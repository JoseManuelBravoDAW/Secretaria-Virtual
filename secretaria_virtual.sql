-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2019 a las 10:51:44
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `secretaria_virtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clavefirma`
--

CREATE TABLE `clavefirma` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fila` enum('a','b','c','d','e','f','g','h') COLLATE ucs2_spanish_ci NOT NULL,
  `columna` enum('1','2','3','4','5','6','7','8') COLLATE ucs2_spanish_ci NOT NULL,
  `clave` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE ucs2_spanish_ci NOT NULL,
  `fichero` varchar(255) COLLATE ucs2_spanish_ci NOT NULL,
  `estado` enum('Pendiente','Firmado') COLLATE ucs2_spanish_ci NOT NULL,
  `fechaFirma` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE ucs2_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE ucs2_spanish_ci NOT NULL,
  `usuario` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  `estado` enum('bloqueado','activo') COLLATE ucs2_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `usuario`, `password`, `estado`) VALUES
(4, 'administrador', 'admin@secretariavirtual.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clavefirma`
--
ALTER TABLE `clavefirma`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clavefirma`
--
ALTER TABLE `clavefirma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1025;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
