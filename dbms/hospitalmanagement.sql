-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2017 at 06:48 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospitalmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `AID` int(5) NOT NULL,
  `DID` varchar(10) NOT NULL,
  `PID` varchar(10) NOT NULL,
  `pemail` varchar(60) NOT NULL,
  `demail` varchar(60) NOT NULL,
  `comments` varchar(1000) NOT NULL,
  `bdate` date NOT NULL,
  `btime` varchar(50) NOT NULL,
  `DT` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`AID`, `DID`, `PID`, `pemail`, `demail`, `comments`, `bdate`, `btime`, `DT`) VALUES
(119, '1000', '4100', 'v@v.com', 'abc@doctor.com', 'hjhj', '2017-09-27', '8:00-8:30', '2017-09-27,8:00-8:30'),
(120, '1000', '4100', 'v@v.com', 'abc@doctor.com', 'hjhj', '2017-09-23', '12:00-12:30', '2017-09-23,12:00-12:30');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `DID` int(10) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(60) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `stime` int(5) NOT NULL,
  `etime` int(5) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`DID`, `name`, `email`, `qualification`, `stime`, `etime`, `specialization`, `password`) VALUES
(1000, 'ABC', 'abc@doctor.com', 'MBBS, MD', 7, 15, 'skin', 'abc'),
(1002, 'vishal aggarwal ', 'vishal@vishal.com', 'MBBS', 10, 18, 'SKIN, ALLERGIES', 'vishal'),
(1006, 'vishal', 'vishal@gmail.com', 'MD', 9, 17, 'cancer', 'vishal'),
(1010, 'satyam kumar', 'satyam@gmail.com', 'MBBS, MD', 12, 16, '	cardio(heart)', 'satyam');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `PID` int(100) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `bloodGroup` varchar(10) NOT NULL,
  `height` int(10) NOT NULL,
  `weight` int(10) NOT NULL,
  `bloodPressure` int(10) NOT NULL,
  `DOB` date NOT NULL,
  `alchoholic` varchar(10) NOT NULL,
  `smoker` varchar(10) NOT NULL,
  `diabetic` varchar(10) NOT NULL,
  `gender` text NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`PID`, `name`, `email`, `mobile`, `address`, `bloodGroup`, `height`, `weight`, `bloodPressure`, `DOB`, `alchoholic`, `smoker`, `diabetic`, `gender`, `password`) VALUES
(4100, 'vishal aggarwal', 'v@v.com', '9210722128', 'A-151/6 Deoli Extn New Delhi 110080', 'O+', 165, 58, 80, '1993-08-12', '1', '', '1', 'male', 'vishal'),
(4101, 'someone', 'some@one.com', '7532989469', 'some where some block', 'A-', 180, 70, 70, '1985-12-06', '1', '1', '', 'male', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`AID`),
  ADD UNIQUE KEY `DT` (`DT`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`DID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`PID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `AID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `DID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `PID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4102;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
