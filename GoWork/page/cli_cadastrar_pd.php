<?php
session_start();
include('../function/conexao.php');
require('../dataTabelas/conexao.php');
$conexao = new conectar();
$tabela = 'cliente';
$campo = 'usuario_cli';
$id = $_SESSION['usuario'];
$result = $conexao->getRead($tabela, $campo, $id);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
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
    margin-top: 50px;
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
    #my_form {
    display: none;
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
    <div class="jumbotron text-center">
      <h1>Novo pedido</h1>
      <p>Preencha todos os campos para que o profissional passe o melhor orçamento</p>
    </div>
    <div class="container container-fluid">
      <div class="row content">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
          <?php
          if (isset($_SESSION['status_cadastro_pd'])):
          ?>
          <div class="alert alert-success" role="alert">
            Cadastro realizado com sucesso
          </div>
          <?php
          endif;
          unset($_SESSION['status_cadastro_pd']);
          ?>
          <?php
          if (isset($_SESSION['status_ncadastro_pd'])):
          ?>
          <div class="alert alert-danger" role="alert">
            Erro inesperádo ao realizar o cadastro. Tente novamente mais tarde
          </div>
          <?php
          endif;
          unset($_SESSION['status_ncadastro_pd']);
          if (isset($_SESSION['pedido_data'])):
          ?>
          <div class="alert alert-danger" role="alert">
            Data estimada inválida
          </div>
          <?php
          endif;
          unset($_SESSION['pedido_data']);
          ?>
          <form action="../function/pedido.php" method="post">
            <div class="form-group">
              <div class="form-group col-md-8" style="padding-left: 0px; padding-right: 10px">
                <label for="inputEmail4">Endereço onde o serviço será realizado</label><label style="color: red; padding-left: 5px">*</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Endereço Completo" name="endereço" required>
              </div>
              <div class="form-group col-md-4" style="padding-left: 5px; padding-right: 0px">
                <label for="inputPassword4">Complemento</label><label style="color: red; padding-left: 5px">*</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ex: Nº, Cond., Edf., Apart." name="complemento" required>
              </div>
            </div>
            <div class="form-group">
              <div class="form-group col-md-4" style="padding-left: 0px; padding-right: 10px">
                <label for="inputEmail4">Bairro</label><label style="color: red; padding-left: 5px">*</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Bairro" name="bairro" required>
              </div>
              <div class="form-group col-md-4" style="padding-left: 5px; padding-right: 10px">
                <label for="inputPassword4">Localidade</label><label style="color: red; padding-left: 5px">*</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Cidade/UF" name="localidade" required>
              </div>
              <div class="form-group col-md-4" style="padding-left: 5px; padding-right: 0px">
                <label for="inputEmail4">CEP</label><label style="color: red; padding-left: 5px">*</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="CEP" name="cep" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-8">
                
              </div>
              <div class="form-group col-md-4" style="padding-left: 5px;">
                <label for="inputDate">Data Estimada</label><label style="color: red; padding-left: 5px">*</label>
                <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="CEP" name="dataest" required>
              </div>
              
            </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Descreva o seu pedido</label><label style="color: red; padding-left: 5px">*</label>
          <a tabindex="0" class="btn btn-secundary ml-2" role="button" data-toggle="popover" data-placement="right" data-trigger="focus" title="Descrição" data-content="Neste campo você deve preencher todos os dados
            referentes ao pedido, no qual será ultilizado pro profissional no momento em que ele irá gerar o orçamento. Ex: Onde será, quantos, e alguns dados que achar necessário informar." style="padding-left: 5px">
            <span class="glyphicon glyphicon-info-sign" style="font-size: 15px" ></span>
          </a>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" name="dsc_pd" required style="resize: none;"></textarea>
        </div>
        <div class="row content">
          <div class="col-sm-8">
            <p class="_58mv" style="font-size: 11px">Ao clicar em Enviar, você concorda com nossos <a href="##" id="terms-link" target="_blank" rel="nofollow">Termos</a>, <a href="##" id="privacy-link" target="_blank" rel="nofollow">Política de Dados</a> e <a href="##" id="cookie-use-link" target="_blank" rel="nofollow">Política de Cookies</a>.</p>
          </div>
          <div class="col-sm-2">
            <button class="btn btn-danger pull-right" type="reset"><span class="glyphicon glyphicon-trash"></span> Limpar</button>
          </div>
          <div class="col-sm-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
            <span class="glyphicon glyphicon-ok"></span> Cadastrar
          </button>
          </div>
          
        </div>
        <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="TituloModalCentralizado">Forma de solicitação de orçamento</h5>
          </div>
          <div class="modal-body">
            <div class="row text-center">
              <div class="col-sm-6">
                <button type="button" class="btn btn-light" id="profissional">
                 <span class="glyphicon glyphicon-list" style="font-size: 50px;color: #337ab7;"></span>
                </button>
                <h2>Escolher</h2>
              </div>
              <div class="col-sm-6">
                <button class="btn btn-light" name="pedido" value="1" type="submit">
                  <span class="glyphicon glyphicon-random" style="font-size: 50px;color: #337ab7;"></span>
                </button>
                <h2>Aleatóriamente</h2>
              </div>
            </div>

            <!-- Escolher o profissional pra quem ele vai querer mandar -->
            <br><div id="my_form" >
              <div class="form-group">
                <label for="exampleFormControlSelect2">Selecione o profissional (até 3)</label>
                <select multiple class="form-control" id="options" name="options[]">
                  <?php
                  
                  $query = "SELECT `nome_pro`,`sobren_pro`,profissional.`cod_pro` FROM `profissional` INNER JOIN `pro_prof` ON `profissional`.`cod_pro` = `pro_prof`.`cod_pro` AND `cod_prof` = 1";
                  $resultado = mysqli_query($conexao2, $query);
                  
                  while($row = mysqli_fetch_array($resultado)){
                    echo "<option value='$row[2]'>$row[0] $row[1]</option>";
                  }

                  ?>
                  </select>
                  <br>
                  <div class="row text-center">
                    <div class="col-sm-9">                     
                    </div>
                    <div class="col-sm-3">
                      <button type="submit" class="btn btn-primary" id="send" name="pedido" value="2">
                        <span class="glyphicon glyphicon-ok"></span> Cadastrar
                      </button>
                    </div>
                  </div>
                </div>
              </div><br>
          </div>
        </div>
      </div>
    </div>
      </form>
    </div>
  </div>
