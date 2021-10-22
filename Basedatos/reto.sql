-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2021 a las 16:40:26
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carta`
--

CREATE TABLE `carta` (
  `idCarta` int(11) NOT NULL,
  `nombreCarta` varchar(30) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `idTipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carta`
--

INSERT INTO `carta` (`idCarta`, `nombreCarta`, `imagen`, `idTipo`) VALUES
(1, 'Pedro', 'vista/imgCartas/pedro.png', 1),
(2, 'Juan', 'vista/imgCartas/juan.png', 1),
(3, 'Carlos', 'vista/imgCartas/carlos.png', 1),
(4, 'Juanita', 'vista/imgCartas/juanita.png', 1),
(5, 'Antonio', 'vista/imgCartas/antonio.png', 1),
(6, 'Carolina', 'vista/imgCartas/carolina.png', 1),
(7, 'Manuel', 'vista/imgCartas/manuel.png', 1),
(8, 'Nomina', 'vista/imgCartas/nomina.png', 2),
(9, 'Facturación', 'vista/imgCartas/facturacion.png', 2),
(10, 'Recibos', 'vista/imgCartas/recibo.png', 2),
(11, 'Comprobante contable', 'vista/imgCartas/comprobanteContable.png', 2),
(12, 'Usuarios', 'vista/imgCartas/usuarios.png', 2),
(13, 'Contabilidad', 'vista/imgCartas/contabilidad.png', 2),
(14, '403', 'vista/imgCartas/404.png', 3),
(15, 'Stack overflow', 'vista/imgCartas/stackOverflow.png', 3),
(16, 'Memory out of range', 'vista/imgCartas/outOfMemory.png', 3),
(17, 'Null pointer', 'vista/imgCartas/nullPointer.png', 3),
(18, 'Syntax error', 'vista/imgCartas/syntaxError.jpg', 3),
(19, 'Encoding error', 'vista/imgCartas/encodingError.png', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartapartida`
--

CREATE TABLE `cartapartida` (
  `idCartaPartida` int(11) NOT NULL,
  `idPartida` int(11) DEFAULT NULL,
  `idCarta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartausuariopartida`
--

CREATE TABLE `cartausuariopartida` (
  `idCartaUsuarioPartida` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCarta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `idPartida` int(11) NOT NULL,
  `codigoPartida` varchar(30) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `ganador` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `idPregunta` int(11) NOT NULL,
  `preguntaProgramador` int(11) DEFAULT NULL,
  `preguntaModulo` int(11) DEFAULT NULL,
  `preguntaError` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocarta`
--

CREATE TABLE `tipocarta` (
  `idTipo` int(11) NOT NULL,
  `nombreTipo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipocarta`
--

INSERT INTO `tipocarta` (`idTipo`, `nombreTipo`) VALUES
(1, 'Programador'),
(2, 'Modulo'),
(3, 'Error');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariopartida`
--

CREATE TABLE `usuariopartida` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `idPartida` int(11) NOT NULL,
  `turno` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariorespuesta`
--

CREATE TABLE `usuariorespuesta` (
  `idUsuarioRespuesta` int(11) NOT NULL,
  `idPregunta` int(11) DEFAULT NULL,
  `respuesta` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carta`
--
ALTER TABLE `carta`
  ADD PRIMARY KEY (`idCarta`),
  ADD KEY `idTipo` (`idTipo`);

--
-- Indices de la tabla `cartapartida`
--
ALTER TABLE `cartapartida`
  ADD PRIMARY KEY (`idCartaPartida`),
  ADD KEY `idPartida` (`idPartida`);

--
-- Indices de la tabla `cartausuariopartida`
--
ALTER TABLE `cartausuariopartida`
  ADD PRIMARY KEY (`idCartaUsuarioPartida`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idCarta` (`idCarta`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`idPartida`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`idPregunta`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `tipocarta`
--
ALTER TABLE `tipocarta`
  ADD PRIMARY KEY (`idTipo`);

--
-- Indices de la tabla `usuariopartida`
--
ALTER TABLE `usuariopartida`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idPartida` (`idPartida`);

--
-- Indices de la tabla `usuariorespuesta`
--
ALTER TABLE `usuariorespuesta`
  ADD PRIMARY KEY (`idUsuarioRespuesta`),
  ADD KEY `idPregunta` (`idPregunta`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carta`
--
ALTER TABLE `carta`
  MODIFY `idCarta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `cartapartida`
--
ALTER TABLE `cartapartida`
  MODIFY `idCartaPartida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cartausuariopartida`
--
ALTER TABLE `cartausuariopartida`
  MODIFY `idCartaUsuarioPartida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `idPartida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipocarta`
--
ALTER TABLE `tipocarta`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuariopartida`
--
ALTER TABLE `usuariopartida`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuariorespuesta`
--
ALTER TABLE `usuariorespuesta`
  MODIFY `idUsuarioRespuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carta`
--
ALTER TABLE `carta`
  ADD CONSTRAINT `carta_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `tipocarta` (`idTipo`);

--
-- Filtros para la tabla `cartapartida`
--
ALTER TABLE `cartapartida`
  ADD CONSTRAINT `cartapartida_ibfk_1` FOREIGN KEY (`idPartida`) REFERENCES `partida` (`idPartida`);

--
-- Filtros para la tabla `cartausuariopartida`
--
ALTER TABLE `cartausuariopartida`
  ADD CONSTRAINT `cartausuariopartida_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuariopartida` (`idUsuario`),
  ADD CONSTRAINT `cartausuariopartida_ibfk_2` FOREIGN KEY (`idCarta`) REFERENCES `carta` (`idCarta`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuariopartida` (`idUsuario`);

--
-- Filtros para la tabla `usuariopartida`
--
ALTER TABLE `usuariopartida`
  ADD CONSTRAINT `usuariopartida_ibfk_1` FOREIGN KEY (`idPartida`) REFERENCES `partida` (`idPartida`);

--
-- Filtros para la tabla `usuariorespuesta`
--
ALTER TABLE `usuariorespuesta`
  ADD CONSTRAINT `usuariorespuesta_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `pregunta` (`idPregunta`),
  ADD CONSTRAINT `usuariorespuesta_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuariopartida` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
