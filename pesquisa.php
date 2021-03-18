<?php
	$page = "Pesquisa";
	include_once('content/header.php');
	include_once('controller/conexao.php');
if (isset($_SESSION['email'])) {
	include_once('content/banner.php');
	$user_code = $_SESSION['codigo'];
	$sql = "UPDATE usuario SET PESQUISA = 1 WHERE CODIGO = $user_code";
	$query = mysqli_query($con, $sql);
?>		
<div class="row">
	<div class="col-12" align="center">
		<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfsbSnZokTgbbt8T5RVM64qlXMzYuK0Yij5e431Cz3QStNYjA/viewform?embedded=true" width="640" height="1591" frameborder="0" marginheight="0" marginwidth="0">Carregando…</iframe>
	</div>
</div>
<?php
echo mysqli_error($con);
}else{
	$page = "404";
	include_once('content/banner.php');
	include_once('content/404.php');
}
	include_once('content/footer.php');
?>