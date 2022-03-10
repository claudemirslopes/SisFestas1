<?php

if (!isset($seguranca)) {
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    $result_prod = "DELETE FROM produtos WHERE id='$id'";
    $resultado_prod = mysqli_query($conn, $result_prod);

    if (mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = "<div class='alert au-alert-success alert-dismissible fade show au-alert au-alert--70per mb-4' role='alert' style='width:100%;'>
        <i class='zmdi zmdi-check-circle'></i>
        <span class='content'>Produto apagado com sucesso.</span>
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
        <i class='fa fa-exclamation-triangle text-danger' aria-hidden='true'></i>&nbsp;&nbsp;
        Produto não pode ser apagado!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
        $url_destino = pg . "/listar/list_prod";
        header("Location: $url_destino");
    }
} else {
    $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
    <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
    Produto não encontrado!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>";
    $url_destino = pg . "/listar/list_prod";
    header("Location: $url_destino");
}

