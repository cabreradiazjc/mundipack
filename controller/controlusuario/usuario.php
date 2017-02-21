<?php 
session_start();
include_once '../../model/controlusuario/usuario_model.php';

$param = array();
$param['param_opcion']='';
$param['param_usuId']=0;
$param['param_usuUsuario']='';
$param['param_usuClave']='';
$param['param_usuEstado'] = 1;
$param['param_dni'] = '';
$param['param_paterno'] = '';
$param['param_materno'] = '';
$param['param_nombres'] = '';
$param['param_celular'] = '';
$param['param_email'] = '';
$param['param_institucion'] = '';
$param['param_otra_institucion'] = '';
$param['param_usuario'] = '';
$param['param_clave'] = '';
$param['param_id'] = '';
$param['param_id2'] = '';
$param['param_evento'] = '';
$param['param_certificado'] = '';

if (isset($_SESSION['usuarioId']))
    $param['param_usuId'] = $_SESSION['usuarioId'];
    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if (isset($_POST['param_usuId']))
    $param['param_usuId'] = $_POST['param_usuId'];

if (isset($_POST['param_usuUsuario']))
    $param['param_usuUsuario'] = $_POST['param_usuUsuario'];

if (isset($_POST['param_usuClave']))
    $param['param_usuClave'] = $_POST['param_usuClave'];

//Socios
if (isset($_POST['param_dni']))
    $param['param_dni'] = $_POST['param_dni'];

if (isset($_POST['param_rubro']))
    $param['param_rubro'] = $_POST['param_rubro'];

if (isset($_POST['param_ruc']))
    $param['param_ruc'] = $_POST['param_ruc'];

if (isset($_POST['param_nombre']))
    $param['param_nombre'] = $_POST['param_nombre'];

if (isset($_POST['param_direccion']))
    $param['param_direccion'] = $_POST['param_direccion'];

if (isset($_POST['param_telefono']))
    $param['param_telefono'] = $_POST['param_telefono'];

if (isset($_POST['param_web']))
    $param['param_web'] = $_POST['param_web'];


//FIn Socios


if (isset($_POST['param_paterno']))
    $param['param_paterno'] = $_POST['param_paterno'];

if (isset($_POST['param_materno']))
    $param['param_materno'] = $_POST['param_materno'];

if (isset($_POST['param_nombres']))
    $param['param_nombres'] = $_POST['param_nombres'];

if (isset($_POST['param_email']))
    $param['param_email'] = $_POST['param_email'];

if (isset($_POST['param_celular']))
    $param['param_celular'] = $_POST['param_celular'];

if (isset($_POST['param_institucion']))
    $param['param_institucion'] = $_POST['param_institucion'];

if (isset($_POST['param_otro_institucion']))
    $param['param_otra_institucion'] = $_POST['param_otro_institucion'];

if (isset($_POST['param_usuario']))
    $param['param_usuario'] = $_POST['param_usuario'];

if (isset($_POST['param_clave']))
    $param['param_clave'] = $_POST['param_clave'];  

if (isset($_POST['param_evento']))
    $param['param_evento'] = $_POST['param_evento'];  

if (isset($_POST['param_certificado']))
    $param['param_certificado'] = $_POST['param_certificado'];  

if (isset($_POST['id']))
    $param['param_id'] = $_POST['id'];

if (isset($_POST['param_id']))
    $param['param_id2'] = $_POST['param_id'];

if (isset($_POST['id']))
    $param['param_id2'] = $_POST['id'];

if (isset($_POST['param_usuEstado'])) {
    if ($_POST['param_usuEstado'] == 'true')
        $param['param_usuEstado'] = '1';
    if ($_POST['param_usuEstado'] == 'false')
        $param['param_usuEstado'] = '0';

}

$Usuario = new Usuario_model();
echo $Usuario->gestionar($param);


 ?>