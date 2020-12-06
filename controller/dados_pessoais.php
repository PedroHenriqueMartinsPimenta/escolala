<?php
	include_once('conexao.php');
	session_start();
	if(isset($_SESSION['email'])){
		$id = $_GET['id'];
		if ($id == 1) {
			//altera os dados pessoais
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

			$sql = "UPDATE usuario SET NOME = '$nome', SOBRENOME = '$sobrenome', EMAIL = '$email', EMAIL_SECUNDARIO = '$email_secundario', RUA = '$rua', COMPLEMENTO = '$complemento', BAIRRO = '$bairro', CIDADE = '$cidade', ESTADO = '$estado' WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['nome'] = $nome;
				$_SESSION['sobrenome'] = $sobrenome;
				$_SESSION['email'] = $email;
				$_SESSION['email_secundario'] = $email_secundario;
				$_SESSION['rua'] = $rua;
				$_SESSION['complemento'] = $complemento;
				$_SESSION['bairro'] = $bairro;
				$_SESSION['cidade'] = $cidade;
				$_SESSION['estado'] = $estado;

				$_SESSION['success'] = "Dados atualizados com sucesso!";
				if ($_SESSION['permissao'] == 0) {
					header('location: ../aluno/dados_pessoais.php');
				}else if ($_SESSION['permissao'] == 1) {
					header('location: ../professor/dados_pessoais.php');
				}else if ($_SESSION['permissao'] == 2) {
					header('location: ../admin/dados_pessoais.php');
				}			
			}else{
				$_SESSION['error'] = mysqli_error($con);
				if ($_SESSION['permissao'] == 0) {
					header('location: ../aluno/dados_pessoais.php');
				}else if ($_SESSION['permissao'] == 1) {
					header('location: ../professor/dados_pessoais.php');
				}else if ($_SESSION['permissao'] == 2) {
					header('location: ../admin/dados_pessoais.php');
				}
			}
		}else if ($id == 2) {
			//altera a senha
			$senha_antiga = md5($_POST['senha_antiga']);
			$nova_senha = md5($_POST['nova_senha']);
			$confirme_senha = md5($_POST['confirme_senha']);
			$codigo = $_GET['codigo'];


			$sql = "SELECT * FROM usuario WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			if ($nova_senha != $confirme_senha) {
				$_SESSION['error'] = "Senhas incompatíveis!";
				if ($_SESSION['permissao'] == 0) {
					header('location: ../aluno/dados_pessoais.php');
				}else if ($_SESSION['permissao'] == 1) {
					header('location: ../professor/dados_pessoais.php');
				}else if ($_SESSION['permissao'] == 2) {
					header('location: ../admin/dados_pessoais.php');
				}
				
			}else if ($nova_senha == $senha_antiga) {
				$_SESSION['error'] = "A nova senha não pode ser igual a antiga!";
				if ($_SESSION['permissao'] == 0) {
					header('location: ../aluno/dados_pessoais.php');
				}else if ($_SESSION['permissao'] == 1) {
					header('location: ../professor/dados_pessoais.php');
				}else if ($_SESSION['permissao'] == 2) {
					header('location: ../admin/dados_pessoais.php');
				}
			}else if ($senha_antiga != $row['SENHA']) {
				$_SESSION['error'] = "Senha antiga incorreta!";
				if ($_SESSION['permissao'] == 0) {
					header('location: ../aluno/dados_pessoais.php');
				}else if ($_SESSION['permissao'] == 1) {
					header('location: ../professor/dados_pessoais.php');
				}else if ($_SESSION['permissao'] == 2) {
					header('location: ../admin/dados_pessoais.php');
				}
			}else{
				$sql = "UPDATE usuario SET SENHA = '$nova_senha' WHERE CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$_SESSION['success'] = "Senha atualizada com sucesso!";
					if ($_SESSION['permissao'] == 0) {
						header('location: ../aluno/dados_pessoais.php');
					}else if ($_SESSION['permissao'] == 1) {
						header('location: ../professor/dados_pessoais.php');
					}else if ($_SESSION['permissao'] == 2) {
						header('location: ../admin/dados_pessoais.php');
					}
				}else{
					$_SESSION['error'] = mysqli_error($con);
					if ($_SESSION['permissao'] == 0) {
						header('location: ../aluno/dados_pessoais.php');
					}else if ($_SESSION['permissao'] == 1) {
						header('location: ../professor/dados_pessoais.php');
					}else if ($_SESSION['permissao'] == 2) {
						header('location: ../admin/dados_pessoais.php');
					}			
				}
			}

			
		}else if ($id == 3){
			//Editar escola
			$escola_codigo = $_GET['codigo'];
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$telefone = $_POST['telefone'];
			$rua = $_POST['rua'];
			$complemento = $_POST['complemento'];
			$bairro = $_POST['bairro'];
			$cidade = $_POST['cidade'];
			$estado = $_POST['estado'];

			$sql = "UPDATE escola SET NOME = '$nome', EMAIL = '$email', TELEFONE = '$telefone', RUA = '$rua', COMPLEMENTO = '$complemento', BAIRRO = '$bairro', CIDADE = '$cidade', ESTADO = '$estado' WHERE CODIGO = $escola_codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Dados atualizados com sucesso!";
				header('location: ../admin/dados_pessoais.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/dados_pessoais.php');			
			}
		}
	}else{
		$_SESSION['error'] = "Permissão necessaria!";
		header('location: ../');		
	}
?>