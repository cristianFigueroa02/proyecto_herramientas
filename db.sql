-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2024 a las 01:28:06
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
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_cate` int(11) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_cate`, `categoria`) VALUES
(1, 'pesada'),
(2, 'suave');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_instructor`
--

CREATE TABLE `detalle_instructor` (
  `id_detalle` int(11) NOT NULL,
  `documento` int(11) NOT NULL,
  `ficha` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_instructor`
--

INSERT INTO `detalle_instructor` (`id_detalle`, `documento`, `ficha`) VALUES
(1, 1782, 123789),
(2, 1782, 789456),
(3, 1782, 789456),
(4, 123456789, 2500591);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pres`
--

CREATE TABLE `detalle_pres` (
  `id_de_pres` int(11) NOT NULL,
  `id_prestamo` int(11) DEFAULT NULL,
  `id_herramienta` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deta_reportes`
--

CREATE TABLE `deta_reportes` (
  `id_de_reporte` int(11) NOT NULL,
  `id_reporte` int(11) DEFAULT NULL,
  `id_herramienta` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `nit` int(9) NOT NULL,
  `nombre_empre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `gmail` varchar(150) NOT NULL,
  `telefono` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`nit`, `nombre_empre`, `direccion`, `gmail`, `telefono`) VALUES
(154879, 'sena sofia ', 'asdads', 'sadas@sena.com', '123456789'),
(123456789, 'sena', 'picaleñaa', 'sena@sema.com', '3124758405');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formacion`
--

CREATE TABLE `formacion` (
  `id_formacion` int(6) NOT NULL,
  `formacion` varchar(50) DEFAULT NULL,
  `jornada` enum('mañana','tarde','noche','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formacion`
--

INSERT INTO `formacion` (`id_formacion`, `formacion`, `jornada`) VALUES
(123789, 'alturasa', 'mañana'),
(789456, 'alturasa', 'noche'),
(2500591, 'ADSO', 'mañana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herrramienta`
--

CREATE TABLE `herrramienta` (
  `id_herramienta` int(11) NOT NULL,
  `nombre_he` varchar(40) DEFAULT NULL,
  `id_cate` int(11) DEFAULT NULL,
  `img_herramienta` text NOT NULL,
  `estado` enum('sin prestamo','prestado','en proceso','') DEFAULT NULL,
  `codigo_barras` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `herrramienta`
--

INSERT INTO `herrramienta` (`id_herramienta`, `nombre_he`, `id_cate`, `img_herramienta`, `estado`, `codigo_barras`) VALUES
(10, 'gordoaaaa', NULL, 'gordo-2024-02-20.png', '', '65d49dc6c799c2132'),
(11, 'armerogolll', 2, 'armerogol-2024-02-20.png', 'sin prestamo', '65d4a1023b8cb9668'),
(12, 'ojaniii', 2, 'ojani-2024-02-20.png', 'sin prestamo', '65d4a31031e443877');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `id_licencia` tinyint(4) NOT NULL,
  `licencia` varchar(255) NOT NULL,
  `estado` enum('activo','inactivo','','') NOT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `nit` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `licencia`
--

INSERT INTO `licencia` (`id_licencia`, `licencia`, `estado`, `fecha_inicio`, `fecha_fin`, `nit`) VALUES
(1, '123456', 'activo', '2024-02-26 16:43:18', '2025-02-26 16:43:18', 123456789),
(15, '65e88323d19aa', 'activo', '2024-03-06 15:52:19', '2025-03-06 15:52:19', 154879);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `documento` int(11) DEFAULT NULL,
  `fecha_prestamo` datetime DEFAULT NULL,
  `fecha_devolucion` datetime DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id_reporte` int(11) NOT NULL,
  `id_prestamo` int(11) DEFAULT NULL,
  `fecha_reporte` datetime DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'administrador'),
(2, 'aprendiz'),
(3, 'superadmin'),
(4, 'instructor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tip_doc`
--

CREATE TABLE `tip_doc` (
  `id_tip_doc` int(11) NOT NULL,
  `tipo_doc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tip_doc`
--

INSERT INTO `tip_doc` (`id_tip_doc`, `tipo_doc`) VALUES
(1, 'cedula de ciudadania '),
(2, 'tarjeta de identidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `documento` int(11) NOT NULL,
  `contraseña` text DEFAULT NULL,
  `nombre` varchar(40) NOT NULL,
  `id_tip_doc` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `id_formacion` int(11) DEFAULT NULL,
  `ficha` int(8) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `id_jornada` int(11) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `nit` int(9) DEFAULT NULL,
  `tyc` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`documento`, `contraseña`, `nombre`, `id_tip_doc`, `email`, `id_formacion`, `ficha`, `id_rol`, `id_jornada`, `estado`, `nit`, `tyc`) VALUES
(1489, '$2y$15$IgIYfYbKz.MwPPDTHxK3Uuc9OLqeyZ32XNU1XybEPBgxvxE.OKzeO', 'aer', 1, 'ae@sena.com', NULL, NULL, 4, NULL, 'activo', 123456789, 'si'),
(1782, '$2y$15$J6xTonkYXrHt0/EfKHSY.OA79HVdu8z0G0H1QSeFDLM8gqFMfni4O', 'sena', 1, 'sena@sena.com', NULL, NULL, 4, NULL, 'activo', 123456789, 'si'),
(121212, '$2y$15$iW6fryIRTrg0O/8KdzeF2.L8AWH.xJv/S9GDG4rqfRJMg9t7XEILy', 'cristian', 1, 'cristian@sena.com', NULL, 2501054, 2, 1, 'activo', 123456789, 'si'),
(123456, '$2y$15$CFsV02Sdw/fyLYXISU/oP.CirAdif2ybkXgneH25C1U8naAvAMo1K', '123', 1, 'ar@sena.com', NULL, NULL, 4, NULL, 'activo', 123456789, 'si'),
(171717, '$2y$15$6r4pE4IwUlrwuydtZgvXaOfyBrShteuyG8FIN5cj9jhFeKC/IqL8y', 'admin', 1, 'admin@sena.com', NULL, 231321, 1, 1, 'activo', 123456789, 'si'),
(123456789, '$2y$15$U/NDbxLlDsWrwc0.D5qLFuK94Alo0wxF2zXCncSASe646OOYedZoO', 'armeraaa', 1, 'a@sena.com', NULL, NULL, 4, NULL, 'activo', 123456789, 'si'),
(1107975322, '$2y$15$nmOJkdLlTBmKk7gxu3zg1OpdsI5ufU8GuNdDJiEv15c4sMzQdKxXO', 'cristian figueroa', 1, 'cristianfigueroa040@gmail.com', NULL, 25000, 1, 1, 'activo', 123456789, 'si');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_cate`);

--
-- Indices de la tabla `detalle_instructor`
--
ALTER TABLE `detalle_instructor`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `detalle_pres`
--
ALTER TABLE `detalle_pres`
  ADD PRIMARY KEY (`id_de_pres`);

--
-- Indices de la tabla `deta_reportes`
--
ALTER TABLE `deta_reportes`
  ADD PRIMARY KEY (`id_de_reporte`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `formacion`
--
ALTER TABLE `formacion`
  ADD PRIMARY KEY (`id_formacion`);

--
-- Indices de la tabla `herrramienta`
--
ALTER TABLE `herrramienta`
  ADD PRIMARY KEY (`id_herramienta`);

--
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`licencia`),
  ADD KEY `licencia_ibfk_1` (`nit`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id_reporte`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tip_doc`
--
ALTER TABLE `tip_doc`
  ADD PRIMARY KEY (`id_tip_doc`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `id_tip_doc` (`id_tip_doc`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `nit` (`nit`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_cate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_instructor`
--
ALTER TABLE `detalle_instructor`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `herrramienta`
--
ALTER TABLE `herrramienta`
  MODIFY `id_herramienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tip_doc`
--
ALTER TABLE `tip_doc`
  MODIFY `id_tip_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
