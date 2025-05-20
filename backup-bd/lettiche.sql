-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2025 a las 23:09:19
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
-- Base de datos: `lettiche`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_pedido`
--

INSERT INTO `detalles_pedido` (`id`, `pedido_id`, `producto_id`, `cantidad`, `precio_unitario`) VALUES
(8, 74, 3, 1, 3000.00),
(9, 74, 2, 1, 12000.00),
(10, 75, 1, 1, 10000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','procesando','enviado','entregado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `fecha`, `total`, `estado`) VALUES
(74, 29, '2025-05-20 15:35:24', 17850.00, 'pendiente'),
(75, 29, '2025-05-20 16:03:05', 11900.00, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `Estado` varchar(11) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `fecha_creacion`, `Estado`) VALUES
(1, 'Chorizo', 'un chorizo de carne de lentejas', 10000.00, 10, 'producto_68040c675dce4.jpg', '2025-04-15 17:03:05', 'ACTIVO'),
(2, 'Carne de Lentejas', 'un kg de carne de lentejas', 12000.00, 10, 'producto_68040c6f482fb.jpg', '2025-04-15 17:12:03', 'ACTIVO'),
(3, 'Empanada', 'Empanada cuyo ingrediente principal son lentejas', 3000.00, 10, 'producto_68040c77e32a5.jpg', '2025-04-16 15:45:46', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion`
--

CREATE TABLE `recuperacion` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recuperacion`
--

INSERT INTO `recuperacion` (`id`, `correo`, `codigo`, `fecha`) VALUES
(3, 'baloncest7oentablon@gmail.com', '58c66ae022db8d736c3d', '2025-05-05 22:05:00'),
(7, 'baloncest8oentablon@gmail.com', 'e5885421c9f081893eb0', '2025-05-06 21:03:47'),
(9, 'baloncest\'8\'oentablon@gmail.com', '2445e0a733e5561efa34', '2025-05-06 21:10:11'),
(10, 'baloncestoentablon8@gmail.com', '58e0b0d8ec9fb5fe1d72', '2025-05-06 21:10:22'),
(14, 'baloncestoentablon\'\'@gmail.com', 'b23cfe89f5703f98aea1', '2025-05-06 21:12:14'),
(16, 'baloncestoentablon\'\'8@gmail.com', '5e1b808238bd718e97eb', '2025-05-06 21:13:06'),
(19, 'baloncestoentablon\'8\'@gmail.com', '31983361a6b1b71009e1', '2025-05-06 21:15:40'),
(21, 'baloncestoentablon@gmail.com', '6452dcf5937dfc78da18', '2025-05-06 21:20:54'),
(23, 'baloncestoentablon1@gmail.com', 'f43e78b51cd0d149ebaa', '2025-05-06 21:21:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(55) NOT NULL,
  `correo` varchar(99) NOT NULL,
  `direccion` varchar(90) NOT NULL,
  `telefono` varchar(19) NOT NULL,
  `Cargo` varchar(55) NOT NULL DEFAULT 'User',
  `pass` varchar(255) NOT NULL,
  `Estado` varchar(11) NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `direccion`, `telefono`, `Cargo`, `pass`, `Estado`) VALUES
(1, 'Administrador', 'nicoend20537@gmail.com', 'Administrador', '1234567890', 'ADMIN', '', 'INACTIVO'),
(2, 'Nicolas', 'guarinmolinan@gmail.coom', '', '3105986680', 'user', '$2y$10$3.fZ4VGc6w07Hp6/OpSOTumkiInsiKcaTcT01sBAkWOB.ngOZPUhu', 'ACTIVO'),
(3, 'Maria', 'mari@gmail.com', '', '3110957284', 'user', '$2y$10$KeOeDlLYgoAvnE/tpsdcB.wWp2d9vjV4Q.eOJvO8bB1RiJvbIsGUa', 'ACTIVO'),
(4, 'ENDYs', 'END@gmail.com', 'Administrador', '3100000000', 'ADMIN', '$2y$10$BFXqhejEmvdBkOnQY5Sc6urCU01YgrnRbGmwB77zjgMTZZSmYXAT.', 'ACTIVO'),
(5, 'Jhonny', 'andres@gmail.com', '', '1234567899', 'user', '$2y$10$.gYVUWLrNOOH2onFZmJE8.m749HA4UPg0W20cueBhHAqXFw3SIszm', 'ACTIVO'),
(6, 'Jhonny', 'user@domain.com', '', '1234567898', 'user', '$2y$10$SL2iCOQmVOBJm3SItbFm5OzE2tIGcVFdlo4ERZZqX4PcvtxSgy2B.', 'ACTIVO'),
(25, 'gaychocho', 'baloncestoentablon@gmail.com', 'la sexta', '3103849526', 'User', '$2y$10$KeOeDlLYgoAvnE/tpsdcB.wWp2d9vjV4Q.eOJvO8bB1RiJvbIsGUa', 'ACTIVO'),
(28, 'Jhonny', 'jadiaz@iegabo.edu.co', '', '3103561843', 'user', '$2y$10$HRQ1F55ujPNjCaCMYz0Y4.OQSmgpVW1LUjuabuc5a6wAUu1jQolLe', 'ACTIVO'),
(29, 'Jhonny dÍAZ', 'jhonnydiaz@gmail.com', '', '9846164615', 'user', '$2y$10$UzJXqrEekj5/XPQoV5bdQOPFDHmpbbUfRnS00ropmTUF8K.P/Xn6q', 'ACTIVO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recuperacion`
--
ALTER TABLE `recuperacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unico_telefono` (`telefono`),
  ADD UNIQUE KEY `unico_correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `recuperacion`
--
ALTER TABLE `recuperacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `detalles_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `detalles_pedido_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
