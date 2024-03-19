-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2022 at 09:42 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `egaming`
--

-- --------------------------------------------------------

--
-- Table structure for table `bundles`
--

CREATE TABLE `bundles` (
  `ID` int(10) NOT NULL,
  `name` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `bundle_hours` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `bun_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `internetcafe`
--

CREATE TABLE `internetcafe` (
  `HostID` int(10) NOT NULL,
  `hostuser` varchar(255) NOT NULL,
  `hostpass` varchar(255) NOT NULL,
  `cybername` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `all_seats` int(11) NOT NULL,
  `activated` int(11) NOT NULL DEFAULT 0 COMMENT 'if 1 then user is activated 0 is not activated',
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `internetcafe`
--

INSERT INTO `internetcafe` (`HostID`, `hostuser`, `hostpass`, `cybername`, `email`, `location`, `images`, `all_seats`, `activated`, `date`) VALUES
(79, 'galaxy', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Galaxy Gaming', 'hazemyaser321@gmail.com', 'maadi', 'IMG-62b760796ca081.35395204.jpg', 7, 1, '2022-06-25');

-- --------------------------------------------------------

--
-- Table structure for table `resetpasswords`
--

CREATE TABLE `resetpasswords` (
  `code` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `userID` int(12) NOT NULL,
  `host_id` int(11) NOT NULL,
  `seat_booked` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL COMMENT 'users ID',
  `username` varchar(255) NOT NULL COMMENT 'display name',
  `PW` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(20) NOT NULL,
  `groupID` int(25) NOT NULL DEFAULT 0 COMMENT 'user or admin',
  `fullname` varchar(255) NOT NULL COMMENT 'user real name',
  `date` date NOT NULL DEFAULT current_timestamp(),
  `activation` int(10) NOT NULL DEFAULT 0 COMMENT 'Activate Hosts',
  `hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `PW`, `email`, `age`, `groupID`, `fullname`, `date`, `activation`, `hours`) VALUES
(3000, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'hazemyaser@yahoo.com', 21, 1, 'Hazem Yaser', '2022-05-11', 1, 0),
(3031, 'hazem', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'hazemyaser123@gmail.com', 22, 0, 'hazem yaser', '2022-06-25', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bundles`
--
ALTER TABLE `bundles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `internetcafe`
--
ALTER TABLE `internetcafe`
  ADD PRIMARY KEY (`HostID`),
  ADD UNIQUE KEY `hostuser` (`hostuser`);

--
-- Indexes for table `resetpasswords`
--
ALTER TABLE `resetpasswords`
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `key_2` (`host_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bundles`
--
ALTER TABLE `bundles`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `internetcafe`
--
ALTER TABLE `internetcafe`
  MODIFY `HostID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'users ID', AUTO_INCREMENT=3032;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `key` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `key_2` FOREIGN KEY (`host_id`) REFERENCES `internetcafe` (`HostID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
