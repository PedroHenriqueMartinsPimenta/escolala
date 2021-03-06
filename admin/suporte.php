<?php
	$page = "Suporte";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$escola_codigo = $_SESSION['escola_codigo'];
	$user_codigo = $_SESSION['codigo'];
	include_once('../content/banner.php');

?>		
<h3>Suporte</h3>
<div class="row">
	<div class="col-12">
		<form action="../controller/suporte.php?id=1" method="post">
			<label>Assunto <span id="required">*</span></label>
			<input type="text" name="assunto" class="form-control" required="">

			<label>Messagem <span id="required">*</span></label>
			<textarea name="mensagem" class="form-control" required style="min-height: 200px"></textarea>

			<input type="submit" value="Enviar" class="btn btn-success">
		</form>
	</div>
</div>
<?php
}else{
	$page = "404";
	include_once('../content/banner.php');
	include_once('../content/404.php');
}
	include_once('../content/footer.php');
?>