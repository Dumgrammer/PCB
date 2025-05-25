-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2025 at 11:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaidyamitra`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `aname` varchar(255) NOT NULL,
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `aname`, `aemail`, `apassword`) VALUES
(1, 'Gina F. Acuña', 'ginaacuna@pcb.edu.ph', 'gina2025z');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appoid` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `pid` int(10) DEFAULT NULL,
  `apponum` varchar(255) DEFAULT NULL,
  `scheduleid` int(10) DEFAULT NULL,
  `appodate` date DEFAULT NULL,
  `reason` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `img`, `pid`, `apponum`, `scheduleid`, `appodate`, `reason`) VALUES
(6, '', 76, '20250523054624884', 21, '2025-05-24', 'Rest'),
(7, '', 76, '20250523060637857', 22, '2025-05-25', 'checkup'),
(8, '', 76, '20250523060739966', 23, '2025-05-24', 'check'),
(9, '', 76, '20250523071120477', 24, '2025-05-24', 'n'),
(10, '', 77, '20250523072503799', 25, '2025-05-23', 'checkup'),
(12, '', 79, '20250525090316484', 27, '2025-05-26', 'HAHAH it works');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `docid` int(11) NOT NULL,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `specialties` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`) VALUES
(4, 'ginaacuna@gmail.com', 'Gina F. Acuña', 'GINA2025', '1122222', '09956767213', 'Dentist'),
(15, 'bastianlacap55@gmail.com', 'Karl Bastian Cunanan Lacap', 'Tsudoishi3', '12312312', '09949282036', 'Dentist');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `item_name`, `quantity`, `date`, `status`) VALUES
(8, 'adhesive bandages', 5, '2025-05-23', 'available'),
(9, 'thermometer', 1, '2025-05-23', 'available'),
(10, 'CPR face shield/mask', 5, '2025-05-23', 'available'),
(11, 'dispossable gloves', 5, '2025-05-23', 'available'),
(12, 'medical tape', 5, '2025-05-23', 'available'),
(13, 'cotton balls', 30, '2025-05-23', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `appoid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `medicine` varchar(255) NOT NULL,
  `dosage` varchar(255) DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `date_given` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `appoid`, `pid`, `medicine`, `dosage`, `instructions`, `date_given`) VALUES
(4, 6, 76, 'Tempra', 'Test', '1x a daay', '2025-05-23 11:47:02'),
(5, 0, 0, '', '10', '', '2025-05-23 12:07:12'),
(6, 0, 0, '', '222', '', '2025-05-23 14:03:25'),
(7, 0, 0, '', '3', '', '2025-05-23 14:04:00'),
(8, 0, 0, '', '22', '', '2025-05-23 14:11:44'),
(9, 0, 0, '', '12312', '', '2025-05-23 14:45:03'),
(10, 0, 0, '', '15', '', '2025-05-23 16:34:46'),
(11, 0, 0, '', '15', '', '2025-05-23 16:38:37'),
(12, 0, 0, '', '10', '', '2025-05-24 21:54:53'),
(13, 0, 0, '', '50', '', '2025-05-25 13:55:40'),
(14, 0, 0, '', '50', '', '2025-05-25 13:58:19'),
(19, 81, 79, 'Tempra', '50', 'Test', '2025-05-25 14:57:20'),
(21, 81, 79, 'Paracetamol', '50', 'Test', '2025-05-25 15:00:13'),
(22, 12, 79, 'unilab', '25mg', 'One hundrd', '2025-05-25 15:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `expiration_date` date NOT NULL,
  `generic_name` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `brand`, `quantity`, `expiration_date`, `generic_name`, `dosage`) VALUES
