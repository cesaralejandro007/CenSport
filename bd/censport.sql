-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2025 a las 18:50:27
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `censport`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `id_division` int(11) NOT NULL,
  `nombre_area` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_area`, `id_division`, `nombre_area`) VALUES
(1, 1, 'Informatica'),
(2, 1, 'Área de Recursos Humanos'),
(3, 1, 'Área de Bienes Nacionales'),
(4, 1, 'Despacho de la División de Administración'),
(5, 1, 'Área de Compras'),
(6, 1, 'Área de Almacén'),
(7, 1, 'Área de Presupuesto'),
(8, 1, 'Área de Contabilidad'),
(9, 1, 'Área de Tesorería'),
(10, 1, 'Coordinación de Infraestructura y Servicios'),
(11, 1, 'Área de Viáticos'),
(12, 2, 'Despacho de Gerencia'),
(13, 2, 'Resguardo'),
(14, 2, 'Seguridad'),
(15, 3, 'Despacho Asistencia al Contribuyente'),
(16, 3, 'Área de Prensa'),
(17, 4, 'Área De Cobranzas'),
(18, 4, 'Modulo de Inserción'),
(19, 4, 'Modulo Exoneración'),
(20, 4, 'Modulo de Remisión'),
(21, 4, 'Registro de Cta./Corriente'),
(22, 4, 'Despacho División de Recaudación'),
(23, 4, 'Modulo de Retenciones'),
(24, 4, 'Entes Públicos'),
(25, 4, 'Área de Sucesiones'),
(26, 4, 'Modulo Investigación Patrimonial'),
(27, 4, 'Área de Rif'),
(28, 4, 'Área de Licores'),
(29, 4, 'Liquidación'),
(30, 4, 'Reintegro y Devoluciones'),
(31, 4, 'Timbres Fiscales'),
(32, 5, 'Despacho Fiscalización'),
(33, 5, 'Fiscalización General'),
(34, 5, 'Avaluo'),
(35, 5, 'Selección Previa'),
(36, 5, 'Deberes Formales'),
(37, 5, 'Beneficios Fiscales'),
(38, 5, 'Fondo y Semi Fondo'),
(39, 5, 'Planificación y Control de Gestión'),
(40, 6, 'Despacho División de Sumario'),
(41, 6, 'Área de Sustanciación de Sumario'),
(42, 7, 'Área Cobro Judicial'),
(43, 7, 'Recursos Administrativo y Jurídico'),
(44, 7, 'Despacho de la División'),
(45, 7, 'Contencioso Tributario'),
(46, 7, 'Sustanciación'),
(47, 8, 'Área de Notificación'),
(48, 8, 'Área de Vivienda Principal'),
(49, 8, 'Área de Archivo General'),
(50, 8, 'Área de Correspondencia'),
(51, 8, 'Despacho de la División'),
(52, 9, 'Área Control de Obligación'),
(53, 9, 'Cobranza'),
(54, 9, 'Área Control Bancario'),
(55, 9, 'Asistencia al Contribuyente'),
(56, 9, 'Despacho de la División'),
(57, 9, 'Modulo de Correcciones y Análisis de Cuentas'),
(58, 9, 'Contribuyentes Especiales Punto Fijo'),
(59, 11, 'Jubilado'),
(60, 12, 'CARORA'),
(61, 10, 'San Felipe'),
(62, 14, 'El Tocuyo'),
(63, 13, 'Guanare'),
(64, 18, 'Acarigua'),
(65, 15, 'Chivacoa'),
(66, 16, 'Nirgua'),
(67, 19, 'Quibor'),
(68, 12, 'Carora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `censo`
--

CREATE TABLE `censo` (
  `id_censo` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_final` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `censo`
--

