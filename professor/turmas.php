<?php
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 1) {
	$page = "Turmas";
	$escola_codigo = $_SESSION['escola_codigo'];
	$user_codigo = $_SESSION['codigo'];
	include_once('../content/banner.php');

?>		
<h3>Turmas</h3>
<?php
	$sql = "SELECT * FROM periodo WHERE escola_CODIGO = $escola_codigo";
	$query = mysqli_query($con, $sql);
?>	
<div style="overflow: auto"> 
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Código</th>
	      <th scope="col">Nome</th>
	      <th scope="col">Alunos / limite</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$sql = "SELECT turma.CODIGO, turma.NOME, turma.LIMITE FROM turma INNER JOIN materia ON materia.turma_CODIGO = turma.CODIGO WHERE materia.usuario_CODIGO = $user_codigo GROUP BY turma.CODIGO";
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {
	  				$turma_codigo = $row['CODIGO'];
	  				$sql = "SELECT COUNT(usuario_CODIGO) AS QTD FROM usuario_has_turma INNER JOIN usuario ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO WHERE usuario.PERMISSAO = 0 AND usuario_has_turma.turma_CODIGO = $turma_codigo AND usuario_has_turma.STATUS = 1";
	  				$query2 = mysqli_query($con, $sql);
	  				$row2 = mysqli_fetch_array($query2);

	  				?>
	  				<tr>
				      <th scope="row"><?php echo $row['CODIGO']?></th>
				      <td><?php echo $row['NOME']?></td>
				      <td><?php echo $row2['QTD']?> / <?php echo $row['LIMITE']?></td>
				    </tr>
	  				<?php
	  			}
	  		}else {
	  			?>
			    <tr>
			      <th scope="row" colspan="3">Nenhuma turma cadastrada ainda!</th>
			    </tr>

	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>
<script type="text/javascript">
	function remover(codigo){
		var confirm = window.confirm("Isto removerá todos os alunos nesta turma!");
		if (confirm) {
			window.location.href = '../controller/turmas.php?id=2&&codigo=' + codigo
		}
	}
</script>
<?php
}else{
	$page = "404";
	include_once('../content/banner.php');
	include_once('../content/404.php');
}
	include_once('../content/footer.php');
?>