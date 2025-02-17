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
  <title>Admin | UPA</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="#" class="logo">
      <span class="logo-mini"><b>S</b>UPA</span>
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
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i><span class="hidden-xs"><?php echo($dadosbd['nome']) ?></span>
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
            <i class="fa fa-sign-out"></i><span>Sair</span>
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
        <li class="active">Cadastrar Paciente</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-default" style="margin-top: 10px;">
        <div class="box-header with-border">
          <h3 class="box-title">Dados do Paciente</h3>
        </div>
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
        <form id="paciente-form" method="post"><!--action="pacientebd.php"-->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label for="nome">Nome</label>
                  <input type="text" name="nome" class="form-control " style="width: 100%;" id="nome" placeholder="Nome Completo">
                </div>
                <div class="form-group">
                  <label for="end">Endereço</label>
                  <input type="text" name="endereco" id="endereco" class="form-control" placeholder="rua, av, trav,...">
                </div>
                <div class="form-group">
                  <label for="num">Número</label>
                  <input type="number" name="numero" id="numero" class="form-control" placeholder="Número">
                </div>
                <div class="form-group">
                  <label>Bairro</label>
                  <select name="bairro" id="bairro" class="form-control">
                     <optgroup label="A">
                        <option>Aparecida</option>
                        <option>Aldeia</option>
                        <option>Alvorada</option>
                        <option>Amparo Conquista</option>
                        <option>Aeroporto velho</option>
                     </optgroup>
                     <optgroup label="C">
                        <option>Centro</option>
                        <option>Caranazal</option>
                     </optgroup>
                     <optgroup label="E">
                        <option>Esperança</option>
                     </optgroup>
                     <optgroup label="F">
                        <option>Fátima</option>
                        <option>Floresta</option>
                     </optgroup>
                     <optgroup label="I">
                        <option selected>Interventoria</option>
                     </optgroup>
                     <optgroup label="J">
                        <option>Jaderlândia</option>
                        <option>Jardim Santarém</option>
                     </optgroup>
                     <optgroup label="L">
                        <option>Laguinho</option>
                     </optgroup>
                     <optgroup label="M">
                        <option>Matinha</option>
                        <option>Maracanã</option>
                        <option>Mapiri</option>
                     </optgroup>
                     <optgroup label="N">
                        <option>Nova Vitória</option>
                        <option>Nova República</option>
                     </optgroup>
                     <optgroup label="S">
                        <option>Salé</option>
                        <option>Santa Clara</option>
                        <option>Santarenzinho</option>
                     </optgroup>
                  </select>
                </div>
                <div class="form-group">
                  <label for="cid">Cidade</label>
                  <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Sua Cidade" value="SANTARÉM">
                </div>
                <div class="form-group">
                  <label for="est">Estado</label>
                  <input type="text" name="estado" id="estado" class="form-control" placeholder="Seu Estado" value="PARÁ">
                </div>
                <!--<div class="form-group">
                  <label for="nasc">Nascimento</label>
                  <input type="date" name="nasc"  id="nascimento" class="form-control">
                </div>-->
               </div>
               <div class="col-md-6">
                <div class="form-group">
                  <label for="idade">Idade</label>
                  <input type="number" name="idade" id="idade" class="form-control" placeholder="idade do paciente">
                </div>
                <div class="form-group">
                  <label for="rg">RG</label>
                  <input type="text" name="rg" id="rg" class="form-control">
                </div>
                <div class="form-group">
                  <label for="sus">Cartão SUS</label>
                  <input type="number" name="sus" class="form-control" id="sus">
                </div>
                <div class="form-group">
                  <label for="fone">Contato</label>
                  <input type="tel" name="cont" id="cont" class="form-control" placeholder="Telefone">
                </div>
                <div class="form-group">
                  <label for="mae">Mãe</label>
                  <input type="text" name="mae" class="form-control" id="mae" placeholder="Nome da Mãe">
                </div>
    
                <div class="form-group">
                  <label>Sexo</label>
                  <select name="sexo" id="sexo" class="form-control">
                     <optgroup>
                        <option>Feminino</option>
                     </optgroup>
                     <optgroup>
                        <option>Masculino</option>
                     </optgroup>
                  </select>
                </div>
                
              <div class="box-footer">
                <button type="submit" class="btn btn-success pull-right">Cadastrar</button>
              </div>
            </div>
           </div>
          </div>
        </form>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2025 <a href="https://adminlte.io">Universidade Federal do Oeste do Pará</a>.</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>

<!-- Scripts -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="paciente_register_api.js"></script>
</body>
</html>