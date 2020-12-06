<?php
	include_once('conexao.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			//Adiciona aula
			$nome = $_POST['nome'];
			$escola_codigo = $_SESSION['escola_codigo'];
			$sql = "INSERT INTO aula (NOME, escola_CODIGO) VALUES('$nome', $escola_codigo)";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Aula cadastrada com sucesso!";
				header('location: ../admin/aulas.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/aulas.php');
			}
		}else if ($id == 2){
			//remover aula
			$codigo = $_GET['codigo'];
			$sql = "DELETE FROM frequencia WHERE aula_CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$sql = "DELETE FROM horario WHERE aula_CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$sql = "DELETE FROM aula WHERE CODIGO = $codigo";
					$query = mysqli_query($con, $sql);
					if ($query) {
						$_SESSION['success'] = "Aula deletada";
						header('location: ../admin/aulas.php');							
					}else{
						$_SESSION['error'] = mysqli_error($con);
						header('location: ../admin/aulas.php');							
					}
				}else{
					$_SESSION['error'] = mysqli_error($con);
					header('location: ../admin/aulas.php');									
				}
			}else {
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/aulas.php');				
			}
		}else if ($id == 3){
			$codigo = $_GET['codigo'];
			$nome = $_POST['nome'];

			$sql = "UPDATE aula SET NOME = '$nome' WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Dados atualizados com sucesso!";
				header('location: ../admin/aulas.php');				
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/aulas.php');			
			}
		}
	}else{
		$_SESSION['error'] = "Permissão necessaria!";
		header('location: ../');
	}
?>