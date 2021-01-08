<?php
	$page = "Matricule-se";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
	$codigo = $_GET['codigo'];
	$sql = "SELECT * FROM usuario WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	$escola_codigo = $row['escola_CODIGO'];
	include_once('../content/banner.php');
?>	

<h3>Matricule-se</h3>
<div class="row"> 
	<div class="col-12"> 
		<form action="../controller/alunos.php?id=5&&escola_codigo=<?php echo $row['escola_CODIGO']?>" method="post"> 
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
					<input type="email" name="email" class="form-control" required>	
				</div>	

				<div class="col-md-6"> 
					<label>E-mail secundário: </label>
					<input type="email" name="email_secundario" class="form-control">	
				</div>	
			</div>

			<div class="row"> 
				<div class="col-md-6"> 
					<label>Rua: <span id="required">*</span></label>
					<input type="text" name="rua" class="form-control" required>	
				</div>	

				<div class="col-md-6"> 
					<label>Complemento </label>
					<input type="text" name="complemento" class="form-control">	
				</div>	
			</div>

			<div class="row"> 
				<div class="col-md-6"> 
					<label>Bairro: <span id="required">*</span></label>
					<input type="text" name="bairro" class="form-control" required>	
				</div>	

				<div class="col-md-4"> 
					<label>Cidade: <span id="required">*</span></label>
					<input type="text" name="cidade" class="form-control">	
				</div>

				<div class="col-md-2"> 
					<label>Estado: <span id="required">*</span></label>
					<input type="text" name="estado" class="form-control" maxlength="2">	
				</div>	
			</div>

			<div class="row">
				<div class="col-12">
					<label>Turma: <span id="required">*</span></label>
					<select name="turma" required class="form-control">
						<?php
							$sql = "SELECT turma.CODIGO, turma.NOME FROM turma INNER JOIN usuario_has_turma ON turma.CODIGO = usuario_has_turma.turma_CODIGO INNER JOIN usuario ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO WHERE usuario.escola_CODIGO = $escola_codigo GROUP BY turma.CODIGO";
							$query = mysqli_query($con, $sql);
							while ($row_turma = mysqli_fetch_array($query)) {
								?>
									<option value="<?php echo $row_turma['CODIGO']?>"><?php echo $row_turma['NOME']?></option>
								<?php
							}
						?>
					</select>
					<?php
						echo mysqli_error($con);
					?>
				</div>
			</div>		

			<div class="row"> 
				<div class="col-md-12"> 
					<label>Senha: <span id="required">*</span></label>
					<input type="password" name="senha" class="form-control" required minlength="6">	
				</div>	
			</div>

			<input type="submit" value="Adicionar" class="btn btn-success mt-2">	
		</form>
	</div>	
</div>
<?php
	include_once('../content/footer.php');
?>