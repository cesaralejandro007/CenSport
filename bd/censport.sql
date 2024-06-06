-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2024 a las 04:37:00
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

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
(1, 2, 'Área de Recursos Humanos '),
(2, 2, 'Área de Bienes Nacionales'),
(3, 2, 'Despacho de la División de Administración'),
(4, 2, 'Área de Compras'),
(5, 2, 'Área de Almacén '),
(6, 2, 'Área de Presupuesto'),
(7, 2, 'Área de Contabilidad'),
(8, 2, 'Área de Tesorería '),
(9, 2, 'Coordinación de Infraestructura y Servicios'),
(10, 2, 'Área de Viáticos '),
(11, 1, 'Despacho de Gerencia'),
(12, 1, 'Resguardo'),
(13, 1, 'Seguridad'),
(14, 3, 'Despacho Asistencia al Contribuyente'),
(15, 3, 'Área de Prensa'),
(16, 4, 'Área De Cobranzas'),
(17, 4, 'Modulo de Inserción'),
(18, 4, 'Modulo Exoneración'),
(19, 4, 'Modulo de Remisión'),
(20, 4, 'Registro de Cta./Corriente'),
(21, 4, 'Despacho División  de Recaudación'),
(22, 4, 'Modulo de Retenciones'),
(23, 4, 'Entes Públicos '),
(24, 4, 'Área de Sucesiones'),
(25, 4, 'Modulo Investigación Patrimonial'),
(26, 4, 'Modulo Investigación Patrimonial'),
(27, 4, 'Área de Licores'),
(28, 4, 'Liquidación '),
(29, 4, 'Reintegro y Devoluciones'),
(30, 4, 'Timbres Fiscales'),
(31, 5, 'Despacho Fiscalización'),
(32, 5, 'Fiscalización General'),
(33, 5, 'Evaluo'),
(34, 5, 'Selección Previa'),
(35, 5, 'Deberes Formales'),
(36, 5, 'Beneficios Fiscales'),
(37, 5, 'Fondo y Semi Fondo'),
(38, 5, 'Planificación y Control de Gestión '),
(39, 6, 'Despacho División de Sumario'),
(40, 6, 'Despacho División de Sumario'),
(41, 7, 'Área Cobro Judicial'),
(42, 7, 'Recursos Administrativo y Jurídico '),
(43, 7, 'Despacho de la División'),
(44, 7, 'Contencioso Tributario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes`
--

CREATE TABLE `deportes` (
  `id_deporte` int(11) NOT NULL,
  `nombre_deporte` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(1, 'Gerencia Regional de Tributos Internos', 'GTI'),
(2, 'Administracion', 'ADM'),
(3, 'División Asistencia al Contribuyente', 'AC'),
(4, 'División de Recaudación', 'RE'),
(5, 'División de Fiscalizacíon', 'FI'),
(6, 'División de Sumario Administrativo', 'SA'),
(7, 'División de Jurídico Tributario ', 'JT'),
(8, 'División de Tramitaciones', 'TR'),
(9, 'División de Contribuyentes Especiales', 'CE');

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
  `sexo` varchar(2) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_grupos`
--

CREATE TABLE `personas_grupos` (
  `id_persona_grupo` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_deporte` int(11) NOT NULL,
  `nombre_grupo` text NOT NULL,
  `descripcion_grupo` text NOT NULL,
  `estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cedula` text NOT NULL,
  `nombre_apellido` text NOT NULL,
  `cargo` text NOT NULL,
  `contrasenna` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cedula`, `nombre_apellido`, `cargo`, `contrasenna`) VALUES
(1, '28055655', 'Cesar Vides', 'Administrador', 'Usuariov.37**');

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
-- Indices de la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD PRIMARY KEY (`id_deporte`);

--
-- Indices de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  ADD PRIMARY KEY (`id_division`);

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
  ADD KEY `id_persona` (`id_persona`);

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
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `deportes`
--
ALTER TABLE `deportes`
  MODIFY `id_deporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  MODIFY `id_division` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas_grupos`
--
ALTER TABLE `personas_grupos`
  MODIFY `id_persona_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`id_division`) REFERENCES `divisiones` (`id_division`);

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
  ADD CONSTRAINT `personas_grupos_ibfk_2` FOREIGN KEY (`id_deporte`) REFERENCES `deportes` (`id_deporte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
