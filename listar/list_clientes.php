<?php
if (!isset($seguranca)) {
    exit;
}
?>
<style>
    .text-primary {
        color: #045FB4 !important;
    }
    .text-primary:hover {
        color: #2E9AFE !important;
    }
    .text-danger {
        color: #B40404 !important;
    }
    .text-danger:hover {
        color: #FE2E2E !important;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Clientes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Listar clientes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Conteúdo principal da página -->
<section class="content">
    <div class="container-fluid">
    <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-9 connectedSortable">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-clientes-tab" data-toggle="pill" href="#custom-tabs-four-clientes" role="tab" aria-controls="custom-tabs-four-clientes" aria-selected="true">Clientes cadastrados no sistema</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row" style="display: inline !important;">
                            <?php
                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }

                            /* Verificar o botão */
                            $botao_editar = carregar_botao('editar/edit_clientes', $conn);
                            $botao_apagar = carregar_botao('processa/proc_apagar_clientes', $conn);

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
                                    FROM clientes user
                                    INNER JOIN niveis_acessos niv on niv.id=user.niveis_acesso_id 
                                    ORDER BY id DESC
                                    LIMIT $inicio, $qnt_result_pg";
                            } else {
                                $result_usuario = "SELECT user.id, user.nome, user.email, user.niveis_acesso_id, user.situacoes_usuario_id,
                                niv.nome_nivel_acesso
                                    FROM clientes user
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
                                                    window.location.href = '../processa/proc_apagar_clientes?id=' + id;   
                                                });
                                                }
                                        </script>
                                        <tr>
                                            <td><?php echo $row_usuario['id']; ?></td>
                                            <td><?php echo $row_usuario['nome']; ?></td>
                                            <td class="hidden-sm"><?php echo $row_usuario['email']; ?></td>
                                            <td class="hidden-sm"><?php echo $row_usuario['nome_nivel_acesso']; ?></td>
                                            <td class="text-center"><?php echo $row_usuario['situacoes_usuario_id'] == 1 ? '<i class="fa fa-check text-success font-weight-bold" aria-hidden="true" title="Ativo"></i>' : '<i class="fa fa-times text-dark font-weight-bold" aria-hidden="true" title="Inativo"></i>'; ?>
                                            </td>
                                            <td class="text-right">
                                                <?php
                                                if ($botao_editar) { ?>
                                                    <a href="javascript:;" onclick="editarUser('<?php echo $row_usuario['id']; ?>')"><i class="fa fa-pencil-square-o text-primary font-weight-bold" aria-hidden="true" title="Editar"></i></a> 
                                                <?php }  ?>  
                                                <?php if ($botao_apagar) { ?>
                                                    <a href="javascript:;" onclick="confirmExcluir(<?php echo $row_usuario['id']?>)"><i class='fa fa-trash text-danger font-weight-bold' aria-hidden='true' title='Excluir'></i></a>   
                                                <?php } ?>                            
                                            </td>
                                        </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </section>
            <section class="col-lg-3 connectedSortable">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0 font-weight-bold">Informações</h5>
                        <div class="float-right">
                            <a href="#" type="button" class="btn btn-outline-danger btn-sm" title="Página anterior" onclick="voltar()">
                                <i class="fa fa-angle-left" aria-hidden="true"></i></a>
                                <script>
                                function voltar() {
                                window.history.back();
                                }
                                </script>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row" style="display: inline !important;line-height: 9px;">
                            <p class="card-text" style="font-size: .9em;"><span class="font-weight-bold">11 </span>Clientes cadastrados<br></p>
                            <p class="card-text" style="font-size: .9em;"><span class="font-weight-bold">10 </span>clientes ativos</p>
                        </div>
                    </div>
                    <div class="card-body" style="padding-bottom: 2.8rem;border-top: 1px solid #ccc;">
                        <div class="color-palette-set font-weight-bold" style="font-size: .9em;">
                            <div class="bg-warning color-palette "><span class="ml-2"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ATENÇÃO</span></div>
                            <div class="bg-warning disabled color-palette"><span class="ml-2">Há <b>2</b> clientes desabilitados no sistema</span></div>
                        </div>
                    </div>
                    <div class="card-body" style="padding-bottom: 1.8rem;border-top: 1px solid #ccc;">
                        <div class="info-box bg-danger">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                            <div class="info-box-content">
                            <span class="info-box-text">IMPORTANTE</span>
                            <span class="info-box-number">3% dos clientes</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 3%"></div>
                            </div>
                            <span class="progress-description">
                                pagtos atrasados
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="card-body" style="padding-bottom: 1.8rem;border-top: 1px solid #ccc;">
                        <!-- Carregar o botão de cadatrar -->
                        <a href="#"><button type="button" class="btn btn-outline-primary btn-block btn-flat" data-toggle="modal" data-target="#modalCadCli"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp; Novo cliente</button></a>
                    </div>
                </div>
            </section>
            <!-- /.Left col -->
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </div>
</section>

