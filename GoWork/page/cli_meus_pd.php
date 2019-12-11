<?php
session_start();
include('../function/conexao.php');
$conexao = new conectar();
$trazer = $conexao->getRead('cliente', 'usuario_cli', $_SESSION['usuario']);
$id = $trazer['cod_cli'];
$tabela = 'pedido';
$campo = 'cod_cli';
$result = $conexao->getReadAll($tabela, $campo, $id);
$result2 = $conexao->getReadAll('orcamento', $campo, $id);
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
          <h1>Meus pedidos</h1>
          <hr>
          <!--Começa Lista de Pedidos Pendentes-->
          <table class="table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th scope="col" style="text-align: center;">Profissão</th>
                <th scope="col" style="text-align: center;">Endereço</th>
                <th scope="col" style="text-align: center;">Bairro</th>
                <th scope="col" style="text-align: center;">Onde</th>
                <th scope="col" style="text-align: center;">Status</th>
                <th scope="col" style="text-align: center;">Opções</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($result as $item){
              echo "<tr>";
                if ($item[3]==1) {
                echo "<td>Pedreiro</td>";
                }
                echo "<td>$item[5]</td>";
                echo "<td>$item[6]</td>";
                echo "<td>$item[7]</td>";
                if ($item[14] == "Pendente" && empty($item[15])) {
                  echo "<td style='color: #337ab7; font-weight: bold'>$item[14]</td>";
                  echo "<td align='center'>
        
                  <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#detalhes$item[0]' title='Consultar detalhes do pedido'>Detalhes</button>

                  <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editar$item[0]' title='Editar Pedido'>
                  <span class='glyphicon glyphicon-pencil'></span>
                  </button>

                  <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#excluir$item[0]' title='Excluir Pedido'>
                  <span class='glyphicon glyphicon-remove'></span>
                  </button>

                </td>";
                }else if ($item[14] == "Pendente" && $item[15] == "a") {
                  echo "<td style='color: #337ab7; font-weight: bold'>$item[14]</td>";
                  echo "<td align='center'>

                  <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#detalhes$item[0]' title='Consultar detalhes do pedido'>Detalhes</button>

                  <a class='btn btn-success' href='cli_orcamentos.php?cod=$item[0]'><span class='glyphicon glyphicon-usd' title='Verificar Orçamentos'></span></a>

                  <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#excluir$item[0]' title='Excluir Pedido'>
                  <span class='glyphicon glyphicon-remove'></span>
                  </button>

                </td>";
                }else if ($item[14] == "Ativo" && $item[15] == "a") {
                  echo "<td style='color: #337ab7; font-weight: bold'>$item[14]</td>";
                  echo "<td align='center'>

                  <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#detalhes$item[0]' title='Consultar detalhes do pedido'>Detalhes</button>

                  <button type='button' class='btn btn-success' data-toggle='modal' data-target='#concluir$item[0]' title='Conclução de Pedido'>
                <span class='glyphicon glyphicon-ok'></span>
                </button>

                  <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#excluir$item[0]' title='Excluir Pedido'>
                  <span class='glyphicon glyphicon-remove'></span>
                  </button>

                </td>";
                }else if ($item[14] == "Cancelado") {
                  echo "<td style='color: #f90202; font-weight: bold'>$item[14]</td>";
                  echo "<td align='center'>

                  <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#detalhes$item[0]' title='Consultar detalhes do pedido'>Detalhes</button>

                  <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#excluir$item[0]' title='Excluir Pedido'>
                  <span class='glyphicon glyphicon-remove'></span>
                  </button>

                </td>";
                }else if ($item[14] == "Concluido" && $item[15] == "b") {
                  echo "<td style='color: #26bd26; font-weight: bold'>$item[14]</td>";
                  echo "<td align='center'>

                  <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#detalhes$item[0]' title='Consultar detalhes do pedido'>Detalhes</button>

                  <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#avaliar$item[0]' title='Avaliar Profissional'>
                  <span class='glyphicon glyphicon-thumbs-up'></span>
                  </button>
                   <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#excluir$item[0]' title='Excluir Pedido'>
                  <span class='glyphicon glyphicon-remove'></span>
                  </button>

                </td>";
                }else if ($item[14] == "Concluido" && $item[15] == "c") {
                  echo "<td style='color: #26bd26; font-weight: bold'>$item[14]</td>";
                  echo "<td align='center'>

                  <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#detalhes$item[0]' title='Consultar detalhes do pedido'>Detalhes</button>

                   <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#excluir$item[0]' title='Excluir Pedido'>
                  <span class='glyphicon glyphicon-remove'></span>
                  </button>

                </td>";
                }

                //   <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#detalhes$item[0]' title='Consultar detalhes do pedido'>Detalhes</button>

                //
                //   <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editar$item[0]' title='Editar Pedido'>
                //   <span class='glyphicon glyphicon-pencil'></span>
                //   </button>

                //   <a class='btn btn-success' href='cli_orcamentos.php?cod=$item[0]'><span class='glyphicon glyphicon-usd' title='Verificar Orçamentos'></span></a>

                //Concluir Pedido
                // <button type='button' class='btn btn-success' data-toggle='modal' data-target='#concluir$item[0]' title='Conclução de Pedido'>
                // <span class='glyphicon glyphicon-ok'></span>
                // </button>

                // Excluir Pedido
                //   <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#excluir$item[0]' title='Excluir Pedido'>
                //   <span class='glyphicon glyphicon-remove'></span>
                //   </button>
                echo "<div class='modal fade' id='avaliar$item[0]' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Avaliar Profissional</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>
                        
                        <form action='../function/pedido.php?cod_pro=$item[2]&cod_pd=$item[0]' method='post'>
                          <div class='form-group'>
                          <div class='form-group col-md-6' style='padding-left: 0px; padding-right: 10px'>
                              <label for='inputEmail4'>Avaliação em relação ao serviço ? <p>De 0 à 10<p></label>
                            </div>
                          
                            <div class='form-group col-md-4' style='padding-left: 0px; padding-right: 10px'>
                              <input type='text' class='form-control' placeholder='Ex: 0-10' name='avaliacao' required>
                            </div>
                          </div>

                          <div class='row content'>
                            <div class='col-sm-8'></div>
                              <div class='col-sm-2'>
                                <button class='btn btn-danger pull-right' type='reset'><span class='glyphicon glyphicon-trash'></span> Limpar</button>
                              </div>
                              <div class='col-sm-2'>
                                  <button class='btn btn-primary pull-right' name='avaliar' type='submit'><span class='glyphicon glyphicon-ok'></span> Enviar</button>
                              </div>
                          </div>
                        </form>
                        
                      </div>
                    </div>
                  </div>
                </div>";
                echo "<div class='modal fade' id='excluir$item[0]' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Excluir pedido</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>
                        <h3> Deseja realmente excluir esse pedido ?</h3>
                        
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                        <a href='../function/pedido.php?delete=$item[0]' class='btn btn-danger' role='button'>Excluir pedido</a>
                      </div>
                    </div>
                  </div>
                </div>";
                echo "<div class='modal fade' id='concluir$item[0]' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>
                        <h3> Deseja realmente concluir o pedido?</h3>
                        
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                        <a href='../function/pedido.php?concluir=$item[0]' class='btn btn-success' role='button'>Concluir pedido</a>
                      </div>
                    </div>
                  </div>
                </div>";
                echo "<div class='modal fade' id='detalhes$item[0]' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Detalhes do Pedido</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>
                        
                        <div class='container-fluid bg-3' style='word-break: break-all;'>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <strong>Endereço: </strong><br>$item[5]
                            </div>
                            <div class='col-sm-6'>
                              <strong>Local: </strong><br>$item[7]
                            </div>
                          </div><br>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <strong>Profissional: </strong><br>$item[2]
                            </div>
                            <div class='col-sm-6'>
                              <strong>Valor R$: </strong><br>$item[4]
                            </div>
                          </div><br>
                          <div class='row'>
                            <div class='col-sm-12'>
                              <strong>Descrição: </strong><br>$item[9]
                            </div>
                          </div><br>
                          <div class='row'>
                            <div class='col-sm-4'>
                              <strong>Data Inicio: </strong><br>$item[10]
                            </div>
                            <div class='col-sm-4'>
                              <strong>Data Estimada: </strong><br>$item[11]
                            </div>
                            <div class='col-sm-4'>
                              <strong>Data de Conclusão: </strong><br>$item[13]
                            </div>
                          </div>
                        </div><br>
                        
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                      </div>
                    </div>
                  </div>
                </div>";
                echo "<div class='modal fade' id='editar$item[0]' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Alterar Dados do Pedido</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>
                        <form action='../function/pedido.php?cod=$item[0]' method='post'>
                          <div class='form-group'>
                            <div class='form-group col-md-8' style='padding-left: 0px; padding-right: 10px'>
                              <label for='inputEmail4'>Endereço onde o serviço será realizado</label><label style='color: red; padding-left: 5px'>*</label>
                              <input type='text' class='form-control' id='exampleFormControlInput1' placeholder='Endereço Completo' name='endereço' required value='$item[5]'>
                            </div>
                            <div class='form-group col-md-4' style='padding-left: 5px; padding-right: 0px'>
                              <label for='inputPassword4'>Complemento</label><label style='color: red; padding-left: 5px'>*</label>
                              <input type='text' class='form-control' id='exampleFormControlInput1' placeholder='Ex: Nº, Cond., Edf., Apart.' name='complemento'>
                            </div>
                          </div>
                          <div class='form-group'>
                            <div class='form-group col-md-4' style='padding-left: 0px; padding-right: 10px'>
                              <label for='inputEmail4'>Bairro</label><label style='color: red; padding-left: 5px'>*</label>
                              <input type='text' class='form-control' id='exampleFormControlInput1' placeholder='Bairro' name='bairro' required value='$item[6]'>
                            </div>
                            <div class='form-group col-md-4' style='padding-left: 5px; padding-right: 10px'>
                              <label for='inputPassword4'>Localidade</label><label style='color: red; padding-left: 5px'>*</label>
                              <input type='text' class='form-control' id='exampleFormControlInput1' placeholder='Cidade/UF' name='localidade' required value='$item[7]'>
                            </div>
                            <div class='form-group col-md-4' style='padding-left: 5px; padding-right: 0px'>
                              <label for='inputEmail4'>CEP</label><label style='color: red; padding-left: 5px'>*</label>
                              <input type='text' class='form-control' id='exampleFormControlInput1' placeholder='CEP' name='cep' required value='$item[8]'>
                            </div>
                          </div>
                          <div class='form-group'>
                            <label for='exampleFormControlTextarea1'>Descreva o seu pedido</label><label style='color: red; padding-left: 5px'>*</label>
                            <a tabindex='0' class='btn btn-secundary ml-2' role='button' data-toggle='popover' data-placement='right' data-trigger='focus' title='Descrição' data-content='Neste campo você deve preencher todos os dados
                              referentes ao pedido, no qual será ultilizado pro profissional no momento em que ele irá gerar o orçamento. Ex: Onde será, quantos, e alguns dados que achar necessário informar.' style='padding-left: 5px'>
                              <span class='glyphicon glyphicon-info-sign' style='font-size: 15px' ></span>
                            </a>
                            <textarea class='form-control' id='exampleFormControlTextarea1' rows='8' name='dsc_pd' required>$item[9]</textarea>
                          </div>
                          
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                          <button class='btn btn-primary pull-right' name='alterar' type='submit'><span class='glyphicon glyphicon-ok'></span> Salvar mudanças</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>";
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