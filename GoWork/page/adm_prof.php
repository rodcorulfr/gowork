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
          <h1>Gerenciar Profissões</h1>
          <hr>
          <!--Começa Lista de Pedidos Pendentes-->
          <table class="table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th scope="col" style="text-align: center;">Código</th>
                <th scope="col" style="text-align: center;">Profissão</th>
                <th scope="col" style="text-align: center;">Área de Atuação</th>
                <th scope="col" style="text-align: center;">Opções</th>
              </tr>
            </thead>
            <tbody>
            <?php
                $tabela = 'profissao';
                //$result = $conexao->getReadAllA($tabela);
                $result = $conexao->getOrder($tabela,'area_atuacao','ASC');

                foreach ($result as $item) {
                  echo "<tr>
                <td>$item[0]</td>
                <td>$item[1]</td>
                <td>$item[2]</td>
                <td>
                <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editar$item[0]' title='Editar Profissão'>
                <span class='glyphicon glyphicon-pencil'></span>
                </button>
                  <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#remover$item[0]' title='Deletar Profissão'>
                  <span class='glyphicon glyphicon-remove'></span>
                  </button>
                </td>
              </tr>"; 
              echo "<div class='modal fade' id='editar$item[0]' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                          <h5 class='modal-title' id='TituloModalCentralizado'>Registrar Profissão</h5>
                        </div>
                        <form action='../function/adm.php?cod_prof=$item[0]' method='post'>
                        <div class='modal-body'>
                        <div class='form-group'>
                          <label>Nome da Profissão: </label>
                          <input type='text' name='nome_prof' class='form-control' value='$item[1]'>
                        </div>
                        <div class='form-group'>
                          <label>Área de Atuação: </label>
                          <input type='text' name='area_atu' class='form-control' value='$item[2]'>
                        </div>
                        </div>
                        <div class='modal-footer'>
                          <input type='submit' name='editar_prof' class='btn btn-primary' value='Salvar'>
                          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>";
              echo "<div class='modal fade' id='remover$item[0]' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                      <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                            <h5 class='modal-title' id='TituloModalCentralizado'>Deletar Profissão</h5>
                          </div>
                          <div class='modal-body' style='text-align:center;'>
                            <label>Deseja realmente deletar a profissão $item[1]?</label>
                          </div>
                          <div class='modal-footer'>
                            <a href='../function/adm.php?remover_prof=OK&cod_prof=$item[0]' class='btn btn-primary' role='button'>Sim, tenho certeza</a>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
                          </div>
                        </div>
                      </div>
                    </div>"; 
                } 
            ?>
            </tbody>
            </table>
            <?php
              if (isset($_GET['editar'])):
             ?>
              <div class="alert alert-success" role="alert" style="margin-top: 20px;">
              Profissão editada com sucesso
              </div>
             <?php endif;?>
              <?php
              if (isset($_GET['registrar'])):
             ?>
              <div class="alert alert-success" role="alert" style="margin-top: 20px;">
              Profissão registrada com sucesso
              </div>
             <?php endif;?>
              <?php
              if (isset($_GET['remover'])):
             ?>
              <div class="alert alert-success" role="alert" style="margin-top: 20px;">
              Profissão deletada com sucesso
              </div>
             <?php endif;?>
              <?php
              if (isset($_GET['remover_erro'])):
             ?>
              <div class="alert alert-danger" role="alert" style="margin-top: 20px;">
              Ocorreu um erro na remoção da profissão
              </div>
             <?php endif;?>
             
                <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#registrar' title='Registrar uma nova profissão'>
                  Registrar Profissão
                </button>
                  <div class='modal fade' id='registrar' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                          <h5 class='modal-title' id='TituloModalCentralizado'>Registrar Profissão</h5>
                        </div>
                        <form action='../function/adm.php' method='post'>
                        <div class='modal-body'>
                        <div class='form-group'>
                          <label>Nome da Profissão: </label>
                          <input type="text" name="nome_prof" class='form-control'>
                        </div>
                        <div class='form-group'>
                          <label>Área de Atuação: </label>
                          <input type='text' name='area_atu' class='form-control'>
                        </div>
                        </div>
                        <div class='modal-footer'>
                          <input type='submit' name='registrar_prof' class='btn btn-primary' value='Registrar'>
                          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
          </div>
        </div>
      </div>

      <br>
      
      <!-- Começa o Footer -->
      <footer class="page-footer font-small indigo">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2019 Copyright: GoWork</div>
        <!-- Copyright -->
      </footer>
      <!-- Termina o Footer -->
      
    </body>
  </html>