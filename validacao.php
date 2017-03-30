<?php

  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
      header("Location: index.php"); exit;
  }

 //Receber dados pelo Post   
 //$senha = mysql_real_escape_string($_POST['senha']);
  $login = $_POST["login"];
  $senha = $_POST['senha'];


 try{
      include 'db/conecta.php';
      $sql = $pdo->prepare("select Us_Id FROM Usuarios WHERE (Us_Login = ?) LIMIT 1");
      $sql->bindParam(1, $login , PDO::PARAM_STR);
      $res = $sql->execute();

      if ($reg = $sql->fetch(PDO::FETCH_OBJ)) {
        $sql = $pdo->prepare("select Us_Id, Us_Nome, Us_Login, Us_Nivel, Us_Reset FROM Usuarios WHERE (Us_Login = ?) AND (Us_Senha = sha1(?)) LIMIT 1");
        $sql->bindParam(1, $login , PDO::PARAM_STR);
        $sql->bindParam(2, $senha , PDO::PARAM_STR);
        $res = $sql->execute();
        if ($reg = $sql->fetch(PDO::FETCH_OBJ)) {
          
          // Levanta a sessão 
          if (!isset($_SESSION)) session_start();
          //Salva os dados encontrados na sessão
          $_SESSION['UsuarioID'] = $reg->Us_Id;
          $_SESSION['UsuarioNome'] = $reg->Us_Nome;
          $_SESSION['UsuarioNivel'] = $reg->Us_Nivel;
          $_SESSION['UsuarioLogin'] = $reg->Us_Login;
          $_SESSION['Reset'] = $reg->Us_Reset;

          // Redireciona o visitante
          if ($_SESSION['UsuarioNivel'] == 1) {
            echo 1; //header("Location: /estoque/index.php"); exit;
          }
        
        }else{
          echo 3;
        }
      
      }else{
        echo 2;
      }

   }
   catch(PDOException $e){
      echo $e->getCode();
      //echo "\nPDO::errorCode(): ", $pdo->errorCode();
   }

/*


$(document).ready(function(){
    $("#demo2").on("hide.bs.collapse", function(){
      $(".demo2").html('<span class="glyphicon glyphicon-plus"></span> Montagem');
    });

$(location).attr('href', 'http://www.teste.com');

*/

?>