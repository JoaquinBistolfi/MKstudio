-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2024 a las 22:02:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectonuevo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE `archivo` (
  `id_archivo` int(11) NOT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `archivo`
--

INSERT INTO `archivo` (`id_archivo`, `ruta`, `tipo`, `id_lote`) VALUES
(5, 'foto_lote/1234564324567_1234564324567_1234564324567/mkstudio.jpg', NULL, 3),
(18, 'foto_lote/terneros cruza_80_200/vacas.jpg', NULL, 20),
(28, 'foto_lote/terneritosss_91_91/fotofondo.jpg', 'imagen', 25),
(29, 'foto_lote/terneritosss_91_91/gandado.jpg', 'imagen', 25),
(30, 'foto_lote/terneritosss_91_91/lotebraford.jpg', 'imagen', 25),
(31, 'foto_lote/terneritosss_91_91/novillonegro.jpg', 'imagen', 25),
(32, 'foto_lote/terneros cruza_120_190/fotofondo.jpg', 'imagen', 26),
(33, 'foto_lote/terneros cruza_120_190/gandado.jpg', 'imagen', 26),
(34, 'foto_lote/terneros cruza_120_190/lotebraford.jpg', 'imagen', 26),
(35, 'foto_lote/terneros cruza_120_190/novillonegro.jpg', 'imagen', 26),
(36, 'foto_lote/123123121231231_123123121231231_123123121231231/fotofondo.jpg', 'imagen', 27),
(37, 'foto_lote/123123121231231_123123121231231_123123121231231/gandado.jpg', 'imagen', 27),
(38, 'foto_lote/123123121231231_123123121231231_123123121231231/lotebraford.jpg', 'imagen', 27),
(39, 'foto_lote/123123121231231_123123121231231_123123121231231/novillonegro.jpg', 'imagen', 27),
(40, 'foto_lote/123123123_123123123_123123123/mkstudio.jpg', 'imagen', 28),
(41, 'foto_lote/12112212_12112212_12112212/borrar.png', 'imagen', 29),
(42, 'foto_lote/12112212_12112212_12112212/borrar.png', 'imagen', 30),
(43, 'foto_lote/1231231231_1231231231_1231231231/novillonegro.jpg', 'imagen', 31),
(44, 'foto_lote/12312312312_12312312312_12312312312/lotebraford.jpg', 'imagen', 32),
(45, 'foto_lote/121231312_123123123_12312312/mateo.jpg', 'imagen', 33),
(46, 'foto_lote/121_121_121/Video de WhatsApp 2024-11-11 a las 13.08.28_ab10c719.mp4', 'video', 34),
(47, 'foto_lote/121_121_121/borrar.png', 'imagen', 34),
(48, 'foto_lote/121_121_121/Video de WhatsApp 2024-11-11 a las 13.08.28_ab10c719.mp4', 'video', 35),
(49, 'foto_lote/121_121_121/borrar.png', 'imagen', 35),
(50, 'foto_lote/200_200_200/Video de WhatsApp 2024-11-11 a las 13.08.28_ab10c719.mp4', 'video', 36),
(51, 'foto_lote/200_200_200/borrar.png', 'imagen', 36),
(52, 'foto_lote/200_200_200/ojo-abierto.png', 'imagen', 36),
(53, 'foto_lote/200_200_200/Video de WhatsApp 2024-11-11 a las 13.08.28_ab10c719.mp4', 'video', 37),
(54, 'foto_lote/200_200_200/ojo-abierto.png', 'imagen', 37),
(55, 'foto_lote/200_200_200/avatar.png', 'imagen', 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificador`
--

CREATE TABLE `certificador` (
  `id_certificador` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `profesion` varchar(60) DEFAULT NULL,
  `ruta_archivo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `certificador`
--

INSERT INTO `certificador` (`id_certificador`, `nombre`, `apellido`, `profesion`, `ruta_archivo`) VALUES
(13, 'mama', 'mama', 'mama', 'perfil_certificador/mkstudio.jpg'),
(14, 'mama', 'mama', 'mama', 'perfil_certificador/mkstudio.jpg'),
(15, 'mama', 'mama', 'mama', 'perfil_certificador/mkstudio.jpg'),
(16, 'mama', 'mama', 'mama', 'perfil_certificador/mkstudio.jpg'),
(17, 'mama', 'mama', 'mama', 'perfil_certificador/mkstudio.jpg'),
(18, 'mama', 'mama', 'mama', 'perfil_certificador/mkstudio.jpg'),
(19, 'mama', 'mama', 'mama', 'perfil_certificador/mkstudio.jpg'),
(20, 'mama', 'mama', 'mama', 'perfil_certificador/mkstudio.jpg'),
(21, 'Juan Cruz', 'Pirotto', 'COntador', 'perfil_certificador/avatar.png'),
(22, 'Juan Cruz', 'Pirotto', 'COntador', 'perfil_certificador/avatar.png'),
(23, 'Juan Cruz', 'Pirotto', 'COntador', 'perfil_certificador/avatar.png'),
(24, 'Juan Cruz', 'Pirotto', 'COntador', 'perfil_certificador/avatar.png'),
(25, 'Juan Cruz', 'Pirotto', 'COntador', 'perfil_certificador/avatar.png'),
(26, 'Juan Cruz', 'Pirotto', 'COntador', 'perfil_certificador/avatar.png'),
(27, 'Juan Cruz', 'Pirotto', 'COntador', 'perfil_certificador/avatar.png'),
(28, 'Juan Cruz', 'Pirotto', 'COntador', 'perfil_certificador/avatar.png'),
(29, 'Juan Cruz', 'Pirotto', 'COntador', 'perfil_certificador/avatar.png'),
(30, 'Juan Cruz', 'Pirotto', 'COntador', 'perfil_certificador/avatar.png'),
(31, 'mama', 'mama', 'mama', 'perfil_certificador/avatar.png'),
(32, 'Bruno', 'Da Rosa', 'Ing. Agronomo; master en merca', 'perfil_certificador/avatar.png'),
(33, 'Felipe', 'Castillo', 'Ing. Agronomo; master en mercados', 'perfil_certificador/Imagen de WhatsApp 2024-10-30 a las 08.37.17_583a2ee6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `id_lote` int(11) NOT NULL,
  `categoria` varchar(40) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `peso_promedio` int(11) DEFAULT NULL,
  `peso_maximo` int(11) DEFAULT NULL,
  `peso_minimo` int(11) DEFAULT NULL,
  `cant_pesada` int(11) DEFAULT NULL,
  `clase` varchar(20) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `raza` varchar(60) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `sanidad` varchar(255) DEFAULT NULL,
  `tratamiento_nutricional` varchar(255) DEFAULT NULL,
  `conoce_miomio` tinyint(1) DEFAULT NULL,
  `zona_garrapata` tinyint(1) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `vendido` tinyint(1) NOT NULL DEFAULT 0,
  `id_certificador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id_lote`, `categoria`, `cantidad`, `peso_promedio`, `peso_maximo`, `peso_minimo`, `cant_pesada`, `clase`, `estado`, `raza`, `edad`, `sanidad`, `tratamiento_nutricional`, `conoce_miomio`, `zona_garrapata`, `observaciones`, `fecha_inicio`, `fecha_fin`, `vendido`, `id_certificador`) VALUES
(27, '123123121231231', 2147483647, 2147483647, 2147483647, 2147483647, 2147483647, '123123121231231', '123123121231231', '123123121231231', 2147483647, '123123121231231', '123123121231231', 0, 0, '123123121231231', '2024-11-10 17:56:00', '2024-11-17 17:56:00', 0, 29),
(28, '123123123', 123123123, 123123123, 123123123, 123123123, 123123123, '123123123', '123123123', '123123123', 123123123, '123123123', '123123123', 0, 0, '123123123', '2024-11-10 18:02:00', '2024-11-17 18:02:00', 0, 13),
(29, '12112212', 12112212, 12112212, 12112212, 12112212, 12112212, '12112212', '12112212', '12112212', 12112212, '12112212', '12112212', 0, 0, '12112212', '2024-11-10 18:05:00', '2024-11-10 18:05:00', 0, 13),
(30, '12112212', 12112212, 12112212, 12112212, 12112212, 12112212, '12112212', '12112212', '12112212', 12112212, '12112212', '12112212', 0, 0, '12112212', '2024-11-10 18:06:00', '2024-11-10 18:08:00', 0, 13),
(31, '1231231231', 1231231231, 1231231231, 1231231231, 1231231231, 1231231231, '1231231231', '1231231231', '1231231231', 1231231231, '1231231231', '1231231231', 0, 0, '1231231231', '2024-11-12 19:51:00', '2024-11-17 19:51:00', 0, 13),
(32, '12312312312', 2147483647, 2147483647, 2147483647, 2147483647, 2147483647, '12312312312', '12312312312', '12312312312', 2147483647, '12312312312', '12312312312', 0, 0, '12312312312', '2024-11-10 19:55:00', '2024-11-10 19:56:00', 0, 13),
(33, '121231312', 123123123, 12312312, 123123123, 23123, 12312312, '12312312', '123123', '123123123', 1231231231, '231313', '123123', 0, 0, '', '2024-11-10 22:04:00', '2024-11-16 22:04:00', 0, 32),
(34, '121', 121, 121, 121, 121, 121, '121', '121', '121', 121, '121', '121', 1, 0, '121', '2024-11-11 13:09:00', '2024-11-11 13:11:00', 0, 33),
(35, '121', 121, 121, 121, 121, 121, '121', '121', '121', 121, '121', '121', 1, 0, '121', '2024-11-11 13:09:00', '2024-11-11 13:11:00', 0, 33),
(36, '200', 200, 200, 200, 200, 200, '200', '200', '200', 200, '200', '200', 1, 0, '200', '2024-11-11 13:11:00', '2024-11-11 13:13:00', 0, 13),
(37, '200', 200, 200, 200, 200, 200, '200', '200', '200', 200, '200', '200', 0, 0, '200', '2024-11-11 13:13:00', '2024-11-11 13:16:00', 0, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE `oferta` (
  `id_oferta` int(11) NOT NULL,
  `monto` decimal(3,2) DEFAULT NULL,
  `fecha_oferta` datetime DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`id_oferta`, `monto`, `fecha_oferta`, `id_lote`, `id_usuario`) VALUES
(14, 1.00, '2024-10-18 03:07:22', 7, 10),
(15, 1.10, '2024-10-18 03:08:24', 7, 1),
(16, 1.20, '2024-10-18 03:47:53', 7, 12),
(17, 1.30, '2024-10-18 03:48:50', 7, 10),
(18, 1.31, '2024-10-18 03:51:14', 7, 12),
(20, 2.00, '2024-10-30 12:34:56', 18, 14),
(21, 2.10, '2024-10-30 23:56:30', 20, 10),
(22, 1.98, '2024-10-30 23:56:49', 21, 10),
(23, 1.00, '2024-11-09 20:15:04', 22, 10),
(24, 1.10, '2024-11-09 20:16:22', 22, 14),
(25, 1.20, '2024-11-09 20:38:07', 22, 14),
(26, 1.30, '2024-11-09 20:49:22', 22, 10),
(27, 1.40, '2024-11-09 20:49:37', 22, 14),
(28, 1.50, '2024-11-09 20:53:02', 22, 14),
(29, 1.60, '2024-11-09 20:53:58', 22, 14),
(30, 1.70, '2024-11-09 20:55:32', 22, 10),
(31, 1.80, '2024-11-09 21:01:27', 22, 14),
(32, 1.90, '2024-11-09 21:16:16', 22, 10),
(33, 2.00, '2024-11-09 21:16:23', 22, 14),
(34, 2.00, '2024-11-09 21:16:51', 22, 10),
(35, 2.10, '2024-11-09 21:17:06', 22, 10),
(36, 2.20, '2024-11-09 21:18:33', 22, 10),
(37, 2.30, '2024-11-09 21:18:45', 22, 14),
(38, 2.40, '2024-11-10 21:26:37', 26, 10),
(39, 2.41, '2024-11-10 21:26:52', 26, 10),
(40, 1.00, '2024-11-10 22:07:56', 30, 10),
(41, 3.00, '2024-11-10 22:08:12', 30, 10),
(42, 4.00, '2024-11-10 22:08:17', 30, 10),
(43, 1.10, '2024-11-10 22:29:24', 27, 14),
(44, 1.00, '2024-11-10 23:52:30', 31, 14),
(45, 1.00, '2024-11-10 23:55:51', 32, 14),
(46, 1.20, '2024-11-10 23:58:37', 27, 14),
(47, 1.30, '2024-11-11 00:01:15', 27, 10),
(48, 1.40, '2024-11-11 00:03:57', 27, 10),
(49, 1.50, '2024-11-11 00:13:13', 27, 10),
(50, 1.60, '2024-11-11 00:14:06', 27, 10),
(51, 1.70, '2024-11-11 00:14:40', 27, 10),
(52, 1.71, '2024-11-11 00:16:12', 27, 10),
(53, 1.72, '2024-11-11 00:29:47', 27, 10),
(54, 1.73, '2024-11-11 00:30:32', 27, 14),
(55, 1.74, '2024-11-11 00:33:04', 27, 14),
(56, 1.75, '2024-11-11 00:35:18', 27, 14),
(57, 1.80, '2024-11-11 00:36:27', 27, 14),
(58, 1.81, '2024-11-11 00:45:48', 27, 14),
(59, 1.82, '2024-11-11 00:46:00', 27, 14),
(60, 2.00, '2024-11-11 00:46:09', 27, 10),
(61, 2.10, '2024-11-11 00:48:07', 27, 14),
(62, 2.20, '2024-11-11 00:48:56', 27, 14),
(63, 2.30, '2024-11-11 00:53:12', 27, 10),
(64, 2.40, '2024-11-11 00:53:36', 27, 10),
(65, 2.50, '2024-11-11 00:55:29', 27, 10),
(66, 2.60, '2024-11-11 01:03:07', 27, 14),
(67, 2.80, '2024-11-11 01:03:35', 27, 14),
(68, 3.00, '2024-11-11 01:03:49', 27, 10),
(69, 3.10, '2024-11-11 01:08:16', 27, 10),
(70, 3.20, '2024-11-11 01:08:27', 27, 14),
(71, 1.10, '2024-11-11 13:24:39', 33, 10),
(72, 1.20, '2024-11-11 13:25:49', 33, 10),
(73, 1.21, '2024-11-11 13:26:37', 33, 10),
(74, 1.22, '2024-11-11 13:36:35', 33, 10),
(75, 1.23, '2024-11-11 13:37:14', 33, 10),
(76, 2.00, '2024-11-11 13:37:33', 33, 10),
(77, 2.10, '2024-11-11 13:38:40', 33, 10),
(78, 2.20, '2024-11-11 13:39:53', 33, 10),
(79, 2.30, '2024-11-11 13:51:06', 33, 10),
(80, 2.31, '2024-11-11 13:51:18', 33, 10),
(81, 2.32, '2024-11-11 13:54:36', 33, 10),
(82, 2.33, '2024-11-11 13:55:22', 33, 10),
(83, 2.34, '2024-11-11 13:55:50', 33, 10),
(84, 2.35, '2024-11-11 13:56:07', 33, 10),
(85, 2.36, '2024-11-11 13:59:06', 33, 10),
(86, 2.37, '2024-11-11 14:00:22', 33, 10),
(87, 2.38, '2024-11-11 14:25:13', 33, 10),
(88, 2.39, '2024-11-11 14:25:24', 33, 10),
(89, 3.00, '2024-11-11 14:25:36', 33, 10),
(90, 3.10, '2024-11-11 14:26:18', 33, 10),
(91, 3.30, '2024-11-11 16:32:16', 27, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `monto_pago` decimal(10,2) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  `id_oferta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id_pago`, `monto_pago`, `fecha`, `metodo_pago`, `id_oferta`) VALUES
(1, 1000.00, '2024-10-29 21:05:00', 'cheque', 22),
(2, 10000.00, '2024-10-30 21:09:00', 'transferencia', 22),
(3, 5000.00, '2024-10-30 21:14:00', 'transferencia', 20),
(4, 1000.00, '2024-10-31 07:42:00', 'transferencia', 22),
(5, 60000.00, '2024-11-08 16:14:00', 'transferencia', 18),
(6, 33600.00, '2024-11-10 17:16:00', 'transferencia', 21),
(7, 54948.00, '2024-11-10 17:36:00', 'transferencia', 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_pregunta` int(11) NOT NULL,
  `contenido` text DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` varchar(15) DEFAULT 'pendiente',
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_pregunta`, `contenido`, `fecha`, `estado`, `id_usuario`) VALUES
(3, 'COMO SE OFERTA?', '2024-10-17 23:15:31', 'pendiente', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'usuario',
  `usuario` varchar(30) DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `bloqueado` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `rol`, `usuario`, `nombre`, `apellido`, `mail`, `telefono`, `contrasena`, `bloqueado`) VALUES
(1, 'Administrador', 'mateo', 'mateo', 'mateo', 'mateodarosa132@gmail.com', 91786564, '$2y$10$hF3g6Bs/X3hYu5L/uFqSKO3IFqENmc.GxopIED/87kvLx8BVom2aq', 0),
(2, 'usuario', 'usuario', 'usuario', 'usuario', 'mateodarosa132@gmail.com', 12345567, '$2y$10$hF3g6Bs/X3hYu5L/uFqSKO3IFqENmc.GxopIED/87kvLx8BVom2aq', 0),
(3, 'usuario', 'usuario', 'usuario', 'usuario', 'mateodarosa132@gmail.com', 21345676, '$2y$10$hF3g6Bs/X3hYu5L/uFqSKO3IFqENmc.GxopIED/87kvLx8BVom2aq', 0),
(4, 'usuario', 'joaquin', 'joaquin', 'joaquin', 'joaquin', 123456, '$2y$10$lPGRpd00lzzkV9cckr/aB.P', 0),
(5, 'usuario', 'felipe', 'felipe', 'felipe', 'felipe', 1234, '$2y$10$QCSz.nDTHidI0IbAqssl8eN', 0),
(6, 'usuario', 'LEITE', 'LEITE', 'LEITE', 'LEITE', 4567, '$2y$10$AABuvVr2DX442KHj9Vle4O.', 0),
(7, 'usuario', 'LEITE', 'LEITE', 'LEITE', 'LEITE', 12345, '$2y$10$jWjpNwazLeiskyArtvdtCO3', 0),
(8, 'usuario', 'usr', 'usr', 'usr', 'usr', 12345, '$2y$10$uATD/i2WsSRn8Ym0hYpr9.z', 0),
(9, 'usuario', 'USR2', 'USR2', 'USR2', 'USR2', 1243, '$2y$10$Ouj4lOU58JJEhY7ESyAO4ua', 0),
(10, 'usuario', 'USR3', 'USR3', 'USR3', 'USR3', 21345, '$2y$10$55fhde3.fAPdnXplSBOB4.gx1zCLhOByGbOIlFqcyr.3MmNKailMa', 0),
(11, 'Administrador', 'admin', 'admin', 'admin', 'admin@gmail.com', 123456, '$2y$10$pSlpE/4cyFSgRCcW5D1n2.yy6WQpOrxmTdgUHo.z.ssaFuNG6sT0a', 0),
(12, 'usuario', 'mama', 'mama', 'mama', 'mama', 123453, '$2y$10$6FOv5pabex7PB5lZJUrHy.uaKhAA3BOzAP6UYdv/Zk/Du9QUJnNvS', 1),
(13, 'usuario', 'titi', 'titi', 'titi', 'titi', 123456, '$2y$10$cSx8lwQ.zk0pVyUFZ1mJ9ua/Ht8hnCB.wGyuIr4EK36OpygdABCr.', 0),
(14, 'usuario', 'mateodr17', 'Mateo', 'Da Rosa', 'mateodarosa132@gmail.com', 98765445, '$2y$10$hF3g6Bs/X3hYu5L/uFqSKO3IFqENmc.GxopIED/87kvLx8BVom2aq', 0),
(15, 'usuario', 'USR4', 'USR4', 'USR4', 'USR4', 4, '$2y$10$37InggRF2SQEjthF1CNUo.gbU908z/vVi1N0u1fOXWGzjzNTFTnJu', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

CREATE TABLE `valoracion` (
  `id_valoracion` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valoracion`
--

INSERT INTO `valoracion` (`id_valoracion`, `calificacion`, `comentario`, `fecha`, `id_usuario`) VALUES
(1, 4, 'me gusta', '2024-10-29 07:16:49', 11),
(2, 2, 'ME GUSTA\r\n', '2024-11-11 12:31:38', 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `id_lote` (`id_lote`);

--
-- Indices de la tabla `certificador`
--
ALTER TABLE `certificador`
  ADD PRIMARY KEY (`id_certificador`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `id_certificador` (`id_certificador`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`id_oferta`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_oferta` (`id_oferta`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD PRIMARY KEY (`id_valoracion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivo`
--
ALTER TABLE `archivo`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `certificador`
--
ALTER TABLE `certificador`
  MODIFY `id_certificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `id_valoracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `archivo_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`);

--
-- Filtros para la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`id_certificador`) REFERENCES `certificador` (`id_certificador`);

--
-- Filtros para la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `oferta_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`id_oferta`) REFERENCES `oferta` (`id_oferta`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD CONSTRAINT `valoracion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
