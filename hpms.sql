-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2022 at 03:17 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hpms`
--

-- --------------------------------------------------------

--
-- Table structure for table `parking_logs`
--

CREATE TABLE `parking_logs` (
  `PL_ID` int(11) NOT NULL,
  `PARKING_SLOT_ID` int(11) NOT NULL,
  `C_FNAME` varchar(255) NOT NULL,
  `C_LNAME` varchar(255) NOT NULL,
  `PLATE_NUMBER` varchar(20) NOT NULL,
  `PARKING_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `PARKING_TIME_OUT` varchar(255) DEFAULT NULL,
  `PAYMENT` double DEFAULT NULL,
  `PL_STATUS` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parking_logs`
--

INSERT INTO `parking_logs` (`PL_ID`, `PARKING_SLOT_ID`, `C_FNAME`, `C_LNAME`, `PLATE_NUMBER`, `PARKING_TIME`, `PARKING_TIME_OUT`, `PAYMENT`, `PL_STATUS`) VALUES
(6, 3, 'KEVIN', 'CALUAG', '12345', '2022-11-09 01:29:04', '2022-11-09 09:57:06', 0, 0),
(7, 3, 'kajo', 'biglang-awa', '2552', '2022-11-08 22:58:48', '2022-11-09 09:59:38', 90, 0),
(8, 6, 'rj', 'kahitano', '5555', '2022-11-08 22:06:06', '2022-11-09 10:08:13', 120, 0);

-- --------------------------------------------------------

--
-- Table structure for table `parking_slot`
--

CREATE TABLE `parking_slot` (
  `PS_ID` int(11) NOT NULL,
  `PARKING_NAME` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL,
  `PS_STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parking_slot`
--

INSERT INTO `parking_slot` (`PS_ID`, `PARKING_NAME`, `DESCRIPTION`, `PS_STATUS`) VALUES
(3, 'PARKING 1', 'BOSS KEVZ', 0),
(6, 'PARKING 4', 'PARKING 4', 0),
(7, 'PARKING 100', 'ASDASDASDASDASDAS 100', 0),
(8, 'PARKING 1', 'PARKING 1 akmdkamskldmasd', 0),
(9, 'PARKING 4', 'PARKING 4', 0),
(10, 'PARKING 100', 'ASDASDASDASDASDAS 100', 0),
(11, 'PARKING 1', 'PARKING 1 akmdkamskldmasd', 0),
(12, 'PARKING 4', 'PARKING 4', 0),
(13, 'PARKING 100', 'ASDASDASDASDASDAS 100', 0),
(14, 'PARKING 1', 'PARKING 1 akmdkamskldmasd', 0),
(15, 'PARKING 4', 'PARKING 4', 0),
(16, 'PARKING 100', 'ASDASDASDASDASDAS 100', 0),
(17, 'PARKING 1', 'PARKING 1 akmdkamskldmasd', 0),
(18, 'PARKING 4', 'PARKING 4', 0),
(19, 'PARKING 100', 'ASDASDASDASDASDAS 100', 0),
(20, 'PARKING 1', 'PARKING 1 akmdkamskldmasd', 0),
(21, 'PARKING 4', 'PARKING 4', 0),
(22, 'PARKING 100', 'ASDASDASDASDASDAS 100', 0),
(23, 'PARKING 1', 'PARKING 1 akmdkamskldmasd', 0),
(24, 'PARKING 4', 'PARKING 4', 0),
(25, 'PARKING 100', 'ASDASDASDASDASDAS 100', 0),
(26, 'PARKING 1', 'PARKING 1 akmdkamskldmasd', 0),
(27, 'PARKING 4', 'PARKING 4', 0),
(28, 'PARKING 100', 'ASDASDASDASDASDAS 100', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `ROLENAME` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ID`, `ROLENAME`) VALUES
(1, 'ADMINISTRATOR'),
(2, 'EMPLOYEES');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `ROLE_ID` int(11) NOT NULL,
  `FNAME` varchar(255) NOT NULL,
  `LNAME` varchar(255) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `CONTACT` varchar(11) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `ROLE_ID`, `FNAME`, `LNAME`, `ADDRESS`, `CONTACT`, `USERNAME`, `PASSWORD`) VALUES
(6, 2, 'kevin', 'felix', 'bago', '465789907', 'superadmin', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parking_logs`
--
ALTER TABLE `parking_logs`
  ADD PRIMARY KEY (`PL_ID`),
  ADD KEY `pl_customer_id` (`C_FNAME`),
  ADD KEY `pl_parking_slot_id` (`PARKING_SLOT_ID`);

--
-- Indexes for table `parking_slot`
--
ALTER TABLE `parking_slot`
  ADD PRIMARY KEY (`PS_ID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`),
  ADD KEY `users_role_id` (`ROLE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parking_logs`
--
ALTER TABLE `parking_logs`
  MODIFY `PL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parking_slot`
--
ALTER TABLE `parking_slot`
  MODIFY `PS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parking_logs`
--
ALTER TABLE `parking_logs`
  ADD CONSTRAINT `pl_parking_slot_id` FOREIGN KEY (`PARKING_SLOT_ID`) REFERENCES `parking_slot` (`PS_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id` FOREIGN KEY (`ROLE_ID`) REFERENCES `roles` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
