<?php
	$page = "Avaliações";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 1) {
	$escola_codigo = $_SESSION['escola_codigo'];
	$user_codigo = $_SESSION['codigo'];
	$data = date('Y-m-d');
	$codigo = $_GET['codigo'];
	$sql = "SELECT * FROM avaliacao WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$row_dados = mysqli_fetch_array($query);
	$data = date('Y-m-d');
	$sql = "SELECT * FROM periodo WHERE escola_CODIGO = $escola_codigo AND INICIO <= '$data' AND FIM >= '$data'";
	$query_periodo = mysqli_query($con, $sql);
	include_once('../content/banner.php');

?>		
<h3>Editando a avaliação: <?php echo $row_dados['NOME']?></h3>
<div class="row"> 
	<div class="col-12"> 
		<form action="../controller/avaliacoes.php?id=3&&codigo=<?php echo $codigo?>" method="post" enctype="multipart/form-data"> 
			<label>Nome da avaliação: <span id="required">*</span></label>
			<input type="text" name="nome" class="form-control" required placeholder="Avaliação de Física / Avaliação comportamental" value="<?php echo $row_dados['NOME']?>">

			<label>Matéria da avaliação: <span id="required">*</span></label>
			<select name="materia" required="" id="materia">
				<?php
					$sql = "SELECT materia.CODIGO, materia.NOME, turma.NOME AS TURMA FROM materia INNER JOIN turma ON materia.turma_CODIGO = turma.CODIGO WHERE materia.usuario_CODIGO = $user_codigo";
					$query = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($query)) {
						?>
							<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME'] . " / " . $row['TURMA']?></option>
						<?php
					}
				?>
			</select>

			<label>Período: <span id="required">*</span></label>
			<select name="periodo" id="periodo" onchange="vereficPeriodo(this)">
				<option>Selecione um período</option>
				<?php
					$array = array();
					$i = 0;
					while ($row = mysqli_fetch_array($query_periodo)) {
						$array[$i] = array($row['CODIGO'], $row['MEDIA']);
						$i++;
						?>
							<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
						<?php
					}
				?>
			</select>

			<div id="peso" style="display: none">
				<label>Média ponderada, informe o peso da avaliação para o calculo final da média do período: <span id="required">*</span></label>
				<input type="number" name="peso" class="form-control" value="<?php echo $row_dados['PESO']?>">
			</div>
			<input type="text" name="type" readonly="" style="display: none" value="<?php echo $row_dados['TIPO']?>">

			<div id="qtd_questoes" style="display: none"> 
				<label>Quantidade de questões</label>
				<input type="number" id="numero" class="form-control">
				<button type="button" class="btn btn-secondary" onclick="inserir()">OK</button>
			</div>	
			<?php
				if ($row_dados['TIPO'] == 1) {
					?>
						<div id="questoes">
							<div class="questao">
								<?php
									$avaliacao_codigo = $row_dados['CODIGO'];
									$i = 1;
									$sql = "SELECT * FROM questoes WHERE avaliacao_CODIGO = $avaliacao_codigo";
									$query = mysqli_query($con, $sql);
									$letras  = array('a', 'b', 'c', 'd', 'e');
									$index = 0;
									while ($row = mysqli_fetch_array($query)) {
										$questao_codigo = $row['CODIGO'];
										$c = 0;
										?>
										<h3 class="mt-4">Pergunta <?php echo $i?></h3><hr>

										<input type="number" name="questao_codigo<?php echo $i?>" value="<?php echo $row['CODIGO']?>" class="form-control" readonly>
										<label>Pergunta: </label>
										<textarea name="pergunta<?php echo $i?>" class="form-control"><?php echo $row['PERGUNTA']?></textarea>

										<a href="<?php echo $row['IMAGE']?>" target="_blank"><?php echo $row['IMAGE']?></a><br>
										<label>Matérial de apoio:</label>	
										<input type="file" name="arquivo<?php echo $i?>" class="form-control"><br>
										<?php 
											$sql = "SELECT * FROM alternativa WHERE questoes_CODIGO = $questao_codigo";
											$query_alternativas = mysqli_query($con, $sql);
											while ($row_alternativas = mysqli_fetch_array($query_alternativas)) {
												if ($row_alternativas['CODIGO'] == $row['CORRETA']) {
													$c = $index + 1;
												}
												?>


													<input type="number" name="<?php echo $letras[$index]?>_codigo<?php echo $i?>" value="<?php echo $row_alternativas['CODIGO']?>" class="form-control" readonly style="display: none">
													<label><?php echo strtoupper($letras[$index])?>) </label>
													<input type="text" name="<?php echo $letras[$index]?><?php echo $i?>" class="form-control" value="<?php echo $row_alternativas['OPCAO']?>">
												<?php
												$index++;
											}
											$index = 0;
										?>

										<label>Correta:</label>					
										<select name="correta<?php echo $i?>" id="correta<?php echo $i?>" class="form-control">					
											<option value="1">A</option>						
											<option value="2">B</option>						
											<option value="3">C</option>						
											<option value="4">D</option>						
											<option value="5">E</option>					
										</select>
										<script type="text/javascript">
											document.querySelector("#correta<?php echo $i?>").value = <?php echo $c?>
										</script>
										<?php
										$i++;
									}
								?>
							</div>
						</div>
					<?php
				}else{
					?>
						<div id="questoes" style="display: none">
							<div class="questao">
								
							</div>
						</div>
					<?php
				}
			?>

			<input type="submit" value="Atualizar" class="btn btn-success mt-2 col-md-4">
		</form>
	</div>	
