<?php
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 1) {
	$page = "Dados Pessoais";
	include_once('../content/banner.php');

?>
	<h3>Dados Pessoais</h3>
	<div class="row">
		<div class="col-md-6 card">
			<form action="../controller/dados_pessoais.php?id=1&&codigo=<?php echo $_SESSION['codigo']?>" method="post" class="card-body">
				<div class="row">
					<div class="col-md-6">
						<label>Nome:</label>
						<input type="text" name="nome" class="form-control" value="<?php echo $_SESSION['nome']?>">
					</div>

					<div class="col-md-6">
						<label>Sobrenome:</label>
						<input type="text" name="sobrenome" class="form-control" value="<?php echo $_SESSION['sobrenome']?>">
					</div>
				</div>


				<div class="row">
					<div class="col-md-6">
						<label>E-mail:</label>
						<input type="email" name="email" class="form-control" value="<?php echo $_SESSION['email']?>">
					</div>

					<div class="col-md-6">
						<label>E-mail secundário:</label>
						<input type="email" name="email_secundario" class="form-control" value="<?php echo $_SESSION['email_secundario']?>">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label>Rua:</label>
						<input type="text" name="rua" class="form-control" value="<?php echo $_SESSION['rua']?>">
					</div>

					<div class="col-md-6">
						<label>Complemento:</label>
						<input type="text" name="complemento" class="form-control" value="<?php echo $_SESSION['complemento']?>">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label>Bairro:</label>
						<input type="text" name="bairro" class="form-control" value="<?php echo $_SESSION['bairro']?>">
					</div>
				</div>

				<div class="row">
					<div class="col-md-9">
						<label>Cidade:</label>
						<input type="text" name="cidade" class="form-control" value="<?php echo $_SESSION['cidade']?>">
					</div>

					<div class="col-md-3">
						<label>Estado:</label>
						<input type="text" maxlength="2" name="estado" class="form-control" value="<?php echo $_SESSION['estado']?>" >
					</div>
				</div>
				<input type="submit" class="btn btn-success col-md-3 mt-3" value="Atualizar">
			</form>
		</div>

		<div class="col-md-5 card ml-md-2">
				<h3>Alterar a senha</h3>
				<form action="../controller/dados_pessoais.php?id=2&&codigo=<?php echo $_SESSION['codigo']?>" method="post" class="card-body ml-md-1">
					<label>Senha antiga</label>
					<input type="password" name="senha_antiga" class="form-control" required>

					<label>Nova senha</label>
					<input type="password" name="nova_senha" class="form-control" required>

					<label>Confirme a senha</label>
					<input type="password" name="confirme_senha" class="form-control" required>

					<input type="submit" value="Atualizar" class="btn btn-success mt-3 col-md-3">
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