<?php

if (!isset($seguranca)) {
    exit;
}
$SendCadVendedor = filter_input(INPUT_POST, 'SendCadVendedor', FILTER_SANITIZE_STRING);
if ($SendCadVendedor) {
    /* $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
      $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
      $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING); */
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $dados['senha'] = str_replace(" ", "", $dados['senha']);
    $dados['usuario'] = str_replace(" ", "", $dados['usuario']);
    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Necessário preencher todos os campos para cadastrar o vendedor!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }
    //Validar e-mail
    elseif (!validarEmail($dados_validos['email'])) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
        <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        E-mail inválido!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    //validar senha
    elseif ((strlen($dados_validos['senha'])) < 6) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
        <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        A senha deve ter no mínimo 6 caracteres!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    } elseif (stristr($dados_validos['senha'], "'")) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
        <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Caracter ( ' ) utilizado na senha inválido!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    //Validar vendedor
    elseif (stristr($dados_validos['usuario'], "'")) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
        <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Caracter ( ' ) utilizado na senha inválido!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    } elseif ((strlen($dados_validos['usuario'])) < 6) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
        <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        O usuário deve ter no mínimo 6 caracteres!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }
    
    //validar extensão da imagem
    elseif(!empty ($_FILES['foto']['name'])){
        $foto = $_FILES['foto'];
        if(!validarExtesao($foto['type'])){
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Extensão de foto inválida!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }else{
            $foto['name'] = caracterEspecial($foto['name']);
            $campo_foto = "foto,";
            $valor_foto = "'".$foto['name']."',";
        }
        
    }
    
    else {
        //Proibir cadastro de codigo duplicado
        $result_usuario = "SELECT id FROM vendedores WHERE codigo='" . $dados_validos['codigo'] . "' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Este código já está cadastrado, tente novamente!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
        //Proibir cadastro de usuário duplicado
        $result_usuario = "SELECT id FROM vendedores WHERE usuario='" . $dados_validos['usuario'] . "' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Este usuário já está cadastrado!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
        //Proibir cadastro de email duplicado
        $result_usuario_email = "SELECT id FROM vendedores WHERE email='" . $dados_validos['email'] . "' LIMIT 1";
        $resultado_usuario_email = mysqli_query($conn, $result_usuario_email);
        if (($resultado_usuario_email) AND ( $resultado_usuario_email->num_rows != 0)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Este e-mail já está cadastrado!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
    }
    
    //Criar as variaveis da foto quando a mesma não está sendo cadastrada
    if(empty ($_FILES['foto']['name'])){
        $campo_foto = "";
        $valor_foto = "";
    }
    
    //Houve erro em algum campo será redirecionado para o formulário, não há erro no formulário tenta cadastrar no banco
    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/listar/list_vendedores";
        header("Location: $url_destino");
    } else {


        //Criptografar a senha
        $dados_validos['senha'] = password_hash($dados_validos['senha'], PASSWORD_DEFAULT);
        $result_usuario = "INSERT INTO vendedores (nome, email, usuario, senha, $campo_foto niveis_acesso_id, situacoes_usuario_id, codigo, created) 
                VALUES(
                '" . $dados_validos['nome'] . "', 
                '" . $dados_validos['email'] . "', 
                '" . $dados_validos['usuario'] . "', 
                '" . $dados_validos['senha'] . "', 
                    $valor_foto
                '" . $dados_validos['niveis_acesso_id'] . "',
                '" . $dados_validos['situacoes_usuario_id'] . "',
                '" . $dados_validos['codigo'] . "',
                 NOW())";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        if (mysqli_insert_id($conn)) {
            unset($_SESSION['dados']);
            
            //Redimensionar a imagem e fazer upload
            if(!empty($_FILES['foto']['name'])){
                $destino = "assets/images/vendedor/".mysqli_insert_id($conn)."/";
                upload($foto, $destino, 200, 200);
            }
            
            $_SESSION['msg'] = "<div class='alert au-alert-success alert-dismissible fade show au-alert au-alert--70per mb-4' role='alert' style='width:100%;'>
            <i class='zmdi zmdi-check-circle'></i>
            <span class='content'>Vendedor cadastrado com sucesso.</span>
            <button class='close' type='button' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>
                    <i class='zmdi zmdi-close-circle'></i>
                </span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_vendedores";
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Erro ao cadastrar vendedor!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_vendedores";
            header("Location: $url_destino");
        }
    }
} else {
    $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
    <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
    Erro ao cadastrar vendedor!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>";
    $url_destino = pg . "/listar/list_vendedores";
    header("Location: $url_destino");
}
// echo '<pre>';
//     print_r($dados_validos);
// exit();
