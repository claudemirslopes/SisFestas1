<?php
include_once '../config/dbconfig.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$obs = $_POST['obs'];
$niveis_acesso_id = $_POST['niveis_acesso_id'];
$situacoes_usuario_id = $_POST['situacoes_usuario_id'];
$modified = $_POST['modified'];

$pdo->query("UPDATE usuarios SET nome = '$nome', email = '$email', usuario = '$usuario', obs = '$obs', niveis_acesso_id = '$niveis_acesso_id', situacoes_usuario_id = '$situacoes_usuario_id', modified = NOW() WHERE id = '$id'");