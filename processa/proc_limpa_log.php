<?php
  // Matriz de definições
$dbcon_new = array(
  "host"     => "localhost",
  "dbname"   => "cr2maxxen",
  "username" => "root",
  "password" => ""
);

// estabelece a ligação
$dbh = new PDO(
  'mysql:host='.$dbcon_new['host'].';dbname='.$dbcon_new['dbname'].';',
  $dbcon_new['username'],
  $dbcon_new['password'],
  array(
    PDO::ATTR_PERSISTENT               => false,
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
    PDO::ATTR_ERRMODE                  => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND       => "SET NAMES utf8"
  )
);

// esvazia a tabela xpto
$dbh->exec("TRUNCATE TABLE log_eventos");
header("Location: ../visualizar/ver_logs");
?>