<?php 
//Criando o arquivo de conexão
$host = "localhost";
$usuario = "id12834938_margot";
$senha = "Tulinho27";
$banco="id12834938_estoque";

$conexao= mysqli_connect($host,$usuario,$senha,$banco) or die("Não foi possivel conectar ao banco");
mysqli_select_db($conexao,$banco) or die("Não foi possivel encontrar esse banco");
