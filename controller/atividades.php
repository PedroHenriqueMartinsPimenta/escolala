<?php
	include_once('conexao.php');
	include_once('../content/config.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			// Adicionar atividade
			$fim = $_POST['fim'];
			$inicio = date('Y-m-d h:i:s');
			$arquivo = $_FILES['arquivo'];
			$turma = $_POST['turma'];
			$momento = date('Y_m_d_h_i_s');
			$pasta = mkdir('../upload/' . $momento, 0777, true);
			$dir = "../upload/" . $momento . "/" . basename($arquivo['name']);
			$upload = move_uploaded_file($arquivo['tmp_name'] , $dir);
			if ($upload) {
				$src = $url . "upload/" . $momento . "/" . basename($arquivo['name']);
				$user_codigo = $_SESSION['codigo'];
				$sql = "INSERT INTO atividade (SRC, INICIO, FIM, usuario_CODIGO, turma_CODIGO) VALUES('$src', '$inicio', '$fim', $user_codigo, $turma)";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$_SESSION['success'] = "Atividade inserida!";
					header('location: ../professor/atividades.php');
				}else{
					$_SESSION['error'] = mysqli_error($con);
					header('location: ../professor/atividades.php');
				}
			}else{
				$_SESSION['error'] = "Error ao enviar arquivo!";
				header('location: ../professor/atividades.php');
			}
		}else if ($id == 2){
			$codigo = $_GET['codigo'];
			$sql = "DELETE FROM atividade WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Atividade deletada com sucesso!";
				header('location: ../professor/atividades.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../professor/atividades.php');
			}
		}else if ($id == 3) {
			// Atualizar dados
			$codigo = $_GET['codigo'];
			$fim = $_POST['fim'];
			$arquivo = $_FILES['arquivo'];
			$turma = $_POST['turma'];
			$name = $arquivo['name'];
			if ($name != "") {
				$momento = date('Y_m_d_h_i_s');
				$pasta = mkdir('../upload/' . $momento, 0777, true);
				$dir = "../upload/" . $momento . "/" . basename($arquivo['name']);
				$upload = move_uploaded_file($arquivo['tmp_name'] , $dir);
				if ($upload) {
					$link = $url . "upload/" . $momento . "/" . basename($arquivo['name']);
					$sql = "UPDATE atividade SET FIM = '$fim', SRC = '$link', turma_CODIGO = $turma WHERE CODIGO = $codigo";
					$query = mysqli_query($con, $sql);
					if ($query) {
						$_SESSION['success'] = "Dados atualizados com sucesso!";
						header('location: ../professor/atividades.php');
					}else{
						$_SESSION['error'] = mysqli_error($con);
						header('location: ../professor/atividades.php');
					}
				}else{
					$_SESSION['error'] = "Erro ao fazer o envio do arquivo";
					header('location: ../professor/atividades.php');
				}
			}else {
				$sql = "UPDATE atividade SET FIM = '$fim', turma_CODIGO = $turma WHERE CODIGO = $codigo";
					$query = mysqli_query($con, $sql);
					if ($query) {
						$_SESSION['success'] = "Dados atualizados com sucesso!";
						header('location: ../professor/atividades.php');
					}else{
						$_SESSION['error'] = mysqli_error($con);
						header('location: ../professor/atividades.php');
					}
			}
		}
	}else{
		$_SESSION['error'] = "Você não tem permissão de acessar o sistema!";
		header('location: ../');
	}
?>