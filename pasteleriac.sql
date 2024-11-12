-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2024 a las 20:21:32
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
-- Base de datos: `pasteleriac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `estado`) VALUES
(1, 'Pasteles', 'activo'),
(2, 'Tartas', 'activo'),
(3, 'Packs', 'activo'),
(4, 'Aperitivos', 'activo'),
(5, 'Cupcakes', 'activo'),
(6, 'Brownies', 'activo'),
(7, 'Cheesecakes', 'activo'),
(8, 'Galletas', 'activo'),
(9, 'Panes Dulces', 'activo'),
(10, 'Pastel', 'activo'),
(33, 'papel', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_cliente` enum('mayorista','minorista') DEFAULT 'minorista',
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `usuario_id`, `nombre`, `apellido`, `telefono`, `direccion`, `fecha_registro`, `tipo_cliente`, `estado`) VALUES
(1, 4, '', '', '4', 'asc', '2024-11-12 17:12:25', 'minorista', 'activo'),
(2, 6, '', '', '707007070', 'Av Arce n2', '2024-11-12 17:20:40', 'minorista', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedidos`
--

CREATE TABLE `detalles_pedidos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `rol` enum('deliveri','almacenero') NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `estado` enum('nuevo','espera','enviado') DEFAULT 'nuevo',
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_entrega` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `cliente_id`, `estado`, `fecha_pedido`, `fecha_entrega`) VALUES
(1, 2, 'nuevo', '2024-11-12 17:24:33', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo_producto` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estado` enum('disponible','nodisponible') DEFAULT 'disponible',
  `stock` int(11) DEFAULT 0,
  `unidad_medida` varchar(20) DEFAULT NULL,
  `proveedor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo_producto`, `nombre`, `descripcion`, `categoria_id`, `precio`, `imagen`, `estado`, `stock`, `unidad_medida`, `proveedor_id`) VALUES
(1, '123456', 'Tarta Crema Café', 'Base de café con crema pastelera infusionada en expresso, capas de bizcocho de chocolate con un toque de vainilla y decorada con caramelo salado y un suave glaseado de latte.', 1, 20.00, 'Tarta-CremaCafe.png', 'nodisponible', 99, 'unidades', 1),
(2, 'TART-002', 'Tarta Vainilla-Choco', 'Bizcocho de vainilla entrelazado con capas de chocolate, relleno de crema de frutilla y cubierto con una delicada capa de ganache de chocolate.', 2, 102.00, 'Tarta-VainillaChoco.png', 'nodisponible', 10, 'Unidad', 1),
(3, 'TART-003', 'Tarta Cookies & Cream', 'Deliciosa combinación de bizcocho de chocolate relleno con una suave crema de galleta Oreo, cubierto con merengue italiano y ganache de chocolate, decorado con galletas Oreo.', 2, 168.00, 'Tarta-CookiesNcream.png', 'disponible', 10, 'Unidad', 1),
(4, 'TART-004', 'Tarta Rosa Oscura', 'Bizcocho de chocolate esponjoso, con tres capas de crema de chocolate oscuro, decorado con pétalos de chocolate en forma de rosa. Para 12 personas.', 2, 180.00, 'Tarta-RosaOscura.png', 'disponible', 10, 'Unidad', 1),
(5, 'PACK-001', 'Pack Fiesta Chico', 'Incluye 9 aperitivos: cuñape, empanada de pollo, empanada de queso, y empanada de carne.', 3, 58.00, 'Pack-FiestaChico.jpeg', 'disponible', 10, 'Pack', 1),
(6, 'PACK-002', 'Pack Fiesta Grande', 'Incluye 24 aperitivos: cuñape, empanadas grandes de pollo, queso, y carne, acompañado de una gaseosa de 2 litros.', 3, 160.00, 'Pack-FiestaGrande.jpeg', 'nodisponible', 10, 'Pack', 1),
(7, 'CUN-001', 'Cuñape Delicia', 'Cuñapes crocantes por unidad, perfectos para cualquier ocasión.', 4, 7.00, 'CuñapeDelicia.jpg', 'disponible', 50, 'Unidad', 1),
(8, 'TART-005', 'Tarta Moka Caramelo', 'Bizcocho de chocolate suave con capas de crema de moka y caramelo salado, cubierto con una ganache de café.', 2, 145.00, 'Tarta-MokaCaramelo.png', 'disponible', 10, 'Unidad', 1),
(9, 'TART-006', 'Tarta Limón Merengue', 'Base de galleta con un relleno de crema de limón y cubierto con un merengue italiano gratinado.', 2, 120.00, 'Tarta-LimonMerengue.png', 'disponible', 10, 'Unidad', 1),
(10, 'TART-007', 'Tarta Red Velvet', 'Bizcocho rojo aterciopelado con capas de crema de queso y un ligero toque de vainilla, decorada con migas de Red Velvet.', 2, 155.00, 'Tarta-VelvetRojo.png', 'disponible', 10, 'Unidad', 1),
(11, 'TART-008', 'Tarta Choco-Avellana', 'Tarta de chocolate con relleno de crema de avellanas y trozos de avellanas caramelizadas, cubierta con un glaseado de chocolate.', 2, 175.00, 'Tarta-ChocoAvellana.png', 'disponible', 10, 'Unidad', 1),
(12, 'TART-009', 'Tarta de Zanahoria', 'Bizcocho de zanahoria con nueces, cubierto con una suave crema de queso y decorado con nueces caramelizadas.', 2, 135.00, 'Tarta-Zanahoria.png', 'disponible', 10, 'Unidad', 1),
(13, 'TART-010', 'Tarta Matcha', 'Delicada tarta de té verde matcha con capas de bizcocho de vainilla y crema de matcha, decorada con polvo de té verde.', 2, 165.00, 'Tarta-Matcha.png', 'disponible', 10, 'Unidad', 1),
(14, 'CUP-001', 'Cupcake de Vainilla', 'Cupcake esponjoso de vainilla con glaseado de crema de mantequilla de vainilla y decorado con sprinkles de colores.', 5, 35.00, 'Cupcake-Vainilla.png', 'disponible', 20, 'Unidad', 1),
(15, 'CUP-002', 'Cupcake de Chocolate', 'Cupcake de chocolate intenso con glaseado de crema de cacao, decorado con virutas de chocolate.', 5, 38.00, 'Cupcake-Choco.png', 'disponible', 20, 'Unidad', 1),
(16, 'BRW-001', 'Brownie de Nuez', 'Brownie de chocolate oscuro con trozos de nuez, cubierto con un glaseado de chocolate.', 6, 48.00, 'Brownie-Nuez.png', 'disponible', 15, 'Unidad', 1),
(17, 'BRW-002', 'Brownie Dulce de Leche', 'Brownie esponjoso con un centro de dulce de leche, decorado con hilos de caramelo.', 6, 50.00, 'Brownie-DulceLeche.png', 'disponible', 15, 'Unidad', 1),
(18, 'CHE-001', 'Cheesecake de Frutilla', 'Base de galleta con un relleno suave de queso crema y frutillas frescas, decorado con coulis de frutilla.', 7, 150.00, 'Cheesecake-Frutilla.png', 'disponible', 10, 'Unidad', 1),
(19, 'CHE-002', 'Cheesecake de Chocolate', 'Cheesecake cremoso con base de galleta de chocolate, decorado con ganache de chocolate oscuro y virutas de chocolate.', 7, 160.00, 'Cheesecake-Chocolate.png', 'disponible', 10, 'Unidad', 1),
(20, 'TART-011', 'Tarta de Frutas Frescas', 'Base de masa quebrada con crema pastelera y decorada con frutas frescas de temporada.', 2, 140.00, 'Tarta-FrutasFrescas.png', 'disponible', 10, 'Unidad', 1),
(21, 'TART-012', 'Tarta de Nuez y Caramelo', 'Masa de nuez con un relleno de caramelo suave, decorada con nueces caramelizadas.', 2, 155.00, 'Tarta-NuezCaramelo.png', 'disponible', 10, 'Unidad', 1),
(22, 'TART-013', 'Tarta Coco-Chocolate', 'Bizcocho de coco con capas de crema de chocolate y cubierto con una ganache de chocolate oscuro.', 2, 165.00, 'Tarta-CocoChoco.png', 'disponible', 10, 'Unidad', 1),
(23, 'TART-014', 'Tarta de Pistacho', 'Bizcocho de pistacho con relleno de crema de pistacho y decorada con trozos de pistacho tostado.', 2, 175.00, 'Tarta-Pistacho.png', 'disponible', 10, 'Unidad', 1),
(24, 'MINI-001', 'Mini Tartaleta de Limón', 'Tartaleta individual con base de masa quebrada y relleno de crema de limón, decorada con merengue.', 1, 25.00, 'Mini-TartaletaLimon.png', 'disponible', 30, 'Unidad', 1),
(25, 'MINI-002', 'Mini Tartaleta de Frutos Rojos', 'Base de masa quebrada con crema pastelera y decorada con una mezcla de frutos rojos frescos.', 1, 28.00, 'Mini-TartaletaFrutosRojos.png', 'disponible', 30, 'Unidad', 1),
(26, 'TART-015', 'Tarta de Almendra y Chocolate', 'Bizcocho de almendra con capas de crema de chocolate y decorada con almendras caramelizadas.', 2, 170.00, 'Tarta-AlmendraChoco.png', 'disponible', 10, 'Unidad', 1),
(27, 'TART-016', 'Tarta Tres Leches', 'Bizcocho esponjoso empapado en una mezcla de tres leches, cubierto con crema batida y decorado con canela en polvo.', 2, 160.00, 'Tarta-TresLeches.png', 'disponible', 10, 'Unidad', 1),
(28, 'TART-001', 'Tarta Crema Café', 'Base de café con crema pastelera infusionada en espresso, capas de bizcocho de chocolate con un toque de vainilla y decorada con caramelo salado y un suave glaseado de latte.', 2, 170.00, 'Tarta-CremaCafe.png', 'disponible', 10, 'Unidad', 1),
(30, 'PAST-001', 'Pastel de Chocolate', 'Delicioso pastel de chocolate con glaseado suave', 1, 25.99, 'pastel_chocolate.jpg', 'disponible', 10, 'Unidad', 1),
(31, 'GAL-001', 'Galletas de Avena y Pasas', 'Galletas crujientes de avena con pasas jugosas', 8, 8.99, 'galletas_avena.jpg', 'disponible', 20, 'Docena', 2),
(32, 'TART-017', 'Tarta de Frutas', 'Tarta fresca con una mezcla de frutas de temporada', 2, 32.50, 'tarta_frutas.jpg', 'disponible', 5, 'Unidad', 1),
(33, 'CUP-003', 'Cupcake de Fresa', 'Delicioso cupcake de fresa con frosting de crema', 5, 4.50, 'cupcake_fresa.jpg', 'disponible', 8, 'Unidad', 1),
(34, 'PAN-001', 'Berlin', 'Clásico berlin relleno de crema pastelera y cubierto de azúcar glas', 9, 4.99, 'berlin.jpg', 'disponible', 12, 'Unidad', 1),
(35, 'PAST-002', 'Pastel de Vainilla', 'Suave pastel de vainilla con decoración de crema', 1, 22.99, 'pastel_vainilla.jpg', 'disponible', 15, 'Unidad', 1),
(36, 'PAST-003', 'Pastel de Fresa', 'Delicioso pastel de fresa con decoración de crema', 1, 29.99, 'pastel_fresa.jpg', 'disponible', 10, 'Unidad', 1),
(37, 'GAL-002', 'Galletas de Mantequilla', 'Deliciosas galletas de mantequilla con un toque de vainilla', 8, 9.99, 'galletas_mantequilla.jpg', 'disponible', 25, 'Docena', 2),
(38, 'GAL-003', 'Galletas de chocolate', 'Deliciosas galletas de chocolate', 8, 2.99, 'galletas_choco.jpg', 'disponible', 10, 'Docena', 2),
(39, 'PAST-004', 'Pastel de Zanahoria', 'Delicioso pastel de zanahoria con crema de queso', 1, 27.99, 'pastel_zanahoria.jpg', 'disponible', 8, 'Unidad', 1),
(40, 'GAL-004', 'Galletas de Chocolate Blanco', 'Galletas crujientes con trozos de chocolate blanco', 8, 8.99, 'galletas_chocolate_blanco.jpg', 'disponible', 18, 'Docena', 2),
(41, 'PAN-002', 'Rosquillas de Canela', 'Rosquillas esponjosas con sabor a canela y cubiertas de azúcar', 9, 3.99, 'rosquillas_canela.jpg', 'disponible', 20, 'Unidad', 1),
(42, 'CUP-004', 'Cupcake de Vainilla', 'Delicioso cupcake de vainilla con frosting de buttercream', 5, 4.50, 'cupcake_vainilla.jpg', 'disponible', 10, 'Unidad', 1),
(43, 'TART-018', 'Tarta de Manzana', 'Tarta clásica de manzana con crujiente de canela', 2, 29.50, 'tarta_manzana.jpg', 'disponible', 5, 'Unidad', 1),
(44, 'GAL-005', 'Galletas de M&M', 'Galletas repletas de coloridos M&M para los amantes del chocolate', 8, 9.99, 'galletas_mm.jpg', 'disponible', 22, 'Docena', 2),
(45, 'PAN-003', 'Pan de Plátano', 'Pan esponjoso con sabor a plátano y nueces troceadas', 9, 7.99, 'pan_platano.jpg', 'disponible', 15, 'Unidad', 1),
(46, 'PAN-004', 'Pan de Canela', 'Pan dulce de canela con un glaseado dulce por encima', 9, 6.50, 'pan_canela.jpg', 'disponible', 10, 'Unidad', 1),
(47, 'CUP-005', 'Cupcake de Chocolate', 'Irresistible cupcake de chocolate con ganache de chocolate', 5, 5.50, 'cupcake_chocolate.jpg', 'disponible', 12, 'Unidad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` enum('activa','inactiva') DEFAULT 'activa',
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `porcentaje_descuento` decimal(5,2) DEFAULT NULL,
  `monto_descuento` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `imagen`, `nombre`, `producto_id`, `precio`, `descripcion`, `estado`, `fecha_inicio`, `fecha_fin`, `porcentaje_descuento`, `monto_descuento`) VALUES
