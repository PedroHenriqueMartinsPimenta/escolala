<?php
	session_start();
	if (isset($_SESSION['email'])) {
		
			if($_SESSION['permissao'] == 0){
				$home = $url . "aluno/";
			}else if($_SESSION['permissao'] == 1){
				$home = $url . "professor/";
			}else if($_SESSION['permissao'] == 2){
				$home = $url . "admin/";
			}
	}
	function nav($url){
		if (isset($_SESSION['email'])) {
			if($_SESSION['permissao'] == 0){
				?>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/">Página inicial</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/horarios.php">Horários</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/avaliacoes.php">Avaliações</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/atividades.php">Atividades</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/boletim.php">Boletim</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/frequencia.php">Frequência</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/dados_pessoais.php">Dados pessoais</a></li>	
				<?php
			}else if($_SESSION['permissao'] == 1){
				?>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/">Página inicial</a></li>	
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/frequencia.php">Frequência</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/avaliacoes.php">Avaliações</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/horarios.php">Horários</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/atividades.php">Atividades</a></li>	
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/turmas.php">Turmas</a></li>	
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/avisos.php">Avisos</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/dados_pessoais.php">Dados pessoais</a></li>	
				<?php
			}else if($_SESSION['permissao'] == 2){
				?>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/">Página inicial</a></li>	
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/horarios.php">Horários</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/periodos.php">Períodos escolares</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/professores.php">Professores</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/admins.php">Administradores</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/alunos.php">Alunos</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/materias.php">Matérias</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/turmas.php">Turmas</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/aulas.php">Aulas</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/avisos.php">Avisos</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/dados_pessoais.php">Dados pessoais</a></li>	
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/init.php">Primeiros passos</a></li>					
				<?php
			}
			?>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>controller/sair.php">Sair</a></li>
			<?php
		}else{
			?>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>">Página inicial</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>blog/">Blog</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>login.php">Login</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>cadastro.php">Cadastre-se</a></li>
			<?php
		}
	}

	function nav_mobile($url){
		if (isset($_SESSION['email'])) {
			if($_SESSION['permissao'] == 0){
				?>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/">Página inicial</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/horarios.php">Horários</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/avaliacoes.php">Avaliações</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/atividades.php">Atividades</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/boletim.php">Boletim</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/frequencia.php">Frequência</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>aluno/dados_pessoais.php">Dados pessoais</a></li>		
				<?php
			}else if($_SESSION['permissao'] == 1){
				?>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/">Página inicial</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/frequencia.php">Frequência</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/avaliacoes.php">Avaliações</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/horarios.php">Horários</a></li>	
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/atividades.php">Atividades</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/turmas.php">Turmas</a></li>	
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/avisos.php">Avisos</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>professor/dados_pessoais.php">Dados pessoais</a></li>		
				<?php
			}else if($_SESSION['permissao'] == 2){
				?>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/">Página inicial</a></li>	
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/horarios.php">Horários</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/periodos.php">Períodos escolares</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/professores.php">Professores</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/admins.php">Administradores</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/alunos.php">Alunos</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/materias.php">Matérias</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/turmas.php">Turmas</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/aulas.php">Aulas</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/avisos.php">Avisos</a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/dados_pessoais.php">Dados pessoais</a></li>	
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>admin/init.php">Primeiros passos</a></li>				
				<?php
			}
			?>
					<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>controller/sair.php">Sair</a></li>		
			<?php
		}else{
			?>
					<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>">Página inicial</a></li>
					<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>blog/">Blog</a></li>
					<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>login.php">Login</a></li>
					<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-39"><a href="<?php echo $url?>cadastro.php">Cadastre-se</a></li>
			<?php
		}
	}
?>