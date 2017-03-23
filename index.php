<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Área de Acesso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">

    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    

</head>
<body>
    <div id="wrapper">

    <div id="page-content-wrapper">
            
        <div class="container animated bounceInDown" id="telaInicial">
            <p class="text-center" id="titulo">Acesso ao sistema</p>

            <form role="form" method= "post" action="validacao.php">
              <div class="form-group">
                <label for="login"><span class="glyphicon glyphicon-user"></span> Username</label>
                <input type="text" class="form-control" id="login" name="login" maxlength="25" placeholder="Informe seu login" required>
              </div>
              <div class="form-group">
                <label for="senha"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
              </div>
            <button type="submit" class="btn btn-warning btn-block" ><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>

        </div>

        <p id="texto" class="text-center animated bounceInRight">Bem vindo ao sistema de Estoque!<br>Para acessá-lo informe suas credenciais.</p>
        
    </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->






    
</body>
</html>
