<?php


$pdo = new PDO("mysql:host=localhost:3307;dbname=teste;charset=utf8", "root", "usbw");//USB_Server
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$pdo->exec("SET time_zone='America/Recife';");
$pdo->exec("SET CHARACTER SET UTF8");

if(!$pdo){
    die('Erro ao criar a conexão');
}


/*

CREATE DATABASE estoque DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
use estoque;

CREATE TABLE Usuarios (
	Us_Id INT(10) AUTO_INCREMENT NOT NULL primary key,
	Us_Login VARCHAR(25) NOT NULL UNIQUE ,
    Us_Nome VARCHAR(50) NOT NULL,
	Us_Senha VARCHAR(40) NOT NULL ,
	Us_Email VARCHAR(50) NOT NULL,
	Us_Nivel INT(1) UNSIGNED NOT NULL DEFAULT '1',
	Us_Reset CHAR DEFAULT 'n');

	insert into Usuarios (Us_Login, Us_Nome, Us_Email, Us_Senha, Us_Nivel, Us_Reset)
	values
	('root','Root Nome',SHA1('root123'), 'exemplo@exemplocom.br', 1,'n'),
	('teste','Teste Nome',SHA1('teste123'), 'exemplo@exemplocom.br', 1,'n');

*/

?>