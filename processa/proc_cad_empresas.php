<?php

if (!isset($seguranca)) {
    exit;
}

$SendCadEmpresa = filter_input(INPUT_POST, 'SendCadEmpresa', FILTER_SANITIZE_STRING);
if ($SendCadEmpresa) {
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
    $cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);
    $rg = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_STRING);
    $ie = filter_input(INPUT_POST, 'ie', FILTER_SANITIZE_STRING);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $rsocial = filter_input(INPUT_POST, 'rsocial', FILTER_SANITIZE_STRING);
    $sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
    $fantasia = filter_input(INPUT_POST, 'fantasia', FILTER_SANITIZE_STRING);
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = $dados;

    if ($cpf = $_POST['cpf']) {
        $dados_validos['cpf_cnpj'] = $cpf;
    } else {
        $dados_validos['cpf_cnpj'] = $cnpj;
    }

    if ($cpf = $_POST['rg']) {
        $dados_validos['rg_ie'] = $rg;
    } else {
        $dados_validos['rg_ie'] = $ie;
    }

    if ($cpf = $_POST['nome']) {
        $dados_validos['nome_rsocial'] = $nome;
    } else {
        $dados_validos['nome_rsocial'] = $rsocial;
    }

    if ($cpf = $_POST['sobrenome']) {
        $dados_validos['snome_fantasia'] = $sobrenome;
    } else {
        $dados_validos['snome_fantasia'] = $fantasia;
    }   
    
    if ($dados_validos['tipo'] == 'F') {
    // Aqui faz a condição para verificar se o CPF é inválido
        if (validaCPF($dados_validos['cpf_cnpj'])) {
            $erro = false;
        } else {
            $erro = true;
                $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
                <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
                Este CPF é inválido!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
        }
    }

    if ($dados_validos['tipo'] == 'F') {
        //validar CPF em branco
        if ((strlen($dados_validos['cpf_cnpj'])) < 11) {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            O CPF deve ter no mínimo 11 caracteres!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
    } else {
        //validar CNPJ em branco
        if ((strlen($dados_validos['cpf_cnpj'])) < 14) {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            O CNPJ deve ter no mínimo 14 caracteres!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
    }

    if ($dados_validos['tipo'] == 'F') {
        //validar nome em branco
        if ((strlen($dados_validos['nome_rsocial'])) == '') {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            O nome não pode estar em branco!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
    } else {
        //validar razão social em branco
        if ((strlen($dados_validos['nome_rsocial'])) == '') {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            A razão social não pode estar em branco!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
    }    

    if ($dados_validos['tipo'] == 'F') {
        //validar nome em branco
        if ((strlen($dados_validos['snome_fantasia'])) == '') {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            O sobrenome não pode estar em branco!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
    } else {
        //validar razão social em branco
        if ((strlen($dados_validos['snome_fantasia'])) == '') {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            O nome fantasia não pode estar em branco!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
    } 

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

    else {
        //Proibir cadastro de CPF duplicado
        $result_usuario = "SELECT id FROM empresas WHERE cpf_cnpj='" . $dados_validos['cpf_cnpj'] . "' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Este CPF já está cadastrado, tente novamente!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        }
        //Proibir cadastro de email duplicado
        $result_usuario_email = "SELECT id FROM empresas WHERE email='" . $dados_validos['email'] . "' LIMIT 1";
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

    //validar extensão da imagem
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto'];
        if (!validarExtesao($foto['type'])) {
            $erro = true;
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
            <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Extensão de foto inválida!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        } else {
            $foto['name'] = caracterEspecial($foto['name']);
            $campo_foto = "foto,";
            $valor_foto = "'" . $foto['name'] . "',";
        }
    }
    
    //Criar as variaveis da foto quando a mesma não está sendo cadastrada
    if(empty ($_FILES['foto']['name'])){
        $campo_foto = "";
        $valor_foto = "";
    }

    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/cadastrar/cad_empresas";
        header("Location: $url_destino");
    } else {
        $result_prod = "INSERT INTO empresas (tipo, cpf_cnpj, rg_ie, nome_rsocial, snome_fantasia, telefone, email, cep, rua, numero, complemento, bairro, cidade, uf, obs, $campo_foto situacao, created) 
                 VALUES(
                '" . $dados_validos['tipo'] . "',
                '" . $dados_validos['cpf_cnpj'] . "',
                '" . $dados_validos['rg_ie'] . "',
                '" . $dados_validos['nome_rsocial'] . "', 
                '" . $dados_validos['snome_fantasia'] . "', 
                '" . $dados_validos['telefone'] . "',
                '" . $dados_validos['email'] . "',  
                '" . $dados_validos['cep'] . "',
                '" . $dados_validos['rua'] . "',
                '" . $dados_validos['numero'] . "',
                '" . $dados_validos['complemento'] . "',
                '" . $dados_validos['bairro'] . "',
                '" . $dados_validos['cidade'] . "',
                '" . $dados_validos['uf'] . "',
                '" . $dados_validos['obs'] . "',
                    $valor_foto
                '" . $dados_validos['situacao'] . "',
                 NOW())";
        $resultado_prod = mysqli_query($conn, $result_prod);
        if (mysqli_insert_id($conn)) {
            unset($_SESSION['dados']);
            
            //Redimensionar a imagem e fazer upload
            $width = 179;
            $heigth = 52;
            if (!empty($_FILES['foto']['name'])) {
                $destino = "assets/images/empresa/" . mysqli_insert_id($conn) . "/";
                upload($foto, $destino, $width, $heigth);
            }

            $_SESSION['msg'] = "<div class='alert au-alert-success alert-dismissible fade show au-alert au-alert--70per mb-4' role='alert' style='width:100%;'>
            <i class='zmdi zmdi-check-circle'></i>
            <span class='content'>Empresa cadastrado com sucesso.</span>
            <button class='close' type='button' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>
                    <i class='zmdi zmdi-close-circle'></i>
                </span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_empresas";
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Erro ao cadastrar empresa!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/cadastrar/cad_empresas";
            header("Location: $url_destino");
        }
    }
} else {
    $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
    <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
    Erro ao carregar a página!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>";
    $url_destino = pg . "/listar/list_empresas";
    header("Location: $url_destino");
}