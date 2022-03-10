<?php
include_once '../config/dbconfig.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$obs = $_POST['obs'];
$modified = $_POST['modified'];

$pdo->query("UPDATE usuarios SET nome = '$nome', email = '$email', usuario = '$usuario', obs = '$obs', modified = NOW() WHERE id = '$id'");