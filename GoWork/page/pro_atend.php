<?php 
  
  session_start();
  include('../function/conexao.php');

  $conexao = new conectar();

  $tabela = 'profissional';
  $campo = 'usuario_pro';
  $id = $_SESSION['usuario'];

  $result = $conexao->getRead($tabela, $campo, $id);
  $cod = $result['cod_pro'];

  $tabela = 'pedido';
  $campo = 'cod_pro';
  $order = 'ORDER BY status_pd ASC';

  $result = $conexao->getReadAllOrder($tabela,$campo,$cod,$order);


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
    .jumbotron {
    background-color: #005487;
    color: #fff;
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

    <div class="jumbotron text-center">
      <h1>Meus Atendimentos</h1>
      <p>Verifique os detalhes dos atendimentos ativos</p>
    </div>
    
    <div class="container">
        <div class="row content">
          <div class="col-sm-1"></div>
        <div class="col-sm-10 text-left"> 
          <h1></h1>
          <hr>
          <!--Começa Lista de Pedidos Pendentes-->
            <table class="table table-bordered table-hover text-center">
              <thead>
                <tr>
                  <th scope="col" style="text-align: center;">Código</th>
                  <th scope="col" style="text-align: center;">Cliente</th>
                  <th scope="col" style="text-align: center;">Descrição</th>
                  <th scope="col" style="text-align: center;">Status</th>
                  <th scope="col" style="text-align: center;">Opções</th>
                  <th scope="col" style="text-align: center;">Data Limite</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $tabela2 = 'cliente';
                  $campo2 = 'cod_cli';


                foreach ($result as $a) {
                 if ($a[14] == "Ativo") {
                  echo "<tr>
                        <td>$a[0]</td>";
                        $id2 = $a[1];
                        $result2 = $conexao->getRead($tabela2, $campo2, $id2);
                        echo "<td>$result2[nome_cli]</td>";
                        echo "<td style='max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>$a[9]</td>
                        <td style='color: #5cb85c; font-weight: bold'>$a[14]</td>
                        <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#Detalhes$a[0]' title='consultar detalhes do pedido'>Detalhes</button>
                        </td>";
                        $data1 = DateTime::createFromFormat("Y-m-d", $a['data_limit']);
                        echo "<td>".$data1->format('d/m/Y')."</td>
                  </tr>";
                 }else if ($a[14] == "Concluido") {
                  echo "<tr>
                        <td>$a[0]</td>";
                        $id2 = $a[1];
                        $result2 = $conexao->getRead($tabela2, $campo2, $id2);
                        echo "<td>$result2[nome_cli]</td>";
                        echo "<td style='max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>$a[9]</td>
                        <td style='color: #337ab7; font-weight: bold'>$a[14]</td>
                        <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#Detalhes$a[0]' title='consultar detalhes do pedido'>Detalhes</button></td>
                        <td>-------</td>
                  </tr>";
                 }
                }
                ?>
              </tbody>
            </table>
            <!--Termina Lista de Pedidos Pendentes-->
        </div>
      </div>
    </div>

       <!-- Começa Modal Detalhes-->
   <?php
   foreach ($result as $a) {
    $id2 = $a[1];
    $result2 = $conexao->getRead($tabela2, $campo2, $id2);
    $data_inicio = DateTime::createFromFormat("Y-m-d", $a[10]);
    $data_estimada = DateTime::createFromFormat("Y-m-d", $a[11]);
    $data_conclusao = DateTime::createFromFormat("Y-m-d", $a[13]);
    echo "<div class='modal fade' id='Detalhes$a[0]' tabindex='-1' role='dialog' aria-labelledby='Titulo' aria-hidden='true'>
      <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
              <span aria-hidden='true'>&times;</span>
            </button>
            <h3 class='modal-title' id='Titulo'>Detalhes - Pedido nº$a[0]</h3>
          </div>
          <div class='modal-body'>
          <div class='container-fluid bg-3' style='word-break: break-all;'>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <strong>Nome do Cliente: </strong><br>$result2[nome_cli]
                            </div>
                            <div class='col-sm-6'>
                              <strong>Endereço: </strong><br>$a[end_pd]
                            </div>
                          </div><br>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <strong>Bairro: </strong><br>$a[bairro_pd]
                            </div>
                            <div class='col-sm-6'>
                              <strong>Local: </strong><br>$a[local_pd]
                            </div>
                          </div><br>
                          <div class='row'>
                            <div class='col-sm-12'>
                              <strong>Descrição: </strong><br>$a[9]
                            </div>
                          </div><br>
                          <div class='row'>
                            <div class='col-sm-4'>
                              <strong>Data Inicio: </strong><br>".$data_inicio->format('d/m/Y')."
                            </div>
                            <div class='col-sm-4'>
                              <strong>Data Estimada: </strong><br>".$data_estimada->format('d/m/Y')."
                            </div>
                            <div class='col-sm-4'>
                              <strong>Data de Conclusão: </strong><br>";
                              if ($a[13] == '0000-00-00') {
                                echo "00/00/0000";
                              }else{
                                echo $data_conclusao->format('d/m/Y');
                              }
                              echo"</div>
                          </div>
                        </div><br>
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
          </div>
        </div>
      </div>
    </div>";
   }

   ?>
    <!-- Termina Modal Detalhes-->
   
    <br><br><br>

    <!-- Começa o Footer -->
    <footer class="page-footer font-small indigo">
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2019 Copyright: GoWork</div>
      <!-- Copyright -->
    </footer>
    <!-- Termina o Footer -->
    
  </body>
</html>