<?php
if(!isset($seguranca)){exit;}
function seguranca(){
    if((isset($_SESSION['email'])) AND (isset($_SESSION['niveis_acesso_id']))){
        //echo "permanecer logado";
    }else{
        include_once("config/config.php");
        $_SESSION['msg'] = "<div class='alert alert-warning' style='font-size: 0.8em;text-align: center;'>Necessário Login para acessar!</div>";
        $url_destino = pg."/login.php";
        header("Location: $url_destino");
    }
}
