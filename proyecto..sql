-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-09-2024 a las 02:52:33
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificador`
--

CREATE TABLE `certificador` (
  `ID_Certificador` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido` varchar(50) DEFAULT NULL,
  `Fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `ID_Lote` int(11) NOT NULL,
  `Categoria` varchar(50) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Peso_Prom` int(11) DEFAULT NULL,
  `Peso_Max` int(11) DEFAULT NULL,
  `Peso_Min` int(11) DEFAULT NULL,
  `Porc_Pesada` int(11) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Estado_Reproductivo` varchar(50) DEFAULT NULL,
  `Castrados` varchar(50) DEFAULT NULL,
  `Cantidad_Raza` varchar(50) DEFAULT NULL,
  `Edad` varchar(50) DEFAULT NULL,
  `Sanidad` varchar(50) DEFAULT NULL,
  `Trat_Nutricional` varchar(50) DEFAULT NULL,
  `Conoce_MiOMiO` tinyint(1) DEFAULT NULL,
  `Zona_Garrapata` tinyint(1) DEFAULT NULL,
  `Trazabilidad` varchar(50) DEFAULT NULL,
  `Destetados` varchar(50) DEFAULT NULL,
  `Mochos` varchar(50) DEFAULT NULL,
  `Observaciones` text DEFAULT NULL,
  `ID_Certificador` int(11) DEFAULT NULL,
  `Ruta_archivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes_mail`
--

CREATE TABLE `lotes_mail` (
  `ID_Lote` int(11) NOT NULL,
  `ID_Mail` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mail`
--

CREATE TABLE `mail` (
  `ID_Mail` int(11) NOT NULL,
  `Asunto` varchar(100) DEFAULT NULL,
  `Contenido` text DEFAULT NULL,
  `Fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE `oferta` (
  `ID_Oferta` int(11) NOT NULL,
  `Monto` decimal(10,2) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `ID_Lote` int(11) DEFAULT NULL,
  `ID_Usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `ID_Pago` int(11) NOT NULL,
  `Monto` decimal(10,2) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Metodo_Pago` varchar(50) DEFAULT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `ID_Oferta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `ID_Pregunta` int(11) NOT NULL,
  `Contenido` text DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `ID_Usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_oferta`
--

CREATE TABLE `pre_oferta` (
  `ID_Pre_Oferta` int(11) NOT NULL,
  `Monto` decimal(10,2) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `ID_Lote` int(11) DEFAULT NULL,
  `ID_Usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_Usuario` int(11) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Contrasena` varchar(20) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Telefono` varchar(50) DEFAULT NULL,
  `rol` varchar(20) DEFAULT 'Cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_mail`
--

CREATE TABLE `usuarios_mail` (
  `ID_Usuario` int(11) NOT NULL,
  `ID_Mail` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `certificador`
--
ALTER TABLE `certificador`
  ADD PRIMARY KEY (`ID_Certificador`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`ID_Lote`),
  ADD KEY `ID_Certificador` (`ID_Certificador`);

--
-- Indices de la tabla `lotes_mail`
--
ALTER TABLE `lotes_mail`
  ADD PRIMARY KEY (`ID_Lote`,`ID_Mail`),
  ADD KEY `ID_Mail` (`ID_Mail`);

--
-- Indices de la tabla `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`ID_Mail`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`ID_Oferta`),
  ADD UNIQUE KEY `monto_lote_unico` (`Monto`,`ID_Lote`),
  ADD KEY `ID_Lote` (`ID_Lote`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`ID_Pago`),
  ADD KEY `ID_Usuario` (`ID_Usuario`),
  ADD KEY `ID_Oferta` (`ID_Oferta`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`ID_Pregunta`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `pre_oferta`
--
ALTER TABLE `pre_oferta`
  ADD PRIMARY KEY (`ID_Pre_Oferta`),
  ADD KEY `ID_Lote` (`ID_Lote`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- Indices de la tabla `usuarios_mail`
--
ALTER TABLE `usuarios_mail`
  ADD PRIMARY KEY (`ID_Usuario`,`ID_Mail`),
  ADD KEY `ID_Mail` (`ID_Mail`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `certificador`
--
ALTER TABLE `certificador`
  MODIFY `ID_Certificador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `ID_Lote` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mail`
--
ALTER TABLE `mail`
  MODIFY `ID_Mail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `ID_Oferta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `ID_Pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `ID_Pregunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pre_oferta`
--
ALTER TABLE `pre_oferta`
  MODIFY `ID_Pre_Oferta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`ID_Certificador`) REFERENCES `certificador` (`ID_Certificador`);

--
-- Filtros para la tabla `lotes_mail`
--
ALTER TABLE `lotes_mail`
  ADD CONSTRAINT `lotes_mail_ibfk_1` FOREIGN KEY (`ID_Lote`) REFERENCES `lotes` (`ID_Lote`),
  ADD CONSTRAINT `lotes_mail_ibfk_2` FOREIGN KEY (`ID_Mail`) REFERENCES `mail` (`ID_Mail`);

--
-- Filtros para la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `oferta_ibfk_1` FOREIGN KEY (`ID_Lote`) REFERENCES `lotes` (`ID_Lote`),
  ADD CONSTRAINT `oferta_ibfk_2` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`),
  ADD CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`ID_Oferta`) REFERENCES `oferta` (`ID_Oferta`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`);

--
-- Filtros para la tabla `pre_oferta`
--
ALTER TABLE `pre_oferta`
  ADD CONSTRAINT `pre_oferta_ibfk_1` FOREIGN KEY (`ID_Lote`) REFERENCES `lotes` (`ID_Lote`) ON DELETE CASCADE,
  ADD CONSTRAINT `pre_oferta_ibfk_2` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios_mail`
--
ALTER TABLE `usuarios_mail`
  ADD CONSTRAINT `usuarios_mail_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`),
  ADD CONSTRAINT `usuarios_mail_ibfk_2` FOREIGN KEY (`ID_Mail`) REFERENCES `mail` (`ID_Mail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
