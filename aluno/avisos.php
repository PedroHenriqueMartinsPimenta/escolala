<?php
	$page = "Avisos";
	include_once('../content/header.php');
	include_once('../controller/conexao.php');
if (isset($_SESSION['email']) && $_SESSION['permissao'] == 0) {
	$escola_codigo = $_SESSION['escola_codigo'];
	include_once('../content/banner.php');

?>		
<h3>Avisos</h3>
<div class="row"> 
	<div class="col-md-4"> 
		<button class="btn btn-primary col-12 mb-2" onclick="action()" id="button">Adicionar novo</button>
	</div>
</div>
<div class="row" style="display: none" id="model"> 
	<div class="col-12"> 
		<form action="../controller/avisos_aluno.php?id=1" method="post"> 
			<div class="row">
				<div class="col-md-12">
					<label>Mensagem: <span id="required">*</span></label>
					<textarea name="mensagem" class="form-control" required></textarea>					
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<label>Tipo de aviso: <span id="required">*</span></label>
					<select name="type" class="form-control" required>
						<option value="0">Aviso simples</option>
						<option value="1">Aviso de advertência</option>
						<option value="2">Aviso de urgência</option>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<label>Destinatários: <span id="required">*</span></label>
					<br>

					<input type="radio" name="destinatario" class="form-control" value="0" onchange="inputChange(this)" id="todos"> 
					<label for="todos">Todos</label>
					<br>

					<input type="radio" name="destinatario" class="form-control" value="1" onchange="inputChange(this)" id="admin"> 
					<label for="admin">Administradores</label>
					<br>

					<input type="radio" name="destinatario" class="form-control" value="2" onchange="inputChange(this)" id="professores"> 
					<label for="professores">Professores</label>
					<br>

					<input type="radio" name="destinatario" class="form-control" value="3" onchange="inputChange(this)" id="adm_prof"> 
					<label for="adm_prof">Administradores e professores</label>
					<br>

					<input type="radio" name="destinatario" class="form-control" value="4" onchange="inputChange(this)" id="alunos"> 
					<label for="alunos">Todos os alunos</label>
					<br>

					<input type="radio" name="destinatario" class="form-control" value="5" onchange="inputChange(this)" id="aluno"> 
					<label for="aluno">Aluno específico</label>
					<br>


					<input type="radio" name="destinatario" class="form-control" value="6" onchange="inputChange(this)" id="turma"> 
					<label for="turma">Turma específica </label>
					<br>
				</div>
			</div>

			<div class="row" id="turma_select" class="form-control" style="display: none">
				<div class="col-md-12">
					<label>Selecione a turma</label>
					<select name="turma_select" class="form-control">
						<?php 
							$sql = "SELECT turma.CODIGO, turma.NOME FROM turma INNER JOIN usuario_has_turma ON turma.CODIGO = usuario_has_turma.turma_CODIGO INNER JOIN usuario ON usuario.CODIGO = usuario_has_turma.usuario_CODIGO WHERE usuario.escola_CODIGO = $escola_codigo GROUP BY turma.CODIGO ORDER BY turma.NOME ASC";
							$query = mysqli_query($con, $sql);
							while ($row = mysqli_fetch_array($query)) {
								?>
								<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
								<?php
							}
						?>
					</select>
				</div>
			</div>

			<div class="row" id="aluno_select" class="form-control" style="display: none;">
				<div class="col-md-12">
					<label>Selecione o aluno: </label>
					<select name="aluno_select" class="form-control">
						<?php
							$sql = "SELECT * FROM usuario WHERE escola_CODIGO = $escola_codigo AND PERMISSAO = 0 AND ATIVO = 1";
							$query = mysqli_query($con, $sql);
							while ($row = mysqli_fetch_array($query)) {
								?>
									<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></option>
								<?php
							}
						?>
					</select>
				</div>
			</div>	
			<hr>
			<div class="row">
				<div class="col-md-12">
					<input type="checkbox" name="email" class="form-control" id="email">
					<label for="email">Enviar E-mail notificando o aviso</label>
				</div>
			</div>
			<input type="submit" value="Adicionar" class="btn btn-success mt-2">	
		</form>
	</div>	
</div>		
<div style="overflow: auto"> 
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Código</th>
	      <th scope="col">Mensagem</th>
	      <th scope="col">Destinátarios</th>
	      <th scope="col">Data</th>
	      <th scope="col">Tipo de aviso</th>
	      <th scope="col">Envio de E-mail</th>
	      <th scope="col">Remover</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		$user_codigo = $_SESSION['codigo'];
	  		$sql = "SELECT aviso.CODIGO, aviso.MESSAGE, aviso.DATA, aviso.TYPE, aviso.EMAIL FROM aviso INNER JOIN aviso_has_usuario ON aviso.CODIGO = aviso_has_usuario.aviso_CODIGO INNER JOIN usuario ON usuario.CODIGO = aviso_has_usuario.usuario_CODIGO WHERE usuario.escola_CODIGO = $escola_codigo AND aviso.usuario_CODIGO = $user_codigo GROUP BY aviso.CODIGO ORDER BY aviso.DATA DESC";
	  		$query = mysqli_query($con, $sql);
	  		if (mysqli_num_rows($query) > 0) {
	  			while ($row = mysqli_fetch_array($query)) {
	  				?>
	  				<tr>
				      <th scope="row"><?php echo $row['CODIGO']?></th>
				      <td><?php echo substr($row['MESSAGE'], 0, 200)?></td>
				      <td><button onclick="destinatario(<?php echo $row['CODIGO']?>)" class="btn btn-outline-primary">Destinatários</button></td>
				      <td><?php echo substr($row['DATA'], 0, 200)?></td>
				      <td>
				      		<?php
				      			if ($row['TYPE'] == 0) {
				      				echo "<span style='color: green'>Aviso simples</span>";
				      			}else if ($row['TYPE'] == 1) {
				      				echo "<span style='color: orange'>Aviso de advertência</span>";
				      			}else if ($row['TYPE'] == 2) {
				      				echo "<span style='color: red'>Aviso de urgência</span>";
				      			}
				      		?>
				      </td>
				      <td>
				      		<?php
				      			if ($row['EMAIL'] == 0) {
				      				echo "Não enviou E-mail";
				      			}else if ($row['EMAIL'] == 1) {
				      				echo "Enviou E-mail";
				      			}
				      		?>
				      </td>
				      <td>
				      	<button class="btn btn-outline-danger" onclick="remover(<?php echo $row['CODIGO']?>)">
				      		Remover
					    </button>
					  </td>
				    </tr>
	  				<?php
	  			}
	  		}else {
	  			?>
			    <tr>
			      <th scope="row" colspan="3">Nenhuma turma cadastrada ainda!</th>
			    </tr>

	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>
<style>
	#modal{
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}
	.back{
		position: fixed;
		top: 0px;
		left: 0px;
		width: 100%;
		height: 100%;
		display: none;
		background:rgba(20, 20, 20, 0.5);
	}
</style>
<div class="row"> 
	<div class="col-12"> 
		<div class="back"> 
		</div>
		<div class="modal col-md-7" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Destinatários</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="modal_close()">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		       
		      </div>
		    </div>
		  </div>
		</div>
	</div>	
</div>	
<script type="text/javascript">
	function inputChange(input){
		var value = input.value;
		if (value == 6) {
			$("#turma_select").fadeIn('slow');
			$("#aluno_select").hide();
		}else if (value == 5){
			$("#turma_select").hide();
			$("#aluno_select").fadeIn('slow');
		}else{
			$("#turma_select").hide();
			$("#aluno_select").hide();
		}
	}
	function remover(codigo){
		var confirm = window.confirm("Isto removerá este aviso do mural!");
		if (confirm) {
			window.location.href = '../controller/avisos_aluno.php?id=2&&codigo=' + codigo
		}
	}
	function destinatario(codigo){
		$.post(
			"../controller/avisos_aluno.php?id=3",
			{codigo: codigo},
			function(result){
				var txt = "";
				for(index in result){
					txt += index + " : "+result[index]["NOME"] + " - " + result[index]["EMAIL"] + "<br><hr>";
				}
				$('.modal-body').html(txt);
				$('#modal').fadeIn('slow');
				$('.back').fadeIn('slow');
			}, 
			'JSON'
			);
	}
	function modal_close(){
		$('#modal').fadeOut('slow');
		$('.back').fadeOut('slow');
	}
</script>
<?php
}else{
	$page = "404";
	include_once('../content/banner.php');
	include_once('../content/404.php');
}
	include_once('../content/footer.php');
?>