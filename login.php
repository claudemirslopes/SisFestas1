<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SisFestas | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <style type="text/css">
    .elevation-3 {
      box-shadow: none !important;
    }
    .card-header {
      background: #333 !important;
      border: 1px solid #fff;
      border-top: none;
      border-radius: 5px;
    }
    .card-body {
      background: #555 !important;
      color: #eee;
      border: 1px solid #fff;
      border-radius: 5px;
    }
    .alert-warning {
      color: #1f2d3d;
      background-color: #F2F5A9;
      border-color: #F3E2A9;
      height: 30px;
      line-height: 3px;
    }

    .alert-success {
      color: #1f2d3d;
      background-color: #D0F5A9;
      border-color: #BCF5A9;
      height: 30px;
      line-height: 3px;
    }

    .alert-danger {
      color: #1f2d3d;
      background-color: #F5BCA9;
      border-color: #F5A9A9;
      height: 30px;
      line-height: 3px;
    }
  </style>
</head>
<body class="hold-transition login-page" style="background: #111;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-warning">
    <div class="card-header text-center">
      <img src="assets/dist/img/salaoFestas_black.png" alt="Ibiza Logo" class="brand-image elevation-3" style="width: 60%;">
    </div>
    <div class="card-body">
      <p class="login-box-msg">Faça login para iniciar sua sessão</p>

      <form method="POST" action="valida.php" accept-charset="utf-8" id="login">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="username" name="usuario" placeholder="Usuário">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" name="senha" class="form-control" placeholder="Senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Lembre-me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
        </div>
        <p style="font-size: 0.6em;text-align: center;">
        <?php
          if (isset($_SESSION['msg'])) {
              echo $_SESSION['msg'];
              unset($_SESSION['msg']);
          }if (isset($_SESSION['msg_rec'])) {
              echo $_SESSION['msg_rec'];
              unset($_SESSION['msg_rec']);
          }
          ?>
          </p>
          <p class="text-center text-danger" style="font-weight: bold;">
          <?php if(isset($_SESSION['loginErro'])){
            echo $_SESSION['loginErro'];
            unset ($_SESSION['loginErro']);
          }?>
          </p>
          <p class="text-center text-success" style="font-weight: bold;font-size: 0.6em;text-align: center;">
          <?php if(isset($_SESSION['loginDeslogado'])){
            echo $_SESSION['loginDeslogado'];
            unset ($_SESSION['loginDeslogado']);
          }?>
          </p>

      <div class="social-auth-links text-center mt-2 mb-3">
        <input type="submit" name="btnLogin" class="btn btn-block btn-danger" value="Entrar no sistema">
      </div>
      <!-- /.social-auth-links -->
      </form>
      <p class="mb-1">
        <a href="recuperar_senha.php">Esqueci minha senha!</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
