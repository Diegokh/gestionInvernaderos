-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2024 a las 18:19:30
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
-- Base de datos: `gestioninvernaderos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE `alertas` (
  `idAlerta` int(11) NOT NULL,
  `tipoAlerta` varchar(50) NOT NULL,
  `descripcionAlerta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alertas`
--

INSERT INTO `alertas` (`idAlerta`, `tipoAlerta`, `descripcionAlerta`) VALUES
(1, 'alta_temperatura', 'La temperatura dentro del invernadero ha superado los 38 °C.'),
(2, 'baja_temperatura', 'La temperatura dentro del invernadero ha bajado de los 15 °C.'),
(3, 'baja_humedad', 'El nivel de humedad ha caído por debajo del nivel adecuado.'),
(4, 'alta_humedad', 'La humedad relativa a superado el 80%.'),
(5, 'fallo_riego', 'Fallo en el sistema de riego'),
(6, 'fallo_ventilacion', 'Fallo en el sistema de ventilacion'),
(7, 'fallo_iluminacion', 'Fallo en el sistema de iluminacion'),
(8, 'alta_concentracion_co2', 'Alta concentracion de CO2'),
(9, 'baja_concentracion_co2', 'Baja concentracion de CO2'),
(10, 'fallo_calefaccion', 'Fallo en el sistema de calefaccion'),
(11, 'fallo_sensor_temperatura', 'El sensor de temperatura no está funcionando correctamente.'),
(12, 'fallo_sensor_humedad', 'El sensor de humedad no está funcionando correctamente.'),
(13, 'fallo_sensor_co2', 'El sensor de CO2 no está funcionando correctamente.'),
(14, 'fallo_sistema_electrico', 'Fallo en el sistema electrico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos_control`
--

