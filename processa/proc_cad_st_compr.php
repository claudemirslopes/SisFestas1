<?php

if (!isset($seguranca)) {
    exit;
}

$SendCadStCompr = filter_input(INPUT_POST, 'SendCadStCompr', FILTER_SANITIZE_STRING);
if ($SendCadStCompr) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário preencher todos os campos para cadastrar o status da compra!</div>";
    }
    
    else {
        //Proibir cadastro de status de compra duplicado
        $result_st_compr = "SELECT id FROM status_compras WHERE nome='" . $dados_validos['nome'] . "' LIMIT 1";
        $resultado_st_compr = mysqli_query($conn, $result_st_compr);
        if (($resultado_st_compr) AND ( $resultado_st_compr->num_rows != 0)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='alert alert-danger'>Este status de compra já está cadastrada!</div>";
        }
    }

    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/cadastrar/cad_st_compr";
        header("Location: $url_destino");
    } else {
        $result_st_compr = "INSERT INTO status_compras (nome, cor_id, created) VALUES (
                '" . $dados_validos['nome'] . "',
                '" . $dados_validos['cor_id'] . "',
                NOW())";
        $resultado_st_compr = mysqli_query($conn, $result_st_compr);
        if (mysqli_insert_id($conn)) {
            unset($_SESSION['dados']);
            $_SESSION['msg'] = "<div class='alert alert-success'>Cadastrado com sucesso o status de compra</div>";
            $url_destino = pg . "/listar/list_st_compr";
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao cadastrar o status de compra</div>";
            $url_destino = pg . "/cadastrar/cad_st_compr";
            header("Location: $url_destino");
        }
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao carregar a página</div>";
    $url_destino = pg . "/listar/list_st_compr";
    header("Location: $url_destino");
}