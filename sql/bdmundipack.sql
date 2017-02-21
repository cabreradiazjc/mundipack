-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2017 a las 03:10:17
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bdmundipack`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_combos`(IN `opcion` VARCHAR(100))
BEGIN
IF opcion = 'combo_empresa' THEN
      SELECT idEmpresa,nombre from empresa order by nombre asc;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_controlFactura`(IN `opcion` VARCHAR(200), IN `numero` INT, IN `nroPropio` INT, IN `fecha` DATE, IN `serie` VARCHAR(100), IN `tipo` VARCHAR(100), IN `totalBI` DOUBLE, IN `descuento` DOUBLE, IN `montoDescuento` DOUBLE, IN `descuentoPP` DOUBLE, IN `montoDescuentoPP` DOUBLE, IN `total` DOUBLE, IN `neto` DOUBLE, IN `personaID` INT, IN `clienteID` INT)
BEGIN
IF opcion = 'opc_listar' THEN
SELECT R.idregistro as FAC_num, concat(U.appaterno, ' ', U.apmaterno) as persona, H.descripcion as FAC_habitacion, R.fechaIngreso as FAC_fechaEntrada, R.fechaSalida as FAC_fechaSalida, R.total as FAC_Total 
from registro R 
inner join usuario U on R.idusuario = U.idusuario 
inner join habitacion H on R.idhabitacion = H.idhabitacion; 

end if;

IF opcion = 'opc_buscar' THEN
SELECT DR.idRegDetalle, DR.descripcion, S.tarifa
from registro_detalle DR
inner join servicios S on DR.idServicio = S.idServicio
where DR.idRegistro=numero;

end if;

IF opcion = 'opc_listarClientes' THEN
      SELECT U.idUsuario as clienteID, concat(U.appaterno, ' ', U.apmaterno,' ',U.nombres) as cliente FROM usuario U;

end if;
IF opcion = 'opc_listarProductos' THEN
SELECT S.idServicio, S.descripcion, S.tarifa from servicios S;
end if;

IF opcion = 'opc_grabar' THEN
	INSERT INTO factura_venta (FAC_nroPropio,FAC_fecha,FAC_serie,
    FAC_tipo,FAC_totalBI,FAC_descuento,FAC_montoDescuento,
    FAC_descuentoPP,FAC_montoDescuentoPP,FAC_total,FAC_igv,FAC_neto,personaID,clienteID) 
    VALUES (nroPropio,fecha,serie,tipo,totalBI,descuento,montoDescuento,
    descuentoPP,montoDescuentoPP,total,18,neto,personaID,clienteID);
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_usuario`(IN `ve_opcion` VARCHAR(50), IN `ve_usuId` INT, IN `ve_usuUsuario` VARCHAR(20), IN `ve_usuClave` VARCHAR(60))
BEGIN
if ve_opcion = 'opc_login_respuesta' then            
  SET @CORRECTO = (SELECT COUNT(*) FROM  usuario usu 
        WHERE 
          usu.usuario = ve_usuUsuario AND usu.clave = ve_usuClave);
  IF @CORRECTO>0 then
     select '1' as 'respuesta';
  ELSE
     select 'Usuario o clave incorrectos' as 'respuesta';
  END IF;
end if;  
IF ve_opcion='opc_login_listar' THEN
  select u.idusuario, u.usuario, u.nombres, u.appaterno
  from usuario u         
  where u.usuario = ve_usuUsuario and u.clave = ve_usuClave;
END IF;

IF ve_opcion='opc_listar_menu' THEN
  SELECT DISTINCT 
      men.men_id,
      men.men_idpadre,
      men.men_nombre,
      men.men_url,      
      men.men_titulo,
      men.men_estilo
    FROM usuario usu
    JOIN perfil perf  ON usu.idusuario=perf.idusuario
    JOIN rol rol      ON rol.rol_id=perf.rol_id
    JOIN permiso perm ON perm.rol_id=rol.rol_id
    JOIN menu  men    ON men.men_id=perm.men_id
    WHERE usu.idusuario=ve_usuId AND rol.rolActivo=1
    ;
