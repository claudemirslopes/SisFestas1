<?php
if (!isset($seguranca)) {
    exit;
}
?>

<!-- Conteúdo principal da página -->
<section class="content">
      <div class="container-fluid">
        <!-- Box pequeno (caixa estática) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h5 class="font-weight-bold">150</h5>

                <p>Clientes cadastrados</p>
              </div>
              <div class="icon">
                <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h5 class="font-weight-bold">785</h5>

                <p>Eventos realizados</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5 class="font-weight-bold">R$ 2.500,00</h5>

                <p>Contas a receber</p>
              </div>
              <div class="icon">
                <i class="fa fa-credit-card" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h5 class="font-weight-bold">R$ 750,00</h5>

                <p>Contas a pagar</p>
              </div>
              <div class="icon">
                <i class="fa fa-money" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <div id="calendar" class="col-centered"></div>
          </section>
          <!-- /.Left col -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->