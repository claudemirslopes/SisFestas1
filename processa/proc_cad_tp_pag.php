<?php

if (!isset($seguranca)) {
    exit;
}

$SendCadTpPag = filter_input(INPUT_POST, 'SendCadTpPag', FILTER_SANITIZE_STRING);
if ($SendCadTpPag) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário preencher todos os campos para cadastrar o tipo de pagamento!</div>";
    }
    
    else {
        //Proibir cadastro de tipo de pagamento duplicado
        $result_tp_pag = "SELECT id FROM tipos_pagamentos WHERE nome='" . $dados_validos['nome'] . "' LIMIT 1";
        $resultado_tp_pag = mysqli_query($conn, $result_tp_pag);
        if (($resultado_tp_pag) AND ( $resultado_tp_pag->num_rows != 0)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='alert alert-danger'>Este tipo de pagamento já está cadastrado!</div>";
        }
    }

    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/cadastrar/cad_tp_pag";
        header("Location: $url_destino");
    } else {
        $result_tp_pag = "INSERT INTO tipos_pagamentos (nome, created) VALUES (
                '" . $dados_validos['nome'] . "',
                NOW())";
        $resultado_tp_pag = mysqli_query($conn, $result_tp_pag);
        if (mysqli_insert_id($conn)) {
            unset($_SESSION['dados']);
            $id_tp_pag = mysqli_insert_id($conn);
            $_SESSION['msg'] = "<div class='alert alert-success'>Cadastrado com sucesso o tipo de pagamento</div>";
            $url_destino = pg . "/visualizar/ver_tp_pag?id=".$id_tp_pag;
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao cadastrar o tipo de pagamento</div>";
            $url_destino = pg . "/cadastrar/cad_tp_pag";
            header("Location: $url_destino");
        }
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao carregar a página</div>";
    $url_destino = pg . "/listar/list_tp_pag";
    header("Location: $url_destino");
}