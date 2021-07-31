-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2020 at 02:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `collectionID` int(11) NOT NULL,
  `collectionName` varchar(40) NOT NULL,
  `projectID` int(11) NOT NULL,
  `constructsID` longtext DEFAULT NULL,
  `managerID` int(11) NOT NULL,
  `constructors` varchar(40) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`collectionID`, `collectionName`, `projectID`, `constructsID`, `managerID`, `constructors`, `updated_at`, `created_at`) VALUES
(1, 'lapms', 1, '1:2', 1, NULL, '2020-03-29 15:37:41', '2020-03-29 15:38:06'),
(2, 'speed camera bases', 1, '3:4', 1, NULL, '2020-03-29 15:37:41', '2020-03-29 15:38:06'),
(3, 'fence', 2, '5:6', 1, NULL, '2020-03-29 15:37:41', '2020-03-29 15:38:06'),
(4, 'gate', 2, '7:8', 1, NULL, '2020-03-29 15:37:41', '2020-03-29 15:38:06'),
(5, 'generator building', 3, '9:10', 3, NULL, '2020-03-29 15:37:41', '2020-03-29 15:38:06'),
(6, 'controller room', 3, '11:12', 3, NULL, '2020-03-29 15:37:41', '2020-03-29 15:38:06'),
(7, 'pipe room', 4, '13:14', 3, NULL, '2020-03-29 15:37:41', '2020-03-29 15:38:06'),
(8, 'water loading area', 4, '15:16', 3, NULL, '2020-03-29 15:37:41', '2020-03-29 15:38:06'),
(44, 'service rooms', 20, NULL, 2, 'underground team', '2020-04-04 05:37:23', '2020-04-04 05:37:23'),
(50, 'compound wall', 20, NULL, 2, 'wall Builders', '2020-04-12 09:17:25', '2020-04-12 09:17:25');

-- --------------------------------------------------------

--
-- Table structure for table `constructs`
--

CREATE TABLE `constructs` (
  `constructID` int(11) NOT NULL,
  `constructName` varchar(40) DEFAULT NULL,
  `constructType` varchar(40) DEFAULT NULL,
  `managerID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL,
  `collectionID` int(11) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `status` varchar(11) DEFAULT 'u',
  `imge` varchar(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `report` longtext DEFAULT NULL,
  `reporterID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `constructs`
--

INSERT INTO `constructs` (`constructID`, `constructName`, `constructType`, `managerID`, `projectID`, `collectionID`, `latitude`, `longitude`, `status`, `imge`, `updated_at`, `created_at`, `report`, `reporterID`) VALUES
(1, 'a1', 'lamp', 1, 1, 1, 12, 32, 'a', NULL, '2020-04-13 07:27:28', '2020-03-30 04:02:36', 'good job', 2),
(2, 'a2', 'lamp', 1, 1, 1, 52, 32, 'r', NULL, '2020-04-07 04:49:59', '2020-03-30 04:02:36', 'it\'s in the wrong place', 2),
(3, 'b1', 'speed camera base', 1, 1, 2, 24, 26, 'u', NULL, '2020-03-30 04:02:14', '2020-03-30 04:02:36', NULL, NULL),
(4, 'b2', 'speed camera base', 1, 1, 2, 15, 36, 'u', NULL, '2020-03-30 04:02:14', '2020-03-30 04:02:36', NULL, NULL),
(5, 'c1', 'fence', 1, 2, 3, 10, 11, 'u', NULL, '2020-03-30 04:02:14', '2020-03-30 04:02:36', NULL, NULL),
(6, 'c2', 'fence', 1, 2, 3, 12, 13, 'u', NULL, '2020-03-30 04:02:14', '2020-03-30 04:02:36', NULL, NULL),
(7, 'd1', 'gate', 1, 2, 4, 45, 14, 'u', NULL, '2020-03-30 04:02:14', '2020-03-30 04:02:36', NULL, NULL),
(8, 'd2', 'gate', 1, 2, 4, 21, 32, 'u', NULL, '2020-03-30 04:02:14', '2020-03-30 04:02:36', NULL, NULL),
(9, 'e1', 'generator equipment', 3, 3, 5, 32, 443, 'u', NULL, '2020-03-30 04:02:14', '2020-03-30 04:02:36', NULL, NULL),
(10, 'e2', 'generator equipment', 3, 3, 5, 12, 21, 'u', NULL, '2020-03-30 04:02:14', '2020-03-30 04:02:36', NULL, NULL),
(11, 'f1', 'control panal', 3, 3, 6, 54, 13, 'u', NULL, '2020-03-30 04:02:14', '2020-03-30 04:02:36', NULL, NULL),
(12, 'f2', 'glass shield', 3, 3, 6, 17, 10, 'u', NULL, '2020-03-30 04:02:14', '2020-03-30 04:02:36', NULL, NULL),
(13, 'g1', 'pipes', 3, 4, 7, 43, 32, 'a', NULL, '2020-04-11 07:37:02', '2020-03-30 04:02:36', 'well done', 3),
(14, 'g2', 'valves', 3, 4, 7, 54, 12, 'r', NULL, '2020-04-11 07:37:48', '2020-03-30 04:02:36', 'it is poorly assembled', 3),
(15, 'h1', 'tubes', 3, 4, 8, 342, 12, 'u', NULL, '2020-03-30 04:02:14', '2020-03-30 04:02:36', NULL, NULL),
(16, 'h2', 'runway', 3, 4, 8, 23, 43, 'u', NULL, '2020-03-30 04:02:14', '2020-03-30 04:02:36', NULL, NULL),
(35, 'room1', 'Electric', 2, 20, 44, 11, 11, 'r', NULL, '2020-04-13 07:28:09', '2020-04-05 11:56:00', 'bad job', 2),
(36, 'room2', 'telephone', 2, 20, 44, -15, -53, 'a', NULL, '2020-04-11 07:52:16', '2020-04-07 05:05:13', NULL, 2),
(37, 'room3', 'internet', 2, 20, 44, -89.9999, 90, 'r', NULL, '2020-04-17 11:30:25', '2020-04-07 05:07:45', 'its missing components including:\r\n-wire shielding.\r\n-service steps.', 14);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `managerID` int(11) NOT NULL,
  `inspectorsID` longtext DEFAULT NULL,
  `collections` longtext DEFAULT NULL,
  `sponsorName` varchar(40) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `managerID`, `inspectorsID`, `collections`, `sponsorName`, `updated_at`, `created_at`) VALUES
