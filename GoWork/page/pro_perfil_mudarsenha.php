<?php 
  
  session_start();
  include('../function/conexao.php');

  $conexao = new conectar();

  $tabela = 'profissional';
  $campo = 'usuario_pro';
  $id = $_SESSION['usuario'];

  $result = $conexao->getRead($tabela, $campo, $id);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>GoWork</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Não Consegui linka ele por arquivos fisicos, verificar-->
    <link rel="stylesheet" href="../assets/css/css.css"/>
    
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
    <!-- Começa o NavBar-->
    <nav class="navbar navbar-inverse-light">
      <div class="container">
        <div class="navbar-header logo">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="pro_inicio.php" style="margin-left: 100px; padding: 0"><img src="../imagens/GoWork-logo.png" style=" height: 100%; padding: 15px; width: auto;"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right logo">
            <li class="active"><a href="pro_inicio.php"><span class="glyphicon glyphicon-home"></span>  Ínicio</a></li>
            <li><a href="pro_perfil.php"><span class="glyphicon glyphicon-cog"></span> Perfil</a></li>
            <li><a href="../function/profissional.php?logout=1"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Termina o NavBar-->
    
  <div class="container-fluid">
    <div class="row content">
      <!-- Barra de pesquisa -->
      <div class="col-sm-3 sidenav">
        <ul class="nav nav-pills nav-stacked">
          <li><a href="pro_perfil.php">Perfil</a></li>
          <li><a href="pro_perfil_alterar.php">Editar perfil</a></li>
          <li class="active"><a href="pro_perfil_mudarsenha.php">Mudar senha</a></li>
          <?php
            if ($result['aut_pro']==0):?>
            <li><a href="pro_perfil_aut.php">Autenticar conta</a></li>
          <?php 
            endif;
          ?>
        </ul><br>
      </div>

      <div class="col-sm-9">
        <h2 style=" text-transform: capitalize;"><?php echo $_SESSION['usuario'];?></h2>
        <hr>
        <h2>Alterar Senha</h2>
        <br><br>
        <div class="col-sm-8">
          <form action="../function/profissional.php" method="post">
            <div class="form-group">
              <label>Senha atual</label>
              <input class="form-control" required name="senha_a" id="senha_a" type="password" placeholder="Sua senha atual">
            </div>
            <div class="form-group">
              <label>Insirda a nova senha</label>
              <input class="form-control" required name="senha_n" id="senha_n" type="password" placeholder="Sua senha nova senha">
            </div>
            <div class="form-group">
              <label>Repita sua senha</label>
              <input class="form-control" required name="senha_nv" id="senha_nv" type="password" placeholder="Insira novamente sua senha"><p></p>
              <?php
              if (isset($_SESSION['senha_aut'])):?>
              <div class="alert alert-success" role="alert">
              Senha Atualizada com sucesso
              </div>
              <?php
              endif;
              if (isset($_SESSION['senha_aaut'])):?>
              <div class="alert alert-danger" role="alert">
              Senha atual incorreta
              </div>
              <?php
              endif;
              if (isset($_SESSION['senha_naut'])):?>
              <div class="alert alert-danger" role="alert">
              Senhas novas não coincidem
              </div>
              <?php
              endif;
              unset($_SESSION['senha_aut']);
              unset($_SESSION['senha_aaut']);
              unset($_SESSION['senha_naut']);
              ?>
            </div>
            <button type="submit" name="update-senha" class="btn btn-primary">Enviar</button>
          </form>
        </div>
        
      </div>

    </div>
  </div>
    

    
    <!-- Começa o Footer -->
    <br><br><br><br>
    <footer class="page-footer font-small indigo">
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2019 Copyright: GoWork</div>
      <!-- Copyright -->
    </footer>
    <!-- Termina o Footer -->
    
    <script type="text/javascript">
            $("#telefone").mask("(00) 0000-0000");
            $("#celular").mask("(00) 00000-0000");
            $("#cpf").mask("000.000.000-00");
        </script>
  </body>
</html>