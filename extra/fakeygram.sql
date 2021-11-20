-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2021 at 10:18 PM
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
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `fromWho` varchar(255) NOT NULL,
  `toWho` varchar(255) NOT NULL,
  `fStatus` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`fromWho`, `toWho`, `fStatus`) VALUES
('27', '24', 'P'),
('14', '24', 'P'),
('26', '24', 'F'),
('25', '24', 'F');

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
(2, 'naruto@gmail.com', 'mauricio@gmail.com', 'feo', '2021-11-20 10:03pm'),
(3, 'naruto@gmail.com', 'mauricio@gmail.com', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2021-11-20 10:03pm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `pfp`, `status`, `age`) VALUES
(12, 'adrian@gmail.com', 'Adrian Navarro', '$2y$10$0nVtglYx023wWCSN2ZRID.AnqV5mXno5dhzR0lG.muGA6XDhU0IAO', 'default.png', 'NOT SET', 'NOT SET'),
(14, 'mauricio@gmail.com', 'feo', '$2y$10$UflEDWRIEWCqd9QHJDNbFuZe2AQrBknAf.v6/ZyV0zTxFB3QKPTYO', 'default.png', 'NOT SET', 'NOT SET'),
(19, 'test@gmail.com', 'Testo', '$2y$10$bh1K6GL9MgcY4mKSrcooV.1bptppBt2ZRXH9/pwjE8lrgMSxtyw8i', 'default.png', 'NOT SET', 'NOT SET'),
(24, 'naruto@gmail.com', 'Naruto', '$2y$10$A4VvvW/q7FewG.bZ0mgTjOOJIrvv5a01G6pcdM3b1pRtT0Q5..ZJO', 'naruto.png', 'DattebayO!', '17'),
(25, 'denji@gmail.com', 'Denji', '$2y$10$aQv15GvFofY3AKVgSQuilOr/EKGTkAQKVIJhJwnIePtiPfLdTplxy', 'original.jpg', 'aaaa', ''),
(26, 'mariano@gmail.com', 'gay', '$2y$10$5YCJwbH.TyDafA73NOc8O.rVsR9z0GxNKYSJ6InLIWJwirC1Xq0.G', 'default.png', 'NOT SET', 'NOT SET'),
(27, 'angel@gmail.com', 'angel', '$2y$10$9Yb9tM30hBo14T61p2.Gk.dq6RapYISBH3uHRuXvcN.ultnl4HmnS', 'angel.jpg', 'NOT SET', 'NOT SET');

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
