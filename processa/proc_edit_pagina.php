<?php
include_once '../config/dbconfig.php';

$id = $_POST['id'];
$endereco = $_POST['endereco'];
$nome_pagina = $_POST['nome_pagina'];
$obs = $_POST['obs'];
$modified = $_POST['modified'];

$pdo->query("UPDATE paginas SET endereco = '$endereco', nome_pagina = '$nome_pagina', obs = '$obs', modified = NOW() WHERE id = '$id'");