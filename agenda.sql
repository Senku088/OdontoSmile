-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2023 a las 20:20:19
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idCitas` int(11) NOT NULL,
  `idDentista` int(11) DEFAULT NULL,
  `idPaciente` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCitas`, `idDentista`, `idPaciente`, `fecha`, `hora`, `descripcion`) VALUES
(1, 1, 4, '2023-11-15', '16:00:00', 'Pruebas de citas 1'),
(2, 1, 3, '2023-11-15', '17:00:00', 'Prueba de citas numero 2'),
(3, 5, 1, '2023-11-15', '12:00:00', 'Prueba de citas numero 3 jaja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dentista`
--

CREATE TABLE `dentista` (
  `idDentista` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `especialidad` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dentista`
--

INSERT INTO `dentista` (`idDentista`, `nombre`, `especialidad`, `telefono`, `correo`, `contrasena`) VALUES
(1, 'admin', 'adminE', '123', '123@admin', '0'),
(4, 'nombre', 'especialidad', '1234567891', 'correo@hola.com', '123456'),
(5, 'Antonio', 'Programador', '1234567891', 'correo@hola.com', '123456'),
(6, 'prueba', 'especialidad', '1234567891', 'correo@hola.com', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `IdEstado` int(11) NOT NULL,
  `Estado` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`IdEstado`, `Estado`) VALUES
(1, 'Sin Empezar'),
(2, 'Tratamiento'),
(3, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idNotificacion` int(11) NOT NULL,
  `descripcionNotificacion` varchar(500) NOT NULL,
  `idPaciente` int(11) DEFAULT NULL,
  `idDentista` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`idNotificacion`, `descripcionNotificacion`, `idPaciente`, `idDentista`) VALUES
(1, 'Prueba de primera notificacion', NULL, 1),
(2, 'Prueba de la segunda notificacion', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `idPaciente` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`idPaciente`, `nombre`, `direccion`, `telefono`, `correo`, `contrasena`) VALUES
(1, 'paciente', 'direccion', '1234567891', 'correo@hola.com', '123456'),
(3, 'pru347567834265', 'Calle del jardin', '1234567891', 'correo@hola.com', '1231'),
(4, 'Prueba1', 'direccion', '1234567891', 'correo@hola.com', 'passwd'),
(5, 'Prueba2', 'direccion', '1234567891', 'correo@hola.com', 'passwd'),
(6, 'Francisco', 'Orizaba', '2721847177', 'f_daniel1998@hotmail.com', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientos`
--

CREATE TABLE `seguimientos` (
  `idSeguimiento` int(11) NOT NULL,
  `observaciones` varchar(500) NOT NULL,
  `idPaciente` int(11) DEFAULT NULL,
  `idDentista` int(11) DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idTratamientos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seguimientos`
--

INSERT INTO `seguimientos` (`idSeguimiento`, `observaciones`, `idPaciente`, `idDentista`, `idEstado`, `idTratamientos`) VALUES
(1, 'Se sacaron las muelas del juicio', 3, 1, 2, 7),
(2, 'Se tiene cita pendiente', 5, 1, 1, 3),
(3, 'Se termina tratamiento', 1, 5, 3, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

CREATE TABLE `tratamientos` (
  `idTratamientos` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `costo` decimal(6,2) DEFAULT NULL,
  `idDentista` int(11) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tratamientos`
--

INSERT INTO `tratamientos` (`idTratamientos`, `nombre`, `costo`, `idDentista`, `descripcion`) VALUES
(3, 'ortodoncia', NULL, NULL, 'brackets'),
(7, 'Extraccion', NULL, NULL, 'Muelas'),
(10, 'rewr', NULL, NULL, 'werwe'),
(13, 'Blanqueamiento dental', '300.00', NULL, 'Realizamos un blanqueamiento dental en menos de 20 minutos'),
(15, 'prueba', '123.00', NULL, '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idCitas`),
  ADD KEY `citas_ibfk_1` (`idDentista`),
  ADD KEY `citas_ibfk_2` (`idPaciente`);

--
-- Indices de la tabla `dentista`
--
ALTER TABLE `dentista`
  ADD PRIMARY KEY (`idDentista`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`IdEstado`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idNotificacion`),
  ADD KEY `dentista_idDentista_notificaciones` (`idDentista`),
  ADD KEY `paciente_idPaciente_notificaciones` (`idPaciente`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idPaciente`);

--
-- Indices de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD PRIMARY KEY (`idSeguimiento`),
  ADD KEY `idPaciente` (`idPaciente`),
  ADD KEY `idDentista` (`idDentista`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idTratamientos` (`idTratamientos`);

--
-- Indices de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`idTratamientos`),
  ADD KEY `dentista_id` (`idDentista`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idCitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `dentista`
--
ALTER TABLE `dentista`
  MODIFY `idDentista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idNotificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  MODIFY `idSeguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `idTratamientos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idDentista`) REFERENCES `dentista` (`idDentista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`idPaciente`) REFERENCES `paciente` (`idPaciente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `dentista_idDentista_notificaciones` FOREIGN KEY (`idDentista`) REFERENCES `dentista` (`idDentista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `paciente_idPaciente_notificaciones` FOREIGN KEY (`idPaciente`) REFERENCES `paciente` (`idPaciente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD CONSTRAINT `seguimientos_ibfk_1` FOREIGN KEY (`idPaciente`) REFERENCES `paciente` (`idPaciente`),
  ADD CONSTRAINT `seguimientos_ibfk_2` FOREIGN KEY (`idDentista`) REFERENCES `dentista` (`idDentista`),
  ADD CONSTRAINT `seguimientos_ibfk_3` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`IdEstado`),
  ADD CONSTRAINT `seguimientos_ibfk_4` FOREIGN KEY (`idTratamientos`) REFERENCES `tratamientos` (`idTratamientos`);

--
-- Filtros para la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD CONSTRAINT `tratamientos_ibfk_1` FOREIGN KEY (`idDentista`) REFERENCES `dentista` (`idDentista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