END IF;

IF ve_opcion = 'opc_usuario_listar' THEN            
      SELECT idusuario, nombres, appaterno, apmaterno FROM usuario where idtipo=1;
    END IF;
  

IF ve_opcion = 'opc_huesped_listar' THEN
		SELECT idusuario, nombres, appaterno, apmaterno FROM usuario where idtipo=2;
	END IF;
    
IF ve_opcion = 'opc_habitaciones_listar' THEN
		SELECT h.idhabitacion, h.descripcion, case when h.idTipoHab=1 then 'SIMPLE' when h.idTipoHab=2 then 'DOBLE' when h.idTipoHab=3 then 'TRIPLE' when h.idTipoHab=4 then 'SUITE JUNIOR' when h.idTipoHab=5 then 'ESTÁNDAR' end as Tipo_Habitacion,  case when h.idEstado=0 then 'SIN ESTADO' when h.idEstado=1 then 'LIBRE' when h.idEstado=2 then 'OCUPADA' end as idEstado FROM habitacion h where not idTipoHab=6;
	END IF;
    
IF ve_opcion = 'opc_ambientes_listar' THEN
		SELECT h.idhabitacion, h.descripcion, case when h.idEstado=0 then 'SIN ESTADO' when h.idEstado=1 then 'LIBRE' when h.idEstado=2 then 'OCUPADA' end as idEstado FROM habitacion h where idTipoHab=6;
	END IF;
    
