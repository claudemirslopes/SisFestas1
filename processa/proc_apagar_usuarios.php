<?php

if (!isset($seguranca)) {
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    if ($_SESSION['niveis_acesso_id'] == 1) {
        $result_usuario = "SELECT id, foto FROM usuarios WHERE id='$id'";
    } else {
        $result_usuario = "SELECT user.id, user.foto,
        niv.nome_nivel_acesso
            FROM usuarios user
            INNER JOIN niveis_acessos niv on niv.id=user.niveis_acesso_id 
            WHERE niv.ordem > '".$_SESSION['ordem']."' AND user.id='$id'
            LIMIT 1";
    }
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    //Verificar se encontrou algum usuarios
    if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
        $row_usuario = mysqli_fetch_assoc($resultado_usuario);
        //Apagar o usuário
        $result_usuario_del = "DELETE FROM usuarios WHERE id = '$id'";
        $resultado_usuario_del = mysqli_query($conn, $result_usuario_del);
        if (mysqli_affected_rows($conn)) {
            //Apagar a foto
            $destino_apagar = "assets/images/usuario/".$id."/".$row_usuario['foto'];
            apagarFoto($destino_apagar);
            
            $_SESSION['msg'] = "<div class='alert alert-success'>
            <i class='fa fa-check-circle text-secondary' aria-hidden='true'></i>&nbsp;&nbsp;
            Usuário apagado com sucesso!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_usuarios";
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>
            <i class='fa fa-exclamation-triangle text-secondary' aria-hidden='true'></i>&nbsp;&nbsp;
            Usuário não foi apagado!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_usuarios";
            header("Location: $url_destino");
        }
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>
        <i class='fa fa-exclamation-triangle text-secondary' aria-hidden='true'></i>&nbsp;&nbsp;
        Usuário não foi encontrado!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
        $url_destino = pg . "/listar/list_usuarios";
        header("Location: $url_destino");
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>
    <i class='fa fa-exclamation-triangle text-secondary' aria-hidden='true'></i>&nbsp;&nbsp;
    Usuário não foi encontrado!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>";
    $url_destino = pg . "/listar/list_usuarios";
    header("Location: $url_destino");
}

