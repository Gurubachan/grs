-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2019 at 12:27 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_grs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

DROP TABLE IF EXISTS `tbl_department`;
CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `dname` varchar(50) NOT NULL,
  `psuid` int(11) DEFAULT NULL,
  `crteatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_division`
--

DROP TABLE IF EXISTS `tbl_division`;
CREATE TABLE `tbl_division` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1',
  `department` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grievence`
--

DROP TABLE IF EXISTS `tbl_grievence`;
CREATE TABLE `tbl_grievence` (
  `id` int(11) NOT NULL,
  `gtype` int(11) DEFAULT NULL,
  `senderid` int(11) DEFAULT NULL,
  `receiverid` int(11) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `referanceno` varchar(50) DEFAULT NULL,
  `source` int(11) DEFAULT NULL,
  `body` text,
  `filelink` varchar(200) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1',
  `ministry` int(11) DEFAULT NULL,
  `psu` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `stid` int(11) DEFAULT NULL,
  `message_type` int(11) DEFAULT NULL,
  `seviourity` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grievence_type`
--

DROP TABLE IF EXISTS `tbl_grievence_type`;
CREATE TABLE `tbl_grievence_type` (
  `id` int(11) NOT NULL,
  `tname` varbinary(50) NOT NULL,
  `crteatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grievence_type`
--

INSERT INTO `tbl_grievence_type` (`id`, `tname`, `crteatedate`, `updatedate`, `entryby`, `updatedby`, `isactive`) VALUES
(1, 0x5472616e73666572, '2019-07-08 00:30:34', NULL, 1, NULL, 1),
(2, 0x5261696c7761792053746f70, '2019-08-16 05:59:53', NULL, 1, NULL, 1),
(3, 0x496e7669746174696f6e, '2019-08-22 18:20:54', NULL, 1, NULL, 1),
(4, 0x4d657373616765, '2019-08-22 22:09:30', NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message_type`
--

DROP TABLE IF EXISTS `tbl_message_type`;
CREATE TABLE `tbl_message_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ministry`
--

DROP TABLE IF EXISTS `tbl_ministry`;
CREATE TABLE `tbl_ministry` (
  `id` int(11) NOT NULL,
  `ministry` varchar(50) NOT NULL,
  `crteatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1',
  `stid` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_psu`
--

DROP TABLE IF EXISTS `tbl_psu`;
CREATE TABLE `tbl_psu` (
  `id` int(11) NOT NULL,
  `psuname` varchar(50) NOT NULL,
  `mid` int(11) DEFAULT NULL,
  `crteatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sender_receiver_address`
--

DROP TABLE IF EXISTS `tbl_sender_receiver_address`;
CREATE TABLE `tbl_sender_receiver_address` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `contact` varchar(10) DEFAULT NULL,
  `emailid` varchar(50) DEFAULT NULL,
  `sendertype` int(11) DEFAULT NULL,
  `crteatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sender_receiver_type`
--

DROP TABLE IF EXISTS `tbl_sender_receiver_type`;
CREATE TABLE `tbl_sender_receiver_type` (
  `id` int(11) NOT NULL,
  `name` varchar(7) NOT NULL,
  `crteatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_send_to`
--

DROP TABLE IF EXISTS `tbl_send_to`;
CREATE TABLE `tbl_send_to` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seviority`
--

DROP TABLE IF EXISTS `tbl_seviority`;
CREATE TABLE `tbl_seviority` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_source`
--

DROP TABLE IF EXISTS `tbl_source`;
CREATE TABLE `tbl_source` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET ucs2 NOT NULL,
  `crteatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

DROP TABLE IF EXISTS `tbl_status`;
CREATE TABLE `tbl_status` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `entryby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `name`, `created_at`, `updated_at`, `entryby`, `updatedby`, `isactive`) VALUES
(1, 'Received', '2019-08-22 20:38:02', NULL, 1, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_division`
--
ALTER TABLE `tbl_division`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `tbl_division_tbl_department_id_fk` (`department`);

--
-- Indexes for table `tbl_grievence`
--
ALTER TABLE `tbl_grievence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_grievence_tbl_department_id_fk` (`department`),
  ADD KEY `tbl_grievence_tbl_ministry_id_fk` (`ministry`),
  ADD KEY `tbl_grievence_tbl_psu_id_fk` (`psu`),
  ADD KEY `tbl_grievence_tbl_send_to_id_fk` (`stid`);

--
-- Indexes for table `tbl_grievence_type`
--
ALTER TABLE `tbl_grievence_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tname` (`tname`);

--
-- Indexes for table `tbl_message_type`
--
ALTER TABLE `tbl_message_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_ministry`
--
ALTER TABLE `tbl_ministry`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ministry` (`ministry`),
  ADD KEY `tbl_ministry_tbl_send_to_id_fk` (`stid`);

--
-- Indexes for table `tbl_psu`
--
ALTER TABLE `tbl_psu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sender_receiver_address`
--
ALTER TABLE `tbl_sender_receiver_address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact` (`contact`),
  ADD UNIQUE KEY `emailid` (`emailid`);

--
-- Indexes for table `tbl_sender_receiver_type`
--
ALTER TABLE `tbl_sender_receiver_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_send_to`
--
ALTER TABLE `tbl_send_to`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_seviority`
--
ALTER TABLE `tbl_seviority`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_source`
--
ALTER TABLE `tbl_source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_division`
--
ALTER TABLE `tbl_division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_grievence`
--
ALTER TABLE `tbl_grievence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_grievence_type`
--
ALTER TABLE `tbl_grievence_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_message_type`
--
ALTER TABLE `tbl_message_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ministry`
--
ALTER TABLE `tbl_ministry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_psu`
--
ALTER TABLE `tbl_psu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sender_receiver_address`
--
ALTER TABLE `tbl_sender_receiver_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sender_receiver_type`
--
ALTER TABLE `tbl_sender_receiver_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_send_to`
--
ALTER TABLE `tbl_send_to`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_seviority`
--
ALTER TABLE `tbl_seviority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_source`
--
ALTER TABLE `tbl_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_division`
--
ALTER TABLE `tbl_division`
  ADD CONSTRAINT `tbl_division_tbl_department_id_fk` FOREIGN KEY (`department`) REFERENCES `tbl_department` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_grievence`
--
ALTER TABLE `tbl_grievence`
  ADD CONSTRAINT `tbl_grievence_tbl_department_id_fk` FOREIGN KEY (`department`) REFERENCES `tbl_department` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_grievence_tbl_ministry_id_fk` FOREIGN KEY (`ministry`) REFERENCES `tbl_ministry` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_grievence_tbl_psu_id_fk` FOREIGN KEY (`psu`) REFERENCES `tbl_psu` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_grievence_tbl_send_to_id_fk` FOREIGN KEY (`stid`) REFERENCES `tbl_send_to` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ministry`
--
ALTER TABLE `tbl_ministry`
  ADD CONSTRAINT `tbl_ministry_tbl_send_to_id_fk` FOREIGN KEY (`stid`) REFERENCES `tbl_send_to` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
