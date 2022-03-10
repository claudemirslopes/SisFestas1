<?php
if(!isset($seguranca)){exit;}
//Recuperar o valor do botao
$SendEditLogo = filter_input(INPUT_POST, 'SendEditLogo', FILTER_SANITIZE_STRING);
//Botão vazio redireciona para o listar
if($SendEditLogo){
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    //Retira o campo "foto_antiga" da validação vazio
    $foto_antiga = $dados['foto_antiga'];
    unset($dados['foto_antiga']);
    
    //validar nenhum campo vazio
    $erro = false;
    $dados_validos = $dados;
    
    //validar extensão da imagem
    if(!empty ($_FILES['foto']['name'])){
        $foto = $_FILES['foto'];
        if(!validarExtesao($foto['type'])){
            $erro = true;
            $_SESSION['msg'] = "<div class='alert alert-warning mt-4'><i class='fa fa-exclamation-circle' aria-hidden='true'></i>&nbsp;&nbsp; Extensão de foto inválida!</div>";
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
        $url_destino = pg . "/visualizar/ver_logos";
        header("Location: $url_destino");
    } else {
        $result_logos = "UPDATE logos SET
                $campo_foto $valor_foto
                modified=NOW()
                WHERE id=1";
        $resultado_logos = mysqli_query($conn, $result_logos);
        if(mysqli_affected_rows($conn)){
            unset($_SESSION['dados']);
            
            //Redimensionar a imagem e fazer upload
            if(!empty($_FILES['foto']['name'])){
                $destino = "assets/images/logos/1/";
                $destino_apagar = $destino.$foto_antiga;
                apagarFoto($destino_apagar);
                upload($foto, $destino, 368, 237);
            }
            
            $_SESSION['msg'] = "<div class='alert alert-success mt-4'><i class='fa fa-check-circle' aria-hidden='true'></i>&nbsp;&nbsp; Logo atualizada com sucesso!</div>";
            $url_destino = pg . "/visualizar/ver_logos";
            header("Location: $url_destino");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger mt-4'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i>&nbsp;&nbsp; Erro ao atualizar Logo</div>";
            $url_destino = pg . "/visualizar/ver_logos";
            header("Location: $url_destino");
        }
    }
}else {
    $_SESSION['msg'] = "<div class='alert alert-danger mt-4'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i>&nbsp;&nbsp; Erro ao carregar a páginaa!</div>";
    $url_destino = pg . "/visualizar/home";
    header("Location: $url_destino");
}