</div>


<!-- Começa o Footer -->
<footer class="page-footer font-small indigo">
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2019 Copyright:Go Work</div>
  <!-- Copyright -->
</footer>
<!-- Termina o Footer -->
<script src="datatable.js"></script>
<script src="dataTabelas/datatables.min.js"></script>
<script type="text/javascript">
$("#telefone").mask("(00) 0000-0000");
$("#celular").mask("(00) 00000-0000");
$("#cpf").mask("000.000.000-00");
$(function (){
$('[data-toggle="popover"]').popover()
})
var btn = document.getElementById('profissional');
var form = document.getElementById('my_form');

btn.addEventListener('click', function() {

if(form.style.display != 'block') {
form.style.display = 'block';
return;
}
form.style.display = 'none';
})

var controle = 0;
function myFunction() {
    
    if(controle ==0){
      document.getElementById("profissional").style.background = "blue";
        document.getElementById("aleatoriamente").style.background = "gray";
        document.getElementById("aleatoriamente").disabled = true;
        controle++;
        var escolher = "1"
          $.ajax({
              type      : 'post',
              url       : '../function/pedido.php',
              data      :  {escolher: 1},

              success: function (response) {
                  $('#id_mostro_produto').html(response);                                                
              },
              error: function(){
                  alert('Falha!');
              }
          });
          $.post(url, function(result) {

        });
        }
    else{
      document.getElementById("profissional").style.background = "blue";
        document.getElementById("aleatoriamente").style.background = "blue";
        document.getElementById("aleatoriamente").disabled = false;
        controle--;
        }
}
function myFunction2() {
    
    if(controle ==0){
        document.getElementById("aleatoriamente").style.background = "blue";
        document.getElementById("profissional").style.background = "gray";
        document.getElementById("profissional").disabled = true;
        document
        
        controle++;
        }
    else{
        document.getElementById("profissional").style.background = "blue";
        document.getElementById("aleatoriamente").style.background = "blue";
        document.getElementById("profissional").disabled = false;
        controle--;
        }
}
$(document).ready(function(){
  $("#options").change(function(){
    var total = $("#options :selected").length;

   if(total > 3){
     $("#send").prop("disabled", true);
   }else{
     $("#send").prop("disabled", false);
   }
  });
});
</script>
</body>
</html>