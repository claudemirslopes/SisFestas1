<?php
if (!isset($seguranca)) {
    exit;
}
?>
<style>
  .fc-day-number {
    color: #333;
    margin-top: 5px;
    margin-right: 5px;
  }
  .fc-title {
    font-weight: bolder;
    font-size: 1.2em;
  }
  .fc-time {
    font-weight: lighter;
    font-size: 1em;
  }
</style>
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

                <p>Eventos cadastrados</p>
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

    <!-- Início do Modal do FullCalendar - Editar registro de Eventos -->
    <div id="visualizar" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Evento</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="<?php echo pg; ?>/processa/proc_edit_evento.php" enctype="multipart/form-data" style="font-size: .9em;">
              <div class="form-row">
                <div class="form-group col-md-10">
                  <label for="inputEmail4">Título</label>
                  <input type="text" name="title" id="title" class="form-control" placeholder="Título" style="font-size: .9em;">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputEmail4">Cor</label>
                  <input type="color" name="color" id="color" class="form-control" style="font-size: .9em;">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Início</label>
                  <input type="text" name="start" id="start" class="form-control" style="font-size: .9em;" onKeyPress="DataHora(event, this)">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Final</label>
                  <input type="text" name="end" id="end" class="form-control" style="font-size: .9em;" onKeyPress="DataHora(event, this)">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEmail4">Descrição</label>
                  <textarea name="descricao" id="descricao" class="form-control" style="font-size: .9em;"></textarea>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                  <label class="text-danger"><input type="checkbox"  name="delete"> Eliminar Evento</label>
                  </div>
                </div>
              </div>
          </div>
          <input type="hidden" name="id_evento" class="form-control" id="id_evento">
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Salvar evento</button>
          </div>
            </form>
        </div>
      </div>
    </div>
    <!-- Final do Modal do FullCalendar - Editar registro de Eventos -->

    <!-- Início do Modal do FullCalendar - Adicionar registro de Eventos -->
    <div id="cadastrar" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adicionar Evento</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form  method="POST" action="<?php echo pg; ?>/processa/proc_cad_evento.php" enctype="multipart/form-data" style="font-size: .9em;">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEmail4">Cliente</label>
                  <select name="idcli" id="idcli" class="form-control" style="font-size: .9em;">
                    <option value="" disabled="" selected="">Selecione...</option>
                    <?php
                    $result_evento = "SELECT * FROM clientes";
                    $resultado_evento = mysqli_query($conn, $result_evento);
                    while($row_evento = mysqli_fetch_array($resultado_evento)){
                      if (isset($_SESSION['dados']['idcli'])){
                        echo "<option value='".$row_evento['id']."' selected>".$row_evento['nome']."</option>";
                    }else{
                        echo "<option value='".$row_evento['id']."'>".$row_evento['nome']."</option>";
                    }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-10">
                  <label for="inputEmail4">Título</label>
                  <input type="text" name="title" id="title" class="form-control" placeholder="Título" style="font-size: .9em;">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputEmail4">Cor</label>
                  <input type="color" name="color" id="color" class="form-control" style="font-size: .9em;">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Início</label>
                  <input type="text" name="start" id="start" class="form-control" style="font-size: .9em;" onKeyPress="DataHora(event, this)">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Final</label>
                  <input type="text" name="end" id="end" class="form-control" style="font-size: .9em;" onKeyPress="DataHora(event, this)">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEmail4">Descrição</label>
                  <textarea name="descricao" id="descricao" class="form-control" style="font-size: .9em;"></textarea>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-success"  name="SendEditEve" value="Salvar Evento">
          </div>
            </form>
        </div>
      </div>
    </div>
    <!-- Final do Modal do FullCalendar - Adicionar registro de Eventos -->
	