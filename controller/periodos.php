<?php
	include_once('conexao.php');
	session_start();
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			//Adiciona período
			$nome = $_POST['nome'] . " " . substr($_POST['inicio'], 0, 4);
			$inicio = $_POST['inicio'];
			$fim = $_POST['fim'];
			$media = $_POST['media'];
			$escola_codigo = $_SESSION['escola_codigo'];

			$sql = "INSERT INTO periodo (NOME, INICIO, FIM, MEDIA, escola_CODIGO) VALUES ('$nome', '$inicio', '$fim', $media, $escola_codigo)";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Período cadastrado com sucesso!";
				header('location: ../admin/periodos.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/periodos.php');
			}
		}else if ($id == 2){
			$codigo = $_GET['codigo'];
			$nome = $_POST['nome'];
			$inicio = $_POST['inicio'];
			$fim = $_POST['fim'];
			$media = $_POST['media'];
			$sql = "UPDATE periodo SET NOME = '$nome', INICIO = '$inicio', FIM = '$fim', MEDIA = $media WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Período atualizado com sucesso!";
				header('location: ../admin/periodos.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/periodos.php');
			}
		}
	}else{
		$_SESSION['error'] = "Você não tem permissão para acessar o sistema!";
		header('location: ../');
	}
?>