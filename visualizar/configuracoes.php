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
                <h1 class="m-0">Configurações</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Ferramentas</a></li>
                <li class="breadcrumb-item active">Configurações</li>
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
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <strong class="card-title">Configurações do Sistema:</strong>
                        <div class="float-right">
                            <!-- Carregar o botão de cadatrar -->
                            <?php
                            $botao_cad = carregar_botao('cadastrar/cad_pagina', $conn);
                            if ($botao_cad) {
                            ?>
                                <!-- <a href="<?php echo pg . '/cadastrar/cad_pagina' ?>"><button type="button" class="btn btn-sm btn-outline-dark"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Cadastrar</button></a> -->
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
                        <div class="row mt-4">
                            <!-- BOX 1 de configurações do sistema -->
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fa fa-sitemap"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Páginas</span>
                                        <span class="info-box-number"><a href="<?php echo pg; ?>/listar/list_pagina">Acessar</a></span>
                                    </div>
                                </div>
                            </div>
                            <!-- BOX 2 de configurações do sistema -->
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger"><i class="fa fa-lock"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Nível de Acesso</span>
                                        <span class="info-box-number"><a href="<?php echo pg; ?>/listar/list_niv_acessos">Acessar</a></span>
                                    </div>
                                </div>
                            </div>
                            <!-- BOX 3 de configurações do sistema -->
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-secondary"><i class="fa fa-picture-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">LOGOs</span>
                                        <span class="info-box-number"><a href="<?php echo pg; ?>/visualizar/ver_logos">Acessar</a></span>
                                    </div>
                                </div>
                            </div>
                            <!-- BOX 4 de configurações do sistema -->
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning"><i class="fa fa-credit-card"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Taxas</span>
                                        <span class="info-box-number"><a href="<?php echo pg; ?>/listar/list_taxas">Acessar</a></span>
                                    </div>
                                </div>
                            </div>
                            <!-- BOX 4 de configurações do sistema -->
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-dark"><i class="fa fa-magic"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tutorial</span>
                                        <span class="info-box-number"><a href="<?php echo pg; ?>/listar/list_tutorial">Acessar</a></span>
                                    </div>
                                </div>
                            </div>
                            <!-- BOX 6 de configurações do sistema -->
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-primary"><i class="fa fa-check-square-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Logs de Acessos</span>
                                        <span class="info-box-number"><a href="<?php echo pg; ?>/visualizar/ver_status">Acessar</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>