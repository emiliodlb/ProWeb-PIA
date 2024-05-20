-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2024 a las 05:16:09
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
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `idusuario` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleorden`
--

CREATE TABLE `detalleorden` (
  `IdOrden` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatusorden`
--

CREATE TABLE `estatusorden` (
  `IdEstatusOrden` int(11) NOT NULL,
  `NombreEstatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estatusorden`
--

INSERT INTO `estatusorden` (`IdEstatusOrden`, `NombreEstatus`) VALUES
(1, 'ACTIVO'),
(2, 'EN ESPERA'),
(3, 'ENTREGADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `IdOrden` int(11) NOT NULL,
  `TotalOrden` decimal(10,2) NOT NULL,
  `FechaOrden` datetime NOT NULL,
  `IdMesa` int(11) NOT NULL,
  `IdEstatusOrden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`IdOrden`, `TotalOrden`, `FechaOrden`, `IdMesa`, `IdEstatusOrden`) VALUES
(12, 1499.99, '2024-05-18 19:19:08', 3, 1),
(13, 1499.99, '2024-05-18 19:19:11', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IdProducto` int(11) NOT NULL,
  `NombreProducto` varchar(45) NOT NULL,
  `DescripcionProducto` varchar(200) NOT NULL,
  `PrecioProducto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `NombreProducto`, `DescripcionProducto`, `PrecioProducto`) VALUES
(1, 'Haburguesa con Tocino', 'Hamburguesa de dos carnes con lechuga, tomate, aros de cebolla, queso amarillo y tocino.\r\nAdicionalmente, con pan horneado.', 150.00),
(2, 'Papas', 'uwu', 50.00),
(3, 'Coca Cola', 'Vidrio - 500 ml.', 20.00),
(16, 'Pizza Mediana', 'Pepperoni y orilla de queso\r\n', 149.99),
(17, 'Nachos a la Brayan', 'Ración de nachos con queso, crema, frijoles, chile en rajas, mayonesa, catusp y salsa buffalo. Ademas de 3 ingredientes a gusto del cliente.', 96.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `IdRol` int(11) NOT NULL,
  `NombreRol` varchar(45) NOT NULL,
  `DescRol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`IdRol`, `NombreRol`, `DescRol`) VALUES
(1, 'Admin', 'Empleado con permisos administrativos'),
(2, 'Empleado ', 'Empleado General'),
(3, 'Mesa', 'Cuenta de mesa para clientes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `NombreUsuario` varchar(45) NOT NULL,
  `TelefonoUsuario` bigint(20) DEFAULT NULL,
  `LugarMesa` varchar(45) DEFAULT NULL,
  `EspacioMesa` int(11) DEFAULT NULL,
  `DisponibilidadMesa` bit(1) DEFAULT NULL,
  `PasswordUsuario` varchar(45) NOT NULL,
  `IdRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `NombreUsuario`, `TelefonoUsuario`, `LugarMesa`, `EspacioMesa`, `DisponibilidadMesa`, `PasswordUsuario`, `IdRol`) VALUES
(1, 'Emilio Briones', 8125944751, '', 0, NULL, 'male1971', 1),
(2, 'Mesa 1', 0, 'Zona de barra', 4, b'1', 'mesauno', 3),
(3, 'EG', 8110323060, '', 0, NULL, '123', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`idusuario`,`idproducto`),
  ADD KEY `idmesa_idx` (`idusuario`),
  ADD KEY `idproducto_idx` (`idproducto`);

--
-- Indices de la tabla `detalleorden`
--
ALTER TABLE `detalleorden`
  ADD PRIMARY KEY (`IdOrden`,`IdProducto`),
  ADD KEY `idorden_idx` (`IdOrden`),
  ADD KEY `idproducto_idx` (`IdProducto`);

--
-- Indices de la tabla `estatusorden`
--
ALTER TABLE `estatusorden`
  ADD PRIMARY KEY (`IdEstatusOrden`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`IdOrden`),
  ADD KEY `idmesa_idx` (`IdMesa`),
  ADD KEY `IdEstatusOrden_idx` (`IdEstatusOrden`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `IdRol_idx` (`IdRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estatusorden`
--
ALTER TABLE `estatusorden`
  MODIFY `IdEstatusOrden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `IdOrden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `IdRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `idproducto2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`IdProducto`),
  ADD CONSTRAINT `idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `detalleorden`
--
ALTER TABLE `detalleorden`
  ADD CONSTRAINT `idorden` FOREIGN KEY (`IdOrden`) REFERENCES `orden` (`IdOrden`),
  ADD CONSTRAINT `idproducto` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`);

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `IdEstatusOrden` FOREIGN KEY (`IdEstatusOrden`) REFERENCES `estatusorden` (`IdEstatusOrden`),
  ADD CONSTRAINT `idmesa1` FOREIGN KEY (`IdMesa`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `IdRol` FOREIGN KEY (`IdRol`) REFERENCES `rol` (`IdRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
