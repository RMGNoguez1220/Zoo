-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2023 a las 09:25:29
-- Versión del servidor: 8.1.0
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zoo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animal`
--

CREATE TABLE `animal` (
  `id_Animal` int NOT NULL,
  `NombreComun` varchar(50) NOT NULL,
  `Apodo` varchar(50) DEFAULT NULL,
  `NombreCientifico` varchar(70) NOT NULL,
  `FechaLlegada` date NOT NULL,
  `FechaSalida` date DEFAULT NULL,
  `especie_id` int DEFAULT NULL,
  `tipo_alimentacion_id` int DEFAULT NULL,
  `habitat_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catusuario`
--

CREATE TABLE `catusuario` (
  `id_CatUsuario` int NOT NULL,
  `TipoUsuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `id_Clasificacion` int NOT NULL,
  `clasificacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clima`
--

CREATE TABLE `clima` (
  `id_Clima` int NOT NULL,
  `Clima` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_Empleado` int NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `id_CatUsuario` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `id_Especie` int NOT NULL,
  `especie` varchar(50) NOT NULL,
  `id_clasificacion` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitat`
--

CREATE TABLE `habitat` (
  `id_Habitat` int NOT NULL,
  `Descripcion` text NOT NULL,
  `id_Clima` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido`
--

CREATE TABLE `recorrido` (
  `id_Recorrido` int NOT NULL,
  `Horario` time DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `TipoRecorrido` varchar(25) DEFAULT NULL,
  `id_guia` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido_habitat`
--

CREATE TABLE `recorrido_habitat` (
  `id_Recorrido` int NOT NULL,
  `id_Habitat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoalimentacion`
--

CREATE TABLE `tipoalimentacion` (
  `id_TipoAlimentacion` int NOT NULL,
  `TipoAlimentacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id_Animal`),
  ADD KEY `id_AnimalFK1` (`especie_id`),
  ADD KEY `id_AnimalFK2` (`tipo_alimentacion_id`),
  ADD KEY `id_AnimalFK3` (`habitat_id`);

--
-- Indices de la tabla `catusuario`
--
ALTER TABLE `catusuario`
  ADD PRIMARY KEY (`id_CatUsuario`);

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`id_Clasificacion`);

--
-- Indices de la tabla `clima`
--
ALTER TABLE `clima`
  ADD PRIMARY KEY (`id_Clima`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_Empleado`),
  ADD KEY `EmpleadoFK` (`id_CatUsuario`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`id_Especie`),
  ADD KEY `id_clasificacionFK` (`id_clasificacion`);

--
-- Indices de la tabla `habitat`
--
ALTER TABLE `habitat`
  ADD PRIMARY KEY (`id_Habitat`),
  ADD KEY `id_HabitatFK` (`id_Clima`);

--
-- Indices de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  ADD PRIMARY KEY (`id_Recorrido`),
  ADD KEY `RecorridoFK` (`id_guia`);

--
-- Indices de la tabla `recorrido_habitat`
--
ALTER TABLE `recorrido_habitat`
  ADD PRIMARY KEY (`id_Recorrido`,`id_Habitat`),
  ADD KEY `PasanFK2` (`id_Habitat`);

--
-- Indices de la tabla `tipoalimentacion`
--
ALTER TABLE `tipoalimentacion`
  ADD PRIMARY KEY (`id_TipoAlimentacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animal`
--
ALTER TABLE `animal`
  MODIFY `id_Animal` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catusuario`
--
ALTER TABLE `catusuario`
  MODIFY `id_CatUsuario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  MODIFY `id_Clasificacion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clima`
--
ALTER TABLE `clima`
  MODIFY `id_Clima` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_Empleado` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `id_Especie` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habitat`
--
ALTER TABLE `habitat`
  MODIFY `id_Habitat` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  MODIFY `id_Recorrido` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoalimentacion`
--
ALTER TABLE `tipoalimentacion`
  MODIFY `id_TipoAlimentacion` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `id_AnimalFK1` FOREIGN KEY (`especie_id`) REFERENCES `especie` (`id_Especie`),
  ADD CONSTRAINT `id_AnimalFK2` FOREIGN KEY (`tipo_alimentacion_id`) REFERENCES `tipoalimentacion` (`id_TipoAlimentacion`),
  ADD CONSTRAINT `id_AnimalFK3` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`id_Habitat`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `EmpleadoFK` FOREIGN KEY (`id_CatUsuario`) REFERENCES `catusuario` (`id_CatUsuario`);

--
-- Filtros para la tabla `especie`
--
ALTER TABLE `especie`
  ADD CONSTRAINT `id_clasificacionFK` FOREIGN KEY (`id_clasificacion`) REFERENCES `clasificacion` (`id_Clasificacion`);

--
-- Filtros para la tabla `habitat`
--
ALTER TABLE `habitat`
  ADD CONSTRAINT `id_HabitatFK` FOREIGN KEY (`id_Clima`) REFERENCES `clima` (`id_Clima`);

--
-- Filtros para la tabla `recorrido`
--
ALTER TABLE `recorrido`
  ADD CONSTRAINT `RecorridoFK` FOREIGN KEY (`id_guia`) REFERENCES `empleado` (`id_Empleado`);

--
-- Filtros para la tabla `recorrido_habitat`
--
ALTER TABLE `recorrido_habitat`
  ADD CONSTRAINT `PasanFK1` FOREIGN KEY (`id_Recorrido`) REFERENCES `recorrido` (`id_Recorrido`),
  ADD CONSTRAINT `PasanFK2` FOREIGN KEY (`id_Habitat`) REFERENCES `habitat` (`id_Habitat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
