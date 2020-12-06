<?php
	include_once('conexao.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			// registrar frequência
			$aluno = $_POST['aluno'];
			$periodo = $_POST['periodo'];
			$aula = $_POST['aula'];
			$data = $_POST['data'];
			$presente = $_POST['presente'];
			if ($presente == 1) {
				$sql = "INSERT INTO frequencia (DATA, usuario_CODIGO, periodo_CODIGO, aula_CODIGO) VALUES ('$data', $aluno, $periodo, $aula)";
			}else {
				$sql = "SELECT * FROM frequencia WHERE usuario_CODIGO = $aluno AND DATA = '$data' AND aula_CODIGO = $aula AND periodo_CODIGO = $periodo LIMIT 1";
				$query = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($query);
				$codigo = $row['CODIGO'];
				$sql = "DELETE FROM frequencia WHERE CODIGO = $codigo";

			}

			$query = mysqli_query($con, $sql);
			echo json_encode($query);
		}
	}else{
		$_SESSION['error'] = "Você não tem permissão para acessar o sistema!";
	}
?>