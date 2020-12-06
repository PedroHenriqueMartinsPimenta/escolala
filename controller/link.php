<?php 
	include_once('conexao.php');
	include_once('../content/config.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		/*types:
		* 1 - add professor
		*
		*/
		if ($id == 1) {
			// Adicionar link
			$type = $_GET['type'];
			$codigo = $_SESSION['codigo'];
			if ($type == 1) {
				$redirect = $url . "admin/add_professor.php?codigo=" . $codigo;
				$sql = "INSERT INTO link (PARA, usuario_CODIGO) VALUES('$redirect', $codigo)";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$_SESSION['success'] = "Link gerado!";
					header('location: ../admin/professores.php');
				}else{
					$_SESSION['error'] = mysqli_error($con);
					header('location: ../admin/professores.php');
				}
			}
		}else if ($id == 2) {
			//Deletar link
			$codigo = $_GET['codigo'];
			$sql = "DELETE FROM link WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Link deletado!";
				header('location: ../admin/professores.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/professores.php');
			}
		}
	}else{
		$_SESSION['error'] = "Você não tem permissão para acessar o sistema!";
		header('location: ../');
	}
?>