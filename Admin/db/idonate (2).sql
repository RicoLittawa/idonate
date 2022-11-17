-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2022 at 04:50 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
(12, 'Nebulizer kits');

-- --------------------------------------------------------

--
-- Table structure for table `donation_items`
--

CREATE TABLE `donation_items` (
  `donor_id` int(11) NOT NULL,
  `Reference` bigint(20) NOT NULL,
  `donor_name` longtext NOT NULL,
  `donor_province` longtext NOT NULL,
  `donor_street` longtext NOT NULL,
  `donor_region` longtext NOT NULL,
  `donor_email` longtext NOT NULL,
  `donationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_items`
--

INSERT INTO `donation_items` (`donor_id`, `Reference`, `donor_name`, `donor_province`, `donor_street`, `donor_region`, `donor_email`, `donationDate`) VALUES
(1, 26, 'rico littawa', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', '4', 'jeffersondetorres@gmail.com', '2022-11-15');

-- --------------------------------------------------------

--
-- Table structure for table `donation_items10`
--

CREATE TABLE `donation_items10` (
  `id` int(11) NOT NULL,
  `Reference` bigint(20) NOT NULL,
  `category` longtext NOT NULL,
  `variant` longtext NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_items10`
--

INSERT INTO `donation_items10` (`id`, `Reference`, `category`, `variant`, `quantity`) VALUES
(1, 26, '6', '7', 1),
(2, 26, '6', '7', 1),
(3, 26, '6', '7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `donation_items_picking`
--

CREATE TABLE `donation_items_picking` (
  `reference_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_items_picking`
--

INSERT INTO `donation_items_picking` (`reference_id`) VALUES
(27);

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
  `reference_id` bigint(20) NOT NULL,
  `req_name` longtext NOT NULL,
  `req_province` longtext NOT NULL,
  `req_street` longtext NOT NULL,
  `req_region` varchar(191) NOT NULL,
  `valid_id` longtext NOT NULL,
  `req_email` longtext NOT NULL,
  `req_date` date NOT NULL,
  `req_contact` int(11) NOT NULL,
  `req_note` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `set_request`
--

INSERT INTO `set_request` (`request_id`, `reference_id`, `req_name`, `req_province`, `req_street`, `req_region`, `valid_id`, `req_email`, `req_date`, `req_contact`, `req_note`) VALUES
(1, 1, '', '', '', '-Select-', 'product.png', '[object HTMLInputElement]', '1970-01-01', 0, ''),
(2, 1, 'dsadad', 'asdad', 'dasda', '14', 'coffee shop.png', '[object HTMLInputElement]', '2022-11-17', 1223, 'sadfsad'),
(3, 1, 'rico', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', '3', 'product.png', 'rico.littawa@g.batstate-u.edu.ph', '2022-11-17', 12, '4'),
(4, 1, 'ric', 'sdad', 'dada', '16', 'product.png', 'dasd', '2022-11-17', 12, '');

-- --------------------------------------------------------

--
-- Table structure for table `set_request10`
--

CREATE TABLE `set_request10` (
  `id` int(11) NOT NULL,
  `Reference` bigint(20) NOT NULL,
  `category` longtext NOT NULL,
  `variant` longtext NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `set_request_pickings`
--

CREATE TABLE `set_request_pickings` (
  `reference_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `set_request_pickings`
--

INSERT INTO `set_request_pickings` (`reference_id`) VALUES
(1);

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
(6, 'No Variant'),
(7, 'Per-Pack');

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
-- Indexes for table `donation_items10`
--
ALTER TABLE `donation_items10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_items_picking`
--
ALTER TABLE `donation_items_picking`
  ADD PRIMARY KEY (`reference_id`);

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
-- Indexes for table `set_request10`
--
ALTER TABLE `set_request10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_request_pickings`
--
ALTER TABLE `set_request_pickings`
  ADD PRIMARY KEY (`reference_id`);

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
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donation_items10`
--
ALTER TABLE `donation_items10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donation_items_picking`
--
ALTER TABLE `donation_items_picking`
  MODIFY `reference_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `set_request10`
--
ALTER TABLE `set_request10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `set_request_pickings`
--
ALTER TABLE `set_request_pickings`
  MODIFY `reference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `useradmin`
--
ALTER TABLE `useradmin`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
