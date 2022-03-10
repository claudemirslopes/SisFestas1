<?php

if (!isset($seguranca)) {
    exit;
}
//Recuperar o valor do botao
$SendEditProd = filter_input(INPUT_POST, 'SendEditProd', FILTER_SANITIZE_STRING);
//Botão vazio redireciona para o listar
if ($SendEditProd) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //Retira o campo "foto_antiga" da validação vazio
    $foto_antiga = $dados['foto_antiga'];
    unset($dados['foto_antiga']);

    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = $dados;

    if ((strlen($dados_validos['nome'])) == '') {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        O nome do produto não pode estar em branco!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    elseif ((strlen($dados_validos['conteudo'])) < 10) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        A descrição curta tem que ter pelo menos 10 caracterers!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    elseif ((strlen($dados_validos['valor_venda'])) == '') {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        O valor de venda não pode estar em branco!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    elseif ((strlen($dados_validos['disponivel_estoque'])) == '') {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        A quantidade disponível não pode estar em branco!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    elseif ((strlen($dados_validos['min_estoque'])) == '') {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        A quantidade mínima não pode estar em branco!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    elseif ((strlen($dados_validos['categorias_produto_id'])) == '') {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        A categoria de produto deve ser selecionada!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    elseif ((strlen($dados_validos['marcas_produtos_id'])) == '') {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        A marca de produto deve ser selecionada!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    elseif ((strlen($dados_validos['fornecedor_id'])) == '') {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        O fornecedor deve ser selecionado!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    //Proibir cadastro de usuário duplicado
    $result_usuario = "SELECT id FROM produtos WHERE slug='" . $dados_validos['slug'] . "' AND id <> '".$dados['id']."' LIMIT 1";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
        <i class='fa fa-exclamation-triangle text-danger' aria-hidden='true'></i>&nbsp;&nbsp;
        Este slug já está cadastrado!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }

    //validar extensão da imagem
    elseif (!empty($_FILES['foto']['name'])) {
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
            $campo_foto = "foto=";
            $valor_foto = "'" . $foto['name'] . "',";
        }
    }

    //Criar as variaveis da foto quando a mesma não está sendo cadastrada
    if (empty($_FILES['foto']['name'])) {
        $campo_foto = "";
        $valor_foto = "";
    }

    //Houve erro em algum campo será redirecionado para o formulário, não há erro no formulário tenta editar no banco
    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/editar/edit_prod?id=" . $dados['id'];
        header("Location: $url_destino");
    } else {
        $dados_validos['valor_compra'] = str_replace(".", "", $dados_validos['valor_compra']);
        $dados_validos['valor_compra'] = str_replace(",", ".", $dados_validos['valor_compra']);

        $dados_validos['valor_venda'] = str_replace(".", "", $dados_validos['valor_venda']);
        $dados_validos['valor_venda'] = str_replace(",", ".", $dados_validos['valor_venda']);
        $result_prod = "UPDATE produtos SET
                nome='" . $dados_validos['nome'] . "', 
                $campo_foto $valor_foto
                conteudo='" . $dados['conteudo'] . "', 
                descricao='" . $dados_validos['descricao'] . "', 
                slug='" . $dados_validos['slug'] . "', 
                palavra_chave='" . $dados_validos['palavra_chave'] . "',
                valor_compra='" . $dados_validos['valor_compra'] . "', 
                valor_venda='" . $dados_validos['valor_venda'] . "', 
                porcento_desc='" . $dados_validos['porcento_desc'] . "', 
                disponivel_estoque='" . $dados_validos['disponivel_estoque'] . "', 
                min_estoque='" . $dados_validos['min_estoque'] . "',  
                editor='" . $_SESSION['id'] . "', 
                categorias_produto_id='" . $dados_validos['categorias_produto_id'] . "', 
                marcas_produtos_id='" . $dados_validos['marcas_produtos_id'] . "', 
                fornecedor_id='" . $dados_validos['fornecedor_id'] . "', 
                situacao_id='" . $dados_validos['situacao_id'] . "', 
                modified=NOW()
                WHERE id='" . $dados_validos['id'] . "'";
        $resultado_prod = mysqli_query($conn, $result_prod);
        if(mysqli_affected_rows($conn)){
            unset($_SESSION['dados']);
            
            //Redimensionar a imagem e fazer upload
            if(!empty($_FILES['foto']['name'])){
                $destino = "assets/images/produto/".$dados['id']."/";
                $destino_apagar = $destino.$foto_antiga;
                apagarFoto($destino_apagar);
                upload($foto, $destino, 200, 200);
            }
            
            $_SESSION['msg'] = "<div class='alert au-alert-success alert-dismissible fade show au-alert au-alert--70per mb-4' role='alert' style='width:100%;'>
            <i class='zmdi zmdi-check-circle'></i>
            <span class='content'>Produto atualizado com sucesso.</span>
            <button class='close' type='button' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>
                    <i class='zmdi zmdi-close-circle'></i>
                </span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_prod";
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Erro ao atualizar o produto!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/editar/edit_prod?id=".$dados['id'];
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
    $url_destino = pg . "/listar/list_prod";
    header("Location: $url_destino");
}
