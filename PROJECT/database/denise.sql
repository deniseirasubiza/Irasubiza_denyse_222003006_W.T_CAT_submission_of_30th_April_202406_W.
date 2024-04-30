-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 12:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `denise`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(12) NOT NULL,
  `bookingdateandtime` date NOT NULL,
  `numberofticket` int(12) NOT NULL,
  `totalprice` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `bookingdateandtime`, `numberofticket`, `totalprice`) VALUES
(8, '2023-09-29', 20, 81),
(9, '2024-04-29', 3, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventid` int(11) NOT NULL,
  `eventname` varchar(40) NOT NULL,
  `eventdate` date NOT NULL,
  `eventtime` int(11) NOT NULL,
  `eventlocation` varchar(30) NOT NULL,
  `eventdescription` varchar(50) NOT NULL,
  `eventcapacity` varchar(30) NOT NULL,
  `ticketprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventid`, `eventname`, `eventdate`, `eventtime`, `eventlocation`, `eventdescription`, `eventcapacity`, `ticketprice`) VALUES
(7, 'shallom concert', '2024-04-29', 3, 'dove', 'live recording', '10000', 4000),
(2, 'chryso concert', '2024-04-29', 3, 'arena', 'praiseandworship', '1000000', 5000),
(9, 'ghj', '2024-04-16', 87, 'ghj', 'ghj', '7', 6),
(9, 'ghj', '2024-04-16', 87, 'ghj', 'ghj', '7', 6),
(9, 'ghj', '2024-04-16', 87, 'ghj', 'ghj', '7', 6),
(5, 'we', '2024-04-29', 34, 'e', 're', '3', 23),
(10, 'denyse', '2024-04-30', 3, 're', 'praiseandworship', '20000', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notificationid` int(11) NOT NULL,
  `notificationtype` varchar(30) NOT NULL,
  `notificationmessage` varchar(50) NOT NULL,
  `notificationdateandtime` date NOT NULL,
  `notificationstatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notificationid`, `notificationtype`, `notificationmessage`, `notificationdateandtime`, `notificationstatus`) VALUES
(3, 'confirm', 'success', '2024-04-30', 'confirmed'),
(7, 'confirm', 'success', '2024-04-30', 'pending'),
(9, 'success', 'payment', '2024-04-29', 'yes'),
(10, 'denyse', 'we', '2024-05-01', 'yii');

--
-- Triggers `notification`
--
DELIMITER $$
CREATE TRIGGER `AfterUpdatenotification` AFTER UPDATE ON `notification` FOR EACH ROW BEGIN
    INSERT INTO notification (notificationid, userid,notificationtype,notificationmessage ,notificationDateTime, notificationstatus)
    VALUES (NEW.notificationid, 'notification Updated', NOW(), INET6_ATON('127.0.0.1'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentid` int(11) NOT NULL,
  `paymentdateandtime` date DEFAULT NULL,
  `paymentamount` int(11) DEFAULT NULL,
  `paymentmethod` varchar(40) DEFAULT NULL,
  `transactionstatus` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentid`, `paymentdateandtime`, `paymentamount`, `paymentmethod`, `transactionstatus`) VALUES
(1, '2024-04-29', 30000, 'momo', 'pending'),
(2, '2024-09-29', 20000, 'creditcard', 'pending'),
(5, '2024-04-15', 1, 'momo', 'pending'),
(8, '2024-04-29', 7, 'nm', 'gt');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportid` int(11) NOT NULL,
  `reporttype` varchar(50) NOT NULL,
  `reportgenerationdateandtime` date DEFAULT NULL,
  `reportcontent` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`reportid`, `reporttype`, `reportgenerationdateandtime`, `reportcontent`) VALUES
(7, 'ghj', '2024-04-29', 'hjk'),
(7, 'ghj', '2024-04-29', 'hjk'),
(4, 'rrrr', '2024-04-04', 'dfgh'),
(4, 'rrrr', '2024-04-04', 'dfgh'),
(4, 'gfdsdfg', '2024-04-05', 'hgfds'),
(5, 'ghj', '2024-04-22', 'we');

-- --------------------------------------------------------

--
-- Table structure for table `update_user_information`
--

CREATE TABLE `update_user_information` (
  `userid` int(11) DEFAULT NULL,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phonenumber` int(11) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'denize', 'irasubiza', 'peace', 'cle@gmail.com', '0785081814', '$2y$10$1V0hGPkOR9F8GkhoJH8nsuWCeRnbxKiqNiyHxukmtDL.v/4/pcQ5S', '2024-04-26 15:23:23', '1', 0),
(2, 'denize', 'irasubiza', 'denize', 'denize@gmail', '0785081814', '$2y$10$50BVoZB2k6//vA7aJ6n.xOQud3JHRhUQFOkrxDSI2UuQP90nvC726', '2024-04-26 15:25:26', '1', 0),
(4, 'peace', 'igiraneza', 'pp', 'peace@gmail.com', '0785081814', '$2y$10$alzRe12Ye2cNOP3JFNGsUui57tRWvqFRT5GOYuUh0JOoXl2VFTK1S', '2024-04-29 07:54:05', '1', 0),
(5, 'mm', 'mn', 'yy', 'gi@gmail.com', '0785081814', '$2y$10$5r.NJmaQ91R.r3.ktDKbnuSWOgqyV9Mx/IQYssXrGyiRpEx0vfxgO', '2024-04-30 07:31:45', '7', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notificationid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notificationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
