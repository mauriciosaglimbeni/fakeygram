-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2021 at 01:07 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fakeygram`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `sent_by` varchar(255) CHARACTER SET latin1 NOT NULL,
  `received_by` varchar(255) CHARACTER SET latin1 NOT NULL,
  `message` varchar(255) CHARACTER SET latin1 NOT NULL,
  `createdAt` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sent_by`, `received_by`, `message`, `createdAt`) VALUES
(6, 'naruto@gmail.com', 'mauricio@gmail.com', 'Hijo de puta ´ttebayo!', '2021-11-18 04:58:35pm'),
(7, 'mauricio@gmail.com', 'naruto@gmail.com', 'Tu puta madre chinomierda', '2021-11-18 04:59:16pm'),
(8, 'naruto@gmail.com', 'denji@gmail.com', 'You don´t have parents bitch, believe it!', '2021-11-19 12:05:35pm'),
(9, 'denji@gmail.com', 'naruto@gmail.com', 'Suck my nuts!', '2021-11-19 12:36:10pm'),
(10, 'denji@gmail.com', 'naruto@gmail.com', 'puta', '2021-11-19 12:36:30pm'),
(11, 'denji@gmail.com', 'naruto@gmail.com', 'a', '2021-11-19 12:38:26pm'),
(12, 'mariano@gmail.com', 'mauricio@gmail.com', 'Feo', '2021-11-19 12:47:44pm'),
(13, 'mauricio@gmail.com', 'mariano@gmail.com', 'Al menos no soy gay', '2021-11-19 12:47:58pm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pfp` varchar(255) CHARACTER SET latin1 DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `pfp`) VALUES
(12, 'adrian@gmail.com', 'Adrian Navarro', '$2y$10$0nVtglYx023wWCSN2ZRID.AnqV5mXno5dhzR0lG.muGA6XDhU0IAO', 'default.png'),
(14, 'mauricio@gmail.com', 'Mauricio Rodriguez', '$2y$10$UflEDWRIEWCqd9QHJDNbFuZe2AQrBknAf.v6/ZyV0zTxFB3QKPTYO', 'default.png'),
(19, 'test@gmail.com', 'Testo', '$2y$10$bh1K6GL9MgcY4mKSrcooV.1bptppBt2ZRXH9/pwjE8lrgMSxtyw8i', 'default.png'),
(24, 'naruto@gmail.com', 'Naruto', '$2y$10$A4VvvW/q7FewG.bZ0mgTjOOJIrvv5a01G6pcdM3b1pRtT0Q5..ZJO', 'naruto.png'),
(25, 'denji@gmail.com', 'Denji', '$2y$10$aQv15GvFofY3AKVgSQuilOr/EKGTkAQKVIJhJwnIePtiPfLdTplxy', 'original.jpg'),
(26, 'mariano@gmail.com', 'gay', '$2y$10$5YCJwbH.TyDafA73NOc8O.rVsR9z0GxNKYSJ6InLIWJwirC1Xq0.G', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
