<?php
	include_once('conexao.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			// Finalizar prova
			$avaliacao = $_POST['avaliacao'];
			$sql = "SELECT * FROM questoes WHERE avaliacao_CODIGO = $avaliacao";
			$query = mysqli_query($con, $sql);
			$corretas = 0;
			$count = 0;
			while ($row = mysqli_fetch_array($query)) {
				$count++;
				$respota = $_POST[$row['CODIGO']];
				if ($respota == $row['CORRETA']) {
					$corretas++;
				}
			}
			echo $corretas . " = " . $count;
		}
	}else{
		$_SESSION['error'] = "Você não tem permissão para acessar o sistema!";
		header('location: ../');
	}
?>