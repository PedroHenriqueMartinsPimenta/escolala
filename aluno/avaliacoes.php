<?php
	$page = "Avaliações";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 0) {
	$user_codigo = $_SESSION['codigo'];
	$escola_codigo = $_SESSION['escola_codigo'];
	include_once('../content/banner.php');

?>		
<h3>Avaliações</h3>		
<div style="overflow: auto"> 
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Código</th>
	      <th scope="col">Nome</th>	  
	      <th scope="col">Peso da avaliação na média</th>
	      <th scope="col">Prazo de entrega</th>
	      <th scope="col">Período</th>
	      <th scope="col">Acessar / Nota</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$data = date('Y');
	  		$sql = "SELECT avaliacao.CODIGO, avaliacao.NOME, avaliacao.PESO, avaliacao.TIPO, periodo.FIM, periodo.NOME AS PERIODO, materia.NOME AS MATERIA FROM avaliacao INNER JOIN periodo ON avaliacao.periodo_CODIGO = periodo.CODIGO INNER JOIN materia ON materia.CODIGO = avaliacao.materia_CODIGO INNER JOIN turma ON materia.turma_CODIGO = turma.CODIGO INNER JOIN usuario_has_turma ON usuario_has_turma.turma_CODIGO = turma.CODIGO WHERE usuario_has_turma.usuario_CODIGO = $user_codigo AND YEAR(periodo.FIM) = $data AND (avaliacao.ATIVA = 1 OR avaliacao.TIPO = 0) GROUP BY avaliacao.CODIGO ORDER BY CONCAT(avaliacao.TIPO, avaliacao.CODIGO) DESC";
	  		$query = mysqli_query($con, $sql);
	  		echo mysqli_error($con);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {

	  				?>
	  				<tr>
				      <th scope="row"><?php echo $row['CODIGO']?></th>
				      <td><?php echo $row['NOME']?></td>
				      <td><?php echo $row['PESO']?></td>
				      <td><?php echo $row['FIM']?></td>
				      <td><?php echo $row['PERIODO']?></td>
				      <td>
				      	<?php
				      		if ($row['TIPO'] == 1) {
				      			$avaliacao = $row['CODIGO'];
				      			$sql = "SELECT NOTA FROM avaliacao_has_usuario WHERE avaliacao_CODIGO = $avaliacao AND usuario_CODIGO = $user_codigo ORDER BY CODIGO ASC LIMIT 1";
				      			$query_nota = mysqli_query($con, $sql);
				      			if (mysqli_num_rows($query_nota) == 0) {
				      				?>
				      					<a href="prova.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-outline-primary">Acessar prova</a>
				      				<?php
				      			}else{
					      			$row_nota = mysqli_fetch_array($query_nota);
					      			if ($row_nota['NOTA'] <= 10) {
						      			?>
						      				<button class="btn btn-success">Nota <?php echo $row_nota['NOTA']?></button>
						      			<?php
						      		}
						      	}
				      		}else{
				      			$avaliacao = $row['CODIGO'];
				      			$sql = "SELECT NOTA FROM avaliacao_has_usuario WHERE avaliacao_CODIGO = $avaliacao AND usuario_CODIGO = $user_codigo ORDER BY CODIGO ASC LIMIT 1";
				      			$query_nota = mysqli_query($con, $sql);
				      			$row_nota = mysqli_fetch_array($query_nota);
				      			if ($row_nota['NOTA'] <= 10) {
					      			?>
					      				<button class="btn btn-success">Nota <?php echo $row_nota['NOTA']?></button>
					      			<?php
					      		}
				      		}
				      	?>
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
<?php
}else{
	$page = "404";
	include_once('../content/banner.php');
	include_once('../content/404.php');
}
	include_once('../content/footer.php');
?>