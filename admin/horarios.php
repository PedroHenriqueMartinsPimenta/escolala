<?php
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$page = "Horários";
	$escola_codigo = $_SESSION['escola_codigo'];
	include_once('../content/banner.php');

?>		
<h3>Horários</h3>
<?php
	$sql = "SELECT * FROM materia INNER JOIN usuario ON usuario.CODIGO = materia.usuario_CODIGO WHERE usuario.escola_CODIGO = $escola_codigo";
	$query = mysqli_query($con, $sql);
	echo mysqli_error($con);
	if (mysqli_num_rows($query) == 0) {
		?>
			<div class="alert alert-danger"> 
				Insira uma matéria antes!
			</div>
		<?php
	}
?>
<?php
	$sql = "SELECT * FROM aula WHERE escola_CODIGO = $escola_codigo";
	$query = mysqli_query($con, $sql);
	echo mysqli_error($con);
	if (mysqli_num_rows($query) == 0) {
		?>
			<div class="alert alert-danger"> 
				Insira uma aula antes!
			</div>
		<?php
	}
?>
<div class="row"> 
	<div class="col-md-4"> 
		<button class="btn btn-primary col-12 mb-2" onclick="action()" id="button">Adicionar novo</button>
	</div>
</div>
<div class="row" style="display: none" id="model"> 
	<div class="col-12"> 
		<form action="../controller/horarios.php?id=1" method="post"> 
			<label>Dia da semana: <span id="required">*</span></label>
			<select name="dia_semana" required>
				<option value="1">Segunda</option>
				<option value="2">Terça</option>
				<option value="3">Quarta</option>
				<option value="4">Quinta</option>
				<option value="5">Sexta</option>
				<option value="6">Sábado</option>
				<option value="0">Domingo</option>
			</select>	
			
			<label>Aula: <span id="required">*</span></label>
			<select name="aula" required>
				<?php
					$sql = "SELECT * FROM aula WHERE escola_CODIGO = $escola_codigo";
					$query = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($query)) {
						?>
							<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
						<?php
					}
				?>
			</select>

			<label>Matéria: <span id="required">*</span></label>
			<select name="materia" required>
				<?php
					$sql = "SELECT materia.CODIGO, materia.NOME, usuario.NOME AS PROFESSOR, turma.NOME AS TURMA FROM materia INNER JOIN usuario ON usuario.CODIGO = materia.usuario_CODIGO INNER JOIN turma ON turma.CODIGO = materia.turma_CODIGO WHERE usuario.escola_CODIGO = $escola_codigo AND usuario.PERMISSAO = 1 AND usuario.ATIVO = 1";
					$query = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($query)) {
						?>
							<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME'] . " - " . $row['PROFESSOR'] . " / " . $row['TURMA']?></option>
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
	      <th scope="col">Dia da semana</th>
	      <th scope="col">aula</th>
	      <th scope="col">Professor</th>
	      <th scope="col">Turma</th>
	      <th scope="col">Matéria</th>
	      <th scope="col">Editar</th>
	      <th scope="col">Remover</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$sql = "SELECT horario.CODIGO, horario.DIA, usuario.NOME AS PROFESSOR, aula.NOME AS AULA, turma.NOME AS TURMA, materia.NOME AS MATERIA, CONCAT(horario.DIA, ' ', aula.CODIGO) AS ORDEM FROM horario INNER JOIN aula ON aula.CODIGO = horario.aula_CODIGO INNER JOIN materia ON materia.CODIGO = horario.materia_CODIGO INNER JOIN usuario ON usuario.CODIGO = materia.usuario_CODIGO INNER JOIN turma ON turma.CODIGO = materia.turma_CODIGO WHERE usuario.escola_CODIGO = $escola_codigo ORDER BY ORDEM ASC";
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {
	  				?>
	  				<tr>
				      <th scope="row"><?php echo $row['CODIGO']?></th>
				      <td><?php echo $dia_semana[$row['DIA']]?></td>
				      <td><?php echo $row['AULA']?></td>
				      <td><?php echo $row['PROFESSOR']?></td>
				      <td><?php echo $row['TURMA']?></td>
				      <td><?php echo $row['MATERIA']?></td>
				      <td><a href="editar_horario.php?codigo=<?php echo $row['CODIGO']?>" class="btn">Editar</a></td>
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
			      <th scope="row" colspan="3">Nenhum horário cadastrado ainda!</th>
			    </tr>

	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>
<script type="text/javascript">
	function remover(codigo){
		var confirm = window.confirm("Isto removerá este horário!");
		if (confirm) {
			window.location.href = '../controller/horarios.php?id=2&&codigo=' + codigo
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