<?php

if (!isset($seguranca)) {
    exit;
}

$SendCadForn = filter_input(INPUT_POST, 'SendCadForn', FILTER_SANITIZE_STRING);
if ($SendCadForn) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Necessário preencher todos os campos para cadastrar o fornecedor!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }
    
    else {
        //Proibir cadastro de fornecedor de produto duplicado
        $result_forn = "SELECT id FROM fornecedores WHERE cnpj='" . $dados_validos['cnpj'] . "' LIMIT 1";
        $resultado_forn = mysqli_query($conn, $result_forn);
        if (($resultado_forn) AND ( $resultado_forn->num_rows != 0)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Necessário preencher todos os campos para cadastrar o fornecedor!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
    }

    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/cadastrar/cad_fornecedores";
        header("Location: $url_destino");
    } else {
        $result_forn = "INSERT INTO fornecedores (cnpj, razao, nome, telefone, email, situacao, created) VALUES (
                '" . $dados_validos['cnpj'] . "',
                '" . $dados_validos['razao'] . "',
                '" . $dados_validos['nome'] . "',
                '" . $dados_validos['telefone'] . "',
                '" . $dados_validos['email'] . "',
                '" . $dados_validos['situacao'] . "',
                NOW())";
        $resultado_forn = mysqli_query($conn, $result_forn);
        if (mysqli_insert_id($conn)) {
            unset($_SESSION['dados']);
            $_SESSION['msg'] = "<div class='alert au-alert-success alert-dismissible fade show au-alert au-alert--70per mb-4' role='alert' style='width:100%;'>
            <i class='zmdi zmdi-check-circle'></i>
            <span class='content'>Fornecedor cadastrado com sucesso.</span>
            <button class='close' type='button' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>
                    <i class='zmdi zmdi-close-circle'></i>
                </span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_fornecedores";
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Erro ao cadastrar o fornecedor!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/cadastrar/cad_fornecedores";
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
    $url_destino = pg . "/listar/list_fornecedores";
    header("Location: $url_destino");
}