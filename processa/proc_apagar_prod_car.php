<?php

if (!isset($seguranca)) {
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    $prod = filter_input(INPUT_GET, 'prod', FILTER_SANITIZE_NUMBER_INT);
    if (!empty($prod)) {
        $result_car_prod = "DELETE FROM carrinhos_produtos 
                WHERE id='$prod'";
        $resultado_car_prod = mysqli_query($conn, $result_car_prod);

        if (mysqli_affected_rows($conn)) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Produto removido com sucesso!</div>";
            $url_destino = pg . "/cadastrar/cad_car?id=" . $id;
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao remover o produto do carrinho!</div>";
            $url_destino = pg . "/cadastrar/cad_car?id=" . $id;
            header("Location: $url_destino");
        }
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Produto inválido!</div>";
        $url_destino = pg . "/cadastrar/cad_car?id=" . $id;
        header("Location: $url_destino");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao carregar o usuário!</div>";
    $url_destino = pg . "/listar/list_usuarios";
    header("Location: $url_destino");
}
