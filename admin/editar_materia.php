<?php
	$page = "Matérias";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	include_once('../content/banner.php');
	$codigo = $_GET['codigo'];
	$sql = "SELECT * FROM materia WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$row_dados = mysqli_fetch_array($query);
?>		
<h3>Editando a matéria: </h3>
<div class="row"> 
	<div class="col-12"> 
		<form action="../controller/materias.php?id=3&&codigo=<?php echo $row_dados['CODIGO']?>" method="post"> 
			<label>Nome da matéria:<span id="required">*</span></label>
			<input type="text" name="nome" class="form-control" required value="<?php echo $row_dados['NOME']?>">

			<label>Professor responsável: <span id="required">*</span></label>
			<select name="professor" id="professor">
				<option value="0">Selecione um professor</option>
				<?php
					$escola_codigo = $_SESSION['escola_codigo'];
					$sql = "SELECT * FROM usuario WHERE escola_CODIGO = $escola_codigo AND PERMISSAO = 1";
					$query = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($query)) {
						?>
							<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
						<?php
					}
				?>
			</select>


			<label>Turma: <span id="required">*</span></label>
			<select name="turma" id="turma">
				<option value="0">Selecione uma turma</option>
				<?php
					$sql = "SELECT turma.NOME, turma.CODIGO FROM usuario INNER JOIN usuario_has_turma ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO INNER JOIN turma ON usuario_has_turma.turma_CODIGO = turma.CODIGO WHERE usuario.escola_CODIGO = $escola_codigo GROUP BY turma.CODIGO";
					$query = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($query)) {
						?>
							<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
						<?php
					}
				?>
			</select>
			<input type="submit" value="Atualizar" class="btn btn-success mt-2 col-md-4">
		</form>
	</div>	
</div>
<script type="text/javascript">
	window.onload = function(){
		$('#professor').val(<?php echo json_encode($row_dados['usuario_CODIGO'])?>);
		$('#turma').val(<?php echo json_encode($row_dados['turma_CODIGO'])?>);
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