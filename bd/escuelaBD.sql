-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-09-2020 a las 13:30:24
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `escuela`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_admin`
--

DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE IF NOT EXISTS `t_admin` (
  `id_administrador` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `cargo` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_administrador`),
  KEY `fk_id_usuario_idx` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `t_admin`
--

INSERT INTO `t_admin` (`id_administrador`, `id_usuario`, `cargo`) VALUES
(1, 1, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_archivos`
--

DROP TABLE IF EXISTS `t_archivos`;
CREATE TABLE IF NOT EXISTS `t_archivos` (
  `id_archivos` int(11) NOT NULL AUTO_INCREMENT,
  `id_proyecto` int(11) DEFAULT NULL,
  `id_actividad` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `extension` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nombre_original` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_archivos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_area_aplicacion`
--

DROP TABLE IF EXISTS `t_area_aplicacion`;
CREATE TABLE IF NOT EXISTS `t_area_aplicacion` (
  `id_area_aplicacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_asignatura` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `aportacion` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nodo_problema` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_area_aplicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_asesor`
--

DROP TABLE IF EXISTS `t_asesor`;
CREATE TABLE IF NOT EXISTS `t_asesor` (
  `id_asesor` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `no_empleado` int(11) DEFAULT NULL,
  `grado_estudios` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_asesor`),
  KEY `fk_id_usuario_idx` (`id_usuario`),
  KEY `fk_id_carrera_idx` (`id_carrera`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_asignatura`
--

DROP TABLE IF EXISTS `t_asignatura`;
CREATE TABLE IF NOT EXISTS `t_asignatura` (
  `id_asignatura` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat_carrera` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `creditos` int(11) DEFAULT NULL,
  `competencia_asignada` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_asignatura`),
  KEY `fk_id_cat_carrera_idx` (`id_cat_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_asignatura_competencia`
--

DROP TABLE IF EXISTS `t_asignatura_competencia`;
CREATE TABLE IF NOT EXISTS `t_asignatura_competencia` (
  `id_asignatura_competencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_competencia` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_asignatura_competencia`),
  KEY `fk_id_competencia_idx` (`id_competencia`),
  KEY `fk_id_asignatura_idx` (`id_asignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_asignatura_estudiante`
--

DROP TABLE IF EXISTS `t_asignatura_estudiante`;
CREATE TABLE IF NOT EXISTS `t_asignatura_estudiante` (
  `id_asignatura_estudiante` int(11) NOT NULL AUTO_INCREMENT,
  `id_asignatura` int(11) DEFAULT NULL,
  `id_estudiante` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_asignatura_estudiante`),
  KEY `fk_id_asignatura_idx` (`id_asignatura`),
  KEY `fk_id_estudiante_idx` (`id_estudiante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_carrera_especialidad`
--

DROP TABLE IF EXISTS `t_carrera_especialidad`;
CREATE TABLE IF NOT EXISTS `t_carrera_especialidad` (
  `id_carrera_especialidad` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrera` int(11) DEFAULT NULL,
  `id_especialidad` int(11) DEFAULT NULL,
  `id_estudiante` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_carrera_especialidad`),
  KEY `fk_id_carrera_idx` (`id_carrera`),
  KEY `fk_id_especialidad_idx` (`id_especialidad`),
  KEY `fk_id_estudiante_idx` (`id_estudiante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cat_carrera`
--

DROP TABLE IF EXISTS `t_cat_carrera`;
CREATE TABLE IF NOT EXISTS `t_cat_carrera` (
  `id_carrera` int(11) NOT NULL AUTO_INCREMENT,
  `clave` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_carrera`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `t_cat_carrera`
--

INSERT INTO `t_cat_carrera` (`id_carrera`, `clave`, `nombre`) VALUES
(22, 124, 'Electronica'),
(24, 123, 'Civil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cat_especialidad`
--

DROP TABLE IF EXISTS `t_cat_especialidad`;
CREATE TABLE IF NOT EXISTS `t_cat_especialidad` (
  `id_especialidad` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrera` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `periodo_vigencia` date DEFAULT NULL,
  PRIMARY KEY (`id_especialidad`),
  KEY `fk_idcarrera_idx` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_competencia`
--

DROP TABLE IF EXISTS `t_competencia`;
CREATE TABLE IF NOT EXISTS `t_competencia` (
  `id_competencia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `campo_desar_asig` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `campo_desar_proyint` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_competencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_desempeño`
--

DROP TABLE IF EXISTS `t_desempeño`;
CREATE TABLE IF NOT EXISTS `t_desempeño` (
  `id_desempeño` int(11) NOT NULL AUTO_INCREMENT,
  `puntos` int(11) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_desempeño`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_entregable`
--

DROP TABLE IF EXISTS `t_entregable`;
CREATE TABLE IF NOT EXISTS `t_entregable` (
  `id_entregable` int(11) NOT NULL AUTO_INCREMENT,
  `id_competencia` int(11) NOT NULL,
  `entregable` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_entregable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_estudiante`
--

DROP TABLE IF EXISTS `t_estudiante`;
CREATE TABLE IF NOT EXISTS `t_estudiante` (
  `id_estudiante` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `no_control` int(11) DEFAULT NULL,
  `genero` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `periodo_ingreso` date DEFAULT NULL,
  PRIMARY KEY (`id_estudiante`),
  KEY `fk_id_usu_idx` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_evidencia`
--

DROP TABLE IF EXISTS `t_evidencia`;
CREATE TABLE IF NOT EXISTS `t_evidencia` (
  `id_evidencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_actividad` int(11) NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_evidencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_proyecto`
--

DROP TABLE IF EXISTS `t_proyecto`;
CREATE TABLE IF NOT EXISTS `t_proyecto` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `id_area_aplicacion` int(11) NOT NULL,
  `titulo` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_proyecto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_rol_usuario`
--

DROP TABLE IF EXISTS `t_rol_usuario`;
CREATE TABLE IF NOT EXISTS `t_rol_usuario` (
  `id_rol_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_insert` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rol_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `t_rol_usuario`
--

INSERT INTO `t_rol_usuario` (`id_rol_usuario`, `nombre`, `fecha_insert`) VALUES
(1, 'admin', NULL),
(2, 'asesor', NULL),
(3, 'estudiante', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuario`
--

DROP TABLE IF EXISTS `t_usuario`;
CREATE TABLE IF NOT EXISTS `t_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `usuario` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_rol_usuario_idx` (`id_rol_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `t_usuario`
--

INSERT INTO `t_usuario` (`id_usuario`, `id_rol_usuario`, `nombre`, `email`, `usuario`, `password`) VALUES
(1, 1, 'erika', '', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_admin`
--
ALTER TABLE `t_admin`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_asesor`
--
ALTER TABLE `t_asesor`
  ADD CONSTRAINT `fk_id_carr` FOREIGN KEY (`id_carrera`) REFERENCES `t_cat_carrera` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_usu` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_asignatura`
--
ALTER TABLE `t_asignatura`
  ADD CONSTRAINT `fk_id_cat_carrera` FOREIGN KEY (`id_cat_carrera`) REFERENCES `t_cat_carrera` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_asignatura_competencia`
--
ALTER TABLE `t_asignatura_competencia`
  ADD CONSTRAINT `fk_id_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `t_asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_competencia` FOREIGN KEY (`id_competencia`) REFERENCES `t_competencia` (`id_competencia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_asignatura_estudiante`
--
ALTER TABLE `t_asignatura_estudiante`
  ADD CONSTRAINT `fk_id_alumno` FOREIGN KEY (`id_estudiante`) REFERENCES `t_estudiante` (`id_estudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_asig` FOREIGN KEY (`id_asignatura`) REFERENCES `t_asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_carrera_especialidad`
--
ALTER TABLE `t_carrera_especialidad`
  ADD CONSTRAINT `fk_id_carrera` FOREIGN KEY (`id_carrera`) REFERENCES `t_cat_carrera` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `t_cat_especialidad` (`id_especialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_estudiante` FOREIGN KEY (`id_estudiante`) REFERENCES `t_estudiante` (`id_estudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_cat_especialidad`
--
ALTER TABLE `t_cat_especialidad`
  ADD CONSTRAINT `fk_idcarrera` FOREIGN KEY (`id_carrera`) REFERENCES `t_cat_carrera` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_estudiante`
--
ALTER TABLE `t_estudiante`
  ADD CONSTRAINT `fk_idusu` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_usuario`
--
ALTER TABLE `t_usuario`
  ADD CONSTRAINT `fk_rol_usuario` FOREIGN KEY (`id_rol_usuario`) REFERENCES `t_rol_usuario` (`id_rol_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
