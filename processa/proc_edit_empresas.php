<?php
if(!isset($seguranca)){exit;}
//Recuperar o valor do botao
$SendEditEmpresa = filter_input(INPUT_POST, 'SendEditEmpresa', FILTER_SANITIZE_STRING);
//Botão vazio redireciona para o listar
if($SendEditEmpresa){
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    //Retira o campo "foto_antiga" da validação vazio
    $foto_antiga = $dados['foto_antiga'];
    unset($dados['foto_antiga']);
    
    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = $dados;

    //validar nome
    if ((strlen($dados_validos['nome_rsocial'])) == '') {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        O nome ou razão social não pode estar em branco!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    //validar nome
    elseif ((strlen($dados_validos['snome_fantasia'])) == '') {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        O sobrenome ou nome fantasia não pode estar em branco!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    //Validar e-mail
    elseif (!validarEmail($dados_validos['email'])) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        E-mail inválido!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    //validar telefone em branco
    elseif ((strlen($dados_validos['telefone'])) < 10) {
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

    
    //validar extensão da imagem
    elseif(!empty ($_FILES['foto']['name'])){
        $foto = $_FILES['foto'];
        if(!validarExtesao($foto['type'])){
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger' aria-hidden='true'></i>&nbsp;&nbsp;
            Extensão de foto inválida!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }else{
            $foto['name'] = caracterEspecial($foto['name']);
            $campo_foto = "foto=";
            $valor_foto = "'".$foto['name']."',";
        }        
    }
    
    else {
        //Proibir cadastro de email duplicado
        $result_usuario_email = "SELECT id FROM empresas WHERE email='" . $dados_validos['email'] . "'  AND id <> '".$dados['id']."'LIMIT 1";
        $resultado_usuario_email = mysqli_query($conn, $result_usuario_email);
        if (($resultado_usuario_email) AND ( $resultado_usuario_email->num_rows != 0)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning' aria-hidden='true'></i>&nbsp;&nbsp;
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
    
    //Houve erro em algum campo será redirecionado para o formulário, não há erro no formulário tenta editar no banco
    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/editar/edit_empresas?id=".$dados['id'];
        header("Location: $url_destino");
    } else {
        
       //Passar as informações do form para o bd
        $result_usuario = "UPDATE empresas SET
                rg_ie='" . $dados_validos['rg_ie'] . "', 
                nome_rsocial='" . $dados_validos['nome_rsocial'] . "',
                snome_fantasia='" . $dados_validos['snome_fantasia'] . "',
                telefone='" . $dados_validos['telefone'] . "',
                email='" . $dados_validos['email'] . "',
                cep='" . $dados_validos['cep'] . "',
                rua='" . $dados_validos['rua'] . "',
                numero='" . $dados_validos['numero'] . "',
                complemento='" . $dados_validos['complemento'] . "',
                bairro='" . $dados_validos['bairro'] . "',
                cidade='" . $dados_validos['cidade'] . "',
                uf='" . $dados_validos['uf'] . "',
                obs='" . $dados_validos['obs'] . "', 
                $campo_foto $valor_foto
                situacao='" . $dados_validos['situacao'] . "', 
                modified=NOW()
                WHERE id='".$dados_validos['id']."'";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        if(mysqli_affected_rows($conn)){
            unset($_SESSION['dados']);
            
            //Redimensionar a imagem e fazer upload
            $width = 179;
            $heigth = 52;
            if(!empty($_FILES['foto']['name'])){
                $destino = "assets/images/empresa/".$dados['id']."/";
                $destino_apagar = $destino.$foto_antiga;
                apagarFoto($destino_apagar);
                upload($foto, $destino, $width, $heigth);
            }
            
            $_SESSION['msg'] = "<div class='alert au-alert-success alert-dismissible fade show au-alert au-alert--70per mb-4' role='alert' style='width:100%;'>
            <i class='zmdi zmdi-check-circle'></i>
            <span class='content'>Empresa editada com sucesso.</span>
            <button class='close' type='button' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>
                    <i class='zmdi zmdi-close-circle'></i>
                </span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_empresas";
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Erro ao editar a empresa!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/editar/edit_empresas?id=".$dados['id'];
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
    $url_destino = pg . "/listar/list_empresas";
    header("Location: $url_destino");
}
