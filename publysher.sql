-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-08-2021 a las 04:58:54
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `publysher`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(10) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'Camaras y grabadores wifi'),
(2, 'Camaras'),
(3, 'Camaras IP - COLOR V'),
(4, 'PTZ IP'),
(5, 'NVR'),
(6, 'CAMARAS HD - (720P - 1MP)'),
(7, 'MONITORES, CABLES Y ACCESORIOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(10) NOT NULL,
  `nombres` varchar(20) NOT NULL,
  `apellido_paterno` varchar(20) NOT NULL,
  `apellido_materno` varchar(20) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `celular` varchar(9) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombres`, `apellido_paterno`, `apellido_materno`, `dni`, `celular`, `email`) VALUES
(1, 'Thom', 'Roman', 'Aguilar', '72847974', '998774412', 'thom@gmail.com'),
(2, 'Esteban', 'Paucar', 'Drebeque', '45653245', '987745123', 'esteban@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantedepago`
--

CREATE TABLE `comprobantedepago` (
  `id_comprobante` int(10) NOT NULL,
  `id_tipocomprobante` int(10) NOT NULL,
  `fechaemision` varchar(30) NOT NULL,
  `ruc` varchar(30) DEFAULT NULL,
  `hora_emision` varchar(30) NOT NULL,
  `precioTotal` double NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `numero_comprobante` varchar(8) DEFAULT NULL,
  `id_estadoComprobante` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `fechaYhora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comprobantedepago`
--

INSERT INTO `comprobantedepago` (`id_comprobante`, `id_tipocomprobante`, `fechaemision`, `ruc`, `hora_emision`, `precioTotal`, `id_cliente`, `numero_comprobante`, `id_estadoComprobante`, `id_usuario`, `fechaYhora`) VALUES
(2, 1, '2021-07-25', NULL, '21:42:06', 628.08, 1, '00000002', 1, 2, '2021-07-26 02:42:06'),
(3, 1, '2021-07-31', NULL, '18:33:27', 309.36, 1, '00000003', 0, 2, '2021-08-03 00:07:05'),
(4, 0, '2021-07-31', '10713117761', '23:35:26', 2719.54, 1, '00000004', 0, 2, '2021-08-01 05:07:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecomprobanteproducto`
--

CREATE TABLE `detallecomprobanteproducto` (
  `id_detallecomprobantes` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `id_comprobante` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallecomprobanteproducto`
--

INSERT INTO `detallecomprobanteproducto` (`id_detallecomprobantes`, `id_producto`, `id_comprobante`) VALUES
(4, 1, 2),
(5, 1, 2),
(6, 1, 2),
(7, 1, 3),
(8, 7, 4),
(9, 7, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecomprobanteservicio`
--

CREATE TABLE `detallecomprobanteservicio` (
  `id_detallecomprobanteservicio` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallecomprobanteservicio`
--

INSERT INTO `detallecomprobanteservicio` (`id_detallecomprobanteservicio`, `id_servicio`, `id_comprobante`) VALUES
(1, 0, 2),
(2, 1, 2),
(3, 0, 3),
(4, 1, 3),
(5, 0, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleprivilegio`
--

CREATE TABLE `detalleprivilegio` (
  `id_detalleprivilegio` int(10) NOT NULL,
  `id_rol` int(10) NOT NULL,
  `id_privilegio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleprivilegio`
--

INSERT INTO `detalleprivilegio` (`id_detalleprivilegio`, `id_rol`, `id_privilegio`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 2, 8),
(4, 3, 5),
(5, 3, 9),
(6, 4, 6),
(7, 4, 4),
(8, 1, 1),
(9, 2, 1),
(10, 3, 1),
(11, 4, 1),
(12, 1, 7),
(13, 2, 7),
(14, 3, 7),
(15, 4, 7),
(16, 5, 1),
(17, 5, 2),
(18, 5, 3),
(19, 5, 4),
(20, 5, 5),
(21, 5, 6),
(22, 5, 7),
(23, 5, 8),
(24, 5, 9),
(25, 5, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleproformaproducto`
--

CREATE TABLE `detalleproformaproducto` (
  `id_detalleProformaProducto` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `id_proforma` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleproformaproducto`
--

INSERT INTO `detalleproformaproducto` (`id_detalleProformaProducto`, `id_producto`, `id_proforma`) VALUES
(1, 1, 4),
(2, 2, 4),
(3, 3, 4),
(4, 6, 5),
(5, 6, 5),
(6, 1, 6),
(7, 1, 6),
(8, 1, 6),
(9, 1, 7),
(10, 1, 8),
(11, 1, 9),
(12, 1, 10),
(13, 1, 11),
(14, 1, 12),
(15, 1, 13),
(16, 1, 14),
(17, 1, 15),
(18, 1, 16),
(19, 1, 17),
(20, 1, 18),
(21, 1, 19),
(22, 2, 20),
(23, 2, 21),
(24, 2, 22),
(25, 1, 23),
(26, 7, 24),
(27, 7, 25),
(28, 7, 26),
(29, 7, 27),
(30, 7, 28),
(31, 7, 29),
(32, 7, 30),
(33, 7, 31),
(34, 7, 32),
(35, 7, 33),
(36, 7, 34),
(37, 1, 35),
(38, 1, 36),
(39, 1, 37),
(40, 1, 38),
(41, 1, 39),
(42, 1, 40),
(43, 1, 41),
(44, 1, 42),
(45, 1, 43),
(46, 3, 44),
(47, 3, 45),
(48, 3, 46),
(49, 3, 47),
(50, 3, 48),
(51, 3, 49),
(52, 3, 50),
(53, 1, 51),
(54, 1, 51),
(55, 1, 51),
(56, 1, 51),
(57, 4, 51),
(58, 4, 51),
(59, 4, 51),
(60, 1, 52),
(61, 1, 52),
(62, 4, 52),
(63, 4, 52),
(64, 7, 52),
(65, 6, 53),
(66, 6, 53),
(67, 6, 53),
(68, 7, 53),
(69, 1, 54),
(70, 7, 55),
(71, 7, 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleproformaservicio`
--

CREATE TABLE `detalleproformaservicio` (
  `id_detalleproformaservicio` int(11) NOT NULL,
  `id_proforma` int(11) NOT NULL,
  `id_tiposervicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleproformaservicio`
--

INSERT INTO `detalleproformaservicio` (`id_detalleproformaservicio`, `id_proforma`, `id_tiposervicio`) VALUES
(1, 5, 1),
(3, 6, 0),
(4, 6, 1),
(5, 52, 0),
(6, 52, 1),
(7, 54, 0),
(8, 54, 1),
(9, 55, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocomprobante`
--

CREATE TABLE `estadocomprobante` (
  `id_estadoComprobante` int(10) NOT NULL,
  `nombre_estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadocomprobante`
--

INSERT INTO `estadocomprobante` (`id_estadoComprobante`, `nombre_estado`) VALUES
(0, 'despachado'),
(1, 'no despachado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoentidad`
--

CREATE TABLE `estadoentidad` (
  `id_estadoEntidad` int(10) NOT NULL,
  `nombre_estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadoentidad`
--

INSERT INTO `estadoentidad` (`id_estadoEntidad`, `nombre_estado`) VALUES
(0, 'habilitado'),
(1, 'deshabilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoincidencia`
--

CREATE TABLE `estadoincidencia` (
  `id_estadoIncidencia` int(10) NOT NULL,
  `nombre_estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadoincidencia`
--

INSERT INTO `estadoincidencia` (`id_estadoIncidencia`, `nombre_estado`) VALUES
(0, 'pendiente'),
(1, 'realizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoproformas`
--

CREATE TABLE `estadoproformas` (
  `id_estadoProforma` int(10) NOT NULL,
  `nombre_estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadoproformas`
--

INSERT INTO `estadoproformas` (`id_estadoProforma`, `nombre_estado`) VALUES
(0, 'atendido'),
(1, 'no atendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id_incidencias` int(10) NOT NULL,
  `hora_notificada` time NOT NULL,
  `fecha_notificada` date NOT NULL,
  `asunto` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `id_estadoincidencia` int(10) NOT NULL,
  `fecha_resolucion` date DEFAULT NULL,
  `id_usuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id_incidencias`, `hora_notificada`, `fecha_notificada`, `asunto`, `descripcion`, `id_estadoincidencia`, `fecha_resolucion`, `id_usuario`) VALUES
(1, '01:53:00', '2021-07-14', 'Perdi', 'Perdi', 1, NULL, 2),
(2, '01:53:00', '2021-07-14', 'Perdi', 'Perdi', 1, NULL, 2),
(3, '14:53:00', '2021-07-07', 'Perdi 2', 'perdi 2', 1, NULL, 2),
(4, '00:12:00', '2021-08-02', 'perdi 3', 'perdi 3', 1, NULL, 5),
(5, '19:02:00', '2021-08-02', 'perdi 4', 'perdi 4', 1, NULL, 1),
(6, '19:04:00', '2021-08-02', 'perdi 5', 'perdi 5', 1, '2021-08-02', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(10) NOT NULL,
  `marca_nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `marca_nombre`) VALUES
(1, 'EZVIZ'),
(2, 'HIKVISION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones`
--

CREATE TABLE `observaciones` (
  `id_observacion` int(10) NOT NULL,
  `nombre_observacion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `observaciones`
--

INSERT INTO `observaciones` (`id_observacion`, `nombre_observacion`) VALUES
(0, 'correcto'),
(1, 'error de fabrica'),
(2, 'dañado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE `privilegios` (
  `id_privilegio` int(10) NOT NULL,
  `nombre_proceso` varchar(100) NOT NULL,
  `boton_proceso` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`id_privilegio`, `nombre_proceso`, `boton_proceso`, `url`) VALUES
(1, 'Cambiar constraseña', 'btnCambiarPassword', '../moduloSeguridad/getCambiarPassword.php'),
(2, 'Emitir Proforma', 'btnEmitirProforma', '../moduloVentas/getEmitirProforma.php'),
(3, 'Emitir Comprobante de Pago', 'btnEmitirComprobante', '../moduloVentas/getComprobantePago.php'),
(4, 'Emitir reporte de incidencias', 'btnEmitirReporteIncidencias', '../moduloGestion/getIncidencia.php'),
(5, 'Registrar Despacho de productos', 'btnRegistrarDespacho', '../moduloVentas/getDespachoProducto.php'),
(6, 'Agendar Servicio', 'btnAgendarServicio', ''),
(7, 'Registrar Incidencia', 'btnRegistrarIncidencia', '../moduloVentas/getIncidencia.php'),
(8, 'Emitir Reporte de Ventas del Dia', 'btnEmitirReporteDeVentasDelDia', '../moduloGestion/getReporteVentas.php'),
(9, 'Gestionar Inventario', 'btnGestionarInventario', '../moduloGestion/getGestionarInventario.php'),
(11, 'Gestionar Datos del usuario', 'btnGestionarDatosDelUsuario', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(10) NOT NULL,
  `codigo_producto` varchar(30) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `stock` int(10) NOT NULL,
  `precioUnitario` double NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `id_marca` int(10) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `id_observacion` int(10) NOT NULL,
  `id_estadoEntidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `codigo_producto`, `nombre`, `stock`, `precioUnitario`, `id_categoria`, `id_marca`, `descripcion`, `id_observacion`, `id_estadoEntidad`) VALUES
(1, 'C-1', 'Cámara IP WIFI 720P interior, lente 2.8mm', 6, 159.36, 1, 1, ' Incluye fuente 220V. Con una base magnética, el C1C está diseñado para una instalación simple y rápida. Monitoreo de seguridad interior simplificado con su video HD de 720p, audio bidireccional y una visión nocturna clara, equilibrando el costo y el rendimiento de primera calidad.\r\n', 0, 0),
(2, 'C-3', 'Cámara IP WIFI 1080P interior, lente 2.8mm', 10, 196.47, 1, 1, 'Incluye fuente 220V. Con una base magnética, el C1C está diseñado para una instalación simple y rápida. Monitoreo de seguridad interior simplificado con su video HD de 1080p, audio bidireccional y una visión nocturna clara, equilibrando el costo y el rendimiento de primera calidad.', 0, 0),
(3, 'C-25', 'DOMO IP 2MP HD 1080p 30fps | CMOS 1/2.8\" ICR| IR 20 a 30m | IP67 | PoE | ANTIVANDALICO IK10.', 10, 327.44, 2, 2, 'Resolución: 1920x1080@30 fps • Lente: 2.8mm@F2.0 •Iluminación:0.01Lux@1.2 | 0Lux IR On • D-WDR. 3D DNR, BLC •Almacenamiento en red: NAS (NFS,SMB/CIFS) • Compresión: H.265+, H.265,H.264+, H.264 • Dual Stream • Alimentación: 12Vdc +/- 25%, PoE (802.3af).\r\nTCP/IP: 10/100Mbps • Compatible Software IVMS 4200. Sin fuente', 0, 0),
(4, 'C-26', 'DOMO EXTERIOR IP 2MP 1080p 30fps. Lente: 2.8-12MM | CMOS 1/2.8\" ICR |IR 20 a 30m', 10, 618.5, 2, 2, ' D-WDR |Slot Micro SD/SDHC/ SDXC | IP67 | IK10| PoE .Resolución: 1920x1080@30 fps •Lente: 2.8-12mm@F1.4 • Iluminación: 0.01Lux@1.2 | 0Lux IR On • D-WDR, 3DDNR, BLC •Compresión: H.265+, H.265, H.264+, H.264 •Dual Stream • Soporta Tarjeta SD hasta 128Gb •Alimentación: 12Vdc +/- 25%, PoE (802.3af). TCP/IP:10/100Mbps • Compatible Software IVMS 4200. Sin fuente', 0, 0),
(5, 'C-5', 'Cámara IP + PIR - WIFI 1080P interior, lente 2.8mm IR 6M.', 10, 265.59, 1, 1, 'Incluye fuente 220V. Con una base magnética, el C1C está diseñado para una instalación simple y rápida. Monitoreo de seguridad interior simplificado con su video HD de 1080p, audio bidireccional y una visión nocturna clara, equilibrando el costo y el rendimiento de primera calidad.', 0, 0),
(6, 'C-6', 'Tubo IP WIFI 720P', 10, 287.94, 1, 1, '1920x1080, ICR, 0lux con IR, H.264, dual- stream, DC5V, DWDR, 3D DNR, BLC, detección de movimiento, Slot para tarjeta micro SD(hasta 128GB), Up to 30m IR, con EZVIZ smart-config. IP66. Incluye micrófono y altavoz. Luz estroboscópica y sirena', 0, 0),
(7, 'C-28', 'DOMO EXTERIOR IP 2MP LENTE VARIFOCAL 2.8-12MM', 8, 1309.77, 3, 2, 'M • 1/2.8\" Progressive Scan CMOS • 1920 × 1080 resolution • 2.8 to 12 mm focal length • Powered by Darkfighter • H.265,H.265+, H.264+, H.264 • 120dB Wide Dynamic Range •BLC/3D DNR/ROI/HLC • IP66, IK10', 0, 0),
(8, 'c-99', 'camara rara', 3, 1.06, 2, 2, 'camara rara rota', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proformas`
--

CREATE TABLE `proformas` (
  `id_proforma` int(10) NOT NULL,
  `fecha_emision` date NOT NULL,
  `precioTotal` double NOT NULL,
  `hora_emision` varchar(12) NOT NULL,
  `id_estadoProforma` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_estadoEntidad` int(10) NOT NULL,
  `codigo_proforma` varchar(8) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `fechaYHora` timestamp NOT NULL DEFAULT current_timestamp(),
  `subtotal` double NOT NULL,
  `igv` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proformas`
--

INSERT INTO `proformas` (`id_proforma`, `fecha_emision`, `precioTotal`, `hora_emision`, `id_estadoProforma`, `id_cliente`, `id_estadoEntidad`, `codigo_proforma`, `id_usuario`, `fechaYHora`, `subtotal`, `igv`) VALUES
(1, '2021-07-03', 574, '01:03:27', 1, 1, 0, '00000001', 1, '2021-07-03 06:03:27', 486.8, 87.62),
(2, '2021-07-09', 917.9, '01:03:42', 1, 2, 0, '00000002', 1, '2021-07-09 06:03:42', 777.86, 140.01),
(3, '2021-07-05', 574, '01:03:53', 1, 1, 0, '00000003', 1, '2021-07-05 06:03:53', 486.8, 87.62),
(4, '2021-07-14', 683.27, '01:04:19', 1, 2, 0, '00000004', 1, '2021-07-14 06:04:19', 560.28, 122.98),
(5, '2021-07-14', 625.88, '01:04:02', 1, 1, 0, '00000005', 1, '2021-07-14 06:04:02', 513.23, 112.65),
(6, '2021-07-25', 628.08, '21:41:48', 0, 1, 0, '00000006', 1, '2021-07-26 02:41:48', 515.03, 113.05),
(7, '2021-07-30', 159.36, '23:23:04', 1, 1, 0, '00000007', 1, '2021-07-31 04:23:04', 130.68, 28.68),
(8, '2021-07-30', 159.36, '23:24:00', 1, 1, 0, '00000008', 1, '2021-07-31 04:24:00', 130.68, 28.68),
(9, '2021-07-30', 159.36, '23:27:26', 1, 1, 0, '00000009', 1, '2021-07-31 04:27:26', 130.68, 28.68),
(10, '2021-07-30', 159.36, '23:28:04', 1, 1, 0, '00000010', 1, '2021-07-31 04:28:04', 130.68, 28.68),
(11, '2021-07-30', 159.36, '23:28:22', 1, 1, 0, '00000011', 1, '2021-07-31 04:28:22', 130.68, 28.68),
(12, '2021-07-30', 159.36, '23:28:57', 1, 1, 0, '00000012', 1, '2021-07-31 04:28:57', 130.68, 28.68),
(13, '2021-07-30', 159.36, '23:31:42', 1, 1, 0, '00000013', 1, '2021-07-31 04:31:42', 130.68, 28.68),
(14, '2021-07-30', 159.36, '23:33:40', 1, 1, 0, '00000014', 1, '2021-07-31 04:33:40', 130.68, 28.68),
(15, '2021-07-30', 159.36, '23:34:56', 1, 1, 0, '00000015', 1, '2021-07-31 04:34:56', 130.68, 28.68),
(16, '2021-07-30', 159.36, '23:40:38', 1, 1, 0, '00000016', 1, '2021-07-31 04:40:38', 130.68, 28.68),
(17, '2021-07-30', 159.36, '23:41:32', 1, 1, 0, '00000017', 1, '2021-07-31 04:41:32', 130.68, 28.68),
(18, '2021-07-30', 159.36, '23:41:44', 1, 1, 0, '00000018', 1, '2021-07-31 04:41:44', 130.68, 28.68),
(19, '2021-07-30', 159.36, '23:49:08', 1, 1, 0, '00000019', 1, '2021-07-31 04:49:08', 130.68, 28.68),
(20, '2021-07-30', 196.47, '23:49:21', 1, 1, 0, '00000020', 1, '2021-07-31 04:49:21', 161.11, 35.36),
(21, '2021-07-30', 196.47, '23:50:10', 1, 1, 0, '00000021', 1, '2021-07-31 04:50:10', 161.11, 35.36),
(22, '2021-07-30', 196.47, '23:50:15', 1, 1, 0, '00000022', 1, '2021-07-31 04:50:15', 161.11, 35.36),
(23, '2021-07-30', 159.36, '23:50:38', 1, 1, 0, '00000023', 1, '2021-07-31 04:50:38', 130.68, 28.68),
(24, '2021-07-30', 1309.77, '23:51:56', 1, 1, 0, '00000024', 1, '2021-07-31 04:51:56', 1074.01, 235.76),
(25, '2021-07-31', 1309.77, '00:22:55', 1, 1, 0, '00000025', 1, '2021-07-31 05:22:55', 1074.01, 235.76),
(26, '2021-07-31', 1309.77, '00:30:49', 1, 1, 0, '00000026', 1, '2021-07-31 05:30:49', 1074.01, 235.76),
(27, '2021-07-31', 1309.77, '00:31:20', 1, 1, 0, '00000027', 1, '2021-07-31 05:31:20', 1074.01, 235.76),
(28, '2021-07-31', 1309.77, '00:31:28', 1, 1, 0, '00000028', 1, '2021-07-31 05:31:28', 1074.01, 235.76),
(29, '2021-07-31', 1309.77, '00:31:36', 1, 1, 0, '00000029', 1, '2021-07-31 05:31:36', 1074.01, 235.76),
(30, '2021-07-31', 1309.77, '00:32:10', 1, 1, 0, '00000030', 1, '2021-07-31 05:32:10', 1074.01, 235.76),
(31, '2021-07-31', 1309.77, '00:32:12', 1, 1, 0, '00000031', 1, '2021-07-31 05:32:12', 1074.01, 235.76),
(32, '2021-07-31', 1309.77, '00:32:22', 1, 1, 0, '00000032', 1, '2021-07-31 05:32:22', 1074.01, 235.76),
(33, '2021-07-31', 1309.77, '00:32:36', 1, 1, 0, '00000033', 1, '2021-07-31 05:32:36', 1074.01, 235.76),
(34, '2021-07-31', 1309.77, '00:34:07', 1, 1, 0, '00000034', 1, '2021-07-31 05:34:07', 1074.01, 235.76),
(35, '2021-07-31', 159.36, '00:34:45', 1, 1, 0, '00000035', 1, '2021-07-31 05:34:45', 130.68, 28.68),
(36, '2021-07-31', 159.36, '00:36:06', 1, 1, 0, '00000036', 1, '2021-07-31 05:36:06', 130.68, 28.68),
(37, '2021-07-31', 159.36, '01:15:53', 1, 1, 0, '00000037', 1, '2021-07-31 06:15:53', 130.68, 28.68),
(38, '2021-07-31', 159.36, '01:28:37', 1, 1, 0, '00000038', 1, '2021-07-31 06:28:37', 130.68, 28.68),
(39, '2021-07-31', 159.36, '01:28:49', 1, 1, 0, '00000039', 1, '2021-07-31 06:28:49', 130.68, 28.68),
(40, '2021-07-31', 159.36, '01:33:39', 1, 1, 0, '00000040', 1, '2021-07-31 06:33:39', 130.68, 28.68),
(41, '2021-07-31', 159.36, '01:33:56', 1, 1, 0, '00000041', 1, '2021-07-31 06:33:56', 130.68, 28.68),
(42, '2021-07-31', 159.36, '01:34:53', 1, 1, 0, '00000042', 1, '2021-07-31 06:34:53', 130.68, 28.68),
(43, '2021-07-31', 159.36, '01:34:55', 1, 1, 0, '00000043', 1, '2021-07-31 06:34:55', 130.68, 28.68),
(44, '2021-07-31', 327.44, '01:36:18', 1, 1, 0, '00000044', 1, '2021-07-31 06:36:18', 268.5, 58.94),
(45, '2021-07-31', 327.44, '01:36:40', 1, 1, 0, '00000045', 1, '2021-07-31 06:36:40', 268.5, 58.94),
(46, '2021-07-31', 327.44, '01:39:22', 1, 1, 0, '00000046', 1, '2021-07-31 06:39:22', 268.5, 58.94),
(47, '2021-07-31', 327.44, '01:41:33', 1, 1, 0, '00000047', 1, '2021-07-31 06:41:33', 268.5, 58.94),
(48, '2021-07-31', 327.44, '01:48:54', 1, 1, 0, '00000048', 1, '2021-07-31 06:48:54', 268.5, 58.94),
(49, '2021-07-31', 327.44, '01:49:10', 1, 1, 0, '00000049', 1, '2021-07-31 06:49:10', 268.5, 58.94),
(50, '2021-07-31', 327.44, '01:50:35', 1, 1, 0, '00000050', 1, '2021-07-31 06:50:35', 268.5, 58.94),
(51, '2021-07-31', 2492.94, '02:05:19', 1, 1, 0, '00000051', 1, '2021-07-31 07:05:19', 2044.21, 448.73),
(52, '2021-07-31', 3015.49, '03:08:29', 1, 1, 0, '00000052', 1, '2021-07-31 08:08:29', 2472.7, 542.79),
(53, '2021-07-31', 2173.59, '03:09:55', 1, 1, 0, '00000053', 1, '2021-07-31 08:09:55', 1782.34, 391.25),
(54, '2021-07-31', 309.36, '16:17:27', 0, 1, 0, '00000054', 1, '2021-07-31 21:17:27', 253.68, 55.68),
(55, '2021-07-31', 2719.54, '23:34:23', 0, 1, 0, '00000055', 1, '2021-08-01 04:34:23', 2230.02, 489.52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(10) NOT NULL,
  `nombre_rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'vendedor'),
(2, 'cajero'),
(3, 'despachador'),
(4, 'tecnico'),
(5, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(10) NOT NULL,
  `fecha_inicio_servicio` date NOT NULL,
  `hora_inicio_servicio` varchar(200) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_tipo` int(10) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `fecha_inicio_servicio`, `hora_inicio_servicio`, `id_cliente`, `id_tipo`, `descripcion`, `estado`) VALUES
(1, '2019-07-12', '11:26:55', 1, 0, 'algo', 1),
(2, '2018-07-13', '11:26:00', 2, 1, 'otro', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocomprobante`
--

CREATE TABLE `tipocomprobante` (
  `id_tipocomprobante` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipocomprobante`
--

INSERT INTO `tipocomprobante` (`id_tipocomprobante`, `nombre`) VALUES
(0, 'factura'),
(1, 'boleta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodeservicios`
--

CREATE TABLE `tipodeservicios` (
  `id_tipo` int(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `precioDeServicio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipodeservicios`
--

INSERT INTO `tipodeservicios` (`id_tipo`, `nombre`, `precioDeServicio`) VALUES
(0, 'instalacion', 100),
(1, 'mantenimiento', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `apellido_paterno` varchar(20) NOT NULL,
  `apellido_materno` varchar(20) NOT NULL,
  `username` varchar(16) NOT NULL,
  `id_rol` int(10) NOT NULL,
  `id_estadoEntidad` int(10) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `celular` varchar(9) NOT NULL,
  `email` varchar(40) NOT NULL,
  `secreta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `password`, `apellido_paterno`, `apellido_materno`, `username`, `id_rol`, `id_estadoEntidad`, `dni`, `celular`, `email`, `secreta`) VALUES
(1, 'Liset', 'eafa3b33aec9ae55e278929d6144f35f', 'Rincon', 'Sanchez', 'lisetRincon', 1, 0, '44653245', '974106988', 'liset@gmail.com', 'lisettumami'),
(2, 'Jorge', 'd67326a22642a324aa1b0745f2f17abb', 'Hoyos', 'Reyna', 'jorgeTheLord', 2, 0, '47943385', '991112010', 'jorge@gmail.com', 'darla'),
(3, 'Paul', '6c63212ab48e8401eaf6b59b95d816a9', 'Del Aguilar', 'Caute', 'paulDC', 3, 0, '75284156', '921881548', 'paul@gmail.com', 'poolvaso'),
(5, 'Carlos', 'dc599a9972fde3045dab59dbd1ae170b', 'Carbajal', 'Rojas', 'carlos', 4, 0, '70693593', '932015412', 'carlos@gmail.com', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `comprobantedepago`
--
ALTER TABLE `comprobantedepago`
  ADD PRIMARY KEY (`id_comprobante`),
  ADD KEY `id_tipocomprobante` (`id_tipocomprobante`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_estadocomprobante` (`id_estadoComprobante`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detallecomprobanteproducto`
--
ALTER TABLE `detallecomprobanteproducto`
  ADD PRIMARY KEY (`id_detallecomprobantes`),
  ADD KEY `id_comprobante` (`id_comprobante`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detallecomprobanteservicio`
--
ALTER TABLE `detallecomprobanteservicio`
  ADD PRIMARY KEY (`id_detallecomprobanteservicio`);

--
-- Indices de la tabla `detalleprivilegio`
--
ALTER TABLE `detalleprivilegio`
  ADD PRIMARY KEY (`id_detalleprivilegio`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_privilegio` (`id_privilegio`);

--
-- Indices de la tabla `detalleproformaproducto`
--
ALTER TABLE `detalleproformaproducto`
  ADD PRIMARY KEY (`id_detalleProformaProducto`),
  ADD KEY `id_proforma` (`id_proforma`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalleproformaservicio`
--
ALTER TABLE `detalleproformaservicio`
  ADD PRIMARY KEY (`id_detalleproformaservicio`);

--
-- Indices de la tabla `estadocomprobante`
--
ALTER TABLE `estadocomprobante`
  ADD PRIMARY KEY (`id_estadoComprobante`);

--
-- Indices de la tabla `estadoentidad`
--
ALTER TABLE `estadoentidad`
  ADD PRIMARY KEY (`id_estadoEntidad`);

--
-- Indices de la tabla `estadoincidencia`
--
ALTER TABLE `estadoincidencia`
  ADD PRIMARY KEY (`id_estadoIncidencia`);

--
-- Indices de la tabla `estadoproformas`
--
ALTER TABLE `estadoproformas`
  ADD PRIMARY KEY (`id_estadoProforma`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id_incidencias`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_estadoincidencia` (`id_estadoincidencia`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `observaciones`
--
ALTER TABLE `observaciones`
  ADD PRIMARY KEY (`id_observacion`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`id_privilegio`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_observacion` (`id_observacion`),
  ADD KEY `id_estadoEntidad` (`id_estadoEntidad`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `proformas`
--
ALTER TABLE `proformas`
  ADD PRIMARY KEY (`id_proforma`),
  ADD KEY `id_estadoProforma` (`id_estadoProforma`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_estadoEntidad` (`id_estadoEntidad`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `tipocomprobante`
--
ALTER TABLE `tipocomprobante`
  ADD PRIMARY KEY (`id_tipocomprobante`);

--
-- Indices de la tabla `tipodeservicios`
--
ALTER TABLE `tipodeservicios`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_estadoEntidad` (`id_estadoEntidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comprobantedepago`
--
ALTER TABLE `comprobantedepago`
  MODIFY `id_comprobante` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detallecomprobanteproducto`
--
ALTER TABLE `detallecomprobanteproducto`
  MODIFY `id_detallecomprobantes` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detallecomprobanteservicio`
--
ALTER TABLE `detallecomprobanteservicio`
  MODIFY `id_detallecomprobanteservicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalleprivilegio`
--
ALTER TABLE `detalleprivilegio`
  MODIFY `id_detalleprivilegio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `detalleproformaproducto`
--
ALTER TABLE `detalleproformaproducto`
  MODIFY `id_detalleProformaProducto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `detalleproformaservicio`
--
ALTER TABLE `detalleproformaservicio`
  MODIFY `id_detalleproformaservicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estadocomprobante`
--
ALTER TABLE `estadocomprobante`
  MODIFY `id_estadoComprobante` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estadoentidad`
--
ALTER TABLE `estadoentidad`
  MODIFY `id_estadoEntidad` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estadoincidencia`
--
ALTER TABLE `estadoincidencia`
  MODIFY `id_estadoIncidencia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estadoproformas`
--
ALTER TABLE `estadoproformas`
  MODIFY `id_estadoProforma` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id_incidencias` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `observaciones`
--
ALTER TABLE `observaciones`
  MODIFY `id_observacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `id_privilegio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `proformas`
--
ALTER TABLE `proformas`
  MODIFY `id_proforma` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipocomprobante`
--
ALTER TABLE `tipocomprobante`
  MODIFY `id_tipocomprobante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipodeservicios`
--
ALTER TABLE `tipodeservicios`
  MODIFY `id_tipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comprobantedepago`
--
ALTER TABLE `comprobantedepago`
  ADD CONSTRAINT `comprobantedepago_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comprobantedepago_ibfk_2` FOREIGN KEY (`id_estadoComprobante`) REFERENCES `estadocomprobante` (`id_estadoComprobante`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comprobantedepago_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallecomprobanteproducto`
--
ALTER TABLE `detallecomprobanteproducto`
  ADD CONSTRAINT `detallecomprobanteproducto_ibfk_2` FOREIGN KEY (`id_comprobante`) REFERENCES `comprobantedepago` (`id_comprobante`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detallecomprobanteproducto_ibfk_3` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleprivilegio`
--
ALTER TABLE `detalleprivilegio`
  ADD CONSTRAINT `detalleprivilegio_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleprivilegio_ibfk_2` FOREIGN KEY (`id_privilegio`) REFERENCES `privilegios` (`id_privilegio`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleproformaproducto`
--
ALTER TABLE `detalleproformaproducto`
  ADD CONSTRAINT `detalleproformaproducto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleproformaproducto_ibfk_3` FOREIGN KEY (`id_proforma`) REFERENCES `proformas` (`id_proforma`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `incidencias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `incidencias_ibfk_2` FOREIGN KEY (`id_estadoincidencia`) REFERENCES `estadoincidencia` (`id_estadoIncidencia`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_foreign_key_id_marca` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_estadoEntidad`) REFERENCES `estadoentidad` (`id_estadoEntidad`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`id_observacion`) REFERENCES `observaciones` (`id_observacion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_4` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proformas`
--
ALTER TABLE `proformas`
  ADD CONSTRAINT `proformas_ibfk_1` FOREIGN KEY (`id_estadoProforma`) REFERENCES `estadoproformas` (`id_estadoProforma`) ON UPDATE CASCADE,
  ADD CONSTRAINT `proformas_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `proformas_ibfk_3` FOREIGN KEY (`id_estadoEntidad`) REFERENCES `estadoentidad` (`id_estadoEntidad`) ON UPDATE CASCADE,
  ADD CONSTRAINT `proformas_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `servicios_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tipodeservicios` (`id_tipo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_estadoEntidad`) REFERENCES `estadoentidad` (`id_estadoEntidad`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
