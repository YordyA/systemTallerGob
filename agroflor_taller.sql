-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-10-2025 a las 09:45:06
-- Versión del servidor: 8.0.43-cll-lve
-- Versión de PHP: 8.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agroflor_taller`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `IDInv` int NOT NULL,
  `IDTipoInv` int NOT NULL,
  `FechaRegInv` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CodigoInv` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `DescripcionInv` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `Existencia` decimal(11,2) NOT NULL,
  `PrecioInv` decimal(11,2) NOT NULL,
  `EstadoInv` int NOT NULL,
  `UltimaActualizacionInv` tinytext COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`IDInv`, `IDTipoInv`, `FechaRegInv`, `CodigoInv`, `DescripcionInv`, `Existencia`, `PrecioInv`, `EstadoInv`, `UltimaActualizacionInv`) VALUES
(1, 1, '2025-08-12 15:31:59', '0001', 'LIMPIEZA DE INYECTORES', 0.00, 20.00, 1, NULL),
(2, 1, '2025-08-12 15:32:43', '0002', 'CAMBIO DE BUJíAS', 0.00, 10.00, 1, NULL),
(3, 1, '2025-08-12 15:33:08', '0003', 'LIMPIEZA DE BUJíAS', 0.00, 10.00, 1, NULL),
(4, 1, '2025-08-12 15:34:54', '0004', 'CAMBIO DE ACEITE', 0.00, 10.00, 1, NULL),
(5, 1, '2025-08-12 15:35:32', '0005', 'CAMBIO DE BOMBA DE COMBUSTIBLE', 0.00, 20.00, 1, NULL),
(6, 1, '2025-09-23 14:25:26', '0006', 'MANTEMIENTO DE FILTROS DIESEL', 0.00, 20.00, 1, NULL),
(7, 1, '2025-09-23 14:41:29', '0007', 'REAPRACION DE MOTOR TRACTOR-ANILLOS-EMPACADURAS-ACEITE-FILTRO', 0.00, 400.00, 1, NULL),
(8, 1, '2025-09-24 14:24:41', '0008', 'ENGRASE DE TREN DELANTERO Y CRUCETAS', 0.00, 10.00, 1, '2025-09-24 02:28:57 PM - TALLER'),
(9, 1, '2025-09-24 14:28:27', '0009', 'CAMBIO DE KIT DE TIEMPO DE 1GR', 0.00, 150.00, 1, '2025-09-24 02:29:07 PM - TALLER'),
(10, 1, '2025-09-24 14:29:39', '0010', 'CAMBIO DE BOMBIN DE CROCHE SUPERIOR', 0.00, 10.00, 1, '2025-09-27 06:35:07 PM - TALLER'),
(11, 2, '2025-09-24 14:41:11', '0001', 'BOMBA DE GASOLINA', 1.00, 10.00, 1, '2025-09-24 02:41:40 PM - TALLER'),
(12, 1, '2025-09-24 14:42:46', '0011', 'LIMPIEZA DE INYECTORES', 0.00, 20.00, 0, '2025-10-04 04:13:03 PM - TALLER'),
(13, 2, '2025-09-24 15:18:25', '0002', 'FILTRO DE GASOLINA', 3.00, 7.00, 1, '2025-09-24 06:18:59 PM - TALLER'),
(14, 1, '2025-09-24 18:18:23', '0012', 'CAMBIO DE FILTRO DE GASOLINA', 0.00, 5.00, 1, NULL),
(15, 1, '2025-09-24 18:27:38', '0013', 'CAMBIO DE ROLINERAS DE PATIN DE CORREA', 0.00, 5.00, 1, NULL),
(16, 2, '2025-09-24 18:28:59', '0003', 'ROLINERA', 0.00, 2.00, 1, NULL),
(17, 1, '2025-09-24 18:32:34', '0014', 'SERVICIO DE ESCANER', 0.00, 20.00, 1, NULL),
(18, 2, '2025-09-24 18:34:03', '004', 'BOMBIN INFERIOR DE CROCHE DE LAND CRUISED', 0.00, 30.00, 1, NULL),
(19, 2, '2025-09-24 18:34:31', '0005', 'BOMBIN SUPERIOR DE CROCHE DE LAND CRUISED', 0.00, 35.00, 1, NULL),
(20, 1, '2025-09-24 18:36:05', '0015', 'CAMBIO DE BOMBIN DE CROCHE INFERIOR', 0.00, 10.00, 1, '2025-09-27 06:35:21 PM - TALLER'),
(21, 2, '2025-09-24 18:46:34', '0006', 'MODULO DE BOMBA DE GASOLINA DE SUPERDUTY', 0.00, 150.00, 1, '2025-09-24 06:47:43 PM - TALLER'),
(22, 2, '2025-09-24 18:51:45', '0007', 'FILTRO DE ACEITE DE 1GR-ETC...', 0.00, 9.00, 1, '2025-09-24 06:52:56 PM - TALLER'),
(23, 2, '2025-09-24 18:54:57', '0008', 'TORNILLO', 0.00, 2.00, 1, '2025-09-27 06:23:07 PM - TALLER'),
(24, 2, '2025-09-24 19:01:20', '0009', 'PUENTE CARDAN DE SUPERDUTY', 0.00, 35.00, 1, '2025-09-24 07:02:38 PM - TALLER'),
(25, 2, '2025-09-24 19:01:40', '0010', 'PUENTE CARDAN DE HILUX', 0.00, 35.00, 1, NULL),
(26, 1, '2025-09-24 19:04:53', '0016', 'CAMBIO DE PUENTE CARDAN', 0.00, 15.00, 1, NULL),
(27, 2, '2025-09-25 18:04:57', '0011', 'BUJIA', 0.00, 5.00, 1, '2025-09-25 06:07:00 PM - TALLER'),
(28, 1, '2025-09-25 18:05:45', '0017', 'CAMBIO DE INYECTORES', 0.00, 12.00, 1, NULL),
(29, 1, '2025-09-25 18:06:25', '0018', 'CAMBIO DE CONERCTORES DE INYECTORES', 0.00, 17.00, 1, NULL),
(30, 2, '2025-09-26 18:15:44', '0019', 'DIODERA DE ALTERNADOR DE HILUX', 0.00, 28.00, 1, '2025-09-26 06:28:45 PM - TALLER'),
(31, 2, '2025-09-26 18:17:19', '0020', 'CARBONERA DE ALTERNADOR DE HILUX', 0.00, 7.00, 1, '2025-09-26 06:29:11 PM - TALLER'),
(32, 1, '2025-09-26 18:18:52', '0019', 'CAMBIO DE DISCO DE FRENO DE HILUX', 0.00, 8.00, 1, NULL),
(33, 1, '2025-09-26 18:20:11', '0020', 'CAMBIO DE PASTILLAS DE FRENO', 0.00, 4.00, 1, NULL),
(34, 1, '2025-09-26 18:30:08', '0021', 'REPARACION DE ALTERNADOR', 0.00, 30.00, 1, NULL),
(35, 1, '2025-09-26 18:30:29', '0022', 'REPARACION DE ARRANQUE', 0.00, 25.00, 1, NULL),
(36, 2, '2025-09-26 18:39:41', '0021', 'VALVULINA 85W-140', 0.00, 12.00, 1, '2025-09-27 06:30:44 PM - TALLER'),
(37, 1, '2025-09-26 18:43:42', '0023', 'REPARACION DE BRAZO DE LIMPIA PARABRISAS DE SUPERDUTY', 0.00, 14.00, 1, NULL),
(38, 1, '2025-09-26 18:48:26', '024', 'MANTENIMIENTO/REVISON DE FRENOS', 0.00, 5.00, 1, '2025-09-26 06:49:12 PM - TALLER'),
(39, 1, '2025-09-27 18:24:29', '0025', 'REPARACION DE FUGA DE AIRE POR BAJANTE DE TUBO DE ESCAPE DE 4.500', 0.00, 14.00, 1, NULL),
(40, 2, '2025-09-27 18:34:08', '0022', 'KIT DE GOMAS DE BOMBIN SUPERIOR DE CROCHE DE LAND CRUISED', 0.00, 8.00, 1, NULL),
(41, 2, '2025-09-27 18:34:34', '0023', 'KIT DE GOMAS DE BOMBIN INFERIOR DE CROCHE DE LAND CRUISED', 0.00, 8.00, 1, NULL),
(42, 1, '2025-09-27 19:05:35', '0026', 'REPARACION DETREN DELANTERO', 0.00, 100.00, 1, NULL),
(43, 1, '2025-09-27 19:14:01', '0027', 'SERVICIO DE SOLDADURA', 0.00, 6.00, 1, NULL),
(44, 1, '2025-09-27 19:15:18', '0028', 'CAMBIO DE MOZOS DE SUPERDUTY', 0.00, 60.00, 1, NULL),
(45, 2, '2025-09-27 19:20:11', '0024', 'CRUCETA DE 4.500', 0.00, 20.00, 1, NULL),
(46, 1, '2025-09-27 19:20:41', '0029', 'CAMBIO DE CRUCETA', 0.00, 15.00, 1, NULL),
(47, 1, '2025-09-30 10:27:00', '0030', 'CAMBIO DE HUESITOS DEL TREN DELANTERO', 0.00, 15.00, 1, NULL),
(48, 2, '2025-09-30 10:47:18', '0025', 'ESTOPERA DEL DAMPER DE LAND CRUISED', 0.00, 7.00, 1, NULL),
(49, 2, '2025-09-30 10:51:55', '0026', 'ESTOPERA DE JOSKIE TRASERO DE LAND CRUISED', 0.00, 25.00, 1, NULL),
(50, 1, '2025-09-30 10:56:01', '0031', 'CAMBIO DE ESTOPERA DEL DAMPER 4500', 0.00, 30.00, 1, NULL),
(51, 1, '2025-09-30 10:56:49', '0032', 'CAMBIO DE ESTOPERA DEL JOSKIE TRASERO 4500', 0.00, 30.00, 1, NULL),
(52, 1, '2025-10-01 15:22:11', '0033', 'CAMBIO DE GOMAS DE AMORTGUADOR TRASERO DE LAND CRUISED', 0.00, 10.00, 1, NULL),
(53, 2, '2025-10-01 15:22:53', '0027', 'AMORTIGUADOR TRASERO DE LAND CRUISED', 0.00, 60.00, 1, NULL),
(54, 2, '2025-10-01 15:26:48', '0028', 'PAR GOMAS DE AMORTGUADOR TRASERO DE LAND CRUISED', 0.00, 8.00, 1, NULL),
(55, 2, '2025-10-01 16:11:30', '0029', 'KIT DE GOMAS DE BOMBIN DE CROCHE INFERIOR DE LAND CRUISED', 0.00, 6.00, 1, NULL),
(56, 2, '2025-10-01 16:12:02', '0030', 'KIT DE GOMAS DE BOMBIN DE CROCHE SUPERIOR DE LAND CRUISED', 0.00, 7.00, 1, NULL),
(57, 1, '2025-10-04 15:52:33', '0034', 'REPARACION DE VALVULA DE MINIMO DE 4.500', 0.00, 15.00, 1, NULL),
(58, 1, '2025-10-04 16:14:22', '0011', 'CAMBIO DE TENSOR DE CORREA UNICA DE SUPERDUTY', 0.00, 10.00, 1, NULL),
(59, 1, '2025-10-04 16:15:58', '0035', 'CAMBIO DE PATIN DE CORREA UNICA', 0.00, 6.00, 1, '2025-10-04 05:36:37 PM - TALLER'),
(60, 1, '2025-10-04 16:24:04', '0036', 'REPARACION DE BOMBIN DE CROCHE SUPERIOR DE LAND CRUISED', 0.00, 6.00, 1, NULL),
(61, 1, '2025-10-04 16:24:32', '0037', 'REPARACION DE BOMBIN DE CROCHE INFERIOR DE LAND CRUISED', 0.00, 5.00, 1, NULL),
(62, 1, '2025-10-04 16:30:23', '0038', 'AJUSTE DE ROLINERA DE PUNTA DE EJE LAND CRUISED', 0.00, 7.00, 1, NULL),
(63, 2, '2025-10-04 16:40:27', '0031', 'AMORTIGUADOR DELANTERO DE SUPERDUTY', 0.00, 70.00, 1, NULL),
(64, 1, '2025-10-04 16:42:56', '0039', 'CAMBIO DE AMORTIGUADOR DELANTERO DE SUPERDUTY', 0.00, 10.00, 1, NULL),
(65, 1, '2025-10-04 16:51:05', '0040', 'CAMBIO DE MOZO DE HILUX', 0.00, 27.00, 1, NULL),
(66, 2, '2025-10-04 16:51:57', '0032', 'MOZO DE HILUX', 0.00, 45.00, 1, NULL),
(67, 1, '2025-10-04 16:54:35', '0041', 'MONTURA DE QUITA RUIDO DE HILUX', 0.00, 10.00, 1, NULL),
(68, 2, '2025-10-04 17:13:41', '0033', 'BUJIA DE SUPERDUTY', 0.00, 6.00, 1, NULL),
(69, 1, '2025-10-04 17:22:56', '0042', 'REVISION COMPLETA DE CABLEADO Y SENSORES DE SUPERDUTY', 0.00, 40.00, 1, NULL),
(70, 2, '2025-10-04 17:23:48', '0043', 'BOBINA DE SUPERDUTY', 4.00, 40.00, 1, NULL),
(71, 1, '2025-10-04 17:35:23', '0043', 'CAMBIO DE CORREA UNICA DE 1GR', 0.00, 8.00, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_movimiento`
--

CREATE TABLE `inventario_movimiento` (
  `IDInvMov` int NOT NULL,
  `FechaRegInvMov` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaMov` date NOT NULL,
  `IDTipoMov` int NOT NULL,
  `IDInv` int NOT NULL,
  `ExistenciaAnterior` decimal(11,2) NOT NULL,
  `Movimiento` decimal(11,2) NOT NULL,
  `ExistenciaActual` decimal(11,2) NOT NULL,
  `ConceptoMov` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `ResponsableMov` tinytext COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario_movimiento`
--

INSERT INTO `inventario_movimiento` (`IDInvMov`, `FechaRegInvMov`, `FechaMov`, `IDTipoMov`, `IDInv`, `ExistenciaAnterior`, `Movimiento`, `ExistenciaActual`, `ConceptoMov`, `ResponsableMov`) VALUES
(1, '2025-09-24 15:19:33', '2025-09-24', 1, 11, 0.00, 1.00, 1.00, 'HILUX CEDRAL', 'TALLER'),
(2, '2025-09-24 15:40:49', '2025-09-24', 2, 11, 1.00, 1.00, 0.00, 'SERVICIO NRO 00003', 'TALLER'),
(3, '2025-09-24 18:16:01', '2025-09-24', 1, 11, 0.00, 6.00, 6.00, 'VEHICULOS REPARADOS AGOSTO', 'TALLER'),
(4, '2025-09-24 18:16:27', '2025-09-24', 1, 13, 0.00, 6.00, 6.00, 'VEHICULOS REPARADOS AGOSTO', 'TALLER'),
(5, '2025-09-24 18:20:46', '2025-09-24', 2, 11, 6.00, 1.00, 5.00, 'SERVICIO NRO 00004', 'TALLER'),
(6, '2025-09-24 18:20:46', '2025-09-24', 2, 13, 6.00, 1.00, 5.00, 'SERVICIO NRO 00004', 'TALLER'),
(7, '2025-09-24 18:29:32', '2025-09-24', 1, 16, 0.00, 2.00, 2.00, 'SUPUER DUTY NEGRO', 'TALLER'),
(8, '2025-09-24 18:31:09', '2025-09-24', 2, 16, 2.00, 2.00, 0.00, 'SERVICIO NRO 00005', 'TALLER'),
(9, '2025-09-24 18:47:30', '2025-09-24', 1, 21, 0.00, 1.00, 1.00, 'SUPERDUTY NEGRO', 'TALLER'),
(10, '2025-09-24 18:49:22', '2025-09-24', 2, 21, 1.00, 1.00, 0.00, 'SERVICIO NRO 00008', 'TALLER'),
(11, '2025-09-24 18:52:43', '2025-09-24', 1, 22, 0.00, 1.00, 1.00, 'PARA 1GR', 'TALLER'),
(12, '2025-09-24 18:54:04', '2025-09-24', 2, 22, 1.00, 1.00, 0.00, 'SERVICIO NRO 00009', 'TALLER'),
(13, '2025-09-24 19:02:28', '2025-09-24', 1, 24, 0.00, 1.00, 1.00, 'SUPERDUTY NEGRO', 'TALLER'),
(14, '2025-09-24 19:03:36', '2025-09-24', 1, 23, 0.00, 1.00, 1.00, 'SUPERDUTY NEGRO', 'TALLER'),
(15, '2025-09-24 19:06:40', '2025-09-24', 2, 24, 1.00, 1.00, 0.00, 'SERVICIO NRO 00010', 'TALLER'),
(16, '2025-09-24 19:06:40', '2025-09-24', 2, 23, 1.00, 1.00, 0.00, 'SERVICIO NRO 00010', 'TALLER'),
(17, '2025-09-24 19:11:15', '2025-09-24', 2, 11, 5.00, 1.00, 4.00, 'SERVICIO NRO 00011', 'TALLER'),
(18, '2025-09-25 18:06:50', '2025-09-25', 1, 27, 0.00, 6.00, 6.00, 'MORICHITO', 'TALLER'),
(19, '2025-09-25 18:08:56', '2025-09-25', 2, 27, 6.00, 6.00, 0.00, 'SERVICIO NRO 00012', 'TALLER'),
(20, '2025-09-26 18:28:26', '2025-09-26', 1, 30, 0.00, 1.00, 1.00, 'HILUX TURAGUA', 'TALLER'),
(21, '2025-09-26 18:29:02', '2025-09-26', 1, 31, 0.00, 1.00, 1.00, 'HILUX TURAGUA', 'TALLER'),
(22, '2025-09-26 18:32:31', '2025-09-26', 2, 30, 1.00, 1.00, 0.00, 'SERVICIO NRO 00015', 'TALLER'),
(23, '2025-09-26 18:32:32', '2025-09-26', 2, 31, 1.00, 1.00, 0.00, 'SERVICIO NRO 00015', 'TALLER'),
(24, '2025-09-26 18:40:14', '2025-09-26', 1, 36, 0.00, 3.00, 3.00, 'USO DIARIO', 'TALLER'),
(25, '2025-09-26 18:41:50', '2025-09-26', 2, 36, 3.00, 1.00, 2.00, 'SERVICIO NRO 00016', 'TALLER'),
(26, '2025-09-27 18:22:55', '2025-09-27', 1, 23, 0.00, 1.00, 1.00, '4.500 DE LA OFICINA', 'TALLER'),
(27, '2025-09-27 18:26:31', '2025-09-27', 2, 23, 1.00, 1.00, 0.00, 'SERVICIO NRO 00020', 'TALLER'),
(28, '2025-09-27 18:28:53', '2025-09-27', 1, 23, 0.00, 2.00, 2.00, '4500 DE LA OFICINA', 'TALLER'),
(29, '2025-09-27 18:36:18', '2025-09-27', 2, 23, 2.00, 2.00, 0.00, 'SERVICIO NRO 00021', 'TALLER'),
(30, '2025-09-27 19:09:38', '2025-09-27', 2, 36, 2.00, 1.00, 1.00, 'SERVICIO NRO 00023', 'TALLER'),
(31, '2025-09-27 19:24:00', '2025-09-27', 1, 45, 0.00, 1.00, 1.00, 'TOYOTA DE LA OFICINA', 'TALLER'),
(32, '2025-09-27 19:24:48', '2025-09-27', 2, 45, 1.00, 1.00, 0.00, 'SERVICIO NRO 00026', 'TALLER'),
(33, '2025-09-30 10:21:49', '2025-09-30', 2, 11, 4.00, 1.00, 3.00, 'SERVICIO NRO 00027', 'TALLER'),
(34, '2025-09-30 10:52:45', '2025-09-30', 1, 48, 0.00, 1.00, 1.00, 'TOYOTA DE OFICINA', 'TALLER'),
(35, '2025-09-30 10:53:12', '2025-09-30', 1, 49, 0.00, 1.00, 1.00, 'TOYOTA DE OFICINA', 'TALLER'),
(36, '2025-09-30 11:01:35', '2025-09-30', 2, 49, 1.00, 1.00, 0.00, 'SERVICIO NRO 00029', 'TALLER'),
(37, '2025-09-30 11:01:36', '2025-09-30', 2, 48, 1.00, 1.00, 0.00, 'SERVICIO NRO 00029', 'TALLER'),
(38, '2025-09-30 11:01:36', '2025-09-30', 2, 36, 1.00, 1.00, 0.00, 'SERVICIO NRO 00029', 'TALLER'),
(39, '2025-10-01 15:27:43', '2025-10-01', 1, 53, 0.00, 2.00, 2.00, 'MORICHITO', 'TALLER'),
(40, '2025-10-01 15:28:17', '2025-10-01', 1, 54, 0.00, 2.00, 2.00, 'CARRO DE INOJOSA', 'TALLER'),
(41, '2025-10-01 15:30:56', '2025-10-01', 2, 53, 2.00, 2.00, 0.00, 'SERVICIO NRO 00030', 'TALLER'),
(42, '2025-10-01 15:34:32', '2025-10-01', 2, 54, 2.00, 2.00, 0.00, 'SERVICIO NRO 00031', 'TALLER'),
(43, '2025-10-01 15:40:09', '2025-10-01', 2, 11, 3.00, 1.00, 2.00, 'SERVICIO NRO 00032', 'TALLER'),
(44, '2025-10-01 16:12:40', '2025-10-01', 1, 55, 0.00, 1.00, 1.00, 'CAMPAMENTO MATIYURE', 'TALLER'),
(45, '2025-10-01 16:14:46', '2025-10-01', 2, 55, 1.00, 1.00, 0.00, 'SERVICIO NRO 00034', 'TALLER'),
(46, '2025-10-04 16:37:13', '2025-10-04', 2, 13, 5.00, 1.00, 4.00, 'SERVICIO NRO 00042', 'TALLER'),
(47, '2025-10-04 16:41:26', '2025-10-04', 1, 63, 0.00, 2.00, 2.00, 'SUPERDUTY NEGRO', 'TALLER'),
(48, '2025-10-04 16:45:19', '2025-10-04', 2, 63, 2.00, 2.00, 0.00, 'SERVICIO NRO 00043', 'TALLER'),
(49, '2025-10-04 16:52:43', '2025-10-04', 1, 66, 0.00, 1.00, 1.00, 'MOZO HILUX', 'TALLER'),
(50, '2025-10-04 17:02:42', '2025-10-04', 2, 66, 1.00, 1.00, 0.00, 'SERVICIO NRO 00045', 'TALLER'),
(51, '2025-10-04 17:21:14', '2025-10-04', 1, 68, 0.00, 16.00, 16.00, 'BUJIA DE SUPERDUTY', 'TALLER'),
(52, '2025-10-04 17:24:13', '2025-10-04', 1, 70, 0.00, 4.00, 4.00, 'SUPERDUTY NEGRO', 'TALLER'),
(53, '2025-10-04 17:29:24', '2025-10-04', 2, 68, 16.00, 16.00, 0.00, 'SERVICIO NRO 00048', 'TALLER'),
(54, '2025-10-04 17:42:29', '2025-10-04', 2, 11, 2.00, 1.00, 1.00, 'SERVICIO NRO 00051', 'TALLER'),
(55, '2025-10-04 17:42:29', '2025-10-04', 2, 13, 4.00, 1.00, 3.00, 'SERVICIO NRO 00051', 'TALLER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_movimiento_tipos`
--

CREATE TABLE `inventario_movimiento_tipos` (
  `IDTipoMov` int NOT NULL,
  `DescripcionMovimiento` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `EstadoMovimiento` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario_movimiento_tipos`
--

INSERT INTO `inventario_movimiento_tipos` (`IDTipoMov`, `DescripcionMovimiento`, `EstadoMovimiento`) VALUES
(1, 'ENTRADA', 1),
(2, 'SALIDA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_tipos`
--

CREATE TABLE `inventario_tipos` (
  `IDTipoInv` int NOT NULL,
  `DescripcionTipoInv` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `TipoExistencia` int NOT NULL,
  `EstadoTipoInv` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario_tipos`
--

INSERT INTO `inventario_tipos` (`IDTipoInv`, `DescripcionTipoInv`, `TipoExistencia`, `EstadoTipoInv`) VALUES
(1, 'SERVICIO', 2, 1),
(2, 'PRODUCTOS', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_detalles`
--

CREATE TABLE `servicios_detalles` (
  `IDServicioDetalle` int NOT NULL,
  `IDServicioResumen` int NOT NULL,
  `IDInv` int NOT NULL,
  `Cantidad` decimal(11,2) NOT NULL,
  `PrecioUSD` decimal(11,2) NOT NULL,
  `PrecioBS` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios_detalles`
--

INSERT INTO `servicios_detalles` (`IDServicioDetalle`, `IDServicioResumen`, `IDInv`, `Cantidad`, `PrecioUSD`, `PrecioBS`) VALUES
(1, 1, 7, 1.00, 400.00, 67366.28),
(2, 2, 6, 1.00, 20.00, 3331.67),
(3, 3, 5, 1.00, 20.00, 3035.25),
(4, 3, 11, 1.00, 10.00, 1517.63),
(5, 3, 1, 1.00, 20.00, 3035.25),
(6, 3, 3, 1.00, 10.00, 1517.63),
(7, 4, 11, 1.00, 10.00, 1271.10),
(8, 4, 5, 1.00, 20.00, 2542.19),
(9, 4, 14, 1.00, 5.00, 635.55),
(10, 4, 13, 1.00, 7.00, 889.77),
(11, 5, 2, 1.00, 10.00, 1344.81),
(12, 5, 16, 2.00, 2.00, 268.96),
(13, 5, 15, 2.00, 5.00, 672.41),
(14, 6, 10, 1.00, 8.00, 1359.81),
(15, 6, 20, 1.00, 8.00, 1359.81),
(16, 6, 17, 1.00, 20.00, 3399.52),
(17, 7, 9, 1.00, 150.00, 20345.99),
(18, 7, 5, 1.00, 20.00, 2712.80),
(19, 7, 1, 1.00, 20.00, 2712.80),
(20, 8, 17, 1.00, 20.00, 2737.86),
(21, 8, 21, 1.00, 150.00, 20533.97),
(22, 8, 4, 1.00, 10.00, 1368.93),
(23, 9, 4, 1.00, 10.00, 1368.93),
(24, 9, 22, 1.00, 9.00, 1232.04),
(25, 10, 8, 1.00, 10.00, 1406.60),
(26, 10, 24, 1.00, 35.00, 4923.10),
(27, 10, 26, 1.00, 15.00, 2109.90),
(28, 10, 23, 1.00, 2.00, 281.32),
(29, 11, 5, 1.00, 20.00, 2860.76),
(30, 11, 11, 1.00, 10.00, 1430.38),
(31, 12, 28, 1.00, 12.00, 1821.15),
(32, 12, 2, 1.00, 10.00, 1517.63),
(33, 12, 27, 6.00, 5.00, 758.81),
(34, 12, 29, 1.00, 17.00, 2579.97),
(35, 13, 4, 1.00, 10.00, 1335.16),
(36, 14, 32, 2.00, 8.00, 1105.03),
(37, 15, 30, 1.00, 28.00, 3590.75),
(38, 15, 31, 1.00, 7.00, 897.69),
(39, 15, 34, 1.00, 30.00, 3847.23),
(40, 16, 36, 1.00, 8.00, 1359.81),
(41, 17, 37, 1.00, 14.00, 2092.55),
(42, 18, 4, 1.00, 10.00, 1430.38),
(43, 18, 6, 1.00, 20.00, 2860.76),
(44, 19, 38, 2.00, 5.00, 721.87),
(45, 20, 39, 1.00, 14.00, 1755.95),
(46, 20, 23, 1.00, 2.00, 250.85),
(47, 21, 23, 2.00, 2.00, 288.75),
(48, 21, 39, 1.00, 14.00, 2021.22),
(49, 21, 20, 1.00, 10.00, 1443.73),
(50, 22, 5, 1.00, 20.00, 3474.72),
(51, 23, 42, 1.00, 100.00, 17373.61),
(52, 23, 36, 1.00, 12.00, 2084.83),
(53, 24, 5, 1.00, 20.00, 3474.72),
(54, 25, 14, 1.00, 5.00, 735.41),
(55, 25, 5, 1.00, 20.00, 2941.65),
(56, 26, 46, 1.00, 15.00, 2226.66),
(57, 26, 45, 1.00, 20.00, 2968.88),
(58, 27, 5, 1.00, 20.00, 2542.19),
(59, 27, 11, 1.00, 10.00, 1271.10),
(60, 28, 47, 1.00, 15.00, 2165.60),
(61, 29, 5, 1.00, 20.00, 3035.25),
(62, 29, 1, 1.00, 20.00, 3035.25),
(63, 29, 3, 1.00, 10.00, 1517.63),
(64, 29, 49, 1.00, 25.00, 3794.07),
(65, 29, 48, 1.00, 7.00, 1062.34),
(66, 29, 50, 1.00, 30.00, 4552.88),
(67, 29, 51, 1.00, 30.00, 4552.88),
(68, 29, 36, 1.00, 12.00, 1821.15),
(69, 30, 53, 2.00, 60.00, 9626.87),
(70, 31, 52, 1.00, 10.00, 1517.63),
(71, 31, 54, 2.00, 8.00, 1214.10),
(72, 32, 11, 1.00, 10.00, 1406.60),
(73, 32, 5, 1.00, 20.00, 2813.20),
(74, 33, 34, 1.00, 30.00, 4412.48),
(75, 34, 20, 1.00, 10.00, 1507.95),
(76, 34, 55, 1.00, 6.00, 904.77),
(77, 35, 4, 1.00, 10.00, 1549.83),
(78, 36, 57, 1.00, 15.00, 2324.74),
(79, 37, 2, 1.00, 10.00, 1604.48),
(80, 37, 5, 1.00, 20.00, 3208.96),
(81, 37, 14, 1.00, 5.00, 802.24),
(82, 37, 1, 1.00, 20.00, 3208.96),
(83, 38, 58, 1.00, 10.00, 1604.48),
(84, 38, 59, 2.00, 6.00, 962.69),
(85, 39, 60, 1.00, 6.00, 1010.49),
(86, 39, 61, 1.00, 5.00, 842.08),
(87, 40, 5, 1.00, 20.00, 3208.96),
(88, 40, 14, 1.00, 5.00, 802.24),
(89, 40, 1, 1.00, 20.00, 3208.96),
(90, 40, 8, 1.00, 10.00, 1604.48),
(91, 40, 62, 1.00, 7.00, 1123.14),
(92, 41, 62, 1.00, 7.00, 1133.22),
(93, 41, 46, 2.00, 15.00, 2428.32),
(94, 42, 5, 1.00, 20.00, 3272.95),
(95, 42, 14, 1.00, 5.00, 818.24),
(96, 42, 13, 1.00, 7.00, 1145.53),
(97, 42, 1, 1.00, 20.00, 3272.95),
(98, 43, 63, 2.00, 70.00, 11660.84),
(99, 43, 64, 2.00, 10.00, 1665.83),
(100, 44, 5, 1.00, 20.00, 3399.52),
(101, 44, 1, 1.00, 20.00, 3399.52),
(102, 45, 65, 1.00, 27.00, 4742.47),
(103, 45, 66, 1.00, 45.00, 7904.12),
(104, 45, 67, 1.00, 10.00, 1756.47),
(105, 46, 4, 1.00, 10.00, 1776.14),
(106, 47, 17, 1.00, 20.00, 3626.07),
(107, 48, 5, 1.00, 20.00, 3662.74),
(108, 48, 1, 1.00, 20.00, 3662.74),
(109, 48, 2, 2.00, 10.00, 1831.37),
(110, 48, 17, 3.00, 20.00, 3662.74),
(111, 48, 68, 16.00, 6.00, 1098.82),
(112, 48, 69, 1.00, 40.00, 7325.48),
(113, 49, 60, 1.00, 6.00, 1098.82),
(114, 50, 15, 3.00, 5.00, 915.68),
(115, 50, 71, 1.00, 8.00, 1465.10),
(116, 50, 59, 1.00, 6.00, 1098.82),
(117, 51, 5, 1.00, 20.00, 3662.74),
(118, 51, 3, 1.00, 10.00, 1831.37),
(119, 51, 14, 1.00, 5.00, 915.68),
(120, 51, 11, 1.00, 10.00, 1831.37),
(121, 51, 13, 1.00, 7.00, 1281.96);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_resumen`
--

CREATE TABLE `servicios_resumen` (
  `IDServicioResumen` int NOT NULL,
  `FechaRegServicios` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaServicio` date NOT NULL,
  `TasaRefBcv` decimal(11,4) NOT NULL,
  `IDTipoServicio` int NOT NULL,
  `IDVehiculo` int NOT NULL,
  `NroNota` int NOT NULL,
  `RecibeCedula` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `RecibeConforme` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `ObservacionServicio` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `ResponsableServicio` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `EstadoServicio` int NOT NULL,
  `UltimaActualizacionServicio` tinytext COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios_resumen`
--

INSERT INTO `servicios_resumen` (`IDServicioResumen`, `FechaRegServicios`, `FechaServicio`, `TasaRefBcv`, `IDTipoServicio`, `IDVehiculo`, `NroNota`, `RecibeCedula`, `RecibeConforme`, `ObservacionServicio`, `ResponsableServicio`, `EstadoServicio`, `UltimaActualizacionServicio`) VALUES
(1, '2025-09-23 14:43:54', '2025-09-23', 168.4157, 1, 9, 1, '19462412', 'JOSE POLANCO', 'REALIZADO', 'TALLER', 3, ''),
(2, '2025-09-23 15:03:05', '2025-09-22', 166.5834, 1, 7, 2, '25588256', 'LANDER ORELLANA', 'SIN COMPLICACIONES', 'TALLER', 3, ''),
(3, '2025-09-24 15:40:49', '2025-09-04', 151.7627, 1, 19, 3, '21005223', 'RAFAEL RODRIGUEZ', 'REALIZADO', 'TALLER', 3, ''),
(4, '2025-09-24 18:20:46', '2025-08-05', 127.1097, 1, 16, 4, '19249778', 'JESUS DASA', 'REALIZADO', 'TALLER', 3, ''),
(5, '2025-09-24 18:31:09', '2025-08-14', 134.4812, 1, 10, 5, '18328783', 'GREDYS LOZADA', 'REALIZADO', 'TALLER', 3, ''),
(6, '2025-09-24 18:37:52', '2025-09-24', 169.9761, 1, 17, 6, '16528608', 'FREDDY ALVARADO', 'REALIZADO', 'TALLER', 3, ''),
(7, '2025-09-24 18:41:59', '2025-08-16', 135.6399, 1, 16, 7, '19249778', 'JESUS DASA', 'REALIZADO', 'TALLER', 3, ''),
(8, '2025-09-24 18:49:22', '2025-08-18', 136.8931, 1, 10, 8, '18328783', 'GREDYS LOZADA', 'REALIZADO', 'TALLER', 3, ''),
(9, '2025-09-24 18:54:04', '2025-08-19', 136.8931, 1, 7, 9, '25588256', 'LANDER ORELLANA', 'REALIZADO', 'TALLER', 3, ''),
(10, '2025-09-24 19:06:40', '2025-08-22', 140.6600, 1, 10, 10, '18328783', 'GREDYS LOZADA', 'REALIZADO', 'TALLER', 3, ''),
(11, '2025-09-24 19:11:15', '2025-08-26', 143.0381, 1, 10, 11, '18328783', 'GREDYS LOZADA', 'REALIZADO', 'TALLER', 3, ''),
(12, '2025-09-25 18:08:56', '2025-09-04', 151.7627, 1, 20, 12, '24837866', 'ANTONIO CANCINES', 'REALIZADO', 'TALLER', 3, ''),
(13, '2025-09-25 18:21:43', '2025-08-13', 133.5159, 1, 2, 13, '25908184', 'ENDER HERRERA', 'REALIZADO', 'TALLER', 3, ''),
(14, '2025-09-26 18:26:44', '2025-08-20', 138.1283, 1, 2, 14, '25908184', 'ENDER HERRERA', 'REALIZADO', 'TALLER', 3, ''),
(15, '2025-09-26 18:32:31', '2025-08-06', 128.2409, 1, 21, 15, '24837866', 'DANIEL JASPE', 'REALIZADO', 'TALLER', 3, ''),
(16, '2025-09-26 18:41:49', '2025-09-24', 169.9761, 1, 20, 16, '24837866', 'ANTONIO CANCINES', 'ENTREGADO AL CHOFER', 'TALLER', 3, ''),
(17, '2025-09-26 18:44:52', '2025-09-02', 149.4677, 1, 10, 17, '18328783', 'GREDYS LOZADA', 'REALIZADO', 'TALLER', 3, ''),
(18, '2025-09-26 18:47:23', '2025-08-26', 143.0381, 1, 13, 18, '17.290.653', 'GLEMAR GUERRERO', 'REALIZADO', 'TALLER', 3, ''),
(19, '2025-09-26 18:50:58', '2025-08-27', 144.3732, 1, 2, 19, '25908184', 'ENDER HERRERA', 'REALIZADO', 'TALLER', 3, ''),
(20, '2025-09-27 18:26:31', '2025-08-01', 125.4247, 1, 24, 20, '11.760.200', 'MANUEL CORDOBA', 'REALIZADO', 'TALLER', 3, ''),
(21, '2025-09-27 18:36:18', '2025-08-27', 144.3732, 1, 24, 21, '11.760.200', 'MANUEL CORDOBA', 'REALIZADO', 'TALLER', 3, ''),
(22, '2025-09-27 18:38:01', '2025-09-27', 173.7361, 1, 17, 22, '16528608', 'FREDDY ALVARADO', 'REALIZADO', 'TALLER', 3, ''),
(23, '2025-09-27 19:09:38', '2025-09-27', 173.7361, 1, 23, 23, '9.872.922', 'JOSE GONZALES', 'REALIZADO', 'TALLER', 3, ''),
(24, '2025-09-27 19:11:04', '2025-09-27', 173.7361, 1, 24, 24, '11.760.200', 'MANUEL CORDOBA', 'REALIZADO', 'TALLER', 3, ''),
(25, '2025-09-27 19:22:40', '2025-08-29', 147.0825, 1, 24, 25, '11.760.200', 'MANUEL CORDOBA', 'REALIZADO', 'TALLER', 3, ''),
(26, '2025-09-27 19:24:48', '2025-09-01', 148.4440, 1, 24, 26, '11.760.200', 'MANUEL CORDOBA', 'REALIZADO', 'TALLER', 3, ''),
(27, '2025-09-30 10:21:48', '2025-08-05', 127.1097, 1, 12, 27, '22998162', 'LUIS SUBERO', 'REALIZADO', 'TALLER', 3, ''),
(28, '2025-09-30 10:29:22', '2025-08-27', 144.3732, 1, 21, 28, '17849825', 'YUBA CARVAJAL', 'REALIZADO', 'TALLER', 3, ''),
(29, '2025-09-30 11:01:35', '2025-09-04', 151.7627, 1, 24, 29, '11.760.200', 'MANUEL CORDOBA', 'REALIZADO', 'TALLER', 3, ''),
(30, '2025-10-01 15:30:55', '2025-09-16', 160.4479, 1, 20, 30, '24837866', 'ANTONIO CANCINES', 'ENTREGADOS AL CHOFER', 'TALLER', 3, ''),
(31, '2025-10-01 15:34:30', '2025-09-04', 151.7627, 1, 14, 31, '18326177', 'JOSE VARGAS', 'REALIZADO', 'TALLER', 3, ''),
(32, '2025-10-01 15:40:08', '2025-08-24', 140.6600, 1, 27, 32, '13096020', 'HERNAN VILORIA', 'REALIZADO', 'TALLER', 3, ''),
(33, '2025-10-01 15:45:23', '2025-08-29', 147.0825, 1, 25, 33, '24837866', 'ANTONIO CANCINES', 'REALIZADO', 'TALLER', 3, ''),
(34, '2025-10-01 16:14:46', '2025-09-03', 150.7952, 1, 28, 34, '21005223', 'RAFAEL RODRIGUEZ', 'REALIZADO', 'TALLER', 3, ''),
(35, '2025-10-04 15:51:02', '2025-09-09', 154.9825, 1, 10, 35, '18.328.783', 'GREDYS LOZADA', 'REALIZADO', 'TALLER', 3, ''),
(36, '2025-10-04 15:54:07', '2025-09-09', 154.9825, 1, 14, 36, '18.326.177', 'JOSE VARGAS', 'REALIZADO', 'TALLER', 3, ''),
(37, '2025-10-04 16:12:32', '2025-09-15', 160.4479, 1, 29, 37, '24.837.599', 'DANIEL JASPE', 'REALIZADO', 'TALLER', 3, ''),
(38, '2025-10-04 16:20:08', '2025-09-15', 160.4479, 1, 10, 38, '18.328.783', 'GREDYS LOZADA', 'REALIZADO', 'TALLER', 3, ''),
(39, '2025-10-04 16:27:14', '2025-09-23', 168.4157, 1, 17, 39, '16528608', 'FREDDY ALVARADO', 'REALIZADO', 'TALLER', 3, ''),
(40, '2025-10-04 16:32:48', '2025-09-16', 160.4479, 1, 28, 40, '15513440', 'DANIEL RODRIGUEZ', 'REALIZADO', 'TALLER', 3, ''),
(41, '2025-10-04 16:35:14', '2025-09-17', 161.8880, 1, 14, 41, '18326177', 'JOSE VARGAS', 'REALIZADO', 'TALLER', 3, ''),
(42, '2025-10-04 16:37:13', '2025-09-18', 163.6474, 1, 21, 42, '24.837.599', 'DANIEL JASPE', 'REALIZADO', 'TALLER', 3, ''),
(43, '2025-10-04 16:45:19', '2025-09-22', 166.5834, 1, 10, 43, '18328783', 'GREDYS LOZADA', 'REALIZADO', 'TALLER', 3, ''),
(44, '2025-10-04 16:48:34', '2025-09-24', 169.9761, 1, 10, 44, '18328783', 'GREDYS LOZADA', 'REALIZADO', 'TALLER', 3, ''),
(45, '2025-10-04 17:02:42', '2025-09-29', 175.6471, 1, 2, 45, '25908184', 'ENDER HERRERA', 'REALIZADO', 'TALLER', 3, ''),
(46, '2025-10-04 17:08:35', '2025-09-30', 177.6143, 1, 30, 46, '19249872', 'DAVID RUIZ', 'REALIZADO', 'TALLER', 3, ''),
(47, '2025-10-04 17:09:50', '2025-10-02', 181.3037, 1, 30, 47, '19249872', 'DAVID RUIZ', 'REALIZADO', 'TALLER', 3, ''),
(48, '2025-10-04 17:29:24', '2025-10-03', 183.1369, 1, 10, 48, '18328783', 'GREDYS LOZADA', 'REALIZADO', 'TALLER', 3, ''),
(49, '2025-10-04 17:33:31', '2025-10-03', 183.1369, 1, 17, 49, '16528608', 'FREDDY ALVARADO', 'REALIZADO', 'TALLER', 3, ''),
(50, '2025-10-04 17:37:46', '2025-10-03', 183.1369, 1, 2, 50, '25908184', 'ENDER HERRERA', 'REALIZADO', 'TALLER', 3, ''),
(51, '2025-10-04 17:42:29', '2025-10-03', 183.1369, 1, 20, 51, '24837866', 'ANTONIO CANCINES', 'REALIZADO', 'TALLER', 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_tipos`
--

CREATE TABLE `servicios_tipos` (
  `IDTipoServicio` int NOT NULL,
  `DescripcionTipoServicio` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `EstadoTipoServicio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios_tipos`
--

INSERT INTO `servicios_tipos` (`IDTipoServicio`, `DescripcionTipoServicio`, `EstadoTipoServicio`) VALUES
(1, 'INTERNO', 1),
(2, 'CONTRIBUCION SOCIAL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_vehiculos`
--

CREATE TABLE `servicios_vehiculos` (
  `IDVehiculo` int NOT NULL,
  `FechaRegVehiculo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IDEmpresa` int NOT NULL,
  `IDCentroCosto` int NOT NULL,
  `CodigoVehiculo` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `YearVehiculo` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `MarcaVehiculo` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `ModeloVehiculo` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `PlacaVehiculo` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `SerialVehiculo` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `ColorVehiculo` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `UrlImagenVehiculo` tinytext COLLATE utf8mb4_general_ci,
  `EstadoVehiculo` int NOT NULL,
  `UltimaActualizacionVehiculo` tinytext COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios_vehiculos`
--

INSERT INTO `servicios_vehiculos` (`IDVehiculo`, `FechaRegVehiculo`, `IDEmpresa`, `IDCentroCosto`, `CodigoVehiculo`, `YearVehiculo`, `MarcaVehiculo`, `ModeloVehiculo`, `PlacaVehiculo`, `SerialVehiculo`, `ColorVehiculo`, `UrlImagenVehiculo`, `EstadoVehiculo`, `UltimaActualizacionVehiculo`) VALUES
(1, '2025-08-12 15:06:17', 1, 45, '001', '2012', 'CHEVROLET', 'REY CAMIóN', 'A66AS7A', '8ZC3CZCG0CG311163', 'BLANCO', '2025-09-23 02:51:25 PM - TALLER', 0, NULL),
(2, '2025-08-12 15:09:43', 2, 1, '002', '2011', 'TOYOTA', 'HILUX V6', 'A89BC8M', '8XA33ZV25B9009882', 'NEGRO', NULL, 1, '2025-09-23 02:37:21 PM - TALLER'),
(3, '2025-08-12 15:17:35', 1, 45, '001', '2012', 'CHEVROLET', 'REY CAMIóN', 'A66AS7A', '8ZC3CZCG0CG311163', 'BLANCO', '2025-09-23 02:51:38 PM - TALLER', 0, NULL),
(4, '2025-08-12 15:24:45', 1, 31, '003', '2014', 'CHEVROLET', 'SILVERADO', 'A91DL1G', '8ZCNKREN1EG306452', 'BLANCO', '2025-09-23 03:46:12 PM - TALLER', 0, '2025-09-23 02:53:21 PM - TALLER'),
(5, '2025-09-05 14:01:46', 1, 45, '001', '2012', 'CHEVROLET', 'REY CAMION 3500 4X2', 'A66AS7A', '8ZC3CG0CG311163', 'BLANCO', NULL, 1, '2025-09-23 02:54:19 PM - TALLER'),
(6, '2025-09-05 14:03:30', 1, 45, '001', '2012', 'CHEVROLET', 'REY CAMION 3500 4X2', 'A66AS7A', '8ZC3CG0CG311163', 'BLANCO', '2025-09-23 02:52:09 PM - TALLER', 0, NULL),
(7, '2025-09-23 14:13:24', 1, 45, '003', '2022', 'CHANGAN', 'KAICENE F70 4X4 L4', 'A64A09R', 'LSBBZ2T7NG602462', 'BLANCO', NULL, 1, '2025-09-23 02:51:12 PM - TALLER'),
(8, '2025-09-23 14:31:27', 1, 45, '004', '2014', 'FORD', 'SUPERDUTY F-350 4X2', 'A72BW3M', '8YTWF3G62EA04244', 'NEGRO', 'img/68d2eb979876e-IMG_4230.PNG', 1, '2025-09-23 02:51:00 PM - TALLER'),
(9, '2025-09-23 14:39:45', 1, 2, 'TURAGUA001', '2014', 'BELARUS', '1221', 'SINPLACA', 'SINSERIAL', 'ROJO', NULL, 1, NULL),
(10, '2025-09-23 15:51:18', 2, 1, '005', '2013', 'FORD', 'SUPER DUTY F-350 4X4', 'A93CE7G', '8YTWF3H66DGA15356', 'BLANCO', NULL, 1, NULL),
(11, '2025-09-23 15:58:11', 2, 45, '006', '2023', 'TOYOTA', 'LAND CRUISED D/CABINA-6V', 'A63EF9G', 'JTEBU71JXPB074419', 'BEIGE', NULL, 1, '2025-10-04 04:05:32 PM - TALLER'),
(12, '2025-09-23 16:03:13', 1, 16, '007', '2017', 'TOYOTA', 'HILUX KAVAK D/C V6', 'A50CH1K', '8XAFU29G0HR000856', 'BLANCO', NULL, 1, NULL),
(13, '2025-09-23 16:12:48', 1, 28, '008', '2021', 'TOYOTA', 'HILUX DIESEL D/C', 'A44AV6I', 'MR0KB8CD5M1124346', 'BLANCO', NULL, 1, '2025-09-24 02:12:02 PM - TALLER'),
(14, '2025-09-23 20:12:06', 2, 45, '009', '2007', 'TOYOTA', 'LAND CRUISER TE / FZJ78L-6LI', 'AD992CF', '8XA21UJ7879502097', 'BLANCO', NULL, 1, '2025-10-04 04:06:29 PM - TALLER'),
(15, '2025-09-24 14:14:56', 1, 45, '010', '2009', 'TOYOTA', 'HILUX KAVAK DIESEL D/C', 'A03AZ8L', 'MR0FX29G792701445', 'BLANCO', NULL, 1, NULL),
(16, '2025-09-24 14:21:53', 2, 39, '011', '2012', 'TOYOTA', 'TACOMA', 'A29BH8D', '5TFLU4EN2CX032361', 'BLANCO', NULL, 1, NULL),
(17, '2025-09-24 14:36:34', 1, 7, '012', '2008', 'TOYOTA', 'LAND CRUISED PLAT.-6V', 'SIN PLACA', '8XA31UJ7989504597', 'BLANCO', NULL, 1, '2025-10-04 04:06:50 PM - TALLER'),
(18, '2025-09-24 14:39:35', 1, 5, '013', '4444', 'TOYOTA', 'LAND CRUISED PLAT.- 6L', '57X GBB', 'JTELJ71JX70011460', 'BLANCO', NULL, 1, '2025-10-04 04:08:00 PM - TALLER'),
(19, '2025-09-24 14:49:34', 1, 15, '014', '2009', 'TOYOTA', 'HILUX KAVAK D/C', 'A83AA7H', '8XA33ZV2599006640', 'BLANCO', NULL, 1, NULL),
(20, '2025-09-25 18:03:33', 1, 6, '015', '2012', 'TOYOTA', 'LAND CRUISED PLAT.-6L', 'SIN PLACA2', 'JTFLB71J3C8034454', 'BLANCO', NULL, 1, '2025-10-04 04:07:26 PM - TALLER'),
(21, '2025-09-26 18:02:30', 1, 2, '016', '2012', 'TOYOTA', 'HILUX 2.7', 'SIN PLACA3', 'MROFX22G4C1072850', 'BLANCO', NULL, 1, NULL),
(22, '2025-09-26 18:12:35', 1, 9, '017', '2012', 'FORD', 'CAMION SUPERDUTY', 'A03BK9M', 'HPG015C1270000972', 'BLANCO', NULL, 1, NULL),
(23, '2025-09-27 18:13:22', 1, 4, '018', '11111', 'TOYOTA', 'CHASIS LARGO GOBER.', 'SIN PLACA4', '8XA21UJ7829500179', 'BLANCO', NULL, 1, '2025-09-27 06:19:32 PM - TALLER'),
(24, '2025-09-27 18:15:48', 2, 45, '019', '2012', 'TOYOTA CAJON', 'LAND CRUISED (OFICINA)- 6L', 'SIN PLACA5', 'JTFLB71J6C8034402', 'BLANCA', NULL, 1, '2025-10-04 04:08:44 PM - TALLER'),
(25, '2025-09-27 19:13:07', 1, 6, '020', '11111', 'BELARUS', 'TRACTOR MORICHITO', 'SIN PLACA6', 'SIN SERIAL', 'ROJO', NULL, 1, NULL),
(26, '2025-09-30 10:39:33', 1, 1, '021', '2013', 'FORD CAMION', 'SUPERDUTY DESARMADO', 'A93CE7FG', '8YTWF3H66DGA15356', 'BLANCO', NULL, 1, '2025-10-01 03:08:11 PM - TALLER'),
(27, '2025-10-01 15:39:05', 2, 31, '022', '2014', 'CHEVROLET', 'SILVERADO 4X4', 'A91DL1G', '8ZCNKREN1EG306452', 'BLANCO', NULL, 1, NULL),
(28, '2025-10-01 16:08:14', 2, 15, '023', '2011', 'TOYOTA', 'LAND CRUISED CHASIS LARG. 6V', 'AC530BO', 'JTGEU73J4C4301488', 'GRIS', NULL, 1, '2025-10-04 04:05:58 PM - TALLER'),
(29, '2025-10-04 16:04:39', 1, 2, '024', '2012', 'TOYOTA', 'LAND CRUISED 6V', 'SIN PLACA7', 'JTFLB71J6C8O34366', 'BLANCO', NULL, 1, NULL),
(30, '2025-10-04 17:06:13', 1, 45, '025', '2025', 'DONGFENG', 'RICH ZNA', 'A34BE5R', 'LINTGUCL6EV420323', 'PLATA', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IDUsuario` int NOT NULL,
  `IDPrivilegio` int NOT NULL,
  `FechaRegUsuario` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `NombreUsuario` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `Usuario` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `Clave` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `EstadoUsuario` int NOT NULL,
  `UltimaActualizacionUsuario` tinytext COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IDUsuario`, `IDPrivilegio`, `FechaRegUsuario`, `NombreUsuario`, `Usuario`, `Clave`, `EstadoUsuario`, `UltimaActualizacionUsuario`) VALUES
(1, 1, '2025-05-23 10:49:38', 'DEP. SISTEMAS', 'sistemas', '$2y$10$nRFyO/KhsdiJlfgPwfPs/eZQ4mamKiFjLg75Aotq.ePUz9yVxFKzS', 1, NULL),
(4, 1, '2025-06-06 11:39:23', 'TALLER', 'taller', '$2y$10$5UxhkjtEYum3CdZM2yqMNe/LO1IRkSX8wpiCRFWImPWp4oTpTaOti', 1, NULL),
(5, 1, '2025-05-23 10:49:38', 'Alejandro Jimenez', 'alejandro', '$2y$10$GgLQ8b3FSKjwaMQoG2S5XeE.EE0fI3psfTK.abMxlgbAuSV8S7WFa', 1, '2025-05-29 03:41:34 PM - DEP. Sistemas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_privilegios`
--

CREATE TABLE `usuarios_privilegios` (
  `IDPrivilegio` int NOT NULL,
  `DescripcionPrivilegio` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `EstadoPrivilegio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_privilegios`
--

INSERT INTO `usuarios_privilegios` (`IDPrivilegio`, `DescripcionPrivilegio`, `EstadoPrivilegio`) VALUES
(1, 'GENERAL', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`IDInv`);

--
-- Indices de la tabla `inventario_movimiento`
--
ALTER TABLE `inventario_movimiento`
  ADD PRIMARY KEY (`IDInvMov`);

--
-- Indices de la tabla `inventario_movimiento_tipos`
--
ALTER TABLE `inventario_movimiento_tipos`
  ADD PRIMARY KEY (`IDTipoMov`);

--
-- Indices de la tabla `inventario_tipos`
--
ALTER TABLE `inventario_tipos`
  ADD PRIMARY KEY (`IDTipoInv`);

--
-- Indices de la tabla `servicios_detalles`
--
ALTER TABLE `servicios_detalles`
  ADD PRIMARY KEY (`IDServicioDetalle`);

--
-- Indices de la tabla `servicios_resumen`
--
ALTER TABLE `servicios_resumen`
  ADD PRIMARY KEY (`IDServicioResumen`);

--
-- Indices de la tabla `servicios_tipos`
--
ALTER TABLE `servicios_tipos`
  ADD PRIMARY KEY (`IDTipoServicio`);

--
-- Indices de la tabla `servicios_vehiculos`
--
ALTER TABLE `servicios_vehiculos`
  ADD PRIMARY KEY (`IDVehiculo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IDUsuario`);

--
-- Indices de la tabla `usuarios_privilegios`
--
ALTER TABLE `usuarios_privilegios`
  ADD PRIMARY KEY (`IDPrivilegio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `IDInv` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `inventario_movimiento`
--
ALTER TABLE `inventario_movimiento`
  MODIFY `IDInvMov` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `inventario_movimiento_tipos`
--
ALTER TABLE `inventario_movimiento_tipos`
  MODIFY `IDTipoMov` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario_tipos`
--
ALTER TABLE `inventario_tipos`
  MODIFY `IDTipoInv` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicios_detalles`
--
ALTER TABLE `servicios_detalles`
  MODIFY `IDServicioDetalle` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de la tabla `servicios_resumen`
--
ALTER TABLE `servicios_resumen`
  MODIFY `IDServicioResumen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `servicios_tipos`
--
ALTER TABLE `servicios_tipos`
  MODIFY `IDTipoServicio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicios_vehiculos`
--
ALTER TABLE `servicios_vehiculos`
  MODIFY `IDVehiculo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IDUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios_privilegios`
--
ALTER TABLE `usuarios_privilegios`
  MODIFY `IDPrivilegio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
