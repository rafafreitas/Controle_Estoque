<?php


$pdo = new PDO("mysql:host=localhost:3307;dbname=teste;charset=utf8", "root", "usbw");//USB_Server
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$pdo->exec("SET time_zone='America/Recife';");
$pdo->exec("SET CHARACTER SET UTF8");

if(!$pdo){
    die('Erro ao criar a conexão');
}


/*

CREATE DATABASE teste DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


use teste;



CREATE TABLE usuarios (
	id_User INT(10) AUTO_INCREMENT NOT NULL primary key,
	nome VARCHAR(50) NOT NULL ,
	login VARCHAR(25) NOT NULL UNIQUE ,
	senha VARCHAR(40) NOT NULL ,
	email VARCHAR(50) NOT NULL,
	telefone VARCHAR(13) NOT NULL,
	nivel INT(1) UNSIGNED NOT NULL DEFAULT '1',
	ativo BOOL NOT NULL DEFAULT '1',
	ultima_alteracao DATETIME NOT NULL,
	reset CHAR DEFAULT 'n');

*/

?>