<?php
	$page = "Alunos";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$escola_codigo = $_SESSION['escola_codigo'];
	include_once('../content/banner.php');

?>		
<h3>Alunos</h3>
<?php

	$sql = "SELECT turma.CODIGO, turma.NOME FROM turma INNER JOIN usuario_has_turma ON turma.CODIGO = usuario_has_turma.turma_CODIGO INNER JOIN usuario ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO WHERE usuario.escola_CODIGO = $escola_codigo GROUP BY turma.CODIGO ORDER BY turma.NOME ASC";
	$query = mysqli_query($con, $sql);
	if (mysqli_num_rows($query) == 0) {
		?>
			<div class="alert alert-danger"> 
				Você deve cadastrar a turma antes!
			</div>
		<?php
	}
?>
<div class="row"> 
	<div class="col-md-4"> 
		<button class="btn btn-primary col-12 mb-2" onclick="action()" id="button">Adicionar nova</button>
	</div>
	<?php
		$codigo = $_SESSION['codigo'];
		$sql = "SELECT * FROM link WHERE usuario_CODIGO = $codigo AND PARA LIKE '%matricula%'";
		$query_link = mysqli_query($con, $sql);
		if (mysqli_num_rows($query_link) == 0) {
			?>
				<div class="col-md-6">
					<a href="../controller/link.php?id=1&&type=2" class="btn btn-outline-primary">Gerar link</a>
				</div>
			<?php
		}else{
			$row_link = mysqli_fetch_array($query_link);
			?>
			<div style="display: inline-block;">
				<a href="<?php echo $row_link['PARA']?>" target="_blank"><?php echo $row_link['PARA']?></a>
				<a href="../controller/link.php?id=2&&codigo=<?php echo $row_link['CODIGO']?>" class="btn btn-secondary">X</a>
			</div>
			<?php
		}
	?>
</div>
<div class="row" style="display: none" id="model"> 
	<div class="col-12"> 
		<form action="../controller/alunos.php?id=1" method="post"> 
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
					<label>E-mail do responsável: </label>
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
			<div class="row"> 
				<div class="col-12"> 
					<label>Turma: <span id="required">*</span></label>
					<select name="turma" required class="form-control">
						<option>Selecionar turma</option>
						<?php
							while ($row = mysqli_fetch_array($query)) {
								?>
								<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
								<?php
							}
						?>
					</select>
				</div>	
			</div>	
			<input type="submit" value="Adicionar" class="btn btn-success mt-2">
		</form>
	</div>	
