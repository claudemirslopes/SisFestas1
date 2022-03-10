<?php
if(!isset($seguranca)){exit;}
//Recuperar o valor do botao
$SendEditForn = filter_input(INPUT_POST, 'SendEditForn', FILTER_SANITIZE_STRING);
//Botão vazio redireciona para o listar
if($SendEditForn){
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Necessário preencher todos os campos para editar o fornecedor!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }
        
    //Houve erro em algum campo será redirecionado para o formulário, não há erro no formulário tenta editar no banco
    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/editar/edit_fornecedores";
        header("Location: $url_destino");
    } else {
        $result_forn = "UPDATE fornecedores SET
                cnpj='" . $dados_validos['cnpj'] . "', 
                razao='" . $dados_validos['razao'] . "', 
                nome='" . $dados_validos['nome'] . "', 
                telefone='" . $dados_validos['telefone'] . "', 
                email='" . $dados_validos['email'] . "', 
                situacao='" . $dados_validos['situacao'] . "', 
                modified=NOW()
                WHERE id='".$dados_validos['id']."'";
        $resultado_forn = mysqli_query($conn, $result_forn);
        if(mysqli_affected_rows($conn)){
            unset($_SESSION['dados']);
                        
            $_SESSION['msg'] = "<div class='alert au-alert-success alert-dismissible fade show au-alert au-alert--70per mb-4' role='alert' style='width:100%;'>
            <i class='zmdi zmdi-check-circle'></i>
            <span class='content'>Fornecedor atualizado com sucesso.</span>
            <button class='close' type='button' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>
                    <i class='zmdi zmdi-close-circle'></i>
                </span>
            </button>
        </div>";
            // $url_destino = pg . "/visualizar/ver_fornecedores?id=".$dados['id'];
            $url_destino = pg . "/listar/list_fornecedores";
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Erro ao editar o fornecedor!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/editar/edit_fornecedores?id=".$dados['id'];
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
    $url_destino = pg . "/listar/list_fornecedores";
    header("Location: $url_destino");
}
