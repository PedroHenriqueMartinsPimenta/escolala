<?php
	include_once('conexao.php');
	session_start();
	$codigo = $_SESSION['escola_codigo'];
	$link = $_GET['link'];
	$sql = "INSERT INTO site (LINK, escola_CODIGO) VALUES ('$link', $codigo)";
	$query = mysqli_query($con, $sql);
	if ($query) {
		$_SESSION['success'] = "Site criado com sucesso!";
		?>
			<script>
				window.location.href = '<?php echo $link?>';
			</script>
		<?php
	}else{
		$_SESSION['error'] = mysqli_error($con);
		header('location: ../admin/dados_pessoais.php');
	}
?>