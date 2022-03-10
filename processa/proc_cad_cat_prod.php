<?php

if (!isset($seguranca)) {
    exit;
}

$SendCadCatProd = filter_input(INPUT_POST, 'SendCadCatProd', FILTER_SANITIZE_STRING);
if ($SendCadCatProd) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Necessário preencher todos os campos para cadastrar a categoria de produto!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }
    
    else {
        //Proibir cadastro de categoria de produto duplicado
        $result_cat_prod = "SELECT id FROM categorias_produtos WHERE nome='" . $dados_validos['nome'] . "' LIMIT 1";
        $resultado_cat_prod = mysqli_query($conn, $result_cat_prod);
        if (($resultado_cat_prod) AND ( $resultado_cat_prod->num_rows != 0)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Esta categoria de produto já está cadastrada!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
    }

    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/cadastrar/cad_cat_prod";
        header("Location: $url_destino");
    } else {
        $result_cat_prod = "INSERT INTO categorias_produtos (nome, situacao_id, created) VALUES (
                '" . $dados_validos['nome'] . "',
                '" . $dados_validos['situacao_id'] . "',
                NOW())";
        $resultado_cat_prod = mysqli_query($conn, $result_cat_prod);
        if (mysqli_insert_id($conn)) {
            unset($_SESSION['dados']);
            $_SESSION['msg'] = "<div class='alert au-alert-success alert-dismissible fade show au-alert au-alert--70per mb-4' role='alert' style='width:100%;'>
            <i class='zmdi zmdi-check-circle'></i>
            <span class='content'>Categoria de produto cadastrada com sucesso.</span>
            <button class='close' type='button' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>
                    <i class='zmdi zmdi-close-circle'></i>
                </span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_cat_prod";
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Erro ao cadastrar a categoria de produto!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/cadastrar/cad_cat_prod";
            header("Location: $url_destino");
        }
    }
} else {
    $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
    <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
    Erro ao carregar página!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>";
    $url_destino = pg . "/listar/list_cat_prod";
    header("Location: $url_destino");
}