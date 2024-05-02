-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2024 a las 07:18:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `documento` bigint(11) NOT NULL,
  `contraseña` text DEFAULT NULL,
  `nombre` varchar(40) NOT NULL,
  `id_tip_doc` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `nit` int(9) DEFAULT NULL,
  `tyc` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`documento`, `contraseña`, `nombre`, `id_tip_doc`, `email`, `id_rol`, `estado`, `nit`, `tyc`) VALUES
(1104544454, '$2y$15$ScAQ4AaHPWvcDwmH0dfQ/.cR6yBWSzREIS28EEtv4X4FkWXPprMJq', 'brrayan fernando sanchez', 1, 'bfsanchez45@misena.edu.co', 2, 'activo', 123456789, 'si'),
(1107975322, '$2y$10$XGTsQD2pLExCOHti07bZh.XtQ27it3b4qsBfDzekKnR7WAACygQXW', 'cristian figueroa', 1, 'cristianfigueroa040@gmail.com', 1, 'activo', 123456789, 'si');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `id_tip_doc` (`id_tip_doc`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `nit` (`nit`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tip_doc`) REFERENCES `tip_doc` (`id_tip_doc`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `usuario_ibfk_5` FOREIGN KEY (`nit`) REFERENCES `empresa` (`nit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
