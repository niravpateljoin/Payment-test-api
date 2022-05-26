-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2020 at 09:26 AM
-- Server version: 5.7.31
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test2`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `internal_invoice_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_on` datetime DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `sell_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `internal_invoice_id`, `invoice_amount`, `due_on`, `createdAt`, `sell_price`) VALUES
(37, '1', '100', '2021-01-10 00:00:00', '2020-12-10 09:22:39', '50'),
(38, '2', '200.5', '2020-12-10 00:00:00', '2020-12-10 09:22:39', '100.25'),
(39, 'B', '300', '2019-05-01 00:00:00', '2020-12-10 09:22:39', '90'),
(40, '1', '100', '2019-05-20 00:00:00', '2020-12-10 09:23:09', '30'),
(41, '2', '200.5', '2019-05-10 00:00:00', '2020-12-10 09:23:09', '60.15'),
(42, 'B', '300', '2019-05-01 00:00:00', '2020-12-10 09:23:09', '90');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
