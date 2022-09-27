-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2022 at 12:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idonate`
--

-- --------------------------------------------------------

--
-- Table structure for table `useradmin`
--

CREATE TABLE `useradmin` (
  `uID` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useradmin`
--

INSERT INTO `useradmin` (`uID`, `name`, `email`, `pwdUsers`) VALUES
(1, '', 'rico.littawa@g.batstate-u.edu.ph', 'admin'),
(2, 'rico littawa', 'jeffersondetorres@gmail.com', 'admin'),
(3, 'rico littawa', 'admin@gmail.com', '$2y$10$T40RK6NQD28fvao.gyAmJ.dHrjRozZdaZIfndx7spoyhElDwzSD7u'),
(4, 'admin', 'xyz@email.com', '$2y$10$y6cbjY6Jwzv0kRABk1kl7.J3Hhg.C8Ryq00JxdeBiujTfK.34Le6i'),
(5, 'John Doe', 'try@gmail.com', '$2y$10$/Pj6nhB1tXYN78uQWAqq/.SmEa/Prz73MhLJDkLyRV6iwaGhvRfWi'),
(6, 'Justin Myles', 'test@gmail.com', '$2y$10$fo4NmeYaZNXxQqvM.2Qx.en8zUiNZIILkNUSeSbMOggQISvXQ4EIS'),
(7, 'John Whiskey', 'John@gmail.com', '$2y$10$5Xx5pPMpY8IIWcBaU6CpV.luX1.xqwAj21ntk1xrxzInkZt.O1g.m'),
(8, 'John Hase', 'hase@try.com', '$2y$10$AvU/4PRbNmmpHeBuRBVk9OiaSh96e/oD1liIeMJ2vJdX5P.cIP522');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `useradmin`
--
ALTER TABLE `useradmin`
  ADD PRIMARY KEY (`uID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `useradmin`
--
ALTER TABLE `useradmin`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
