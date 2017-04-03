<?php 

require_once ("validacao.php");
include '../db/conecta.php';


if (!empty($_GET['enter'])){
    try{
        $pesquisa = $_GET['enter'];
        //Códigos padrão
        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
        $sql = "select COUNT(*) AS quantidade FROM Clientes WHERE LOCATE('".$pesquisa."',Cli_Nome)";//Passar com parametro
        foreach ($pdo->query($sql) as $row) 
        $total_usuários = $row['quantidade'];
        $qdt_pg = 6;
        $num_pagina = ceil($total_usuários/$qdt_pg);
        $incio = ($qdt_pg*$pagina)-$qdt_pg;

        //Com parametros
        //$busca = $pdo->prepare("select id_user, nome, login, nivel, ultima_alteracao from usuarios WHERE LOCATE('?',nome) ORDER BY nome;");
        //$busca->bindParam(1, $pesquisa, PDO::PARAM_STR);
        //$busca->execute();
        $sql = "select Cli_Id, Cli_Nome, Cli_Telefone, Cli_Email from Clientes WHERE LOCATE('".$pesquisa."',Cli_Nome) ORDER BY Cli_Nome limit $incio, $qdt_pg;";//Passar com parametros

    }catch(PDOException $e) {
        echo 'ERROR: ' . $e->getCode() . ' Pesquisa GET';
    }

}else{

    try {
        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

        //Selecionar todos os usuários da tabela
        $sql = "select COUNT(*) AS quantidade FROM Clientes;";
        foreach ($pdo->query($sql) as $row) 

        //Quantidade de Usuários
        $total_usuários = $row['quantidade'];

        //Seta a quantidade de usuários por pagina
        $qdt_pg = 6;

        //calcular o número de pagina necessárias para apresentar os cursos
        $num_pagina = ceil($total_usuários/$qdt_pg);

        //Calcular o inicio da visualizacao
        $incio = ($qdt_pg*$pagina)-$qdt_pg;

        //Selecionar os usuários a serem exibidos na página

        $sql = "select Cli_Id, Cli_Nome, Cli_Telefone, Cli_Email from Clientes ORDER BY Cli_Nome limit $incio, $qdt_pg";
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getCode() . ' Dados preparatórios para formação da Tabela';
    }


}

