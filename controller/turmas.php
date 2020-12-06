<?php
	include_once('conexao.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			//Adiciona turma
			$nome = $_POST['nome'];
			$limite = $_POST['limite'];
			$momento = date('Y-m-d H:i:s');

			$sql = "INSERT INTO turma (NOME, LIMITE, MOMENTO) VALUES ('$nome', $limite, '$momento')";
			$query = mysqli_query($con, $sql);

			if ($query) {
				$user_codigo = $_SESSION['codigo'];
				$sql = "SELECT CODIGO FROM turma WHERE NOME = '$nome' AND LIMITE = '$limite' AND MOMENTO = '$momento'";
				$query = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($query);
				$turma_codigo = $row['CODIGO'];
				$sql = "INSERT INTO usuario_has_turma (usuario_CODIGO, turma_CODIGO) VALUES($user_codigo, $turma_codigo)";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$_SESSION['success'] = "Turma cadastrada com sucesso!";
					header('location: ../admin/turmas.php');
				}else{
					$_SESSION['error'] = mysqli_error($con);
					header('location: ../admin/turmas.php');				
				}
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/turmas.php');
			}
		}else if($id == 2){
			//remover turma
			$codigo = $_GET['codigo'];
			$sql = "DELETE FROM usuario_has_turma WHERE turma_CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$sql = "DELETE FROM materia WHERE turma_CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$sql = "DELETE FROM turma WHERE CODIGO = $codigo";
					$query = mysqli_query($con, $sql);
					if ($query) {
						$_SESSION['success'] = "Turma removida com sucesso!";
						header('location: ../admin/turmas.php');
					}else{
						$_SESSION['error'] = mysqli_error($con);
						header('location: ../admin/turmas.php');
					}
				}else {
					$_SESSION['error'] = mysqli_error($con);
					header('location: ../admin/turmas.php');				
				}
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/turmas.php');			
			}
		}else if($id == 3){
			//editar turma
			$codigo = $_GET['codigo'];
			$nome = $_POST['nome'];
			$limite = $_POST['limite'];
			$sql = "UPDATE turma SET NOME = '$nome', LIMITE = '$limite' WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Dados atualizados com sucesso!";
				header('location: ../admin/turmas.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/turmas.php');			
			}
		}
	}else{
		$_SESSION['error'] = "Permissão necessaria!";
		header('location: ../');
	}
?>