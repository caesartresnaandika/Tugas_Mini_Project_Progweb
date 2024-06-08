-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 02:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_progweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `id_artis` int(11) NOT NULL,
  `tipe_ticket` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `harga` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `id_artis`, `tipe_ticket`, `stock`, `harga`) VALUES
(1, 1, 'CAT 1A DAY 1', 99, 2900000),
(2, 1, 'CAT 1B DAY 1', 12, 2900000),
(3, 1, 'CAT 2A DAY 2', 56, 2700000),
(4, 1, 'CAT 2B DAY 2', 12, 2700000),
(5, 1, 'CAT 2C DAY 2', 0, 1700000),
(24, 2, 'CAT 1A DAY 1', 99, 2900000),
(25, 2, 'CAT 1B DAY 1', 12, 2900000),
(26, 2, 'CAT 2A DAY 2', 56, 2700000),
(27, 2, 'CAT 2B DAY 2', 12, 2700000),
(28, 2, 'CAT 2C DAY 2', 0, 1700000),
(29, 3, 'CAT 1A DAY 1', 99, 2900000),
(30, 3, 'CAT 1B DAY 1', 12, 2900000),
(31, 3, 'CAT 2A DAY 2', 56, 2700000),
(32, 3, 'CAT 2B DAY 2', 12, 2700000),
(33, 3, 'CAT 2C DAY 2', 0, 1700000),
(34, 4, 'CAT 1A DAY 1', 99, 2900000),
(35, 4, 'CAT 1B DAY 1', 12, 2900000),
(36, 4, 'CAT 2A DAY 2', 56, 2700000),
(37, 3, 'CAT 2B DAY 2', 12, 2700000),
(38, 4, 'CAT 2C DAY 2', 0, 1700000),
(39, 5, 'CAT 1A DAY 1', 99, 2900000),
(40, 5, 'CAT 1B DAY 1', 12, 2900000),
(41, 5, 'CAT 2A DAY 2', 56, 2700000),
(42, 5, 'CAT 2B DAY 2', 12, 2700000),
(43, 5, 'CAT 2C DAY 2', 0, 1700000),
(44, 6, 'CAT 1A DAY 1', 99, 2900000),
(45, 6, 'CAT 1B DAY 1', 12, 2900000),
(46, 6, 'CAT 2A DAY 2', 56, 2700000),
(47, 6, 'CAT 2B DAY 2', 12, 2700000),
(48, 6, 'CAT 2C DAY 2', 0, 1700000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `id_artis` (`id_artis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_artis`) REFERENCES `konser` (`id_artis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
