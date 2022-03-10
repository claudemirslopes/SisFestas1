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
                        <strong class="card-title mb-3">Cadastrar página:</strong>
                        <div class="float-right">
                            <!-- Carregar o botão de cadatrar -->
                            <a href = "<?php echo pg . '/listar/list_pagina' ?>"><button type = "button" class = "btn btn-sm btn-outline-dark"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;&nbsp; Listar páginas</button></a>
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
                        <div class="mx-auto d-block">
                        <?php
                        if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?php echo pg; ?>/processa/proc_cad_pagina" id="post" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                        <fieldset class="border p-3 fset" style="margin-top: 10px;">
                                            <legend class="font-small">&nbsp;&nbsp;<i class="fa fa-file-text"></i>&nbsp;&nbsp;Página</legend>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Endereço (URL)</label>
                                                    <input type="text" name="endereco" class="form-control form-control-sm forp" placeholder="URL da Página" value="<?php if (isset($_SESSION['dados']['endereco'])) {
                                                        echo $_SESSION['dados']['endereco'];
                                                    } ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Nome da página</label>
                                                    <input type="text" name="nome_pagina" class="form-control form-control-sm forp" placeholder="Nome da página" value="<?php if (isset($_SESSION['dados']['nome_pagina'])) {
                                                        echo $_SESSION['dados']['nome_pagina'];
                                                    } ?>">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Observação</label>
                                                    <textarea name="obs" class="form-control form-control-sm forp" placeholder="Observação"><?php if (isset($_SESSION['dados']['obs'])) {
                                                        echo $_SESSION['dados']['obs'];
                                                    } ?></textarea>
                                                </div>
                                            </div>
                                        </fieldset>
                                        
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <input type="submit" class="btn btn-outline-primary" name="SendCadPagina" value="Cadastrar página">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>


    