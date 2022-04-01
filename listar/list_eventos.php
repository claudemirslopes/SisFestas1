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

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Usuários</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Listar eventos</li>
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
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <strong class="card-title">Todos os eventos:</strong>
                        <div class="float-right">
                            <!-- Carregar o botão de cadatrar -->
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
                        <div class="row" style="display: inline !important;">
                            <?php
                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }

                            /* Verificar o botão */
                            $botao_apagar = carregar_botao('processa/proc_apagar_eventos', $conn);

                            /* Selecionar no banco de dados os usuário */
                            $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                            $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                            //Setar a quantidade de itens por pagina
                            $qnt_result_pg = 50;

                            //calcular o inicio visualização
                            $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

                            if ($_SESSION['niveis_acesso_id'] == 1) {
                                $result_evento = "SELECT e.id ide, e.title, e.start, e.idcli, c.id idc, c.nome
                                    FROM events e
                                    INNER JOIN clientes c on c.id=e.idcli 
                                    ORDER BY e.id DESC
                                    LIMIT $inicio, $qnt_result_pg";
                            } else {
                                $result_evento = "SELECT e.id, e.title, e.start, e.idcli, c.id, c.nome
                                FROM events e
                                INNER JOIN clientes c on c.id=e.idcli 
                                    WHERE ordem > '".$_SESSION['ordem']."'
                                    ORDER BY e.id DESC
                                    LIMIT $inicio, $qnt_result_pg";
                            }

                            $resultado_evento = mysqli_query($conn, $result_evento);
                            ?>                            
                            <table id="example1" class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Título</th>
                                        <th class="hidden-sm">Data</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row_evento = mysqli_fetch_array($resultado_evento)) {
                                        //echo $row_evento['nome'] . "<br>";
                                    ?>
                                        <script>
                                            function confirmExcluir(id)
                                                {
                                                swal({
                                                    title: "Excluir",
                                                    text: "Confirma a exclusão do evento?",
                                                    type: "error",
                                                    showCancelButton: true,
                                                    confirmButtonClass: 'btn-success',
                                                    confirmButtonText: 'Sim',
                                                    cancelButtonText: 'Não',
                                                    closeOnConfirm: false
                                                }, function () {
                                                    window.location.href = '../processa/proc_apagar_eventos?id=' + id;   
                                                });
                                                }
                                        </script>
                                        <tr>
                                            <td><?php echo $row_evento['ide']; ?></td>
                                            <td><?php echo $row_evento['nome']; ?></td>
                                            <td><?php echo $row_evento['title']; ?></td>
                                            <td class="hidden-sm"><?php echo $row_evento['start']; ?></td>
                                            <td class="text-right">  
                                                <?php if ($botao_apagar) { ?>
                                                    <a href="javascript:;" onclick="confirmExcluir(<?php echo $row_evento['ide']?>)"><i class='fa fa-trash text-danger mr-2' aria-hidden='true' title='Excluir'></i></a>   
                                                <?php } ?>                            
                                            </td>
                                        </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
                
                <div class="card  card-success card-outline">
                  <div class="row">
                      <section class="col-lg-12 connectedSortable mb-4">
                          <div id="calendar" class="col-centered"></div>
                      </section>
                  </div>
                </div>              
            </div>
        </div>
    </div>
</section>

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
            <form method="POST" action="" enctype="multipart/form-data" style="font-size: .9em;">
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
          <input type="hidden" name="id" class="form-control" id="id">
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
            <form  method="POST" action="" enctype="multipart/form-data" style="font-size: .9em;">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEmail4">Cliente</label>
                  <select name="idcli" id="idcli" class="form-control" style="font-size: .9em;">
                    <option value="" disabled="" selected="">Selecione...</option>
                    <?php
                    $result_evento = "SELECT * FROM clientes";
                    $resultado_evento = mysqli_query($conn, $result_evento);
                    while($row_evento = mysqli_fetch_array($resultado_evento)){
                      echo "<option value='".$row_evento['id']."'>".$row_evento['nome']."</option>";
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

<?php
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
$start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
$end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);

if(!empty($id) && !empty($title) && !empty($color) && !empty($descricao) && !empty($start) && !empty($end)){
	//Converter a data e hora do formato brasileiro para o formato do Banco de Dados
	$data = explode(" ", $start);
	list($date, $hora) = $data;
	$data_sem_barra = array_reverse(explode("/", $date));
	$data_sem_barra = implode("-", $data_sem_barra);
	$start_sem_barra = $data_sem_barra . " " . $hora;
	
	$data = explode(" ", $end);
	list($date, $hora) = $data;
	$data_sem_barra = array_reverse(explode("/", $date));
	$data_sem_barra = implode("-", $data_sem_barra);
	$end_sem_barra = $data_sem_barra . " " . $hora;
	
	$result_events = "UPDATE events SET title='$title', color='$color', descricao='$descricao', start='$start_sem_barra', end='$end_sem_barra' WHERE id='$id'"; 
	$resultado_events = mysqli_query($conn, $result_events);
	
	//Verificar se alterou no banco de dados através "mysqli_affected_rows"
	if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-success alert-dismissible fade show' style='border-left: 4px solid #28A745;'>
    <i class='fa fa-check-circle text-success fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
    Evento editado com sucesso!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>";
		$url_destino = pg . "/listar/list_eventos";
		header("Location: $url_destino");
	}else{
		$_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
    <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
    Erro ao tentar editar evento!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>";
		$url_destino = pg . "/listar/list_eventos";
		header("Location: $url_destino");
	}
}
?>
<?php

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
$start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
$end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
$idcli = filter_input(INPUT_POST, 'idcli', FILTER_SANITIZE_STRING);

