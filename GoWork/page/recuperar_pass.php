<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content - type" content="text/html" charset = "UTF-8">
		<meta name="RodC & MatG">
		<link rel="stylesheet" href="../assets/css/css.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
		
		
		<title>Recuperar Senha</title>
	</head>
	<body id="login">
		<div class="formulario">
			<img src="../imagens/logo_login.png">
			<form action="../function/global.php" method="post">
				<div class="email">
					<br><br>
					<b style="color: #fff;">Para que possamos enviar uma nova senha para seu email</b>
					<h4>Insira seu e-mail</h4>
					<input type="email" name="email" id="email" required placeholder="Endereço de e-mail ou nome do usuário" class="form">
				</div><br>
				<?php
					if (isset($_SESSION['senha_rec_c'])){
				?>
				<div class="alert alert-success" role="alert">
					E-mail enviado para redefinição
					Caso demore a chegar, verifique a caixa de SPAM
				</div>
				<?php
				unset($_SESSION['senha_rec_c']);
				}else if (isset($_SESSION['senha_rec_nop'])){
				?>
				<div class="alert alert-danger" role="alert">
					E-mail informado não encontrado
				</div>
				<?php
				unset($_SESSION['senha_rec_nop']);
				}else if (isset($_SESSION['senha_rec_2'])){
				?>
				<script>
						$(document).ready(function(){
							$('#modalExemplo').modal('show');
						});
				</script>
				<!-- Modal -->
				<?php
				unset($_SESSION['senha_rec_2']);
				}
				?>
				<input type="submit" name="recuperar_pass" value="ENVIAR" class="botao">
			</form>
			<a href="login.php">voltar</a>
		</div>
		<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
						</button>
						<h5 class="modal-title" id="TituloModalCentralizado">Escolher qual usuário redefir a senha</h5>
					</div>
					<div class="modal-body">
						<div class="row text-center">
							<div class="col-sm-6">
								<a href="../function/cliente.php?redsenha=1"><span class="glyphicon glyphicon-check" style="font-size: 50px;color: #337ab7;"></span></a>
								<h2>Cliente</h2>
							</div>
							<div class="col-sm-6">
								<a href="../function/profissional.php?redsenha=1"><span class="glyphicon glyphicon-list-alt" style="font-size: 50px;color: #337ab7;"></span></a>
								<h2>Profissional</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>