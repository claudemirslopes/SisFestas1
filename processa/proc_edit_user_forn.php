<?php

if (!isset($seguranca)) {
    exit;
}
//Recuperar o valor do id
$forn = filter_input(INPUT_GET, 'forn', FILTER_SANITIZE_NUMBER_INT);
//id vazio redireciona para o listar
if (!empty($forn)) {
    $user = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_NUMBER_INT);
    if (!empty($user)) {
        //echo $id ." - ". $user;
        $result_forn = "UPDATE fornecedores SET
                usuario_id='$user', 
                modified=NOW()
                WHERE id='$forn'";
        $resultado_forn = mysqli_query($conn, $result_forn);
        if (mysqli_affected_rows($conn)) {
            unset($_SESSION['dados']);
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário do fornecedor editado com sucesso</div>";
            $url_destino = pg . "/visualizar/ver_forn?id=" . $forn;
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao editar o usuário do fornecedor1</div>";
            $url_destino = pg . "/listar/list_forn";
            header("Location: $url_destino");
        }
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao carregar a página2</div>";
        $url_destino = pg . "/listar/list_forn";
        header("Location: $url_destino");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao carregar a página3</div>";
    $url_destino = pg . "/listar/list_forn";
    header("Location: $url_destino");
}
