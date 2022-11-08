-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2022 at 03:55 PM
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
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `ID` int(11) NOT NULL,
  `C_FNAME` varchar(255) NOT NULL,
  `C_LNAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`ID`, `C_FNAME`, `C_LNAME`) VALUES
(1, 'kevin', 'caluag');

-- --------------------------------------------------------

--
-- Table structure for table `parking_logs`
--

CREATE TABLE `parking_logs` (
  `ID` int(11) NOT NULL,
  `PARKING_SLOT_ID` int(11) NOT NULL,
  `CUSTOMER_ID` int(11) NOT NULL,
  `PLATE_NUMBER` varchar(20) NOT NULL,
  `PARKING_TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PARKING_TIME_OUT` date DEFAULT NULL,
  `PAYMENT` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `parking_slot`
--

CREATE TABLE `parking_slot` (
  `ID` int(11) NOT NULL,
  `PARKING_NAME` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parking_slot`
--

INSERT INTO `parking_slot` (`ID`, `PARKING_NAME`, `DESCRIPTION`) VALUES
(1, 'PARKING SLOT 1', 'PARKING SLOT 1'),
(2, 'PARKING SLOT 2', 'PARKING SLOT 2');

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
  `ID` int(11) NOT NULL,
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

INSERT INTO `users` (`ID`, `ROLE_ID`, `FNAME`, `LNAME`, `ADDRESS`, `CONTACT`, `USERNAME`, `PASSWORD`) VALUES
(1, 1, 'ARJAY', 'SIMBULAN', 'CONCEPCION', '09566851357', 'ARJAY2022', 'PASSWORD'),
(2, 2, 'KEVIN', 'FELIX', 'ASDASASD', '09566851357', 'ARJAY2022s', 'PASSWORD'),
(3, 2, 'KEVINs', 'FELIXs', 'ASDASASDs', '09566851357', 'ARJAY2022ss', 'PASSWORDs'),
(4, 2, 'JOMARI', 'MALLARE', 'SAMPAGUITA', '234567890-', 'JOMS', 'PASSWORD'),
(5, 2, 'asdjn', 'jknkjnj', 'knkjnkjnk', 'jnkjnjknkj', 'nkjnkjnkjnk', 'jnjknkjnjkn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `parking_logs`
--
ALTER TABLE `parking_logs`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `pl_customer_id` (`CUSTOMER_ID`),
  ADD KEY `pl_parking_slot_id` (`PARKING_SLOT_ID`);

--
-- Indexes for table `parking_slot`
--
ALTER TABLE `parking_slot`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `users_role_id` (`ROLE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parking_logs`
--
ALTER TABLE `parking_logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parking_slot`
--
ALTER TABLE `parking_slot`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parking_logs`
--
ALTER TABLE `parking_logs`
  ADD CONSTRAINT `pl_customer_id` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `customers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pl_parking_slot_id` FOREIGN KEY (`PARKING_SLOT_ID`) REFERENCES `parking_slot` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id` FOREIGN KEY (`ROLE_ID`) REFERENCES `roles` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
