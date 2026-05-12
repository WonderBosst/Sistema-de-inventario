-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2026 a las 23:15:45
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `friendly_cleaner`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm`
--

CREATE TABLE `crm` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `entre_calles` varchar(200) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `numero_telefonico` bigint(11) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `crm`
--

INSERT INTO `crm` (`id_cliente`, `nombre`, `apellidos`, `direccion`, `entre_calles`, `correo`, `numero_telefonico`, `activo`, `fecha_creacion`) VALUES
(1, 'José Ramón', 'Vazquéz Mendéz', 'Colonia: Alameda, Calle: Figueroa #65', 'Bella vista y Bella loma', 'jrvm@gmail.com', 3112328876, 1, '2026-03-12 20:34:06'),
(2, 'María Fernanda', 'López García', 'Colonia Centro, Calle Hidalgo #120', 'Morelos y Juárez', 'mflg@gmail.com', 3114567789, 0, '2026-03-12 20:34:06'),
(3, 'Carlos Alberto', 'Sánchez Ruiz', 'Colonia San Juan, Calle Zaragoza #45', 'Victoria y Mina', 'casr@gmail.com', 3119871234, 1, '2026-03-12 20:34:06'),
(4, 'Ana Sofía', 'Martínez Torres', 'Colonia Valle Verde, Calle Roble #22', 'Pino y Cedro', 'asmt@gmail.com', 3112345567, 1, '2026-03-12 20:34:06'),
(5, 'Luis Enrique', 'Gómez Herrera', 'Colonia Los Fresnos, Calle Olivo #18', 'Primavera y Verano', 'legh@gmail.com', 3116543321, 1, '2026-03-12 20:34:06'),
(6, 'Daniela', 'Castillo Ramírez', 'Colonia Jardines, Calle Tulipán #50', 'Rosas y Margaritas', 'dcrc@gmail.com', 3117788990, 1, '2026-03-12 20:34:06'),
(7, 'Miguel Ángel', 'Ortega Salazar', 'Colonia Santa María, Calle Guerrero #77', 'Allende y Bravo', 'maos@gmail.com', 3114455667, 1, '2026-03-12 20:34:06'),
(8, 'Paola Andrea', 'Navarro Delgado', 'Colonia Puerta del Sol, Calle Luna #10', 'Sol y Estrella', 'pand@gmail.com', 3115566778, 1, '2026-03-12 20:34:06'),
(9, 'Jorge Luis', 'Ríos Mendoza', 'Colonia Independencia, Calle Libertad #90', 'Patria y Nación', 'jlrm@gmail.com', 3118899001, 1, '2026-03-12 20:34:06'),
(10, 'Fernanda', 'Cruz Aguilar', 'Colonia Las Palmas, Calle Palma Real #33', 'Coco y Mango', 'fca@gmail.com', 3116677889, 1, '2026-03-12 20:34:06'),
(11, 'Antonio', 'Riváz Zepeda', 'Colonia: Agústin Iturbide, Calle: Rio colorado #98', 'Rio salado y Rio carmesi', 'arz@gmail.com', 3117779987, 1, '2026-03-13 18:47:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_materiales`
--