INSERT INTO `censo` (`id_censo`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_final`, `id_usuario`) VALUES
(1, 'CENSO DEPORTIVO', 'CENSO DEPORTIVO 2025', '2025-02-19 09:00:00', '2025-03-20 16:00:00', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes`
--

CREATE TABLE `deportes` (
  `id_deporte` int(11) NOT NULL,
  `nombre_deporte` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `deportes`
--

INSERT INTO `deportes` (`id_deporte`, `nombre_deporte`) VALUES
(22, 'Aerofitness Masculino'),
(23, 'Aerofitness Femenino'),
(24, 'Bolas Criollas Masculino'),
(25, 'Bolas Criollas Femenino'),
(26, 'Voleibol Cancha Masculino'),
(27, 'Voleibol Cancha Femenino'),
(28, 'Voleibol Playa Femenino'),
(29, 'Voleibol Playa Masculino'),
(30, 'Softboll Masculino'),
(31, 'Softboll Femenino'),
(32, 'Baloncesto Masculino'),
(33, 'Kickingboll Femenino'),
(34, 'Domino Masculino'),
(35, 'Domino Femenino'),
(36, 'Tenis De Mesa Masculino'),
(37, 'Tenis De Mesa Femenino'),
(38, 'Natación Masculino'),
(39, 'Natación Femenino'),
(40, 'Maratón Masculino'),
(41, 'Maratón Femenino'),
(42, 'Artes Marciales Masculino'),
(43, 'Artes Marciales Femenino'),
(44, 'Fútbol Campo Masculino'),
(45, 'Fútbol Sala Masculino'),
(46, 'Ajedrez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diciplina_persona`
--

CREATE TABLE `diciplina_persona` (
  `id_diciplina_persona` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_deporte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `diciplina_persona`
--

INSERT INTO `diciplina_persona` (`id_diciplina_persona`, `id_persona`, `id_deporte`) VALUES
(29, 169, 25),
(30, 169, 33),
(31, 170, 26),
(32, 170, 36),
(33, 171, 32),
(34, 171, 34),
(35, 172, 23),
(36, 173, 23),
(37, 174, 24),
(38, 174, 40),
(39, 175, 23),
(40, 175, 33),
(41, 176, 23),
(42, 177, 31),
(43, 177, 43),
(44, 178, 23),
(45, 178, 31),
(46, 179, 23),
(47, 180, 23),
(48, 181, 23),
(49, 182, 23),
(50, 183, 23),
(51, 184, 31),
(52, 184, 33),
(53, 185, 24),
(54, 186, 30),
(55, 187, 31),
(56, 187, 33),
(57, 188, 23),
(58, 189, 23),
(59, 190, 23),
(60, 191, 23),
(61, 192, 30),
(62, 192, 44),
(63, 193, 30),
(64, 193, 32),
(65, 194, 30),
(66, 195, 23),
(67, 195, 35),
(68, 196, 34),
(69, 197, 23),
(70, 198, 45),
(71, 198, 30),
(72, 199, 30),
(73, 199, 44),
(74, 200, 30),
(75, 200, 26),
(76, 201, 32),
(77, 201, 36),
(78, 202, 25),
(79, 202, 23),
(80, 203, 30),
(81, 204, 31),
(82, 204, 33),
(83, 205, 44),
(84, 206, 23),
(85, 207, 23),
(86, 207, 41),
(87, 208, 23),
(88, 209, 28),
(89, 209, 37),
(90, 210, 36),
(91, 211, 35),
(92, 212, 35),
(93, 213, 30),
(94, 214, 35),
(95, 215, 23),
(96, 216, 30),
(97, 217, 30),
(98, 217, 32),
(100, 219, 30),
(101, 220, 35),
(102, 220, 23),
(103, 221, 44),
(104, 221, 30),
(105, 222, 44),
(106, 222, 30),
(107, 223, 32),
(108, 224, 23),
(109, 224, 25),
(110, 225, 23),
(111, 225, 43),
(112, 226, 30),
(113, 227, 34),
(114, 227, 24),
(115, 228, 34),
(116, 228, 42),
(117, 229, 25),
(118, 230, 23),
(119, 230, 31),
(120, 231, 31),
(121, 231, 25),
(122, 232, 24),
(123, 233, 22),
(124, 233, 24),
(125, 234, 30),
(126, 234, 44),
(127, 235, 44),
(128, 235, 45),
(129, 236, 23),
(130, 236, 39),
(131, 237, 30),
(132, 237, 32),
(133, 238, 44),
(134, 238, 45),
(135, 239, 45),
(136, 239, 44),
(137, 240, 23),
(138, 240, 31),
(139, 241, 23),
(140, 241, 25),
(141, 242, 23),
(142, 243, 24),
(143, 243, 30),
(144, 244, 23),
(145, 244, 41),
(146, 245, 45),
(147, 245, 44),
(148, 246, 26),
(149, 246, 29),
(150, 247, 33),
(151, 248, 24),
(152, 249, 25),
(153, 249, 27),
(154, 250, 30),
(155, 251, 29),
(156, 251, 26),
(157, 252, 28),
(158, 253, 30),
(159, 253, 24),
(160, 254, 24),
(161, 255, 27),
(162, 255, 28),
(163, 256, 31),
(164, 257, 25),
(165, 258, 26),
(166, 258, 30),
(167, 259, 26),
(168, 259, 45),
(169, 260, 26),
(170, 261, 31),
(171, 262, 23),
(172, 263, 34),
(173, 263, 40),
(174, 264, 26),
(175, 264, 45),
(176, 265, 25),
(177, 265, 31),
(178, 266, 45),
(179, 266, 44),
(180, 267, 42),
(181, 268, 22),
(182, 268, 38),
(183, 269, 23),
(184, 270, 36),
(185, 271, 27),
(186, 271, 23),
(187, 272, 27),
(188, 272, 23),
(189, 273, 25),
(190, 274, 23),
(191, 274, 28),
(192, 275, 26),
(193, 275, 45),
(194, 276, 31),
(195, 276, 33),
(196, 277, 31),
(197, 277, 27),
(198, 278, 45),
(199, 278, 44),
(200, 279, 32),
(201, 280, 44),
(202, 280, 45),
(203, 281, 30),
(204, 282, 25),
(205, 283, 25),
(206, 284, 36),
(207, 284, 32),
(208, 218, 30),
(209, 218, 34),
(210, 285, 25),
(211, 285, 33),
(212, 286, 25),
(213, 286, 27),
(214, 287, 25),
(215, 287, 27),
(216, 288, 27),
(217, 288, 25),
(218, 289, 35),
(219, 290, 33),
(220, 291, 23),
(221, 292, 44),
(222, 292, 26),
(223, 293, 23),
(224, 294, 23),
(225, 295, 39),
(226, 296, 23),
(227, 297, 40),
(228, 298, 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisiones`
--

CREATE TABLE `divisiones` (
  `id_division` int(11) NOT NULL,
  `nombre_division` text NOT NULL,
  `descripcion_division` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `divisiones`
--

INSERT INTO `divisiones` (`id_division`, `nombre_division`, `descripcion_division`) VALUES
(1, 'Administracion', 'ADM'),
(2, 'Gerencia Regional de Tributos Internos', 'GTI'),
(3, 'División Asistencia al Contribuyente', 'AC'),
(4, 'División de Recaudación', 'RE'),
(5, 'División de Fiscalizacíon', 'FI'),
(6, 'División de Sumario Administrativo', 'SA'),
(7, 'División de Jurídico Tributario ', 'JT'),
(8, 'División de Tramitaciones', 'TR'),
(9, 'División de Contribuyentes Especiales', 'CE'),
(10, 'SECTOR SAN FELIPE', 'SF'),
(11, 'JUBILADO', 'J'),
(12, 'SECTOR CARORA', 'SCA'),
(13, 'UTI GUANARE', 'UG'),
(14, 'UTI EL TOCUYO', 'SQ'),
(15, 'UTI CHIVACOA', 'UC'),
(16, 'UTI NIRGUA', 'UN'),
(17, 'SECTOR CABUDARE', 'SC'),
(18, 'SECTOR ACARIGUA', 'SA'),
(19, 'SECTOR QUIBOR', 'SQ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_deportivos`
--

CREATE TABLE `grupos_deportivos` (
  `id_grupo_deportivo` int(11) NOT NULL,
  `nombre_grupo` text NOT NULL,
  `descripcion_grupo` text NOT NULL,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `cedula` varchar(11) NOT NULL,
  `nombres` varchar(25) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `sexo` varchar(9) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `id_area`, `cedula`, `nombres`, `apellidos`, `sexo`, `telefono`, `fecha_nacimiento`, `fecha_ingreso`) VALUES
(169, 56, '22323754', 'Yoselin Karina', 'Rosendo Colombo', 'Femenino', '0426-3580924', '1992-08-23', '2022-09-07'),
(170, 13, '13856630', 'Jimmy Alexander', 'Puentes Paez', 'Masculino', '0414-1050022', '1978-06-27', '2016-04-15'),
(171, 43, '16001594', 'Ricardo Ramon', 'Querales Martinez', 'Masculino', '0424-5032212', '1981-06-08', '2024-02-20'),
(172, 13, '9235934', 'Yesenia Coromoto', 'Angulo Loreto', 'Femenino', '0426-5538526', '1967-03-07', '2002-07-05'),
(173, 53, '16386453', 'Malbia Alimar', 'Alvarez Colina', 'Femenino', '0424-5175693', '1982-06-16', '2017-06-05'),
(174, 59, '9557997', 'Freddy Humberto', 'Alvarado Hernandez', 'Masculino', '0424-5189047', '1967-09-11', '1995-01-01'),
(175, 30, '22330887', 'Edimar Dayan', 'Rivero Perozo', 'Femenino', '0412-5026884', '1992-09-27', '2022-03-28'),
(176, 59, '7401742', 'Aleida Yulitza', 'Escalona Romero', 'Femenino', '0426-3521724', '1967-10-25', '1995-06-14'),
(177, 1, '27193453', 'Maria José', 'Zapata Virguez', 'Femenino', '0416-0505109', '2000-05-15', '2022-02-07'),
(178, 1, '25814777', 'Miriannys', 'Pérez Almao', 'Femenino', '0424-5349000', '1996-12-01', '2022-06-20'),
(179, 47, '11263758', 'Janeth Tebaida', 'Torrealba Guedez', 'Femenino', '0424-5545732', '1972-09-22', '2005-05-25'),
(180, 47, '10554152', 'Yaizdeh', 'Carvajal Lopez', 'Femenino', '0414-8566522', '1973-07-12', '2007-10-15'),
(181, 47, '13990042', 'Monica Isabel', 'Soto Colmenarez', 'Femenino', '0416-6410096', '1978-11-24', '2006-05-05'),
(182, 47, '11881771', 'Yaneidy Coromoto', 'Dorante Crespo', 'Femenino', '0414-5280358', '1972-04-19', '1995-06-16'),
(183, 10, '7400513', 'Nancy Marlene', 'Rivas', 'Femenino', '0414-5103610', '1964-08-08', '2023-01-24'),
(184, 28, '25139756', 'Lithuania Gloria', 'Ramirez Alvarado', 'Femenino', '0424-3392796', '1996-10-05', '2022-03-28'),
(185, 17, '16533044', 'Luis Felipe', 'Mendoza Cañizales', 'Masculino', '0414-5298599', '1982-05-30', '2022-01-17'),
(186, 53, '16402817', 'Yohn Frank', 'Lopez Alvarado', 'Masculino', '0424-3359768', '1984-06-11', '2022-03-28'),
(187, 12, '28055963', 'Sophia Jairith', 'Estrada Hernandez', 'Femenino', '0412-5202930', '2001-11-07', '2022-10-25'),
(188, 45, '15350167', 'Nurith Josefina', 'Pastran Mejias', 'Femenino', '0412-5691837', '1979-10-03', '2021-11-15'),
(189, 45, '12432165', 'Tania', 'Ramirez Duran', 'Femenino', '0424-5591496', '1974-09-16', '2018-05-31'),
(190, 43, '1481699', 'Mayrelis', 'Mejias Perez', 'Femenino', '0412-5242041', '1981-07-24', '2022-03-28'),
(191, 45, '25571565', 'Irene', 'Montero Almao', 'Femenino', '0412-5041190', '1994-02-17', '2023-09-18'),
(192, 1, '12026715', 'Jorge Enrique', 'Nieto Virguez', 'Masculino', '0416-6506540', '1975-05-14', '2022-03-28'),
(193, 1, '11186559', 'Diogenes Guzman', 'Rivas Delgado', 'Masculino', '0412-5179380', '1971-11-14', '2019-11-08'),
(194, 59, '7374680', 'Yovanny Enrique', 'Aguirre Peroza', 'Masculino', '0416-1578855', '1964-07-02', '1983-05-05'),
(195, 6, '14512763', 'Ana Cecilia', 'Mendoza Alvarado', 'Femenino', '0426-2315917', '1976-11-02', '2018-10-18'),
(196, 15, '7438707', 'Dennys Enrique', 'Perez Rosales', 'Masculino', '0414-3514973', '1969-09-04', '1996-05-16'),
(197, 15, '7435263', 'Emely Josefina', 'Mendez Rodriguez', 'Femenino', '0426-5524265', '1968-12-20', '2007-10-15'),
(198, 1, '28055655', 'Cesar Alejandro', 'Vides Gonzalez', 'Masculino', '0412-0318406', '2001-03-27', '2022-07-02'),
(199, 38, '1679518', 'Jesus Alberto', 'Crespo Martinez', 'Masculino', '0412-7837621', '1981-12-02', '2020-05-21'),
(200, 59, '7331129', 'Rafael Segundo', 'Mendoza Rodriguez', 'Masculino', '0414-9503259', '1961-08-28', '2010-08-01'),
(201, 1, '13267843', 'Emiro José', 'González Alvarado', 'Masculino', '0424-5483593', '1976-09-28', '2023-09-18'),
(202, 10, '16532255', 'Odalis Teresa', 'Mercado', 'Femenino', '0414-5156490', '1982-09-15', '2019-05-29'),
(203, 29, '21726823', 'Amilcar Jesus', 'Melendez Pinto', 'Masculino', '0424-5828250', '1993-08-30', '2022-09-07'),
(204, 38, '20921963', 'Andrea Karina', 'Camargo Nieto', 'Femenino', '0412-5172181', '1992-05-18', '2022-10-25'),
(205, 12, '12434150', 'Eduardo Josue', 'Aranguren Figueredo', 'Masculino', '0414-3524263', '1976-02-17', '2015-04-30'),
(206, 15, '18872469', 'Yerika Adais', 'Escalona Vasquez', 'Femenino', '0412-1514084', '1987-08-02', '2018-10-15'),
(207, 39, '10847973', 'Sonia', 'Dejesus Rodriguez', 'Femenino', '0412-3135101', '1973-04-21', '1995-03-16'),
(208, 38, '13189462', 'Beatriz', 'Camacaro', 'Femenino', '0416-4514467', '1977-02-27', '2022-05-07'),
(209, 53, '16387961', 'Betzay Pastora', 'Franco Oquendo', 'Femenino', '0412-1566961', '1984-08-21', '2022-09-07'),
(210, 1, '18261828', 'Orangel Jesus', 'Rivero Guaido', 'Masculino', '0426-5532512', '1986-09-10', '2022-10-25'),
(211, 53, '15228656', 'Soilin Karisber', 'Barrios Lopez', 'Femenino', '0426-5507468', '1980-10-23', '2022-01-17'),
(212, 53, '14269248', 'Ada Carolina', 'Bueno Ojeda', 'Femenino', '0416-7715759', '1977-05-22', '2018-10-15'),
(213, 10, '17229374', 'Gumersindo Jose', 'Gonzalez Chirinos', 'Masculino', '0416-5734810', '1981-04-07', '2019-05-29'),
(214, 53, '15229628', 'Yennifer Pilar', 'Caruci Jimenez', 'Femenino', '0426-2562704', '0982-07-17', '2018-10-15'),
(215, 33, '16530029', 'Maira Eloisa', 'Hernandez Apostol', 'Femenino', '0426-6548546', '1983-06-11', '2023-09-18'),
(216, 39, '15885331', 'Carlos Alberto', 'Caruci Martinez', 'Masculino', '0416-0838996', '1981-02-04', '2023-09-18'),
(217, 50, '9559566', 'Jonny Alberto', 'Yanez Mendoza', 'Masculino', '0426-5519465', '1966-04-11', '2019-05-29'),
(218, 10, '14426989', 'Orlando Rafael', 'Acosta Torres', 'Masculino', '0416-6260917', '1979-08-26', '2018-05-31'),
(219, 10, '20671976', 'Johander Jose', 'Mendoza Alvarado', 'Masculino', '0424-5726125', '1993-07-01', '2024-08-11'),
(220, 27, '14750740', 'Yelitza Coromoto', 'Romero Mendoza', 'Femenino', '0424-5773326', '1980-08-11', '2018-05-30'),
(221, 15, '13408040', 'Pastor Antonio', 'Hernandez Colina', 'Masculino', '0412-0528244', '1977-05-20', '2014-05-08'),
(222, 62, '12242776', 'Jose', 'Hernandez Colina', 'Masculino', '0416-6566216', '1974-08-12', '2007-09-03'),
(223, 3, '27210238', 'German Jose', 'Sibrian Rodriguez', 'Masculino', '0414-5031964', '1999-07-27', '2024-02-20'),
(224, 27, '25526355', 'Briyit Coraima', 'Perez Perez', 'Femenino', '0424-5875739', '1996-04-22', '2020-05-22'),
(225, 2, '31271467', 'Yeilu Getsemany', 'Barradas Oropeza', 'Femenino', '0424-5991379', '2006-04-28', '2024-09-17'),
(226, 15, '9624284', 'Jose Silva', 'Amaro', 'Masculino', '0414-5035343', '1968-01-08', '2022-02-15'),
(227, 50, '7412698', 'Jose Cirsanto', 'Salas Macute', 'Masculino', '0412-1568735', '1968-08-27', '2022-03-28'),
(228, 10, '16748634', 'Dervin Ruben', 'Monsave Torrealba', 'Masculino', '0424-5643351', '1980-05-16', '2023-01-23'),
(229, 16, '20924729', 'Anabel Patricia', 'Mujica Castellanos', 'Femenino', '0414-3579774', '1991-12-15', '2024-11-06'),
(230, 10, '23836077', 'Carla Andreina', 'Rodriguez Gutierrez', 'Femenino', '0412-4490929', '1990-07-07', '2023-09-18'),
(231, 59, '7385038', 'Raquel Graciela', 'Sira Alvarez', 'Femenino', '0424-5253739', '1965-03-04', '1982-11-01'),
(232, 15, '9887157', 'Eduardo Enrique', 'Santana Chavez', 'Masculino', '0426-3563617', '1968-06-08', '1997-12-01'),
(233, 22, '27816240', 'Luis Alberto', 'Gonzalez Diaz', 'Masculino', '0426-2333036', '1999-07-26', '2020-05-21'),
(234, 17, '12434017', 'Osmer Alfredo', 'Diaz Suarez', 'Masculino', '0414-5028177', '1976-01-17', '2018-09-28'),
(235, 43, '13239724', 'Wilfredo Ramon', 'Ramos Campos', 'Masculino', '0426-2311567', '1973-07-15', '2022-03-28'),
(236, 27, '11598902', 'Celina Katerinne', 'Escobar Perez', 'Femenino', '0426-6590785', '1974-05-13', '2021-05-07'),
(237, 12, '14750744', 'Wilder Pastor', 'Alvarez Frias', 'Masculino', '0414-5006248', '1980-11-23', '2023-09-18'),
(238, 43, '17782872', 'Ali Sandino', 'Martinez Fernandez', 'Masculino', '0412-6502565', '1986-01-31', '2022-06-20'),
(239, 14, '21126634', 'Cesar Octavio', 'Nieto Rivero', 'Masculino', '0426-2607336', '1993-03-24', '2022-02-22'),
(240, 29, '27882629', 'Miryelis Anais', 'Garcia Leal', 'Femenino', '0412-5181884', '2000-02-03', '2018-10-15'),
(241, 36, '15886895', 'Aracelys Jeusmar', 'Salas Betancourt', 'Femenino', '0424-5349058', '1882-12-03', '2007-09-03'),
(242, 21, '16898625', 'Reimary Carolina', 'Delgado', 'Femenino', '0414-5651837', '1984-09-04', '2017-06-05'),
(243, 29, '20920371', 'Enderson Jose', 'Torres Santeliz', 'Masculino', '0424-5326137', '1991-12-06', '2022-09-07'),
(244, 49, '10373265', 'Johamile Xiomaxi', 'Gonzales Vasquez', 'Femenino', '0412-0254959', '1970-04-23', '2008-03-12'),
(245, 3, '30529264', 'Jesus Esteban', 'Yanez Rivero', 'Masculino', '0424-5011208', '2004-01-07', '2022-09-07'),
(246, 58, '28406419', 'Jose Angel', 'Gonzalez Torres', 'Masculino', '0412-5469424', '2001-11-13', '2021-05-07'),
(247, 53, '16278022', 'Ingris', 'Jiménez Vera', 'Femenino', '0426-5527496', '1983-09-23', '2022-09-07'),
(248, 47, '7905207', 'Enrique Alfredo', 'Regalado Rarin', 'Masculino', '0416-9554977', '1964-10-16', '2001-02-04'),
(249, 43, '17727034', 'Daisly', 'Jimenez', 'Femenino', '0414-5082065', '1987-03-25', '2024-11-04'),
(250, 33, '7399532', 'Ivan Pastor', 'Soteldo', 'Masculino', '0424-5820166', '1967-01-26', '1997-12-01'),
(251, 55, '12849233', 'Jose Benito', 'Freites', 'Masculino', '0424-5136026', '1976-03-30', '2000-07-01'),
(252, 32, '17380697', 'Yubisay Zulimar', 'Torrealba Chirinos', 'Femenino', '0412-5207238', '1985-08-29', '2018-05-31'),
(253, 38, '18334389', 'Rafael Alberto', 'Parra Martin', 'Masculino', '0412-5165657', '1985-09-12', '2008-05-30'),
(254, 33, '11077542', 'Mariano', 'Colina Rojas', 'Masculino', '0412-9787737', '0001-10-23', '2018-09-28'),
(255, 29, '20349148', 'Karla Didiana', 'Diaz Mosquera', 'Femenino', '0412-4101666', '1990-03-05', '2019-05-29'),
(256, 29, '18861666', 'Yennifer Carmen', 'Barrios Terán', 'Femenino', '0414-5362332', '1985-08-25', '2019-05-29'),
(257, 59, '4342229', 'Maria', 'Camacho Delobos', 'Femenino', '0414-5186607', '1956-03-28', '1995-01-01'),
(258, 10, '16642923', 'Gerardo Alfonso', 'Catari Lafe', 'Masculino', '0424-5097909', '1985-07-28', '2023-01-24'),
(259, 67, '26487838', 'Jose Gregorio', 'Rodriguez Escalona', 'Masculino', '0412-5125062', '1998-10-08', '2024-11-01'),
(260, 67, '19850270', 'Yaim Feliet', 'Goyo Blanco', 'Masculino', '0412-5368312', '1992-04-06', '2020-04-27'),
(261, 14, '21141048', 'Carsolys Nohemy', 'Rivero Suarez', 'Femenino', '0412-0768605', '1990-09-18', '2023-10-19'),
(262, 59, '9486269', 'Lourdes', 'Sandoval González', 'Femenino', '0414-5092852', '1969-02-17', '1996-05-15'),
(263, 59, '11883731', 'Jose Nectali', 'Liscano Mercado', 'Masculino', '0412-9346406', '1969-06-05', '1989-02-17'),
(264, 67, '20046537', 'Eben Daniezer', 'Liscano Jiménez', 'Masculino', '0412-7721296', '1992-03-25', '2022-02-18'),
(265, 59, '7393253', 'Lisbeth Malila', 'Amaro', 'Femenino', '0416-6551460', '1962-05-23', '1986-05-16'),
(266, 13, '30528725', 'Brayan Enrique', 'Gonzalez Cordero', 'Masculino', '0424-5314046', '2003-08-12', '2022-09-19'),
(267, 13, '31143243', 'Josue Daniel', 'Ramirez Hernandez', 'Masculino', '0416-2770128', '2004-12-12', '2023-04-16'),
(268, 13, '22188325', 'Yair Jose', 'Guedez Marquez', 'Masculino', '0424-2244187', '1994-01-26', '2023-09-12'),
(269, 54, '7396471', 'Enma Belen', 'Torrelles Garcia', 'Femenino', '0416-1267795', '1967-11-24', '2020-05-20'),
(270, 43, '11457208', 'Jose Gregorio', 'Alaña', 'Masculino', '0426-3579842', '1972-05-06', '2010-02-18'),
(271, 47, '13652325', 'Marlin Yulimar', 'Torrealba Lobaton', 'Femenino', '0416-6560855', '1978-11-11', '2005-05-25'),
(272, 33, '13651822', 'Carenys Maria', 'Lucena Navea', 'Femenino', '0412-3036368', '1978-09-24', '2018-10-15'),
(273, 15, '7355150', 'Luz María', 'Angulo Hernandez', 'Femenino', '0424-5838901', '1961-10-21', '2020-05-21'),
(274, 10, '24418745', 'Odilia Gabriela', 'Camacaro Mora', 'Femenino', '0412-5856795', '1996-06-03', '2019-11-07'),
(275, 65, '21046967', 'Edsneyder Enrique', 'Mendez Noguera', 'Masculino', '0412-0541852', '1993-03-10', '2022-09-08'),
(276, 59, '7430128', 'Lulu Pastora', 'Gimenez Colmenarez', 'Femenino', '0414-5093420', '1967-05-29', '1985-11-16'),
(277, 33, '18950415', 'Hermelin Carolina', 'Paez Colmenarez', 'Femenino', '0416-6514588', '1989-11-09', '2018-05-31'),
(278, 27, '19323985', 'Jhonger Leonardo', 'Gonzalez Barrios', 'Masculino', '0424-6159881', '1988-11-18', '2022-02-07'),
(279, 14, '18131984', 'Franklin Antonio', 'Romero Mejias', 'Masculino', '0414-0478999', '1988-02-10', '2024-05-24'),
(280, 65, '22313643', 'Jonathan Josuee', 'Perez Castillo', 'Masculino', '0412-5217246', '1993-10-15', '2024-05-24'),
(281, 10, '9545093', 'Oscar Enrique', 'Castro Gimenez', 'Masculino', '0414-6385793', '1964-05-19', '2018-01-18'),
(282, 65, '8516302', 'Iris Elena', 'Hernandez Carrasco', 'Femenino', '0414-5360143', '1970-01-15', '2022-03-25'),
(283, 65, '12936034', 'Zulay Maria', 'Mendoza Peralta', 'Femenino', '0416-1542797', '1975-08-27', '2007-10-22'),
(284, 51, '13036645', 'Pedro Luis', 'Cortez', 'Masculino', '0416-0551401', '1978-02-04', '2018-10-15'),
(285, 65, '17320735', 'Agnedy Cecilia', 'Leon Quiñonez', 'Femenino', '0412-2604512', '1985-04-11', '2018-05-31'),
(286, 65, '15597381', 'Joxi Jaqueline', 'Atacho Alvarez', 'Femenino', '0414-5568665', '1981-09-27', '2022-05-15'),
(287, 65, '17813126', 'Maria Victoria', 'Osorio Ascanio', 'Femenino', '0412-3404292', '1987-04-28', '2025-01-30'),
(288, 65, '17992708', 'Diana Carolina', 'Mendoza Goyo', 'Femenino', '0412-5623743', '1985-12-16', '2018-09-15'),
(289, 65, '13502879', 'Yesenia Emilia', 'Leon Matinez', 'Femenino', '0412-8553451', '1977-11-17', '2020-05-20'),
(290, 29, '16957744', 'Yurby Karelis', 'Gonzalez Torres', 'Femenino', '0424-5462987', '1982-01-21', '2018-05-31'),
(291, 54, '14607864', 'Shirley Josefina', 'Pimentel Romero', 'Femenino', '0426-8545826', '1980-06-26', '2018-10-15'),
(292, 65, '21341147', 'Omar', 'Rodriguez', 'Masculino', '0412-7599926', '1989-05-15', '2022-03-25'),
(293, 56, '20890664', 'Eukarys Mariuska', 'Araujo Mariuska', 'Femenino', '0426-2589733', '1993-12-22', '2018-05-31'),
(294, 52, '7434963', 'Yolimar Carmen', 'Medina Rivero', 'Femenino', '0426-5579817', '1970-06-08', '1996-05-16'),
(295, 2, '16642061', 'Maria Josefa', 'Chavez Colmenarez', 'Femenino', '0424-5192531', '1984-12-04', '2021-05-07'),
(296, 25, '16748633', 'Magbis Esther', 'Monsalve', 'Femenino', '0412-0989230', '1985-01-17', '2023-09-18'),
(297, 43, '25571612', 'Oscar Enrique', 'Castro Colmenarez', 'Masculino', '0416-2559583', '1997-08-11', '2018-10-15'),
(298, 59, '4073230', 'Belkys Yuraima', 'Medina', 'Femenino', '0426-7576351', '1955-04-27', '1975-09-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_grupos`
--

CREATE TABLE `personas_grupos` (
  `id_persona_grupo` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_deporte` int(11) NOT NULL,
  `id_grupo_deportivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cedula` text NOT NULL,
  `nombres` text NOT NULL,
  `apellidos` text NOT NULL,
  `cargo` text NOT NULL,
  `contrasenna` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cedula`, `nombres`, `apellidos`, `cargo`, `contrasenna`) VALUES
(8, '9559758', 'Rafael', 'Vargas', 'Administrador', '$2y$10$cRHL3h37UUDcigSg98ssy.KWXUNd/uIAtwg7uFQ2q5MfmLHAgb7EK'),
(9, '17874264', 'Heclizeth', 'Jimenez', 'Administrador', '$2y$10$Xot9L0b7SeonWKG31B0gX.4zkBxQsKfmy8n.u2cjydm4MS.VpYKPe'),
(10, '28055655', 'Cesar Alejandro', 'Vides Gonzalez', 'Administrador', '$2y$10$eDHAxKArxfyoto9/xYxeQu.vk1Je3MxfOQg2YHkHBib6skPlr84sy');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`),
  ADD KEY `id_division` (`id_division`);

--
-- Indices de la tabla `censo`
--
ALTER TABLE `censo`
  ADD PRIMARY KEY (`id_censo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD PRIMARY KEY (`id_deporte`);

--
-- Indices de la tabla `diciplina_persona`
--
ALTER TABLE `diciplina_persona`
  ADD PRIMARY KEY (`id_diciplina_persona`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_deporte` (`id_deporte`);

--
-- Indices de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  ADD PRIMARY KEY (`id_division`);

--
-- Indices de la tabla `grupos_deportivos`
--
ALTER TABLE `grupos_deportivos`
  ADD PRIMARY KEY (`id_grupo_deportivo`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `id_area` (`id_area`);

--
-- Indices de la tabla `personas_grupos`
--
ALTER TABLE `personas_grupos`
  ADD PRIMARY KEY (`id_persona_grupo`),
  ADD KEY `id_deporte` (`id_deporte`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_grupo_deportivo` (`id_grupo_deportivo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `censo`
--
ALTER TABLE `censo`
  MODIFY `id_censo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `deportes`
--
ALTER TABLE `deportes`
  MODIFY `id_deporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `diciplina_persona`
--
ALTER TABLE `diciplina_persona`
  MODIFY `id_diciplina_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  MODIFY `id_division` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `grupos_deportivos`
--
ALTER TABLE `grupos_deportivos`
  MODIFY `id_grupo_deportivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT de la tabla `personas_grupos`
--
ALTER TABLE `personas_grupos`
  MODIFY `id_persona_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`id_division`) REFERENCES `divisiones` (`id_division`);

--
-- Filtros para la tabla `censo`
--
ALTER TABLE `censo`
  ADD CONSTRAINT `censo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `diciplina_persona`
--
ALTER TABLE `diciplina_persona`
  ADD CONSTRAINT `diciplina_persona_ibfk_1` FOREIGN KEY (`id_deporte`) REFERENCES `deportes` (`id_deporte`),
  ADD CONSTRAINT `diciplina_persona_ibfk_2` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id_area`);

--
-- Filtros para la tabla `personas_grupos`
--
ALTER TABLE `personas_grupos`
  ADD CONSTRAINT `personas_grupos_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`),
  ADD CONSTRAINT `personas_grupos_ibfk_2` FOREIGN KEY (`id_deporte`) REFERENCES `deportes` (`id_deporte`),
  ADD CONSTRAINT `personas_grupos_ibfk_3` FOREIGN KEY (`id_grupo_deportivo`) REFERENCES `grupos_deportivos` (`id_grupo_deportivo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
