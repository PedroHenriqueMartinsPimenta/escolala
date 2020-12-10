<?php 
	include_once('conexao.php');
	session_start();
	$id = $_GET['id'];
	if ($id == 1) {
		//Gerar codigo
		$email = $_POST['email'];
		$code = random_int(10000, 99999);
		$_SESSION['code'] = $code;
		$_SESSION['email_alter'] = $email;
		$send = mail($email, "Codigo de alteração de senha", "Seu codigo: " . $code);
		if ($send) {
			$_SESSION['success'] = "Informe o codigo enviado para seu E-mail";
			header('location: ../minha_senha.php?id=1');
		}else{
			$_SESSION['error'] = "Erro ao enviar E-mail";
			header('location: ../');
		}
	}else if ($id == 2){
		// Verificar codigo
		$codigo = $_POST['codigo'];
		if ($codigo == $_SESSION['code']) {
			$_SESSION['success'] = "Código correto!";
			header('location: ../minha_senha.php?id=2');
		}else{
			$_SESSION['error'] = "Código incorreto!";
			header('location: ../minha_senha.php?id=1');
		}
	}else if($id == 3) {
		// Alterar Senha
		$email = $_SESSION['email_alter'];
		$senha = md5($_POST['senha']);
		$c_senha = md5($_POST['c_senha']);
		if ($c_senha == $senha) {
			$sql = "UPDATE usuario SET SENHA = '$senha' WHERE EMAIL = '$email'";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Senha alterada!";
				header('location: ../minha_senha.php?id=3');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../minha_senha.php?id=2');
			}
		}else{
			$_SESSION['error'] = "Senhas incompatíveis!";
			header('location: ../minha_senha.php?id=2');
		}
	}
?>