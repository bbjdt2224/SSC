-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2017 at 07:32 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssc`
--

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE `timesheets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startdate` date NOT NULL,
  `firstweek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0',
  `secondweek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0',
  `totals` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0,0,0',
  `submitted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timesheets`
--

INSERT INTO `timesheets` (`id`, `user`, `startdate`, `firstweek`, `secondweek`, `totals`, `submitted`, `created_at`, `updated_at`) VALUES
(1, '-1', '2017-10-23', '-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0', '-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0', '0,0,0', 0, '2017-10-17 04:00:00', '2017-10-17 04:00:00'),
(2, '1', '2017-10-23', '-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,7:00 PM,1:00 AM,-,6', '-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,7:00 PM,1:00 AM,-,6|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,7:00 PM,1:00 AM,-,6', '6,12,18', 0, '2017-10-17 04:00:00', '2017-10-18 08:17:13'),
(3, '1', '2017-10-30', '-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,7:00 PM,1:00 AM,-,6|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,7:00 PM,1:00 AM,-,6', '-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,7:00 PM,1:00 AM,-,6|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,7:00 PM,1:00 AM,-,6', '12,12,24', 0, '2017-10-18 08:07:55', '2017-10-18 08:16:51'),
(5, '1', '2017-10-09', '-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,7:00 PM,1:00 AM,-,6|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,7:00 PM,1:00 AM,-,6', '-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,7:00 PM,1:00 AM,-,6|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,7:00 PM,1:00 AM,-,6', '12,12,24', 1, '2017-10-18 20:46:37', '2017-10-18 21:13:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
