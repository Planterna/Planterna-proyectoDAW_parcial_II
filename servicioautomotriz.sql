-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2025 a las 06:25:45
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
-- Base de datos: `servicioautomotriz`
--
CREATE DATABASE IF NOT EXISTS `servicioautomotriz` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `servicioautomotriz`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `id_cotizacion` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `correo_cliente` varchar(100) NOT NULL,
  `telefono_cliente` varchar(20) DEFAULT NULL,
  `descripcion_servicio` text NOT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'Pendiente',
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`id_cotizacion`, `nombre_cliente`, `correo_cliente`, `telefono_cliente`, `descripcion_servicio`, `estado`, `fecha_solicitud`) VALUES
(5, 'lopez', 'steven14@gmail.com', '0960910935', 'necesito reparacion del motor ', 'Cancelada', '2025-07-14 04:16:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `mar_id` int(11) NOT NULL,
  `mar_nombre` varchar(100) NOT NULL,
  `mar_codigo` varchar(20) DEFAULT NULL,
  `mar_telefono` varchar(20) DEFAULT NULL,
  `mar_email` varchar(100) DEFAULT NULL,
  `mar_descripcion` varchar(255) DEFAULT NULL,
  `mar_fechaCreacion` datetime DEFAULT NULL,
  `mar_fechaActualizacion` datetime DEFAULT NULL,
  `mar_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`mar_id`, `mar_nombre`, `mar_codigo`, `mar_telefono`, `mar_email`, `mar_descripcion`, `mar_fechaCreacion`, `mar_fechaActualizacion`, `mar_estado`) VALUES
(1, 'Bosch', 'BOS123', '123-456-7890', 'Bosh@gmail.com', 'Marca líder en componentes automotrices.', '2022-01-10 09:00:00', '2023-06-01 15:30:00', 1),
(2, 'NGK', 'NGK456', '098-765-4321', 'NGK@gmail.com', 'Especialistas en bujías y sistemas de encendido.', '2021-07-15 10:00:00', '2023-05-20 12:00:00', 1),
(3, 'Denso', 'DNS789', '555-123-4567', 'Denso@gmail.com', 'Proveedor global de sistemas de climatización y más.', '2020-11-05 08:30:00', '2023-04-18 09:45:00', 1),
(4, 'ACDelco', 'ACD012', '444-555-6666', 'ACDelco@gmail.com', 'Repuestos originales para vehículos GM.', '2022-03-22 14:00:00', '2023-06-10 16:20:00', 1),
(5, 'Valeo', 'VLE345', '333-222-1111', 'Valeo@gmail.com', 'Tecnología avanzada en componentes automotrices.', '2021-09-30 11:15:00', '2023-05-25 13:50:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `mod_id` int(11) NOT NULL,
  `mod_nombre` varchar(100) NOT NULL,
  `mod_idMarca` int(11) NOT NULL,
  `mod_codigo` varchar(20) DEFAULT NULL,
  `mod_descripcion` varchar(255) DEFAULT NULL,
  `mod_fechaCreacion` datetime DEFAULT NULL,
  `mod_fechaActualizacion` datetime DEFAULT NULL,
  `mod_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`mod_id`, `mod_nombre`, `mod_idMarca`, `mod_codigo`, `mod_descripcion`, `mod_fechaCreacion`, `mod_fechaActualizacion`, `mod_estado`) VALUES
