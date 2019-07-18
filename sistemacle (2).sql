-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2019 a las 10:39:26
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
  `num_control` int(11) NOT NULL,
  `curp_alumno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrera` enum('Ingeniería Eléctrica','Ingeniería Electrónica','Ingeniería Civil','Ingeniería Mecánica','Ingeniería Industrial','Ingeniería Química','Ingeniería en Gestión Empresarial','Ingeniería en Sistemas Computacionales','Licenciatura en Administración') COLLATE utf8mb4_unicode_ci NOT NULL,
  `semestre` enum('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16') COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` enum('Inscrito','No Inscrito') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`num_control`, `curp_alumno`, `carrera`, `semestre`, `estatus`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5926049, 'fjls41px', 'Ingeniería en Sistemas Computacionales', '5', 'Inscrito', NULL, '2019-06-11 21:59:53', '2019-06-11 21:59:53'),
(6812919, 'fjls38av', 'Ingeniería Eléctrica', '3', 'No Inscrito', NULL, '2019-06-11 21:59:55', '2019-06-11 21:59:55'),
(6855791, 'fjls64qo', 'Ingeniería en Gestión Empresarial', '4', 'No Inscrito', NULL, '2019-06-11 21:59:55', '2019-06-11 21:59:55'),
(12161276, 'GAGG941124HOCRRL01', 'Ingeniería Mecánica', '12', 'No Inscrito', '2019-07-18 13:21:09', '2019-07-18 13:18:50', '2019-07-18 13:21:09'),
(13139610, 'fjls05os', 'Ingeniería Industrial', '12', 'Inscrito', NULL, '2019-06-11 21:59:54', '2019-06-11 21:59:54'),
(13161107, 'EIVM931001MOCSSN01', 'Ingeniería en Gestión Empresarial', '8', 'No Inscrito', '2019-07-10 14:00:03', '2019-07-04 10:06:24', '2019-07-10 14:00:03'),
(13456789, 'EIVM781001MOCSSN01', 'Licenciatura en Administración', '3', 'No Inscrito', '2019-07-18 12:40:18', NULL, '2019-07-18 12:40:18'),
(16267389, 'EIVA900304MOCSSN01', 'Ingeniería Electrónica', '9', 'No Inscrito', NULL, '2019-07-04 02:43:28', '2019-07-04 02:43:28'),
(19283731, 'EIVM601212MOCSSN01', 'Ingeniería en Sistemas Computacionales', '2', 'No Inscrito', NULL, '2019-07-04 01:39:22', '2019-07-18 09:44:28'),
(25474287, 'fjls17bm', 'Ingeniería Química', '8', 'Inscrito', NULL, '2019-06-11 21:59:55', '2019-06-11 21:59:55'),
(32008644, 'fjls61jc', 'Ingeniería en Sistemas Computacionales', '4', 'Inscrito', NULL, '2019-06-11 21:59:56', '2019-06-11 21:59:56'),
(34567873, 'RENA101224MOCSSN01', 'Ingeniería Química', '8', 'No Inscrito', NULL, '2019-07-04 02:52:22', '2019-07-04 02:52:22'),
(35780755, 'fjls16ce', 'Ingeniería Electrónica', '7', 'No Inscrito', NULL, '2019-06-11 21:59:55', '2019-06-11 21:59:55'),
(38949120, 'fjls62is', 'Ingeniería Civil', '6', 'No Inscrito', NULL, '2019-06-11 21:59:54', '2019-06-11 21:59:54'),
(39567669, 'fjls68ly', 'Ingeniería Eléctrica', '7', 'No Inscrito', NULL, '2019-06-11 21:59:56', '2019-06-11 21:59:56'),
(41141056, 'fjls70cw', 'Ingeniería Química', '5', 'No Inscrito', NULL, '2019-06-11 21:59:54', '2019-06-11 21:59:54'),
(47996027, 'fjls05mk', 'Ingeniería Electrónica', '9', 'No Inscrito', NULL, '2019-06-11 21:59:56', '2019-06-11 21:59:56'),
(56738763, 'JOEJ890815HOCSSN01', 'Licenciatura en Administración', '12', 'No Inscrito', '2019-07-10 13:43:44', '2019-07-04 02:55:45', '2019-07-10 13:43:44'),
(56789673, 'EIME921021MOCSSN01', 'Ingeniería Química', '9', 'No Inscrito', NULL, '2019-07-04 09:16:41', '2019-07-04 09:16:41'),
(57824989, 'fjls11im', 'Licenciatura en Administración', '7', 'No Inscrito', NULL, '2019-06-11 21:59:54', '2019-06-11 21:59:54'),
(65031740, 'fjls08zm', 'Ingeniería Civil', '11', 'No Inscrito', NULL, '2019-06-11 21:59:56', '2019-06-11 21:59:56'),
(67179574, 'fjls45wp', 'Ingeniería Eléctrica', '5', 'Inscrito', NULL, '2019-06-11 21:59:55', '2019-06-11 21:59:55'),
(67661135, 'fjls58gf', 'Ingeniería Mecánica', '3', 'Inscrito', NULL, '2019-06-11 21:59:54', '2019-06-11 21:59:54'),
(67898768, 'IIVM931001MOCSSN01', 'Ingeniería en Gestión Empresarial', '9', 'No Inscrito', NULL, '2019-07-04 03:02:05', '2019-07-04 03:02:05'),
(73027689, 'fjls94mf', 'Ingeniería Industrial', '11', 'No Inscrito', NULL, '2019-06-11 21:59:54', '2019-06-11 21:59:54'),
(78932840, 'EIMV931001MOCSSN08', 'Ingeniería Electrónica', '2', 'No Inscrito', '2019-07-04 09:19:06', '2019-07-04 09:18:37', '2019-07-04 09:19:06'),
(80822979, 'fjls09jz', 'Ingeniería Eléctrica', '11', 'Inscrito', NULL, '2019-06-11 21:59:56', '2019-06-11 21:59:56'),
(83812007, 'fjls15lf', 'Ingeniería Civil', '1', 'Inscrito', '2019-06-22 05:39:54', '2019-06-11 21:59:55', '2019-06-22 05:39:54'),
(84754048, 'fjls34nt', 'Ingeniería Eléctrica', '9', 'Inscrito', '2019-07-11 06:57:05', '2019-06-11 21:59:55', '2019-07-11 06:57:05'),
(88992200, 'HEVM931001MOCSSN01', 'Ingeniería Industrial', '4', 'No Inscrito', '2019-07-18 13:09:15', '2019-07-18 11:53:16', '2019-07-18 13:09:15'),
(93749884, 'PAUL941024MOCSSN01', 'Licenciatura en Administración', '8', 'No Inscrito', NULL, '2019-07-04 02:58:01', '2019-07-04 02:58:01'),
(98392892, 'EIVM921001MOCSSN01', 'Ingeniería Mecánica', '2', 'No Inscrito', '2019-07-11 11:19:52', '2019-07-04 12:22:59', '2019-07-11 11:19:52');

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
(4, 7, 'I', 4, '2019-06-25 23:23:11'),
(5, 9, 'I', 11, NULL),
(6, 8, 'K', 12, NULL);

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
(15, 'JOJJ890815MOCSSN01', 'Orden-CitaLAB010.pdf', 'Doctorado', 'Orden-CitaLAB010.pdf', 'Orden-CitaLAB010.pdf', 'Inactivo', NULL, '2019-07-18 12:20:11', '2019-07-18 12:20:11'),
(16, 'JLAKJ', '2-Programa_Lengua_Extranjera_2014 (1).pdf', 'Maestría', '2-Programa_Lengua_Extranjera_2014 (1).pdf', '2-Programa_Lengua_Extranjera_2014 (1).pdf', 'Inactivo', '2019-07-18 13:33:27', '2019-07-18 12:23:41', '2019-07-18 13:33:27');

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
  `docente` int(10) UNSIGNED NOT NULL,
  `periodo` int(10) UNSIGNED NOT NULL,
  `hora` time NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `grupo`, `modalidad`, `nivel_id`, `aula`, `docente`, `periodo`, `hora`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'A', 'Semanal', 1, 3, 4, 1, '07:00:00', NULL, NULL, NULL),
(2, 'B', 'Semanal', 4, 3, 4, 1, '13:00:00', NULL, NULL, NULL),
(3, 'C', 'Sabatino', 3, 1, 5, 2, '08:00:00', NULL, NULL, NULL);

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
(2, '07:00:00', '08:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '07:00:00', '08:00:00', '09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '07:00:00', '08:00:00', '09:00:00', '10:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '08:00:00', '09:00:00', '12:00:00', '15:00:00', '16:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '11:00:00', '12:00:00', '15:00:00', '18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '08:00:00', '09:00:00', '13:00:00', '14:00:00', '16:00:00', '19:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '08:00:00', '09:00:00', '13:00:00', '14:00:00', '16:00:00', '19:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '09:00:00', '10:00:00', '15:00:00', '17:00:00', '18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(13, '2019_05_29_045230_create_grupos_table', 2);

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
(9, 'A1', 'M1', 'Inglés', '2019-07-06 03:26:00');

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
(2, 'AGO-DIC', 2019, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `curp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_paterno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_materno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calle` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `colonia` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipio` int(11) NOT NULL,
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

