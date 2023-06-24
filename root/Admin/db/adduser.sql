-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2023 at 04:30 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u321569821_idonate`
--

-- --------------------------------------------------------

--
-- Table structure for table `adduser`
--

CREATE TABLE `adduser` (
  `uID` int(11) NOT NULL,
  `firstname` longtext NOT NULL,
  `lastname` longtext NOT NULL,
  `position` longtext NOT NULL,
  `email` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL,
  `address` longtext NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'offline',
  `profile` longtext DEFAULT NULL,
  `reset_token` mediumtext DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `logged_in` datetime DEFAULT NULL,
  `logged_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adduser`
--

INSERT INTO `adduser` (`uID`, `firstname`, `lastname`, `position`, `email`, `pwdUsers`, `address`, `role`, `status`, `profile`, `reset_token`, `reset_token_expiry`, `logged_in`, `logged_out`) VALUES
(2, 'Normal', 'Person', 'Bgry Captain-Balagtas', 'ricolittawa030620@gmail.com', '$2y$10$xROgcGdUjjdHJiz3huKub.niE0etweo/nE7pq1bfsxZQvb9Y7/VTa', 'Balagtas Batangas City', 'user', 'offline', '2_3619298.jpg', NULL, NULL, '2023-06-24 08:27:44', '2023-06-24 08:31:30'),
(10, 'admin', 'admin1', 'Cdrrmo Employee', 'littawa_rico@yahoo.com', '$2y$10$8VTvoXExJXtYTks0oHVme./l.EwMW3WUshtDwKlvekc80AsOmXbku', 'Balagtas Batangas City', 'admin', 'active', '10_riconew.jpg', '$2y$10$dxo/86J7C7IJRmD/BdNBT.JUnkwUzfilOaNyztvSA7u5In7SgEGFO', '2023-06-21 18:15:23', '2023-06-24 10:10:57', NULL),
(14, 'im a', 'user', 'Bgry Captain-SanPascual', 'rico.littawa@g.batstate-u.edu.ph', '$2y$10$oV.QAmTR2nk4wdFvByRFY.5Ji/MEcKlMutOLU3yCFy7QlBIVbKf.2', 'Balagtas Batangas City', 'user', 'offline', '14_3619298.jpg', '$2y$10$OLml6XBSkmkyOt0jfAw7j.ibT7PTTQSjLz1PfCWAt8JHy6fj5uEgm', '2023-06-24 07:00:21', '2023-06-24 10:10:06', '2023-06-24 10:10:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adduser`
--
ALTER TABLE `adduser`
  ADD PRIMARY KEY (`uID`),
  ADD UNIQUE KEY `constraint_name` (`email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adduser`
--
ALTER TABLE `adduser`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
