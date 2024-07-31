-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-07-2024 a las 14:15:15
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
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `ruta_archivo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id`, `titulo`, `ruta_archivo`) VALUES
(23, '1 joaquin bien perritp', 'foto_lote/1 joaquin bien perritp/1 joaquin bien perritp_Entrevista.png'),
(24, '20 toros hereford', 'foto_lote/20 toros hereford/20 toros hereford_juve2.jpg'),
(25, '20 toros hereford', 'foto_lote/20 toros hereford/20 toros hereford_juve2.jpg'),
(26, 'felipe entangado', 'foto_lote/felipe entangado/felipe entangado_png-clipart-modiano-playing-card-poker-card-game-trophy-others-retail-rectangle-removebg-preview.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `uid` int(11) NOT NULL,
  `usuario` varchar(11) NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `apellido` varchar(11) NOT NULL,
  `documento` int(8) NOT NULL,
  `contrasena` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`uid`, `usuario`, `nombre`, `apellido`, `documento`, `contrasena`) VALUES
(4, 'feli', 'feli', 'feli', 12312313, 'feli'),
(5, 'mateodr17', 'mateo', 'da rosa', 123123123, 'mateo'),
(12, 'johsua1', 'johsua', 'hartwig', 2147483647, 'mateo'),
(13, 'juancito', 'jan', 'juan', 234234, 'juan'),
(14, 'prueba', 'jan', 'juan', 1231232123, 'prueba');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `documento` (`documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
