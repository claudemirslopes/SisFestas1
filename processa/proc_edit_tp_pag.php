<?php
if(!isset($seguranca)){exit;}
//Recuperar o valor do botao
$SendEditTpPag = filter_input(INPUT_POST, 'SendEditTpPag', FILTER_SANITIZE_STRING);
//Botão vazio redireciona para o listar
if($SendEditTpPag){
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
        $result_tp_pag = "SELECT id FROM tipos_pagamentos WHERE nome='" . $dados_validos['nome'] . "' AND id <> '".$dados['id']."' LIMIT 1";
        $resultado_tp_pag = mysqli_query($conn, $result_tp_pag);
        if (($resultado_tp_pag) AND ( $resultado_tp_pag->num_rows != 0)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='alert alert-danger'>Este tipo de pagamento já está cadastrado!</div>";
        }
    }
        
    //Houve erro em algum campo será redirecionado para o formulário, não há erro no formulário tenta editar no banco
    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/editar/edit_tp_pag?id=".$dados['id'];
        header("Location: $url_destino");
    } else {
        $result_tp_pag = "UPDATE tipos_pagamentos SET
                nome='" . $dados_validos['nome'] . "',
                modified=NOW()
                WHERE id='".$dados_validos['id']."'";
        $resultado_tp_pag = mysqli_query($conn, $result_tp_pag);
        if(mysqli_affected_rows($conn)){
            unset($_SESSION['dados']);
                        
            $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de Pagamento editado com sucesso</div>";
            $url_destino = pg . "/visualizar/ver_tp_pag?id=".$dados['id'];
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao editar o tipo de pagamento</div>";
            $url_destino = pg . "/editar/edit_tp_pag?id=".$dados['id'];
            header("Location: $url_destino");
        }
    }
}else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao carregar a página</div>";
    $url_destino = pg . "/listar/list_tp_pag";
    header("Location: $url_destino");
}
