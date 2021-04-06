-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-04-2021 a las 18:32:16
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
('33432443i', '4', 'GITI', 'TERMO,FLUIDOS,PW'),
('45611234T', '1', 'GII', 'IP,IG'),
('77178334q', '4', 'GII', 'EDNL,AAED,PW,PNET');

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
(22, '11111111B', '3', 6),
(50, '33432443i', '25', 10),
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
('1', '2021-05-05', 'a', 2, '2', 'POO'),
('2', '2021-06-06', 'b', 1, '2', 'EDNL'),
('4', '2021-06-06', 'c', 10, '5', 'PW'),
('5', '2021-04-06', 'c', 10, '5', 'PW'),
('6', '2021-06-04', 'c', 10, '5', 'PW'),
('7', '2021-04-01', 'c', 10, '5', 'PW'),
('3', '2021-04-01', 'c', 10, '5', 'PW');

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
(31, 'Juan Jose', 'Rodriguez', 'ALUMNO', '11111111B', 'qwer', 'jj
', 'default.jpg'),
(35, 'Patricio ', 'abelardo ', 'PROFESOR', '00000000p', '', 'patri ', ''),
(36, 'Carlos', 'Vazquez', 'ALUMNO', '33432443i', 'miau', 'miau', 'default.jpg'),
(38, 'admin 2', 'admin ', 'ADMIN', 'admin2 ', 'admin ', 'admin2 ', 'default.jpg'),
(39, 'Juan', 'Rodriguez', 'PROFESOR', '33245544r', 'prof', 'profesor', 'default.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `IDPREG` int(11) NOT NULL,
  `TEMAID` int(11) NOT NULL,
  `ENUNCIADO` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `RESPONSES` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CORRECTA` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`IDPREG`, `TEMAID`, `ENUNCIADO`, `RESPONSES`, `CORRECTA`) VALUES
(9, 5, 'Â¿QuÃ© es PHP?', 'Un lenguaje interpretado ,PHP,Una herramienta Ãºtil,Un lenguaje de programaciÃ³n', 'Un lenguaje interpretado'),
(67, 7, 'Que es una lista', 'Un suspenso, un aprobado, la compra, una ed', 'una ed'),
(100, 5, 'La respuesta es a', 'a,  b, c, d', 'a'),
(101, 5, 'La respuesta es b', 'a,  b, c, d', 'b');


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
(4, 'PHP', '10,11'),
(5, 'Programacion Web', '9,3,12,15,177,481,190,476'),
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
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
