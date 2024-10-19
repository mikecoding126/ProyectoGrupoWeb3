-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2024 a las 01:12:58
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
-- Base de datos: `pasteleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `apellido` varchar(45) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `correo` varchar(40) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `telefono` int(45) NOT NULL,
  `mensaje` varchar(120) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre`, `apellido`, `correo`, `telefono`, `mensaje`) VALUES
(1, 'daniel', 'montes', 'hola@gmail.com', 666555442, 'Bastante bueno'),
(2, 'ana', 'martines', 'ana@gmail.com', 665544321, 'vamos'),
(3, 'juan', 'montes', 'dasd@gmail.com', 1232465, 'La calidad es aceptable'),
(4, 'JUAN', 'quispe', 'juan@gmail.com', 666555442, 'xd'),
(5, 'maria', 'nuñes', 'maria@gmail.com', 6064177, 'tremendo'),
(6, 'Victor', 'Fernandez', 'victor@gmail.com', 8594821, 'La variedad esta bien');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `idDetalle` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `nombreProducto` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_pedido`
--

INSERT INTO `detalles_pedido` (`idDetalle`, `idPedido`, `idProducto`, `nombreProducto`, `precio`, `cantidad`, `total`) VALUES
(1, 1, 2, 'Torta Pasión', 99.00, 1, 99.00),
(2, 1, 8, 'Empanadas de Queso', 6.00, 1, 6.00),
(3, 1, 18, 'Torta Dulce de Leche', 149.00, 1, 149.00),
(4, 2, 3, 'Torta Oreo', 165.00, 2, 330.00),
(5, 2, 11, 'Pack de alfajores Día de la Madre', 15.00, 1, 15.00),
(6, 2, 2, 'Torta Pasión', 99.00, 1, 99.00),
(7, 3, 8, 'Empanadas de Queso', 6.00, 1, 6.00),
(8, 3, 9, 'Quequiños', 59.00, 1, 59.00),
(9, 3, 14, 'Box Dulce Día de la Madre', 49.00, 1, 49.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `comentarios` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `nombre`, `direccion`, `telefono`, `comentarios`, `fecha`) VALUES
(1, 'nataly', 'xxxx', '4565465', 'kjblj', '2024-06-10 14:54:22'),
(2, 'dfsfgsd', '2313', '4565465', 'knblkjb', '2024-06-10 15:00:46'),
(3, 'dfsfgsd', 'xxxx', '4565465', '465', '2024-06-10 15:25:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codProducto` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` longtext NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `idProv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codProducto`, `imagen`, `nombre`, `descripcion`, `precio`, `estado`, `idProv`) VALUES
(1, 'Tarta-CremaCafe.png', 'Tarta Crema Café', 'Base de café con crema pastelera infusionada en espresso, capas de bizcocho de chocolate con un toque de vainilla y decorada con caramelo salado y un suave glaseado de latte.', 170, 'Disponible', 23),
(2, 'Tarta-VainillaChoco.png', 'Tarta Vainilla-Choco', 'Bizcocho de vainilla entrelazado con capas de chocolate, relleno de crema de frutilla y cubierto con una delicada capa de ganache de chocolate.', 102, 'Disponible', 23),
(3, 'Tarta-CookiesNcream.png', 'Tarta Cookies & Cream', 'Deliciosa combinación de bizcocho de chocolate relleno con una suave crema de galleta Oreo, cubierto con merengue italiano y ganache de chocolate, decorado con galletas Oreo.', 168, 'Disponible', 23),
(4, 'Tarta-RosaOscura.png', 'Tarta Rosa Oscura', 'Bizcocho de chocolate esponjoso, con tres capas de crema de chocolate oscuro, decorado con pétalos de chocolate en forma de rosa. Para 12 personas.', 180, 'Disponible', 0),
(5, 'Pack-FiestaChico.jpeg', 'Pack Fiesta Chico', 'Incluye 9 aperitivos: cuñape, empanada de pollo, empanada de queso, y empanada de carne.', 58, 'Disponible', 0),
(6, 'Pack-FiestaGrande.jpeg', 'Pack Fiesta Grande', 'Incluye 24 aperitivos: cuñape, empanadas grandes de pollo, queso, y carne, acompañado de una gaseosa de 2 litros.', 160, 'Disponible', 0),
(7, 'CuñapeDelicia.jpg', 'Cuñape Delicia', 'Cuñapes crocantes por unidad, perfectos para cualquier ocasión.', 7, 'Disponible', 0),
(8, 'Tarta-MokaCaramelo.png', 'Tarta Moka Caramelo', 'Bizcocho de chocolate suave con capas de crema de moka y caramelo salado, cubierto con una ganache de café.', 145, 'Disponible', 15),
(9, 'Tarta-LimonMerengue.png', 'Tarta Limón Merengue', 'Base de galleta con un relleno de crema de limón y cubierto con un merengue italiano gratinado.', 120, 'Disponible', 10),
(10, 'Tarta-VelvetRojo.png', 'Tarta Red Velvet', 'Bizcocho rojo aterciopelado con capas de crema de queso y un ligero toque de vainilla, decorada con migas de Red Velvet.', 155, 'Disponible', 18),
(11, 'Tarta-ChocoAvellana.png', 'Tarta Choco-Avellana', 'Tarta de chocolate con relleno de crema de avellanas y trozos de avellanas caramelizadas, cubierta con un glaseado de chocolate.', 175, 'Disponible', 25),
(12, 'Tarta-Zanahoria.png', 'Tarta de Zanahoria', 'Bizcocho de zanahoria con nueces, cubierto con una suave crema de queso y decorado con nueces caramelizadas.', 135, 'Disponible', 20),
(13, 'Tarta-Matcha.png', 'Tarta Matcha', 'Delicada tarta de té verde matcha con capas de bizcocho de vainilla y crema de matcha, decorada con polvo de té verde.', 165, 'Disponible', 12),
(14, 'Cupcake-Vainilla.png', 'Cupcake de Vainilla', 'Cupcake esponjoso de vainilla con glaseado de crema de mantequilla de vainilla y decorado con sprinkles de colores.', 35, 'Disponible', 40),
(15, 'Cupcake-Choco.png', 'Cupcake de Chocolate', 'Cupcake de chocolate intenso con glaseado de crema de cacao, decorado con virutas de chocolate.', 38, 'Disponible', 45),
(16, 'Brownie-Nuez.png', 'Brownie de Nuez', 'Brownie de chocolate oscuro con trozos de nuez, cubierto con un glaseado de chocolate.', 48, 'Disponible', 35),
(17, 'Brownie-DulceLeche.png', 'Brownie Dulce de Leche', 'Brownie esponjoso con un centro de dulce de leche, decorado con hilos de caramelo.', 50, 'Disponible', 25),
(18, 'Cheesecake-Frutilla.png', 'Cheesecake de Frutilla', 'Base de galleta con un relleno suave de queso crema y frutillas frescas, decorado con coulis de frutilla.', 150, 'Disponible', 18),
(19, 'Cheesecake-Chocolate.png', 'Cheesecake de Chocolate', 'Cheesecake cremoso con base de galleta de chocolate, decorado con ganache de chocolate oscuro y virutas de chocolate.', 160, 'Disponible', 20),
(20, 'Tarta-FrutasFrescas.png', 'Tarta de Frutas Frescas', 'Base de masa quebrada con crema pastelera y decorada con frutas frescas de temporada.', 140, 'Disponible', 10),
(21, 'Tarta-NuezCaramelo.png', 'Tarta de Nuez y Caramelo', 'Masa de nuez con un relleno de caramelo suave, decorada con nueces caramelizadas.', 155, 'Disponible', 8),
(22, 'Tarta-CocoChoco.png', 'Tarta Coco-Chocolate', 'Bizcocho de coco con capas de crema de chocolate y cubierto con una ganache de chocolate oscuro.', 165, 'Disponible', 22),
(23, 'Tarta-Pistacho.png', 'Tarta de Pistacho', 'Bizcocho de pistacho con relleno de crema de pistacho y decorada con trozos de pistacho tostado.', 175, 'Disponible', 17),
(24, 'Mini-TartaletaLimon.png', 'Mini Tartaleta de Limón', 'Tartaleta individual con base de masa quebrada y relleno de crema de limón, decorada con merengue.', 25, 'Disponible', 50),
(25, 'Mini-TartaletaFrutosRojos.png', 'Mini Tartaleta de Frutos Rojos', 'Base de masa quebrada con crema pastelera y decorada con una mezcla de frutos rojos frescos.', 28, 'Disponible', 45),
(26, 'Tarta-AlmendraChoco.png', 'Tarta de Almendra y Chocolate', 'Bizcocho de almendra con capas de crema de chocolate y decorada con almendras caramelizadas.', 170, 'Disponible', 15),
(27, 'Tarta-TresLeches.png', 'Tarta Tres Leches', 'Bizcocho esponjoso empapado en una mezcla de tres leches, cubierto con crema batida y decorado con canela en polvo.', 160, 'Disponible', 30),


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `codPromocion` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` longtext NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



