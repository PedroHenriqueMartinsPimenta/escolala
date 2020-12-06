<?php
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 1) {
	$page = "Avaliações";
	$codigo = $_GET['codigo'];
	$sql = "SELECT * FROM avaliacao WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	$user_codigo = $_SESSION['codigo'];
	include_once('../content/banner.php');

?>		
<h3>Notas da avaliação: <?php echo $row['NOME']?></h3>
	
<div style="overflow: auto"> 
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Nome do aluno:</th>
	      <th scope="col">Nota</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$sql = "SELECT usuario.NOME, usuario.SOBRENOME, avaliacao_has_usuario.NOTA, avaliacao_has_usuario.CODIGO FROM usuario INNER JOIN avaliacao_has_usuario ON usuario.CODIGO = avaliacao_has_usuario.usuario_CODIGO WHERE avaliacao_has_usuario.avaliacao_CODIGO = $codigo";
	  		$query = mysqli_query($con, $sql);
	  		while ($row_notas = mysqli_fetch_array($query)) {
	  			?>
					<tr>
				      <th scope="row"><?php echo $row_notas['NOME'] . " " . $row_notas['SOBRENOME']?></th>
				      <td><input type="text" name="nota" class="form-control" onchange="update(<?php echo $row_notas['CODIGO']?>, this)" value="<?php echo $row_notas['NOTA']?>"></td>
				    </tr>
	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>	
<script type="text/javascript">
	function update(codigo, input){
		var nota = input.value;
		var dados = {codigo: codigo, nota: nota};
		$.post(
			"../controller/avaliacoes.php?id=4",
			dados,
			function(result){
				if (!result) {
					alert("Erro na atualização da nota!");
				}
			},
			'JSON'
			);
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