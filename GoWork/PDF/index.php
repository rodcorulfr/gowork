<?php
	
require_once __DIR__ . '/vendor/autoload.php';
$nome = $_POST['nome'];
$email = $_POST['email'];
$body = '

<link rel="stylesheet" href="../assets/css/css.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-1"></div>
    <div class="col-sm-10 text-center" style="border: 1px solid #000; margin-top: 20px;">
      <h3>Go Work</h3>
      <h5>Sistema de Contratação de Profissionais</h5>
    </div>
  </div>
  <div class="col-sm-1"></div>
</div>

<div class="container">
  <div class="row content">
    <div class="col-sm-1"></div>
    <div class="col-sm-10 text-left">
      <h1>Histórico meus atendimentos</h1>
      <hr>
      <!--Começa Lista de Pedidos Pendentes-->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Tipo</th>
            <th scope="col">Onde</th>
            <th scope="col">Local</th>
            <th scope="col">Valor R$</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">#5618</th>
            <td>Rodrigo</td>
            <td>Reformas</td>
            <td>Parede</td>
            <td>Casa</td>
            <td>900</td>
          </tr>
          <tr>
            <th scope="row">#3189</th>
            <td>João</td>
            <td>Reformas</td>
            <td>Pisos e revestimentos</td>
            <td>Apartamento</td>
            <td>800</td>
          </tr>
          <tr>
            <th scope="row">#5647</th>
            <td>Matheus</td>
            <td>Instalação</td>
            <td>Porta e Janelas</td>
            <td>Empresa</td>
            <td>1100</td>
          </tr>
          <tr>
            <th scope="row">#8107</th>
            <td>Victor</td>
            <td>Instalação</td>
            <td>Porta</td>
            <td>Casa</td>
            <td>600</td>
          </tr>
        </tbody>
      </table>
      <!--Termina Lista de Pedidos Pendentes-->
    </div>
  </div>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br>

<div class="container">
	<hr>
  <div class="row content">
    <div class="col-sm-12">
        <p class="text-center">Go Work Sistema de Contratação de Profissionais</p>
    </div>
  </div>
</div>
   
';
$mpdf = new \Mpdf\Mpdf();
$mpdf->allow_charset_conversion = true;
$mpdf->charset_in = 'UTF-8';
$mpdf->WriteHTML($body);
$mpdf->Output('teste.pdf','I');

?>
