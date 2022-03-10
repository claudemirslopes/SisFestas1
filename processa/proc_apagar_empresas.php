<?php

if (!isset($seguranca)) {
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    if($_SESSION['niveis_acesso_id'] == 1){
        $result_empresa = "SELECT * FROM empresas WHERE id='$id'";
    }else{
        $result_empresa = "SELECT * FROM empresas WHERE id='$id'
            LIMIT 1";
    }
    $resultado_empresa = mysqli_query($conn, $result_empresa);
    //Verificar se encontrou alguma empresa
    if (($resultado_empresa) AND ( $resultado_empresa->num_rows != 0)) {
        $row_empresa = mysqli_fetch_assoc($resultado_empresa);
        //Apagar a empresa
        $result_empresa_del = "DELETE FROM empresas WHERE id = '$id'";
        $resultado_empresa_del = mysqli_query($conn, $result_empresa_del);
        if (mysqli_affected_rows($conn)) {
            //Apagar a foto
            $destino_apagar = "assets/images/empresa/".$id."/".$row_empresa['foto'];
            apagarFoto($destino_apagar);
            
            $_SESSION['msg'] = "<div class='alert au-alert-success alert-dismissible fade show au-alert au-alert--70per mb-4' role='alert' style='width:100%;'>
            <i class='zmdi zmdi-check-circle'></i>
            <span class='content'>Empresa apagada com sucesso.</span>
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
            <i class='fa fa-exclamation-triangle text-danger' aria-hidden='true'></i>&nbsp;&nbsp;
            Empresa não pode ser apagada!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
            $url_destino = pg . "/listar/list_empresas";
            header("Location: $url_destino");
        }
    } else {
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
        <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Empresa não encontrada!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
        $url_destino = pg . "/listar/list_empresas";
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
    $url_destino = pg . "/listar/list_empresas";
    header("Location: $url_destino");
}

