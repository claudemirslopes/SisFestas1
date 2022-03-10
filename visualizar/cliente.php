<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SisFestas | Cliente</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Fullcalendar -->
  <link rel="stylesheet" href="dist/css/fullcalendar.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <style type="text/css">
    .nav-treeview {
      background: #494E54 !important;
    }
    #calendar {
    max-width: 95%;
    }
    .col-centered {
      float: none;
      margin: 0 auto;
    }
    .elevation-3 {
      box-shadow: none !important;
    }
    .nav-tabs .nav-link.active {
      font-weight: bold;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-warning navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contato</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Pesquisar" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-info navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/salaoFestas_black.png" alt="Ibiza Logo" class="brand-image elevation-3" style="width: 70%;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/2.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Claudemir S. Lopes</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Pesquisar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.html" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.html" class="nav-link">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                Eventos
              </p>
            </a>
          </li>
          <li class="nav-header">PRINCIPAL</li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Cadastros
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="clientes.html" class="nav-link active">
                  <i class="fa fa-user-plus nav-icon text-primary"></i>
                  <p>Clientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="fa fa-archive nav-icon text-light"></i>
                  <p>Pacotes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="fa fa-tags nav-icon text-warning"></i>
                  <p>Serviços</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-usd"></i>
              <p>
                Financeiro
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="fa fa-money nav-icon text-danger"></i>
                  <p>Contas a Pagar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="fa fa-credit-card-alt nav-icon text-info"></i>
                  <p>Contas a Receber</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="fa fa-barcode nav-icon text-success"></i>
                  <p>Boletos</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-list-alt"></i>
              <p>
                Relatórios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                  <i class="nav-icon far fa-circle text-warning"></i>
                  <p>Festas por Mês</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Festas por Ano</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/buttons.html" class="nav-link">
                  <i class="nav-icon far fa-circle text-primary"></i>
                  <p>Despesas do Mês</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/sliders.html" class="nav-link">
                  <i class="nav-icon far fa-circle text-success"></i>
                  <p>Saldo a Receber</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/modals.html" class="nav-link">
                  <i class="nav-icon far fa-circle text-danger"></i>
                  <p>Saldo a Pagar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">CONFIGURAÇÕES</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuários
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="fa fa-vcard nav-icon text-primary"></i>
                  <p>Colaboradores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="fa fa-lock nav-icon text-success"></i>
                  <p>Permissões</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Ferramentas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="fa fa-picture-o nav-icon text-info"></i>
                  <p>Logo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="fa fa-comments-o nav-icon text-warning"></i>
                  <p>Avisos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-bell nav-icon text-danger"></i>
                  <p>Notificações</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cadastro de Cliente</h1>
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

    <!-- Main content -->
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
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-dados" role="tabpanel" aria-labelledby="custom-tabs-four-dados-tab">
                    <div class="card-body">
                      <form>
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <button type="button" data-toggle="modal" data-target="#newevent" class="btn btn-primary">Agendar novo evento no sistema&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar" aria-hidden="true"></i></button>
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
                    </div>
                    <div class="card-body col-md-4 float-right">
                      <button type="button" class="btn btn-info btn-block btn-flat btn-sm" data-toggle="modal" data-target="#addcontato"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Adicionar Contato</button>
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
              </div>
              <div class="card-body">
                <p class="card-text" style="font-size: .9em;"><span class="font-weight-bold">Nome: </span>Eliane Rocha de Freitas Lopes<br>
                  <span class="font-weight-bold">CPF: </span>999.999.999-99</p>
                <p class="card-text" style="font-size: .9em;"><span class="font-weight-bold">Login: </span>lifreitas | <span class="font-weight-bold">Senha:</span> lulamolusco</p>
              </div>
              <div class="card-body" style="margin-top: -5px;border-top: 1px solid #ccc;">
                <div class="color-palette-set font-weight-bold" style="font-size: .9em;">
                  <div class="bg-danger color-palette "><span class="ml-2"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> IMPORTANTE</span></div>
                  <div class="bg-danger disabled color-palette"><span class="ml-2">Há boletos não pagos deste cliente</span></div>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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

  <footer class="main-footer">
    <strong>Copyright &copy; 2021-2021 <a href="https://openbeta.com.br">Open Beta Informática</a>.</strong>
    Direitos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Versão</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://kit.fontawesome.com/a8568f4b07.js" crossorigin="anonymous"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- FullCalendar -->
<script src='dist/js/moment.min.js'></script>
<script src='dist/js/fullcalendar/fullcalendar.min.js'></script>
<script src='dist/js/fullcalendar/fullcalendar.js'></script>
<script src='dist/js/fullcalendar/locale/pt-br.js'></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<script>

  $(document).ready(function() {

    var date = new Date();
       var yyyy = date.getFullYear().toString();
       var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
       var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
    
    $('#calendar').fullCalendar({
      header: {
         language: 'pt-br',
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek',

      },
      defaultDate: yyyy+"-"+mm+"-"+dd,
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
        
        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd').modal('show');
      },
      eventRender: function(event, element) {
        element.bind('dblclick', function() {
          $('#ModalEdit #id').val(event.id);
          $('#ModalEdit #title').val(event.title);
          $('#ModalEdit #color').val(event.color);
          $('#ModalEdit').modal('show');
        });
      },
      eventDrop: function(event, delta, revertFunc) { // si changement de position

        edit(event);

      },
      eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

        edit(event);

      },
      events: [
        {
          id: '1',
          title: 'Cas: Rita e Jonas',
          start: '2021-08-31 08:24:00',
          end: '2021-08-31 16:55:45',
          color: '#B40486',
        },
        {
          id: '2',
          title: 'Festa: Maria Eduarda',
          start: '2021-09-04 08:24:00',
          end: '2021-09-04 16:55:45',
          color: '#0040FF',
        },
        {
          id: '4',
          title: 'Festa: Caio Ortolan',
          start: '2021-09-05 08:24:00',
          end: '2021-09-05 16:55:45',
          color: '#0040FF',
        },
        {
          id: '7',
          title: 'Cas: Maria e João',
          start: '2021-09-15 08:24:00',
          end: '2021-09-15 16:55:45',
          color: '#B40486',
        },
        {
          id: '9',
          title: 'Festa: Mônica Santos',
          start: '2021-09-17 08:24:00',
          end: '2021-09-17 16:55:45',
          color: '#0040FF',
        },
        {
          id: '12',
          title: 'Deb: Sthefanie Laura',
          start: '2021-09-28 08:24:00',
          end: '2021-09-28 16:55:45',
          color: '#4B088A',
        },
      ]
    });
    
    function edit(event){
      start = event.start.format('YYYY-MM-DD HH:mm:ss');
      if(event.end){
        end = event.end.format('YYYY-MM-DD HH:mm:ss');
      }else{
        end = start;
      }
      
      id =  event.id;
      
      Event = [];
      Event[0] = id;
      Event[1] = start;
      Event[2] = end;
      
      $.ajax({
       url: 'editEventDate.php',
       type: "POST",
       data: {Event:Event},
       success: function(rep) {
          if(rep == 'OK'){
            alert('Inserção realizada com sucesso');
          }else{
            alert('Não foi possível gravar, Tentar novamente!.'); 
          }
        }
      });
    }
    
  });

</script>
</body>
</html>
