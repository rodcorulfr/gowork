<?php 
  
  session_start();
  include('../function/conexao.php');
  $conexao = new conectar();

  $tabela = 'pacote';
  $result = $conexao->getReadAllA($tabela);

  $id = $_SESSION['usuario'];
  $result2 = $conexao->getRead('profissional','usuario_pro',$id);

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
      <h1>Pacotes de Plano</h1>
      <p>Aderir a um pacote de serviço</p>
    </div>
    
    <div class="container">
        <div class="container-fluid">
<!--   <div class="text-center">
    <h2>Pricing</h2>
    <h4>Choose a payment plan that works for you</h4>
  </div> -->
  <div class="row">
    <?php
    if ($result2['cod_pac'] == NULL) {
      foreach ($result as $item) {
      echo "<div class='col-sm-4'>
      <div class='panel panel-default text-center'>
        <div class='panel-heading'>";
      if ($item['prz_pac'] == 1) {
      echo "<h1>Mensal</h1>";
      }else if ($item['prz_pac'] == 3) {
      echo "<h1>Trimestral</h1>";  
      }else if ($item['prz_pac'] == 12) {
      echo "<h1>Anual</h1>";  
      }
      echo "</div>
        <div class='panel-body'>
          <p>Registrar Orçamento</p>";
      if ($item['prz_pac'] == 1) {
      echo "<p>Válido no periodo de 1 mês</p>";
      }else if ($item['prz_pac'] == 3) {
      echo "<p>Válido no periodo de 3 meses</p>";
      }else if ($item['prz_pac'] == 12) {
      echo "<p>Válido no periodo de 1 ano</p>";
      }
      echo "<p>Assitência 24hr</p>
        </div>
        <div class='panel-footer'>";
        echo "<h3>R$ $item[val_pac]</h3>";
        if ($item['prz_pac'] == 1) {
        echo " <h4>por mês</h4><br>";
        }else if ($item['prz_pac'] == 3) {
        echo " <h4>a cada 3 meses</h4><br>";
        }else if ($item['prz_pac'] == 12) {
        echo " <h4>por ano</h4><br>";
        }
        echo "<button class='btn btn-lg' data-toggle='modal' data-target='#aceitar$item[0]'>Contratar</button>
        </div>
      </div>
    </div>";
          echo "<div class='modal fade' id='aceitar$item[0]' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <h5 class='modal-title' id='TituloModalCentralizado'>Aceitar Plano</h5>
                </div>
                <div class='modal-body' style='text-align:center;'>";
                        if ($item['prz_pac'] == 1) {
                          echo "<label>Deseja realmente aceitar o plano mensal?</label>";
                          }else if ($item['prz_pac'] == 3) {
                          echo "<label>Deseja realmente aceitar o plano trimestral?</label>";
                          }else if ($item['prz_pac'] == 12) {
                          echo "<label>Deseja realmente aceitar o plano anual?</label>";
                          }
                echo "</div>
                <div class='modal-footer'>
                  <a href='../function/profissional.php?plano=X&cod_pac=$item[0]&prz_pac=$item[1]&val_pac=$item[2]&cod_pro=$result2[cod_pro]' class='btn btn-primary' role='button'>Sim, tenho certeza</a>
                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
                </div>
              </div>
            </div>
          </div>";
    }
    }else{
      $result = $conexao->getRead('pacote','cod_pac',$result2['cod_pac']);
      $result3 = $conexao->getRead('fatura','cod_pro',$result2['cod_pro']);
      echo "<div class='col-sm-14'>
      <div class='panel panel-default text-center'>
        <div class='panel-heading'>";
      if ($result['cod_pac'] == 1) {
      echo "<h1>Pacote Atual - Mensal</h1>";
      }else if($result['cod_pac' == 2]){
      echo "<h1>Pacote Atual - Trimestral</h1>";
      }else if($result['cod_pac' == 3]){
      echo "<h1>Pacote Atual - Anual</h1>";
      }
      echo "</div>
        <div class='panel-body'>";
      echo "<div class='col-sm-4'>
      <div class='panel panel-default text-justify'>
        <div class='panel-body'>";
      echo "<p><label>Nome:</label> $result2[nome_pro] $result2[sobren_pro]</p>";
      if ($result['cod_pac'] == 1) {
      $data_termino = DateTime::createFromFormat("Y-m-d", $result3['datt_fat']);
      echo "<p><label>Data de término:</label> ".$data_termino->format('d/m/Y')."</p>";
      $data_termino->modify('-1 month');
      echo "<p><label>Data de aquisição:</label> ".$data_termino->format('d/m/Y')."</p>";
      }else if($result['cod_pac' == 2]){
      echo "<p><label>Data de término:</label> ".$data_termino->format('d/m/Y')."</p>";
      $data_termino->modify('-3 month');
      echo "<p><label>Data de aquisição:</label> ".$data_termino->format('d/m/Y')."</p>";
      }else if($result['cod_pac' == 3]){
      echo "<p><label>Data de término:</label> ".$data_termino->format('d/m/Y')."</p>";
      $data_termino->modify('-12 month');
      echo "<p><label>Data de aquisição:</label> ".$data_termino->format('d/m/Y')."</p>";
      }
      echo "</div>
      </div>
    </div>";

      echo "<div class='col-sm-4'>";
      echo "</div>";

      echo "<div class='col-sm-4'>
      <div class='panel panel-default text-left'>
        <div class='panel-body'>";
      echo "<p><span class='glyphicon glyphicon-ok' style='color: green'></span> Registrar Orçamento</p>
      <p><span class='glyphicon glyphicon-ok' style='color: green'></span> 24 hrs de Assistência</p>
      <p><span class='glyphicon glyphicon-ok' style='color: green'></span> Acesso a todas funcionalidades de profissional</p>
      </div>
      </div>
    </div>";
      echo "
        </div>
        <div class='panel-footer' style='padding: 2%'>";
        echo "<h3>R$ $result3[val_fat]</h3>";
        if ($result['cod_pac'] == 1) {
        echo " <h4>por mês</h4><br>";
        }else if ($result['cod_pac'] == 2) {
        echo " <h4>a cada 3 meses</h4><br>";
        }else if ($result['cod_pac'] == 3) {
        echo " <h4>por ano</h4><br>";
        }
        // echo "<button class='btn btn-lg' data-toggle='modal' data-target='#gerar' style='margin-right:1%'>Gerar Fatura</button>";
        // echo "<button class='btn btn-lg' data-toggle='modal' data-target='#mudar' style='margin-left:1%'>Mudar de Plano</button>";
        echo "</div>
      </div>
    </div>";
    }
    ?>
  </div>
</div>
    </div>
   
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