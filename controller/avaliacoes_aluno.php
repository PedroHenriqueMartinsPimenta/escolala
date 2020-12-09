<?php
	include_once('conexao.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			// Finalizar prova
			$avaliacao = $_POST['avaliacao'];
			$user_codigo = $_SESSION['codigo'];
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
			$nota = ($corretas * 10) / $count;
			$sql = "INSERT INTO avaliacao_has_usuario (avaliacao_CODIGO, usuario_CODIGO, NOTA) VALUES ($avaliacao, $user_codigo, $nota)";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Prova finalizada com sucesso!";
				header('location: ../aluno/prova.php?codigo=' . $avaliacao . '&&comando=2');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../aluno/avaliacoes.php');
			}
		}
	}else{
		$_SESSION['error'] = "Você não tem permissão para acessar o sistema!";
		header('location: ../');
	}
?>