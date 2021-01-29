<?php
	$page = "Frequência";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 1) {
	$escola_codigo = $_SESSION['escola_codigo'];
	$user_codigo = $_SESSION['codigo'];
	include_once('../content/banner.php');
	if (isset($_GET['dia'])) {
		$data = $_GET['dia'];
		$periodo = $_GET['periodo'];
		$turma = $_GET['turma'];
		$aula = $_GET['aula'];
	}else{
		$data = date('Y-m-d');
		$sql = "SELECT * FROM periodo WHERE INICIO <= '$data' AND FIM >= '$data' AND escola_CODIGO = $escola_codigo ORDER BY INICIO ASC LIMIT 1";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$periodo = $row['CODIGO'];
		$sql = "SELECT turma.NOME, turma.CODIGO FROM materia INNER JOIN turma ON materia.turma_CODIGO = turma.CODIGO WHERE materia.usuario_CODIGO = $user_codigo LIMIT 1";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$turma = $row['CODIGO'];
		$sql = "SELECT aula.NOME, aula.CODIGO FROM aula WHERE escola_CODIGO = $escola_codigo LIMIT 1";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$aula = $row['CODIGO'];
	}
?>		
<h3>Frequência</h3>
<div class="row">
	<div class="col-12">
		<form action="frequencia.php" method="get">
			<label>Data: <span id="required">*</span></label>
			<input type="date" name="dia" class="form-control" required value="<?php echo $data?>">

			<label>Período: <span id="required">*</span></label>
			<select name="periodo" id="periodo" required class="form-control">
				<?php
					$data = date('Y-m-d');
					$sql = "SELECT * FROM periodo WHERE escola_CODIGO = $escola_codigo AND FIM >= '$data'";
					$query = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($query)) {
						?>
						<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
						<?php
					}
				?>
			</select>

			<label>Aula: <span id="required">*</span></label>
			<select name="aula" id="aula" class="form-control" required>
				<?php
					$sql = "SELECT aula.NOME, aula.CODIGO FROM aula WHERE escola_CODIGO = $escola_codigo";
					$query = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($query)) {
						?>
						<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
						<?php
					}
				?>
			</select>

			<label>Turma: <span id="required">*</span></label>
			<select name="turma" id="turma" required class="form-control">
				<?php
					$sql = "SELECT turma.NOME, turma.CODIGO FROM materia INNER JOIN turma ON materia.turma_CODIGO = turma.CODIGO WHERE materia.usuario_CODIGO = $user_codigo";
					$query = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($query)) {
						?>
						<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
						<?php
					}
				?>
			</select>
			<input type="submit" value="Filtrar" class="btn btn-success mt-2">
		</form>
	</div>
</div>
<h3>Alunos:</h3>
<?php
	$sql = "SELECT * FROM usuario_has_turma INNER JOIN usuario ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO WHERE usuario_has_turma.turma_CODIGO = $turma AND usuario_has_turma.STATUS = 1 AND usuario.PERMISSAO = 0";
	$query = mysqli_query($con, $sql);
	if (mysqli_num_rows($query) > 0) {
		while ($row = mysqli_fetch_array($query)) {
			$c = $row['CODIGO'];
			$sql = "SELECT * FROM frequencia WHERE usuario_CODIGO = $c AND aula_CODIGO = $aula AND periodo_CODIGO = $periodo AND DATA = '$data'";
			$query_frequencia = mysqli_query($con, $sql);
			if (mysqli_num_rows($query_frequencia) > 0) {
				?>
					<div class="row mt-3" style="padding: 20px">
						<div class="col-12">
							    <div class="custom-control custom-checkbox">
							        <input type="checkbox" class="custom-control-input" id="code<?php echo $row['CODIGO']?>" checked onchange="atualiza(this)" value="<?php echo $row['CODIGO']?>">
							        <label class="custom-control-label" for="code<?php echo $row['CODIGO']?>" style="font-weight: bolder;"><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></label>
							    </div>
						</div>
					</div>
					<hr>
				<?php
			}else{
				?>
					<div class="row mt-3" style="padding: 20px">
						<div class="col-12">
							    <div class="custom-control custom-checkbox">
							        <input type="checkbox" class="custom-control-input" id="code<?php echo $row['CODIGO']?>" onchange="atualiza(this)" value="<?php echo $row['CODIGO']?>">
							        <label class="custom-control-label" for="code<?php echo $row['CODIGO']?>" style="font-weight: bolder;"><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></label>
							    </div>
						</div>
					</div>
					<hr>
				<?php
			}
		}
	}else{
		?>
		<div class="row mt-3">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<b>Esta turma ainda não tem alunos</b>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
?>


<script type="text/javascript">
	var periodo = <?php echo $periodo?>;
	var aula = <?php echo $aula?>;
	var data = "<?php echo $data?>";
	
	window.onload = function(){
		$('#periodo').val(<?php echo $periodo?>);
		$('#turma').val(<?php echo $turma?>);
		$('#aula').val(<?php echo $aula?>);
	}
	function atualiza(input){
		var codigo = input.value;
		var presente = 1;
		if (!input.checked) {
			presente = 0;
		}
		var dados = {aluno: codigo, periodo: periodo, aula: aula, data: data, presente: presente};
		$.post(
			"../controller/frequencia.php?id=1",
			dados, 
			function(result){
				if (!result) {
					if (presente == 1) {
						input.checked = false;
					}else{
						input.checked = true;
					}
				}
			},
			'JSON'
			);
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