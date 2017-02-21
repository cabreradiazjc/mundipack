<?php 
  session_start();
  if (isset($_SESSION['usuario']))
  {
    $tipoUsuario = $_SESSION['usuarioTipo'];

    switch ($tipoUsuario) {
      case "1":
        header("principal/principal_admin.php");
        break;
      case "2":
        header("principal/principal_socio.php");
        break;
      case "3":
        header("principal/principal_viajero.php");
        break;
      case "4":
        header("principal/principal_operador.php");
        break;

            }
  } else {
?>

<!DOCTYPE html>
<html>
<head>
  <title>MUNDIPACK | Log in</title>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../../assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/flat-admin.css">

  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="../../assets/css/theme/blue-sky.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/theme/blue.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/theme/red.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/theme/yellow.css">

</head>
<body>
  <div class="app app-default">

<div class="app-container app-login">
  <div class="flex-center">
    <div class="app-header"></div>

    <div class="app-body">

      <div class="loader-container text-center">

          <div class="icon">
            <div class="sk-folding-cube">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
              </div>
            </div>
          <div class="title">Logging in...</div>
      </div>

      

      <div class="app-block">
      <img src="../../assets/images/logo.jpg">
      <div class="app-form">
        <div class="form-header">
          <div class="app-brand"><span class="highlight">INICIAR</span> SESIÓN</div>
        </div>

        <form action="../../controller/controlusuario/usuario.php" method="post">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">
                <i class="fa fa-user" aria-hidden="true"></i></span>
              <input type="text" class="form-control" name="param_usuUsuario" placeholder="Usuario" aria-describedby="basic-addon1" required="required">
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon2">
                <i class="fa fa-key" aria-hidden="true"></i></span>
              <input type="password" class="form-control" name="param_usuClave" placeholder="Clave" aria-describedby="basic-addon2" required="required">
            </div>
            <div class="text-center">
                <input type="hidden" value="login" name="param_opcion">
                <input type="submit" class="btn btn-success btn-submit" value="Ingresar">
            </div>
        </form>

        <!--
        <div class="form-line">
          <div class="title">OR</div>
        </div>
        <div class="form-footer">
          <button type="button" class="btn btn-default btn-sm btn-social __facebook">
            <div class="info">
              <i class="icon fa fa-facebook-official" aria-hidden="true"></i>
              <span class="title">Login with Facebook</span>
            </div>
          </button>
        </div>

        -->

      </div>
      </div>
    </div>
    <div class="app-footer">
    </div>
  </div>
</div>

  </div>
  
 <!-- <script type="text/javascript" src="../../assets/js/vendor.js"></script>
  <script type="text/javascript" src="../../assets/js/app.js"></script> -->

</body>
</html>

<?php } ?>