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
                <h1 class="m-0">Usuários</h1>
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
                        <strong class="card-title">Usuários cadastrados:</strong>
                        <div class="float-right">
                            <!-- Carregar o botão de cadatrar -->
                            <a href="#"><button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#modalCadUser"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp; Cadastrar</button></a>
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
                            if (isset($_SESSION['msg'])) {
                                echo '<div class="col-md-12" style="margin-top:-25px !important;">';
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                                echo '</div>';
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
                                                if ($botao_editar) { ?>
                                                    <a href="javascript:;" onclick="editarUser('<?php echo $row_usuario['id']; ?>')"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar"></i></button></a> 
                                                <?php }  ?>  
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
                <form action="<?php echo pg; ?>/processa/proc_cad_usuarios" method="POST" class="form-horizontal" enctype="multipart/form-data">
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
                            $result_sit_usuario = "SELECT * FROM situacoes_usuarios";
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

    