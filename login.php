<?php
	$page = "Login";
	include_once('content/header.php');
	include_once('content/banner.php');
?>
	<div class="row" id="login">
		<div class="col-md-12">
			<form action="controller/login.php" method="post">
				<h3>Informe os dados de Login</h3>
				<hr>
				<label>E-mail</label>
				<input type="email" name="email" class="form-control" required placeholder="example@example.com">

				<label>Senha</label>
				<input type="password" name="senha" class="form-control" required placeholder="Senha">

				<a href="minha_senha.php" style="float: right;">Esqueci minha senha!</a>

				<button type="submit" class="btn btn-success col-md-3 mt-2">Entrar</button>
			</form>
		</div>
	</div>		

		
<?php
	include_once('content/footer.php');
?>