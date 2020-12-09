<?php
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 0) {
	$codigo = $_GET['codigo'];
	$sql = "SELECT * FROM avaliacao WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	$page = $row['NOME'];
	$user_codigo = $_SESSION['codigo'];
	$escola_codigo = $_SESSION['escola_codigo'];
	include_once('../content/banner.php');
	if (isset($_GET['comando'])){
			$comando = $_GET['comando'];
			if ($comando == 1) {
				?>
					<div class="row">
						<div class="col-12">
							<form action="../controller/avaliacoes_aluno.php?id=1"	 method="post">
								<input type="hidden" name="avaliacao" value="<?php echo $row['CODIGO']?>">
								<?php
									$sql = "SELECT questoes.CODIGO, questoes.PERGUNTA, questoes.IMAGE, alternativa.CODIGO AS ALTERNATIVA, alternativa.OPCAO FROM questoes INNER JOIN alternativa ON questoes.CODIGO = alternativa.questoes_CODIGO WHERE questoes.avaliacao_CODIGO = $codigo";
									$query_questoes = mysqli_query($con, $sql);
									$i = 1;
									$questao_codigo = -10;
									$array = array("a", "b", "c", "d", "e");
									$letra = 0;
									while ($row_questoes = mysqli_fetch_array($query_questoes)) {
										if ($questao_codigo != $row_questoes['CODIGO']) {
											if($questao_codigo >= 0){
												?>
													</div>
												<?php
											}
											$questao_codigo = $row_questoes['CODIGO'];
											?>	
												<div class="row mt-5"> 
												<h4><?php echo $i?>ºQuestão</h4>
												<div class="card col-12">
													<div class="card-header">
														<b><?php echo $row_questoes['PERGUNTA']?></b>
														<?php
															if ($row_questoes['IMAGE'] != "") {
																?>

																	<br> 
																	<br> 
																	<hr> 
																	Material de apoio:<br> 
																	<a href="<?php echo $row_questoes['IMAGE']?>" target="_blank"><?php echo $row_questoes['IMAGE']?></a>
																<?php
															}
														?>
													</div>
												</div>
												<label>
													<input type="radio" name="<?php echo $row_questoes['CODIGO']?>" value="<?php echo $row_questoes['ALTERNATIVA']?>"><?php echo $row_questoes['OPCAO']?>
												</label>
											<?php
											$letra++;
											$i++;
										}else if($questao_codigo == $row_questoes['CODIGO']){
											?>
												<label>
													<input type="radio" name="<?php echo $row_questoes['CODIGO']?>" value="<?php echo $row_questoes['ALTERNATIVA']?>"><?php echo $row_questoes['OPCAO']?>
												</label>
											<?php
											if ($letra == sizeof($array) - 1) {
												$letra = 0;
											}else{
												$letra++;
											}

										}
									}
								?>
							</div>
								<input type="submit" value="Finalizar" class="btn btn-success mt-4">
							</form>
						</div>	
					</div>	
				<?php
			}else if ($comando == 2) {
				$sql = "SELECT * FROM avaliacao_has_usuario WHERE usuario_CODIGO = $user_codigo AND avaliacao_CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				$nota = mysqli_fetch_array($query)['NOTA'];
				?>
					<div class="row">
						<div class="col-12">
							<h2>Prova finalizada com sucesso!</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-12"> 
							Parabéns por finalizar mais esta avaliação! <br> 
							<b>Sua nota foi: <?php echo $nota?></b><br> 
							<a href="avaliacoes.php" class="btn btn-success mt-2">Voltar para as avalições</a>
						</div>	
					</div>	
				<?php
			}
	}else{
		?>
			<div class="row">
				<div class="col-12">
					<h2>Iniciar prova</h2>
				</div>
			</div>
			<div class="row"> 
				<div class="col-12">
					Você agora irá iniciar a avaliação: <?php echo $row['NOME']?>
				</div>
				<div class="col-12 mt-3"> 
					<ul>
						<li>Faça com o conhecimento adequirido durante o período de aula</li>
						<li>Empenhe-se para alcançar o seu melhor resultado</li>
						<li>Não cole</li>
						<li>A nota desta avaliação terá peso <?php echo $row['PESO']?> em sua média</li>
					</ul>
				</div>
				<div class="col-12 mt-3"> 
					<h3>Boa sorte!</h3>
					<a href="prova.php?codigo=<?php echo $codigo?>&&comando=1" class="btn btn-success">Iniciar</a>
				</div>		
			</div>	
		<?php
	}
?>	
<?php
}else{
	$page = "404";
	include_once('../content/banner.php');
	include_once('../content/404.php');
}
	include_once('../content/footer.php');
?>