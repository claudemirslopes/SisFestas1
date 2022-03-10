<?php

if (!isset($seguranca)) {
    exit;
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
//Verificar a existencia do ID na URL
if (!empty($id)) {
    //Pesquisar as informaçõe do produto no carrinho
    $result_car = "SELECT carprod.id, carprod.valor_cotacao, carprod.valor_venda,carprod.qnt_produto, carprod.produto_id,
            car.usuario_id
            FROM carrinhos_produtos carprod
            INNER JOIN carrinhos car ON car.id=carprod.carrinho_id
            WHERE carprod.id='$id' LIMIT 1";
    $resultado_car = mysqli_query($conn, $result_car);
    $row_car = mysqli_fetch_assoc($resultado_car);

    $row_car['qnt_produto_at'] = $row_car['qnt_produto'] + 1;

    //Pesquisar quantos produtos há estoque
    $result_prod = "SELECT id, disponivel_estoque
            FROM produtos 
            WHERE  id='" . $row_car['produto_id'] . "'
            LIMIT 1";
    $resultado_prod = mysqli_query($conn, $result_prod);
    $row_prod = mysqli_fetch_assoc($resultado_prod);

    if ($row_prod['disponivel_estoque'] >= $row_car['qnt_produto_at']) {
        $row_car['valor_cotacao'] = ($row_car['valor_cotacao'] / $row_car['qnt_produto']) * $row_car['qnt_produto_at'];

        $row_car['valor_venda'] = ($row_car['valor_venda'] / $row_car['qnt_produto']) * $row_car['qnt_produto_at'];

        $result_car_prod = "UPDATE carrinhos_produtos SET
            valor_cotacao='" . $row_car['valor_cotacao'] . "',
            valor_venda='" . $row_car['valor_venda'] . "',
            qnt_produto='" . $row_car['qnt_produto_at'] . "',
            modified = NOW()
            WHERE id='$id'";
        $resultado_car_prod = mysqli_query($conn, $result_car_prod);
        if (mysqli_affected_rows($conn)) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Quantidade de Produto alterado com sucesso!</div>";
            $url_destino = pg . "/cadastrar/cad_car?id=" . $row_car['usuario_id'];
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao editar a quantidade de produto!</div>";
            $url_destino = pg . "/cadastrar/cad_car?id=" . $row_car['usuario_id'];
            header("Location: $url_destino");
        }
    } else {
        if ($row_prod['disponivel_estoque'] < $row_car['qnt_produto']) {
            $row_car['qnt_produto_at'] = $row_prod['disponivel_estoque'];

            $row_car['valor_cotacao'] = ($row_car['valor_cotacao'] / $row_car['qnt_produto']) * $row_car['qnt_produto_at'];

            $row_car['valor_venda'] = ($row_car['valor_venda'] / $row_car['qnt_produto']) * $row_car['qnt_produto_at'];
            
            $result_car_prod = "UPDATE carrinhos_produtos SET
                valor_cotacao='" . $row_car['valor_cotacao'] . "',
                valor_venda='" . $row_car['valor_venda'] . "',
                qnt_produto='" . $row_car['qnt_produto_at'] . "',
                modified = NOW()
                WHERE id='$id'";
            $resultado_car_prod = mysqli_query($conn, $result_car_prod);
        
        }
        $_SESSION['msg'] = "<div class='alert alert-danger'>Quantidade de produto insuficiente: Há disponível " . $row_prod['disponivel_estoque'] . "!</div>";
        $url_destino = pg . "/cadastrar/cad_car?id=" . $row_car['usuario_id'];
        header("Location: $url_destino");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Nenhum produto encontrado!</div>";
    $url_destino = pg . "/listar/list_usuarios";
    header("Location: $url_destino");
}