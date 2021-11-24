-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2021 a las 17:37:03
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fakeygram`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friendship`
--

CREATE TABLE `friendship` (
  `fromWho` varchar(255) NOT NULL,
  `toWho` varchar(255) NOT NULL,
  `fStatus` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `friendship`
--

INSERT INTO `friendship` (`fromWho`, `toWho`, `fStatus`) VALUES
('24', '32', 'F'),
('32', '12', 'P'),
('33', '34', 'F'),
('34', '32', 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `sent_by` varchar(255) CHARACTER SET latin1 NOT NULL,
  `received_by` varchar(255) CHARACTER SET latin1 NOT NULL,
  `message` varchar(255) CHARACTER SET latin1 NOT NULL,
  `createdAt` varchar(255) CHARACTER SET latin1 NOT NULL,
  `opened` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `sent_by`, `received_by`, `message`, `createdAt`, `opened`) VALUES
(1, 'naruto@gmail.com', 'mauricio@gmail.com', 'Hello Mauricio!', '2021-11-24 04:35pm', 1),
(2, 'naruto@gmail.com', 'mauricio@gmail.com', 'Do you want to be my friend?', '2021-11-24 04:35pm', 1),
(3, 'mauricio@gmail.com', 'naruto@gmail.com', 'Sure, I´ll accept your friend request right away!', '2021-11-24 04:36pm', 0),
(4, 'mauricio@gmail.com', 'adrian@gmail.com', 'Hello Adri, do you want to be my friend?', '2021-11-24 04:36pm', 1),
(5, 'adrian@gmail.com', 'mauricio@gmail.com', 'I´ll think about it...', '2021-11-24 04:44pm', 0),
(6, 'alfredo@gmail.com', 'luis@gmail.com', 'Hi Luis', '2021-11-24 04:44pm', 1),
(7, 'alfredo@gmail.com', 'luis@gmail.com', 'Do you like FakeyGram?', '2021-11-24 04:45pm', 1),
(8, 'luis@gmail.com', 'alfredo@gmail.com', 'Yeah, but my app is better ', '2021-11-24 04:45pm', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pfp` varchar(255) CHARACTER SET latin1 DEFAULT 'default.png',
  `status` varchar(255) DEFAULT 'NOT SET',
  `age` varchar(255) DEFAULT 'NOT SET'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `pfp`, `status`, `age`) VALUES
(1, 'admin@root.com', 'admin', '$2y$10$ysuHZmZpwQrM29PPiG2BDuBlvtXfZeVf55h7GctAzcJ6vuA2kwnjm', 'default.png', 'NOT SET', 'NOT SET'),
(12, 'adrian@gmail.com', 'Adrian Navarro', '$2y$10$0nVtglYx023wWCSN2ZRID.AnqV5mXno5dhzR0lG.muGA6XDhU0IAO', 'adrian.png', 'Feeling good!', '21'),
(24, 'naruto@gmail.com', 'Naruto', '$2y$10$A4VvvW/q7FewG.bZ0mgTjOOJIrvv5a01G6pcdM3b1pRtT0Q5..ZJO', 'naruto.png', 'DattebayO!', '17'),
(32, 'mauricio@gmail.com', 'Mauricio Rodriguez', '$2y$10$k7M3Gwo3gQL9sidFh0Ddh.vnfuLDIHFTW.bpcqxgiUioXTL3mKPAa', 'denji.png', 'NOT SET', 'NOT SET'),
(33, 'alfredo@gmail.com', 'Alfredo Puerta', '$2y$10$MbSBlDKIYABJmLzlg0fo3u9E9acIvP9eNhUmcDvOJk/rIQDUSa5nC', 'default.png', 'NOT SET', 'NOT SET'),
(34, 'luis@gmail.com', 'Luis Monzon', '$2y$10$b4YqV8qGZ3PhHGgzFLLEKuUcjtTe.8edX82.J/.uSfYHtmx8R2J4q', 'default.png', 'NOT SET', 'NOT SET');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
