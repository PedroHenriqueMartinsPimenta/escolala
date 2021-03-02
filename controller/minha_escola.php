<?php
	$codigo = $_GET['escola'];
	$email_escola = $_GET['email'];
	$assunto = $_POST['assunto'];
	$email = $_POST['email'];
	$message = $_POST['message'] . "\n(".$email.")";

	mail($email_escola, $assunto, $message);
	header('location: ../minha_escola.php?escola=' . $codigo);
?>