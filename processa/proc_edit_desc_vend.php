<?php

if (!isset($seguranca)) {
    exit;
}

$SendCadPorcDesc = filter_input(INPUT_POST, 'SendCadPorcDesc', FILTER_SANITIZE_STRING);
if ($SendCadPorcDesc) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //Validar nenhum campo vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário preencher todos os campos para fornecer o desconto!</div>";
    } else {
        //pesquisar na tabela produtos_vendas o produto
        $result_vend_prod = "SELECT vendprod.id, vendprod.qnt_produto,
                prod.nome nome_prod, prod.valor_venda, prod.porcento_desc,
                vend.id id_venda, vend.usuario_id
                FROM vendas_produtos vendprod
                INNER JOIN produtos prod ON prod.id=vendprod.produto_id
                INNER JOIN vendas vend ON vend.id=vendprod.venda_id
                WHERE vendprod.id='" . $dados['id'] . "'";
        $resultado_vend_prod = mysqli_query($conn, $result_vend_prod);
        if (($resultado_vend_prod) AND ( $resultado_vend_prod->num_rows != 0)) {
            $row_vend_prod = mysqli_fetch_assoc($resultado_vend_prod);
            //Verificar se aporcentagem de desconto do formulário é maior que a permitida no BD
            if ($dados_validos['porcento_desc'] <= $row_vend_prod['porcento_desc']) {
                //valor real de desconto
                $valor_desc = (($row_vend_prod['valor_venda'] * $dados_validos['porcento_desc']) / 100);
                //valor de venda menos o valor de desconto e multiplicar a quantidade de produtos no carrinho
                $valor_venda = ($row_vend_prod['valor_venda'] - $valor_desc) * $row_vend_prod['qnt_produto'];

                $result_vend_prod = "UPDATE vendas_produtos SET
                        valor_venda='$valor_venda',
                        modified=NOW()
                        WHERE id='" . $dados_validos['id'] . "'";
                $resultado_vend_prod = mysqli_query($conn, $result_vend_prod);
                if (mysqli_affected_rows($conn)) {
                    $_SESSION['msg'] = "<div class='alert alert-success'>Desconto fornecido ao produto com sucesso!</div>";
                    $url_destino = pg . "/visualizar/ver_venda?id=" . $dados['id_venda'];
                    header("Location: $url_destino");
                } else {
                    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao fornecer o desconto ao produto!</div>";
                    $url_destino = pg . "/visualizar/ver_venda?id=" . $dados['id_venda'];
                    header("Location: $url_destino");
                }
            } else {
                $erro = true;
                $_SESSION['msg'] = "<div class='alert alert-danger'>Porcentagem máxima de desconto: " . $row_vend_prod['porcento_desc'] . "%!</div>";
            }
        } else {
            $erro = true;
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao fornecer o desconto!</div>";
        }
    }

    if ($erro) {
        $url_destino = pg . "/visualizar/ver_venda?id=" . $dados['id_venda'];
        header("Location: $url_destino");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao carregar a página!</div>";
    $url_destino = pg . "/listar/list_usuarios";
    header("Location: $url_destino");
}

