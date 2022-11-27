-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2022 at 01:19 PM
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
-- Table structure for table `announcement_template`
--

CREATE TABLE `announcement_template` (
  `id` int(11) NOT NULL,
  `announcement` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement_template`
--

INSERT INTO `announcement_template` (`id`, `announcement`) VALUES
(1, 'Attention! There is a massive fire near this sample street. We need clothes, ready-to eat foods for the victims of fire');

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
(2, 'Canned goods, Noodles'),
(4, 'Hygiene Essentials'),
(5, 'Infant Items'),
(6, 'Drinking water'),
(7, 'First Aid Kits'),
(8, 'Medicine'),
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
  `donor_contact` varchar(11) NOT NULL,
  `donationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_items`
--

INSERT INTO `donation_items` (`donor_id`, `Reference`, `donor_name`, `donor_province`, `donor_street`, `donor_region`, `donor_email`, `donor_contact`, `donationDate`) VALUES
(1, 1, 'try name', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', '4', 'rico.littawa@g.batstate-u.edu.ph', '09298289932', '2022-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `donation_items10`
--

CREATE TABLE `donation_items10` (
  `id` int(11) NOT NULL,
  `Reference` bigint(20) NOT NULL,
  `category` longtext NOT NULL,
  `name_items` longtext NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_items10`
--

INSERT INTO `donation_items10` (`id`, `Reference`, `category`, `name_items`, `quantity`) VALUES
(1, 1, 'sardines', '2', 30);

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
(2);

-- --------------------------------------------------------

--
-- Table structure for table `donor_record`
--

CREATE TABLE `donor_record` (
  `id` int(11) NOT NULL,
  `rD_reference` bigint(20) NOT NULL,
  `rD_name` longtext NOT NULL,
  `rD_province` longtext NOT NULL,
  `rD_street` longtext NOT NULL,
  `rD_region` longtext NOT NULL,
  `rD_email` longtext NOT NULL,
  `rD_contact` varchar(11) NOT NULL,
  `rD_date` date NOT NULL,
  `rD_certificate` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donor_recordm`
--

CREATE TABLE `donor_recordm` (
  `id` int(11) NOT NULL,
  `rDM_name` longtext NOT NULL,
  `rDM_province` longtext NOT NULL,
  `rDM_street` longtext NOT NULL,
  `rDM_region` longtext NOT NULL,
  `rDM_contact` varchar(11) NOT NULL,
  `rDM_email` longtext NOT NULL,
  `donated` bigint(20) NOT NULL,
  `rDM_date` date NOT NULL,
  `rDM_certificate` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `money_contact` varchar(11) NOT NULL,
  `money_email` longtext NOT NULL,
  `money_date` date NOT NULL,
  `money_reference` varchar(100) NOT NULL,
  `money_img` longtext NOT NULL,
  `money_amount` bigint(20) NOT NULL,
  `money_note` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE `month` (
  `id` int(11) NOT NULL,
  `name_month` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`id`, `name_month`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'April '),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

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
  `req_contact` varchar(11) NOT NULL,
  `req_note` varchar(1000) NOT NULL,
  `req_status` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `set_request`
--

INSERT INTO `set_request` (`request_id`, `reference_id`, `req_name`, `req_province`, `req_street`, `req_region`, `valid_id`, `req_email`, `req_date`, `req_contact`, `req_note`, `req_status`) VALUES
(1, 1, 'mariestella', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', '8', 'coffee shop.png', 'mariestella.suarez@g.bat-state-u.edu.ph', '2022-11-27', '09298289932', '', 'Verified'),
(2, 2, 'rico', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', '4', 'product.png', 'rico.littawa@g.batstate-u.edu.ph', '2022-11-27', '09298289932', '', 'For verification');

-- --------------------------------------------------------

--
-- Table structure for table `set_request10`
--

CREATE TABLE `set_request10` (
  `id` int(11) NOT NULL,
  `req_reference` bigint(20) NOT NULL,
  `req_category` longtext NOT NULL,
  `req_nameItem` longtext NOT NULL,
  `req_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `set_request10`
--

INSERT INTO `set_request10` (`id`, `req_reference`, `req_category`, `req_nameItem`, `req_quantity`) VALUES
(1, 4, 'sardines', '6', 23),
(2, 4, 'sardines', '7', 4),
(4, 1, '6', '', 30),
(5, 2, '4', '', 20);

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
(3);

-- --------------------------------------------------------

--
-- Table structure for table `template_certi`
--

CREATE TABLE `template_certi` (
  `id` int(11) NOT NULL,
  `template` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `total_donor`
--

CREATE TABLE `total_donor` (
  `id` int(11) NOT NULL,
  `Tdonor_name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `total_funds`
--

CREATE TABLE `total_funds` (
  `id` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `total_funds`
--

INSERT INTO `total_funds` (`id`, `amount`) VALUES
(1, 200);

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
(1, 'Per Pack'),
(3, 'Per Box');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `id` int(11) NOT NULL,
  `year_name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`id`, `year_name`) VALUES
(1, '2022'),
(2, '2023'),
(3, '2024'),
(4, '2025'),
(5, '2026'),
(6, '2027'),
(7, '2028'),
(8, '2029'),
(9, '2030'),
(10, '2022'),
(11, '2023'),
(12, '2024'),
(13, '2025'),
(14, '2026'),
(15, '2027'),
(16, '2028'),
(17, '2029'),
(18, '2030');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement_template`
--
ALTER TABLE `announcement_template`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `donor_record`
--
ALTER TABLE `donor_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor_recordm`
--
ALTER TABLE `donor_recordm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monetary_donations`
--
ALTER TABLE `monetary_donations`
  ADD PRIMARY KEY (`money_id`);

--
-- Indexes for table `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `template_certi`
--
ALTER TABLE `template_certi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_donor`
--
ALTER TABLE `total_donor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_funds`
--
ALTER TABLE `total_funds`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement_template`
--
ALTER TABLE `announcement_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donation_items_picking`
--
ALTER TABLE `donation_items_picking`
  MODIFY `reference_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `donor_record`
--
ALTER TABLE `donor_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donor_recordm`
--
ALTER TABLE `donor_recordm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monetary_donations`
--
ALTER TABLE `monetary_donations`
  MODIFY `money_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `month`
--
ALTER TABLE `month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `set_request`
--
ALTER TABLE `set_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `set_request10`
--
ALTER TABLE `set_request10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `set_request_pickings`
--
ALTER TABLE `set_request_pickings`
  MODIFY `reference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `template_certi`
--
ALTER TABLE `template_certi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `total_donor`
--
ALTER TABLE `total_donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `total_funds`
--
ALTER TABLE `total_funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `useradmin`
--
ALTER TABLE `useradmin`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