INSERT INTO `promociones` (`codPromocion`, `imagen`, `nombre`, `descripcion`, `precio`, `estado`) VALUES
(1, 'galleta.jpg', 'Galleta Hallowen', 'Deliciosas galletas por unidad .', 2, 'Disponible'),
(2, 'galleta2.jpg', 'galletas Personalizadas', 'Galletas de Todos los Santos por unidad.', 2, 'Disponible'),
(3, 'pastel1.jpg', 'Rebanada de Pastel', 'Rebanada de pastel .', 5, 'Disponible'),
(4, 'empanada1.jpg', 'empanada de Manjar', 'Deliciosa empanada de manjar por unidad', 3, 'Disponible'),
(5, 'empanada2.jpg', 'Empanada de carne', 'Deliciosa empanada de Carne por unidad', 3, 'Disponible'),
(6, 'empanada3.jpg', 'Empanadas de Queso', 'Deliciosas Empanadas de Queso Economicas por unidad.',2 , 'Disponible'),
(7, 'torta.jpg', 'torta MIni', 'Torta mini sencilla ',15 , 'Disponible');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idProv` int(11) NOT NULL,
  `nomProv` varchar(20) NOT NULL,
  `telProv` int(9) NOT NULL,
  `correoProv` varchar(30) NOT NULL,
  `dirProv` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProv`, `nomProv`, `telProv`, `correoProv`, `dirProv`) VALUES
