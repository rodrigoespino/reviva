-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 05-03-2020 a las 15:39:22
-- Versión del servidor: 10.3.22-MariaDB-0+deb10u1
-- Versión de PHP: 7.3.14-5+0~20200202.52+debian10~1.gbpa71879

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `total`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_groups`
--

CREATE TABLE `admin_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admin_groups`
--

INSERT INTO `admin_groups` (`id`, `name`, `description`) VALUES
(1, 'webmaster', 'Webmaster'),
(2, 'admin', 'Administrator'),
(3, 'manager', 'Manager'),
(4, 'staff', 'Staff');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_login_attempts`
--

CREATE TABLE `admin_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admin_users`
--

INSERT INTO `admin_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`) VALUES
(1, '127.0.0.1', 'webmaster', '$2y$08$/X5gzWjesYi78GqeAv5tA.dVGBVP7C1e1PzqnYCVe5s1qhlDIPPES', NULL, NULL, NULL, NULL, NULL, NULL, 1451900190, 1583417287, 1, 'Webmaster', ''),
(2, '127.0.0.1', 'admin', '$2y$08$7Bkco6JXtC3Hu6g9ngLZDuHsFLvT7cyAxiz1FzxlX5vwccvRT7nKW', NULL, NULL, NULL, NULL, NULL, NULL, 1451900228, 1465833536, 1, 'Admin', ''),
(3, '127.0.0.1', 'manager', '$2y$08$snzIJdFXvg/rSHe0SndIAuvZyjktkjUxBXkrrGdkPy1K6r5r/dMLa', NULL, NULL, NULL, NULL, NULL, NULL, 1451900430, 1465489585, 1, 'Manager', ''),
(4, '127.0.0.1', 'staff', '$2y$08$NigAXjN23CRKllqe3KmjYuWXD5iSRPY812SijlhGeKfkrMKde9da6', NULL, NULL, NULL, NULL, NULL, NULL, 1451900439, 1465489590, 1, 'Staff', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_users_groups`
--

CREATE TABLE `admin_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admin_users_groups`
--

INSERT INTO `admin_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_access`
--

CREATE TABLE `api_access` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(40) NOT NULL DEFAULT '',
  `controller` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, 'anonymous', 1, 1, 0, NULL, 1463388382);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_limits`
--

CREATE TABLE `api_limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_logs`
--

CREATE TABLE `api_logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text DEFAULT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billing_items`
--

CREATE TABLE `billing_items` (
  `id_billing` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `price_unity` float(5,2) NOT NULL,
  `price_total` float(5,2) NOT NULL,
  `taxes` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `billing_items`
--

INSERT INTO `billing_items` (`id_billing`, `id_product`, `qty`, `price_unity`, `price_total`, `taxes`) VALUES
(4, 1, 1, 80.00, 88.00, 0),
(4, 1, 1, 80.00, 88.00, 0),
(4, 3, 4, 10.00, 46.00, 0),
(5, 1, 1, 80.00, 88.00, 10),
(5, 1, 1, 80.00, 88.00, 10),
(5, 3, 4, 10.00, 46.00, 15),
(6, 3, 12, 10.00, 138.00, 15),
(6, 1, 12, 80.00, 999.99, 10),
(6, 3, 12, 10.00, 138.00, 15),
(7, 4, 1, 12.49, 13.11, 5),
(8, 4, 1, 12.49, 13.11, 5),
(9, 4, 1, 12.49, 13.11, 5),
(9, 4, 1, 12.49, 13.11, 5),
(9, 3, 4, 10.00, 46.00, 15),
(10, 4, 1, 12.49, 13.11, 5),
(10, 1, 1, 80.00, 88.00, 10),
(11, 4, 1, 12.49, 13.11, 5),
(11, 1, 1, 80.00, 88.00, 10),
(12, 4, 1, 12.49, 13.11, 5),
(12, 1, 1, 80.00, 88.00, 10),
(13, 4, 1, 12.49, 13.11, 5),
(13, 1, 1, 80.00, 88.00, 10),
(14, 4, 1, 12.49, 13.11, 5),
(14, 1, 1, 80.00, 88.00, 10),
(15, 4, 1, 12.49, 13.11, 5),
(15, 1, 1, 80.00, 88.00, 10),
(16, 4, 1, 12.49, 13.11, 5),
(16, 1, 1, 80.00, 88.00, 10),
(17, 4, 1, 12.49, 13.11, 5),
(17, 1, 1, 80.00, 88.00, 10),
(18, 4, 1, 12.49, 13.11, 5),
(18, 1, 1, 80.00, 88.00, 10),
(19, 4, 1, 12.49, 13.11, 5),
(19, 1, 1, 80.00, 88.00, 10),
(20, 4, 1, 12.49, 13.11, 5),
(20, 1, 1, 80.00, 88.00, 10),
(21, 4, 1, 12.49, 13.11, 5),
(21, 1, 1, 80.00, 88.00, 10),
(22, 4, 1, 12.49, 13.11, 5),
(23, 3, 1, 10.00, 11.50, 15),
(23, 4, 1, 12.49, 13.11, 5),
(24, 4, 2, 12.49, 24.98, 0),
(24, 5, 1, 14.99, 16.49, 10),
(24, 6, 1, 0.85, 0.85, 0),
(25, 8, 1, 10.00, 10.50, 5),
(25, 9, 1, 47.50, 54.63, 15),
(26, 12, 1, 27.99, 32.19, 15),
(26, 14, 1, 18.99, 20.89, 10),
(26, 11, 1, 9.75, 9.75, 0),
(26, 15, 3, 13.00, 40.95, 5),
(27, 1, 1, 80.00, 80.00, 0),
(27, 3, 12, 10.00, 126.00, 5),
(27, 8, 44, 10.00, 462.00, 5),
(28, 1, 12, 80.00, 960.00, 0),
(28, 8, 40, 10.00, 420.00, 5),
(28, 10, 23, 20.89, 528.52, 10),
(28, 15, 33, 11.25, 389.81, 5),
(28, 11, 55, 9.75, 536.25, 0),
(29, 3, 2, 10.00, 21.00, 5),
(30, 3, 12, 10.00, 126.00, 5),
(31, 6, 12, 0.85, 10.20, 12),
(31, 11, 0, 9.75, 0.00, 0),
(32, 4, 12, 12.49, 149.88, 0),
(33, 3, 1, 10.00, 10.50, 5),
(33, 4, 12, 12.49, 149.88, 0),
(33, 15, 66, 11.25, 779.63, 5),
(33, 4, 22, 12.49, 274.78, 0),
(33, 3, 33, 10.00, 346.50, 5),
(33, 11, 55, 9.75, 536.25, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id_client`, `Name`, `email`, `Address`, `Phone`) VALUES
(1, 'Rodrigo Espino', 'espino.rodrigo@gmail.com', 'Vicollo Porta Galli 3', ''),
(3, 'a', 'a', 'a', ''),
(4, 'Nuevo Cliente', 'espino.rodrigo@gmail.com', 'ASDASDA', '1212121212');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Company`
--

CREATE TABLE `Company` (
  `Name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Taxes_imported` decimal(5,2) NOT NULL,
  `id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Company`
--

INSERT INTO `Company` (`Name`, `email`, `Address`, `Taxes_imported`, `id`, `phone`, `url`) VALUES
('REVIVA', 'info@reviva.com', 'Aasasas', '5.00', 1, '1111', 'd67d6-logo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cover_photos`
--

CREATE TABLE `cover_photos` (
  `id` int(11) NOT NULL,
  `pos` int(11) NOT NULL DEFAULT 0,
  `image_url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','hidden') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cover_photos`
--

INSERT INTO `cover_photos` (`id`, `pos`, `image_url`, `status`) VALUES
(1, 2, '45296-2.jpg', 'active'),
(2, 1, '2934f-1.jpg', 'active'),
(3, 3, '3717d-3.jpg', 'active'),
(4, 0, 'bfaca-677774d6-a86b-4d9c-be4c-a5c4c5b6737b.jpg', 'active'),
(5, 0, '80bca-Captura-de-pantalla-de-2020-01-17-18-24-24.png', 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'members', 'General User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_taxes`
--

CREATE TABLE `group_taxes` (
  `id_grouptax` int(5) NOT NULL,
  `description_group` varchar(200) NOT NULL,
  `tax_price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `group_taxes`
--

INSERT INTO `group_taxes` (`id_grouptax`, `description_group`, `tax_price`) VALUES
(1, 'MEDICAL', '0.00'),
(3, 'BOOKS', '0.00'),
(4, 'FOOD', '0.00'),
(6, 'OTHERS', '10.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `header_billing`
--

CREATE TABLE `header_billing` (
  `id_billing` int(5) NOT NULL,
  `id_client` int(10) NOT NULL,
  `total_billing` decimal(5,2) NOT NULL,
  `total_taxes` decimal(5,2) NOT NULL,
  `date_billing` date NOT NULL DEFAULT current_timestamp(),
  `id_paid` int(11) NOT NULL,
  `notes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `header_billing`
--

INSERT INTO `header_billing` (`id_billing`, `id_client`, `total_billing`, `total_taxes`, `date_billing`, `id_paid`, `notes`) VALUES
(1, 1, '100.00', '100.00', '2020-02-21', 1, ''),
(2, 0, '0.00', '0.00', '0000-00-00', 0, ''),
(3, 1, '222.00', '0.00', '2020-02-24', 0, ''),
(4, 1, '222.00', '0.00', '2020-02-24', 0, ''),
(5, 1, '222.00', '0.00', '2020-02-24', 0, ''),
(6, 1, '999.99', '0.00', '2020-02-24', 0, ''),
(7, 1, '13.11', '0.00', '2020-02-24', 0, ''),
(8, 1, '13.11', '0.00', '2020-02-24', 0, ''),
(9, 1, '72.22', '0.00', '2020-02-24', 0, ''),
(10, 3, '101.11', '92.49', '2020-02-24', 0, ''),
(11, 3, '101.11', '92.49', '2020-02-24', 0, ''),
(12, 3, '101.11', '92.49', '2020-02-24', 0, ''),
(13, 3, '101.11', '92.49', '2020-02-24', 0, ''),
(14, 3, '101.11', '92.49', '2020-02-24', 0, ''),
(15, 3, '101.11', '92.49', '2020-02-24', 0, ''),
(16, 3, '101.11', '92.49', '2020-02-24', 0, ''),
(17, 3, '101.11', '92.49', '2020-02-24', 0, ''),
(18, 3, '101.11', '92.49', '2020-02-24', 0, ''),
(19, 3, '101.11', '92.49', '2020-02-24', 0, ''),
(20, 3, '101.11', '92.49', '2020-02-24', 0, ''),
(21, 3, '101.11', '92.49', '2020-02-24', 0, ''),
(22, 1, '13.11', '12.49', '2020-02-24', 0, ''),
(23, 1, '24.61', '22.49', '2020-02-24', 0, ''),
(24, 1, '42.32', '40.82', '2020-02-24', 0, ''),
(25, 1, '65.13', '57.50', '2020-02-24', 0, ''),
(26, 1, '103.78', '95.73', '2020-02-24', 0, ''),
(27, 4, '668.00', '640.00', '2020-03-04', 1, ''),
(28, 4, '999.99', '999.99', '2020-03-05', 1, 'Demo Billing'),
(29, 4, '21.00', '20.00', '2020-03-05', 1, '444'),
(30, 3, '126.00', '120.00', '2020-03-05', 1, '12'),
(31, 4, '10.20', '10.20', '2020-03-05', 1, '12'),
(32, 4, '149.88', '149.88', '2020-03-05', 1, '12'),
(33, 1, '999.99', '999.99', '2020-03-05', 1, 'qwdqwewqe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id_product` int(10) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` float(5,2) DEFAULT NULL,
  `id_grouptax` int(5) DEFAULT NULL,
  `is_imported` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id_product`, `description`, `price`, `id_grouptax`, `is_imported`) VALUES
(1, 'PILDORA', 80.00, 1, 0),
(3, 'CHOCOLATO', 10.00, 1, 1),
(4, 'BOOK', 12.49, 3, 0),
(5, 'music CD ', 14.99, 6, 0),
(6, 'chocolate bar', 0.85, 4, 0),
(8, ' imported box of chocolates', 10.00, 4, 1),
(9, 'imported bottle of perfume at', 47.50, 6, 1),
(10, 'bottle of perfume', 20.89, 6, 0),
(11, 'packet of headache pills', 9.75, 1, 0),
(12, 'imported bottle of perfume 2', 27.99, 6, 1),
(13, 'box of imported chocolates 2', 11.25, 4, 1),
(14, 'bottle of perfume', 18.99, 6, 0),
(15, ' box of imported chocolates I3', 11.25, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_paid`
--

CREATE TABLE `status_paid` (
  `id_paid` int(11) NOT NULL,
  `description_paid` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `status_paid`
--

INSERT INTO `status_paid` (`id_paid`, `description_paid`) VALUES
(1, 'PAID');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `about` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `about`) VALUES
(1, '127.0.0.1', 'member', '$2y$08$kkqUE2hrqAJtg.pPnAhvL.1iE7LIujK5LZ61arONLpaBBWh/ek61G', NULL, 'member@member.com', NULL, NULL, NULL, NULL, 1451903855, 1451905011, 1, 'Member', 'One', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin_groups`
--
ALTER TABLE `admin_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `admin_login_attempts`
--
ALTER TABLE `admin_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `admin_users_groups`
--
ALTER TABLE `admin_users_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `api_access`
--
ALTER TABLE `api_access`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `api_limits`
--
ALTER TABLE `api_limits`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `api_logs`
--
ALTER TABLE `api_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indices de la tabla `Company`
--
ALTER TABLE `Company`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cover_photos`
--
ALTER TABLE `cover_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `group_taxes`
--
ALTER TABLE `group_taxes`
  ADD PRIMARY KEY (`id_grouptax`);

--
-- Indices de la tabla `header_billing`
--
ALTER TABLE `header_billing`
  ADD PRIMARY KEY (`id_billing`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indices de la tabla `status_paid`
--
ALTER TABLE `status_paid`
  ADD PRIMARY KEY (`id_paid`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin_groups`
--
ALTER TABLE `admin_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `admin_login_attempts`
--
ALTER TABLE `admin_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `admin_users_groups`
--
ALTER TABLE `admin_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `api_access`
--
ALTER TABLE `api_access`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `api_limits`
--
ALTER TABLE `api_limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `api_logs`
--
ALTER TABLE `api_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Company`
--
ALTER TABLE `Company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cover_photos`
--
ALTER TABLE `cover_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `group_taxes`
--
ALTER TABLE `group_taxes`
  MODIFY `id_grouptax` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `header_billing`
--
ALTER TABLE `header_billing`
  MODIFY `id_billing` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `status_paid`
--
ALTER TABLE `status_paid`
  MODIFY `id_paid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
