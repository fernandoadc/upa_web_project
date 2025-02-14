<?php
  session_start();
  include_once "../database.php";
  if(!empty($_SESSION['login'])){
    $dados = mysqli_query($dbcon, "SELECT nome FROM usuario WHERE matricula = $_SESSION[login]");
    $dadosbd = mysqli_fetch_assoc($dados);
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminUPA | Consulta</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <span class="logo-mini"><b>S</b>UP</span>
      <span class="logo-lg"><b>Santarém</b>UPA</span>
    </a>

    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i><span class="hidden-xs"><?= $dadosbd['nome'] ?></span>
            </a>
          </li>
          <li>
            <a href="../logout.php"><i class="fa fa-sign-out"></i><span class="hidden-xs">Sair</span></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">
    <section class="sidebar">
      <!-- Menu de Navegação -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="administrativo.php">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li>
          <a href="paciente.php">
            <i class="fa fa-user-plus"></i>
            <span>Cadastrar Paciente</span>
          </a>
        </li>
        <li>
          <a href="medico.php">
            <i class="fa fa-user-md"></i>
            <span>Cadastrar Médico</span>
          </a>
        </li>
        <li>
          <a href="consulta.php">
            <i class="fa fa-medkit"></i>
            <span>Realizar Consulta</span>
          </a>
        </li>
        <li>
          <a href="../logout.php">
            <i class="fa fa-sign-out"></i> <span>Sair</span>
          </a>
        </li>
      </ul>
      <!-- Fim do menu de navegação-->
      
    </section>
  </aside>

  <!-- Área do formulário -->
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="administrativo.php"><i class="fa fa-home"></i>Home</a></li>
        <li class="active">Realizar Consulta</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-success">
            <?php
               if(isset($_SESSION['msg'])){
                 echo "<div class='alert alert-danger' role='alert'>", $_SESSION['msg'], "</div>";
                 unset($_SESSION['msg']);
               }
               if(isset($_SESSION['msgcad'])){
                 echo "<div class='alert alert-success' role='alert'>", $_SESSION['msgcad'],"</div>";
                 unset ($_SESSION['msgcad']);
               }
            ?>
            <form method="post" action="consultabd.php">
              <div class="box-body">
                  <div style="text-align: center; margin-bottom: 10px;" class="box-header with-border ">
                    <h3 class="box-title">Dados Pessoais/Procedimentos</h3>
                  </div>
                  
                <div class="form-group">
                   <label for="nome">Paciente</label>
                    
                   <div class="input-group">
                     <div class="input-group-addon">
                       <i class="fa fa-user"></i>
                     </div>
                     <input type="text" name="nome" class="form-control pull-right" id="nome">
                   </div>        
                </div>
                
                <div class="form-group">
                  <label for="nasc">Cartão SUS</label>
                  <input type="number" name="sus" class="form-control" id="nasc">
                </div>
                
                <div class="form-group">
                  <label>Pedido Médico</label>
                  <textarea class="form-control" name="desc" rows="3" placeholder="Descreva aqui a queixa do paciente..."></textarea>
                </div>
                
                <div class="form-group">
                  <label>Médico Solicitante</label>
                  
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user-md"></i>
                    </div>
                    <input type="text" name="medico" class="form-control pull-right" id="datepicker">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="crm">CRM</label>
                  <input type="number" name="crm" class="form-control" id="crm">
                </div>
                
                <div class="form-group">
                  <label>Data da Consulta</label>
                  
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" name="data" class="form-control pull-right" id="datepicker">
                  </div>
                </div>
                
              <div class="box-footer">
                <button type="submit" class="btn btn-success">Confirmar Consulta</button>
              </div>
            </form>
          </div>
        </div>
        <!--/.col (left) -->
        <div class="col-md-6">
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2024 <a href="https://adminlte.io">Universidade Federal do Oeste do Pará</a>.</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>