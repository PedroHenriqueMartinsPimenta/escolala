<?php
	$page = "Horários";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$escola_codigo = $_SESSION['escola_codigo'];
	$codigo = $_GET['codigo'];
	$sql = "SELECT * FROM horario WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$row_dados = mysqli_fetch_array($query);
	include_once('../content/banner.php');

?>		
<h3>Editando horário do código: <?php echo $codigo?></h3>
<div class="row"> 
	<div class="col-12"> 
		<form action="../controller/horarios.php?id=3&&codigo=<?php echo $codigo?>" method="post"> 
			<label>Dia da semana: <span id="required">*</span></label>
			<select name="dia_semana" required id="dia">
				<option value="1">Segunda</option>
				<option value="2">Terça</option>
				<option value="3">Quarta</option>
				<option value="4">Quinta</option>
				<option value="5">Sexta</option>
				<option value="6">Sábado</option>
				<option value="0">Domingo</option>
			</select>	
			
			<label>Aula: <span id="required">*</span></label>
			<select name="aula" required id="aula">
				<?php
					$sql = "SELECT * FROM aula WHERE escola_CODIGO = $escola_codigo";
					$query = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($query)) {
						?>
							<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
						<?php
					}
				?>
			</select>

			<label>Matéria: <span id="required">*</span></label>
			<select name="materia" required id="materia">
				<?php
					$sql = "SELECT materia.CODIGO, materia.NOME, usuario.NOME AS PROFESSOR, turma.NOME AS TURMA FROM materia INNER JOIN usuario ON usuario.CODIGO = materia.usuario_CODIGO INNER JOIN turma ON turma.CODIGO = materia.turma_CODIGO WHERE usuario.escola_CODIGO = $escola_codigo AND usuario.PERMISSAO = 1";
					$query = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($query)) {
						?>
							<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME'] . " - " . $row['PROFESSOR'] . " / " . $row['TURMA']?></option>
						<?php
					}
				?>
			</select>
			<input type="submit" value="Atualizar" class="btn btn-success mt-2 col-md-4">
		</form>
	</div>	
</div>
<script>
	window.onload = function(){
		$('#dia').val(<?php echo $row_dados['DIA']?>);
		$('#aula').val(<?php echo $row_dados['aula_CODIGO']?>);
		$('#materia').val(<?php echo $row_dados['materia_CODIGO']?>);		
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