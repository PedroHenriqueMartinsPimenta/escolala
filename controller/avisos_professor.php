<?php
	include_once('conexao.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			//adicionar aviso
			$mensagem = $_POST['mensagem'];
			$type = $_POST['type'];
			$destinatario = $_POST['destinatario'];
			$codigo = $_SESSION['codigo'];
			if (isset($_POST['email'])) {
				$email = 1;
			}else{
				$email = 0;
			}
			$escola_codigo = $_SESSION['escola_codigo'];
			$data = date('Y-m-d H:i:s');

			$sql = "INSERT INTO aviso (MESSAGE, TYPE, EMAIL, DATA, usuario_CODIGO) VALUES ('$mensagem', $type, $email, '$data', $codigo)";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$sql = "SELECT CODIGO FROM aviso WHERE MESSAGE = '$mensagem' AND DATA = '$data'";
				$query = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($query);
				$aviso_codigo = $row['CODIGO'];
				if ($destinatario == 0) {
					$sql = "SELECT usuario.CODIGO, usuario.EMAIL, usuario.EMAIL_SECUNDARIO FROM usuario WHERE escola_CODIGO = $escola_codigo";
				}else if($destinatario == 1){
					$sql = "SELECT usuario.CODIGO, usuario.EMAIL, usuario.EMAIL_SECUNDARIO FROM usuario WHERE escola_CODIGO = $escola_codigo AND PERMISSAO = 2";
				}else if($destinatario == 2){
					$sql = "SELECT usuario.CODIGO, usuario.EMAIL, usuario.EMAIL_SECUNDARIO FROM usuario WHERE escola_CODIGO = $escola_codigo AND PERMISSAO = 1";
				}else if($destinatario == 3){
					$sql = "SELECT usuario.CODIGO, usuario.EMAIL, usuario.EMAIL_SECUNDARIO FROM usuario WHERE escola_CODIGO = $escola_codigo AND (PERMISSAO = 1 OR PERMISSAO = 2)";
				}else if($destinatario == 4){
					$sql = "SELECT usuario.CODIGO, usuario.EMAIL, usuario.EMAIL_SECUNDARIO FROM usuario WHERE escola_CODIGO = $escola_codigo AND PERMISSAO = 0";
				}else if($destinatario == 5){
					$aluno_codigo = $_POST['aluno_select'];
					$sql = "SELECT usuario.CODIGO, usuario.EMAIL, usuario.EMAIL_SECUNDARIO FROM usuario WHERE escola_CODIGO = $escola_codigo AND CODIGO = $aluno_codigo";
				}else if($destinatario == 6){
					$turma_codigo = $_POST['turma_select'];
					$sql = "SELECT usuario.CODIGO, usuario.EMAIL, usuario.EMAIL_SECUNDARIO FROM usuario INNER JOIN usuario_has_turma ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO INNER JOIN turma ON turma.CODIGO = usuario_has_turma.turma_CODIGO WHERE usuario.escola_CODIGO = $escola_codigo AND turma.CODIGO = $turma_codigo AND usuario_has_turma.STATUS = 1 AND (usuario.PERMISSAO = 0 OR usuario.PERMISSAO = 1)";
				}
				$query = mysqli_query($con, $sql);
				while ($row = mysqli_fetch_array($query)) {
					$user_codigo = $row['CODIGO'];
					$sql = "INSERT INTO aviso_has_usuario (aviso_CODIGO, usuario_CODIGO) VALUES($aviso_codigo, $user_codigo)";
					$query_usuario_has_aviso = mysqli_query($con, $sql);
					if ($email) {
						if($type == 0){
							$assunto = "Você tem um novo aviso!";
						}else if ($type == 1) {
							$assunto = "Você tem uma nova advertencia!";
						}else if ($type == 2) {
							$assunto = "Você tem um novo aviso de urgencia!";
						}
						mail($row['EMAIL'], $assunto, $mensagem);
						mail($row['EMAIL_SECUNDARIO'], $assunto, $mensagem);
					}
					if (!$query_usuario_has_aviso) {
						if (isset($_SESSION['error'])) {
							$_SESSION['error'] .= mysqli_error($con) . "<br>";
						}else{
							$_SESSION['error'] = mysqli_error($con) . "<br>";
						}
					}
				}
				if (!isset($_SESSION['error'])) {
					$_SESSION['success'] = "Aviso cadastrado com sucesso!";
				}
				header('location: ../professor/avisos.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../professor/avisos.php');
			}
		}else if ($id == 2){
			$codigo = $_GET['codigo'];
			$sql = "DELETE FROM aviso_has_usuario WHERE aviso_CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$sql = "DELETE FROM aviso WHERE CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$_SESSION['success'] = "Aviso deletado com sucesso!";
					header('location: ../professor/avisos.php');
				}else{
					$_SESSION['error'] = mysqli_error($con);
					header('location: ../professor/avisos.php');
				}
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../professor/avisos.php');
			}
		}else if ($id == 3){
			//JSON result destinatarios
			$codigo = $_POST['codigo'];
			$sql = "SELECT * FROM usuario INNER JOIN aviso_has_usuario ON usuario.CODIGO = aviso_has_usuario.usuario_CODIGO WHERE aviso_has_usuario.aviso_CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$array = array();
				$i = 0;
				while ($row = mysqli_fetch_array($query)) {
					$array[$i] = $row;
					$i++;
				}
				echo json_encode($array);
			}else {
				echo json_encode("Error");
			}
		}
	}else{
		$_SESSION['error'] = "Você não tem permissão para acessar o sistema!";
		header('location: ../');
	}
?>