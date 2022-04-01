<?php
if(!isset($seguranca)){exit;}

//Recuperar o valor do botao
$SendEditCliente2 = filter_input(INPUT_POST, 'SendEditCliente2', FILTER_SANITIZE_STRING);
//Botão vazio redireciona para o listar
if($SendEditCliente2){
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    //Retira o campo "foto_antiga" da validação vazio
    
    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = $dados;

    //validar telefone em branco
    if ((strlen($dados_validos['telefone'])) < 10) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        O Telefone/Celular deve ter no mínimo 10 caracteres!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }
    

    //validar CEP em branco
    elseif ((strlen($dados_validos['cep'])) < 8) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        O CEP deve ter no mínimo 8 caracteres!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    //validar rua em branco
    elseif ((strlen($dados_validos['rua'])) == '') {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        O campo rua não pode estar em branco!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    //validar bairro em branco
    elseif ((strlen($dados_validos['bairro'])) == '') {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        O campo bairro não pode estar em branco!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    //validar cidade em branco
    elseif ((strlen($dados_validos['cidade'])) == '') {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        O campo cidade não pode estar em branco!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }
    
    //Houve erro em algum campo será redirecionado para o formulário, não há erro no formulário tenta editar no banco
    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/editar/edit_clientes?id=".$dados['id'];
        header("Location: $url_destino");
    } else {
        
       //Criptografar a senha
        $dados_validos['senha'] = password_hash($dados_validos['senha'], PASSWORD_DEFAULT);
        $result_usuario = "UPDATE clientes SET
                telefone='" . $dados_validos['telefone'] . "',
                cep='" . $dados_validos['cep'] . "',
                rua='" . $dados_validos['rua'] . "',
                numero='" . $dados_validos['numero'] . "',
                complemento='" . $dados_validos['complemento'] . "',
                bairro='" . $dados_validos['bairro'] . "',
                cidade='" . $dados_validos['cidade'] . "',
                uf='" . $dados_validos['uf'] . "',
                obs='" . $dados_validos['obs'] . "',
                modified=NOW()
                WHERE id='".$dados_validos['id']."'";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        if(mysqli_affected_rows($conn)){
            unset($_SESSION['dados']);
            
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-success alert-dismissible fade show' style='border-left: 4px solid #28A745;'>
            <i class='fa fa-exclamation-triangle text-success fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Contato editado com sucesso!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/editar/edit_clientes?id=".$dados['id'];
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Erro ao editar o cliente!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/editar/edit_clientes?id=".$dados['id'];
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
    $url_destino = pg . "/editar/edit_clientes?id=".$dados['id'];
    header("Location: $url_destino");
}
