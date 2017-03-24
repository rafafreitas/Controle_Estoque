<?php

 include 'db/conecta.php';
  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
      header("Location: index.php"); exit;
  }

 //Receber dados pelo Post   
 //$senha = mysql_real_escape_string($_POST['senha']);
  $login = $_POST["login"];
  $senha = $_POST['senha'];

 try{
      $sql = $pdo->prepare("select id_user FROM usuarios WHERE (login = ?) LIMIT 1");
      $sql->bindParam(1, $login , PDO::PARAM_STR);
      $res = $sql->execute();

      if ($reg = $sql->fetch(PDO::FETCH_OBJ)) {
        $sql = $pdo->prepare("select id_user, nome, login, nivel, reset FROM usuarios WHERE (login = ?) AND (senha = sha1(?)) AND (ativo = 1) LIMIT 1");
        $sql->bindParam(1, $login , PDO::PARAM_STR);
        $sql->bindParam(2, $senha , PDO::PARAM_STR);
        $res = $sql->execute();
        if ($reg = $sql->fetch(PDO::FETCH_OBJ)) {
          
          // Levanta a sessão 
          if (!isset($_SESSION)) session_start();
          //Salva os dados encontrados na sessão
          $_SESSION['UsuarioID'] = $reg->id_user;
          $_SESSION['UsuarioNome'] = $reg->nome;
          $_SESSION['UsuarioNivel'] = $reg->nivel;
          $_SESSION['UsuarioLogin'] = $reg->login;
          $_SESSION['Reset'] = $reg->reset;

          // Redireciona o visitante
          if ($_SESSION['UsuarioNivel'] == 1) {
            header("Location: /estoque/index.php"); exit;
          }
        
        }else{
          header("Location: index.php?e=2");
        }
      
      }else{
        header("Location: index.php?e=1");
      }

   }
   catch(PDOException $e){
      echo $e->getMessage();
   }

/*


$(document).ready(function(){
    $("#demo2").on("hide.bs.collapse", function(){
      $(".demo2").html('<span class="glyphicon glyphicon-plus"></span> Montagem');
    });

$(location).attr('href', 'http://www.teste.com');

*/

?>