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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Cadastrar página</li>
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
                            <?php
                            $botao_cad = carregar_botao('cadastrar/cad_pagina', $conn);
                            if ($botao_cad) {
                            ?>
                                <a href="<?php echo pg . '/cadastrar/cad_pagina' ?>"><button type="button" class="btn btn-sm btn-outline-dark"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Cadastrar</button></a>
                            <?php } ?>
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
                        <div class="row mt-2">
                        
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>


    