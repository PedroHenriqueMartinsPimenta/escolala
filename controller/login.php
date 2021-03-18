<?php
	include_once('conexao.php');
	session_start();
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);

	$sql = "SELECT usuario.EMAIL, usuario.CODIGO, usuario.NOME, usuario.SOBRENOME, usuario.RUA, usuario.COMPLEMENTO, usuario.BAIRRO, usuario.CIDADE, usuario.ESTADO, usuario.EMAIL_SECUNDARIO, usuario.escola_CODIGO, usuario.PERMISSAO, usuario.SENHA, usuario.ATIVO, usuario.PESQUISA, escola.PRIVILEGIO FROM usuario INNER JOIN escola ON usuario.escola_CODIGO = escola.CODIGO WHERE usuario.EMAIL = '$email' AND usuario.ATIVO = 1";
	$query = mysqli_query($con, $sql);
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);
			if ($senha == $row['SENHA']) {
				$_SESSION['success'] = "Login efetuado com sucesso!";
				/*
				* 0 = Aluno
				* 1 = Professor 
				* 2 = Admin
				*/	
				$_SESSION['email'] = $email;
				$_SESSION['codigo'] = $row['CODIGO'];
				$_SESSION['nome'] = $row['NOME'];
				$_SESSION['sobrenome'] = $row['SOBRENOME'];
				$_SESSION['rua'] = $row['RUA'];
				$_SESSION['complemento'] = $row['COMPLEMENTO'];
				$_SESSION['bairro'] = $row['BAIRRO'];
				$_SESSION['cidade'] = $row['CIDADE'];
				$_SESSION['estado'] = $row['ESTADO'];
				$_SESSION['email_secundario'] = $row['EMAIL_SECUNDARIO'];
				$_SESSION['escola_codigo'] = $row['escola_CODIGO'];

				$_SESSION['permissao'] = $row['PERMISSAO'];
				$_SESSION['privilegio'] = $row['PRIVILEGIO'];
				if($row['PESQUISA'] == 0){
					header('location: ../pesquisa.php');
				}else{
					if ($row['PERMISSAO'] == 0) {
						header('location:../aluno/');
					}else if ($row['PERMISSAO'] == 1) {
						header('location:../professor/');
					}else if ($row['PERMISSAO'] == 2) {
						header('location:../admin/');
					}
				}
			}else{
				$_SESSION['error'] = "Senha incorreta!";
				header('location: ../login.php');			
			}
		}else{
			$_SESSION['error'] = "Login incorreto!";
			header('location: ../login.php');				
		}
	}else{
		$_SESSION['error'] = mysqli_error($con);
		header('location: ../login.php');
	}
?>