-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 04:21 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dump`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(50) NOT NULL DEFAULT '',
  `cat_description` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`, `cat_description`) VALUES
(19, 'Dessert', ''),
(20, 'Pasta', ''),
(21, 'Beverage', ''),
(22, 'Salad', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `od_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `od_date` date NOT NULL,
  `od_status` enum('New','Shipped','Completed','Cancelled') NOT NULL DEFAULT 'New',
  `od_name` varchar(50) NOT NULL DEFAULT '',
  `od_address` varchar(100) NOT NULL DEFAULT '',
  `od_city` varchar(100) NOT NULL DEFAULT '',
  `od_postal_code` varchar(10) NOT NULL DEFAULT '',
  `od_cost` varchar(10) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`od_id`, `user_id`, `od_date`, `od_status`, `od_name`, `od_address`, `od_city`, `od_postal_code`, `od_cost`) VALUES
(25, 10, '2022-01-16', 'Shipped', 'Caner', 'asdasd', 'Urla', '35000', '25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_item`
--

CREATE TABLE `tbl_order_item` (
  `od_id` int(10) UNSIGNED NOT NULL,
  `pd_id` int(10) UNSIGNED NOT NULL,
  `od_qty` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_item`
--

INSERT INTO `tbl_order_item` (`od_id`, `pd_id`, `od_qty`) VALUES
(25, 40, 1),
(25, 41, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pd_id` int(10) UNSIGNED NOT NULL,
  `cat_id` int(10) UNSIGNED NOT NULL,
  `pd_name` varchar(99) NOT NULL DEFAULT '',
  `pd_description` text NOT NULL,
  `pd_price` decimal(7,2) NOT NULL DEFAULT 0.00,
  `pd_qty` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `pd_image` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pd_id`, `cat_id`, `pd_name`, `pd_description`, `pd_price`, `pd_qty`, `pd_image`) VALUES
(34, 20, 'Pesto Penne', '', '15.00', 50, 'pesto.jpg'),
(35, 21, 'Soda', '', '5.00', 50, 'Soda.jpg'),
(36, 21, 'Fruit Juice', '', '5.00', 50, 'juice.jpg'),
(37, 19, 'Apple Pie', '', '10.00', 50, 'applepie.jpg'),
(38, 19, 'Cheesecake', '', '10.00', 50, 'cheesecake.jpg'),
(39, 22, 'Caesar Salad', '', '10.00', 50, 'ceaser.jpg'),
(40, 22, 'Greek Salad', '', '10.00', 49, 'greekjpg.jpg'),
(41, 20, 'Lasagna', '', '15.00', 49, 'lasagna.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `user_email` varchar(40) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `password`, `user_email`, `created_at`, `updated_at`, `user_is_admin`) VALUES
(9, 'admin', '0192023a7bbd73250516f069df18b500', 'admin@std.iyte.edu.tr', '2022-01-16 01:31:53', '2022-01-16 01:31:53', 1),
(10, 'caner', '87f1e0aea37ca6ec20f26945f8779fd1', 'caneralparslan@std.iyte.edu.tr', '2022-01-16 01:35:46', '2022-01-20 16:17:14', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_name` (`cat_name`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`od_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_order_item`
--
ALTER TABLE `tbl_order_item`
  ADD PRIMARY KEY (`od_id`,`pd_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `pd_name` (`pd_name`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `od_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pd_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