CREATE TABLE `dispositivos_control` (
  `id_Dispositivo` int(11) NOT NULL,
  `tipo_Dispositivo` varchar(50) NOT NULL,
  `estado_Dispositivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dispositivos_control`
--

INSERT INTO `dispositivos_control` (`id_Dispositivo`, `tipo_Dispositivo`, `estado_Dispositivo`) VALUES
(1, 'Ventilacion', 'Apagado'),
(2, 'Sistema de Riego', 'Apagado'),
(3, 'Calefacción', 'Apagado'),
(4, 'Sistemas de Iluminación', 'Apagado'),
(5, 'Sistemas de CO2', 'Apagado'),
(6, 'Sistemas de Deshumidificacion', 'Apagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_control`
--

CREATE TABLE `historial_control` (
  `idHistorial` int(11) NOT NULL,
  `accionHistorial` int(11) NOT NULL,
  `fechaHistorial` date NOT NULL,
  `horaHistorial` time NOT NULL,
  `id_Dispositivo` int(11) NOT NULL,
  `id_Invernadero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_control`
--

INSERT INTO `historial_control` (`idHistorial`, `accionHistorial`, `fechaHistorial`, `horaHistorial`, `id_Dispositivo`, `id_Invernadero`) VALUES
(1, 1, '2024-10-15', '07:00:00', 1, 1),
(2, 2, '2024-10-17', '07:30:00', 2, 1),
(3, 1, '2024-10-19', '08:00:00', 3, 1),
(4, 2, '2024-10-20', '08:30:00', 4, 2),
(5, 1, '2024-10-25', '09:00:00', 1, 2),
(6, 2, '2024-10-27', '09:30:00', 3, 3),
(7, 1, '2024-11-01', '10:00:00', 2, 4),
(8, 2, '2024-11-05', '10:30:00', 4, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invernadero`
--

CREATE TABLE `invernadero` (
  `id_Invernadero` int(11) NOT NULL,
  `ubicacionInvernadero` varchar(50) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `invernadero`
--

INSERT INTO `invernadero` (`id_Invernadero`, `ubicacionInvernadero`, `idUsuario`) VALUES
(1, 'Vicar', 1),
(2, 'El Ejido', 2),
(3, 'La Mojonera', 1),
(4, 'El Ejido', 4),
(5, 'La Mojonera', 3),
(6, 'Nijar', 3),
(7, 'La Mojonera', 3),
(8, 'Roquetas de Mar', 4),
(9, 'Vicar', 4),
(10, 'Vicar', 3),
(11, 'Nijar', 2),
(12, 'El Ejido', 2),
(13, 'Nijar', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecturas`
--

CREATE TABLE `lecturas` (
  `idLectura` int(11) NOT NULL,
  `valor` varchar(50) NOT NULL,
  `hora_Lectura` time NOT NULL,
  `fecha_Lectura` date NOT NULL,
  `idSensor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacionalertausuario`
--

CREATE TABLE `notificacionalertausuario` (
  `idNotificacion` int(11) NOT NULL,
  `fechaNotificacion` date NOT NULL,
  `horaNotificacion` time NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `id_Invernadero` int(11) NOT NULL,
  `idAlerta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificacionalertausuario`
--

INSERT INTO `notificacionalertausuario` (`idNotificacion`, `fechaNotificacion`, `horaNotificacion`, `idUsuario`, `id_Invernadero`, `idAlerta`) VALUES
(1, '2024-11-05', '08:00:00', 1, 1, 1),
(2, '2024-11-09', '09:30:00', 2, 2, 2),
(3, '2024-11-18', '16:00:00', 1, 3, 3),
(4, '2024-11-10', '11:00:00', 4, 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensores`
--

CREATE TABLE `sensores` (
  `idSensor` int(11) NOT NULL,
  `tipo_sensor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sensores`
--

INSERT INTO `sensores` (`idSensor`, `tipo_sensor`) VALUES
(1, 'Temperatura'),
(2, 'Humedad'),
(3, 'Nivel CO2'),
(4, 'Luminosidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensores_inver`
--

CREATE TABLE `sensores_inver` (
  `id_Invernadero` int(11) NOT NULL,
  `idSensor` int(11) NOT NULL,
  `Ubicacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sensores_inver`
--

INSERT INTO `sensores_inver` (`id_Invernadero`, `idSensor`, `Ubicacion`) VALUES
(1, 1, 'Lineo 19'),
(1, 2, 'Lineo 30'),
(1, 3, 'Lineo 11'),
(2, 4, 'Entrada del invernadero'),
(2, 1, 'Lineo 5'),
(3, 3, 'Lineo 50'),
(3, 2, 'Lineo 10'),
(3, 4, 'Entrada del invernadero'),
(4, 1, 'Lineo 43'),
(4, 2, 'Lineo 21'),
(5, 3, 'Lineo 73'),
(6, 4, 'Entrada del invernadero'),
(7, 2, 'Lineo 82'),
(8, 1, 'Lineo 31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(30) NOT NULL,
  `apellidoUsuario` varchar(50) NOT NULL,
  `emailUsuario` varchar(50) NOT NULL,
  `passwordUsuario` varchar(50) NOT NULL,
  `telefonoUsuario` int(11) NOT NULL,
  `rolUsuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreUsuario`, `apellidoUsuario`, `emailUsuario`, `passwordUsuario`, `telefonoUsuario`, `rolUsuario`) VALUES
(1, 'Diego', 'Blanque Saavedra', 'diegoblanque1@gmail.com', 'admin.diego.1', 659102394, 'Estandar'),
(2, 'Fineas', 'Havran', 'fineashavran@gmail.com', 'admin.fineas.2', 691206841, 'Estandar'),
(3, 'Jose', 'Checa', 'josecheca@outlook.com', 'admin.jose.3', 691029430, 'Estandar'),
(4, 'Abde', 'Afendi', 'abdeafendi@hotmail.com', 'admin.abde.4', 699102228, 'Estandar'),
(100, 'administrador', 'admin', 'administracion@agrosmart.com', 'admin.admin', 640318700, 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`idAlerta`);

--
-- Indices de la tabla `dispositivos_control`
--
ALTER TABLE `dispositivos_control`
  ADD PRIMARY KEY (`id_Dispositivo`);

--
-- Indices de la tabla `historial_control`
--
ALTER TABLE `historial_control`
  ADD PRIMARY KEY (`idHistorial`),
  ADD KEY `id_Dispositivo` (`id_Dispositivo`),
  ADD KEY `id_Invernadero` (`id_Invernadero`);

--
-- Indices de la tabla `invernadero`
--
ALTER TABLE `invernadero`
  ADD PRIMARY KEY (`id_Invernadero`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD PRIMARY KEY (`idLectura`),
  ADD KEY `idSensor` (`idSensor`);

--
-- Indices de la tabla `notificacionalertausuario`
--
ALTER TABLE `notificacionalertausuario`
  ADD PRIMARY KEY (`idNotificacion`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `id_Invernadero` (`id_Invernadero`),
  ADD KEY `idAlerta` (`idAlerta`);

--
-- Indices de la tabla `sensores`
--
ALTER TABLE `sensores`
  ADD PRIMARY KEY (`idSensor`);

--
-- Indices de la tabla `sensores_inver`
--
ALTER TABLE `sensores_inver`
  ADD KEY `id_Invernadero` (`id_Invernadero`),
  ADD KEY `idSensor` (`idSensor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `idAlerta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `dispositivos_control`
--
ALTER TABLE `dispositivos_control`
  MODIFY `id_Dispositivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `historial_control`
--
ALTER TABLE `historial_control`
  MODIFY `idHistorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `invernadero`
--
ALTER TABLE `invernadero`
  MODIFY `id_Invernadero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  MODIFY `idLectura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificacionalertausuario`
--
ALTER TABLE `notificacionalertausuario`
  MODIFY `idNotificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sensores`
--
ALTER TABLE `sensores`
  MODIFY `idSensor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial_control`
--
ALTER TABLE `historial_control`
  ADD CONSTRAINT `historial_control_ibfk_1` FOREIGN KEY (`id_Dispositivo`) REFERENCES `dispositivos_control` (`id_Dispositivo`),
  ADD CONSTRAINT `historial_control_ibfk_2` FOREIGN KEY (`id_Invernadero`) REFERENCES `invernadero` (`id_Invernadero`);

--
-- Filtros para la tabla `invernadero`
--
ALTER TABLE `invernadero`
  ADD CONSTRAINT `invernadero_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD CONSTRAINT `lecturas_ibfk_1` FOREIGN KEY (`idSensor`) REFERENCES `sensores` (`idSensor`);

--
-- Filtros para la tabla `notificacionalertausuario`
--
ALTER TABLE `notificacionalertausuario`
  ADD CONSTRAINT `notificacionalertausuario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `notificacionalertausuario_ibfk_2` FOREIGN KEY (`id_Invernadero`) REFERENCES `invernadero` (`id_Invernadero`),
  ADD CONSTRAINT `notificacionalertausuario_ibfk_3` FOREIGN KEY (`idAlerta`) REFERENCES `alertas` (`idAlerta`);

--
-- Filtros para la tabla `sensores_inver`
--
ALTER TABLE `sensores_inver`
  ADD CONSTRAINT `sensores_inver_ibfk_1` FOREIGN KEY (`id_Invernadero`) REFERENCES `invernadero` (`id_Invernadero`),
  ADD CONSTRAINT `sensores_inver_ibfk_2` FOREIGN KEY (`idSensor`) REFERENCES `sensores` (`idSensor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
