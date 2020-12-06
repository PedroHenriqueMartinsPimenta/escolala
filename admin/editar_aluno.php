<?php
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$page = "Alunos";
	$escola_codigo = $_SESSION['escola_codigo'];
	$codigo = $_GET['codigo'];
	$sql = "SELECT * FROM usuario WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$row_dados = mysqli_fetch_array($query);
	include_once('../content/banner.php');

?>		
<h3>Editando o aluno: <?php echo $row_dados['NOME']?></h3>
<div class="row"> 
	<div class="col-12"> 
		<form action="../controller/alunos.php?id=3&&codigo=<?php echo $codigo?>" method="post"> 
			<div class="row"> 
				<div class="col-md-6"> 
					<label>Nome: <span id="required">*</span></label>
					<input type="text" name="nome" class="form-control" required value="<?php echo $row_dados['NOME']?>">	
				</div>	

				<div class="col-md-6"> 
					<label>Sobrenome: <span id="required">*</span></label>
					<input type="text" name="sobrenome" class="form-control" required value="<?php echo $row_dados['SOBRENOME']?>">	
				</div>	
			</div>

			<div class="row"> 
				<div class="col-md-6"> 
					<label>E-mail: <span id="required">*</span></label>
					<input type="email" name="email" class="form-control" required value="<?php echo $row_dados['EMAIL']?>">	
				</div>	

				<div class="col-md-6"> 
					<label>E-mail do responsável: </label>
					<input type="email" name="email_secundario" class="form-control" value="<?php echo $row_dados['EMAIL_SECUNDARIO']?>">	
				</div>	
			</div>

			<div class="row"> 
				<div class="col-md-6"> 
					<label>Rua: <span id="required">*</span></label>
					<input type="text" name="rua" class="form-control" required value="<?php echo $row_dados['RUA']?>">	
				</div>	

				<div class="col-md-6"> 
					<label>Complemento </label>
					<input type="text" name="complemento" class="form-control" value="<?php echo $row_dados['COMPLEMENTO']?>">	
				</div>	
			</div>

			<div class="row"> 
				<div class="col-md-6"> 
					<label>Bairro: <span id="required">*</span></label>
					<input type="text" name="bairro" class="form-control" required value="<?php echo $row_dados['BAIRRO']?>">	
				</div>	

				<div class="col-md-4"> 
					<label>Cidade: <span id="required">*</span></label>
					<input type="text" name="cidade" class="form-control" value="<?php echo $row_dados['CIDADE']?>">	
				</div>

				<div class="col-md-2"> 
					<label>Estado: <span id="required">*</span></label>
					<input type="text" name="estado" class="form-control" maxlength="2" value="<?php echo $row_dados['ESTADO']?>">	
				</div>	
			</div>

			<div class="row"> 
				<div class="col-12"> 
					<label>Turma: <span id="required">*</span></label>
					<select name="turma" required class="form-control" id="turma">
						<option>Selecionar turma</option>
						<?php
							$sql = "SELECT turma.CODIGO, turma.NOME FROM turma INNER JOIN usuario_has_turma ON turma.CODIGO = usuario_has_turma.turma_CODIGO INNER JOIN usuario ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO WHERE usuario.escola_CODIGO = $escola_codigo GROUP BY turma.CODIGO ORDER BY turma.NOME ASC";
							$query = mysqli_query($con, $sql);
							while ($row = mysqli_fetch_array($query)) {
								?>
								<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
								<?php
							}
						?>
					</select>
				</div>	
			</div>

			<div class="row"> 
				<div class="col-12">
					<label>Permissão:</label>
					<select name="permissao" class="form-control">
						<option value="0">Aluno</option>
						<option value="1">Professor</option>
						<option value="2">Administrador</option>
					</select>
				</div>
			</div>				
			<input type="submit" value="Atualizar" class="btn btn-success mt-2">
		</form>
	</div>	
</div>
<script>
	<?php
		$sql = "SELECT * FROM usuario_has_turma WHERE usuario_CODIGO = $codigo AND STATUS = 1";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
	?>
	window.onload = function(){
		$('#turma').val(<?php echo $row['turma_CODIGO']?>);
	}
</script>
<?php
}else{
	$page = "404";
	include_once('../content/banner.php');
	include_once('../content/404.php');
}
	include_once('../content/footer.php');
?>