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
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Aqui aparecem os relatórios do dashboard -->
<?php
$home_relatorio = carregar_botao('visualizar/home_relatorio', $conn);
if($home_relatorio){
    include_once 'visualizar/home_relatorio.php';
}

    