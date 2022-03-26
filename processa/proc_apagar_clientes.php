<?php

if (!isset($seguranca)) {
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    if ($_SESSION['niveis_acesso_id'] == 1) {
        $result_usuario = "SELECT id, foto FROM clientes WHERE id='$id'";
    } else {
        $result_usuario = "SELECT id, foto FROM clientes
            WHERE ordem > '".$_SESSION['ordem']."' AND id='$id'
            LIMIT 1";
    }
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    //Verificar se encontrou algum usuarios
    if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
        $row_usuario = mysqli_fetch_assoc($resultado_usuario);
        //Apagar o usuário
        $result_usuario_del = "DELETE FROM clientes WHERE id = '$id'";
        $resultado_usuario_del = mysqli_query($conn, $result_usuario_del);
        if (mysqli_affected_rows($conn)) {
            //Apagar a foto
            $destino_apagar = "assets/images/cliente/".$id."/".$row_usuario['foto'];
            apagarFoto($destino_apagar);
            
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-success alert-dismissible fade show' style='border-left: 4px solid #28A745;'>
            <i class='fa fa-check-circle text-success fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Cliente excluído com sucesso!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_clientes";
            header("Location: $url_destino");
        } else {
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger' aria-hidden='true'></i>&nbsp;&nbsp;
            Cliente não foi apagado!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_clientes";
            header("Location: $url_destino");
        }
    } else {
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
        <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Cliente não encontrado!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
        $url_destino = pg . "/listar/list_clientes";
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
    $url_destino = pg . "/listar/list_clientes";
    header("Location: $url_destino");
}

