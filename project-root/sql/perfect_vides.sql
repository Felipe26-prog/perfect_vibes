-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2024 a las 14:46:11
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
-- Base de datos: `perfect_vides`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','pagada','cancelada') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_carrito`
--

CREATE TABLE `factura_carrito` (
  `factura_id` int(11) NOT NULL,
  `carrito_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','leido') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `nombre`, `email`, `mensaje`, `fecha`, `estado`) VALUES
(1, 'Krol valentina', 'Karolvalentina@gmail.com', 'Me parece buena su pagina los felicito', '2024-11-01 16:58:48', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `usuario_id`, `categoria`) VALUES
(33, 'Desodorante Arden For Men Clinical Power Protech Crema 70gr', 'Fórmula mejorada Clincal Power Protech, con activo antitranspirante de última tecnología con un ingrediente desodorante que se adelanta a la generación del mal olor para brindar una protección extrema contra la sudoración y el mal olor.', 8500.00, 'Desodorante Arden For Men Clinical Power Protech Crema 70gr.webp', NULL, NULL),
(34, 'Polvo Vitú Compacto Vitamina E Tono 3 Nuez 12gr', 'Su fórmula contiene vitamina E, un excelente antioxidante natural. Favorece la humectación de la piel y le da una apariencia más firme. Con filtro solar.', 13500.00, 'Polvo Vitú Compacto Vitamina E Tono 3 Nuez 12gr.webp', NULL, NULL),
(35, 'Corrector Catrice True Skin High Cover Tono 010 4.5ml', 'Corrector True Skin High Cover, la combinación perfecta entre una cobertura excelente y una cobertura ligera. ', 23500.00, 'Corrector Catrice True Skin High Cover Tono 010 4.5ml.webp', NULL, NULL),
(36, 'Corrector Essence Coverstick Tono 30 Matt Honey', '¡Nunca los volverás a ver! Este corrector cubre los granitos, rojeces e impurezas de la piel.', 7000.00, 'Corrector Essence Coverstick Tono 30 Matt Honey.webp', NULL, NULL),
(37, 'Shampoo Seco Moroccanoil Tonos Oscuros 205ml', 'Fórmula Profesional. Este shampoo seco se descompone instantáneamente, sin dejar residuos opacos y manteniendo la riqueza natural de los tonos oscuros y morenos.', 132000.00, 'Shampoo Seco Moroccanoil Tonos Oscuros 205ml.webp', NULL, NULL),
(38, 'Exfoliante Corporal', 'Elimina las células muertas y renueva tu piel, dejándola lista para todo. Mejora la apariencia de la piel de naranja, limpia tu piel, la hidrata y la deja suave y luminosa, contiene aceite de almendras, coco y naranja, gracias a esta mezcla tu piel estará mucho más hidratada.', 35000.00, 'Exfoliante Corporal.webp', NULL, NULL),
(39, 'Mascarilla Vitú Carbón Activado 15gr', 'Fórmula con efecto peel-off que desprende las impurezas de la piel, devolviéndole suavidad, frescura y una luminosidad natural al rostro.', 6000.00, 'Mascarilla Vitú Carbón Activado 15gr.webp', NULL, NULL),
(40, 'Talco Arden For Men Para Pies 170gr', 'Su fórmula con triclosán y boric acid actúan como activos antibacteriales, minimizando la acción de agentes microbianos, dejando una sensación de frescura y seguridad total durante todo el día.', 13000.00, 'Talco Arden For Men Para Pies 170gr.webp', NULL, NULL),
(41, 'Promoción Arden For Men Para Pies Antibacterial Aerosol 240ml X2 uds.', 'Desodorante antibacterial para pies que brindan 48 horas de protección contra el sudor y el mal olor.', 32000.00, 'Promoción Arden For Men Para Pies Antibacterial Aerosol 240ml X2 uds..webp', NULL, NULL),
(42, 'Jabón Reductor', 'Jabón que ayuda a disminuir y prevenir la celulitis, ayuda a mejorar la apariencia de la piel flácida.\r\nEstá enriquecido con té verde, cuenta con propiedades desintoxicantes y reductoras que reafirman la piel.\r\nTambién disponible en color blanco.', 18000.00, 'Jabón Reductor.webp', NULL, NULL),
(43, 'Gel Revox R Retinol Anti-Arrugas Ojos 30 Ml', 'Gel Revox R Retinol Anti-Arrugas Ojos 30 Ml', 34000.00, 'Gel Revox R Retinol Anti-Arrugas Ojos 30 Ml.webp', NULL, NULL),
(44, 'Pestañina Essence Call Me Queen False Lash 11.5ml', 'Looks llamativos y pestañas que sorprenden con su volumen.', 21500.00, 'Pestañina Essence Call Me Queen False Lash 11.5ml.webp', NULL, NULL),
(45, 'Iluminador Max Factor Facefinity Golden Hour 8gr', 'Iluminador ultra-ligero para un acabado profesional. Acabado difuminado que camufla los poros. Permite que la piel respire. Para lucir una piel perfecta y natural durante todo el año y tener un brillo saludable y radiante durante todo el día.', 62500.00, 'Iluminador Max Factor Facefinity Golden Hour 8gr.webp', NULL, NULL),
(46, 'Delineador Catrice Ojos Kohl Kajal Waterproof Tono 110 0.78gr', 'Para un toque de color resistente al agua e impresionante.', 13000.00, 'Delineador Catrice Ojos Kohl Kajal Waterproof Tono 110 0.78gr.webp', NULL, NULL),
(47, 'Cetaphil Crema Hidratante X 453 GCetaphil Crema Hidratante X 453 G', 'Emulsión facial que hidrata mientras protege de los rayos solares. Ayuda a prevenir los signos del envejecimiento prematuro por el sol.', 130000.00, 'Cetaphil Crema Hidratante X 453 G.webp', NULL, NULL),
(48, 'SOMBRA COSMOS TRENDY', 'El iluminador tiene un propósito en cada uno de los looks que quieres lograr y es elevar tu rostro.', 20000.00, 'SOMBRA COSMOS TRENDY.webp', NULL, NULL),
(49, 'Base Líquida ', 'Mezcla líquida y pigmentada que varía en acabado y niveles de cobertura para disimular las imperfecciones y dejar la piel con un aspecto uniforme', 15000.00, 'Base Líquida .jpeg', NULL, NULL),
(50, 'Xihbxyly Flash Deals Rubor Líquido Mate Claro Borde Natural', 'Crema suave y liviana que se puede mezclar y altamente pigmentada para un color de aspecto natural y un brillo duradero. Un rubor de belleza poco común, no quita el maquillaje, resistente al sudor y no pegajoso, puede durar efectivamente todo el día sin preocuparse por las imperfecciones del maquillaje.', 25000.00, 'Xihbxyly Flash Deals Liquid Blush Matte Clear Natural Border.webp', NULL, NULL),
(51, 'ESMALTE VOGUE EFECTO GEL ARMONIA BEIGE', 'ESMALTE VOGUE EFECTO GEL ARMONIA BEIGE', 11000.00, 'ESMALTE VOGUE EFECTO GEL ARMONIA BEIGE.png', NULL, NULL),
(52, 'Delineador Cat Line Doble Punta', '¡Descubre el Delineador Cat Line Doble Punta y lleva tu delineado al siguiente nivel! Este innovador delineador cuenta con dos puntas, brindándote la versatilidad que necesitas para crear trazos precisos y una cola de gato perfecta.', 15000.00, '5011DelineadorCatLine_1.webp', NULL, NULL),
(53, 'Máscara Efecto Pestañas De Muñeca', 'Disfruta de pestañas más grandes, grandes, grandes con cada pasada y la máscara Efecto Pestañas de Muñeca gracias a su mega cepillo, Su fórmula a prueba de agua y con aloe vera', 25000.00, 'Máscara Efecto Pestañas De Muñeca.png', NULL, NULL),
(54, 'Esmalte Vogue Efecto Gel Determinación', 'Esmalte Vogue Efecto Gel Determinación', 9500.00, 'Esmalte Vogue Efecto Gel Determinación.jpg', NULL, NULL),
(55, 'Dulzura', 'Esmalte Efecto Gel, hasta 10 días de duración con Biotina y Argán en 2 pasos, Paso 1: Color y Paso 2: Brillo, a un precio increíble.', 10500.00, 'Dulzura.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion_contraseña`
--

CREATE TABLE `recuperacion_contraseña` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiracion` datetime NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recuperacion_contraseña`
--

INSERT INTO `recuperacion_contraseña` (`id`, `correo`, `token`, `expiracion`, `usuario_id`, `cliente_id`) VALUES
(1, 'felipemuhalo2@gmail.com', 'bc06877e8db2b1e0ccb2ed150ec5a83fc9814804b43b77059ce518f4f88fcfe380d4b31c0b22df5b17c1d492c04a8b0722d9', '2024-10-01 18:58:18', NULL, NULL),
(2, 'felipemuhalo2@gmail.com', '60f34dc12a9ffb061b320cc7d8bca2b56ea899454df7316838e1f2a2a3694d67c61308e11e887e43b86342b8036b54a9e988', '2024-10-01 19:09:03', NULL, NULL),
(3, 'felipemuhalo2@gmail.com', '0a922a066dca89d75af48c14ae8234f837c996ca084ced1cc51f41c38bab5ffcb8eb29639b24fab5422f5b002378568151f8', '2024-10-01 19:29:54', NULL, NULL),
(4, 'felipemuhalo2@gmail.com', '7f7e2b4a72545c71af7c4748b887f90e83a5bf22e280b9c02144dfbed90e77387ed17b70c5e26f44b82e4684e7c1d4bf7c6b', '2024-10-01 19:31:48', NULL, NULL),
(5, 'felipemuhalo2@gmail.com', 'd9d6fbe78a6f1f4045d92c4895846b97d5c44e38693c56d0b2aab3a2fc669de30065252c8e5c1614ad2756eb976bc93acba8', '2024-10-01 19:34:37', NULL, NULL),
(6, 'felipemuhalo2@gmail.com', 'ac5bdb6df0f1a08cc5413e7bb6216e91e6c9e0a29bd4cd5dbd59a909e28366a300f96227812e0d9896244b8578090e9f3bf9', '2024-10-01 19:42:48', NULL, NULL),
(7, 'felipemuhalo2@gmail.com', 'f4c56dc71ce8763c207d74a0a41291b7dc93cf32ae2f865c98c248f367b05bc6292929e7a4da0e5bff955cdac74e28e21fa3', '2024-10-01 19:58:06', NULL, NULL),
(8, 'felipemuhalo2@gmail.com', '1d5ebd8592b61f7957f80a8a3917881cc64f4f3e10c73159058571f909480321bf1d4f8e6a6f5ca25733c6c144b890462cd2', '2024-10-01 19:58:38', NULL, NULL),
(9, 'felipemuhalo2@gmail.com', '0d2ed972a66f00de21abf8e738bf693dd53db7e0f1865d421c005d3bdf62b5269ab29fc1b100f84794cc901b0856f3221971', '2024-10-01 20:02:17', NULL, NULL),
(10, 'felipemuhalo2@gmail.com', 'ce31436968485edc2f465951247bf00b69eca354264336c05f3d23d6afb89817e897f36df00706e0cd87165029bf73850f58', '2024-10-01 20:05:09', NULL, NULL),
(11, 'felipemuhalo2@gmail.com', '04ce7fb23529df9bc617150d86b66925c86eef1c5bbf8b884b198e5278a3e0e9e78b9afd33579a7fbdb284c721e83f35159f', '2024-10-01 20:11:44', NULL, NULL),
(12, 'felipemuhalo2@gmail.com', '0488aa0d20b5d849202bcfc4faa1275f3d9cccd3238d8daddd66f3c59715dcf066ed6434c2253e7ad922d9a65216e789e96b', '2024-10-01 20:16:53', NULL, NULL),
(14, 'felipemuhalo@gmail.com', 'ad6c73251ce6170e73f242fb6c62bea546e029d174b7397d3aac3e442204c64a7dd9bf3b808bfe8e520c9a276199e1a25433', '2024-10-01 21:48:22', NULL, NULL),
(18, 'karendayanarojbel6@gmail.com', '3233bdf563ca3d59f29ec8cfab0f6476c6347c215e940166b16235d2a6e9471fb8a6de7c8ecd293cf2ee73cc171ba3c0e5b9', '2024-10-22 03:26:57', NULL, NULL),
(19, 'karendayanarojbel6@gmail.com', 'b50a1614a58baafd8cb8426334783e55c9aab0cf0ee5629ff084b4747dcb4d8b85079a3b6a4c8b945edae2f7a2117b9c2ff5', '2024-10-25 03:06:47', NULL, NULL),
(20, 'felipemuhalo@gmail.com', '01744038bca83e12ff6db93c0ded20e94128687b9ae6e8c904d22765efa2c387e570c2326a09ac99b35453d20eed244a87a0', '2024-10-25 03:09:26', NULL, NULL),
(21, 'karendayanarojbel6@gmail.com', 'ed624d4f5c8fb6f12c1eb088bcd01498f7057b31ebfc26a9ae825407310b5223df63a07918320ffad410f16c86abd9de62bf', '2024-10-25 03:19:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `video`, `usuario_id`, `whatsapp`) VALUES
(11, 'Pedicure tradicional', 'La mejor definición de pedicura es: tratamiento cosmético superficial de las uñas de los pies', 13000.00, 'pedicuretradicional.jpg', NULL, NULL, 'https://wa.me/573212343673'),
(12, 'Manicure tradicional', 'En el caso de la técnica tradicional, se utiliza esmalte de uñas regular que no se cura con ningún dispositivo.', 13000.00, 'manicuretradicional.webp', NULL, NULL, 'https://wa.me/573212343673'),
(13, 'Masajes corporales', 'El masaje es un tipo de medicina integral en la que un masajista frota y presiona firmemente la piel, los músculos, los tendones y los ligamentos.', 61000.00, 'masajes.jpeg', NULL, NULL, 'https://wa.me/573212343673'),
(14, 'Pedicure semipermanente', 'La manicura semipermanente es un esmaltado de secado inmediato y de larga duración que mantiene un resultado reluciente.', 50000.00, 'semipermanente.jpg', NULL, NULL, 'https://wa.me/573212343673'),
(15, 'Manicure en acrílico ', 'Las uñas acrílicas o artificiales son extensiones que se ponen sobre la uña natural con distintas técnicas o bien materiales', 150000.00, 'acrilicouñas.jpg', NULL, NULL, 'https://wa.me/573212343673'),
(18, 'Maquillaje', 'A pesar de que en un primer nivel de análisis el maquillaje pudiera parecer una técnica decorativa un tanto frívola, nada más lejos de la realidad.', 30000.00, 'Maquillaje.jfif', NULL, NULL, 'https://wa.me/573212343673');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(20) NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `telefono`, `contraseña`, `fecha_registro`, `role`) VALUES
(6, 'Admin Felipe', 'felipemuhalo@gmail.com', '3138556776', '$2y$10$xqhPwO03nvIwryygwbN9zOvhX527bjIi031yCqA0.jhC5ScNfwm16', '2024-10-16 07:15:07', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `factura_carrito`
--
ALTER TABLE `factura_carrito`
  ADD PRIMARY KEY (`factura_id`,`carrito_id`),
  ADD KEY `fk_factura_carrito_carrito` (`carrito_id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_usuarios` (`usuario_id`);

--
-- Indices de la tabla `recuperacion_contraseña`
--
ALTER TABLE `recuperacion_contraseña`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recuperacion_usuarios` (`usuario_id`),
  ADD KEY `fk_recuperacion_clientes` (`cliente_id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_servicios_usuarios` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `recuperacion_contraseña`
--
ALTER TABLE `recuperacion_contraseña`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_carrito_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura_carrito`
--
ALTER TABLE `factura_carrito`
  ADD CONSTRAINT `factura_carrito_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `factura_carrito_ibfk_2` FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_factura_carrito_carrito` FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_factura_carrito_factura` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `recuperacion_contraseña`
--
ALTER TABLE `recuperacion_contraseña`
  ADD CONSTRAINT `fk_recuperacion_clientes` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_recuperacion_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `fk_servicios_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
