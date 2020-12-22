<?php
	$page = "Atividades";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 1) {
	$user_codigo = $_SESSION['codigo'];
	include_once('../content/banner.php');
?>		
<h3>Atividades</h3>
<div class="row"> 
	<div class="col-md-4"> 
		<button class="btn btn-primary col-12 mb-2" onclick="action()" id="button">Adicionar nova</button>
	</div>
</div>
<div class="row" style="display: none" id="model"> 
	<div class="col-12"> 
		<form action="../controller/atividades.php?id=1" method="post" enctype="multipart/form-data"> 
			<label>Data de entrega:</label>
			<input type="date" name="fim" class="form-control">

			<label>Atividade (dê preferência a PDFs): <span id="required">*</span></label>
			<input type="file" name="arquivo" class="form-control" required> <br> 
			
			<label>Turma: <span id="required">*</span></label>
			<select name="turma" class="form-control" required>
				<?php
					$sql = "SELECT turma.CODIGO, turma.NOME FROM materia INNER JOIN turma ON materia.turma_CODIGO = turma.CODIGO WHERE materia.usuario_CODIGO = $user_codigo";
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
	      <th scope="col">Turma</th>	      
	      <th scope="col">Ínicio</th>
	      <th scope="col">Fim</th>
	      <th scope="col">Arquivo</th>
	      <th scope="col">Editar</th>
	      <th scope="col">Remover</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$escola_codigo = $_SESSION['escola_codigo'];
	  		$sql = "SELECT atividade.CODIGO, atividade.INICIO, atividade.FIM, atividade.SRC, turma.NOME FROM atividade INNER JOIN turma ON atividade.turma_CODIGO = turma.CODIGO WHERE usuario_CODIGO = $user_codigo GROUP BY atividade.CODIGO ORDER BY INICIO DESC";
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {

	  				?>
	  				<tr>
				      <th scope="row"><?php echo $row['CODIGO']?></th>
				      <td><?php echo $row['NOME']?></td>
				      <td><?php echo $row['INICIO']?></td>
				      <td><?php echo $row['FIM']?></td>
				      <td><a href="<?php echo $row['SRC']?>" target="_blank"><?php echo $row['SRC']?></a></td>
				      <td><a href="editar_atividade.php?codigo=<?php echo $row['CODIGO']?>" class="btn">Editar</a></td>
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
			      <th scope="row" colspan="3">Nenhuma atividade cadastrada ainda!</th>
			    </tr>

	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>
<script type="text/javascript">
	function remover(codigo){
		var confirm = window.confirm("Isto removerá esta atividade!");
		if (confirm) {
			window.location.href = '../controller/atividades.php?id=2&&codigo=' + codigo
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