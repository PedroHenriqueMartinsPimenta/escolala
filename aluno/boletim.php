<?php
	$page = "Boletim";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 0) {
	$user_codigo = $_SESSION['codigo'];
	$escola_codigo = $_SESSION['escola_codigo'];
	include_once('../content/banner.php');

?>		
<h3>Boletim</h3>		
<div style="overflow: auto"> 
	<table class="table">
	  <thead>
	    <tr>

	      <th scope="col">Materia</th>
	      <?php
	      	$ano = date('Y');
	      	$sql = "SELECT * FROM periodo WHERE escola_CODIGO = $escola_codigo AND YEAR(FIM) = $ano ORDER BY FIM ASC";
	      	$query = mysqli_query($con, $sql);
	      	$periodos_codigo = array();
	      	$i = 0;
	      	while ($row = mysqli_fetch_array($query)) {
	      		$periodos_codigo[$i] = $row['CODIGO'];
	      		$i++;
	      		?>
	     		 <th scope="col"><?php echo $row['NOME']?></th>
	      		<?php
	      	}
	      ?>
	      <th scope="col">Média final</th>

	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$data = date('Y-m-d');
	  		$sql = "SELECT materia.NOME, materia.CODIGO FROM materia INNER JOIN turma ON materia.turma_CODIGO = turma.CODIGO INNER JOIN usuario_has_turma ON turma.CODIGO = usuario_has_turma.turma_CODIGO WHERE usuario_has_turma.usuario_CODIGO = $user_codigo AND usuario_has_turma.STATUS = 1 GROUP BY materia.CODIGO";
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {

	  				?>
	  				<tr>
				      <th scope="row"><?php echo $row['NOME']?></th>
				      <?php
				      	$soma_medias = 0;
			      		$array_notas = array();
			      		$a = 0;
				      	for ($i=0; $i < sizeof($periodos_codigo); $i++) { 
				      		$periodo = $periodos_codigo[$i];
				      		$materia = $row['CODIGO'];
				      		$numerador = 0;
				      		$denominador = 0;
				      		$sql = "SELECT avaliacao_has_usuario.NOTA, avaliacao.PESO FROM periodo INNER JOIN avaliacao ON periodo.CODIGO = avaliacao.periodo_CODIGO INNER JOIN avaliacao_has_usuario ON avaliacao_has_usuario.avaliacao_CODIGO = avaliacao.CODIGO WHERE avaliacao.periodo_CODIGO = $periodo AND avaliacao.materia_CODIGO = $materia AND avaliacao_has_usuario.usuario_CODIGO = $user_codigo AND avaliacao_has_usuario.NOTA <= 10 GROUP BY avaliacao.CODIGO";
				      		$query_notas = mysqli_query($con, $sql);
				      		echo mysqli_error($con);
				      		while ($row_notas = mysqli_fetch_array($query_notas)) {
				      			$numerador += $row_notas['NOTA'] * $row_notas['PESO'];
				      			$denominador += $row_notas['PESO']; 
				      		}
				      		if ($denominador != 0) {
				      			$media = $numerador / $denominador;
				      		}else{
				      			$media = 0;
				      		}
				      		$soma_medias += $media;
				      		$array_notas[$a] = $media;
				      		$a++;
				      		?>
				      				<td><?php echo $media?></td>
				      		<?php
				      	}

				      ?>
				      <td><?php echo ($soma_medias / sizeof($array_notas))?></td>
				    </tr>
	  				<?php
	  			}
	  		}else {
	  			?>
			    <tr>
			      <th scope="row" colspan="<?php echo (sizeof($periodos_codigo) + 2)?>">Nenhuma nota cadastrada ainda!</th>
			    </tr>

	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>
<?php
}else{
	$page = "404";
	include_once('../content/banner.php');
	include_once('../content/404.php');
}
	include_once('../content/footer.php');
?>