-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2020 at 12:11 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.28-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rhumsug`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'rhum', 'rhum alcohol'),
(2, 'sucre liquide', 'sucre pas d\'alcool');

-- --------------------------------------------------------

--
-- Table structure for table `Clients`
--

CREATE TABLE `Clients` (
  `client_id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `hash` varchar(500) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Clients`
--

INSERT INTO `Clients` (`client_id`, `nom`, `prenom`, `birthday`, `address1`, `address2`, `city`, `region`, `postcode`, `country`, `phone`, `email`, `hash`, `verified`, `order_id`) VALUES
(20, 'cats', 'cats', NULL, '1 cat street', '', 'katze', 'koshka', '89IOU', 'Barbados', '1234567890', 'clavainova@gmail.com', '$2y$10$tt0qhfGEtH87uFgkFhlPHuQQ/Mzri7HkJ7ui88C2muzUM530dymkO', 1, 0),
(21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'vplijmmxgrcgucakfk@ttirv.com', '$2y$10$cutt9DcnEke0rLd3PjfIOeTRmTZqsnHoFP3W4q9Q9Rko1A7qQXgQ6', 1, 0),
(22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'obo00611@bcaoo.com', '$2y$10$Hr2xzSZtQ3fILuTWBnkoO.9ZhPjCRrd.BXPMXJfuHSH5Cn4dxutP2', 0, 0),
(23, 'cats', 'cats', NULL, '1 cat street', '', 'katze', 'koshka', '89IOU', 'Barbados', '1234567890', 'fcofgsrvviavccptkg@ttirv.org', '$2y$10$5.XfT1H1pCStbmseTv6LtOcRSrLsBbxdc2KXyMZ0iJPEhgXD3Hj7K', 1, 0),
(24, 'catsgggggg', 'cats', NULL, '1 cat street', '', 'katze', 'koshka', '89IOU', 'Barbados', '1234567890', 'etylaxypnjiaquaqtl@ttirv.com', '$2y$10$l5.Cf4PI4/hzMpWZ4q/HrezdW5h.NAZSihzlupWl/PmyFxFypr4l2', 1, 0),
(25, 'ghetsis', 'ahrmonia', NULL, 'castle', '', 'victroad', 'unova', '777', 'Laos', '1234567890', 'jgojpphahketwqykft@awdrt.org', '$2y$10$PFc46NizY9JsFgO/TN4SZuRaPgVBUOhRMfDwGle/DSICjZTRWjjC2', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid` tinyint(1) DEFAULT '0',
  `card_number` int(16) DEFAULT NULL,
  `security_code` int(3) DEFAULT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(500) NOT NULL,
  `category_id` int(11) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `unit_weight` int(11) NOT NULL,
  `units_in_stock` int(11) NOT NULL,
  `product_available` int(10) NOT NULL,
  `img_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`product_id`, `product_name`, `product_description`, `category_id`, `unit_price`, `unit_weight`, `units_in_stock`, `product_available`, `img_url`) VALUES
(1, 'rhum agricole a 50', 'description', 1, '10.00', 500, 8, 20, 'rhum.jpg'),
(2, 'rhum vieux ambre, 45', 'veilli en futs', 1, '15.00', 600, 20, 20, 'rhum_noir.jpg'),
(3, 'sucre de canne raffine', '(morceaux, en poudre, glace)', 2, '5.00', 600, 30, 25, 'sucre.png'),
(4, 'sucre de canne liquide\r\n', 'description', 2, '5.00', 200, 20, 20, 'liquide.jpg'),
(5, 'Don Papa Rum 10 Years', 'geographic boundaries of rum', 1, '65.00', 800, 999, 999, 'rum_papa.jpg'),
(6, 'Bougainville Vieux', 'Domaine Spiced Rum', 1, '23.00', 1000, 999, 999, 'rum_vieux.jpg'),
(7, 'Chairman\'s Reserve', 'White Label Rum', 1, '25.00', 600, 999, 999, 'rum_blanc.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_category` (`client_id`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Clients`
--
ALTER TABLE `Clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`client_id`) REFERENCES `Clients` (`client_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
