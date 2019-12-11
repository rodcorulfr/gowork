<?php 
  
  session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>GoWork</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Não Consegui linka ele por arquivos fisicos, verificar-->
    
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
    </style>
  </head>
  <body>
    <!-- Começa o NavBar-->
    <nav class="navbar navbar-inverse-light">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="color: black">Go Work</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Ínicio</a></li>
            <li><a href="#">Quem somos</a></li>
            <li><a href="#">Contato</a></li>
            <li><a href="page/login.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Termina o NavBar-->
    <!-- Começa o Carousel-->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      
      <div class="carousel-inner" role="listbox">
        <!-- Primeira foto do slide -->
        <div class="item active">
          <img src="imagens/carousel_1.jpg" alt="Image">
          <div class="carousel-caption">
            <h3>Matheus é Viado</h3>
            <p>Vendo por 5 reais</p>
          </div>
        </div>
        <!-- Segunda foto do slide -->
        <div class="item">
          <img src="imagens/carousel_2.jpg" alt="Image">
          <div class="carousel-caption">
            <h3>Lucas é Viado</h3>
            <p>Vendo por 2 reais</p>
          </div>
        </div>
        <!-- Terceira foto do slide -->
        <div class="item">
          <img src="imagens/carousel_3.jpg" alt="Image">
          <div class="carousel-caption">
            <h3>Jv é Viado</h3>
            <p>Pode levar</p>
          </div>
        </div>
      </div>
      <!-- Anterior e Avançar controles -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Avançar</span>
      </a>
    </div>
    <!-- Termina o Carousel-->
    
    <br><br><br><br>
    <div class="container text-center">
      <h3>Bem Vindo ao GoWork - <?php echo $_SESSION['usuario'];?> </h3><br>
      <div class="row">
        <div class="col-sm-6">
          fdfsdfffffffffffddddd
          <p>Br3Br3Br3</p>
        </div>
        <div class="col-sm-6">
          fdsssssssssssssssssss
          <p>Br3Br3Br3</p>
        </div>
      </div>
    </div><br>
    
    <!-- Começa o Footer -->
    <footer class="page-footer font-small indigo">
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2018 Copyright: Go Work</div>
      <!-- Copyright -->
    </footer>
    <!-- Termina o Footer -->
  </body>
</html>