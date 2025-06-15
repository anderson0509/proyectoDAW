-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-06-2025 a las 23:29:32
-- Versión del servidor: 8.4.3
-- Versión de PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controlnota`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `codigo` bigint UNSIGNED NOT NULL,
  `encargado` bigint UNSIGNED NOT NULL,
  `nie` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`codigo`, `encargado`, `nie`, `nombre`, `apellido`, `correo`, `fecha_nacimiento`, `imagen`, `created_at`, `updated_at`) VALUES
(1, 1, 28485599, 'Alexander', 'Perez', 'alexander.perez@edu.sv', '2018-08-10', '/imagenes/icono.png', '2025-06-12 03:12:23', NULL),
(2, 2, 28485589, 'Karen', 'Ortega', 'karen.ortega@edu.sv', '2017-06-15', '/imagenes/icono.png', '2025-06-12 03:12:23', NULL),
(3, 3, 18455895, 'Josue', 'Ortiz', 'josue.ortiz@edu.sv', '2016-07-10', '/imagenes/icono.png', '2025-06-12 03:12:23', NULL),
(4, 1, 25484409, 'Saraí', 'Arce', 'sarai.arce@edu.sv', '2015-03-13', '/imagenes/icono.png', '2025-06-12 04:42:51', '2025-06-13 02:28:15'),
(6, 2, 25483308, 'Pedro', 'Ortega', 'pedro.ortega@gmail.com', '2015-07-09', '/imagenes/icono.png', '2025-06-14 05:23:19', '2025-06-14 05:23:19'),
(8, 3, 28454577, 'Carlos', 'Ortiz', 'carlos.ortiz@edu.sv', '2018-06-12', '/imagenes/icono.png', '2025-06-14 22:40:46', '2025-06-14 22:40:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('asistencia_1_1_2025-06-14', 'a:5:{s:5:\"Lunes\";s:1:\"1\";s:6:\"Martes\";s:1:\"1\";s:10:\"Miércoles\";s:1:\"1\";s:6:\"Jueves\";b:0;s:7:\"Viernes\";b:0;}', 1752525650),
('asistencia_1_8_2025-06-14', 'a:5:{s:5:\"Lunes\";b:0;s:6:\"Martes\";b:0;s:10:\"Miércoles\";b:0;s:6:\"Jueves\";b:0;s:7:\"Viernes\";b:0;}', 1752525650);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_docente`
--

