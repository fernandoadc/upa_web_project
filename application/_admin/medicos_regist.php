<?php
  session_start();
  include_once "../conexaoUPA.php";
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
  <title>AdminLTE 2 | Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <span class="logo-mini"><b>S</b>UPA</span>
      <span class="logo-lg"><b>Santarém</b>UPA</span>
    </a>

    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
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
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
      
      <!-- Menu de Navegação -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVEGAÇÃO</li>
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
    </section>
  </aside>

  <div class="content-wrapper">

    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="administrativo.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Médicos</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <section class="col-lg-7 connectedSortable">
          <div class="box box-default">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Lista de Médicos</h3>

              <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>            
            <div class="box-body">
              <?php
                $conexao = mysqli_connect("localhost", "root", "", "db_upa");
                $dados = mysqli_query($conexao, "SELECT * FROM medico ORDER BY nome LIMIT 0, 6");
                
                while($produto = mysqli_fetch_array($dados)){
              echo"
              <ul class='todo-list'>
                <li>
                  <input type='checkbox' value=''>
                  <!-- todo text -->
                  <span class='text'>", $produto['nome'],"</span>
                  <!-- General tools such as edit or delete-->
                  <div class='tools'>
                    <i class='fa fa-edit'></i>
                    <i class='fa fa-trash-o'></i>
                  </div>
                </li>
              </ul>";
              }
              ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-success pull-right" onclick="medico()"><i class="fa fa-plus"></i> Add médico</button>
            </div>         
            <script>function medico(){location.href="medico.php"}</script>
          </div>
        </section>
      </div>
    </section>
  </div>
  
  <!-- Rodapé -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2024 <a href="https://adminlte.io">Universidade Federal do Oeste do Pará</a>.</strong>
  </footer>
  
  <div class="control-sidebar-bg"></div>
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="dist/js/demo.js"></script>

</body>
</html>