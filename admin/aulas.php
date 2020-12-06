<?php
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$page = "Aulas";
	include_once('../content/banner.php');

?>		
<h3>Aulas</h3>
<div class="row"> 
	<div class="col-md-4"> 
		<button class="btn btn-primary col-12 mb-2" onclick="action()" id="button">Adicionar nova</button>
	</div>
</div>
<div class="row" style="display: none" id="model"> 
	<div class="col-12"> 
		<form action="../controller/Aulas.php?id=1" method="post"> 
			<label>Nome da aula:<span id="required">*</span></label>
			<input type="text" name="nome" class="form-control" required>
			
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
	      <th scope="col">Editar</th>
	      <th scope="col">Remover</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$escola_codigo = $_SESSION['escola_codigo'];
	  		$sql = "SELECT * FROM aula WHERE escola_CODIGO = $escola_codigo";
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {

	  				?>
	  				<tr>
				      <th scope="row"><?php echo $row['CODIGO']?></th>
				      <td><?php echo $row['NOME']?></td>
				      <td><a href="editar_aula.php?codigo=<?php echo $row['CODIGO']?>" class="btn">Editar</a></td>
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
			      <th scope="row" colspan="3">Nenhuma aula cadastrada ainda!</th>
			    </tr>

	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>
<script type="text/javascript">
	function remover(codigo){
		var confirm = window.confirm("Isto removerá: \n - Todas as frequências registradas nesta aula \n - Todos horários registrados nesta aula");
		if (confirm) {
			window.location.href = '../controller/aulas.php?id=2&&codigo=' + codigo
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