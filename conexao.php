<?php 
$servidor='localhost';
$usuario='root';
$senha='';
$db='restaurante';
$con = mysqli_connect($servidor,$usuario,$senha,$db);
if (!$con){
    print("Erro na conexão com MySql");
    print("Erro:".mysqli_connect_error());
    exit;
}
?>