<?php
	if (isset($_GET['escola'])) {
		include_once('controller/conexao.php');
		$escola = $_GET['escola'];
		$sql = "SELECT * FROM escola WHERE CODIGO = $escola";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$page = $row['NOME'];
		include_once('content/header.php');
		include_once('content/banner.php');
			?>
				<div class="row mt-2">
					<div class="col-12">
						<h2>Informações de contato</h2>
					</div>
				</div>
				<hr>
				<div class="row mt-2">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								Que tal um telefonema ou um WhatsApp ;)
							</div>
							<div class="card-body" style="text-align: center;">
								<a href="tel: <?php echo $row['TELEFONE']?>"><?php echo $row['TELEFONE']?></a>
							</div>
						</div>
					</div>


					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								Nós temos um E-mail também ;)
							</div>
							<div class="card-body" style="text-align: center;">
								<a href="mailto: <?php echo $row['EMAIL']?>"><?php echo $row['EMAIL']?></a>
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-12">
						<h2>Onde estamos ;)</h2>
					</div>
				</div>
				<hr>
				<div class="row mt-2">
					<div class="col-12">
						<a class="btn btn-success col-12" style="text-align: center; padding-top: 225px; padding-bottom: 225px; font-size: 30px; display: inline-block; position: relative;" href="https://www.google.com/maps/place/<?php echo $row['RUA']. ', ' . $row['BAIRRO'] . ', ' . $row['CIDADE'] . ', ' . $row['ESTADO']?>" target="_blank">Clique Aqui :D</a>
					</div>
				</div>

				
			<?php
		include_once('content/footer.php');
	}else{
		header('location: index.php');
	}
?>