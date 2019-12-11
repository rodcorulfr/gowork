<?php
 session_start();
  include('conexao.php');
  require_once '../Graph/phplot.php';

  $conexao = new conectar();

  if ($_GET['tipo'] == 'orc') {
    $tabela = 'profissional';
    $campo = 'usuario_pro';
    $id = $_SESSION['usuario'];

    $result = $conexao->getRead($tabela, $campo, $id);
    $cod = $result['cod_pro'];

  $tabela = 'pedido';

  $parameter = "prof_1 = ".$cod." OR prof_2 = ".$cod." OR prof_3 = ".$cod;

  $result = $conexao->getReadAllOR($tabela,$parameter);
  $countX = 0;
  $countA = 0;
  $countC = 0;
  foreach ($result as $a) {
    if ($a['status_prof1'] == "Pendente" && $a['prof_1'] == $cod) {
      $countC++;
    }elseif ($a['status_prof2'] == "Pendente" && $a['prof_2'] == $cod) {
      $countC++;
    }elseif ($a['status_prof3'] == "Pendente" && $a['prof_3'] == $cod) {
      $countC++;
    }

    if ($a['prof_1'] == $cod && $a['status_prof1'] == "Recusado") {
      $countX++;
    }elseif ($a['prof_2'] == $cod && $a['status_prof2'] == "Recusado") {
      $countX++;
    }elseif ($a['prof_3'] == $cod && $a['status_prof3'] == "Recusado") {
      $countX++;
    }

    if ($a['prof_1'] == $cod && $a['status_prof1'] == "Registrado") {
      $countA++;
    }elseif ($a['prof_2'] == $cod && $a['status_prof2'] == "Registrado") {
      $countA++;
    }elseif ($a['prof_3'] == $cod && $a['status_prof3'] == "Registrado") {
      $countA++;
    }
  }

  	   $data = array(
      array('Recusado', $countX),
      array('Registrado', $countA),
      array('Pendente', $countC),
    );

    $plot = new PHPlot(900,700);
    $plot->SetImageBorderType('plain');

    $plot->SetPlotType('pie');
    $plot->SetDataType('text-data-single');
    $plot->SetDataValues($data);

    # Set enough different colors;
    $plot->SetDataColors(array('red', 'green', 'blue'));

    # Main plot title:
    $plot->SetTitle("Pedidos");

    # Build a legend from our data array.
    # Each call to SetLegend makes one line as "label: value".
    foreach ($data as $row)
      $plot->SetLegend(implode(': ', $row));
    # Place the legend in the upper left corner:
    $plot->SetLegendPixels(5, 5);

    $plot->DrawGraph();
  }else if ($_GET['tipo'] == 'ped') {
  	$tabela = 'profissional';
  	$campo = 'usuario_pro';
  	$id = $_SESSION['usuario'];

  	$result = $conexao->getRead($tabela, $campo, $id);
  	$cod = $result['cod_pro'];

  	$tabela = 'pedido';
  	$campo = 'cod_pro';

  	$result = $conexao->getReadAll($tabela, $campo, $cod);
  	$countX = 0;
  	$countA = 0;
  	$countC = 0;

  	foreach ($result as $a) {
  		if ($a['status_pd'] == "Cancelado") {
  			$countX++;
  		}else if ($a['status_pd'] == "Ativo") {
  			$countA++;
  		}else if ($a['status_pd'] == "Concluido") {
  			$countC++;
  		}
  	}

		$data = array(
		  array('Cancelado', $countX),
		  array('Ativo', $countA),
		  array('Concluido', $countC),
		);

		$plot = new PHPlot(900,700);
		$plot->SetImageBorderType('plain');

		$plot->SetPlotType('pie');
		$plot->SetDataType('text-data-single');
		$plot->SetDataValues($data);

		# Set enough different colors;
		$plot->SetDataColors(array('red', 'green', 'blue'));

		# Main plot title:
		$plot->SetTitle("Pedidos");

		# Build a legend from our data array.
		# Each call to SetLegend makes one line as "label: value".
		foreach ($data as $row)
		  $plot->SetLegend(implode(': ', $row));
		# Place the legend in the upper left corner:
		$plot->SetLegendPixels(5, 5);

		$plot->DrawGraph();
  }

?>