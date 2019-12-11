<?php
session_start();
include('../function/conexao.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GoWork</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--Não Consegui linka ele por arquivos fisicos, verificar-->
		<link rel="stylesheet" type="text/css" href="../assets/css/css.css">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
		<link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
		<style>
		/* Remove the navbar's default margin-bottom and rounded borders */
		.navbar {
		margin-bottom: 0;
		border-radius: 0;
		color: white;
		}
		
		/* Add a gray background color and some padding to the footer */
		footer {
		background-color: #f2f2f2;
		padding: 25px;
		margin-top: 50px;
		}
		
		.carousel-inner img {
		width: 100%; /* Set width to 100% */
		margin: auto;
		min-height:200px;
		}
		/* Hide the carousel text when the screen is less than 600 pixels wide */
		@media (max-width: 600px) {
		.carousel-caption {
		display: none;
		}
		}
		.jumbotron {
		background-color: #005487;
		color: #fff;
		}
		.navbar-brand {
		height: 80px;
		}
		.logo >li >a {
		padding-top: 30px;
		padding-bottom: 30px;
		}
		.navbar-toggle {
		padding: 10px;
		margin: 25px 15px 25px 0;
		}
		</style>
	</head>
	<body>
		<div class="container container-fluid">
			<div class="row content">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<br><br>
					<img src="../imagens/GoWork-logo.png" style="width: 40%; margin-left: 22%">
					<br><br>
					<?php
						if (isset($_SESSION['erro']) && $_SESSION['erro'] == 'cpf'):?>
						<div class="alert alert-danger" role="alert" align="center">
							CPF inválido
						</div>
						<?php
						unset($_SESSION['erro']);
						endif;
						if (isset($_SESSION['senha_n'])):?>
						<div class="alert alert-danger" role="alert" align="center">
							Senhas não coincidem
						</div>
						<?php
						unset($_SESSION['senha_n']);
						endif;
						?>
					<form action="../function/cliente.php" method="post">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="inputEmail4">Nome</label>
								<input type="text" name="nome" class="form-control" placeholder="Primeiro Nome" required>
							</div>
							<div class="form-group col-md-4">
								<label for="inputPassword4">Sobrenome</label>
								<input type="text" name="sobren" class="form-control" placeholder="Segundo Nome" required>
							</div>
							<div class="form-group col-md-4">
								<label for="inputPassword4">Usuário</label>
								<input type="text" name="usuario" class="form-control" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputPassword6">Email</label>
								<input type="email" name="email" class="form-control" placeholder="example@example.com" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputPassword6">Senha </label><small id="passwordHelpInline" class="text-muted">   Deve ter entre 8 e 20 caracteres.</small>
								<input type="password" name="senha" class="form-control mx-sm-3" aria-describedby="passwordHelpInline"
								placeholder="insira aqui sua senha" required>
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword6">Insira sua senha novamente</label>
								<input type="password" name="senha2" class="form-control mx-sm-3" aria-describedby="passwordHelpInline"
								placeholder="insira aqui sua senha novamente" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputEmail4">CPF</label>
								<input type="text" class="form-control cpf" name="cpf" id="cpf" placeholder="000.000.000-00" required>
							</div>
							<div class="form-group col-md-6">
								<label for="inputEstado">Sexo</label>
								<select id="inputEstado" name="sexo" class="form-control" required>
									<option selected value="M">Masculino</option>
									<option value="F">Feminino</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputEmail4">Telefone</label>
								<input type="text" name="telefone" id="telefone" placeholder="(00) 0000-0000" class="form-control telefone" required>
							</div>
							<div class="form-group col-md-6">
								<label for="inputEstado">Celular</label>
								<input type="text" name="celular" id="celular" placeholder="(00) 00000-0000" class="form-control celular" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								<a href="login.php">voltar</a>
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-primary" name="cadastrar">Cadastrar</button>
							</div>
						</div><br><br><br>
				

					</form>
					<script type="text/javascript">
					$("#celular").mask("(00) 00000-0000");
					$(".celular").mask("(00) 00000-0000");
					$("#telefone").mask("(00) 0000-0000");
					$(".telefone").mask("(00) 0000-0000");
					$("#cpf").mask("000.000.000-00");
					$(".cpf").mask("000.000.000-00");
					</script>
				</div>
			</div>
		</div>
		
	</body>
</html>