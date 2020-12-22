<?php
	$page = "Turmas";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	include_once('../content/banner.php');
	$codigo = $_GET['codigo'];
	$sql = "SELECT * FROM turma WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
?>	

<h3>Editando turma: <?php echo $row['NOME']?></h3>
<div class="row">
	<div class="col-12">
		<form action="../controller/turmas.php?id=3&&codigo=<?php echo $row['CODIGO']?>" method="post">
			<label>Nome:</label>
			<input type="text" name="nome" class="form-control" required value="<?php echo $row['NOME']?>">	

			<label>Limite de alunos:</label>
			<input type="number" name="limite" class="form-control" required value="<?php echo $row['LIMITE']?>">

			<input type="submit" value="Atualizar" class="btn btn-success mt-2">			
		</form>
	</div>
</div>
<?php
}else{
	$page = "404";
	include_once('../content/banner.php');
	include_once('../content/404.php');
}
	include_once('../content/footer.php');
?>