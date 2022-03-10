<?php
if (!isset($seguranca)) {
    exit;
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
//verificar a existencia do id na URL
if (!empty($id)) {
    if($_SESSION['niveis_acesso_id'] == 1){
        $result_usuario = "SELECT * FROM usuarios WHERE id='$id'";
    }else{
        $result_usuario = "SELECT user.*,
        niv.nome_nivel_acesso
            FROM usuarios user
            INNER JOIN niveis_acessos niv on niv.id=user.niveis_acesso_id 
            WHERE niv.ordem > '".$_SESSION['ordem']."' AND user.id='$id'
            LIMIT 1";
    }
    
    $resultado_usuario = mysqli_query($conn, $result_usuario);

    //Verificar se encontrou o usuário no banco de dados
    if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
        $row_usuario = mysqli_fetch_assoc($resultado_usuario);
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
                <li class="breadcrumb-item active">Editar usuário</li>
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
                                <form action="<?php echo pg; ?>/processa/proc_edit_usuarios" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                    <fieldset class="border p-3 fset" style="margin-top: 10px;">
                                        <legend class="font-small">&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;&nbsp;Dados Cadastrais</legend>
                                        <input type="hidden" name="id" value="<?php echo $row_usuario['id']; ?>">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="card mt-3" style="border: none;border: 1px solid #ccc;padding: 4px;border-radius: 15px;">
                                                    <?php if(!empty($row_usuario['foto'])) { ?>
                                                        <img class="product-image-thumb" src="<?php echo pg; ?>/assets/images/usuario/<?php echo $row_usuario['id']; ?>/<?php echo $row_usuario['foto']; ?>" alt="Foto" style="margin:auto;">
                                                    <?php } else { ?>
                                                        <img class="product-image-thumb" src="<?php echo pg; ?>/assets/images/usuario/no.jpg" alt="Foto">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-row">
                                                    <div class="form-group col-md-5">
                                                        <label for="inputEmail4">Nome</label>
                                                        <input type="text" name="nome" class="form-control form-control-sm forp" placeholder="Nome completo" value="<?php
                                                                if (isset($_SESSION['dados']['nome'])) {
                                                                    echo $_SESSION['dados']['nome'];
                                                                } elseif (isset($row_usuario['nome'])) {
                                                                    echo $row_usuario['nome'];
                                                                }
                                                                ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputPassword4">E-mail</label>
                                                        <input type="email" name="email" class="form-control form-control-sm forp forp" placeholder="E-mail" value="<?php
                                                                if (isset($_SESSION['dados']['email'])) {
                                                                    echo $_SESSION['dados']['email'];
                                                                } elseif (isset($row_usuario['email'])) {
                                                                    echo $row_usuario['email'];
                                                                }
                                                                ?>">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="inputEmail4">Usuário</label>
                                                        <input type="text" name="usuario" class="form-control form-control-sm forp forp" placeholder="Usuário para logar no sistema" value="<?php
                                                                if (isset($_SESSION['dados']['usuario'])) {
                                                                    echo $_SESSION['dados']['usuario'];
                                                                } elseif (isset($row_usuario['usuario'])) {
                                                                    echo $row_usuario['usuario'];
                                                                }
                                                                ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                            <!-- A senha padrão ao editar um usuário é cr2_+usuario atual -->
                                                            <input type="hidden" name="senha" class="form-control form-control-sm forp forp" value="cr2_<?php
                                                                    if (isset($_SESSION['dados']['usuario'])) {
                                                                        echo $_SESSION['dados']['usuario'];
                                                                    } elseif (isset($row_usuario['usuario'])) {
                                                                        echo $row_usuario['usuario'];
                                                                    }
                                                                    ?>">
                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail4">Foto</label>
                                                        <input type="hidden" name="foto_antiga" value="<?php echo $row_usuario['foto']; ?>">
                                                        <input type="file" class="form-control form-control-sm forp forp" id="exampleFormControlFile1" name="foto">
                                                    </div>
                                                <?php
                                                if ($_SESSION['niveis_acesso_id'] == 1) {
                                                    $result_niv_acesso = "SELECT * FROM niveis_acessos";
                                                } else {
                                                    $result_niv_acesso = "SELECT * FROM niveis_acessos WHERE ordem > '".$_SESSION['ordem']."'";
                                                }

                                                $resultado_niv_acesso = mysqli_query($conn, $result_niv_acesso);
                                                ?>
                                                    
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Nível de Acesso</label>
                                                    <select class="form-control form-control-sm forp forp" name="niveis_acesso_id">
                                                        <option value="">Selecione</option>
                                                        <?php
                                                        while ($row_niv_acesso = mysqli_fetch_array($resultado_niv_acesso)) {
                                                            if (isset($_SESSION['dados']['niveis_acesso_id']) AND ( $_SESSION['dados']['niveis_acesso_id'] == $row_niv_acesso['id'])) {
                                                                echo "<option value='" . $row_niv_acesso['id'] . "' selected>" . $row_niv_acesso['nome_nivel_acesso'] . "</option>";
                                                            } 
                                                            //Preencher com informações do banco de dados caso não tenha nenhum valor salvo na sessão $_SESSION['dados']
                                                            elseif (!isset($_SESSION['dados']['niveis_acesso_id']) AND isset ($row_usuario['niveis_acesso_id']) AND ( $row_usuario['niveis_acesso_id'] == $row_niv_acesso['id'])) {
                                                                echo "<option value='" . $row_niv_acesso['id'] . "' selected>" . $row_niv_acesso['nome_nivel_acesso'] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $row_niv_acesso['id'] . "'>" . $row_niv_acesso['nome_nivel_acesso'] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <?php
                                                $result_sit_usuario = "SELECT * FROM situacoes_usuarios";
                                                $resultado_sit_usuario = mysqli_query($conn, $result_sit_usuario);
                                                ?>
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Situação</label>
                                                    <select class="form-control form-control-sm forp forp" name="situacoes_usuario_id">
                                                        <option value="">Selecione</option>
                                                        <?php
                                                        while ($row_sit_usuario = mysqli_fetch_array($resultado_sit_usuario)) {
                                                            //Preencher com as informações que estão salva nasessão
                                                            if (isset($_SESSION['dados']['situacoes_usuario_id']) AND ( $_SESSION['dados']['niveis_acesso_id'] == $row_sit_usuario['id'])) {
                                                                echo "<option value='" . $row_sit_usuario['id'] . "' selected>" . $row_sit_usuario['nome_situacao'] . "</option>";
                                                            }
                                                            
                                                            //Preencher com informações do banco de dados caso não tenha nenhum valor salvo na sessão $_SESSION['dados']
                                                            elseif (!isset($_SESSION['dados']['situacoes_usuario_id']) AND isset ($row_usuario['situacoes_usuario_id']) AND ( $row_usuario['situacoes_usuario_id'] == $row_sit_usuario['id'])) {
                                                                echo "<option value='" . $row_sit_usuario['id'] . "' selected>" . $row_sit_usuario['nome_situacao'] . "</option>";
                                                            }
                                                            
                                                            else {
                                                                echo "<option value='" . $row_sit_usuario['id'] . "'>" . $row_sit_usuario['nome_situacao'] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    </fieldset>
                                    <hr>
                                    <div class="card-text text-sm-center">
                                        <input type="submit" class="btn btn-outline-primary" name="SendEditUsuario" value="Editar Usuário">
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
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Nenhum usuário encontrado</div>";
    $url_destino = pg . "/listar/list_usuarios";
    header("Location: $url_destino");
}
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Nenhum usuário encontrado</div>";
    $url_destino = pg . "/listar/list_usuarios";
    header("Location: $url_destino");
}
    