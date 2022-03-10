<?php

if (!isset($seguranca)) {
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    //Pesquisar informações da venda
    $result_venda = "SELECT id, usuario_id, status_compra_id FROM vendas WHERE id = '$id' LIMIT 1";
    $resultado_venda = mysqli_query($conn, $result_venda);
    $row_venda = mysqli_fetch_assoc($resultado_venda);

    //Verifiar o status da venda, caso seja 3 está cancelada não necessário corrigir a qnt de produto
    if ($row_venda['status_compra_id'] == 3) {
        //Apagar os produtos da venda
        $result_vend_prod = "DELETE FROM vendas_produtos WHERE venda_id='$id'";
        $resultado_vend_prod = mysqli_query($conn, $result_vend_prod);
        //Apagar a venda
        $result_vend = "DELETE FROM vendas WHERE id='$id'";
        $resultado_vend = mysqli_query($conn, $result_vend);

        if (mysqli_affected_rows($conn)) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Venda apagada com sucesso</div>";
            $url_destino = pg . "/listar/list_venda_user?id=" . $row_venda['usuario_id'];
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: a venda não foi apagada!</div>";
            $url_destino = pg . "/listar/list_venda_user?id=" . $row_venda['usuario_id'];
            header("Location: $url_destino");
        }
    } elseif($row_venda['status_compra_id'] == 2){
        $_SESSION['msg'] = "<div class='alert alert-danger'>A compra já está paga não pode ser apagada</div>";
        $url_destino = pg . "/visualizar/ver_venda?id=" . $id;
        header("Location: $url_destino");
    }else {
        //Pesquisar os produto da venda
        $result_vnd_prod = "SELECT * FROM vendas_produtos WHERE venda_id='$id'";
        $resultado_vnd_prod = mysqli_query($conn, $result_vnd_prod);
        //Ler os produtos da venda e atualizar a qnto de produto na tabela produtos
        while ($row_vnd_prod = mysqli_fetch_array($resultado_vnd_prod)) {
            //Aumentar a qnt de produto no estoque
            $result_prod = "UPDATE produtos SET
                                disponivel_estoque=disponivel_estoque + " . $row_vnd_prod['qnt_produto'] . ",
                                modified=NOW()
                                WHERE id='" . $row_vnd_prod['produto_id'] . "'";
            $resultado_prod = mysqli_query($conn, $result_prod);
        }

        //Apagar os produtos da venda
        $result_vend_prod = "DELETE FROM vendas_produtos WHERE venda_id='$id'";
        $resultado_vend_prod = mysqli_query($conn, $result_vend_prod);
        //Apagar a venda
        $result_vend = "DELETE FROM vendas WHERE id='$id'";
        $resultado_vend = mysqli_query($conn, $result_vend);

        if (mysqli_affected_rows($conn)) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Venda apagada com sucesso</div>";
            $url_destino = pg . "/listar/list_venda_user?id=" . $row_venda['usuario_id'];
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: a venda não foi apagada!</div>";
            $url_destino = pg . "/listar/list_venda_user?id=" . $row_venda['usuario_id'];
            header("Location: $url_destino");
        }
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Nenhuma venda encontrada</div>";
    $url_destino = pg . "/listar/list_venda";
    header("Location: $url_destino");
}