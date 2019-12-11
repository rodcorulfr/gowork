<?php


class conectar {
	
		/**
		*@return \PDO
		*$table é a tabela
		*$info // são as informações especificar de casa crud
		*$parameter será o dado que usaremos como parametro, user ou cod_
		*$values são os dados (inseridos ou atualizados
		*/

	 private function getConnection(){

		$dsn  ='mysql:host=localhost;dbname=tcc;charset=utf8';
		$user ='root';
		$pass ='';

		try {

			$PDO = new PDO($dsn, $user, $pass);
			return $PDO;

		} catch (PPDOException $e) {
			echo "Erro: ".$e->getMessage();
		}

	}

	function getLogin($login, $senha, $tabela, $logindb, $senhadb){

		$conn = $this->getConnection();
		$user = $login;
		$pass = $senha;

		$sql = "SELECT $logindb FROM $tabela WHERE $logindb = '$user' AND $senhadb = '$pass'";
		$stmt = $conn->prepare($sql);
		

		if($stmt->execute()){
			$result = $stmt->fetch();
			return $result;

		}

	}

	function getInsert($tabela, $campos , $dados){

		$conn = $this->getConnection();
		$table = $tabela;
		$info = $campos;
		$values = $dados;

		$sql = "INSERT INTO $table ($info) VALUES ($values)";

		if ($conn->exec($sql)) {
			$insert = true;
			return $insert;
		}else{
			$insert = false;
			return $insert;
		}

	}

	function getRead($tabela, $campo, $id){

		$conn = $this->getConnection();
		$table = $tabela;
		$info = $campo;
		$parameter = $id;

		$sql = "SELECT * FROM $table WHERE $info = '$parameter'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();

		//Valores retornados do banco de dados de acordo com o parametro (primary)
		$result = $stmt->fetch();

		return $result;

	}

	function getReadAll($tabela, $campo, $id){

        $conn = $this->getConnection();

        	$sql = "SELECT * FROM $tabela WHERE $campo = '$id'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        //Valores retornados do banco de dados de acordo com o parametro (primary)
        $result = $stmt->fetchAll();

        return $result;

    }

    	function getReadAllOrder($tabela, $campo, $id, $order){

        $conn = $this->getConnection();

        	$sql = "SELECT * FROM $tabela WHERE $campo = '$id' $order";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        //Valores retornados do banco de dados de acordo com o parametro (primary)
        $result = $stmt->fetchAll();

        return $result;

    }

    	function getReadAllOR($tabela, $parameter){

        $conn = $this->getConnection();

      
        $sql = "SELECT * FROM $tabela WHERE $parameter";
       
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        //Valores retornados do banco de dados de acordo com o parametro (primary)
        $result = $stmt->fetchAll();

        return $result;

    }

    function getReadAllA($tabela){
    	$conn = $this->getConnection();

       	$sql = "SELECT * FROM $tabela";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        //Valores retornados do banco de dados de acordo com o parametro (primary)
        $result = $stmt->fetchAll();

        return $result;
    }

    function getOrder($tabela, $variavel, $modo){

    	$conn = $this->getConnection();

       	$sql = "SELECT * FROM `$tabela` ORDER BY `$variavel` $modo";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        //Valores retornados do banco de dados de acordo com o parametro (primary)
        $result = $stmt->fetchAll();

        return $result;
    }




	function getCount($tabela, $campo ,$id){

		$conn = $this->getConnection();
		$table = $tabela;
		$info = $campo;
		$parameter = $id;

		$sql = "SELECT count(*) as total FROM $table WHERE $info = '$parameter'";

		$stmt = $conn->prepare($sql);
		
		if($stmt->execute()){
			$result = $stmt->fetch();
			return $result;
		}

		

	}

	function getUpdate($tabela, $campo, $id, $dados){

		$conn = $this->getConnection();
		
		$sql = "UPDATE $tabela SET $dados WHERE $campo = '$id'";

		echo $sql;

		$stmt = $conn->prepare($sql);
	
		if ($stmt->execute()) {
			$result = 1;
			return $result;
		}else{
	 		echo "Erro ao atualizar";
		}

	}

	function getDelete($tabela, $campo, $id){

		$conn = $this->getConnection();
		$table = $tabela;
		$info = $campo;
		$parameter = $id;

		$sql = "DELETE FROM $tabela WHERE $info = '$parameter'";

		echo $sql;

		$stmt = $conn->prepare($sql);

		if ($stmt->execute()) {
			return $result = true;
			echo "Exluido com sucesso";
		}else{
	 		echo "Erro ao excluir";
		}

	}

		function getDeleteANDOR($tabela, $parameter){

		$conn = $this->getConnection();

		$sql = "DELETE FROM $tabela WHERE $parameter";

		echo $sql;

		$stmt = $conn->prepare($sql);

		if ($stmt->execute()) {
			return $result = true;
			echo "Exluido com sucesso";
		}else{
	 		echo "Erro ao excluir";
		}

	}

	function getShowTable($tabela){

		$conn = $this->getConnection();
		$table = $tabela;

		$sql = "SHOW TABLE STATUS LIKE '$table'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();

		//Valores retornados do banco de dados de acordo com o parametro (primary)
		$result = $stmt->fetch();

		return $result;

	}
}