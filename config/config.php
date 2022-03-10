<?php
$url_host = filter_input(INPUT_SERVER, 'HTTP_HOST');
// AQUI NO LOCALHOST
define('pg', "http://$url_host/SisFestas");
// AQUI NO SERVIDOR DE HOSPEDAGEM
// define('pg', "https://vieiraeguimaraesadvocacia.com.br/site/adm");