INSERT INTO `personas` (`curp`, `nombres`, `ap_paterno`, `ap_materno`, `calle`, `numero`, `colonia`, `municipio`, `telefono`, `edad`, `sexo`, `tipo`, `deleted_at`, `created_at`, `updated_at`) VALUES
('', 'okdjs', 'lksjlak', 'lksjdkd', 'lkjsalkj3', 323, 'jiokals', 6, '23456789', 56, 'M', 'docente', NULL, NULL, NULL),
('AESP931001MOCSSN02', 'Personita', 'Apellido', 'Segundo Apellido', 'Robles', 24, 'Arboledas', 3, '1234567890', 23, 'M', 'docente', NULL, '2019-07-18 03:51:41', '2019-07-18 12:14:18'),
('AIJM931001MOCSSN01', 'klajkj', 'kjalk', 'kjlak', 'kjdlakj', 12, 'kajjk', 3, '23456789', 12, 'F', 'docente', NULL, '2019-07-18 03:46:10', '2019-07-18 03:46:10'),
('ALSKJLKJ', 'eeeeee', 'lkajk', 'kjakja', 'jlakjda', 23, 'kjkaj', 5, '7890', 90, 'F', 'alumno', NULL, '2019-07-17 10:59:36', '2019-07-17 10:59:36'),
('ASKJLA', 'qqqq', 'kajljda', 'kjaj', 'kajlak', 322, 'klajl', 2, '7890', 23, 'F', 'docente', NULL, '2019-07-17 11:06:04', '2019-07-17 11:06:04'),
('EIME921021MOCSSN01', 'Esmeralda', 'Ramirez', 'Lopez', 'KRJFAJKJAL', 390, 'KLJKJA', 6, '23452', 23, 'M', 'alumno', NULL, '2019-07-04 09:16:41', '2019-07-04 09:16:41'),
('EIMV931001MOCSSN08', 'skjdkaj', 'kjlaskjd', 'kjlskdjka', 'JKJLDLKFJlksj', 39, 'lskdjl', 3, '789987', 93, 'F', 'alumno', '2019-07-04 09:19:06', '2019-07-04 09:18:37', '2019-07-04 09:19:06'),
('EIVA900304MOCSSN01', 'Adriana', 'Espina', 'Vasquez', 'YUIO', 23, 'HJIKL', 9, '12345678876543', 26, 'F', 'alumno', NULL, '2019-07-04 02:43:28', '2019-07-04 02:43:28'),
('EIVM601212MOCSSN01', 'Carmen', 'Vasquez', 'Hernandez', 'Camino Nacional', 120, 'Morelos', 14, '1234567890', 60, 'M', 'alumno', NULL, '2019-07-04 01:39:22', '2019-07-10 11:08:05'),
('EIVM781001MOCSSN01', 'Hello', 'hello', 'hello', 'dfghjkl', 56789, 'fghjkl', 7, '678900', 67, 'M', 'alumno', '2019-07-18 12:40:18', NULL, '2019-07-18 12:40:18'),
('EIVM921001MOCSSN01', 'Fresa', 'dklsjlk', 'lksajlk', 'JKLSDKlkajlk', 9089, 'jlskdjlkaj', 5, '2345', 23, 'F', 'alumno', '2019-07-11 11:19:52', '2019-07-04 12:22:59', '2019-07-11 11:19:52'),
('EIVM931001MOCSSN01', 'kllsdjkljjls', 'kjsdlkja', 'kslkdj', 'lksdjla', 234, 'kjaslkd', 10, '897987', 98, 'F', 'alumno', '2019-07-10 14:00:04', '2019-07-04 10:06:23', '2019-07-10 14:00:04'),
('EIVM931001MOCSSN05', 'Alicia', 'Reyes', 'Montes', 'Norte 1', 934, 'Reforma', 21, '9238719829', 42, 'F', 'docente', NULL, '2019-06-20 05:12:48', '2019-06-20 05:12:48'),
('EIVM931001MOCSSN06', 'Jesus', 'Bautista', 'Alderete', 'Las Rosas', 2, 'Morelos', 2, '123456789', 23, 'M', 'docente', NULL, '2019-06-11 23:51:53', '2019-07-16 04:25:22'),
('EIVM931002MOCSNN01', 'hola', 'ldkslk', 'kjfls', 'kfjdlkaj', 90, 'kdjalkj', 3, '567890', 32, 'F', 'alumno', NULL, '2019-07-17 10:43:27', '2019-07-17 10:43:27'),
('EIVM931003MOCSSN01', 'holados', 'lakja', 'kajkj', 'ksja', 32, 'lkasj', 3, '7890', 23, 'F', 'alumno', NULL, '2019-07-17 10:51:50', '2019-07-17 10:51:50'),
('EIVM931101MOCSSN01', 'aaaaa', 'jfasdkj', 'lkajl', 'lkdsaj', 32, 'kajak', 1, '7890', 89, 'F', 'docente', NULL, '2019-07-17 10:55:46', '2019-07-17 10:55:46'),
('fjls05mk', 'Cordia', 'Breitenberg', 'Stark', 'iste', 664, 'porro', 531, '(855) 762-6593', 59, 'M', 'docente', NULL, '2019-06-11 21:59:53', '2019-06-11 21:59:53'),
('fjls05os', 'Dwight', 'Bernhard', 'Dickens', 'vel', 192, 'voluptates', 95, '877-962-9040', 50, 'F', 'docente', NULL, '2019-06-11 21:59:51', '2019-06-11 21:59:51'),
('fjls08zm', 'Hildegard', 'Herzog', 'Veum', 'soluta', 993, 'laudantium', 505, '1-855-799-9604', 22, 'F', 'alumno', NULL, '2019-06-11 21:59:52', '2019-06-11 21:59:52'),
('fjls09jz', 'Jose', 'Kunde', 'Cormier', 'ut', 698, 'architecto', 558, '1-877-788-1711', 76, 'F', 'alumno', NULL, '2019-06-11 21:59:53', '2019-06-11 21:59:53'),
('fjls11im', 'Adell', 'Schimmel', 'Ullrich', 'unde', 673, 'maiores', 81, '1-888-735-4867', 24, 'F', 'alumno', NULL, '2019-06-11 21:59:52', '2019-06-11 21:59:52'),
('fjls15lf', 'Maxwell', 'Gibson', 'Russel', 'ut', 40, 'eos', 164, '1-800-737-5809', 59, 'F', 'alumno', '2019-06-22 05:37:20', '2019-06-11 21:59:52', '2019-06-22 05:37:20'),
('fjls16ce', 'Ellis', 'Waters', 'Spencer', 'quis', 749, 'excepturi', 243, '1-888-476-4119', 52, 'F', 'alumno', NULL, '2019-06-11 21:59:50', '2019-06-11 21:59:50'),
('fjls17bm', 'Danika', 'Runolfsson', 'Stracke', 'similique', 13, 'est', 170, '877-317-6602', 54, 'F', 'alumno', NULL, '2019-06-11 21:59:53', '2019-06-11 21:59:53'),
('fjls34nt', 'Ulices', 'Hansen', 'Murphy', 'dolor', 288, 'neque', 252, '844-693-8182', 34, 'M', 'alumno', '2019-07-11 06:57:05', '2019-06-11 21:59:51', '2019-07-11 06:57:05'),
('fjls38av', 'Joanne', 'Blanda', 'Jacobson', 'hic', 80, 'ducimus', 390, '1-866-941-8634', 47, 'M', 'docente', NULL, '2019-06-11 21:59:51', '2019-06-11 21:59:51'),
('fjls41px', 'Dominic', 'Ratke', 'Breitenberg', 'autem', 126, 'ea', 21, '800-423-8278', 36, 'F', 'alumno', NULL, '2019-06-11 21:59:50', '2019-06-11 21:59:50'),
('fjls45wp', 'Aracely', 'Marvin', 'Cummerata', 'ullam', 714, 'hic', 262, '888-930-8850', 63, 'M', 'alumno', NULL, '2019-06-11 21:59:53', '2019-06-11 21:59:53'),
('fjls56pe', 'Sam', 'Abshire', 'Bailey', 'voluptate', 159, 'voluptas', 566, '877.961.9264', 10, 'F', 'alumno', NULL, '2019-06-11 21:59:52', '2019-06-11 21:59:52'),
('fjls58gf', 'Yessenia', 'Greenholt', 'Stokes', 'est', 220, 'ut', 35, '1-877-322-4622', 41, 'F', 'docente', NULL, '2019-06-11 21:59:52', '2019-06-11 21:59:52'),
('fjls61jc', 'Ezekiel', 'Cartwright', 'Pfeffer', 'officiis', 981, 'itaque', 523, '(844) 380-6755', 69, 'F', 'docente', NULL, '2019-06-11 21:59:53', '2019-06-11 21:59:53'),
('fjls62is', 'Aliyah', 'Rutherford', 'Lynch', 'similique', 6, 'consectetur', 107, '1-800-925-7739', 42, 'M', 'docente', NULL, '2019-06-11 21:59:51', '2019-06-11 21:59:51'),
('fjls64qo', 'Arvel', 'Stanton', 'Price', 'deserunt', 420, 'molestiae', 148, '(877) 849-0193', 53, 'M', 'docente', NULL, '2019-06-11 21:59:51', '2019-06-11 21:59:51'),
('fjls68ly', 'Raven', 'Hessel', 'Kiehn', 'inventore', 278, 'deleniti', 415, '8889453967', 72, 'M', 'alumno', NULL, '2019-06-11 21:59:50', '2019-07-18 13:20:42'),
('fjls70cw', 'Yvonne', 'Brown', 'Kulas', 'accusamus', 4, 'excepturi', 87, '877-282-3325', 80, 'F', 'alumno', NULL, '2019-06-11 21:59:52', '2019-06-11 21:59:52'),
('fjls94mf', 'Trever', 'Wolff', 'Rowe', 'itaque', 0, 'animi', 29, '(844) 854-5796', 4, 'M', 'alumno', NULL, '2019-06-11 21:59:50', '2019-06-11 21:59:50'),
('GAGG941124HOCRRL01', 'Ricardito', 'Bebesito', 'Brr brr', 'Palmeras', 302, 'Llano Verde', 14, '234567898765', 24, 'M', 'alumno', NULL, '2019-07-18 13:18:50', '2019-07-18 13:21:09'),
('GAGR951124HOCSSN02', 'Ricardo', 'Garcia', 'Garcia', 'Palmeras', 100, 'Llano Verde', 375, '9511967690', 24, 'M', 'docente', NULL, '2019-06-20 05:48:38', '2019-06-20 05:48:38'),
('HEVM931001MOCSSN01', 'Holita', 'Holita', 'Holita', 'kajkj', 23, 'lkaj', 3, '56789', 12, 'F', 'alumno', '2019-07-18 13:09:15', '2019-07-18 11:53:16', '2019-07-18 13:09:15'),
('IIVM931001MOCSSN01', 'Ivanna', 'Espina', 'Hernandez', 'lkdjlkajlkjla', 32, 'jlksdjkl', 5, '2345678', 31, 'F', 'alumno', NULL, '2019-07-04 03:02:05', '2019-07-04 03:02:05'),
('JKSAJLAKJ', 'wwwwwwwww', 'lkdsajlkj', 'jkaldkjal', 'LKASJDLA', 90, 'laksja', 4, '56789', 90, 'F', 'docente', NULL, '2019-07-17 11:07:03', '2019-07-17 11:07:03'),
('JLAKJ', 'ajaj', 'kljlakj', 'kjal', 'lakjda', 32, 'kldjlakj', 3, '6789098', 90, 'F', 'docente', '2019-07-18 13:33:27', '2019-07-18 12:23:41', '2019-07-18 13:33:27'),
('JOEJ890815HOCSSN01', 'Joe', 'Jonas', 'Miller', 'klajdkskl', 938, 'kdjlkajkl', 16, '12345678987654', 28, 'M', 'alumno', '2019-07-10 13:43:44', '2019-07-04 02:55:45', '2019-07-10 13:43:44'),
('JOJJ890815MOCSSN01', 'Joe', 'Jonas', 'Miller', 'kajla', 32, 'slkaj', 10, '45678976', 28, 'M', 'docente', NULL, '2019-07-18 12:20:11', '2019-07-18 12:20:11'),
('LKJDSL', 'dijlj', 'lksdjl', 'lkjsdl', 'klsdal', 11, 'kfdjlkj', 1, '890', 21, 'F', 'alumno', NULL, '2019-07-17 10:40:39', '2019-07-17 10:40:39'),
('PAUL941024MOCSSN01', 'Paulina', 'Barranco', 'Canseco', 'LKJSDLKJA', 2938, 'lkdajslkaj', 25, '4562738637', 24, 'F', 'alumno', NULL, '2019-07-04 02:58:01', '2019-07-04 02:58:01'),
('POGL920621HOCSSN03', 'Luis', 'Ponce', 'García', 'Martires de Tacubaya', 500, 'Reforma Agraria', 58, '923898191', 27, 'M', 'docente', NULL, '2019-06-20 05:42:57', '2019-06-20 05:42:57'),
('RENA101224MOCSSN01', 'Renata', 'Espina', 'Hernandez', 'LSJkjkjalkj', 13, 'klsjdlkj', 16, '134567543', 10, 'F', 'alumno', NULL, '2019-07-04 02:52:22', '2019-07-04 02:52:22');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `curp_user`, `email`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Coordinacion', NULL, 'shadow3924@hotmail.com', '$2y$10$Wyr.H3l1mCjymDu9.Q4pBe2uIDhe5q9A/FZ9Pqf3rtnLSAbfIYkt2', NULL, NULL, '2019-06-11 22:00:39', '2019-07-04 01:08:48'),
(3, 'Carmen', 'EIVM601212MOCSSN01', 'hoola@hola.com', 'hola', NULL, NULL, NULL, '2019-07-18 09:44:29'),
(4, 'Hello', 'EIVM781001MOCSSN01', 'hello@heelo.mx', 'rtyui', NULL, '2019-07-18 12:40:18', NULL, '2019-07-18 12:40:18'),
(5, 'Fresa', 'EIVM921001MOCSSN01', 'akjaj@lka.lj', 'lskaj', NULL, '2019-07-11 11:19:52', NULL, '2019-07-11 11:19:52'),
(6, 'klajkj', 'AIJM931001MOCSSN01', 'kjjaq@lakja.dkl', '$2y$10$s0Qvq6657SUqhOXAd2/9cuzg/g.GeQJ7lze43ENb.6nztkISsG3JS', NULL, NULL, '2019-07-18 03:46:45', '2019-07-18 03:46:45'),
(7, 'Personita', 'AESP931001MOCSSN02', 'personita@correo.com', '$2y$10$JSdC8WuCmXqSM0XK0AAYLO9a0JxfUOH9qjTULKtWFcnlyeaGFsFVS', NULL, NULL, '2019-07-18 03:51:42', '2019-07-18 12:14:18'),
(8, 'Holita', 'HEVM931001MOCSSN01', 'alkjal@kajl.com', '$2y$10$9OZKF5DxoMrBHzt470rWd.g64E1RV1BBu0716A3/LfJLL8Z0XvdxS', NULL, '2019-07-18 13:09:15', '2019-07-18 11:53:17', '2019-07-18 13:09:15'),
(9, 'Joe', 'JOJJ890815MOCSSN01', 'joe@jonas.com', '$2y$10$cWgRfonWajSASO7Ahp7aGOK3Ff9H0HqIwAKAaPt5/uqV3P1sKbTFm', NULL, NULL, '2019-07-18 12:20:11', '2019-07-18 12:20:11'),
(10, 'ajaj', 'JLAKJ', 'lskjja@kjalk.jckj', '$2y$10$iCzqVb7yymVpCHNQkenhy.8NTURr6MXYpXPgZHNhTjUncqmzMvE5C', NULL, '2019-07-18 13:33:27', '2019-07-18 12:23:42', '2019-07-18 13:33:27'),
(11, 'Ricardito', 'GAGG941124HOCRRL01', 'rioija@akjal.dkj', '$2y$10$4aoak8qxlktsfI7Dpf0CwORBIJoGJiuxqvpzQ5lFdHoNZcehfwSXe', NULL, NULL, '2019-07-18 13:18:50', '2019-07-18 13:21:08');

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
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id_aula`),
  ADD KEY `aulas_hrdisponible_foreign` (`hrdisponible`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`),
  ADD KEY `docentes_curp_docente_foreign` (`curp_docente`);

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
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id_aula` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horas_disponibles`
--
ALTER TABLE `horas_disponibles`
  MODIFY `id_hora` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `nivels`
--
ALTER TABLE `nivels`
  MODIFY `id_nivel` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `id_periodo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_curp_alumno_foreign` FOREIGN KEY (`curp_alumno`) REFERENCES `personas` (`curp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_hrdisponible_foreign` FOREIGN KEY (`hrdisponible`) REFERENCES `horas_disponibles` (`id_hora`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `docentes_curp_docente_foreign` FOREIGN KEY (`curp_docente`) REFERENCES `personas` (`curp`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_curp_user_foreign` FOREIGN KEY (`curp_user`) REFERENCES `personas` (`curp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
