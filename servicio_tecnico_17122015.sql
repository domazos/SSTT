-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2015 a las 18:47:29
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `servicio_tecnico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_region` int(11) NOT NULL,
  `id_comuna` int(11) NOT NULL,
  `id_tipo_cliente` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `rut` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cod_cliente_ex` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contacto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `id_region`, `id_comuna`, `id_tipo_cliente`, `id_tienda`, `rut`, `cod_cliente_ex`, `nombre`, `direccion`, `correo`, `contacto`, `telefono`, `celular`, `fecha_creacion`, `fecha_modificacion`, `activo`) VALUES
(1, 13, 326, 1, 0, '15088254-0', 0, 'Jorge Domazos', 'Conquistador del Monte 5024', 'jdomazos@reif.cl', 'Jorge Domazos', '226781220', '78250024', '2015-10-05 17:59:01', '2015-10-05 22:33:57', 1),
(2, 13, 334, 2, 0, '0', 0, 'Cliente extranjero', 'Cualquier calle 123', 'cliente@empresa.cl', 'Juan Perez', '123456789', '999999999', '2015-10-05 23:29:03', '2015-10-06 22:06:44', 1),
(3, 1, 2, 2, 0, '', 500, 'Test cliente', 'asdasd', 'asdasd@asd.cl', '123123', '123123', '123123123', '2015-10-06 18:26:53', '2015-10-06 18:26:53', 1),
(4, 5, 53, 1, 0, '7132798-1', 0, 'Test nacional', 'calle 444', 'eee@asd.cl', 'asasdasd', '1231235', '123123123123', '2015-10-06 21:08:50', '2015-10-26 20:05:37', 1),
(5, 13, 320, 1, 0, '1-9', 0, 'test contrato', 'direccion contrato', 'correo@test.cl', 'contacto contrato', '12345678', '87654321', '2015-10-26 02:25:40', '2015-10-26 02:25:40', 1),
(6, 13, 320, 1, 0, '1-9', 0, 'cliente test', 'direc. test', 'correo@test.cl', 'cont. test', '999999', '888888', '2015-10-26 02:27:48', '2015-10-26 02:27:48', 1),
(7, 13, 297, 1, 0, '1-9', 0, 'test', 'asasd', 'asd@asd.asd', 'asdasd', '123123', '123123', '2015-10-26 02:37:53', '2015-10-26 02:37:53', 1),
(8, 13, 333, 1, 0, '1-9', 0, 'test', 'asd', 'asd@asd.c', 'asd', '123123', '123132123', '2015-10-26 02:50:17', '2015-10-26 02:50:17', 1),
(9, 13, 300, 1, 0, '1-9', 0, 'kjhkjh', 'kjh', 'domazos@gmail.com', 'kjh', '987987', '7897987', '2015-10-26 03:01:56', '2015-10-26 03:01:56', 1),
(10, 1, 2, 1, 0, '1-9', 0, 'asd', 'asd', 'asdasd@asd.cl', 'asdasd', '123', '123123', '2015-10-26 20:05:13', '2015-10-26 20:05:13', 1),
(11, 1, 2, 2, 0, '0', 500, 'Test cliente editado', 'asdasd', 'asdasd@asd.cl', 'Juanito Perez', '123123', '123123123', '2015-10-27 17:15:36', '2015-10-27 17:15:36', 1),
(12, 13, 326, 1, 0, '15088254-0', 0, 'Jorge Domazos Espinoza', 'Conquistador del Monte 5024', 'domazos@gmail.com', 'Jorge Domazos', '226781220', '78250024', '2015-10-27 19:47:22', '2015-10-27 19:47:22', 1),
(13, 2, 13, 1, 0, '1-9', 0, 'juan', 'perez', 'juan@asd.cl', 'asdad', '123123', '13123213', '2015-11-04 15:15:44', '2015-11-04 15:15:44', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunas`
--

