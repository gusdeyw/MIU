-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 22, 2022 at 07:39 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tes-multiple`
--

-- --------------------------------------------------------

--
-- Table structure for table `property_list`
--

CREATE TABLE `property_list` (
  `id_property` int(11) NOT NULL,
  `images` longtext NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_list`
--

INSERT INTO `property_list` (`id_property`, `images`, `name`) VALUES
(1, ' public/property/BLI1403/18.jpg, public/property/BLI1403/2.jpg,public/property/BLI1403/1.jpg, public/property/BLI1403/3.jpg, public/property/BLI1403/4.jpg, public/property/BLI1403/5.jpg, public/property/BLI1403/7.jpg, public/property/BLI1403/8.jpg, public/property/BLI1403/9.jpg, public/property/BLI1403/6.jpg, public/property/BLI1403/10.jpg, public/property/BLI1403/11.jpg, public/property/BLI1403/12.jpg, public/property/BLI1403/17.jpg, public/property/BLI1403/13.jpg, public/property/BLI1403/14.jpg, public/property/BLI1403/15.jpg, public/property/BLI1403/16.jpg', 'BLI1403'),
(2, ' public/property/BLI1408/7.jpg, public/property/BLI1408/3.jpg, public/property/BLI1408/4.jpg, public/property/BLI1408/5.jpg, public/property/BLI1408/6.jpg,public/property/BLI1408/1.jpg, public/property/BLI1408/2.jpg', 'BLI1408');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `property_list`
--
ALTER TABLE `property_list`
  ADD PRIMARY KEY (`id_property`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `property_list`
--
ALTER TABLE `property_list`
  MODIFY `id_property` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