(1, 'kings road', 1, '1:2', '1:2', 'Jeddah Municipality', NULL, '2020-03-27 14:36:32'),
(2, 'Dock 43', 1, '1', '3:4', 'Almarai', NULL, '2020-03-27 14:36:32'),
(3, 'electric company building', 3, '3:2', '5:6', 'Saudi Electricity Company', NULL, '2020-03-27 14:36:32'),
(4, 'water company building', 3, '3', '7:8', '', NULL, '2020-03-27 14:36:32'),
(20, 'Aramco Compound', 2, NULL, NULL, 'Aramco', '2020-03-30 08:28:08', '2020-03-30 08:28:08'),
(27, 'Funfair', 13, NULL, NULL, 'Al Hokair', '2020-04-04 06:11:58', '2020-04-04 06:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `projects` longtext DEFAULT NULL,
  `reports` longtext DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `pass`, `projects`, `reports`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'gorge', 'gorge@mail.com', '$2y$10$H5pf9PyhsmMRJYHXo1ZALeoEQBhpnRVCOxTuJsSjYvKXm3uqmyoFy', 'test1234', '1:2', NULL, NULL, NULL, '2020-03-25 11:09:48', '2020-03-25 11:09:48'),
(2, 'david', 'david@mail.com', '$2y$10$z3jp2AtXblblcaZBfEpoPOht5vjNrOfLhIymfff.f3UkSRgmKwE5y', 'test1234', '1:20:3:27', NULL, NULL, NULL, '2020-03-25 11:11:00', '2020-04-13 02:35:43'),
(3, 'panos', 'panos@mail.com', '$2y$10$dKQxlbmVy1YfV312l/07h.UM13OgbEf3n0UWB0.g71/64WZTUh3E.', 'test1234', '3:4', NULL, NULL, 'Shu2hNirus03e6Q5Uqpv9RSHCq8akfQ0X7kdJrUqgqYuSjpKkMd1vJOg4NBt', '2020-03-25 11:11:50', '2020-03-25 11:11:50'),
(13, 'test', 'test@test', '$2y$10$ZwvfUIYtyguP.ZPh5miQG.AvDlH1U/S0.ECODz18r3kpZw/utpSY.', 'test1234', '20:27:32', NULL, NULL, NULL, '2020-04-04 05:16:21', '2020-04-09 05:56:18'),
(14, 'john', 'john@mail.com', '$2y$10$Loqi6s9DQcIjZ4xkWoP2Ge/vVDj28HXLesZ.lGCs0EMOZjqM1iZeK', 'test1234', '20', NULL, NULL, NULL, '2020-04-17 11:26:04', '2020-04-17 11:28:18'),
(15, 'bob', 'bob@mail.com', '$2y$10$U8cxOLZw8Eakt64xtdpaFOGrAlfqnr3Mmo1h/I.fPA8bdHzEUhXH2', 'test1234', '', NULL, NULL, NULL, '2020-04-17 11:42:49', '2020-04-17 11:42:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`collectionID`);

--
-- Indexes for table `constructs`
--
ALTER TABLE `constructs`
  ADD PRIMARY KEY (`constructID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `collectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `constructs`
--
ALTER TABLE `constructs`
  MODIFY `constructID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
