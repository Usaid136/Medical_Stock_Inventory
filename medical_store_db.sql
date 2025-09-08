-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2025 at 08:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical_store_db`
--
CREATE DATABASE IF NOT EXISTS `medical_store_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `medical_store_db`;

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` enum('Tablet','Capsule','Syrup','Injection','Topical','Drops','Inhaler','Suppository','Medical Device','General Item','Vet Inj 10ml','Vet Inj 50ml','Vet Inj 100ml','Vet Powder','Vet Tablets','Vet Other Items','Vet Tuips','Vet Drench 1000ml','Vet Drench 100ml','Human Other Items','Vet Syrup','Sachet','Vet Drip','Vet Spray') DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `retail_price` decimal(10,2) DEFAULT NULL,
  `wholesale_price` decimal(10,2) DEFAULT NULL,
  `expiry_date` date NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `location` varchar(50) NOT NULL DEFAULT 'Shop'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `category`, `manufacturer`, `quantity`, `retail_price`, `wholesale_price`, `expiry_date`, `added_date`, `location`) VALUES
(6, 'Eye Drops', 'Drops', 'VisionMed', 30, 60.00, 50.00, '2026-09-01', '2025-05-21 07:24:05', 'godown 1'),
(7, 'Asthma Inhaler', 'Inhaler', 'BreathWell', 20, 250.00, 200.00, '2026-11-05', '2025-05-21 07:24:05', 'godown 2'),
(8, 'Glycerin Suppository', 'Suppository', 'ReliefMed', 60, 10.00, 8.00, '2026-12-31', '2025-05-21 07:24:05', 'godown 3'),
(9, 'Digital Thermometer', 'Medical Device', 'MediTech', 15, 400.00, 350.00, '2027-01-01', '2025-05-21 07:24:05', 'IN SHOP'),
(10, 'Cotton Roll', 'General Item', 'CleanCo', 200, 5.00, 4.00, '2027-01-15', '2025-05-21 07:24:05', 'godown 1'),
(11, 'Bandage Pack', 'Human Other Items', 'HealFast', 120, 8.00, 6.00, '2026-09-30', '2025-05-21 07:24:05', 'godown 2'),
(12, 'Vetox 10ml', 'Vet Inj 10ml', 'VetCare', 35, 85.00, 70.00, '2026-08-01', '2025-05-21 07:24:05', 'godown 3'),
(13, 'Vetox 50ml', 'Vet Inj 50ml', 'VetCare', 40, 150.00, 120.00, '2026-08-01', '2025-05-21 07:24:05', 'IN SHOP'),
(14, 'Vetox 100ml', 'Vet Inj 100ml', 'VetCare', 45, 250.00, 200.00, '2026-08-01', '2025-05-21 07:24:05', 'godown 1'),
(15, 'Animal Feed Mix', 'Vet Powder', 'AgriLife', 100, 200.00, 160.00, '2026-09-01', '2025-05-21 07:24:05', 'godown 2'),
(16, 'Vet Tabs', 'Vet Tablets', 'AgriVet', 80, 40.00, 30.00, '2026-10-01', '2025-05-21 07:24:05', 'godown 3'),
(17, 'Vet Spray', 'Vet Other Items', 'FarmCare', 60, 180.00, 150.00, '2026-07-15', '2025-05-21 07:24:05', 'IN SHOP'),
(18, 'Tuip Injection', 'Vet Tuips', 'RuralVet', 50, 300.00, 260.00, '2026-12-01', '2025-05-21 07:24:05', 'godown 1'),
(19, 'Drench Mix 100ml', 'Vet Drench 100ml', 'AgroMed', 20, 220.00, 180.00, '2026-11-11', '2025-05-21 07:24:05', 'godown 2'),
(20, 'Drench Mix 1000ml', 'Vet Drench 1000ml', 'AgroMed', 10, 1500.00, 1300.00, '2026-12-20', '2025-05-21 07:24:05', 'godown 3'),
(21, 'Vet Syrup', 'Vet Syrup', 'VetHealth', 70, 120.00, 90.00, '2026-09-25', '2025-05-21 07:24:05', 'IN SHOP'),
(22, 'Perfume Rose', 'General Item', 'Fragrance Inc.', 30, 250.00, 180.00, '2027-01-01', '2025-05-21 07:27:05', 'IN SHOP'),
(23, 'Nestle Cerelac', 'General Item', 'Nestle', 40, 180.00, 150.00, '2026-12-31', '2025-05-21 07:27:05', 'godown 1'),
(24, 'Baby Feeder 150ml', 'General Item', 'BabyCare', 50, 90.00, 75.00, '2027-02-01', '2025-05-21 07:27:05', 'godown 2'),
(25, 'Facewash Neem', 'General Item', 'GlowSkin', 60, 120.00, 100.00, '2027-03-10', '2025-05-21 07:27:05', 'godown 3'),
(26, 'Ponstan', 'Tablet', 'MediCare', 15, 500.00, 470.00, '2025-07-23', '2025-05-23 06:16:09', 'Shop'),
(27, 'Meclay Shampoo', 'General Item', 'Meclay Industries', 8, 380.00, 350.00, '2025-06-26', '2025-05-23 06:19:02', '330');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
