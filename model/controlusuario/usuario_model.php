<?php 

include_once '../../model/controlusuario/conexion_model.php';

class Usuario_model{

	private $param = array();
	private $conexion = null;
	private $result = null;

	function __construct()
	{
		$this->conexion = Conexion_Model::getConexion();

	}

	function cerrarAbrir()
	{
        mysqli_close($this->conexion);
        $this->conexion = Conexion_Model::getConexion();
	}

	function gestionar($param)
	{
		$this->param = $param;		
		switch($this->param['param_opcion'])
		{
			case "login";
				echo $this->login();
				break;
			case "nuevoSocio";
				echo $this->nuevoSocio();
				break;
			case "listarUsuariosSocios";
				echo $this->listarUsuariosSocios();
				break;
			case "listarSocios";
				echo $this->listarSocios();
				break;
			case "mostrar";
				echo $this->mostrarUsuario();
				break;
			case "modificarUsuario";
				echo $this->modificarUsuario();
				break;
			case "eliminarUsuario";
				echo $this->eliminarUsuario();
				break;
		}
	}

	function prepararConsultaUsuario($opcion) 
	{
		$consultaSql = "call sp_control_usuario(";
		$consultaSql.="'".$opcion."',";
		$consultaSql.="'',";
		$consultaSql.="'".$this->param['param_usuUsuario']."',";
		$consultaSql.="'".$this->param['param_usuClave']."')";
		//echo $consultaSql;	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }


    function ejecutarConsultaRespuesta() {
        $respuesta = '';
        while ($fila = mysqli_fetch_array($this->result)) {
            $respuesta = $fila['respuesta'];
        }
        return $respuesta;
    }

	function login() 
	{
        $this->prepararConsultaUsuario('opc_login_respuesta');
        $respuesta = $this->ejecutarConsultaRespuesta();
        //echo $respuesta;
        if($respuesta == '1')
        {        	
        	$this->cerrarAbrir();
        	$this->prepararConsultaUsuario('opc_login_listar');        	
        	while($fila = mysqli_fetch_array($this->result))
        	{
				$_SESSION['idusuario'] = $fila['idusuario'];
				$_SESSION['usuario']   = $fila['usuario'];
				$_SESSION['usuarioNombre'] = $fila['nombres'];
				$_SESSION['usuarioApPaterno'] = $fila['appaterno'];
				$_SESSION['usuarioImagen'] = $fila['img'];
				$_SESSION['usuarioTipo'] = $fila['idtipo'];
				$tipo = $fila['idtipo'];
        	}
        		switch ($tipo) {
        			case "1":
        				header("Location:../../view/controlusuario/principal/principal_admin.php");
        				break;
        			case "2":
        				header("Location:../../view/controlusuario/principal/principal_socio.php");
        				break;
        			case "3":
        				header("Location:../../view/controlusuario/principal/principal_viajero.php");
        				break;
        			case "4":
        				header("Location:../../view/controlusuario/principal/principal_operador.php");
        				break;

        		}
        		
        }
        else
        {	
        	//echo "<script type=\"text/javascript\">alert(\"Usuario y/o contraseña incorrecta\");</script>";  
        	header("Location:../../view/controlusuario/login.php");

        	
    	}
    }



	function listarUsuariosSocios() {
    	$this->prepararConsultaUsuario('opc_usuarios_socios_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="font-size: 12px; height: 10px; width: 4%;">'.$row[0].'</td>					
					<td style="font-size: 12px; height: 10px; width: 20%;">'.$row[1].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[2].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[3].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[4].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[5].'</td>
					<td syle="height: 10px; width: 5%;">
					<a class="btn btn-link btn-xs col-md-offset-4"><span class="fa fa-edit" title="Editar" onclick="editar('.$row[0].');" /></span></a>
								
					</td>
					<td syle="height: 10px; width: 5%;">
						<a id="eliminar_usuario" class="btn btn-link btn-xs col-md-offset-4"><span class="fa fa-close" title="Eliminar" onclick="eliminar('.$row[0].');"/></span></a>				
					</td>					
					
				</tr>';
		}
	}

	function listarSocios() {
    	$this->prepararConsultaUsuario('opc_socios_listar');    	
    	while($row = mysqli_fetch_row($this->result)){
    		
			echo '<tr>					
					<td style="font-size: 12px; height: 10px; width: 4%;">'.$row[0].'</td>					
					<td style="font-size: 12px; height: 10px; width: 20%;">'.$row[1].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[2].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[3].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[4].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[5].'</td>
					<td style="font-size: 12px; height: 10px; width: 15%;">'.$row[6].'</td>
					<td syle="height: 10px; width: 5%;">
					<a class="btn btn-link btn-xs col-md-offset-4"><span class="fa fa-edit" title="Editar" onclick="editar('.$row[0].');" /></span></a>	
					</td>
					<td syle="height: 10px; width: 5%;">
						<a id="eliminar_usuario" class="btn btn-link btn-xs col-md-offset-4"><span class="fa fa-close" title="Eliminar" onclick="eliminar('.$row[0].');"/></span></a>				
					</td>					
					
				</tr>';
		}
	}

	function nuevoSocio() {
		$this->prepararRegistroUsuario('opc_socio_registrar');
		echo 1;
    }

     function prepararRegistroUsuario($opcion) 
	{
		$consultaSql = "call sp_gestionar_usuario(";
		$consultaSql.="'".$opcion."',";
		$consultaSql.="'".$this->param['param_nombres']."',";
		$consultaSql.="'".$this->param['param_paterno']."',";
		$consultaSql.="'".$this->param['param_materno']."',";
		$consultaSql.="'".$this->param['param_nombre']."',";
		$consultaSql.="'".$this->param['param_rubro']."',";
		$consultaSql.="'".$this->param['param_ruc']."',";
		$consultaSql.="'".$this->param['param_dni']."',";
		$consultaSql.="'".$this->param['param_direccion']."',";
		$consultaSql.="'".$this->param['param_celular']."',";
		$consultaSql.="'".$this->param['param_telefono']."',";
		$consultaSql.="'".$this->param['param_usuario']."',";
		$consultaSql.="'".$this->param['param_clave']."',";
		$consultaSql.="'".$this->param['param_web']."',";
		$consultaSql.="'".$this->param['param_email']."',";
		$consultaSql.="'".$this->param['param_id']."')";
		//echo $consultaSql;	// FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA	
		$this->result = mysqli_query($this->conexion,$consultaSql);
    }

  

	function mostrarUsuario() {
    	$this->prepararEditarUsuario('opc_usuario_mostrar');    	
    	$row = mysqli_fetch_row($this->result);
		echo json_encode($row);
		
	}



}

 ?>

