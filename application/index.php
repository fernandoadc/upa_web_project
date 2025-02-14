<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminUPA | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="_admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="_admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="_admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="_admin/plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!--<div class="login-logo">
    <a href="#"><b></b>Login</a>
  </div>-->
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Entre com seus dados de acesso!</p>
    
    <?php
      if(isset($_SESSION['msg'])){
        echo "<div class='alert alert-danger' role='alert'>", $_SESSION['msg'], "</div>";
        unset($_SESSION['msg']);
      }
      if(isset($_SESSION['msgcad'])){
        echo "<div class='alert alert-success' role='alert'>", $_SESSION['msgcad'], "</div>";
        unset($_SESSION['msgcad']);
      }
    ?>
    
    <form id="login-form" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="login" id="matricula" class="form-control" placeholder="Matrícula">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!--<div class="checkbox ">
            <label>
              <input type="checkbox"> Mantenha-me conectado
            </label>
          </div>-->
        </div>
        
        <div class="col-xs-4">
          <button type="submit" class="btn btn-success btn-block btn-flat">Entrar</button>
        </div>
        
      </div>
    </form>
    <!-- /.social-auth-links -->
    <div style="text-align: center;">
       <!--<a href="#">Esqueci a senha</a><br>-->
       <a href="register.php" class="text-center"><span class="fa fa-user" style="margin-right: 3px;"></span>Cadastre-se</a>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="_admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="_admin/plugins/iCheck/icheck.min.js"></script>
<script src="api_auth.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>