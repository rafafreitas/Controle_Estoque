<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Controle de Estoque</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>


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


    <script type="text/javascript">

        //Primeiro Dropdown caret
        $(document).ready(function(){
            $('.drop1').on('show.bs.dropdown', function(){
                $(".dropA1").html('<i class="material-icons">work</i> - Tarefas <span class="dropup"><span class="caret"></span></span>');
            });

            $('.drop1').on('hide.bs.dropdown', function(){
                $(".dropA1").html('<i class="material-icons">work</i> - Tarefas <span class="caret"></span>');
            });


        });
        //Segundo Dropdown caret
        $(document).ready(function(){
            $('.drop2').on('show.bs.dropdown', function(){
                $(".dropA2").html('<i class="material-icons">library_books</i> - Relatórios <span class="dropup"><span class="caret"></span></span>');
            });

            $('.drop2').on('hide.bs.dropdown', function(){
                $(".dropA2").html('<i class="material-icons">library_books</i> - Relatórios <span class="caret"></span>');
            });

        });


    </script>

</head>
<body>
    <div id="wrapper">

    <?php require_once ("menu-principal.php"); ?>
    <!-- Fim do Menu -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
    			<span class="hamb-middle"></span>
				<span class="hamb-bottom"></span>
            </button>
            <img src="img/seta.png" style="margin-top: -20px;">
            <div class="container">
                <p class="text-center" id="titulo">Controle de Estoque</p>
                <img src="img/grafico.gif">                                                
                
                
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
<script type="text/javascript">
$(document).ready(function () {
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });  
});
</script>
</body>
</html>
