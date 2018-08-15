-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 14, 2018 at 08:28 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.2.7-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sysmedic`
--

-- --------------------------------------------------------

--
-- Table structure for table `abilities`
--

CREATE TABLE `abilities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity_id` int(10) UNSIGNED DEFAULT NULL,
  `entity_type` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `only_owned` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abilities`
--

INSERT INTO `abilities` (`id`, `name`, `title`, `entity_id`, `entity_type`, `only_owned`, `created_at`, `updated_at`) VALUES
(1, 'users_manage', NULL, NULL, NULL, 0, '2018-07-02 01:41:41', '2018-07-02 01:41:41'),
(2, 'users_admin_sedes', NULL, NULL, NULL, 0, '2018-07-02 01:45:38', '2018-07-02 01:45:38'),
(3, 'users_managefull', NULL, NULL, NULL, 0, '2018-07-14 01:10:26', '2018-07-14 01:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `analises`
--

CREATE TABLE `analises` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `laboratorio` varchar(100) NOT NULL,
  `preciopublico` text NOT NULL,
  `costlab` text NOT NULL,
  `porcentaje` varchar(200) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analises`
--

INSERT INTO `analises` (`id`, `name`, `laboratorio`, `preciopublico`, `costlab`, `porcentaje`, `created_at`, `updated_at`, `id_empresa`, `id_sucursal`) VALUES
(1, 'Glicemia', 'laboratorio', '798', '234', '', '2018-07-03', '2018-07-03', 1, 1),
(2, 'Glicemia', 'laboratorio', '100', '2000', '', '2018-07-03', '2018-07-03', 1, 1),
(3, 'Azucar', 'laboratorio1', '123', '250', '', '2018-07-03', '2018-07-03', 1, 2),
(4, 'dsdsd', 'laboratorio', '232', '232', '', '2018-07-13', '2018-07-13', 1, 1),
(5, 'bbbbbbb', 'laboratorio', '545', '4445', '', '2018-07-13', '2018-07-13', 1, 2),
(6, 'PERFIL OBSTETRICO CON HIV', 'BLUFSTEIN', '120.00', '29.00', '10.00', '2018-07-16', '2018-08-08', 1, 1),
(7, 'administrator', 'laboratorio', '50', '343', '', '2018-07-16', '2018-07-16', 1, 1),
(9, 'Decimales', 'laboratorio', '125', '100', '', '2018-07-16', '2018-07-16', 1, 1),
(11, 'prueba', 'laboratorio', '1', '1250', '', '2018-07-16', '2018-07-16', 1, 1),
(12, 'users_admin_sedes', 'laboratorio', '1', '1500', '', '2018-07-16', '2018-07-16', 1, 1),
(13, 'tytytyt', 'laboratorio', '556', '556', '', '2018-07-16', '2018-07-16', 1, 1),
(14, 'ssssssssss', 'laboratorio', '333', '333', '', '2018-07-16', '2018-07-16', 1, 1),
(15, 'xzxzxz', 'laboratorio', '1250', '1250', '', '2018-07-16', '2018-07-16', 1, 1),
(16, 'aaaaaa', 'laboratorio', '1250', '1250', '', '2018-07-16', '2018-07-16', 1, 1),
(17, 'aaaa', 'laboratorio', '1250', '1250', '', '2018-07-16', '2018-07-16', 1, 1),
(18, 'bbbbb', 'laboratorio', '1.250,00', '1.250,00', '', '2018-07-16', '2018-07-16', 1, 1),
(19, 'LISTOOOO', 'laboratorio', '400,00', '400,00', '', '2018-07-16', '2018-07-16', 1, 1),
(20, 'CA-123 MARCADOR TUMORAL', 'BGL LABORATORIOS', '200.00', '45.00', '', '2018-08-02', '2018-08-02', 1, 1),
(21, 'GRUPO SANG. Y FACTOR RH', 'BGL', '15.00', '4.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(22, 'HEMATOCRITO', 'BGL', '15.00', '3.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(23, 'HEMOGLOBINA', 'BGL', '15.00', '3.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(24, 'HEMOGRAMA COMPLETO (AUTORIZADO)', 'BGL', '25.00', '8.00', '5.00', '2018-08-06', '2018-08-13', 1, 5),
(25, 'VELOC.DE SEDIM.GLOBULAR', 'BGL', '15.00', '3.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(26, 'TIEMPO DE COAGULACIÓN', 'BGL', '15.00', '2.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(27, 'TIEMPO DE PROTOMBINA', 'BGL', '35.00', '13.00', '7.00', '2018-08-06', '2018-08-13', 1, 5),
(28, 'TIEMPO DE TROMBINA', 'BGL', '50.00', '20.00', '10.00', '2018-08-06', '2018-08-13', 1, 5),
(29, 'AC. URICO', 'BGL', '15.00', '4.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(30, 'AMILASA', 'BGL', '28.00', '8.00', '5.50', '2018-08-06', '2018-08-13', 1, 5),
(31, 'BILIRRUBINA T-F', 'BGL', '15.00', '4.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(32, 'BILIRRUBINA T-F', 'BGL', '15.00', '4.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(33, 'COLESTEROL TOTAL', 'BGL', '15.00', '4.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(34, 'CREATININA', 'BGL', '15.00', '4.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(35, 'FOSFATASA ALCALINA', 'BGL', '25.00', '6.00', '5.00', '2018-08-06', '2018-08-13', 1, 5),
(36, 'GLUCOSA', 'BGL', '15.00', '3.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(37, 'HDL COLESTEROL', 'BGL', '15.00', '4.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(38, 'LDL COLESTEROL', 'BGL', '15.00', '4.50', '3.00', '2018-08-06', '2018-08-13', 1, 5),
(39, 'LIPIDOS TOTALES', 'BGL', '30.00', '8.50', '6.00', '2018-08-06', '2018-08-13', 1, 5),
(40, 'PROTEINAS  T-F', 'BGL', '20.00', '5.00', '4.00', '2018-08-06', '2018-08-13', 1, 5),
(41, 'TGO', 'BGL', '30.00', '4.50', '6.00', '2018-08-06', '2018-08-13', 1, 5),
(42, 'TGP', 'BGL', '30.00', '4.50', '6.00', '2018-08-06', '2018-08-13', 1, 5),
(43, 'TRIGLICERIDOS', 'BGL', '25.00', '5.00', '4.00', '2018-08-06', '2018-08-13', 1, 5),
(44, 'UREA', 'BGL', '25.00', '4.50', '5.00', '2018-08-06', '2018-08-13', 1, 5),
(45, 'VLDL COLESTEROL', 'BGL', '20.00', '5.00', '4.00', '2018-08-06', '2018-08-13', 1, 5),
(46, 'GLUCOSA POST PRANDIAL', 'BGL', '20.00', '3.50', '4.00', '2018-08-06', '2018-08-13', 1, 5),
(47, 'HEMOGLOBINA GLUCOSILADA', 'BGL', '70.00', '24.00', '14.00', '2018-08-06', '2018-08-13', 1, 5),
(48, 'AGLUTINACIONES EN PLACA', 'BGL', '25.00', '7.00', '5.00', '2018-08-06', '2018-08-13', 1, 5),
(49, 'PROTEINA C REACTIVA', 'BGL', '35.00', '7.00', '7.00', '2018-08-06', '2018-08-13', 1, 5),
(50, 'VDRL O RPR', 'BGL', '25.00', '5.50', '5.00', '2018-08-06', '2018-08-13', 1, 5),
(51, 'HEPATITIS A ig M', 'BGL', '100.00', '39.00', '15.00', '2018-08-06', '2018-08-13', 1, 5),
(52, 'HEPATITIS  D IgM', 'BGL', '15.00', '120.00', '', '2018-08-06', '2018-08-06', 1, 5),
(53, 'HEPATITIS B ANTICORE  Ig M', 'BGL', '15.00', '40.00', '', '2018-08-06', '2018-08-06', 1, 5),
(54, 'HEPATITIS B ANTICORE  TOTAL', 'BGL', '15.00', '35.00', '', '2018-08-06', '2018-08-06', 1, 5),
(55, 'HERPES I IgM/HERPES I IgG c/u', 'BGL', '15.00', '28.00', '', '2018-08-06', '2018-08-06', 1, 5),
(56, 'HERPES II IgM/HERPES II IgG c/u', 'BGL', '60.00', '28.00', '', '2018-08-06', '2018-08-06', 1, 5),
(57, 'HIV- ELISA', 'BGL', '15.00', '18.00', '', '2018-08-06', '2018-08-06', 1, 5),
(58, 'Ig M', 'BGL', '15.00', '28.00', '', '2018-08-06', '2018-08-06', 1, 5),
(59, 'Ig G', 'BGL', '15.00', '28.00', '', '2018-08-06', '2018-08-06', 1, 5),
(60, 'COLORACION GRAM', 'BGL', '15.00', '4.50', '', '2018-08-06', '2018-08-06', 1, 5),
(61, 'EXAMEN COMPLETO DE ORINA', 'BGL', '15.00', '4.50', '', '2018-08-06', '2018-08-06', 1, 5),
(62, 'REACCION INFLAMATORIA DE -HECES', 'BGL', '15.00', '4.50', '', '2018-08-06', '2018-08-06', 1, 5),
(63, 'PARASITOX3 MUESTRAS', 'BGL', '15.00', '9.00', '', '2018-08-06', '2018-08-06', 1, 5),
(64, 'SECREC. CULTIVO Y ANTIBIOGRAMA', 'BGL', '15.00', '15.50', '', '2018-08-06', '2018-08-06', 1, 5),
(65, 'UROCULTIVO Y ANTIBIOGRAMA', 'BGL', '15.00', '12.00', '', '2018-08-06', '2018-08-06', 1, 5),
(66, 'CULTIVO DE SECRECION VAGINAL', 'BGL', '15.00', '15.50', '', '2018-08-06', '2018-08-06', 1, 5),
(67, 'PROLACTINA', 'BGL', '15.00', '18.50', '', '2018-08-06', '2018-08-06', 1, 5),
(68, 'HCH-ANTISUBUNIDAD BETA(CUALITATIVO)', 'BGL', '15.00', '11.00', '', '2018-08-06', '2018-08-06', 1, 5),
(69, 'INSULINA', 'BGL', '15.00', '30.00', '', '2018-08-06', '2018-08-06', 1, 5),
(70, 'PSA TOTAL', 'BGL', '15.00', '19.00', '', '2018-08-06', '2018-08-06', 1, 5),
(71, 'PSA(LIBRE)', 'BGL', '15.00', '30.00', '', '2018-08-06', '2018-08-06', 1, 5),
(72, 'INDICE DE PSA', 'BGL', '15.00', '50.00', '', '2018-08-06', '2018-08-06', 1, 5),
(73, 'PROTEINAS EN 24HRS', 'BGL', '15.00', '9.00', '', '2018-08-06', '2018-08-06', 1, 5),
(74, 'CREATINIA  ORONA SIMPLE', 'BGL', '15.00', '5.00', '', '2018-08-06', '2018-08-06', 1, 5),
(75, 'CREATINIA  ORONA SIMPLE', 'BGL', '15.00', '5.00', '', '2018-08-06', '2018-08-06', 1, 5),
(76, 'BIOPSIA <1.0 cm', 'BGL', '15.00', '40.00', '', '2018-08-06', '2018-08-06', 1, 5),
(77, 'HELYCOBACRER PYLORI Ig M', 'BGL', '15.00', '30.00', '', '2018-08-06', '2018-08-06', 1, 5),
(78, 'PERFIL LIPIDICO (Col.total, HDL, LDL, VLDL, TRIGLIT., RIESGO CORONARIO)', 'BGL', '15.00', '20.00', '', '2018-08-06', '2018-08-06', 1, 5),
(79, 'PERFIL HEPATICO', 'BGL', '15.00', '19.50', '', '2018-08-06', '2018-08-06', 1, 5),
(80, 'PERFIL TIROIDEO', 'BGL', '15.00', '48.50', '', '2018-08-06', '2018-08-06', 1, 5),
(81, 'PERFIL HORMONAL FEMENINO', 'BGL', '15.00', '69.00', '', '2018-08-06', '2018-08-06', 1, 5),
(82, 'PERFIL PRENATAL', 'BGL', '15.00', '30.00', '', '2018-08-06', '2018-08-06', 1, 5),
(83, 'HEMOGRAMA COMPLETO', 'BLUFSTEIN', '25.60', '5.00', '10.00', '2018-08-07', '2018-08-07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `assigned_roles`
--

CREATE TABLE `assigned_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `entity_id` int(10) UNSIGNED NOT NULL,
  `entity_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assigned_roles`
--

INSERT INTO `assigned_roles` (`role_id`, `entity_id`, `entity_type`) VALUES
(1, 1, 'App\\User'),
(1, 2, 'App\\User'),
(1, 3, 'App\\User'),
(2, 4, 'App\\User'),
(1, 5, 'App\\User'),
(1, 6, 'App\\User'),
(1, 7, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `atencions`
--

CREATE TABLE `atencions` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atencions`
--

INSERT INTO `atencions` (`id`, `id_empresa`, `id_sucursal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-07-27', '2018-07-27'),
(2, 1, 1, '2018-07-27', '2018-07-27'),
(3, 1, 1, '2018-07-30', '2018-07-30'),
(4, 1, 1, '2018-07-30', '2018-07-30'),
(5, 1, 1, '2018-07-30', '2018-07-30'),
(6, 1, 1, '2018-08-01', '2018-08-01'),
(7, 1, 1, '2018-08-02', '2018-08-02'),
(8, 1, 1, '2018-08-02', '2018-08-02'),
(9, 1, 1, '2018-08-02', '2018-08-02'),
(10, 1, 1, '2018-08-02', '2018-08-02'),
(11, 1, 1, '2018-08-02', '2018-08-02'),
(12, 1, 1, '2018-08-02', '2018-08-02'),
(13, 1, 1, '2018-08-02', '2018-08-02'),
(14, 1, 1, '2018-08-02', '2018-08-02'),
(15, 1, 1, '2018-08-02', '2018-08-02'),
(16, 1, 1, '2018-08-02', '2018-08-02'),
(17, 1, 1, '2018-08-02', '2018-08-02'),
(18, 1, 1, '2018-08-02', '2018-08-02'),
(19, 1, 1, '2018-08-02', '2018-08-02'),
(20, 1, 1, '2018-08-02', '2018-08-02'),
(21, 1, 1, '2018-08-03', '2018-08-03'),
(22, 1, 1, '2018-08-03', '2018-08-03'),
(23, 1, 1, '2018-08-03', '2018-08-03'),
(24, 1, 1, '2018-08-03', '2018-08-03'),
(25, 1, 1, '2018-08-04', '2018-08-04'),
(26, 1, 1, '2018-08-05', '2018-08-05'),
(27, 1, 5, '2018-08-06', '2018-08-06'),
(28, 1, 1, '2018-08-07', '2018-08-07'),
(29, 1, 1, '2018-08-07', '2018-08-07'),
(30, 1, 1, '2018-08-07', '2018-08-07'),
(31, 1, 1, '2018-08-07', '2018-08-07'),
(32, 1, 1, '2018-08-07', '2018-08-07'),
(33, 1, 1, '2018-08-08', '2018-08-08'),
(34, 1, 1, '2018-08-08', '2018-08-08'),
(35, 1, 1, '2018-08-08', '2018-08-08'),
(36, 1, 1, '2018-08-08', '2018-08-08'),
(37, 1, 1, '2018-08-08', '2018-08-08'),
(38, 1, 5, '2018-08-08', '2018-08-08'),
(39, 1, 5, '2018-08-08', '2018-08-08'),
(40, 1, 5, '2018-08-08', '2018-08-08'),
(41, 1, 1, '2018-08-08', '2018-08-08'),
(42, 1, 1, '2018-08-10', '2018-08-10'),
(43, 1, 1, '2018-08-13', '2018-08-13'),
(44, 1, 1, '2018-08-13', '2018-08-13'),
(45, 1, 1, '2018-08-14', '2018-08-14'),
(46, 1, 1, '2018-08-14', '2018-08-14'),
(47, 1, 1, '2018-08-14', '2018-08-14'),
(48, 1, 5, '2018-08-14', '2018-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `atencion_detalles`
--

CREATE TABLE `atencion_detalles` (
  `id` int(11) NOT NULL,
  `id_atencion` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_servicio` int(11) DEFAULT '1',
  `id_paquete` int(11) NOT NULL,
  `costo` text,
  `porcentaje` text,
  `acuenta` text,
  `costoa` text,
  `pendiente` int(11) NOT NULL,
  `pagado` tinyint(1) NOT NULL DEFAULT '0',
  `tarjeta` varchar(200) DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atencion_detalles`
--

INSERT INTO `atencion_detalles` (`id`, `id_atencion`, `id_paciente`, `id_servicio`, `id_paquete`, `costo`, `porcentaje`, `acuenta`, `costoa`, `pendiente`, `pagado`, `tarjeta`, `observaciones`, `created_at`, `updated_at`) VALUES
(6, 1, 9, NULL, 0, '200,00', '110,00', 'PA', '10', 0, 0, 'prueba', 'tester', '2018-07-27', '2018-07-27'),
(7, 2, 14, NULL, 0, '60,00', '45,80', 'PA', '60,00', 0, 0, '4', '4', '2018-07-27', '2018-07-27'),
(8, 3, 8, 7, 0, '60,00', '45,80', 'PA', '60,00', 0, 0, 'x', 's', '2018-07-30', '2018-07-30'),
(9, 4, 8, NULL, 0, '30.00', '0.52', 'EF', '30', 0, 0, 'giygui', 'jhjk', '2018-07-30', '2018-07-30'),
(10, 5, 8, 7, 0, '30.00', '0.52', 'EF', '30', 0, 0, 'giygui', 'jhjk', '2018-07-30', '2018-07-30'),
(11, 6, 14, NULL, 0, '1.250,90', '45.80', 'EF', '1250,90', 0, 0, '4', 's', '2018-08-01', '2018-08-01'),
(12, 7, 14, 7, 0, '60', '50', 'EF', '60,00', 0, 0, '4', '4', '2018-08-02', '2018-08-02'),
(13, 8, 8, 6, 0, '120.00', '50.00', 'EF', '20', 0, 0, 'ddd', 'ddddd', '2018-08-02', '2018-08-02'),
(14, 9, 8, 6, 0, '250.00', '250.00', 'EF', '55', 0, 0, 'dfdfd', 'fdfdfd', '2018-08-02', '2018-08-02'),
(15, 10, 14, NULL, 0, '234,50', '0.10', 'EF', '234,50', 0, 0, '4', 'jhjk', '2018-08-02', '2018-08-02'),
(16, 11, 14, NULL, 0, '234,50', '0.52', '0', '234,50', 0, 0, 'x', '4', '2018-08-02', '2018-08-02'),
(17, 12, 15, 7, 0, '60', '50', 'EF', '30', 0, 0, 'ghghgh', 'ghghghgh', '2018-08-02', '2018-08-02'),
(18, 13, 14, 7, 0, '60', '50', 'EF', '60,00', 0, 0, 'x', '4', '2018-08-02', '2018-08-02'),
(19, 14, 15, NULL, 0, '234.50', '0.52', 'EF', '234,50d', 0, 0, '4d', 'jhjk', '2018-08-02', '2018-08-02'),
(20, 15, 15, NULL, 0, '234.50', '0.52', 'EF', '234,50', 0, 0, '4d', 'jhjk', '2018-08-02', '2018-08-02'),
(21, 16, 15, NULL, 0, '234.50', '0.52', 'EF', '234,50', 0, 0, '4d', 'jhjk', '2018-08-02', '2018-08-02'),
(22, 17, 14, 8, 0, '120.00', '50.00', 'EF', '12.50', 0, 0, 'NO DEBE SER OBLIG', 'NO DEBE SER OBLIGATORIO', '2018-08-02', '2018-08-02'),
(23, 18, 12, 5, 0, '2121', '121', '0', '2121', 0, 0, 'giygui', 'jhjk', '2018-08-02', '2018-08-02'),
(24, 19, 14, NULL, 0, '120.00', '50.00', 'EF', '120', 0, 0, 'giygui', 'jhjk', '2018-08-02', '2018-08-02'),
(25, 20, 12, NULL, 0, '120.00', '0.52', 'EF', '120', 0, 0, 'x', 'jhjk', '2018-08-02', '2018-08-02'),
(26, 21, 16, 1, 0, '60', '50', '0', '60,00', 0, 0, NULL, NULL, '2018-08-03', '2018-08-03'),
(27, 22, 14, 1, 0, '60', '50', '0', '60,00', 0, 0, NULL, NULL, '2018-08-03', '2018-08-03'),
(28, 23, 9, 1, 0, '50.00', '50', 'EF', '50,00', 0, 0, NULL, NULL, '2018-08-03', '2018-08-03'),
(29, 24, 13, 1, 0, '60,00', '45,80', 'TJ', '60,00', 0, 0, '45557', NULL, '2018-08-03', '2018-08-03'),
(30, 25, 15, 1, 0, '234,50', '0.10', '0', '234,50', 0, 0, NULL, NULL, '2018-08-04', '2018-08-04'),
(31, 26, 14, 1, 0, '1.250,00', '1.250,00', 'EF', '1250,90', 0, 0, '4', 'jhjk', '2018-08-05', '2018-08-05'),
(32, 27, 17, 1, 0, '25', '0', 'EF', '25', 0, 0, 'X', 'NINGUNA', '2018-08-06', '2018-08-06'),
(33, 28, 20, 1, 0, '320', '0.10', 'EF', '200', 0, 0, NULL, NULL, '2018-08-07', '2018-08-07'),
(34, 29, 14, 1, 0, '798', '0.10', 'EF', '798', 0, 0, NULL, NULL, '2018-08-07', '2018-08-07'),
(35, 30, 14, 1, 0, '7.98', '0.10', 'EF', '798', 0, 0, 'x', '4', '2018-08-07', '2018-08-07'),
(36, 31, 14, 1, 0, '798.00', '0.10', 'EF', '798', 0, 0, 'x', '4', '2018-08-07', '2018-08-07'),
(37, 32, 14, 1, 0, '798.00', '0.10', 'EF', '798', 0, 0, 'x', '4', '2018-08-07', '2018-08-07'),
(38, 33, 21, 1, 0, '60', '0', 'EF', '60,00', 0, 0, NULL, NULL, '2018-08-08', '2018-08-08'),
(39, 34, 16, 1, 0, '530', '0', 'EF', '120', 0, 0, 'f', 'f', '2018-08-08', '2018-08-08'),
(40, 35, 15, 1, 0, '460', '0', 'EF', '460.00', 0, 0, NULL, NULL, '2018-08-08', '2018-08-08'),
(41, 36, 14, 1, 0, '180.00', '0', 'EF', '180', 0, 0, NULL, NULL, '2018-08-08', '2018-08-08'),
(42, 37, 20, 1, 0, '120', '0', 'EF', '120', 0, 0, NULL, NULL, '2018-08-08', '2018-08-08'),
(43, 38, 17, 1, 0, '60', '0', '0', '45', 0, 0, NULL, NULL, '2018-08-08', '2018-08-08'),
(44, 39, 17, 1, 0, '60', '0', '0', '45', 0, 0, NULL, NULL, '2018-08-08', '2018-08-08'),
(45, 40, 23, 1, 0, '45.00', '0', '0', '45', 0, 0, NULL, NULL, '2018-08-08', '2018-08-08'),
(46, 41, 14, 1, 0, '70', '0', 'EF', '70.00', 0, 0, NULL, NULL, '2018-08-08', '2018-08-08'),
(47, 42, 14, 1, 9, '45.00', '0', 'EF', '45.00', 0, 0, NULL, NULL, '2018-08-10', '2018-08-10'),
(48, 43, 15, 1, 0, '250', '2.00', 'EF', '100.00', 0, 0, 'sdsd', 'sds', '2018-08-13', '2018-08-13'),
(49, 44, 24, 1, 0, '120.00', '0.01', 'EF', '120.00', 0, 0, NULL, NULL, '2018-08-13', '2018-08-13'),
(50, 45, 14, 1, 0, '60', '0', 'EF', '60.00', 0, 1, NULL, NULL, '2018-08-14', '2018-08-14'),
(51, 46, 24, 1, 0, '50.00', '10.00', 'EF', '25.00', 25, 1, NULL, NULL, '2018-08-14', '2018-08-14'),
(52, 47, 24, 1, 0, '60', '0', 'EF', '30.00', 30, 1, NULL, NULL, '2018-08-14', '2018-08-14'),
(53, 48, 35, 1, 0, '60', '25.00', 'EF', '60.00', 0, 0, NULL, NULL, '2018-08-14', '2018-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `atencion_laboratorios`
--

CREATE TABLE `atencion_laboratorios` (
  `id` int(11) NOT NULL,
  `id_atencion` int(11) NOT NULL,
  `id_analisis` int(11) NOT NULL,
  `pagado` tinyint(1) NOT NULL DEFAULT '0',
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atencion_laboratorios`
--

INSERT INTO `atencion_laboratorios` (`id`, `id_atencion`, `id_analisis`, `pagado`, `id_empresa`, `id_sucursal`, `created_at`, `updated_at`) VALUES
(1, 30, 1, 0, 0, 0, '2018-07-28', '2018-07-28'),
(2, 30, 7, 0, 0, 0, '2018-07-28', '2018-07-28'),
(3, 31, 4, 0, 0, 0, '2018-07-28', '2018-07-28'),
(4, 32, 2, 0, 0, 0, '2018-07-28', '2018-07-28'),
(5, 32, 6, 0, 0, 0, '2018-07-28', '2018-07-28'),
(6, 33, 2, 1, 1, 1, '2018-07-28', '2018-07-28'),
(7, 33, 6, 1, 1, 1, '2018-07-28', '2018-07-28'),
(8, 33, 7, 1, 1, 1, '2018-07-28', '2018-07-28'),
(9, 34, 2, 0, 1, 1, '2018-07-28', '2018-07-28'),
(10, 34, 6, 0, 1, 1, '2018-07-28', '2018-07-28'),
(11, 34, 7, 0, 1, 1, '2018-07-28', '2018-07-28'),
(12, 35, 2, 0, 1, 1, '2018-07-28', '2018-07-28'),
(13, 35, 8, 0, 1, 1, '2018-07-28', '2018-07-28'),
(14, 36, 2, 0, 1, 1, '2018-07-28', '2018-07-28'),
(15, 38, 2, 1, 1, 1, '2018-07-29', '2018-07-30'),
(16, 38, 4, 0, 1, 1, '2018-07-29', '2018-07-29'),
(17, 39, 4, 0, 1, 1, '2018-07-29', '2018-07-29'),
(18, 39, 6, 0, 1, 1, '2018-07-29', '2018-07-29'),
(19, 40, 2, 0, 1, 1, '2018-07-29', '2018-07-29'),
(20, 41, 2, 0, 1, 1, '2018-07-29', '2018-07-29'),
(21, 41, 7, 0, 1, 1, '2018-07-29', '2018-07-29'),
(22, 8, 2, 0, 1, 1, '2018-08-02', '2018-08-02'),
(23, 8, 4, 0, 1, 1, '2018-08-02', '2018-08-02'),
(24, 9, 2, 0, 1, 1, '2018-08-02', '2018-08-02'),
(25, 12, 2, 0, 1, 1, '2018-08-02', '2018-08-02'),
(26, 16, 1, 0, 1, 1, '2018-08-02', '2018-08-02'),
(27, 17, 2, 0, 1, 1, '2018-08-02', '2018-08-02'),
(28, 17, 7, 0, 1, 1, '2018-08-02', '2018-08-02'),
(29, 18, 2, 0, 1, 1, '2018-08-02', '2018-08-02'),
(30, 19, 2, 0, 1, 1, '2018-08-02', '2018-08-02'),
(31, 19, 20, 0, 1, 1, '2018-08-02', '2018-08-02'),
(32, 20, 6, 0, 1, 1, '2018-08-02', '2018-08-02'),
(33, 21, 2, 0, 1, 1, '2018-08-03', '2018-08-03'),
(34, 22, 1, 0, 1, 1, '2018-08-03', '2018-08-03'),
(35, 26, 2, 0, 1, 1, '2018-08-05', '2018-08-05'),
(36, 26, 7, 0, 1, 1, '2018-08-05', '2018-08-05'),
(37, 26, 8, 0, 1, 1, '2018-08-05', '2018-08-05'),
(38, 28, 20, 1, 1, 1, '2018-08-07', '2018-08-07'),
(39, 29, 1, 0, 1, 1, '2018-08-07', '2018-08-07'),
(40, 30, 1, 1, 1, 1, '2018-08-07', '2018-08-07'),
(41, 31, 1, 0, 1, 1, '2018-08-07', '2018-08-07'),
(42, 32, 1, 0, 1, 1, '2018-08-07', '2018-08-07'),
(43, 34, 2, 0, 1, 1, '2018-08-08', '2018-08-08'),
(44, 34, 6, 0, 1, 1, '2018-08-08', '2018-08-08'),
(45, 35, 2, 0, 1, 1, '2018-08-08', '2018-08-08'),
(46, 35, 6, 1, 1, 1, '2018-08-08', '2018-08-11'),
(47, 44, 6, 0, 1, 1, '2018-08-13', '2018-08-13'),
(48, 45, 6, 1, 1, 1, '2018-08-14', '2018-08-14'),
(49, 46, 1, 1, 1, 1, '2018-08-14', '2018-08-14'),
(50, 46, 6, 0, 1, 1, '2018-08-14', '2018-08-14'),
(51, 47, 2, 0, 1, 1, '2018-08-14', '2018-08-14'),
(52, 47, 6, 0, 1, 1, '2018-08-14', '2018-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `atencion_servicios`
--

CREATE TABLE `atencion_servicios` (
  `id` int(11) NOT NULL,
  `id_atencion` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `pagado` tinyint(1) DEFAULT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atencion_servicios`
--

INSERT INTO `atencion_servicios` (`id`, `id_atencion`, `id_servicio`, `pagado`, `id_empresa`, `id_sucursal`, `created_at`, `updated_at`) VALUES
(6, 21, 7, NULL, 1, 1, '2018-08-03', '2018-08-03'),
(7, 22, 7, NULL, 1, 1, '2018-08-03', '2018-08-03'),
(8, 22, 8, NULL, 1, 1, '2018-08-03', '2018-08-03'),
(9, 26, 6, NULL, 1, 1, '2018-08-05', '2018-08-05'),
(10, 26, 7, NULL, 1, 1, '2018-08-05', '2018-08-05'),
(11, 26, 8, NULL, 1, 1, '2018-08-05', '2018-08-05'),
(12, 28, 7, NULL, 1, 1, '2018-08-07', '2018-08-07'),
(13, 28, 8, NULL, 1, 1, '2018-08-07', '2018-08-07'),
(14, 34, 1, NULL, 1, 1, '2018-08-08', '2018-08-08'),
(15, 34, 5, NULL, 1, 1, '2018-08-08', '2018-08-08'),
(16, 34, 7, NULL, 1, 1, '2018-08-08', '2018-08-08'),
(17, 35, 5, NULL, 1, 1, '2018-08-08', '2018-08-08'),
(18, 35, 7, NULL, 1, 1, '2018-08-08', '2018-08-08'),
(19, 36, 5, NULL, 1, 1, '2018-08-08', '2018-08-08'),
(20, 37, 7, NULL, 1, 1, '2018-08-08', '2018-08-08'),
(21, 37, 8, NULL, 1, 1, '2018-08-08', '2018-08-08'),
(22, 38, 9, NULL, 1, 5, '2018-08-08', '2018-08-08'),
(23, 39, 9, NULL, 1, 5, '2018-08-08', '2018-08-08'),
(24, 40, 9, NULL, 1, 5, '2018-08-08', '2018-08-08'),
(25, 41, 1, NULL, 1, 1, '2018-08-08', '2018-08-08'),
(26, 43, 1, NULL, 1, 1, '2018-08-13', '2018-08-13'),
(27, 43, 5, NULL, 1, 1, '2018-08-13', '2018-08-13'),
(28, 45, 7, NULL, 1, 1, '2018-08-14', '2018-08-14'),
(29, 46, 7, NULL, 1, 1, '2018-08-14', '2018-08-14'),
(30, 47, 7, NULL, 1, 1, '2018-08-14', '2018-08-14'),
(31, 48, 9, NULL, 1, 5, '2018-08-14', '2018-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `centros`
--

CREATE TABLE `centros` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `referencia` varchar(200) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `centros`
--

INSERT INTO `centros` (`id`, `name`, `direccion`, `referencia`, `created_at`, `updated_at`, `id_empresa`, `id_sucursal`) VALUES
(1, 'HIGH LAB', 'COMAS AV TUPAC AMARU', NULL, '2018-07-02', '2018-08-08', 1, 1),
(4, 'Centro Mèdico 2', 'cvcvc', 'cvcvcv', '2018-07-02', '2018-07-02', 1, 2),
(5, 'Centro Mèdico 1', 'qqqq', 'qqqqqq', '2018-07-02', '2018-07-02', 1, 2),
(7, 'VIDA FELIZ SAC', 'PROCERES DE LA INDEPENDENCIA 837 2DO PISO URBANIZACION SAN HILARON SJL', 'METRO LA HACIENDA', '2018-08-02', '2018-08-02', 1, 1),
(8, 'SAN ANTONIO DE PADUA', 'PRÓCERES 1781 3ER PISO LOS OLIVOS', NULL, '2018-08-07', '2018-08-07', 1, 1),
(9, 'CS INFANTAS', 'LOS OLIVOS', NULL, '2018-08-13', '2018-08-13', 1, 1),
(10, 'CS TAHUANTINSUYO BAJO', 'AV CHINCHAYSUYO CDRA 4 INDEPENDENCIA', NULL, '2018-08-14', '2018-08-14', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `creditos`
--

CREATE TABLE `creditos` (
  `id` int(11) NOT NULL,
  `id_atencion` int(11) DEFAULT NULL,
  `monto` text NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `origen` varchar(200) NOT NULL,
  `tipo_ingreso` varchar(20) DEFAULT NULL,
  `causa` varchar(200) DEFAULT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `creditos`
--

INSERT INTO `creditos` (`id`, `id_atencion`, `monto`, `descripcion`, `origen`, `tipo_ingreso`, `causa`, `id_empresa`, `id_sucursal`, `created_at`, `updated_at`) VALUES
(4, 35, '200', NULL, 'INGRESO DE ATENCIONES', '', '', 1, 1, '2018-07-28', '2018-07-28'),
(5, 36, '200', NULL, 'INGRESO DE ATENCIONES', '', '', 1, 1, '2018-07-28', '2018-07-28'),
(6, NULL, '200.5', 'eepepepepe', 'OTROS INGRESOS', '', '', 1, 1, '2018-07-28', '2018-07-28'),
(7, NULL, '200.5', 'HOLA', 'OTROS INGRESOS', 'EF', '', 1, 1, '2018-07-28', '2018-07-28'),
(8, NULL, '4.000,00', '29 prueba', 'OTROS INGRESOS', 'EF', '', 1, 1, '2018-07-29', '2018-07-29'),
(9, 38, '300', NULL, 'INGRESO DE ATENCIONES', NULL, '', 1, 1, '2018-07-29', '2018-07-29'),
(10, NULL, '3.000,00', 'HGHGH', 'OTROS INGRESOS', 'TJ', '', 1, 1, '2018-07-29', '2018-07-29'),
(11, NULL, '656.565,65', '565656', 'OTROS INGRESOS', 'TJ', '', 1, 1, '2018-07-29', '2018-07-29'),
(12, NULL, '54.545,45', 'FDFDFDF', 'OTROS INGRESOS', 'EF', '', 1, 1, '2018-07-29', '2018-07-29'),
(13, 39, '2000', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-07-29', '2018-07-29'),
(14, 40, '200', NULL, 'INGRESO DE ATENCIONES', 'TJ', '', 1, 1, '2018-07-29', '2018-07-29'),
(15, 41, '150.00', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-07-29', '2018-07-29'),
(16, NULL, '200.00', 'TETETET', 'OTROS INGRESOS', 'EF', '', 1, 1, '2018-07-29', '2018-07-29'),
(17, 4, '30', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-07-30', '2018-07-30'),
(18, 5, '30', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-07-30', '2018-07-30'),
(19, NULL, '35.00', 'cable magico', 'OTROS INGRESOS', 'EF', '', 1, 1, '2018-07-31', '2018-07-31'),
(20, 6, '1250,90', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-01', '2018-08-01'),
(21, 7, '60,00', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-02', '2018-08-02'),
(22, 8, '20', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-02', '2018-08-02'),
(23, 9, '55', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-02', '2018-08-02'),
(24, 10, '234,50', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-02', '2018-08-02'),
(25, 11, '234,50', NULL, 'INGRESO DE ATENCIONES', '0', '', 1, 1, '2018-08-02', '2018-08-02'),
(26, 12, '30', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-02', '2018-08-02'),
(27, 13, '60,00', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-02', '2018-08-02'),
(28, 14, '234,50d', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-02', '2018-08-02'),
(29, 15, '234,50', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-02', '2018-08-02'),
(30, 16, '234,50', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-02', '2018-08-02'),
(31, 17, '12.50', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-02', '2018-08-02'),
(32, 18, '2121', NULL, 'INGRESO DE ATENCIONES', '0', '', 1, 1, '2018-08-02', '2018-08-02'),
(33, 19, '120', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-02', '2018-08-02'),
(34, 20, '120', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-02', '2018-08-02'),
(35, 21, '60,00', NULL, 'INGRESO DE ATENCIONES', '0', '', 1, 1, '2018-08-03', '2018-08-03'),
(36, 22, '60,00', NULL, 'INGRESO DE ATENCIONES', '0', '', 1, 1, '2018-08-03', '2018-08-03'),
(37, 23, '50,00', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-03', '2018-08-03'),
(38, 24, '60,00', NULL, 'INGRESO DE ATENCIONES', 'TJ', '', 1, 1, '2018-08-03', '2018-08-03'),
(39, 25, '234,50', NULL, 'INGRESO DE ATENCIONES', '0', '', 1, 1, '2018-08-04', '2018-08-04'),
(40, 26, '1250,90', NULL, 'INGRESO DE ATENCIONES', 'EF', '', 1, 1, '2018-08-05', '2018-08-05'),
(41, 27, '25', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 5, '2018-08-06', '2018-08-06'),
(42, 28, '200', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-07', '2018-08-07'),
(43, 29, '798', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-07', '2018-08-07'),
(44, 30, '798', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-07', '2018-08-07'),
(45, 31, '798', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-07', '2018-08-07'),
(46, 32, '798', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-07', '2018-08-07'),
(47, 33, '60,00', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-08', '2018-08-08'),
(48, 34, '120', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-08', '2018-08-08'),
(49, 35, '460.00', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-08', '2018-08-08'),
(50, 36, '180', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-08', '2018-08-08'),
(51, 37, '120', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-08', '2018-08-08'),
(52, 38, '45', NULL, 'INGRESO DE ATENCIONES', '0', NULL, 1, 5, '2018-08-08', '2018-08-08'),
(53, 39, '45', NULL, 'INGRESO DE ATENCIONES', '0', NULL, 1, 5, '2018-08-08', '2018-08-08'),
(54, 40, '45', NULL, 'INGRESO DE ATENCIONES', '0', NULL, 1, 5, '2018-08-08', '2018-08-08'),
(55, 41, '70.00', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-08', '2018-08-08'),
(56, NULL, '149.50', 'cable magico', 'OTROS INGRESOS', 'EF', 'V', 1, 1, '2018-08-09', '2018-08-09'),
(57, 42, '45.00', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-10', '2018-08-10'),
(58, NULL, '20000.00', 'fdddf', 'OTROS INGRESOS', 'EF', 'V', 1, 1, '2018-08-11', '2018-08-11'),
(59, NULL, '35.00', 'medicamentos', 'OTROS INGRESOS', 'EF', 'V', 1, 1, '2018-08-11', '2018-08-11'),
(60, 43, '100.00', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-13', '2018-08-13'),
(68, NULL, '50.00', '50 pastillas', 'OTROS INGRESOS', 'EF', 'V', 1, 1, '2018-08-13', '2018-08-13'),
(69, NULL, '1231.64', 'yuyuyt', 'OTROS INGRESOS', '0', 'V', 1, 1, '2018-08-13', '2018-08-13'),
(70, 44, '120.00', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-13', '2018-08-13'),
(71, 45, '60.00', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-14', '2018-08-14'),
(72, NULL, '50.00', '10', 'OTROS INGRESOS', 'EF', 'V', 1, 1, '2018-08-14', '2018-08-14'),
(73, 46, '25.00', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-14', '2018-08-14'),
(74, NULL, '1000.00', 'dhejoñekpfkkrepfp', 'OTROS INGRESOS', '0', 'O', 1, 1, '2018-08-14', '2018-08-14'),
(75, 46, '25', 'CUENTAS POR COBRAR', 'CUENTAS POR COBRAR', NULL, NULL, 1, 1, '2018-08-14', '2018-08-14'),
(76, 45, '0', 'CUENTAS POR COBRAR', 'CUENTAS POR COBRAR', NULL, NULL, 1, 1, '2018-08-14', '2018-08-14'),
(77, 47, '30.00', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 1, '2018-08-14', '2018-08-14'),
(78, 47, '30', 'CUENTAS POR COBRAR', 'CUENTAS POR COBRAR', NULL, NULL, 1, 1, '2018-08-14', '2018-08-14'),
(79, 48, '60.00', NULL, 'INGRESO DE ATENCIONES', 'EF', NULL, 1, 5, '2018-08-14', '2018-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `creditos_productos`
--

CREATE TABLE `creditos_productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_credito` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `creditos_productos`
--

INSERT INTO `creditos_productos` (`id`, `id_credito`, `id_producto`, `created_at`, `updated_at`) VALUES
(1, 62, 1, '2018-08-13', '2018-08-13'),
(2, 62, 3, '2018-08-13', '2018-08-13'),
(3, 63, 2, '2018-08-13', '2018-08-13'),
(4, 63, 3, '2018-08-13', '2018-08-13'),
(5, 66, 2, '2018-08-13', '2018-08-13'),
(6, 66, 3, '2018-08-13', '2018-08-13'),
(7, 68, 9, '2018-08-13', '2018-08-13'),
(8, 69, 2, '2018-08-13', '2018-08-13'),
(9, 69, 3, '2018-08-13', '2018-08-13'),
(10, 69, 5, '2018-08-13', '2018-08-13'),
(11, 69, 6, '2018-08-13', '2018-08-13'),
(12, 72, 9, '2018-08-14', '2018-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `debitos`
--

CREATE TABLE `debitos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `id_gasto` int(11) DEFAULT NULL,
  `monto` text NOT NULL,
  `origen` varchar(200) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debitos`
--

INSERT INTO `debitos` (`id`, `descripcion`, `id_gasto`, `monto`, `origen`, `id_empresa`, `id_sucursal`, `created_at`, `updated_at`) VALUES
(1, 'eeee', 3, '9.999,99', '', 1, 1, '2018-07-28', '2018-07-28'),
(2, 'administrator', NULL, '343', '', 1, 1, '2018-07-28', '2018-07-28'),
(3, 'looooo', NULL, '1000', 'LABORATORIOS POR PAGAR', 1, 1, '2018-07-28', '2018-07-28'),
(4, 'sssss', 5, '20.000,00', 'RELACION DE GASTOS', 1, 1, '2018-07-29', '2018-07-29'),
(5, 'PAGO DE TELEFONO', 6, '20.000,00', 'RELACION DE GASTOS', 1, 1, '2018-07-29', '2018-07-29'),
(6, 'tester', 7, '200.00', 'RELACION DE GASTOS', 1, 1, '2018-07-29', '2018-07-29'),
(7, 'xzxzxz', NULL, '1250', 'LABORATORIOS POR PAGAR', 1, 1, '2018-07-30', '2018-07-30'),
(8, 'mes de julio', 4, '1000.00', 'RELACION DE GASTOS', 1, 1, '2018-08-02', '2018-08-02'),
(9, 'MES DE MAYO 2018', 5, '287.00', 'RELACION DE GASTOS', 1, 1, '2018-08-07', '2018-08-07'),
(10, 'MES DE ABRIL 2018', 6, '87.00', 'RELACION DE GASTOS', 1, 1, '2018-08-07', '2018-08-07'),
(11, 'LDL COLESTEROL', NULL, '4.50', 'LABORATORIOS POR PAGAR', 1, 1, '2018-08-07', '2018-08-07'),
(12, 'PROTEINAS  T-F', NULL, '5.00', 'LABORATORIOS POR PAGAR', 1, 1, '2018-08-07', '2018-08-07'),
(13, 'GLUCOSA POST PRANDIAL', NULL, '3.50', 'LABORATORIOS POR PAGAR', 1, 1, '2018-08-11', '2018-08-11'),
(14, 'mes de agosto', 7, '800.00', 'RELACION DE GASTOS', 1, 1, '2018-08-13', '2018-08-13'),
(15, 'mes setiembre', 8, '149.50', 'RELACION DE GASTOS', 1, 1, '2018-08-13', '2018-08-13'),
(16, 'AGLUTINACIONES EN PLACA', NULL, '7.00', 'LABORATORIOS POR PAGAR', 1, 1, '2018-08-14', '2018-08-14'),
(17, 'PROTEINA C REACTIVA', NULL, '7.00', 'LABORATORIOS POR PAGAR', 1, 1, '2018-08-14', '2018-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `distritos`
--

CREATE TABLE `distritos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distritos`
--

INSERT INTO `distritos` (`id`, `nombre`) VALUES
(1, 'Cercado de Lima'),
(2, 'Ate'),
(3, 'Barranci'),
(4, 'Breña'),
(5, 'Comas'),
(6, 'El Agustino'),
(7, 'Jesùs Maria'),
(8, 'La Molina'),
(9, 'La Victoria'),
(10, 'Lince'),
(11, 'Magdalena del Mar'),
(12, 'Miraflores'),
(13, 'Pueblo Libre'),
(14, 'Puente Piedra'),
(15, 'Rimac'),
(16, 'San Isidro'),
(17, 'Independencia'),
(18, 'San Juan de Miraflores'),
(19, 'San Luis'),
(20, 'San Martin de Porres'),
(21, 'San Miguel'),
(22, 'Santiago de Surco'),
(23, 'Surquillo'),
(24, 'Villa Maria del Triunfo'),
(25, 'San Juan de Lurigancho'),
(26, 'Santa Rosa'),
(27, 'Los Olivos'),
(28, 'Villa el Salvador'),
(29, 'Santa Anita');

-- --------------------------------------------------------

--
-- Table structure for table `edo_civils`
--

CREATE TABLE `edo_civils` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edo_civils`
--

INSERT INTO `edo_civils` (`id`, `nombre`) VALUES
(1, 'Soltero'),
(2, 'Casado'),
(3, 'Divorciado'),
(4, 'Concubino');

-- --------------------------------------------------------

--
-- Table structure for table `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Empresa 1', '0000-00-00', '0000-00-00'),
(2, 'Empresa 2', '2018-07-12', '2018-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `especialidads`
--

CREATE TABLE `especialidads` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `especialidads`
--

INSERT INTO `especialidads` (`id`, `nombre`) VALUES
(1, 'Medicina General'),
(2, 'Ginecologìa'),
(3, 'Ginecología'),
(4, 'Obstetra'),
(5, 'Urología'),
(6, 'Gastroenterología'),
(7, 'Pediatría'),
(8, 'Enfermera'),
(9, 'Medicina Interna'),
(10, 'Dermatología'),
(11, 'Traumatología'),
(12, 'Reumatología'),
(13, 'Medicina Familiar'),
(14, 'Cirugía General');

-- --------------------------------------------------------

--
-- Table structure for table `gastos`
--

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `concepto` varchar(200) NOT NULL,
  `monto` text NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gastos`
--

INSERT INTO `gastos` (`id`, `name`, `concepto`, `monto`, `id_empresa`, `id_sucursal`, `created_at`, `updated_at`) VALUES
(3, 'pago a entel', 'mes de julio', '149,50', 1, 1, '2018-07-27', '2018-07-27'),
(4, 'STEPHANIA', 'mes de julio', '1000.00', 1, 1, '2018-08-02', '2018-08-02'),
(5, 'SEDAPAL', 'MES DE MAYO 2018', '287.00', 1, 1, '2018-08-07', '2018-08-07'),
(6, 'EDELNOR', 'MES DE ABRIL 2018', '87.00', 1, 1, '2018-08-07', '2018-08-07'),
(7, 'pago local', 'mes de agosto', '800.00', 1, 1, '2018-08-13', '2018-08-13'),
(8, 'pago edelnor', 'mes setiembre', '149.50', 1, 1, '2018-08-13', '2018-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `grado_instruccions`
--

CREATE TABLE `grado_instruccions` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grado_instruccions`
--

INSERT INTO `grado_instruccions` (`id`, `nombre`) VALUES
(1, 'Primaria'),
(2, 'Secundaria'),
(3, 'Tècnico'),
(4, 'Superior');

-- --------------------------------------------------------

--
-- Table structure for table `historias_clinicas`
--

CREATE TABLE `historias_clinicas` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `historia` varchar(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `historias_clinicas`
--

INSERT INTO `historias_clinicas` (`id`, `id_paciente`, `historia`, `estatus`, `created_at`, `updated_at`) VALUES
(6, 8, '8', 1, '2018-07-11', '2018-07-11'),
(7, 9, '0009', 1, '2018-07-11', '2018-07-11'),
(8, 10, '0010', 1, '2018-07-12', '2018-07-12'),
(9, 11, '0011', 1, '2018-07-12', '2018-07-12'),
(10, 12, '0012', 1, '2018-07-13', '2018-07-13'),
(11, 13, '0013', 1, '2018-07-15', '2018-07-15'),
(12, 14, '0014', 1, '2018-07-24', '2018-07-24'),
(13, 15, '0015', 1, '2018-08-02', '2018-08-02'),
(14, 16, '0016', 1, '2018-08-03', '2018-08-03'),
(15, 17, '0017', 1, '2018-08-06', '2018-08-06'),
(16, 18, '0018', 1, '2018-08-06', '2018-08-06'),
(17, 19, '0019', 1, '2018-08-06', '2018-08-06'),
(18, 20, '0020', 1, '2018-08-07', '2018-08-07'),
(19, 21, '0021', 1, '2018-08-08', '2018-08-08'),
(20, 22, '0022', 1, '2018-08-08', '2018-08-08'),
(21, 23, '0023', 1, '2018-08-08', '2018-08-08'),
(22, 24, '0024', 1, '2018-08-08', '2018-08-08'),
(23, 25, '0025', 1, '2018-08-09', '2018-08-09'),
(24, 26, '0026', 1, '2018-08-09', '2018-08-09'),
(25, 27, '0027', 1, '2018-08-11', '2018-08-11'),
(26, 28, '0028', 1, '2018-08-11', '2018-08-11'),
(27, 29, '0029', 1, '2018-08-11', '2018-08-11'),
(28, 30, '0030', 1, '2018-08-11', '2018-08-11'),
(29, 31, '0031', 1, '2018-08-13', '2018-08-13'),
(30, 32, '0032', 1, '2018-08-13', '2018-08-13'),
(31, 33, '0033', 1, '2018-08-13', '2018-08-13'),
(32, 34, '0034', 1, '2018-08-14', '2018-08-14'),
(33, 35, '0035', 1, '2018-08-14', '2018-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `ingresos`
--

CREATE TABLE `ingresos` (
  `id` int(11) NOT NULL,
  `producto` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fechaingreso` date NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingresos`
--

INSERT INTO `ingresos` (`id`, `producto`, `cantidad`, `fechaingreso`, `created_at`, `updated_at`, `id_empresa`, `id_sucursal`) VALUES
(2, 'Medicamentoooooo', 34, '1111-01-01', '2018-07-08', '2018-07-08', 0, 0),
(3, 'Medicamentoooooo', 45, '1111-11-01', '2018-07-08', '2018-07-08', 0, 0),
(4, 'Medicamentoooooo', 10, '1000-01-01', '2018-07-08', '2018-07-08', 0, 0),
(5, 'Medicamentoooooo', 10000, '1000-01-01', '2018-07-08', '2018-07-08', 0, 0),
(6, 'Medicamentoooooo', 1, '0001-01-01', '2018-07-08', '2018-07-08', 0, 0),
(7, 'Medicamentoooooo', 2, '1999-01-01', '2018-07-08', '2018-07-08', 0, 0),
(8, 'Medicamentoooooo', 45, '1990-01-01', '2018-07-08', '2018-07-08', 0, 0),
(9, 'Producto Prueba', 112, '1990-11-15', '2018-07-08', '2018-07-08', 0, 0),
(10, 'Producto Jose', 99, '1000-11-01', '2018-07-08', '2018-07-08', 0, 0),
(11, 'Medicamentoooooo', 34, '1222-12-12', '2018-07-13', '2018-07-13', 1, 1),
(14, 'Producto Jose', 45, '2222-12-12', '2018-07-13', '2018-07-13', 1, 1),
(16, 'Medicamentoooooo', 12, '1222-12-12', '2018-07-15', '2018-07-15', 1, 2),
(17, 'patector', 15, '2018-07-27', '2018-07-27', '2018-07-27', 1, 1),
(18, 'CIPROFLOXACINO 500', 50, '2018-08-07', '2018-08-07', '2018-08-07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `laboratorios`
--

CREATE TABLE `laboratorios` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laboratorios`
--

INSERT INTO `laboratorios` (`id`, `name`, `direccion`, `referencia`, `created_at`, `updated_at`, `id_empresa`, `id_sucursal`) VALUES
(3, 'laboratorio1', 'llllllllllllllllllll', 'ttyttt', '2018-07-03', '2018-07-03', 0, 0),
(4, 'laboaaaa', 'sssss', 'sssss', '2018-07-12', '2018-07-12', 0, 0),
(6, 'BGL LABORATORIOS', 'av carlos yzaguirre', 'AV ANGAMOS', '2018-08-02', '2018-08-02', 1, 1),
(7, 'BGL', 'Jr. Caraz Nº 1070 Urb. Covida    LOS OLIVOS', '(Alt. Cdra. 10 de Antúnez de Mayolo)', '2018-08-06', '2018-08-06', 1, 5),
(8, 'BLUFSTEIN', 'AV. CHINCHAYSUYO 323 URB TAHUANTINSUYO INDEPENDENCIA', 'ALTURA ESTACIÓN NARANJAL', '2018-08-07', '2018-08-07', 1, 1),
(9, 'TAXA', 'SAN BORJA', NULL, '2018-08-07', '2018-08-07', 1, 1),
(10, 'SUIZA LAB', 'MIRAFLORES', NULL, '2018-08-13', '2018-08-13', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `locales`
--

CREATE TABLE `locales` (
  `id` int(11) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locales`
--

INSERT INTO `locales` (`id`, `nombres`, `id_empresa`, `created_at`, `updated_at`) VALUES
(1, 'Sucursal Empresa 1', 1, '2018-07-12', '2018-07-12'),
(2, 'Sucursal Empresa 2', 2, '2018-07-12', '2018-07-12'),
(3, 'Sucursal 2 Empre1', 1, '2018-07-12', '2018-07-12'),
(4, 'Sucursal 2 Empre2', 2, '2018-07-12', '2018-07-12'),
(5, 'MT INDEP', 1, '2018-08-05', '2018-08-05'),
(6, 'MT PRO', 1, '2018-08-05', '2018-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `medidas`
--

CREATE TABLE `medidas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medidas`
--

INSERT INTO `medidas` (`id`, `nombre`) VALUES
(1, 'Milimetro'),
(2, 'Miligramo'),
(3, 'Cajax6Unid'),
(4, 'Cajax10Unid'),
(5, 'Cajax12Unid'),
(6, 'Cajax15Unid'),
(7, 'Cajax20Unid'),
(8, 'Cajax100Unid');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_07_13_082418_create_bouncer_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `dni` varchar(200) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `provincia` varchar(10) NOT NULL,
  `distrito` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `fechanac` date NOT NULL,
  `gradoinstruccion` varchar(100) NOT NULL,
  `ocupacion` varchar(100) NOT NULL,
  `edocivil` varchar(100) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`id`, `dni`, `nombres`, `apellidos`, `direccion`, `provincia`, `distrito`, `telefono`, `fechanac`, `gradoinstruccion`, `ocupacion`, `edocivil`, `estatus`, `created_at`, `updated_at`, `id_empresa`, `id_sucursal`) VALUES
(10, '23232', 'ererer', 'erere', 'ererer', 'Lima', 'Lurigancho', '4265360533', '2222-12-12', 'Bachiller', 'erere', 'Soltero', 1, '2018-07-12', '2018-07-12', 1, 2),
(11, '23232', 'ererer', 'erere', 'ererer', 'Lima', 'Lurigancho', '4265360533', '2222-12-12', 'Bachiller', 'erere', 'Soltero', 1, '2018-07-12', '2018-07-12', 1, 2),
(14, '40342679', 'JOSE LUIS', 'MEZA LA ROSA', 'AV. CHINCHAYSUYO 323 URB TAHUANTINSUYO', 'Lima', 'Cercado de Lima', '940314839', '1979-08-10', 'Primaria', 'ADMINISTRADOR', 'Soltero', 1, '2018-07-24', '2018-08-02', 1, 1),
(15, '42370268', 'GIOVANNI ANTONIO', 'MEZA LA ROSA', 'MADERA 447 MZ F LT 8', 'Lima', 'Rimac', '952377612', '1984-04-28', 'Tècnico', 'LAVADOR', 'Soltero', 1, '2018-08-02', '2018-08-02', 1, 1),
(16, '20046908', 'JENY GRACIELA', 'MOLINA NINANYA', 'GERONA 225 URB JAVIER PRADO II ETAPA', 'Lima', 'San Luis', '998712367', '1972-09-24', 'Superior', 'OBSTETRA', 'Casado', 1, '2018-08-03', '2018-08-03', 1, 1),
(17, '73860673', 'ROXANA', 'HUAMANI ESPINOZA', 'AV CHINCHAYSUYO 633 URB. TAHUANTINSUYO INDEPENDENCIA', 'Lima', 'Independencia', '0241-8720610', '1985-08-10', 'Primaria', 'AMA DE CASA', 'Soltero', 1, '2018-08-06', '2018-08-06', 1, 5),
(19, '77033433', 'lesly', 'vega paredes', 'mz. Y lt. 59 tercera explanada laderas', 'Lima', 'Puente Piedra', '926124495', '1994-12-21', 'Secundaria', 'ama de casa', 'Soltero', 1, '2018-08-06', '2018-08-08', 1, 6),
(21, '026178788', 'DAYMAR STEPHANIA', 'DIAZ', 'LOS CHASQUIS 837 DPTO 202 URB ZARATE', 'Lima', 'San Juan de Lurigancho', '977656001', '1996-10-18', 'Secundaria', 'ASISTENTE', 'Soltero', 1, '2018-08-08', '2018-08-08', 1, 1),
(22, '72241038', 'Hilda', 'Choquehuanca Chinguel Hilda', 'Laderas de chillon', 'Lima', 'Puente Piedra', '945500857', '2000-07-06', 'Secundaria', 'Ama de', 'Concubino', 1, '2018-08-08', '2018-08-08', 1, 6),
(23, '46794474', 'MONICA DIONICIA', 'LLACCHO HUAMAN DE CORONEL', 'VILLA ELVIRA MZ E LT 04', 'Lima', 'Cercado de Lima', '958902536', '1986-05-13', 'Secundaria', 'AMA DE CASA', 'Soltero', 1, '2018-08-08', '2018-08-08', 1, 5),
(24, '001342111', 'MAURYN NINOSKA', 'DIAZ', 'LOS CHASQUIS 837 DPTO 202 URB ZARATE', 'Lima', 'San Juan de Lurigancho', '977656001', '1984-01-07', 'Secundaria', 'ADMINISTRADOR', 'Casado', 1, '2018-08-08', '2018-08-08', 1, 1),
(25, '44064653', 'NELIDA  ENEDITA', 'ESPIRITU POMA', 'ASENT.H LADERAS DE CHILLON MZJ LT31', 'Lima', 'Puente Piedra', '990266056', '1981-05-01', 'Primaria', 'AMA DE CASA', 'Soltero', 1, '2018-08-09', '2018-08-12', 1, 6),
(26, '80454079', 'FLORENTINA', 'PAUCAR QUISPE', 'CALLE 85 ASENT.H LOS OLIVOS MZC LT38', 'Lima', 'Los Olivos', '933502684', '1978-01-20', 'Primaria', 'AMA DE CASA', 'Concubino', 1, '2018-08-09', '2018-08-12', 1, 6),
(27, '09624437', 'ANA MARGARITA', 'RAMIREZ  VELASQUEZ', 'JR. LA UNIDAD 799- PRO', 'Lima', 'Los Olivos', '940254078', '1945-11-30', 'Tècnico', 'AMA DE CASA', 'Casado', 1, '2018-08-11', '2018-08-12', 1, 6),
(28, '46254351', 'DEYSI', 'SANCHEZ ZANABRIA', 'ASOC.SANTA LUCIA MZT LT5', 'Lima', 'Cercado de Lima', '940732373', '1990-02-08', 'Superior', 'CONTADORA', 'Soltero', 1, '2018-08-11', '2018-08-11', 1, 6),
(29, '45926174', 'LIZET', 'SANCHEZ VIERA', 'CALLE 40 URB.PUERTA DE PRO MZT4 LT13', 'Lima', 'Los Olivos', '910133615', '1989-08-05', 'Secundaria', 'AMA DE CASA', 'Concubino', 1, '2018-08-11', '2018-08-12', 1, 6),
(30, '75932580', 'YADIRA', 'DE LA CRUZ ALANYA', 'AV, LOS HEROES DEL ALTO MZA LT2', 'Lima', 'Puente Piedra', '935283859', '1999-07-11', 'Secundaria', 'TRABAJO', 'Soltero', 1, '2018-08-11', '2018-08-12', 1, 6),
(31, '70032785', 'ROSA', 'CHURA MAMANI', 'MZC LT3 ASENT.H LADERAS DE CHILLON', 'Lima', 'Puente Piedra', '995551112', '1993-09-06', 'Secundaria', 'AMA DE CASA', 'Soltero', 1, '2018-08-13', '2018-08-13', 1, 6),
(32, '75160585', 'FIORELA NORVIT', 'DIESTRA VEGA', 'MZK LT12 OS, LADERAS DE CHILLON', 'Lima', 'Puente Piedra', '990652380', '2000-06-01', 'Secundaria', 'AMA DE CASA', 'Soltero', 1, '2018-08-13', '2018-08-13', 1, 6),
(33, '40282677', 'SABINA', 'QUISPE BUITRON', 'CENTRO POBLADO LOS EUCALIPTOS MZB LT16', 'Lima', 'Puente Piedra', 'NO TIENE', '1979-05-14', 'Secundaria', 'AMA DE CASA', 'Casado', 1, '2018-08-13', '2018-08-13', 1, 6),
(34, '48410201', 'VALERI', 'BURGOS RETAMOZO', 'LADERAS DE CHILLO MZI LT39', 'Lima', 'Puente Piedra', '987383319', '1992-01-19', 'Secundaria', 'TRABAJADORA', 'Concubino', 1, '2018-08-14', '2018-08-14', 1, 6),
(35, '47259183', 'FIORELLA KAROL', 'HUALLANCA ROSALES', 'PJE LOS LIMONES 159 ERMITAÑO', 'Lima', 'Independencia', '977710478', '1991-09-09', 'Tècnico', 'RECEPCIONISTA', 'Concubino', 1, '2018-08-14', '2018-08-14', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `paquetes`
--

CREATE TABLE `paquetes` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `costo` text NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paquetes`
--

INSERT INTO `paquetes` (`id`, `name`, `costo`, `id_empresa`, `id_sucursal`, `created_at`, `updated_at`) VALUES
(8, 'chequeo niños', '39.00', 1, 5, '2018-08-09', '2018-08-09'),
(16, 'prueba', '1.00', 1, 1, '2018-08-13', '2018-08-13'),
(17, 'PAQUETE GESTANTE', '45.00', 1, 1, '2018-08-13', '2018-08-13'),
(18, 'PAQUETE GINECOLOGICO', '25.00', 1, 1, '2018-08-13', '2018-08-13'),
(19, 'USER', '112.22', 1, 1, '2018-08-13', '2018-08-13'),
(20, 'paqiute gest 2', '45.00', 1, 1, '2018-08-13', '2018-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `paquetes_analises`
--

CREATE TABLE `paquetes_analises` (
  `id` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `id_analisis` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paquetes_analises`
--

INSERT INTO `paquetes_analises` (`id`, `id_paquete`, `id_analisis`, `created_at`, `updated_at`) VALUES
(6, 16, 2, '2018-08-13', '2018-08-13'),
(7, 16, 5, '2018-08-13', '2018-08-13'),
(8, 17, 1, '2018-08-13', '2018-08-13'),
(9, 17, 4, '2018-08-13', '2018-08-13'),
(10, 18, 0, '2018-08-13', '2018-08-13'),
(11, 19, 1, '2018-08-13', '2018-08-13'),
(12, 19, 5, '2018-08-13', '2018-08-13'),
(13, 20, 1, '2018-08-13', '2018-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `paquetes_servs`
--

CREATE TABLE `paquetes_servs` (
  `id` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paquetes_servs`
--

INSERT INTO `paquetes_servs` (`id`, `id_paquete`, `id_servicio`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2018-07-16', '2018-07-16'),
(4, 5, 0, '2018-07-19', '2018-07-19'),
(5, 5, 1, '2018-07-19', '2018-07-19'),
(6, 5, 2, '2018-07-19', '2018-07-19'),
(7, 6, 0, '2018-07-19', '2018-07-19'),
(9, 6, 2, '2018-07-19', '2018-07-19'),
(13, 8, 1, '2018-08-09', '2018-08-09'),
(14, 8, 5, '2018-08-09', '2018-08-09'),
(17, 9, 6, '2018-08-10', '2018-08-10'),
(18, 10, 0, '2018-08-11', '2018-08-11'),
(19, 10, 3, '2018-08-11', '2018-08-11'),
(20, 10, 5, '2018-08-11', '2018-08-11'),
(21, 11, 0, '2018-08-13', '2018-08-13'),
(22, 12, 3, '2018-08-13', '2018-08-13'),
(23, 13, 0, '2018-08-13', '2018-08-13'),
(24, 13, 3, '2018-08-13', '2018-08-13'),
(25, 7, 1, '2018-08-13', '2018-08-13'),
(26, 7, 4, '2018-08-13', '2018-08-13'),
(31, 16, 1, '2018-08-13', '2018-08-13'),
(32, 16, 3, '2018-08-13', '2018-08-13'),
(33, 16, 4, '2018-08-13', '2018-08-13'),
(34, 17, 5, '2018-08-13', '2018-08-13'),
(35, 18, 18, '2018-08-13', '2018-08-13'),
(36, 19, 0, '2018-08-13', '2018-08-13'),
(37, 19, 3, '2018-08-13', '2018-08-13'),
(38, 20, 5, '2018-08-13', '2018-08-13'),
(39, 20, 23, '2018-08-13', '2018-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `ability_id` int(10) UNSIGNED NOT NULL,
  `entity_id` int(10) UNSIGNED NOT NULL,
  `entity_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `forbidden` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`ability_id`, `entity_id`, `entity_type`, `forbidden`) VALUES
(1, 1, 'roles', 0),
(2, 1, 'roles', 0),
(3, 2, 'roles', 0);

-- --------------------------------------------------------

--
-- Table structure for table `personals`
--

CREATE TABLE `personals` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `direccion` varchar(200) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `dni` varchar(200) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_sucursal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personals`
--

INSERT INTO `personals` (`id`, `name`, `apellidos`, `telefono`, `email`, `direccion`, `estatus`, `dni`, `created_at`, `updated_at`, `id_empresa`, `id_sucursal`) VALUES
(1, 'SOPHIA', 'TUPANO', '015555', 'SOPHIA@GMAIL.COM', 'URBANIZACION PRO', 1, '8984561', '2018-07-01', '2018-08-08', 1, 1),
(3, 'CARMEN ALEJANDRA', 'PARRA GARCIA', '955545565', 'katherineobst@hotmail.es', 'LA UNIDAD 8050 URB PRO', 1, '512365', '2018-07-01', '2018-08-07', 1, 1),
(8, 'prueba', 'prueba', 'xcxcx', NULL, 'cxcxc', 1, '23232', '2018-07-01', '2018-07-01', 1, 2),
(9, 'Jose', 'Meza', 'fffff', NULL, 'ffff', 1, '3333333', '2018-07-01', '2018-07-01', 1, 2),
(11, '2222', '2222', '4265360533', NULL, 'San Juan de Los Morros', 1, '2222', '2018-07-13', '2018-07-13', 1, 2),
(12, 'MIRIAM DASHANA', 'ARIZA ESPINOZA', '946556657', NULL, 'av. chinchaysuyo 323 urb. tahuantisuyo - independencia', 1, '42883130', '2018-07-23', '2018-08-02', 1, 1),
(13, 'KIARA NIEVES', 'ZARATE VICTORIA', '946556657', NULL, 'calle vulcano 364 ate', 1, '74534311', '2018-08-06', '2018-08-06', 1, 5),
(14, 'JOSE GREGORIO', 'RODRIGUEZ DIAZ', '977656001', NULL, 'PROCERES DE LA INDEPENDENCIA 837 2DO PISO URBANIZACION SAN HILARON SJL', 1, '10210154', '2018-08-07', '2018-08-07', 1, 1),
(15, 'ERIK GUSTAVO', 'ZERPA MUJICA', '4265360533', 'erik_2612@hotmail.com', 'San Juan de Los Morros', 1, '019985127', '2018-08-08', '2018-08-08', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `medida` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `name`, `medida`, `cantidad`, `created_at`, `updated_at`, `id_empresa`, `id_sucursal`) VALUES
(1, 'Medicamentoooooo', 'Miligramo', 30065, '2018-07-05', '2018-07-08', 1, 1),
(2, 'Producto Prueba', 'Milimetro', 132, '2018-07-08', '2018-07-08', 0, 0),
(3, 'Producto Jose', 'Miligramo', 194, '2018-07-08', '2018-07-13', 0, 0),
(4, 'zzz', 'Milimetro', 121, '2018-07-15', '2018-07-15', 1, 2),
(5, 'rtrtrt', 'Milimetro', 35, '2018-07-15', '2018-07-15', 1, 1),
(6, 'patector', 'Milimetro', 115, '2018-07-27', '2018-07-27', 1, 1),
(7, 'PATECTOR', 'Milimetro', 20, '2018-08-02', '2018-08-02', 1, 1),
(8, 'mesigyna', 'Milimetro', 1, '2018-08-02', '2018-08-02', 1, 1),
(9, 'CIPROFLOXACINO 500', 'Miligramo', 150, '2018-08-07', '2018-08-07', 1, 1),
(10, 'AMOXICILINA 500MG', 'Milimetro', 100, '2018-08-09', '2018-08-09', 1, 5),
(11, 'CEFALOGEN AMP', 'Milimetro', 25, '2018-08-09', '2018-08-09', 1, 5),
(12, 'JERINGA 20ML', 'Milimetro', 10, '2018-08-09', '2018-08-09', 1, 5),
(13, 'gestafer', 'Cajax6Unid', 2, '2018-08-13', '2018-08-13', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profesionales`
--

CREATE TABLE `profesionales` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `centro` varchar(100) NOT NULL,
  `cmp` varchar(10) NOT NULL,
  `codigo` varchar(200) DEFAULT NULL,
  `nacimiento` date NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profesionales`
--

INSERT INTO `profesionales` (`id`, `name`, `apellidos`, `especialidad`, `centro`, `cmp`, `codigo`, `nacimiento`, `created_at`, `updated_at`, `id_empresa`, `id_sucursal`) VALUES
(1, 'Jose', 'Meza', 'Medicina General', 'VIDA FELIZ SAC', '123456', NULL, '1979-08-10', '2018-07-02', '2018-08-08', 1, 1),
(5, 'Erik', 'Zerpa', 'Odontologia', 'Centro Mèdico 3', '19985127', NULL, '1990-11-15', '2018-07-03', '2018-07-03', 1, 2),
(7, 'YOSMAR DEL VALLE', 'DIAZ', 'Odontologia', 'VIDA FELIZ SAC', '55555', NULL, '1985-08-10', '2018-08-05', '2018-08-05', 1, 1),
(8, 'STEPHANIA', 'MOLINA NINANYA', 'Odontologia', 'VIDA FELIZ SAC', '48966', NULL, '1984-01-07', '2018-08-07', '2018-08-07', 1, 1),
(9, 'STEPHANIA', 'DIAZ', 'Urología', 'SAN ANTONIO DE PADUA', '0048965', '0009', '1984-08-23', '2018-08-07', '2018-08-07', 1, 1),
(10, 'DIANA ELIZABETH', 'CAMARGO IBAÑEZ', 'Obstetra', 'CS INFANTAS', '18564', '0010', '1985-09-10', '2018-08-13', '2018-08-13', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `provincias`
--

CREATE TABLE `provincias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`) VALUES
(1, 'Lima');

-- --------------------------------------------------------

--
-- Table structure for table `resultados`
--

CREATE TABLE `resultados` (
  `id` int(11) NOT NULL,
  `id_atencion` int(11) NOT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `id_analisis` int(11) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT '0',
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `title`, `level`, `created_at`, `updated_at`) VALUES
(1, 'administrator', NULL, NULL, '2018-07-02 01:41:41', '2018-07-02 01:41:41'),
(2, 'superadmin', NULL, NULL, '2018-07-14 01:11:29', '2018-07-14 01:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `sedes`
--

CREATE TABLE `sedes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sedes`
--

INSERT INTO `sedes` (`id`, `nombre`, `estatus`) VALUES
(1, 'Hospital Central', 1),
(2, 'Hospital Central', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sedes_afilias`
--

CREATE TABLE `sedes_afilias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `fechaafilia` date NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sedes_afilias`
--

INSERT INTO `sedes_afilias` (`id`, `nombre`, `direccion`, `telefono`, `fechaafilia`, `created_at`, `updated_at`) VALUES
(1, 'Sedes1', 'direccion', '04263453434', '1990-11-15', '2018-07-04', '2018-07-04');

-- --------------------------------------------------------

--
-- Table structure for table `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `detalle` varchar(200) NOT NULL,
  `precio` text NOT NULL,
  `porcentaje` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicios`
--

INSERT INTO `servicios` (`id`, `detalle`, `precio`, `porcentaje`, `created_at`, `updated_at`, `id_empresa`, `id_sucursal`) VALUES
(1, 'COACHING', '70.00', '0', '2018-07-04', '2018-08-08', 1, 1),
(3, 'Servicio prueba', '100', '990', '2018-07-04', '2018-07-04', 1, 2),
(4, 'yuyuyu', '222', '222', '2018-07-13', '2018-07-13', 1, 2),
(5, 'ECOGRAFIA DOPPLER COLOR', '180.00', '50.00', '2018-07-13', '2018-08-08', 1, 1),
(6, 'SERVICIO', '1.250,00', '1.250,00', '2018-07-16', '2018-07-16', 1, 1),
(7, 'ECOGRAFIA TRANSVAGINAL', '60', '50', '2018-07-23', '2018-07-23', 1, 1),
(8, 'ECOGRAFIA DE MAMAS', '60.00', '45.80', '2018-07-24', '2018-08-07', 1, 1),
(9, 'ECOGRAFIA TRANSVAGINAL', '60.00', '50.01', '2018-08-06', '2018-08-06', 1, 5),
(10, 'ECOGRAFIA OBSTETRICA', '40.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(11, 'PERFIL BIOFISICO', '50.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(12, 'DESCARTE DE EMBARAZO', '25.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(13, 'ECOGRAFIA RENAL', '40.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(14, 'ECOGRAFIA VESICO PROSTATICA', '45.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(15, 'COLPOSCOPIA', '120.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(16, 'ECOGRAFIA ABDOMINAL SUPERIOR', '45.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(17, 'ECOGRAFIA GINECOLOGICA', '40.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(18, 'ECOGRAFIA  GENETICA', '120.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(19, 'ECOGRAFIA DE MAMAS', '60.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(20, 'CONSULTA GINECOLOGIA', '40.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(21, 'CONSULTA OBSTETRICA', '20.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(22, 'CONSULTA MEDICINA', '30.00', '0.01', '2018-08-06', '2018-08-06', 1, 5),
(23, 'COLPOSCOPIA', '180.00', '30.00', '2018-08-07', '2018-08-07', 1, 1),
(24, 'consulta medicina', '30.00', '0.10', '2018-08-09', '2018-08-09', 1, 5),
(25, 'CONSULTA GINECOLOGICA', '30.00', '0.01', '2018-08-13', '2018-08-13', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `id_sede` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sucursales`
--

INSERT INTO `sucursales` (`id`, `nombre`, `id_sede`, `estatus`) VALUES
(1, 'Sede Sur', 1, 1),
(2, 'Sede Sur', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_empresa` int(11) NOT NULL DEFAULT '1',
  `id_sucursal` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `id_empresa`, `id_sucursal`) VALUES
(2, 'Erik', 'zerpaerik@gmail.com', '$2y$10$Hx/hnU6hT9.lnUG.MmCIzOC3Fe3VEdwQuF/hF.ccol2c70ALS.lzq', NULL, '2018-07-02 05:59:15', '2018-07-02 05:59:15', 0, 0),
(4, 'Jose', 'jmeza@gmail.com', '$2y$10$2q5Iv6Ha6W0MDzXp4PyBPu8b7B251FgWGfk9wFXX0lwbHc3b4y5hq', 'kchvMjEdzWS20LtSiRkPdHtzKacI1CErif1T0wWvk0xBEYQO8wnbcBdhay7f', '2018-07-14 01:11:55', '2018-07-14 01:11:55', 1, 1),
(5, 'Admin', 'admin@admin.com', '$2y$10$LueHY4/NLhcjxzE5dR1V.uI5HgCK8nwSBElsRIzEcwLjHXhgLIwDy', '1xLKGhdqsZVyZuwQJcbCXseTjKJIZRn3um5zLBDQDZvZWbMHEM5KTbncLUgV', '2018-07-23 13:57:48', '2018-07-23 13:57:48', 1, 1),
(6, 'MT INDEP', 'mtindep@admin.com', '$2y$10$xM4eXdI/PFWvhdOtgvIzMOqqDtrdGp.3.CFi27ZrZ8o/c9DmFLigy', 'UItyIdcIonmezo9E9nSm350HM4trxxShOWh3Z6B0qoYeFFNvbw3u6x6wb4Vi', '2018-08-05 21:44:22', '2018-08-05 21:44:22', 1, 5),
(7, 'MT PRO', 'mtpro@admin.com', '$2y$10$GP6qjpb1LDUhAPHYjCm3g.qhRxGxkbrvpRehxHXyMPhDT/5Wp7bd6', 'jds8DK1wbmqsWa6UvjXQFOQA7LXdbVu7lJQmve9IdKeOfv4TnVDsEGFUr6W3', '2018-08-05 21:44:42', '2018-08-05 21:44:42', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `email` varchar(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_sede` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  `esadmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `email`, `usuario`, `contrasena`, `id_perfil`, `id_sede`, `id_sucursal`, `estatus`, `esadmin`) VALUES
(1, 'Jose', 'Meza', 'jmez@gmail.com', 'jmeza', '123456', 1, 1, 1, 1, 0),
(2, 'Jose', 'Meza', 'jmez@gmail.com', 'jmeza', '123456', 1, 1, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abilities`
--
ALTER TABLE `abilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `abilities_unique_index` (`name`,`entity_id`,`entity_type`,`only_owned`);

--
-- Indexes for table `analises`
--
ALTER TABLE `analises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD KEY `assigned_roles_entity_id_entity_type_index` (`entity_id`,`entity_type`),
  ADD KEY `assigned_roles_role_id_index` (`role_id`);

--
-- Indexes for table `atencions`
--
ALTER TABLE `atencions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atencion_detalles`
--
ALTER TABLE `atencion_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atencion_laboratorios`
--
ALTER TABLE `atencion_laboratorios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atencion_servicios`
--
ALTER TABLE `atencion_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `centros`
--
ALTER TABLE `centros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creditos`
--
ALTER TABLE `creditos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creditos_productos`
--
ALTER TABLE `creditos_productos`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `debitos`
--
ALTER TABLE `debitos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distritos`
--
ALTER TABLE `distritos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edo_civils`
--
ALTER TABLE `edo_civils`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `especialidads`
--
ALTER TABLE `especialidads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grado_instruccions`
--
ALTER TABLE `grado_instruccions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historias_clinicas`
--
ALTER TABLE `historias_clinicas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paquetes_analises`
--
ALTER TABLE `paquetes_analises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paquetes_servs`
--
ALTER TABLE `paquetes_servs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD KEY `permissions_entity_id_entity_type_index` (`entity_id`,`entity_type`),
  ADD KEY `permissions_ability_id_index` (`ability_id`);

--
-- Indexes for table `personals`
--
ALTER TABLE `personals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profesionales`
--
ALTER TABLE `profesionales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sedes_afilias`
--
ALTER TABLE `sedes_afilias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abilities`
--
ALTER TABLE `abilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `analises`
--
ALTER TABLE `analises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `atencions`
--
ALTER TABLE `atencions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `atencion_detalles`
--
ALTER TABLE `atencion_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `atencion_laboratorios`
--
ALTER TABLE `atencion_laboratorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `atencion_servicios`
--
ALTER TABLE `atencion_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `centros`
--
ALTER TABLE `centros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `creditos`
--
ALTER TABLE `creditos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `creditos_productos`
--
ALTER TABLE `creditos_productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `debitos`
--
ALTER TABLE `debitos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `distritos`
--
ALTER TABLE `distritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `edo_civils`
--
ALTER TABLE `edo_civils`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `especialidads`
--
ALTER TABLE `especialidads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `grado_instruccions`
--
ALTER TABLE `grado_instruccions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `historias_clinicas`
--
ALTER TABLE `historias_clinicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `locales`
--
ALTER TABLE `locales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `paquetes_analises`
--
ALTER TABLE `paquetes_analises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `paquetes_servs`
--
ALTER TABLE `paquetes_servs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personals`
--
ALTER TABLE `personals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `profesionales`
--
ALTER TABLE `profesionales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sedes_afilias`
--
ALTER TABLE `sedes_afilias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ability_id_foreign` FOREIGN KEY (`ability_id`) REFERENCES `abilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
