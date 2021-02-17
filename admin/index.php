<?php
	$page = "Mural";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
	if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
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
	</style>
	<h3>Mural</h3>
	<div class="row mb-5">
		<div class="col-12">
			<div class="card simples">
				<div class="card-header" style="font-weight: bolder;">
					Precisamos de você!
				</div>
				<div class="card-body">
					Olá <?php echo $_SESSION['nome']?>, como você já sabe, nós somos uma plataforma gratuita, mas temos contas a pagar :( e queríamos sua ajuda para mantemos esse padrão de qualidade. Criamos uma <a href="http://vaka.me/1817596" target="_blank">Vakinha</a> para podermos pagar os serviços de hospedagem, se você poder contribuir ficaremos gratos! <br>
					OBS.: Essa mensagem somente aparece para professores e administradores.
				</div>
			</div>
		</div>
	</div>
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
	<?php
	}else{
		$page = "404";
		include_once('../content/banner.php');
		include_once('../content/404.php');
	}
	include_once('../content/footer.php');
?>