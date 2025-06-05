-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2025 a las 08:22:02
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `verificar_stock` (IN `id_producto` INT, IN `cantidad_solicitada` INT, OUT `estado_compra` BOOLEAN, OUT `existencia_producto` BOOLEAN)   BEGIN
DECLARE stock_disponible INT;
IF(EXISTS(SELECT 1 FROM productos WHERE id = id_producto)) THEN
	SET existencia_producto = TRUE;
ELSE
	SET existencia_producto = FALSE;
END IF;
IF(existencia_producto) THEN
	SELECT stock INTO stock_disponible FROM productos WHERE id = id_producto;
    if(stock_disponible >= cantidad_solicitada) THEN
    SET estado_compra = TRUE;
    ELSE
    SET estado_compra = FALSE;
    END IF;
END IF;
END$$

DELIMITER ;

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
(10, 75, 1, 1, 10000.00),
(11, 76, 2, 1, 12000.00),
(12, 76, 1, 4, 10000.00),
(13, 77, 2, 2, 12000.00),
(14, 78, 2, 1, 12000.00),
(15, 78, 3, 1, 3000.00),
(16, 78, 4, 1, 12333.00),
(17, 78, 1, 1, 10000.00),
(18, 79, 1, 2, 10000.00),
(19, 79, 3, 1, 12000.00),
(21, 81, 1, 2, 10000.00),
(22, 82, 1, 5, 10000.00),
(23, 83, 2, 1, 12000.00),
(24, 83, 3, 2, 3000.00),
(25, 83, 4, 11, 12333.00),
(26, 83, 1, 2, 10000.00),
(27, 84, 1, 3, 10000.00),
(28, 85, 3, 3, 3000.00),
(29, 85, 4, 10, 12333.00),
(30, 85, 2, 4, 12000.00),
(31, 86, 1, 1, 10000.00),
(32, 87, 1, 1, 10000.00),
(33, 88, 1, 1, 10000.00),
(34, 89, 1, 4, 10000.00),
(35, 90, 1, 1, 10000.00),
(36, 91, 1, 1, 10000.00),
(37, 94, 1, 2, 10000.00),
(38, 95, 1, 5, 10000.00),
(39, 96, 2, 2, 12000.00),
(40, 97, 2, 1, 12000.00),
(41, 98, 2, 1, 12000.00),
(42, 99, 3, 2, 3000.00),
(43, 100, 3, 1, 3000.00),
(44, 100, 4, 3, 12333.00),
(45, 100, 2, 1, 12000.00),
(46, 101, 3, 2, 3000.00),
(47, 102, 3, 2, 3000.00),
(48, 103, 2, 1, 12000.00);

