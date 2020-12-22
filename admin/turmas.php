<?php
	$page = "Turmas";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$escola_codigo = $_SESSION['escola_codigo'];
	include_once('../content/banner.php');

?>		
<h3>Turmas</h3>
<?php
	$sql = "SELECT * FROM periodo WHERE escola_CODIGO = $escola_codigo";
	$query = mysqli_query($con, $sql);
	if (mysqli_num_rows($query) == 0) {
		?>
		<div class="row">
			<div class="col-12">
				<div class="alert alert-danger">
					Cadastre um período antes
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
		<form action="../controller/turmas.php?id=1" method="post"> 
			<label>Nome da turma:<span id="required">*</span></label>
			<input type="text" name="nome" class="form-control" required>

			<label>Quantidade limíte de alunos: <span id="required">*</span></label>
			<input type="number" name="limite" class="form-control" required="">	
			
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
	      <th scope="col">Alunos / limite</th>
	      <th scope="col">Editar</th>
	      <th scope="col">Remover</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$user_codigo = $_SESSION['codigo'];
	  		$sql = "SELECT * FROM turma INNER JOIN usuario_has_turma ON usuario_has_turma.turma_CODIGO = turma.CODIGO WHERE usuario_has_turma.usuario_CODIGO = $user_codigo GROUP BY turma.CODIGO";
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {
	  				$turma_codigo = $row['CODIGO'];
	  				$sql = "SELECT COUNT(usuario_CODIGO) AS QTD FROM usuario_has_turma INNER JOIN usuario ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO WHERE usuario.PERMISSAO = 0 AND usuario_has_turma.turma_CODIGO = $turma_codigo AND usuario_has_turma.STATUS = 1";
	  				$query2 = mysqli_query($con, $sql);
	  				$row2 = mysqli_fetch_array($query2);

	  				?>
	  				<tr>
				      <th scope="row"><?php echo $row['CODIGO']?></th>
				      <td><?php echo $row['NOME']?></td>
				      <td><?php echo $row2['QTD']?> / <?php echo $row['LIMITE']?></td>
				      <td><a href="editar_turma.php?codigo=<?php echo $row['CODIGO']?>" class="btn">Editar</a></td>
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
			      <th scope="row" colspan="3">Nenhuma turma cadastrada ainda!</th>
			    </tr>

	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>
<script type="text/javascript">
	function remover(codigo){
		var confirm = window.confirm("Isto removerá todos os alunos nesta turma!");
		if (confirm) {
			window.location.href = '../controller/turmas.php?id=2&&codigo=' + codigo
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