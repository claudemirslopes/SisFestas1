<style>
  .brand-link .brand-image {
    margin-right: -0.5rem !important;
  }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="<?php echo pg; ?>" class="brand-link">
      <img src="<?php echo pg; ?>/assets/dist/img/salaoFestas.png" alt="Logo" class="brand-image elevation-3" style="width: 70%;">
    </a> -->

    <a href="<?php echo pg; ?>/visualizar/home" class="brand-link">
    <?php
    $result_logos = "SELECT * FROM logos
      ORDER BY id ASC
      LIMIT 1";

    $resultado_logos = mysqli_query($conn, $result_logos);
    
    while ($row_logos = mysqli_fetch_array($resultado_logos)) {
    ?>
    <img src="<?php echo pg; ?>/assets/images/logos/<?php echo $row_logos['id']; ?>/<?php echo $row_logos['foto']; ?>" alt="Logo" class="brand-image elevation-3">
    <?php } ?>
    <?php
    $result_logos = "SELECT * FROM logos
      ORDER BY id DESC
      LIMIT 1";

    $resultado_logos = mysqli_query($conn, $result_logos);
    
    while ($row_logos = mysqli_fetch_array($resultado_logos)) {
    ?>
    <span class="brand-text"><img src="<?php echo pg; ?>/assets/images/logos/<?php echo $row_logos['id']; ?>/<?php echo $row_logos['foto']; ?>" alt="Logo" class="brand-image elevation-3"></span>
    <?php } ?>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <?php
      $result_usuario = "SELECT id, nome, foto, niveis_acesso_id FROM usuarios WHERE id='".$_SESSION['id']."' LIMIT 1";
      $resultado_usuario = mysqli_query($conn, $result_usuario);
      $row_usuario = mysqli_fetch_assoc($resultado_usuario);   
      //Somente pegar o primeiro nome
      $nome = explode(" ", $row_usuario['nome']);
      $primeiro_nome = $nome[0];
      ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php if(!empty($row_usuario['foto'])){ ?>
            <img src="<?php echo pg.'/assets/images/usuario/'.$_SESSION['id'].'/'.$row_usuario['foto'];?>" class="img-circle elevation-2" alt="User Image">
          <?php } else { ?>
            <img src="<?php echo pg.'/assets/images/usuario/no.jpg'; ?>" class="img-circle elevation-2" alt="User Image">
          <?php } ?>
        </div>
        <div class="info">
          <a href="javascript:;" onclick="editarPerfil('<?php echo $_SESSION['id']; ?>')" title="Editar perfil" class="d-block"><?php echo $primeiro_nome; ?>&nbsp;
            <span style="font-size:.6em;">
              <?php
                if ($row_usuario['niveis_acesso_id'] == 1) {
                  echo '[Programador]';
                } elseif ($row_usuario['niveis_acesso_id'] == 2) {
                  echo '[Administrador]';
                } elseif ($row_usuario['niveis_acesso_id'] == 3) {
                  echo '[Colaborador]';
                } else {
                  echo '[Estagiário]';
                }
              ?>
            </span></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo pg; ?>/visualizar/home" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo pg; ?>/listar/list_eventos" class="nav-link">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                Eventos
              </p>
            </a>
          </li>
          <li class="nav-header">PRINCIPAL</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Cadastros
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo pg; ?>/listar/list_clientes" class="nav-link">
                  <i class="fa fa-user-plus nav-icon text-primary"></i>
                  <p>Clientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo pg; ?>/listar/list_pacotes" class="nav-link">
                  <i class="fa fa-archive nav-icon text-light"></i>
                  <p>Pacotes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo pg; ?>/listar/list_servicos" class="nav-link">
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
            <a href="<?php echo pg; ?>/listar/list_usuarios" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuários
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo pg; ?>/listar/list_usuarios" class="nav-link">
                  <i class="fa fa-vcard nav-icon text-primary"></i>
                  <p>Colaboradores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo pg; ?>/listar/list_niv_acessos" class="nav-link">
                  <i class="fa fa-lock nav-icon text-success"></i>
                  <p>Níveis de Acessos</p>
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
                <a href="<?php echo pg; ?>/visualizar/configuracoes" class="nav-link">
                  <i class="fa fa-cog nav-icon text-info"></i>
                  <p>Configurações</p>
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
          <li class="nav-item sair">
            <a href="<?php echo pg; ?>/sair.php" class="nav-link">
              <i class="nav-icon fa fa-sign-out"></i>
              <p>
                Sair
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>