</div>
<div class="row">
	<div class="col-12">
		<form action="alunos.php" method="get">
			<input type="text" name="nome" class="form-control" placeholder="Pesquisa aluno pelo nome">
			<input type="submit" value="Pesquisar" class="btn btn-success">
			<?php
				if (isset($_GET['nome'])) {
					?>
						<a href="professores.php" class="btn btn-outline-danger"> Remover pesquisa</a>
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
	      <th scope="col">E-mail responsável</th>
	      <th scope="col">Rua</th>
	      <th scope="col">Complemento</th>
	      <th scope="col">Bairro</th>
	      <th scope="col">Cidade</th>
	      <th scope="col">Estado</th>
	      <th scope="col">Turma</th>
	      <th scope="col">Boletim</th>
	      <th scope="col">Transitar</th>
	      <th scope="col">Editar</th>
	      <th scope="col">Ativar / Desativar</th>
	      <th scope="col">Remover</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		if (isset($_GET['nome'])) {
	  			$nome = $_GET['nome'];
	  			$sql = "SELECT usuario.CODIGO, usuario.NOME, usuario.SOBRENOME, usuario.EMAIL, usuario.EMAIL_SECUNDARIO, usuario.RUA, usuario.COMPLEMENTO, usuario.BAIRRO, usuario.CIDADE, usuario.ESTADO, usuario.ATIVO, turma.NOME AS TURMA FROM usuario INNER JOIN usuario_has_turma ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO INNER JOIN turma ON turma.CODIGO = usuario_has_turma.turma_CODIGO WHERE usuario.escola_codigo = $escola_codigo AND usuario.PERMISSAO = 0 AND usuario_has_turma.STATUS = 1 AND CONCAT(usuario.NOME, ' ', usuario.SOBRENOME) LIKE '%$nome%'";
	  		}else{
	  			$sql = "SELECT usuario.CODIGO, usuario.NOME, usuario.SOBRENOME, usuario.EMAIL, usuario.EMAIL_SECUNDARIO, usuario.RUA, usuario.COMPLEMENTO, usuario.BAIRRO, usuario.CIDADE, usuario.ESTADO, usuario.ATIVO, turma.NOME AS TURMA FROM usuario INNER JOIN usuario_has_turma ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO INNER JOIN turma ON turma.CODIGO = usuario_has_turma.turma_CODIGO WHERE usuario.escola_codigo = $escola_codigo AND usuario.PERMISSAO = 0 AND usuario_has_turma.STATUS = 1";
	  		}
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {
	  				if($row['ATIVO'] != 2){
		  				if ($row['ATIVO'] == 1) {
		  					?>
		  						<tr>

		  					<?php
		  				}else{
		  					?>
								<tr style="opacity: 0.5">
		  					<?php
		  				}
		  				?>
					      <th scope="row"><?php echo $row['CODIGO']?></th>
					      <td><?php echo $row['NOME']?></td>
					      <td><?php echo $row['SOBRENOME']?></td>
					      <td><a href="mailto:<?php echo $row['EMAIL']?>"><?php echo $row['EMAIL']?></a></td>
					      <td><a href="mailto:<?php echo $row['EMAIL_SECUNDARIO']?>"><?php echo $row['EMAIL_SECUNDARIO']?></a></td>
					      <td><?php echo $row['RUA']?></td>
					      <td><?php echo $row['COMPLEMENTO']?></td>
					      <td><?php echo $row['BAIRRO']?></td>
					      <td><?php echo $row['CIDADE']?></td>
					      <td><?php echo $row['ESTADO']?></td>
					      <td><?php echo $row['TURMA']?></td>
					      <td><a href="boletim.php?codigo=<?php echo $row['CODIGO']?>">Ver</a></td>
					      <td><a href="transitar_turma.php?codigo=<?php echo $row['CODIGO']?>" class="btn" title="Transistar o aluno para uma nova turma">Transitar</a></td>
					      <td><a href="editar_aluno.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-primary">Editar</a></td>
					      <td>
					      	<?php
					      		if ($row['ATIVO'] == 1) {
					      			?>
					      				<button class="btn btn-outline-danger" onclick="desativar(<?php echo $row['CODIGO']?>)">
								      		Desativar
									    </button>
					      			<?php
					      		}else{
					      			?>
					      				<button class="btn btn-outline-success" onclick="ativar(<?php echo $row['CODIGO']?>)">
								      		Ativar
									    </button>
					      			<?php
					      		}
					      	?>

						  <td><button class="btn btn-danger" onclick='remover(<?php echo json_encode($row['EMAIL'])?>, <?php echo $row['CODIGO']?>)'>Remover</button></td>
					    </tr>
						  </td>
					    </tr>
		  				<?php
		  			}
		  		}
	  		}else {
	  			?>
			    <tr>
			      <th scope="row" colspan="3">Nenhum aluno(a) cadastrado ainda!</th>
			    </tr>

	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>
<script type="text/javascript">
	function desativar(codigo){
		var confirm = window.confirm("Isto desativará este aluno");
		if (confirm) {
			window.location.href = '../controller/alunos.php?id=2&&codigo=' + codigo + '&&ativo=0'
		}
	}
	function ativar(codigo){
		window.location.href = '../controller/alunos.php?id=2&&codigo=' + codigo + '&&ativo=1'		
	}
	function remover(email, codigo){
		var confirm = window.confirm("Realmente deseja remover permanentemente este usuário?");
		if (confirm) {
			window.location.href = '../controller/alunos.php?id=6&&codigo=' + codigo + '&&email='+email;
		}
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