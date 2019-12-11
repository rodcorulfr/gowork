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
		
		
		<title>Autenticação de conta</title>
	</head>
	<body id="login">
		<div class="formulario">
			<form action="../function/profissional.php" method="post"><br>
				<div class="email">
					<b style="color: #fff;">Foi enviado para seu e-mail o código de verificação.</b><br><br>
					<b style="color: #fff;">Inserir no campo abaixo.</b><br>
					<input type="text" name="codigo" id="cod" required placeholder=" Insira o código de verificação" class="form">
					<a class="btn btn-link" href="../function/profissional.php?codaut=1" role="button">Enviar novamente</a>
				</div>
				<?php
					if (isset($_SESSION['email_aut_t'])){
				?>
				<div class="alert alert-success" role="alert">
					E-mail enviado com sucesso
					Caso demore a chegar, verifique a caixa de SPAM
				</div>
				<?php
					unset($_SESSION['email_aut_t']);
				}
				if (isset($_SESSION['n_aut_pro'])) {
					header('Location: ../function/profissional.php?codaut=1');
					unset($_SESSION['n_aut_pro']);
				}
				?>
				<input type="submit" name="validarAut" value="SALVAR" class="botao">
			</form>
		</div>
	</body>
</html>