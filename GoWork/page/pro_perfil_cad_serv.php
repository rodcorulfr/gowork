<?php 
  
  session_start();
  include('../function/conexao.php');

  $conexao = new conectar();

  $tabela = 'profissional';
  $campo = 'usuario_pro';
  $id = $_SESSION['usuario'];

  $result = $conexao->getRead($tabela, $campo, $id);
  $cod = $result['cod_pro'];

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
  <div>
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
        <div class="collapse navbar-collapse" id="myNavbar" >
          <ul class="nav navbar-nav navbar-right logo">
            <li class="active"><a href="pro_inicio.php"><span class="glyphicon glyphicon-home"></span>  Ínicio</a></li>
            <li><a href="pro_perfil.php"><span class="glyphicon glyphicon-cog"></span> Perfil</a></li>
            <li><a href="../function/profissional.php?logout=1"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Termina o NavBar-->
    
  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav">
      </div>

      <div class="col-sm-9">
        <h2 style=" text-transform: capitalize;"><?php echo $result['usuario_pro'];?></h2>
        <hr>
        <h2>Cadastrar Novas Profissões</h2>
        <br>
        <div class="col-sm-8">
        <form action="../function/profissional.php" method="post">
            <div class="form-group">
              <label>Escolha a Profissão</label>
              <select class="form-control" name="profissao">

                <?php 
                $tabela = 'profissao';
                $result = $conexao->getReadAllA($tabela);

                foreach ($result as $item) {
                  echo "<option value='$item[0]'>$item[1]</option>";  
                }

                ?>

              </select>
            </div>
            <input type="submit" name="prof" value="Registrar" class="btn btn-primary">
             <?php
              if (isset($_SESSION['profOK'])):
                ?>
              <div class="alert alert-success" role="alert" style="margin-top: 20px;">
              Profissão Registrada com sucesso
              </div>
              <?php
              endif;
              if (isset($_SESSION['profNOT'])):
              ?> 
              <div class="alert alert-danger" role="alert" style="margin-top: 20px;">
              Você já possui essa profissão
              </div>
              <?php
              endif;
              unset($_SESSION['profOK']);
              unset($_SESSION['profNOT']);
              ?>
          </form>
          <h3>Suas Profissões</h3>

              <?php

                $result2 = $conexao->getReadAll('pro_prof', 'cod_pro', $cod);
          
          foreach ($result2 as $a) {
            if (empty($profissoes)) {
              $profissoes = [$a[1]];
            }else{
              array_push($profissoes, $a[1]);
            }
          }

          $tabela = 'profissao';
          $campo = 'cod_prof';

          if (isset($profissoes)) {
          echo "<table class='table table-bordered table-hover text-center'>
                <thead>
                <tr>
                  <th scope='col' style='text-align: center; width: 90%;'>Profissão</th>
                  <th scope='col' style='text-align: center; width: 10%;'></th>
                </tr>
              </thead>
              <tbody>";
          for ($i=0; $i < count($profissoes); $i++) { 
           $result2 = $conexao->getRead('profissao','cod_prof', $profissoes[$i]);
            echo "<tr>";
            echo "<td>$result2[dsc_prof]</td>";
            echo "<td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#Remover$result2[cod_prof]' title='Remover Profissão'>
                <span class='glyphicon glyphicon-remove'></span>
                </button></td>";
            echo "</tr>";
            echo "<div class='modal fade' id='Remover$result2[cod_prof]' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <h5 class='modal-title' id='TituloModalCentralizado'>Remover Profissão - $result2[dsc_prof]</h5>
                </div>
                <div class='modal-body' style='text-align:center;'>
                  <label>Deseja realmente remover a profissão?</label>
                  <br>
                  <small style='color: #adadad;'>Você poderá registrar-la novamente caso deseje.</small>
                </div>
                <div class='modal-footer'>
                  <a href='../function/profissional.php?remover_prof=OK&cod_prof=$result2[cod_prof]&cod_pro=$cod' class='btn btn-primary' role='button'>Sim, tenho certeza</a>
                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
                </div>
              </div>
            </div>
          </div>";
          }
          echo "</tbody>
                </table>";
          }else{
            echo "<div style='text-align = center;'>
                  Você não possui profissão.
            </div>";
            $_SESSION['first_profNOT'] = 'x';
          }

              ?>
                


        </div>
      </div>

    </div>
  </div>
    

    
    <!-- Começa o Footer -->
    <br><br><br><br><br><br>
    <footer class="page-footer font-small indigo">
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2019 Copyright: GoWork</div>
      <!-- Copyright -->
    </footer>
    <!-- Termina o Footer -->
    
  </body>
</html>