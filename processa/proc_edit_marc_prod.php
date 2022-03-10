<?php
if(!isset($seguranca)){exit;}
//Recuperar o valor do botao
$SendEditMarcProd = filter_input(INPUT_POST, 'SendEditMarcProd', FILTER_SANITIZE_STRING);
//Botão vazio redireciona para o listar
if($SendEditMarcProd){
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Necessário preencher todos os campos para editar a marca de produto!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }
        
    else {
        //Proibir cadastro de marca de produto duplicado
        $result_marc_prod = "SELECT id FROM marcas_produtos WHERE nome='" . $dados_validos['nome'] . "' AND id <> '".$dados['id']."' LIMIT 1";
        $resultado_marc_prod = mysqli_query($conn, $result_marc_prod);
        if (($resultado_marc_prod) AND ( $resultado_marc_prod->num_rows != 0)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Esta marca de produto já está cadastrada!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
    }
        
    //Houve erro em algum campo será redirecionado para o formulário, não há erro no formulário tenta editar no banco
    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/editar/edit_marc_prod?id=".$dados['id'];
        header("Location: $url_destino");
    } else {
        $result_marc_prod = "UPDATE marcas_produtos SET
                nome='" . $dados_validos['nome'] . "', 
                situacao_id='" . $dados_validos['situacao_id'] . "', 
                modified=NOW()
                WHERE id='".$dados_validos['id']."'";
        $resultado_marc_prod = mysqli_query($conn, $result_marc_prod);
        if(mysqli_affected_rows($conn)){
            unset($_SESSION['dados']);
                        
            $_SESSION['msg'] = "<div class='alert au-alert-success alert-dismissible fade show au-alert au-alert--70per mb-4' role='alert' style='width:100%;'>
            <i class='zmdi zmdi-check-circle'></i>
            <span class='content'>marca de produto cadastrada com sucesso.</span>
            <button class='close' type='button' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>
                    <i class='zmdi zmdi-close-circle'></i>
                </span>
            </button>
        </div>";
            $url_destino = pg . "/visualizar/ver_marc_prod?id=".$dados['id'];
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Erro ao editar a marca de produto!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/editar/edit_marc_prod?id=".$dados['id'];
            header("Location: $url_destino");
        }
    }
}else {
    $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
    <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
    Erro ao carregar página!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>";
    $url_destino = pg . "/listar/list_marc_prod";
    header("Location: $url_destino");
}
