<?php 
  
  session_start();
  include('../function/conexao.php');

  $conexao = new conectar();

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

    <!-- Termina o NavBar -->

    <div class="container-fluid">
      <h2 style="text-align: center;">Profissões mais procuradas</h2>
      <div class="row content">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 text-center" style="border: 1px solid #e9e9e9; margin-top: 20px;"><br>
          <div class="col-sm-4">
            <div class="thumbnail">
              <a href="cli_cadastrar_pd.php"><img src="../imagens/pedreiro.jpeg" class="img-responsive" style="width:100%" alt="Image"></a>
              <p><b>Pedreiro</b></p>
            </div>
          </div>
          <div class="col-sm-4"> 
            <div class="thumbnail">
              <a href="#"><img src="../imagens/Banner.png" class="img-responsive" style="width:100%" alt="Image"></a>
              <p><b>Eletricista</b></p>
            </div>    
          </div>
          <div class="col-sm-4"> 
            <div class="thumbnail">
              <a href="#"><img src="../imagens/Banner.png" class="img-responsive" style="width:100%" alt="Image"></a>
              <p><b>Encanador</b></p>
            </div>    
          </div>    
          </div>
        </div>
        <div class="col-sm-2 sidenav"></div>
      </div>
    </div>


    <div class="container-fluid">
      <h2 style="text-align: center;">Outros</h2>
      <div class="row content">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 text-center" style="border: 1px solid #e9e9e9; margin-top: 20px;"><br>

          <nav class="navbar navbar-light bg-light">
            <form class="form-inline navbar-light bg-light" style="text-align: right;">
              <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
          </nav><br>
          <div class="col-sm-3"> 
            <div class="thumbnail">
              <a href="cli_registrar_pedido.php"><img src="../imagens/Banner.png" class="img-responsive" style="width:100%" alt="Image"></a>
            </div>    
          </div>
          <div class="col-sm-3"> 
            <div class="thumbnail">
              <a href="cli_registrar_pedido.php"><img src="../imagens/Banner.png" class="img-responsive" style="width:100%" alt="Image"></a>
            </div>    
          </div>
          <div class="col-sm-3"> 
            <div class="thumbnail">
              <a href="cli_registrar_pedido.php"><img src="../imagens/Banner.png" class="img-responsive" style="width:100%" alt="Image"></a>
            </div>    
          </div>
          <div class="col-sm-3"> 
            <div class="thumbnail">
              <a href="cli_registrar_pedido.php"><img src="../imagens/Banner.png" class="img-responsive" style="width:100%" alt="Image"></a>
            </div>    
          </div>
          <div class="col-sm-3"> 
            <div class="thumbnail">
              <a href="cli_registrar_pedido.php"><img src="../imagens/Banner.png" class="img-responsive" style="width:100%" alt="Image"></a>
            </div>    
          </div>
          
        </div>
        <div class="col-sm-2 sidenav"></div>
      </div>
    </div>


  <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4><span class="glyphicon glyphicon-lock"></span> Solicitar Serviço</h4>
          </div>
          <div class="modal-body">
            <form role="form">
              <p>Deseja proseguir para efetuar um pedido com esse profissional ?</p>
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-default pull-left" data-dismiss="modal">
              <span class="glyphicon glyphicon-ok"></span> Confirmar pedido
            </button>
            <p>Need <a href="#">help?</a></p>
          </div>
        </div>
        <!-- Modal content-->
      </div>
    </div>
    <!-- Modal-->


    <!-- Começa o Footer -->
    <footer class="page-footer font-small indigo" style="margin-top: 30px">
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2019 Copyright: GoWork</div>
      <!-- Copyright -->
    </footer>
    <!-- Termina o Footer -->
    
  </body>
</html>