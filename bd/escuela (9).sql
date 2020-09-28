-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-09-2020 a las 05:38:17
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
-- Estructura de tabla para la tabla `t_actividadea`
--

DROP TABLE IF EXISTS `t_actividadea`;
CREATE TABLE IF NOT EXISTS `t_actividadea` (
  `id_actividadea` int(11) NOT NULL AUTO_INCREMENT,
  `id_entregable` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_actividadea`),
  KEY `fk_act_ent_id_idx` (`id_entregable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  `nombre` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `extension` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nombre_original` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_archivos`),
  KEY `fk_archivo_proyecto_idx` (`id_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_archivos_actividadea`
--

DROP TABLE IF EXISTS `t_archivos_actividadea`;
CREATE TABLE IF NOT EXISTS `t_archivos_actividadea` (
  `id_archivos_actividadEA` int(11) NOT NULL AUTO_INCREMENT,
  `id_act_mat_apoyo` int(11) DEFAULT NULL,
  `id_act_fue_inf` int(11) DEFAULT NULL,
  `id_act_ent` int(11) DEFAULT NULL,
  `id_act_ap` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `ext` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nombre_original` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_entregable` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_archivos_actividadEA`),
  KEY `fk_archea_entr_idx` (`id_entregable`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  PRIMARY KEY (`id_area_aplicacion`),
  KEY `fk_id_asignatura_idx` (`id_asignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_asesor`
--

DROP TABLE IF EXISTS `t_asesor`;
CREATE TABLE IF NOT EXISTS `t_asesor` (
  `id_asesor` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `no_empleado` int(11) DEFAULT NULL,
  `grado_estudios` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_asesor`),
  KEY `fk_id_usuario_idx` (`id_usuario`),
  KEY `fk_id_carrera_as_idx` (`id_carrera`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_asignatura`
--

DROP TABLE IF EXISTS `t_asignatura`;
CREATE TABLE IF NOT EXISTS `t_asignatura` (
  `id_asignatura` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `creditos` int(11) DEFAULT NULL,
  `clave` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_asignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_asignatura_carrera`
--

DROP TABLE IF EXISTS `t_asignatura_carrera`;
CREATE TABLE IF NOT EXISTS `t_asignatura_carrera` (
  `id_asignatura_carrera` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrera` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_asignatura_carrera`),
  KEY `fk_asig_car_idx` (`id_carrera`),
  KEY `fk_asig_id_idx` (`id_asignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_asignatura_estudiante`
--

DROP TABLE IF EXISTS `t_asignatura_estudiante`;
CREATE TABLE IF NOT EXISTS `t_asignatura_estudiante` (
  `id_asignatura_estudiante` int(11) NOT NULL AUTO_INCREMENT,
  `id_asignatura` int(11) DEFAULT NULL,
  `id_estudiante` int(11) DEFAULT NULL,
  `calif` float DEFAULT NULL,
  PRIMARY KEY (`id_asignatura_estudiante`),
  KEY `fk_id_asignatura_idx` (`id_asignatura`),
  KEY `fk_id_estudiante_idx` (`id_estudiante`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_carrera_asesor`
--

DROP TABLE IF EXISTS `t_carrera_asesor`;
CREATE TABLE IF NOT EXISTS `t_carrera_asesor` (
  `id_carrera_asesor` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrera` int(11) DEFAULT NULL,
  `id_asesor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_carrera_asesor`),
  KEY `fk_car_id_idx` (`id_carrera`),
  KEY `fk_asesor_id_idx` (`id_asesor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_carrera_especialidad`
--

DROP TABLE IF EXISTS `t_carrera_especialidad`;
CREATE TABLE IF NOT EXISTS `t_carrera_especialidad` (
  `id_carrera_especialidad` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrera` int(11) DEFAULT NULL,
  `id_especialidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_carrera_especialidad`),
  KEY `fk_id_carrera_idx` (`id_carrera`),
  KEY `fk_id_especialidad_idx` (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cat_especialidad`
--

DROP TABLE IF EXISTS `t_cat_especialidad`;
CREATE TABLE IF NOT EXISTS `t_cat_especialidad` (
  `id_especialidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `periodo_vigencia` date DEFAULT NULL,
  PRIMARY KEY (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_desempeno`
--

DROP TABLE IF EXISTS `t_desempeno`;
CREATE TABLE IF NOT EXISTS `t_desempeno` (
  `id_desempeno` int(11) NOT NULL AUTO_INCREMENT,
  `id_entregable` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_evidencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_desempeno`),
  KEY `fk_ent_des_idx` (`id_entregable`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_entregable`
--

DROP TABLE IF EXISTS `t_entregable`;
CREATE TABLE IF NOT EXISTS `t_entregable` (
  `id_entregable` int(11) NOT NULL AUTO_INCREMENT,
  `id_competencia` int(11) DEFAULT NULL,
  `entregable` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_entregable`),
  KEY `fk_entr_comp_idx` (`id_competencia`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_evidencia`
--

DROP TABLE IF EXISTS `t_evidencia`;
CREATE TABLE IF NOT EXISTS `t_evidencia` (
  `id_evidencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_entregable` int(11) DEFAULT NULL,
  `url` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_evidencia`),
  KEY `fk_ent_evi_idx` (`id_entregable`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_proyecto`
--

DROP TABLE IF EXISTS `t_proyecto`;
CREATE TABLE IF NOT EXISTS `t_proyecto` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `id_asesor` int(11) DEFAULT NULL,
  `titulo` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `area_aplicacion` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_proyecto`),
  KEY `fk_asesor_pro_idx` (`id_asesor`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_proyecto_asignatura`
--

DROP TABLE IF EXISTS `t_proyecto_asignatura`;
CREATE TABLE IF NOT EXISTS `t_proyecto_asignatura` (
  `id_proyecto_asignatura` int(11) NOT NULL AUTO_INCREMENT,
  `id_asignatura` int(11) DEFAULT NULL,
  `id_proyecto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_proyecto_asignatura`),
  KEY `fk_asig_id_idx` (`id_asignatura`),
  KEY `fk_pro_id_idx` (`id_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_proyecto_estudiante`
--

DROP TABLE IF EXISTS `t_proyecto_estudiante`;
CREATE TABLE IF NOT EXISTS `t_proyecto_estudiante` (
  `id_proyecto_estudiante` int(11) NOT NULL AUTO_INCREMENT,
  `id_estudiante` int(11) DEFAULT NULL,
  `id_proyecto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_proyecto_estudiante`),
  KEY `fk_id_est_pro_idx` (`id_estudiante`),
  KEY `fk_id_proy_idx` (`id_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `t_usuario`
--

INSERT INTO `t_usuario` (`id_usuario`, `id_rol_usuario`, `nombre`, `email`, `usuario`, `password`) VALUES
(1, 1, 'erika', NULL, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_actividadea`
--
ALTER TABLE `t_actividadea`
  ADD CONSTRAINT `fk_act_ent_id` FOREIGN KEY (`id_entregable`) REFERENCES `t_entregable` (`id_entregable`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_admin`
--
ALTER TABLE `t_admin`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_archivos`
--
ALTER TABLE `t_archivos`
  ADD CONSTRAINT `fk_archivo_proyecto` FOREIGN KEY (`id_proyecto`) REFERENCES `t_proyecto` (`id_proyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_archivos_actividadea`
--
ALTER TABLE `t_archivos_actividadea`
  ADD CONSTRAINT `fk_archea_entr` FOREIGN KEY (`id_entregable`) REFERENCES `t_entregable` (`id_entregable`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_area_aplicacion`
--
ALTER TABLE `t_area_aplicacion`
  ADD CONSTRAINT `fk_id_area_asig` FOREIGN KEY (`id_asignatura`) REFERENCES `t_asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_asesor`
--
ALTER TABLE `t_asesor`
  ADD CONSTRAINT `fk_id_carrera_as` FOREIGN KEY (`id_carrera`) REFERENCES `t_cat_carrera` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_usu` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_asignatura_carrera`
--
ALTER TABLE `t_asignatura_carrera`
  ADD CONSTRAINT `fk_asig_car` FOREIGN KEY (`id_carrera`) REFERENCES `t_cat_carrera` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asig_id` FOREIGN KEY (`id_asignatura`) REFERENCES `t_asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `t_carrera_asesor`
--
ALTER TABLE `t_carrera_asesor`
  ADD CONSTRAINT `fk_asesor_id` FOREIGN KEY (`id_asesor`) REFERENCES `t_asesor` (`id_asesor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_car_id` FOREIGN KEY (`id_carrera`) REFERENCES `t_cat_carrera` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_carrera_especialidad`
--
ALTER TABLE `t_carrera_especialidad`
  ADD CONSTRAINT `fk_id_carrera` FOREIGN KEY (`id_carrera`) REFERENCES `t_cat_carrera` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `t_cat_especialidad` (`id_especialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_desempeno`
--
ALTER TABLE `t_desempeno`
  ADD CONSTRAINT `fk_ent_des` FOREIGN KEY (`id_entregable`) REFERENCES `t_entregable` (`id_entregable`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_entregable`
--
ALTER TABLE `t_entregable`
  ADD CONSTRAINT `fk_entr_comp` FOREIGN KEY (`id_competencia`) REFERENCES `t_competencia` (`id_competencia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_estudiante`
--
ALTER TABLE `t_estudiante`
  ADD CONSTRAINT `fk_idusu` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_evidencia`
--
ALTER TABLE `t_evidencia`
  ADD CONSTRAINT `fk_ent_evi` FOREIGN KEY (`id_entregable`) REFERENCES `t_entregable` (`id_entregable`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_proyecto`
--
ALTER TABLE `t_proyecto`
  ADD CONSTRAINT `fk_asesor_pro` FOREIGN KEY (`id_asesor`) REFERENCES `t_asesor` (`id_asesor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_proyecto_asignatura`
--
ALTER TABLE `t_proyecto_asignatura`
  ADD CONSTRAINT `fk_asig_pro_id` FOREIGN KEY (`id_asignatura`) REFERENCES `t_asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pro_id` FOREIGN KEY (`id_proyecto`) REFERENCES `t_proyecto` (`id_proyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_proyecto_estudiante`
--
ALTER TABLE `t_proyecto_estudiante`
  ADD CONSTRAINT `fk_id_est_pro` FOREIGN KEY (`id_estudiante`) REFERENCES `t_estudiante` (`id_estudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_proy` FOREIGN KEY (`id_proyecto`) REFERENCES `t_proyecto` (`id_proyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_usuario`
--
ALTER TABLE `t_usuario`
  ADD CONSTRAINT `fk_rol_usuario` FOREIGN KEY (`id_rol_usuario`) REFERENCES `t_rol_usuario` (`id_rol_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
