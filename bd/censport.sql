-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2025 a las 05:23:59
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
(58, 9, 'Contribuyentes Especiales Punto Fijo');

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
(1, 'Fútbol'),
(2, 'Baloncesto'),
(3, 'Tenis'),
(4, 'Natación'),
(5, 'Atletismo'),
(6, 'Voleibol'),
(7, 'Golf'),
(8, 'Béisbol'),
(9, 'Rugby'),
(10, 'Ciclismo'),
(11, 'Boxeo'),
(12, 'Hockey'),
(13, 'Escalada'),
(14, 'Surf'),
(15, 'Esquí'),
(16, 'Taekwondo'),
(17, 'Karate'),
(18, 'Judo'),
(20, 'Patinaje'),
(21, 'Gimnasia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diciplina_persona`
--

CREATE TABLE `diciplina_persona` (
  `id_diciplina_persona` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_deporte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(9, 'División de Contribuyentes Especiales', 'CE');

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
(4, '28055655', 'Cesar Alejandro', 'Vides Gonzalez', 'Administrador', '$2y$10$EX4.HdhpjsoGfidaNChyCuZfhA1Ki/esrlYhH422r0Kq.gwAlHdWq');

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
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `deportes`
--
ALTER TABLE `deportes`
  MODIFY `id_deporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `diciplina_persona`
--
ALTER TABLE `diciplina_persona`
  MODIFY `id_diciplina_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  MODIFY `id_division` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `grupos_deportivos`
--
ALTER TABLE `grupos_deportivos`
  MODIFY `id_grupo_deportivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT de la tabla `personas_grupos`
--
ALTER TABLE `personas_grupos`
  MODIFY `id_persona_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`id_division`) REFERENCES `divisiones` (`id_division`);

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
