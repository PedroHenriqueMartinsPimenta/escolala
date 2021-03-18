<?php
	session_start();
	if (isset($_SESSION['email']) && $_SESSION['permissao'] == 1) {
		include_once('../controller/conexao.php');
		$data = $_GET['data'];
		$turma_codigo = $_GET['turma'];
		$code_mes = intval(substr($data, 5, 2));
		$ano = substr($data, 0, 4);
		$mes = array('', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
		$escola_codigo = $_SESSION['escola_codigo'];
		$sql = "SELECT * FROM escola WHERE CODIGO = $escola_codigo";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$escola = $row['NOME'];

		$sql = "SELECT * FROM turma WHERE CODIGO = $turma_codigo";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$turma = $row['NOME'];

		?>

		<!DOCTYPE html>
		<html>
		<head>
			<title>Frequência de <?php echo $mes[$code_mes]?></title>
			<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
			<style>
				td{padding: 10px}
				button{
					margin: 10px;
				}
			</style>
		</head>
		<body>
		<button class="btn btn-primary" onclick="imprimir(this)">Imprimir</button>
		<div align="center"> 
			<table border="1" style="text-align: center">
			<thead>
				<tr> 
					<td colspan="33"><b>Frequência de <?php echo $mes[$code_mes]?></b></td>
				</tr>
				<tr> 
					<td colspan="11"><b>Escola:</b> <?php echo $escola?></td>
					<td colspan="11"><b>Ano:</b> <?php echo $ano?></td>
					<td colspan="11"><b>Turma:</b> <?php echo $turma?></td>
				</tr>
				<tr> 
					<td colspan="33"><b>Professor(a):</b> <?php echo $_SESSION['nome'] . " " . $_SESSION['sobrenome']?></td>
				</tr>
				<tr> 
					<th>ID</th>
					<th>Nome</th>
					<?php
						for ($i=1; $i <= 31; $i++) { 
							?>
								<th><?php echo $i?></th>
							<?php
						}
					?>
				</tr>
			</thead>

			<tbody>
				<?php
					$i = 1;
					$sql = "SELECT * FROM usuario INNER JOIN usuario_has_turma ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO WHERE usuario_has_turma.turma_CODIGO = $turma_codigo AND usuario_has_turma.STATUS = 1 AND usuario.ATIVO = 1 AND usuario.PERMISSAO = 0 ORDER BY CONCAT(NOME, SOBRENOME) ASC";
					$query = mysqli_query($con, $sql);
					while($row = mysqli_fetch_array($query)){
						$codigo = $row['CODIGO'];
						$nome = $row['NOME'] . " " . $row['SOBRENOME'];
						?>
							<tr>
								<th><?php echo $codigo;?></th>
								<th><?php echo $nome?></th>
								<?php
									for ($a=1; $a <= 31; $a++) { 
										$sql = "SELECT * FROM frequencia WHERE usuario_CODIGO = $codigo AND YEAR(DATA) = $ano AND MONTH(DATA) = $code_mes AND DAY(DATA) = $a";

										$query_frequencia = mysqli_query($con, $sql);
										if (mysqli_num_rows($query_frequencia) > 0) {
											?>
												<td style="font-weight: bolder; color: green">P</td>
											<?php
										}else{
											?>
												<td style="font-weight: bolder; color: red">F</td>
											<?php
										}
									}
								?>
							</tr>
						<?php
						$i++;
					}
				?>
				<tr>
					<td colspan="33" align="right" style="padding-top: 20px; font-size: 12px"><span style="text-align: center;">__________________________________________________________________________<br>Assinatura
					</span></td>
				</tr>
			</tbody>
		</table>	
		</div>
		<script>
			function imprimir(button){
				button.style.display = 'none';
				window.print();
				button.style.display = 'block';
			}
		</script>
		</body>
		</html>
		<?php
	}else{
		$_SESSION['error'] == "Login necessário!";
		header('location: ../');
	}
?>