IF ve_opcion = 'opc_registro_listar' THEN
		SELECT r.idregistro, u.nombres, u.appaterno, u.apmaterno, h.descripcion, r.fechaIngreso, r.fechaSalida FROM registro r INNER JOIN habitacion h on h.idhabitacion = r.idhabitacion INNER JOIN usuario u on u.idusuario = r.idusuario;
	END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gestionar_usuario`(IN `opcion` VARCHAR(200), IN `nombres` VARCHAR(100), IN `paterno` VARCHAR(100), IN `materno` VARCHAR(100), IN `dni` VARCHAR(08), IN `direccion` VARCHAR(11), IN `celular` VARCHAR(100), IN `usuario` VARCHAR(100), IN `clave` VARCHAR(100), IN `empresa` INT, IN `id` INT )
BEGIN
if opcion = 'opc_usuario_respuesta' THEN            
      SET @CORRECTO = (SELECT COUNT(*) FROM  usuario usu WHERE 
              usu.usuario = usuario AND
              usu.clave = clave AND usu.dni = dni);
      IF @CORRECTO>0 then
         select '1' as 'respuesta';
      ELSE
         select '0' as 'respuesta';
    END IF;
    END IF;
    IF opcion = 'opc_usuario_registrar' THEN            
      INSERT INTO usuario (nombres, appaterno, apmaterno, dni, direccion, celular, usuario, clave) VALUES (nombres, paterno, materno, dni, direccion, celular, usuario, clave);
    END IF;
    /*IF opcion = 'opc_usuario_registrar2' THEN            
      INSERT INTO usuario( nombres, appaterno, apmaterno, dni, fecharegistro, email) VALUES (nombres, paterno, materno, dni, now(), email);
    SET @USUARIO = (SELECT MAX(idusuario) AS id FROM usuario);  
    INSERT INTO inscripcion (idusuario, fecha, idevento, certificado, pagado) VALUES (@USUARIO, now(), evento, certificado,0);
    END IF;*/
    IF opcion = 'opc_usuario_modificar' THEN            
      UPDATE usuario SET nombres = nombres, appaterno = paterno, apmaterno = materno, dni = dni ,direccion=direccion, celular=celular, usuario=usuario, clave=clave WHERE idusuario = id;
    END IF;
    IF opcion = 'opc_usuario_eliminar' THEN            
      DELETE FROM usuario WHERE idusuario = id;
    END IF;

   IF opcion = 'opc_usuario_registrar1' THEN  
		INSERT INTO usuario(nombres, appaterno, apmaterno, dni, direccion, celular, usuario, clave, idtipo) VALUES (nombres, paterno, materno, dni, direccion,celular, usuario, clave, '1');
    END IF;

   IF opcion = 'opc_usuario_registrar2' THEN  
		INSERT INTO usuario(nombres, appaterno, apmaterno, dni, direccion, celular, usuario, clave, idtipo, idEmpresa) VALUES (nombres, paterno, materno, dni, direccion,celular, usuario, clave, '2', empresa);
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mostrar_usuario`(IN `opcion` VARCHAR(200), IN `id` INT)
BEGIN
IF opcion = 'opc_usuario_mostrar' THEN            
      SELECT u.idusuario, u.nombres, u.appaterno, u.apmaterno, u.dni FROM usuario u;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` mediumtext CHARACTER SET latin1,
  `ruc` char(11) CHARACTER SET latin1 DEFAULT NULL,
  `direccion` mediumtext CHARACTER SET latin1,
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idEmpresa`, `nombre`, `ruc`, `direccion`) VALUES
(1, 'CONSERMET S.A.C.', '12345678901', 'Evitamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `idEstado` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idEstado`, `descripcion`) VALUES
(0, 'Sin Estado'),
(1, 'Libre'),
(2, 'Ocupada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE IF NOT EXISTS `habitacion` (
  `idhabitacion` int(11) NOT NULL,
  `descripcion` varchar(32) DEFAULT NULL,
  `idTipoHab` int(11) NOT NULL,
  `idEstado` int(1) NOT NULL,
  `tarifa` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idhabitacion`),
  KEY `idTipoHab` (`idTipoHab`),
  KEY `idEstado` (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`idhabitacion`, `descripcion`, `idTipoHab`, `idEstado`, `tarifa`) VALUES
(1, 'Cochera', 7, 1, '0'),
(2, 'Lavandería', 7, 1, '0'),
(3, 'Desayuno', 7, 1, '0'),
(4, 'Consumo', 7, 1, '0'),
(100, 'Sala 1', 6, 1, '0'),
(101, 'Cochera', 6, 1, '0'),
(102, 'Sala 2', 6, 1, '0'),
(103, 'Almacén', 6, 0, '0'),
(104, 'Comedor', 6, 0, '0'),
(105, 'Cocina', 6, 0, '0'),
(201, 'Habitación 201 - Segundo Piso', 1, 1, '0'),
(202, 'Habitación 202 - Segundo Piso', 4, 0, '0'),
(203, 'Habitación 203 - Segundo Piso', 2, 0, '0'),
(204, 'Habitación 204 - Segundo Piso', 2, 0, '0'),
(205, 'Habitación 205 - Segundo Piso', 1, 0, '0'),
(301, 'Habitación 301 - Tercer Piso', 1, 0, '0'),
(302, 'Habitación 302 - Tercer Piso', 1, 0, '0'),
(303, 'Habitación 303 - Tercer Piso', 1, 0, '0'),
(304, 'Habitación 304 - Tercer Piso', 2, 0, '0'),
(305, 'Habitación 305 - Tercer Piso', 1, 2, '0'),
(401, 'Habitación 401 - Cuarto Piso', 1, 0, '0'),
(402, 'Habitación 402 - Cuarto Piso', 3, 0, '0'),
(403, 'Habitación 403 - Cuarto Piso', 2, 0, '0'),
(404, 'Habitación 404 - Cuarto Piso', 1, 0, '0'),
(405, 'Habitación 405 - Cuarto Piso', 1, 0, '0'),
(501, 'Cuarto de Trabajadores', 6, 0, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `men_id` int(11) NOT NULL,
  `men_idpadre` int(11) DEFAULT NULL,
  `men_nombre` varchar(100) DEFAULT NULL,
  `men_url` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `men_titulo` varchar(100) DEFAULT NULL,
  `men_estilo` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `men_estado` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`men_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`men_id`, `men_idpadre`, `men_nombre`, `men_url`, `men_titulo`, `men_estilo`, `men_estado`) VALUES
(1, NULL, 'Dashboard', '', 'Dashboard', 'fa-tachometer', 1),
(2, 1, 'VerTablero', '../../view/operaciones/principal.php', 'Ver Tablero', 'fa-tachometer', 1),
(3, NULL, 'Funciones_Administrador', NULL, 'Administrador', 'fa-user', 1),
(4, 3, 'Listar_Socios', '../../view/operaciones/listar_socios.php', 'Listar socios', 'fa-tasks', 1),
(5, 3, 'Listar_Viajeros', '../../view/operaciones/listar_viajeros.php', 'Listar viajeros', 'fa-suitcase', 0),
(6, NULL, 'Gestión_Financiera', NULL, 'Gestión Financiera', 'fa-money', 0),
(7, 6, 'Depositos_Viajeros', '../../view/operaciones/listar_depositosV.php', 'Depósitos de viajeros', 'fa-paper-plane-o', 1),
(8, 6, 'PorcentajeConsumos', '../../view/operaciones/porcentaje_consumos.php', 'Porcentaje de Consumos', 'fa-percent', 1),
(9, NULL, 'GestionUsuarios', NULL, 'Gestión de Usuarios', 'fa-users', 1),
(10, 9, 'VerPermisos', '../../view/operaciones/permisos_usuarios.php', 'Ver Permisos de Usuario', 'fa-circle-o-notch', 1),
(11, 9, 'NuevoSocio', '../../view/operaciones/nuevo_socio.php', 'Nuevo Socio', 'fa-male', 1),
(12, 9, 'NuevoViajero', '../../view/operaciones/nuevo_viajero.php', 'Nuevo Viajero', 'fa-map', 1),
(13, NULL, 'Viaje', NULL, 'Viaje', 'fa-plane', 1),
(14, 13, 'Paquetes', '../../view/operaciones/paquetes.php', 'Paquetes de Viaje', 'fa-paper-plane', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `rol_id` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  KEY `FK_perfil_rol` (`rol_id`),
  KEY `FK_perfil_usuario1` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`rol_id`, `idusuario`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
  `rol_id` int(11) NOT NULL,
  `men_id` int(11) NOT NULL,
  KEY `FK_permiso_menu1` (`men_id`),
  KEY `FK_permiso_rol` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`rol_id`, `men_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE IF NOT EXISTS `registro` (
  `idregistro` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `idhabitacion` int(11) DEFAULT NULL,
  `fechaIngreso` datetime DEFAULT NULL,
  `fechaSalida` datetime DEFAULT NULL,
  `total` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idregistro`),
  KEY `FK_registro_habitacion` (`idhabitacion`),
  KEY `FK_registro_usuario` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`idregistro`, `idusuario`, `idhabitacion`, `fechaIngreso`, `fechaSalida`, `total`) VALUES
