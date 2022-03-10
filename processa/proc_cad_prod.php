<?php

if (!isset($seguranca)) {
    exit;
}

$SendCadProd = filter_input(INPUT_POST, 'SendCadProd', FILTER_SANITIZE_STRING);
if ($SendCadProd) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

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
            $campo_foto = "foto,";
            $valor_foto = "'" . $foto['name'] . "',";
        }
    }

    $dados_validos['slug'] = caracterEspecial($dados_validos['slug']);
    //Proibir cadastro de slug duplicado
    $result_slug = "SELECT id FROM produtos WHERE slug='" . $dados_validos['slug'] . "' LIMIT 1";
    $resultado_slug = mysqli_query($conn, $result_slug);
    if (($resultado_slug) AND ( $resultado_slug->num_rows != 0)) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Este slug já está cadastrado!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }
    //Proibir cadastro de código do produto duplicado
    $result_cod_prod = "SELECT id FROM produtos WHERE codigo_produto='" . $dados_validos['codigo_produto'] . "' LIMIT 1";
    $resultado_cod_prod = mysqli_query($conn, $result_cod_prod);
    if (($resultado_cod_prod) AND ( $resultado_cod_prod->num_rows != 0)) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Este código de produto já está cadastrado!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }
    //Proibir cadastro de código de barras duplicado
    $result_cod_barra = "SELECT id FROM produtos WHERE codigo_barra='" . $dados_validos['codigo_barra'] . "' LIMIT 1";
    $resultado_cod_barra = mysqli_query($conn, $result_cod_barra);
    if (($resultado_cod_barra) AND ( $resultado_cod_barra->num_rows != 0)) {
        $erro = true;
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show' style='border-left: 4px solid #FFC107;'>
        <i class='fa fa-exclamation-circle text-warning fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Este código de barra já está cadastrado!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }
    //Criar as variaveis da foto quando a mesma não está sendo cadastrada
    if (empty($_FILES['foto']['name'])) {
        $campo_foto = "";
        $valor_foto = "";
    }

    if ($erro) {
        $_SESSION['dados'] = $dados;
        $url_destino = pg . "/cadastrar/cad_prod";
        header("Location: $url_destino");
    } else {
        $dados_validos['valor_compra'] = str_replace(".", "", $dados_validos['valor_compra']);
        $dados_validos['valor_compra'] = str_replace(",", ".", $dados_validos['valor_compra']);

        $dados_validos['valor_venda'] = str_replace(".", "", $dados_validos['valor_venda']);
        $dados_validos['valor_venda'] = str_replace(",", ".", $dados_validos['valor_venda']);

        $result_prod = "INSERT INTO produtos (codigo_produto, nome, $campo_foto conteudo, descricao, slug, palavra_chave, codigo_barra, valor_compra, valor_venda, porcento_desc, disponivel_estoque, min_estoque, cadastro, categorias_produto_id, marcas_produtos_id, fornecedor_id, situacao_id, created) 
                VALUES(
                '" . $dados_validos['codigo_produto'] . "',
                '" . $dados_validos['nome'] . "', 
                    $valor_foto
                '" . $dados['conteudo'] . "', 
                '" . $dados_validos['descricao'] . "',
                '" . $dados_validos['slug'] . "', 
                '" . $dados_validos['palavra_chave'] . "',
                '" . $dados_validos['codigo_barra'] . "',
                '" . $dados_validos['valor_compra'] . "',
                '" . $dados_validos['valor_venda'] . "',
                '" . $dados_validos['porcento_desc'] . "',
                '" . $dados_validos['disponivel_estoque'] . "',
                '" . $dados_validos['min_estoque'] . "',
                '" . $_SESSION['id'] . "',
                '" . $dados_validos['categorias_produto_id'] . "',
                '" . $dados_validos['marcas_produtos_id'] . "',
                '" . $dados_validos['fornecedor_id'] . "',
                '" . $dados_validos['situacao_id'] . "',
                 NOW())";
        $resultado_prod = mysqli_query($conn, $result_prod);
        if (mysqli_insert_id($conn)) {
            unset($_SESSION['dados']);

            //Redimensionar a imagem e fazer upload
            if (!empty($_FILES['foto']['name'])) {
                $destino = "assets/images/produto/" . mysqli_insert_id($conn) . "/";
                upload($foto, $destino, 200, 200);
            }

            $_SESSION['msg'] = "<div class='alert au-alert-success alert-dismissible fade show au-alert au-alert--70per mb-4' role='alert' style='width:100%;'>
            <i class='zmdi zmdi-check-circle'></i>
            <span class='content'>Produto cadastrado com sucesso.</span>
            <button class='close' type='button' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>
                    <i class='zmdi zmdi-close-circle'></i>
                </span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_prod";
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Erro ao cadastrar o produto!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/cadastrar/cad_prod";
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