-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2024 a las 19:36:43
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
(6, 'foto_lote/12343332234323142_12343332234323142_12343332234323142/vacas.jpg', NULL, 4),
(7, 'foto_lote/12345123425421435_12345123425421435_12345123425421435/vacas.jpg', NULL, 5),
(8, 'foto_lote/12325436563122435_12325436563122435_12325436563122435/avatar.png', NULL, 6),
(9, 'foto_lote/terneros_98_150/vacas.jpg', NULL, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificador`
--

CREATE TABLE `certificador` (
  `id_certificador` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `profesion` varchar(30) DEFAULT NULL,
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
(31, 'mama', 'mama', 'mama', 'perfil_certificador/avatar.png');

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
  `mochos` int(11) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `sanidad` varchar(255) DEFAULT NULL,
  `tratamiento_nutricional` varchar(255) DEFAULT NULL,
  `conoce_miomio` tinyint(1) DEFAULT NULL,
  `zona_garrapata` tinyint(1) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `id_certificador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id_lote`, `categoria`, `cantidad`, `peso_promedio`, `peso_maximo`, `peso_minimo`, `cant_pesada`, `clase`, `estado`, `raza`, `mochos`, `edad`, `sanidad`, `tratamiento_nutricional`, `conoce_miomio`, `zona_garrapata`, `observaciones`, `fecha_inicio`, `fecha_fin`, `id_certificador`) VALUES
(3, '1234564324567', 2147483647, 2147483647, 2147483647, 2147483647, 2147483647, NULL, '1234564324567', NULL, 2147483647, 2147483647, '1234564324567', '1234564324567', 1, 0, '1234564324567', '2024-10-17 14:30:00', '2024-10-18 14:30:00', NULL),
(4, '12343332234323142', 2147483647, 2147483647, 2147483647, 2147483647, 2147483647, NULL, '12343332234323142', NULL, 2147483647, 2147483647, '12343332234323142', '12343332234323142', 1, 0, '12343332234323142', '2024-10-17 14:30:00', '2024-10-18 14:30:00', NULL),
(5, '12345123425421435', 2147483647, 2147483647, 2147483647, 2147483647, 2147483647, NULL, '12345123425421435', '12345123425421435', 2147483647, 2147483647, '12345123425421435', '12345123425421435', 1, 0, '12345123425421435', '2024-10-17 14:30:00', '2024-10-18 14:30:00', NULL),
(6, '12325436563122435', 2147483647, 2147483647, 2147483647, 2147483647, 2147483647, NULL, '12325436563122435', '12325436563122435', 2147483647, 2147483647, '12325436563122435', '12325436563122435', 1, 0, '12325436563122435', '2024-10-17 14:30:00', '2024-10-18 14:30:00', NULL),
(7, 'terneros', 98, 150, 170, 130, 40, NULL, '', '30he, 30aa, 30ra, 8ho', 30, 9, 'clostridiosis', 'avena', 1, 0, 'Buen lote de novillos Sola Marca Hereford, de buenas conformaciones carniceras, parejos en clase y estado. Con buen desarrollo. El 50 % pesa entre 260 y 290 kg. Uno un poco atorunado y uno con leve traumatismo en cuarto, sin problema. Lote sano, manso y bien trabajado que conocen eléctrico y saben comer ración.', '2024-10-17 14:30:00', '2024-10-18 14:30:00', NULL);

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
(18, 1.31, '2024-10-18 03:51:14', 7, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  `id_oferta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'adfsasa', NULL, 'pendiente', 12),
(2, '', '2024-10-17 23:15:15', 'pendiente', 10),
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
  `contrasena` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `rol`, `usuario`, `nombre`, `apellido`, `mail`, `telefono`, `contrasena`) VALUES
(1, 'Administrador', 'mateo', 'mateo', 'mateo', 'mateodarosa132@gmail.com', 91786564, 'mateo1317'),
(2, 'usuario', 'usuario', 'usuario', 'usuario', 'mateodarosa132@gmail.com', 12345567, 'usuario'),
(3, 'usuario', 'usuario', 'usuario', 'usuario', 'mateodarosa132@gmail.com', 21345676, 'usuario'),
(4, 'usuario', 'joaquin', 'joaquin', 'joaquin', 'joaquin', 123456, '$2y$10$lPGRpd00lzzkV9cckr/aB.P'),
(5, 'usuario', 'felipe', 'felipe', 'felipe', 'felipe', 1234, '$2y$10$QCSz.nDTHidI0IbAqssl8eN'),
(6, 'usuario', 'LEITE', 'LEITE', 'LEITE', 'LEITE', 4567, '$2y$10$AABuvVr2DX442KHj9Vle4O.'),
(7, 'usuario', 'LEITE', 'LEITE', 'LEITE', 'LEITE', 12345, '$2y$10$jWjpNwazLeiskyArtvdtCO3'),
(8, 'usuario', 'usr', 'usr', 'usr', 'usr', 12345, '$2y$10$uATD/i2WsSRn8Ym0hYpr9.z'),
(9, 'usuario', 'USR2', 'USR2', 'USR2', 'USR2', 1243, '$2y$10$Ouj4lOU58JJEhY7ESyAO4ua'),
(10, 'usuario', 'USR3', 'USR3', 'USR3', 'USR3', 21345, '$2y$10$55fhde3.fAPdnXplSBOB4.gx1zCLhOByGbOIlFqcyr.3MmNKailMa'),
(11, 'Administrador', 'admin', 'admin', 'admin', 'admin@gmail.com', 123456, '$2y$10$pSlpE/4cyFSgRCcW5D1n2.yy6WQpOrxmTdgUHo.z.ssaFuNG6sT0a'),
(12, 'usuario', 'mama', 'mama', 'mama', 'mama', 123453, '$2y$10$6FOv5pabex7PB5lZJUrHy.uaKhAA3BOzAP6UYdv/Zk/Du9QUJnNvS'),
(13, 'usuario', 'titi', 'titi', 'titi', 'titi', 123456, '$2y$10$cSx8lwQ.zk0pVyUFZ1mJ9ua/Ht8hnCB.wGyuIr4EK36OpygdABCr.');

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
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `certificador`
--
ALTER TABLE `certificador`
  MODIFY `id_certificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `id_valoracion` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `oferta_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`),
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