?>
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
    <script type="text/javascript" src='js/main.js'></script>

    
    <script>
        function deleteUser(idUser) {
            var r = confirm("Você confirma a exclusão do Usuário?");
            if (r == true) {
                alert("O ID que será excluido é:" + idUser);
                document.location.href = "delete.php?id="+idUser;
            }
        }

        //Script Modal Login
        $(document).ready(function(){
            $("#myBtn").click(function(){
                $("#myModal").modal({backdrop: false});
            });
        });

        function formatar(mascara, documento){
            var i = documento.value.length;
            var saida = mascara.substring(0,1);
            var texto = mascara.substring(i)
          
            if (texto.substring(0,1) != saida){
                documento.value += texto.substring(0,1);
            }   

        }

        /*
        $(document).ready(function(){
            $('button:button').click(function() {
                alert($(this).val());
            });
        });
        */

        //Atualizar dados do cliente.
        $(document).ready(function(){
            $('button#atualizar').click(function() {
                $('#retornoAt').hide();
                var idAtualizar=$(this).val();
                $.ajax({
                    url:"db/atualizarCliente.php",                    
                    type:"post",                            
                    data: "Cli_Id="+idAtualizar,
                    dataType: "JSON",
                    success: function (result){ 
                        //var dados = JSON.parse(result);
                        $("#idAt").val(result[0].Cli_Id);
                        $("#nomeAt").val(result[0].Cli_Nome);
                        $("#emailAt").val(result[0].Cli_Email);
                        $("#telefoneAt").val(result[0].Cli_Telefone);
                        $("#enderecoAt").val(result[0].Cli_Endereco);
                        $("#descricaoAt").val(result[0].Cli_Descricao);
                        $("#myModalAtualizar").modal({backdrop: false});
                    }
                });
                //alert((this).val());
            });

            $('#formAtualizar').submit(function(){
                $('#retornoAt').hide();
                var json = jQuery(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "db/atualizarCliente.php",
                    data: json,
                    success: function(result)
                    {
                        if(result==1){
                            $('#retornoAt').show();
                            $('#retornoAt').addClass('animated shake');                     
                            $("#retornoAt").html("<p class='text-center'>Informações atualizadas!</p>");
                        }if (result !=1){
                            $('#retornoAt').show();
                            $('#retornoAt').addClass('animated shake');                     
                            $("#retornoAt").html("<p class='text-center'>Ops!: "+ result+ "</p>");
                        }
                    }
                });


                return false;
                //location.reload();
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
            <div class="container">
                <p class="text-center" id="titulo">Controle de Clientes</p>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body" style="padding:40px 50px;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3>Cadastro de clientes  <span class="glyphicon glyphicon-user"></span></h3>
                                    
                                <form class="form-horizontal" method="POST" action="create_user.php" style="max-width: 600px;">
                                      <!--Nome-->
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="nome">Nome:</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome do usuário" required>
                                        </div>
                                    </div>
                                    <!--E-Mail-->
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">E-Mail:</label>
                                        <div class="col-sm-10"> 
                                          <input type="email" class="form-control" id="email" name="email" placeholder="E-mail para contato." pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="exemplo@exemplo.com" required>
                                        </div>
                                    </div>
                                    <!--Telefone-->
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="telefone">Telefone:</label>
                                        <div class="col-sm-10">
                                            <input pattern="^\d{2}-\d{5}-\d{4}$" type="tel" class="form-control" rows="3" id="telefone" name="telefone" OnKeyPress="formatar('##-#####-####', this)" maxlength="13" placeholder="00-00000-0000" style="max-width: 150px;" required></input>Caso deseje informar um Nº Fixo, colocar um 0 no lugar do 9º dígito.
                                        </div>
                                    </div>
                                    <!--Endereço -->
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="endereco">Endereço:</label>
                                        <div class="col-sm-10"> 
                                          <textarea class="form-control" rows="4" id="endereco" style="resize:vertical;"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="endereco">Descrição:</label>
                                        <div class="col-sm-10"> 
                                          <textarea class="form-control" rows="4" id="descricao" style="resize:vertical;"></textarea>
                                        </div>
                                    </div>
                                    

                                    <div class="form-group"> 
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default">Cadastrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div> <!--modal-body (Cadastrar)-->
                        </div><!--modal-content (Cadastrar)-->
                    </div><!--modal-dialog (Cadastrar)-->
                </div> <!--modal fade (Cadastrar)-->

                <!--Modal para atualizaçao-->
                <div class="modal fade" id="myModalAtualizar" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body" style="padding:40px 50px;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3><span class="glyphicon glyphicon-pencil"></span> Atualizar Dados</h3>
                                    
                                <form class="form-horizontal" id="formAtualizar" style="max-width: 600px;">
                                      <!--Nome-->
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="nomeAt">Nome:</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="nomeAt" name="nomeAt" placeholder="Informe o nome do usuário" required>
                                        </div>
                                    </div>
                                    <!--E-Mail-->
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="emailAt">E-Mail:</label>
                                        <div class="col-sm-10"> 
                                          <input type="email" class="form-control" id="emailAt" name="emailAt" placeholder="E-mail para contato." pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="exemplo@exemplo.com" required>
                                        </div>
                                    </div>
                                    <!--Telefone-->
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="telefoneAt">Telefone:</label>
                                        <div class="col-sm-10">
                                            <input pattern="^\d{2}-\d{5}-\d{4}$" type="tel" class="form-control" rows="3" id="telefoneAt" name="telefoneAt" OnKeyPress="formatar('##-#####-####', this)" maxlength="13" placeholder="00-00000-0000" style="max-width: 150px;" required></input>Caso deseje informar um Nº Fixo, colocar um 0 no lugar do 9º dígito.
                                        </div>
                                    </div>
                                    <!--Endereço -->
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="enderecoAt">Endereço:</label>
                                        <div class="col-sm-10"> 
                                          <textarea class="form-control" rows="4" id="enderecoAt" style="resize:vertical;"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="descricaoAt">Descrição:</label>
                                        <div class="col-sm-10"> 
                                          <textarea class="form-control" rows="4" id="descricaoAt" style="resize:vertical;"></textarea>
                                          <input type="hidden" name="idAt" id="idAt" value="">
                                        </div>
                                    </div>
                                    

                                    <div class="form-group"> 
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default" id="btnAtualizar">Atualizar</button>
                                            <p id="retornoAt" class="text-center"></p>
                                        </div>
                                    </div>
                                </form>
                            </div> <!--modal-body (Atualizar)-->
                        </div><!--modal-content (Atualizar)-->
                    </div><!--modal-dialog (Atualizar)-->
                </div> <!--modal fade (Atualizar)-->


                <!--Tabela de consulta-->
                <div class="container">
                    <div class="row">
                    <h3>Base de Dados</h3>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                        <p>
                        <a id="myBtn" class="btn btn-success">Cadastrar</a>
                        </p>
                        </div>
                        <div class="col-sm-6">
                            <form class="form-horizontal" method="GET" action="clientes.php" style="max-width:500px; margin-bottom: 20px;">
                                <div class="input-group col-md-12">
                                    <?php 
                                    include 'db/datalistUsers.php';
                                    ?>
                                    <span class="input-group-btn">
                                    <button class="btn btn-info btn-md" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                    </span>
                                </div>
                            </form>
                        </div> 
                        
                        <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>E-Mail</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <?php 
                        try {
                            foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Cli_Nome'] . '</td>';
                            echo '<td>'. $row['Cli_Telefone'] . '</td>';
                            echo '<td>'. $row['Cli_Email'] . '</td>';

                            echo '<td width=250>';
                            echo '<button type="button" class="btn" id="ver" value="'.$row['Cli_Id'].'">Ver</button>';
                            echo '&nbsp;';
                            echo '<button type="button" class="btn btn-success" id="atualizar" value="'.$row['Cli_Id'].'">Atualizar</button>';
                            echo '&nbsp;';
                            echo '<button type="button" class="btn btn-danger" onclick="deleteUser('.$row['Cli_Id'].');">Apagar</button>';
                            //echo '<a class="btn btn-danger" href="delete.php?id='.$row['id_User'].'">Apagar</a>';
                            echo '</td>';
                            echo '</tr>';
                            }
                        } catch (Exception $e) {
                            echo 'ERROR: ' . $e->getCode() .'Formação das Linhas';
                        }?>

                        </tbody>
                        </table>
                    </div><!--Class Row-->
                        <?php
                            //Verificar a pagina anterior e posterior
                            $pagina_anterior = $pagina - 1;
                            $pagina_posterior = $pagina + 1;
                        ?>
                        <?php //Se estiver detro de uma pesquisa gera essa paginação
                        if (!empty($_GET['enter'])){?>
                                <nav class="text-center">
                                <ul class="pagination">
                                    <li>
                                        <?php
                                        if($pagina_anterior != 0){ ?>
                                            <a href="clientes.php?enter=<?php echo $pesquisa;?>&pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        <?php }else{ ?>
                                            <span aria-hidden="true">&laquo;</span>
                                    <?php }  ?>
                                    </li>
                                    <?php 
                                    //Apresentar a paginacao
                                    for($i = 1; $i < $num_pagina + 1; $i++){
                                        if ($i == $pagina){
                                        ?>
                                        <li class="active"><a href="clientes.php?enter=<?php echo $pesquisa;?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                        <?php }else{?>
                                        <li><a href="clientes.php?enter=<?php echo $pesquisa;?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php } } ?>
                                    <li>
                                        <?php
                                        if($pagina_posterior <= $num_pagina){ ?>
                                            <a href="clientes.php?enter=<?php echo $pesquisa;?>&pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        <?php }else{ ?>
                                            <span aria-hidden="true">&raquo;</span>
                                    <?php }  ?>
                                    </li>
                                </ul>
                            </nav>



                            <?php }else{ //Caso não esteja dentro de uma pesquisa.
                            ?>
                            <nav class="text-center">
                                <ul class="pagination">
                                    <li>
                                        <?php
                                        if($pagina_anterior != 0){ ?>
                                            <a href="clientes.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        <?php }else{ ?>
                                            <span aria-hidden="true">&laquo;</span>
                                    <?php }  ?>
                                    </li>
                                    <?php 
                                    //Apresentar a paginacao
                                    for($i = 1; $i < $num_pagina + 1; $i++){ 
                                    if ($i == $pagina) { ?>
                                        <li class="active"><a href="clientes.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php }else{ ?>
                                        <li><a href="clientes.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php } }?>
                                    <li>
                                        <?php
                                        if($pagina_posterior <= $num_pagina){ ?>
                                            <a href="clientes.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        <?php }else{ ?>
                                            <span aria-hidden="true">&raquo;</span>
                                    <?php }  ?>
                                    </li>
                                </ul>
                            </nav><?php } ?>
                </div> <!-- /container -->


            </div><!--Container-->

        </div><!-- /#page-content-wrapper -->

    </div><!-- /#wrapper -->

</body>
</html>
