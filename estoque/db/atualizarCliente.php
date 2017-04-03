<?php


if (!empty($_POST['Cli_Id'])) {
  try{
    $Cli_Id = $_POST["Cli_Id"];
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

}elseif (!empty($_POST)) {
  $json = $_POST;
  $dados = json_decode(json_encode($json), true);
  echo $dados['idAt'];
}






?>