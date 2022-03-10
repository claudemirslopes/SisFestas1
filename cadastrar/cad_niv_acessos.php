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
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title mb-3">Páginas do Sistema:</strong>
                        <div class="float-right">
                            <!-- Carregar o botão de cadatrar -->
                            <a href = "<?php echo pg . '/listar/list_niv_acessos' ?>"><button type = "button" class = "btn btn-sm btn-outline-dark"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;&nbsp; Listar nível de acesso</button></a>
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
                                    <hr>
                                    <div class="card-text text-sm-center">
                                        <input type="submit" class="btn btn-outline-primary" name="SendCadNivAcesso" value="Cadastrar nível de acesso">
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

    