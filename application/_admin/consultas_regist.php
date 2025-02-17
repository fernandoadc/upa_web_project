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
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="administrativo.php" class="logo">
      <span class="logo-mini"><b>S</b>UPA</span>
      <span class="logo-lg"><b>Santarém</b>UPA</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
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
        <li class="active">Consultas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-xs-12">
          <div class="box" style="margin-top: 10px;">
            <div class="box-header">
              <h3 class="box-title">Tabela de Consultas</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Buscar Consulta">

                  <div class="input-group-btn">
                    <button type="submit" name="sendPesqMsg" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
     
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Paciente</th>
                  <th>Data</th>
                  <th>Médico Solicitante</th>
                  <th>Descrição do pedido médico</th>
                </tr>
                <?php                  
                   $conexao = mysqli_connect("localhost", "root", "", "db_upa");
                   $dados = mysqli_query($conexao, "SELECT * FROM consulta ORDER BY data DESC LIMIT 0, 15");
                
                   while($consulta = mysqli_fetch_array($dados)){
                     $pac = mysqli_query($conexao, "SELECT nome FROM paciente WHERE cartao_sus = $consulta[paciente_cartao_sus]");
                     $nomepac = mysqli_fetch_array($pac);
                     $med = mysqli_query($conexao, "SELECT nome FROM medico WHERE crm = $consulta[medico_crm]");
                     $nomemed = mysqli_fetch_array($med);
                echo "
                <tr>
                  <td>", $consulta['cod_consulta'], "</td>
                  <td>", $nomepac['nome'], "</td>
                  <td>", $consulta['data'], "</td>
                  <td>", $nomemed['nome'], "</td>
                  <td>", $consulta['descricao'], "</td>
                </tr>";
				   }
                ?>
              </table>
            </div>
          </div>
        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</body>
</html>