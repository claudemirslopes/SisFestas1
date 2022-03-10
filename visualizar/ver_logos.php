<?php
if (!isset($seguranca)) {
    exit;
}
date_default_timezone_set('America/Sao_Paulo');
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">LOGOs</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Ferramentas</a></li>
                <li class="breadcrumb-item"><a href="#">Configurações</a></li>
                <li class="breadcrumb-item active">Logos</li>
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
                        <strong class="card-title">Logos do Sistema:</strong>
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
                        <?php
                        // Mensagens de erro e sucesso
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        /* Verificar o botão */
                        $botao_editar = carregar_botao('editar/edit_logos', $conn);
                        ?>
                        <div class="row mt-4">

                            <?php
                            if ($_SESSION['niveis_acesso_id'] == 1) {
                                $result_logos = "SELECT * FROM logos
                                    ORDER BY id ASC
                                    LIMIT 1";
                            } 

                            $resultado_logos = mysqli_query($conn, $result_logos);
                            
                            while ($row_logos = mysqli_fetch_array($resultado_logos)) {
                            ?>
                            <!-- BOX 1 de configurações do sistema -->
                            <div class="col-md-4">
                                <div class="attachment-block clearfix bg-dark">
                                    <img src="<?php echo pg; ?>/assets/images/logos/<?php echo $row_logos['id']; ?>/<?php echo $row_logos['foto']; ?>" alt="Logo" style="height:200px">
                                    <a href="javascript(void)" data-toggle="modal" data-target="#logo1Modal-<?php echo $row_logos['id']; ?>" type="button" class="btn btn-block btn-warning mt-2">Alterar Logo 1</a>
                                </div>
                            </div>
                            <!-- Modal do logo 1 -->
                            <div class="modal fade" id="logo1Modal-<?php echo $row_logos['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="logo1ModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="logo1ModalLongTitle">Alterar a Logo 1</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="<?php echo pg; ?>/processa/proc_edit_logos1" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo $row_logos['id']; ?>">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="inputEmail4">Logo 1</label>
                                                <input type="hidden" name="foto_antiga" value="<?php echo $row_logos['foto']; ?>">
                                                <input type="file" class="form-control form-control-sm form-control-file" id="exampleFormControlFile1" name="foto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-outline-primary" name="SendEditLogo" value="Alterar Logo 1">
                                    </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php
                            if ($_SESSION['niveis_acesso_id'] == 1) {
                                $result_logos = "SELECT * FROM logos
                                    ORDER BY id DESC
                                    LIMIT 1";
                            } 

                            $resultado_logos = mysqli_query($conn, $result_logos);
                            
                            while ($row_logos = mysqli_fetch_array($resultado_logos)) {
                            ?>
                            <div class="col-md-8">
                                <div class="attachment-block clearfix bg-dark">
                                    <img src="<?php echo pg; ?>/assets/images/logos/<?php echo $row_logos['id']; ?>/<?php echo $row_logos['foto']; ?>" alt="Logo" style="height:200px">
                                    <a href="javascript(void)" data-toggle="modal" data-target="#logo2Modal-<?php echo $row_logos['id']; ?>" type="button" class="btn btn-block btn-warning mt-2">Alterar Logo 2</a>
                                </div>
                            </div>
                            <!-- Modal do logo 2 -->
                            <div class="modal fade" id="logo2Modal-<?php echo $row_logos['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="logo2ModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="logo2ModalLongTitle">Alterar a Logo 2</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="<?php echo pg; ?>/processa/proc_edit_logos2" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo $row_logos['id']; ?>">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="inputEmail4">Logo 2</label>
                                                <input type="hidden" name="foto_antiga" value="<?php echo $row_logos['foto']; ?>">
                                                <input type="file" class="form-control form-control-sm form-control-file" id="exampleFormControlFile1" name="foto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-outline-primary" name="SendEditLogo2" value="Alterar Logo 2">
                                    </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>