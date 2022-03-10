<?php

if (!isset($seguranca)) {
    exit;
}
$SendCadPorcDesc = filter_input(INPUT_POST, 'SendCadPorcDesc', FILTER_SANITIZE_STRING);

if ($SendCadPorcDesc) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //validar nenhum campo seja vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário preencher todos os campos para fornecer o desconto ao produto!</div>";
    } else {
        //Verificar se o produto está no carrinho
        $result_car_prod = "SELECT carprod.id, carprod.qnt_produto,
                prod.nome nome_prod,
                prod.valor_venda,
                prod.porcento_desc,
                car.usuario_id
                FROM carrinhos_produtos carprod
                INNER JOIN produtos prod ON prod.id=carprod.produto_id
                INNER JOIN carrinhos car ON car.id=carprod.carrinho_id
                WHERE carprod.id='" . $dados['id'] . "' LIMIT 1";

        $resultado_car_prod = mysqli_query($conn, $result_car_prod);
        if (($resultado_car_prod) AND ( $resultado_car_prod->num_rows != 0)) {
            $row_car_prod = mysqli_fetch_assoc($resultado_car_prod);
            //Verificar se a porcentagem de desconto do formulário é maior que a permitida no BD
            if ($dados['porcento_desc'] <= $row_car_prod['porcento_desc']) {
                //Valor real de desconto
                $valor_desc = (($row_car_prod['valor_venda'] * $dados['porcento_desc']) / 100);

                //valor de venda menos o valor de desconto e multiplica a quantidade de produtos no carrinho
                $valor_venda = ($row_car_prod['valor_venda'] - $valor_desc) * $row_car_prod['qnt_produto'];

                $result_car_prod = "UPDATE carrinhos_produtos SET
                        valor_venda='$valor_venda',
                        modified=NOW()
                        WHERE id='" . $dados_validos['id'] . "'";
                $resultado_car_prod = mysqli_query($conn, $result_car_prod);
                if (mysqli_affected_rows($conn)) {
                    $_SESSION['msg'] = "<div class='alert alert-success'>Desconto fornecido ao produto com sucesso!</div>";
                    $url_destino = pg . "/cadastrar/cad_car?id=" . $row_car_prod['usuario_id'];
                    header("Location: $url_destino");
                } else {
                    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao fornecer o desconto ao produto!</div>";
                    $url_destino = pg . "/cadastrar/cad_car?id=" . $row_car_prod['usuario_id'];
                    header("Location: $url_destino");
                }
            } else {
                $erro = true;
                $_SESSION['msg'] = "<div class='alert alert-danger'>Porcentagem máxima de desconto: " . $row_car_prod['porcento_desc'] . "%!</div>";
            }
        } else {
            $erro = true;
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao fornecer o desconto!</div>";
        }
    }


    if ($erro) {
        $url_destino = pg . "/cadastrar/cad_car?id=" . $dados['id_usuario'];
        header("Location: $url_destino");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao carregar a página</div>";
    $url_destino = pg . "/listar/list_usuarios";
    header("Location: $url_destino");
}