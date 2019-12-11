<?php
session_start();
include('../function/conexao.php');
$conexao = new conectar();

$result = $conexao->getReadAllA('pacote');
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
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
          <h1>Gerenciar Pacote</h1>
          <hr>
          <!--Começa Lista de Pedidos Pendentes-->
          <table class="table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th scope="col" style="text-align: center;">Código</th>
                <th scope="col" style="text-align: center;">Prazo</th>
                <th scope="col" style="text-align: center;">Valor</th>
                <th scope="col" style="text-align: center;">Opções</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            foreach ($result as $item) {
              echo "<tr>
                <td>$item[0]</td>";
                if ($item[0] == 1) {
                echo "<td>$item[1] mês</td>";
                }else{
                echo "<td>$item[1] meses</td>";
                }
                echo "<td>$item[2] R$</td>
                <td>
                <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editar$item[0]' title='Editar Pacote'>
                        <span class='glyphicon glyphicon-pencil'></span>
                </button>
                </td>
              </tr>";
                  echo "<div class='modal fade' id='editar$item[0]' tabindex='-1' role='dialog' aria-labelledby='Titulo' aria-hidden='true'>
                          <div class='modal-dialog modal-dialog-centered' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                                <h3 class='modal-title' id='Titulo'>Editar Plano - $item[0]</h3>
                              </div>
                              <form action='../function/adm.php?cod_pac=$item[0]' method='post'>
                              <div class='modal-body'>
                                  <div class='form-group'>
                                  <label>Valor do Pacote (R$)</label>
                                  <input class='form-control' id='dinheiro' type='text' name='val_pac' value='$item[2]' placeholder='0.00' required>
                                  </div>
                              </div>
                              <div class='modal-footer'>
                                <input type='submit' name='editar_pac' class='btn btn-primary' value='Salvar'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                              </div>
                              </form>
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
              Pacote editado com sucesso
              </div>
             <?php endif;?>
            <!--Termina Lista de Pedidos Pendentes-->
          </div>
        </div>
      </div>

    <script type="text/javascript">
      $('#dinheiro').mask('#.##0.00', {reverse: true});
    </script>
      
      <!-- Começa o Footer -->
      <footer class="page-footer font-small indigo" style="position: absolute; bottom: 0; width: 100%;">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2019 Copyright: GoWork</div>
        <!-- Copyright -->
      </footer>
      <!-- Termina o Footer -->
      
    </body>
  </html>