	<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content - type" content="text/html" charset = "UTF-8">
		<meta name="RodC & MatG">
		<link rel="stylesheet" href="../assets/css/css.css"/>
		
    	
		<title>Tela de login</title>
	</head>
	<body id="login">
		<div class="formulario">
			<img src="../imagens/GoWork-logo-min.png">
			<form action="../function/cliente.php" method="post">
				<div class="login">
					<h4>Login</h4>
					<input type="text" name="login" required placeholder="Endereço de e-mail ou nome do usuário" class="form">
				</div>
				<div class="senha">
					<h4>Senha</h4>
					<input type="password" required name="senha" placeholder="Senha" class="form" >
				</div>
				<br>
				<div class="lembre" align="left">
					<input type="checkbox" name="lembre" value="xxx"> <label>Lembrar-me</label>
				</div>
				<br>
				<?php
					if (isset($_SESSION['nao_aut'])): //Dando erro, veificar
				?>
				<p>Erro: Usuário ou senha inválidos</p>
				<?php
				endif;
				unset($_SESSION['nao_aut']);
				?>
				<input type="submit" name="submit" value="ENTRAR" class="botao">

				<hr>
				<h4><b>Não é registrado ? <a href="../page/cadastro.php">Clique Aqui</a></b></h4>
			</form>
		</div>
	</body>
</html>