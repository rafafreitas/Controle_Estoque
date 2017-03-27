<?php
	
session_start(); 	//A seção deve ser iniciada em todas as páginas
if (!isset($_SESSION['UsuarioID']) || !isset($_SESSION['UsuarioNome']) || !isset($_SESSION['UsuarioNivel']) || !isset($_SESSION['UsuarioLogin']) ) {
    session_destroy();						//Destroi a seção por segurança
    header("Location: index.html"); exit;	//Redireciona o visitante para login
}else {
	header("Location: /estoque/index.php"); exit;
}

?>

