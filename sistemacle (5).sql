-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2019 a las 10:29:55
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemacle`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `num_control` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `curp_alumno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrera` enum('Ingeniería Eléctrica','Ingeniería Electrónica','Ingeniería Civil','Ingeniería Mecánica','Ingeniería Industrial','Ingeniería Química','Ingeniería en Gestión Empresarial','Ingeniería en Sistemas Computacionales','Licenciatura en Administración') COLLATE utf8mb4_unicode_ci NOT NULL,
  `semestre` enum('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16') COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` enum('Inscrito','No Inscrito') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel_inicial` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`num_control`, `curp_alumno`, `carrera`, `semestre`, `estatus`, `nivel_inicial`, `deleted_at`, `created_at`, `updated_at`) VALUES
('12161276', 'GAGG941124HOCRRL01', 'Ingeniería Mecánica', '12', 'Inscrito', NULL, NULL, '2019-07-18 13:18:50', '2019-08-30 16:39:51'),
('12342342', 'EIVM991001MOCSSN01', 'Ingeniería Mecánica', '11', 'Inscrito', NULL, NULL, '2019-09-17 19:02:56', '2019-09-23 14:52:47'),
('12345679', 'GOMM991205MNTMRR11', 'Ingeniería Civil', '4', 'No Inscrito', 'A2M2', NULL, '2019-09-20 16:41:54', '2019-09-20 16:41:54'),
('12345680', 'SAMV770826MSLLNR38', 'Ingeniería Civil', '4', 'No Inscrito', 'A2M1', NULL, '2019-09-20 16:45:15', '2019-09-20 16:45:15'),
('13139610', 'fjls05os', 'Ingeniería Industrial', '12', 'Inscrito', NULL, NULL, '2019-06-11 21:59:54', '2019-08-30 17:43:52'),
('13161107', 'EIVM931001MOCSSN01', 'Ingeniería en Gestión Empresarial', '8', 'No Inscrito', NULL, '2019-07-10 14:00:03', '2019-07-04 10:06:24', '2019-07-10 14:00:03'),
('13456763', 'EIVM931001MOCSSN07', 'Ingeniería Mecánica', '8', 'Inscrito', NULL, NULL, '2019-08-30 17:35:09', '2019-08-30 17:43:52'),
('13456789', 'EIVM781001MOCSSN01', 'Licenciatura en Administración', '3', 'No Inscrito', NULL, '2019-07-18 12:40:18', NULL, '2019-07-18 12:40:18'),
('16267389', 'EIVA900304MOCSSN01', 'Ingeniería Electrónica', '9', 'No Inscrito', NULL, NULL, '2019-07-04 02:43:28', '2019-09-10 19:40:13'),
('18181811', 'OIMA770826MCLRNL68', 'Ingeniería en Gestión Empresarial', '6', 'No Inscrito', 'B1M2', NULL, '2019-09-23 06:27:06', '2019-09-23 06:27:06'),
('19283731', 'EIVM601212MOCSSN01', 'Ingeniería en Sistemas Computacionales', '2', 'Inscrito', NULL, NULL, '2019-07-04 01:39:22', '2019-08-29 16:49:30'),
('19309932', 'GUSA770826MNLTTN26', 'Ingeniería Industrial', '7', 'No Inscrito', 'A2M1', NULL, '2019-09-23 05:21:22', '2019-09-23 05:21:22'),
('21222112', 'CUGA980412MCMRRR85', 'Ingeniería Civil', '2', 'No Inscrito', NULL, NULL, '2019-10-08 18:14:20', '2019-10-08 18:14:20'),
('22222222', 'NIEC920916HOCSSN01', 'Ingeniería en Sistemas Computacionales', '11', 'No Inscrito', 'A2M2', NULL, '2019-09-17 20:37:12', '2019-09-17 20:37:12'),
('22828228', 'SAFA770826HPLNRN46', 'Ingeniería Eléctrica', '6', 'No Inscrito', 'B1M1', NULL, '2019-09-23 06:24:35', '2019-09-23 06:24:36'),
('25474287', 'fjls17bm', 'Ingeniería Química', '8', 'No Inscrito', NULL, NULL, '2019-06-11 21:59:55', '2019-08-30 16:20:19'),
('30293321', 'RIGR770826HBCSMS19', 'Ingeniería Eléctrica', '4', 'No Inscrito', 'A2M1', NULL, '2019-09-23 05:25:27', '2019-09-23 05:44:02'),
('32008644', 'fjls61jc', 'Ingeniería en Sistemas Computacionales', '4', 'Inscrito', NULL, NULL, '2019-06-11 21:59:56', '2019-06-11 21:59:56'),
('32983028', 'EIMM770826HDFSRR54', 'Ingeniería en Sistemas Computacionales', '7', 'No Inscrito', 'A2M2', NULL, '2019-09-23 05:26:38', '2019-09-23 05:26:38'),
('34567873', 'RENA101224MOCSSN01', 'Ingeniería Química', '8', 'Inscrito', NULL, NULL, '2019-07-04 02:52:22', '2019-08-21 13:24:17'),
('35780755', 'fjls16ce', 'Ingeniería Electrónica', '7', 'No Inscrito', NULL, NULL, '2019-06-11 21:59:55', '2019-08-30 15:46:17'),
('38949120', 'fjls62is', 'Ingeniería Civil', '6', 'No Inscrito', NULL, NULL, '2019-06-11 21:59:54', '2019-08-29 18:18:43'),
('39109103', 'RIRJ770826HQRSSS89', 'Ingeniería en Gestión Empresarial', '11', 'No Inscrito', 'A2M2', NULL, '2019-09-23 05:27:41', '2019-09-23 05:27:42'),
('39309303', 'LOGL770826HBCPRT25', 'Ingeniería Eléctrica', '6', 'No Inscrito', NULL, NULL, '2019-10-07 08:02:46', '2019-10-07 08:02:46'),
('39567669', 'fjls68ly', 'Ingeniería Eléctrica', '7', 'Inscrito', NULL, NULL, '2019-06-11 21:59:56', '2019-06-11 21:59:56'),
('41141056', 'fjls70cw', 'Ingeniería Química', '5', 'No Inscrito', NULL, NULL, '2019-06-11 21:59:54', '2019-08-30 15:46:17'),
('47996027', 'fjls05mk', 'Ingeniería Electrónica', '9', 'Inscrito', NULL, NULL, '2019-06-11 21:59:56', '2019-08-22 20:33:08'),
('49292001', 'VARM770826HGRRMR31', 'Ingeniería en Gestión Empresarial', '6', 'No Inscrito', 'B1M2', NULL, '2019-10-03 22:35:52', '2019-10-03 22:35:52'),
('56789673', 'EIME921021MOCSSN01', 'Ingeniería Química', '9', 'No Inscrito', NULL, NULL, '2019-07-04 09:16:41', '2019-08-30 15:46:17'),
('57824989', 'fjls11im', 'Licenciatura en Administración', '7', 'No Inscrito', NULL, NULL, '2019-06-11 21:59:54', '2019-08-30 15:46:17'),
('59260494', 'fjls41px', 'Ingeniería en Sistemas Computacionales', '5', 'Inscrito', NULL, NULL, '2019-06-11 21:59:53', '2019-09-17 17:56:58'),
('65031740', 'fjls08zm', 'Ingeniería Civil', '11', 'Inscrito', NULL, NULL, '2019-06-11 21:59:56', '2019-08-30 17:43:30'),
('66666666', 'EEIE881105HOCSSN01', 'Ingeniería Química', '9', 'No Inscrito', NULL, NULL, '2019-09-17 20:41:08', '2019-09-17 20:41:08'),
('67179574', 'fjls45wp', 'Ingeniería Eléctrica', '5', 'No Inscrito', NULL, NULL, '2019-06-11 21:59:55', '2019-08-30 15:46:16'),
('67661135', 'fjls58gf', 'Ingeniería Mecánica', '3', 'Inscrito', NULL, NULL, '2019-06-11 21:59:54', '2019-06-11 21:59:54'),
('67898768', 'IIVM931001MOCSSN01', 'Ingeniería en Gestión Empresarial', '9', 'No Inscrito', NULL, NULL, '2019-07-04 03:02:05', '2019-08-30 15:45:33'),
('6812919', 'fjls38av', 'Ingeniería Eléctrica', '3', 'Inscrito', NULL, NULL, '2019-06-11 21:59:55', '2019-08-30 17:43:30'),
('6855791', 'fjls64qo', 'Ingeniería en Gestión Empresarial', '4', 'No Inscrito', NULL, NULL, '2019-06-11 21:59:55', '2019-09-23 05:44:02'),
('73027689', 'fjls94mf', 'Ingeniería Industrial', '11', 'No Inscrito', NULL, NULL, '2019-06-11 21:59:54', '2019-06-11 21:59:54'),
('78932840', 'EIMV931001MOCSSN08', 'Ingeniería Electrónica', '2', 'No Inscrito', NULL, '2019-07-04 09:19:06', '2019-07-04 09:18:37', '2019-07-04 09:19:06'),
('80822979', 'fjls09jz', 'Ingeniería Eléctrica', '11', 'No Inscrito', NULL, NULL, '2019-06-11 21:59:56', '2019-06-11 21:59:56'),
('82919191', 'OIAA770826HGTRLR39', 'Ingeniería en Gestión Empresarial', '6', 'No Inscrito', 'B1M2', NULL, '2019-09-23 06:25:50', '2019-09-23 06:25:50'),
('82983992', 'EIVM831001MOCSSN01', 'Ingeniería Industrial', '3', 'No Inscrito', NULL, '2019-08-21 13:32:15', '2019-07-19 11:36:22', '2019-08-21 13:32:15'),
('83494920', 'VACP770826MYNRRB63', 'Licenciatura en Administración', '7', 'No Inscrito', NULL, NULL, '2019-10-04 07:13:12', '2019-10-04 07:13:12'),
('83812007', 'fjls15lf', 'Ingeniería Civil', '1', 'No Inscrito', NULL, '2019-06-22 05:39:54', '2019-06-11 21:59:55', '2019-06-22 05:39:54'),
('84372382', 'GUAM770826HSRZGR11', 'Ingeniería Química', '7', 'No Inscrito', 'B1M1', NULL, '2019-09-23 06:21:54', '2019-09-23 06:21:55'),
('84754048', 'fjls34nt', 'Ingeniería Eléctrica', '9', 'No Inscrito', NULL, '2019-07-11 06:57:05', '2019-06-11 21:59:55', '2019-07-11 06:57:05'),
('88992200', 'HEVM931001MOCSSN01', 'Ingeniería Industrial', '4', 'No Inscrito', NULL, '2019-07-18 13:09:15', '2019-07-18 11:53:16', '2019-07-18 13:09:15'),
('89320390', 'MOGA770826MNLRTN17', 'Ingeniería Electrónica', '3', 'Inscrito', 'A2M2', NULL, '2019-10-07 08:31:06', '2019-10-14 17:08:42'),
('89898899', 'NIUG891220MOCSSN58', 'Ingeniería Mecánica', '1', 'Inscrito', 'A1M1', NULL, '2019-10-08 18:17:28', '2019-10-14 17:00:47'),
('90920932', 'ROOC770826HSPDRR78', 'Ingeniería Química', '5', 'No Inscrito', 'B1M1', NULL, '2019-09-23 06:23:02', '2019-09-23 06:23:02'),
('92919191', 'SOMA000826HOCRRH07', 'Ingeniería Mecánica', '6', 'No Inscrito', 'B1M2', NULL, '2019-09-23 06:29:27', '2019-09-23 06:29:27'),
('92929292', 'LOGM770826HTCPZR85', 'Ingeniería Industrial', '9', 'Inscrito', 'A2M2', NULL, '2019-09-23 05:28:53', '2019-09-25 04:40:24'),
('92938039', 'PEGR770826HDGRRF75', 'Ingeniería Mecánica', '9', 'No Inscrito', 'A2M1', NULL, '2019-09-23 05:13:30', '2019-10-06 07:46:39'),
('93749884', 'PAUL941024MOCSSN01', 'Licenciatura en Administración', '8', 'No Inscrito', NULL, NULL, '2019-07-04 02:58:01', '2019-07-04 02:58:01'),
('98392892', 'EIVM921001MOCSSN01', 'Ingeniería Mecánica', '2', 'No Inscrito', NULL, '2019-07-11 11:19:52', '2019-07-04 12:22:59', '2019-07-11 11:19:52'),
('B39834842', 'GURA770826HBCTDL22', 'Licenciatura en Administración', '7', 'No Inscrito', 'B1M1', NULL, '2019-10-07 08:16:36', '2019-10-07 08:16:36'),
('C29290211', 'VAMG770826MSPRRB23', 'Ingeniería Química', '7', 'No Inscrito', NULL, NULL, '2019-10-07 05:36:42', '2019-10-07 05:36:42'),
('D83928212', 'MOGR770826HTCRNC29', 'Ingeniería Química', '4', 'No Inscrito', 'B1M2', NULL, '2019-10-08 18:03:23', '2019-10-08 18:03:23'),
('H23838299', 'RIGE770826MTCSMN65', 'Ingeniería Química', '7', 'Inscrito', NULL, NULL, '2019-10-07 08:23:52', '2019-10-09 06:09:33'),
('H92030290', 'FOVA980823HGTLSN96', 'Ingeniería Electrónica', '6', 'No Inscrito', 'B1M1', NULL, '2019-10-08 18:06:59', '2019-10-08 18:06:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_inscrito`
--

