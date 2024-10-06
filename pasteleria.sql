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
(1, 'daniel', 'montes', 'hola@gmail.com', 666555442, 'muy rico pero quisiera mas variedad'),
(2, 'ana', 'martines', 'ana@gmail.com', 665544321, 'cuando traen tortas heladas'),
(3, 'juan', 'montes', 'dasd@gmail.com', 1232465, 'mas donas'),
(4, 'JUAN', 'quispe', 'juan@gmail.com', 666555442, 'hola'),
(5, 'maria', 'nuñes', 'maria@gmail.com', 6064177, 'holas marias'),
(6, 'Victor', 'Fernandez', 'victor@gmail.com', 8594821, 'rico');

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
(1, 'Torta-Rosa.png', 'Torta Rosa Coffe', 'Masa de café, crema pastelera con espresso, Masa de chocolate, brigadeiro de vainilla con hilos de toffee salado, torta humectada con café latte.', 165, 'Disponible', 23),
(2, 'Torta-Pasion.png', 'Torta Pasión', 'Torta con masa de vainilla y masa de chocolate con relleno de crema de chocolate y crema de frutilla.', 99, 'Disponible', 23),
(3, 'Torta-Oreo.png', 'Torta Oreo', '¡Llegó abril y con él, la torta de tus sueños! Presentamos la increíble TORTA OREO: una masa de chocolate irresistible, rellena de la más suave crema de Oreo, capas de Oreos enteras, bañada en un delicado merengue italiano y un sedoso ganache de chocolate. Para rematar, ¡más Oreos decorando su corona!', 165, 'Disponible', 23),
(4, 'Torta-Rosa.png', 'Torta Rosa Negra', 'Esponjosa masa de chocolate, rellena con 3 capas de budín de chocolate, decorada con finos pétalos de chocolate que asemejan a una rosa. Para 12 personas.', 175, 'Disponible', 0),
(5, 'Party-Pack-Pequeño.jpeg', 'Party Pack Pequeño', '9 salados. Cuñape, empanada grande de pollo, queso y carne.', 54, 'Disponible', 0),
(6, 'Party-Pack-Mediano.jpeg', 'Party Pack Mediano', '24 salados. Cuñape, empanada grande de pollo, queso y carne, 1 gaseosa de 2 ltrs.', 154, 'Disponible', 0),
(7, 'Cuñape.jpg', 'Cuñape', 'Deliciosos cuñapes por unidad.', 6, 'Disponible', 0),
(8, 'Empanadas-Queso.jpg', 'Empanadas de Queso', 'Empanadas de Queso por unidad.', 6, 'Disponible', 0),
(9, 'Quequinos.png', 'Quequiños', 'Estos no son queques estos son ✨ quequiños ✨\r\nTe mostramos los dos sabores que te traemos para que los probés Te prometemos que no te arrepentirás.', 59, 'Disponible', 0),
(10, 'DESAYUNO-ESPECIAL-DIA-DE-LA-MADRE.jpg', 'Desayuno Especial Día de la Madre', 'Contiene: Omelette, 2 Tostadas, Pie de Limón, Porción de Torta, Pack de mini Bombitas, Tarta de Zanahoria, Empanada de Queso, Cuñape, Jugo, Apego', 134, 'Disponible', 0),
(11, 'ALFAJORES.jpg', 'Pack de alfajores Día de la Madre', 'Deliciosos alfajores edición Día de la Madre.\r\n¡Sorprendé a mamá!', 15, 'Disponible', 0),
(12, 'GALLETAS-DIA-DE-LA-MADRE.jpg', 'Pack Galletas de vainilla Día de la Madre', 'Deliciosas galletas edición Día de la Madre.\r\n¡Sorprendé a mamá!', 19, 'Disponible', 0),
(13, 'BOX-DIA-MADRE.jpg', 'Box Día de la Madre', 'Delicioso Box edición Día de la Madre.\r\n¡Sorprendé a mamá!', 89, 'Disponible', 0),
(14, 'BOX-DULCE-DIA-MADRE.jpg', 'Box Dulce Día de la Madre', 'Delicioso Box edición Día de la Madre.\r\n¡Sorprendé a mamá!', 49, 'Disponible', 0),
(15, 'Torta-Especial-Dia-de-la-Madre.jpg', 'Torta Especial Día de la Madre', 'Deliciosa Torta Especial edición Día de la Madre para 40 personas.\r\nMasa de vainilla con una capa de crema de dulce de leche.', 199, 'Disponible', 0),
(16, 'Desayuno-Fridolin.png', 'Desayuno Fridolin', 'El Desayuno Fridolin incluye: Cuñape, Tamal a la Olla, Sonso, Empanada de carne, Empanada de queso, Vaso mocochinchi, Alfajores de maicena, Nescafé Capuccino, Empanada de pollo grande, Bombones pasteleros, Sándwich mixto frío, Taza Fridolin, Torta de zanahoria Individual, Pie de limón Individual, Empanada de ricotta, Té de frutos surtidos, Yogurt griego, Sándwich de pollo, Penco porción, Azúcar, Edulcorante, Egg Salad Croissant, Porción de Rosa Negra', 270, 'Disponible', 0),
(17, 'TORTA-FELICIDAD.jpg', 'Torta Felicidad', 'Masa de vainilla, crema de frutilla, mermelada de frutilla, crema de durazno y mermelada de durazno.', 99, 'Disponible', 0),
(18, 'TORTA-DULCE-DE-LECHE.jpg', 'Torta Dulce de Leche', 'Suave masa de vainilla, rellena con una capa de dulce de leche y crema de dulce de leche. Bañada con una fina capa de merengue italiano.', 149, 'Disponible', 0),
(19, 'TORTA-ROSA-MARMOLADA.png', 'Torta Marmolada', 'Masa de chocolate rosa negra y masa de vainilla, con relleno de brigadeiro de chocolate negro y blanco, decorado con pétalos marmolados de chocolate negro y blanco.', 160, 'Disponible', 0),
(20, 'TORTA-ROSA-PINK.png', 'Torta Rosa Pink', 'Húmeda masa de chocolate y suave crema diplomata de frutilla y un corazón de salsa de frutos rojos.', 165, 'Disponible', 0),
(21, 'TORTA-SENSACION.jpg', 'Torta Sensación', 'Masa combinada de vainilla y chocolate, rellena con crema pastelera y dulce de leche, bañada en fina capa de merengue italiano, ganache de chocolate y suspiros de colores.', 149, 'Disponible', 0),
(22, 'Empanada-Carne.jpg', 'Empanadas de Carne', 'Deliciosas Empanadas de Carne por unidad.', 6, 'Disponible', 0),
(23, 'Empanada-Pollo-Mediano.jpg', 'Empanadas de Pollo Medianas', 'Deliciosas Empanadas de Pollo Medianas por unidad.', 6, 'Disponible', 0),
(24, 'Desayuno-Especial.png', 'Desayuno Especial', 'Contiene: Vaso Mocochinchi, Apego To Go - Almendra, Pie de limón Individual, Bombones pasteleros, Torta de zanahoria Individual, Cuñape, Empanada de carne, Empanada de queso, Taza fridolin, Nescafé, Té clasico, Azúcar, Edulcorante, Croissant jamón y queso, Slice cake Rosa Negra Individual', 134, 'Disponible', 0),
(25, 'Combo-Personal-Cafe-Americano.png', 'Combo Personal Café Americano', '1 Café Americano de 12 oz., 1 Empanada de Queso,1 Cuñape.', 24, 'Disponible', 0),
(26, 'Torta-Rosa-Blanca.png', 'Torta Rosa Blanca', 'Masa húmeda de vainilla, crema diplomata, dulce de leche cremoso y almendras pralinadas.', 165, 'Disponible', 0),
(27, 'ROSA-NEGRA-INDIVIDUAL.jpg', 'Rosa Negra Individual', 'Deliciosa Mini Rosa Negra.\r\n¡Sorprendé a quien más querés!', 49, 'Disponible', 0);

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

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`codPromocion`, `imagen`, `nombre`, `descripcion`, `precio`, `estado`) VALUES
(1, 'cunape.jpg', 'Cuñape', 'Deliciosos cuñapes por unidad.', 6, 'Disponible'),
(2, 'Empanada-de-queso.jpg', 'Empanadas de Queso', 'Deliciosas Empanadas de Queso por unidad.', 6, 'Disponible'),
(3, 'Empanada-de-carne.jpg', 'Empanadas de Carne', 'Deliciosas Empanadas de Carne por unidad.', 6, 'Disponible'),
(4, 'Party-Pack-Mediano.jpeg', 'Party Pack Mediano', '24 salados, Cuñape, empanada grande de pollo, queso y carne, 1 gaseosa de 2 ltrs.', 154, 'Disponible'),
(5, 'TORTA-PASION.jpg', 'Torta Pasión', 'Torta con masa de vainilla y masa de chocolate con relleno de crema de chocolate y crema de frutilla.', 99, 'Disponible'),
(6, 'Empanada-pollo-mediana.jpg', 'Empanadas de Pollo Medianas', 'Deliciosas Empanadas de Pollo Medianas por unidad.', 6, 'Disponible'),
(7, 'Party-Pack-Pequeño.jpeg', 'Party Pack Pequeño', '9 salados, Cuñape, empanada grande de pollo, queso y carne.', 54, 'Disponible'),
(8, 'Combo-Cafe-Americano.png', 'Combo Personal Café Americano', '1 Café Americano de 12 oz., 1 Empanada de Queso, 1 Cuñape.', 24, 'Disponible'),
(9, 'Combo-Cafe-Latte.png', 'Combo Personal Café Latte', '1 Café Latte de 12 oz., 1 Empanada de Queso, 1 Cuñape.', 24, 'Disponible'),
(10, 'Combo-Mocochinchi.png', 'Combo Personal Mocochinchi', ' 1 Vaso de Mocochinchi, 1 Empanada de Queso, 1 Cuñape.', 20, 'Agotado'),
(11, 'TORTA-FELICIDAD.jpg', 'Torta Felicidad', 'Masa de vainilla, crema de frutilla, mermelada de frutilla, crema de durazno y mermelada de durazno.', 99, 'Disponible');

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
