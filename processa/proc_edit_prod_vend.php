<?php

if (!isset($seguranca)) {
    exit;
}

$SendEditProdVend = filter_input(INPUT_POST, 'SendEditProdVend', FILTER_SANITIZE_STRING);
if ($SendEditProdVend) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //Validar se nenhum campo está vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário preencher todos os campos para editar a quantiade de produto!</div>";
    } elseif ($dados_validos['qnt_produto'] < 1) {
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-danger'>Quantidade de unidade inválido!</div>";
    }

    //Pesquisar os dados do produto vendido
    $result_prod_vend = "SELECT vendprod.*,
            vend.id id_venda, vend.status_compra_id,
            prod.id id_prod, prod.disponivel_estoque	
            FROM vendas_produtos vendprod
            INNER JOIN vendas vend ON vend.id=vendprod.venda_id
            INNER JOIN produtos prod ON prod.id=vendprod.produto_id
            WHERE vendprod.id='" . $dados['id'] . "' LIMIT 1";
    $resultado_prod_vend = mysqli_query($conn, $result_prod_vend);
    $row_prod_vend = mysqli_fetch_assoc($resultado_prod_vend);

    //Diminuir a quantidade já vendida da quantidade do formulário 
    $qnt_acresc = $dados_validos['qnt_produto'] - $row_prod_vend['qnt_produto'];
    if ($qnt_acresc > $row_prod_vend['disponivel_estoque']) {
        $erro = true;
        $disponivel_venda = $row_prod_vend['disponivel_estoque'] + $row_prod_vend['qnt_produto'];
        $_SESSION['msg'] = "<div class='alert alert-danger'>Quantidade disponivel no estoque insuficiente: Há disponivel " . $row_prod_vend['disponivel_estoque'] . " no estoque e mais o(s) " . $row_prod_vend['qnt_produto'] . " reservado para este cliente, total $disponivel_venda disponivel para essa compra!</div>";
    }


    //Acessa o IF se houver algum erro
    if ($erro) {
        $url_destino = pg . "/visualizar/ver_venda?id=" . $row_prod_vend['id_venda'];
        header("Location: $url_destino");
    } else {
        $valor_unitario_cot = $row_prod_vend['valor_cotacao'] / $row_prod_vend['qnt_produto'];
        $valor_atual_cot = $valor_unitario_cot * $dados_validos['qnt_produto'];

        $valor_unitario_vend = $row_prod_vend['valor_venda'] / $row_prod_vend['qnt_produto'];
        $valor_atual_vend = $valor_unitario_vend * $dados_validos['qnt_produto'];

        //Diminuir a quantida de unidade no estoque
        if ($dados_validos['qnt_produto'] > $row_prod_vend['qnt_produto']) {
            $qnt_prod_vend = $dados_validos['qnt_produto'] - $row_prod_vend['qnt_produto'];

            //Diminuir a qnt de produro no estoque
            $result_prod = "UPDATE produtos SET
                    disponivel_estoque=disponivel_estoque-'" . $qnt_acresc . "',
                    created=NOW()
                    WHERE id='" . $row_prod_vend['id_prod'] . "'";
            $resultado_prod = mysqli_query($conn, $result_prod);
        }

        //Aumentar a quantidade de unidade no estoque
        if ($dados_validos['qnt_produto'] < $row_prod_vend['qnt_produto']) {
            $qnt_reduz = $row_prod_vend['qnt_produto'] - $dados_validos['qnt_produto'];
            //Aumentar o produto no estoque
            $result_prod = "UPDATE produtos SET
                    disponivel_estoque=disponivel_estoque+'" . $qnt_reduz . "',
                    created=NOW()
                    WHERE id='" . $row_prod_vend['id_prod'] . "'";
            $resultado_prod = mysqli_query($conn, $result_prod);
        }

        //Alterar as informações do produto na venda
        $result_vend_prod = "UPDATE vendas_produtos SET
                valor_cotacao='$valor_atual_cot',
                valor_venda='$valor_atual_vend',
                qnt_produto='" . $dados_validos['qnt_produto'] . "',
                modified=NOW()
                WHERE id='" . $dados_validos['id'] . "'";
        $resultado_vend_prod = mysqli_query($conn, $result_vend_prod);
        if (mysqli_affected_rows($conn)) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Quantidade de produto alterado com sucesso!</div>";
            $url_destino = pg . "/visualizar/ver_venda?id=".$row_prod_vend['id_venda'];
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao alterar a quantiade de produto!</div>";
            $url_destino = pg . "/visualizar/ver_venda?id=".$row_prod_vend['id_venda'];
            header("Location: $url_destino");
        }
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao carregar a página!</div>";
    $url_destino = pg . "/listar/list_venda";
    header("Location: $url_destino");
}

