-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2026 a las 23:24:24
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
  `id_grupo_materiales` varchar(120) NOT NULL,
  `id_material` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultima_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupo_materiales`
--

INSERT INTO `grupo_materiales` (`id_grupo_materiales`, `id_material`, `cantidad`, `fecha_creacion`, `ultima_actualizacion`) VALUES
('2XXTFT78', 1, 4, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('2XXTFT78', 2, 20, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('2XXTFT78', 3, 11, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('3XXTFT98', 3, 7, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('3XXTFT98', 5, 1, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('3XXTFT98', 7, 2, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('3XXTFT98', 8, 3, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('3XXTFT98', 9, 20, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('3XXTFT98', 11, 20, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('3XXTFT98', 12, 22, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('3XXTFT98', 13, 10, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('4XXTFT91', 2, 9, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('4XXTFT91', 3, 8, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('4XXTFT91', 9, 7, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('Lfw9sHXp', 3, 1, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('Lfw9sHXp', 18, 1, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('MkAPdm0o', 2, 4, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('MkAPdm0o', 6, 20, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('ne5VIHWP', 5, 11, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('Qz74N14I', 1, 11, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('Qz74N14I', 2, 2, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('Qz74N14I', 4, 9, '2026-04-15 18:02:25', '2026-04-15 18:03:27'),
('Qz74N14I', 11, 3, '2026-04-15 18:02:25', '2026-04-15 18:03:27');

--
-- Disparadores `grupo_materiales`
--
DELIMITER $$
CREATE TRIGGER `after_delete_grupo_materiales` AFTER DELETE ON `grupo_materiales` FOR EACH ROW BEGIN
    UPDATE material
    SET cantidad = cantidad + OLD.cantidad
    WHERE id_material = OLD.id_material;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_grupo_materiales` BEFORE INSERT ON `grupo_materiales` FOR EACH ROW BEGIN
    DECLARE stock_actual DOUBLE;

    SELECT cantidad INTO stock_actual
    FROM material
    WHERE id_material = NEW.id_material;

    IF stock_actual < NEW.cantidad THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No hay suficiente stock';
    ELSE
        UPDATE material
        SET cantidad = cantidad - NEW.cantidad
        WHERE id_material = NEW.id_material;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_grupo_materiales` BEFORE UPDATE ON `grupo_materiales` FOR EACH ROW BEGIN
    DECLARE diferencia DOUBLE;
    DECLARE stock_actual DOUBLE;

    SET diferencia = NEW.cantidad - OLD.cantidad;

    IF diferencia > 0 THEN
        -- Solo validar si está aumentando
        SELECT cantidad INTO stock_actual
        FROM materiales
        WHERE id_material = NEW.id_material;

        IF stock_actual < diferencia THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'No hay suficiente stock para actualizar';
        END IF;

        UPDATE material
        SET cantidad = cantidad - diferencia
        WHERE id_material = NEW.id_material;

    ELSE
        -- Si reduces cantidad → devolver stock
        UPDATE material
        SET cantidad = cantidad + ABS(diferencia)
        WHERE id_material = NEW.id_material;
    END IF;

END
$$
DELIMITER ;

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
('2XXTFT78', 10, 1, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 20:35:54'),
('2XXTFT78', 11, 1, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 20:35:55'),
('2XXTFT78', 12, 1, NULL, NULL, '2026-04-15 18:09:51', '2026-04-15 20:35:55'),
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
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id_material` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad` double DEFAULT NULL,
  `marca` varchar(120) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id_material`, `nombre`, `cantidad`, `marca`, `fecha_creacion`) VALUES
