-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2022 at 03:49 PM
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
-- Table structure for table `donation_items`
--

CREATE TABLE `donation_items` (
  `donor_id` int(11) NOT NULL,
  `donor_name` longtext NOT NULL,
  `donor_city` longtext NOT NULL,
  `donor_street` longtext NOT NULL,
  `donor_region` longtext NOT NULL,
  `donor_email` longtext NOT NULL,
  `donation_category` longtext NOT NULL,
  `donationDate` date NOT NULL,
  `donation_variant` longtext NOT NULL,
  `donation_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_items`
--

INSERT INTO `donation_items` (`donor_id`, `donor_name`, `donor_city`, `donor_street`, `donor_region`, `donor_email`, `donation_category`, `donationDate`, `donation_variant`, `donation_quantity`) VALUES
(18, 'Ben Salamay', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'Region IV‑A – CALABARZON', 'sample@gmail.com', 'Canned goods, Noodles', '2022-11-01', 'Per Box', 12),
(19, 'rico littawa', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'Region IV‑A – CALABARZON', 'jeffersondetorres@gmail.com', 'clothes', '2022-11-01', 'Pieces', 121),
(20, 'Rico Version2', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'Region IV‑A – CALABARZON', 'ricolittawa030620@gmail.com', 'Canned goods, Noodles', '2022-11-01', 'Per Box', 12),
(21, 'Jobilleen Lopez', 'Batangas', 'Sta Maria Bauan', 'Region IV‑A – CALABARZON', 'jobilleen.lopez@g.batstate-u.edu.ph', 'clothes', '1970-01-01', 'Per Box', 10),
(22, 'Abra Cuta', 'Cebu', 'Noli Me Tangere Street', 'Region VII – Central Visayas', 'xyz@email.com', 'Ready-to-eat goods', '2022-11-02', 'Per Box', 12),
(23, 'Asnor Solaiman', 'Cotobato', '10 Rajah, Tabunaway Blvd, Cotabato City, Maguindanao', 'BARMM – Bangsamoro Autonomous Region in Muslim Mindanao', 'sample@gmail.com', 'Canned goods, Noodles', '2022-11-02', 'Pieces', 12),
(24, 'Ania Detorres', 'Pasig', 'Pasic city Bangbang', 'NCR – National Capital Region', 'sample@gmail.com', 'clothes', '2022-11-02', 'Per Box', 100),
(25, 'Elizabeth De Torres', 'Pasig', 'Pasig City BangBang', 'NCR – National Capital Region', 'xyz@email.com', 'Canned goods, Noodles', '2022-11-02', 'Per Box', 5),
(26, 'Decierlyn Pereda', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'Region IV‑A – CALABARZON', 'decierclyn.pereda@g.batstate-u.edu.ph', 'Canned goods, Noodles', '2022-11-02', 'Pieces', 12),
(27, 'Jobilleen Lopez', 'Bauan', 'Sta Maria Bauan', 'Region IV‑A – CALABARZON', 'jeffersondetorres@gmail.com', 'Hygiene Essentials', '2022-10-31', 'Pieces', 12),
(28, 'superman', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'Region I – Ilocos Region', 'sample@gmail.com', 'Canned goods, Noodles', '2022-11-01', 'Per Box', 12),
(29, 'Mariestella Suarez', 'Batangas', 'San Pascual', 'Region IV‑A – CALABARZON', 'xyz@email.com', 'Canned goods, Noodles', '2022-10-31', 'Pieces', 12),
(30, 'Sample Name', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'Region IV‑A – CALABARZON', 'sample@gmail.com', 'Canned goods, Noodles', '2022-11-02', 'Per Box', 5),
(42, 'Gonda Blues', 'Catbalogan ', 'San Bartolome St', 'Region VIII – Eastern Visayas', ' sample@gmail.com', 'clothes', '2022-11-02', 'Per Box', 100);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `region_id` int(11) NOT NULL,
  `region_name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`region_id`, `region_name`) VALUES
(1, 'Region I – Ilocos Region'),
(2, 'Region II – Cagayan Valley'),
(3, 'Region III – Central Luzon'),
(4, 'Region IV‑A – CALABARZON'),
(5, 'MIMAROPA Region'),
(6, 'Region V – Bicol Region'),
(7, 'Region VI – Western Visayas'),
(8, 'Region VII – Central Visayas'),
(9, 'Region VIII – Eastern Visayas'),
(10, 'Region IX – Zamboanga Peninsula'),
(11, 'Region X – Northern Mindanao'),
(12, 'Region XI – Davao Region'),
(13, 'Region XII – SOCCSKSARGEN'),
(14, 'Region XIII – Caraga'),
(15, 'NCR – National Capital Region'),
(16, 'CAR – Cordillera Administrative Region'),
(17, 'BARMM – Bangsamoro Autonomous Region in Muslim Mindanao');

-- --------------------------------------------------------

--
-- Table structure for table `set_request`
--

CREATE TABLE `set_request` (
  `request_id` int(11) NOT NULL,
  `req_name` longtext NOT NULL,
  `req_city` longtext NOT NULL,
  `req_street` longtext NOT NULL,
  `req_region` varchar(191) NOT NULL,
  `req_email` longtext NOT NULL,
  `req_date` date NOT NULL,
  `req_category` longtext NOT NULL,
  `req_variant` longtext NOT NULL,
  `req_quantity` int(11) NOT NULL,
  `req_note` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `set_request`
--

INSERT INTO `set_request` (`request_id`, `req_name`, `req_city`, `req_street`, `req_region`, `req_email`, `req_date`, `req_category`, `req_variant`, `req_quantity`, `req_note`) VALUES
(31, 'Rico Littawa', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'Region XIII – Caraga', 'rico.littawa@g.batstate-u.edu.ph', '2022-10-31', 'Ready-to-eat goods', 'Per Box', 12, 'this is my note'),
(32, 'Jobilleen Lopez', 'Bauan', 'Sta Maria Bauan', 'Region IV‑A – CALABARZON', 'jeffersondetorres@gmail.com', '2022-10-31', 'Hygiene Essentials', 'Pieces', 12, 'this is my note'),
(33, 'Decierlyn Pereda', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'Region IV‑A – CALABARZON', 'sample@gmail.com', '2022-10-31', 'Canned goods, Noodles', 'Per Box', 2, 'note'),
(34, 'Mariestella Suarez', 'Batangas', 'San Pascual', 'Region IV‑A – CALABARZON', 'xyz@email.com', '2022-10-31', 'Canned goods, Noodles', 'Pieces', 12, 'note'),
(35, 'superman', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'Region I – Ilocos Region', 'sample@gmail.com', '2022-11-01', 'Canned goods, Noodles', 'Per Box', 12, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(36, 'Sample Name', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'Region IV‑A – CALABARZON', 'sample@gmail.com', '2022-11-02', 'Canned goods, Noodles', 'Per Box', 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(37, 'Gonda Blues', 'Catbalogan ', 'San Bartolome St', 'Region VIII – Eastern Visayas', ' sample@gmail.com', '2022-11-02', 'clothes', 'Per Box', 100, 'this is my note');

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
(8, 'John Hase', 'hase@try.com', '$2y$10$AvU/4PRbNmmpHeBuRBVk9OiaSh96e/oD1liIeMJ2vJdX5P.cIP522'),
(9, 'Ben ', 'ben@123.gmail.com', '$2y$10$jNA3t9LqeFmN47bPOk6M6u6EWkd0gCR9SSdbRPhM4oAlLSOQLcCEK'),
(10, 'admin', 'jobs@gmail.com', '$2y$10$xJ4L9r1kka8fWAUkUXIYc.zKBN73nFsQXZPLHumTbpKS75K2R7pdW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donation_items`
--
ALTER TABLE `donation_items`
  ADD PRIMARY KEY (`donor_id`),
  ADD KEY `donationDate` (`donationDate`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`),
  ADD KEY `region_name` (`region_name`(768));

--
-- Indexes for table `set_request`
--
ALTER TABLE `set_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `useradmin`
--
ALTER TABLE `useradmin`
  ADD PRIMARY KEY (`uID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donation_items`
--
ALTER TABLE `donation_items`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `set_request`
--
ALTER TABLE `set_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `useradmin`
--
ALTER TABLE `useradmin`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
