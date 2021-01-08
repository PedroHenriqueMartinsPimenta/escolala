<?php
	include_once('conexao.php');
	session_start();
	if($_GET['id'] == 4){
		$_SESSION['email'] = "...";
	}
	if (isset($_SESSION['email'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			//Adicionar professor
			$nome = $_POST['nome'];
			$sobrenome = $_POST['sobrenome'];
			$email = $_POST['email'];
			$email_secundario = $_POST['email_secundario'];
			$rua = $_POST['rua'];
			$complemento = $_POST['complemento'];
			$bairro = $_POST['bairro'];
			$cidade = $_POST['cidade'];
			$estado = $_POST['estado'];
			$senha = md5($_POST['senha']);
			$escola_codigo = $_GET['escola_codigo'];
			$permissao = 1;

			$sql = "INSERT INTO usuario (NOME, SOBRENOME, EMAIL, EMAIL_SECUNDARIO, RUA, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, SENHA, PERMISSAO, escola_CODIGO) VALUES ('$nome', '$sobrenome', '$email', '$email_secundario', '$rua', '$complemento', '$bairro', '$cidade', '$estado', '$senha', $permissao, $escola_codigo)";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Professor cadastrado com sucesso!";
				header('location: ../admin/professores.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/professores.php');
			}
		}else if ($id == 2){
			//desativar / ativar
			$codigo = $_GET['codigo'];
			$ativo = $_GET['ativo'];
			$sql = "UPDATE usuario SET ATIVO = $ativo WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				if ($ativo == 1) {
					$_SESSION['success'] = "Professor ativado com sucesso!";
				}else{
					$_SESSION['success'] = "Professor desativado com sucesso!";
				}
				header('location: ../admin/professores.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/professores.php');				
			}
		}else if ($id == 3){
			//editar
			$codigo = $_GET['codigo'];
			$nome = $_POST['nome'];
			$sobrenome = $_POST['sobrenome'];
			$email = $_POST['email'];
			$email_secundario = $_POST['email_secundario'];
			$rua = $_POST['rua'];
			$complemento = $_POST['complemento'];
			$bairro = $_POST['bairro'];
			$cidade = $_POST['cidade'];
			$estado = $_POST['estado'];
			$permissao = $_POST['permissao'];
			$sql = "UPDATE usuario SET NOME = '$nome', SOBRENOME = '$sobrenome', EMAIL = '$email', EMAIL_SECUNDARIO = '$email_secundario', RUA = '$rua', COMPLEMENTO = '$complemento', BAIRRO = '$bairro', CIDADE = '$cidade', ESTADO = '$estado', PERMISSAO = $permissao WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['success'] = "Dados atualizados com sucesso!";
				header('location: ../admin/professores.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				header('location: ../admin/professores.php');				
			}

		}else if ($id == 4){
			//Adicionar professor pelo link
			$nome = $_POST['nome'];
			$sobrenome = $_POST['sobrenome'];
			$email = $_POST['email'];
			$email_secundario = $_POST['email_secundario'];
			$rua = $_POST['rua'];
			$complemento = $_POST['complemento'];
			$bairro = $_POST['bairro'];
			$cidade = $_POST['cidade'];
			$estado = $_POST['estado'];
			$senha = md5($_POST['senha']);
			$escola_codigo = $_GET['escola_codigo'];
			$permissao = 1;

			$sql = "INSERT INTO usuario (NOME, SOBRENOME, EMAIL, EMAIL_SECUNDARIO, RUA, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, SENHA, PERMISSAO, escola_CODIGO) VALUES ('$nome', '$sobrenome', '$email', '$email_secundario', '$rua', '$complemento', '$bairro', '$cidade', '$estado', '$senha', $permissao, $escola_codigo)";
			$query = mysqli_query($con, $sql);
			unset($_SESSION['email']);
			if ($query) {
				$_SESSION['success'] = "Efetue o login";
				header('location: ../login.php');
			}else{
				$_SESSION['error'] = mysqli_error($con);
				?>
				<script type="text/javascript">
					history.go(-1);
				</script>
				<?php
			}
		}
	}else{
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			if ($id == 4){
				//Adicionar professor pelo link
				$nome = $_POST['nome'];
				$sobrenome = $_POST['sobrenome'];
				$email = $_POST['email'];
				$email_secundario = $_POST['email_secundario'];
				$rua = $_POST['rua'];
				$complemento = $_POST['complemento'];
				$bairro = $_POST['bairro'];
				$cidade = $_POST['cidade'];
				$estado = $_POST['estado'];
				$senha = md5($_POST['senha']);
				$escola_codigo = $_GET['escola_codigo'];
				$permissao = 1;

				$sql = "INSERT INTO usuario (NOME, SOBRENOME, EMAIL, EMAIL_SECUNDARIO, RUA, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, SENHA, PERMISSAO, escola_CODIGO) VALUES ('$nome', '$sobrenome', '$email', '$email_secundario', '$rua', '$complemento', '$bairro', '$cidade', '$estado', '$senha', $permissao, $escola_codigo)";
				$query = mysqli_query($con, $sql);
				unset($_SESSION['email']);
				if ($query) {
					$_SESSION['success'] = "Efetue o login";
					header('location: ../login.php');
				}else{
					$_SESSION['error'] = mysqli_error($con);
					?>
					<script type="text/javascript">
						history.go(-1);
					</script>
					<?php
				}
			}
		}else{
			$_SESSION['error'] = "Permissão necessaria!";
			header('location:../');
		}
	}
?>