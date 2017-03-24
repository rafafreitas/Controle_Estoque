<?php

 include '_db/database.php';
  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
      header("Location: index.php"); exit;
  }

 //Receber dados pelo Post   
 //$senha = mysql_real_escape_string($_POST['senha']);
  $login = $_POST["login"];
  $senha = $_POST['senha'];

 try{
      $sql = $pdo->prepare("select id_user, nome, login, FROM usuarios WHERE (login = ?) LIMIT 1");
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
          header("Location: /_r/index.php"); exit;
        }
        if ($_SESSION['UsuarioNivel'] == 2) {
          header("Location: /_cli/index.php"); exit;
        }
       
      }else{
        echo "<script type='text/javascript' language='javascript'>alert ('Login Invalido! Verifique as credenciais informadas.'); window.location.href ='index.php';</script>";
      }
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }

?>
