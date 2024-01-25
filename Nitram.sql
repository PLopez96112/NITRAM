
--
-- Base de datos: `nitram`
--
CREATE DATABASE IF NOT EXISTS `nitram` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `nitram`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `Id` int(11) NOT NULL,
  `Tipo` varchar(25) NOT NULL,
  `Resumen` varchar(500) NOT NULL,
  `Descripcion` varchar(2500) NOT NULL,
  `Estado` varchar(25) NOT NULL,
  `Fecha_Ultima_actualizacion` date NOT NULL,
  `Fecha_Apertura` date NOT NULL,
  `Fecha_Cierre` int(11) DEFAULT NULL,
  `Gopro_resolutor` int(11) NOT NULL,
  `Solicitante` int(11) NOT NULL,
  `Asignatario` int(11) DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE `tokens` (
  `Id` varchar(255) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Caducidad` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(100) NOT NULL,
  `Contraseña` varchar(255) DEFAULT NULL,
  `Tipo` varchar(5) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT 0,
  `Grupo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `Codigo` varchar(5) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Correo`, `Nombre`, `Apellidos`, `Contraseña`, `Tipo`, `Estado`, `Grupo`) VALUES
(11, 'pedrojose9616@gmail.com', 'Pedro Jose', 'Lopez Martin', '$2y$10$dtzxtE92NA//AL8YuVYFsOEEQu5m8ZNpao04sn2yFKZcyUNHregZW', 'SU', 0, NULL);


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Asignatario` (`Asignatario`),
  ADD KEY `Grupo_resolutor` (`Gupro_resolutor`),
  ADD KEY `Solicitante` (`Solicitante`);
  ADD KEY `Estado` (`Estado`);

--
-- Indices de la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Usuarios` (`Id_Usuario`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Grupo` (`Grupo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `Asignatario` FOREIGN KEY (`Asignatario`) REFERENCES `usuarios` (`Id`),
  ADD CONSTRAINT `Grupo_resolutor` FOREIGN KEY (`Gopro_resolutor`) REFERENCES `grupos` (`Id`),
  ADD CONSTRAINT `Solicitante` FOREIGN KEY (`Solicitante`) REFERENCES `usuarios` (`Id`);
  ADD CONSTRAINT `Estado` FOREIGN KEY (`Estado`) REFERENCES `estados` (`Codigo`);
--
-- Filtros para la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `Uduario` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `Grupo` FOREIGN KEY (`Grupo`) REFERENCES `grupos` (`Id`);
