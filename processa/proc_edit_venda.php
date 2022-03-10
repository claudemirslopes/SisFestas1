<?php

if (!isset($seguranca)) {
    exit;
}
//recuperar o valor do botão
$SendEditVenda = filter_input(INPUT_POST, 'SendEditVenda', FILTER_SANITIZE_STRING);
//Botão vazio redireciona para o listar
if ($SendEditVenda) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //validar se nenhum campo está vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário preencher todos os campos para editar a venda!</div>";
    }

    //Houve erro algum campo será acessado o IF
    if ($erro) {
        $url_destino = pg . "/editar/edit_venda?id=" . $dados['id'];
        header("Location: $url_destino");
    } else {
        //Se a compra está com status cancelado não pode ser editada
        if ($dados['status_compra_atual'] == 3) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>A venda não pode ser editada, porque está cancelada!</div>";
            $url_destino = pg . "/visualizar/ver_venda?id=" . $dados['id'];
            header("Location: $url_destino");
        } else {
            $result_vendas = "UPDATE vendas SET
                    status_compra_id='" . $dados_validos['status_compra_id'] . "',
                    tipos_pagamento_id='" . $dados_validos['tipos_pagamento_id'] . "',
                    modified=NOW()
                    WHERE id='" . $dados_validos['id'] . "'";
            $resultado_vendas = mysqli_query($conn, $result_vendas);

            if (mysqli_affected_rows($conn)) {
                unset($_SESSION['dados']);
                //Se a venda foi cancelada retornar os produtos para o estoque
                if($dados_validos['status_compra_id'] == 3){
                    //Pesquisar os produtos da venda
                    $result_vend_prod = "SELECT id, qnt_produto, produto_id FROM vendas_produtos WHERE venda_id='".$dados_validos['id']."'";
                    $resultado_vend_prod = mysqli_query($conn, $result_vend_prod);
                    while ($row_vend_prod = mysqli_fetch_assoc($resultado_vend_prod)) {
                        //Aumentar produto no estoque
                        $result_prod = "UPDATE produtos SET
                                disponivel_estoque=disponivel_estoque + ".$row_vend_prod['qnt_produto'].",
                                modified=NOW()
                                WHERE id='".$row_vend_prod['produto_id']."'";
                        $resultado_prod = mysqli_query($conn, $result_prod);
                    }
                }
                
                $_SESSION['msg'] = "<div class='alert alert-success'>Venda editada com sucesso</div>";
                $url_destino = pg . "/visualizar/ver_venda?id=" . $dados['id'];
                header("Location: $url_destino");
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao editar a venda</div>";
                $url_destino = pg . "/editar/edit_venda?id=" . $dados['id'];
                header("Location: $url_destino");
            }
        }
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Nenhuma venda encontrada</div>";
    $url_destino = pg . "/listar/list_venda";
    header("Location: $url_destino");
}
