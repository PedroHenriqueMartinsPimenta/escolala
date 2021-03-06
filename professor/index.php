<?php
	$page = "Mural";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
	if (isset($_SESSION['email']) && $_SESSION['permissao'] == 1) {
		$codigo = $_SESSION['codigo'];
		include_once('../content/banner.php');
	?>
	<style>
		.urgencia{
			box-shadow: 2px 2px 20px rgba(240, 50, 50, 1);
		}
		.simples{
			box-shadow: 2px 2px 20px rgba(50, 240, 50, 1);
		}
		.advertencia{
			box-shadow: 2px 2px 20px rgba(255, 218, 0, 1);
		}
		.card-header{
			background-color: transparent;
		}
		#button_alert{
			position: fixed;
			bottom: 10px;
			right: 10px;
			box-shadow: 2px 2px 20px rgba(50, 240, 50, 1);
			transition: 0.25s;
			animation: animacao_btn 1s infinite alternate;
			padding: 15px;
			z-index: 9999;
		}
		@keyframes animacao_btn{
			0%{
				box-shadow: 2px 2px 20px rgba(50, 240, 50, 1);
			}
			100%{
				box-shadow: 2px 2px 20px rgba(240, 50, 50, 1);
			}
		}
	</style>
	<h3>Mural</h3>
	<a href="https://mpago.la/31caaub" target="_blank" title="Nós da Escolalá temos muitas contas a pagar :( e precisamos de sua ajuda para mantermos o padrão de qualidade" id="button_alert" class="btn btn-success">doe R$ 4,99</a>
	<?php
		$sql = "SELECT * FROM aviso INNER JOIN aviso_has_usuario ON aviso.CODIGO = aviso_has_usuario.aviso_CODIGO INNER JOIN usuario ON aviso.usuario_CODIGO = usuario.CODIGO WHERE aviso_has_usuario.usuario_CODIGO = $codigo OR aviso.usuario_CODIGO = $codigo GROUP BY aviso.CODIGO ORDER BY aviso.DATA DESC";
		$query = mysqli_query($con, $sql);
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_array($query)) {
				if ($row['TYPE'] == 0) {
					?>
						<div class="row mb-5">
							<div class="col-12">
								<div class="card simples">
									<div class="card-header" style="font-weight: bold"> 
										<?php
											echo $row['NOME'] . " " . $row['SOBRENOME'] . " (" . $row['DATA'] . ")"
										?>
									</div>
									<div class="card-body"> 
											<?php echo $row['MESSAGE']?>
									</div>		
								</div>	
							</div>	
						</div>
					<?php
				}else if ($row['TYPE'] == 1) {
					?>
						<div class="row mb-5">
							<div class="col-12">
								<div class="card advertencia">
									<div class="card-header" style="font-weight: bold"> 
										<?php
											echo $row['NOME'] . " " . $row['SOBRENOME'] . " (" . $row['DATA'] . ")"
										?>
									</div>
									<div class="card-body"> 
											<?php echo $row['MESSAGE']?>
									</div>		
								</div>	
							</div>	
						</div>
					<?php
				}else if ($row['TYPE'] == 2) {
					?>
						<div class="row mb-5">
							<div class="col-12">
								<div class="card urgencia">
									<div class="card-header" style="font-weight: bold"> 
										<?php
											echo $row['NOME'] . " " . $row['SOBRENOME'] . " (" . $row['DATA'] . ")"
										?>
									</div>
									<div class="card-body"> 
											<?php echo $row['MESSAGE']?>
									</div>		
								</div>	
							</div>	
						</div>
					<?php
				}
			}
		}else{
			?>
				<div class="row mb-5">
					<div class="col-12">
						<div class="card simples">
							<div class="card-header"> 
								Nenhum aviso no mural ainda!
							</div>		
						</div>	
					</div>	
				</div>
			<?php
		}
	?>	
	<div style="height: 100px"></div>
	<?php
	}else{
		$page = "404";
		include_once('../content/banner.php');
		include_once('../content/404.php');
	}
	include_once('../content/footer.php');
?>