(1, 'Trapiadores largos', 12, 'Generico', '2026-03-10 18:55:11'),
(2, 'Escobas', 1, 'Generico', '2026-03-10 18:55:11'),
(3, 'Aspiradoras', 0, 'Kymberly-Clark', '2026-03-10 18:55:11'),
(4, 'Cubetas', 25, 'Fapsa', '2026-03-10 18:55:11'),
(5, 'Recojedores', 1, 'Solprac', '2026-03-10 18:55:11'),
(6, 'Cepillo para inodoro', 3, 'Tork', '2026-03-10 18:55:11'),
(7, 'Espátulas', 21, 'Tork', '2026-03-10 18:55:11'),
(8, 'Plumero extensible', 18, 'Biozone', '2026-03-10 18:55:11'),
(9, 'Plumero corto', 3, 'Biozone', '2026-03-10 18:55:11'),
(10, 'Paños de limpieza de microfibra', 33, 'Glade', '2026-03-10 18:55:11'),
(11, 'Jalador de pisos', 1, 'Oval', '2026-03-10 18:55:11'),
(12, 'Jalador de vidrios', 32, 'Oval', '2026-03-10 18:55:11'),
(13, 'Destapacaños', 1, 'Jofel', '2026-03-10 18:55:11'),
(14, 'Cinta destapacaños', 32, 'Gojo', '2026-03-10 18:55:11'),
(15, 'Cepillo de limpieza de esquinas', 19, 'Wiese', '2026-03-10 18:55:11'),
(18, 'Pañuelos de limpieza de algodón', 11, 'TABS', '2026-03-30 21:44:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id_notas` int(11) NOT NULL,
  `id_operacion` int(11) DEFAULT NULL,
  `titulo` varchar(150) NOT NULL,
  `escrito` varchar(500) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id_notas`, `id_operacion`, `titulo`, `escrito`, `fecha_creacion`) VALUES
(1, 4, 'Cliente criticon', 'El señor antonio es un cliente distinguido que constantemente tiene desacuerdos en la limpieza, se sugiere mantener mucha limpieza y evitar conflictos con el cliente', '2026-04-06 21:15:08'),
(2, 5, 'Cuidado con el perro', ' La señora Fernanda tiene un pitbull muy bravo se sugiere que se comuniquen primero con la dueña para pedir que lo amarre', '2026-04-06 21:15:08'),
(4, 19, 'Cliente con perro', 'El cliente tiene un pitbull se sugiere ir por la tarde por que en esos tiempos no esta el perro en casa', '2026-04-09 21:22:10'),
(5, 21, 'Patío con reclamos', 'El patío del cliente esta normalmente siendo muy reclamado por el vecino debido a que dice que se sobrepaso en la construcción del hogar del cliente, se sugiere ignorar y continuar con la limpieza.', '2026-04-10 18:26:55'),
(6, 18, 'Cliente criticon', 'sadsasdasdsadas', '2026-04-10 18:29:40'),
(7, 22, 'Casa con techo resbaladizo', 'Se sugiere llevar zapatos especiales para no resbalarse del techo.', '2026-04-10 18:37:44');

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
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `cantidad`, `reserva`, `total`, `medida`, `conservado`, `tipo`, `marca`, `fecha_creacion`) VALUES
(3, 'Blanqueador concentrado', 28, 900, 16200, 'ml', 'Botellas', 'Liquido', 'Clorox', '2026-03-27 18:23:19'),
(6, 'Gel desmaquillador', 7, 600, 4200, 'g', 'Frascos', 'Geles', 'Stain Cleaner', '2026-03-27 18:23:19'),
(7, 'Limpiador de pisos', 7, 7, 49, 'Unidades', 'Bolsas', 'Pastillas', 'Wow! Clean', '2026-03-27 18:23:19'),
(8, 'Toallas desinfectantes', 7, 8, 56, 'Unidades', 'Frascos', 'Toallitas humedas', 'Lysol', '2026-03-27 18:23:19'),
(9, 'Pastillas activas para retrete', 69, 7, 483, 'Unidades', 'Tubos', 'Pastillas', 'Harpic', '2026-03-27 18:23:19'),
(10, 'Limpiador quita sarro de retrete', 7, 7, 49, 'Unidades', 'Bolsas', 'Pastillas', 'BeoClean', '2026-03-27 18:23:19'),
(11, 'Discos activos de aromatizante de retrete', 53, 7, 371, 'Unidades', 'Tubos', 'Pastillas', 'Pato', '2026-03-27 18:23:19'),
(12, 'Limpiador de teclados y arranca polvo de aparatos de electrónica', 15, 4, 60, 'Unidades', 'Cajas', 'Geles', 'TABS', '2026-03-27 18:23:19'),
(13, 'Pastillas de tratamiento con cloro para agua', 26, 12, 312, 'Unidades', 'Bolsas', 'Pastillas', 'TABS', '2026-03-27 18:23:19'),
(14, 'Liquido en cloro', 21, 1, 21, 'L', 'Botellas', 'Liquido', 'Cloralex', '2026-03-27 18:23:19'),
(15, 'Gel de inodoro', 67, 7, 469, 'Unidades', 'Tubos', 'Pastillas', 'KILOSTEP', '2026-03-27 18:23:19'),
(16, 'Aromatizante para WC', 14, 950, 13300, 'ml', 'Botellas', 'Sprays', 'Scent Colors', '2026-03-27 18:23:19'),
(18, 'Gel antibacterial', 10, 100, 1000, 'ml', 'Botellas', 'Geles', 'Blumen', '2026-03-27 18:23:19'),
(19, 'Gel Antibacterial', 14, 60, 840, 'ml', 'Botellas', 'Geles', 'Walfort', '2026-03-27 18:23:19'),
(21, 'Jabón para Trastes', 14, 750, 10500, 'ml', 'Botellas', 'Liquido', 'Uline', '2026-03-30 19:37:40'),
(22, 'Desinfectante de baños', 14, 950, 13300, 'ml', 'Botellas', 'Sprays', 'Jhonson', '2026-04-22 19:21:13');

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
(1, 'Juan Pedro', 'Lagunillas Romero', 0, '', 29, 'Colonia: Juan Escutia, Calle: Salamanca #33', 'Parque Sovietico y Rio suchiatorio', 'jupe@gmail.com', 3117885890, 1, '2026-03-05 18:32:29'),
(2, 'Ricardo Canaya', 'Riquin Canallin', 0, NULL, 32, 'Colonia: Vistas de la cantera, Calle: Villa de Luevano #89', 'Villa de Cordoba y Villa de León', 'rica@hotmail.com', 3117764533, 0, '2026-03-05 18:32:29'),
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
  ADD PRIMARY KEY (`id_grupo_materiales`,`id_material`),
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
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id_notas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `operacion`
--
ALTER TABLE `operacion`
  MODIFY `id_operacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  ADD CONSTRAINT `fk_materiales_grupomateriales` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`);

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
