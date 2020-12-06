<?php
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$page = "Alunos";
	$escola_codigo = $_SESSION['escola_codigo'];
	$codigo = $_GET['codigo'];
	$sql = "SELECT usuario.NOME, turma.NOME AS TURMA, usuario.CODIGO AS USUARIO_CODIGO, turma.CODIGO AS TURMA_CODIGO, usuario_has_turma.STATUS FROM usuario INNER JOIN usuario_has_turma ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO INNER JOIN turma ON turma.CODIGO = usuario_has_turma.turma_CODIGO WHERE usuario.CODIGO = $codigo AND usuario_has_turma.STATUS = 1";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	include_once('../content/banner.php');

?>		
<h3>Alterar turma do aluno <?php echo $codigo?></h3>
<div class="row">
	<div class="col-12">
		<form action="../controller/alunos.php?id=4&&codigo=<?php echo $codigo?>&&turma=<?php echo $row['TURMA_CODIGO']?>" method="post">
			<div class="row">
				<div class="col-12">
					<h4>Informações sobre a atual turma:</h4>
					<label>Status do estudante na turma <?php echo $row['TURMA']?></label>
					<select name="status" class="form-control" onchange="verefic()" id="status">
						<option value="1">Cursando</option>
						<option value="0">Finalizada</option>
					</select>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-12">
					<h4>Nova turma</h4>
					<label>Selecione a nova turma: <span id="required">*</span></label>
					<select name="turma" required disabled class="form-control" id="turma">
						<?php 
							$turma = $row['TURMA_CODIGO'];
							$sql = "SELECT turma.NOME, turma.CODIGO FROM turma INNER JOIN usuario_has_turma ON turma.CODIGO = usuario_has_turma.turma_CODIGO INNER JOIN usuario ON usuario_has_turma.usuario_CODIGO = usuario.CODIGO WHERE usuario.escola_CODIGO = $escola_codigo AND turma.CODIGO != $turma GROUP BY turma.CODIGO";
							$query_turmas = mysqli_query($con, $sql);
							echo mysqli_error($con);
							while ($row_turmas = mysqli_fetch_array($query_turmas)) {
								?>
									<option value="<?php echo $row_turmas['CODIGO']?>"><?php echo $row_turmas['NOME']?></option>
								<?php
							}
						?>
					</select>
				</div>
			</div>
			<input type="submit" value="Enviar" class="btn btn-success" id="submit" disabled>
		</form>
	</div>
</div>
<script type="text/javascript">
	function verefic(){
		var value = $('#status').val();
		if (value == 0) {
			document.querySelector('#turma').disabled = false;
			document.querySelector("#submit").disabled = false;
		}else if(value == 1){
			document.querySelector('#turma').disabled = true;	
			document.querySelector("#submit").disabled = true;		
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