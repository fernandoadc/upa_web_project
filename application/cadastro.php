<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminUPA | Cadastro</title>
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
<body class="hold-transition register-page">
<div class="register-box">
  <!--<div class="register-logo">
    <a href="index.php"><b></b>Cadastro</a>
  </div>-->

  <div class="register-box-body">
    <p class="login-box-msg">Informe seus dados para acesso!</p>

    <?php
       if(isset($_SESSION['msg'])){
         echo "<div class='alert alert-danger' role='alert'>", $_SESSION['msg'], "</div>";
         unset($_SESSION['msg']);
       }
    ?>
    
    <form id="cadastro-form" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome Completo">
        <!--<span class="glyphicon glyphicon-user form-control-feedback"></span>-->
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
        <!--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>-->
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha">
        <!--<span class="glyphicon glyphicon-lock form-control-feedback"></span>-->
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="senhac" id="senhac" class="form-control" placeholder="Confirmar senha">
        <!--<span class="glyphicon glyphicon-lock form-control-feedback"></span>-->
      </div>
      <div class="form-group has-feedback">
        <input type="tel" name="contato" id="contato" class="form-control" placeholder="Telefone">
        <!--<span class="glyphicon glyphicon-phone form-control-feedback"></span>-->
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="matricula" id="matricula" class="form-control" placeholder="Matrícula">
        <!--<span class="glyphicon glyphicon-share form-control-feedback"></span>-->
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!--<div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>-->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-success btn-block btn-flat">Cadastrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <div style="text-align: center;">
       <a href="index.php" class="text-center"><span class="fa fa-user" style="margin-right: 3px;"></span>Fazer Login</a>
    </div>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="_admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="_admin/plugins/iCheck/icheck.min.js"></script>
<script src="api_cadastro.js"></script>
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