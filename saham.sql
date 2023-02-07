-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 07, 2023 at 12:14 PM
-- Server version: 10.6.11-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saham`
--

-- --------------------------------------------------------

--
-- Table structure for table `broker_sum`
--

CREATE TABLE `broker_sum` (
  `REC_ID` int(11) NOT NULL,
  `BS_DATE` date NOT NULL,
  `BROKER` varchar(2) NOT NULL,
  `SAHAM` varchar(50) NOT NULL,
  `B_VAL` decimal(18,2) DEFAULT NULL,
  `B_LOT` decimal(18,2) DEFAULT NULL,
  `B_FREQ` decimal(18,2) DEFAULT NULL,
  `B_AVG` decimal(18,2) DEFAULT NULL,
  `S_VAL` decimal(18,2) DEFAULT NULL,
  `S_LOT` decimal(18,2) DEFAULT NULL,
  `S_FREQ` decimal(18,2) DEFAULT NULL,
  `S_AVG` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `broker_sum`
--

INSERT INTO `broker_sum` (`REC_ID`, `BS_DATE`, `BROKER`, `SAHAM`, `B_VAL`, `B_LOT`, `B_FREQ`, `B_AVG`, `S_VAL`, `S_LOT`, `S_FREQ`, `S_AVG`) VALUES
(1, '2023-01-26', '1', '1', '2.00', '3.00', '4.00', '5.00', '6.00', '7.00', '8.00', '9.00'),
(2, '2023-01-27', '2', '2', '3.00', '3.01', '4.01', '5.01', '6.01', '7.01', '8.01', '9.01'),
(3, '2023-01-28', '3', '3', '4.00', '3.02', '4.02', '5.02', '6.02', '7.02', '8.02', '9.02'),
(4, '2023-01-28', '4', '4', '5.00', '3.03', '4.03', '5.03', '0.00', '7.03', '8.03', '9.03'),
(5, '2023-01-28', '5', '5', '6.00', '3.04', '4.04', '5.04', '6.04', '7.04', '8.04', '9.04'),
(6, '2023-01-28', '6', '6', '7.00', '3.05', '4.05', '5.05', '6.05', '7.05', '8.05', '9.05'),
(7, '2023-01-28', '7', '7', '8.00', '3.06', '4.06', '5.06', '6.06', '7.06', '8.06', '9.06'),
(8, '2023-01-28', '8', '8', '9.00', '3.07', '4.07', '5.07', '6.07', '7.07', '8.07', '9.07'),
(9, '2023-01-28', '9', '9', '10.00', '3.08', '4.08', '5.08', '6.08', '7.08', '8.08', '9.08'),
(10, '2023-01-28', '10', '10', '11.00', '3.09', '4.09', '5.09', '6.09', '7.09', '8.09', '9.09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `broker_sum`
--
ALTER TABLE `broker_sum`
  ADD PRIMARY KEY (`REC_ID`),
  ADD UNIQUE KEY `BS_DATE` (`BS_DATE`,`BROKER`,`SAHAM`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `broker_sum`
--
ALTER TABLE `broker_sum`
  MODIFY `REC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
