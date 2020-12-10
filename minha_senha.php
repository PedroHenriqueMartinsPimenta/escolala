<?php
	include_once('content/header.php');
	$page = "Esqueci minha senha";
	include_once('content/banner.php');
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			?>
			<div class="row">
				<div class="col-12">
					<h3>Informe o codigo</h3>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<form action="controller/minha_senha.php?id=2" method="post">
						<label>Informe seu codigo:</label>
						<input type="number" name="codigo" class="form-control" required>

						<input type="submit" value="Enviar" class="btn btn-success mt-2">	
					</form>
				</div>
			</div>
			<?php
		}else if($id == 2){
			?>
			<div class="row">
				<div class="col-12">
					<h3>Informe a nova senha</h3>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<form action="controller/minha_senha.php?id=3" method="post">
						<label>Informe a nova senha:</label>
						<input type="password" name="senha" class="form-control" required>

						<label>Confirme a nova senha:</label>
						<input type="password" name="c_senha" class="form-control" required>

						<input type="submit" value="Enviar" class="btn btn-success mt-2">	
					</form>
				</div>
			</div>
			<?php
		}else if ($id == 3) {
			session_destroy();
			session_start();
			$_SESSION['success'] = "Senha alterada com sucesso!";
			?>
				<script>
					window.location.href = 'login.php';
				</script>
			<?php
		}
	}else{
		if (isset($_SESSION['code'])) {
			?>
				<script>
					window.location.href = "minha_senha.php?id=1";
				</script>
			<?php
		}
		?>
			<div class="row">
				<div class="col-12">
					<h3>Esqueci minha senha</h3>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<form action="controller/minha_senha.php?id=1" method="post">
						<label>Informe seu E-mail:</label>
						<input type="email" name="email" class="form-control" required>

						<input type="submit" value="Enviar" class="btn btn-success mt-2">	
					</form>
				</div>
			</div>
		<?php
	}
	include_once('content/footer.php');
?>