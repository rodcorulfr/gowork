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
  if (isset($_POST['login'])) {
    $resultADM = $conexao->getLogin($_POST['login'],$_POST['senha'],'adm','usuario_adm','senha_adm');
    if ($resultADM == true) {
      $_SESSION['usuario'] = $_POST['login'];
      header('Location: ../page/adm_inicio.php');
      exit();
    }
    if (isset($_POST['lembre'])) {
      $_SESSION['lembre'] = 'xxx';
    }
  	$cont=0;
  	if (empty($_POST['login']) || empty($_POST['senha'])) {
		header('Location: ../page/login.php');
		exit();
	}

  	$_SESSION['login'] = $_POST['login'];
    $login = $_POST['login'];
	  $senha = $_POST['senha'];


    if (filter_var($login, FILTER_VALIDATE_EMAIL) == true) {
        $user_c = $conexao->getLogin($login,$senha,'cliente','email_cli','senha_cli');
        $user_p = $conexao->getLogin($login,$senha,'profissional','email_pro','senha_pro');
        $campo = 'email_cli';
    }else{
        $user_c = $conexao->getLogin($login,$senha,'cliente','usuario_cli','senha_cli');
        $user_p = $conexao->getLogin($login,$senha,'profissional','usuario_pro','senha_pro');
        $campo = 'email_cli';
    }

  	if (empty($user_c) && empty($user_p)) {
   		$_SESSION['nao_aut'] = true;
		header('Location: ../page/login.php');
		exit();		
	}else{
		// $_SESSION['usuario'] = $login;
		if (isset($user_c) && empty($user_p)) {
      $tabela = 'cliente';
      $campo = 'email_cli';
      $result = $conexao->getRead($tabela, $campo, $login);
      $_SESSION['usuario'] = $result['usuario_cli'];
      $_SESSION['email'] = $result['email_cli'];
			header('Location: ../page/cli_inicio.php');
			exit();
  		}
  		else if (isset($user_p) && empty($user_c)) {
  		$tabela = 'profissional';
      $campo = 'email_pro';
      $result = $conexao->getRead($tabela, $campo, $login);
      $_SESSION['usuario'] = $result['usuario_pro'];
      $_SESSION['email'] = $result['email_pro'];
			header('Location: ../page/pro_inicio.php');
			exit();	
  		}else{
			$_SESSION['aut_dois'] = true;
      $_SESSION['usuario'] = $login;
			header('Location: ../page/login.php');
			exit();
  		}
	  } 	
  }

  if ($_GET['user']==1){
      $tabela = 'cliente';
      $campo = 'email_cli';
      $login = $_SESSION['login'];
      $result = $conexao->getRead($tabela, $campo, $login);
      $_SESSION['usuario'] = $result['usuario_cli'];
      $_SESSION['email'] = $result['email_cli'];
      header('Location: ../page/cli_inicio.php');
      exit();
  }

    if ($_GET['user']==2){
      $tabela = 'profissional';
      $campo = 'email_pro';
      $login = $_SESSION['login'];
      $result = $conexao->getRead($tabela, $campo, $login);
      $_SESSION['usuario'] = $result['usuario_pro'];
      $_SESSION['email'] = $result['email_pro'];
      header('Location: ../page/pro_inicio.php');
      exit();
  }

    //Function recuperar senha
    if (isset($_POST['recuperar_pass'])) {
      //Variavel que atribui o valor do email
      $id = $_POST['email'];
      $_SESSION['email_rec_c'] = $_POST['email'];
      echo $id.'<br>';
      
      $result_c = $conexao->getRead('cliente', 'email_cli', $id);
      $result_p = $conexao->getRead('profissional', 'email_pro', $id);

      if (empty($result_c) && empty($result_p) ) {
        $_SESSION['senha_rec_nop'] = true;        
        header('Location: ../page/recuperar_pass.php');
      }else if (isset($result_c) && empty($result_p)) {
        header('Location: cliente.php?redsenha=1');
      }else if (isset($result_p) && empty($result_c)) {
        header('Location: profissional.php?redsenha=1');
      }else{
        $_SESSION['senha_rec_2'] = true;
        header('Location: ../page/recuperar_pass.php');
      }
    }

    //Function autenticar cliente
    if (isset($_GET['codaut'])) {
    $upper = implode('', range('A', 'Z'));// Adicionando a variável $upper todas as letras maiúsculas ABCDEFGHIJKLMNOPQRSTUVWXYZ
    $lower = implode('', range('a', 'z'));// Adicionando a variável $lower todas as letras minúsculas abcdefghijklmnopqrstuvwxyzy
    $nums = implode('', range(0, 9)); // Adicionando a variável $nums todos os números 0123456789

    $alphaNumeric = $upper.$lower.$nums; // Concatenando todos as variáveis
    $autcodstr = '';
    $len = 12; // Definindo o número de caracteres
    for($i = 0; $i < $len; $i++) {
        $autcodstr .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
        //Escolhendo de forma aleatória entres as variáveis presentes na $alphaNumeric
    }

    //Enviando a chave por email para o usuário
    require '../vendor/autoload.php';

    $from = new SendGrid\Email(null, "gowork.contact.ifs@gmail.com");
    $subject = "Mensagem de contato";
    $to = new SendGrid\Email(null, $_SESSION['email_cli']);
    $content = new SendGrid\Content("text/html", "");
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
      
    //Necessário inserir a chave
    $apiKey = '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';
    $sg = new \SendGrid($apiKey);

    $response = $sg->client->mail()->send()->post($mail);

    //Vamos pegar o código que foi gerado e atribuir ao banco de dados para a verificação

    $user_atual = $_SESSION['usuario'];
    $tabela = 'cliente';
    $formt = "codaut_cli='$autcodstr'";

    $sql = $conexao->getUpdate($tabela,'usuario_cli',$user_atual, $formt);

    $_SESSION['email_aut_t'] = true;
    header('Location: ../page/t_emailAuten.php');

      }
