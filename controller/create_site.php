<?php
	session_start();
	if (isset($_SESSION['email'])) {
		if ($_SESSION['permissao'] == 2) {
			include_once('conexao.php');
			include_once('../content/config.php');
			$codigo = $_SESSION['escola_codigo'];
			$sql = "SELECT * FROM escola WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$nome =  random_int(0, 999999999) . "_" . str_replace(" ", "_", $row['NOME']);
			$result = mkdir('../site/'.$nome, 0777, true);
			$link = $url . "site/" . $nome . "/";
			copy("../wordpress/wordpress.zip", "../site/".$nome."/wordpress.zip");
			$zip = new ZipArchive();
			echo "Extraindo arquivos...<br>";
			set_time_limit(600);
			if ($zip->open('../site/'.$nome.'/wordpress.zip') === TRUE) {
			    $zip->extractTo('../site/'.$nome.'/');
			    $zip->close();
			    echo 'Arquivos extraidos!';
			} else {
			    echo 'failed';
			}
			?>
				<script type="text/javascript">
					window.location.href = "insert_link.php?link=<?php echo $link?>"
				</script>
			<?php
		}else{
			$_SESSION['error'] = "Você não tem permissão de acessar esta área!";
			header('location: ../');
		}
	}else{
		$_SESSION['error'] = "Efetue o login";
		header('location: ../login.php');
	}
?>