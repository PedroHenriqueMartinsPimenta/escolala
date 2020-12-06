<?php
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$page = "Administradores";
	$escola_codigo = $_SESSION['escola_codigo'];
	$codigo = $_GET['codigo'];
	$sql = "SELECT * FROM usuario WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	include_once('../content/banner.php');
?>	

<h3>Editando o administrador <?php echo $row['NOME']?></h3>
<div class="row"> 
	<div class="col-12"> 
		<form action="../controller/admins.php?id=3&&codigo=<?php echo $codigo?>" method="post"> 
			<div class="row"> 
				<div class="col-md-6"> 
					<label>Nome: <span id="required">*</span></label>
					<input type="text" name="nome" class="form-control" required value="<?php echo $row['NOME']?>">	
				</div>	

				<div class="col-md-6"> 
					<label>Sobrenome: <span id="required">*</span></label>
					<input type="text" name="sobrenome" class="form-control" required value="<?php echo $row['SOBRENOME']?>">	
				</div>	
			</div>

			<div class="row"> 
				<div class="col-md-6"> 
					<label>E-mail: <span id="required">*</span></label>
					<input type="email" name="email" class="form-control" required value="<?php echo $row['EMAIL']?>">	
				</div>	

				<div class="col-md-6"> 
					<label>E-mail secundário: </label>
					<input type="email" name="email_secundario" class="form-control" value="<?php echo $row['EMAIL_SECUNDARIO']?>">	
				</div>	
			</div>

			<div class="row"> 
				<div class="col-md-6"> 
					<label>Rua: <span id="required">*</span></label>
					<input type="text" name="rua" class="form-control" required value="<?php echo $row['RUA']?>">	
				</div>	

				<div class="col-md-6"> 
					<label>Complemento </label>
					<input type="text" name="complemento" class="form-control" value="<?php echo $row['COMPLEMENTO']?>">	
				</div>	
			</div>

			<div class="row"> 
				<div class="col-md-6"> 
					<label>Bairro: <span id="required">*</span></label>
					<input type="text" name="bairro" class="form-control" required value="<?php echo $row['BAIRRO']?>">	
				</div>	

				<div class="col-md-4"> 
					<label>Cidade: <span id="required">*</span></label>
					<input type="text" name="cidade" class="form-control" value="<?php echo $row['CIDADE']?>">	
				</div>

				<div class="col-md-2"> 
					<label>Estado: <span id="required">*</span></label>
					<input type="text" name="estado" class="form-control" maxlength="2" value="<?php echo $row['ESTADO']?>">	
				</div>	
			</div>

			<div class="row"> 
				<div class="col-md-12"> 
					<label>Permissao: <span id="required">*</span></label>
					<select name="permissao" id="permissao" class="form-control">
						<option value="2">Administrador</option>
						<option value="0">Aluno</option>
						<option value="1">Professor</option>
					</select>	
				</div>	
			</div>

			<input type="submit" value="Atualizar" class="btn btn-success mt-2">	
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