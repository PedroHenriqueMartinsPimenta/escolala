<?php
	$page = "Atividades";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 0) {
	$user_codigo = $_SESSION['codigo'];
	$escola_codigo = $_SESSION['escola_codigo'];
	include_once('../content/banner.php');

?>		
<h3>Atividades</h3>		
<div style="overflow: auto"> 
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Código</th>
	      <th scope="col">Turma</th>	      
	      <th scope="col">Ínicio</th>
	      <th scope="col">Fim</th>
	      <th scope="col">Arquivo</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$data = date('Y-m-d');
	  		$sql = "SELECT atividade.CODIGO, atividade.INICIO, atividade.FIM, atividade.SRC, turma.NOME FROM atividade INNER JOIN turma ON atividade.turma_CODIGO = turma.CODIGO INNER JOIN usuario_has_turma ON turma.CODIGO = usuario_has_turma.turma_CODIGO WHERE usuario_has_turma.usuario_CODIGO = $user_codigo AND usuario_has_turma.STATUS = 1 AND (atividade.FIM >= '$data' OR atividade.FIM = '0000-00-00') GROUP BY atividade.CODIGO ORDER BY INICIO DESC";
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {

	  				?>
	  				<tr>
				      <th scope="row"><?php echo $row['CODIGO']?></th>
				      <td><?php echo $row['NOME']?></td>
				      <td><?php echo $row['INICIO']?></td>
				      <td><?php echo $row['FIM']?></td>
				      <td><a href="<?php echo $row['SRC']?>" target="_blank"><?php echo $row['SRC']?></a></td>
				    </tr>
	  				<?php
	  			}
	  		}else {
	  			?>
			    <tr>
			      <th scope="row" colspan="3">Nenhuma atividade cadastrada ainda!</th>
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