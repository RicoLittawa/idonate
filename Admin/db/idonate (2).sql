-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2022 at 11:12 PM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categ_id` int(11) NOT NULL,
  `category` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categ_id`, `category`) VALUES
(1, 'Ready-to-eat goods'),
(2, 'Canned goods, Noodles'),
(3, 'Clothes'),
(4, 'Hygiene Essentials'),
(5, 'Infant Items'),
(6, 'Drinking water'),
(7, 'First Aid Kits'),
(8, 'Medicine'),
(9, 'Tents and shelter materials'),
(10, 'Sleeping kits'),
(11, 'N95 masks'),
(12, 'Nebulizer kits'),
(13, 'Cash Donations');

-- --------------------------------------------------------

--
-- Table structure for table `donation_items`
--

CREATE TABLE `donation_items` (
  `donor_id` int(11) NOT NULL,
  `donor_name` longtext NOT NULL,
  `donor_province` longtext NOT NULL,
  `donor_street` longtext NOT NULL,
  `donor_email` longtext NOT NULL,
  `donor_region` longtext NOT NULL,
  `donationDate` date NOT NULL,
  `donation_category` longtext NOT NULL,
  `donation_variant` longtext NOT NULL,
  `donation_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_items`
--

INSERT INTO `donation_items` (`donor_id`, `donor_name`, `donor_province`, `donor_street`, `donor_email`, `donor_region`, `donationDate`, `donation_category`, `donation_variant`, `donation_quantity`) VALUES
(44, 'rico littawa', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'sample@gmail.com', 'Region IV‑A – CALABARZON', '2022-11-03', 'Canned goods, Noodles', 'Per-box', 12),
(45, 'wendel', 'Batangas', 'Rosario Batangas', 'jeffersondetorres@gmail.com', 'Region IV‑A – CALABARZON', '2022-11-03', 'Infant Items', 'Per-box', 5),
(46, 'Jobilleen Lopez', 'Batangas', 'Sta Maria Bauan', 'rico.littawa@g.batstate-u.edu.ph', 'Region IV‑A – CALABARZON', '2022-11-03', 'Hygiene Essentials', 'Per-box', 4),
(47, 'Jobilleen Lopez', 'Batangas', 'Sta Maria Bauan', 'rico.littawa@g.batstate-u.edu.ph', 'Region IV‑A – CALABARZON', '2022-11-03', 'Hygiene Essentials', 'Per-box', 4),
(48, 'Jobilleen Lopez', 'Batangas', 'Sta Maria Bauan', 'rico.littawa@g.batstate-u.edu.ph', 'Region IV‑A – CALABARZON', '2022-11-03', 'Hygiene Essentials', 'Per-box', 4),
(49, 'Justin Gaethji', 'Cebu', 'Cebu', 'rico.littawa@g.batstate-u.edu.ph', 'Region VII – Central Visayas', '2022-11-06', 'Cash Donations', 'Money', 1500),
(51, 'This is my name', 'cebu', 'cebu', 'try@gmail.com', 'Region VII – Central Visayas', '2022-11-05', 'Cash Donations', 'Money', 200),
(52, 'teslaan', 'batangas', 'Balagtas Sitio 7 Tramo Pulo', 'try@gmail.com', 'Region IV‑A – CALABARZON', '2022-11-05', 'Cash Donations', 'Money', 121),
(53, 'Justin Gaethji', 'Cebu', 'Cebu', 'rico.littawa@g.batstate-u.edu.ph', 'Region VII – Central Visayas', '2022-11-06', 'Cash Donations', 'Money', 1500),
(54, 'Conor Mc Gregor', 'Mindoro', 'Mindoro Sample Street', 'jeffersondetorres@gmail.com', 'MIMAROPA Region', '2022-11-06', 'Cash Donations', 'Money', 1000),
(55, 'Conor Mc Gregor', 'Mindoro', 'Mindoro Sample Street', 'jeffersondetorres@gmail.com', 'MIMAROPA Region', '2022-11-06', 'Cash Donations', 'Money', 1000),
(56, 'deser pereda', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'decierclyn.pereda@g.batstate-u.edu.ph', 'Region IV‑A – CALABARZON', '2022-11-06', 'Nebulizer kits', 'Per-pieces', 56),
(57, 'deser', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'decierclyn.pereda@g.batstate-u.edu.ph', 'Region IV‑A – CALABARZON', '2022-11-06', 'Clothes', 'Per-box', 5),
(58, 'teslaan', 'batangas', 'Balagtas Sitio 7 Tramo Pulo', 'try@gmail.com', 'Region IV‑A – CALABARZON', '2022-11-05', 'Cash Donations', 'Money', 121);

-- --------------------------------------------------------

--
-- Table structure for table `monetary_donations`
--

CREATE TABLE `monetary_donations` (
  `money_id` int(11) NOT NULL,
  `money_name` longtext NOT NULL,
  `money_province` longtext NOT NULL,
  `money_street` longtext NOT NULL,
  `money_region` longtext NOT NULL,
  `money_contact` int(11) NOT NULL,
  `money_email` longtext NOT NULL,
  `money_date` date NOT NULL,
  `money_reference` int(11) NOT NULL,
  `money_img` longtext NOT NULL,
  `money_amount` int(11) NOT NULL,
  `money_note` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monetary_donations`
--

INSERT INTO `monetary_donations` (`money_id`, `money_name`, `money_province`, `money_street`, `money_region`, `money_contact`, `money_email`, `money_date`, `money_reference`, `money_img`, `money_amount`, `money_note`) VALUES
(7, 'Rico Littawa', 'Batangas', 'Balagtas Sitio 7 Tramo Pulo', 'Region IV‑A – CALABARZON', 2147483647, 'try@gmail.com', '2022-11-05', 2147483647, 'wp7540845.jpg', 1000, 'note'),
(9, 'teslaan', 'batangas', 'Balagtas Sitio 7 Tramo Pulo', 'Region IV‑A – CALABARZON', 2147483647, 'try@gmail.com', '2022-11-05', 2147483647, 'minimalist.png', 121, 'note'),
(10, 'This is my name', 'cebu', 'cebu', 'Region VII – Central Visayas', 123213213, 'try@gmail.com', '2022-11-05', 2147483647, 'pngegg.png', 200, 'note'),
(11, 'Justin Gaethji', 'Cebu', 'Cebu', 'Region VII – Central Visayas', 123456789, 'rico.littawa@g.batstate-u.edu.ph', '2022-11-06', 123456789, '313895431_497548282348938_2363266253948085506_n.jpg', 1500, 'its from gcash'),
(12, 'Conor Mc Gregor', 'Mindoro', 'Mindoro Sample Street', 'MIMAROPA Region', 2147483647, 'jeffersondetorres@gmail.com', '2022-11-06', 123456789, '313895431_497548282348938_2363266253948085506_n.jpg', 1000, 'this is my note');

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
  `req_province` longtext NOT NULL,
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

INSERT INTO `set_request` (`request_id`, `req_name`, `req_province`, `req_street`, `req_region`, `req_email`, `req_date`, `req_category`, `req_variant`, `req_quantity`, `req_note`) VALUES
(39, 'Jobilleen Lopez', 'Batangas', 'Sta Maria Bauan', 'Region IV‑A – CALABARZON', 'rico.littawa@g.batstate-u.edu.ph', '2022-11-03', 'Hygiene Essentials', 'Per-box', 4, 'this is my note'),
(40, 'deser', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', 'Region IV‑A – CALABARZON', 'decierclyn.pereda@g.batstate-u.edu.ph', '2022-11-06', 'Clothes', 'Per-box', 5, 'note');

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

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE `variant` (
  `variant_id` int(11) NOT NULL,
  `variant` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`variant_id`, `variant`) VALUES
(1, 'Per-box'),
(2, 'Per-pieces'),
(5, 'Money');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categ_id`),
  ADD KEY `category` (`category`(768));

--
-- Indexes for table `donation_items`
--
ALTER TABLE `donation_items`
  ADD PRIMARY KEY (`donor_id`),
  ADD KEY `donationDate` (`donationDate`);

--
-- Indexes for table `monetary_donations`
--
ALTER TABLE `monetary_donations`
  ADD PRIMARY KEY (`money_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`),
  ADD KEY `region_name` (`region_name`(768)),
  ADD KEY `region_name_2` (`region_name`(768));

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
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`variant_id`),
  ADD KEY `variant` (`variant`(768));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `donation_items`
--
ALTER TABLE `donation_items`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `monetary_donations`
--
ALTER TABLE `monetary_donations`
  MODIFY `money_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `set_request`
--
ALTER TABLE `set_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `useradmin`
--
ALTER TABLE `useradmin`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
