<?php
	include_once('conexao.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			//Adicionar horário
			$dia_semana = $_POST['dia_semana'];
			$aula = $_POST['aula'];
			$materia = $_POST['materia'];

			$sql = "INSERT INTO horario (DIA, aula_CODIGO, materia_CODIGO) VALUES($dia_semana, $aula, $materia)";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Horário cadastrado com sucesso!";
				header('location: ../admin/horarios.php');			
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/horarios.php');
			}
		}else if ($id == 2) {
			//Remover horário
			$codigo = $_GET['codigo'];
			$sql = "DELETE FROM horario WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Horário removido com sucesso!";
				header('location: ../admin/horarios.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/horarios.php');
			}
		}else if ($id == 3) {
			//Editar dados 
			$codigo = $_GET['codigo'];
			$dia = $_POST['dia_semana'];
			$aula = $_POST['aula'];
			$materia = $_POST['materia'];

			$sql = "UPDATE horario SET DIA = $dia, aula_CODIGO = $aula, materia_CODIGO = $materia WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Horário atualizado com sucesso!";
				header('location: ../admin/horarios.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/horarios.php');
			}

		}
	}else{
		$_SESSION['error'] = "Você não tem permissão para acessar o sistema!";
		header('location: ../');
	}
?>