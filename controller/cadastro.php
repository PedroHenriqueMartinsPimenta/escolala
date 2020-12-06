<?php
	include_once('conexao.php');
	session_start();
	//dados da escola
	$nome_escola = $_POST['escola'];
	$email_escola = $_POST['email_escola'];
	$telefone_escola = $_POST['tel_escola'];
	$rua_escola = $_POST['rua_escola'];
	$complemento_escola = $_POST['complemento_escola'];
	$bairro_escola = $_POST['bairro_escola'];
	$cidade_escola = $_POST['cidade_escola'];
	$estado_escola = $_POST['estado_escola'];

	//dados do usuário
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$rua = $_POST['rua'];
	$complemento = $_POST['complemento'];
	$bairro = $_POST['bairro'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];
	$email = $_POST['email'];
	$email_secundario = $_POST['email_secundario'];
	$senha = md5($_POST['senha']);

	$data = date('Y-m-d');

	$sql = "INSERT INTO escola (NOME, RUA, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, TELEFONE, EMAIL, PRIVILEGIO, DATA) VALUES ('$nome_escola', '$rua_escola', '$complemento_escola', '$bairro_escola', '$cidade_escola', '$estado_escola', '$telefone_escola', '$email_escola', 1, '$data')";

	$query = mysqli_query($con, $sql);

	if ($query) {
		$sql = "SELECT * FROM escola WHERE EMAIL = '$email_escola'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$codigo = $row['CODIGO'];
		$sql = "INSERT INTO usuario (NOME, SOBRENOME, RUA, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, EMAIL, PERMISSAO, SENHA, EMAIL_SECUNDARIO, escola_CODIGO) VALUES('$nome', '$sobrenome', '$rua', '$complemento', '$bairro', '$cidade', '$estado', '$email', 2, '$senha', '$email_secundario', $codigo)";
		$query = mysqli_query($con, $sql);
		if ($query) {
			$_SESSION['success'] = "Cadastro realizado com sucesso, efetue o login para prosseguir!";
			header('location:../login.php');
		}else{
			echo mysqli_error($con);
			$sql = "DELETE FROM escola WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['error'] = "Error ao inserir usuário, tente novamente mais tarde!";
				echo $codigo;
				header('location:../cadastro.php');
			}else{
				$_SESSION['error'] = "Error ao inserir usuário, tente novamente mais tarde! ultilize outro E-mail válido para escola!";
				header('location:../cadastro.php');				
			}
		}
	}else{
		$_SESSION['error'] = mysqli_error($con);
		header('location:../cadastro.php');
	}

?>