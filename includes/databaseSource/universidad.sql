-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-03-2021 a las 19:22:55
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
  `MATRICULADO` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`DNI`, `CURSO`, `GRADO`, `MATRICULADO`) VALUES
('11223344I', '2', 'GITI', 'POO,POO,POO,POO,POO,POO,POO,,,,'),
('11234554R', '2', 'GII', 'POO,POO,POO,POO,POO,POO,POO,,,,'),
('123457G  ', '3Âº', 'GII', 'POO,EDNL,ADS,PW,IRC,DA,,,,,'),
('44565443R', '4', 'INEF', 'qwerqwer,qwerqwer,qwerqwer,qwerqwer,qwerqwer,qwerqwer,qwerqwer,,,,');

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
('PW', 3, '2,1,3'),
('EDNL', 2, '9,2,1'),
('AAED', 2, '9,2,5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `CODIGO` varchar(19) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ALUM_DNI` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `COD_EX` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NOTA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`CODIGO`, `ALUM_DNI`, `COD_EX`, `NOTA`) VALUES
('3', '12345D', '61B', 5),
('2', '72638E', '20G', 2),
('1', '773956G', '20G', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE `examenes` (
  `CODEX` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FECHA` date NOT NULL,
  `PASS` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PREG` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TEM` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ASIG` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`CODEX`, `FECHA`, `PASS`, `PREG`, `TEM`, `ASIG`) VALUES
('20G', '2021-03-16', 'celula', 'Que es una celula', 'Biologia', 'PW'),
('61B', '2021-03-01', 'arboles', 'Que es un arbol', '2', 'EDNL');

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
(4, 'JesÃºs   ', 'Lagares   ', 'ALUMNO', '123457G  ', '777303  ', 'Jelag   ', ''),
(23, 'Profesor', 'Sustituto', 'PROFESOR', '77293D', 'prof', 'profesor', 'default.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `IDPREG` int(11) NOT NULL,
  `ENUNCIADO` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RESP1` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RESP2` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RESP3` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RESP4` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RESP` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`IDPREG`, `ENUNCIADO`, `RESP1`, `RESP2`, `RESP3`, `RESP4`, `RESP`) VALUES
(1, '¿En que año se fundo...?', '2000', '2001', '2011', '2020', 'resp1'),
(7, 'Esta pagina esta hecha en PHP y HTML  ', 'Verdadero   ', 'Flaso   ', '   ', '   ', 'resp1   '),
(8, 'como mostramos por pantalla un texto en php?', 'echo', 'balabla', 'qwer', '', 'resp1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `ASIGASOC` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DNI` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`ASIGASOC`, `DNI`) VALUES
('PW', '44353321I');

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
  ADD UNIQUE KEY `ALUM_DNI` (`ALUM_DNI`),
  ADD UNIQUE KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD PRIMARY KEY (`CODEX`),
  ADD KEY `PREG` (`PREG`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `DNI` (`DNI`,`USER`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`IDPREG`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD UNIQUE KEY `DNI` (`DNI`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `IDPREG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