(1, 'unilab', 10, '2025-05-31', 'neozep', '15'),
(2, 'Paracetamol', 10, '2026-01-01', 'Bioflu', '25mg'),
(94, 'Tempra', 2, '2025-06-01', 'Syrup', '50');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_category`
--

CREATE TABLE `medicine_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_category`
--

INSERT INTO `medicine_category` (`id`, `category`) VALUES
(1, 'Drug'),
(2, '1'),
(3, '1'),
(4, '1'),
(5, '1'),
(6, '1'),
(20, 'skelan'),
(30, 'skelan'),
(60, 'paracetamol');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `pemail` varchar(255) DEFAULT NULL,
  `ppassword` varchar(255) DEFAULT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(11) DEFAULT NULL,
  `pbarangay` varchar(255) NOT NULL,
  `pcity` varchar(255) NOT NULL,
  `pprovince` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `pemail`, `ppassword`, `pdob`, `ptel`, `pbarangay`, `pcity`, `pprovince`, `fname`, `mname`, `lname`, `student_id`, `image`, `course`) VALUES
(79, 'danicacasimiro@pcb.edu.ph', '$2y$10$SwWwWtY.YbzKSZfgyMvaFe1MzZIZqf39/voNBHfawC7e8YWuSnjI6', '2025-05-01', '09285753858', 'porac', 'narnia', 'Zambales', 'Danica', 'Dial', 'Casimiro', '21-00575', '90f449eff80861a5b9b8b3bf036c996b.jpg', ''),
(80, 'kristeljoysalinas@pcb.edu.ph', '$2y$10$bBnDvI4/LfD3S3SE2YP5junEq4F1.VGWZahve3ws1qEx8SYjzPJTW', '1992-10-21', '09098761161', 'Taugtog', 'Botolan', 'Zambales', 'Joy', 'dante', 'Salinas', '25-54541', '6372e10de978ba014a428005d4eb166a.jpg', ''),
(84, 'bastianlacap55@pcb.edu.ph', '$2y$10$x7l1uKawCy1BqPMl1dfWPubekiu.RDr8godDfZMWNMv8KFJYW9OJa', '2003-11-25', '09949282036', 'Palis', 'Botolan', 'Zambales', 'Karl Bastian', 'Cunanan', 'Lacap', '19-0054', '19-0054_1748163247.png', 'BSIT');

-- --------------------------------------------------------

--
-- Table structure for table `pending_patient`
--

CREATE TABLE `pending_patient` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('pending','approved','declined') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `fname` varchar(100) DEFAULT NULL,
  `mname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(11) DEFAULT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `pbarangay` varchar(100) DEFAULT NULL,
  `pprovince` varchar(100) DEFAULT NULL,
  `pcity` varchar(100) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int(11) NOT NULL,
  `docid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`) VALUES
(1, '2', 'Regular Checkup', '2023-07-09', '11:30:00', 5),
(2, '4', 'Chest pain', '2025-05-23', '02:44:00', NULL),
(3, '4', 'Testing', '2025-05-23', '04:00:00', NULL),
(4, '4', 'Testing', '2025-05-24', '03:17:00', NULL),
(5, '4', 'Test', '2025-05-23', '03:58:00', NULL),
(6, '4', 'test', '2025-05-24', '11:40:00', NULL),
(7, '4', 'test', '2025-05-24', '11:40:00', NULL),
(8, '4', 'test', '2025-05-24', '11:40:00', NULL),
(9, '4', 'Test', '2025-05-23', '23:46:00', NULL),
(10, '4', 'Test', '2025-05-23', '23:46:00', NULL),
(11, '4', 'Test', '2025-05-23', '23:46:00', NULL),
(12, '4', 'Test', '2025-05-23', '23:46:00', NULL),
(13, '4', 'Test', '2025-05-23', '23:46:00', NULL),
(14, '4', 'Rest', '2025-05-24', '11:48:00', NULL),
(15, '4', 'Rest', '2025-05-24', '11:48:00', NULL),
(16, '4', 'Rest', '2025-05-24', '11:48:00', NULL),
(17, '4', 'Rest', '2025-05-24', '11:48:00', NULL),
(18, '4', 'Rest', '2025-05-24', '11:48:00', NULL),
(19, '4', 'Rest', '2025-05-24', '11:48:00', NULL),
(20, '4', 'Rest', '2025-05-24', '11:48:00', NULL),
(21, '4', 'Rest', '2025-05-24', '11:48:00', NULL),
(22, '4', 'checkup', '2025-05-25', '03:00:00', NULL),
(23, '4', 'check', '2025-05-24', '03:00:00', NULL),
(24, '4', 'n', '2025-05-24', '07:07:00', NULL),
(25, '4', 'checkup', '2025-05-23', '08:00:00', NULL),
(26, '4', 'Test', '2025-05-25', '14:50:00', NULL),
(27, '4', 'HAHAH it works', '2025-05-26', '19:15:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `id` int(255) NOT NULL,
  `sname` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `sname`) VALUES
(1, 'Nurse'),
(2, 'Doctor'),
(3, 'Dentist');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('ginaacuna@pcb.edu.ph', 'a'),
('kristeljoysalinas@pcb.edu.ph', 'p'),
('danicacasimiro@pcb.edu.ph', 'p'),
('bastianlacap55@pcb.edu.ph', 'p'),
('bastianlacap55@gmail.com', 'a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appoid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `scheduleid` (`scheduleid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`docid`),
  ADD KEY `specialties` (`specialties`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_category`
--
ALTER TABLE `medicine_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `pending_patient`
--
ALTER TABLE `pending_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`),
  ADD KEY `docid` (`docid`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `medicine_category`
--
ALTER TABLE `medicine_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `pending_patient`
--
ALTER TABLE `pending_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
