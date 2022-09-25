-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 25, 2022 at 07:52 AM
-- Server version: 5.7.31
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `papers_store`
--
CREATE DATABASE IF NOT EXISTS `papers_store` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `papers_store`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` varchar(17) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
('6314a3063c16c', 'GCE Advanced Level'),
('6314a8021385a', 'GCE Ordinary Level'),
('6314a8813e7f2', 'Grade 11'),
('6314a8e7c3098', 'Grade 9');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `category_id` varchar(17) NOT NULL,
  `product_id` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`category_id`, `product_id`) VALUES
('6314a3063c16c', '632ff326edf80'),
('6314a8021385a', '632ff41a43bb3'),
('6314a8813e7f2', '632ff3806a1aa'),
('6314a8e7c3098', '632ff524352de');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(17) NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(15) NOT NULL,
  `type` varchar(15) NOT NULL,
  `user_id` varchar(17) NOT NULL,
  `payment_method` varchar(15) NOT NULL,
  `payment_status` varchar(11) NOT NULL DEFAULT 'incomplete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `amount`, `status`, `type`, `user_id`, `payment_method`, `payment_status`) VALUES
('632ff87e5b63a', 2230, 'shipped', 'delivery', '632ff79d3f0a6', 'card', 'complete'),
('632ff95021099', 800, 'new', 'delivery', '632ff938deba2', 'cod', 'complete'),
('632ff970a6e1a', 2230, 'new', 'online', '632ff938deba2', 'card', 'incomplete');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` varchar(17) NOT NULL,
  `product_id` varchar(17) NOT NULL,
  `order_id` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `product_id`, `order_id`) VALUES
('632ff87e5b989', '632ff3806a1aa', '632ff87e5b63a'),
('632ff970a7124', '632ff3806a1aa', '632ff970a6e1a'),
('632ff87e5bb4c', '632ff41a43bb3', '632ff87e5b63a'),
('632ff970a729d', '632ff41a43bb3', '632ff970a6e1a'),
('632ff95021391', '632ff524352de', '632ff95021099');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` varchar(17) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text NOT NULL,
  `image_url` text NOT NULL,
  `download_link` text NOT NULL,
  `category_id` varchar(17) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `quantity`, `description`, `image_url`, `download_link`, `category_id`, `name`, `price`) VALUES
('632ff326edf80', 5, 'This contains papers from year 2000 for the AL common general exam.', 'https://i.ibb.co/3v5980Y/sanya-podu-test.png', 'https://i.ibb.co/3v5980Y/sanya-podu-test.png', '6314a3063c16c', 'GCE AL Common General Exam Past Papers', 1200),
('632ff3806a1aa', 5, 'This contains exercises for grade 11 science with revision papers.', 'https://i.ibb.co/HgSV5gn/science.jpg', 'https://i0.wp.com/lol.lk/wp-content/uploads/2021/12/WB.jpg?fit=1576%2C1576&amp;ssl=1', '6314a8813e7f2', 'Grade 11 Science Revision Papers ', 880),
('632ff41a43bb3', 5, 'GCE O/L new syllabus past papers for Business and Accounting. ', 'https://i.ibb.co/0f53FHp/commerce.jpg', 'https://i.ibb.co/0f53FHp/commerce.jpg', '6314a8021385a', 'GCE O/L Business and Accounting', 1350),
('632ff524352de', 5, 'This contains exercises for grade 9 history subject with revision papers.', 'https://i.ibb.co/9219gZG/history.jpg', 'https://i.ibb.co/9219gZG/history.jpg', '6314a8e7c3098', 'Grade 9 History Revision Papers', 800);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart_product`
--

CREATE TABLE `shoppingcart_product` (
  `id` varchar(17) NOT NULL,
  `user_id` varchar(17) NOT NULL,
  `product_id` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(17) NOT NULL,
  `name` varchar(25) NOT NULL,
  `password` text,
  `email` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `address`, `type`) VALUES
('632ff128588e2', 'Admin User', '$2y$10$sSOHr5dITbmCrgZPmzWJ7O7senqxkUULowSTEMhDzPwscZdI8eL4q', 'admin@gmail.com', '12B,\r\nFlower Rd,\r\nColombo 10,\r\nSri Lanka.', 'admin'),
('632ff79d3f0a6', 'Fathima Haani', '$2y$10$CY10hhEo/I.kJ3JUikfzsuuPVtvpzjHwm1DaLtMrBNwYwwvd8Izxa', 'fathimah@gmail.com', '1/23,\r\nKirulapana Avenue,\r\nColombo 3.', 'customer'),
('632ff938deba2', 'Lester James', '$2y$10$kGRpWMSnwd0vfSrRsVczkuykDwWOhyXECkMvombt5B9Ba5lVLHgk6', 'lesterjames@gmail.com', '33/34,\r\nUpper Dickson Rd,\r\nKaluwella,\r\nGalle.', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`category_id`,`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD UNIQUE KEY `product_id` (`product_id`,`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart_product`
--
ALTER TABLE `shoppingcart_product`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `user_id` (`user_id`,`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