CREATE TABLE `grupos_materiales` (
  `id_grupo_materiales` varchar(120) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupos_materiales`
--

INSERT INTO `grupos_materiales` (`id_grupo_materiales`, `fecha_creacion`) VALUES
('0kjPQDSi', '2026-04-06 21:00:38'),
('2XXTFT78', '2026-03-17 20:59:36'),
('3XXTFT98', '2026-03-17 20:59:36'),
('4XXTFT91', '2026-03-17 20:59:36'),
('DiOYBT5q', '2026-04-10 18:02:44'),
('kykAnKNc', '2026-04-06 19:13:35'),
('Lfw9sHXp', '2026-04-06 19:12:48'),
('m1AuZFlD', '2026-04-09 21:22:10'),
('MkAPdm0o', '2026-04-09 20:58:52'),
('MRT0lai7', '2026-04-06 21:52:13'),
('ne5VIHWP', '2026-04-06 19:20:30'),
('Qz74N14I', '2026-04-10 18:37:03'),
('zhK5PNqo', '2026-04-06 19:14:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_productos`
--

CREATE TABLE `grupos_productos` (
  `id_grupo_productos` varchar(120) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupos_productos`
--

INSERT INTO `grupos_productos` (`id_grupo_productos`, `fecha_creacion`) VALUES
('0kjPQDSi', '2026-04-06 21:00:38'),
('2XXTFT78', '2026-03-17 20:59:36'),
('3XXTFT98', '2026-03-17 20:59:36'),
('4XXTFT91', '2026-03-17 20:59:36'),
('DiOYBT5q', '2026-04-10 18:02:44'),
('kykAnKNc', '2026-04-06 19:13:35'),
('Lfw9sHXp', '2026-04-06 19:12:48'),
('m1AuZFlD', '2026-04-09 21:22:10'),
('MkAPdm0o', '2026-04-09 20:58:52'),
('MRT0lai7', '2026-04-06 21:52:13'),
('ne5VIHWP', '2026-04-06 19:20:30'),
('Qz74N14I', '2026-04-10 18:37:03'),
('zhK5PNqo', '2026-04-06 19:14:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_trabajadores`
--

CREATE TABLE `grupos_trabajadores` (
  `id_grupo_trabajadores` varchar(120) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupos_trabajadores`
--

INSERT INTO `grupos_trabajadores` (`id_grupo_trabajadores`, `fecha_creacion`) VALUES
('0kjPQDSi', '2026-04-06 21:00:38'),
('2XXTFT78', '2026-03-17 20:58:11'),
('3XXTFT98', '2026-03-17 20:58:11'),
('4XXTFT91', '2026-03-17 20:58:11'),
('DiOYBT5q', '2026-04-10 18:02:44'),
('kykAnKNc', '2026-04-06 19:13:35'),
('Lfw9sHXp', '2026-04-06 19:12:48'),
('m1AuZFlD', '2026-04-09 21:22:10'),
('MkAPdm0o', '2026-04-09 20:58:52'),
('MRT0lai7', '2026-04-06 21:52:13'),
('ne5VIHWP', '2026-04-06 19:20:30'),
('Qz74N14I', '2026-04-10 18:37:03'),
('zhK5PNqo', '2026-04-06 19:14:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_materiales`
--

CREATE TABLE `grupo_materiales` (
  `id_interno` int(11) NOT NULL,
  `id_grupo_materiales` varchar(120) NOT NULL,
  `id_material` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultima_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupo_materiales`
--

INSERT INTO `grupo_materiales` (`id_interno`, `id_grupo_materiales`, `id_material`, `cantidad`, `fecha_creacion`, `ultima_actualizacion`) VALUES
(3, '2XXTFT78', NULL, 10, '2026-04-23 20:25:43', '2026-04-23 20:25:43'),
(6, '3XXTFT98', 3, 7, '2026-04-24 21:17:31', '2026-04-24 21:17:31'),
(7, '3XXTFT98', 2, 5, '2026-04-24 21:17:46', '2026-04-24 21:17:46'),
(9, '3XXTFT98', 5, 1, '2026-04-24 21:17:56', '2026-04-24 21:17:56'),
(17, '2XXTFT78', 32, NULL, '2026-05-04 19:14:28', '2026-05-04 19:14:28'),
(18, '2XXTFT78', 33, NULL, '2026-05-04 19:14:29', '2026-05-04 19:14:29'),
(19, '2XXTFT78', 34, NULL, '2026-05-04 19:14:30', '2026-05-04 19:14:30'),
(28, '2XXTFT78', 35, NULL, '2026-05-07 20:46:54', '2026-05-07 20:46:54'),
(29, '2XXTFT78', 36, NULL, '2026-05-07 20:46:56', '2026-05-07 20:46:56'),
(30, '2XXTFT78', 37, NULL, '2026-05-07 20:46:57', '2026-05-07 20:46:57'),
(31, '2XXTFT78', 38, NULL, '2026-05-07 21:11:41', '2026-05-07 21:11:41'),
(32, '2XXTFT78', 40, NULL, '2026-05-07 21:11:42', '2026-05-07 21:11:42'),
(33, '2XXTFT78', 41, NULL, '2026-05-07 21:11:43', '2026-05-07 21:11:43'),
(34, '2XXTFT78', 42, NULL, '2026-05-07 21:11:44', '2026-05-07 21:11:44'),
(35, '2XXTFT78', 43, NULL, '2026-05-07 21:13:02', '2026-05-07 21:13:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_productos`
--

CREATE TABLE `grupo_productos` (
  `id_grupo_productos` varchar(120) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` double DEFAULT NULL,
  `consumido` double DEFAULT NULL,
  `medida` varchar(150) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultima_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupo_productos`
--

INSERT INTO `grupo_productos` (`id_grupo_productos`, `id_producto`, `cantidad`, `consumido`, `medida`, `fecha_creacion`, `ultima_actualizacion`) VALUES
('2XXTFT78', 3, 11, 0, NULL, '2026-04-15 18:09:51', '2026-04-21 21:23:22'),
('2XXTFT78', 6, 21, NULL, NULL, '2026-04-15 18:09:51', '2026-04-20 21:33:50'),
('2XXTFT78', 7, 12, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('2XXTFT78', 8, 7, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('2XXTFT78', 9, 60, 420, NULL, '2026-04-28 18:10:44', '2026-04-28 18:10:44'),
('2XXTFT78', 10, 1, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 20:35:54'),
('2XXTFT78', 11, 1, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 20:35:55'),
('2XXTFT78', 12, 1, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 20:35:55'),
('2XXTFT78', 13, 20, 240, '0', '2026-04-28 18:50:11', '2026-04-28 18:50:11'),
('2XXTFT78', 14, 20, 20, '0', '2026-04-28 18:55:07', '2026-04-28 18:55:07'),
('2XXTFT78', 15, 30, 210, '0', '2026-04-28 18:55:11', '2026-04-28 18:55:11'),
('2XXTFT78', 16, 10, 9500, '0', '2026-04-28 18:57:39', '2026-04-28 18:57:39'),
('2XXTFT78', 18, 9, 900, '0', '2026-05-12 18:27:22', '2026-05-12 18:27:22'),
('3XXTFT98', 6, 19, NULL, NULL, '2026-04-15 18:09:51', '2026-04-20 21:33:20'),
('3XXTFT98', 7, 2, NULL, NULL, '2026-04-15 18:09:51', '2026-04-20 21:45:46'),
('3XXTFT98', 8, 2, NULL, NULL, '2026-04-15 18:09:51', '2026-04-20 21:45:45'),
('3XXTFT98', 9, 4, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('3XXTFT98', 10, 0, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('3XXTFT98', 11, 0, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('3XXTFT98', 12, 0, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('3XXTFT98', 13, 9, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 18:47:44'),
('4XXTFT91', 7, 1, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('4XXTFT91', 11, 2, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('4XXTFT91', 14, 1, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('Lfw9sHXp', 7, 2, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('Lfw9sHXp', 8, 1, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('Lfw9sHXp', 9, 1, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('Lfw9sHXp', 10, 0, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('Lfw9sHXp', 18, 2, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('MkAPdm0o', 6, 0, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('MkAPdm0o', 7, 0, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('MkAPdm0o', 8, 0, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('MkAPdm0o', 9, 0, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('MkAPdm0o', 10, 0, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('ne5VIHWP', 6, 9, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('ne5VIHWP', 8, 2, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('ne5VIHWP', 9, 3, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('ne5VIHWP', 10, 1, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('ne5VIHWP', 11, 2, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('Qz74N14I', 7, 6, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('Qz74N14I', 8, 4, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('Qz74N14I', 9, 3, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50'),
('Qz74N14I', 10, 3, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 17:58:50');

--
-- Disparadores `grupo_productos`
--
DELIMITER $$
CREATE TRIGGER `after_delete_grupo_productos` AFTER DELETE ON `grupo_productos` FOR EACH ROW BEGIN
    UPDATE productos
    SET cantidad = cantidad + OLD.cantidad
    WHERE id_producto = OLD.id_producto;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_grupo_productos` BEFORE INSERT ON `grupo_productos` FOR EACH ROW BEGIN
    DECLARE stock_actual DOUBLE;

    SELECT cantidad INTO stock_actual
    FROM productos
    WHERE id_producto = NEW.id_producto;

    IF stock_actual < NEW.cantidad THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No hay suficiente stock';
    ELSE
        UPDATE productos
        SET cantidad = cantidad - NEW.cantidad
        WHERE id_producto = NEW.id_producto;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_grupo_productos` BEFORE UPDATE ON `grupo_productos` FOR EACH ROW BEGIN
    DECLARE diferencia DOUBLE;
    DECLARE stock_actual DOUBLE;

    SET diferencia = NEW.cantidad - OLD.cantidad;

    IF diferencia > 0 THEN
        -- Solo validar si está aumentando
        SELECT cantidad INTO stock_actual
        FROM productos
        WHERE id_producto = NEW.id_producto;

        IF stock_actual < diferencia THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'No hay suficiente stock para actualizar';
        END IF;

        UPDATE productos
        SET cantidad = cantidad - diferencia
        WHERE id_producto = NEW.id_producto;

    ELSE
        -- Si reduces cantidad → devolver stock
        UPDATE productos
        SET cantidad = cantidad + ABS(diferencia)
        WHERE id_producto = NEW.id_producto;
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_trabajadores`
--

CREATE TABLE `grupo_trabajadores` (
  `id_grupo_trabajadores` varchar(120) NOT NULL,
  `id_trabajador` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultima_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupo_trabajadores`
--

INSERT INTO `grupo_trabajadores` (`id_grupo_trabajadores`, `id_trabajador`, `fecha_creacion`, `ultima_actualizacion`) VALUES
('2XXTFT78', 1, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('2XXTFT78', 4, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('2XXTFT78', 5, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('2XXTFT78', 11, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('2XXTFT78', 13, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('2XXTFT78', 14, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('2XXTFT78', 16, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('2XXTFT78', 17, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('2XXTFT78', 19, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('3XXTFT98', 1, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('3XXTFT98', 2, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('3XXTFT98', 3, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('3XXTFT98', 4, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('3XXTFT98', 9, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('3XXTFT98', 12, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('3XXTFT98', 14, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('3XXTFT98', 16, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('3XXTFT98', 19, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('3XXTFT98', 20, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('3XXTFT98', 21, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('4XXTFT91', 1, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('4XXTFT91', 3, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('4XXTFT91', 4, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('Lfw9sHXp', 20, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('Lfw9sHXp', 21, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('Lfw9sHXp', 22, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('MkAPdm0o', 1, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('MkAPdm0o', 3, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('MkAPdm0o', 12, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('MkAPdm0o', 13, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('ne5VIHWP', 3, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('ne5VIHWP', 4, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('ne5VIHWP', 5, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('ne5VIHWP', 12, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('ne5VIHWP', 15, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('ne5VIHWP', 16, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('ne5VIHWP', 19, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('ne5VIHWP', 21, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('ne5VIHWP', 23, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('ne5VIHWP', 26, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('Qz74N14I', 1, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('Qz74N14I', 3, '2026-04-15 18:05:14', '2026-04-15 18:04:45'),
('Qz74N14I', 10, '2026-04-15 18:05:14', '2026-04-15 18:04:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `limitante`
--

CREATE TABLE `limitante` (
  `id_limite` int(11) NOT NULL,
  `entidad` varchar(100) NOT NULL,
  `limite` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `limitante`
--

INSERT INTO `limitante` (`id_limite`, `entidad`, `limite`) VALUES
(1, 'materiales', 2),
(2, 'productos', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id_material` int(11) NOT NULL,
  `codigo` varchar(150) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `marca` varchar(120) DEFAULT NULL,
  `razon` varchar(200) DEFAULT NULL,
  `estatus` tinyint(1) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_eliminacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id_material`, `codigo`, `nombre`, `marca`, `razon`, `estatus`, `fecha_creacion`, `fecha_eliminacion`) VALUES
(2, NULL, 'Escoba', 'Generico', NULL, 0, '2026-03-10 18:55:11', '2026-05-04 18:24:42'),
(3, NULL, 'Aspiradora', 'Kymberly-Clark', 'El motor ya no sirve', 0, '2026-03-10 18:55:11', '2026-05-04 18:25:25'),
(5, NULL, 'Recojedor', 'Solprac', 'No tiene codigo', 0, '2026-03-10 18:55:11', '2026-05-04 20:32:51'),
(7, NULL, 'Espátula', 'Tork', 'No tiene codigo', 0, '2026-03-10 18:55:11', '2026-05-04 20:34:21'),
(8, NULL, 'Plumero extensible', 'Biozone', NULL, 0, '2026-03-10 18:55:11', '2026-05-04 18:24:42'),
(9, NULL, 'Plumero corto', 'Biozone', 'No tiene codigo', 0, '2026-03-10 18:55:11', '2026-05-04 20:36:32'),
(10, NULL, 'Paños de limpieza de microfibra', 'Glade', 'No tiene codigo', 0, '2026-03-10 18:55:11', '2026-05-04 20:32:18'),
(11, NULL, 'Jalador de pisos', 'Oval', 'No tiene codigo', 0, '2026-03-10 18:55:11', '2026-05-04 20:29:36'),
(12, NULL, 'Jalador de vidrios', 'Oval', 'No tiene codigo', 0, '2026-03-10 18:55:11', '2026-05-04 20:31:43'),
(13, NULL, 'Destapacaño', 'Jofel', 'No tiene codigo', 0, '2026-03-10 18:55:11', '2026-05-04 20:26:35'),
(14, NULL, 'Cinta destapacaños', 'Gojo', 'No tiene codigo', 0, '2026-03-10 18:55:11', '2026-05-04 20:27:30'),
(15, NULL, 'Cepillo de limpieza de esquinas', 'Wiese', 'No tiene codigo', 0, '2026-03-10 18:55:11', '2026-05-04 20:25:40'),
(23, NULL, 'Espátulas de hierro', 'BeoClean', 'No tiene codigo', 0, '2026-04-24 19:50:34', '2026-05-04 20:31:05'),
(24, NULL, 'Trapeador corto', 'Unline', 'No tiene codigo', 0, '2026-04-24 19:53:30', '2026-05-04 20:34:40'),
(25, NULL, 'Trapeador largo', 'Rubbermaid', 'No tiene codigo', 0, '2026-04-24 19:54:49', '2026-05-04 20:35:36'),
(26, NULL, 'Trapeador de microfibra', 'Rubbermaid', 'No tiene codigo', 0, '2026-04-24 19:55:24', '2026-05-04 20:35:12'),
(27, NULL, 'Trapeador rectangular largo de 50 cm', 'Rubbermaid', 'No tiene codigo', 0, '2026-04-24 19:55:57', '2026-05-04 20:36:01'),
(28, NULL, 'Escoba de cepillo de largo de 40 cm', 'Rubbermaid', 'No tiene codigo', 0, '2026-04-24 19:57:50', '2026-05-04 20:30:00'),
(29, NULL, 'Escoba angular', 'Uline', 'No tiene codigo', 0, '2026-04-24 19:59:47', '2026-05-04 20:28:08'),
(30, NULL, 'Botella de spray', 'Generico', 'No tiene codigo', 0, '2026-04-24 20:01:57', '2026-05-04 20:24:34'),
(31, 'cleaner-COomG5CK', 'Trapeador corto', 'Salvo', 'Ya no sirve', 0, '2026-04-30 21:58:21', '2026-05-04 18:27:27'),
(32, 'cleaner-1I24ON0a', 'Escoba', 'Salvo', NULL, 1, '2026-04-30 21:58:44', '2026-05-04 18:24:42'),
(33, 'cleaner-ZzpohIgS', 'Escoba', 'Salvo', NULL, 1, '2026-05-04 19:13:59', '2026-05-04 19:13:59'),
(34, 'cleaner-VA7YLM4b', 'Escoba', 'Byozone', NULL, 1, '2026-05-04 19:14:11', '2026-05-04 19:14:11'),
(35, 'cleaner-s7iXWlu5', 'Escoba', 'Byozone', NULL, 1, '2026-05-04 20:19:09', '2026-05-04 20:19:09'),
(36, 'cleaner-PtO8cJdD', 'Espátula', 'Johnn Deree', NULL, 1, '2026-05-04 20:19:26', '2026-05-04 20:19:26'),
(37, 'cleaner-1n7phEvw', 'Plumero corto', 'Jhonsson', NULL, 1, '2026-05-04 20:19:47', '2026-05-04 20:19:47'),
(38, 'cleaner-vxXmM3bd', 'Botella de spray', 'Jhonsson', NULL, 1, '2026-05-04 20:24:55', '2026-05-04 20:24:55'),
(39, 'cleaner-gsEtkNxj', 'Botella de spray', 'Fabuloso', 'Se elimina por que se vacio', 0, '2026-05-04 20:25:13', '2026-05-07 20:37:28'),
(40, 'cleaner-YBoSHtBK', 'Botella de spray', 'Clorox', NULL, 1, '2026-05-04 20:25:21', '2026-05-04 20:25:21'),
(41, 'cleaner-ckogSs52', 'Cepillo de limpieza de esquinas', 'Wiese', NULL, 1, '2026-05-04 20:25:48', '2026-05-04 20:25:48'),
(42, 'cleaner-XyFB6hEP', 'Cepillo de limpieza de esquinas', 'Wiese', NULL, 1, '2026-05-04 20:25:56', '2026-05-04 20:25:56'),
(43, 'cleaner-ipUjxneU', 'Cepillo de limpieza de esquinas', 'Wiese', NULL, 1, '2026-05-04 20:26:03', '2026-05-04 20:26:03'),
(44, 'cleaner-UXqCjRVb', 'Destapacaño', 'Jofel', NULL, 1, '2026-05-04 20:26:45', '2026-05-04 20:26:45'),
(45, 'cleaner-1m0MpgsU', 'Destapacaño', 'Jofel', NULL, 1, '2026-05-04 20:26:52', '2026-05-04 20:26:52'),
(46, 'cleaner-DegDJ56b', 'Destapacaño', 'Jhonsson', NULL, 1, '2026-05-04 20:26:59', '2026-05-04 20:26:59'),
(47, 'cleaner-yWGu7WDi', 'Destapacaño', 'Byozone', NULL, 1, '2026-05-04 20:27:05', '2026-05-04 20:27:05'),
(48, 'cleaner-nJKKZEZW', 'Cinta destapacaños', 'Gojo', NULL, 1, '2026-05-04 20:27:38', '2026-05-04 20:27:38'),
(49, 'cleaner-mcSA0DyL', 'Cinta destapacaños', 'Gojo', NULL, 1, '2026-05-04 20:27:46', '2026-05-04 20:27:46'),
(50, 'cleaner-eDBX7vTR', 'Cinta destapacaños', 'Gojo', NULL, 1, '2026-05-04 20:27:54', '2026-05-04 20:27:54'),
(51, 'cleaner-N4WD2uQR', 'Escoba angular', 'Gojo', NULL, 1, '2026-05-04 20:28:14', '2026-05-04 20:28:14'),
(52, 'cleaner-6Obf76UB', 'Escoba angular', 'Jhonsson', NULL, 1, '2026-05-04 20:28:19', '2026-05-04 20:28:19'),
(53, 'cleaner-Wnr34CBL', 'Jalador de pisos', 'Gojo', NULL, 1, '2026-05-04 20:29:09', '2026-05-04 20:29:09'),
(54, 'cleaner-0TICLRxt', 'Jalador de pisos', 'Byozone', NULL, 1, '2026-05-04 20:29:17', '2026-05-04 20:29:17'),
(55, 'cleaner-d47XGLoI', 'Jalador de pisos', 'Salvo', NULL, 1, '2026-05-04 20:29:25', '2026-05-04 20:29:25'),
(56, 'cleaner-FKGxD0UM', 'Escoba de cepillo de largo de 40 cm', 'Rubbermaid', NULL, 1, '2026-05-04 20:30:07', '2026-05-04 20:30:07'),
(57, 'cleaner-me4IPiEi', 'Escoba de cepillo de largo de 40 cm', 'Byozone', NULL, 1, '2026-05-04 20:30:13', '2026-05-04 20:30:13'),
(58, 'cleaner-sBHpkjQz', 'Escoba de cepillo de largo de 40 cm', 'Byozone', NULL, 1, '2026-05-04 20:30:18', '2026-05-04 20:30:18'),
(59, 'cleaner-sO0kjaQ7', 'Espátulas de hierro', 'BeoClean', NULL, 1, '2026-05-04 20:31:13', '2026-05-04 20:31:13'),
(60, 'cleaner-aacCZFzX', 'Espátulas de hierro', 'BeoClean', NULL, 1, '2026-05-04 20:31:20', '2026-05-04 20:31:20'),
(61, 'cleaner-gzeWy5ns', 'Espátulas de hierro', 'BeoClean', NULL, 1, '2026-05-04 20:31:27', '2026-05-04 20:31:27'),
(62, 'cleaner-yRgWCy9g', 'Jalador de vidrios', 'Oval', NULL, 1, '2026-05-04 20:31:49', '2026-05-04 20:31:49'),
(63, 'cleaner-qCmd5Cjl', 'Jalador de vidrios', 'Oval', NULL, 1, '2026-05-04 20:31:55', '2026-05-04 20:31:55'),
(64, 'cleaner-UIYZGudG', 'Jalador de vidrios', 'Oval', NULL, 1, '2026-05-04 20:32:01', '2026-05-04 20:32:01'),
(65, 'cleaner-965xnzJN', 'Jalador de vidrios', 'Salvo', NULL, 1, '2026-05-04 20:32:06', '2026-05-04 20:32:06'),
(66, 'cleaner-IzkCdidp', 'Paños de limpieza de microfibra', 'Glade', NULL, 1, '2026-05-04 20:32:25', '2026-05-04 20:32:25'),
(67, 'cleaner-3r9vfQMP', 'Paños de limpieza de microfibra', 'Glade', NULL, 1, '2026-05-04 20:32:33', '2026-05-04 20:32:33'),
(68, 'cleaner-epHOQpGX', 'Recojedor', 'Solprac', NULL, 1, '2026-05-04 20:32:59', '2026-05-04 20:32:59'),
(69, 'cleaner-iWOXkDe1', 'Recojedor', 'Byozone', NULL, 1, '2026-05-04 20:33:04', '2026-05-04 20:33:04'),
(70, 'cleaner-tfmhuGkm', 'Recojedor', 'Salvo', NULL, 1, '2026-05-04 20:33:10', '2026-05-04 20:33:10'),
(71, 'cleaner-vrLi1glP', 'Espátula', 'Wiese', NULL, 1, '2026-05-04 20:34:27', '2026-05-04 20:34:27'),
(72, 'cleaner-bIBatqRX', 'Trapeador corto', 'Uline', NULL, 1, '2026-05-04 20:34:49', '2026-05-04 20:34:49'),
(73, 'cleaner-jiP4gZm1', 'Trapeador corto', 'Wiese', NULL, 1, '2026-05-04 20:34:55', '2026-05-04 20:34:55'),
(74, 'cleaner-ofvWO8U4', 'Trapeador corto', 'Byozone', NULL, 1, '2026-05-04 20:34:59', '2026-05-04 20:34:59'),
(75, 'cleaner-HJus1zRn', 'Trapeador de microfibra', 'Gojo', NULL, 1, '2026-05-04 20:35:18', '2026-05-04 20:35:18'),
(76, 'cleaner-RI6OhaaA', 'Trapeador de microfibra', 'Rubbermaid', NULL, 1, '2026-05-04 20:35:24', '2026-05-04 20:35:24'),
(77, 'cleaner-5eipa8bN', 'Trapeador largo', 'Rubbermaid', NULL, 1, '2026-05-04 20:35:42', '2026-05-04 20:35:42'),
(78, 'cleaner-DZnFPMpJ', 'Trapeador largo', 'Rubbermaid', NULL, 1, '2026-05-04 20:35:47', '2026-05-04 20:35:47'),
(79, 'cleaner-UuyS1K5L', 'Trapeador rectangular largo de 50 cm', 'Wiese', NULL, 1, '2026-05-04 20:36:07', '2026-05-04 20:36:07'),
(80, 'cleaner-UV43kukT', 'Trapeador rectangular largo de 50 cm', 'Gojo', NULL, 1, '2026-05-04 20:36:11', '2026-05-04 20:36:11'),
(81, 'cleaner-EVH2bQDL', 'Trapeador corto', 'Byozone', NULL, 1, '2026-05-04 20:36:38', '2026-05-04 20:36:38'),
(82, 'cleaner-bpBW1W1b', 'Plumero extensible', 'Wiese', NULL, 1, '2026-05-04 20:36:50', '2026-05-04 20:36:50'),
(83, 'cleaner-kdO41btZ', 'Botella de spray', 'Byozone', NULL, 1, '2026-05-04 21:34:01', '2026-05-04 21:34:01'),
(84, 'cleaner-JGRe8uOt', 'Botella de spray', 'Jhonsson', NULL, 1, '2026-05-04 21:34:06', '2026-05-04 21:34:06'),
(85, 'cleaner-hGZvmUeV', 'Botella de spray', 'Gojo', NULL, 1, '2026-05-04 21:34:12', '2026-05-04 21:34:12'),
(86, 'cleaner-UMIXWUXj', 'Jalador de vidrios', 'Salvo', NULL, 1, '2026-05-04 21:56:10', '2026-05-04 21:56:10'),
(87, 'cleaner-mlcHokDs', 'Jalador de vidrios', 'Gojo', NULL, 1, '2026-05-04 21:56:15', '2026-05-04 21:56:15'),
(88, 'cleaner-VWmeUMgb', 'Plumero extensible', 'Gojo', NULL, 1, '2026-05-04 21:56:23', '2026-05-04 21:56:23'),
(89, 'cleaner-ZzLvFAQZ', 'Plumero extensible', 'Wiese', NULL, 1, '2026-05-04 21:56:29', '2026-05-04 21:56:29'),
(90, 'cleaner-5kBMoGem', 'Plumero extensible', 'Gojo', NULL, 1, '2026-05-04 21:56:35', '2026-05-04 21:56:35'),
(91, 'cleaner-S3hn6wzS', 'Plumero extensible', 'Salvo', NULL, 1, '2026-05-04 21:56:43', '2026-05-04 21:56:43'),
(92, 'cleaner-5ZSMypQ4', 'Plumero extensible', 'Byozone', NULL, 1, '2026-05-04 21:56:52', '2026-05-04 21:56:52'),
(93, 'cleaner-kDPmbjXe', 'Cepillo de limpieza de esquinas', 'Gojo', NULL, 1, '2026-05-06 19:31:01', '2026-05-06 19:31:01'),
(94, 'cleaner-6yEFy9k3', 'Cepillo de limpieza de esquinas', 'Byozone', NULL, 1, '2026-05-06 19:31:11', '2026-05-06 19:31:11'),
(95, 'cleaner-3ei8xKjA', 'Escoba angular', 'Gojo', NULL, 1, '2026-05-06 20:40:16', '2026-05-06 20:40:16'),
(96, 'cleaner-TdRxwjMi', 'Espátula', 'Salvo', NULL, 1, '2026-05-06 20:40:36', '2026-05-06 20:40:36'),
(97, 'cleaner-Lm8IvR2D', 'Paños de limpieza de microfibra', 'Jhonsson', NULL, 1, '2026-05-06 20:40:45', '2026-05-06 20:40:45'),
(98, 'cleaner-pB1AC4RG', 'Plumero corto', 'Gojo', NULL, 1, '2026-05-06 20:40:53', '2026-05-06 20:40:53'),
(99, 'cleaner-TxELS0gm', 'Plumero corto', 'Byozone', NULL, 1, '2026-05-06 20:41:14', '2026-05-06 20:41:14'),
(100, 'cleaner-lsjBCL6h', 'Trapeador de microfibra', 'Jhonsson', NULL, 1, '2026-05-06 20:41:23', '2026-05-06 20:41:23'),
(101, 'cleaner-sU1oWvgO', 'Trapeador rectangular largo de 50 cm', 'Wiese', NULL, 1, '2026-05-06 20:41:56', '2026-05-06 20:41:56'),
(102, 'cleaner-gnDh8nCy', 'Trapeador largo', 'Wiese', NULL, 1, '2026-05-06 20:43:15', '2026-05-06 20:43:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id_notas` int(11) NOT NULL,
  `id_operacion` int(11) DEFAULT NULL,
  `titulo` varchar(150) NOT NULL,
  `escrito` varchar(500) DEFAULT NULL,
  `estatus` tinyint(1) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id_notas`, `id_operacion`, `titulo`, `escrito`, `estatus`, `fecha_creacion`) VALUES
(1, 4, 'Cliente criticon', 'El señor antonio es un cliente distinguido que constantemente tiene desacuerdos en la limpieza, se sugiere mantener mucha limpieza y evitar conflictos con el cliente', 1, '2026-04-06 21:15:08'),
(2, 5, 'Cuidado con el perro', ' La señora Fernanda tiene un pitbull muy bravo se sugiere que se comuniquen primero con la dueña para pedir que lo amarre', 1, '2026-04-06 21:15:08'),
(4, 19, 'Cliente con perro', 'El cliente tiene un pitbull se sugiere ir por la tarde por que en esos tiempos no esta el perro en casa', 1, '2026-04-09 21:22:10'),
(5, 21, 'Patío con reclamos', 'El patío del cliente esta normalmente siendo muy reclamado por el vecino debido a que dice que se sobrepaso en la construcción del hogar del cliente, se sugiere ignorar y continuar con la limpieza.', 1, '2026-04-10 18:26:55'),
(6, 18, 'Cliente criticon', 'sadsasdasdsadas', 0, '2026-04-10 18:29:40'),
(7, 22, 'Casa con techo resbaladizo', 'Se sugiere llevar zapatos especiales para no resbalarse del techo.', 1, '2026-04-10 18:37:44'),
(8, NULL, 'Patío con reclamos', 'sdfdsfdsfsd', 1, '2026-04-23 21:28:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacion`
--

CREATE TABLE `operacion` (
  `id_operacion` int(11) NOT NULL,
  `trabajo_realizado` varchar(200) DEFAULT NULL,
  `estatus` varchar(90) NOT NULL,
  `id_grupo_trabajadores` varchar(120) NOT NULL,
  `id_grupo_productos` varchar(120) NOT NULL,
  `id_grupo_materiales` varchar(120) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_finalizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `operacion`
--

INSERT INTO `operacion` (`id_operacion`, `trabajo_realizado`, `estatus`, `id_grupo_trabajadores`, `id_grupo_productos`, `id_grupo_materiales`, `id_cliente`, `fecha_creacion`, `fecha_finalizacion`) VALUES
(4, 'Trabajo de jardineria', 'Terminado', '2XXTFT78', '2XXTFT78', '2XXTFT78', 7, '2026-01-14 21:00:12', '2026-04-09 12:27:00'),
(5, 'Trabajo de limpieza de patio', 'En proceso', '3XXTFT98', '3XXTFT98', '3XXTFT98', 2, '2026-02-03 21:00:12', '2026-04-01 12:28:00'),
(6, 'Trabajo de limpieza de vidrios', 'Cancelado', '4XXTFT91', '4XXTFT91', '4XXTFT91', 4, '2026-02-07 15:00:00', '2026-04-05 12:28:24'),
(10, 'Trabajo de limpieza de auto', 'En proceso', 'Lfw9sHXp', 'Lfw9sHXp', 'Lfw9sHXp', 7, '2026-04-06 19:12:48', '2026-04-07 12:28:37'),
(11, 'Trabajo de limpieza de baño', 'Terminado', 'kykAnKNc', 'kykAnKNc', 'kykAnKNc', 10, '2026-04-06 19:13:35', '2026-04-07 12:29:07'),
(12, 'Trabajo de limpieza de baño', 'En proceso', 'zhK5PNqo', 'zhK5PNqo', 'zhK5PNqo', 10, '2026-04-06 19:14:44', '2026-04-07 12:29:16'),
(13, 'Trabajo de limpieza de baño', 'En proceso', 'ne5VIHWP', 'ne5VIHWP', 'ne5VIHWP', 11, '2026-04-06 19:20:30', '2026-04-07 12:29:24'),
(14, 'Trabajo de limpieza de patio', 'Cancelado', '0kjPQDSi', '0kjPQDSi', '0kjPQDSi', 7, '2026-04-06 21:00:38', '2026-04-07 12:29:30'),
(15, 'Trabajo de limpieza de autolavado con toallas', 'En proceso', 'MRT0lai7', 'MRT0lai7', 'MRT0lai7', 1, '2026-04-06 21:52:13', '2026-04-07 12:29:38'),
(18, 'Trabajo de limpieza de baño', 'Terminado', 'MkAPdm0o', 'MkAPdm0o', 'MkAPdm0o', 1, '2026-04-09 20:58:52', '2026-04-09 14:37:23'),
(19, 'Limpieza de cochera', 'Terminado', 'm1AuZFlD', 'm1AuZFlD', 'm1AuZFlD', 2, '2026-04-09 21:22:10', '2026-04-09 14:37:32'),
(21, 'Trabajo de limpieza de almacén de autos viejos', 'En proceso', 'DiOYBT5q', 'DiOYBT5q', 'DiOYBT5q', 3, '2026-04-10 18:02:44', '2026-04-13 11:04:00'),
(22, 'Trabajo de limpieza de techo', 'En proceso', 'Qz74N14I', 'Qz74N14I', 'Qz74N14I', 10, '2026-04-10 18:37:03', '2026-04-16 12:08:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `cantidad` double DEFAULT NULL,
  `reserva` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `medida` varchar(120) DEFAULT NULL,
  `conservado` varchar(120) DEFAULT NULL,
  `tipo` varchar(120) DEFAULT NULL,
  `marca` varchar(120) DEFAULT NULL,
  `estatus` tinyint(1) DEFAULT 1,
  `fecha_eliminacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `cantidad`, `reserva`, `total`, `medida`, `conservado`, `tipo`, `marca`, `estatus`, `fecha_eliminacion`, `fecha_creacion`) VALUES
(3, 'Blanqueador concentrado', 30, 121, 3630, 'fl oz', 'Botellas', 'Liquido', 'Clorox', 1, '2026-05-11 19:27:51', '2026-03-27 18:23:19'),
(6, 'Gel desmaquillador', 5, 121, 605, 'fl oz', 'Frascos', 'Geles', 'Stain Cleaner', 1, '2026-05-11 19:27:23', '2026-03-27 18:23:19'),
(7, 'Limpiador de pisos', 7, 7, 49, 'Unidades', 'Bolsas', 'Pastillas', 'Wow! Clean', 1, '2026-05-06 20:39:15', '2026-03-27 18:23:19'),
(8, 'Toallas desinfectantes', 7, 8, 56, 'Unidades', 'Frascos', 'Toallitas humedas', 'Lysol', 1, '2026-05-04 20:50:03', '2026-03-27 18:23:19'),
(9, 'Pastillas activas para retrete', 9, 7, 483, 'Unidades', 'Tubos', 'Pastillas', 'Harpic', 1, '2026-05-04 20:50:03', '2026-03-27 18:23:19'),
(10, 'Limpiador quita sarro de retrete', 7, 7, 49, 'Unidades', 'Bolsas', 'Pastillas', 'BeoClean', 1, '2026-05-04 20:50:03', '2026-03-27 18:23:19'),
(11, 'Discos activos de aromatizante de retrete', 53, 7, 371, 'Unidades', 'Tubos', 'Pastillas', 'Pato', 1, '2026-05-04 20:50:03', '2026-03-27 18:23:19'),
(12, 'Limpiador de teclados y arranca polvo de aparatos de electrónica', 15, 4, 60, 'Unidades', 'Cajas', 'Geles', 'TABS', 1, '2026-05-04 20:50:03', '2026-03-27 18:23:19'),
(13, 'Pastillas de tratamiento con cloro para agua', 6, 12, 312, 'Unidades', 'Bolsas', 'Pastillas', 'TABS', 1, '2026-05-04 20:50:03', '2026-03-27 18:23:19'),
(14, 'Liquido en cloro', 6, 121, 726, 'fl oz', 'Botellas', 'Liquido', 'Cloralex', 1, '2026-05-11 19:26:46', '2026-03-27 18:23:19'),
(15, 'Gel de inodoro', 40, 7, 280, 'Unidades', 'Tubos', 'Pastillas', 'KILOSTEP', 1, '2026-05-06 20:45:26', '2026-03-27 18:23:19'),
(16, 'Aromatizante para WC', 6, 121, 726, 'fl oz', 'Botellas', 'Sprays', 'Scent Colors', 1, '2026-05-11 19:26:32', '2026-03-27 18:23:19'),
(18, 'Gel antibacterial', 1, 100, 100, 'fl oz', 'Botellas', 'Geles', 'Blumen', 1, '2026-05-12 18:27:22', '2026-03-27 18:23:19'),
(19, 'Gel Antibacterial', 14, 121, 1694, 'fl oz', 'Botellas', 'Geles', 'Walfort', 1, '2026-05-11 19:24:23', '2026-03-27 18:23:19'),
(21, 'Jabón para Trastes', 14, 32, 448, 'fl oz', 'Botellas', 'Liquido', 'Uline', 1, '2026-05-11 19:29:05', '2026-03-30 19:37:40'),
(22, 'Desinfectante de baños', 14, 32, 448, 'fl oz', 'Botellas', 'Sprays', 'Jhonson', 1, '2026-05-11 19:17:39', '2026-04-22 19:21:13'),
(23, 'Lava trastes', 30, 32, 960, 'fl oz', 'Botellas', 'Liquido', 'Salvamanos', 1, '2026-05-11 19:17:16', '2026-04-23 21:34:59'),
(24, 'Blanqueador concentrado', 33, 700, 23100, 'Oz', 'Botellas', 'Liquido', 'Byozone', 0, '2026-05-04 20:50:03', '2026-05-04 20:47:45'),
(25, 'Blanqueador concentrado', 33, 700, 23100, 'Oz', 'Botellas', 'Liquido', 'Salvo', 0, '2026-05-04 20:50:03', '2026-05-04 20:48:04'),
(26, 'Liquido de cloro', 6, 121, 726, 'fl oz', 'Botellas', 'Liquido', 'Clorox', 1, '2026-05-11 19:14:47', '2026-05-11 19:14:47');

--
-- Disparadores `productos`
--
DELIMITER $$
CREATE TRIGGER `calcular_total_productos_insert` BEFORE INSERT ON `productos` FOR EACH ROW BEGIN
    -- Calculamos el total multiplicando la nueva cantidad por la reserva
    SET NEW.total = NEW.cantidad * NEW.reserva;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calcular_total_productos_update` BEFORE UPDATE ON `productos` FOR EACH ROW BEGIN
    -- Si cambia la cantidad o la reserva, actualizamos el total automáticamente
    SET NEW.total = NEW.cantidad * NEW.reserva;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rh`
--

CREATE TABLE `rh` (
  `id_trabajador` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `rol` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(150) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `entre_calles` varchar(200) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `numero_telefonico` bigint(11) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rh`
--

INSERT INTO `rh` (`id_trabajador`, `nombre`, `apellidos`, `rol`, `password`, `edad`, `direccion`, `entre_calles`, `correo`, `numero_telefonico`, `activo`, `fecha_creacion`) VALUES
(1, 'Juan Pedro', 'Lagunillas Romero', 0, '', 29, 'Colonia: Juan Escutia, Calle: Salamanca #33', 'Parque Sovietico y Rio suchiatorio', 'jupe@gmail.com', 3117885890, 0, '2026-03-05 18:32:29'),
(2, 'Ricardo Canaya', 'Riquin Canallin', 0, '', 32, 'Colonia: Vistas de la cantera, Calle: Villa de Luevano #89', 'Villa de Cordoba y Villa de León', 'rica@hotmail.com', 3117764533, 0, '2026-03-05 18:32:29'),
(3, 'Esmeralda Luna', 'Soto Camayo', 1, '12345', 45, 'Colonia: Agustín Iturbide, Calle: Bolivia #112', 'Parque Argentina y África ', 'eslu@gmail.com', 3118909907, 1, '2026-03-05 18:32:29'),
(4, 'Violeta Laura', 'Lomeli Palomas', 0, NULL, 23, 'Colonia: Vistas de la cantera, Calle: Real del Monte #43', 'Real de Plata y Real de Huasca', 'vila@hotmail.com', 3111215543, 1, '2026-03-05 18:32:29'),
(5, 'Paloma', 'Veridiana Camillas', 0, NULL, 25, 'Colonia: Villas de la cantera, Calle: Rubi #117', 'Agua Marina y Blvd Granate', 'pave@gmail.com', 3119900766, 1, '2026-03-05 18:32:29'),
(6, 'Manuel Fernando', 'Coronel Figueroa', 0, NULL, 28, 'Colonia: Jacarandas, Calle: Villa del Este #342', 'Topacio y Villa del Niño', 'mafe@gmail.com', 3115564034, 0, '2026-03-05 18:32:29'),
(7, 'José Maximiliano', 'Cantabrana Esquivel', 1, 'max12345', 27, 'Colonia: Real Montecarlo, Calle: Mona #14', 'Furina y Arlecchino', 'joma@gmail.com', 3113221999, 1, '2026-03-05 18:32:29'),
(8, 'Liliana Karla', 'Hidalgo Goméz', 0, '', 34, 'Colonia: Cd. Del Valle, Calle: Lomas del Valle #77', 'Parque San Pedro y Loma Verde', 'lika@outlook.com', 3118909976, 0, '2026-03-05 18:32:29'),
(9, 'techdomoti01', 'Sauces', 1, '12345', 38, 'Colonia: Los Sauces, Calle: Girasol #54', 'Rosa y Cardo', 'techdomotic@gmail.com', 3117786423, 1, '2026-03-05 18:32:29'),
(10, 'Christian Alejandro', 'Gutierréz Goméz', 0, '0', 23, 'Colonia: Juan Hernandez Gárcia, Calle: Bolillo #23', 'Donas espolvoreadas y Empanadas', 'cagg@gmail.com', 3112322211, 1, '2026-03-12 19:06:19'),
(11, 'Mario Enrique', 'Ordáz Ortíz', 0, '0', 29, 'Colonia: Amado Nervo, Calle: Tesorero #442', 'Guevara y Miguel Hidalgo', 'meoo@hotmail.com', 3115668799, 1, '2026-03-12 19:26:40'),
(12, 'Michelle Yazmín', 'Tirado Valenzuela', 0, NULL, 28, 'Colonia: Juan Escutia, Calle: Salamanca #35', 'Parque Sovietico y Rio Suchiate', 'mytv@gmail.com', 3113423377, 1, '2026-03-12 19:32:04'),
(13, 'Kevin José', 'Aguirre Lomeda', 0, '', 29, 'Colonia: Juan Escutia, Calle: Salamanca #37', 'Parque Sovietico y Rio Suchiate', 'kjal@gmail.com', 3117885899, 1, '2026-03-12 19:48:56'),
(14, 'Ricardo Manuel', 'Ocegueda Figueroa', 1, '12345', 33, 'Colonia: Juan Escutia, Calle: Salamanca #39', 'Parque Sovietico y Rio Suchiate', 'rmof@gmail.com', 3117885872, 1, '2026-03-12 19:57:47'),
(15, 'Juan Manuel', 'Arellano Mendoza', 1, '12345567', 37, 'Colonia: Juan Escutia, Calle: Salamanca #41', 'Parque Sovietico y Rio Suchiate', 'jmam@hotmail.com', 3117885812, 1, '2026-03-12 19:59:41'),
(16, 'Fernando Hugo', 'Ayala Montéz', 1, '12345', 39, 'Colonia: Juan Escutia, Calle: Salamanca #43', 'Parque Sovietico y Rio Suchiate', 'fham@gmail.com', 3111125634, 1, '2026-03-12 20:02:03'),
(17, 'Carlos Alberto', 'Mendoza Ruiz', 0, NULL, 31, 'Colonia: Las Brisas, Calle: Mar Caribe #120', 'Océano Pacífico y Mar Rojo', 'came@gmail.com', 3114456677, 1, '2026-03-30 20:21:42'),
(18, 'Andrea Sofía', 'Pérez Lozano', 0, '', 26, 'Colonia: Valle Dorado, Calle: Oro #56', 'Plata y Bronce', 'anso@hotmail.com', 3115567788, 0, '2026-03-30 20:21:42'),
(19, 'Luis Fernando', 'García Torres', 0, NULL, 35, 'Colonia: El Tecolote, Calle: Roble #89', 'Pino y Encino', 'lufe@gmail.com', 3116678899, 1, '2026-03-30 20:21:42'),
(20, 'Mariana Guadalupe', 'Castro Silva', 0, NULL, 22, 'Colonia: Centro, Calle: Hidalgo #101', 'Morelos y Juárez', 'maca@hotmail.com', 3117789900, 1, '2026-03-30 20:21:42'),
(21, 'Roberto', 'Navarro Salinas', 1, 'robn123', 40, 'Colonia: Jardines del Valle, Calle: Magnolia #77', 'Tulipán y Gardenia', 'rona@gmail.com', 3118899001, 1, '2026-03-30 20:21:42'),
(22, 'Daniela', 'Ortega Campos', 0, NULL, 29, 'Colonia: Villas del Roble, Calle: Cedro #65', 'Nogal y Abeto', 'daor@hotmail.com', 3119900112, 1, '2026-03-30 20:21:42'),
(23, 'Miguel Ángel', 'Ríos Delgado', 0, NULL, 33, 'Colonia: Santa Teresita, Calle: Azucena #150', 'Clavel y Rosa', 'miri@gmail.com', 3112233445, 1, '2026-03-30 20:21:42'),
(24, 'Patricia', 'López Herrera', 1, 'pat12345', 37, 'Colonia: Las Flores, Calle: Jazmín #200', 'Lirio y Orquídea', 'palo@hotmail.com', 3113344556, 1, '2026-03-30 20:21:42'),
(25, 'Jorge Luis', 'Vega Castillo', 0, NULL, 28, 'Colonia: Puerta del Sol, Calle: Eclipse #12', 'Sol y Luna', 'jove@gmail.com', 3114455667, 1, '2026-03-30 20:21:42'),
(26, 'Fernanda', 'Cruz Morales', 0, NULL, 24, 'Colonia: Nuevo Amanecer, Calle: Aurora #88', 'Estrella y Cometa', 'fecr@hotmail.com', 3115566778, 1, '2026-03-30 20:21:42'),
(1001, 'LucyFlores', 'Admin Uno', 1, 'Tech7482', NULL, NULL, NULL, 'LucyFlores@gmail.com', NULL, 1, '2026-04-20 21:14:23'),
(1002, 'techdomotic', 'Admin Dos', 1, 'Tech7889', NULL, NULL, NULL, 'techdomotic@gmail.com', NULL, 1, '2026-04-20 21:14:23');

--
-- Disparadores `rh`
--
DELIMITER $$
CREATE TRIGGER `prevent_delete_superadmins` BEFORE DELETE ON `rh` FOR EACH ROW BEGIN
    -- Si el ID es alguno de los super admins, lanzamos un error
    IF OLD.id_trabajador IN (1001, 1002) THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Error: No se permite eliminar a los Administradores principales del sistema.';
    END IF;
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `crm`
--
ALTER TABLE `crm`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `grupos_materiales`
--
ALTER TABLE `grupos_materiales`
  ADD PRIMARY KEY (`id_grupo_materiales`);

--
-- Indices de la tabla `grupos_productos`
--
ALTER TABLE `grupos_productos`
  ADD PRIMARY KEY (`id_grupo_productos`);

--
-- Indices de la tabla `grupos_trabajadores`
--
ALTER TABLE `grupos_trabajadores`
  ADD PRIMARY KEY (`id_grupo_trabajadores`);

--
-- Indices de la tabla `grupo_materiales`
--
ALTER TABLE `grupo_materiales`
  ADD PRIMARY KEY (`id_interno`),
  ADD KEY `idx_grupo_codigo` (`id_grupo_materiales`),
  ADD KEY `fk_materiales_grupomateriales` (`id_material`);

--
-- Indices de la tabla `grupo_productos`
--
ALTER TABLE `grupo_productos`
  ADD PRIMARY KEY (`id_grupo_productos`,`id_producto`),
  ADD KEY `fk_productos_grupoproductos` (`id_producto`);

--
-- Indices de la tabla `grupo_trabajadores`
--
ALTER TABLE `grupo_trabajadores`
  ADD PRIMARY KEY (`id_grupo_trabajadores`,`id_trabajador`),
  ADD KEY `fk_RH_grupotrabajadores` (`id_trabajador`);

--
-- Indices de la tabla `limitante`
--
ALTER TABLE `limitante`
  ADD PRIMARY KEY (`id_limite`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_notas`),
  ADD KEY `fk_operacion_nota` (`id_operacion`);

--
-- Indices de la tabla `operacion`
--
ALTER TABLE `operacion`
  ADD PRIMARY KEY (`id_operacion`),
  ADD KEY `fk_grupostrabajadores_operacion` (`id_grupo_trabajadores`),
  ADD KEY `fk_gruposproductos_operacion` (`id_grupo_productos`),
  ADD KEY `fk_gruposmateriales_operacion` (`id_grupo_materiales`),
  ADD KEY `fk_cliente_operacion` (`id_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `rh`
--
ALTER TABLE `rh`
  ADD PRIMARY KEY (`id_trabajador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `crm`
--
ALTER TABLE `crm`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `grupo_materiales`
--
ALTER TABLE `grupo_materiales`
  MODIFY `id_interno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `limitante`
--
ALTER TABLE `limitante`
  MODIFY `id_limite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id_notas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `operacion`
--
ALTER TABLE `operacion`
  MODIFY `id_operacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `rh`
--
ALTER TABLE `rh`
  MODIFY `id_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `grupo_materiales`
--
ALTER TABLE `grupo_materiales`
  ADD CONSTRAINT `fk_grupomateriales_gruposmateriales` FOREIGN KEY (`id_grupo_materiales`) REFERENCES `grupos_materiales` (`id_grupo_materiales`),
  ADD CONSTRAINT `fk_materiales_grupomateriales` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`) ON DELETE SET NULL;

--
-- Filtros para la tabla `grupo_productos`
--
ALTER TABLE `grupo_productos`
  ADD CONSTRAINT `fk_grupoproductos_gruposproductos` FOREIGN KEY (`id_grupo_productos`) REFERENCES `grupos_productos` (`id_grupo_productos`),
  ADD CONSTRAINT `fk_productos_grupoproductos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `grupo_trabajadores`
--
ALTER TABLE `grupo_trabajadores`
  ADD CONSTRAINT `fk_RH_grupotrabajadores` FOREIGN KEY (`id_trabajador`) REFERENCES `rh` (`id_trabajador`),
  ADD CONSTRAINT `fk_grupotrabajadores_grupostrabajadores` FOREIGN KEY (`id_grupo_trabajadores`) REFERENCES `grupos_trabajadores` (`id_grupo_trabajadores`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `fk_operacion_nota` FOREIGN KEY (`id_operacion`) REFERENCES `operacion` (`id_operacion`) ON DELETE CASCADE;

--
-- Filtros para la tabla `operacion`
--
ALTER TABLE `operacion`
  ADD CONSTRAINT `fk_cliente_operacion` FOREIGN KEY (`id_cliente`) REFERENCES `crm` (`id_cliente`),
  ADD CONSTRAINT `fk_gruposmateriales_operacion` FOREIGN KEY (`id_grupo_materiales`) REFERENCES `grupos_materiales` (`id_grupo_materiales`),
  ADD CONSTRAINT `fk_gruposproductos_operacion` FOREIGN KEY (`id_grupo_productos`) REFERENCES `grupos_productos` (`id_grupo_productos`),
  ADD CONSTRAINT `fk_grupostrabajadores_operacion` FOREIGN KEY (`id_grupo_trabajadores`) REFERENCES `grupos_trabajadores` (`id_grupo_trabajadores`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
