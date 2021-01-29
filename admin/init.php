<?php
	$page = "Primeiros passos";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 2) {
	$escola_codigo = $_SESSION['escola_codigo'];
	include_once('../content/banner.php');

?>
<style type="text/css">
	ol{
		text-align: left;
	}
	ol li{
		padding: 10px;
		border-bottom: 1px solid rgba(20, 20, 20, 0.1);
	}
</style>
<h3>Primeiros passos</h3>
<div class="row mt-2">
	<div class="col-12">
		<ol>
			<li>Você deve cadastrar as aulas</li>
			<li>Você deve cadastrar os Periodos escolares</li>
			<li>Você deve adicionar as turmas</li>
			<li>Você deve adicionar os professores, pode utilizar o gerador de link para se cadastrem</li>
			<li>Agora você deve cadastrar as Matérias</li>
			<li>Agora você pode cadastrar os alunos/ matrícular, pode utilizar o gerador de link para se cadastrem</li>
			<li>Crie o horário escolar</li>
		</ol>
	</div>
</div>
<div class="row mt-4">
	<div class="col-12">
		<iframe width="560" height="315" src="https://www.youtube.com/embed/5ydSre9Aiws" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
</div>
<?php
}else{
	$page = "404";
	include_once('../content/banner.php');
	include_once('../content/404.php');
}
	include_once('../content/footer.php');
?>