</div>	
<script type="text/javascript">
	window.onload = function(){
		$('#materia').val(<?php echo $row_dados['materia_CODIGO']?>);
		$("#periodo").val(<?php echo $row_dados['periodo_CODIGO']?>);
		$('#type').val(<?php echo $row_dados['TIPO']?>);
		vereficPeriodo(document.querySelector("#periodo"));

	}
	var matriz = <?php echo json_encode($array)?>;
	var questao = "";
	var number_questao = 1;
	function vereficPeriodo(select){
		var codigo = select.value;
		for(key in matriz){
			if (matriz[key][0] == codigo) {
				if (matriz[key][1] == 1) {
					$("#peso").fadeIn('slow');
				}else{
					$("#peso").fadeOut();
				}
			}	
		}
	}

	function vereficAvaliacao(select){
		var value = select.value;
		if (value == 1) {
			$('#qtd_questoes').fadeIn('slow');
		}else{
			$('#qtd_questoes').fadeOut();
			$('.questao').html("");
			$("#questoes").fadeOut();
			number_questao = 1;
		}
	}
	function inserir(){
		number_questao = 1;
		var count = $('#numero').val();
		$('.questao').html("");
		for (var i = 0; i < count; i++) {
			add_questao();
		}
		$("#questoes").fadeIn();
	}
	function add_questao(){
		var questao = '<h3 class="mt-4">Pergunta '+number_questao+'</h3><hr><label>Pergunta: </label><textarea name="pergunta'+number_questao+'" class="form-control"></textarea><label>Matérial de apoio:</label>					<input type="file" name="arquivo'+number_questao+'" class="form-control"><br>					<label>A) </label>					<input type="text" name="a'+number_questao+'" class="form-control">										<label>B) </label>						<input type="text" name="b'+number_questao+'" class="form-control">										<label>C) </label>						<input type="text" name="c'+number_questao+'" class="form-control">										<label>D) </label>						<input type="text" name="d'+number_questao+'" class="form-control">									<label>E) </label>						<input type="text" name="e'+number_questao+'" class="form-control">										<label>Correta:</label>					<select name="correta'+number_questao+'" class="form-control">					<option value="1">A</option>						<option value="2">B</option>						<option value="3">C</option>						<option value="4">D</option>						<option value="5">E</option>					</select> ';
		$('.questao').html($('.questao').html() + questao);
		number_questao++;
	}
	function desativar(codigo){
		var confirm = window.confirm("Isto desativará esta avaliação!");
		if (confirm) {
			window.location.href = '../controller/avaliacoes.php?id=2&&codigo=' + codigo + "&&ativo=0";
		}
	}
	function ativar(codigo){
		window.location.href = '../controller/avaliacoes.php?id=2&&codigo=' + codigo + "&&ativo=1";
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