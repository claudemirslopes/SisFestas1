<?php

if (!isset($seguranca)) {
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    //Pesquisar detalhes na tabela vendas_produtos
    $result_vend_prod = "SELECT * FROM vendas_produtos WHERE id='$id'";
    $resultado_vend_prod = mysqli_query($conn, $result_vend_prod);

    //Encontrou dados na tabela vendas_produtos
    if (($resultado_vend_prod) AND ( $resultado_vend_prod->num_rows != 0)) {
        $row_vend_prod = mysqli_fetch_assoc($resultado_vend_prod);

        //Contar quantos produtos tem na venda
        $result_sum_vend_prod = "SELECT COUNT(id) AS qnt_produto FROM vendas_produtos WHERE venda_id = '" . $row_vend_prod['venda_id'] . "'";
        $resultado_sum_vend_prod = mysqli_query($conn, $result_sum_vend_prod);
        $row_sum_vend_prod = mysqli_fetch_assoc($resultado_sum_vend_prod);
        //Pesquisar as informações da venda
        $result_venda = "SELECT id, usuario_id, status_compra_id FROM vendas WHERE id='" . $row_vend_prod['venda_id'] . "' LIMIT 1";
        $resultado_venda = mysqli_query($conn, $result_venda);
        $row_venda = mysqli_fetch_assoc($resultado_venda);

        //Havendo somente 1 produto na venda, apagar a venda
        if ($row_sum_vend_prod['qnt_produto'] <= 1) {
            $result_vend = "DELETE FROM vendas WHERE id='" . $row_vend_prod['venda_id'] . "'";
            $resultado_vend = mysqli_query($conn, $result_vend);
        }

        //verificar o status da venda, status 2 está pago não pode ser apagado o produto, status 3 está cancelado não é necessário corrigir a quantidade de produto
        if ($row_venda['status_compra_id'] == 2) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>O produto já está pago não pode ser excluido!</div>";
            $url_destino = pg . "/visualizar/ver_venda?id=" . $row_vend_prod['venda_id'];
            header("Location: $url_destino");
        } elseif ($row_venda['status_compra_id'] == 3) {
            //Apagar na tabela vendas_produtos
            $result_vend_prod = "DELETE FROM vendas_produtos WHERE id='$id'";
            $resultado_vend_prod = mysqli_query($conn, $result_vend_prod);
            if (mysqli_affected_rows($conn)) {
                //Se apagou a venda redirecionar ao listar compras do cliente
                if ($row_sum_vend_prod['qnt_produto'] <= 1) {
                    $_SESSION['msg'] = "<div class='alert alert-success'>Produto da venda apagado com sucesso!</div>";
                    $url_destino = pg . "/listar/list_venda_user?id=" . $row_venda['usuario_id'];
                    header("Location: $url_destino");
                } else {
                    $_SESSION['msg'] = "<div class='alert alert-success'>Produto da venda apagado com sucesso!</div>";
                    $url_destino = pg . "/visualizar/ver_venda?id=" . $row_vend_prod['venda_id'];
                    header("Location: $url_destino");
                }
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: produto da venda não foi apagado!</div>";
                $url_destino = pg . "/visualizar/ver_venda?id=" . $row_vend_prod['venda_id'];
                header("Location: $url_destino");
            }
        } else {
            //Aumentar a qnt de produto no estoque
            $result_prod = "UPDATE produtos SET
                disponivel_estoque=disponivel_estoque + " . $row_vend_prod['qnt_produto'] . ",
                modified=NOW()
                WHERE id='" . $row_vend_prod['produto_id'] . "'";
            $resultado_prod = mysqli_query($conn, $result_prod);
            
            //Apagar na tabela vendas_produtos
            $result_vend_prod = "DELETE FROM vendas_produtos WHERE id='$id'";
            $resultado_vend_prod = mysqli_query($conn, $result_vend_prod);
            if(mysqli_affected_rows($conn)){
                //Se apagou a venda redirecionar ao listar compras do cliente
                if ($row_sum_vend_prod['qnt_produto'] <= 1) {
                    $_SESSION['msg'] = "<div class='alert alert-success'>Produto da venda apagado com sucesso!</div>";
                    $url_destino = pg . "/listar/list_venda_user?id=" . $row_venda['usuario_id'];
                    header("Location: $url_destino");
                } else {
                    $_SESSION['msg'] = "<div class='alert alert-success'>Produto da venda apagado com sucesso!</div>";
                    $url_destino = pg . "/visualizar/ver_venda?id=" . $row_vend_prod['venda_id'];
                    header("Location: $url_destino");
                }
            }else{
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: produto da venda não foi apagado!</div>";
                $url_destino = pg . "/visualizar/ver_venda?id=" . $row_vend_prod['venda_id'];
                header("Location: $url_destino");
            }
        }
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Venda não encontrada!</div>";
        $url_destino = pg . "/listar/list_venda";
        header("Location: $url_destino");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Produto não encontrado!</div>";
    $url_destino = pg . "/listar/list_venda";
    header("Location: $url_destino");
}