<?php
	$page = "Avaliações";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 1) {
	$escola_codigo = $_SESSION['escola_codigo'];
	$user_codigo = $_SESSION['codigo'];
	$data = date('Y-m-d');
	$sql = "SELECT * FROM periodo WHERE escola_CODIGO = $escola_codigo AND INICIO <= '$data' AND FIM >= '$data'";
	$query_periodo = mysqli_query($con, $sql);
	include_once('../content/banner.php');

?>		
<h3>Avaliações</h3>
<div class="row"> 
	<div class="col-md-4"> 
		<button class="btn btn-primary col-12 mb-2" onclick="action()" id="button">Adicionar nova</button>
	</div>
</div>
<div class="row" style="display: none" id="model"> 
	<div class="col-12"> 
		<form action="../controller/avaliacoes.php?id=1" method="post" enctype="multipart/form-data"> 
			<label>Nome da avaliação: <span id="required">*</span></label>
			<input type="text" name="nome" class="form-control" required placeholder="Avaliação de Física / Avaliação comportamental">

			<label>Matéria da avaliação: <span id="required">*</span></label>
			<select name="materia" required="">
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
				<input type="number" name="peso" class="form-control" value="1">
			</div>

			<label>Tipo de avalição: <span id="required">*</span></label>
			<select name="type" id="type" required="" onchange="vereficAvaliacao(this)">
				<option value="0" title="Você deve inserir as notas dos alunos manualmente">Avaliação simples</option>
				<option value="1" title="É gerada uma prova online">Avaliação online</option>
			</select>

			<div id="qtd_questoes" style="display: none"> 
				<label>Quantidade de questões</label>
				<input type="number" id="numero" class="form-control">
				<button type="button" class="btn btn-secondary" onclick="inserir()">OK</button>
			</div>	
			<div id="questoes" style="display: none">
				<div class="questao">
					
				</div>
			</div>

			<input type="submit" value="Adicionar" class="btn btn-success mt-2 col-md-4">
		</form>
	</div>	
</div>		
<div style="overflow: auto"> 
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Código</th>
	      <th scope="col">Nome</th>
	      <th scope="col">Turma</th>
	      <th scope="col">Período</th>
	      <th scope="col">Matéria</th>
	      <th scope="col">Tipo</th>
	      <th scope="col">Peso</th>
	      <th scope="col">Notas</th>
	      <th scope="col">Editar</th>
	      <th scope="col">Ativar / Desativar</th>
	      <th scope="col">Remover</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$data = date('Y-m-d');
	  		$sql = "SELECT avaliacao.CODIGO, avaliacao.NOME, avaliacao.PESO, avaliacao.ATIVA, avaliacao.TIPO, periodo.NOME AS PERIODO, materia.NOME AS MATERIA, turma.NOME AS TURMA FROM avaliacao INNER JOIN periodo ON avaliacao.periodo_CODIGO = periodo.CODIGO INNER JOIN materia ON avaliacao.materia_CODIGO = materia.CODIGO INNER JOIN turma ON materia.turma_CODIGO = turma.CODIGO WHERE periodo.escola_CODIGO = $escola_codigo AND materia.usuario_CODIGO = $user_codigo AND periodo.FIM >= '$data' ORDER BY avaliacao.CODIGO DESC";
	  		$query = mysqli_query($con, $sql);
	  		echo mysqli_error($con);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {
	  				if ($row['ATIVA'] == 1) {
	  					?>
	  						<tr>
	  					<?php
	  				}else{
	  					if ($row['TIPO'] == 1) {
	  						?>
		  						<tr style="opacity: 0.5">
		  					<?php
	  					}
	  				}
	  				?>
				      <th scope="row"><?php echo $row['CODIGO']?></th>
				      <td><?php echo $row['NOME']?></td>
				      <td><?php echo $row['TURMA']?></td>
				      <td><?php echo $row['PERIODO']?></td>
				      <td><?php echo $row['MATERIA']?></td>
				      <td><?php
				      		if($row['TIPO'] == 1){
				      			echo "Avaliação online";
				      		}else{
				      			echo "Avaliação simples";
				      		}
				      ?></td>
				      <td><?php echo $row['PESO']?></td>
				      <td><a href="notas_avaliacao.php?codigo=<?php echo $row['CODIGO']?>" class="btn">Ver</a></td>
				      <td><a href="editar_avaliacao.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-outline-primary">Editar</a></td>
				      <td>
				      	<?php
				      		if ($row['ATIVA'] == 1) {
				      			?>
				      				<button class="btn btn-outline-danger" title="Avaliação desativada não é contabilizada" onclick="desativar(<?php echo $row['CODIGO']?>)">
							      		Desativar
								    </button>
				      			<?php
				      		}else if($row['TIPO'] == 1){
				      			?>
				      				<button class="btn btn-outline-success" onclick="ativar(<?php echo $row['CODIGO']?>)">
							      		Ativar
								    </button>
				      			<?php
				      		}
				      	?>
					  </td>
					  <td><button class="btn btn-outline-danger" onclick="remover_avaliacao(<?php echo $row['CODIGO']?>)">Remover</button></td>
				    </tr>
	  				<?php
	  			}
	  		}else {
	  			?>
			    <tr>
			      <th scope="row" colspan="3">Nenhuma aula cadastrada ainda!</th>
			    </tr>

	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>
<script type="text/javascript">
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
	function remover_avaliacao(codigo){
		var confirm = window.confirm("Isto apagarar permanentemente esta avaliação e tudo vinculado a ela!");
		if (confirm) {
			window.location.href = '../controller/avaliacoes.php?id=5&&codigo=' + codigo ;
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