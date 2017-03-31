<?php


if (!empty($_POST) AND (empty($_POST['Cli_Id'])) ) {
      echo "1";
      exit;
  }

try{
	$Cli_Id = $_POST["Cli_Id"];
    include '../../db/conecta.php';

    $sql = $pdo->prepare("select Cli_Nome, Cli_Telefone, Cli_Email, Cli_Endereco, Cli_Descricao, DATE_FORMAT( Cli_Ultima_Alteracao , '%d/%m/%Y Às %H:%i:%s' ) AS Cli_Ultima_Alteracao FROM Clientes WHERE Cli_Id = ? LIMIT 1");
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




?>