(1, 'ABS Control', 1, 'ABS001', 'Control ABS avanzado para vehículos modernos', '2022-01-10 09:00:00', '2023-06-01 15:30:00', 1),
(2, 'MaxPower', 1, 'MPW002', 'Potente sistema de ignición MaxPower', '2021-07-15 10:00:00', '2023-05-20 12:00:00', 1),
(3, 'ProSpark', 1, 'PSP003', 'Bujías ProSpark para alto rendimiento', '2020-11-05 08:30:00', '2023-04-18 09:45:00', 1),
(4, 'IridiumX', 2, 'IRX004', 'Bujías IridiumX de alta durabilidad', '2022-03-22 14:00:00', '2023-06-10 16:20:00', 1),
(5, 'LaserTech', 2, 'LST005', 'Tecnología láser para sistemas de ignición', '2021-09-30 11:15:00', '2023-05-25 13:50:00', 1),
(6, 'Resistor', 2, 'RES006', 'Resistores para sistema eléctrico', '2021-08-20 09:00:00', '2023-05-10 10:30:00', 1),
(7, 'TwinFuel', 3, 'TFU007', 'Combustible TwinFuel para mejor eficiencia', '2020-12-01 08:00:00', '2023-04-12 14:00:00', 1),
(8, 'AirFlow', 3, 'AFW008', 'Sistema AirFlow para ventilación optimizada', '2022-02-11 15:00:00', '2023-06-05 16:00:00', 1),
(9, 'VoltMax', 3, 'VLM009', 'VoltMax: sistema eléctrico de alto rendimiento', '2021-05-18 12:00:00', '2023-05-22 13:00:00', 1),
(10, 'VoltCore', 4, 'VLC010', 'VoltCore: núcleo de voltaje estable', '2020-09-25 10:30:00', '2023-04-28 11:00:00', 1),
(11, 'DIN55', 4, 'DIN011', 'DIN55: estándar industrial para repuestos', '2021-03-15 14:20:00', '2023-05-01 15:30:00', 1),
(12, 'EdgeGuard', 4, 'EDG012', 'EdgeGuard: protección avanzada para sistemas', '2022-04-10 09:40:00', '2023-06-08 12:50:00', 1),
(13, 'EcoCharge', 5, 'ECO013', 'EcoCharge: carga eficiente y ecológica', '2021-10-05 13:10:00', '2023-05-30 14:20:00', 1),
(14, 'ZenCool', 5, 'ZNC014', 'ZenCool: sistema de refrigeración avanzado', '2020-08-22 08:45:00', '2023-04-15 09:55:00', 1),
(15, 'LiteAir', 5, 'LTA015', 'LiteAir: sistema de ventilación liviano', '2021-06-10 10:30:00', '2023-05-18 11:40:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registroservicio`
--

CREATE TABLE `registroservicio` (
  `id_Registro` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `marcaVehiculo` varchar(150) NOT NULL,
  `placaVehiculo` varchar(10) NOT NULL,
  `tipoServicio` enum('MANTENIMIENTO PREVENTIVO','REPARACIONES','SERVICIO TECNICO','') NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_tecnico` int(11) DEFAULT NULL,
  `estado` enum('EN ESPERA','EN PROCESO','TRABAJANDO','TERMINADO') NOT NULL DEFAULT 'EN ESPERA',
  `fechaCreacion` datetime NOT NULL,
  `fechaModificacion` datetime NOT NULL,
  `statusLogical` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registroservicio`
--

INSERT INTO `registroservicio` (`id_Registro`, `nombre`, `cedula`, `telefono`, `correo`, `marcaVehiculo`, `placaVehiculo`, `tipoServicio`, `id_user`, `id_tecnico`, `estado`, `fechaCreacion`, `fechaModificacion`, `statusLogical`) VALUES
(2, 'Jonathan', '0914675616', '0913452678', 'juan.aguirre@gmail.com', 'ABC', 'ABC123', 'SERVICIO TECNICO', 4, 2, 'TERMINADO', '2025-07-03 20:25:11', '2025-07-06 20:21:16', 1),
(3, 'Juan', '1231313218', '1231313218', 'juan.aguirre@gmail.com', 'asasd', 'asd123', 'SERVICIO TECNICO', 4, 1, 'TERMINADO', '2025-07-04 22:14:09', '2025-07-14 06:11:01', 1),
(4, 'Jonathan', '1231313218', '0960910935', 'juan.aguirre@gmail.com', 'ASASD', 'ASD123', 'MANTENIMIENTO PREVENTIVO', 5, 2, 'EN ESPERA', '2025-07-05 00:09:28', '2025-07-14 05:24:07', 0),
(5, 'Jonathan', '0941246928', '1231313218', 'juan.aguirre@gmail.com', 'ASASD', 'ASD123', 'REPARACIONES', 5, 2, 'EN ESPERA', '2025-07-05 01:00:37', '2025-07-14 05:24:38', 1),
(6, 'Jonathan Alejandro', '0945878745', '0960910935', 'juan.aguirre@gmail.com', 'ASASD', 'BCA123', 'SERVICIO TECNICO', 5, 2, 'EN ESPERA', '2025-07-05 01:06:03', '2025-07-14 05:26:12', 1),
(7, 'Jonathan', '0941246578', '1231313218', 'juan.aguirre@gmail.com', 'ASASY', 'BCA124', 'MANTENIMIENTO PREVENTIVO', 5, 2, 'EN ESPERA', '2025-07-05 01:07:04', '2025-07-14 05:25:08', 1),
(8, 'Ale', '0123456789', '1234567890', 'hola123@gmail.com', 'TOYOTA', 'CQS1212', 'MANTENIMIENTO PREVENTIVO', 3, 2, 'EN ESPERA', '2025-07-05 01:41:46', '2025-07-05 05:32:31', 1),
(9, 'John Steven Quijije Tovar', '0941246928', '0960910935', 'john.quijijetov@ug.edu.ec', 'ASASI', 'BCA125', 'REPARACIONES', 1, 1, 'TRABAJANDO', '2025-07-14 06:11:26', '2025-07-14 06:12:04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_solicitudes_simples`
--

CREATE TABLE `registro_solicitudes_simples` (
  `id_registro` int(11) NOT NULL,
  `id_tecnico` int(11) NOT NULL,
  `fecha_solicitud` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro_solicitudes_simples`
--

INSERT INTO `registro_solicitudes_simples` (`id_registro`, `id_tecnico`, `fecha_solicitud`) VALUES
(13, 2, '2025-07-13 22:05:14'),
(14, 2, '2025-07-13 22:21:10'),
(15, 2, '2025-07-13 23:18:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos`
--

CREATE TABLE `repuestos` (
  `rep_id` int(11) NOT NULL,
  `rep_nombre` varchar(40) NOT NULL,
  `rep_descripcion` varchar(100) DEFAULT NULL,
  `rep_precio` decimal(10,2) NOT NULL,
  `rep_stock` int(11) NOT NULL,
  `rep_tipoRepuesto` varchar(20) NOT NULL,
  `rep_idMarca` int(3) NOT NULL,
  `rep_idModelo` int(3) NOT NULL,
  `rep_estado` tinyint(1) NOT NULL DEFAULT 1,
  `rep_fechaRegistro` date NOT NULL DEFAULT curdate(),
  `rep_fechaActualizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `repuestos`
--

INSERT INTO `repuestos` (`rep_id`, `rep_nombre`, `rep_descripcion`, `rep_precio`, `rep_stock`, `rep_tipoRepuesto`, `rep_idMarca`, `rep_idModelo`, `rep_estado`, `rep_fechaRegistro`, `rep_fechaActualizacion`) VALUES
(28, 'Prueba2', '2', 2.00, 2, 'Generico', 4, 11, 1, '2025-07-09', NULL),
(29, 'Prueba3', '3', 3.00, 3, 'Original', 3, 8, 1, '2025-07-09', NULL),
(30, 'Prueba4', '4', 4.00, 4, 'Original', 1, 3, 1, '2025-07-09', NULL),
(31, 'Prueba5', '5', 5.00, 5, 'Original', 1, 2, 1, '2025-07-09', NULL),
(32, 'Prueba6', '6', 6.00, 6, 'Original', 4, 11, 1, '2025-07-09', NULL),
(33, 'Prueba7', '7', 7.00, 7, 'Original', 2, 4, 0, '2025-07-09', NULL),
(34, 'caburador', '1', 3.25, 8, 'Original', 1, 1, 1, '2025-07-14', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_mod` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `descripcion`, `fecha_creacion`, `fecha_modificacion`, `usuario_mod`, `estado`) VALUES
(1, 'Usuario', '2025-07-05 21:23:37', '2025-07-05 21:23:37', NULL, 1),
(2, 'Tecnico', '2025-07-05 21:23:37', '2025-07-05 21:23:37', NULL, 1),
(3, 'Admin', '2025-07-05 21:24:00', '2025-07-05 21:24:00', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `notificaciones` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nombre`, `cedula`, `correo`, `telefono`, `password`, `rol`, `estado`, `fecha_creacion`, `notificaciones`) VALUES
(1, 'Admin', '0912345678', 'admin@tauto.com', '0991234567', '$2y$10$ts.ZJxMN5D6j7k9HOaxD3O83sbBmrqrd3cVHA5d/bhojL8RQG3ijO', 3, 1, '2025-07-05 16:25:42', 0),
(2, 'Ariana', '0912786534', 'ariana.123@tauto.com', '0912225643', '$2y$10$ts.ZJxMN5D6j7k9HOaxD3O83sbBmrqrd3cVHA5d/bhojL8RQG3ijO', 2, 1, '2025-07-05 16:37:06', 0),
(3, 'Pablo', '0912786533', 'pablo@gmail.com', '0913452678', '$2y$10$dTSKYNFhhiOmtzDdxhLJjeErPZDcEBUCwoE2.Ow2yPxPYcXs2rP1e', 2, 0, '2025-07-05 17:05:12', 0),
(4, 'John Steven Quijije Tovar', '0941246928', 'john.quijijetov@ug.edu.ec', '0960910935', '$2y$10$4k/fMlGXW1.p5lXf6gkrjuVeIwBaK1otL1Y9Os6oGV5Id2bVzEnfq', 3, 1, '2025-07-06 01:41:43', 0),
(5, 'Jonathan Alejandro', '0941246927', 'jonathan.ale@gmail.com', '0960910935', '$2y$10$nGklhS.U8r8bn2E8ZzuxpuBDGtLXWkhkefI6lnMACPydK2j6QmsLG', 1, 1, '2025-07-07 03:47:24', 0),
(6, 'Sofia moran', '0941246926', 'Sofi.m@gmail.com', '0960910935', '$2y$10$HLWEXc2s/pXs2TtAwR3JrOxLa8o52UIboPzMpwJM6fNCejtmqm9Ie', 2, 1, '2025-07-07 05:46:58', 0),
(11, 'Steven Quijije ', '0941246921', 'Steven.q@gmail.com', '0960910935', '$2y$10$etzJYpDZVuPE97xKAzTPWO7nhRLyUgWXlmpLI8A4AsdLlStTTPaGa', 2, 1, '2025-07-14 05:01:27', 0),
(12, 'Steven', '0941245787', 'juan.aguirre1@gmail.com', '0960910935', '$2y$10$z8s5PL4mtjQBhtrGR3jtkedqXnXij9kd/C.f.aiKbmPgo2KW4Uz6i', 1, 1, '2025-07-14 06:08:48', 1),
(13, 'John Steven Quijije Tovar', '0941246923', 'john.quijijetov1@ug.edu.ec', '0960910938', '$2y$10$NUy8mXalrJLMGNsm6/SUpuw7cimHY7/8IBMsXNXkBt60e0Tb3/Fm.', 2, 1, '2025-07-13 23:18:19', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`id_cotizacion`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`mar_id`),
  ADD UNIQUE KEY `mar_nombre` (`mar_nombre`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`mod_id`),
  ADD KEY `mod_idMarca` (`mod_idMarca`);

--
-- Indices de la tabla `registroservicio`
--
ALTER TABLE `registroservicio`
  ADD PRIMARY KEY (`id_Registro`),
  ADD KEY `FK_User_Registro` (`id_user`),
  ADD KEY `FK_Tecnico_Registro` (`id_tecnico`);

--
-- Indices de la tabla `registro_solicitudes_simples`
--
ALTER TABLE `registro_solicitudes_simples`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_tecnico` (`id_tecnico`);

--
-- Indices de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD PRIMARY KEY (`rep_id`),
  ADD KEY `rep_idMarca` (`rep_idMarca`),
  ADD KEY `rep_idModelo` (`rep_idModelo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD KEY `FK_Usuario` (`usuario_mod`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_Rol_user` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `id_cotizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `mar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `registroservicio`
--
ALTER TABLE `registroservicio`
  MODIFY `id_Registro` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `registro_solicitudes_simples`
--
ALTER TABLE `registro_solicitudes_simples`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  MODIFY `rep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `modelos_ibfk_1` FOREIGN KEY (`mod_idMarca`) REFERENCES `marcas` (`mar_id`);

--
-- Filtros para la tabla `registroservicio`
--
ALTER TABLE `registroservicio`
  ADD CONSTRAINT `FK_Tecnico_Registro` FOREIGN KEY (`id_tecnico`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_User_Registro` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_solicitudes_simples`
--
ALTER TABLE `registro_solicitudes_simples`
  ADD CONSTRAINT `registro_solicitudes_simples_ibfk_1` FOREIGN KEY (`id_tecnico`) REFERENCES `usuarios` (`id_user`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD CONSTRAINT `repuestos_ibfk_1` FOREIGN KEY (`rep_idMarca`) REFERENCES `marcas` (`mar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repuestos_ibfk_2` FOREIGN KEY (`rep_idModelo`) REFERENCES `modelos` (`mod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `FK_Usuario` FOREIGN KEY (`usuario_mod`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_Rol_user` FOREIGN KEY (`rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
