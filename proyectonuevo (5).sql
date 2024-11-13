-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2024 a las 17:12:12
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
(7, 'foto_lote/Novillos_30_300/redangus1.jpg', 'imagen', 4),
(8, 'foto_lote/Novillos_30_300/redangus2.jpg', 'imagen', 4),
(9, 'foto_lote/Vaquillonas_20_330/angus1.jpg', 'imagen', 5),
(10, 'foto_lote/Vaquillonas_20_330/angus2.jpg', 'imagen', 5),
(11, 'foto_lote/Novillos_50_250/hereford1.jpg', 'imagen', 6),
(12, 'foto_lote/Novillos_50_250/hereford2.jpg', 'imagen', 6);

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
(1, 'Juan', 'Leites', 'Veterinario', 'perfil_certificador/leites.jpg'),
(2, 'Joaquin', 'Bistolfi', 'Ing. Agrónomo', 'perfil_certificador/joaquin.jpg'),
(3, 'Felipe', 'Castillo', 'Ing. Agronomo, master en mercados', 'perfil_certificador/felipe.jpg'),
(4, 'Mateo', 'Da Rosa', 'Veterinario', 'perfil_certificador/mateo.jpg');

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
(4, 'Novillos', 30, 300, 310, 290, 50, 'muy buena', 'muy bueno', '30 RA', 20, 'clostridiosis, fipronil', 'pradera', 1, 0, 'Lote de excelente calidad compuesto por 30 novillos Red Angus, todos en óptimo estado de salud y con una condición corporal uniforme. Los animales se destacan por su conformación muscular y docilidad, ideales para sistemas de engorde intensivo o extensivo.', '2024-11-13 09:26:00', '2024-11-24 09:26:00', 0, 1),
(5, 'Vaquillonas', 20, 330, 345, 320, 50, 'muy buena', 'muy bueno', '20 AA', 22, 'fipronil', 'pradera', 1, 1, 'Lote de gran calidad compuesto por 20 vaquillonas Aberdeen Angus, en excelente estado sanitario y con una condición corporal homogénea. Estos animales muestran buena estructura y temperamento dócil, siendo una excelente opción para cría o reposición en sistemas de producción.', '2024-11-23 09:41:00', '2024-12-04 09:41:00', 0, 4),
(6, 'Novillos', 50, 250, 270, 230, 70, 'buena', 'regular', '50 HE', 16, 'fipronil', 'pradera', 1, 0, 'Lote de 50 novillos Hereford de buena clase, afectados previamente por la seca, lo cual les dejó en un estado corporal regular. Actualmente, están en proceso de recuperación gracias a su permanencia en una pradera de buena calidad, lo que está mejorando su condición y desarrollo. Estos animales presentan una conformación sólida y son una buena opción para producción en sistemas extensivos.', '2024-11-13 11:29:00', '2024-11-13 11:33:00', 1, 2);

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
(1, 2.20, '2024-11-13 15:32:01', 6, 20),
(2, 2.21, '2024-11-13 15:33:08', 6, 20),
(3, 2.00, '2024-11-13 15:34:07', 4, 20);

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
(1, 200.00, '2024-11-13 11:36:00', 'transferencia', 2);

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
(1, 'No entiendo la seccion de ofertas.', '2024-11-13 13:05:57', 'pendiente', 25),
(2, 'Quisiera saber cada cuanto se actualizan los precios.', '2024-11-13 13:05:57', 'pendiente', 24),
(3, 'Como cierro sesion?', '2024-11-13 13:07:29', 'pendiente', 23);

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
(11, 'Administrador', 'admin', 'admin', 'admin', 'admin@gmail.com', 123456, '$2y$10$pSlpE/4cyFSgRCcW5D1n2.yy6WQpOrxmTdgUHo.z.ssaFuNG6sT0a', 0),
(20, 'usuario', 'mateodr', 'Mateo', 'Da Rosa', 'mateodarosa132@gmail.com', 91786564, '$2y$10$.x03xXo9lywcSAsKxxN5EOjuipvk0Eidn3oOJcb8Yj8O3KVfY/JiG', 0),
(21, 'usuario', 'Felicas', 'Felipe', 'Castillo', 'felipecastillo01040@gmail.com', 99948838, '$2y$10$/jm0knmwSnUiW9p4.Lr30.2KhXlyEHigyxu0klMWLgLj8czsO35fK', 0),
(22, 'usuario', 'Joacobisto', 'Joaquin', 'Bistolfi', 'joacobisto2007@gmail.com', 99000000, '$2y$10$LF1HZNJpTr4CcuNim2.Z3.Laj4FHmKwSLQhPXWnAfRfI.yhFUzzPO', 0),
(23, 'usuario', 'jcpirot', 'Juan', 'Pirotto', 'juancruzpirotto@gmail.com', 99000001, '$2y$10$4OdSysGggGM12E.1qmqjGu2f4OmPluXFH.wZYcy4kmGQf1XhyI0o2', 0),
(24, 'usuario', 'mariu', 'Maria', 'da Cunha Barros', 'mariaeugenia132@gmail.com', 99070445, '$2y$10$aIJqWY0Epld1lAzPniyIb.Lsa/CNx1nJpanUjDfPw1qMsTOphSVx.', 0),
(25, 'usuario', 'alexito2060', 'Johsua', 'Hartwig', 'johsuahartwig@gmail.com', 99086357, '$2y$10$CeKaYaMJfLdHMyHl8RbiYeoUtN4QFcvm5f0ynp4RH9A8mdlVVIJx6', 0);

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
(1, 4, 'Muy bueno todo.', '2024-11-13 12:49:06', 20),
(3, 4, 'Me gusta la pagina.', '2024-11-13 13:02:27', 23),
(4, 5, 'Todo muy bueno.', '2024-11-13 13:02:27', 24);

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
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `unique_usuario` (`usuario`),
  ADD UNIQUE KEY `unique_mail` (`mail`);

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
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `certificador`
--
ALTER TABLE `certificador`
  MODIFY `id_certificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `id_valoracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
