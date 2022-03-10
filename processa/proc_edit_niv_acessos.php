<?php
include_once '../config/dbconfig.php';

$id = $_POST['id'];
$nome_nivel_acesso = $_POST['nome_nivel_acesso'];
$ordem = $_POST['ordem'];
$modified = $_POST['modified'];

$pdo->query("UPDATE niveis_acessos SET nome_nivel_acesso = '$nome_nivel_acesso', ordem = '$ordem', modified = NOW() WHERE id = '$id'");