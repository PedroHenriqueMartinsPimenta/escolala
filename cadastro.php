<?php
	$page = "Cadastre-se";
	include_once('content/header.php');
	include_once('content/banner.php');

?>
	<div class="row">
		<div class="col-12">
			<div class="alert alert-danger" style="display: none">
				
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<h3>Cadastro:</h3>
			<form action="controller/cadastro.php" method="post" class="ml-md-4">
				<h5><b>Informações escolares:</b></h5>
				<hr>
				<label>Nome da escola <span id="required">*</span></label>
				<input type="text" name="escola" class="form-control" required>

				<label>E-mail escolar <span id="required">*</span></label>
				<input type="email" name="email_escola" class="form-control" required>

				<label>Telefone escolar</label>
				<input type="text" name="tel_escola" class="form-control" onkeydown="fMasc(this, mTel)" maxlength="14">

				<label>Rua da escola <span id="required">*</span></label>
				<input type="text" name="rua_escola" class="form-control" required>

				<label>Complemento</label>
				<input type="text" name="complemento_escola" class="form-control">

				<label>Bairro <span id="required">*</span></label>
				<input type="text" name="bairro_escola" class="form-control" required>

				<label>Cidade <span id="required">*</span></label>
				<input type="text" name="cidade_escola" class="form-control" required>

				<label>Estado <span id="required">*</span></label>
				<input type="text" name="estado_escola" class="form-control" required placeholder="EX.: CE" maxlength="2">

				<br>
				<br>

				<h5><b>Informações de usuario:</b></h5>
				<hr>
				<div class="row">

					<div class="col-md-6">
						<label>Nome: <span id="required">*</span></label>
						<input type="text" name="nome" class="form-control" required>
					</div>


					<div class="col-md-6">
						<label>Sobrenome: <span id="required">*</span></label>
						<input type="text" name="sobrenome" class="form-control" required>
					</div>
					
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<label>E-mail: <span id="required">*</span></label>
						<input type="email" name="email" class="form-control" required="">
					</div>


					<div class="col-md-6">
						<label>E-mail secundário:</label>
						<input type="email" name="email_secundario" class="form-control">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label>Rua: <span id="required">*</span></label>
						<input type="text" name="rua" class="form-control" required>
					</div>

					<div class="col-md-4">
						<label>Complemento:</label>
						<input type="text" name="complemento" class="form-control">
					</div>

					<div class="col-md-4">
						<label>Bairro: <span id="required">*</span></label>
						<input type="text" name="bairro" class="form-control" required>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label>Cidade: <span id="required">*</span></label>
						<input type="text" name="cidade" class="form-control" required>
					</div>

					<div class="col-md-6">
						<label>Estado: <span id="required">*</span></label>
						<input type="text" name="estado" class="form-control" required maxlength="2" placeholder="EX.: CE">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label>Senha: <span id="required">*</span></label>
						<input type="password" name="senha" class="form-control" required id="senha" minlength="6">
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<button type="submit" class="btn btn-success col-md-3 mt-2">Enviar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php
	include_once('content/footer.php');
?>