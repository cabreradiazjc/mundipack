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
  <title>MUNDIPACK | Socios</title>

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
        <li class="navbar-title">Tabla de Socios</li>
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
      <li> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
      Nuevo Socio
      </button></li>
    </ul>
  </div>
</div>


<!-- tABLA -->

<div class="row">

 <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Socios
        </div>
        <div class="card-body padding">
          <table class="datatable table table-striped primary" cellspacing="0" width="100%" id="socios">
            <thead>
                <tr>
                    <th style="font-size: 12px; height: 10px; width: 4%;">ID</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Nombre</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Rubro</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">RUC</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Direccion</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Telefono</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Web</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Editar</th>
                    <th style="font-size: 12px; height: 10px; width: 4%;">Eliminar</th>
                </tr>
            </thead>

            <tbody id="cuerpoTablaSocios">
               

            </tbody>
        </table>

        </div>
      </div>
    </div>
    </div>




<!-- MODAL -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Nuevo Socio</h4>
            
          </div>

        

          <div class="modal-body">

          <div id="mensaje" class="col-md-12"></div>
            <form class="form form-horizontal" method="post" id="frm_nuevoSocio" style="font-size: 12px;">
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
                  <label class="col-md-3 control-label">Rubro</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Rubro" name="param_rubro" id="param_rubro" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">RUC</label>
                  <div class="col-md-9">
                    <input type="text" maxlength="11" class="form-control" placeholder="RUC" onkeypress="return solonumeros(event)" name="param_ruc" id="param_ruc" >
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

                <!-- Telefono -->
                <div class="form-group">
                  <label class="col-md-3 control-label">Teléfono</label>
                  <div class="col-md-9">
                    <input type="tel" class="form-control" placeholder="Teléfono"  name="param_telefono" id="param_telefono">
                  </div>
                </div>

                <!-- Web -->
                <div class="form-group">
                  <label class="col-md-3 control-label">Web</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Página web"  name="param_web" id="param_web" >
                  </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label class="col-md-3 control-label">Email</label>
                  <div class="col-md-9">
                    <input type="email" class="form-control" placeholder="email@example.com" name="param_email" id="param_email" >
                  </div>
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
    <script src="../../../js/listar_socios.js"></script>
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