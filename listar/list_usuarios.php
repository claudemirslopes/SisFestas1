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
                <h1 class="m-0">Colaboradores</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Listar usuários</li>
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
                        <strong class="card-title mb-3">Usuários:</strong>
                        <div class="float-right">
                            <!-- Carregar o botão de cadatrar -->
                            <a href="<?php echo pg . '/cadastrar/cad_usuarios' ?>"><button type="button" class="btn btn-outline-dark btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp; Cadastrar</button></a>
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
                            $botao_editar = carregar_botao('editar/edit_usuarios', $conn);
                            $botao_apagar = carregar_botao('processa/proc_apagar_usuarios', $conn);

                            /* Selecionar no banco de dados os usuário */
                            $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                            $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                            //Setar a quantidade de itens por pagina
                            $qnt_result_pg = 50;

                            //calcular o inicio visualização
                            $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

                            if ($_SESSION['niveis_acesso_id'] == 1) {
                                $result_usuario = "SELECT user.id, user.nome, user.email, user.niveis_acesso_id, user.situacoes_usuario_id,
                                niv.nome_nivel_acesso
                                    FROM usuarios user
                                    INNER JOIN niveis_acessos niv on niv.id=user.niveis_acesso_id 
                                    WHERE user.niveis_acesso_id != 8 AND user.niveis_acesso_id != 9 AND user.niveis_acesso_id != 10
                                    ORDER BY id DESC
                                    LIMIT $inicio, $qnt_result_pg";
                            } else {
                                $result_usuario = "SELECT user.id, user.nome, user.email, user.niveis_acesso_id, user.situacoes_usuario_id,
                                niv.nome_nivel_acesso
                                    FROM usuarios user
                                    INNER JOIN niveis_acessos niv on niv.id=user.niveis_acesso_id
                                    WHERE ordem > '".$_SESSION['ordem']."'
                                    ORDER BY id DESC
                                    LIMIT $inicio, $qnt_result_pg";
                            }

                            $resultado_usuario = mysqli_query($conn, $result_usuario);
                            ?>                            
                            <table id="example1" class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th class="hidden-sm">E-mail</th>
                                        <th class="hidden-sm">Nivel de Acesso</th>
                                        <th class="text-center">Situação</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row_usuario = mysqli_fetch_array($resultado_usuario)) {
                                        //echo $row_usuario['nome'] . "<br>";
                                    ?>
                                        <script>
                                            function confirmExcluir(id)
                                                {
                                                swal({
                                                    title: "Excluir",
                                                    text: "Confirma a exclusão do usuário?",
                                                    type: "error",
                                                    showCancelButton: true,
                                                    confirmButtonClass: 'btn-success',
                                                    confirmButtonText: 'Sim',
                                                    cancelButtonText: 'Não',
                                                    closeOnConfirm: false
                                                }, function () {
                                                    window.location.href = '../processa/proc_apagar_usuarios?id=' + id;   
                                                });
                                                }
                                        </script>
                                        <tr>
                                            <td><?php echo $row_usuario['id']; ?></td>
                                            <td><?php echo $row_usuario['nome']; ?></td>
                                            <td class="hidden-sm"><?php echo $row_usuario['email']; ?></td>
                                            <td class="hidden-sm"><?php echo $row_usuario['nome_nivel_acesso']; ?></td>
                                            <td class="text-center"><?php echo $row_usuario['situacoes_usuario_id'] == 1 ? '<span class="badge badge-success btn-sm"><i class="fa fa-check" aria-hidden="true" title="Ativo"></i></span>' : '<span class="badge badge-danger btn-sm"><i class="fa fa-times" aria-hidden="true" title="Inativo"></i></span>'; ?>
                                            </td>
                                            <td class="text-right">
                                                <?php
                                                if ($botao_editar) {
                                                    echo "<a href='" . pg . "/editar/edit_usuarios?id=" . $row_usuario['id'] . "'><button type='button' class='btn btn-sm btn-warning'><i class='fa fa-pencil-square-o' aria-hidden='true' title='Editar'></i></button></a> ";
                                                } ?>
                                                <?php if ($botao_apagar) { ?>
                                                    <a href="javascript:;" onclick="confirmExcluir(<?php echo $row_usuario['id']?>)"><button type='button' class='btn btn-sm btn-danger'><i class='fa fa-trash' aria-hidden='true' title='Excluir'></i></button></a>   
                                                <?php } ?>                            
                                            </td>
                                        </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>

    