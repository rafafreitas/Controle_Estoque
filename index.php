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
    
    <script>
        $(document).ready(function(){
        $('#erroLogin').hide(); //Esconde o elemento com id errolog
        $('#erroSenha').hide();
        $('#erroBanco').hide();
            $('#formAcesso').submit(function(){  //Ao submeter formulário
                $('#login').removeClass('animated shake');
                $('#senha').removeClass('animated shake');
                $('#erroBanco').hide();
                var login=$('#login').val();    //Pega valor do campo email
                var senha=$('#senha').val();    //Pega valor do campo senha
                $.ajax({            //Função AJAX
                    url:"validacao.php",                    //Arquivo php
                    type:"post",                            //Método de envio
                    data: "login="+login+"&senha="+senha,   //Dados
                    success: function (result){             //Sucesso no AJAX
                        if(result==1){                      
                            location.href='red.php'    //Redireciona
                        }if(result==2){
                            $('#login').addClass('animated shake');
                            $('#erroSenha').hide();
                            $('#erroLogin').show();
                        }if (result==3) {
                            $('#senha').addClass('animated shake');
                            $('#erroLogin').hide();
                            $('#erroSenha').show();
                        }if (result !=1 && result != 2 && result != 3){
                            $('#erroBanco').show();
                            $("#erroBanco").html("<p class='text-center'>Erro: "+ result+ "</p>");
                        }  
                    }
                })
            return false;   //Evita que a página seja atualizada
            })
        })
    </script>
    
</head>
<body>
    
    <div id="wrapper">

    <div id="page-content-wrapper">
            
        <div class="container animated bounceInDown" id="telaInicial">
            <p class="text-center" id="titulo">Acesso ao sistema</p>

            <form role="form" id="formAcesso">
              <div class="form-group">
                <label for="login"><span class="glyphicon glyphicon-user"></span> Username</label>
                <input type="text" class="form-control" id="login" name="login" maxlength="25" placeholder="Informe seu login" required>
                <p id="erroLogin">Login incorreto!</p>
              </div>
              <div class="form-group">
                <label for="senha"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
                <p id="erroSenha">Senha incorreta!</p>
              </div>
            <button type="submit" class="btn btn-warning btn-block" ><span class="glyphicon glyphicon-off"></span> Login</button>
            <p class="text-center" id="erroBanco"></p>
          </form>

        </div>
        <p id="texto" class="text-center animated bounceInRight">Bem vindo ao sistema de Estoque!<br>Para acessá-lo informe suas credenciais.</p>
        
    </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->


</body>
</html>
