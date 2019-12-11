<?php
  session_start();
  include('conexao.php');

  $conexao = new conectar();

  if (isset($_POST['editar_pac'])) {
  	$cod_pac = $_GET['cod_pac'];
  	$val_pac = $_POST['val_pac'];

  	$dados = "val_pac = '$val_pac'";

  	$result = $conexao->getUpdate('pacote','cod_pac',$cod_pac,$dados);
  	header('Location: ../page/adm_pac.php?editar=x');
  	exit();
  }

  if (isset($_POST['registrar_prof'])) {
  	$dsc_prof = $_POST['nome_prof'];
  	$area_atu = $_POST['area_atu'];

  	$campos = "dsc_prof, area_atuacao";
  	$dados =  "'$dsc_prof','$area_atu'";

  	$result = $conexao->getInsert('profissao',$campos,$dados);
  	header('Location: ../page/adm_prof.php?registrar=OK');
  	exit();

  }

    if (isset($_POST['editar_prof'])) {
  	$dsc_prof = $_POST['nome_prof'];
  	$area_atu = $_POST['area_atu'];
  	$cod_prof = $_GET['cod_prof'];

  	$dados = "dsc_prof = '$dsc_prof', area_atuacao = '$area_atu'";

  	$result = $conexao->getUpdate('profissao','cod_prof',$cod_prof,$dados);

  	header('Location: ../page/adm_prof.php?editar=OK');
  	exit();
  }

  if (isset($_GET['remover_prof'])) {
  	$cod_prof = $_GET['cod_prof'];

  	$result = $conexao->getDelete('profissao','cod_prof',$cod_prof);

  	if ($result = true) {
  		$result = $conexao->getRead('pro_prof','cod_prof',$cod_prof);
  		if ($result = true) {
  		$result = $conexao->getDelete('pro_prof','cod_prof',$cod_prof);
  		header('Location: ../page/adm_prof.php?remover=OK');
  		exit();
  		}
  		header('Location: ../page/adm_prof.php?remover=OK');
  		exit();
  	}else {
  		header('Location: ../page/adm_prof.php?remover_erro=OK');
  		exit();
  	}

  }

  if (isset($_GET['confirmar_pro'])) {
    $cod_pro = $_GET['cod_pro'];
    $nome_pro = $_GET['nome_pro'];
    $dados = "doc_pro = '1'";
    $result = $conexao->getUpdate('profissional','cod_pro',$cod_pro,$dados);
    header('Location: ../page/adm_conf_pro.php?conf_pro=OK&nome_pro=$_GET[nome_pro]');
    exit();
  }

  if (isset($_GET['recusar_pro'])) {
    $cod_pro = $_GET['cod_pro'];
    $nome_pro = $_GET['nome_pro'];
    $dados = "doc_pro = '-1'";
    $result = $conexao->getUpdate('profissional','cod_pro',$cod_pro,$dados);
    header('Location: ../page/adm_conf_pro.php?recu_pro=OK&nome_pro=$_GET[nome_pro]');
    exit();
  }

?>