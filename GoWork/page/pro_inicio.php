<?php

session_start();
  include('../function/conexao.php');
  $conexao = new conectar();
  $tabela = 'profissional';
  $campo = 'usuario_pro';
  $id = $_SESSION['usuario'];
  $result = $conexao->getRead($tabela, $campo, $id);
  if ($result['aut_pro'] != 1) {
    $_SESSION['n_aut_pro'] = true;
    $_SESSION['email_pro'] = trim($result['email_pro']);
    header('Location: t_emailAutenP.php');
  }
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
        <div class="collapse navbar-collapse" id="myNavbar" style="margin-top: 15px">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="pro_inicio.php"><span class="glyphicon glyphicon-home"></span>  Ínicio</a></li>
            <li><a href="pro_perfil.php"><span class="glyphicon glyphicon-cog"></span> Perfil</a></li>
            <li><a href="../function/profissional.php?logout=1" name="submit"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Termina o NavBar-->
    
    <!-- Começa Jumbotron -->
    <div class="jumbotron text-center">
      <h1 style=" text-transform: capitalize;">Olá, <?php echo $result['nome_pro'].' '.$result['sobren_pro'];?></h1>
      <p>A solução para todos seus problemas em um único lugar</p>
    </div>
    <!-- Terminar Jumbotron -->
    <br><br><br>
    
    <div class="container-fluid text-center">
      <br>
      <div class="row">
        <div class="col-sm-4">
          <a href="pro_perfil_cad_serv.php"><span class="glyphicon glyphicon-book" style="font-size: 50px"></span></a>
          <h2>Registrar Profissão</h2>
          <p>Efetuar novos tipos de profissão que deseja prestar</p>
        </div>
        <div class="col-sm-4">
          <a href="pro_atend.php"><span class="glyphicon glyphicon-check" style="font-size: 50px"></span></a>
          <h2>Meus Atendimentos</h2>
          <p>Meus atendimentos que estão em aberto</p>
        </div>
        <div class="col-sm-4">
          <?php
              $tabela = 'profissional';
              $campo = 'usuario_pro';
              $id = $_SESSION['usuario'];

              $result = $conexao->getRead($tabela, $campo, $id);
          if ($result['doc_pro'] == 1) {
          ?>
          <a href="pro_orc.php"><span class="glyphicon glyphicon-inbox" style="font-size: 50px"></span></a>
          <h2>Solicitações de Orçamento</h2>
          <p>Orçamentos registrados e em pendência</p>
          <?php
        }else if ($result['doc_pro'] == 0) {
          ?>

          <span class="glyphicon glyphicon-inbox" style="font-size: 50px; color: gray;"></span>
          <h2>Solicitações de Orçamento</h2>
          <p>Só disponível mediante a confirmação do Administrador</p>

          <?php

            }

          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <a href="pro_plano.php"><span class="glyphicon glyphicon-user" style="font-size: 50px;"></span></a>
          <h2>Gerenciar Plano</h2>
          <p>Geração e pagamento de fatura</p>
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
          <a data-toggle="modal" data-target="#Relatórios" style="cursor: pointer;"><span class="glyphicon glyphicon-book" style="font-size: 50px;"></span></a>
          <h2>Relatórios</h2>
          <p>Relatórios de Orçamentos e Pedidos</p>
        </div>
      </div>
      <br><br>
    </div>

    <!-- Começo do Modal de Relatórios -->
<div class="modal fade" id="Relatórios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"></h5>
      </div>
      <div class="modal-body">
      <div align="center">
        <h2>Escolha o Relatório desejado</h2>
        <a href="../function/PDFrelatorio.php?tipo=orc"><button type="button" class="btn btn-primary" style="width: 100%; margin: 3px;">Orçamentos</button></a>
        <a href="../function/PDFrelatorio.php?tipo=ped"><button type="button" class="btn btn-primary" style="width: 100%; margin: 3px;">Pedidos</button></a>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
    <!-- Final do Modal de Relatórios -->

    <!-- Começo do Modal de Cadastro de Profissão -->
    <?php
    $tabela = 'profissional';
    $campo = 'usuario_pro';
    $id = $_SESSION['usuario'];

      $result = $conexao->getRead($tabela, $campo, $id);
      $cod = $result['cod_pro'];
      $result2 = $conexao->getReadAllA('profissao');
      $result3 = $conexao->getReadAll('pro_prof','cod_pro',$cod);
      if (!$result3 && empty($_SESSION['first_profNOT'])) {

    ?>

        <div class="modal fade" id="profissao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3>Selecione a sua primeira profissão</h3>
        <h5 class="modal-title" id="exampleModalLabel"></h5>
      </div>
      <form action="../function/profissional.php" method="post">
      <div class="modal-body">
        <div class="form-group">
        <select select class="form-control" name="profissao">
        <?php
        foreach ($result2 as $item) {
          echo "<option value='$item[0]'>$item[1]</option>";
        }
        ?>
        </select>
      </div>
      </div>
      <div class="modal-footer">
        <div class="form-group">
        <input type="submit" class="btn btn-primary" name="prof" value="Escolher">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div>



    <script>
        $(document).ready(function(){
            $("#profissao").modal();
        });
    </script>

    <?php

  }

    ?>


        <?php
    $tabela = 'profissional';
    $campo = 'usuario_pro';
    $id = $_SESSION['usuario'];

      $result = $conexao->getRead($tabela, $campo, $id);
      $cod = $result['cod_pro'];
      if ($result['doc_pro'] == -1) {

    ?>

        <div class="modal fade" id="imagem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3>Envie as imagens de seus documentos pessoais</h3>
        <h5 class="modal-title" id="exampleModalLabel"></h5>
      </div>
      <form action="../function/profissional.php"  enctype="multipart/form-data"  method="post">
      <div class="modal-body">
        <div class="form-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="pic">
          </div>
      </div>
      </div>
      <div class="modal-footer">
        <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Enviar">
      </div>
      </div>
      </form>
    </div>
  </div>
</div>



    <script>
        $(document).ready(function(){
            $("#imagem").modal();
        });
    </script>

    <?php

  }

    ?>
    <!-- Final do Modal de Cadastro de Profissão -->
    
    <!-- Começa o Footer -->
    <footer class="page-footer font-small indigo">
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2019 Copyright: GoWork</div>
      <!-- Copyright -->
    </footer>
    <!-- Termina o Footer -->
  </body>
</html>