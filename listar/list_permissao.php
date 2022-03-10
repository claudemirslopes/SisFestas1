<?php
if (!isset($seguranca)) {
    exit;
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    if ($_SESSION['niveis_acesso_id'] == 1) {
        $result_niv_acesso = "SELECT nivpg.*,
                pg.endereco, pg.obs,
                nivac.nome_nivel_acesso
                FROM niveis_acessos_paginas nivpg
                INNER JOIN paginas pg on pg.id=nivpg.pagina_id
                INNER JOIN niveis_acessos nivac on nivac.id=nivpg.niveis_acesso_id
                WHERE nivpg.niveis_acesso_id='$id'
                ORDER BY nivpg.ordem ASC";
    } else {
        $result_niv_acesso = "SELECT nivpg.*,
                pg.endereco, pg.obs,
                nivac.nome_nivel_acesso
                FROM niveis_acessos_paginas nivpg
                INNER JOIN paginas pg on pg.id=nivpg.pagina_id
                INNER JOIN niveis_acessos nivac on nivac.id=nivpg.niveis_acesso_id
                WHERE nivpg.niveis_acesso_id='$id' AND nivac.ordem > '" . $_SESSION['ordem'] . "'
                ORDER BY nivpg.ordem ASC";
    }

    $resultado_niv_acesso = mysqli_query($conn, $result_niv_acesso);

    //verificar se encontrou alguma página cadastra
    if (($resultado_niv_acesso) AND ( $resultado_niv_acesso->num_rows != 0)) {
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Níveis de Acessos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Permissão</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Conteúdo principal da página -->
<section class="content">
    <div class="container-fluid">
    <!-- Box pequeno (caixa estática) -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <?php
                $result_nivel_acesso = "SELECT nivpg.*,
                    nivac.nome_nivel_acesso
                    FROM niveis_acessos_paginas nivpg
                    INNER JOIN niveis_acessos nivac on nivac.id=nivpg.niveis_acesso_id
                    WHERE nivpg.niveis_acesso_id='$id'
                    LIMIT 1";
                $resultado_nivel_acesso = mysqli_query($conn, $result_nivel_acesso);
                $row_nivel_acesso = mysqli_fetch_assoc($resultado_nivel_acesso);
                ?>
                    <div class="card-header">
                        <strong class="card-title mb-3">Permissão: </strong>&nbsp;&nbsp; <?php echo $row_nivel_acesso['nome_nivel_acesso']; ?>
                        <div class="float-right">
                            <!-- Carregar o botão de cadatrar -->
                            <a href="<?php echo pg . '/listar/list_niv_acessos' ?>"><button type="button" class="btn btn-sm btn-outline-dark"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp; Listar Nível de Acesso</button></a>
                            <a href="#" type="button" class="btn btn-outline-danger btn-sm" title="Página anterior" onclick="voltar()">
                                <i class="fa fa-angle-left" aria-hidden="true"></i></a>
                                <script>
                                function voltar() {
                                window.history.back();
                                }
                                </script>
                        </div>
                    </div>
                    <!-- Carrega os demais conteúdos da página -->
                    <div class="card-body">
                        <div class="row" style="display: inline !important;">
                            <?php
                            // Mensagens de erro e sucesso
                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                            ?>
                            <table id="example3" class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Página</th>
                                        <th class="text-center">Ordem</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $qnt_linhas_exe = 1;
                                    while ($row_niv_acesso = mysqli_fetch_array($resultado_niv_acesso)) {
                                        $result_pg = "SELECT COUNT(id) AS num_result FROM niveis_acessos_paginas 
                                            WHERE pagina_id='" . $row_niv_acesso['pagina_id'] . "' AND niveis_acesso_id='" . $_SESSION['niveis_acesso_id'] . "' AND permissao='1' LIMIT 1";
                                        $resultado_pg = mysqli_query($conn, $result_pg);
                                        $row_pg = mysqli_fetch_assoc($resultado_pg);
                                        if ($row_pg['num_result'] != 0) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row_niv_acesso['id']; ?></td>
                                                <td>
                                                        <i class="fa fa-question-circle" aria-hidden="true"aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="<?php echo $row_niv_acesso['obs']; ?>"></i>
                                                    <?php echo $row_niv_acesso['endereco']; ?>
                                                </td>
                                                <td class="text-center"><span class="badge badge-warning"><?php echo $row_niv_acesso['ordem']; ?></span></td>
                                                <td class="text-right">
                                                    <?php
                                                    if ($row_niv_acesso['permissao'] == 1) {
                                                        echo "<a href='" . pg . "/processa/proc_liberar_permissao?id=" . $row_niv_acesso['id'] . "'><button type='button' class='btn btn-sm btn-success'><i class='fa fa-check' aria-hidden='true' title='Permitido'></i></button></a>";
                                                    } else {
                                                        echo "<a href='" . pg . "/processa/proc_liberar_permissao?id=" . $row_niv_acesso['id'] . "'><button type='button' class='btn btn-sm btn-danger'><i class='fa fa-ban' aria-hidden='true' title='Bloqueado'></i></button></a>";
                                                    }
                                                    ?>
                                                    <?php
                                                    // if ($row_niv_acesso['menu'] == 1) {
                                                    //     echo "<a href='" . pg . "/processa/proc_liberar_menu?id=" . $row_niv_acesso['id'] . "'><button type='button' class='btn btn-sm btn-success'><i class='fa fa-check' aria-hidden='true' title='Permitido'></i></button></a>";
                                                    // } else {
                                                    //     echo "<a href='" . pg . "/processa/proc_liberar_menu?id=" . $row_niv_acesso['id'] . "'><button type='button' class='btn btn-sm btn-danger'><i class='fa fa-ban' aria-hidden='true' title='Bloqueado'></i></button></a>";
                                                    // }
                                                    ?>
                                                    <?php
                                                    if ($qnt_linhas_exe == 1) {
                                                        echo "<button type='button' class='btn btn-sm btn-info'>";
                                                        echo "<i class='fa fa-arrow-up' aria-hidden='true' title='Ordenar'></i>";
                                                        echo "</button> ";
                                                    } else {
                                                        echo "<a href='" . pg . "/processa/proc_ordem_menu?id=" . $row_niv_acesso['id'] . "'><button type='button' class='btn btn-sm btn-info'>";
                                                        echo "<i class='fa fa-arrow-up' aria-hidden='true' title='Ordenar'></i>";
                                                        echo "</button></a> ";
                                                    }
                                                    $qnt_linhas_exe++;
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>

<?php
    } else {
        $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
        <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
        Permissão não encontrada!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
        $url_destino = pg . "/listar/list_niv_acessos";
        header("Location: $url_destino");
    }
} else {
    $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
    <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
    Permissão não encontrada!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>";
    $url_destino = pg . "/listar/list_niv_acessos";
    header("Location: $url_destino");
}
?>
    