if(isset($title) && isset($color) && isset($descricao) && isset($start) && isset($end) && isset($idcli)){
	//Converter a data e hora do formato brasileiro para o formato do Banco de Dados
	$data = explode(" ", $start);
	list($date, $hora) = $data;
	$data_sem_barra = array_reverse(explode("/", $date));
	$data_sem_barra = implode("-", $data_sem_barra);
	$start_sem_barra = $data_sem_barra . " " . $hora;
	
	$data = explode(" ", $end);
	list($date, $hora) = $data;
	$data_sem_barra = array_reverse(explode("/", $date));
	$data_sem_barra = implode("-", $data_sem_barra);
	$end_sem_barra = $data_sem_barra . " " . $hora;
	
	$result_events = "INSERT INTO events (title, color, descricao, start, end, idcli) VALUES ('$title', '$color', '$descricao', '$start_sem_barra', '$end_sem_barra', '$idcli')";
	$resultado_events = mysqli_query($conn, $result_events);
	
	//Verificar se salvou no banco de dados através "mysqli_insert_id" o qual verifica se existe o ID do último dado inserido
	if(mysqli_insert_id($conn)){
		$_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-success alert-dismissible fade show' style='border-left: 4px solid #28A745;'>
    <i class='fa fa-check-circle text-success fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
    Evento cadastrado com sucesso!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>";
		$url_destino = pg . "/listar/list_eventos";
		header("Location: $url_destino");
	}else{
		$_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
    <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
    Erro ao tentar cadastrar evento!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>";
		$url_destino = pg . "/listar/list_eventos";
		header("Location: $url_destino");
	}
}
?>

<?php
if (isset($_POST['delete']) && isset($_POST['id'])){
        //Apagar a empresa
        $result_empresa_del = "DELETE FROM events WHERE id = '$id'";
        $resultado_empresa_del = mysqli_query($conn, $result_empresa_del);
        if (mysqli_affected_rows($conn)) {
          $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-success alert-dismissible fade show' style='border-left: 4px solid #28A745;'>
          <i class='fa fa-check-circle text-success fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
          Evento excluído com sucesso!
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
          </button>
      </div>";
          $url_destino = pg . "/listar/list_eventos";
          header("Location: $url_destino");
        } else {
          if ($res == false) {
            $_SESSION['msg'] = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' style='border-left: 4px solid #DC3545;'>
            <i class='fa fa-exclamation-triangle text-danger fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;
            Erro ao tentar ecluir evento!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
		        $url_destino = pg . "/listar/list_eventos";
		        header("Location: $url_destino");
        }
  }
}
?>