<?php

//Pegar Dados dos Clientes
if (!empty($_POST['Cli_Id_At'])) {
  try{
    $Cli_Id = $_POST["Cli_Id_At"];
    include '../../db/conecta.php';

    $sql = $pdo->prepare("select Cli_Id, Cli_Nome, Cli_Telefone, Cli_Email, Cli_Endereco, Cli_Descricao, DATE_FORMAT( Cli_Ultima_Alteracao , '%d/%m/%Y Às %H:%i:%s' ) AS Cli_Ultima_Alteracao FROM Clientes WHERE Cli_Id = ? LIMIT 1");
    $sql->bindParam(1, $Cli_Id , PDO::PARAM_INT);
    $sql->execute();

    $result=$sql->fetchAll(PDO::FETCH_ASSOC);//FETCH_ASSOC
    //$output[] = $result;

    $json=json_encode($result);
    echo "$json";    

  }
  catch(PDOException $e){
    echo $e->getCode();
  }

//Deletar Clientes
}elseif (!empty($_POST['Cli_Id_Del'])) {
	try{
    $Cli_Id = $_POST["Cli_Id_Del"];
    include '../../db/conecta.php';

    $sql = $pdo->prepare("delete FROM Clientes WHERE Cli_Id = ?");
    $sql->bindParam(1, $Cli_Id , PDO::PARAM_INT);
    $sql->execute();

	$count = $sql->rowCount();

    if ($count == 1) {
    	echo "1";
    }else{
    	echo "Ocorreu um ERRO na execução da instrução!";
    }   

  }
  catch(PDOException $e){
    echo $e->getCode();
  }	


//Atualizar dados dos Clientes
}elseif (!empty($_POST)) {

	try{
      $json = $_POST;
		  $dados = json_decode(json_encode($json), true);

      if (isset($dados['idAt'])){
        $Cli_Nome = $dados['nomeAt'];
        $Cli_Telefone = $dados['telefoneAt'];
        $Cli_Email = $dados['emailAt'];
        $Cli_Endereco = $dados['enderecoAt'];
        $Cli_Descricao = $dados['descricaoAt'];
        $Cli_Id = $dados['idAt'];


        include '../../db/conecta.php';

        $sql = $pdo->prepare("update Clientes  SET Cli_Nome = ?, Cli_Telefone = ?, Cli_Email = ?, Cli_Endereco = ?, Cli_Descricao = ?, Cli_Ultima_Alteracao = NOW() WHERE Cli_Id = ?");
        $sql->bindParam(1, $Cli_Nome , PDO::PARAM_STR);
        $sql->bindParam(2, $Cli_Telefone , PDO::PARAM_STR);
        $sql->bindParam(3, $Cli_Email , PDO::PARAM_STR);
        $sql->bindParam(4, $Cli_Endereco , PDO::PARAM_STR);
        $sql->bindParam(5, $Cli_Descricao , PDO::PARAM_STR);
        $sql->bindParam(6, $Cli_Id , PDO::PARAM_INT);
        $sql->execute();

        $count = $sql->rowCount();
        

        if ($count == 1) {
          echo "1";
        }else{
          echo "Ocorreu um ERRO na execução da instrução!";
        }
      
      }elseif (!isset($dados['idAt'])) {
        $Cli_Nome = $dados['nomeCad'];
        $Cli_Telefone = $dados['telefoneCad'];
        $Cli_Email = $dados['emailCad'];
        $Cli_Endereco = $dados['enderecoCad'];
        $Cli_Descricao = $dados['descricaoCad'];

        include '../../db/conecta.php';

        $sql = $pdo->prepare("insert into Clientes (Cli_Nome, Cli_Telefone, Cli_Email, Cli_Endereco, Cli_Descricao, Cli_Ultima_Alteracao) values (?,?,?,?,?, NOW() )");
        $sql->bindParam(1, $Cli_Nome , PDO::PARAM_STR);
        $sql->bindParam(2, $Cli_Telefone , PDO::PARAM_STR);
        $sql->bindParam(3, $Cli_Email , PDO::PARAM_STR);
        $sql->bindParam(4, $Cli_Endereco , PDO::PARAM_STR);
        $sql->bindParam(5, $Cli_Descricao , PDO::PARAM_STR);
        $sql->execute();

        $count = $sql->rowCount();
        

        if ($count == 1) {
          echo "1";
        }else{
          echo "Ocorreu um ERRO na execução da instrução!";
        }



      }
		  
      

	}
	catch(PDOException $e){
    	echo $e->getCode();
	}

}






?>