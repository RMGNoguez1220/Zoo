-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2023 a las 23:31:02
-- Versión del servidor: 8.1.0
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zoobd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animal`
--

CREATE TABLE `animal` (
  `IdAnimal` int NOT NULL,
  `NombreComun` varchar(50) NOT NULL,
  `NombreCientifico` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Apodo` varchar(50) DEFAULT NULL,
  `FechaLlegada` date NOT NULL,
  `FechaSalida` date DEFAULT NULL,
  `TipoAlimentacion_id` int DEFAULT NULL,
  `Habitat_id` int DEFAULT NULL,
  `Especie_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catusuario`
--

CREATE TABLE `catusuario` (
  `IdCatUsuario` int NOT NULL,
  `TipoUsuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `IdClasificacion` int NOT NULL,
  `Clasificacion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clima`
--

CREATE TABLE `clima` (
  `IdClima` int NOT NULL,
  `Clima` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `IdEspecie` int NOT NULL,
  `Especie` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Clasificacion_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitat`
--

CREATE TABLE `habitat` (
  `IdHabitat` int NOT NULL,
  `Descripcion` text NOT NULL,
  `Clima_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido`
--

CREATE TABLE `recorrido` (
  `IdRecorrido` int NOT NULL,
  `Horario` time DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `TipoRecorrido` varchar(25) DEFAULT NULL,
  `Guia_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido_habitat`
--

CREATE TABLE `recorrido_habitat` (
  `Recorrido_id` int NOT NULL,
  `Habitat_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoalimentacion`
--

CREATE TABLE `tipoalimentacion` (
  `IdTipoAlimentacion` int NOT NULL,
  `TipoAlimentacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Apellidos` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Correo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Contrasena` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CatUsuario_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`IdAnimal`),
  ADD KEY `id_AnimalFK1` (`Especie_id`),
  ADD KEY `id_AnimalFK2` (`TipoAlimentacion_id`),
  ADD KEY `id_AnimalFK3` (`Habitat_id`);

--
-- Indices de la tabla `catusuario`
--
ALTER TABLE `catusuario`
  ADD PRIMARY KEY (`IdCatUsuario`);

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`IdClasificacion`);

--
-- Indices de la tabla `clima`
--
ALTER TABLE `clima`
  ADD PRIMARY KEY (`IdClima`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`IdEspecie`),
  ADD KEY `id_clasificacionFK` (`Clasificacion_id`);

--
-- Indices de la tabla `habitat`
--
ALTER TABLE `habitat`
  ADD PRIMARY KEY (`IdHabitat`),
  ADD KEY `id_HabitatFK` (`Clima_id`);

--
-- Indices de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  ADD PRIMARY KEY (`IdRecorrido`),
  ADD KEY `RecorridoFK` (`Guia_id`);

--
-- Indices de la tabla `recorrido_habitat`
--
ALTER TABLE `recorrido_habitat`
  ADD PRIMARY KEY (`Recorrido_id`,`Habitat_id`),
  ADD KEY `PasanFK1` (`Recorrido_id`),
  ADD KEY `PasanFK2` (`Habitat_id`) USING BTREE;

--
-- Indices de la tabla `tipoalimentacion`
--
ALTER TABLE `tipoalimentacion`
  ADD PRIMARY KEY (`IdTipoAlimentacion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `UsuarioFK` (`CatUsuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animal`
--
ALTER TABLE `animal`
  MODIFY `IdAnimal` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catusuario`
--
ALTER TABLE `catusuario`
  MODIFY `IdCatUsuario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  MODIFY `IdClasificacion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clima`
--
ALTER TABLE `clima`
  MODIFY `IdClima` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `IdEspecie` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habitat`
--
ALTER TABLE `habitat`
  MODIFY `IdHabitat` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  MODIFY `IdRecorrido` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoalimentacion`
--
ALTER TABLE `tipoalimentacion`
  MODIFY `IdTipoAlimentacion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `id_AnimalFK1` FOREIGN KEY (`Especie_id`) REFERENCES `especie` (`IdEspecie`),
  ADD CONSTRAINT `id_AnimalFK2` FOREIGN KEY (`TipoAlimentacion_id`) REFERENCES `tipoalimentacion` (`IdTipoAlimentacion`),
  ADD CONSTRAINT `id_AnimalFK3` FOREIGN KEY (`Habitat_id`) REFERENCES `habitat` (`IdHabitat`);

--
-- Filtros para la tabla `especie`
--
ALTER TABLE `especie`
  ADD CONSTRAINT `id_clasificacionFK` FOREIGN KEY (`Clasificacion_id`) REFERENCES `clasificacion` (`IdClasificacion`);

--
-- Filtros para la tabla `habitat`
--
ALTER TABLE `habitat`
  ADD CONSTRAINT `id_HabitatFK` FOREIGN KEY (`Clima_id`) REFERENCES `clima` (`IdClima`);

--
-- Filtros para la tabla `recorrido`
--
ALTER TABLE `recorrido`
  ADD CONSTRAINT `RecorridoFK` FOREIGN KEY (`Guia_id`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `recorrido_habitat`
--
ALTER TABLE `recorrido_habitat`
  ADD CONSTRAINT `PasanFK1` FOREIGN KEY (`Recorrido_id`) REFERENCES `recorrido` (`IdRecorrido`),
  ADD CONSTRAINT `PasanFK2` FOREIGN KEY (`Habitat_id`) REFERENCES `habitat` (`IdHabitat`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `UsuarioFK` FOREIGN KEY (`CatUsuario_id`) REFERENCES `catusuario` (`IdCatUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
