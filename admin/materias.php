<?php
	$page = "Matérias";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$escola_codigo = $_SESSION['escola_codigo'];
	include_once('../content/banner.php');

?>		
<h3>Matérias</h3>
<?php 
	$sql = "SELECT * FROM usuario WHERE escola_CODIGO = $escola_codigo AND PERMISSAO = 1 AND ATIVO = 1";
	$query = mysqli_query($con, $sql);
	if (mysqli_num_rows($query) == 0) {
		?>
		<div class="row">
			<div class="col-12">
				<div class="alert alert-danger">
					Cadastre um professor antes!
				</div>
			</div>
		</div>
		<?php
	}

	$sql = "SELECT * FROM turma INNER JOIN usuario_has_turma ON usuario_has_turma.turma_CODIGO = turma.CODIGO INNER JOIN usuario ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO WHERE escola_CODIGO = $escola_codigo";
	$query = mysqli_query($con, $sql);
	if (mysqli_num_rows($query) == 0) {
		?>
		<div class="row">
			<div class="col-12">
				<div class="alert alert-danger">
					Cadastre uma turma antes!
				</div>
			</div>
		</div>
		<?php
	}
?>
<div class="row"> 
	<div class="col-md-4"> 
		<button class="btn btn-primary col-12 mb-2" onclick="action()" id="button">Adicionar nova</button>
	</div>
</div>
<div class="row" style="display: none" id="model"> 
	<div class="col-12"> 
		<form action="../controller/materias.php?id=1" method="post"> 
			<label>Nome da matéria:<span id="required">*</span></label>
			<input type="text" name="nome" class="form-control" required>

			<label>Professor responsável: <span id="required">*</span></label>
			<select name="professor">
				<option value="0">Selecione um professor</option>
				<?php
					$sql = "SELECT * FROM usuario WHERE escola_CODIGO = $escola_codigo AND PERMISSAO = 1 AND ATIVO = 1";
					$query = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($query)) {
						?>
							<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
						<?php
					}
				?>
			</select>


			<label>Turma: <span id="required">*</span></label>
			<select name="turma">
				<option value="0">Selecione uma turma</option>
				<?php
					$sql = "SELECT turma.NOME, turma.CODIGO FROM usuario INNER JOIN usuario_has_turma ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO INNER JOIN turma ON usuario_has_turma.turma_CODIGO = turma.CODIGO WHERE usuario.escola_CODIGO = $escola_codigo GROUP BY turma.CODIGO";
					$query = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($query)) {
						?>
							<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
						<?php
					}
				?>
			</select>
			<input type="submit" value="Adicionar" class="btn btn-success mt-2 col-md-4">
		</form>
	</div>	
</div>		
<div style="overflow: auto"> 
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Código</th>
	      <th scope="col">Nome</th>
	      <th scope="col">Professor</th>
	      <th scope="col">Turma</th>
	      <th scope="col">Editar</th>
	      <th scope="col">Remover</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$sql = "SELECT materia.CODIGO, materia.NOME, usuario.NOME AS PROFESSOR, turma.NOME AS TURMA FROM materia INNER JOIN turma ON materia.turma_CODIGO = turma.CODIGO INNER JOIN usuario ON materia.usuario_CODIGO = usuario.CODIGO WHERE usuario.escola_CODIGO = $escola_codigo";
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {
	  				?>
	  				<tr>
				      <th scope="row"><?php echo $row['CODIGO']?></th>
				      <td><?php echo $row['NOME']?></td>
				      <td><?php echo $row['PROFESSOR']?></td>
				      <td><?php echo $row['TURMA']?></td>
				      <td><a href="editar_materia.php?codigo=<?php echo $row['CODIGO']?>" class="btn">Editar</a></td>
				      <td>
				      	<button class="btn btn-outline-danger" onclick="remover(<?php echo $row['CODIGO']?>)">
				      		Remover
					    </button>
					  </td>
				    </tr>
	  				<?php
	  			}
	  		}else {
	  			?>
			    <tr>
			      <th scope="row" colspan="3">Nenhuma matéria cadastrada ainda!</th>
			    </tr>

	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>
<script type="text/javascript">
	function remover(codigo){
		var confirm = window.confirm("Realmente deseja remover esta matéria? \n - Isto excluirá todos os horarios e avaliações envolvendo-a");
		if (confirm) {
			window.location.href = '../controller/materias.php?id=2&&codigo=' + codigo
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