<?php
 session_start();
  include('conexao.php');

  $conexao = new conectar();

  //Function Logout
  	if (isset($_GET['logout'])) {
  		header('Location: ../index.php');
  		session_destroy(); 
  		exit();
  	}

  //Function Login
  if (isset($_POST['submit'])) {
  	if (empty($_POST['login']) || empty($_POST['senha'])) {
		header('Location: ../page/login.php');
		exit();
	}

  	$login = $_POST['login'];
	$senha = $_POST['senha'];

  	$user = $conexao->getLogin($login,$senha,'profissional','usuario_pro','senha_pro');
 
   	if (empty($user)) {
   		$_SESSION['nao_aut'] = true;
		header('Location: ../page/login.php');
		exit();
		
	}else{
		$_SESSION['usuario'] = $login;
		header('Location: ../page/pro_inicio.php');
		exit();
	}
  }


  //Function Cadastrar
  if (isset($_POST['cadastrar'])) {

  $nome     = trim($_POST['nome']);
  $sobren   = trim($_POST['sobren']);
  $usuario  = trim($_POST['usuario']);
	$email    = trim($_POST['email']);
  $_SESSION['email_pro'] = trim($_POST['email']);
	$senha    = trim($_POST['senha']);
  $senha2   = trim($_POST['senha2']);
	$cpf      = trim($_POST['cpf']);
  $cpfT     = trim($_POST['cpf']);
	$telefone = trim($_POST['telefone']);
	$celular  = trim($_POST['celular']);
	$escolar  = trim($_POST['escolaridade']);
	$sexo     = trim($_POST['sexo']);

  if ($senha==$senha2) {

			// Função de validação do CPF
	 if (isset($cpfT)) {
 
    // Extrai somente os números
    $cpfT = preg_replace("/[^0-9]/", "", $cpfT);
	$cpfT = str_pad($cpfT, 11, '0', STR_PAD_LEFT);
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpfT) != 11) {
    	$_SESSION['erro'] = 'cpf';
        header('Location: ../page/pro_cadastro.php');
        exit();
    }
    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match("/(\d)\1{10}/", $cpfT)) {
    	$_SESSION['erro'] = 'cpf';
        header('Location: ../page/pro_cadastro.php');
        exit();
    }
    // Faz o calculo para validar o CPF
            if ($cpfT == '00000000000' || 
    $cpfT == '11111111111' || 
    $cpfT == '22222222222' || 
    $cpfT == '33333333333' || 
    $cpfT == '44444444444' || 
    $cpfT == '55555555555' || 
    $cpfT == '66666666666' || 
    $cpfT == '77777777777' || 
    $cpfT == '88888888888' || 
    $cpfT == '99999999999') {
     $_SESSION['erro'] = 'cpf';
        header('Location: ../page/pro_cadastro.php');
        exit();
   }else{
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpfT{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpfT{$c} != $d) {
        $_SESSION['erro'] = 'cpf';
        header('Location: ../page/pro_cadastro.php');
        exit();
        }
    }

   }

}


	$tabela = 'profissional';


	$result = $conexao->getCount($tabela,'usuario_pro',$usuario);

	print_r($result);

	if ($result[0]==1) {
		$_SESSION['usuario_existe'] = true;
		header('Location: ../page/pro_cadastro.php');
		exit;	
	}
	
	$campos = 'nome_pro, sobren_pro, usuario_pro,email_pro, senha_pro, cpf_pro, tel_pro, cel_pro, sex_pro, esc_pro, doc_pro, aut_pro, datac_pro';
	$dados = "'$nome', '$sobren', '$usuario','$email', '$senha', '$cpf', '$telefone', '$celular', '$sexo', '$escolar', -1, 0, NOW()";

	$sql = $conexao->getInsert($tabela,$campos,$dados);

	if ($sql==true) {
		$_SESSION['status_cadastro'] = true;
    $_SESSION['n_aut_pro'] = true;
		header('Location: ../page/t_emailAutenP.php');
		exit();
	}else{
		$_SESSION['status_cadastro'] = false;
		echo "Deu erro";
	}
	exit;
  }else{
    $_SESSION['senha_n'] = true;
    echo "Erro na senha";
    header('Location: ../page/cli_cadastro.php');
  }
  }

  //Function UpdateSenha
  	if (isset($_POST['update-senha'])) {
  		
  		$senha_atual = trim($_POST['senha_a']);
  		$senha_nova = trim($_POST['senha_n']);
  		$senha_novav = trim($_POST['senha_nv']);

	  	$user = $conexao->getLogin($_SESSION['usuario'],$senha_atual,'profissional','usuario_pro','senha_pro');
	 
	   	if (empty($user)) {
	   		$_SESSION['senha_aaut'] = true;
	   		header('Location: ../page/pro_perfil_mudarsenha.php');
			exit();		
		}else{
			if ($senha_nova == $senha_novav) {
				$tabela = 'profissional';
				$formt = "senha_pro='$senha_nova'";
				$sql = $conexao->getUpdate($tabela,'usuario_pro',$_SESSION['usuario'], $formt);			
				$_SESSION['senha_aut'] = true;
				header('Location: ../page/pro_perfil_mudarsenha.php');
				exit();
			}else{
				$_SESSION['senha_naut'] = true;
				header('Location: ../page/pro_perfil_mudarsenha.php');
				exit();	
			}			
		}
  	}

  //Function Update
  	if (isset($_POST['update'])) {

	  $nome     = trim($_POST['nome']);
    $sobren     = trim($_POST['sobren']);
		$email    = trim($_POST['email']);
		$cpf      = trim($_POST['cpf']);
		$telefone = trim($_POST['telefone']);
		$celular  = trim($_POST['celular']);
		$escolar  = trim($_POST['escolaridade']);
 		$sexo     = trim($_POST['sexo']);

      // Função de validação do CPF
   if (isset($cpfT)) {
 
    // Extrai somente os números
    $cpfT = preg_replace("/[^0-9]/", "", $cpfT);
  $cpfT = str_pad($cpfT, 11, '0', STR_PAD_LEFT);
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpfT) != 11) {
      $_SESSION['erro'] = 'cpf';
        header('Location: ../page/pro_perfil_alterar.php');
        exit();
    }
    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match("/(\d)\1{10}/", $cpfT)) {
      $_SESSION['erro'] = 'cpf';
        header('Location: ../page/pro_perfil_alterar.php');
        exit();
    }
    // Faz o calculo para validar o CPF
            if ($cpfT == '00000000000' || 
    $cpfT == '11111111111' || 
    $cpfT == '22222222222' || 
    $cpfT == '33333333333' || 
    $cpfT == '44444444444' || 
    $cpfT == '55555555555' || 
    $cpfT == '66666666666' || 
    $cpfT == '77777777777' || 
    $cpfT == '88888888888' || 
    $cpfT == '99999999999') {
     $_SESSION['erro'] = 'cpf';
        header('Location: ../page/pro_perfil_alterar.php');
        exit();
   }else{
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpfT{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpfT{$c} != $d) {
        $_SESSION['erro'] = 'cpf';
        header('Location: ../page/pro_perfil_alterar.php');
        exit();
        }
    }
   }


}

		$tabela = 'profissional';

		$formt = "nome_pro='$nome', sobren_pro='$sobren', email_pro='$email', cpf_pro='$cpf', tel_pro='$telefone', cel_pro='$celular', sex_pro='$sexo', esc_pro='$escolar'";

		$sql = $conexao->getUpdate($tabela,'usuario_pro',$_SESSION['usuario'], $formt);

		if ($sql == 1) {
			header('Location: ../page/pro_perfil.php');
			exit();
		}else{
			echo "Deu Erro";
			exit();
		}

  	}

  //Function Deletar
  	if (isset($_GET['delete'])) {

  		$fun = $conexao->getDelete('profissional', 'usuario_pro', $_SESSION['usuario']);

  		if (isset($fun)){
  			unset($_SESSION['usuario']);
  			header('Location: ../index.php');
  		}else{
  			echo "Error";
  		}

  	}
  //Function GerarPDF
  	if(isset($_GET['pdf'])){
  		
  	}

  //Function profissao
  	if (isset($_POST['prof'])) {
  		$tabela = 'profissional';
  		$campo = 'usuario_pro';
  		$usu = $_SESSION['usuario'];

  		$result = $conexao->getRead($tabela, $campo, $usu);
  		$id = $result['cod_pro'];
  		$prof = $_POST['profissao'];
  		$tabela = 'pro_prof';
  		$campo = 'cod_pro, cod_prof';
		  $dados = "'$id', '$prof'";

      $result = $conexao->getReadAllOR($tabela, "cod_pro = '$id' AND cod_prof = '$prof'");

		if ($result == false) {;
    $result = $conexao->getInsert($tabela,$campo,$dados);
		header('Location: ../page/pro_perfil_cad_serv.php');
    $_SESSION['profOK'] = 'x';
		exit();
		}else{
    header('Location: ../page/pro_perfil_cad_serv.php');
		$_SESSION['profNOT'] = 'x';
    exit();
		}

  	}

    //Function recusar orçamento
    if (isset($_GET['recusar'])) {
      $cod_pd = $_GET['cod_pd'];
      $cod_pro = $_GET['cod_pro'];

      $tabela = 'pedido';
      $campo = 'cod_pd';
      $parameter = "prof_1 = ".$cod_pro." OR prof_2 = ".$cod_pro." OR prof_3 = ".$cod_pro;

      $result = $conexao->getRead($tabela,$campo,$cod_pd);
      if ($result['prof_1'] == $cod_pro) {
        $result = $conexao->getUpdate($tabela,"cod_pd",$cod_pd,"status_prof1='Recusado'");
      }else if ($result['prof_2'] == $cod_pro) {
        $result = $conexao->getUpdate($tabela,"cod_pd",$cod_pd,"status_prof2='Recusado'");
      }else if ($result['prof_3'] == $cod_pro) {
        $result = $conexao->getUpdate($tabela,"cod_pd",$cod_pd,"status_prof3='Recusado'");
      }
      header('Location: ../page/pro_orc.php');
      exit();
    }

    //Function remover da lista de orçamento
    if (isset($_GET['deletar_orc'])) {
      $cod_pd = $_GET['cod_pd'];
      $cod_pro = $_GET['cod_pro'];

      $tabela = 'pedido';
      $campo = 'cod_pd';
      $parameter = "prof_1 = ".$cod_pro." OR prof_2 = ".$cod_pro." OR prof_3 = ".$cod_pro;

      $result = $conexao->getRead($tabela,$campo,$cod_pd);
      if ($result['prof_1'] == $cod_pro) {
        $result = $conexao->getUpdate($tabela,"cod_pd",$cod_pd,"prof_1='-1'");
      }else if ($result['prof_2'] == $cod_pro) {
        $result = $conexao->getUpdate($tabela,"cod_pd",$cod_pd,"prof_2='-1'");
      }else if ($result['prof_3'] == $cod_pro) {
        $result = $conexao->getUpdate($tabela,"cod_pd",$cod_pd,"prof_3='-1'");
      }
      header('Location: ../page/pro_orc.php');
      exit();
    }

    //Function registrar orçamento
    if (isset($_POST['registrar_orc'])) {
      $cod_pd = $_GET['cod_pd'];
      $cod_pro = $_GET['cod_pro'];
      $dsc_orc = $_POST['dsc_orc'];
      $val_orc = $_POST['val_orc'];

      $data_valid = date('Y-m-d', strtotime('+1 week'));

      $tabela = 'orcamento';
      $campos = 'cod_pro, cod_pd, dsc_orc, val_orc, data_orc, data_valid';
      $dados = "'$cod_pro', '$cod_pd', '$dsc_orc', $val_orc, NOW(), '$data_valid'";

      $result = $conexao->getInsert($tabela,$campos,$dados);

      $tabela = 'pedido';
      $campo = 'cod_pd';

      $result = $conexao->getUpdate('pedido','cod_pd',$cod_pd,"status_pd2 ='a'");

      $parameter = "prof_1 = ".$cod_pro." OR prof_2 = ".$cod_pro." OR prof_3 = ".$cod_pro;

      $result = $conexao->getRead($tabela,$campo,$cod_pd);
      if ($result['prof_1'] == $cod_pro) {
        $result = $conexao->getUpdate($tabela,"cod_pd",$cod_pd,"status_prof1='Registrado'");
      }else if ($result['prof_2'] == $cod_pro) {
        $result = $conexao->getUpdate($tabela,"cod_pd",$cod_pd,"status_prof2='Registrado'");
      }else if ($result['prof_3'] == $cod_pro) {
        $result = $conexao->getUpdate($tabela,"cod_pd",$cod_pd,"status_prof3='Registrado'");
      }
      header('Location: ../page/pro_orc.php');
      exit();
      }

    //Function editar orçamento
    if (isset($_POST['editar_orc'])) {
      $cod_pd = $_GET['cod_pd'];
      $cod_pro = $_GET['cod_pro'];
      $dsc_orc = $_POST['dsc_orc'];
      $val_orc = $_POST['val_orc'];

      $tabela = 'orcamento';
      $campo = 'cod_pd';
      $dados = "dsc_orc='$dsc_orc', val_orc='$val_orc'";

      $result = $conexao->getUpdate($tabela,$campo,$cod_pd,$dados);

      header('Location: ../page/pro_orc.php');
      exit();
      }

    //Function remover profissão
      if (isset($_GET['remover_prof'])) {
        $cod_prof = $_GET['cod_prof'];
        $cod_pro = $_GET['cod_pro'];

        $tabela = 'pro_prof';

        $result = $conexao->getDeleteANDOR($tabela, "cod_pro = '$cod_pro' AND cod_prof = '$cod_prof'");

        header('Location: ../page/pro_perfil_cad_serv.php');

        exit();
      }

    //Function gerar fatura
      if (isset($_GET['plano'])) {
        $cod_pac = $_GET['cod_pac'];
        $prz_pac = $_GET['prz_pac'];
        $val_pac = $_GET['val_pac'];
        $cod_pro = $_GET['cod_pro'];
        $data_valid = date('Y-m-d', strtotime('+1 week'));
        if ($prz_pac == 1) {
        $data_termino = date('Y-m-d', strtotime('+1 month'));
        }else if ($prz_pac == 3) {
        $data_termino = date('Y-m-d', strtotime('+3 month'));
        }else if ($prz_pac == 12) {
        $data_termino = date('Y-m-d', strtotime('+12 month'));
        }

        $campos = 'cod_pro, datv_fat, datt_fat, val_fat';
        $dados = "'$cod_pro', '$data_valid', '$data_termino', $val_pac";
        $result = $conexao->getInsert('fatura',$campos,$dados);
        if ($result == true) {
          $result2 = $conexao->getUpdate('profissional','cod_pro',$cod_pro,"cod_pac='$cod_pac'");
          header('Location: ../page/pro_plano.php?fatura=OK');
          exit();
        }else{
          header('Location: ../page/pro_plano.php?faturaNOT=OK');
          exit();
        }
        
      }
        
      if (isset($_FILES['pic'])) {
        $ext = strtolower(substr($_FILES['pic']['name'],-4));
        $novo_nome = date('Y-m-d_H-i-s').$ext;
        $resultx = $conexao->getRead('profissional','usuario_pro',$_SESSION['usuario']);
        $cod_pro = $resultx['cod_pro'];
        $dir = '.'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'documentos'.DIRECTORY_SEPARATOR;
        move_uploaded_file($_FILES['pic']['tmp_name'], $dir.$novo_nome);
        $dirBD = "documentos/$novo_nome";

        $result = $conexao->getUpdate('profissional','cod_pro',$cod_pro,"img_doc_pro = '$dirBD', doc_pro = '0'");
        header('Location: ../page/pro_inicio.php');
        exit();
        }

      if (isset($_GET['codaut'])) {
        echo "Entrou no CodAut";
    $upper = implode('', range('A', 'Z'));// Adicionando a variável $upper todas as letras maiúsculas ABCDEFGHIJKLMNOPQRSTUVWXYZ
    $lower = implode('', range('a', 'z'));// Adicionando a variável $lower todas as letras minúsculas abcdefghijklmnopqrstuvwxyzy
    $nums = implode('', range(0, 9)); // Adicionando a variável $nums todos os números 0123456789

    $alphaNumeric = $upper.$lower.$nums; // Concatenando todos as variáveis
    $autcodstr = '';
    $len = 10; // Definindo o número de caracteres
    for($i = 0; $i < $len; $i++) {
        $autcodstr .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
        //Escolhendo de forma aleatória entres as variáveis presentes na $alphaNumeric
    }

    //Enviando a chave por email para o usuário
    require '../vendor/autoload.php';

        $from = new SendGrid\Email(null, "gowork.contact.ifs@gmail.com");
        $subject = "Mensagem de contato";
        $to = new SendGrid\Email(null, $_SESSION['email_pro']);
        $content = new SendGrid\Content("text/html", "<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml'>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name='viewport' content='width=device-width'>
    <meta name='HandheldFriendly' content='true' />
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <!--[if gte IE 7]><html class='ie8plus' xmlns='http://www.w3.org/1999/xhtml'><![endif]-->
    <!--[if IEMobile]><html class='ie8plus' xmlns='http://www.w3.org/1999/xhtml'><![endif]-->
    <meta name='format-detection' content='telephone=no'>
    <meta name='x-apple-disable-message-reformatting'>
    <meta name='generator' content='EDMdesigner, www.edmdesigner.com'>
    <title></title>
    <link href='https://fonts.googleapis.com/css?family=Avenir' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'> <!--##custom-font-resource##-->
    <style type='text/css' media='screen'>
    * {line-height: inherit;}
    .ExternalClass * { line-height: 100%; }
    body, p{margin:0; padding:0; margin-bottom:0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none;} img{line-height:100%; outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;} a img{border: none;} a, a:link, .no-detect-local a, .appleLinks a{color:#5555ff !important; text-decoration: underline;} .ExternalClass {display: block !important; width:100%;} .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: inherit; } table td {border-collapse:collapse;mso-table-lspace: 0pt; mso-table-rspace: 0pt;} .mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {text-decoration: default; color: #5555ff !important; pointer-events: auto; cursor: default;} .no-detect a{text-decoration: none; color: #5555ff;
    pointer-events: auto; cursor: default;} {color: #5555ff;} span {color: inherit; border-bottom: none;} span:hover { background-color: transparent; }
    a[x-apple-data-detectors] {color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; }
    .nounderline {text-decoration: none !important;}
    h1, h2, h3 { margin:0; padding:0; }
    p {Margin: 0px !important; }
    table[class='email-root-wrapper'] { width: 600px !important; }
    body {
    background-color: #ffffff;
    background: #ffffff;
    }
    body { min-width: 280px; width: 100%;}
    td[class='pattern'] .c199p33r { width: 33.33333333333333%;}
    td[class='pattern'] .c200p33r { width: 33.333333333333336%;}
    </style>
    <style>
    @media only screen and (max-width: 599px),
    only screen and (max-device-width: 599px),
    only screen and (max-width: 400px),
    only screen and (max-device-width: 400px) {
    .email-root-wrapper { width: 100% !important; }
    .full-width { width: 100% !important; height: auto !important; text-align:center;}
    .fullwidthhalfleft {width:100% !important;}
    .fullwidthhalfright {width:100% !important;}
    .fullwidthhalfinner {width:100% !important; margin: 0 auto !important; float: none !important; margin-left: auto !important; margin-right: auto !important; clear:both !important; }
    .hide { display:none !important; width:0px !important;height:0px !important; overflow:hidden; }
    .c199p33r { width: 100% !important; float:none;}
    .c200p33r { width: 100% !important; float:none;}
    }
    </style>
    <style>
    @media only screen and (min-width: 600px) {
    td[class='pattern'] .c199p33r { width: 199px !important;}
    td[class='pattern'] .c200p33r { width: 200px !important;}
    }
    @media only screen and (max-width: 599px),
    only screen and (max-device-width: 599px),
    only screen and (max-width: 400px),
    only screen and (max-device-width: 400px) {
    table[class='email-root-wrapper'] { width: 100% !important; }
    td[class='wrap'] .full-width { width: 100% !important; height: auto !important;}
    td[class='wrap'] .fullwidthhalfleft {width:100% !important;}
    td[class='wrap'] .fullwidthhalfright {width:100% !important;}
    td[class='wrap'] .fullwidthhalfinner {width:100% !important; margin: 0 auto !important; float: none !important; margin-left: auto !important; margin-right: auto !important; clear:both !important; }
    td[class='wrap'] .hide { display:none !important; width:0px;height:0px; overflow:hidden; }
    .edm-social {width: 100% !important;}
    td[class='pattern'] .c199p33r { width: 100% !important; }
    td[class='pattern'] .c200p33r { width: 100% !important; }
    }
    @media screen and (-webkit-min-device-pixel-ratio:0) {
    .img258x164 { width: 258px !important; height: 164px !important;}
    .img37x37 { width: 37px !important; height: 37px !important;}
    }
    </style>
    <style>
    @media screen and (min-width: 600px) {
    .dh{
    display: none;
    }
    }
    </style>
    <!--[if (gte mso 9)|(IE)]>
    <style>
    .dh {
    display: none;
    }
    .dh table {
    mso-hide: all;
    }
    </style>
    <![endif]-->
    <!--[if (gte IE 7) & (vml)]>
    <style type='text/css'>
    html, body {margin:0 !important; padding:0px !important;}
    img.full-width { position: relative !important; }
    .img258x164 { width: 258px !important; height: 164px !important;}
    .img37x37 { width: 37px !important; height: 37px !important;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]>
    <style type='text/css'>
    .mso-font-fix-arial { font-family: Arial, sans-serif;}
    .mso-font-fix-georgia { font-family: Georgia, sans-serif;}
    .mso-font-fix-tahoma { font-family: Tahoma, sans-serif;}
    .mso-font-fix-times_new_roman { font-family: 'Times New Roman', sans-serif;}
    .mso-font-fix-trebuchet_ms { font-family: 'Trebuchet MS', sans-serif;}
    .mso-font-fix-verdana { font-family: Verdana, sans-serif;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]>
    <style type='text/css'>
    table, td {
    border-collapse: collapse !important;
    mso-table-lspace: 0px !important;
    mso-table-rspace: 0px !important;
    }
    .email-root-wrapper { width 600px !important;}
    .imglink { font-size: 0px; }
    </style>
    <![endif]-->
    <!--[if gte mso 15]>
    <style type='text/css'>
    table {
    font-size:0px;
    mso-margin-top-alt:0px;
    }
    .fullwidthhalfleft {
    width: 49% !important;
    float:left !important;
    }
    .fullwidthhalfright {
    width: 50% !important;
    float:right !important;
    }
    </style>
    <![endif]-->
    <STYLE type='text/css' media='(pointer) and (min-color-index:0)'>
    html, body {background-image: none !important; background-color: transparent !important; margin:0 !important; padding:0 !important;}
    </STYLE>
  </head>
  <body leftmargin='0' marginwidth='0' topmargin='0' marginheight='0' offset='0' style='font-family:Arial, sans-serif; font-size:0px;margin:0;padding:0;background: #ffffff !important;' bgcolor='#ffffff'>
    <style>
    @media screen yahoo and (max-width: 600px){
    .hide{
    display: none;
    overflow: hidden;
    }
    }
    </style>
    <!--[if t]><![endif]--><!--[if t]><![endif]--><!--[if t]><![endif]--><!--[if t]><![endif]--><!--[if t]><![endif]--><!--[if t]><![endif]-->
    <table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'  bgcolor='#ffffff' style='margin:0; padding:0; width:100% !important; background: #ffffff !important;'>
      <tr>
        <td class='wrap' align='center' valign='top' width='100%'>
          <center>
          <!-- content -->
          <div  style='padding:0px'>
            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
              <tr>
                <td valign='top'  style='padding:0px'>
                  <table cellpadding='0' cellspacing='0' width='600' align='center'  style='max-width:600px;min-width:240px;margin:0 auto' class='email-root-wrapper'>
                    <tr>
                      <td valign='top'  style='padding:0px'>
                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border:0px none'>
                          <tr>
                            <td valign='top' style='padding:0px'>
                              <table cellpadding='0' cellspacing='0' width='100%'>
                                <tr>
                                  <td  style='padding:0px'>
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%' class='full-width'>
                                      <tr>
                                        <td valign='top' align='center' style='padding:0px'>
                                          <table cellpadding='0' cellspacing='0' border='0' width='258' style='border:0px none' class='full-width'>
                                            <tr>
                                              <td valign='top' style='padding:0px'><img
                                                src='https://images.chamaileon.io/5db659bdd401420012e2a83b/GoWork-logo-min.png' width='258' height='164' alt=' border='0'  style='display:block;max-width:100%;height:auto' class='full-width img258x164'  />
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                      <tr>
                                        <td valign='top'  style='padding-top:20px;padding-right:20px;padding-bottom:2px;padding-left:2px'><div  style='text-align:left;font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif;font-size:16px;color:#000000;line-height:24px;mso-line-height:exactly;mso-text-raise:4px'><h1 style='font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif; font-size: 36px; color: #000000; line-height: 52px; mso-line-height: exactly; mso-text-raise: 8px; padding: 0; margin: 0;text-align: center;'><span class='mso-font-fix-arial'>BEM-VINDO A GO WORK</span></h1></div></td>
                                      </tr>
                                    </table>
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                      <tr>
                                        <td valign='top' style='padding-top:10px;padding-right:120px;padding-bottom:10px;padding-left:120px'>
                                          <table cellpadding='0' cellspacing='0' width='100%'>
                                            <tr>
                                              <td  style='padding:0px'>
                                                <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border-top:2px solid #00a591'>
                                                  <tr>
                                                    <td valign='top'>
                                                      <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                          <td  style='padding:0px'></td>
                                                        </tr>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                      <tr>
                                        <td valign='top'  style='padding:10px'><div  style='text-align:left;font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif;font-size:16px;color:#000000;line-height:24px;mso-line-height:exactly;mso-text-raise:4px'><p style='padding: 0; margin: 0;text-align: center;'>A Equipe Go Work fica muito feliz em ter um cliente como você.</p><p style='padding: 0; margin: 0;text-align: center;'>Agradecemos a preferência ao nosso sistema</p></div></td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
              <tr>
                <td valign='top'  style='padding:0px'>
                  <table cellpadding='0' cellspacing='0' width='600' align='center'  style='max-width:600px;min-width:240px;margin:0 auto' class='email-root-wrapper'>
                    <tr>
                      <td valign='top'  style='padding:0px'>
                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border:0px none'>
                          <tr>
                            <td valign='top' style='padding:0px'>
                              <table cellpadding='0' cellspacing='0' width='100%'>
                                <tr>
                                  <td  style='padding:0px'>
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                      <tr>
                                        <td valign='top' style='padding-top:10px;padding-bottom:10px'>
                                          <table cellpadding='0' cellspacing='0' width='100%'>
                                            <tr>
                                              <td  style='padding:0px'>
                                                <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border-top:1px solid #00a591'>
                                                  <tr>
                                                    <td valign='top'>
                                                      <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                          <td  style='padding:0px'></td>
                                                        </tr>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                      <tr>
                                        <td valign='top'  style='padding:10px'><div  style='text-align:left;font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif;font-size:16px;color:#000000;line-height:24px;mso-line-height:exactly;mso-text-raise:4px'><h3 style='font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif; font-size: 22px; color: #000000; line-height: 34px; mso-line-height: exactly; mso-text-raise: 6px; padding: 0; margin: 0;text-align: center;'><span class='mso-font-fix-arial'>Para completar o registo, introduza o código de verificação:</span></h3></div></td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                          <tr>
                            <td valign='top' style='padding-top:10px;padding-bottom:10px'>
                              <table cellpadding='0' cellspacing='0' width='100%'>
                                <tr>
                                  <td  style='padding:0px'>
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border-top:1px solid #00a591'>
                                      <tr>
                                        <td valign='top'>
                                          <table cellpadding='0' cellspacing='0' width='100%'>
                                            <tr>
                                              <td  style='padding:0px'></td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
              <tr>
                <td valign='top'  style='padding:0px'>
                  <table cellpadding='0' cellspacing='0' width='600' align='center'  style='max-width:600px;min-width:240px;margin:0 auto' class='email-root-wrapper'>
                    <tr>
                      <td valign='top'  style='padding:0px'>
                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border:0px none'>
                          <tr>
                            <td valign='top' style='padding:0px'>
                              <table cellpadding='0' cellspacing='0' width='100%'>
                                <tr>
                                  <td  style='padding:0px'>
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                      <tr>
                                        <td valign='top'  style='padding:10px'><div  style='text-align:left;font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif;font-size:16px;color:#000000;line-height:24px;mso-line-height:exactly;mso-text-raise:4px'><h3 style='font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif; font-size: 22px; color: #000000; line-height: 34px; mso-line-height: exactly; mso-text-raise: 6px; padding: 0; margin: 0;text-align: center;'><span class='mso-font-fix-arial' style='color:#FF0000;'>$autcodstr</span></h3></div></td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
              <tr>
                <td valign='top'  style='padding:0px'>
                  <table cellpadding='0' cellspacing='0' width='600' align='center'  style='max-width:600px;min-width:240px;margin:0 auto' class='email-root-wrapper'>
                    <tr>
                      <td valign='top'  style='padding:0px'>
                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border:0px none'>
                          <tr>
                            <td valign='top' style='padding:0px'>
                              <table cellpadding='0' cellspacing='0' width='100%'>
                                <tr>
                                  <td  style='padding:0px' class='pattern'>
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                      <tr>
                                        <td valign='top' style='padding-top:5px;padding-bottom:20px'>
                                          <table cellpadding='0' cellspacing='0' width='100%'>
                                            <tr>
                                              <td  style='padding:0px'>
                                                <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border-top:1px solid #00a591'>
                                                  <tr>
                                                    <td valign='top'>
                                                      <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                          <td  style='padding:0px'></td>
                                                        </tr>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                      <tr>
                                        <td valign='top'  style='padding:0;mso-cellspacing:0in'>
                                          <table cellpadding='0' cellspacing='0' border='0' align='left' width='199' id='c199p33r'  style='float:left' class='c199p33r'>
                                            <tr>
                                              <td valign='top'  style='padding:0px'>
                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                  <tr>
                                                    <td valign='top' style='padding:10px'>
                                                      <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                          <td  style='padding:0px'>
                                                            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                              <tr>
                                                                <td valign='top'>
                                                                  <table cellpadding='0' cellspacing='0' width='100%'>
                                                                    <tr>
                                                                      <td  style='padding:0px'></td>
                                                                    </tr>
                                                                  </table>
                                                                </td>
                                                              </tr>
                                                            </table>
                                                          </td>
                                                        </tr>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                          </table>
                                          <!--[if gte mso 9]></td><td valign='top' style='padding:0;'><![endif]-->
                                          <table cellpadding='0' cellspacing='0' border='0' align='left' width='199' id='c199p33r'  style='float:left' class='c199p33r'>
                                            <tr>
                                              <td valign='top'  style='padding:0px'>
                                                <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border:0px none'>
                                                  <tr>
                                                    <td valign='top' style='padding:0px'>
                                                      <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                          <td  style='padding:0px'>
                                                            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                              <tr>
                                                                <td valign='top' width='66'  style='padding:0px'>
                                                                  <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                    <tr>
                                                                      <td valign='top' align='center' style='padding:15px'>
                                                                        <table cellpadding='0' cellspacing='0' border='0' width='37' style='border:0px none'>
                                                                          <tr>
                                                                            <td valign='top' style='padding:0px'><img
                                                                              src='https://images.chamaileon.io/5af430d4a0870300120192f8/1460562865_06-facebook.png' width='37' height='37' alt=' border='0'  style='display:block' class='img37x37'  />
                                                                            </td>
                                                                          </tr>
                                                                        </table>
                                                                      </td>
                                                                    </tr>
                                                                  </table>
                                                                </td>
                                                                <td valign='top' width='66'  style='padding:0px'>
                                                                  <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                    <tr>
                                                                      <td valign='top' align='center' style='padding:15px'>
                                                                        <table cellpadding='0' cellspacing='0' border='0' width='37' style='border:0px none'>
                                                                          <tr>
                                                                            <td valign='top' style='padding:0px'><img
                                                                              src='https://images.chamaileon.io/5af430d4a0870300120192f8/1460562885_03-twitter.png' width='37' height='37' alt=' border='0'  style='display:block' class='img37x37'  />
                                                                            </td>
                                                                          </tr>
                                                                        </table>
                                                                      </td>
                                                                    </tr>
                                                                  </table>
                                                                </td>
                                                                <td valign='top' width='66'  style='padding:0px'>
                                                                  <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                    <tr>
                                                                      <td valign='top' align='center' style='padding:15px'>
                                                                        <table cellpadding='0' cellspacing='0' border='0' width='37' style='border:0px none'>
                                                                          <tr>
                                                                            <td valign='top' style='padding:0px'><img
                                                                              src='https://images.chamaileon.io/5af430d4a0870300120192f8/1460563162_38-instagram.png' width='37' height='37' alt=' border='0'  style='display:block' class='img37x37'  />
                                                                            </td>
                                                                          </tr>
                                                                        </table>
                                                                      </td>
                                                                    </tr>
                                                                  </table>
                                                                </td>
                                                              </tr>
                                                            </table>
                                                          </td>
                                                        </tr>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                          </table>
                                          <!--[if gte mso 9]></td><td valign='top' style='padding:0;'><![endif]-->
                                          <table cellpadding='0' cellspacing='0' border='0' align='left' width='200' id='c200p33r'  style='float:left' class='c200p33r'>
                                            <tr>
                                              <td valign='top'  style='padding:0px'>
                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                  <tr>
                                                    <td valign='top' style='padding:10px'>
                                                      <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                          <td  style='padding:0px'>
                                                            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                              <tr>
                                                                <td valign='top'>
                                                                  <table cellpadding='0' cellspacing='0' width='100%'>
                                                                    <tr>
                                                                      <td  style='padding:0px'></td>
                                                                    </tr>
                                                                  </table>
                                                                </td>
                                                              </tr>
                                                            </table>
                                                          </td>
                                                        </tr>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                      <tr>
                                        <td valign='top'  style='padding-top:10px;padding-right:10px;padding-bottom:30px;padding-left:10px'><div  style='text-align:left;font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif;font-size:14px;color:#000000;line-height:20px;mso-line-height:exactly;mso-text-raise:3px'><p style='padding: 0; margin: 0;text-align: center;'>Se não se registou em Go Work, ignore esta mensagem.<br><br>Cumprimentos, Serviço de Suporte Go Work.<br>E-mail: gowork.contact.ifs@gmail.com<br>&nbsp;</p><p style='padding: 0; margin: 0;text-align: center;'><span style='font-size:9px;'>Não será necessário responder a esta mensagem.</span></p><p style='padding: 0; margin: 0;text-align: center;'>&nbsp;</p></div></td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
          <!-- content end -->
          </center>
        </td>
      </tr>
    </table>
  </body>
</html>");
        $mail = new SendGrid\Mail($from, $subject, $to, $content);
        
        //Necessário inserir a chave
        $apiKey = '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';
        $sg = new \SendGrid($apiKey);

        $response = $sg->client->mail()->send()->post($mail);

        //Vamos pegar o código que foi gerado e atribuir ao banco de dados para a verificação

        $user_atual = $_SESSION['usuario'];
        $tabela = 'profissional';
        $formt = "codaut_pro='$autcodstr'";

        $sql = $conexao->getUpdate($tabela,'usuario_pro',$user_atual, $formt);

        $_SESSION['email_aut_t'] = true;
        header('Location: ../page/t_emailAutenP.php');

      }

    // Validando o código  
    if (isset($_POST['validarAut'])) {

      $codAut = trim($_POST['codigo']);
      echo $codAut;

      $tabela = 'profissional';
      $campo = 'codaut_pro';
      $id = $codAut;
      
      $result = $conexao->getRead($tabela, $campo, $id);

      echo '<br>'.$_SESSION['usuario'].'<br>';

      $user_atual = $_SESSION['usuario'];
      $formt = "aut_pro=1";

      $sql = $conexao->getUpdate($tabela,'usuario_pro',$user_atual, $formt);
      header('Location: ../page/pro_inicio.php');      

    }

    //Redefinindo a senha
    if (isset($_GET['redsenha']) && $_GET['redsenha']==1) {

        $upper = implode('', range('A', 'Z'));// Adicionando a variável $upper todas as letras maiúsculas ABCDEFGHIJKLMNOPQRSTUVWXYZ
        $lower = implode('', range('a', 'z'));// Adicionando a variável $lower todas as letras minúsculas abcdefghijklmnopqrstuvwxyzy
        $nums = implode('', range(0, 9)); // Adicionando a variável $nums todos os números 0123456789
        $alphaNumeric = $upper.$lower.$nums; // Concatenando todos as variáveis
        $senha = '';
        $len = 7; // Definindo o número de caracteres
        for($i = 0; $i < $len; $i++) {
        $senha .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
        //Escolhendo de forma aleatória entres as variáveis presentes na $alphaNumeric
        }

        $_SESSION['senha_rec_c'] = $senha;

        $user_atual = $_SESSION['email_rec_c'];
        $formt = "senha_pro='$senha'";
        $sql = $conexao->getUpdate( 'profissional','email_pro',$user_atual, $formt);
        header('Location: ../processa.php');

    }

?>