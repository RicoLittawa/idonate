-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 11:51 AM
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
  `donor_contact` varchar(11) NOT NULL,
  `donationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 1, '6', '2', 12),
(2, 2, '8', '2', 10),
(3, 2, '12', '1', 2),
(4, 3, '6', '6', 12),
(5, 3, '12', '1', 1),
(6, 4, '9', '2', 1),
(9, 6, '7', '1', 12),
(10, 5, '8', '6', 1),
(11, 7, '8', '6', 2),
(12, 8, '6', '6', 100),
(13, 9, '10', '2', 1),
(14, 9, '9', '7', 2),
(16, 10, '8', '2', 1),
(17, 11, '8', '1', 100),
(18, 12, '8', '6', 1);

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
(13);

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

--
-- Dumping data for table `donor_record`
--

INSERT INTO `donor_record` (`id`, `rD_reference`, `rD_name`, `rD_province`, `rD_street`, `rD_region`, `rD_email`, `rD_contact`, `rD_date`, `rD_certificate`) VALUES
(1, 1, 'rico littawa', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', '12', 'rico.littawa@g.batstate-u.edu.ph', '09392560014', '2022-11-23', 'rico littawa1669252571.png'),
(2, 2, 'wendel', 'Batangas', 'Rosario Batangas', '4', 'jeffersondetorres@gmail.com', '09392560001', '2022-11-23', 'wendel1669252576.png'),
(3, 3, 'new request', 'Batangas', 'Sta Maria Bauan', '11', 'sample@gmail.com', '12345678912', '2022-11-23', 'new request1669266663.png'),
(4, 4, 'to powerbi', 'Laguna', 'Brgy Balagtas Sitio 7 Tramo Pulo', '12', 'sample@gmail.com', '09392560014', '2022-10-25', 'to powerbi1669267738.png'),
(5, 5, 'test1', 'Batangas', 'Rosario Batangas', '15', 'rico.littawa@g.batstate-u.edu.ph', '09392560001', '2022-10-13', 'test11669268713.png'),
(6, 6, 'test2', 'cebu', 'Brgy Balagtas Sitio 7 Tramo Pulo', '12', 'rico.littawa@g.batstate-u.edu.ph', '09392560000', '2022-10-18', 'test21669268718.png'),
(7, 7, 'test3', 'Laguna', 'dasd', '8', 'rico.littawa@g.batstate-u.edu.ph', '09392560000', '2022-11-23', 'test31669268723.png'),
(8, 8, 'test5', 'Batangas', 'Sta Maria Bauan', '14', 'jeffersondetorres@gmail.com', '09392560001', '2022-10-27', 'test51669268885.png'),
(9, 9, 'test6', 'cebu', 'Sta Maria Bauan', '10', 'xyz@email.com', '09392560014', '2022-10-19', 'test61669268891.png'),
(10, 10, 'test8', 'cebu', 'Brgy Balagtas Sitio 7 Tramo Pulo', '13', 'jeffersondetorres@gmail.com', '09392560014', '2022-10-08', 'test81669268895.png'),
(11, 11, 'test10', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', '13', 'sample@gmail.com', '09392560014', '2022-10-20', 'test101669268900.png'),
(12, 12, 'this is september', 'Batangas', 'Brgy Balagtas Sitio 7 Tramo Pulo', '10', 'sample@gmail.com', '09392560001', '2022-09-22', 'this is september1669280644.png');

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

--
-- Dumping data for table `donor_recordm`
--

INSERT INTO `donor_recordm` (`id`, `rDM_name`, `rDM_province`, `rDM_street`, `rDM_region`, `rDM_contact`, `rDM_email`, `donated`, `rDM_date`, `rDM_certificate`) VALUES
(1, 'This is my real name', 'Batangas', 'Balagtas Sitio 7 Tramo Pulo', '4', '2147483647', '2147483647', 0, '2022-11-23', 'This is my real name1669255015.png'),
(2, 'tommy shelby', 'Mindoro', 'Mindoro Sample Street', '7', '2147483647', '2147483647', 121, '2022-11-23', 'tommy shelby1669256549.png'),
(3, 'october test', 'Batangas', 'Cebu', '15', '2147483647', '2147483647', 300, '2022-10-25', 'october test1669281942.png'),
(4, 'october test 4', 'Cebu', 'Balagtas Sitio 7 Tramo Pulo', '14', '09298289932', '09298289932', 200, '2022-10-27', 'october test 41669282365.png'),
(5, 'october test3', 'Mindoro', 'Mindoro Sample Street', '13', '2147483647', '2147483647', 10, '2022-10-17', 'october test31669282371.png'),
(6, 'october test2', 'Batangas', 'Cebu', '12', '2147483647', '2147483647', 200, '2022-10-25', 'october test21669282376.png');

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
  `req_note` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `set_request`
--

INSERT INTO `set_request` (`request_id`, `reference_id`, `req_name`, `req_province`, `req_street`, `req_region`, `valid_id`, `req_email`, `req_date`, `req_contact`, `req_note`) VALUES
(2, 2, 'new request from future', 'cebu', 'cebu city', '11', 'minimalist.png', 'xyz@email.com', '2022-11-23', '09298289932', 'my note');

-- --------------------------------------------------------

--
-- Table structure for table `set_request10`
--

CREATE TABLE `set_request10` (
  `id` int(11) NOT NULL,
  `req_reference` bigint(20) NOT NULL,
  `req_category` longtext NOT NULL,
  `req_variant` longtext NOT NULL,
  `req_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `set_request10`
--

INSERT INTO `set_request10` (`id`, `req_reference`, `req_category`, `req_variant`, `req_quantity`) VALUES
(2, 2, '6', '2', 12);

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

--
-- Dumping data for table `total_donor`
--

INSERT INTO `total_donor` (`id`, `Tdonor_name`) VALUES
(1, 'Justin Gaethji'),
(2, 'rico littawa'),
(3, 'wendel'),
(4, 'teslaan'),
(5, 'Conor Mc Gregor'),
(6, 'Try Name'),
(7, 'This is my real name'),
(8, 'tommy shelby'),
(9, 'new request'),
(10, 'to powerbi'),
(11, 'test1'),
(12, 'test2'),
(13, 'test3'),
(14, 'test5'),
(15, 'test6'),
(16, 'test8'),
(17, 'test10'),
(18, 'this is september'),
(19, 'october test'),
(20, 'october test 4'),
(21, 'october test3'),
(22, 'october test2');

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
(1, 1000),
(2, 121),
(3, 300),
(4, 200),
(5, 10),
(6, 200);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement_template`
--
ALTER TABLE `announcement_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `donation_items`
--
ALTER TABLE `donation_items`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `donation_items10`
--
ALTER TABLE `donation_items10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `donation_items_picking`
--
ALTER TABLE `donation_items_picking`
  MODIFY `reference_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `donor_record`
--
ALTER TABLE `donor_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `donor_recordm`
--
ALTER TABLE `donor_recordm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `monetary_donations`
--
ALTER TABLE `monetary_donations`
  MODIFY `money_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `total_funds`
--
ALTER TABLE `total_funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
