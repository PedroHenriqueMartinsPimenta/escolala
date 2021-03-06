<?php
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			// Enviar mensagem 
			$assunto = $_POST['assunto'];
			$mensagem = $_POST['mensagem'] . "\n(".$_SESSION['email'].")";
			$result = mail("escolalaconnect@gmail.com", $assunto, $mensagem);
			if ($result) {
				$_SESSION['success'] = "O suporte responderá sua mensagem em breve!";
			}else{
				$_SESSION['error'] = "Erro ao enviar E-mail, tente novamente mais tarde!";

			}
			header('location: ../admin/suporte.php');
		}
	}else{
		$_SESSION['error'] = "Necessário efetuar o login para acessar o sistema!";
		header('location: ../');
	}
?>