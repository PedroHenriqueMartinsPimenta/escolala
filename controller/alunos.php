<?php
	include_once('conexao.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			//Adicionar aluno
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
			$turma = $_POST['turma'];
			$escola_codigo = $_SESSION['escola_codigo'];
			$sql = "INSERT INTO usuario (NOME, SOBRENOME, EMAIL, EMAIL_SECUNDARIO, RUA, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, SENHA, escola_CODIGO) VALUES ('$nome', '$sobrenome', '$email', '$email_secundario', '$rua', '$complemento', '$bairro', '$cidade', '$estado', '$senha', $escola_codigo)";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$sql = "SELECT * FROM usuario WHERE EMAIL = '$email'";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$row = mysqli_fetch_array($query);
					$user_codigo = $row['CODIGO'];
					$sql = "INSERT INTO usuario_has_turma (usuario_CODIGO, turma_CODIGO) VALUES($user_codigo, $turma)";
					$query = mysqli_query($con, $sql);
					if ($query) {
						$_SESSION['success'] = "Aluno cadastrado com sucesso!";
						header('location: ../admin/alunos.php');
					}else{
						$_SESSION['error'] = mysqli_error($con);
						header('location: ../admin/alunos.php');						
					}
				}else{
					$_SESSION['error'] = mysqli_error($con);
					header('location: ../admin/alunos.php');					
				}
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/alunos.php');
			}
		}else if ($id == 2){
			//Ativar / desativar aluno
			$codigo = $_GET['codigo'];
			$ativo = $_GET['ativo'];
			$sql = "UPDATE usuario SET ATIVO = $ativo WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				if ($ativo == 1) {
					$_SESSION['success'] = "Aluno ativado com sucesso!";
				}else{
					$_SESSION['success'] = "Aluno desativado com sucesso!";
				}
				header('location: ../admin/alunos.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/alunos.php');
			}
		}else if ($id == 3){
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
			$turma = $_POST['turma'];
			$permissao = $_POST['permissao'];
			$sql = "UPDATE usuario SET NOME = '$nome', SOBRENOME = '$sobrenome', EMAIL = '$email', EMAIL_SECUNDARIO = '$email_secundario', RUA = '$rua', COMPLEMENTO = '$complemento', BAIRRO = '$bairro', CIDADE = '$cidade', ESTADO = '$estado', PERMISSAO = $permissao WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$sql = "UPDATE usuario_has_turma SET turma_CODIGO = $turma WHERE usuario_CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$_SESSION['success'] = "Dados atualizados com sucesso!";
					header('location: ../admin/alunos.php');
				}else{
					$_SESSION['error'] = mysqli_error($con);
					header('location: ../admin/alunos.php');					
				}
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/alunos.php');				
			}
		}else if ($id == 4){
			//Transitar para outra turma turma 
			$codigo = $_GET['codigo'];
			$status = $_POST['status'];
			$turma = $_POST['turma'];
			$turma_codigo = $_GET['turma'];

			$sql = "UPDATE usuario_has_turma SET STATUS = $status WHERE usuario_CODIGO = $codigo AND turma_CODIGO = $turma_codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$sql = "INSERT INTO usuario_has_turma (usuario_CODIGO, turma_CODIGO) VALUES($codigo, $turma)";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$_SESSION['success'] = "Transição ocorrida com sucesso!";
					header('location: ../admin/alunos.php');	
				}else{
					$_SESSION['error'] = mysqli_error($con);
					header('location: ../admin/alunos.php');						
				}
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/alunos.php');					
			}
		}else if($id == 5){
			// Matricula pelo link
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
			$turma = $_POST['turma'];
			$escola_codigo = base64_decode($_GET['escola_codigo']);
			$sql = "INSERT INTO usuario (NOME, SOBRENOME, EMAIL, EMAIL_SECUNDARIO, RUA, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, SENHA, escola_CODIGO) VALUES ('$nome', '$sobrenome', '$email', '$email_secundario', '$rua', '$complemento', '$bairro', '$cidade', '$estado', '$senha', $escola_codigo)";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$sql = "SELECT * FROM usuario WHERE EMAIL = '$email'";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$row = mysqli_fetch_array($query);
					$user_codigo = $row['CODIGO'];
					$sql = "INSERT INTO usuario_has_turma (usuario_CODIGO, turma_CODIGO) VALUES($user_codigo, $turma)";
					$query = mysqli_query($con, $sql);
					if ($query) {
						$_SESSION['success'] = "Aluno cadastrado com sucesso!";
						header('location: ../login.php');
					}else{
						$_SESSION['error'] = mysqli_error($con);
						header('location: ../login.php');						
					}
				}else{
					$_SESSION['error'] = mysqli_error($con);
					header('location: ../login.php');					
				}
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../login.php');
			}
		}else if ($id == 6){
			//Remover aluno 
			$codigo = $_GET['codigo'];
			$email =  substr($_GET['email'], 0, 45) . random_int(0, 9999999);
			$sql = "UPDATE usuario SET EMAIL = '$email', ATIVO = 2 WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Usuário deletado!";
				header('location: ../admin/alunos.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/alunos.php');
			}
		}
	}else{
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			if ($id == 5) {
				// Matricula pelo link
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
			$turma = $_POST['turma'];
			$escola_codigo = $_GET['escola_codigo'];
			$sql = "INSERT INTO usuario (NOME, SOBRENOME, EMAIL, EMAIL_SECUNDARIO, RUA, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, SENHA, escola_CODIGO) VALUES ('$nome', '$sobrenome', '$email', '$email_secundario', '$rua', '$complemento', '$bairro', '$cidade', '$estado', '$senha', $escola_codigo)";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$sql = "SELECT * FROM usuario WHERE EMAIL = '$email'";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$row = mysqli_fetch_array($query);
					$user_codigo = $row['CODIGO'];
					$sql = "INSERT INTO usuario_has_turma (usuario_CODIGO, turma_CODIGO) VALUES($user_codigo, $turma)";
					$query = mysqli_query($con, $sql);
					if ($query) {
						$_SESSION['success'] = "Aluno cadastrado com sucesso!";
						header('location: ../login.php');
					}else{
						$_SESSION['error'] = mysqli_error($con);
						header('location: ../login.php');						
					}
				}else{
					$_SESSION['error'] = mysqli_error($con);
					header('location: ../login.php');					
				}
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../login.php');
			}
			}
		}else{
			$_SESSION['error'] = "Você não tem permissão para acessar o sistema!";
			header('location:../');
		}
	}
?>