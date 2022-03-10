<?php
if(!isset($seguranca)){exit;}
//Recuperar o valor do botao
$SendEditStCompr = filter_input(INPUT_POST, 'SendEditStCompr', FILTER_SANITIZE_STRING);
//Botão vazio redireciona para o listar
if($SendEditStCompr){
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário preencher todos os campos para editar o status de compra!</div>";
    }
        
    else {
        //Proibir cadastro de status de compra duplicado
        $result_st_compr = "SELECT id FROM status_compras WHERE nome='" . $dados_validos['nome'] . "' AND id <> '".$dados['id']."' LIMIT 1";
        $resultado_st_compr = mysqli_query($conn, $result_st_compr);
        if (($resultado_st_compr) AND ( $resultado_st_compr->num_rows != 0)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='alert alert-danger'>Este status de compra já está cadastrado!</div>";
        }
    }
        
    //Houve erro em algum campo será redirecionado para o formulário, não há erro no formulário tenta editar no banco
    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/editar/edit_st_compr?id=".$dados['id'];
        header("Location: $url_destino");
    } else {
        $result_st_compr = "UPDATE status_compras SET
                nome='" . $dados_validos['nome'] . "', 
                cor_id='" . $dados_validos['cor_id'] . "', 
                modified=NOW()
                WHERE id='".$dados_validos['id']."'";
        $resultado_st_compr = mysqli_query($conn, $result_st_compr);
        if(mysqli_affected_rows($conn)){
            unset($_SESSION['dados']);
                        
            $_SESSION['msg'] = "<div class='alert alert-success'>Status de compra editado com sucesso</div>";
            $url_destino = pg . "/visualizar/ver_st_compr?id=".$dados['id'];
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao editar o status de compra</div>";
            $url_destino = pg . "/editar/edit_st_compr?id=".$dados['id'];
            header("Location: $url_destino");
        }
    }
}else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao carregar a página</div>";
    $url_destino = pg . "/listar/list_st_compr";
    header("Location: $url_destino");
}
