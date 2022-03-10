<?php

if (!isset($seguranca)) {
    exit;
}

$SendCadPgVend = filter_input(INPUT_POST, 'SendCadPgVend', FILTER_SANITIZE_STRING);
if ($SendCadPgVend) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //validar se nenhum campo está vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário preencher todos os campos para cadastrar a forma de pagamento!</div>";
    }

    if ($erro) {
        $url_destino = pg . "/cadastrar/cad_pg_vend?id=" . $dados['id'];
        header("Location: $url_destino");
    } else {
        //Pesquisar o carrinho
        $result_car = "SELECT * FROM carrinhos WHERE usuario_id ='" . $dados['id'] . "' LIMIT 1";
        $resultado_car = mysqli_query($conn, $result_car);
        $row_car = mysqli_fetch_assoc($resultado_car);

        //Pesquisar os produtos do carrinho
        $result_car_prod = "SELECT * FROM carrinhos_produtos WHERE carrinho_id = '" . $row_car['id'] . "'";
        $resultado_car_prod = mysqli_query($conn, $result_car_prod);

        //Verificar se há produto nesse carrinho
        if (($resultado_car_prod) AND ( $resultado_car_prod->num_rows != 0)) {
            //Inserir o carrinho na tabela vendas
            $result_vendas = "INSERT INTO vendas
                    (usuario_id, status_compra_id, tipos_pagamento_id, vendedor_id, created)VALUES
                    ('" . $dados_validos['id'] . "',
                    '" . $dados_validos['status_compra_id'] . "',
                    '" . $dados_validos['tipos_pagamento_id'] . "',
                    '" . $_SESSION['id'] . "',
                    NOW())";
            $resultado_vendas = mysqli_query($conn, $result_vendas);
            if (mysqli_insert_id($conn)) {
                $id_venda = mysqli_insert_id($conn);
                //Ler os produtos do carrinho e inserir na tabela de venda produtos
                while($row_car_prod = mysqli_fetch_assoc($resultado_car_prod)){
                    $result_vend_prod = "INSERT INTO vendas_produtos
                            (valor_cotacao, valor_venda, qnt_produto, produto_id, venda_id, created) 
                            VALUES(
                            '".$row_car_prod['valor_cotacao']."',
                            '".$row_car_prod['valor_venda']."',
                            '".$row_car_prod['qnt_produto']."',
                            '".$row_car_prod['produto_id']."',
                            '$id_venda',
                            NOW())";
                    $resultado_vend_prod = mysqli_query($conn, $result_vend_prod);
                    //Diminuir produto no estoque
                    $result_prod = "UPDATE produtos SET
                            disponivel_estoque= disponivel_estoque - ".$row_car_prod['qnt_produto'].",
                            modified=NOW()
                            WHERE id='".$row_car_prod['produto_id']."'";
                    $resultado_prod = mysqli_query($conn, $result_prod);
                }
                //Apagar os produtos do carrinho
                $result_ap_car_prod = "DELETE FROM carrinhos_produtos WHERE carrinho_id='".$row_car['id']."'";
                $resultado_ap_car_prod = mysqli_query($conn, $result_ap_car_prod);
                
                $_SESSION['msg'] = "<div class='alert alert-success'>Finalizado a compra com sucesso!</div>";
                $url_destino = pg . "/visualizar/ver_venda?id=".$id_venda;
                header("Location: $url_destino");
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>A comprar não pode ser finalizada!</div>";
                $url_destino = pg . "/cadastrar/cad_car?id=" . $dados['id'];
                header("Location: $url_destino");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>A comprar não pode ser finalizada, não há produtos no carrinho!</div>";
            $url_destino = pg . "/cadastrar/cad_car?id=" . $dados['id'];
            header("Location: $url_destino");
        }
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao carregar o pagina!</div>";
    $url_destino = pg . "/listar/list_usuarios";
    header("Location: $url_destino");
}