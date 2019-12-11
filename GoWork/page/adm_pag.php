<?php
session_start();
include('../function/conexao.php');
$conexao = new conectar();
$result = $conexao->getReadAllA('fatura');
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
          <a class="navbar-brand" href="adm_inicio.php" style="margin-left: 100px; padding: 0"><img src="../imagens/GoWork-logo.png" style=" height: 100%; padding: 15px; width: auto;"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right logo">
            <li class="active"><a href="adm_inicio.php"><span class="glyphicon glyphicon-home"></span>  Ínicio</a></li>
            <li><a href="../function/global.php?logout=1"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Termina o NavBar-->
    
    <div class="container">
      <div class="row content">
        <div class="col-sm-1"></div>
        <div class="col-sm-10 text-left">
          <h1>Faturas</h1>
          <hr>
          <!--Começa Lista de Pedidos Pendentes-->
          <table class="table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th scope="col" style="text-align: center;">Código</th>
                <th scope="col" style="text-align: center;">Profissional</th>
                <th scope="col" style="text-align: center;">Data de Validade</th>
                <th scope="col" style="text-align: center;">Data de Pagamento</th>
                <th scope="col" style="text-align: center;">Data de Término</th>
                <th scope="col" style="text-align: center;">Valor</th>
                <!-- <th scope="col" style="text-align: center;">Opções</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($result as $item) {
              echo "<tr>";
              echo "<td>$item[cod_fat]</td>";
              $result2 = $conexao->getRead('profissional','cod_pro',$item['cod_pro']);
              echo "<td>$result2[nome_pro]</td>";
              $data_validade = DateTime::createFromFormat("Y-m-d", $item['datv_fat']);
              echo "<td>".$data_validade->format('d/m/Y')."</td>";
              echo "<td>$item[datp_fat]</td>";
              $data_termino = DateTime::createFromFormat("Y-m-d", $item['datt_fat']);
              echo "<td>".$data_termino->format('d/m/Y')."</td>";
              echo "<td>$item[val_fat]</td>";
              /*echo "<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#detalhes$item[0]' title='Consultar detalhes da fatura'>Detalhes</button></td>";*/
              echo "</tr>";
              /*echo "<div class='modal fade' id='detalhes$item[0]' tabindex='-1' role='dialog' aria-labelledby='Titulo' aria-hidden='true'>
                      <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                            <h3 class='modal-title' id='Titulo'>Detalhes - Fatura nº$item[0]</h3>
                          </div>
                          <div class='modal-body'>
                          <div>
                          <div class='container-fluid bg-3' style='word-break: break-all;'>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <strong>Nome: </strong><br>$result2[nome_pro]
                            </div>
                            <div class='col-sm-6'>
                              <strong>: </strong><br>$a[end_pd]
                            </div>
                          </div><br>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <strong>Bairro: </strong><br>$a[bairro_pd]
                            </div>
                            <div class='col-sm-6'>
                              <strong>Local: </strong><br>$a[local_pd]
                            </div>
                          </div>
                          </div>
                          </div>
                          <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                          </div>
                        </div>
                      </div>
                  </div>";*/
              }
               ?>
            </tbody>
            </table>
            <!--Termina Lista de Pedidos Pendentes-->
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