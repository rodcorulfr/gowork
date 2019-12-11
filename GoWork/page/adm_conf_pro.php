<?php
session_start();
include('../function/conexao.php');
$conexao = new conectar();

$result = $conexao->getReadAll('profissional','doc_pro',0);

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
          <h1>Confirmação de Profissional</h1>
          <hr>
          <!--Começa Lista de Pedidos Pendentes-->
          <?php 
              if ($result == true) {

            ?>
          <table class="table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th scope="col" style="text-align: center;">Código</th>
                <th scope="col" style="text-align: center;">Profissional</th>
                <th scope="col" style="text-align: center;">Opções</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            foreach ($result as $item) {
            echo "<tr>
                <td>$item[0]</td>
                <td>$item[nome_pro]</td>
                <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#detalhes$item[0]' title='Consultar documentos do cadastro'>Documentos</button>
                <button type='button' class='btn btn-success' data-toggle='modal' data-target='#confirmar$item[0]' title='Confirmar Cadastro'>
                        <span class='glyphicon glyphicon-ok'></span>
                </button>
                  <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#recusar$item[0]' title='Recusar Cadastro'>
                  <span class='glyphicon glyphicon-remove'></span>
                  </button>
                </td>
              </tr>";
            }

            ?>
            </tbody>
            </table>
            <?php 
          }else{
            echo "<div style='text-align = center;'>
                  Nenhum registro pendente para confirmação.
            </div>";
          }

            ?>
              <?php
              if (isset($_GET['conf_pro'])):
             ?>
              <div class="alert alert-success" role="alert" style="margin-top: 20px;">
              O Profissional foi efetuado com sucesso
              </div>
             <?php endif;?>

              <?php
              if (isset($_GET['recu_pro'])):
             ?>
              <div class="alert alert-success" role="alert" style="margin-top: 20px;">
              O Profissional foi recusado com sucesso
              </div>
             <?php endif;?>
            <!--Termina Lista de Pedidos Pendentes-->
          </div>
        </div>
      </div>

      <?php
      foreach ($result as $item) {
        echo "<div class='modal fade' id='confirmar$item[0]' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <h5 class='modal-title' id='TituloModalCentralizado'>Confirmar Cadastro - $item[nome_pro]</h5>
                </div>
                <div class='modal-body' style='text-align:center;'>
                  <label>Deseja prosseguir com a confirmação?</label>
                </div>
                <div class='modal-footer'>
                  <a href='../function/adm.php?confirmar_pro=OK&cod_pro=$item[0]&nome_pro=$item[nome_pro]' class='btn btn-primary' role='button'>Sim, tenho certeza</a>
                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
                </div>
              </div>
            </div>
          </div>";

                echo "<div class='modal fade' id='detalhes$item[0]' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <h5 class='modal-title' id='TituloModalCentralizado'>Documentos - $item[nome_pro]</h5>
                </div>
                <div class='modal-body' style='text-align:center;'>
                  <img src='../$item[img_doc_pro]' style='max-width: 100%;'>
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
                </div>
              </div>
            </div>
          </div>";
                echo "<div class='modal fade' id='recusar$item[0]' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <h5 class='modal-title' id='TituloModalCentralizado'>Recusar Cadastro - $item[nome_pro]</h5>
                </div>
                <div class='modal-body' style='text-align:center;'>
                  <p>Deseja realmente recusar o cadastro do profissional?</p>
                </div>
                <div class='modal-footer'>
                  <a href='../function/adm.php?recusar_pro=OK&cod_pro=$item[0]&nome_pro=$item[nome_pro]' class='btn btn-primary' role='button'>Sim, tenho certeza</a>
                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
                </div>
              </div>
            </div>
          </div>";
      }

      ?>
      
      <!-- Começa o Footer -->
      <footer class="page-footer font-small indigo" style="position: absolute; bottom: 0; width: 100%; max-width: 100%;">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2019 Copyright: GoWork</div>
        <!-- Copyright -->
      </footer>
      <!-- Termina o Footer -->
      
    </body>
  </html>