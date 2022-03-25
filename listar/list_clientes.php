<?php
if (!isset($seguranca)) {
    exit;
}
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
                <h1 class="m-0">Clientes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Listar clientes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Conteúdo principal da página -->
<section class="content">
    <div class="container-fluid">
    <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-9 connectedSortable">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-clientes-tab" data-toggle="pill" href="#custom-tabs-four-clientes" role="tab" aria-controls="custom-tabs-four-clientes" aria-selected="true">Clientes cadastrados no sistema</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row" style="display: inline !important;">
                            <?php
                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }

                            /* Verificar o botão */
                            $botao_editar = carregar_botao('editar/edit_clientes', $conn);
                            $botao_apagar = carregar_botao('processa/proc_apagar_clientes', $conn);

                            /* Selecionar no banco de dados os cliente */
                            $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                            $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                            //Setar a quantidade de itens por pagina
                            $qnt_result_pg = 50;

                            //calcular o inicio visualização
                            $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

                            if ($_SESSION['niveis_acesso_id'] == 1) {
                                $result_cliente = "SELECT * FROM clientes
                                    ORDER BY id DESC
                                    LIMIT $inicio, $qnt_result_pg";
                            } else {
                                $result_cliente = "SELECT * FROM clientes
                                    WHERE ordem > '".$_SESSION['ordem']."'
                                    ORDER BY id DESC
                                    LIMIT $inicio, $qnt_result_pg";
                            }

                            $resultado_cliente = mysqli_query($conn, $result_cliente);
                            ?>                            
                            <table id="example1" class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th class="hidden-sm">Tel/Cel</th>
                                        <th class="hidden-sm">Usuário</th>
                                        <th class="hidden-sm">CPF</th>
                                        <th class="text-center">Sit.</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row_cliente = mysqli_fetch_array($resultado_cliente)) {
                                        //echo $row_cliente['nome'] . "<br>";
                                    ?>
                                        <script>
                                            function confirmExcluir(id)
                                                {
                                                swal({
                                                    title: "Excluir",
                                                    text: "Confirma a exclusão do cliente?",
                                                    type: "error",
                                                    showCancelButton: true,
                                                    confirmButtonClass: 'btn-success',
                                                    confirmButtonText: 'Sim',
                                                    cancelButtonText: 'Não',
                                                    closeOnConfirm: false
                                                }, function () {
                                                    window.location.href = '../processa/proc_apagar_clientes?id=' + id;   
                                                });
                                                }
                                        </script>
                                        <tr>
                                            <td><?php echo $row_cliente['id']; ?></td>
                                            <td><?php echo $row_cliente['nome']; ?></td>
                                            <td class="hidden-sm"><?php echo $row_cliente['telefone']; ?></td>
                                            <td class="hidden-sm"><?php echo $row_cliente['usuario']; ?></td>
                                            <td class="hidden-sm"><?php echo $row_cliente['cpf']; ?></td>
                                            <td class="text-center"><?php echo $row_cliente['situacao'] == 1 ? '<i class="fa fa-check text-success font-weight-bold" aria-hidden="true" title="Ativo"></i>' : '<i class="fa fa-times text-dark font-weight-bold" aria-hidden="true" title="Inativo"></i>'; ?>
                                            </td>
                                            <td class="text-right">
                                                <?php
                                                if ($botao_editar) { ?>
                                                    <a href="javascript:;" onclick="editarCli('<?php echo $row_cliente['id']; ?>')"><i class="fa fa-pencil-square-o text-primary font-weight-bold" aria-hidden="true" title="Editar"></i></a> 
                                                <?php }  ?>  
                                                <?php if ($botao_apagar) { ?>
                                                    <a href="javascript:;" onclick="confirmExcluir(<?php echo $row_cliente['id']?>)"><i class='fa fa-trash text-danger font-weight-bold' aria-hidden='true' title='Excluir'></i></a>   
                                                <?php } ?>                            
                                            </td>
                                        </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </section>
            <section class="col-lg-3 connectedSortable">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0 font-weight-bold">Informações</h5>
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
                            <p class="card-text" style="font-size: .9em;"><span class="font-weight-bold">
                                <?php 
                                $result_usuarios = "SELECT COUNT(id) AS num_result FROM clientes";
                                $resultao_usuarios = mysqli_query($conn, $result_usuarios);
                                $row_usuarios = mysqli_fetch_assoc($resultao_usuarios); ?>
                                <?php echo $row_usuarios['num_result']; ?> </span>Clientes cadastrados<br>
                            </p>
                            <p class="card-text" style="font-size: .9em;"><span class="font-weight-bold">
                                <?php 
                                $result_usuarios = "SELECT COUNT(id) AS num_result FROM clientes
                                WHERE situacao = 1";
                                $resultao_usuarios = mysqli_query($conn, $result_usuarios);
                                $row_usuarios = mysqli_fetch_assoc($resultao_usuarios); ?>
                                <?php echo $row_usuarios['num_result']; ?> </span>clientes ativos
                            </p>
                        </div>
                    </div>
                    <div class="card-body" style="padding-bottom: 2.8rem;border-top: 1px solid #ccc;">
                        <div class="color-palette-set font-weight-bold" style="font-size: .9em;">
                            <div class="bg-warning color-palette" style="padding: 2px;"><span class="ml-2"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ATENÇÃO</span></div>
                            <div class="bg-warning disabled color-palette">
                                <div class="col-md-12 p-2">
                                    Há 
                                    <b>
                                        <?php 
                                        $result_usuarios = "SELECT COUNT(id) AS num_result FROM clientes
                                        WHERE situacao != 1";
                                        $resultao_usuarios = mysqli_query($conn, $result_usuarios);
                                        $row_usuarios = mysqli_fetch_assoc($resultao_usuarios); ?>
                                        <?php echo $row_usuarios['num_result']; ?>
                                    </b> 
                                    clientes desabilitados no sistema</div>
                                </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding-bottom: 1.8rem;border-top: 1px solid #ccc;">
                        <div class="info-box bg-danger">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                            <div class="info-box-content" style="font-size: smaller;">
                                <span class="info-box-text">IMPORTANTE</span>
                                <span class="info-box-number">3% dos clientes</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 3%"></div>
                                </div>
                                <span class="progress-description" style="font-size: smaller;">
                                    pagtos atrasados
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="card-body" style="padding-bottom: 1.8rem;border-top: 1px solid #ccc;">
                        <!-- Carregar o botão de cadatrar -->
                        <a href="#"><button type="button" class="btn btn-outline-primary btn-block btn-flat" data-toggle="modal" data-target="#modalCadCli"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp; Novo cliente</button></a>
                    </div>
                </div>
            </section>
            <!-- /.Left col -->
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </div>
</section>

<!-- /.início do modal cadastrar -->
<div class="modal fade" id="modalCadCli">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Cadastrar cliente</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <form action="<?php echo pg; ?>/processa/proc_cad_clientes" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <fieldset class="border p-3 fset" style="margin-top: 10px;">
                            <legend class="font-small">&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;&nbsp;Dados Cadastrais</legend>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nome</label>
                                <input type="text" name="nome" class="form-control form-control-sm forp" placeholder="Nome completo" value="<?php if (isset($_SESSION['dados']['nome'])) {
                                    echo $_SESSION['dados']['nome'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">CPF</label>
                                <input type="text" name="cpf" class="form-control form-control-sm forp cpf" placeholder="CPF" value="<?php if (isset($_SESSION['dados']['cpf'])) {
                                    echo $_SESSION['dados']['cpf'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword4">RG</label>
                                <input type="text" name="rg" class="form-control form-control-sm forp" placeholder="RG" value="<?php if (isset($_SESSION['dados']['rg'])) {
                                    echo $_SESSION['dados']['rg'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">E-mail</label>
                                <input type="email" name="email" class="form-control form-control-sm forp" placeholder="E-mail" value="<?php if (isset($_SESSION['dados']['email'])) {
                                    echo $_SESSION['dados']['email'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Usuário</label>
                                <input type="text" name="usuario" class="form-control form-control-sm forp" placeholder="Usuário para logar no sistema" value="<?php if (isset($_SESSION['dados']['usuario'])) {
                                    echo $_SESSION['dados']['usuario'];
                                } ?>">
                            </div>
                                <!-- A senha padrão ao cadastrar um cliente é cr2@+mês+ano atual -->
                                <input type="hidden" name="senha" class="form-control form-control-sm forp" value="sf@<?php echo $hoje; ?>">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Foto</label>
                                <input type="file" class="form-control form-control-file form-control-sm forp" id="exampleFormControlFile1" name="foto">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border p-3 fset" style="margin-top: 10px;">
                        <legend class="font-small">&nbsp;&nbsp;<i class="fa fa-map"></i>&nbsp;&nbsp;Endereço</legend>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Telefone/Celular</label>
                                <input type="text" name="telefone" class="form-control form-control-sm forp form-control form-control-sm forp-sm sp_celphones" placeholder="Telefone/celular" value="<?php if (isset($_SESSION['dados']['telefone'])) {
                                    echo $_SESSION['dados']['telefone'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">CEP</label>
                                <input type="text" name="cep" id="cep" class="form-control form-control-sm forp form-control form-control-sm forp-sm cep" placeholder="CEP" value="<?php if (isset($_SESSION['dados']['cep'])) {
                                    echo $_SESSION['dados']['cep'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Logradouro</label>
                                <input type="text" name="rua" id="logradouro" class="form-control form-control-sm forp" placeholder="Rua/Avenida" value="<?php if (isset($_SESSION['dados']['rua'])) {
                                    echo $_SESSION['dados']['rua'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="inputEmail4">Nº</label>
                                <input type="number" name="numero" class="form-control form-control-sm forp form-control form-control-sm forp-sm" placeholder="Nº" value="<?php if (isset($_SESSION['dados']['numero'])) {
                                    echo $_SESSION['dados']['numero'];
                                } ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Complemento</label>
                                <input type="text" name="complemento" class="form-control form-control-sm forp form-control form-control-sm forp-sm" placeholder="Complemento" value="<?php if (isset($_SESSION['dados']['complemento'])) {
                                    echo $_SESSION['dados']['complemento'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword4">Bairro</label>
                                <input type="text" name="bairro" id="bairro" class="form-control form-control-sm forp" placeholder="Bairro" value="<?php if (isset($_SESSION['dados']['bairro'])) {
                                    echo $_SESSION['dados']['bairro'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword4">Cidade</label>
                                <input type="text" name="cidade" id="cidade" class="form-control form-control-sm forp cidade" placeholder="Cidade" value="<?php if (isset($_SESSION['dados']['cidade'])) {
                                    echo $_SESSION['dados']['cidade'];
                                } ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">Estado</label>
                                <select name="uf" id="uf" class="form-control form-control-sm forp custom-select">
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG">MG</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PR">PR</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SP" selected>SP</option>
                                    <option value="SE">SE</option>
                                    <option value="TO">TO</option>
                                </select>   
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border p-3 fset" style="margin-top: 10px;">
                        <legend class="font-small">&nbsp;&nbsp;<i class="fa fa-info"></i>&nbsp;&nbsp;Observação</legend>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea name="obs" class="form-control form-control-sm forp"><?php if (isset($_SESSION['dados']['obs'])) {
                                    echo $_SESSION['dados']['obs'];
                                } ?></textarea>
                            </div>
                        </div>
                    </fieldset>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-outline-primary" name="SendCadcliente" value="Cadastrar cliente">
            </form>
        </div>
        </div>
    </div>
</div>   
<!-- /.fim do modal cadastrar -->
<!-- /.início do modal editar -->
<div id="ModalUser" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar cliente</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body"></div>
    </div>
    </div>
</div>
<!-- /.fim do modal editar -->
<!-- /.início do modal editar foto -->
<div id="ModalFoto2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar foto</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<!-- /.fim do modal editar -->
<!-- /.início do modal editar senha -->
<div id="ModalSenha2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar senha</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<!-- /.fim do modal editar -->

    