--
-- Disparadores `detalles_pedido`
--
DELIMITER $$
CREATE TRIGGER `descontar_stock` AFTER INSERT ON `detalles_pedido` FOR EACH ROW BEGIN
UPDATE productos SET stock = stock - NEW.cantidad WHERE id = NEW.producto_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `direccion_envio` varchar(90) DEFAULT NULL,
  `estado` enum('pendiente','procesando','enviado','entregado','cancelado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `fecha`, `total`, `direccion_envio`, `estado`) VALUES
(74, 29, '2025-05-20 15:35:24', 17850.00, '', 'entregado'),
(75, 29, '2025-05-20 16:03:05', 11900.00, '', 'entregado'),
(76, 4, '2025-05-20 18:18:05', 61880.00, NULL, 'entregado'),
(77, 4, '2025-05-23 15:24:28', 28560.00, NULL, 'entregado'),
(78, 4, '2025-05-23 18:15:21', 44426.27, NULL, 'entregado'),
(79, 29, '2025-05-24 22:02:12', 38080.00, NULL, 'entregado'),
(80, 29, '2025-05-24 22:04:57', 29750.00, NULL, 'entregado'),
(81, 29, '2025-05-24 22:07:42', 23800.00, NULL, 'entregado'),
(82, 29, '2025-05-24 22:59:02', 59500.00, NULL, 'entregado'),
(83, 29, '2025-05-24 23:10:36', 206658.97, NULL, 'entregado'),
(84, 29, '2025-05-24 23:12:06', 35700.00, NULL, 'entregado'),
(85, 29, '2025-05-24 23:38:47', 214592.70, NULL, 'pendiente'),
(86, 29, '2025-05-24 23:47:17', 11900.00, NULL, 'pendiente'),
(87, 29, '2025-05-24 23:49:47', 11900.00, NULL, 'pendiente'),
(88, 29, '2025-05-24 23:51:48', 11900.00, NULL, 'procesando'),
(89, 29, '2025-05-24 23:54:40', 47600.00, 'perra', 'entregado'),
(90, 29, '2025-05-24 23:55:47', 11900.00, 'hlkjf', 'cancelado'),
(91, 29, '2025-05-24 23:55:55', 11900.00, 'hlkjf', 'cancelado'),
(92, 29, '2025-05-25 00:00:03', 23800.00, 'no jodan', 'cancelado'),
(93, 29, '2025-05-25 00:00:45', 23800.00, 'no jodan', 'cancelado'),
(94, 29, '2025-05-25 00:00:59', 23800.00, 'no jodan', 'cancelado'),
(95, 29, '2025-06-05 00:29:24', 52000.00, 'hola #1', 'pendiente'),
(96, 29, '2025-06-05 00:29:42', 26000.00, 'hola droga', 'pendiente'),
(97, 29, '2025-06-05 00:30:20', 14000.00, 'hola droga', 'cancelado'),
(98, 29, '2025-06-05 00:31:00', 14000.00, 'hola droga', 'pendiente'),
(99, 29, '2025-06-05 00:32:36', 8000.00, 'hola #1', 'cancelado'),
(100, 29, '2025-06-05 00:35:49', 53999.00, 'hola #1', 'entregado'),
(101, 29, '2025-06-05 00:58:08', 8000.00, 'hola #1', 'cancelado'),
(102, 29, '2025-06-05 01:01:02', 8000.00, 'hola 1', 'cancelado'),
(103, 29, '2025-06-05 01:21:14', 14000.00, 'hola 1', 'pendiente');

--
-- Disparadores `pedidos`
--
DELIMITER $$
CREATE TRIGGER `retornar_stock_cancelado` BEFORE UPDATE ON `pedidos` FOR EACH ROW BEGIN
if(new.estado = 'cancelado') THEN
UPDATE productos JOIN detalles_pedido ON detalles_pedido.producto_id = productos.id
SET productos.stock = productos.stock + detalles_pedido.cantidad, Estado = 'ACTIVO' WHERE detalles_pedido.pedido_id = old.id;
END IF;
END
$$
DELIMITER ;

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
(1, 'Chorizo', 'un chorizo de carne de lentejas', 10000.00, 0, 'producto_68040c675dce4.jpg', '2025-04-15 17:03:05', 'INACTIVO'),
(2, 'Carne de Lentejas', 'un kg de carne de lentejas', 12000.00, 0, 'producto_68040c6f482fb.jpg', '2025-04-15 17:12:03', 'INACTIVO'),
(3, 'Empanada', 'Empanada cuyo ingrediente principal son lentejas', 3000.00, 4, 'producto_68040c77e32a5.jpg', '2025-04-16 15:45:46', 'ACTIVO'),
(4, 'Lentejas', 'lentejass', 12333.00, 2, 'producto_6830ffe17f436..jpg', '2025-05-23 18:08:17', 'ACTIVO');

--
-- Disparadores `productos`
--
DELIMITER $$
CREATE TRIGGER `desactivar_productos_sin_stock` BEFORE UPDATE ON `productos` FOR EACH ROW BEGIN 
    IF NEW.stock = 0 THEN
        SET NEW.Estado = 'INACTIVO';
    END IF;
END
$$
DELIMITER ;

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
(1, 'Administrador', 'nicoend20537@gmail.com', 'Administrador', '1234567890', 'ADMIN', '', 'ACTIVO'),
(2, 'Nicolas', 'guarinmolinan@gmail.coom', '', '3105986680', 'user', '$2y$10$3.fZ4VGc6w07Hp6/OpSOTumkiInsiKcaTcT01sBAkWOB.ngOZPUhu', 'ACTIVO'),
(3, 'Maria', 'mari@gmail.com', '', '3110957284', 'user', '$2y$10$KeOeDlLYgoAvnE/tpsdcB.wWp2d9vjV4Q.eOJvO8bB1RiJvbIsGUa', 'INACTIVO'),
(4, 'ENDYs', 'END@gmail.com', 'Administrador', '3100000000', 'ADMIN', '$2y$10$BFXqhejEmvdBkOnQY5Sc6urCU01YgrnRbGmwB77zjgMTZZSmYXAT.', 'ACTIVO'),
(5, 'Jhonny', 'andres@gmail.com', '', '1234567899', 'user', '$2y$10$.gYVUWLrNOOH2onFZmJE8.m749HA4UPg0W20cueBhHAqXFw3SIszm', 'INACTIVO'),
(6, 'Jhonny', 'user@domain.com', '', '1234567898', 'user', '$2y$10$SL2iCOQmVOBJm3SItbFm5OzE2tIGcVFdlo4ERZZqX4PcvtxSgy2B.', 'ACTIVO'),
(25, 'gaychocho', 'baloncestoentablon@gmail.com', 'la sexta', '3103849526', 'User', '$2y$10$KeOeDlLYgoAvnE/tpsdcB.wWp2d9vjV4Q.eOJvO8bB1RiJvbIsGUa', 'ACTIVO'),
(28, 'Jhonny', 'jadiaz@iegabo.edu.co', '', '3103561843', 'user', '$2y$10$HRQ1F55ujPNjCaCMYz0Y4.OQSmgpVW1LUjuabuc5a6wAUu1jQolLe', 'ACTIVO'),
(29, 'Jhonny dÍAZ', 'jhonnydiaz@gmail.com', 'hola 1', '9846164615', 'ADMIN', '$2y$10$UzJXqrEekj5/XPQoV5bdQOPFDHmpbbUfRnS00ropmTUF8K.P/Xn6q', 'ACTIVO');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
