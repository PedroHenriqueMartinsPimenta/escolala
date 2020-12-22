<?php
	$page = "Frequência";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 0) {
	$user_codigo = $_SESSION['codigo'];
	$escola_codigo = $_SESSION['escola_codigo'];
	include_once('../content/banner.php');

?>		
<h3>Frequência</h3>	
<div style="overflow: auto"> 
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Período</th>
	      <th scope="col">Faltas</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$ano = date('Y');
	  		$sql = "SELECT COUNT(frequencia.CODIGO) AS PRESENCA, periodo.NOME, periodo.CODIGO AS PERIODO_CODIGO FROM frequencia INNER JOIN periodo ON frequencia.periodo_CODIGO = periodo.CODIGO WHERE frequencia.usuario_CODIGO = $user_codigo AND YEAR(frequencia.DATA) = $ano GROUP BY periodo.CODIGO ORDER BY periodo.CODIGO ASC";
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {
	  				$periodo_codigo = $row['PERIODO_CODIGO'];
	  				$sql = "SELECT * FROM frequencia INNER JOIN usuario ON frequencia.usuario_CODIGO = usuario.CODIGO WHERE usuario.escola_CODIGO = $escola_codigo AND frequencia.periodo_CODIGO = $periodo_codigo GROUP BY CONCAT(frequencia.DATA, frequencia.aula_CODIGO)";
	  				$query_count = mysqli_query($con, $sql);
	  				$dias_letivos = mysqli_num_rows($query_count);
	  				?>
	  				<tr>
				      <th scope="row"><?php echo $row['NOME']?></th>
				      <td><?php echo $dias_letivos - $row['PRESENCA']?></td>
	  				<?php
	  			}
	  		}else {
	  			?>
			    <tr>
			      <th scope="row" colspan="3">Nenhuma frequência registrada ainda!</th>
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