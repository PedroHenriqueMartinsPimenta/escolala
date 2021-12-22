<?php
	include_once('conexao.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			// Adicionar administrador
			$nome = $_POST['nome'];
			$sobrenome = $_POST['sobrenome'];
			$email = $_POST['email'];
			$email_secundario = $_POST['email_secundario'];
			$rua = $_POST['rua'];
			$complemento = $_POST['complemento'];
			$bairro = $_POST['bairro'];
			$cidade = $_POST['cidade'];
			$estado = $_POST['estado'];
			$senha = md5($_POST['senha']);
			$escola_codigo = $_GET['escola_codigo'];
			$permissao = 2;
			$sql = "INSERT INTO usuario (NOME, SOBRENOME, EMAIL, EMAIL_SECUNDARIO, RUA, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, SENHA, escola_CODIGO, PERMISSAO) VALUES ('$nome', '$sobrenome', '$email', '$email_secundario', '$rua', '$complemento', '$bairro', '$cidade', '$estado', '$senha', $escola_codigo, $permissao)";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Administrador cadastrado com sucesso!";
				header('location: ../admin/admins.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/admins.php');
			}

		}else if ($id == 2){
			//desativar / ativar
			$codigo = $_GET['codigo'];
			$ativo = $_GET['ativo'];
			$sql = "UPDATE usuario SET ATIVO = $ativo WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				if ($ativo == 1) {
					$_SESSION['success'] = "Administrador ativado com sucesso!";
				}else{
					$_SESSION['success'] = "Administrador desativado com sucesso!";
				}
				header('location: ../admin/admins.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/admins.php');				
			}
		}else if ($id == 3){
			// Editar administrador
			$codigo = $_GET['codigo'];
			$nome = $_POST['nome'];
			$sobrenome = $_POST['sobrenome'];
			$email = $_POST['email'];
			$email_secundario = $_POST['email_secundario'];
			$rua = $_POST['rua'];
			$complemento = $_POST['complemento'];
			$bairro = $_POST['bairro'];
			$cidade = $_POST['cidade'];
			$estado = $_POST['estado'];
			$permissao = $_POST['permissao'];

			$sql = "UPDATE usuario SET NOME = '$nome', SOBRENOME = '$sobrenome', EMAIL = '$email', EMAIL_SECUNDARIO = '$email_secundario', RUA = '$rua', COMPLEMENTO = '$complemento', BAIRRO = '$bairro', CIDADE = '$cidade', ESTADO = '$estado', PERMISSAO = $permissao WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Dados atualizados com sucesso!";
				header('location: ../admin/admins.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/admins.php');
			}

		}else if ($id == 4){
			//Remover Admin 
			$codigo = $_GET['codigo'];
			$email =  substr($_GET['email'], 0, 45) . random_int(0, 9999999);
			$sql = "UPDATE usuario SET EMAIL = '$email', ATIVO = 2 WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Usuário deletado!";
				header('location: ../admin/admins.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/admins.php');
			}
		}
	}else{
		$_SESSION['error'] = "Você não tem permissão para acessar o sistema!";
		header('location: ../');
	}
?>