<!-- /.início do modal cadastrar -->
<div class="modal fade" id="modalCadUser">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Cadastrar Usuário</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <form action="<?php echo pg; ?>/processa/proc_cad_clientes" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <fieldset class="border p-3 fset" style="margin-top: 10px;">
                            <legend class="font-small">&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;&nbsp;Dados Cadastrais</legend>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="inputEmail4">Nome</label>
                                <input type="text" name="nome" class="form-control form-control-sm forp" placeholder="Nome completo" value="<?php if (isset($_SESSION['dados']['nome'])) {
                                    echo $_SESSION['dados']['nome'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">E-mail</label>
                                <input type="email" name="email" class="form-control form-control-sm forp" placeholder="E-mail" value="<?php if (isset($_SESSION['dados']['email'])) {
                                    echo $_SESSION['dados']['email'];
                                } ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Usuário</label>
                                <input type="text" name="usuario" class="form-control form-control-sm forp" placeholder="Usuário para logar no sistema" value="<?php if (isset($_SESSION['dados']['nome'])) {
                                    echo $_SESSION['dados']['usuario'];
                                } ?>">
                            </div>
                                <!-- A senha padrão ao cadastrar um usuário é cr2@+mês+ano atual -->
                                <input type="hidden" name="senha" class="form-control form-control-sm forp" value="sf@<?php echo $hoje; ?>">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Foto</label>
                                <input type="file" class="form-control form-control-file form-control-sm forp" id="exampleFormControlFile1" name="foto">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Observação</label>
                                <textarea name="obs" class="form-control form-control-sm forp"><?php if (isset($_SESSION['dados']['obs'])) {
                                    echo $_SESSION['dados']['obs'];
                                } ?></textarea>
                            </div>
                        </div>

                        <?php
                        if($_SESSION['niveis_acesso_id'] == 1){
                        $result_niv_acesso = "SELECT * FROM niveis_acessos"; 
                        }else{
                            $result_niv_acesso = "SELECT * FROM niveis_acessos WHERE ordem > '".$_SESSION['ordem']."'";
                        }
                        $resultado_niv_acesso = mysqli_query($conn, $result_niv_acesso);
                        ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nível de Acesso</label>
                                <select class="form-control form-control-sm forp" name="niveis_acesso_id">
                                    <option value="">Selecione</option>
                                    <?php
                                    while($row_niv_acesso = mysqli_fetch_array($resultado_niv_acesso)){
                                        if (isset($_SESSION['dados']['niveis_acesso_id']) AND ($_SESSION['dados']['niveis_acesso_id'] == $row_niv_acesso['id'])){
                                            echo "<option value='".$row_niv_acesso['id']."' selected>".$row_niv_acesso['nome_nivel_acesso']."</option>";
                                        }else{
                                            echo "<option value='".$row_niv_acesso['id']."'>".$row_niv_acesso['nome_nivel_acesso']."</option>";
                                        }
                                        
                                    }
                                    ?>
                                </select>
                            </div>

                            <?php
                            $result_sit_usuario = "SELECT * FROM situacoes_clientes";
                            $resultado_sit_usuario = mysqli_query($conn, $result_sit_usuario);
                            ?>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Situação</label>
                                <select class="form-control form-control-sm forp" name="situacoes_usuario_id">
                                    <option value="">Selecione</option>
                                    <?php
                                    while($row_sit_usuario = mysqli_fetch_array($resultado_sit_usuario)){
                                        if (isset($_SESSION['dados']['situacoes_usuario_id']) AND ($_SESSION['dados']['niveis_acesso_id'] == $row_sit_usuario['id'])){
                                            echo "<option value='".$row_sit_usuario['id']."' selected>".$row_sit_usuario['nome_situacao']."</option>";
                                        }else{
                                            echo "<option value='".$row_sit_usuario['id']."'>".$row_sit_usuario['nome_situacao']."</option>";
                                        }
                                        
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-outline-primary" name="SendCadUsuario" value="Cadastrar Usuário">
        </form>
        </div>
        </div>
    </div>
</div>   
<!-- /.fim do modal cadastrar -->
<!-- /.início do modal editar -->
<div id="ModalUser" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Usuário</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body"></div>
    </div>
    </div>
</div>
<!-- /.fim do modal editar -->
<!-- /.início do modal editar foto -->
<div id="ModalFoto2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar foto</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<!-- /.fim do modal editar -->
<!-- /.início do modal editar senha -->
<div id="ModalSenha2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar senha</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<!-- /.fim do modal editar -->

    