(0, 'Ricardo', 78549215, 'ricardo@gmail.com', 'Miraflores'),
(23, 'Jose', 78954921, 'jose@gmail.com', 'Irpavi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosc`
--

CREATE TABLE `usuariosc` (
  `idUsuario` int(11) NOT NULL,
  `email` varchar(80) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `pasword` char(60) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuariosc`
--

INSERT INTO `usuariosc` (`idUsuario`, `email`, `pasword`, `estado`) VALUES
(1, 'abc@gmail.com', '$2y$10$xXD2zZ61eO3Ind1yBisC1encS09lCvo/XLQNIf', 'Inactivo'),
(2, 'abcd@gmail.com', '$2y$10$J04ZiwXNIWWpIH8U4.fa3ebiLtQNS09Wsy1Fuv', 'Inactivo'),
(3, 'ale@gmail.com', '$2y$10$xJJUHlWNZbbRVg.JTrShweMxEczuTe10w.MDxg', 'Activo'),
(4, 'cris@gmail.com', '$2y$10$BpV9YUb8Pr7JjNDjKMH5de/qcPbxLgRH/TLh7U', 'Activo'),
(5, 'hola@gmail.com', '$2y$10$zefuTAmgclAeWahVZq4fBe8asgZ6Ck9xH2kSLZ', 'Activo'),
(6, 'man@gmail.com', '$2y$10$F3EtpialPWFSXJSi810PCeRDd1Co8in7eJr4iV', 'Activo'),
(7, 'manuel@gmail.com', '$2y$10$z11ibr1eH06cYu5vZaho2us8CuLFC/MG5BWGXw', 'Activo'),
(8, 'xd@gmail.com', '$2y$10$PSnM/vrEq7Y4MFTsabGxReZqzvhm8UxiM6x00D', 'Activo'),
(9, 'xdxd@gmail.com', '$2y$10$65QZkAMsPw.WQXYxCbIHpO6c4SHnTPInO8F/wNQfw1uGQHScsnYW2', 'Activo'),
(0, 'delia.100.10@gmail.com', '$2y$10$UUaNX1ssuc0t.HBfysqo5O0Fgq7q.f/PPPqWb4dumzziYj4ieDKv6', 'Activo'),
(0, '11@gj', '$2y$10$BAXD..eoLarWsK0KhreiFuOhWP95esLlYzcd6sAOQsnRHsMezsKVW', 'Activo'),
(1, 'abc@gmail.com', '$2y$10$xXD2zZ61eO3Ind1yBisC1encS09lCvo/XLQNIf', 'Inactivo'),
(2, 'abcd@gmail.com', '$2y$10$J04ZiwXNIWWpIH8U4.fa3ebiLtQNS09Wsy1Fuv', 'Inactivo'),
(3, 'ale@gmail.com', '$2y$10$xJJUHlWNZbbRVg.JTrShweMxEczuTe10w.MDxg', 'Activo'),
(4, 'cris@gmail.com', '$2y$10$BpV9YUb8Pr7JjNDjKMH5de/qcPbxLgRH/TLh7U', 'Activo'),
(5, 'hola@gmail.com', '$2y$10$zefuTAmgclAeWahVZq4fBe8asgZ6Ck9xH2kSLZ', 'Activo'),
(6, 'man@gmail.com', '$2y$10$F3EtpialPWFSXJSi810PCeRDd1Co8in7eJr4iV', 'Activo'),
(7, 'manuel@gmail.com', '$2y$10$z11ibr1eH06cYu5vZaho2us8CuLFC/MG5BWGXw', 'Activo'),
(8, 'xd@gmail.com', '$2y$10$PSnM/vrEq7Y4MFTsabGxReZqzvhm8UxiM6x00D', 'Activo'),
(9, 'xdxd@gmail.com', '$2y$10$65QZkAMsPw.WQXYxCbIHpO6c4SHnTPInO8F/wNQfw1uGQHScsnYW2', 'Activo'),
(0, 'delia.100.10@gmail.com', '$2y$10$UUaNX1ssuc0t.HBfysqo5O0Fgq7q.f/PPPqWb4dumzziYj4ieDKv6', 'Activo'),
(0, '11@gj', '$2y$10$BAXD..eoLarWsK0KhreiFuOhWP95esLlYzcd6sAOQsnRHsMezsKVW', 'Activo'),
(1, 'abc@gmail.com', '$2y$10$xXD2zZ61eO3Ind1yBisC1encS09lCvo/XLQNIf', 'Inactivo'),
(2, 'abcd@gmail.com', '$2y$10$J04ZiwXNIWWpIH8U4.fa3ebiLtQNS09Wsy1Fuv', 'Inactivo'),
(3, 'ale@gmail.com', '$2y$10$xJJUHlWNZbbRVg.JTrShweMxEczuTe10w.MDxg', 'Activo'),
(4, 'cris@gmail.com', '$2y$10$BpV9YUb8Pr7JjNDjKMH5de/qcPbxLgRH/TLh7U', 'Activo'),
(5, 'hola@gmail.com', '$2y$10$zefuTAmgclAeWahVZq4fBe8asgZ6Ck9xH2kSLZ', 'Activo'),
(6, 'man@gmail.com', '$2y$10$F3EtpialPWFSXJSi810PCeRDd1Co8in7eJr4iV', 'Activo'),
(7, 'manuel@gmail.com', '$2y$10$z11ibr1eH06cYu5vZaho2us8CuLFC/MG5BWGXw', 'Activo'),
(8, 'xd@gmail.com', '$2y$10$PSnM/vrEq7Y4MFTsabGxReZqzvhm8UxiM6x00D', 'Activo'),
(9, 'xdxd@gmail.com', '$2y$10$65QZkAMsPw.WQXYxCbIHpO6c4SHnTPInO8F/wNQfw1uGQHScsnYW2', 'Activo'),
(0, 'delia.100.10@gmail.com', '$2y$10$UUaNX1ssuc0t.HBfysqo5O0Fgq7q.f/PPPqWb4dumzziYj4ieDKv6', 'Activo'),
(0, '11@gj', '$2y$10$BAXD..eoLarWsK0KhreiFuOhWP95esLlYzcd6sAOQsnRHsMezsKVW', 'Activo'),
(1, 'abc@gmail.com', '$2y$10$xXD2zZ61eO3Ind1yBisC1encS09lCvo/XLQNIf', 'Inactivo'),
(2, 'abcd@gmail.com', '$2y$10$J04ZiwXNIWWpIH8U4.fa3ebiLtQNS09Wsy1Fuv', 'Inactivo'),
(3, 'ale@gmail.com', '$2y$10$xJJUHlWNZbbRVg.JTrShweMxEczuTe10w.MDxg', 'Activo'),
(4, 'cris@gmail.com', '$2y$10$BpV9YUb8Pr7JjNDjKMH5de/qcPbxLgRH/TLh7U', 'Activo'),
(5, 'hola@gmail.com', '$2y$10$zefuTAmgclAeWahVZq4fBe8asgZ6Ck9xH2kSLZ', 'Activo'),
(6, 'man@gmail.com', '$2y$10$F3EtpialPWFSXJSi810PCeRDd1Co8in7eJr4iV', 'Activo'),
(7, 'manuel@gmail.com', '$2y$10$z11ibr1eH06cYu5vZaho2us8CuLFC/MG5BWGXw', 'Activo'),
(8, 'xd@gmail.com', '$2y$10$PSnM/vrEq7Y4MFTsabGxReZqzvhm8UxiM6x00D', 'Activo'),
(9, 'xdxd@gmail.com', '$2y$10$65QZkAMsPw.WQXYxCbIHpO6c4SHnTPInO8F/wNQfw1uGQHScsnYW2', 'Activo'),
(0, 'delia.100.10@gmail.com', '$2y$10$UUaNX1ssuc0t.HBfysqo5O0Fgq7q.f/PPPqWb4dumzziYj4ieDKv6', 'Activo'),
(0, '11@gj', '$2y$10$BAXD..eoLarWsK0KhreiFuOhWP95esLlYzcd6sAOQsnRHsMezsKVW', 'Activo'),
(1, 'abc@gmail.com', '$2y$10$xXD2zZ61eO3Ind1yBisC1encS09lCvo/XLQNIf', 'Inactivo'),
(2, 'abcd@gmail.com', '$2y$10$J04ZiwXNIWWpIH8U4.fa3ebiLtQNS09Wsy1Fuv', 'Inactivo'),
(3, 'ale@gmail.com', '$2y$10$xJJUHlWNZbbRVg.JTrShweMxEczuTe10w.MDxg', 'Activo'),
(4, 'cris@gmail.com', '$2y$10$BpV9YUb8Pr7JjNDjKMH5de/qcPbxLgRH/TLh7U', 'Activo'),
(5, 'hola@gmail.com', '$2y$10$zefuTAmgclAeWahVZq4fBe8asgZ6Ck9xH2kSLZ', 'Activo'),
(6, 'man@gmail.com', '$2y$10$F3EtpialPWFSXJSi810PCeRDd1Co8in7eJr4iV', 'Activo'),
(7, 'manuel@gmail.com', '$2y$10$z11ibr1eH06cYu5vZaho2us8CuLFC/MG5BWGXw', 'Activo'),
(8, 'xd@gmail.com', '$2y$10$PSnM/vrEq7Y4MFTsabGxReZqzvhm8UxiM6x00D', 'Activo'),
(9, 'xdxd@gmail.com', '$2y$10$65QZkAMsPw.WQXYxCbIHpO6c4SHnTPInO8F/wNQfw1uGQHScsnYW2', 'Activo'),
(0, 'delia.100.10@gmail.com', '$2y$10$UUaNX1ssuc0t.HBfysqo5O0Fgq7q.f/PPPqWb4dumzziYj4ieDKv6', 'Activo'),
(0, '11@gj', '$2y$10$BAXD..eoLarWsK0KhreiFuOhWP95esLlYzcd6sAOQsnRHsMezsKVW', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosd`
--

CREATE TABLE `usuariosd` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `tipo_usuario` enum('cliente','empleado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuariosd`
--

INSERT INTO `usuariosd` (`id_usuario`, `nombre`, `email`, `contraseña`, `tipo_usuario`) VALUES
(1, 'Jhon Doe', 'john@example.com', 'jhon12', 'cliente'),
(2, 'Jane Smith', 'jane@example.com', 'jane123', 'empleado'),
(3, 'Diana', 'diana@example.com', 'Dianacm123', 'cliente'),
(1, 'Jhon Doe', 'john@example.com', 'jhon12', 'cliente'),
(2, 'Jane Smith', 'jane@example.com', 'jane123', 'empleado'),
(3, 'Diana', 'diana@example.com', 'Dianacm123', 'cliente'),
(1, 'Jhon Doe', 'john@example.com', 'jhon12', 'cliente'),
(2, 'Jane Smith', 'jane@example.com', 'jane123', 'empleado'),
(3, 'Diana', 'diana@example.com', 'Dianacm123', 'cliente'),
(1, 'Jhon Doe', 'john@example.com', 'jhon12', 'cliente'),
(2, 'Jane Smith', 'jane@example.com', 'jane123', 'empleado'),
(3, 'Diana', 'diana@example.com', 'Dianacm123', 'cliente'),
(1, 'Jhon Doe', 'john@example.com', 'jhon12', 'cliente'),
(2, 'Jane Smith', 'jane@example.com', 'jane123', 'empleado'),
(3, 'Diana', 'diana@example.com', 'Dianacm123', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `idPedido` (`idPedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codProducto`),
  ADD KEY `idProv` (`idProv`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`codPromocion`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idProv`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `codPromocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idProv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `detalles_pedido_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idProv`) REFERENCES `proveedores` (`idProv`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
