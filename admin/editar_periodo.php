<?php
	$page = "Períodos escolares";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$codigo = $_GET['codigo'];
	$sql = "SELECT * FROM periodo WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	include_once('../content/banner.php');

?>		
<h3>Editando o período de codigo <?php echo $codigo?></h3>
<div class="row"> 
	<div class="col-12"> 
		<form action="../controller/periodos.php?id=2&&codigo=<?php echo $codigo?>" method="post"> 
			<div class="row">
				<div class="col-md-12">
					<label>Nome do período:<span id="required">*</span></label>
					<input type="text" name="nome" class="form-control" required value="<?php echo $row['NOME']?>">					
				</div>
			</div>
			 
			<div class="row">
				<div class="col-md-6">
					<label>Início: <span id="required">*</span></label>
					<input type="date" name="inicio" class="form-control" required value="<?php echo $row['INICIO']?>">				
				</div>
				<div class="col-md-6">
					<label>Fim: <span id="required">*</span></label>
					<input type="date" name="fim" class="form-control" required value="<?php echo $row['FIM']?>">				
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<label>Calculo da média: <span id="required">*</span></label>
					<select name="media" class="form-control" required id="media">
						<option value="0">Média simples</option>
						<option value="1">Média ponderada</option>
					</select>
				</div>
			</div>
			<input type="submit" value="Atualizar" class="btn btn-success mt-2 col-md-4">
		</form>
	</div>	
</div>
<script type="text/javascript">
	window.onload = function(){
		document.querySelector("#media").value = <?php echo $row['MEDIA']?>
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