-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2023 a las 20:39:42
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `evention`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'Personal'),
(2, 'Compras'),
(3, 'Domestica'),
(4, 'Trabajo'),
(5, 'Programación'),
(6, 'Estudio'),
(7, 'Examen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(225) NOT NULL,
  `estado` char(2) NOT NULL,
  `fechaEntrega` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`id`, `descripcion`, `estado`, `fechaEntrega`, `idUsuario`, `idCategoria`) VALUES
(4, 'MODIFICAR TAREA', 'P', '2023-05-09', 4, 5),
(6, 'Clasificar card por categoria', 'ST', '2023-05-10', 1, 5),
(7, 'Terminar Proyecto Evention', 'P', '2023-05-14', 1, 5),
(10, 'Sigo probando', 'E', '2023-05-10', 1, 3),
(11, 'Ir a la FDP', 'ST', '2023-05-12', 1, 1),
(12, 'Examen de PHP y SQL', 'P', '2023-05-11', 4, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido1` varchar(30) NOT NULL,
  `apellido2` varchar(30) NOT NULL,
  `telefono` char(10) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `genero` char(2) NOT NULL,
  `estado` char(2) NOT NULL,
  `fechaNacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido1`, `apellido2`, `telefono`, `login`, `password`, `genero`, `estado`, `fechaNacimiento`) VALUES
(1, 'Jesús', 'Díaz-Bernardo', 'Moreno de Redrojo', '617287674', 'admin', '$2y$10$M./OO836dFgGuqAxU8RVQ.8c25vvD5PFtPtNDNwKi8Fnk6Fi1wNhe', 'H', 'E', '2002-07-18'),
(2, 'prueba', 'prueba', 'prueba', '123456789', 'prueba', '$2y$10$jY/DdxCl/HC7sZZjYeBZ0.7mIhgZGwu9s13CumMYMjcRnPGLWVm3m', 'M', 'E', '2002-07-02'),
(3, 'paco', 'leches', 'fritas', '123456789', 'paco', '$2y$10$2lMeuQj0DWGehNjXVF3gSO67I4JUGV9p0PukDW1m9OsbJmms86Do.', 'O', 'T', '2019-11-14'),
(4, 'Jesús', 'Jesús', 'Díaz-Bernardo', '617287674', 'jesus', '$2y$10$b7N0w24brdNDuJt6pVmpZePtZDdT0KodvwcgAZdGysF9UjeFpI22y', 'H', 'E', '2002-07-18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `tarea_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
