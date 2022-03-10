<?php

if (!isset($seguranca)) {
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    //Verificar se há compras cadastrado nesse status de compra
    $result_vend = "SELECT id FROM vendas WHERE status_compra_id = '$id' LIMIT 2";
    $resultado_vend = mysqli_query($conn, $result_vend);
    if (($resultado_vend) AND ( $resultado_vend->num_rows != 0)) {
        $_SESSION['msg'] = "<div class='alert alert-danger'>O status de compra não pode ser apagado, há vendas cadastrada nesse status!</div>";
        $url_destino = pg . "/visualizar/ver_st_compr?id=".$id;
        header("Location: $url_destino");
    } else {//Não há nenhum venda cadastrada com esse status de compra
        $result_st_compr = "DELETE FROM status_compras WHERE id='$id'";
        $resultado_st_compr = mysqli_query($conn, $result_st_compr);

        if (mysqli_affected_rows($conn)) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Status de compra apagado com sucesso!</div>";
            $url_destino = pg . "/listar/list_st_compr";
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Status de compra não foi apagada!</div>";
            $url_destino = pg . "/visualizar/ver_st_compr?id=".$id;
            header("Location: $url_destino");
        }
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Status de compra não encontrado!</div>";
    $url_destino = pg . "/listar/list_st_compr";
    header("Location: $url_destino");
}

