<?php
	$page = "Horários";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 1) {
	$escola_codigo = $_SESSION['escola_codigo'];
	$user_codigo = $_SESSION['codigo'];
	include_once('../content/banner.php');

?>		
<h3>Meu horário</h3>
<?php
	$sql = "SELECT horario.CODIGO, horario.DIA, aula.NOME AS AULA, turma.NOME AS TURMA, materia.NOME AS MATERIA FROM horario INNER JOIN materia ON horario.materia_CODIGO = materia.CODIGO INNER JOIN turma ON materia.turma_CODIGO = turma.CODIGO INNER JOIN aula ON aula.CODIGO = horario.aula_CODIGO WHERE materia.usuario_CODIGO = $user_codigo ORDER BY CONCAT(horario.DIA, ' ', aula.CODIGO) ASC";
	$query = mysqli_query($con, $sql);
	$dia = 20;
	if (mysqli_num_rows($query) > 0) {
		while ($row = mysqli_fetch_array($query)) {
			if ($dia != $row['DIA']) {
				if ($dia == 20) {
					?>
					<h4><?php echo $dia_semana[$row['DIA']]?>:</h4>
					<table class="table">
					<thead>
					    <tr>
					      <th scope="col">Codigo</th>
					      <th scope="col">Aula</th>
					      <th scope="col">Turma</th>
					      <th scope="col">Matéria</th>
					    </tr>
					</thead>
					<tbody>
					    <tr>
					      <th scope="row"><?php echo $row['CODIGO']?></th>
					      <td><?php echo $row['AULA']?></td>
					      <td><?php echo $row['TURMA']?></td>
					      <td><?php echo $row['MATERIA']?></td>
					    </tr>
					<?php
				}else{
					?>
						</tbody>
					</table>
					<br> 
					<br> 
					<h4><?php echo $dia_semana[$row['DIA']]?>:</h4>
					<table class="table">
					<thead>
					    <tr>
					      <th scope="col">Codigo</th>
					      <th scope="col">Aula</th>
					      <th scope="col">Turma</th>
					      <th scope="col">Matéria</th>
					    </tr>
					</thead>
					<tbody>
					    <tr>
					      <th scope="row"><?php echo $row['CODIGO']?></th>
					      <td><?php echo $row['AULA']?></td>
					      <td><?php echo $row['TURMA']?></td>
					      <td><?php echo $row['MATERIA']?></td>
					    </tr>

					<?php
				}
				$dia = $row['DIA'];
			}else{
				?>
			    <tr>
			      <th scope="row"><?php echo $row['CODIGO']?></th>
			      <td><?php echo $row['AULA']?></td>
			      <td><?php echo $row['TURMA']?></td>
			      <td><?php echo $row['MATERIA']?></td>
			    </tr>

				<?php
			}
		}
	}else{
		?>
		<div class="row"> 
			<div class="col-12"> 
				<div class="alert alert-danger"> 
					Nenhum horário cadastrado ainda
				</div>
			</div>	
		</div>	
		<?php
	}
?>
<?php
}else{
	$page = "404";
	include_once('../content/banner.php');
	include_once('../content/404.php');
}
	include_once('../content/footer.php');
?>