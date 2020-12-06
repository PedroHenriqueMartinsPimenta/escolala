<?php
	include_once('conexao.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			//Adicionar matéria
			$nome = $_POST['nome'];
			$professor = $_POST['professor'];
			$turma = $_POST['turma'];

			$sql = "INSERT INTO materia (NOME, usuario_CODIGO, turma_CODIGO) VALUES('$nome', $professor, $turma)";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Matéria cadastrada com sucesso!";
				header('location: ../admin/materias.php');				
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/materias.php');
			}
		}else if ($id == 2){
			//Deletar matéria
			$codigo = $_GET['codigo'];
			$sql = "SELECT materia.CODIGO AS MATERIA, avaliacao.CODIGO AS AVALIACAO, questoes.CODIGO AS QUESTOES FROM materia INNER JOIN avaliacao ON avaliacao.materia_CODIGO = materia.CODIGO INNER JOIN questoes ON questoes.avaliacao_CODIGO = avaliacao.CODIGO WHERE materia.CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				if (mysqli_num_rows($query) > 0) {
				while ($row = mysqli_fetch_array($query)) {
					$codigo_questao = $row['QUESTOES'];
					$sql = "DELETE FROM alternativas WHERE questoes_CODIGO = $codigo_questao";
					$query1 = mysqli_query($con, $sql);
					if ($query1) {
						$sql = "DELETE FROM questoes WHERE CODIGO = $codigo_questao";
						$query1 = mysqli_query($con, $sql);
						if ($query1) {
							$codigo_avaliacao = $row['AVALIACAO'];
							$sql = "DELETE FROM avaliacao WHERE CODIGO = $codigo_avaliacao";
							$query1 = mysqli_query($con, $sql);
							if ($query1) {
								$sql = "DELETE FROM horario WHERE materia_CODIGO = $codigo";
								$query1 = mysqli_query($con, $sql);
								if ($query1) {
									$sql = "DELETE FROM materia WHERE CODIGO = $codigo";
									$query1 = mysqli_query($con, $sql);
									if ($query1) {
										$_SESSION['success'] = "Materia removida com sucesso!";
										header('location:../admin/materias.php');
									}else{
										$_SESSION['error'] = mysqli_error($con);
										header('location:../admin/materias.php');
									}
								}else{
									$_SESSION['error'] = mysqli_error($con);
									header('location:../admin/materias.php');									
								}
							}else{
								$_SESSION['error'] = mysqli_error($con);
								header('location:../admin/materias.php');								
							}
						}else{
							$_SESSION['error'] = mysqli_error($con);
							header('location:../admin/materias.php');							
						}
					}else{
						$_SESSION['error'] = mysqli_error($con);
						header('location:../admin/materias.php');						
					}
				}
			}else{
				$sql = "DELETE FROM horario WHERE materia_CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$sql = "DELETE FROM materia WHERE CODIGO = $codigo";
					$query = mysqli_query($con, $sql);
					if ($query) {
						$_SESSION['success'] = "Matéria removida com sucesso!";
						header('location:../admin/materias.php');
					}else{
						$_SESSION['error'] = mysqli_error($con);
						header('location:../admin/materias.php');						
					}
				}else{
					$_SESSION['error'] = mysqli_error($con);
					header('location:../admin/materias.php');						
				}
			}
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location:../admin/materias.php');
			}
		}else if($id == 3){
			//atualizar dados
			$codigo = $_GET['codigo'];
			$nome = $_POST['nome'];
			$professor = $_POST['professor'];
			$turma = $_POST['turma'];

			$sql = "UPDATE materia SET NOME = '$nome', usuario_CODIGO = '$professor', turma_CODIGO = '$turma' WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if($query){
				$_SESSION['success'] = "Dados atualizados com sucesso!";
				header('location:../admin/materias.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location:../admin/materias.php');				
			}
		}
	}else{
		$_SESSION['error'] = "Permissão necessaria";
		header('location: ../');
	}
?>