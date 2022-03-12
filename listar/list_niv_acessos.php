<?php
if (!isset($seguranca)) {
    exit;
}
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
                <li class="breadcrumb-item active">Listar níveis de acessos</li>
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
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <strong class="card-title">Níveis de acessos:</strong>
                        <div class="float-right">
                            <!-- Carregar o botão de cadatrar -->
                            <a href="#"><button type="button" data-toggle="modal" data-target="#modalCadNiv" class="btn btn-sm btn-outline-dark"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Cadastrar</button></a>
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
                            /* Verificar o botão */
                            $botao_permissao = carregar_botao('listar/list_permissao', $conn);
                            $botao_editar = carregar_botao('editar/edit_niv_acessos', $conn);
                            $botao_apagar = carregar_botao('processa/proc_apagar_niv_acessos', $conn);

                            /* Selecionar no banco de dados os usuário */
                            $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                            $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                            //Setar a quantidade de itens por pagina
                            $qnt_result_pg = 1220;

                            //calcular o inicio visualização
                            $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

                            if ($_SESSION['niveis_acesso_id'] == 1) {
                                $result_niv_acesso = "SELECT * FROM niveis_acessos ORDER BY ordem ASC
                                    LIMIT $inicio, $qnt_result_pg";
                            } else {
                                $result_niv_acesso = "SELECT *
                                    FROM niveis_acessos
                                    WHERE ordem > '" . $_SESSION['ordem'] . "'
                                    ORDER BY ordem ASC
                                    LIMIT $inicio, $qnt_result_pg";
                            }

                            $resultado_niv_acesso = mysqli_query($conn, $result_niv_acesso);
                            ?>
                            <table id="#" class="table table-sm table-striped" style="border-top: none !important;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Ordem</th>
                                    <th class="text-right">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $qnt_linhas_exe = 1;
                                    while ($row_niv_acesso = mysqli_fetch_array($resultado_niv_acesso)) {
                                        //echo $row_usuario['nome'] . "<br>";
                                        ?>
                                        <script>
                                            function confirmExcluir(id)
                                                {
                                                swal({
                                                    title: "Excluir",
                                                    text: "Confirma a exclusão do nível de acesso?",
                                                    type: "error",
                                                    showCancelButton: true,
                                                    confirmButtonClass: 'btn-success',
                                                    confirmButtonText: 'Sim',
                                                    cancelButtonText: 'Não',
                                                    closeOnConfirm: false
                                                }, function () {
                                                    window.location.href = '../processa/proc_apagar_niv_acessos?id=' + id;   
                                                });
                                                }
                                        </script>
                                        <tr>
                                            <td><?php echo $row_niv_acesso['id']; ?></td>
                                            <td><?php echo $row_niv_acesso['nome_nivel_acesso']; ?></td>
                                            <td><?php echo $row_niv_acesso['ordem']; ?></td>
                                            <td class="text-right">
                                                <?php
                                                if ($qnt_linhas_exe == 1) {
                                                    echo "<button type='button' class='btn btn-sm btn-info'>";
                                                    echo "<i class='fa fa-arrow-up' aria-hidden='true'></i>";
                                                    echo "</button> ";
                                                } else {
                                                    echo "<a href='" . pg . "/processa/proc_ordem_niv_acessos?ordem=" . $row_niv_acesso['ordem'] . "'><button type='button' class='btn btn-sm btn-info'>";
                                                    echo "<i class='fa fa-arrow-up' aria-hidden='true' title='Ordenar'></i>";
                                                    echo "</button></a> ";
                                                }
                                                $qnt_linhas_exe++;

                                                if ($botao_permissao) {
                                                    echo "<a href='" . pg . "/listar/list_permissao?id=" . $row_niv_acesso['id'] . "'><button type='button' class='btn btn-sm btn-dark'><i class='fa fa-lock' aria-hidden='true' title='Permissão'></i></button></a> ";
                                                } ?>
                                                <?php
                                                if ($botao_editar) { ?>
                                                    <a href="javascript:;" onclick="editarNivel('<?php echo $row_niv_acesso['id']; ?>')"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar"></i></button></a> 
                                                <?php }  ?> 
                                                <?php if ($botao_apagar) { ?>
                                                    <a href="javascript:;" onclick="confirmExcluir(<?php echo $row_niv_acesso['id']?>)"><button type='button' class='btn btn-sm btn-danger'><i class='fa fa-trash' aria-hidden='true' title='Excluir'></i></button></a>   
                                                <?php } ?>                                 
                                            </td>
                                        </tr>
                                        <?php
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

<!-- /.início do modal cadastrar -->
<div class="modal fade" id="modalCadNiv">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Cadastrar Nível</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <form action="<?php echo pg; ?>/processa/proc_cad_niv_acessos" id="post" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <fieldset class="border p-3 fset" style="margin-top: 10px;">
                        <legend class="font-small">&nbsp;&nbsp;<i class="fa fa-unlock"></i>&nbsp;&nbsp;Nível de Acesso</legend>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Nome</label>
                                <input type="text" name="nome_nivel_acesso" class="form-control form-control-sm forp forp form-control form-control-sm forp forp-sm" placeholder="Nome do nível de acesso" value="<?php if (isset($_SESSION['dados']['nome_nivel_acesso'])) {
                                    echo $_SESSION['dados']['nome_nivel_acesso'];
                                } ?>">
                            </div>
                        </div>
                    </fieldset>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-outline-danger float-right" name="SendCadNivAcesso" value="Cadastrar nível de acesso">
            </form>
        </div>
        </div>
    </div>
</div>   
<!-- /.fim do modal cadastrar -->

<!-- /.início do modal editar -->
<div id="ModalNivel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Nível de Acesso</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body"></div>
    </div>
    </div>
</div><!-- /.fim do modal editar -->
    