<?php
if(!isset($seguranca)){exit;}

// AQUI NO LOCALHOST
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "sisfestas";

// AQUI NO SERVIDOR DE HOSPEDAGEM
// $servidor = "localhost";
// $usuario = "openbe48_vegadv";
// $senha = "{K1s6yuznQ7p";
// $dbname = "openbe48_vegadv";

//Criar conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
if(!$conn){
    die("Falha na conexao: " . mysqli_connect_error());
}else{
    //echo "Conexao realizada com sucesso";
}