(1, 'galleta.jpg', 'Galleta Halloween', 1, 2.00, 'Deliciosas galletas por unidad.', 'inactiva', '2024-10-01', '2024-10-31', 10.00, 0.20),
(2, 'galleta2.jpg', 'Galletas Personalizadas', 2, 2.00, 'Galletas de Todos los Santos por unidad.', 'inactiva', '2024-10-01', '2024-10-31', 15.00, 0.30),
(3, 'pastel1.jpg', 'Rebanada de Pastel', 3, 5.00, 'Rebanada de pastel.', 'inactiva', '2024-10-01', '2024-10-31', 0.00, 0.00),
(4, 'empanada1.jpg', 'Empanada de Manjar 3', 4, 3.00, 'Deliciosa empanada de manjar por unidad', 'activa', '2024-10-01', '2024-10-31', 5.00, 0.15),
(5, 'empanada2.jpg', 'Empanada de Carne', 5, 3.00, 'Deliciosa empanada de carne por unidad', 'activa', '2024-10-01', '2024-10-31', 0.00, 0.00),
(6, 'empanada3.jpg', 'Empanadas de Queso', 6, 2.00, 'Deliciosas empanadas de queso económicas por unidad.', 'activa', '2024-10-01', '2024-10-31', 7.00, 0.40),
(11, 'torta.jpg', 'Torta Mini', 8, 1.00, 'Torta mini sencilla', 'activa', '2024-10-01', '2024-10-31', 10.00, 1.50),
(20, 'Captura de pantalla 2024-11-11 131155.png', '1', 3, 1.00, '1', 'inactiva', '2024-11-11', '2024-11-14', 1.00, 1.00),
(21, 'IMAGEN4.png', '1', 34, 11.00, '1', 'activa', '2024-11-11', '2024-11-20', 1.00, 1.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `estado` enum('promocionado','no_promocionado') DEFAULT 'no_promocionado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `telefono`, `correo`, `direccion`, `estado`) VALUES
(1, 'LucasM', '74659821', 'Delisa@gmail.com', 'Av Villaroel Z. Villa Fatima  #54', 'no_promocionado'),
(2, 'Cocacola', '756949130', 'CocacolaBolivia@gmail.com', 'Av Centenenario Z. Central  #165', 'promocionado'),
(3, 'Ricardo', '70849512', 'bakersLapaz@gmail.com', 'Av Tawantisuyu Z Norte Calle 12', 'no_promocionado'),
(4, '', '70705040', 'prueba99@gmail.com', 'Av Litoral N45', 'no_promocionado'),
(5, '', '808', 'aca@gmail.com', 'Av dos', 'no_promocionado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo_usuario` enum('empleado','cliente') NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `tipo_usuario`, `estado`) VALUES
(1, 'Prueba', 'prueba', 'prueba@gmail.com', '$2y$10$Ae3TFAj9gFYZQInsWZEiKO6qsLGO01HJMxUVCZsqPQJgVCwcoI1Ju', 'cliente', 'activo'),
(2, '1', '1', '1@gmail.com', '$2y$10$XACXFRT6G8sm/7/ZSQwviedoTvTgZI4HTsbpy/1GNXRvtGEu2iZoa', 'empleado', 'inactivo'),
(3, 'r', 'sd', 'dd@sdv', '$2y$10$vby6U0/lrS/RSG1.WBofiOOyXtgs69G79l6UuXvCJlAY3v3kF13Tu', 'cliente', 'activo'),
(4, 'wegew', 'sgwe', 'sgwe@gmail.com', '$2y$10$jHqkjBIw5d5YsF6Zo96/i.j0HKsbhZ6AoRjaooEws6Gv6FkcRc5ym', 'cliente', 'activo'),
(5, 'none', 'none', 'none@gmail.com', '$2y$10$nNK.o.b2v0.2IlUD3IjmJeAQlwMtAttjlqvwoS0.144EawsMk87gG', 'cliente', 'activo'),
(6, 'pedro', 'rios', 'pedro@gmail.com', '$2y$10$P2Eabo2ms4P7d2ewLbAXdusmfRGQVrWOZ1WHD1QQOK2MMiuPZ1GjK', 'cliente', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_producto` (`codigo_producto`),
  ADD KEY `proveedor_id` (`proveedor_id`),
  ADD KEY `productos_ibfk_2` (`categoria_id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  ADD CONSTRAINT `detalles_pedidos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `detalles_pedidos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `promociones_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