CREATE TABLE `detalle_docente` (
  `codigo` bigint UNSIGNED NOT NULL,
  `docente` bigint UNSIGNED NOT NULL,
  `grado` bigint UNSIGNED NOT NULL,
  `materia` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_docente`
--

INSERT INTO `detalle_docente` (`codigo`, `docente`, `grado`, `materia`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2025-06-12 03:12:23', NULL),
(2, 2, 2, 4, '2025-06-12 03:12:23', NULL),
(3, 3, 3, 5, '2025-06-12 03:12:23', NULL),
(5, 5, 4, 3, '2025-06-13 09:07:55', '2025-06-13 09:07:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `codigo` bigint UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dui` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `especialidad` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`codigo`, `nombre`, `apellido`, `dui`, `correo`, `telefono`, `especialidad`, `created_at`, `updated_at`) VALUES
(1, 'Rony', 'Aguilar', '05258897-2', 'rony.aguilar@edu.sv', '7688-9834', 'matematica', '2025-06-12 03:12:23', NULL),
(2, 'Anderson', 'Cuellar', '05258758-2', 'anderson.cuellar@edu.sv', '7598-7834', 'Ciencia', '2025-06-12 03:12:23', NULL),
(3, 'Karla', 'Catalan', '05248598-2', 'karla.catalan@edu.sv', '7888-9635', 'Ingles', '2025-06-12 03:12:23', NULL),
(5, 'Josué', 'Rodriguez', '05283767-8', 'josue.rodriguez@edu.sv', '7528-1738', 'Sociales', '2025-06-13 07:56:35', '2025-06-13 07:56:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado`
--

CREATE TABLE `encargado` (
  `codigo` bigint UNSIGNED NOT NULL,
  `dui` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentesco` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `encargado`
--

INSERT INTO `encargado` (`codigo`, `dui`, `nombre`, `apellido`, `correo`, `parentesco`, `created_at`, `updated_at`) VALUES
(1, '05268498-3', 'Juan', 'Perez', 'juan.perez@gmail.com', 'Padre', '2025-06-12 03:12:23', NULL),
(2, '06268587-3', 'Maria', 'Ortega', 'maria.ortega@gmail.com', 'Madre', '2025-06-12 03:12:23', NULL),
(3, '04265788-3', 'Jose', 'Ortiz', 'jose.ortiz@gmail.com', 'Padre', '2025-06-12 03:12:23', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `codigo` bigint UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seccion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`codigo`, `nombre`, `seccion`, `created_at`, `updated_at`) VALUES
(1, 'Primer grado', 'UNICA', '2025-06-12 03:12:23', NULL),
(2, 'Segundo grado', 'UNICA', '2025-06-12 03:12:23', NULL),
(3, 'Tercer grado', 'Unica', '2025-06-12 03:12:23', NULL),
(4, 'Cuarto grado', 'UNICA', '2025-06-12 03:12:23', NULL),
(5, 'Quinto grado', 'UNICA', '2025-06-12 03:12:23', NULL),
(6, 'Sexto grado', 'UNICA', '2025-06-12 03:12:23', NULL),
(7, 'Septimo grado', 'UNICA', '2025-06-12 03:12:23', NULL),
(8, 'Octavo grado', 'UNICA', '2025-06-12 03:12:23', NULL),
(9, 'Noveno grado', 'UNICA', '2025-06-12 03:12:23', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `codigo` bigint UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`codigo`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Matematica', '2025-06-12 03:12:23', NULL),
(2, 'Lenguaje', '2025-06-12 03:12:23', NULL),
(3, 'Sociales', '2025-06-12 03:12:23', NULL),
(4, 'Ciencia', '2025-06-12 03:12:23', NULL),
(5, 'Ingles', '2025-06-12 03:12:23', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `codigo` bigint UNSIGNED NOT NULL,
  `alumno` bigint UNSIGNED NOT NULL,
  `grado` bigint UNSIGNED NOT NULL,
  `materia` bigint UNSIGNED NOT NULL,
  `año_matricula` year NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`codigo`, `alumno`, `grado`, `materia`, `año_matricula`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2025', '2025-06-12 03:12:23', NULL),
(2, 2, 2, 2, '2025', '2025-06-12 03:12:23', NULL),
(3, 3, 3, 3, '2025', '2025-06-12 03:12:23', NULL),
(5, 4, 5, 5, '2025', '2025-06-14 03:18:18', '2025-06-14 05:50:36'),
(6, 6, 5, 4, '2025', '2025-06-14 05:23:42', '2025-06-14 05:23:42'),
(7, 4, 5, 2, '2025', '2025-06-14 10:07:58', '2025-06-14 10:07:58'),
(13, 1, 1, 2, '2025', '2025-06-15 04:03:11', '2025-06-15 04:03:11'),
(14, 1, 1, 3, '2025', '2025-06-15 04:03:25', '2025-06-15 04:03:25'),
(15, 1, 1, 4, '2025', '2025-06-15 04:03:50', '2025-06-15 04:03:50'),
(16, 1, 1, 5, '2025', '2025-06-15 04:04:04', '2025-06-15 04:04:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_11_204734_create_docente_table', 1),
(5, '2025_06_11_204758_create_grado_table', 1),
(6, '2025_06_11_204826_create_materia_table', 1),
(7, '2025_06_11_204847_create_detalle_docente_table', 1),
(8, '2025_06_11_204908_create_encargado_table', 1),
(9, '2025_06_11_204924_create_alumno_table', 1),
(10, '2025_06_11_204937_create_matricula_table', 1),
(11, '2025_06_11_204950_create_trimestre_table', 1),
(12, '2025_06_11_205002_create_nota_table', 1),
(13, '2025_06_14_194743_add_rol_to_users_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `codigo` bigint UNSIGNED NOT NULL,
  `trimestre` bigint UNSIGNED NOT NULL,
  `matricula` bigint UNSIGNED NOT NULL,
  `actividad1` int NOT NULL,
  `actividad2` int NOT NULL,
  `actividad3` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`codigo`, `trimestre`, `matricula`, `actividad1`, `actividad2`, `actividad3`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 6, 10, 10, '2025-06-12 03:12:23', '2025-06-14 12:50:05'),
(2, 1, 2, 10, 10, 10, '2025-06-12 03:12:23', NULL),
(3, 1, 3, 10, 10, 10, '2025-06-12 03:12:23', NULL),
(11, 2, 1, 8, 7, 10, '2025-06-14 12:12:21', '2025-06-15 02:42:37'),
(12, 3, 1, 10, 8, 6, '2025-06-14 12:20:57', '2025-06-14 12:20:57'),
(15, 1, 13, 10, 8, 9, '2025-06-15 04:04:47', '2025-06-15 04:04:47'),
(16, 1, 14, 10, 7, 10, '2025-06-15 04:08:23', '2025-06-15 04:08:23'),
(17, 1, 15, 8, 9, 7, '2025-06-15 04:08:57', '2025-06-15 04:08:57'),
(18, 1, 16, 6, 7, 10, '2025-06-15 04:09:21', '2025-06-15 04:09:21'),
(19, 2, 13, 10, 8, 6, '2025-06-15 04:42:42', '2025-06-15 04:42:42'),
(20, 2, 14, 10, 7, 9, '2025-06-15 04:43:09', '2025-06-15 04:43:09'),
(21, 2, 15, 5, 6, 6, '2025-06-15 04:43:49', '2025-06-15 04:43:49'),
(22, 2, 16, 10, 10, 6, '2025-06-15 04:44:26', '2025-06-15 04:44:26'),
(23, 3, 13, 10, 10, 10, '2025-06-15 04:45:20', '2025-06-15 04:45:20'),
(24, 3, 14, 10, 8, 7, '2025-06-15 04:45:50', '2025-06-15 04:45:50'),
(25, 3, 15, 10, 9, 10, '2025-06-15 04:46:23', '2025-06-15 04:46:23'),
(26, 3, 16, 8, 8, 9, '2025-06-15 04:46:49', '2025-06-15 04:46:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lyUkq88UY7DkhlvZtt88Mos7Q0uc243wGYbhkppP', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiWWYyc2txeEhoU25TWklGMm5jUHlzQ09WSHptTDhJa0hPZDJIdjBVUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaG9tZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQ5OTQzMDY5O319', 1749943518);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trimestre`
--

CREATE TABLE `trimestre` (
  `codigo` bigint UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trimestre`
--

INSERT INTO `trimestre` (`codigo`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Primer Trimestre', '2025-06-12 03:12:23', NULL),
(2, 'Segundo Trimestre', '2025-06-12 03:12:23', NULL),
(3, 'Tercer Trimestre', '2025-06-12 03:12:23', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'docente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `rol`) VALUES
(3, 'Rony Aguilar', 'rony.aguilar@edu.sv', NULL, '$2y$12$CRrWd1kXTZxRKiBXYrGZEelWFiKxlSv27CF4CVmQFpoUb1UNVcBvW', NULL, '2025-06-15 01:57:09', '2025-06-15 01:57:09', 'docente'),
(4, 'Anderson Cuellar', 'anderson.cuellar@edu.sv', NULL, '$2y$12$AuOsI0nCI/63Xod8n9D5HOpF6OC0e1pPw1rRuYxqMI50.CHELeT7S', NULL, '2025-06-15 01:58:10', '2025-06-15 01:58:10', 'director');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `alumno_encargado_foreign` (`encargado`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `detalle_docente`
--
ALTER TABLE `detalle_docente`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `detalle_docente_docente_foreign` (`docente`),
  ADD KEY `detalle_docente_grado_foreign` (`grado`),
  ADD KEY `detalle_docente_materia_foreign` (`materia`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `encargado`
--
ALTER TABLE `encargado`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `matricula_alumno_foreign` (`alumno`),
  ADD KEY `matricula_grado_foreign` (`grado`),
  ADD KEY `matricula_materia_foreign` (`materia`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `nota_trimestre_foreign` (`trimestre`),
  ADD KEY `nota_matricula_foreign` (`matricula`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `trimestre`
--
ALTER TABLE `trimestre`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `codigo` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_docente`
--
ALTER TABLE `detalle_docente`
  MODIFY `codigo` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `codigo` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `encargado`
--
ALTER TABLE `encargado`
  MODIFY `codigo` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `codigo` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `codigo` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `codigo` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `codigo` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `trimestre`
--
ALTER TABLE `trimestre`
  MODIFY `codigo` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_encargado_foreign` FOREIGN KEY (`encargado`) REFERENCES `encargado` (`codigo`);

--
-- Filtros para la tabla `detalle_docente`
--
ALTER TABLE `detalle_docente`
  ADD CONSTRAINT `detalle_docente_docente_foreign` FOREIGN KEY (`docente`) REFERENCES `docente` (`codigo`),
  ADD CONSTRAINT `detalle_docente_grado_foreign` FOREIGN KEY (`grado`) REFERENCES `grado` (`codigo`),
  ADD CONSTRAINT `detalle_docente_materia_foreign` FOREIGN KEY (`materia`) REFERENCES `materia` (`codigo`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_alumno_foreign` FOREIGN KEY (`alumno`) REFERENCES `alumno` (`codigo`),
  ADD CONSTRAINT `matricula_grado_foreign` FOREIGN KEY (`grado`) REFERENCES `grado` (`codigo`),
  ADD CONSTRAINT `matricula_materia_foreign` FOREIGN KEY (`materia`) REFERENCES `materia` (`codigo`);

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_matricula_foreign` FOREIGN KEY (`matricula`) REFERENCES `matricula` (`codigo`),
  ADD CONSTRAINT `nota_trimestre_foreign` FOREIGN KEY (`trimestre`) REFERENCES `trimestre` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
