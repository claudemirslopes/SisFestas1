<?php
if (!isset($seguranca)) {
    exit;
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
//verificar a existencia do id na URL
if (!empty($id)) {
    if($_SESSION['niveis_acesso_id'] == 1){
        $result_usuario = "SELECT * FROM clientes WHERE id='$id'";
    }else{
        $result_usuario = "SELECT * FROM clientes 
            WHERE ordem > '".$_SESSION['ordem']."' AND id='$id'
            LIMIT 1";
    }
    
    $resultado_usuario = mysqli_query($conn, $result_usuario);

    //Verificar se encontrou o usuário no banco de dados
    if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
        $row_usuario = mysqli_fetch_assoc($resultado_usuario);
?>
<style>
    .text-primary {
        color: #045FB4 !important;
    }
    .text-primary:hover {
        color: #2E9AFE !important;
    }
    .text-danger {
        color: #B40404 !important;
    }
    .text-danger:hover {
        color: #FE2E2E !important;
    }
</style>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#logradouro").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
    }       
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {
        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //Preenche os campos com "carregando..." enquanto consulta webservice.
                $("#logradouro").val("carregando...");
                $("#bairro").val("carregando...");
                $("#cidade").val("carregando...");
                $("#uf").val("carregando...");
                $("#ibge").val("carregando...");
                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#logradouro").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                        $("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});
</script>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edição de Cliente</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="clientes.html">Clientes</a></li>
            <li class="breadcrumb-item active">Cliente</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Conteúdo principal da página -->
<section class="content">
    <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row" style="margin-left: -20px;">
        <div class="col-lg-2 text-center">
        <a class="btn btn-lg btn-app bg-secondary" style="width: 100%;">
            <i class="fa fa-file-text"></i> Contrato
        </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 text-center">
        <a class="btn btn-lg btn-app bg-success" style="width: 100%;">
            <i class="fas fa-barcode"></i> Boletos
        </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 text-center">
        <a class="btn btn-lg btn-app bg-danger" style="width: 100%;">
            <i class="fas fa-barcode"></i> Boleto Avulso
        </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 text-center">
        <a class="btn btn-lg btn-app bg-info" style="width: 100%;">
            <i class="fa fa-qrcode"></i> Gerar Carnê
        </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 text-center">
        <a class="btn btn-lg btn-app bg-warning" style="width: 100%;">
            <i class="fa fa-th-list"></i> Organização da Festa
        </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 text-center">
        <a class="btn btn-lg btn-app bg-primary" style="width: 100%;">
            <i class="fa fa-sticky-note"></i> Observações do Evento
        </a>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <?php
    if(isset($_SESSION['<div class="row">msg</div>'])){
        echo $_SESSION['<div class="row">msg</div>'];
        unset($_SESSION['<div class="row">msg</div>']);
    }
    ?>
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-9 connectedSortable mt-2">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 border-bottom-0">
              <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-dados-tab" data-toggle="pill" href="#custom-tabs-four-dados" role="tab" aria-controls="custom-tabs-four-dados" aria-selected="true">Dados Pessoais</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-contato-tab" data-toggle="pill" href="#custom-tabs-four-contato" role="tab" aria-controls="custom-tabs-four-contato" aria-selected="false">Contato</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-cobranca-tab" data-toggle="pill" href="#custom-tabs-four-cobranca" role="tab" aria-controls="custom-tabs-four-cobranca" aria-selected="false">Cobrança</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-pacote-tab" data-toggle="pill" href="#custom-tabs-four-pacote" role="tab" aria-controls="custom-tabs-four-pacote" aria-selected="false">Pacote</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-mensagem-tab" data-toggle="pill" href="#custom-tabs-four-mensagem" role="tab" aria-controls="custom-tabs-four-mensagem" aria-selected="false">Mensagens</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-administrativo-tab" data-toggle="pill" href="#custom-tabs-four-administrativo" role="tab" aria-controls="custom-tabs-four-administrativo" aria-selected="false">Administrativo</a>
                  </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content mt-4" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-dados" role="tabpanel" aria-labelledby="custom-tabs-four-dados-tab">
                  <div class="card-body">
                      <form>
                      <div class="form-row">
                          <div class="form-group col-md-4">
                          <button type="button" data-toggle="modal" data-target="#newevent" class="btn btn-primary">Agendar Evento&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar" aria-hidden="true"></i></button>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group col-md-8">
                          <label for="inputAddress">Nome</label>
                          <input type="text" class="form-control" value="Eliane Rocha de Freitas Lopes" readonly="">
                          </div>
                          <div class="form-group col-md-4">
                          <label for="inputAddress">Email</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                              </div>
                              <input type="text" class="form-control" value="lifreitaslopes@gmail.com" readonly="">
                          </div>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group col-md-6">
                          <label for="inputAddress">Login</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-user"></i></span>
                              </div>
                              <input type="text" class="form-control" value="lifreitaslopes" readonly="">
                          </div>
                          </div>
                          <div class="form-group col-md-6">
                          <label for="inputAddress">Senha</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-lock"></i></span>
                              </div>
                              <input type="text" class="form-control" value="lulamolusco" readonly="">
                          </div>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group col-md-4">
                          <label for="inputState">Data de Nascimento</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control" value="28/11/1971" readonly="">
                          </div>
                          </div>
                          <div class="form-group col-md-4">
                          <label for="inputState">CPF</label>
                          <input type="text" class="form-control" value="999.999.999-99" readonly="">
                          </div>
                          <div class="form-group col-md-4">
                          <label for="inputZip">RG</label>
                          <input type="text" class="form-control" value="58.855.585.5" readonly="">
                          </div>
                      </div>
                      <button type="button" data-toggle="modal" data-target="#editcliente" class="btn btn-warning float-right"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Editar informações do cliente</button>
                      </form>
                  </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-contato" role="tabpanel" aria-labelledby="custom-tabs-four-contato-tab">
                  <div class="card-body">
                      <table class="table table-sm table-bordered table-striped">
                      <thead>
                          <tr>
                          <th>Email</th>
                          <th>Telefone</th>
                          <th>Endereço</th>
                          <th class="text-right">Ações</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                          <td class="text-left">lifreitaslopes@gmail.com</td>
                          <td class="text-left">(19) 98457-8361</td>
                          <td class="text-left">Rua João Macário Adella, 35 - Limeira/SP</td>
                          <td class="text-right"><a title="Editar" href="cliente.html" role="button"><i class="fa fa-pencil-square-o text-info" aria-hidden="true"></i></a>&nbsp;<a title="Excluír" href="#" role="button"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a></td>
                          </tr>
                      </tbody>
                      </table>
                      <button type="button" class="btn btn-info btn-block btn-flat btn-sm mt-2" data-toggle="modal" data-target="#addcontato"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Adicionar Contato</button>
                  </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-cobranca" role="tabpanel" aria-labelledby="custom-tabs-four-cobranca-tab">
                      Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-pacote" role="tabpanel" aria-labelledby="custom-tabs-four-pacote-tab">
                      Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-mensagem" role="tabpanel" aria-labelledby="custom-tabs-four-mensagem-tab">
                      Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-administrativo" role="tabpanel" aria-labelledby="custom-tabs-four-administrativo-tab">
                      Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                  </div>
              </div>
            </div>
            <!-- /.card -->
        </div>
      </section>
      <section class="col-lg-3 connectedSortable">
        <div class="card card-danger card-outline mt-2">
            <div class="card-header">
              <h5 class="card-title m-0 font-weight-bold">Resumo</h5>
              <div class="float-right">
                  <a href="#" type="button" class="btn btn-outline-danger btn-sm" title="Página anterior" onclick="voltar()">
                      <i class="fa fa-angle-left" aria-hidden="true"></i></a>
                      <script>
                      function voltar() {
                      window.history.back();
                      }
                      </script>
              </div>
            </div>
            <div class="card-body">
              <div class="row" style="display: inline !important;line-height: 9px;">
                <p class="card-text" style="font-size: .9em;"><span class="font-weight-bold">CPF: </span>999.999.999-99</p>
                <p class="card-text" style="font-size: .9em;"><span class="font-weight-bold">Login: </span>lifreitas</p>
              </div>
            </div>
            <div class="card-body" style="padding-bottom: 2.8rem;border-top: 1px solid #ccc;">
              <div class="color-palette-set font-weight-bold" style="font-size: .9em;">
                <div class="bg-danger color-palette ">
                  <span class="ml-2"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> IMPORTANTE</span>
                </div>
                <div class="bg-danger disabled color-palette">
                  <div class="col-md-12 p-2">
                    <span class="ml-2">Há boletos não pagos deste cliente</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body" style="margin-top: -5px;border-top: 1px solid #ccc;">
              <table class="table table-bordered table-hover" style="font-size: .9em;">
                  <thead>
                  <tr>
                      <th>Plano</th>
                      <th>Valor</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td class="text-left">Festa p/ 100 pessoas</td>
                      <td class="text-right">R$ 500,00</td>
                  </tr>
                  <tr>
                      <th class="text-right">Total</th>
                      <td class="text-right">R$ 500,00</td>
                  </tr>
                  </tbody>
              </table>
            </div>
        </div>
      </section>
      <!-- /.Left col -->
    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>

<!-- Modal para novo evento -->
<div class="modal fade" id="newevent">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agendar novo evento ao sistema</h4>
        <button type="button" class="Fechar" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="calendar" class="col-centered"></div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal para editar um cliente -->
<div class="modal fade" id="editcliente">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Cliente</h4>
        <button type="button" class="Fechar" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="inputAddress">Nome</label>
            <input type="text" class="form-control" value="Eliane Rocha de Freitas Lopes">
          </div>
          <div class="form-group col-md-4">
              <label for="inputAddress">Email</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="text" class="form-control">
              </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputAddress">Login</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" class="form-control" value="lifreitaslopes">
            </div>
          </div>
          <div class="form-group col-md-6">
            <label for="inputAddress">Senha</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input type="text" class="form-control" value="lulamolusco">
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputState">Data de Nascimento</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              <input type="text" class="form-control" value="28/11/1971">
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="inputState">CPF</label>
            <input type="text" class="form-control" value="999.999.999-99">
          </div>
          <div class="form-group col-md-4">
            <label for="inputZip">RG</label>
            <input type="text" class="form-control" value="58.855.585.5">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Gravar Informações no Sistema</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal para adicionar um novo contato -->
<div class="modal fade" id="addcontato">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Cadastrar Novo Endereço de Contato</h4>
        <button type="button" class="Fechar" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputAddress">CEP</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
              </div>
              <input type="text" class="form-control">
            </div>
          </div>
          <div class="form-group col-md-6">
            <label for="inputState">Telefone <small>(Fixo ou Celular)</small></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
              </div>
              <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-11">
            <label for="inputState">Endereço<small>(rua, logradouro)</small></label>
            <input type="text" class="form-control">
          </div>
          <div class="form-group col-md-1">
            <label for="inputZip">Nº</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputState">Complemento <small> (Apto, casa, outros)</small></label>
            <input type="text" class="form-control">
          </div>
          <div class="form-group col-md-3">
            <label for="inputZip">Bairro</label>
            <input type="text" class="form-control">
          </div>
          <div class="form-group col-md-3">
            <label for="inputZip">Cidade</label>
            <input type="text" class="form-control">
          </div>
          <div class="form-group col-md-2">
            <label for="inputZip">UF</label>
            <select class="form-control">
              <option value="" selected="" disabled="">Selecione...</option>
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espirito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MT">Mato Grosso</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RO">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Gravar Informações no Sistema</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
    unset($_SESSION['dados']);
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Nenhum cliente encontrado</div>";
    $url_destino = pg . "/listar/list_clientes";
    header("Location: $url_destino");
}
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Nenhum cliente encontrado</div>";
    $url_destino = pg . "/listar/list_clientes";
    header("Location: $url_destino");
}