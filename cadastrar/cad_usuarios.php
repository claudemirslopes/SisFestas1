<?php
if (!isset($seguranca)) {
    exit;
}
$hoje = date('mY');
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
                <li class="breadcrumb-item active">Cadastrar usuário</li>
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
                            <a href = "<?php echo pg . '/listar/list_usuarios' ?>"><button type = "button" class = "btn btn-sm btn-outline-dark"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp; Listar usuários</button></a>
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
                        <?php
                        if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?>
                        <div class="row">
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
                                                <input type="hidden" name="senha" class="form-control form-control-sm forp" value="cr2@<?php echo $hoje; ?>">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Foto</label>
                                                <input type="file" class="form-control form-control-file form-control-sm forp" id="exampleFormControlFile1" name="foto">
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
                                    <hr>
                                    <div class="card-text text-sm-center">
                                        <input type="submit" class="btn btn-outline-primary" name="SendCadUsuario" value="Cadastrar Usuário">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
<?php
unset($_SESSION['dados']);

    