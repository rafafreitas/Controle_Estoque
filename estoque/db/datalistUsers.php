<?php

include "../db/conecta.php";

$consulta = $pdo->prepare("select nome from usuarios where id_User > 1 order by nome;");
$consulta->execute();

echo "<input list='enter' name='enter' class='form-control input-md' placeholder='Buscar'>";
echo "<datalist id='enter'>";
while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) {
	echo "<option value='".$linha->nome."'>";
}
echo "</datalist>";



/*
$query = "select nome from usuarios where id_User > 1 order by nome;" ;
$sql = mysql_query($query) or die(mysql_error($conexao));
//$qtd = mysql_num_rows($sql);

$qtd = 0;

//while ($linha=mysql_fetch_array($sql, MYSQL_ASSOC)) {
//	echo "Nome = ".$linha["nome"]."<br>";
//	$qtd++;
//}
// echo "$qtd";


while ($linha=mysql_fetch_array($sql, MYSQL_ASSOC)) {
	$vetor[$qtd] = $linha["nome"];
	echo "$vetor[$qtd]";
	$qtd++;
}
 echo "$qtd";

echo "<input list='nameUsers' name='nameUsers'>";
echo "<datalist id='nameUsers'>";
for ($i=0; $i <$qtd ; $i++) { 
	echo "<option value=".$vetor[$i].">";
}
echo "</datalist>";


//echo "<input list='nameUsers' name='nameUsers'>";
//echo "<datalist id='nameUsers'>";
//while ($linha=mysql_fetch_array($sql, MYSQL_ASSOC)) {
//	echo "<option value=".$linha["nome"].">";
//}
//echo "</datalist>";


*/
?>

