-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-04-2021 a las 13:13:35
-- Versión del servidor: 5.7.33-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `universidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `DNI` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CURSO` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GRADO` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MATRICULADO` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`DNI`, `CURSO`, `GRADO`, `MATRICULADO`) VALUES
('11111111B', '3', 'GII', 'PW,EDNL,POO,AAED'),
('33432443i', '2', 'GITI', 'TERMO,FLUIDOS,PW,EDNL,POO,AAED,IP,IG'),
('45611234T', '1', 'GII', 'IP,IG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `CODIGO` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CURSOASIG` int(11) NOT NULL,
  `IDTEMAS` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--
INSERT INTO `asignaturas` (`CODIGO`, `CURSOASIG`, `IDTEMAS`) VALUES
('EDNL', 2, '1,2,3'),
('PW', 3, '4,5,6'),
('AAED', 2, '6,7,8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `CODIGO` int(11) NOT NULL,
  `ALUM_DNI` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `COD_EX` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NOTA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`CODIGO`, `ALUM_DNI`, `COD_EX`, `NOTA`) VALUES
(1, '33432443i', '2', 10),
(2, '33432443i', '1', 8),
(10, '72638E', '3', 10),
(20, '773956G', '3', 5),
(200, '12345D', '3', 7),
(300, '72638Es', '3', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE `examenes` (
  `CODEX` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FECHA` date NOT NULL,
  `PASS` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NUM_PREG` int(11) NOT NULL,
  `TEM` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ASIG` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`CODEX`, `FECHA`, `PASS`, `NUM_PREG`, `TEM`, `ASIG`) VALUES
('0', '2021-04-04', 'a', 2, '2', 'PW'),
('1', '2021-05-05', 'a', 2, '2', 'POO'),
('2', '2021-06-06', 'b', 1, '2', 'EDNL'),
('4', '2021-05-05', 'a', 2, '2', 'IG'),
('5', '2021-06-06', 'b', 1, '2', 'IP'),
('6', '2021-05-05', 'a', 2, '2', 'PW'),
('7', '2021-06-06', 'b', 1, '2', 'TERMO'),
('3', '2021-04-07', 'c', 10, 'Programacion Web', 'PW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `APELLIDOS` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TIPO` enum('ALUMNO','PROFESOR','ADMIN') COLLATE utf8mb4_unicode_ci NOT NULL,
  `DNI` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASS` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `USER` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FOTO` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`ID`, `NOMBRE`, `APELLIDOS`, `TIPO`, `DNI`, `PASS`, `USER`, `FOTO`) VALUES
(3, 'admin   ', 'admin   ', 'ADMIN', '45611234T', 'admin ', 'administrador   ', 'default.jpg'),
(28, 'gonzalo', 'ulibarri', 'ALUMNO', '77178334q', 'qwer', 'gonzalo', 'default.jpg'),
(31, 'jj', 'rodrigue', 'ALUMNO', '11111111B', 'qwer', 'jj', 'default.jpg'),
(35, 'patricio', 'abelardo', 'PROFESOR', '00000000p', 'abe', 'patri', 'default.jpg'),
(36, 'miau', 'gatito', 'ALUMNO', '33432443i', 'miau', 'miau', 'default.jpg'),
(38, 'admin', 'admin', 'ADMIN', 'admin2', 'admin', 'admin2', 'default.jpg'),
(39, 'profesor', 'profesor', 'PROFESOR', '33245544r', 'prof', 'profesor', 'default.jpg'),
(43, 'qwer', 'qwer', 'ALUMNO', 'qwer', 'qwer', 'qwer', 'default.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `IDPREG` int(11) NOT NULL AUTO_INCREMENT,
  `TEMAID` int(11) NOT NULL,
  `ENUNCIADO` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RESPONSES` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CORRECTA` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY(`IDPREG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`IDPREG`, `TEMAID`, `ENUNCIADO`, `RESPONSES`, `CORRECTA`) VALUES
(1, 2, 'Esto es un enunciado', 'Resp1,resp2,resp3,resp4', 'resp1'),
(2, 1, 'Que es un arbol', 'No es nada, no existe, no lo se, una plan', 'una plan'),
(3, 7, 'Que es una lista', 'Un suspenso, un aprobado, la compra, una ed', 'una ed'),
(4, 5, 'Que esun framework', 'No lo se, quien sabe, wtf, una herramienta', 'una herramienta'),
(5, 5, 'Nueva pregutna', '1,2,3,4', '3'),
(6, 5, '133', '123123312,123123,3123123,131213', '3'),
(7, 5, 'Esto es el nuevo enunciado', 'd,w,4131s,e', 'e'),
(8, 5, 'Nueva pregutna', '1,2,3,4', '3'),
(9, 5, '1312', '12331232,123,123123,1312', '1312'),
(10, 5, 'Â¿De que color es el pelo de Pedro?', 'Azul,amarillo,rojo,no tiene', 'no tiene'),
(11, 5, '133', '123123312,123123,3123123,131213', '3'),
(12, 5, '133', '123123312,123123,3123123,131213', '3'),
(13, 5, 'Hola muy buenas', 'Hey ,Que tal,No,Si', 'Si'),
(14, 5, '133', '123123312,123123,3123123,131213', '3'),
(15, 5, 'Â¿De que color es el pelo de Pedro?', 'Azul,amarillo,rojo,no tiene', 'no tiene'),
(16, 5, '2', '1,3,4131s,5', '3'),
(17, 5, 'Â¿De que color es el pelo de Pedro?', 'Azul,amarillo,rojo,no tiene', 'no tiene'),
(18, 5, '133', '123123312,123123,3123123,131213', '3'),
(19, 5, 'Â¿De que color es el pelo de Pedro?', 'Azul,amarillo,rojo,no tiene', 'no tiene'),
(20, 5, '133', '123123312,123123,3123123,131213', '3'),
(21, 5, '1312', '12331232,123,123123,1312', '1312'),
(22, 5, 'Â¿De que color es el pelo de Pedro?', 'Azul,amarillo,rojo,no tiene', 'no tiene'),
(23, 5, 'Nueva pregutna', '1,2,3,4', '3'),
(24, 5, 'Â¿De que color es el pelo de Pedro?', 'Azul,amarillo,rojo,no tiene', 'no tiene'),
(25, 5, '2', '1,3,4131s,5', '3'),
(26, 5, '133', '123123312,123123,3123123,131213', '3'),
(27, 5, 'Nueva pregunta', '1,2,3,4', '3'),
(28, 5, '133', '123123312,123123,3123123,131213', '3'),
(29, 5, '133', '123123312,123123,3123123,131213', '3'),
(30, 5, '133', '123123312,123123,3123123,131213', '3'),
(31, 5, 'Â¿De que color es el pelo de Pedro?', 'Azul,amarillo,rojo,no tiene', 'no tiene'),
(32, 5, 'Nueva pregutna', '1,2,3,4', '3'),
(33, 4, 'Qué es PHP', 'Lo peor que se ha creado, un lenguaje, no lo se, unas siglas', 'un lenguaje'),
(34, 5, 'Esto es el nuevo enunciado', 'd,w,4131s,e', 'e'),
(35, 5, '1312', '12331232,123,123123,1312', '1312'),
(36, 5, 'Esto es el nuevo enunciado', 'd,w,4131s,e', 'e'),
(37, 5, '2', '1,3,4131s,5', '3'),
(38, 5, 'prg', '1,2,3,4', '1'),
(39, 5, '133', '123123312,123123,3123123,131213', '3'),
(40, 5, 'Esto es el nuevo enunciado', 'd,w,4131s,e', 'e'),
(41, 5, '133', '123123312,123123,3123123,131213', '3'),
(42, 5, 'Nueva pregutna', '1,2,3,4', '3'),
(43, 5, '133', '123123312,123123,3123123,131213', '3'),
(44, 5, 'Esto es el nuevo enunciado', 'd,w,4131s,e', 'e'),
(45, 5, '1312', '12331232,123,123123,1312', '1312'),
(46, 5, 'prg', '1,2,3,4', '1'),
(47, 5, '2', '1,3,4131s,5', '3'),
(48, 5, 'prg', '1,2,3,4', '1'),
(49, 5, 'Â¿De que color es el pelo de Pedro?', 'Azul,amarillo,rojo,no tiene', 'no tiene'),
(50, 5, 'Â¿De que color es el pelo de Pedro?', 'Azul,amarillo,rojo,no tiene', 'no tiene');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `DNI` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ASIGASOC` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`DNI`, `ASIGASOC`) VALUES
('00000000p', ''),
('33245544r', 'PW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `ID_PREG` int(11) NOT NULL,
  `ALUM_DNI` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `COD_EX` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RESPALUMN` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ID_RESP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BATPREGUNTAS` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`ID`, `NOMBRE`, `BATPREGUNTAS`) VALUES
(1, 'Arboles', '1,2,3,4'),
(2, 'Grafos', '5,6,7,8'),
(4, 'PHP', '9,10,11'),
(5, 'Programacion Web', '3,2,12,250'),
(8, 'Listas', '100,200,300');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD UNIQUE KEY `DNI` (`DNI`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD UNIQUE KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD PRIMARY KEY (`CODEX`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `DNI` (`DNI`,`USER`);


-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD UNIQUE KEY `DNI` (`DNI`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`ID_RESP`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `IDPREG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=484;
--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `ID_RESP` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
