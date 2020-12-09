<?php
	include_once('conexao.php');
	include_once('../content/config.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			//Registrar avaliação
			$nome = $_POST['nome'];
			$materia = $_POST['materia'];
			$periodo = $_POST['periodo'];
			$peso = $_POST['peso'];
			$type = $_POST['type'];
			$escola_codigo = $_SESSION['escola_codigo'];
			if ($type == 1) {
				$array = array();
				$i = 0;
				$a = 1;
			 	$loop = true;
			 	while ($loop) {
			 		if (isset($_POST['pergunta' . $a])) {
			 			$array[$i] = array(
			 				'pergunta' => $_POST['pergunta' . $a],
			 				'arquivo' => $_FILES['arquivo' . $a],
			 				'a' => $_POST['a' . $a],
			 				'b' => $_POST['b' . $a],
			 				'c' => $_POST['c' . $a],
			 				'd' => $_POST['d' . $a],
			 				'e' => $_POST['e' . $a],
			 				'correta' => $_POST['correta' . $a]
			 			);
			 			$i++;
			 			$a++;
			 		}else{
			 			$loop = false;
			 		}
			 	}
			}

			if ($type == 1) {
				$sql = "INSERT INTO avaliacao (NOME, TIPO, PESO, ATIVA, periodo_CODIGO, materia_CODIGO) VALUES('$nome', $type, $peso, 1, $periodo, $materia)";
			}else if ($type == 0) {
				$sql = "INSERT INTO avaliacao (NOME, TIPO, PESO, periodo_CODIGO, materia_CODIGO) VALUES('$nome', $type, $peso, $periodo, $materia)";
			}
			$query = mysqli_query($con, $sql);
			if ($query) {
				if ($type == 1) {
						$sql = "SELECT CODIGO FROM avaliacao WHERE NOME = '$nome' AND TIPO = $type AND PESO = $peso AND periodo_CODIGO = $periodo AND materia_CODIGO = $materia ORDER BY CODIGO DESC LIMIT 1";
						$query = mysqli_query($con, $sql);
						$row = mysqli_fetch_array($query);
						$codigo = $row['CODIGO'];
						for ($i=0; $i < sizeof($array); $i++) { 
							$dados = $array[$i];
							$link = "";
							if ($dados['arquivo']['name'] != "") {
								$dir = "../upload/" . basename($dados['arquivo']['name']);
								$result = move_uploaded_file($dados['arquivo']['tmp_name'], $dir);
								if ($result) {
									$link = $url . "upload/" . basename($dados['arquivo']['name']);
								}else{
									$_SESSION['error'] = "Erro no envio dos arquivos!";
									header('location: ../professor/avaliacoes.php');
								}
							}
							$pergunta = $dados['pergunta'];
							$correta = $dados['correta'];
							$sql = "INSERT INTO questoes (PERGUNTA, IMAGE, CORRETA, avaliacao_CODIGO) VALUES('$pergunta', '$link', $correta, $codigo)";
							$query = mysqli_query($con, $sql);
							if ($query) {
								$sql = "SELECT CODIGO FROM questoes WHERE PERGUNTA = '$pergunta' AND IMAGE = '$link' AND CORRETA = $correta AND avaliacao_CODIGO = $codigo";
								$query = mysqli_query($con, $sql);
								$row = mysqli_fetch_array($query);
								$codigo_questao = $row['CODIGO'];
								$a = $dados['a'];
								$b = $dados['b'];
								$c = $dados['c'];
								$d = $dados['d'];
								$e = $dados['e'];

								$sql = "INSERT INTO alternativa (OPCAO, questoes_CODIGO) VALUES ('$a', $codigo_questao)";
								$query = mysqli_query($con, $sql);
								$sql = "INSERT INTO alternativa (OPCAO, questoes_CODIGO) VALUES ('$b', $codigo_questao)";
								$query = mysqli_query($con, $sql);
								$sql = "INSERT INTO alternativa (OPCAO, questoes_CODIGO) VALUES ('$c', $codigo_questao)";
								$query = mysqli_query($con, $sql);
								$sql = "INSERT INTO alternativa (OPCAO, questoes_CODIGO) VALUES ('$d', $codigo_questao)";
								$query = mysqli_query($con, $sql);
								$sql = "INSERT INTO alternativa (OPCAO, questoes_CODIGO) VALUES ('$e', $codigo_questao)";
								$query = mysqli_query($con, $sql);

								if ($correta == 1) {
									$sql = "SELECT CODIGO FROM alternativa WHERE questoes_CODIGO = $codigo_questao AND OPCAO = '$a'";
								}else if ($correta == 2) {
									$sql = "SELECT CODIGO FROM alternativa WHERE questoes_CODIGO = $codigo_questao AND OPCAO = '$b'";
								}else  if ($correta == 3) {
									$sql = "SELECT CODIGO FROM alternativa WHERE questoes_CODIGO = $codigo_questao AND OPCAO = '$c'";
								}else  if ($correta == 4) {
									$sql = "SELECT CODIGO FROM alternativa WHERE questoes_CODIGO = $codigo_questao AND OPCAO = '$d'";
								} if ($correta == 5) {
									$sql = "SELECT CODIGO FROM alternativa WHERE questoes_CODIGO = $codigo_questao AND OPCAO = '$e'";
								}
								$query = mysqli_query($con, $sql);
								$row = mysqli_fetch_array($query);
								$correta_codigo = $row['CODIGO'];
								$sql = "UPDATE questoes SET CORRETA = $correta_codigo WHERE CODIGO = $codigo_questao";
								$query = mysqli_query($con, $sql);
								if ($query) {
									$_SESSION['success'] = "Avaliação inserida com sucesso!";
									header('location: ../professor/avaliacoes.php');
								}else{
									$_SESSION['error'] = mysqli_error($con);
									header('location: ../professor/avaliacoes.php');
								}
							}else{
								$_SESSION['error'] = mysqli_error($con);
								header('location: ../professor/avaliacoes.php');
							}
						}
				}else{
					$sql = "SELECT turma_CODIGO FROM materia WHERE CODIGO = $materia";
					$query = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($query);
					$turma_CODIGO = $row['turma_CODIGO'];
					$sql = "SELECT CODIGO FROM avaliacao WHERE NOME = '$nome' AND TIPO = $type AND PESO = $peso AND periodo_CODIGO = $periodo AND materia_CODIGO = $materia ORDER BY CODIGO DESC LIMIT 1";
					$query = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($query);
					$avaliacao_CODIGO = $row['CODIGO'];
					$sql = "SELECT usuario.CODIGO FROM usuario INNER JOIN usuario_has_turma ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO WHERE usuario.PERMISSAO = 0 AND usuario.escola_CODIGO = $escola_codigo AND usuario_has_turma.turma_CODIGO = $turma_CODIGO AND usuario_has_turma.STATUS = 1";
					$query = mysqli_query($con, $sql);
					$m = "";
					while ($row = mysqli_fetch_array($query)) {
						$aluno = $row['CODIGO'];
						$sql = "INSERT INTO avaliacao_has_usuario (usuario_CODIGO, avaliacao_CODIGO, NOTA) VALUES($aluno, $avaliacao_CODIGO, 20)";
						$q = mysqli_query($con, $sql);
						if (!$q) {
							$m .= "<br>" . mysqli_error($con);
						}
					}
					$_SESSION['success'] = "Avalição inserida com sucesso!" . $m;
					header('location: ../professor/avaliacoes.php');
				}
			}else{
				$_SESSION['error'] = mysqli_error($con);
			}
		}else if ($id == 2) {
			// Desativar / ativar
			$codigo = $_GET['codigo'];
			$ativo = $_GET['ativo'];
			$sql = "UPDATE avaliacao SET ATIVA = $ativo WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				if ($ativo == 1) {
					$_SESSION['success'] = "Avaliação ativada com sucesso!";
					header('location: ../professor/avaliacoes.php');
				}else {
					$_SESSION['success'] = "Avaliação desativada com sucesso!";
					header('location: ../professor/avaliacoes.php');
				}
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../professor/avaliacoes.php');
			}
		}else if ($id == 3) {
			//Atualizar a avaliação
			$codigo = $_GET['codigo'];
			$nome = $_POST['nome'];
			$materia = $_POST['materia'];
			$periodo = $_POST['periodo'];
			$peso = $_POST['peso'];
			$type = $_POST['type'];
			if ($type == 1) {
				$array = array();
				$i = 0;
				$a = 1;
			 	$loop = true;
			 	while ($loop) {
			 		if (isset($_POST['pergunta' . $a])) {
			 			$array[$i] = array(
			 				'questao_codigo' => $_POST['questao_codigo' . $a],
			 				'pergunta' => $_POST['pergunta' . $a],
			 				'arquivo' => $_FILES['arquivo' . $a],
			 				'a' => $_POST['a' . $a],
			 				'b' => $_POST['b' . $a],
			 				'c' => $_POST['c' . $a],
			 				'd' => $_POST['d' . $a],
			 				'e' => $_POST['e' . $a],
			 				'a_codigo' => $_POST['a_codigo' . $a],
			 				'b_codigo' => $_POST['b_codigo' . $a],
			 				'c_codigo' => $_POST['c_codigo' . $a],
			 				'd_codigo' => $_POST['d_codigo' . $a],
			 				'e_codigo' => $_POST['e_codigo' . $a],
			 				'correta' => $_POST['correta' . $a]
			 			);
			 			$i++;
			 			$a++;
			 		}else{
			 			$loop = false;
			 		}
			 	}
			}

			$sql = "UPDATE avaliacao SET NOME = '$nome', PESO = $peso, TIPO = $type WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				if ($type == 1) {
					
					for ($i=0; $i < sizeof($array); $i++) { 
						$dados = $array[$i];
						$questao_codigo = $dados['questao_codigo'];
						$pergunta = $dados['pergunta'];
						$correta = $dados['correta'];
						$link = "";
						if ($dados['arquivo']['name'] != "") {
							$dir = "../upload/" . basename($dados['arquivo']['name']);
							$result = move_uploaded_file($dados['arquivo']['tmp_name'], $dir);
							if ($result) {
								$link = $url . "upload/" . basename($dados['arquivo']['name']);
							}else{
								$_SESSION['error'] = "Erro no envio dos arquivos!";
								header('location: ../professor/avaliacoes.php');
							}
						}

						$sql = "UPDATE questoes SET PERGUNTA = '$pergunta', IMAGE = '$link', CORRETA = $correta WHERE CODIGO = $questao_codigo";
						$query = mysqli_query($con, $sql);
						if ($query) {
							$opcao = $dados['a'];
							$opcao_codigo = $dados['a_codigo'];
							$sql = "UPDATE alternativa SET OPCAO = '$opcao' WHERE CODIGO = $opcao_codigo";
							$query = mysqli_query($con, $sql);

							$opcao = $dados['b'];
							$opcao_codigo = $dados['b_codigo'];
							$sql = "UPDATE alternativa SET OPCAO = '$opcao' WHERE CODIGO = $opcao_codigo";
							$query = mysqli_query($con, $sql);

							$opcao = $dados['c'];
							$opcao_codigo = $dados['c_codigo'];
							$sql = "UPDATE alternativa SET OPCAO = '$opcao' WHERE CODIGO = $opcao_codigo";
							$query = mysqli_query($con, $sql);

							$opcao = $dados['d'];
							$opcao_codigo = $dados['d_codigo'];
							$sql = "UPDATE alternativa SET OPCAO = '$opcao' WHERE CODIGO = $opcao_codigo";
							$query = mysqli_query($con, $sql);

							$opcao = $dados['e'];
							$opcao_codigo = $dados['e_codigo'];
							$sql = "UPDATE alternativa SET OPCAO = '$opcao' WHERE CODIGO = $opcao_codigo";
							$query = mysqli_query($con, $sql);

							$a = $dados['a'];
							$b = $dados['b'];
							$c = $dados['c'];
							$d = $dados['d'];
							$e = $dados['e'];
							if ($correta == 1) {
									$sql = "SELECT CODIGO FROM alternativa WHERE questoes_CODIGO = $questao_codigo AND OPCAO = '$a'";
								}else if ($correta == 2) {
									$sql = "SELECT CODIGO FROM alternativa WHERE questoes_CODIGO = $questao_codigo AND OPCAO = '$b'";
								}else  if ($correta == 3) {
									$sql = "SELECT CODIGO FROM alternativa WHERE questoes_CODIGO = $questao_codigo AND OPCAO = '$c'";
								}else  if ($correta == 4) {
									$sql = "SELECT CODIGO FROM alternativa WHERE questoes_CODIGO = $questao_codigo AND OPCAO = '$d'";
								} if ($correta == 5) {
									$sql = "SELECT CODIGO FROM alternativa WHERE questoes_CODIGO = $questao_codigo AND OPCAO = '$e'";
								}
								$query = mysqli_query($con, $sql);
								$row = mysqli_fetch_array($query);
								$correta_codigo = $row['CODIGO'];
								$sql = "UPDATE questoes SET CORRETA = $correta_codigo WHERE CODIGO = $questao_codigo";
								$query = mysqli_query($con, $sql);
								if ($query) {
									$_SESSION['success'] = "Dados atualizados com sucesso!";
									header('location: ../professor/avaliacoes.php');
								}else{
									$_SESSION['error'] = mysqli_error($con);
									header('location: ../professor/avaliacoes.php');
								}
						}else{
							$_SESSION['error'] = mysqli_error($con);
							header('location: ../professor/avaliacoes.php');
						}
					}
				}else{
					$_SESSION['success'] = "Dados atualizados com sucesso!";
					header('location: ../professor/avaliacoes.php');
				}
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../professor/avaliacoes.php');
			}
		}else if ($id == 4) {
			// Atualizar notas
			$codigo = $_POST['codigo'];
			$nota = $_POST['nota'];
			$sql = "UPDATE avaliacao_has_usuario SET NOTA = $nota WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			echo json_encode($query);
		}
	}else{
		$_SESSION['error'] = "Você não tem permissão para acessar o sistema!";
		header('location: ../');
	}
?>