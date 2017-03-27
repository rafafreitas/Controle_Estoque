<?php
      // A sessão precisa ser iniciada em cada página diferente
      if (!isset($_SESSION)) session_start();
       $nivel_necessario = 1;
       $nomeLogado = $_SESSION['UsuarioNome'];
       $loginLogado = $_SESSION['UsuarioLogin'];

      // Verifica se não há a variável da sessão que identifica o usuário
      if ($_SESSION['UsuarioNivel'] != $nivel_necessario) {
          // Destrói a sessão por segurança
          session_destroy();
          // Redireciona o visitante de volta pro login
          header("Location: ../index.php"); exit;
      }
?>