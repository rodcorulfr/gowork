<?php

session_start();
include('../function/conexao.php');
require('../dataTabelas/conexao.php');
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="dataTabelas/datatables.min.css">
    <link rel="stylesheet" href="dataTabelas/Bootstrap-4-4.1.1/css/bootstrap.min.css">
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
          <h1>Profissões Disponíveis</h1>
          <hr>
          <!--Começa Lista de Pedidos Pendentes-->
          <table id="datatable" class="table table-striped" cellspacing="0" width="100%">
                <thead class="thead-dark" style="text-align: center; background-color: #11112d; color: white">
                  <tr>
                    <th>Descrição da profissão</th>
                    <th>Área de atuação</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  
                  $query = "SELECT * FROM profissao";
                  $resultado = mysqli_query($conexao2, $query);
                  
                  while($row = mysqli_fetch_array($resultado)){
                    echo"<tr style='text-align: center'>";                  
                    echo "<td>". $row[1]."</td>";
                    echo "<td>". $row[2]."</td>";
                    echo"</th>";
                    echo"</th>";
              }
              ?>
            </tbody>
          </table>

          </div>
        </div>
      </div>
      <!-- Começa o Footer -->]
      <br><br><br>
      <footer class="page-footer font-small indigo">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2019 Copyright: GoWork</div>
        <!-- Copyright -->
      </footer>
      <!-- Termina o Footer -->

      <script src="datatable.js"></script>
      <script src="dataTabelas/datatables.min.js"></script>
      
    </body>
  </html>