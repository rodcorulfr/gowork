<?php
session_start();

if (isset($_SESSION['lembre'])) {

  include('../function/conexao.php');
  $conexao = new conectar();

  $result = $conexao->getRead('profissional','email_pro', $_SESSION['email']);

  if ($result) {
  	header('Location: ../page/pro_inicio.php');
  }

  $result = $conexao->getRead('cliente','email_cli',$_SESSION['email']);

  if ($result) {
  	header('Location: ../page/cli_inicio.php');
  }

  unset($_SESSION['email']);

}


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
		
		
		<title>Tela de login</title>
	</head>
	<body id="login">
		<div class="imagengo">
			<div class="formulario">
				<img src="../imagens/GoWork-logo-min.png">
				<form action="../function/global.php" method="post" style="text-align: left;">
					<div class="login">
						<h5>Login</h5>
						<input type="text" name="login" required placeholder="Endereço de e-mail ou nome do usuário" class="form">
					</div>
					<div class="senha">
						<h5>Senha</h5>
						<input type="password" required name="senha" placeholder="Senha" class="form" >
					</div>
					<div class="lembre" align="left">
						<h5><input type="checkbox" name="lembre" value="xxx"><label>  Lembrar-me</label>
						<a href="recuperar_pass.php" style="color: #3333ff; float: right;"> Esqueceu sua senha?</a></h5>
					</div>
					<?php
						if (isset($_SESSION['nao_aut'])): //Dando erro, veificar
					?>
					<div class="alert alert-danger text-center" role="alert">
						Erro: Usuário ou senha inválidos
					</div>
					<?php
					endif;
					unset($_SESSION['nao_aut']);
					?>
					<?php
						if (isset($_SESSION['aut_dois'])):
					?>
					<script>
						$(document).ready(function(){
							$('#modalExemplo').modal('show');
						});
					</script>
					<!-- Modal -->
					<?php
					endif;
					unset($_SESSION['aut_dois']);
					?>
					<input type="submit" name="submit" value="ENTRAR" class="botao">
					<hr>
					<p style="color: #000; text-align: center;">Não tem conta? <b><a href="../page/cli_cadastro.php" style="color: #3333ff">CADASTRE-SE.</a></p></b>
					<p style="color: #000; text-align: center;">Quer trabalhar conosco ?<b><a href="../page/pro_cadastro.php" style="color: #3333ff"> Clique aqui</a></p></b>
				</form>
			</div>
		</div>
		<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
						</button>
						<h5 class="modal-title" id="TituloModalCentralizado">Escolher forma de login</h5>
					</div>
					<div class="modal-body">
						<div class="row text-center">
							<div class="col-sm-6">
								<a href="../function/global.php?user=1"><span class="glyphicon glyphicon-check" style="font-size: 50px;color: #337ab7;"></span></a>
								<h2>Cliente</h2>
							</div>
							<div class="col-sm-6">
								<a href="../function/global.php?user=2"><span class="glyphicon glyphicon-list-alt" style="font-size: 50px;color: #337ab7;"></span></a>
								<h2>Profissional</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>