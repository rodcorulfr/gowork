<?php
session_start();
include('../function/conexao.php');
$conexao = new conectar();
$cod_pd = $_GET['cod'];
$result = $conexao->getReadAll('orcamento', 'cod_pd', $cod_pd);
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
      <div class="row content">
        <div class="col-sm-1"></div>
        <div class="col-sm-10 text-left">
          <h1>Orçamentos Registrados</h1>
          <hr>
          <h3>Pedido Nº <?php echo $cod_pd; ?></h3><br>
          <?php
          foreach ($result as $item) {
          $result2 = $conexao->getReadAll('profissional', 'cod_pro', $item[1]);
          $nome = $result2[0][2];
          echo "<div class='row'>
            <div class='col-sm-12'>
              <div class='panel panel-default'>
                <div class='panel-heading'>
                  <h4>$nome</h4>
                </div>
                <div class='panel-body'>
                <div class='row'>
                  <div class='col-sm-9'>
                  <b><p>Descrição:</p></b>
                  <p>$item[3]</p>
                  </div>
                  <div class='col-sm-3'>
                  <b><p>Valor R$:</p></b>
                  <p>R$ $item[4]</p>
                  </div>
                </div>
                  <br>
                  <button type='button' style='margin-left: 80%' class='btn btn-primary' data-toggle='modal' data-target='#aceitar$item[0]' title='Excluir Pedido'><span class='glyphicon glyphicon-ok'></span> Aceitar Orçamento
                  </button>
                </div>
              </div>
            </div>
          </div>
          ";
          echo "<div class='modal fade' id='aceitar$item[0]' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>
                        <h3> Deseja contratar o serviço desse profissional ?</h3>
                        
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
                        <a href='../function/pedido.php?aceitar=$item[0]' class='btn btn-success' role='button'>Aceitar Orçamento</a>
                      </div>
                    </div>
                  </div>
                </div>";
          }
          ?>
          
          
        </div>
      </div>
    </div>
    
    <!-- Começa o Footer -->
    <br><br><br>
    <footer class="page-footer font-small indigo">
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2019 Copyright: GoWork</div>
      <!-- Copyright -->
    </footer>
    <!-- Termina o Footer -->
    
  </body>
</html>