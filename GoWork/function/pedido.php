<?php
  session_start();
  include('conexao.php');

  $conexao = new conectar();

  //Function Cadastrar
  if (isset($_POST['pedido'])) {

	$end = trim($_POST['endereço']);
	$comp = trim($_POST['complemento']);
	$bair = trim($_POST['bairro']);
	$local = trim($_POST['localidade']);
	$cep = trim($_POST['cep']);
	$dsc_pd     = trim($_POST['dsc_pd']);
	$data_est = trim($_POST['dataest']);
	$tabela = 'pedido';
	$trazer = $conexao->getRead('cliente', 'usuario_cli', $_SESSION['usuario']);
	$cod_cli = $trazer['cod_cli'];
	$end_compl = $end." - ".$comp;

	$dia_h = date('d');
	$mes_h = date('m');
	$ano_h = date('Y');

	$dia = $data_est[8]."".$data_est[9];
	$mes = $data_est[5]."".$data_est[6];
	$ano = $data_est[0]."".$data_est[1]."".$data_est[2]."".$data_est[3];

	if ($ano-$ano_h<0 || $mes-$mes_h<0) {
		$_SESSION['pedido_data'] = true;
		header('Location: ../page/cli_cadastrar_pd.php');
		exit();
	}else if ($mes-$mes_h == 0 && $dia-$dia_h<0) {
		$_SESSION['pedido_data'] = true;
		header('Location: ../page/cli_cadastrar_pd.php');
		exit();
	}

	$campos = 'cod_cli, cod_serv, end_pd, bairro_pd, local_pd, cep_pd, dsc_pd, data_pd, data_limit, status_pd, status_prof1, status_prof2, status_prof3';
	$dados = "'$cod_cli','1', '$end_compl', '$bair', '$local', '$cep', '$dsc_pd', NOW(), '$data_est', 'Pendente', 'Pendente', 'Pendente', 'Pendente' ";

	$sql = $conexao->getInsert($tabela,$campos,$dados);
	$id = $conexao->getShowTable('pedido');
	$auto = $id['Auto_increment']-1;

	if ($sql==true) {
		$i=0;
		$result = $conexao->getReadAll('pro_prof', 'cod_prof', 1);
		$count = $conexao->getCount('pro_prof', 'cod_prof', 1);

		if ($_POST['pedido'] == 1) {
			$randoms = [];
			for ($i=0; $i < 3; $i++) {
				
			do {
				$rando = rand(0, $count[0]-1);
				$randoms[$i] = $rando;
			} while (array_count_values($randoms)[$rando] > 1);

			$valor_f[$i] = $result[$rando][0];
			$insert = $conexao->getUpdate('pedido', 'cod_pd',$auto, "prof_".($i+1)." = ".$valor_f[$i]);
			}
		}else if($_POST['pedido'] == 2){
			foreach ($_POST['options'] as $a) {
				$i++;
				$insert = $conexao->getUpdate('pedido', 'cod_pd',$auto, "prof_$i = $a");
			}
		}

		

		$_SESSION['status_cadastro_pd'] = true;
		header('Location: ../page/cli_cadastrar_pd.php');
		exit();
		
	}else{
		$_SESSION['status_ncadastro_pd'] = true;
		header('Location: ../page/cli_cadastrar_pd.php');
		exit();
	}
	
  }

  //Function Read
  	function ConsultarUser(){
  		$tabela = 'cliente';
        $campo = 'usuario_cli';
        $id = $_SESSION['usuario'];

        $result = $conexao->getRead($tabela, $campo, $id);

        return $result;
  	}

  //Function Update
  	if (isset($_POST['alterar'])) {

	  	$id = $_GET['cod'];
		$end = trim($_POST['endereço']);
		$comp = trim($_POST['complemento']);
		$bair = trim($_POST['bairro']);
		$local = trim($_POST['localidade']);
		$cep = trim($_POST['cep']);
		$dsc_pd = trim($_POST['dsc_pd']);

		$end_compl = $end." - ".$comp;

		$dados = "end_pd = '$end_compl', bairro_pd = '$bair', local_pd = '$local', cep_pd = '$cep', dsc_pd = '$dsc_pd'";

		$sql = $conexao->getUpdate('pedido', 'cod_pd', $id, $dados);

		if ($sql == 1) {
			header('Location: ../page/cli_meus_pd.php');
			exit();
		}else{
			echo "Deu Erro";
			exit();
		}

  	}
	
  	//Function Deletar
  	if (isset($_GET['delete'])) {

  		$cod = $_GET['delete'];
  		echo "Entrou : ".$codi;
  		$fun = $conexao->getDelete('pedido', 'cod_pd', $cod);

  		if (isset($fun)){ 
  			header('Location: ../page/cli_meus_pd.php');
  		}else{
  			echo "Error";
  		}

  	}

	//Function aceitar orçamento  	
	if (isset($_GET['aceitar'])) {
		$cod_orc = $_GET['aceitar'];
		$result = $conexao->getReadAll('orcamento', 'cod_orc', $cod_orc);

		$id = $result[0][2];
		$cod_pro = $result[0][1];
		$valor_pd = $result[0][4];

		$dados = "cod_pro = '$cod_pro', valor_pd = '$valor_pd' , status_pd = 'Ativo', data_aceit = NOW(), status_pd2 = 'a'";

		$sql = $conexao->getUpdate('pedido', 'cod_pd', $id, $dados);

		if ($sql == 1) {
			header('Location: ../page/cli_meus_pd.php');
			exit();
		}else{
			echo "Deu Erro";
			exit();
		}

		
	}

	//Function concluir pedido 	
	if (isset($_GET['concluir'])) {
		$id = $_GET['concluir'];
		$dados = "data_conc = NOW(), status_pd = 'Concluido' , status_pd2 = 'b'";

		$sql = $conexao->getUpdate('pedido', 'cod_pd', $id, $dados);

		if ($sql == 1) {
			header('Location: ../page/cli_meus_pd.php');
			exit();
		}else{
			echo "Deu Erro";
			exit();
		}

		
	}

	//Function Avaliar profissional
	if (isset($_POST['avaliar'])) {
		$valor = $_POST['avaliacao'];
		$id = $_GET['cod_pro'];
		$cod_pd = $_GET['cod_pd'];

		echo "Cod_pd: ".$cod_pd;		

		$trazer = $conexao->getReadAll('profissional', 'cod_pro', $id);

		$qtd_at = $trazer[0]['qtd_pd'];
		$ava_at = $trazer[0]['ava_tt'];

		$qtd_f = $qtd_at+1;
		$ava_f = $ava_at + $valor;
		$valor_f = $ava_f / $qtd_f;

		$dados = "ava_pro = '$valor_f', qtd_pd = '$qtd_f', ava_tt = '$ava_f'";

		$sql = $conexao->getUpdate('profissional', 'cod_pro', $id, $dados);
		
		$dados2 = "status_pd2 = 'c'";
		$sql = $conexao->getUpdate('pedido', 'cod_pd', $cod_pd, $dados2);

		if ($sql == 1) {
			header('Location: ../page/cli_meus_pd.php');
			exit();
		}else{
			echo "Deu Erro";
			exit();
		}
	}

?>



  