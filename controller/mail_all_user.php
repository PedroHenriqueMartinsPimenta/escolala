<?php
	include_once('conexao.php');
	if (isset($_GET['message'])) {
		$message = $_GET['message'];
		$sql = "SELECT * FROM usuario";
		$query = mysqli_query($con, $sql);
		while ($row = mysqli_fetch_array($query)) {
			mail($row['EMAIL'], "Aqui é a Escolalá :)", $message);
		}
	}
?>