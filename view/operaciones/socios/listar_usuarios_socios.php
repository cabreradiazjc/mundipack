<?php 
  session_start();
  if (!isset($_SESSION['usuario']))
  {
    header("Location:view/controlusuario/login.php");
  } else {
?>

<!DOCTYPE html>
<html>
<head>
  <title>MUNDIPACK | Usuarios - Socios</title>

  <meta http-equiv="Content-Type" content="IE=Edge; chrome=1"> 
  <meta charset="UTF-8"">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../../../assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/flat-admin.css">

  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="../../../assets/css/theme/blue-sky.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/theme/blue.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/theme/red.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/theme/yellow.css">

</head>
<body>
  <div class="app app-default">

<aside class="app-sidebar" id="sidebar">
  <div class="sidebar-header">
    <a class="sidebar-brand" href="../../controlusuario/principal/principal_admin.php"><span class="highlight">MUNDI</span>PACK</a>
    <button type="button" class="sidebar-toggle">
      <i class="fa fa-times"></i>
    </button>
  </div>


<!-- Sidebar Menu -->


  <div class="sidebar-menu" id="tree">


<!-- Sidebar Menu 

  <div class="sidebar-menu">
    <ul class="sidebar-nav">
      <li class="active">
        <a href="./principal.php">
          <div class="icon">
            <i class="fa fa-tasks" aria-hidden="true"></i>
          </div>
          <div class="title">Dashboard</div>
        </a>
      </li>
      <li class="@@menu.messaging">
        <a href="./messaging.html">
          <div class="icon">
            <i class="fa fa-comments" aria-hidden="true"></i>
          </div>
          <div class="title">Messaging</div>
        </a>
      </li>
      <li class="dropdown ">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <div class="icon">
            <i class="fa fa-check" aria-hidden="true"></i>
          </div>
          <div class="title">UI Kits</div>
        </a>
        <div class="dropdown-menu">
          <ul>
            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> UI Kits</li>
            <li><a href="./uikits/customize.html">Customize</a></li>
            <li><a href="./uikits/components.html">Components</a></li>
            <li><a href="./uikits/card.html">Card</a></li>
            <li><a href="./uikits/form.html">Form</a></li>
            <li><a href="./uikits/table.html">Table</a></li>
            <li><a href="./uikits/icons.html">Icons</a></li>
            <li class="line"></li>
            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Advanced Components</li>
            <li><a href="./uikits/pricing-table.html">Pricing Table</a></li>
            <li><a href="./uikits/timeline.html">Timeline</a></li>
            <li><a href="./uikits/chart.html">Chart</a></li>
          </ul>
        </div>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <div class="icon">
            <i class="fa fa-file-o" aria-hidden="true"></i>
          </div>
          <div class="title">Pages</div>
        </a>
        <div class="dropdown-menu">
          <ul>
            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Admin</li>
            <li><a href="./pages/form.html">Form</a></li>
            <li><a href="./pages/profile.html">Profile</a></li>
            <li><a href="./pages/search.html">Search</a></li>
            <li class="line"></li>
            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Landing</li>
            <li><a href="./pages/landing.html">Landing</a></li>
            <li><a href="./pages/login.html">Login</a></li>
            <li><a href="./pages/register.html">Register</a></li>
            <li><a href="./pages/404.html">404</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>

-->

  </div>

<!-- Fin de SideBar Menú -->



  <div class="sidebar-footer">
    <ul class="menu">
      <li>
        <a href="/" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-cogs" aria-hidden="true"></i>
        </a>
      </li>
      <li><a href="#"><span class="flag-icon flag-icon-pe flag-icon-squared"></span></a></li>
    </ul>
  </div>
</aside>

<script type="text/ng-template" id="sidebar-dropdown.tpl.html">
  <div class="dropdown-background">
    <div class="bg"></div>
  </div>
  <div class="dropdown-container">
    {{list}}
  </div>
</script>


<div class="app-container">


<!-- Barra Superior -->
<nav class="navbar navbar-default" id="navbar">
  <div class="container-fluid">
    <div class="navbar-collapse collapse in">
      <ul class="nav navbar-nav navbar-mobile">
        <li>
          <button type="button" class="sidebar-toggle">
            <i class="fa fa-bars"></i>
          </button>
        </li>
        <li class="logo">
          <a class="navbar-brand" href="#"><span class="highlight">MUNDI</span>PACK</a>
        </li>
        <li>
          <button type="button" class="navbar-toggle">
            <img class="profile-img" src="../../../assets/images/profile.jpg">
          </button>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li class="navbar-title">Datos de Usuarios de Socios</li>
        <!-- Search 
        <li class="navbar-search hidden-sm">
          <input id="search" type="text" placeholder="Search..">
          <button class="btn-search"><i class="fa fa-search"></i></button>
        </li> -->
      </ul>

      
      <!-- Menús despegables -->

      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown profile">
          <a href="/html/pages/profile.html" class="dropdown-toggle"  data-toggle="dropdown">
            <img class="profile-img" src="../../controlusuario/guardar/<?php echo $_SESSION['usuarioImagen'];?>" >
            <div class="title">Profile</div>
          </a>
          <div class="dropdown-menu">
            <div class="profile-info">
              <h4 class="username"><?php echo $_SESSION['usuarioNombre'];?></h4>
            </div>
            <ul class="action">
              <li>
                <a href="../../controlusuario/cuenta/cuenta_admin.php">
                  Cuenta
                </a>
              </li>
              <li>
                <a href="../../../view/controlusuario/logout.php">
                  Salir
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <div class="btn-floating" id="help-actions">
  <div class="btn-bg"></div>
  <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions">
    <i class="icon fa fa-plus"></i>
    <span class="help-text">Shortcut</span>
  </button>
  <div class="toggle-content">
    <ul class="actions">
      <li> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalUSocio">
      Nuevo Usuario de Socio
      </button></li>
    </ul>
  </div>
</div>

<!-- Gráfico
<div class="row">
  <div class="col-xs-12">
    <div class="card card-banner card-chart card-green no-br">
      <div class="card-header">
        <div class="card-title">
          <div class="title">Top Sale Today</div>
        </div>
        <ul class="card-action">
          <li>
            <a href="/">
              <i class="fa fa-refresh"></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="ct-chart-sale"></div>
      </div>
    </div>
  </div>
</div>

-->

<div class="row">

 <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Usuarios de Socios
        </div>
        <div class="card-body padding">

          <table class="datatable table table-striped primary" cellspacing="0" width="100%" id="uSocios">
            <thead>
                <tr>
                    <th style="font-size: 12px; height: 10px; width: 4%;">ID</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Nombres</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Apellidos</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Email</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Celular</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Socio</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Editar</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Eliminar</th>
                </tr>
            </thead>

            <tbody id="cuerpoUSocios">
               

            </tbody>
        </table>

        </div>
      </div>
    </div>
    </div>


<!-- MODAL -->

    <div class="modal fade" id="myModalUSocio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Nuevo Usuario de Socio</h4>
            
          </div>

        

          <div class="modal-body">

          <div id="mensaje" class="col-md-12"></div>

            <form class="form form-horizontal" method="post" id="frm_nuevoUSocio" style="font-size: 12px;">
            <div class="section">
              <!-- <div class="section-title">Datos Personales</div> -->
              <div class="section-body">

                <!-- Nombres -->
                <div class="form-group">
                  <label class="col-md-3 control-label">Nombre</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Establecimiento" name="param_nombre" id="param_nombre" >
                  </div>
                </div>

                <!-- Apellidos -->
                <div class="form-group">
                  <label class="col-md-3 control-label">Apellido Paterno</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Rubro" name="param_rubro" id="param_rubro" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Apellido Materno</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Rubro" name="param_rubro" id="param_rubro" >
                  </div>
                </div>

                <!-- Radio Button Sexo -->
                <div class="form-group">
                  <label class="col-md-3 control-label">Sexo</label>
                  <div class="col-md-9">
                    <div class="radio radio-inline">
                        <input type="radio" name="radio4" id="radio10" value="option10">
                        <label for="radio10">
                          Masculino
                        </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" name="radio4" id="radio11" value="option11" checked>
                        <label for="radio11">
                          Femenino
                        </label>
                    </div>
                  </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label class="col-md-3 control-label">Email</label>
                  <div class="col-md-9">
                    <input type="email" class="form-control" placeholder="email@example.com" name="param_email" id="param_email" >
                  </div>
                </div>

                 <!-- Telefono -->
                <div class="form-group">
                  <label class="col-md-3 control-label">Celular</label>
                  <div class="col-md-9">
                    <input type="tel" class="form-control" placeholder="Teléfono"  name="param_telefono" id="param_telefono">
                  </div>
                </div>

                <!-- Dirección -->
                <div class="form-group">
                  <div class="col-md-3">
                    <label class="control-label">Dirección</label>
                    <p class="control-label-help">(Calle/Urbanización/Oficina/Distrito)</p>
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control"  name="param_direccion" id="param_direccion" ></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">DNI / C.E.</label>
                  <div class="col-md-9">
                    <input type="text" maxlength="11" class="form-control" placeholder="RUC" name="param_ruc" id="param_ruc" >
                  </div>
                </div>

                <!-- Usuario -->
                <div class="form-group">
                  <label class="col-md-3 control-label">Usuario</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Página web"  name="param_web" id="param_web" >
                  </div>
                </div>

                <!-- Clave -->
                <div class="form-group">
                  <label class="col-md-3 control-label">Clave</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Página web"  name="param_web" id="param_web" >
                  </div>
                </div>

                <!-- Socios -->
                <div class= "form-group">
                <label class="col-md-3 control-label">Socio</label>
                <select class="selectSocio">
                  <option value="AL">Alabama</option>
                  <option value="WY">Wyoming</option>
                </select>
                </div>




            <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-sm btn-success" id="nuevoSocio">Guardar</button>
          </div>
            </form>


          </div>
         
        </div>
      </div>
    </div>


  <footer class="app-footer"> 
  <div class="row">
    <div class="col-xs-12">
      <div class="footer-copyright">
        SodaTech+ © 2017  MUNDIPACK
      </div>
    </div>
  </div>
</footer>
</div>

  </div>
  
     <!-- JS de la aplicación -->
  
    <script type="text/javascript" src="../../../assets/js/vendor.js"></script>
    <script type="text/javascript" src="../../../assets/js/app.js"></script> 


    <!-- JS creados -->

    <script src="../../../js/treemodulo.js"></script>
    <script src="../../../js/listar_usuarios_socios.js"></script>
    <script src="../../../js/operaciones_registro.js"></script>


    <!--Validaciones -->
  
    <script type="text/javascript">
      
      function solonumeros(e) {

            e = (e) ? e : window.event;
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

    </script>



</body>
</html>

<?php } ?>