CREATE TABLE IF NOT EXISTS `comunas` (
  `id_comuna` int(11) NOT NULL AUTO_INCREMENT,
  `id_region` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_comuna`),
  KEY `FK_comuna_region` (`id_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=367 ;

--
-- Volcado de datos para la tabla `comunas`
--

INSERT INTO `comunas` (`id_comuna`, `id_region`, `nombre`, `orden`, `activo`) VALUES
(2, 1, 'Alto Hospicio', 1, 1),
(3, 1, 'Iquique', 2, 1),
(4, 1, 'Huara', 3, 1),
(6, 1, 'Camiña', 4, 1),
(7, 1, 'Colchane', 5, 1),
(9, 1, 'Pica', 6, 1),
(11, 2, 'Tocopilla', 1, 1),
(12, 2, 'María Elena', 2, 1),
(13, 2, 'Calama', 3, 1),
(14, 2, 'Ollagüe', 4, 1),
(15, 2, 'San Pedro de Atacama', 5, 1),
(16, 2, 'Antofagasta', 6, 1),
(17, 2, 'Mejillones', 7, 1),
(18, 2, 'Sierra Gorda', 8, 1),
(19, 2, 'Taltal', 9, 1),
(20, 3, 'Chañaral', 1, 1),
(21, 3, 'Diego de Almagro', 2, 1),
(22, 3, 'Copiapó', 3, 1),
(23, 3, 'Caldera', 4, 1),
(24, 3, 'Tierra Amarilla', 5, 1),
(25, 3, 'Vallenar', 6, 1),
(26, 3, 'Freirina', 7, 1),
(27, 3, 'Huasco', 8, 1),
(28, 3, 'Alto del Carmen', 9, 1),
(29, 4, 'La Serena', 1, 1),
(30, 4, 'Los Vilos', 14, 1),
(31, 4, 'Salamanca', 13, 1),
(32, 4, 'Illapel', 12, 1),
(33, 4, 'Punitaqui', 11, 1),
(34, 4, 'Combarbalá', 10, 1),
(35, 4, 'Monte Patria', 9, 1),
(36, 4, 'Río Hurtado', 8, 1),
(37, 4, 'Ovalle', 7, 1),
(38, 4, 'Paihuano', 6, 1),
(39, 4, 'Vicuña', 5, 1),
(40, 4, 'Andacollo', 4, 1),
(41, 4, 'Coquimbo', 3, 1),
(42, 4, 'La Higuera', 2, 1),
(43, 4, 'Canela', 15, 1),
(44, 5, 'La Ligua', 1, 1),
(45, 5, 'Limache', 21, 1),
(46, 5, 'Olmué', 22, 1),
(47, 5, 'Valparaíso', 23, 1),
(48, 5, 'Viña del Mar', 24, 1),
(49, 5, 'Quintero', 25, 1),
(50, 5, 'Puchuncaví', 26, 1),
(51, 5, 'Quilpué', 27, 1),
(52, 5, 'Villa Alemana', 28, 1),
(53, 5, 'Casablanca', 29, 1),
(54, 5, 'Concón', 30, 1),
(55, 5, 'Juan Fernández', 31, 1),
(56, 5, 'San Antonio', 32, 1),
(57, 5, 'Cartagena', 33, 1),
(58, 5, 'El Tabo', 34, 1),
(59, 5, 'El Quisco', 35, 1),
(60, 5, 'Algarrobo', 36, 1),
(61, 5, 'Santo Domingo', 37, 1),
(62, 5, 'Hijuelas', 20, 1),
(63, 5, 'Nogales', 19, 1),
(64, 5, 'Petorca', 2, 1),
(65, 5, 'Cabildo', 3, 1),
(66, 5, 'Zapallar', 4, 1),
(67, 5, 'Papudo', 5, 1),
(68, 5, 'Los Andes', 6, 1),
(69, 5, 'San Esteban', 7, 1),
(70, 5, 'Calle Larga', 8, 1),
(71, 5, 'Rinconada', 9, 1),
(72, 5, 'San Felipe', 10, 1),
(73, 5, 'Putaendo', 11, 1),
(74, 5, 'Santa María', 12, 1),
(75, 5, 'Panquehue', 13, 1),
(76, 5, 'Llayllay', 14, 1),
(77, 5, 'Catemu', 15, 1),
(78, 5, 'Quillota', 16, 1),
(79, 5, 'La Cruz', 17, 1),
(80, 5, 'Calera', 18, 1),
(81, 5, 'Isla de Pascua', 38, 1),
(82, 6, 'Rancagua', 1, 1),
(83, 6, 'Chimbarongo', 19, 1),
(84, 6, 'Placilla', 20, 1),
(85, 6, 'Nancagua', 21, 1),
(86, 6, 'Chépica', 22, 1),
(87, 6, 'Santa Cruz', 23, 1),
(88, 6, 'Lolol', 24, 1),
(89, 6, 'Pumanque', 25, 1),
(90, 6, 'Palmilla', 26, 1),
(91, 6, 'Peralillo', 27, 1),
(92, 6, 'Pichilemu', 28, 1),
(93, 6, 'Navidad', 29, 1),
(94, 6, 'Litueche', 30, 1),
(95, 6, 'La Estrella', 31, 1),
(96, 6, 'Marchihue', 32, 1),
(97, 6, 'San Fernando', 18, 1),
(98, 6, 'Las Cabras', 17, 1),
(99, 6, 'Doñihue', 16, 1),
(100, 6, 'Graneros', 2, 1),
(101, 6, 'Mostazal', 3, 1),
(102, 6, 'Codegua', 4, 1),
(103, 6, 'Machalí', 5, 1),
(104, 6, 'Olivar', 6, 1),
(105, 6, 'Requinoa', 7, 1),
(106, 6, 'Rengo', 8, 1),
(107, 6, 'Malloa', 9, 1),
(108, 6, 'Quinta de Tilcoco', 10, 1),
(109, 6, 'San Vicente', 11, 1),
(110, 6, 'Pichidegua', 12, 1),
(111, 6, 'Peumo', 13, 1),
(112, 6, 'Coltauco', 14, 1),
(113, 6, 'Coinco', 15, 1),
(114, 6, 'Paredones', 33, 1),
(115, 7, 'Curicó', 1, 1),
(116, 7, 'Pencahue', 17, 1),
(117, 7, 'Constitución', 18, 1),
(118, 7, 'Curepto', 19, 1),
(119, 7, 'Linares', 20, 1),
(120, 7, 'Yerbas Buenas', 21, 1),
(121, 7, 'Colbún', 22, 1),
(122, 7, 'Longaví', 23, 1),
(123, 7, 'Parral', 24, 1),
(124, 7, 'Retiro', 25, 1),
(125, 7, 'Villa Alegre', 26, 1),
(126, 7, 'San Javier', 27, 1),
(127, 7, 'Cauquenes', 28, 1),
(128, 7, 'Pelluhue', 29, 1),
(129, 7, 'Empedrado', 16, 1),
(130, 7, 'San Rafael', 15, 1),
(131, 7, 'Teno', 2, 1),
(132, 7, 'Romeral', 3, 1),
(133, 7, 'Molina', 4, 1),
(134, 7, 'Sagrada Familia', 5, 1),
(135, 7, 'Hualañé', 6, 1),
(136, 7, 'Licantén', 7, 1),
(137, 7, 'Vichuquén', 8, 1),
(138, 7, 'Rauco', 9, 1),
(139, 7, 'Talca', 10, 1),
(140, 7, 'Pelarco', 11, 1),
(141, 7, 'Río Claro', 12, 1),
(142, 7, 'San Clemente', 13, 1),
(143, 7, 'Maule', 14, 1),
(144, 7, 'Chanco', 30, 1),
(145, 8, 'Cañete', 52, 1),
(146, 8, 'Penco', 38, 1),
(147, 8, 'Talcahuano', 37, 1),
(148, 8, 'Concepción', 36, 1),
(149, 8, 'Yumbel', 35, 1),
(150, 8, 'San Rosendo', 34, 1),
(151, 8, 'Laja', 33, 1),
(152, 8, 'Nacimiento', 32, 1),
(154, 8, 'Mulchén', 30, 1),
(155, 8, 'Quilaco', 29, 1),
(156, 8, 'Santa Bárbara', 28, 1),
(157, 8, 'Tomé', 39, 1),
(158, 8, 'Florida', 40, 1),
(159, 8, 'Los Alamos', 51, 1),
(160, 8, 'Curanilahue', 50, 1),
(161, 8, 'Arauco', 49, 1),
(162, 8, 'Lebu', 48, 1),
(163, 8, 'Chiguayante', 47, 1),
(164, 8, 'San Pedro de la Paz', 46, 1),
(165, 8, 'Coronel', 45, 1),
(166, 8, 'Lota', 44, 1),
(167, 8, 'Santa Juana', 43, 1),
(168, 8, 'Hualqui', 42, 1),
(169, 8, 'Hualpén', 41, 1),
(170, 8, 'Quilleco', 27, 1),
(171, 8, 'Antuco', 26, 1),
(172, 8, 'Quillón', 12, 1),
(173, 8, 'Bulnes', 11, 1),
(174, 8, 'Pemuco', 10, 1),
(175, 8, 'Yungay', 9, 1),
(176, 8, 'El Carmen', 8, 1),
(177, 8, 'San Ignacio', 7, 1),
(178, 8, 'Pinto', 6, 1),
(179, 8, 'Coihueco', 5, 1),
(180, 8, 'San Fabián', 4, 1),
(181, 8, 'Ñiquén', 3, 1),
(182, 8, 'San Carlos', 2, 1),
(183, 8, 'Ránquil', 13, 1),
(184, 8, 'Portezuelo', 14, 1),
(185, 8, 'Tucapel', 25, 1),
(186, 8, 'Cabrero', 24, 1),
(187, 8, 'Los Angeles', 23, 1),
(188, 8, 'Alto Biobío', 22, 1),
(189, 8, 'Chillán Viejo', 21, 1),
(190, 8, 'San Nicolás', 20, 1),
(191, 8, 'Ninhue', 19, 1),
(192, 8, 'Quirihue', 18, 1),
(193, 8, 'Cobquecura', 17, 1),
(194, 8, 'Treguaco', 16, 1),
(195, 8, 'Coelemu', 15, 1),
(196, 8, 'Chillán', 1, 1),
(197, 9, 'Angol', 1, 1),
(198, 9, 'Melipeuco', 18, 1),
(199, 9, 'Curarrehue', 19, 1),
(200, 9, 'Pucón', 20, 1),
(201, 9, 'Villarrica', 21, 1),
(202, 9, 'Freire', 22, 1),
(203, 9, 'Pitrufquén', 23, 1),
(204, 9, 'Gorbea', 24, 1),
(205, 9, 'Loncoche', 25, 1),
(206, 9, 'Toltén', 26, 1),
(207, 9, 'Teodoro Schmidt', 27, 1),
(208, 9, 'Saavedra', 28, 1),
(209, 9, 'Carahue', 29, 1),
(210, 9, 'Nueva Imperial', 30, 1),
(211, 9, 'Cunco', 17, 1),
(212, 9, 'Cholchol', 16, 1),
(213, 9, 'Vilcún', 15, 1),
(214, 9, 'Renaico', 2, 1),
(215, 9, 'Collipulli', 3, 1),
(216, 9, 'Lonquimay', 4, 1),
(217, 9, 'Curacautín', 5, 1),
(218, 9, 'Ercilla', 6, 1),
(219, 9, 'Victoria', 7, 1),
(220, 9, 'Traiguén', 8, 1),
(221, 9, 'Lumaco', 9, 1),
(222, 9, 'Purén', 10, 1),
(223, 9, 'Los Sauces', 11, 1),
(224, 9, 'Temuco', 12, 1),
(225, 9, 'Lautaro', 13, 1),
(226, 9, 'Perquenco', 14, 1),
(227, 9, 'Galvarino', 31, 1),
(229, 10, 'Palena', 30, 1),
(230, 10, 'Futaleufú', 29, 1),
(231, 10, 'Hualaihué', 28, 1),
(232, 10, 'Chaitén', 27, 1),
(233, 10, 'Quellón', 26, 1),
(234, 10, 'Queilén', 25, 1),
(235, 10, 'Chonchi', 24, 1),
(236, 10, 'Puqueldón', 23, 1),
(248, 10, 'Quinchao', 22, 1),
(249, 10, 'Curaco de Vélez', 21, 1),
(250, 10, 'Puerto Varas', 9, 1),
(251, 10, 'Puerto Montt', 8, 1),
(252, 10, 'San Juan de la Costa', 7, 1),
(253, 10, 'Río Negro', 6, 1),
(254, 10, 'Purranque', 5, 1),
(255, 10, 'Puerto Octay', 4, 1),
(256, 10, 'Puyehue', 3, 1),
(257, 10, 'San Pablo', 2, 1),
(258, 10, 'Cochamó', 10, 1),
(259, 10, 'Calbuco', 11, 1),
(260, 10, 'Maullín', 12, 1),
(261, 10, 'Dalcahue', 20, 1),
(262, 10, 'Quemchi', 19, 1),
(263, 10, 'Ancud', 18, 1),
(264, 10, 'Castro', 17, 1),
(265, 10, 'Frutillar', 16, 1),
(266, 10, 'Llanquihue', 15, 1),
(267, 10, 'Fresia', 14, 1),
(268, 10, 'Los Muermos', 13, 1),
(269, 10, 'Osorno', 1, 1),
(270, 11, 'Coihaique', 1, 1),
(271, 11, 'O''Higgins', 8, 1),
(272, 11, 'Cochrane', 8, 1),
(273, 11, 'Río Ibánez', 7, 1),
(274, 11, 'Chile Chico', 6, 1),
(275, 11, 'Guaitecas', 5, 1),
(276, 11, 'Cisnes', 4, 1),
(277, 11, 'Aisén', 3, 1),
(278, 11, 'Lago Verde', 2, 1),
(279, 11, 'Tortel', 10, 1),
(280, 12, 'Natales', 1, 1),
(281, 12, 'Timaukel', 9, 1),
(282, 12, 'Primavera', 8, 1),
(283, 12, 'Porvenir', 7, 1),
(284, 12, 'San Gregorio', 6, 1),
(285, 12, 'Laguna Blanca', 5, 1),
(286, 12, 'Rio Verde', 4, 1),
(287, 12, 'Punta Arenas', 3, 1),
(288, 12, 'Torres del Paine', 2, 1),
(289, 12, 'Cabo de Hornos', 10, 1),
(291, 13, 'San Bernardo', 40, 1),
(292, 13, 'Pirque', 39, 1),
(293, 13, 'San José de Maipo', 38, 1),
(294, 13, 'Puente Alto', 37, 1),
(295, 13, 'Tiltil', 35, 1),
(296, 13, 'Lampa', 34, 1),
(297, 13, 'Colina', 33, 1),
(298, 13, 'Quilicura', 32, 1),
(299, 13, 'Renca', 31, 1),
(300, 13, 'Cerro Navia', 30, 1),
(301, 13, 'Pudahuel', 29, 1),
(302, 13, 'Buin', 41, 1),
(303, 13, 'Paine', 42, 1),
(304, 13, 'Calera de Tango', 43, 1),
(306, 13, 'Padre Hurtado', 53, 1),
(307, 13, 'El Monte', 52, 1),
(308, 13, 'Isla de Maipo', 51, 1),
(309, 13, 'Peñaflor', 50, 1),
(310, 13, 'Talagante', 49, 1),
(311, 13, 'San Pedro', 48, 1),
(312, 13, 'Alhué', 47, 1),
(313, 13, 'Curacaví', 46, 1),
(314, 13, 'María Pinto', 45, 1),
(315, 13, 'Melipilla', 44, 1),
(316, 13, 'Lo Prado', 28, 1),
(317, 13, 'Quinta Normal', 27, 1),
(318, 13, 'Macul', 12, 1),
(319, 13, 'La Reina', 11, 1),
(320, 13, 'Ñuñoa', 10, 1),
(321, 13, 'Las Condes', 9, 1),
(322, 13, 'Lo Barnechea', 8, 1),
(323, 13, 'Vitacura', 7, 1),
(324, 13, 'Providencia', 6, 1),
(325, 13, 'Recoleta', 5, 1),
(326, 13, 'Huechuraba', 4, 1),
(327, 13, 'Conchalí', 3, 1),
(328, 13, 'Independencia', 2, 1),
(329, 13, 'Peñalolén', 13, 1),
(330, 13, 'La Florida', 14, 1),
(331, 13, 'San Joaquín', 15, 1),
(332, 13, 'Maipú', 26, 1),
(333, 13, 'Cerrillos', 25, 1),
(334, 13, 'Estación Central', 24, 1),
(335, 13, 'Lo Espejo', 23, 1),
(336, 13, 'Pedro Aguirre Cerda', 22, 1),
(337, 13, 'El Bosque', 21, 1),
(338, 13, 'La Cisterna', 20, 1),
(339, 13, 'San Miguel', 19, 1),
(340, 13, 'San Ramón', 18, 1),
(341, 13, 'La Pintana', 17, 1),
(342, 13, 'La Granja', 16, 1),
(343, 13, 'Santiago', 1, 1),
(345, 15, 'Arica', 1, 1),
(346, 15, 'Camarones', 2, 1),
(347, 15, 'Putre', 3, 1),
(348, 15, 'General Lagos', 4, 1),
(349, 12, 'Antártica', 11, 1),
(350, 16, 'Valdivia', 1, 1),
(351, 16, 'Mariquina', 2, 1),
(352, 16, 'Lanco', 3, 1),
(353, 16, 'Máfil', 4, 1),
(354, 16, 'Corral', 5, 1),
(355, 16, 'Los Lagos', 6, 1),
(356, 16, 'Panguipulli', 7, 1),
(357, 16, 'Paillaco', 8, 1),
(358, 16, 'La Unión', 9, 1),
(359, 16, 'Futrono', 10, 1),
(360, 16, 'Río Bueno', 11, 1),
(361, 16, 'Lago Ranco', 12, 1),
(363, 8, 'Contulmo', 1, 1),
(364, 8, 'Tirua', 1, 1),
(365, 1, 'Pozo Almonte', 7, 1),
(366, 9, 'Padre las Casas', 32, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_reparacion`
--

CREATE TABLE IF NOT EXISTS `contratos_reparacion` (
  `id_contrato` int(11) NOT NULL AUTO_INCREMENT,
  `id_familia` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_tipo_contrato` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_recepcion` datetime NOT NULL,
  `num_serie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `garantia` tinyint(4) NOT NULL,
  `buscar_iphone` tinyint(4) NOT NULL,
  `marca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `falla_cliente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rayas` tinyint(4) NOT NULL,
  `golpes` tinyint(4) NOT NULL,
  `abolladuras` tinyint(4) NOT NULL,
  `marcas` tinyint(4) NOT NULL,
  `liquido` tinyint(4) NOT NULL,
  `intervenido` tinyint(4) NOT NULL,
  `cod_vendedor` int(11) NOT NULL,
  `num_boleta` int(11) NOT NULL,
  `fecha_boleta` datetime NOT NULL,
  `fecha_tent_diagnostico` datetime NOT NULL,
  `fecha_tent_entrega` datetime NOT NULL,
  `observacion_final` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_observacion_final` datetime NOT NULL,
  PRIMARY KEY (`id_contrato`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

--
-- Volcado de datos para la tabla `contratos_reparacion`
--

INSERT INTO `contratos_reparacion` (`id_contrato`, `id_familia`, `id_estado`, `id_cliente`, `id_tipo_contrato`, `id_usuario`, `fecha_recepcion`, `num_serie`, `modelo`, `descripcion`, `garantia`, `buscar_iphone`, `marca`, `falla_cliente`, `rayas`, `golpes`, `abolladuras`, `marcas`, `liquido`, `intervenido`, `cod_vendedor`, `num_boleta`, `fecha_boleta`, `fecha_tent_diagnostico`, `fecha_tent_entrega`, `observacion_final`, `fecha_observacion_final`) VALUES
(1, 1, 6, 1, 1, 1, '1970-01-01 00:00:00', '12345', 'iphone 9', 'test descripcion', 1, 1, '0', 'test falla cliente', 1, 0, 0, 1, 0, 0, 0, 999999, '2015-02-10 00:00:00', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'Trabajo terminado correctamente.', '2015-11-04 13:53:13'),
(2, 1, 1, 3, 1, 1, '1970-01-01 01:00:00', '55555', 'iMac', 'desc 2', 1, 1, '0', 'asdasdasd', 1, 1, 1, 1, 0, 0, 0, 88888, '1970-01-01 00:00:00', '1970-01-01 01:00:00', '1970-01-01 01:00:00', '', '0000-00-00 00:00:00'),
(3, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', 'asdasd', 'asdsasad', 'asd', 1, 1, '0', 'asdasd', 1, 1, 1, 1, 1, 1, 0, 123123, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(4, 1, 1, 1, 1, 1, '2015-10-25 21:03:00', 'ads', 'asdasd', 'asd', 1, 1, '0', 'asdasd', 1, 1, 1, 1, 1, 1, 0, 123123, '2015-10-03 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(6, 1, 1, 1, 2, 1, '2015-10-25 21:39:00', '9987', 'hkjh', 'kjhkjhjk', 0, 0, '0', 'dsfsdfsdf', 1, 1, 1, 1, 1, 1, 0, 123123, '2015-10-07 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(7, 2, 2, 1, 2, 1, '2015-10-25 21:41:00', '888ajsd', '', 'alsjdlaskdj', 0, 0, '0', 'sdfsdf', 1, 1, 1, 1, 1, 1, 0, 23234, '2015-10-15 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(8, 1, 2, 6, 1, 1, '2015-10-25 22:26:00', 'dsfs', 'sd', 'sdf', 0, 0, '0', 'sdfsdf', 1, 0, 0, 0, 0, 0, 0, 23423, '2015-10-13 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(9, 1, 5, 9, 1, 1, '2015-10-25 22:55:00', 'kjh', 'kjh', 'kjh', 0, 0, '0', 'jhkhkjh', 1, 0, 0, 0, 0, 0, 0, 7987987, '2015-10-02 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(10, 1, 1, 1, 1, 1, '2015-10-25 00:49:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-02 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(11, 1, 1, 1, 1, 1, '2015-10-26 00:54:00', 'asd', 'asd', 'asda', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-01 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(12, 1, 1, 4, 1, 1, '2015-10-26 01:09:00', 'asd', 'asd', 'asd', 1, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-09 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(13, 1, 1, 1, 1, 1, '2015-10-26 12:26:00', 'aaaaaaa', 'sssss', 'ddddd', 0, 1, '0', 'asdasd', 1, 1, 1, 1, 1, 1, 0, 123123, '2015-10-03 00:00:00', '2015-11-01 00:00:00', '2015-11-23 00:00:00', '', '0000-00-00 00:00:00'),
(14, 1, 1, 3, 2, 1, '2015-10-26 12:29:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-14 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(15, 1, 1, 2, 2, 1, '2015-10-26 12:33:00', '123', 'asasd', 'ASDD', 0, 0, '0', 'asdasd', 1, 1, 1, 1, 1, 1, 0, 123123, '2015-09-30 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(16, 1, 1, 1, 1, 1, '2015-10-26 17:52:00', '123123', 'asdasd', 'asdasd', 0, 0, '0', 'asdasd', 1, 1, 1, 1, 1, 1, 0, 123123, '2015-10-09 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(17, 1, 1, 1, 1, 1, '2015-10-26 17:54:00', '1', '2', '3', 0, 0, '0', '1234', 1, 1, 1, 1, 1, 1, 0, 1111, '2015-10-01 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(18, 1, 1, 1, 1, 1, '2015-10-26 18:18:00', 'asd', 'asd', 'asd', 0, 0, '0', 'aasd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-09 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(19, 1, 1, 1, 1, 1, '2015-10-26 18:21:00', 'asdas', 'sd', 'asdas', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123123, '2015-10-08 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(20, 1, 1, 1, 1, 1, '2015-10-26 18:22:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-08 00:00:00', '2015-10-31 00:00:00', '2015-11-21 00:00:00', '', '0000-00-00 00:00:00'),
(21, 1, 1, 11, 1, 1, '2015-10-27 13:14:00', 'asdas', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123123, '2015-10-23 00:00:00', '2015-11-03 00:00:00', '2015-11-24 00:00:00', '', '0000-00-00 00:00:00'),
(22, 1, 1, 11, 1, 1, '2015-10-27 13:15:00', 'asdasd', 'asdadasd', 'asdasd', 0, 0, '0', 'asdasd', 1, 1, 1, 1, 1, 1, 0, 123123, '2015-10-01 00:00:00', '2015-11-03 00:00:00', '2015-11-24 00:00:00', '', '0000-00-00 00:00:00'),
(23, 1, 1, 12, 1, 1, '2015-10-27 15:46:00', '12312312', '33333', 'dassdf', 0, 0, '0', 'sdfsdfsdf', 1, 1, 0, 1, 0, 0, 0, 444444, '2015-10-16 00:00:00', '2015-11-03 00:00:00', '2015-11-24 00:00:00', '', '0000-00-00 00:00:00'),
(24, 1, 1, 1, 1, 1, '2015-10-28 12:20:00', 'asdasd', 'asdasd', 'asd', 0, 0, '0', 'asdasd', 1, 1, 1, 1, 1, 1, 0, 123123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(25, 1, 1, 1, 1, 1, '2015-10-28 12:52:00', '123', '123123', '123123', 0, 0, '0', '1231231', 1, 1, 1, 1, 1, 1, 0, 123123, '2015-10-01 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(26, 1, 1, 1, 1, 1, '2015-10-28 12:55:00', 'asda', 'dasd', 'adas', 0, 0, '0', 'wqdqwd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-16 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(27, 1, 1, 1, 1, 1, '2015-10-28 12:57:00', 'asd', 'asd', 'asd', 0, 0, '0', '12313', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-21 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(28, 1, 1, 1, 1, 1, '2015-10-28 12:57:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-22 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(29, 1, 1, 1, 1, 1, '2015-10-28 12:57:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-22 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(30, 1, 1, 1, 1, 1, '2015-10-28 12:57:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-22 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(31, 1, 1, 1, 1, 1, '2015-10-28 12:57:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-22 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(32, 1, 1, 1, 1, 1, '2015-10-28 12:57:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-22 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(33, 1, 1, 1, 1, 1, '2015-10-28 12:57:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-22 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(34, 1, 1, 1, 1, 1, '2015-10-28 12:57:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-22 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(35, 1, 1, 1, 1, 1, '2015-10-28 12:57:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-22 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(36, 1, 1, 1, 1, 1, '2015-10-28 13:14:00', 'asd', 'sd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-16 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(37, 1, 1, 1, 1, 1, '2015-10-28 13:15:00', 'asd', 'dasd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-16 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(38, 1, 1, 1, 1, 1, '2015-10-28 13:16:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-08 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(39, 1, 1, 1, 1, 1, '2015-10-28 13:18:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-08 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(40, 1, 1, 1, 1, 1, '2015-10-28 15:46:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-07 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(41, 1, 1, 1, 1, 1, '2015-10-28 15:47:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-14 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(42, 1, 1, 1, 1, 1, '2015-10-28 15:50:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 1234, '2015-10-14 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(43, 1, 1, 1, 1, 1, '2015-10-28 15:51:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-14 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(44, 1, 1, 1, 1, 1, '2015-10-28 15:51:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-14 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(45, 1, 1, 1, 1, 1, '2015-10-28 15:51:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-14 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(46, 1, 1, 1, 1, 1, '2015-10-28 15:51:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-14 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(47, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(48, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(49, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(50, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(51, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(52, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(53, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(54, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(55, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(56, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(57, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(58, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(59, 1, 1, 1, 1, 1, '2015-10-28 15:58:00', 'asdasd', 'as', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 123, '2015-10-15 00:00:00', '2015-11-04 00:00:00', '2015-11-25 00:00:00', '', '0000-00-00 00:00:00'),
(60, 1, 1, 12, 1, 1, '2015-11-04 10:24:00', '11111', '22222', '33333', 0, 0, '0', 'falla segun cliente', 1, 1, 1, 1, 1, 1, 0, 12345, '2015-10-28 00:00:00', '2015-11-11 00:00:00', '2015-12-02 00:00:00', '', '0000-00-00 00:00:00'),
(61, 1, 7, 1, 1, 1, '2015-11-04 10:27:00', 'asd', 'asd', 'asd', 0, 0, '0', 'asd', 1, 1, 1, 1, 1, 1, 0, 22222, '2015-10-29 00:00:00', '2015-11-11 00:00:00', '2015-12-02 00:00:00', 'obs final', '2015-11-04 15:14:54'),
(62, 1, 7, 12, 1, 1, '2015-11-04 11:38:00', '1234556', 'iphone 6', 'descripcion', 0, 0, '0', 'falla segun el cliente', 1, 0, 0, 0, 0, 0, 0, 1234, '2015-11-01 00:00:00', '2015-11-11 00:00:00', '2015-12-02 00:00:00', 'Observacion final', '2015-11-04 17:03:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_oc`
--

CREATE TABLE IF NOT EXISTS `detalle_oc` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_oc` int(11) NOT NULL,
  `cod_repuesto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des_repuesto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cant_repuesto` int(11) NOT NULL,
  `prec_repuesto` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `detalle_oc`
--

INSERT INTO `detalle_oc` (`id_detalle`, `id_oc`, `cod_repuesto`, `des_repuesto`, `cant_repuesto`, `prec_repuesto`) VALUES
(1, 4, 'COD1', 'REPUESTO 1', 2, 15000),
(2, 5, 'COD1', 'REPUESTO 1', 2, 15000),
(3, 6, 'COD1', 'REPUESTO 1', 2, 15000),
(4, 7, 'COD1', 'REPUESTO 1', 2, 15000),
(5, 8, 'COD1', 'REPUESTO 1', 2, 15000),
(6, 9, 'COD1', 'REPUESTO 1', 2, 15000),
(7, 10, 'COD1', 'REPUESTO 1', 2, 15000),
(8, 11, 'COD1', 'REPUESTO 1', 2, 15000),
(9, 12, 'COD1', 'REPUESTO 1', 2, 15000),
(10, 13, 'COD1', 'REPUESTO 1', 2, 15000),
(11, 14, 'COD1', 'REPUESTO 1', 2, 15000),
(12, 15, 'COD1', 'REPUESTO 1', 2, 15000),
(13, 16, 'COD1', 'REPUESTO 1', 2, 15000),
(14, 17, 'COD1', 'REPUESTO 1', 2, 15000),
(15, 18, 'COD1', 'REPUESTO 1', 2, 15000),
(16, 19, 'COD1', 'REPUESTO 1', 2, 15000),
(17, 20, 'COD1', 'REPUESTO 1', 2, 15000),
(18, 21, 'HH', 'HORA TRABAJO', 1, 10000),
(19, 22, 'HH', 'HORA TRABAJO', 1, 10000),
(20, 23, 'HH', 'HORA TRABAJO', 1, 10000),
(21, 24, 'HH', 'HORA TRABAJO', 1, 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE IF NOT EXISTS `diagnostico` (
  `id_diagnostico` int(11) NOT NULL AUTO_INCREMENT,
  `id_respuesta` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `otra_respuesta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aplica_garantia` tinyint(4) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_termino` datetime NOT NULL,
  `diagnostico_cliente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diagnostico_interno` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_gsx` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_diagnostico`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `diagnostico`
--

INSERT INTO `diagnostico` (`id_diagnostico`, `id_respuesta`, `id_contrato`, `otra_respuesta`, `aplica_garantia`, `fecha_inicio`, `fecha_termino`, `diagnostico_cliente`, `diagnostico_interno`, `num_gsx`) VALUES
(1, 1, 1, '', 1, '2015-11-02 16:43:00', '2015-11-30 00:00:00', 'diag. cliente', 'diag. interno', '99999'),
(2, 1, 2, '', 1, '2015-11-02 16:44:00', '2015-11-07 00:00:00', 'asd', 'asd', 'asd'),
(3, 1, 3, '', 1, '2015-11-02 17:42:00', '2015-11-07 00:00:00', 'asdasd', 'adssd', 'asdasdasd'),
(7, 1, 4, '', 1, '2015-11-02 17:49:00', '2015-11-07 00:00:00', 'asd', 'asd', 'asd'),
(8, 1, 7, '', 1, '2015-11-03 12:11:00', '2015-11-10 00:00:00', 'test diagnostico cliente', 'diagnostico interno', '123123'),
(9, 1, 8, '', 0, '2015-11-03 12:19:00', '2015-11-10 00:00:00', 'asdasd', 'asdasdasdasd', '123123123'),
(10, 2, 9, 'test otra respuesta', 0, '2015-11-03 18:02:00', '2015-11-25 00:00:00', 'Diagnostico visible para cliente', 'Diagnostico interno', ''),
(11, 1, 61, '', 0, '2015-11-04 10:29:00', '2015-11-11 00:00:00', 'diag. cli', 'diag. interno', ''),
(12, 2, 62, 'Otra respuesta', 1, '2015-11-04 11:55:00', '2015-11-11 00:00:00', 'Detalle diag. cliente', 'Detalle diag. interno.', 'gsx12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_contrato`
--

CREATE TABLE IF NOT EXISTS `estados_contrato` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `estados_contrato`
--

INSERT INTO `estados_contrato` (`id_estado`, `descripcion`) VALUES
(1, 'EN ESPERA DE DIAGNOSTICO'),
(2, 'EN ESPERA VB CLIENTE'),
(3, 'PRESUPUESTO ACEPTADO POR CLIENTE'),
(4, 'PRESUPUESTO RECHAZADO POR CLIENTE'),
(5, 'EN ESPERA DE REPUESTOS'),
(6, 'EN PROCESO DE REPARACION'),
(7, 'FINALIZADO'),
(8, 'RETIRADO POR CLIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_ppto`
--

CREATE TABLE IF NOT EXISTS `estados_ppto` (
  `id_estado_ppto` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id_estado_ppto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `estados_ppto`
--

INSERT INTO `estados_ppto` (`id_estado_ppto`, `descripcion`, `activo`) VALUES
(1, 'INGRESADO', 1),
(2, 'INFORMADO', 1),
(3, 'ACEPTADO POR CLIENTE', 1),
(4, 'RECHAZADO POR CLIENTE', 1),
(5, 'PAGADO', 1),
(6, 'EN ESPERA DE REPUESTOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE IF NOT EXISTS `familias` (
  `id_familia` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_familia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `familias`
--

INSERT INTO `familias` (`id_familia`, `descripcion`) VALUES
(1, 'Apple'),
(2, 'Terceros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feriados`
--

CREATE TABLE IF NOT EXISTS `feriados` (
  `id_feriado` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `activo` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_feriado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `feriados`
--

INSERT INTO `feriados` (`id_feriado`, `fecha`, `activo`) VALUES
(1, '2015-10-31', 1),
(2, '2015-11-01', 1),
(3, '2015-12-25', 1),
(4, '2016-01-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_contrato`
--

CREATE TABLE IF NOT EXISTS `imagenes_contrato` (
  `id_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `id_contrato` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etapa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_imagen`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `imagenes_contrato`
--

INSERT INTO `imagenes_contrato` (`id_imagen`, `id_contrato`, `nombre`, `ubicacion`, `etapa`) VALUES
(1, 1, '904ea4f8922034cd7abc8a3ae1d73770.jpg', 'C:/xampp/htdocs/sstt/uploads/1/diagnostico', 'diagnostico'),
(2, 1, '8cff1a114ca2f6c2811f3da269e1cbea.jpg', 'C:/xampp/htdocs/sstt/uploads/1/diagnostico', 'diagnostico'),
(3, 1, '6409d71da4345eb859c56f744a40cb85.jpg', 'E:/web/sstt/uploads/1/diagnostico', 'diagnostico'),
(4, 9, '84f440b9dc6dbad64798f1659e4988fe.jpg', 'E:/web/sstt/uploads/9/diagnostico', 'diagnostico'),
(5, 9, 'fb6c9dacd4214ba5e52e8aa627694045.jpg', 'E:/web/sstt/uploads/9/diagnostico', 'diagnostico'),
(6, 61, 'd389b7352a0a9f729420328799e4e1ee.jpg', 'C:/xampp/htdocs/sstt/uploads/61/recepcion', 'recepcion'),
(7, 61, '39ebf7882debd9e22530e9bebd9422d5.jpg', 'C:/xampp/htdocs/sstt/uploads/61/recepcion', 'recepcion'),
(8, 62, '2f7d95dd37e1b3e3c6c6c9fe0b07a7bc.jpg', 'C:/xampp/htdocs/sstt/uploads/62/recepcion', 'recepcion'),
(9, 62, '1eacf73628e40efe6d95d28a9d57e990.jpg', 'C:/xampp/htdocs/sstt/uploads/62/diagnostico', 'diagnostico'),
(10, 62, '381d7193584834eaf66cdb4c7020b9c8.jpg', 'C:/xampp/htdocs/sstt/uploads/62/diagnostico', 'diagnostico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE IF NOT EXISTS `orden_compra` (
  `id_oc` int(11) NOT NULL AUTO_INCREMENT,
  `id_presupuesto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_total` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id_oc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id_oc`, `id_presupuesto`, `id_usuario`, `fecha_creacion`, `observaciones`, `sub_total`, `iva`, `total`) VALUES
(3, 10, 1, '2015-11-04 04:05:19', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(4, 10, 1, '2015-11-04 04:07:39', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(5, 10, 1, '2015-11-04 04:08:19', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(6, 10, 1, '2015-11-04 04:09:28', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(7, 10, 1, '2015-11-04 04:10:02', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(8, 10, 1, '2015-11-04 04:11:08', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(9, 10, 1, '2015-11-04 04:12:17', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(10, 10, 1, '2015-11-04 04:23:47', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(11, 10, 1, '2015-11-04 04:24:49', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(12, 10, 1, '2015-11-04 04:31:32', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(13, 10, 1, '2015-11-04 04:34:07', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(14, 10, 1, '2015-11-04 04:35:54', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(15, 10, 1, '2015-11-04 04:39:34', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(16, 10, 1, '2015-11-04 04:42:25', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(17, 10, 1, '2015-11-04 04:43:48', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(18, 10, 1, '2015-11-04 04:45:26', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(19, 10, 1, '2015-11-04 04:54:32', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(20, 10, 1, '2015-11-04 06:05:59', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM9)', 25210, 4790, 30000),
(21, 11, 1, '2015-11-04 15:04:12', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM61)', 8403, 1597, 10000),
(22, 11, 1, '2015-11-04 15:10:46', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM61)', 8403, 1597, 10000),
(23, 11, 1, '2015-11-04 15:12:46', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM61)', 8403, 1597, 10000),
(24, 12, 1, '2015-11-04 16:38:06', 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM62)', 8403, 1597, 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE IF NOT EXISTS `parametros` (
  `id_parametro` int(11) NOT NULL AUTO_INCREMENT,
  `host_correo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_correo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass_correo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `puerto_correo` int(11) NOT NULL,
  `link_vb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_parametro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`id_parametro`, `host_correo`, `usuario_correo`, `pass_correo`, `puerto_correo`, `link_vb`) VALUES
(1, 'owa.reifschneider.cl', 'jdomazos', 'Domazos123A:?', 26, 'http://localhost/sstt/detalle_contrato.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto`
--

CREATE TABLE IF NOT EXISTS `presupuesto` (
  `id_presupuesto` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado_ppto` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `fecha_presupuesto` datetime NOT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_confirmacion` datetime NOT NULL,
  `sub_total` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `total_pagar` int(11) NOT NULL,
  `num_boleta` int(11) NOT NULL,
  `orden_compra` int(11) NOT NULL,
  PRIMARY KEY (`id_presupuesto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `presupuesto`
--

INSERT INTO `presupuesto` (`id_presupuesto`, `id_estado_ppto`, `id_contrato`, `fecha_presupuesto`, `observaciones`, `fecha_confirmacion`, `sub_total`, `iva`, `total`, `total_pagar`, `num_boleta`, `orden_compra`) VALUES
(1, 3, 1, '2015-11-02 16:43:00', 'obs. ppto', '0000-00-00 00:00:00', 134453, 25547, 160000, 160000, 0, 9),
(2, 1, 2, '2015-11-02 16:44:00', '', '0000-00-00 00:00:00', 420168, 79832, 500000, 500000, 0, 0),
(3, 1, 3, '2015-11-02 17:42:00', 'qweqwe', '0000-00-00 00:00:00', 12605, 2395, 15000, 15000, 0, 0),
(7, 1, 4, '2015-11-02 17:49:00', 'asd', '0000-00-00 00:00:00', 42016, 7984, 50000, 50000, 0, 0),
(8, 1, 7, '2015-11-03 12:11:00', 'observaciones del presupuesto para cliente', '0000-00-00 00:00:00', 12605, 2395, 15000, 0, 0, 0),
(9, 1, 8, '2015-11-03 12:19:00', '123123', '0000-00-00 00:00:00', 12605, 2395, 15000, 15000, 0, 0),
(10, 6, 9, '2015-11-03 18:02:00', 'Observaciones hechas al presupuesto', '0000-00-00 00:00:00', 25210, 4790, 30000, 30000, 55556666, 0),
(11, 6, 61, '2015-11-04 10:29:00', 'obs. ppto', '0000-00-00 00:00:00', 8403, 1597, 10000, 10000, 123, 23),
(12, 6, 62, '2015-11-04 11:55:00', 'obs ppto', '0000-00-00 00:00:00', 8403, 1597, 10000, 0, 0, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto_repuestos`
--

CREATE TABLE IF NOT EXISTS `presupuesto_repuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_presupuesto` int(11) NOT NULL,
  `id_repuesto` int(11) NOT NULL,
  `cod_repuesto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des_repuesto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cant_repuesto` int(11) NOT NULL,
  `precio_repuesto` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `presupuesto_repuestos`
--

INSERT INTO `presupuesto_repuestos` (`id`, `id_presupuesto`, `id_repuesto`, `cod_repuesto`, `des_repuesto`, `cant_repuesto`, `precio_repuesto`) VALUES
(1, 1, 1, 'COD1', 'REPUESTO 1', 1, 15000),
(2, 1, 2, 'COD2', 'REPUESTO 2', 2, 50000),
(3, 1, 1, 'COD1', 'REPUESTO 1', 3, 15000),
(4, 2, 2, 'COD2', 'REPUESTO 2', 10, 50000),
(5, 3, 1, 'COD1', 'REPUESTO 1', 1, 15000),
(6, 8, 1, 'COD1', 'REPUESTO 1', 1, 15000),
(7, 9, 1, 'COD1', 'REPUESTO 1', 1, 15000),
(8, 10, 1, 'COD1', 'REPUESTO 1', 2, 15000),
(9, 11, 3, 'HH', 'HORA TRABAJO', 1, 10000),
(10, 12, 3, 'HH', 'HORA TRABAJO', 1, 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE IF NOT EXISTS `regiones` (
  `id_region` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) CHARACTER SET latin1 DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`id_region`, `nombre`, `orden`, `activo`) VALUES
(1, 'I de Tarapacá', 1, 1),
(2, 'II de Antofagasta', 3, 1),
(3, 'III de Atacama', 4, 1),
(4, 'IV de Coquimbo', 5, 1),
(5, 'V de Valparaíso', 6, 1),
(6, 'VI del Libertador General B.O', 7, 1),
(7, 'VII del Maule', 8, 1),
(8, 'VIII del Biobío', 9, 1),
(9, 'IX de la Araucanía', 10, 1),
(10, 'X de los Lagos', 12, 1),
(11, 'XI Aysén', 13, 1),
(12, 'XII de Magallanes y Antártica', 14, 1),
(13, 'Metropolitana de Santiago', 15, 1),
(15, 'XV de Arica y Parinacota', 2, 1),
(16, 'XIV de los Ríos', 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos`
--

CREATE TABLE IF NOT EXISTS `repuestos` (
  `id_repuesto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_repuesto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_repuesto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id_repuesto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `repuestos`
--

INSERT INTO `repuestos` (`id_repuesto`, `codigo_repuesto`, `descripcion_repuesto`, `precio_venta`, `stock`) VALUES
(1, 'COD1', 'REPUESTO 1', 15000, 20),
(2, 'COD2', 'REPUESTO 2', 50000, 10),
(3, 'HH', 'HORA TRABAJO', 10000, 100000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_tipo`
--

CREATE TABLE IF NOT EXISTS `respuestas_tipo` (
  `id_respuesta` int(11) NOT NULL AUTO_INCREMENT,
  `respuesta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id_respuesta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `respuestas_tipo`
--

INSERT INTO `respuestas_tipo` (`id_respuesta`, `respuesta`, `activo`) VALUES
(1, 'SIN FALLA DETECTADA', 1),
(2, 'OTRA RESPUESTA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE IF NOT EXISTS `tiendas` (
  `id_tienda` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id_tienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`id_tienda`, `nombre`, `direccion`, `activo`) VALUES
(1, 'Casa Matriz', 'Conquistador del Monte 5024. Santiago', 1),
(2, 'Mall Parque Arauco', 'Presidente Kennedy 5413, Local 4012. Santiago', 1),
(3, 'Mall Alto Las Condes', 'Presidente Kennedy 9001, Local 2172. Santiago', 1),
(4, 'Mall Plaza Vespucio', 'Av Vicuna Mackenna 7110, Local MA-116. Santiago', 1),
(5, 'Mall Plaza Oeste', 'Av. Américo Vespucio 1501, Local D-106/D-110. Santiago', 1),
(6, 'Mall Portal Temuco', 'Av. Alemania 671, Local 3056. Temuco', 1),
(7, 'Mall Plaza La Serena', 'Alberto Solari Magnasco 1400, Local C-101. La Serena', 1),
(8, 'Mall Plaza Antofagasta', 'Balmaceda 2355, Local 216-218-220. Antofagasta', 1),
(9, 'Mall Portal Osorno', 'Yungay 609 local 3021, Local 3021. Osorno', 1),
(10, 'Tienda Puerto Montt', 'Illapel 10, Local EP03. Puerto Montt', 1),
(11, 'Mall Portal Rancagua', 'Presidente Eduardo Frei Montalva 750, Local 1064. Rancagua', 1),
(12, 'Paseo Ahumada', 'Ahumada 196. Santiago', 1),
(13, 'Mall Costanera Center', 'Andrés Bello 2447. Santiago', 1),
(14, 'Mall Florida Center', 'Av. Vicuña Mackena 6100, Local 3085. Santiago', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_clientes`
--

CREATE TABLE IF NOT EXISTS `tipos_clientes` (
  `id_tipo_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tipo_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipos_clientes`
--

INSERT INTO `tipos_clientes` (`id_tipo_cliente`, `descripcion`) VALUES
(1, 'Nacional'),
(2, 'Extranjero'),
(3, 'Tienda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_contrato`
--

CREATE TABLE IF NOT EXISTS `tipos_contrato` (
  `id_tipo_contrato` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tipo_contrato`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipos_contrato`
--

INSERT INTO `tipos_contrato` (`id_tipo_contrato`, `descripcion`) VALUES
(1, 'Garantía'),
(2, 'Reparación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuario`
--

CREATE TABLE IF NOT EXISTS `tipos_usuario` (
  `id_tipo_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`id_tipo_usuario`, `descripcion`) VALUES
(1, 'SUPERADMIN'),
(2, 'Administrador'),
(3, 'Técnico'),
(4, 'Recepción Tienda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_tipo_usuario` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_tipo_usuario`, `nombre`, `correo`, `telefono`, `usuario`, `pass`, `activo`) VALUES
(1, 1, 'Jorge Domazos', 'jdomazos@reif.cl', '226781220', 'administrator', 'c9cea2ec578bf30341bacd3c2b6a00f8', 1),
(4, 3, 'Juan Perez', 'jperez@reif.cl', '44444444', 'jperez', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(5, 3, 'Tecnico 1', 'jdomazos@reif.cl', '888888', 'tecnico1', 'e3f8b6833c621226b868a08fad661cc3', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
