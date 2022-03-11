<?php
if(!isset($seguranca)){exit;}
//Recuperar o valor do botao
$SendEditFoto = filter_input(INPUT_POST, 'SendEditFoto', FILTER_SANITIZE_STRING);
//Botão vazio redireciona para o listar
if($SendEditFoto){
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    //Retira o campo "foto_antiga" da validação vazio
    $foto_antiga = $dados['foto_antiga'];
    unset($dados['foto_antiga']);
    
    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = vazio($dados);
    if (!$dados_validos) {
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-warning'><i class='fa fa-exclamation-circle' aria-hidden='true'></i>&nbsp;&nbsp; Necessário preencher todos os campos para editar a foto!</div>";
    }
    
    //validar extensão da imagem
    elseif(!empty ($_FILES['foto']['name'])){
        $foto = $_FILES['foto'];
        if(!validarExtesao($foto['type'])){
            $erro = true;
            $_SESSION['msg'] = "<div class='alert alert-warning'><i class='fa fa-exclamation-circle' aria-hidden='true'></i>&nbsp;&nbsp; Extensão de foto inválida!</div>";
        }else{
            $foto['name'] = caracterEspecial($foto['name']);
            $campo_foto = "foto=";
            $valor_foto = "'".$foto['name']."',";
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
        $url_destino = pg . "/visualizar/home";
        header("Location: $url_destino");
    } else {
        $result_usuario = "UPDATE usuarios SET
                $campo_foto $valor_foto
                modified=NOW()
                WHERE id='".$_SESSION['id']."'";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        if(mysqli_affected_rows($conn)){
            unset($_SESSION['dados']);
            
            //Redimensionar a imagem e fazer upload
            if(!empty($_FILES['foto']['name'])){
                $destino = "assets/images/usuario/".$_SESSION['id']."/";
                $destino_apagar = $destino.$foto_antiga;
                apagarFoto($destino_apagar);
                upload($foto, $destino, 200, 200);
            }
            
            $_SESSION['msg'] = "<div class='alert alert-success'><i class='fa fa-check-circle' aria-hidden='true'></i>&nbsp;&nbsp; Foto alterada com sucesso!</div>";
            $url_destino = pg . "/visualizar/home";
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i>&nbsp;&nbsp; Erro ao editar foto!</div>";
            $url_destino = pg . "/visualizar/home";
            header("Location: $url_destino");
        }
    }
}else {
    $_SESSION['msg'] = "<div class='alert alert-danger'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i>&nbsp;&nbsp; Erro ao carregar página!</div>";
    $url_destino = pg . "/visualizar/home";
    header("Location: $url_destino");
}
