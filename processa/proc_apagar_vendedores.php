<?php

if (!isset($seguranca)) {
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    if ($_SESSION['niveis_acesso_id'] == 1) {
        $result_usuario = "SELECT id, foto FROM vendedores WHERE id='$id'";
    } else {
        $result_usuario = "SELECT user.id, user.foto,
        niv.nome_nivel_acesso
            FROM vendedores user
            INNER JOIN niveis_acessos_vend niv on niv.id=user.niveis_acesso_id 
            WHERE niv.ordem > '".$_SESSION['ordem']."' AND user.id='$id'
            LIMIT 1";
    }
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    //Verificar se encontrou algum usuarios
    if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
        $row_usuario = mysqli_fetch_assoc($resultado_usuario);
        //Apagar o usuário
        $result_usuario_del = "DELETE FROM vendedores WHERE id = '$id'";
        $resultado_usuario_del = mysqli_query($conn, $result_usuario_del);
        if (mysqli_affected_rows($conn)) {
            //Apagar a foto
            $destino_apagar = "assets/images/vendedor/".$id."/".$row_usuario['foto'];
            apagarFoto($destino_apagar);
            
            $_SESSION['msg'] = "<div class='alert au-alert-success alert-dismissible fade show au-alert au-alert--70per mb-4' role='alert' style='width:100%;'>
            <i class='zmdi zmdi-check-circle'></i>
            <span class='content'>Vendedor apagado com sucesso.</span>
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
            <i class='fa fa-exclamation-triangle text-danger' aria-hidden='true'></i>&nbsp;&nbsp;
            Vendedor não foi apagado!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_vendedores";
            header("Location: $url_destino");
        }
    } else {
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
        <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Vendedor não encontrado!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
        $url_destino = pg . "/listar/list_vendedores";
        header("Location: $url_destino");
    }
} else {
    $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
    <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
    A página não pode ser carregada!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>";
    $url_destino = pg . "/listar/list_vendedores";
    header("Location: $url_destino");
}

