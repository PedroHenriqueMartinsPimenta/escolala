<?php
	include_once('content/header.php');
	include_once('content/banner.php');
	include_once('controller/conexao.php');
?>
<style type="text/css">
	#estado{
		font-size: 50px;
		font-weight: bolder;
		text-align: center;
	}
</style>
<div class="row">
	<div class="col-12">
		<h3>Alguns de nossos recursos!</h3>
	</div>
</div>

<div class="row mt-5">
	<div class="col-md-3 mb-3" style="text-align: center">
		<img src="images/boletim.png" width="40%">
		<h4 style="font-weight: bolder; padding: 2px">Boletim escolar</h4>
	</div>

	<div class="col-md-3 mb-3" style="text-align: center">
		<img src="images/frequencia.png" width="40%">
		<h4 style="font-weight: bolder; padding: 2px">Frequência escolar</h4>
	</div>

	<div class="col-md-3 mb-3" style="text-align: center">
		<img src="images/livro.png" width="40%">
		<h4 style="font-weight: bolder; padding: 2px">Material didático</h4>
	</div>

	<div class="col-md-3 mb-3" style="text-align: center">
		<img src="images/hora.png" width="40%">
		<h4 style="font-weight: bolder; padding: 2px">Horário escolar</h4>
	</div>
</div>

<div class="row mt-4">
	<div class="col-12">
		Alguns estados que nós já atuamos:
	</div>
</div>

<div class="row mt-2">
	<?php
		$sql = "SELECT ESTADO FROM escola GROUP BY ESTADO";
		$query = mysqli_query($con, $sql);
		echo mysqli_error($con);
		while ($row = mysqli_fetch_array($query)) {
			?>
			<div class="col-md-3 card mt-2" id="estado">
				<div class="card-body"><?php echo strtoupper($row['ESTADO'])?></div>
			</div>
			<?php
		}
	?>
</div>

<div class="row mt-4">
	<div class="col-12">
		<h3><ins><i>O que somos?</i></ins></h3>
	</div>
</div>

<div class="row mt-2">
	<div class="col-md-6 mt-2">
		<div class="card">
			<div class="card-body">
				Nós somos um website que foi desenvolvido para ajudar o sistema educacional, público ou privado, nestes tempos em que é necessário tornamos cada dia mais digitais!
			</div>
		</div>
	</div>

	<div class="col-md-6 mt-2">
		<div class="card">
			<div class="card-body">
				Nós oferecemos um sistema de administração escolar <b>gratuito</b> para que vocês possam integra-se ao avanço da tecnologia! venha <b>dominar</b> <?php echo date('Y')?> junto conosco!
			</div>
		</div>
	</div>
</div>

<div class="row mt-5">
	<div class="col-12">
		<h3>Por que é tão importante a <b>tecnologia</b> nas <i>escolas</i>?</h3>
	</div>
</div>

<div class="row mt-3">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				Você já deve ter parado para pensar como as coisas avançaram de 1994 até <?php echo date("Y")?>, né?<br> 
				Da geração de 1994 até a de <?php echo date("Y")?> é tida como a geração da tecnologia, em que já nascem sendo integrados, familiarizados, com esta tecnologia! <br> 
				E a instituição de ensino com seu papel primordial de formação de indivíduos, deve demostrar a importância da tecnologia em <?php echo date('Y')?> adiante, como sendo o domínio das tecnologias algo primordial!

			</div>
		</div>
	</div>
</div>
<?php
	include_once('content/footer.php');
?>