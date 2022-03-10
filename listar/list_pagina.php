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
                <h1 class="m-0">Páginas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Ferramentas</a></li>
                <li class="breadcrumb-item"><a href="#">Configurações</a></li>
                <li class="breadcrumb-item active">Páginas</li>
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
                    <div class="card-header">
                        <strong class="card-title">Páginas do Sistema:</strong>
                        <div class="float-right">
                            <!-- Carregar o botão de cadatrar -->
                            <?php
                            $botao_cad = carregar_botao('processa/proc_cad_pagina', $conn);
                            if ($botao_cad) {
                            ?>
                            <a href="#"><button type="button" class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target="#modalCadPag"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Cadastrar</button></a>
                            <?php
                            }
                            $botao_sin_pg = carregar_botao('processa/proc_sincronizar_pagina', $conn);
                            if ($botao_sin_pg) {
                                ?>
                                <a href="<?php echo pg . '/processa/proc_sincronizar_pagina' ?>"><button type="button" class="btn btn-sm btn-info"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Sincronizar</button></a>
                                <?php
                            }
                            ?>
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
                            $botao_editar = carregar_botao('processa/proc_edit_pagina', $conn);

                            /* Selecionar no banco de dados os usuário */
                            $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                            $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                            //Setar a quantidade de itens por pagina
                            $qnt_result_pg = 10220;

                            //calcular o inicio visualização
                            $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

                            if ($_SESSION['niveis_acesso_id'] == 1) {
                                $result_paginas = "SELECT * FROM paginas ORDER BY id ASC
                                    LIMIT $inicio, $qnt_result_pg";
                            } else {
                                $result_paginas = "SELECT * FROM paginas ORDER BY id ASC
                                    LIMIT $inicio, $qnt_result_pg";
                            }

                            $resultado_paginas = mysqli_query($conn, $result_paginas);
                            ?>
                            <table id="example3" class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="hidden-sm">Endereço</th>
                                        <th>Nome da Página</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row_paginas = mysqli_fetch_array($resultado_paginas)) {
                                        //echo $row_usuario['nome'] . "<br>";
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $row_paginas['id']; ?></td>
                                            <td class="hidden-sm"><?php echo $row_paginas['endereco']; ?></td>
                                            <td><?php echo $row_paginas['nome_pagina']; ?></td>
                                            <td class="text-right">
                                                <?php
                                                if ($botao_editar) { ?>
                                                    <a href="javascript:;" onclick="editarPagina('<?php echo $row_paginas['id']; ?>')"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar"></i></button></a> 
                                                <?php }  ?>                                
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
<div class="modal fade" id="modalCadPag">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Cadastrar Página</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <form action="<?php echo pg; ?>/processa/proc_cad_pagina" id="post" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <fieldset class="border p-3 fset" style="margin-top: 10px;">
                        <legend class="font-small">&nbsp;&nbsp;<i class="fa fa-file-text"></i>&nbsp;&nbsp;Página</legend>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Endereço (URL)</label>
                                <input type="text" name="endereco" class="form-control form-control-sm forp forp form-control form-control-sm forp forp-sm" placeholder="URL da Página" value="<?php if (isset($_SESSION['dados']['endereco'])) {
                                    echo $_SESSION['dados']['endereco'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nome da página</label>
                                <input type="text" name="nome_pagina" class="form-control form-control-sm forp forp form-control form-control-sm forp forp-sm" placeholder="Nome da página" value="<?php if (isset($_SESSION['dados']['nome_pagina'])) {
                                    echo $_SESSION['dados']['nome_pagina'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Observação</label>
                                <textarea name="obs" class="form-control form-control-sm forp forp form-control form-control-sm forp forp-sm" placeholder="Observação"><?php if (isset($_SESSION['dados']['obs'])) {
                                    echo $_SESSION['dados']['obs'];
                                } ?></textarea>
                            </div>
                        </div>
                    </fieldset>
            </div>
        </div>
        <div class="modal-footer">
                <input type="submit" class="btn btn-outline-danger float-right" name="SendCadPagina" value="Cadastrar página">
            </form>
        </div>
        </div>
    </div>
</div>   
<!-- /.fim do modal cadastrar -->

<!-- /.início do modal editar -->
<div id="ModalPagina" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Página</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body"></div>
    </div>
    </div>
</div>
<!-- /.fim do modal editar -->