<?php
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 1) {
	$page = "Atividades";
	$codigo = $_GET['codigo'];
	$sql = "SELECT * FROM atividade WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	$user_codigo = $_SESSION['codigo'];
	include_once('../content/banner.php');

?>		
<h3>Editando a atividade <?php echo $codigo?></h3>
<div class="row"> 
	<div class="col-12"> 
		<form action="../controller/atividades.php?id=3&&codigo=<?php echo $codigo?>" method="post" enctype="multipart/form-data"> 
			<label>Data de entrega:</label>
			<input type="date" name="fim" class="form-control" value="<?php echo $row['FIM']?>">

			<label>Atividade atual:</label>
			<a href="<?php echo $row['SRC']?>" target="_blank"><?php echo $row['SRC']?></a> <br>

			<label>Atividade (dê preferência a PDFs): </label>
			<input type="file" name="arquivo" class="form-control"> <br> 
			
			<label>Turma:</label>
			<select name="turma" id="turma" class="form-control">
				<?php
					$sql = "SELECT turma.CODIGO, turma.NOME FROM materia INNER JOIN turma ON materia.turma_CODIGO = turma.CODIGO WHERE materia.usuario_CODIGO = $user_codigo";
					$query_turma = mysqli_query($con, $sql);
					while ($row_turma = mysqli_fetch_array($query_turma)) {
						?>
						<option value="<?php echo $row_turma['CODIGO']?>"><?php echo $row_turma['NOME']?></option>
						<?php
					}
				?>
			</select>
			
			<input type="submit" value="Atualizar" class="btn btn-success mt-2 col-md-4">
		</form>
	</div>	
</div>
<script type="text/javascript">
	window.onload = function() {
		$('#turma').val(<?php echo $row['turma_CODIGO']?>);
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