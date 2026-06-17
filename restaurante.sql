-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql210.infinityfree.com
-- Tiempo de generación: 17-06-2026 a las 18:34:56
-- Versión del servidor: 11.4.12-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `if0_40974340_restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alergia`
--

CREATE TABLE `alergia` (
  `Id_alergia` int(11) NOT NULL,
  `nombre_alergia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alergia`
--

INSERT INTO `alergia` (`Id_alergia`, `nombre_alergia`) VALUES
(1, 'Gluten'),
(2, 'Lactosa'),
(3, 'Frutos secos'),
(4, 'Marisco'),
(5, 'Huevo'),
(6, 'Soja'),
(7, 'Pescado'),
(8, 'Mostaza'),
(9, 'Apio'),
(10, 'Sesamo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre`, `email`, `mensaje`, `fecha`) VALUES
(1, 'Elena', 'elena@mail.com', 'fgagaegsgs', '2026-01-24 17:45:09'),
(2, 'Elena', 'elena@mail.com', 'fgagaegsgs', '2026-01-24 17:47:11'),
(3, 'Lorenzo', 'lorenzo@mail.com', 'Necesito mas informaciÃ³n del espacio\r\nGracias.', '2026-01-28 10:44:01'),
(4, 'Elena', 'elena@mail.com', 'Hola queria saber si hoy tenian el restaurante abierto', '2026-02-01 10:53:53'),
(5, 'Lorenzo', 'lorenzo@mail.com', 'Buenas Tardes, preguntaba si el dia de la reserva estarÃ¡ el chef para poder visitarle.', '2026-05-19 21:00:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `Id_menu` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`Id_menu`, `nombre`, `tipo`) VALUES
(1, 'Menu Degustacion', 'Especial'),
(2, 'Menu Vegano', 'Vegano'),
(3, 'Menu Carta', 'Clasico'),
(4, 'Menu Infantil', 'Infantil'),
(5, 'Menu XL', 'Especial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `Id_mesa` int(11) NOT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `ocupacion_min` int(11) DEFAULT 1,
  `ocupacion_max` int(11) DEFAULT 10,
  `tipo` varchar(50) DEFAULT 'Normal',
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`Id_mesa`, `ubicacion`, `capacidad`, `ocupacion_min`, `ocupacion_max`, `tipo`, `activo`) VALUES
(0, 'Terraza', 2, 2, 4, 'Alta', 1),
(1, 'Interior', 4, 1, 6, 'Redonda', 1),
(2, 'Terraza', 2, 1, 2, 'Alta', 1),
(3, 'Interior', 4, 1, 10, 'Normal', 0),
(4, 'Interior', 4, 1, 4, 'Normal', 1),
(5, 'Interior', 4, 1, 4, 'Normal', 1),
(6, 'Terraza', 2, 1, 2, 'Alta', 1),
(7, 'VIP', 6, 1, 6, 'SofÃ¡', 1),
(8, 'Interior', 4, 1, 4, 'Normal', 1),
(9, 'Terraza', 2, 1, 10, 'Normal', 0),
(10, 'VIP', 4, 2, 4, 'Normal', 1),
(11, 'Terraza', 4, 1, 5, 'Normal', 0),
(12, 'VIP', 3, 2, 4, 'SofÃ¡', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `Id_Reserva` int(11) NOT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `Id_mesa` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` varchar(10) DEFAULT NULL,
  `n_personas` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `notas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`Id_Reserva`, `Id_Usuario`, `Id_mesa`, `fecha`, `hora`, `n_personas`, `estado`, `nombre`, `email`, `telefono`, `notas`) VALUES
(1, 4, 1, '2025-11-15', '20:00', 4, 'pendiente', NULL, NULL, NULL, NULL),
(2, 6, 2, '2025-11-16', '21:00', 2, 'confirmada', NULL, NULL, NULL, NULL),
(3, 9, 3, '2025-11-17', '19:30', 3, 'cancelada', NULL, NULL, NULL, NULL),
(5, 2, 5, '2025-11-19', '22:00', 2, 'cancelada', NULL, NULL, NULL, NULL),
(6, 3, 6, '2025-11-20', '20:45', 6, 'pendiente', NULL, NULL, NULL, NULL),
(7, 10, 7, '2025-11-21', '21:30', 1, 'confirmada', NULL, NULL, NULL, NULL),
(8, 1, 8, '2025-11-22', '19:00', 4, 'confirmada', NULL, NULL, NULL, NULL),
(9, 7, 9, '2025-11-23', '20:30', 3, 'pendiente', NULL, NULL, NULL, NULL),
(10, 5, 10, '2025-11-24', '21:15', 2, 'confirmada', NULL, NULL, NULL, NULL),
(13, 12, 2, '2026-03-29', '14:00', 4, 'pendiente', NULL, NULL, NULL, NULL),
(14, 1, 2, '2026-03-29', '20:30', 2, 'pendiente', NULL, NULL, NULL, NULL),
(15, 1, 3, '2026-05-30', '22:00', 3, 'pendiente', NULL, NULL, NULL, NULL),
(17, 12, 2, '2026-05-22', '20:15', 4, 'pendiente', NULL, NULL, NULL, NULL),
(19, 12, 2, '2026-06-26', '22:20', 6, 'cancelada', NULL, NULL, NULL, NULL),
(20, 1, 1, '2026-07-24', '14:50', 3, 'cancelada', NULL, NULL, NULL, NULL),
(21, 1, 1, '2026-06-28', '21:45', 2, 'cancelada', NULL, NULL, NULL, NULL),
(22, 9, 3, '2026-08-28', '22:00', 4, 'confirmada', NULL, NULL, NULL, NULL),
(23, 9, 2, '2026-07-24', '14:00', 4, 'confirmada', NULL, NULL, NULL, NULL),
(24, 12, 1, '2026-07-18', '13:50', 2, 'confirmada', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_alergia`
--

CREATE TABLE `reserva_alergia` (
  `Id_Reserva` int(11) NOT NULL,
  `Id_alergia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva_alergia`
--

INSERT INTO `reserva_alergia` (`Id_Reserva`, `Id_alergia`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_menu`
--

CREATE TABLE `reserva_menu` (
  `Id_Reserva` int(11) NOT NULL,
  `Id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva_menu`
--

INSERT INTO `reserva_menu` (`Id_Reserva`, `Id_menu`) VALUES
(1, 1),
(6, 1),
(2, 2),
(7, 2),
(3, 3),
(8, 3),
(4, 4),
(9, 4),
(5, 5),
(10, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_Usuario`, `nombre`, `email`, `contrasena`, `telefono`, `rol`, `activo`) VALUES
(1, 'Lorenzo', 'lorenzo@mail.com', '$2y$10$QewqlZS.xBT7LOnQJUydP.jYgwoCI/HpPWCDlIqcsm4fIFIXb6FzC', '693405783', 'usuario', 1),
(2, 'Luismi', 'luismi@mail.com', '$2y$10$r0xyyVYFSJPN1/p4StkGAuGQsxr6lDSqyE4rPe7dR76/qSSv1i0L.', '600473299', 'usuario', 1),
(3, 'Marta', 'marta@mail.com', '$2y$10$ZEXLulUUTolfqI4nQgiOoO/Vi6v/FFy6r9TgpFAoucfAoDgQwlFOe', '617649002', 'usuario', 1),
(4, 'Carla', 'carla@mail.com', '$2y$10$jj8R7dprgICJjBcSXS9Kz.wTW8VcXjCs/AprvxSdMazjuQ3mxO9Lm', '601493763', 'usuario', 1),
(5, 'Barbara', 'barbara@mail.com', '$2y$10$CoZfEIdnqmjDg2/1NzhMreCYEtlmF0TTprXQds91ijRsBmPpIWKmO', '677003654', 'usuario', 1),
(6, 'Pedro', 'pedro@mail.com', '$2y$10$jtu868FOyc.Kq34GOHrmAOl8HxonX1mFpwd8WCaXJT8f.n2aefHYy', '604999521', 'usuario', 1),
(7, 'Sofia', 'sofia@mail.com', '$2y$10$iw5yFQDYc6Emqlpg81qtA.T0K0Yd1RoGN28wrRDfqP8.kbgTa7tHe', '614039888', 'usuario', 1),
(9, 'Elena', 'elena@mail.com', '$2y$10$Vsruor6qftW3DJrE2uImnO1bD4ot4rCy4x5wIOkcpcPxzNhBxeXlm', '697774332', 'usuario', 1),
(10, 'Javi', 'javi@mail.com', '$2y$10$bCgvlLFk.tFtofcLKu1Tnea5JxEm.zMN4EfiOxDzK6iDKyU61Hg0W', '686642662', 'usuario', 1),
(11, 'David', 'david@mail.com', '$2y$10$r523GtHqPIJ/qTEuUoOxsuZeXTvjjypKrQvQR/Btyw5qglnQGV9pG', '677909433', 'usuario', 1),
(12, 'Virginia', 'virgi@mail.com', '$2y$10$2VSBXmFLabsKn1raCuiMue3Y3UFtHIzN2Aa5SsZdz3wMyl3GFN4b2', '633466588', 'usuario', 1),
(20, 'Fernando', 'fernando@mail.com', '$2y$10$piFy1AeFsTppDrFe9Bw6Z.DyGvyzvm1EKFijFIvhf6si7a2wegsSS', '678006445', 'admin', 1),
(21, 'Bryan', 'bryan@mail.com', '$2y$10$kbU2FWBqCbB0qp/jHL9WROvWWhLg8PK02SdSI/bnrWggDC0KTLNLO', '689999002', 'usuario', 0),
(23, 'Ramon', 'ramon@mail.com', '$2y$10$t6CFcBQRZbNHNxm85cx/EuHJX04REP5n5iGqpMwiVa0G12odHmmwW', '677555300', 'usuario', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alergia`
--
ALTER TABLE `alergia`
  ADD PRIMARY KEY (`Id_alergia`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`Id_menu`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`Id_mesa`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`Id_Reserva`),
  ADD KEY `Id_Usuario` (`Id_Usuario`),
  ADD KEY `Id_mesa` (`Id_mesa`);

--
-- Indices de la tabla `reserva_alergia`
--
ALTER TABLE `reserva_alergia`
  ADD PRIMARY KEY (`Id_Reserva`,`Id_alergia`),
  ADD KEY `Id_alergia` (`Id_alergia`);

--
-- Indices de la tabla `reserva_menu`
--
ALTER TABLE `reserva_menu`
  ADD PRIMARY KEY (`Id_Reserva`,`Id_menu`),
  ADD KEY `Id_menu` (`Id_menu`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `Id_Reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id_Usuario`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`Id_mesa`) REFERENCES `mesa` (`Id_mesa`);

--
-- Filtros para la tabla `reserva_alergia`
--
ALTER TABLE `reserva_alergia`
  ADD CONSTRAINT `reserva_alergia_ibfk_2` FOREIGN KEY (`Id_alergia`) REFERENCES `alergia` (`Id_alergia`);

--
-- Filtros para la tabla `reserva_menu`
--
ALTER TABLE `reserva_menu`
  ADD CONSTRAINT `reserva_menu_ibfk_2` FOREIGN KEY (`Id_menu`) REFERENCES `menu` (`Id_menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
