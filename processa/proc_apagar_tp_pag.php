<?php

if (!isset($seguranca)) {
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    //Verificar se há vendas com esse tipo de pagamento
    $result_vend = "SELECT id FROM vendas WHERE tipos_pagamento_id = '$id' LIMIT 2";
    $resultado_vend = mysqli_query($conn, $result_vend);
    if (($resultado_vend) AND ( $resultado_vend->num_rows != 0)) {
        $_SESSION['msg'] = "<div class='alert alert-danger'>O tipo de pagamento não pode ser apagado, há vendas cadastradas com esse tipo de pagamento!</div>";
        $url_destino = pg . "/visualizar/ver_tp_pag?id=".$id;
        header("Location: $url_destino");
    } else {//Não há nenhuma venda cadastrada com esse tipo de pagamento
        $result_tp_pag = "DELETE FROM tipos_pagamentos WHERE id='$id'";
        $resultado_tp_pag = mysqli_query($conn, $result_tp_pag);

        if (mysqli_affected_rows($conn)) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de pagamento apagado com sucesso!</div>";
            $url_destino = pg . "/listar/list_tp_pag";
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Tipo de pagamento não foi apagado!</div>";
            $url_destino = pg . "/visualizar/ver_tp_pag?id=".$id;
            header("Location: $url_destino");
        }
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Categoria de produto não encontrado!</div>";
    $url_destino = pg . "/listar/list_tp_pag";
    header("Location: $url_destino");
}

