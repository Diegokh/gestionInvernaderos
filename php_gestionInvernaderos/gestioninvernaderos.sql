-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2024 a las 14:31:32
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
  `idAlerta` int(5) NOT NULL,
  `tipoAlerta` varchar(50) NOT NULL,
  `descipcionAlerta` varchar(100) NOT NULL,
  `fechaAlerta` time(6) NOT NULL,
  `horaAlerta` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos_control`
--

CREATE TABLE `dispositivos_control` (
  `id_Dispositivo` int(5) NOT NULL,
  `tipo_Dispositivo` varchar(50) NOT NULL,
  `estado_Dispositivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_control`
--

CREATE TABLE `historial_control` (
  `idHistorial` int(5) NOT NULL,
  `accionHistorial` int(30) NOT NULL,
  `fechaHistorial` date NOT NULL,
  `horaHistorial` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invernadero`
--

CREATE TABLE `invernadero` (
  `id_Invernadero` int(5) NOT NULL,
  `ubicacionInvernadero` varchar(50) NOT NULL,
  `idUsuario` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `invernadero`
--

INSERT INTO `invernadero` (`id_Invernadero`, `ubicacionInvernadero`, `idUsuario`) VALUES
(1, 'Vicar', 1),
(2, 'El Ejido', 2),
(3, 'La Mojonera', 1),
(4, 'El Ejido', 4),
(5, 'La Mojonera', 2),
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
  `idLectura` int(5) NOT NULL,
  `valor` varchar(50) NOT NULL,
  `hora_Lectura` time(6) NOT NULL,
  `fecha_Lectura` date NOT NULL,
  `idSensor` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensores`
--

CREATE TABLE `sensores` (
  `idSensor` int(5) NOT NULL,
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
  `id_Invernadero` int(5) NOT NULL,
  `idSensor` int(5) NOT NULL,
  `Ubicacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(5) NOT NULL,
  `nombreUsuario` varchar(30) NOT NULL,
  `apellidoUsuario` varchar(50) NOT NULL,
  `emailUsuario` varchar(20) NOT NULL,
  `passwordUsuario` varchar(25) NOT NULL,
  `telefonoUsuario` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreUsuario`, `apellidoUsuario`, `emailUsuario`, `passwordUsuario`, `telefonoUsuario`) VALUES
(1, 'Diego', 'Blanque Saavedra', 'diegoblanque1@gmail.', 'admin.diego.1', 659102394),
(2, 'Fineas ', 'Havran', 'fineashavran@gmail.c', 'admin.fineas.2', 691206841),
(3, 'Jose', 'Checa', 'josecheca@outlook.co', 'admin.jose.3', 691029430),
(4, 'Abde', 'Afendi', 'abdeafendi@hotmail.c', 'admin.abde.4', 699102227);

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
  ADD PRIMARY KEY (`idHistorial`);

--
-- Indices de la tabla `invernadero`
--
ALTER TABLE `invernadero`
  ADD PRIMARY KEY (`id_Invernadero`);

--
-- Indices de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD PRIMARY KEY (`idLectura`);

--
-- Indices de la tabla `sensores`
--
ALTER TABLE `sensores`
  ADD PRIMARY KEY (`idSensor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
