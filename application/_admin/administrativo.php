<?php
#error_reporting(E_ALL);
#ini_set('display_errors', 1);
session_start();
include_once "../database.php";
#if(isset($_SESSION['login']) && !empty($_SESSION['login'])){
#  echo "Usuário logado: " . $_SESSION['login'];
#} else {
#  echo "Usuário não está logado!";
#}
  if(!empty($_SESSION['login'])){
    $dados = mysqli_query($dbcon, "SELECT nome FROM usuario WHERE matricula = $_SESSION[login]");
    $dadosbd = mysqli_fetch_assoc($dados);
    
    $countpac = mysqli_query($dbcon, "SELECT count(*) from paciente");
    $resulpac = mysqli_fetch_assoc($countpac);
    $countmed = mysqli_query($dbcon, "SELECT count(*) from medico");
    $resulmed = mysqli_fetch_assoc($countmed);
    $countcon = mysqli_query($dbcon, "SELECT count(*) from consulta");
    $resulcon = mysqli_fetch_assoc($countcon);
    echo "
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Admin | UPA</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link rel='stylesheet' href='bower_components/bootstrap/dist/css/bootstrap.min.css'>
  <link rel='stylesheet' href='bower_components/font-awesome/css/font-awesome.min.css'>
  <link rel='stylesheet' href='bower_components/Ionicons/css/ionicons.min.css'>
  <link rel='stylesheet' href='dist/css/AdminLTE.min.css'>
  <link rel='stylesheet' href='dist/css/skins/_all-skins.min.css'>
  <link rel='stylesheet' href='bower_components/morris.js/morris.css'>
  <link rel='stylesheet' href='bower_components/jvectormap/jquery-jvectormap.css'>
  <link rel='stylesheet' href='bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'>
  <link rel='stylesheet' href='bower_components/bootstrap-daterangepicker/daterangepicker.css'>
  <link rel='stylesheet' href='plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'>

  <!-- Google Font -->
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic'>
</head>
<body class='hold-transition skin-blue sidebar-mini'>
<div class='wrapper'>

  <header class='main-header'>
    <!-- Logo -->
    <a href='#' class='logo'>
      <span class='logo-mini'><b>S</b>UP</span>
      <span class='logo-lg'><b>Santarém</b>UPA</span>
    </a>

    <nav class='navbar navbar-static-top'>

      <a href='#' class='sidebar-toggle' data-toggle='push-menu' role='button'>
        <span class='sr-only'>Toggle navigation</span>
      </a>

      <div class='navbar-custom-menu'>
        <ul class='nav navbar-nav'>
          <li class=' dropdown user user-menu'>
            <a href='#' class='dropdown-toggle' data-toggle=' dropdown'>
              <i class='fa fa-user'></i><span class='hidden-xs'>", $dadosbd['nome'],"</span>
            </a>
          </li>
          <li>
            <a href='../logout.php'><i class='fa fa-sign-out'></i><span class='hidden-xs'>Sair</span></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class='main-sidebar'>
    <section class='sidebar'>
      <ul class='sidebar-menu' data-widget='tree'>
        <li class='header'>NAVEGAÇÃO</li>
        <li>
          <a href='administrativo.php'>
            <i class='fa fa-home'></i> <span>Home</span>
          </a>
        </li>
        <li>
          <a href='paciente.php'>
            <i class='fa fa-user-plus'></i>
            <span>Cadastrar Paciente</span>
          </a>
        </li>
        <li>
          <a href='medico.php'>
            <i class='fa fa-user-md'></i>
            <span>Cadastrar Médico</span>
          </a>
        </li>
        <li>
          <a href='consulta.php'>
            <i class='fa fa-medkit'></i>
            <span>Realizar Consulta</span>
          </a>
        </li>
        <li>
          <a href='../logout.php'>
            <i class='fa fa-sign-out'></i> <span>Sair</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>

  <div class='content-wrapper'>

    <section class='content'>

      <div class='row'>
      
        <div class='col-lg-3 col-xs-6'>
          <div class='small-box bg-aqua'>
            <div class='inner'>
              <h3>", $resulpac['count(*)'] ,"</h3>

              <p>Pacientes Registrados</p>
            </div>
            <div class='icon'>
              <i class='fa fa-user'></i>
            </div>
            <a href='pacientes_regist.php' class='small-box-footer'>Ver pacientes <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        
        <div class='col-lg-3 col-xs-6'>
          <div class='small-box bg-aqua'>
            <div class='inner'>
              <h3>", $resulcon['count(*)'], "<sup style='font-size: 20px'></sup></h3>

              <p>Consultas Registradas</p>
            </div>
            <div class='icon'>
              <i class='ion ion-clipboard'></i>
            </div>
            <a href='consultas_regist.php' class='small-box-footer'>Ver consultas <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>

        <div class='col-lg-3 col-xs-6'>
          <div class='small-box bg-aqua'>
            <div class='inner'>
              <h3>", $resulmed['count(*)'], "</h3>
              
              <p>Médicos Registrados</p>
            </div>
            <div class='icon'>
              <i class='fa fa-user-md'></i>
            </div>
            <a href='medicos_regist.php' class='small-box-footer'>Ver médicos <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        
        <div class='col-lg-3 col-xs-6'>
          <div class='small-box bg-aqua'>
            <div class='inner'>
              <h3>", $resulcon['count(*)'],"</h3>

              <p>Consultas Realizadas</p>
            </div>
            <div class='icon'>
              <i class='fa fa-medkit'></i>
            </div>
            <a href='#' class='small-box-footer'>Total de consultas</a>
          </div>
        </div>
      </div>

    </section>
  </div>

  <footer class='main-footer'>
    <div class='pull-right hidden-xs'>
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2024 <a href='https://adminlte.io'>Universidade Federal do Oeste do Pará</a>.</strong>
  </footer>

  <div class='control-sidebar-bg'></div>
</div>

<script src='bower_components/jquery/dist/jquery.min.js'></script>
<script src='bower_components/jquery-ui/jquery-ui.min.js'></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src='bower_components/bootstrap/dist/js/bootstrap.min.js'></script>
<script src='bower_components/raphael/raphael.min.js'></script>
<script src='bower_components/morris.js/morris.min.js'></script>
<script src='bower_components/jquery-sparkline/dist/jquery.sparkline.min.js'></script>
<script src='plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script src='plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
<script src='bower_components/jquery-knob/dist/jquery.knob.min.js'></script>
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/bootstrap-daterangepicker/daterangepicker.js'></script>
<script src='bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'></script>
<script src='plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'></script>
<script src='bower_components/jquery-slimscroll/jquery.slimscroll.min.js'></script>
<script src='bower_components/fastclick/lib/fastclick.js'></script>
<script src='dist/js/adminlte.min.js'></script>
<script src='dist/js/pages/dashboard.js'></script>
<script src='dist/js/demo.js'></script>
</body>
</html>
";
  }else{
    $_SESSION['msg'] = "Necessário autenticar-se!!! ";
    header("Location: ../index.php");
  }