(1, 3, 201, '2016-10-04 00:00:00', '2016-10-07 00:00:00', '65');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_detalle`
--

CREATE TABLE IF NOT EXISTS `registro_detalle` (
  `idRegDetalle` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `idRegistro` int(11) NOT NULL,
  PRIMARY KEY (`idRegDetalle`),
  KEY `idServicio` (`idservicio`),
  KEY `idRegistro` (`idRegistro`),
  KEY `idhabitacion` (`idservicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `registro_detalle`
--

INSERT INTO `registro_detalle` (`idRegDetalle`, `descripcion`, `idservicio`, `idRegistro`) VALUES
(1, 'Servicio de Cochera', 1, 1),
(2, 'Servicio de Lavanderia', 2, 1),
(3, 'Habitación Simple', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(50) DEFAULT NULL,
  `rolActivo` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`, `rolActivo`) VALUES
(1, 'Administrador', 1),
(2, 'Socio', 1),
(3, 'Viajero', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
  `idServicio` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `tarifa` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idServicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`idServicio`, `descripcion`, `tarifa`) VALUES
(1, 'Cochera', '0'),
(2, 'Lavandería', '5'),
(3, 'Desayuno', '5'),
(4, 'Taxi de llegada', '0'),
(5, 'Taxi de salida', '0'),
(6, 'Consumo', '0'),
(7, 'Habitación Simple', '60'),
(8, 'Habitación Doble', '80'),
(9, 'Habitación Triple', '100'),
(10, 'Suite Junior', '140'),
(11, 'Habitación Estandar', '85');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE IF NOT EXISTS `tipo_habitacion` (
  `idTipoHab` int(11) NOT NULL AUTO_INCREMENT,
  `descripcionTipoHab` varchar(20) NOT NULL,
  PRIMARY KEY (`idTipoHab`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`idTipoHab`, `descripcionTipoHab`) VALUES
(1, 'Simple'),
(2, 'Doble'),
(3, 'Triple'),
(4, 'Suite Junior'),
(5, 'Estándar'),
(6, 'Ambiente'),
(7, 'Servicio'),
(8, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idtipo`, `descripcion`) VALUES
(1, 'Empleado'),
(2, 'Huesped');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) DEFAULT NULL,
  `appaterno` varchar(50) DEFAULT NULL,
  `apmaterno` varchar(50) DEFAULT NULL,
  `dni` varchar(15) DEFAULT NULL,
  `direccion` text,
  `celular` varchar(15) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `idtipo` int(11) DEFAULT NULL,
  `idEmpresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `FK_usuario_empresa` (`idEmpresa`),
  KEY `FK_usuario_tipo_usuario` (`idtipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombres`, `appaterno`, `apmaterno`, `dni`, `direccion`, `celular`, `usuario`, `clave`, `idtipo`, `idEmpresa`) VALUES
(1, 'Juan Carlos', 'Cabrera', 'Díaz', '72543150', 'Trujillo', '963335717', 'admin', '123123', 1, NULL),
(2, 'Nombre', 'Paterno', 'Materno', '72543150', 'direccion', 'celular', 'usuario', 'clave', 1, NULL),
(3, 'Huesped', 'Echevarria', 'Pinedo', NULL, NULL, NULL, NULL, NULL, 2, NULL),
(5, '11', '11', '11', '11', '11', '11', '11', '11', 1, NULL),
(9, 'Olinda', 'Goicochea', 'Mauricio', '75694930', 'Av. 28 de Julio 703', '993011793', '', '', 2, 1),
(19, '', '', '', '', '', '', '', '', 2, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`idTipoHab`) REFERENCES `tipo_habitacion` (`idTipoHab`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `habitacion_ibfk_2` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `FK_perfil_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_perfil_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `FK_permiso_menu` FOREIGN KEY (`men_id`) REFERENCES `menu` (`men_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_permiso_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `FK_registro_habitacion` FOREIGN KEY (`idhabitacion`) REFERENCES `habitacion` (`idhabitacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_registro_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registro_detalle`
--
ALTER TABLE `registro_detalle`
  ADD CONSTRAINT `registro_detalle_ibfk_1` FOREIGN KEY (`idservicio`) REFERENCES `servicios` (`idServicio`),
  ADD CONSTRAINT `registro_detalle_ibfk_2` FOREIGN KEY (`idRegistro`) REFERENCES `registro` (`idregistro`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_usuario_empresa` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_usuario_tipo_usuario` FOREIGN KEY (`idtipo`) REFERENCES `tipo_usuario` (`idtipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
