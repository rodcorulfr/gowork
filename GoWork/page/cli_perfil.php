<?php 
  
  session_start();
  include('../function/conexao.php');

  $conexao = new conectar();

  $tabela = 'cliente';
  $campo = 'usuario_cli';
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
          <a class="navbar-brand" href="cli_inicio.php" style="margin-left: 100px; padding: 0"><img src="../imagens/GoWork-logo.png" style=" height: 100%; padding: 15px; width: auto;"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right logo">
            <li class="active"><a href="cli_inicio.php"><span class="glyphicon glyphicon-home"></span>  Ínicio</a></li>
            <li><a href="cli_perfil.php"><span class="glyphicon glyphicon-cog"></span> Perfil</a></li>
            <li><a href="../function/cliente.php?logout=1"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Termina o NavBar-->
  <div class="container">

  </div>
    
  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <ul class="nav nav-pills nav-stacked">
          <li class="active"><a href="cli_perfil.php">Perfil</a></li>
          <li><a href="cli_perfil_alterar.php">Editar perfil</a></li>
          <li><a href="cli_perfil_mudarsenha.php">Mudar senha</a></li>
          <?php
            if ($result['aut_cli']==0):?>
            <li><a href="cli_perfil_aut.php">Autenticar conta</a></li>
          <?php 
            endif;
          ?>
        </ul><br>
      </div>

      <div class="col-sm-9">
        <h2 style=" text-transform: capitalize;"><?php echo $_SESSION['usuario'];?></h2>
        <hr>
        <h2>Dados Pessoais</h2>
        <br><br>

        <div class="col-sm-4" style=" color: rgba(0,0,0,0.2);">
          <?php
          echo 'Nome do usuário: <p></p>';
          echo 'E-mail: <p></p>';
          echo 'CPF: <p></p>';
          echo 'Telefone: <p></p>';
          echo 'Celular: <p></p>';
          echo 'Sexo: <p></p>';
          echo 'Verificação: <p></p>';

          ?>
          
        </div>
        <div class="col-sm-4">
          <?php
      
          echo $result['nome_cli'].' '.$result['sobren_cli'].'<p></p>';
          echo $result['email_cli'].'<p></p>';
          echo $result['cpf_cli'].'<p></p>';
          echo $result['tel_cli'].'<p></p>';
          echo $result['cel_cli'].'<p></p>';
          if ($result['sex_cli'] == 'M') {
            echo "Masculino<p></p>";
          }else{
            echo "Feminino<p></p>";
          }
          if ($result['aut_cli']==1) {
            echo "Autenticado<p></p>";
          }else{
            echo "<a href='cli_perfil_aut.php'>Pendente</a> ";
          }
          ?>

        </div>
          <!-- Botão para acionar modal -->
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ExemploModalCentralizado">
            <span class="glyphicon glyphicon-trash"></span> Deletar perfil
          </button>

          <!-- Modal -->
          <div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="TituloModalCentralizado">Deletar Perfil</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Deseja realmente deletar seu perfil ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  <a href="../function/cliente.php?delete=1" class="btn btn-primary" role="button">Sim, tenho certeza</a><p></p> 
                </div>
              </div>
            </div>
          </div>

        </div>

    </div>
  </div>
    

    
    <!-- Começa o Footer -->
    <footer class="page-footer font-small indigo" style="position: absolute; bottom: 0; width: 100%;">
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2019 Copyright: GoWork</div>
      <!-- Copyright -->
    </footer>
    <!-- Termina o Footer -->
    
  </body>
</html>