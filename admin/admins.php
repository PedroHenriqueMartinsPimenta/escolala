<?php
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$page = "Administradores";
	$escola_codigo = $_SESSION['escola_codigo'];
	include_once('../content/banner.php');
?>	

<h3>Administradores</h3>
<div class="row"> 
	<div class="col-md-4"> 
		<button class="btn btn-primary col-12 mb-2" onclick="action()" id="button">Adicionar novo</button>
	</div>
</div>
<div class="row" style="display: none" id="model"> 
	<div class="col-12"> 
		<form action="../controller/admins.php?id=1&&escola_codigo=<?php echo $escola_codigo?>" method="post"> 
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
				<div class="col-md-12"> 
					<label>Senha: <span id="required">*</span></label>
					<input type="password" name="senha" class="form-control" required minlength="6">	
				</div>	
			</div>

			<input type="submit" value="Adicionar" class="btn btn-success mt-2">	
		</form>
	</div>	
</div>

<div class="row">
	<div class="col-12">
		<form action="admins.php" method="get">
			<input type="text" name="nome" class="form-control" placeholder="Pesquisa professor pelo nome">
			<input type="submit" value="Pesquisar" class="btn btn-success">
			<?php
				if (isset($_GET['nome'])) {
					?>
						<a href="admins.php" class="btn btn-outline-danger"> Remover pesquisa</a>
					<?php
				}
			?>
		</form>		
	</div>
</div>

<div style="overflow: auto"> 
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Código</th>
	      <th scope="col">Nome</th>
	      <th scope="col">Sobrenome</th>
	      <th scope="col">E-mail</th>
	      <th scope="col">E-mail seundário</th>
	      <th scope="col">Rua</th>
	      <th scope="col">Complemento</th>
	      <th scope="col">Bairro</th>
	      <th scope="col">Cidade</th>
	      <th scope="col">Estado</th>
	      <th scope="col">Editar</th>
	      <th scope="col">Ativar / desativar</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		if (isset($_GET['nome'])) {
	  			$nome = $_GET['nome'];
		  		$sql = "SELECT * FROM usuario WHERE escola_CODIGO = $escola_codigo AND PERMISSAO = 2 AND CONCAT(NOME, ' ',SOBRENOME) LIKE '%$nome%'";	  			
	  		}else{
		  		$sql = "SELECT * FROM usuario WHERE escola_CODIGO = $escola_codigo AND PERMISSAO = 2";
		  	}
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {
	  				if ($row['ATIVO'] == 0) {
	  					?>

	  				<tr style="opacity: 0.5">
	  					<?php
	  				}else{
	  				?>
	  				<tr>
	  				<?php
	  				 }
	  				?>
				      <th scope="row"><?php echo $row['CODIGO']?></th>
				      <td><?php echo $row['NOME']?></td>
				      <td><?php echo $row['SOBRENOME']?></td>
				      <td><?php echo $row['EMAIL']?></td>
				      <td><?php echo $row['EMAIL_SECUNDARIO']?></td>
				      <td><?php echo $row['RUA']?></td>
				      <td><?php echo $row['COMPLEMENTO']?></td>
				      <td><?php echo $row['BAIRRO']?></td>
				      <td><?php echo $row['CIDADE']?></td>
				      <td><?php echo $row['ESTADO']?></td>
				      <td><a href="editar_admin.php?codigo=<?php echo $row['CODIGO']?>" class="btn">Editar</a></td>
				      <td>
				      	<?php
				      		if ($row['ATIVO'] == 0) {
				      			?>
				      				<button class="btn btn-outline-success" onclick="ativar(<?php echo $row['CODIGO']?>)">
							      		Ativar
								    </button>
				      			<?php
				      		}else{
				      			?>
				      				<button class="btn btn-outline-danger" onclick="desativar(<?php echo $row['CODIGO']?>)">
							      		Desativar
								    </button>
				      			<?php
				      		}
				      	?>
					  </td>
				    </tr>
	  				<?php
	  			}
	  		}else {
	  			?>
			    <tr>
			      <th scope="row" colspan="3">Nenhum professor cadastrado ainda!</th>
			    </tr>

	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>
<script type="text/javascript">
	function desativar(codigo){
		var confirm = window.confirm("Realmente deseja desativar este usuário?");
		if (confirm) {
			window.location.href = '../controller/admins.php?id=2&&codigo=' + codigo + '&&ativo=0';
		}
	}

	function ativar(codigo){
			window.location.href = '../controller/admins.php?id=2&&codigo=' + codigo + '&&ativo=1';
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