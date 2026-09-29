-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-09-2026 a las 18:51:32
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `albunes`
--
CREATE DATABASE IF NOT EXISTS `albunes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `albunes`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albunes`
--

CREATE TABLE `albunes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `artista` varchar(150) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `anio` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `albunes`
--

INSERT INTO `albunes` (`id`, `titulo`, `artista`, `genero`, `anio`, `precio`) VALUES
(1, 'Abbey Road', 'The Beatles', 'Rock', 1969, 19.99),
(2, 'Thriller', 'Michael Jackson', 'Pop', 1982, 24.99),
(3, 'Back to Black', 'Amy Winehouse', 'Soul', 2006, 17.99),
(4, 'Random Access Memories', 'Daft Punk', 'Electronic', 2013, 21.99),
(9, 'lalal', 'llolol', 'balls', 1963, 30.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albunes`
--
ALTER TABLE `albunes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albunes`
--
ALTER TABLE `albunes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
