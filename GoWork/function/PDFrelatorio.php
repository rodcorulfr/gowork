<?php
 session_start();
 if ($_GET['tipo'] == 'ped') {
	echo '<link rel="stylesheet" href="../assets/css/css.css"/>
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
  <a onclick="window.print()" style="cursor: pointer"> Imprimir</a>
    <div class="col-sm-1"></div>
    <div class="col-sm-10 text-left">
      <h1>Gráfico de Pedidos</h1>
      <hr>
      <img src="../function/relatorio.php?tipo=ped">
    </div>
  </div>
</div>

<div class="container">
  <hr>
  <div class="row content">
    <div class="col-sm-12">
        
    </div>
  </div>
</div>';
 }else{
	echo '<link rel="stylesheet" href="../assets/css/css.css"/>
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
  <a onclick="window.print()" style="cursor: pointer"> Imprimir</a>
    <div class="col-sm-1"></div>
    <div class="col-sm-10 text-left">
      <h1>Gráfico de Orçamentos</h1>
      <hr>
      <img src="../function/relatorio.php?tipo=orc">
    </div>
  </div>
</div>
<div class="container">
  <hr>
  <div class="row content">
    <div class="col-sm-12">
        
    </div>
  </div>
</div>';
 }

?>