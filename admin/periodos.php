<?php
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$page = "Períodos escolares";
	include_once('../content/banner.php');

?>		
<h3>Períodos escolares</h3>
<div class="row"> 
	<div class="col-md-4"> 
		<button class="btn btn-primary col-12 mb-2" onclick="action()" id="button">Adicionar novo</button>
	</div>
</div>
<div class="row" style="display: none" id="model"> 
	<div class="col-12"> 
		<form action="../controller/periodos.php?id=1" method="post"> 
			<div class="row">
				<div class="col-md-12">
					<label>Nome do período:<span id="required">*</span></label>
					<input type="text" name="nome" class="form-control" required>					
				</div>
			</div>
			 
			<div class="row">
				<div class="col-md-6">
					<label>Início: <span id="required">*</span></label>
					<input type="date" name="inicio" class="form-control" required>				
				</div>
				<div class="col-md-6">
					<label>Fim: <span id="required">*</span></label>
					<input type="date" name="fim" class="form-control" required>				
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<label>Calculo da média: <span id="required">*</span></label>
					<select name="media" class="form-control" required>
						<option value="0">Média simples</option>
						<option value="1">Média ponderada</option>
					</select>
				</div>
			</div>
			<input type="submit" value="Adicionar" class="btn btn-success mt-2 col-md-4">
		</form>
	</div>	
</div>		
<div class="row mb-2">
	<div class="col-12">
		<a href="periodos.php?all=1" class="btn btn-secondary">Exibir todos os períodos</a>
		<?php
			if (isset($_GET['all'])) {
				?>
					<a href="periodos.php" class="btn btn-outline-danger">Remover filtro</a>
				<?php
			}
		?>
	</div>
</div>
<div style="overflow: auto"> 
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Código</th>
	      <th scope="col">Nome</th>
	      <th scope="col">Início</th>
	      <th scope="col">Fim</th>
	      <th scope="col">Média</th>
	      <th scope="col">Editar</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$escola_codigo = $_SESSION['escola_codigo'];
	  		$date = date('Y-m-d');
	  		if (isset($_GET['all'])) {
	  			$sql = "SELECT * FROM periodo WHERE escola_CODIGO = $escola_codigo ORDER BY FIM ASC";
	  		}else{
	  			$sql = "SELECT * FROM periodo WHERE escola_CODIGO = $escola_codigo AND FIM >= '$date' ORDER BY FIM ASC";
	  		}
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {

	  				?>
	  				<tr>
				      <th scope="row"><?php echo $row['CODIGO']?></th>
				      <td><?php echo $row['NOME']?></td>
				      <td><?php echo $row['INICIO']?></td>
				      <td><?php echo $row['FIM']?></td>
				      <td><?php
				      	if($row['MEDIA'] == 0){
				      		echo "Média simples";
				      	}else{
				      		echo "Média ponderada";
				      	}
				      ?></td>
				      <td><a href="editar_periodo.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-primary">Editar</a></td>
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