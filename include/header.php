<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SisFestas | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo pg; ?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <!-- <link rel="stylesheet" href="<?php echo pg; ?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo pg; ?>/assets/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo pg; ?>/assets/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo pg; ?>/assets/datatables/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo pg; ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="<?php echo pg; ?>/assets/plugins/jqvmap/jqvmap.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo pg; ?>/assets/dist/css/adminlte.min.css">
  <!-- CSS personalizado -->
  <link rel="stylesheet" href="<?php echo pg; ?>/assets/dist/css/custom.css">
  <!-- Fullcalendar -->
  <link rel="stylesheet" href="<?php echo pg; ?>/assets/dist/css/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo pg; ?>/assets/dist/css/fullcalendar.print.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <!-- overlayScrollbars -->
  <!-- <link rel="stylesheet" href="<?php echo pg; ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="<?php echo pg; ?>/assets/plugins/daterangepicker/daterangepicker.css"> -->
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="<?php echo pg; ?>/assets/plugins/summernote/summernote-bs4.min.css"> -->
  <!-- Favicons -->
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo pg; ?>/assets/dist/img/favicon.ico">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo pg; ?>/assets/dist/img/apple-icon-64x64.png">

  <!-- Script do textarea editor TynyMCE -->
  <script src="<?php echo pg; ?>/lib/tinymce/tinymce.min.js"></script>
  <script>
      tinymce.init({
          selector: 'textarea#editable',
          theme: 'modern',
          plugins: [
              'advlist autolink lists link image charmap print preview hr anchor pagebreak',
              'searchreplace wordcount visualblocks visualchars code fullscreen',
              'insertdatetime media nonbreaking save table contextmenu directionality',
              'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
          ],
          toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
          image_advtab: true,
          templates: [
              {title: 'Test template 1', content: 'Test 1'},
              {title: 'Test template 2', content: 'Test 2'}
          ],
          content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
          ]
      });
  </script>

  <style type="text/css">
    .nav-treeview {
      background: #494E54 !important;
    }
    #calendar {
    max-width: 95%;
    }
    .col-centered{
      float: none;
      margin: 0 auto;
    }
    .elevation-3 {
      box-shadow: none !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo pg; ?>/assets/dist/img/salaoFestasL.png" alt="Logo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-warning navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo pg; ?>/visualizar/home" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
          <a class="nav-link" data-toggle="dropdown" href="<?php echo pg; ?>/visualizar/perfil">
            <i class="far fa-user"></i> Meu Perfil
          </a>
          <?php
          $result_usuario = "SELECT id, nome, foto, niveis_acesso_id FROM usuarios WHERE id='".$_SESSION['id']."' LIMIT 1";
          $resultado_usuario = mysqli_query($conn, $result_usuario);
          $row_usuario = mysqli_fetch_assoc($resultado_usuario);   
          //Somente pegar o primeiro nome
          $nome = explode(" ", $row_usuario['nome']);
          $primeiro_nome = $nome[0];
          ?>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu ml-4">
            <span class="dropdown-item dropdown-header"><?php echo $row_usuario['nome']; ?></span>
            <div class="dropdown-divider"></div>
              <a href="javascript:;" onclick="editarPerfil('<?php echo $_SESSION['id']; ?>')" title="Editar perfil" class="dropdown-item">
              <i class="fas fa-edit mr-2"></i> Editar Perfil
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo pg; ?>/sair.php" class="dropdown-item">
              <i class="fas fa-power-off mr-2"></i> Logout
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">
              <?php
                  if ($row_usuario['niveis_acesso_id'] == 1) {
                    echo '<b>N??vel:</b> Programador';
                  } elseif ($row_usuario['niveis_acesso_id'] == 2) {
                    echo '<b>N??vel:</b> Administrador';
                  } elseif ($row_usuario['niveis_acesso_id'] == 3) {
                    echo '<b>N??vel: Colaborador';
                  } else {
                    echo '<b>N??vel:</b> Estagi??rio';
                  }
                ?>
            </a>
        </div>
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
              <img src="<?php echo pg; ?>/assets/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
              <img src="<?php echo pg; ?>/assets/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
              <img src="<?php echo pg; ?>/assets/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

<!-- /.in??cio do modal editar perfil -->
<div id="ModalPerfil" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 200%;margin-left: -50%;margin-right: -50%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar perfil</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">??</span>
        </button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<!-- /.fim do modal editar -->
<!-- /.in??cio do modal editar foto -->
<div id="ModalFoto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar foto</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">??</span>
        </button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<!-- /.fim do modal editar -->
<!-- /.in??cio do modal editar senha -->
<div id="ModalSenha" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar senha</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">??</span>
        </button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<!-- /.fim do modal editar -->