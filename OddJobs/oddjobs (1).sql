-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2017 at 01:37 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oddjobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryId` int(11) NOT NULL,
  `CategoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryId`, `CategoryName`) VALUES
(1, 'Electrician'),
(2, 'Transportation'),
(3, 'Plumbing'),
(4, 'Baby Sitting'),
(5, 'Laundry'),
(6, 'Delivery'),
(7, 'Beauty'),
(8, 'Craftting');

-- --------------------------------------------------------

--
-- Table structure for table `jobapplications`
--

CREATE TABLE `jobapplications` (
  `ApplicationId` int(11) NOT NULL,
  `JobId` int(11) NOT NULL,
  `ApplicantId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobdetail`
--

CREATE TABLE `jobdetail` (
  `JobId` int(11) NOT NULL,
  `JobName` varchar(50) NOT NULL,
  `JobDescription` varchar(1000) NOT NULL,
  `JobCategory` int(11) NOT NULL,
  `MaxPrice` int(11) NOT NULL,
  `MinPrice` int(11) NOT NULL,
  `Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `EmployerId` int(11) NOT NULL,
  `EmployeeId` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'waiting',
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobdetail`
--

INSERT INTO `jobdetail` (`JobId`, `JobName`, `JobDescription`, `JobCategory`, `MaxPrice`, `MinPrice`, `Date`, `EmployerId`, `EmployeeId`, `active`, `status`, `location`) VALUES
(1, 'Plumber Required', 'sad ssa hjgjh khj kjjh kjhk', 3, 200, 50, '2017-04-12 10:41:37', 2, NULL, 0, 'waiting', 'Surat\r\n'),
(2, 'Electrician', 'sad ssa hjgjh khj kjjh kjhk', 1, 2000, 250, '2017-04-12 10:43:54', 1, NULL, 0, 'waiting', 'Mumbai\r\n'),
(3, 'Transportaion', 'sad ssa hjgjh khj kjjh kjhk', 2, 600, 50, '2017-04-12 10:43:54', 3, NULL, 0, 'waiting', 'Delhi\r\n'),
(4, 'Beauty', 'sad ssa hjgjh khj kjjh kjhk', 7, 200, 50, '2017-04-12 10:43:54', 2, NULL, 1, 'waiting', 'Surat\r\n'),
(5, 'Crafting', 'sad ssa hjgjh khj kjjh kjhk', 8, 200, 50, '2017-04-12 10:43:54', 1, NULL, 1, 'waiting', 'Banglore\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `jobnotifications`
--

CREATE TABLE `jobnotifications` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `JobId` int(11) NOT NULL,
  `message` varchar(50) NOT NULL,
  `SeenStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phoneNo` decimal(10,0) NOT NULL,
  `prefferedCategory` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `userRating` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`userId`, `userName`, `email`, `password`, `phoneNo`, `prefferedCategory`, `image`, `userRating`) VALUES
(1, 'mohit sharma', 'mks@gmail.com', 'mohit', '1234567890', 'Electrician, Plumbing', '0', '8'),
(2, 'Rajul Nahar', 'rajul@gmail.com', 'rajul', '9845632175', 'Beauty, Transportation', '0', '9'),
(3, 'Nupur Modi', 'nupur@gmail.com', 'nupur', '9844632123', 'Delivery, Crafting', '0', '8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `jobapplications`
--
ALTER TABLE `jobapplications`
  ADD PRIMARY KEY (`ApplicationId`);

--
-- Indexes for table `jobdetail`
--
ALTER TABLE `jobdetail`
  ADD PRIMARY KEY (`JobId`);

--
-- Indexes for table `jobnotifications`
--
ALTER TABLE `jobnotifications`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `jobapplications`
--
ALTER TABLE `jobapplications`
  MODIFY `ApplicationId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobdetail`
--
ALTER TABLE `jobdetail`
  MODIFY `JobId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jobnotifications`
--
ALTER TABLE `jobnotifications`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