CREATE TABLE `alumno_inscrito` (
  `num_inscripcion` int(10) UNSIGNED NOT NULL,
  `id_grupo` int(10) UNSIGNED DEFAULT NULL,
  `num_control` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folio_pago` int(11) DEFAULT NULL,
  `monto_pago` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `pago_verificado` tinyint(1) DEFAULT NULL,
  `examen_ubicacion` tinyint(1) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno_inscrito`
--

INSERT INTO `alumno_inscrito` (`num_inscripcion`, `id_grupo`, `num_control`, `folio_pago`, `monto_pago`, `fecha`, `pago_verificado`, `examen_ubicacion`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 3, '67661135', 123, 123, '2019-12-12', 1, NULL, NULL, '2019-08-15 20:30:17', '2019-10-03 23:27:36'),
(4, 5, '59260494', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-20 18:10:38', '2019-08-20 18:10:38'),
(5, 5, '32008644', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-20 18:10:38', '2019-08-20 18:10:38'),
(6, 5, '39567669', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-20 18:10:38', '2019-08-20 18:10:38'),
(7, 3, '34567873', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-21 13:24:17', '2019-08-21 13:24:17'),
(8, 2, '67661135', 234, 1234, '2019-01-01', 1, NULL, NULL, '2019-01-16 21:30:17', '2019-09-19 19:35:23'),
(9, 3, '47996027', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-22 20:33:07', '2019-08-22 20:33:07'),
(10, 3, '19283731', 123, 123, '2019-12-12', 1, NULL, NULL, '2019-08-29 16:49:30', '2019-09-19 19:43:38'),
(42, 3, '12161276', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:39:51', '2019-08-30 16:39:51'),
(43, 3, '6855791', NULL, NULL, NULL, NULL, NULL, '2019-09-23 05:44:02', '2019-08-30 16:45:08', '2019-09-23 05:44:02'),
(44, 11, '6812919', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-30 17:43:30', '2019-08-30 17:43:30'),
(45, 11, '65031740', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-30 17:43:30', '2019-08-30 17:43:30'),
(46, 11, '13139610', 111234, 1234, '2019-12-12', NULL, NULL, NULL, '2019-08-30 17:43:52', '2019-10-15 22:56:33'),
(47, 11, '13456763', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-30 17:43:52', '2019-08-30 17:43:52'),
(48, 1, '16267389', NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-10 19:40:13', '2019-09-10 19:40:13'),
(50, 5, '92929292', NULL, NULL, NULL, NULL, NULL, '2019-09-23 06:17:32', '2019-09-23 05:47:31', '2019-09-23 06:17:32'),
(51, 5, '92929292', NULL, NULL, NULL, NULL, NULL, '2019-09-23 06:18:26', '2019-09-23 06:18:00', '2019-09-23 06:18:26'),
(52, 11, '12342342', NULL, NULL, NULL, NULL, NULL, '2019-09-23 14:28:59', '2019-09-23 14:27:32', '2019-09-23 14:28:59'),
(53, 11, '12342342', NULL, NULL, NULL, NULL, NULL, '2019-09-23 14:43:29', '2019-09-23 14:42:35', '2019-09-23 14:43:29'),
(54, 11, '12342342', NULL, NULL, NULL, NULL, NULL, '2019-09-23 14:47:18', '2019-09-23 14:43:46', '2019-09-23 14:47:18'),
(55, 11, '12342342', NULL, NULL, NULL, NULL, NULL, '2019-09-23 14:49:24', '2019-09-23 14:49:16', '2019-09-23 14:49:24'),
(56, 11, '12342342', NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-23 14:52:47', '2019-09-23 14:52:47'),
(57, 5, '92929292', 123456, 814, '2019-09-23', 1, NULL, NULL, '2019-09-23 16:19:04', '2019-09-25 04:40:24'),
(59, NULL, '92938039', 121212, 12, '2019-09-23', 1, NULL, NULL, '2019-09-23 16:25:12', '2019-10-06 07:46:39'),
(60, NULL, '66666666', 212121, 121212, '2019-09-12', 0, NULL, NULL, '2019-09-23 17:25:38', '2019-09-23 17:25:54'),
(65, 12, 'H23838299', 121617, 124, '2019-10-08', 1, NULL, NULL, '2019-10-08 06:07:28', '2019-10-09 06:09:33'),
(66, NULL, 'C29290211', 102938, 800, '2019-10-08', 1, NULL, NULL, '2019-10-09 01:19:02', '2019-10-09 01:19:50'),
(67, 12, '89320390', 292929, 9292, '2019-12-12', 1, NULL, NULL, '2019-10-14 16:44:52', '2019-10-14 17:08:42'),
(68, 11, '89898899', 11111, 1111, '2019-12-23', 1, NULL, NULL, '2019-10-14 16:46:34', '2019-10-14 17:00:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `id_aula` int(10) UNSIGNED NOT NULL,
  `num_aula` tinyint(4) NOT NULL,
  `edificio` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hrdisponible` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`id_aula`, `num_aula`, `edificio`, `hrdisponible`, `deleted_at`) VALUES
(1, 3, 'A', 1, NULL),
(2, 3, 'C', 3, NULL),
(3, 2, 'B', 2, NULL),
(4, 7, 'I', 4, NULL),
(5, 9, 'I', 11, NULL),
(6, 8, 'K', 19, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletas`
--

CREATE TABLE `boletas` (
  `id_boleta` int(10) UNSIGNED NOT NULL,
  `num_control` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_grupo` int(10) UNSIGNED NOT NULL,
  `calif1` int(11) DEFAULT NULL,
  `calif2` int(11) DEFAULT NULL,
  `calif3` int(11) DEFAULT NULL,
  `calif_f` int(11) DEFAULT NULL,
  `faltas` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `boletas`
--

INSERT INTO `boletas` (`id_boleta`, `num_control`, `id_grupo`, `calif1`, `calif2`, `calif3`, `calif_f`, `faltas`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '67179574', 3, 80, 73, 100, 84, NULL, '2019-08-29 18:38:05', NULL, '2019-08-29 18:38:05'),
(2, '67661135', 3, 80, 95, 100, 0, 10, NULL, NULL, '2019-10-05 19:58:00'),
(3, '67898768', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 15:45:33', NULL, '2019-08-30 15:45:33'),
(4, '59260494', 5, NULL, NULL, NULL, 84, NULL, NULL, NULL, NULL),
(5, '32008644', 5, NULL, NULL, NULL, 78, NULL, NULL, NULL, NULL),
(6, '39567669', 5, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(7, '34567873', 3, 0, 80, 0, 27, 0, NULL, NULL, '2019-10-05 19:58:00'),
(8, '67661135', 2, NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL),
(9, '47996027', 3, 70, 0, 0, 23, 0, NULL, '2019-08-29 16:49:30', '2019-10-05 19:58:00'),
(10, '19283731', 3, 0, 0, 0, 0, 0, NULL, '2019-08-29 16:49:30', '2019-10-05 19:29:27'),
(11, '25474287', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 15:46:17', '2019-08-29 16:49:30', '2019-08-30 15:46:17'),
(12, '6812919', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-29 18:09:40', '2019-08-29 18:06:16', '2019-08-29 18:09:40'),
(13, '6855791', 3, 76, 87, 87, NULL, NULL, '2019-09-23 05:44:02', '2019-08-29 18:06:16', '2019-09-23 05:44:02'),
(14, '38949120', 3, NULL, NULL, NULL, 88, NULL, NULL, '2019-08-29 18:18:43', '2019-08-29 18:18:43'),
(15, '6812919', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:39:51', '2019-08-29 18:38:05', '2019-08-30 16:39:51'),
(16, '6855791', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 15:46:16', '2019-08-29 18:38:05', '2019-08-30 15:46:16'),
(17, '67179574', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 15:46:16', '2019-08-29 18:47:43', '2019-08-30 15:46:16'),
(18, '12161276', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 15:46:16', '2019-08-30 15:45:32', '2019-08-30 15:46:16'),
(19, '13139610', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 15:46:16', '2019-08-30 15:45:32', '2019-08-30 15:46:16'),
(20, '16267389', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 15:46:16', '2019-08-30 15:45:32', '2019-08-30 15:46:16'),
(21, '35780755', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 15:46:17', '2019-08-30 15:45:32', '2019-08-30 15:46:17'),
(22, '41141056', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 15:46:17', '2019-08-30 15:45:33', '2019-08-30 15:46:17'),
(23, '56789673', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 15:46:17', '2019-08-30 15:45:33', '2019-08-30 15:46:17'),
(24, '57824989', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 15:46:17', '2019-08-30 15:45:33', '2019-08-30 15:46:17'),
(25, '65031740', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 15:46:17', '2019-08-30 15:45:33', '2019-08-30 15:46:17'),
(26, '6855791', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:08:50', '2019-08-30 16:05:12', '2019-08-30 16:08:50'),
(27, '12161276', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:08:50', '2019-08-30 16:06:25', '2019-08-30 16:08:50'),
(28, '13139610', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:08:50', '2019-08-30 16:08:40', '2019-08-30 16:08:50'),
(29, '6855791', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:20:18', '2019-08-30 16:11:08', '2019-08-30 16:20:18'),
(30, '12161276', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:17:13', '2019-08-30 16:14:39', '2019-08-30 16:17:13'),
(31, '13139610', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:17:13', '2019-08-30 16:16:59', '2019-08-30 16:17:13'),
(32, '12161276', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:20:18', '2019-08-30 16:17:50', '2019-08-30 16:20:18'),
(33, '13139610', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:19:35', '2019-08-30 16:19:26', '2019-08-30 16:19:35'),
(34, '16267389', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:20:19', '2019-08-30 16:20:05', '2019-08-30 16:20:19'),
(35, '25474287', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:20:19', '2019-08-30 16:20:05', '2019-08-30 16:20:19'),
(36, '6855791', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:36:17', '2019-08-30 16:33:15', '2019-08-30 16:36:17'),
(37, '12161276', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:36:17', '2019-08-30 16:33:16', '2019-08-30 16:36:17'),
(38, '13139610', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:36:17', '2019-08-30 16:34:38', '2019-08-30 16:36:17'),
(39, '6855791', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:38:33', '2019-08-30 16:38:24', '2019-08-30 16:38:33'),
(40, '6855791', 3, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:39:51', '2019-08-30 16:39:14', '2019-08-30 16:39:51'),
(41, '12161276', 3, 90, 0, 0, 30, 0, NULL, '2019-08-30 16:39:51', '2019-10-05 19:58:00'),
(42, '6855791', 3, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-30 16:45:08', '2019-08-30 16:45:08'),
(43, '6812919', 11, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-30 17:43:30', '2019-08-30 17:43:30'),
(44, '65031740', 11, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-30 17:43:30', '2019-08-30 17:43:30'),
(45, '13139610', 11, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-30 17:43:52', '2019-08-30 17:43:52'),
(46, '13456763', 11, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-30 17:43:52', '2019-08-30 17:43:52'),
(47, '16267389', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-10 19:40:13', '2019-09-10 19:40:13'),
(48, '30293321', 3, NULL, NULL, NULL, NULL, NULL, '2019-09-23 05:44:02', '2019-09-23 05:43:47', '2019-09-23 05:44:02'),
(49, '92929292', 5, NULL, NULL, NULL, NULL, NULL, '2019-09-23 06:17:32', '2019-09-23 05:47:32', '2019-09-23 06:17:32'),
(50, '92929292', 5, NULL, NULL, NULL, NULL, NULL, '2019-09-23 06:18:26', '2019-09-23 06:18:00', '2019-09-23 06:18:26'),
(51, '12342342', 11, NULL, NULL, NULL, NULL, NULL, '2019-09-23 14:28:59', '2019-09-23 14:27:32', '2019-09-23 14:28:59'),
(52, '12342342', 11, NULL, NULL, NULL, NULL, NULL, '2019-09-23 14:43:29', '2019-09-23 14:42:35', '2019-09-23 14:43:29'),
(53, '12342342', 11, NULL, NULL, NULL, NULL, NULL, '2019-09-23 14:47:18', '2019-09-23 14:43:46', '2019-09-23 14:47:18'),
(54, '12342342', 11, NULL, NULL, NULL, NULL, NULL, '2019-09-23 14:49:24', '2019-09-23 14:49:16', '2019-09-23 14:49:24'),
(55, '12342342', 11, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-23 14:52:47', '2019-09-23 14:52:47'),
(56, '92929292', 5, NULL, NULL, NULL, NULL, NULL, '2019-09-25 04:39:27', '2019-09-23 16:23:24', '2019-09-25 04:39:27'),
(57, '92929292', 5, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-25 04:40:24', '2019-09-25 04:40:24'),
(58, '92938039', 3, NULL, NULL, NULL, NULL, NULL, '2019-10-03 23:28:53', '2019-10-03 23:28:35', '2019-10-03 23:28:53'),
(59, '92938039', 3, NULL, NULL, NULL, NULL, NULL, '2019-10-06 06:02:22', '2019-10-06 06:01:56', '2019-10-06 06:02:22'),
(60, '92938039', 3, NULL, NULL, NULL, NULL, NULL, '2019-10-06 07:46:39', '2019-10-06 07:43:29', '2019-10-06 07:46:39'),
(61, 'H23838299', 12, 80, 70, 70, 0, 9, '2019-10-09 04:13:23', '2019-10-08 06:16:40', '2019-10-09 04:13:23'),
(62, 'H23838299', 12, NULL, NULL, NULL, NULL, NULL, '2019-10-09 04:17:56', '2019-10-09 04:17:50', '2019-10-09 04:17:56'),
(63, 'H23838299', 12, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-09 06:09:34', '2019-10-09 06:09:34'),
(64, '89898899', 11, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-14 17:00:48', '2019-10-14 17:00:48'),
(65, '89320390', 12, NULL, NULL, NULL, NULL, NULL, '2019-10-14 17:07:15', '2019-10-14 17:05:07', '2019-10-14 17:07:15'),
(66, '89320390', 12, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-14 17:08:42', '2019-10-14 17:08:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(10) UNSIGNED NOT NULL,
  `curp_docente` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grado_estudios` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ced_prof` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactivo',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `curp_docente`, `rfc`, `grado_estudios`, `titulo`, `ced_prof`, `estatus`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, 'EIVM931001MOCSSN06', 'LDSJA409', 'Maestría', 'AKLSDJOIWEFN', '12345654', 'Inactivo', NULL, '2019-06-11 23:51:53', '2019-06-11 23:51:53'),
(5, 'EIVM931001MOCSSN05', 'CUPU800825569', 'Maestría', 'Idiomas', '87654321', 'Activo', NULL, '2019-06-20 05:12:48', '2019-06-20 05:12:48'),
(6, 'fjls05mk', 'FEFR0301889H0', 'Licenciatura', 'Idiomas', '92837743', 'Inactivo', NULL, NULL, NULL),
(7, 'POGL920621HOCSSN03', '12345234bnm', 'Licenciatura', 'Idiomas', '83912039', 'Activo', NULL, '2019-06-20 05:42:57', '2019-06-20 05:42:57'),
(9, 'GAGR951124HOCSSN02', '345678iug', 'Doctorado', 'Idiomas', '45678989', 'Activo', NULL, NULL, NULL),
(10, 'EIVM931101MOCSSN01', '2-Programa_Lengua_Extranjera_2014 (1).pdf', 'Maestría', 'Dialnet-LaImportanciaDelAprendizajeYConocimientoDelIdiomaI-6234740.pdf', 'Dialnet-LaImportanciaDelAprendizajeYConocimientoDelIdiomaI-6234740.pdf', 'Activo', NULL, '2019-07-17 10:55:46', '2019-07-17 10:55:46'),
(11, 'ASKJLA', 'Dialnet-LaImportanciaDelAprendizajeYConocimientoDelIdiomaI-6234740.pdf', 'Doctorado', '316-Article Text-1065-2-10-20150424.pdf', '316-Article Text-1065-2-10-20150424.pdf', 'Inactivo', NULL, '2019-07-17 11:06:04', '2019-07-17 11:06:04'),
(12, 'JKSAJLAKJ', '2-Programa_Lengua_Extranjera_2014 (1).pdf', 'Maestría', '316-Article Text-1065-2-10-20150424.pdf', '316-Article Text-1065-2-10-20150424.pdf', 'Activo', NULL, '2019-07-17 11:07:03', '2019-07-17 11:07:03'),
(13, 'AIJM931001MOCSSN01', 'Orden-CitaLAB010.pdf', 'Maestría', '316-Article Text-1065-2-10-20150424.pdf', '316-Article Text-1065-2-10-20150424.pdf', 'Inactivo', NULL, '2019-07-18 03:46:10', '2019-07-18 03:46:10'),
(14, 'AESP931001MOCSSN02', '316-Article Text-1065-2-10-20150424.pdf', 'Licenciatura', '2-Programa_Lengua_Extranjera_2014 (1).pdf', '2-Programa_Lengua_Extranjera_2014 (1).pdf', 'Activo', NULL, '2019-07-18 03:51:41', '2019-07-18 12:14:18'),
(16, 'JLAKJ', '2-Programa_Lengua_Extranjera_2014 (1).pdf', 'Maestría', '2-Programa_Lengua_Extranjera_2014 (1).pdf', '2-Programa_Lengua_Extranjera_2014 (1).pdf', 'Inactivo', '2019-07-18 13:33:27', '2019-07-18 12:23:41', '2019-07-18 13:33:27'),
(17, '65789iygvbhj98u', 'wqertywerwerefdkal', 'Licenciatura', 'sokjakjlkaj', '940909023', 'Activo', NULL, NULL, NULL),
(18, 'fjls05os', 'ksjlakj4jlk3', 'Licenciatura', 'slkjlakjlskd', '239309203', 'Inactivo', NULL, NULL, NULL),
(19, 'fjls38av', 'ksjdlakjldk344', 'sdkjlakjl', 'sdklkaj', '2333232', 'Inactivo', NULL, NULL, NULL),
(20, 'fjls58gf', 'lksdjlka', 'skdjlkjsa', 'lksdjlk', '43lk34', 'Activo', NULL, NULL, NULL),
(21, 'fjls61jc', 'skdjlakj', 'lkjldksj', 'kjslkjdal', 'lklak2', 'Inactivo', NULL, NULL, NULL),
(22, 'fjls62is', 'skdjlakj', 'lksdjlak', 'lkjalkjd', 'lkjlkjd', 'Inactivo', NULL, NULL, NULL),
(23, 'fjls64qo', 'skldjalkj', 'kjalskdj', 'kjlskdj', 'kljlk', 'Activo', NULL, NULL, NULL),
(24, 'CUFM770826MMSRLR35', 'MANUAL DE IDENTIDAD 4.pdf', 'Doctorado', 'MANUAL DE IDENTIDAD 4.pdf', 'Glendy local correcion historias.pdf', 'Inactivo', NULL, '2019-10-04 07:14:59', '2019-10-04 07:14:59'),
(25, 'SAMG770826HOCLRL69', 'MANUAL DE IDENTIDAD 4.pdf', 'Doctorado', 'MANUAL DE IDENTIDAD 4.pdf', 'MANUAL DE IDENTIDAD 4.pdf', 'Inactivo', NULL, '2019-10-07 10:32:08', '2019-10-07 10:32:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE `evaluacion` (
  `num_evaluacion` int(10) UNSIGNED NOT NULL,
  `num_control` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `curp_docente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo` int(10) UNSIGNED NOT NULL,
  `periodo` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`num_evaluacion`, `num_control`, `curp_docente`, `grupo`, `periodo`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'H23838299', 'SAMG770826HOCLRL69', 12, 2, NULL, '2019-10-10 17:42:26', '2019-10-10 17:42:26'),
(4, '89320390', 'SAMG770826HOCLRL69', 12, 2, NULL, '2019-10-14 17:11:30', '2019-10-14 17:11:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(10) UNSIGNED NOT NULL,
  `grupo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modalidad` enum('Semanal','Sabatino') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Semanal',
  `nivel_id` int(10) UNSIGNED NOT NULL,
  `aula` int(10) UNSIGNED NOT NULL,
  `docente` int(10) UNSIGNED DEFAULT NULL,
  `periodo` int(10) UNSIGNED NOT NULL,
  `hora` time NOT NULL,
  `cupo` int(11) NOT NULL DEFAULT '30',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `grupo`, `modalidad`, `nivel_id`, `aula`, `docente`, `periodo`, `hora`, `cupo`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'A', 'Semanal', 1, 3, 4, 1, '07:00:00', 30, NULL, NULL, NULL),
(2, 'B', 'Semanal', 4, 3, 4, 1, '13:00:00', 30, NULL, NULL, NULL),
(3, 'C', 'Sabatino', 3, 1, 5, 2, '08:00:00', 15, NULL, NULL, '2019-08-30 15:51:51'),
(4, 'ghjk', 'Semanal', 3, 2, 4, 2, '07:00:00', 30, '2019-07-25 00:07:01', '2019-07-19 10:19:07', '2019-07-25 00:07:01'),
(5, 'kjlk', 'Semanal', 4, 2, 4, 2, '07:00:00', 30, NULL, '2019-07-25 00:09:10', '2019-07-25 00:09:10'),
(6, 'jl', 'Semanal', 3, 5, 10, 1, '19:00:00', 30, '2019-07-25 00:10:48', '2019-07-25 00:10:23', '2019-07-25 00:10:48'),
(7, 'I', 'Semanal', 6, 6, 7, 2, '18:00:00', 30, NULL, NULL, '2019-09-20 16:58:50'),
(8, 'F', 'Semanal', 4, 5, 11, 3, '14:00:00', 23, NULL, '2019-08-29 20:15:06', '2019-08-29 20:15:06'),
(9, 'D', 'Semanal', 6, 2, 7, 2, '09:00:00', 15, NULL, '2019-08-30 01:12:45', '2019-08-30 01:12:45'),
(10, 'H', 'Semanal', 5, 4, 9, 2, '09:00:00', 25, NULL, '2019-08-30 01:18:44', '2019-08-30 01:18:44'),
(11, 'L', 'Semanal', 1, 5, 5, 2, '13:00:00', 15, NULL, '2019-08-30 17:43:01', '2019-08-30 17:43:01'),
(12, 'W', 'Semanal', 4, 3, 25, 3, '08:00:00', 45, NULL, '2019-10-07 13:15:10', '2019-10-07 13:15:10'),
(13, 'R', 'Semanal', 1, 5, NULL, 3, '09:00:00', 34, NULL, '2019-10-14 04:17:44', '2019-10-14 04:17:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_respuesta`
--

CREATE TABLE `grupo_respuesta` (
  `id_grupoRespuestas` int(10) UNSIGNED NOT NULL,
  `grupoRespuesta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupo_respuesta`
--

INSERT INTO `grupo_respuesta` (`id_grupoRespuestas`, `grupoRespuesta`, `created_at`, `updated_at`) VALUES
(1, 'Frecuencia', '2019-09-27 04:52:34', '2019-09-27 04:52:34'),
(2, 'Puntuación', '2019-09-27 04:55:44', '2019-09-27 04:55:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_historial` int(10) UNSIGNED NOT NULL,
  `num_control` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_paterno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_materno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carrera` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semestre` int(11) NOT NULL,
  `periodo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `nivel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modulo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grupo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `A1M1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calif1` int(11) DEFAULT NULL,
  `A2M1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calif2` int(11) DEFAULT NULL,
  `A2M2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calif3` int(11) DEFAULT NULL,
  `B1M1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calif4` int(11) DEFAULT NULL,
  `B1M2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calif5` int(11) DEFAULT NULL,
  `calif_final` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id_historial`, `num_control`, `nombres`, `ap_paterno`, `ap_materno`, `carrera`, `semestre`, `periodo`, `anio`, `nivel`, `modulo`, `grupo`, `A1M1`, `calif1`, `A2M1`, `calif2`, `A2M2`, `calif3`, `B1M1`, `calif4`, `B1M2`, `calif5`, `calif_final`, `created_at`, `updated_at`) VALUES
(6, '22222222', 'Nick ', 'Jonas ', 'Miller', 'Ingeniería en Sistemas Computacionales', 11, NULL, NULL, NULL, NULL, NULL, 'aprobado', 0, 'aprobado', 0, 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-17 20:37:12', '2019-09-23 14:21:49'),
(7, '66666666', 'Kevin ', 'Jonas', NULL, 'Ingeniería Química', 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-17 20:41:08', '2019-09-17 20:41:08'),
(8, '12345679', 'Marcela ', 'Gómez ', 'Martínez', 'Ingeniería Civil', 4, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-20 16:41:54', '2019-09-20 17:24:53'),
(9, '12345680', 'Veronica ', 'Salazar ', 'Muñoz', 'Ingeniería Civil', 4, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-20 16:45:15', '2019-09-20 16:45:15'),
(10, '92938039', 'Rafael', 'Pérez', 'Garza', 'Ingeniería Mecánica', 9, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-23 05:13:30', '2019-10-06 07:46:39'),
(11, '19309932', 'Antonia ', 'Gutierrez ', 'Soto', 'Ingeniería Industrial', 7, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-23 05:21:22', '2019-09-23 05:21:22'),
(12, '30293321', 'Rosa ', 'Rios ', 'Gomez', 'Ingeniería Eléctrica', 4, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-23 05:25:27', '2019-09-23 05:25:27'),
(13, '32983028', 'María Luisa ', 'Espinoza ', 'Martinez', 'Ingeniería en Sistemas Computacionales', 7, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-23 05:26:38', '2019-09-23 05:26:38'),
(14, '39109103', 'José Luis ', 'Rios', 'Rios', 'Ingeniería en Gestión Empresarial', 11, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-23 05:27:42', '2019-09-23 05:27:42'),
(15, '92929292', 'María Elena ', 'López ', 'Gúzman', 'Ingeniería Industrial', 9, 'AGO-DIC', 2019, 'A2', 'M2', 'kjlk', 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-23 05:28:53', '2019-09-25 04:40:24'),
(16, '84372382', 'María de los Angeles ', 'Guzman ', 'Aguilar', 'Ingeniería Química', 7, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, '2019-09-23 06:21:55', '2019-09-23 06:21:55'),
(17, '90920932', 'Carmen ', 'Rodriguez ', 'Ortiz', 'Ingeniería Química', 5, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, '2019-09-23 06:23:02', '2019-09-23 06:23:02'),
(18, '22828228', 'Ana María ', 'Santiago ', 'Fernandez', 'Ingeniería Eléctrica', 6, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, '2019-09-23 06:24:36', '2019-09-23 06:24:36'),
(19, '82919191', 'Arturo ', 'Ortiz ', 'Alvarez', 'Ingeniería en Gestión Empresarial', 6, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, '2019-09-23 06:25:50', '2019-09-23 06:25:50'),
(20, '18181811', 'Alfredo ', 'Ortiz ', 'Mendoza', 'Ingeniería en Gestión Empresarial', 6, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, '2019-09-23 06:27:06', '2019-09-23 06:27:06'),
(21, '92919191', 'Marco Antonio ', 'Soriano', NULL, 'Ingeniería Mecánica', 6, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, '2019-09-23 06:29:27', '2019-09-23 06:29:27'),
(24, '12342342', 'Roberto', 'Castellanos', NULL, 'Ingeniería Mecánica', 11, 'AGO-DIC', 2019, 'A1', 'M1', 'L', 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-23 14:52:47', '2019-09-23 14:52:47'),
(25, '49292001', 'María de Jesús', 'Vargas', 'Morales', 'Ingeniería en Gestión Empresarial', 6, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', 80, NULL, '2019-10-03 22:35:52', '2019-10-03 22:35:52'),
(26, '83494920', 'Pablo', 'Cruz', 'Vargas', 'Licenciatura en Administración', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-04 07:13:12', '2019-10-04 07:13:12'),
(27, 'C29290211', 'Gabriel', 'Vargas', 'Moreno', 'Ingeniería Química', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-07 05:36:43', '2019-10-07 05:36:43'),
(28, '39309303', 'Leticia', 'López', 'García', 'Ingeniería Eléctrica', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-07 08:02:47', '2019-10-07 08:02:47'),
(29, 'B39834842', 'Alejandro', 'Gutierrez', 'Rodriguez', 'Licenciatura en Administración', 7, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, '2019-10-07 08:16:36', '2019-10-07 08:16:36'),
(30, 'H23838299', 'Luis Enrique', 'Rios', 'Gomez', 'Ingeniería Química', 7, 'ENE-JUN', 2020, 'A2', 'M2', 'W', 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-07 08:23:53', '2019-10-09 06:09:34'),
(31, '89320390', 'Angel', 'Moreno', 'Gutierrez', 'Ingeniería Electrónica', 3, 'ENE-JUN', 2020, 'A2', 'M2', 'W', 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-07 08:31:06', '2019-10-14 17:08:42'),
(32, 'D83928212', 'Raul', 'Herrera', 'Morales', 'Ingeniería Química', 4, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, '2019-10-08 18:03:23', '2019-10-08 18:03:23'),
(33, 'H92030290', 'Miguel', 'Flores', 'Vasquez', 'Ingeniería Electrónica', 6, NULL, NULL, NULL, NULL, NULL, 'aprobado', NULL, 'aprobado', NULL, 'aprobado', NULL, 'cursando', NULL, NULL, NULL, NULL, '2019-10-08 18:06:59', '2019-10-08 18:06:59'),
(34, '21222112', 'Ana', 'Cruz', 'Garza', 'Ingeniería Civil', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-08 18:14:21', '2019-10-08 18:14:21'),
(35, '89898899', 'Gloria', 'Nuñez', 'Alvarez', 'Ingeniería Mecánica', 1, 'AGO-DIC', 2019, 'A1', 'M1', 'L', 'cursando', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-08 18:17:28', '2019-10-14 17:00:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_disponibles`
--

CREATE TABLE `horas_disponibles` (
  `id_hora` int(10) UNSIGNED NOT NULL,
  `hora1` time DEFAULT NULL,
  `hora2` time DEFAULT NULL,
  `hora3` time DEFAULT NULL,
  `hora4` time DEFAULT NULL,
  `hora5` time DEFAULT NULL,
  `hora6` time DEFAULT NULL,
  `hora7` time DEFAULT NULL,
  `hora8` time DEFAULT NULL,
  `hora9` time DEFAULT NULL,
  `hora10` time DEFAULT NULL,
  `hora11` time DEFAULT NULL,
  `hora12` time DEFAULT NULL,
  `hora13` time DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horas_disponibles`
--

INSERT INTO `horas_disponibles` (`id_hora`, `hora1`, `hora2`, `hora3`, `hora4`, `hora5`, `hora6`, `hora7`, `hora8`, `hora9`, `hora10`, `hora11`, `hora12`, `hora13`, `deleted_at`) VALUES
(1, '07:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '07:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, '08:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '07:00:00', '08:00:00', NULL, '10:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '08:00:00', '09:00:00', '12:00:00', '15:00:00', '16:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '11:00:00', '12:00:00', '15:00:00', '18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '08:00:00', '09:00:00', '13:00:00', '14:00:00', '16:00:00', '19:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '08:00:00', NULL, NULL, NULL, '16:00:00', '19:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '09:00:00', '10:00:00', '15:00:00', '17:00:00', '18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '08:00:00', '11:00:00', '14:00:00', '15:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '09:00:00', '13:00:00', '14:00:00', '16:00:00', '18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '09:00:00', '10:00:00', '14:00:00', '19:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '09:00:00', '10:00:00', '14:00:00', '19:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '09:00:00', '10:00:00', '14:00:00', '19:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '07:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '17:00:00', '18:00:00', '19:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_05_31_012256_create_municipios_table', 1),
(2, '2014_05_14_193245_create_persona_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_05_14_203626_create_alumnos_table', 1),
(6, '2019_05_29_034645_create_docentes_table', 1),
(7, '2019_05_29_040039_create_nivels_table', 1),
(8, '2019_05_29_044744_create_periodos_table', 1),
(9, '2019_05_29_045009_create_horas_disponibles_table', 1),
(10, '2019_05_29_045110_create_aulas_table', 1),
(13, '2019_05_29_045230_create_grupos_table', 2),
(17, '2019_08_05_113456_create_alumnos_inscritos_table', 3),
(18, '2019_08_21_093829_create_boletas_table', 4),
(20, '2019_09_17_122244_create_historial_table', 5),
(22, '2019_09_25_001028_create_respuestas_table', 6),
(23, '2019_09_25_001519_create_preguntas_table', 6),
(24, '2019_09_25_002410_create_evaluacion_table', 6),
(26, '2019_09_25_003042_create_result-pregunta_table', 7),
(27, '2019_09_26_185154_create_catalog_respuestas_table', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` int(11) NOT NULL,
  `nombre_municipio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre_municipio`) VALUES
(1, 'Abejones'),
(2, 'Acatlán de Pérez Figueroa'),
(3, 'Asunción Cacalotepec'),
(4, 'Asunción Cuyotepeji'),
(5, 'Asunción Ixtaltepec'),
(6, 'Asunción Nochixtlán'),
(7, 'Asunción Ocotlán'),
(8, 'Asunción Tlacolulita'),
(9, 'Ayotzintepec'),
(10, 'El Barrio de la Soledad'),
(11, 'Calihualá'),
(12, 'Candelaria Loxicha'),
(13, 'Ciénega de Zimatlán'),
(14, 'Ciudad Ixtepec'),
(15, 'Coatecas Altas'),
(16, 'Coicoyán de las Flores'),
(17, 'La Compañía'),
(18, 'Concepción Buenavista'),
(19, 'Concepción Pápalo'),
(20, 'Constancia del Rosario'),
(21, 'Cosolapa'),
(22, 'Cosoltepec'),
(23, 'Cuilápam de Guerrero'),
(24, 'Cuyamecalco Villa de Zaragoza'),
(25, 'Chahuites'),
(26, 'Chalcatongo de Hidalgo'),
(27, 'Chiquihuitlán de Benito Juárez'),
(28, 'Heroica Ciudad de Ejutla de Crespo'),
(29, 'Eloxochitlán de Flores Magón'),
(30, 'El Espinal'),
(31, 'Tamazulápam del Espíritu Santo'),
(32, 'Fresnillo de Trujano'),
(33, 'Guadalupe Etla'),
(34, 'Guadalupe de Ramírez'),
(35, 'Guelatao de Juárez'),
(36, 'Guevea de Humboldt'),
(37, 'Mesones Hidalgo'),
(38, 'Villa Hidalgo'),
(39, 'Heroica Ciudad de Huajuapan de León'),
(40, 'Huautepec'),
(41, 'Huautla de Jiménez'),
(42, 'Ixtlán de Juárez'),
(43, 'Heroica Ciudad de Juchitán de Zaragoza'),
(44, 'Loma Bonita'),
(45, 'Magdalena Apasco'),
(46, 'Magdalena Jaltepec'),
(47, 'Santa Magdalena Jicotlán'),
(48, 'Magdalena Mixtepec'),
(49, 'Magdalena Ocotlán'),
(50, 'Magdalena Peñasco'),
(51, 'Magdalena Teitipac'),
(52, 'Magdalena Tequisistlán'),
(53, 'Magdalena Tlacotepec'),
(54, 'Magdalena Zahuatlán'),
(55, 'Mariscala de Juárez'),
(56, 'Mártires de Tacubaya'),
(57, 'Matías Romero Avendaño'),
(58, 'Mazatlán Villa de Flores'),
(59, 'Miahuatlán de Porfirio Díaz'),
(60, 'Mixistlán de la Reforma'),
(61, 'Monjas'),
(62, 'Natividad'),
(63, 'Nazareno Etla'),
(64, 'Nejapa de Madero'),
(65, 'Ixpantepec Nieves'),
(66, 'Santiago Niltepec'),
(67, 'Oaxaca de Juárez'),
(68, 'Ocotlán de Morelos'),
(69, 'La Pe'),
(70, 'Pinotepa de Don Luis'),
(71, 'Pluma Hidalgo'),
(72, 'San José del Progreso'),
(73, 'Putla Villa de Guerrero'),
(74, 'Santa Catarina Quioquitani'),
(75, 'Reforma de Pineda'),
(76, 'La Reforma'),
(77, 'Reyes Etla'),
(78, 'Rojas de Cuauhtémoc'),
(79, 'Salina Cruz'),
(80, 'San Agustín Amatengo'),
(81, 'San Agustín Atenango'),
(82, 'San Agustín Chayuco'),
(83, 'San Agustín de las Juntas'),
(84, 'San Agustín Etla'),
(85, 'San Agustín Loxicha'),
(86, 'San Agustín Tlacotepec'),
(87, 'San Agustín Yatareni'),
(88, 'San Andrés Cabecera Nueva'),
(89, 'San Andrés Dinicuiti'),
(90, 'San Andrés Huaxpaltepec'),
(91, 'San Andrés Huayápam'),
(92, 'San Andrés Ixtlahuaca'),
(93, 'San Andrés Lagunas'),
(94, 'San Andrés Nuxiño'),
(95, 'San Andrés Paxtlán'),
(96, 'San Andrés Sinaxtla'),
(97, 'San Andrés Solaga'),
(98, 'San Andrés Teotilálpam'),
(99, 'San Andrés Tepetlapa'),
(100, 'San Andrés Yaá'),
(101, 'San Andrés Zabache'),
(102, 'San Andrés Zautla'),
(103, 'San Antonino Castillo Velasco'),
(104, 'San Antonino el Alto'),
(105, 'San Antonino Monte Verde'),
(106, 'San Antonio Acutla'),
(107, 'San Antonio de la Cal'),
(108, 'San Antonio Huitepec'),
(109, 'San Antonio Nanahuatípam'),
(110, 'San Antonio Sinicahua'),
(111, 'San Antonio Tepetlapa'),
(112, 'San Baltazar Chichicápam'),
(113, 'San Baltazar Loxicha'),
(114, 'San Baltazar Yatzachi el Bajo'),
(115, 'San Bartolo Coyotepec'),
(116, 'San Bartolomé Ayautla'),
(117, 'San Bartolomé Loxicha'),
(118, 'San Bartolomé Quialana'),
(119, 'San Bartolomé Yucuañe'),
(120, 'San Bartolomé Zoogocho'),
(121, 'San Bartolo Soyaltepec'),
(122, 'San Bartolo Yautepec'),
(123, 'San Bernardo Mixtepec'),
(124, 'San Blas Atempa'),
(125, 'San Carlos Yautepec'),
(126, 'San Cristóbal Amatlán'),
(127, 'San Cristóbal Amoltepec'),
(128, 'San Cristóbal Lachirioag'),
(129, 'San Cristóbal Suchixtlahuaca'),
(130, 'San Dionisio del Mar'),
(131, 'San Dionisio Ocotepec'),
(132, 'San Dionisio Ocotlán'),
(133, 'San Esteban Atatlahuca'),
(134, 'San Felipe Jalapa de Díaz'),
(135, 'San Felipe Tejalápam'),
(136, 'San Felipe Usila'),
(137, 'San Francisco Cahuacuá'),
(138, 'San Francisco Cajonos'),
(139, 'San Francisco Chapulapa'),
(140, 'San Francisco Chindúa'),
(141, 'San Francisco del Mar'),
(142, 'San Francisco Huehuetlán'),
(143, 'San Francisco Ixhuatán'),
(144, 'San Francisco Jaltepetongo'),
(145, 'San Francisco Lachigoló'),
(146, 'San Francisco Logueche'),
(147, 'San Francisco Nuxaño'),
(148, 'San Francisco Ozolotepec'),
(149, 'San Francisco Sola'),
(150, 'San Francisco Telixtlahuaca'),
(151, 'San Francisco Teopan'),
(152, 'San Francisco Tlapancingo'),
(153, 'San Gabriel Mixtepec'),
(154, 'San Ildefonso Amatlán'),
(155, 'San Ildefonso Sola'),
(156, 'San Ildefonso Villa Alta'),
(157, 'San Jacinto Amilpas'),
(158, 'San Jacinto Tlacotepec'),
(159, 'San Jerónimo Coatlán'),
(160, 'San Jerónimo Silacayoapilla'),
(161, 'San Jerónimo Sosola'),
(162, 'San Jerónimo Taviche'),
(163, 'San Jerónimo Tecóatl'),
(164, 'San Jorge Nuchita'),
(165, 'San José Ayuquila'),
(166, 'San José Chiltepec'),
(167, 'San José del Peñasco'),
(168, 'San José Estancia Grande'),
(169, 'San José Independencia'),
(170, 'San José Lachiguiri'),
(171, 'San José Tenango'),
(172, 'San Juan Achiutla'),
(173, 'San Juan Atepec'),
(174, 'Ánimas Trujano'),
(175, 'San Juan Bautista Atatlahuca'),
(176, 'San Juan Bautista Coixtlahuaca'),
(177, 'San Juan Bautista Cuicatlán'),
(178, 'San Juan Bautista Guelache'),
(179, 'San Juan Bautista Jayacatlán'),
(180, 'San Juan Bautista Lo de Soto'),
(181, 'San Juan Bautista Suchitepec'),
(182, 'San Juan Bautista Tlacoatzintepec'),
(183, 'San Juan Bautista Tlachichilco'),
(184, 'San Juan Bautista Tuxtepec'),
(185, 'San Juan Cacahuatepec'),
(186, 'San Juan Cieneguilla'),
(187, 'San Juan Coatzóspam'),
(188, 'San Juan Colorado'),
(189, 'San Juan Comaltepec'),
(190, 'San Juan Cotzocón'),
(191, 'San Juan Chicomezúchil'),
(192, 'San Juan Chilateca'),
(193, 'San Juan del Estado'),
(194, 'San Juan del Río'),
(195, 'San Juan Diuxi'),
(196, 'San Juan Evangelista Analco'),
(197, 'San Juan Guelavía'),
(198, 'San Juan Guichicovi'),
(199, 'San Juan Ihualtepec'),
(200, 'San Juan Juquila Mixes'),
(201, 'San Juan Juquila Vijanos'),
(202, 'San Juan Lachao'),
(203, 'San Juan Lachigalla'),
(204, 'San Juan Lajarcia'),
(205, 'San Juan Lalana'),
(206, 'San Juan de los Cués'),
(207, 'San Juan Mazatlán'),
(208, 'San Juan Mixtepec'),
(209, 'San Juan Mixtepec'),
(210, 'San Juan Ñumí'),
(211, 'San Juan Ozolotepec'),
(212, 'San Juan Petlapa'),
(213, 'San Juan Quiahije'),
(214, 'San Juan Quiotepec'),
(215, 'San Juan Sayultepec'),
(216, 'San Juan Tabaá'),
(217, 'San Juan Tamazola'),
(218, 'San Juan Teita'),
(219, 'San Juan Teitipac'),
(220, 'San Juan Tepeuxila'),
(221, 'San Juan Teposcolula'),
(222, 'San Juan Yaeé'),
(223, 'San Juan Yatzona'),
(224, 'San Juan Yucuita'),
(225, 'San Lorenzo'),
(226, 'San Lorenzo Albarradas'),
(227, 'San Lorenzo Cacaotepec'),
(228, 'San Lorenzo Cuaunecuiltitla'),
(229, 'San Lorenzo Texmelúcan'),
(230, 'San Lorenzo Victoria'),
(231, 'San Lucas Camotlán'),
(232, 'San Lucas Ojitlán'),
(233, 'San Lucas Quiaviní'),
(234, 'San Lucas Zoquiápam'),
(235, 'San Luis Amatlán'),
(236, 'San Marcial Ozolotepec'),
(237, 'San Marcos Arteaga'),
(238, 'San Martín de los Cansecos'),
(239, 'San Martín Huamelúlpam'),
(240, 'San Martín Itunyoso'),
(241, 'San Martín Lachilá'),
(242, 'San Martín Peras'),
(243, 'San Martín Tilcajete'),
(244, 'San Martín Toxpalan'),
(245, 'San Martín Zacatepec'),
(246, 'San Mateo Cajonos'),
(247, 'Capulálpam de Méndez'),
(248, 'San Mateo del Mar'),
(249, 'San Mateo Yoloxochitlán'),
(250, 'San Mateo Etlatongo'),
(251, 'San Mateo Nejápam'),
(252, 'San Mateo Peñasco'),
(253, 'San Mateo Piñas'),
(254, 'San Mateo Río Hondo'),
(255, 'San Mateo Sindihui'),
(256, 'San Mateo Tlapiltepec'),
(257, 'San Melchor Betaza'),
(258, 'San Miguel Achiutla'),
(259, 'San Miguel Ahuehuetitlán'),
(260, 'San Miguel Aloápam'),
(261, 'San Miguel Amatitlán'),
(262, 'San Miguel Amatlán'),
(263, 'San Miguel Coatlán'),
(264, 'San Miguel Chicahua'),
(265, 'San Miguel Chimalapa'),
(266, 'San Miguel del Puerto'),
(267, 'San Miguel del Río'),
(268, 'San Miguel Ejutla'),
(269, 'San Miguel el Grande'),
(270, 'San Miguel Huautla'),
(271, 'San Miguel Mixtepec'),
(272, 'San Miguel Panixtlahuaca'),
(273, 'San Miguel Peras'),
(274, 'San Miguel Piedras'),
(275, 'San Miguel Quetzaltepec'),
(276, 'San Miguel Santa Flor'),
(277, 'Villa Sola de Vega'),
(278, 'San Miguel Soyaltepec'),
(279, 'San Miguel Suchixtepec'),
(280, 'Villa Talea de Castro'),
(281, 'San Miguel Tecomatlán'),
(282, 'San Miguel Tenango'),
(283, 'San Miguel Tequixtepec'),
(284, 'San Miguel Tilquiápam'),
(285, 'San Miguel Tlacamama'),
(286, 'San Miguel Tlacotepec'),
(287, 'San Miguel Tulancingo'),
(288, 'San Miguel Yotao'),
(289, 'San Nicolás'),
(290, 'San Nicolás Hidalgo'),
(291, 'San Pablo Coatlán'),
(292, 'San Pablo Cuatro Venados'),
(293, 'San Pablo Etla'),
(294, 'San Pablo Huitzo'),
(295, 'San Pablo Huixtepec'),
(296, 'San Pablo Macuiltianguis'),
(297, 'San Pablo Tijaltepec'),
(298, 'San Pablo Villa de Mitla'),
(299, 'San Pablo Yaganiza'),
(300, 'San Pedro Amuzgos'),
(301, 'San Pedro Apóstol'),
(302, 'San Pedro Atoyac'),
(303, 'San Pedro Cajonos'),
(304, 'San Pedro Coxcaltepec Cántaros'),
(305, 'San Pedro Comitancillo'),
(306, 'San Pedro el Alto'),
(307, 'San Pedro Huamelula'),
(308, 'San Pedro Huilotepec'),
(309, 'San Pedro Ixcatlán'),
(310, 'San Pedro Ixtlahuaca'),
(311, 'San Pedro Jaltepetongo'),
(312, 'San Pedro Jicayán'),
(313, 'San Pedro Jocotipac'),
(314, 'San Pedro Juchatengo'),
(315, 'San Pedro Mártir'),
(316, 'San Pedro Mártir Quiechapa'),
(317, 'San Pedro Mártir Yucuxaco'),
(318, 'San Pedro Mixtepec'),
(319, 'San Pedro Mixtepec'),
(320, 'San Pedro Molinos'),
(321, 'San Pedro Nopala'),
(322, 'San Pedro Ocopetatillo'),
(323, 'San Pedro Ocotepec'),
(324, 'San Pedro Pochutla'),
(325, 'San Pedro Quiatoni'),
(326, 'San Pedro Sochiápam'),
(327, 'San Pedro Tapanatepec'),
(328, 'San Pedro Taviche'),
(329, 'San Pedro Teozacoalco'),
(330, 'San Pedro Teutila'),
(331, 'San Pedro Tidaá'),
(332, 'San Pedro Topiltepec'),
(333, 'San Pedro Totolápam'),
(334, 'Villa de Tututepec de Melchor Ocampo'),
(335, 'San Pedro Yaneri'),
(336, 'San Pedro Yólox'),
(337, 'San Pedro y San Pablo Ayutla'),
(338, 'Villa de Etla'),
(339, 'San Pedro y San Pablo Teposcolula'),
(340, 'San Pedro y San Pablo Tequixtepec'),
(341, 'San Pedro Yucunama'),
(342, 'San Raymundo Jalpan'),
(343, 'San Sebastián Abasolo'),
(344, 'San Sebastián Coatlán'),
(345, 'San Sebastián Ixcapa'),
(346, 'San Sebastián Nicananduta'),
(347, 'San Sebastián Río Hondo'),
(348, 'San Sebastián Tecomaxtlahuaca'),
(349, 'San Sebastián Teitipac'),
(350, 'San Sebastián Tutla'),
(351, 'San Simón Almolongas'),
(352, 'San Simón Zahuatlán'),
(353, 'Santa Ana'),
(354, 'Santa Ana Ateixtlahuaca'),
(355, 'Santa Ana Cuauhtémoc'),
(356, 'Santa Ana del Valle'),
(357, 'Santa Ana Tavela'),
(358, 'Santa Ana Tlapacoyan'),
(359, 'Santa Ana Yareni'),
(360, 'Santa Ana Zegache'),
(361, 'Santa Catalina Quierí'),
(362, 'Santa Catarina Cuixtla'),
(363, 'Santa Catarina Ixtepeji'),
(364, 'Santa Catarina Juquila'),
(365, 'Santa Catarina Lachatao'),
(366, 'Santa Catarina Loxicha'),
(367, 'Santa Catarina Mechoacán'),
(368, 'Santa Catarina Minas'),
(369, 'Santa Catarina Quiané'),
(370, 'Santa Catarina Tayata'),
(371, 'Santa Catarina Ticuá'),
(372, 'Santa Catarina Yosonotú'),
(373, 'Santa Catarina Zapoquila'),
(374, 'Santa Cruz Acatepec'),
(375, 'Santa Cruz Amilpas'),
(376, 'Santa Cruz de Bravo'),
(377, 'Santa Cruz Itundujia'),
(378, 'Santa Cruz Mixtepec'),
(379, 'Santa Cruz Nundaco'),
(380, 'Santa Cruz Papalutla'),
(381, 'Santa Cruz Tacache de Mina'),
(382, 'Santa Cruz Tacahua'),
(383, 'Santa Cruz Tayata'),
(384, 'Santa Cruz Xitla'),
(385, 'Santa Cruz Xoxocotlán'),
(386, 'Santa Cruz Zenzontepec'),
(387, 'Santa Gertrudis'),
(388, 'Santa Inés del Monte'),
(389, 'Santa Inés Yatzeche'),
(390, 'Santa Lucía del Camino'),
(391, 'Santa Lucía Miahuatlán'),
(392, 'Santa Lucía Monteverde'),
(393, 'Santa Lucía Ocotlán'),
(394, 'Santa María Alotepec'),
(395, 'Santa María Apazco'),
(396, 'Santa María la Asunción'),
(397, 'Heroica Ciudad de Tlaxiaco'),
(398, 'Ayoquezco de Aldama'),
(399, 'Santa María Atzompa'),
(400, 'Santa María Camotlán'),
(401, 'Santa María Colotepec'),
(402, 'Santa María Cortijo'),
(403, 'Santa María Coyotepec'),
(404, 'Santa María Chachoápam'),
(405, 'Villa de Chilapa de Díaz'),
(406, 'Santa María Chilchotla'),
(407, 'Santa María Chimalapa'),
(408, 'Santa María del Rosario'),
(409, 'Santa María del Tule'),
(410, 'Santa María Ecatepec'),
(411, 'Santa María Guelacé'),
(412, 'Santa María Guienagati'),
(413, 'Santa María Huatulco'),
(414, 'Santa María Huazolotitlán'),
(415, 'Santa María Ipalapa'),
(416, 'Santa María Ixcatlán'),
(417, 'Santa María Jacatepec'),
(418, 'Santa María Jalapa del Marqués'),
(419, 'Santa María Jaltianguis'),
(420, 'Santa María Lachixío'),
(421, 'Santa María Mixtequilla'),
(422, 'Santa María Nativitas'),
(423, 'Santa María Nduayaco'),
(424, 'Santa María Ozolotepec'),
(425, 'Santa María Pápalo'),
(426, 'Santa María Peñoles'),
(427, 'Santa María Petapa'),
(428, 'Santa María Quiegolani'),
(429, 'Santa María Sola'),
(430, 'Santa María Tataltepec'),
(431, 'Santa María Tecomavaca'),
(432, 'Santa María Temaxcalapa'),
(433, 'Santa María Temaxcaltepec'),
(434, 'Santa María Teopoxco'),
(435, 'Santa María Tepantlali'),
(436, 'Santa María Texcatitlán'),
(437, 'Santa María Tlahuitoltepec'),
(438, 'Santa María Tlalixtac'),
(439, 'Santa María Tonameca'),
(440, 'Santa María Totolapilla'),
(441, 'Santa María Xadani'),
(442, 'Santa María Yalina'),
(443, 'Santa María Yavesía'),
(444, 'Santa María Yolotepec'),
(445, 'Santa María Yosoyúa'),
(446, 'Santa María Yucuhiti'),
(447, 'Santa María Zacatepec'),
(448, 'Santa María Zaniza'),
(449, 'Santa María Zoquitlán'),
(450, 'Santiago Amoltepec'),
(451, 'Santiago Apoala'),
(452, 'Santiago Apóstol'),
(453, 'Santiago Astata'),
(454, 'Santiago Atitlán'),
(455, 'Santiago Ayuquililla'),
(456, 'Santiago Cacaloxtepec'),
(457, 'Santiago Camotlán'),
(458, 'Santiago Comaltepec'),
(459, 'Santiago Chazumba'),
(460, 'Santiago Choápam'),
(461, 'Santiago del Río'),
(462, 'Santiago Huajolotitlán'),
(463, 'Santiago Huauclilla'),
(464, 'Santiago Ihuitlán Plumas'),
(465, 'Santiago Ixcuintepec'),
(466, 'Santiago Ixtayutla'),
(467, 'Santiago Jamiltepec'),
(468, 'Santiago Jocotepec'),
(469, 'Santiago Juxtlahuaca'),
(470, 'Santiago Lachiguiri'),
(471, 'Santiago Lalopa'),
(472, 'Santiago Laollaga'),
(473, 'Santiago Laxopa'),
(474, 'Santiago Llano Grande'),
(475, 'Santiago Matatlán'),
(476, 'Santiago Miltepec'),
(477, 'Santiago Minas'),
(478, 'Santiago Nacaltepec'),
(479, 'Santiago Nejapilla'),
(480, 'Santiago Nundiche'),
(481, 'Santiago Nuyoó'),
(482, 'Santiago Pinotepa Nacional'),
(483, 'Santiago Suchilquitongo'),
(484, 'Santiago Tamazola'),
(485, 'Santiago Tapextla'),
(486, 'Villa Tejúpam de la Unión'),
(487, 'Santiago Tenango'),
(488, 'Santiago Tepetlapa'),
(489, 'Santiago Tetepec'),
(490, 'Santiago Texcalcingo'),
(491, 'Santiago Textitlán'),
(492, 'Santiago Tilantongo'),
(493, 'Santiago Tillo'),
(494, 'Santiago Tlazoyaltepec'),
(495, 'Santiago Xanica'),
(496, 'Santiago Xiacuí'),
(497, 'Santiago Yaitepec'),
(498, 'Santiago Yaveo'),
(499, 'Santiago Yolomécatl'),
(500, 'Santiago Yosondúa'),
(501, 'Santiago Yucuyachi'),
(502, 'Santiago Zacatepec'),
(503, 'Santiago Zoochila'),
(504, 'Nuevo Zoquiápam'),
(505, 'Santo Domingo Ingenio'),
(506, 'Santo Domingo Albarradas'),
(507, 'Santo Domingo Armenta'),
(508, 'Santo Domingo Chihuitán'),
(509, 'Santo Domingo de Morelos'),
(510, 'Santo Domingo Ixcatlán'),
(511, 'Santo Domingo Nuxaá'),
(512, 'Santo Domingo Ozolotepec'),
(513, 'Santo Domingo Petapa'),
(514, 'Santo Domingo Roayaga'),
(515, 'Santo Domingo Tehuantepec'),
(516, 'Santo Domingo Teojomulco'),
(517, 'Santo Domingo Tepuxtepec'),
(518, 'Santo Domingo Tlatayápam'),
(519, 'Santo Domingo Tomaltepec'),
(520, 'Santo Domingo Tonalá'),
(521, 'Santo Domingo Tonaltepec'),
(522, 'Santo Domingo Xagacía'),
(523, 'Santo Domingo Yanhuitlán'),
(524, 'Santo Domingo Yodohino'),
(525, 'Santo Domingo Zanatepec'),
(526, 'Santos Reyes Nopala'),
(527, 'Santos Reyes Pápalo'),
(528, 'Santos Reyes Tepejillo'),
(529, 'Santos Reyes Yucuná'),
(530, 'Santo Tomás Jalieza'),
(531, 'Santo Tomás Mazaltepec'),
(532, 'Santo Tomás Ocotepec'),
(533, 'Santo Tomás Tamazulapan'),
(534, 'San Vicente Coatlán'),
(535, 'San Vicente Lachixío'),
(536, 'San Vicente Nuñú'),
(537, 'Silacayoápam'),
(538, 'Sitio de Xitlapehua'),
(539, 'Soledad Etla'),
(540, 'Villa de Tamazulápam del Progreso'),
(541, 'Tanetze de Zaragoza'),
(542, 'Taniche'),
(543, 'Tataltepec de Valdés'),
(544, 'Teococuilco de Marcos Pérez'),
(545, 'Teotitlán de Flores Magón'),
(546, 'Teotitlán del Valle'),
(547, 'Teotongo'),
(548, 'Tepelmeme Villa de Morelos'),
(549, 'Heroica Villa Tezoatlán de Segura y Luna'),
(550, 'San Jerónimo Tlacochahuaya'),
(551, 'Tlacolula de Matamoros'),
(552, 'Tlacotepec Plumas'),
(553, 'Tlalixtac de Cabrera'),
(554, 'Totontepec Villa de Morelos'),
(555, 'Trinidad Zaachila'),
(556, 'La Trinidad Vista Hermosa'),
(557, 'Unión Hidalgo'),
(558, 'Valerio Trujano'),
(559, 'San Juan Bautista Valle Nacional'),
(560, 'Villa Díaz Ordaz'),
(561, 'Yaxe'),
(562, 'Magdalena Yodocono de Porfirio Díaz'),
(563, 'Yogana'),
(564, 'Yutanduchi de Guerrero'),
(565, 'Villa de Zaachila'),
(566, 'San Mateo Yucutindoo'),
(567, 'Zapotitlán Lagunas'),
(568, 'Zapotitlán Palmas'),
(569, 'Santa Inés de Zaragoza'),
(570, 'Zimatlán de Álvarez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivels`
--

CREATE TABLE `nivels` (
  `id_nivel` int(10) UNSIGNED NOT NULL,
  `nivel` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modulo` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idioma` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nivels`
--

INSERT INTO `nivels` (`id_nivel`, `nivel`, `modulo`, `idioma`, `deleted_at`) VALUES
(1, 'A1', 'M1', 'Inglés', NULL),
(2, 'A1', 'M2', 'Inglés', '2019-07-06 03:26:04'),
(3, 'A2', 'M1', 'Inglés', NULL),
(4, 'A2', 'M2', 'Inglés', NULL),
(5, 'B1', 'M1', 'Inglés', NULL),
(6, 'B1', 'M2', 'Inglés', NULL),
(7, 'B2', 'M1', 'Inglés', '2019-07-06 03:26:16'),
(8, 'B2', 'M2', 'Inglés', '2019-06-25 23:18:43'),
(9, 'A1', 'M1', 'Inglés', '2019-07-06 03:26:00'),
(10, 'B2', 'M1', 'Inglés', '2019-07-25 01:28:02'),
(11, 'B2', 'M2', 'Inglés', '2019-07-25 02:52:15'),
(12, 'C1', 'M1', 'iNGLES', '2019-07-25 01:34:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `id_periodo` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anio` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`id_periodo`, `descripcion`, `anio`, `deleted_at`) VALUES
(1, 'ENE-JUN', 2019, NULL),
(2, 'AGO-DIC', 2019, NULL),
(3, 'ENE-JUN', 2020, NULL),
(4, 'Verano', 2019, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `curp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_paterno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_materno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calle` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `colonia` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipio` int(11) NOT NULL,
  `cp` int(11) NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edad` smallint(6) NOT NULL,
  `sexo` enum('F','M') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('alumno','docente','coordinador') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'alumno',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`curp`, `nombres`, `ap_paterno`, `ap_materno`, `calle`, `numero`, `colonia`, `municipio`, `cp`, `telefono`, `edad`, `sexo`, `tipo`, `deleted_at`, `created_at`, `updated_at`) VALUES
('65789iygvbhj98u', 'okdjs', 'lksjlak', 'lksjdkd', 'lkjsalkj3', 323, 'jiokals', 6, 0, '23456789', 56, 'M', 'docente', NULL, NULL, NULL),
('AESP931001MOCSSN02', 'Personita', 'Apellido', 'Segundo Apellido', 'Robles', 24, 'Arboledas', 3, 0, '1234567890', 23, 'M', 'docente', NULL, '2019-07-18 03:51:41', '2019-07-18 12:14:18'),
('AIJM931001MOCSSN01', 'klajkj', 'kjalk', 'kjlak', 'kjdlakj', 12, 'kajjk', 3, 0, '23456789', 12, 'F', 'docente', NULL, '2019-07-18 03:46:10', '2019-07-18 03:46:10'),
('ALSKJLKJ', 'eeeeee', 'lkajk', 'kjakja', 'jlakjda', 23, 'kjkaj', 5, 0, '7890', 90, 'F', 'alumno', NULL, '2019-07-17 10:59:36', '2019-07-17 10:59:36'),
('ASKJLA', 'qqqq', 'kajljda', 'kjaj', 'kajlak', 322, 'klajl', 2, 0, '7890', 23, 'F', 'docente', NULL, '2019-07-17 11:06:04', '2019-07-17 11:06:04'),
('CUFM770826MMSRLR35', 'Guadalupe', 'Cruz', 'Flores', 'Tierra', 32, 'Oaxaca', 67, 32323, '322323223332', 23, 'F', 'docente', NULL, '2019-10-04 07:14:59', '2019-10-04 07:14:59'),
('CUGA980412MCMRRR85', 'Ana', 'Cruz', 'Garza', 'Jazminez', 321, 'Flores', 10, 392929, '9383930902', 20, 'F', 'alumno', NULL, '2019-10-08 18:14:20', '2019-10-08 18:14:20'),
('EEIE881105HOCSSN01', 'Kevin', 'Jonas', NULL, 'www', 111, 'www', 14, 0, '1111', 32, 'M', 'alumno', NULL, '2019-09-17 20:41:08', '2019-09-17 20:41:08'),
('EIME921021MOCSSN01', 'Esmeralda', 'Ramirez', 'Lopez', 'KRJFAJKJAL', 390, 'KLJKJA', 6, 0, '23452', 23, 'M', 'alumno', NULL, '2019-07-04 09:16:41', '2019-07-04 09:16:41'),
('EIMM770826HDFSRR54', 'María Luisa', 'Espinoza', 'Martinez', 'iiiioiooioio', 33, 'jjjjjjjj', 67, 0, '222222222', 22, 'F', 'alumno', NULL, '2019-09-23 05:26:38', '2019-09-23 05:26:38'),
('EIMV931001MOCSSN08', 'skjdkaj', 'kjlaskjd', 'kjlskdjka', 'JKJLDLKFJlksj', 39, 'lskdjl', 3, 0, '789987', 93, 'F', 'alumno', '2019-07-04 09:19:06', '2019-07-04 09:18:37', '2019-07-04 09:19:06'),
('EIVA900304MOCSSN01', 'Adriana', 'Espina', 'Vasquez', 'YUIO', 23, 'HJIKL', 9, 0, '12345678876543', 26, 'F', 'alumno', NULL, '2019-07-04 02:43:28', '2019-07-04 02:43:28'),
('EIVM601212MOCSSN01', 'Carmen', 'Vasquez', 'Hernandez', 'Camino Nacional', 120, 'Morelos', 14, 0, '1234567890', 60, 'M', 'alumno', NULL, '2019-07-04 01:39:22', '2019-07-10 11:08:05'),
('EIVM781001MOCSSN01', 'Hello', 'hello', 'hello', 'dfghjkl', 56789, 'fghjkl', 7, 0, '678900', 67, 'M', 'alumno', '2019-07-18 12:40:18', NULL, '2019-07-18 12:40:18'),
('EIVM831001MOCSSN01', 'Hola', 'alkjl', 'kajl', 'KSJAKJ', 323, 'lksaj', 4, 0, '78908', 12, 'F', 'alumno', '2019-08-21 13:32:15', '2019-07-19 11:36:21', '2019-08-21 13:32:15'),
('EIVM921001MOCSSN01', 'Fresa', 'dklsjlk', 'lksajlk', 'JKLSDKlkajlk', 9089, 'jlskdjlkaj', 5, 0, '2345', 23, 'F', 'alumno', '2019-07-11 11:19:52', '2019-07-04 12:22:59', '2019-07-11 11:19:52'),
('EIVM931001MOCSSN01', 'kllsdjkljjls', 'kjsdlkja', 'kslkdj', 'lksdjla', 234, 'kjaslkd', 10, 0, '897987', 98, 'F', 'alumno', '2019-07-10 14:00:04', '2019-07-04 10:06:23', '2019-07-10 14:00:04'),
('EIVM931001MOCSSN05', 'Alicia', 'Reyes', 'Montes', 'Norte 1', 934, 'Reforma', 21, 0, '9238719829', 42, 'F', 'docente', NULL, '2019-06-20 05:12:48', '2019-06-20 05:12:48'),
('EIVM931001MOCSSN06', 'Jesus', 'Bautista', 'Alderete', 'Las Rosas', 2, 'Morelos', 2, 0, '123456789', 23, 'M', 'docente', NULL, '2019-06-11 23:51:53', '2019-07-16 04:25:22'),
('EIVM931001MOCSSN07', 'Monica', 'Espina', 'Vasquez', 'Norte 1', 23, 'Reforma', 6, 0, '23456789', 23, 'F', 'alumno', NULL, '2019-08-30 17:35:09', '2019-08-30 17:35:09'),
('EIVM931002MOCSNN01', 'hola', 'ldkslk', 'kjfls', 'kfjdlkaj', 90, 'kdjalkj', 3, 0, '567890', 32, 'F', 'alumno', NULL, '2019-07-17 10:43:27', '2019-07-17 10:43:27'),
('EIVM931003MOCSSN01', 'holados', 'lakja', 'kajkj', 'ksja', 32, 'lkasj', 3, 0, '7890', 23, 'F', 'alumno', NULL, '2019-07-17 10:51:50', '2019-07-17 10:51:50'),
('EIVM931101MOCSSN01', 'aaaaa', 'jfasdkj', 'lkajl', 'lkdsaj', 32, 'kajak', 1, 0, '7890', 89, 'F', 'docente', NULL, '2019-07-17 10:55:46', '2019-07-17 10:55:46'),
('EIVM991001MOCSSN01', 'Roberto', 'Castellanos', NULL, 'wedfgh', 123, 'asdfgf', 15, 0, '234562', 22, 'M', 'alumno', NULL, '2019-09-17 19:02:56', '2019-09-17 19:02:56'),
('fjls05mk', 'Cordia', 'Breitenberg', 'Stark', 'iste', 664, 'porro', 531, 0, '(855) 762-6593', 59, 'M', 'docente', NULL, '2019-06-11 21:59:53', '2019-06-11 21:59:53'),
('fjls05os', 'Dwight', 'Bernhard', 'Dickens', 'vel', 192, 'voluptates', 95, 0, '877-962-9040', 50, 'F', 'docente', NULL, '2019-06-11 21:59:51', '2019-06-11 21:59:51'),
('fjls08zm', 'Hildegard', 'Herzog', 'Veum', 'soluta', 993, 'laudantium', 505, 0, '1-855-799-9604', 22, 'F', 'alumno', NULL, '2019-06-11 21:59:52', '2019-06-11 21:59:52'),
('fjls09jz', 'Jose', 'Kunde', 'Cormier', 'ut', 698, 'architecto', 558, 0, '1-877-788-1711', 76, 'F', 'alumno', NULL, '2019-06-11 21:59:53', '2019-06-11 21:59:53'),
('fjls11im', 'Adell', 'Schimmel', 'Ullrich', 'unde', 673, 'maiores', 81, 0, '1-888-735-4867', 24, 'F', 'alumno', NULL, '2019-06-11 21:59:52', '2019-06-11 21:59:52'),
('fjls15lf', 'Maxwell', 'Gibson', 'Russel', 'ut', 40, 'eos', 164, 0, '1-800-737-5809', 59, 'F', 'alumno', '2019-06-22 05:37:20', '2019-06-11 21:59:52', '2019-06-22 05:37:20'),
('fjls16ce', 'Ellis', 'Waters', 'Spencer', 'quis', 749, 'excepturi', 243, 0, '1-888-476-4119', 52, 'F', 'alumno', NULL, '2019-06-11 21:59:50', '2019-06-11 21:59:50'),
('fjls17bm', 'Danika', 'Runolfsson', 'Stracke', 'similique', 13, 'est', 170, 0, '877-317-6602', 54, 'F', 'alumno', NULL, '2019-06-11 21:59:53', '2019-06-11 21:59:53'),
('fjls34nt', 'Ulices', 'Hansen', 'Murphy', 'dolor', 288, 'neque', 252, 0, '844-693-8182', 34, 'M', 'alumno', '2019-07-11 06:57:05', '2019-06-11 21:59:51', '2019-07-11 06:57:05'),
('fjls38av', 'Joanne', 'Blanda', 'Jacobson', 'hic', 80, 'ducimus', 390, 0, '1-866-941-8634', 47, 'M', 'docente', NULL, '2019-06-11 21:59:51', '2019-06-11 21:59:51'),
('fjls41px', 'Dominic', 'Ratke', 'Breitenberg', 'autem', 126, 'ea', 21, 0, '8004238278', 36, 'M', 'alumno', NULL, '2019-06-11 21:59:50', '2019-09-17 17:56:55'),
('fjls45wp', 'Aracely', 'Marvin', 'Cummerata', 'ullam', 714, 'hic', 262, 0, '888-930-8850', 63, 'M', 'alumno', NULL, '2019-06-11 21:59:53', '2019-06-11 21:59:53'),
('fjls56pe', 'Sam', 'Abshire', 'Bailey', 'voluptate', 159, 'voluptas', 566, 0, '877.961.9264', 10, 'F', 'alumno', NULL, '2019-06-11 21:59:52', '2019-06-11 21:59:52'),
('fjls58gf', 'Yessenia', 'Greenholt', 'Stokes', 'est', 220, 'ut', 35, 0, '1-877-322-4622', 41, 'F', 'alumno', NULL, '2019-06-11 21:59:52', '2019-06-11 21:59:52'),
('fjls61jc', 'Ezekiel', 'Cartwright', 'Pfeffer', 'officiis', 981, 'itaque', 523, 0, '(844) 380-6755', 69, 'F', 'docente', NULL, '2019-06-11 21:59:53', '2019-06-11 21:59:53'),
('fjls62is', 'Aliyah', 'Rutherford', 'Lynch', 'similique', 6, 'consectetur', 107, 0, '1-800-925-7739', 42, 'M', 'docente', NULL, '2019-06-11 21:59:51', '2019-06-11 21:59:51'),
('fjls64qo', 'Arvel', 'Stanton', 'Price', 'deserunt', 420, 'molestiae', 148, 0, '(877) 849-0193', 53, 'M', 'docente', NULL, '2019-06-11 21:59:51', '2019-06-11 21:59:51'),
('fjls68ly', 'Raven', 'Hessel', 'Kiehn', 'inventore', 278, 'deleniti', 415, 0, '8889453967', 72, 'M', 'alumno', NULL, '2019-06-11 21:59:50', '2019-07-18 13:20:42'),
('fjls70cw', 'Yvonne', 'Brown', 'Kulas', 'accusamus', 4, 'excepturi', 87, 0, '877-282-3325', 80, 'F', 'alumno', NULL, '2019-06-11 21:59:52', '2019-06-11 21:59:52'),
('fjls94mf', 'Trever', 'Wolff', 'Rowe', 'itaque', 0, 'animi', 29, 0, '(844) 854-5796', 4, 'M', 'alumno', NULL, '2019-06-11 21:59:50', '2019-06-11 21:59:50'),
('FOVA980823HGTLSN96', 'Miguel', 'Flores', 'Vasquez', 'Guanajuato', 321, 'Mexico', 70, 848899, '832984923809', 22, 'M', 'alumno', NULL, '2019-10-08 18:06:59', '2019-10-08 18:06:59'),
('GAGG941124HOCRRL01', 'Ricardo', 'Garcia', 'Garcia', 'Palmeras', 302, 'Llano Verde', 14, 0, '234567898765', 24, 'M', 'alumno', NULL, '2019-07-18 13:18:50', '2019-09-20 17:32:35'),
('GAGR951124HOCSSN02', 'Ricardo', 'Garcia', 'Garcia', 'Palmeras', 100, 'Llano Verde', 375, 0, '9511967690', 24, 'M', 'docente', NULL, '2019-06-20 05:48:38', '2019-06-20 05:48:38'),
('GOMM991205MNTMRR11', 'Marcela', 'Gómez', 'Martínez', 'fsdkjakj', 332, 'kjdlskj', 15, 0, '809809', 23, 'M', 'alumno', NULL, '2019-09-20 16:41:53', '2019-09-20 17:23:50'),
('GUAM770826HSRZGR11', 'María de los Angeles', 'Guzman', 'Aguilar', 'yyyyyy', 88888, 'yyyyyyy', 28, 0, '77777777', 21, 'F', 'alumno', NULL, '2019-09-23 06:21:54', '2019-09-23 06:21:54'),
('GURA770826HBCTDL22', 'Alejandro', 'Gutierrez', 'Rodriguez', 'Nogales', 12, 'Flores', 75, 68932, '9303939290', 22, 'M', 'alumno', NULL, '2019-10-07 08:16:35', '2019-10-07 08:16:35'),
('GUSA770826MNLTTN26', 'Antonia', 'Gutierrez', 'Soto', 'iiiiiiii', 9899, 'iiiiiii', 11, 0, '9999999999', 32, 'F', 'alumno', NULL, '2019-09-23 05:21:22', '2019-09-23 05:21:22'),
('HEVM931001MOCSSN01', 'Holita', 'Holita', 'Holita', 'kajkj', 23, 'lkaj', 3, 0, '56789', 12, 'F', 'alumno', '2019-07-18 13:09:15', '2019-07-18 11:53:16', '2019-07-18 13:09:15'),
('IIVM931001MOCSSN01', 'Ivanna', 'Espina', 'Hernandez', 'lkdjlkajlkjla', 32, 'jlksdjkl', 5, 0, '2345678', 31, 'F', 'alumno', NULL, '2019-07-04 03:02:05', '2019-07-04 03:02:05'),
('JKSAJLAKJ', 'wwwwwwwww', 'lkdsajlkj', 'jkaldkjal', 'LKASJDLA', 90, 'laksja', 4, 0, '56789', 90, 'F', 'docente', NULL, '2019-07-17 11:07:03', '2019-07-17 11:07:03'),
('JLAKJ', 'ajaj', 'kljlakj', 'kjal', 'lakjda', 32, 'kldjlakj', 3, 0, '6789098', 90, 'F', 'docente', '2019-07-18 13:33:27', '2019-07-18 12:23:41', '2019-07-18 13:33:27'),
('LKJDSL', 'dijlj', 'lksdjl', 'lkjsdl', 'klsdal', 11, 'kfdjlkj', 1, 0, '890', 21, 'F', 'alumno', NULL, '2019-07-17 10:40:39', '2019-07-17 10:40:39'),
('LOGL770826HBCPRT25', 'Leticia', 'López', 'García', 'Baja California', 89, 'México', 6, 68100, '8029340298409', 23, 'F', 'alumno', NULL, '2019-10-07 08:02:46', '2019-10-07 08:02:46'),
('LOGM770826HTCPZR85', 'María Elena', 'López', 'Gúzman', 'jdjdjdjdjd', 2222, 'jdjdjdjdj', 49, 0, '88282828282', 21, 'F', 'alumno', NULL, '2019-09-23 05:28:52', '2019-09-23 05:28:52'),
('MOGA770826MNLRTN17', 'Angel', 'Moreno', 'Gutierrez', 'Oriente 3', 3392, 'Morelos', 10, 89382, '023902938', 12, 'M', 'alumno', NULL, '2019-10-07 08:31:05', '2019-10-07 08:31:05'),
('MOGR770826HTCRNC29', 'Raul', 'Herrera', 'Morales', 'Mexico', 32, 'America', 7, 828289, '88293939232', 23, 'M', 'alumno', NULL, '2019-10-08 18:03:22', '2019-10-08 18:03:22'),
('NIEC920916HOCSSN01', 'Nick', 'Jonas', 'Miller', 'qqqq', 333, 'qqqq', 52, 0, '11111', 27, 'M', 'alumno', NULL, '2019-09-17 20:37:11', '2019-09-17 20:37:11'),
('NIUG891220MOCSSN58', 'Gloria', 'Nuñez', 'Alvarez', 'Martires de Chicago', 500, 'Reforma Agraria', 7, 932920, '3039093029', 30, 'M', 'alumno', NULL, '2019-10-08 18:17:28', '2019-10-08 18:17:28'),
('OIAA770826HGTRLR39', 'Arturo', 'Ortiz', 'Alvarez', 'qqqqq', 11, 'qqqqqq', 16, 0, '8383838383', 20, 'M', 'alumno', NULL, '2019-09-23 06:25:50', '2019-09-23 06:25:50'),
('OIMA770826MCLRNL68', 'Alfredo', 'Ortiz', 'Mendoza', 'ddddddd', 444444, 'dddddd', 65, 0, '77777777', 19, 'M', 'alumno', NULL, '2019-09-23 06:27:05', '2019-09-23 06:27:05'),
('PAUL941024MOCSSN01', 'Paulina', 'Barranco', 'Canseco', 'LKJSDLKJA', 2938, 'lkdajslkaj', 25, 0, '4562738637', 24, 'F', 'alumno', NULL, '2019-07-04 02:58:01', '2019-07-04 02:58:01'),
('PEGR770826HDGRRF75', 'Rafael', 'Pérez', 'Garza', 'qqqq', 1, 'qqqqq', 6, 0, '1111111', 29, 'M', 'alumno', NULL, '2019-09-23 05:13:30', '2019-09-23 05:13:30'),
('POGL920621HOCSSN03', 'Luis', 'Ponce', 'García', 'Martires de Tacubaya', 500, 'Reforma Agraria', 58, 0, '923898191', 27, 'M', 'docente', NULL, '2019-06-20 05:42:57', '2019-06-20 05:42:57'),
('RENA101224MOCSSN01', 'Renata', 'Espina', 'Hernandez', 'LSJkjkjalkj', 13, 'klsjdlkj', 16, 0, '134567543', 10, 'F', 'alumno', NULL, '2019-07-04 02:52:22', '2019-07-04 02:52:22'),
('RIGE770826MTCSMN65', 'Luis Enrique', 'Rios', 'Gomez', 'Arenal', 500, 'Morelos', 115, 98764, '32456789987654', 24, 'M', 'alumno', NULL, '2019-10-07 08:23:52', '2019-10-08 04:33:06'),
('RIGR770826HBCSMS19', 'Rosa', 'Rios', 'Gomez', 'jjjjjjj', 9999, 'jjjjjj', 6, 0, '99999999', 12, 'F', 'alumno', NULL, '2019-09-23 05:25:27', '2019-09-23 05:25:27'),
('RIRJ770826HQRSSS89', 'José Luis', 'Rios', 'Rios', 'jjjjjj', 222, 'jjjjjjj', 67, 0, '39393939393', 21, 'M', 'alumno', NULL, '2019-09-23 05:27:41', '2019-09-23 05:27:41'),
('ROOC770826HSPDRR78', 'Carmen', 'Rodriguez', 'Ortiz', 'uuuuuuu', 88888, 'uuuuuuuu', 557, 0, '88888888', 12, 'F', 'alumno', NULL, '2019-09-23 06:23:02', '2019-09-23 06:23:02'),
('SAFA770826HPLNRN46', 'Ana María', 'Santiago', 'Fernandez', 'rrrrrrrr', 544444, 'rrrrrrrrr', 75, 0, '444444444', 22, 'F', 'alumno', NULL, '2019-09-23 06:24:35', '2019-09-23 06:24:35'),
('SAMG770826HOCLRL69', 'Guillermo Mateo', 'Salazar', 'Martinez', 'Amapolas', 325, 'Reforma', 31, 894982, '1818181', 21, 'M', 'docente', NULL, '2019-10-07 10:32:08', '2019-10-07 12:51:11'),
('SAMV770826MSLLNR38', 'Veronica', 'Salazar', 'Muñoz', 'Hola', 2, 'hola', 2, 0, '999999', 54, 'F', 'alumno', NULL, '2019-09-20 16:45:15', '2019-09-20 16:45:15'),
('SOMA000826HOCRRH07', 'Marco Antonio', 'Soriano', NULL, 'ppppppp', 0, 'ñpppppp', 27, 0, '00000000', 19, 'M', 'alumno', NULL, '2019-09-23 06:29:27', '2019-09-23 06:29:27'),
('VACP770826MYNRRB63', 'Pablo', 'Cruz', 'Vargas', 'Naval', 34, 'Reforma', 4, 68030, '89439289289', 23, 'M', 'alumno', NULL, '2019-10-04 07:13:12', '2019-10-04 07:13:12'),
('VAMG770826MSPRRB23', 'Gabriel', 'Vargas', 'Moreno', 'Palmeras', 23, 'Reforma', 14, 6803, '9493202309', 23, 'M', 'alumno', NULL, '2019-10-07 05:36:42', '2019-10-07 05:36:42'),
('VARM770826HGRRMR31', 'María de Jesús', 'Vargas', 'Morales', 'Rosas', 32, 'Flores', 5, 0, '893283938', 28, 'F', 'alumno', NULL, '2019-10-03 22:35:51', '2019-10-03 22:35:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_pregunta` int(10) UNSIGNED NOT NULL,
  `pregunta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vigencia` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('Enfoque de Enseñanza','Clima Afectivo','Proceso de Enseñanza','Estrategias de Retroalimentacion') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_respuesta` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_pregunta`, `pregunta`, `vigencia`, `tipo`, `id_respuesta`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '¿Utiliza tu maestro(a) solamente inglés en clase?', '2020', 'Enfoque de Enseñanza', 1, NULL, '2019-09-26 06:16:03', '2019-09-26 06:16:03'),
(2, '¿Hay suficientes oportunidades para practicar de manera oral el idioma inglés?', '2020', 'Enfoque de Enseñanza', 1, NULL, '2019-09-26 06:20:03', '2019-09-26 06:20:03'),
(3, '¿Hay suficientes oportunidades para practicar la comprensión auditiva?', '2019', 'Enfoque de Enseñanza', 1, NULL, '2019-09-26 22:23:18', '2019-09-26 22:23:18'),
(4, '¿Hay suficientes oportunidades para practicar la producción escrita?', '2019', 'Enfoque de Enseñanza', 1, NULL, '2019-09-26 22:23:56', '2019-09-26 22:23:56'),
(5, '¿Hay suficientes oportunidades para practicar la comprensión de textos?', '2019', 'Enfoque de Enseñanza', 1, NULL, '2019-09-26 22:24:21', '2019-09-26 22:24:21'),
(6, '¿Incorpora tu maestro(a) materiales didácticos para fortalecer el aprendizaje del grupo?', '2019', 'Enfoque de Enseñanza', 1, NULL, '2019-09-26 22:24:58', '2019-09-26 22:24:58'),
(7, '¿Propicia tu maestro(a) un ambiente agradable en el salón de clase?', '2019', 'Clima Afectivo', 1, NULL, '2019-09-26 22:25:19', '2019-09-26 22:25:19'),
(8, '¿Tu profesor se dirige a ti y a tus compañeros con respeto?', '2019', 'Clima Afectivo', 1, NULL, '2019-09-26 22:30:32', '2019-09-26 22:30:32'),
(9, '¿Promueve tu maestro(a) la integración de todos los miembros del grupo?', '2019', 'Clima Afectivo', 1, NULL, '2019-09-26 22:30:58', '2019-09-26 22:30:58'),
(10, '¿La clase de tu maestro(a) siempre está bien organizada?', '2019', 'Proceso de Enseñanza', 1, NULL, '2019-09-26 22:31:13', '2019-09-26 22:31:13'),
(11, '¿Las explicaciones de tu maestro(a) son claras?', '2019', 'Proceso de Enseñanza', 1, NULL, '2019-09-26 22:31:38', '2019-09-26 22:31:38'),
(12, '¿Promueve tu maestro(a) la participación de todos(as) tus compañeros(as) en clase?', '2019', 'Proceso de Enseñanza', 1, NULL, '2019-09-26 22:32:06', '2019-09-26 22:32:06'),
(13, '¿Implementa el/la maestro(a) diferentes estrategias (dinámicas) que fortalecen el aprendizaje del grupo?', '2019', 'Proceso de Enseñanza', 1, NULL, '2019-09-26 22:32:28', '2019-09-26 22:32:28'),
(14, '¿Los temas que presenta tu maestro concuerdan con el desarrollo del curso?', '2019', 'Proceso de Enseñanza', 1, NULL, '2019-09-26 22:32:47', '2019-09-26 22:32:47'),
(15, '¿Incorpora tu maestro(a) actividades y temáticas atractivas y de interés general para los integrantes del grupo?', '2019', 'Proceso de Enseñanza', 1, NULL, '2019-09-26 22:33:05', '2019-09-26 22:33:05'),
(16, '¿Tu maestro(a) inicia y termina sus clases de manera puntual?', '2019', 'Proceso de Enseñanza', 1, NULL, '2019-09-26 22:33:22', '2019-09-26 22:33:22'),
(17, '¿Después de un examen de período el maestro (a) te da a conocer los resultados en un periodo de tiempo oportuno?', '2020', 'Estrategias de Retroalimentacion', 1, NULL, '2019-09-26 23:04:44', '2019-09-26 23:04:44'),
(18, '¿Con frecuencia el maestro(a) retroalimenta las tareas, proyectos, trabajos escritos, participación en clase?', '2020', 'Estrategias de Retroalimentacion', 1, NULL, '2019-09-30 16:51:40', '2019-09-30 16:51:40'),
(19, '¿La retroalimentación que te brinda el maestro (a) te permite mejorar tu proceso de aprendizaje (es constructiva)?', '2020', 'Estrategias de Retroalimentacion', 1, NULL, '2019-09-30 16:58:48', '2019-09-30 16:58:48'),
(20, 'comentarios', '2023', 'Estrategias de Retroalimentacion', 1, '2019-09-30 18:35:22', '2019-09-30 18:31:34', '2019-09-30 18:35:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id_respuesta` int(10) UNSIGNED NOT NULL,
  `respuesta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo_respuesta` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id_respuesta`, `respuesta`, `grupo_respuesta`, `created_at`, `updated_at`) VALUES
(1, 'Siempre', 1, '2019-09-25 07:40:29', '2019-09-25 07:40:29'),
(2, 'Casi Siempre', 1, '2019-09-25 07:41:54', '2019-09-25 08:29:44'),
(3, 'A veces', 1, '2019-09-25 07:42:08', '2019-09-25 07:42:08'),
(4, 'Casi nunca', 1, '2019-09-25 07:42:19', '2019-09-25 07:42:19'),
(5, 'Nunca', 1, '2019-09-25 07:42:28', '2019-09-25 07:42:28'),
(8, '2', 2, '2019-09-27 05:35:43', '2019-09-30 20:28:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado_pregunta`
--

CREATE TABLE `resultado_pregunta` (
  `id_rp` int(10) UNSIGNED NOT NULL,
  `id_pregunta` int(10) UNSIGNED NOT NULL,
  `id_respuesta` int(10) UNSIGNED NOT NULL,
  `num_evaluacion` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `resultado_pregunta`
--

INSERT INTO `resultado_pregunta` (`id_rp`, `id_pregunta`, `id_respuesta`, `num_evaluacion`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, NULL, '2019-10-10 17:42:26', '2019-10-10 17:42:26'),
(2, 2, 4, 3, NULL, '2019-10-10 17:42:26', '2019-10-10 17:42:26'),
(3, 3, 3, 3, NULL, '2019-10-10 17:42:26', '2019-10-10 17:42:26'),
(4, 4, 3, 3, NULL, '2019-10-10 17:42:26', '2019-10-10 17:42:26'),
(5, 5, 2, 3, NULL, '2019-10-10 17:42:26', '2019-10-10 17:42:26'),
(6, 6, 2, 3, NULL, '2019-10-10 17:42:26', '2019-10-10 17:42:26'),
(7, 7, 3, 3, NULL, '2019-10-10 17:42:26', '2019-10-10 17:42:26'),
(8, 8, 3, 3, NULL, '2019-10-10 17:42:27', '2019-10-10 17:42:27'),
(9, 9, 3, 3, NULL, '2019-10-10 17:42:27', '2019-10-10 17:42:27'),
(10, 10, 4, 3, NULL, '2019-10-10 17:42:27', '2019-10-10 17:42:27'),
(11, 11, 3, 3, NULL, '2019-10-10 17:42:27', '2019-10-10 17:42:27'),
(12, 12, 3, 3, NULL, '2019-10-10 17:42:27', '2019-10-10 17:42:27'),
(13, 13, 1, 3, NULL, '2019-10-10 17:42:27', '2019-10-10 17:42:27'),
(14, 14, 4, 3, NULL, '2019-10-10 17:42:27', '2019-10-10 17:42:27'),
(15, 15, 2, 3, NULL, '2019-10-10 17:42:27', '2019-10-10 17:42:27'),
(16, 16, 3, 3, NULL, '2019-10-10 17:42:27', '2019-10-10 17:42:27'),
(17, 17, 5, 3, NULL, '2019-10-10 17:42:27', '2019-10-10 17:42:27'),
(18, 18, 2, 3, NULL, '2019-10-10 17:42:27', '2019-10-10 17:42:27'),
(19, 19, 3, 3, NULL, '2019-10-10 17:42:27', '2019-10-10 17:42:27'),
(20, 1, 1, 4, NULL, '2019-10-14 17:11:30', '2019-10-14 17:11:30'),
(21, 2, 2, 4, NULL, '2019-10-14 17:11:30', '2019-10-14 17:11:30'),
(22, 3, 4, 4, NULL, '2019-10-14 17:11:30', '2019-10-14 17:11:30'),
(23, 4, 2, 4, NULL, '2019-10-14 17:11:30', '2019-10-14 17:11:30'),
(24, 5, 2, 4, NULL, '2019-10-14 17:11:30', '2019-10-14 17:11:30'),
(25, 6, 2, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(26, 7, 5, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(27, 8, 1, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(28, 9, 4, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(29, 10, 1, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(30, 11, 5, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(31, 12, 4, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(32, 13, 2, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(33, 14, 4, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(34, 15, 4, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(35, 16, 3, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(36, 17, 4, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(37, 18, 3, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31'),
(38, 19, 2, 4, NULL, '2019-10-14 17:11:31', '2019-10-14 17:11:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `curp_user` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `curp_user`, `email`, `password`, `tipo`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Coordinacion', NULL, 'shadow3924@hotmail.com', '$2y$10$Wyr.H3l1mCjymDu9.Q4pBe2uIDhe5q9A/FZ9Pqf3rtnLSAbfIYkt2', 'coordinador', NULL, NULL, '2019-06-11 22:00:39', '2019-07-04 01:08:48'),
(3, 'Carmen', 'EIVM601212MOCSSN01', 'heyhey@hey.hey', '$2y$10$jxwXKSjuXjk6AOsA9LFy7eDUyY2v06YZxqi8Wtvwcjt7XDPn1CBXu', '', NULL, NULL, NULL, '2019-08-28 17:14:46'),
(4, 'Hello', 'EIVM781001MOCSSN01', 'hello@heelo.mx', 'rtyui', '', NULL, '2019-07-18 12:40:18', NULL, '2019-07-18 12:40:18'),
(5, 'Fresa', 'EIVM921001MOCSSN01', 'akjaj@lka.lj', 'lskaj', '', NULL, '2019-07-11 11:19:52', NULL, '2019-07-11 11:19:52'),
(6, 'klajkj', 'AIJM931001MOCSSN01', 'kjjaq@lakja.dkl', '$2y$10$s0Qvq6657SUqhOXAd2/9cuzg/g.GeQJ7lze43ENb.6nztkISsG3JS', '', NULL, NULL, '2019-07-18 03:46:45', '2019-07-18 03:46:45'),
(7, 'Personita', 'AESP931001MOCSSN02', 'personita@correo.com', '$2y$10$JSdC8WuCmXqSM0XK0AAYLO9a0JxfUOH9qjTULKtWFcnlyeaGFsFVS', '', NULL, NULL, '2019-07-18 03:51:42', '2019-07-18 12:14:18'),
(8, 'Holita', 'HEVM931001MOCSSN01', 'alkjal@kajl.com', '$2y$10$9OZKF5DxoMrBHzt470rWd.g64E1RV1BBu0716A3/LfJLL8Z0XvdxS', '', NULL, '2019-07-18 13:09:15', '2019-07-18 11:53:17', '2019-07-18 13:09:15'),
(10, 'ajaj', 'JLAKJ', 'lskjja@kjalk.jckj', '$2y$10$iCzqVb7yymVpCHNQkenhy.8NTURr6MXYpXPgZHNhTjUncqmzMvE5C', '', NULL, '2019-07-18 13:33:27', '2019-07-18 12:23:42', '2019-07-18 13:33:27'),
(11, 'Ricardo', 'GAGG941124HOCRRL01', 'holaaaaaaa@hola.hola', '$2y$10$4aoak8qxlktsfI7Dpf0CwORBIJoGJiuxqvpzQ5lFdHoNZcehfwSXe', '', NULL, NULL, '2019-07-18 13:18:50', '2019-09-20 17:32:35'),
(12, 'Hola', 'EIVM831001MOCSSN01', 'akj@jlks.sdjl', '$2y$10$pzNpGJMIK25eaGfYI2Hw8O1lG8RCDpNsumyQJ.EPTStYwRzCfcdZC', '', NULL, '2019-08-21 13:32:15', '2019-07-19 11:36:22', '2019-08-21 13:32:15'),
(13, 'Monica', 'EIVM931001MOCSSN07', 'hola@h.co', '$2y$10$8YnSUc/vJiP04g3L/MSzBeOxbcW62OrLacROriu3ZpqQXlG.yxTdy', '', NULL, NULL, '2019-08-30 17:35:09', '2019-08-30 17:35:09'),
(17, 'Roberto', 'EIVM991001MOCSSN01', 'roberto@roberto.rob', '$2y$10$9vO.sEzWMZE8i8U3x9E2qOv2XUiyAWnQcEFcwqQ.9POdsLCognzNu', '', NULL, NULL, '2019-09-17 19:02:56', '2019-09-17 19:02:56'),
(25, 'Nick', 'NIEC920916HOCSSN01', 'nick@nick.pr', '$2y$10$c4GbBmaGgdIsw6UbuHbfC.3qshIrMBdW9iZSuq9C9KcFHk4sidynq', '', NULL, NULL, '2019-09-17 20:37:12', '2019-09-17 20:37:12'),
(26, 'Kevin', 'EEIE881105HOCSSN01', 'kevin@kevin.kev', '$2y$10$yFUml2rURbsNs6oWjUv3seuF0tw49/gc93aulwKRMpwCvDdM2nOty', '', NULL, NULL, '2019-09-17 20:41:08', '2019-09-17 20:41:08'),
(27, 'Marcela', 'GOMM991205MNTMRR11', 'ksksjdl@lksdl.skjld', '$2y$10$32Z7NBjADw.0x45P5GHw6uGKFV3qFobUVXgQfi6IwDrr/NYAQp9T.', '', NULL, NULL, '2019-09-20 16:41:54', '2019-09-20 17:20:45'),
(28, 'Veronica', 'SAMV770826MSLLNR38', 'hola@hola12.cl', '$2y$10$FhnIWEePbrv8CLgalakkm.935lBgvSaAKplv486s0aeR3oHdG4/OS', '', NULL, NULL, '2019-09-20 16:45:15', '2019-09-20 16:45:15'),
(29, 'Rafael', 'PEGR770826HDGRRF75', 'rafa@rafa.raf', '$2y$10$41T1.R6e8nGm/N.0WfS58u2A.f0s5pVPz1Ukfi0G00aF2lC29FlBS', '', NULL, NULL, '2019-09-23 05:13:30', '2019-09-23 05:13:30'),
(30, 'Antonia', 'GUSA770826MNLTTN26', 'antonia@antonia.ant', '$2y$10$f9IJrijG0gigTRxpyk0LVuRKbk2ozZe2ZekW72sIuCvK4w3XbPd9a', '', NULL, NULL, '2019-09-23 05:21:22', '2019-09-23 05:21:22'),
(31, 'Rosa', 'RIGR770826HBCSMS19', 'rosa@rosa.ros', '$2y$10$xJAgCmULXxotR6GcEx5HzOYbV7cR.UJq.Klg4sODwxafFAsUA1Wuy', '', NULL, NULL, '2019-09-23 05:25:27', '2019-09-23 05:25:27'),
(32, 'María Luisa', 'EIMM770826HDFSRR54', 'luisa@luisa.lui', '$2y$10$9K6Wd/9n9H7HomuSi0tFAOJo85RJGSZkcz62iu0maTiGE85i8vcMi', '', NULL, NULL, '2019-09-23 05:26:38', '2019-09-23 05:26:38'),
(33, 'José Luis', 'RIRJ770826HQRSSS89', 'jose@jose.jos', '$2y$10$npOuhirO5D749d5tz/uxz.dopxvvr7MqEzMglHLXtUSQGhr8XoFN2', '', NULL, NULL, '2019-09-23 05:27:42', '2019-09-23 05:27:42'),
(34, 'María Elena', 'LOGM770826HTCPZR85', 'elena@elena.ele', '$2y$10$PRNGQP3uTRECbGNlu9T74uoIXGIJXMh4p7jBk2cCUOxdEr26fJjNC', '', NULL, NULL, '2019-09-23 05:28:53', '2019-09-23 05:28:53'),
(35, 'María de los Angeles', 'GUAM770826HSRZGR11', 'angy@angy.anf', '$2y$10$Mmv99XJ.IrtiYIC6okLj..poGmLYenuzB.txLMSjlBp5DiPmL3Boi', '', NULL, NULL, '2019-09-23 06:21:55', '2019-09-23 06:21:55'),
(36, 'Carmen', 'ROOC770826HSPDRR78', 'carmen@carmen.car', '$2y$10$6FPDXn0HWz7qZqHKmpjcZ.lCQaY8VPZbGhifVFSy5iLUCPqV/tAva', '', NULL, NULL, '2019-09-23 06:23:02', '2019-09-23 06:23:02'),
(37, 'Ana María', 'SAFA770826HPLNRN46', 'ana@ana.ana', '$2y$10$Qb1aOKe3kD77.3iowyq9ReqydrXb16w1hujaYDZubvgBMhxzxJWpG', '', NULL, NULL, '2019-09-23 06:24:35', '2019-09-23 06:24:35'),
(38, 'Arturo', 'OIAA770826HGTRLR39', 'artur@artur.art', '$2y$10$xJGsqLO4UacuppaYnoDNt.af0fXBUiZXf9CJtOCVfOTMHzkpEicS2', '', NULL, NULL, '2019-09-23 06:25:50', '2019-09-23 06:25:50'),
(39, 'Alfredo', 'OIMA770826MCLRNL68', 'alfred@alfred.alf', '$2y$10$tpFOxaqZx0sjPGTACgMHI.FpWA1u1/yXb16X308oN0CEwvulzb/li', '', NULL, NULL, '2019-09-23 06:27:06', '2019-09-23 06:27:06'),
(40, 'Marco Antonio', 'SOMA000826HOCRRH07', 'marco@marco.mar', '$2y$10$XJpTH.F6pW8lcDx/O3ltHusz9pEsozdeg4z5yRUJHDVkM4KPoBlUi', '', NULL, NULL, '2019-09-23 06:29:27', '2019-09-23 06:29:27'),
(42, 'María de Jesús', 'VARM770826HGRRMR31', 'maria@maria.ms', '$2y$10$lOVD5gRIbdTZmtFpEFYTEeNUlMCFBlH6O7UsjPWj4luSKLxH6Ps4O', '', NULL, NULL, '2019-10-03 22:35:52', '2019-10-03 22:35:52'),
(43, 'Pablo', 'VACP770826MYNRRB63', 'pablo@pablo.pa', '$2y$10$pMMoS7tfPLluWnZo77HXp.EoUwgreB/N4d0fxC50AJUzwZdDCmVwi', '', NULL, NULL, '2019-10-04 07:13:12', '2019-10-04 07:13:12'),
(44, 'Guadalupe', 'CUFM770826MMSRLR35', 'lupita@lupita.lu', '$2y$10$xw6EHBxHt07nWqa/5MTYhetXQvpno1ulbrtS2S/ZVucUrI5Yy7Hbe', '', NULL, NULL, '2019-10-04 07:14:59', '2019-10-04 07:14:59'),
(46, 'Gabriel', 'VAMG770826MSPRRB23', 'gabriel@gabo.mo', '$2y$10$4pXgo2xVKA86WV0UkPi0p.WksTcChYhy1ED2BkH621m3LwhRgJcDO', 'alumno', NULL, NULL, '2019-10-07 05:36:43', '2019-10-07 05:36:43'),
(47, 'Leticia', 'LOGL770826HBCPRT25', 'lety@lety.le', '$2y$10$13oh3omx1j7WYc2UZEkJHORclRmLK2lAVJrd.G8dFQ4FgEeCaZA4W', 'alumno', NULL, NULL, '2019-10-07 08:02:46', '2019-10-07 08:02:46'),
(48, 'Alejandro', 'GURA770826HBCTDL22', 'ale@ale.al', '$2y$10$ETVR8AATtuW.6bI.N.pdFelUH2Fi8MPZTnyY2hZl84SLZv7BmP5De', 'alumno', NULL, NULL, '2019-10-07 08:16:36', '2019-10-07 08:16:36'),
(49, 'Luis Enrique', 'RIGE770826MTCSMN65', 'kike@kike.ki', '$2y$10$tReBeKr4ZuZXttP0Y2kFlunw8DWSy1cLUUS/D8GpXFJ0Chn74ExVy', 'alumno', NULL, NULL, '2019-10-07 08:23:52', '2019-10-08 04:33:07'),
(50, 'Angel', 'MOGA770826MNLRTN17', 'angel@angel.an', '$2y$10$ZGyXhDXlyswCJT1PbCRW..q2/uYWc4ozbLfRsjOBygQI4lI3gWPQS', 'alumno', NULL, NULL, '2019-10-07 08:31:06', '2019-10-07 08:31:06'),
(51, 'Guillermo Mateo', 'SAMG770826HOCLRL69', 'memo@memo.me', '$2y$10$sO4yzWu/YchpJq17XTXziO7fBh2jlZCehpqyDEls5dOGbgpUMDSni', 'docente', NULL, NULL, '2019-10-07 10:32:09', '2019-10-07 12:44:07'),
(52, 'Raul', 'MOGR770826HTCRNC29', 'raul@raul.ra', '$2y$10$/MZjHJhpGj5XDXeP.ABuQ.H95EIP9kbseV6ymrrJGZOuEOFd2og8G', 'alumno', NULL, NULL, '2019-10-08 18:03:23', '2019-10-08 18:03:23'),
(53, 'Miguel', 'FOVA980823HGTLSN96', 'migue@migue.mi', '$2y$10$BpjNroF.78aZNRYmjvm2pu.KVnhj5fEZXfrvqLp1iSdvRybyYoFxm', 'alumno', NULL, NULL, '2019-10-08 18:06:59', '2019-10-08 18:06:59'),
(54, 'Ana', 'CUGA980412MCMRRR85', 'anita@ana.an', '$2y$10$ssqQePrAdrDsMzwB1xSgxOUroSzF78GSy15jR2cmnPztB5CrYxu9i', 'alumno', NULL, NULL, '2019-10-08 18:14:20', '2019-10-08 18:14:20'),
(55, 'Gloria', 'NIUG891220MOCSSN58', 'gloria@gloria.gl', '$2y$10$WyM.7G4XkPZ5ZKECmSsSqO0jQZweaJGALbLcxpZY2nVmNbSsjbuQG', 'alumno', NULL, NULL, '2019-10-08 18:17:28', '2019-10-08 18:17:28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`num_control`),
  ADD KEY `alumnos_curp_alumno_foreign` (`curp_alumno`);

--
-- Indices de la tabla `alumno_inscrito`
--
ALTER TABLE `alumno_inscrito`
  ADD PRIMARY KEY (`num_inscripcion`),
  ADD KEY `alumno_inscrito_id_grupo_foreign` (`id_grupo`),
  ADD KEY `alumno_inscrito_num_control_foreign` (`num_control`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id_aula`),
  ADD KEY `aulas_hrdisponible_foreign` (`hrdisponible`);

--
-- Indices de la tabla `boletas`
--
ALTER TABLE `boletas`
  ADD PRIMARY KEY (`id_boleta`),
  ADD KEY `boletas_id_grupo_foreign` (`id_grupo`),
  ADD KEY `boletas_num_control_foreign` (`num_control`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`),
  ADD KEY `docentes_curp_docente_foreign` (`curp_docente`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`num_evaluacion`),
  ADD KEY `evaluacion_curp_docente_foreign` (`curp_docente`),
  ADD KEY `evaluacion_num_control_foreign` (`num_control`),
  ADD KEY `evaluacion_periodo_foreign` (`periodo`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `grupos_nivel_foreign` (`nivel_id`),
  ADD KEY `grupos_aula_foreign` (`aula`),
  ADD KEY `grupos_docente_foreign` (`docente`),
  ADD KEY `grupos_periodo_foreign` (`periodo`);

--
-- Indices de la tabla `grupo_respuesta`
--
ALTER TABLE `grupo_respuesta`
  ADD PRIMARY KEY (`id_grupoRespuestas`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`);

--
-- Indices de la tabla `horas_disponibles`
--
ALTER TABLE `horas_disponibles`
  ADD PRIMARY KEY (`id_hora`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nivels`
--
ALTER TABLE `nivels`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`curp`),
  ADD KEY `personas_municipio_foreign` (`municipio`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `preguntas_id_respuesta_foreign` (`id_respuesta`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `fk_grupo_respuesta` (`grupo_respuesta`);

--
-- Indices de la tabla `resultado_pregunta`
--
ALTER TABLE `resultado_pregunta`
  ADD PRIMARY KEY (`id_rp`),
  ADD KEY `resultado_pregunta_id_pregunta_foreign` (`id_pregunta`),
  ADD KEY `resultado_pregunta_id_respuesta_foreign` (`id_respuesta`),
  ADD KEY `resultado_pregunta_num_evaluacion_foreign` (`num_evaluacion`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email(191)_unique` (`email`(191)),
  ADD KEY `users_curp_user_foreign` (`curp_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno_inscrito`
--
ALTER TABLE `alumno_inscrito`
  MODIFY `num_inscripcion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id_aula` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `boletas`
--
ALTER TABLE `boletas`
  MODIFY `id_boleta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `num_evaluacion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `grupo_respuesta`
--
ALTER TABLE `grupo_respuesta`
  MODIFY `id_grupoRespuestas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `horas_disponibles`
--
ALTER TABLE `horas_disponibles`
  MODIFY `id_hora` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `nivels`
--
ALTER TABLE `nivels`
  MODIFY `id_nivel` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `id_periodo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_pregunta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id_respuesta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `resultado_pregunta`
--
ALTER TABLE `resultado_pregunta`
  MODIFY `id_rp` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_curp_alumno_foreign` FOREIGN KEY (`curp_alumno`) REFERENCES `personas` (`curp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alumno_inscrito`
--
ALTER TABLE `alumno_inscrito`
  ADD CONSTRAINT `alumno_inscrito_id_grupo_foreign` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumno_inscrito_num_control_foreign` FOREIGN KEY (`num_control`) REFERENCES `alumnos` (`num_control`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_hrdisponible_foreign` FOREIGN KEY (`hrdisponible`) REFERENCES `horas_disponibles` (`id_hora`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `boletas`
--
ALTER TABLE `boletas`
  ADD CONSTRAINT `boletas_id_grupo_foreign` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `boletas_num_control_foreign` FOREIGN KEY (`num_control`) REFERENCES `alumnos` (`num_control`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `docentes_curp_docente_foreign` FOREIGN KEY (`curp_docente`) REFERENCES `personas` (`curp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `evaluacion_curp_docente_foreign` FOREIGN KEY (`curp_docente`) REFERENCES `docentes` (`curp_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluacion_num_control_foreign` FOREIGN KEY (`num_control`) REFERENCES `alumnos` (`num_control`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluacion_periodo_foreign` FOREIGN KEY (`periodo`) REFERENCES `periodos` (`id_periodo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_aula_foreign` FOREIGN KEY (`aula`) REFERENCES `aulas` (`id_aula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupos_docente_foreign` FOREIGN KEY (`docente`) REFERENCES `docentes` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupos_nivel_foreign` FOREIGN KEY (`nivel_id`) REFERENCES `nivels` (`id_nivel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupos_periodo_foreign` FOREIGN KEY (`periodo`) REFERENCES `periodos` (`id_periodo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_municipio_foreign` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_id_respuesta_foreign` FOREIGN KEY (`id_respuesta`) REFERENCES `grupo_respuesta` (`id_grupoRespuestas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `fk_grupo_respuesta` FOREIGN KEY (`grupo_respuesta`) REFERENCES `grupo_respuesta` (`id_grupoRespuestas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `resultado_pregunta`
--
ALTER TABLE `resultado_pregunta`
  ADD CONSTRAINT `resultado_pregunta_id_pregunta_foreign` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id_pregunta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resultado_pregunta_id_respuesta_foreign` FOREIGN KEY (`id_respuesta`) REFERENCES `respuestas` (`id_respuesta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resultado_pregunta_num_evaluacion_foreign` FOREIGN KEY (`num_evaluacion`) REFERENCES `evaluacion` (`num_evaluacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_curp_user_foreign` FOREIGN KEY (`curp_user`) REFERENCES `personas` (`curp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
