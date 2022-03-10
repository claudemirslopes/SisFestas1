<?php
include_once '../config/dbconfig.php';

$id = $_POST['id'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$modified = $_POST['modified'];

$pdo->query("UPDATE usuarios SET senha = '$senha', modified = NOW() WHERE id = '$id'");