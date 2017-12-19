-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-12-2017 a las 01:07:11
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `quiz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

DROP TABLE IF EXISTS `preguntas`;
CREATE TABLE IF NOT EXISTS `preguntas` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Correo` text COLLATE utf8_unicode_ci NOT NULL,
  `Pregunta` text COLLATE utf8_unicode_ci NOT NULL,
  `Correcta` text COLLATE utf8_unicode_ci NOT NULL,
  `Incorrecta1` text COLLATE utf8_unicode_ci NOT NULL,
  `Incorrecta2` text COLLATE utf8_unicode_ci NOT NULL,
  `Incorrecta3` text COLLATE utf8_unicode_ci NOT NULL,
  `Complejidad` int(11) NOT NULL,
  `Tema` text COLLATE utf8_unicode_ci NOT NULL,
  `Imagen` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`Codigo`, `Correo`, `Pregunta`, `Correcta`, `Incorrecta1`, `Incorrecta2`, `Incorrecta3`, `Complejidad`, `Tema`, `Imagen`) VALUES
(1, 'jelexpuru002@ikasle.ehu.eus', 'Never gonna give you up', 'Rick Astley', 'Bono', 'Bruce Springsteen', 'Paquirrin', 2, 'Autor', 'uploads/astley.jpg'),
(2, 'jelexpuru002@ikasle.ehu.eus', 'Nothing Else Matters', 'Metallica', 'Apocalyptica', 'Lucy Silvas', 'Melendi', 1, 'Autor', 'uploads/125_logo.png'),
(3, 'jelexpuru002@ikasle.ehu.eus', 'Holding Out For A Hero', 'Bonnie Tyler', 'Van Canto', 'Shrek', 'Pitingo', 3, 'Autor', 'uploads/R-645293-1297282661.jpeg.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `Email` text COLLATE utf8_unicode_ci NOT NULL,
  `Nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `Nick` text COLLATE utf8_unicode_ci NOT NULL,
  `Password` text COLLATE utf8_unicode_ci NOT NULL,
  `Foto` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Email`(35))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Email`, `Nombre`, `Nick`, `Password`, `Foto`) VALUES
('jelexpuru002@ikasle.ehu.eus', 'Julen Elexpuru Ortiz', 'Julexpuru', 'ciUWav4Bt5luI', 'uploads/Foto Dni.jpeg'),
('web000@ehu.es', '', '', 'ciNHXWXKhrRWE', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
