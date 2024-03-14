-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2024 at 12:33 AM
-- Server version: 8.0.28-0ubuntu4
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instruct`
--

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ref` varchar(100) NOT NULL,
  `centre` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `service` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `country` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `ref`, `centre`, `service`, `country`) VALUES
('1', 'APPLAB1', 'Aperture Science', 'Portal Technology', 'FR'),
('2', 'BLULAB1', 'Blue Sun Corp', 'Behaviour Modification', 'FR'),
('3', 'BLULAB2', 'Blue Sun Corp', 'Behaviour Modification', 'IT'),
('4', 'BLULAB3', 'Blue Sun R&D', 'Behaviour Modification', 'CZ'),
('5', 'BMELAB1', 'Black Mesa', 'Interdimensional Travel', 'DE'),
('6', 'BMELAB2', 'Black Mesa Second Site', 'Interdimensional Travel', 'DE'),
('7', 'TYRLAB1', 'Tyrell Research', 'Synthetic Consciousness', 'GB'),
('8', 'TYRLAB2', 'Tyrell Research', 'ynthetic Optics', 'PT'),
('9', 'WEYLAB1', 'Weyland Yutani Research', 'Xeno-biology', 'GB');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
