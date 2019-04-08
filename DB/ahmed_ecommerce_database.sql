-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2018 at 04:35 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ahmed_ecommerce_database`
--
CREATE DATABASE IF NOT EXISTS `ahmed_ecommerce_database` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ahmed_ecommerce_database`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_name`, `email`, `password`) VALUES
(1, 'Rashu', 'rashu', 'trte'),
(2, 'Rashu', 'rashu', 'trte'),
(3, 'Rashu', '', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `entry_date` date NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `product_name`, `picture`, `quantity`, `total_price`, `entry_date`, `expiry_date`) VALUES
(15, 17, 10, 'dsf', '1526400348', 1, 50, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `description`, `picture`, `status`) VALUES
(1, 'Mobiledsf', 'f  sdf', NULL, 'active'),
(2, 'Laptop', 'dssfsd dsfs ddsf', NULL, 'active'),
(10, 'mobile hardware', 'dfsf dsfs af', NULL, 'active'),
(11, 'electric product', 'dsfds fsd sd', '1525538009img-1.jpg', 'active'),
(12, 'sdfsdf', 'sdsdf', '1525801362', 'active'),
(13, 'dfsdf', 'sdfsdf', '1525801395', 'active'),
(14, 'dfds', 'dsfs', '1525801499', 'active'),
(15, 'new', 'sdff', '1525802371', 'active'),
(16, 'new ', 'new new', '1525880495', 'active'),
(17, 'jhjkjh', 'khkjh', '1525880510', 'active'),
(18, 'nbvbnn', 'jhgjhg', '1525880587', 'active'),
(19, 'kjhkj', 'kjjhkj', '1525881106', 'active'),
(20, 'kjkhkj', 'khjh', '1525881120', 'active'),
(21, 'khkj', 'jhkn', '1525881226', 'active'),
(22, 'dsffssdfsf', 'dsf', '1525881541', 'active'),
(23, 'fgddd', 'efcfas', '1525881690', 'active'),
(24, 'dsfsffsa', 'sdfsf', '1525881870', 'active'),
(25, 'regd', 'xcv', '1525882420', 'active'),
(26, 'oekpfwk', 's;daf,;la', '1525882463', 'active'),
(27, 'camera2', 'lkjfkljlaffdsf', '1526400252', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_name`, `phone`, `email`, `comment`) VALUES
(1, 'dsd', 'sdf', 'rashu.web@gmail.com', 'dsf'),
(2, '', '', '', ''),
(3, '', '', '', ''),
(4, '', '', '', ''),
(5, '', '', '', ''),
(6, '', '', '', ''),
(7, '', '', '', ''),
(8, 'rashu', NULL, 'rashu.web@gmail.com', NULL),
(9, 'Rashu Nath', '01829695454', 'rashu.web@gmail.com', 'sdfsf'),
(10, '', '', '', ''),
(11, 'Rashu Nath', '01829695454', 'rashu.web@gmail.com', ''),
(12, '', NULL, '', ''),
(13, '', NULL, '', ''),
(14, '', NULL, '', ''),
(15, '', '', '', ''),
(16, '', '', '', ''),
(17, '', '', '', ''),
(18, '', '', '', ''),
(19, '', '', '', ''),
(20, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_number` varchar(100) DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `ship_date` date DEFAULT NULL,
  `paid` varchar(50) NOT NULL DEFAULT 'no',
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_number`, `paid_amount`, `order_date`, `ship_date`, `paid`, `payment_date`) VALUES
(2, 17, '14675', 1450, NULL, NULL, 'yes', NULL),
(3, 17, '14675', 1450, NULL, NULL, 'yes', NULL),
(4, 17, '5546', 1450, NULL, NULL, 'yes', NULL),
(5, 17, '13951', 1902, NULL, NULL, 'yes', NULL),
(6, 17, '12682', 100, NULL, NULL, 'yes', NULL),
(7, 17, '12740', 100, NULL, NULL, 'yes', NULL),
(8, 17, '1798', 50, NULL, NULL, 'yes', NULL),
(9, 17, '13239', 300, NULL, NULL, 'yes', NULL),
(10, 17, '881', 150, NULL, NULL, 'yes', NULL),
(11, 17, '11212', 100, NULL, NULL, 'yes', NULL),
(12, 17, '17706', 100, NULL, NULL, 'yes', NULL),
(13, 17, '17706', 100, NULL, NULL, 'yes', NULL),
(14, 17, '17706', 100, NULL, NULL, 'yes', NULL),
(15, 17, '17706', 100, NULL, NULL, 'yes', NULL),
(16, 17, '17706', 100, NULL, NULL, 'yes', NULL),
(17, 17, '17706', 100, NULL, NULL, 'yes', NULL),
(18, 17, '28443', 250, NULL, NULL, 'yes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `quantity` double NOT NULL,
  `total` double NOT NULL,
  `ship_date` date NOT NULL,
  `bill_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `width` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `current_order` varchar(50) NOT NULL DEFAULT 'no',
  `price` double NOT NULL,
  `sale_price` double DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `stock_status` varchar(10) NOT NULL DEFAULT 'in stock',
  `entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_name`, `picture`, `color`, `width`, `height`, `weight`, `description`, `current_order`, `price`, `sale_price`, `vendor_id`, `stock_status`, `entry_date`) VALUES
(1, 2, 'Asus Laptop', NULL, NULL, 10, 10, 5, 'erer eryre', 'no', 50, 50, 18, 'in stock', '2018-05-05'),
(2, 2, 'Asus Laptop', NULL, NULL, 10, 10, 5, 'erer eryre', 'no', 50, 50, 18, 'in stock', '2018-05-05'),
(3, 2, 'Asus Laptop', NULL, NULL, 10, 10, 5, 'erer eryre', 'no', 50, 50, 18, 'in stock', '2018-05-05'),
(4, 2, 'Asus Laptop', NULL, NULL, 10, 10, 5, 'erer eryre', 'no', 50, 50, 18, 'in stock', '2018-05-05'),
(5, 2, 'Asus Laptop', NULL, NULL, 10, 10, 5, 'erer eryre', 'no', 50, 50, 18, 'in stock', '2018-05-05'),
(6, 2, 'Asus Laptop', NULL, NULL, 10, 10, 5, 'erer eryre', 'no', 50, 50, 18, 'in stock', '2018-05-05'),
(7, 1, '', NULL, NULL, 10, 10, 5, 'dsfsa dsfsa', 'no', 50, 50, 18, 'in stock', '2018-05-05'),
(8, 10, 'memory card', NULL, NULL, 15, 10, 10, 'retb  dl f', 'no', 50, 50, 18, 'in stock', '2018-05-05'),
(9, 10, 'camera', '1525537884img-2.jpg', NULL, 411, 0, 5, 'dsfs dsfsd f sdf sd f', 'no', 50, 50, 18, 'in stock', '2018-05-05'),
(10, 27, 'dsf', '1526400348', NULL, 411, 0, 10, 'tryr', 'no', 50, 50, 18, 'in stock', '2018-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `product_sold`
--

CREATE TABLE `product_sold` (
  `product_sold_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sold_counter` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_sold`
--

INSERT INTO `product_sold` (`product_sold_id`, `product_id`, `sold_counter`, `vendor_id`, `total_price`) VALUES
(1, 10, 1, 0, 0),
(2, 10, 1, 0, 0),
(3, 10, 1, 0, 0),
(4, 10, 1, 0, 0),
(5, 10, 1, 0, 0),
(6, 10, 1, 0, 0),
(7, 10, 1, 0, 0),
(8, 10, 1, 0, 0),
(9, 10, 1, 0, 0),
(10, 10, 1, 0, 0),
(11, 10, 1, 0, 0),
(12, 10, 1, 0, 0),
(13, 10, 1, 0, 0),
(14, 10, 1, 0, 0),
(15, 9, 1, 0, 0),
(16, 9, 1, 0, 0),
(17, 9, 1, 0, 0),
(18, 9, 1, 0, 0),
(19, 9, 1, 0, 0),
(20, 9, 1, 0, 0),
(21, 9, 1, 0, 0),
(22, 9, 1, 0, 0),
(23, 8, 1, 0, 0),
(24, 8, 1, 0, 0),
(25, 8, 1, 0, 0),
(26, 8, 1, 0, 0),
(27, 8, 1, 0, 0),
(28, 9, 1, 0, 0),
(29, 9, 1, 0, 0),
(30, 10, 1, 0, 0),
(31, 10, 1, 0, 0),
(32, 10, 1, 0, 0),
(33, 10, 1, 0, 0),
(34, 10, 1, 0, 0),
(35, 10, 1, 0, 0),
(36, 10, 1, 0, 0),
(37, 10, 1, 0, 0),
(38, 10, 1, 0, 0),
(39, 10, 1, 0, 0),
(40, 10, 1, 0, 0),
(41, 10, 1, 0, 0),
(42, 10, 1, 0, 0),
(43, 10, 1, 0, 0),
(44, 9, 1, 0, 0),
(45, 9, 1, 0, 0),
(46, 9, 1, 0, 0),
(47, 9, 1, 0, 0),
(48, 9, 1, 0, 0),
(49, 9, 1, 0, 0),
(50, 9, 1, 0, 0),
(51, 9, 1, 0, 0),
(52, 8, 1, 0, 0),
(53, 8, 1, 0, 0),
(54, 8, 1, 0, 0),
(55, 8, 1, 0, 0),
(56, 8, 1, 0, 0),
(57, 9, 1, 0, 0),
(58, 9, 1, 0, 0),
(59, 10, 1, 0, 0),
(60, 10, 1, 0, 0),
(61, 10, 1, 0, 0),
(62, 10, 1, 0, 0),
(63, 10, 1, 0, 0),
(64, 10, 1, 0, 0),
(65, 10, 1, 0, 0),
(66, 10, 1, 0, 0),
(67, 10, 1, 0, 0),
(68, 10, 1, 0, 0),
(69, 10, 1, 0, 0),
(70, 10, 1, 0, 0),
(71, 10, 1, 0, 0),
(72, 10, 1, 0, 0),
(73, 9, 1, 0, 0),
(74, 9, 1, 0, 0),
(75, 9, 1, 0, 0),
(76, 9, 1, 0, 0),
(77, 9, 1, 0, 0),
(78, 9, 1, 0, 0),
(79, 9, 1, 0, 0),
(80, 9, 1, 0, 0),
(81, 8, 1, 0, 0),
(82, 8, 1, 0, 0),
(83, 8, 1, 0, 0),
(84, 8, 1, 0, 0),
(85, 8, 1, 0, 0),
(86, 9, 1, 0, 0),
(87, 9, 1, 0, 0),
(88, 10, 1, 0, 0),
(89, 10, 1, 0, 0),
(90, 10, 1, 0, 0),
(91, 10, 1, 0, 0),
(92, 10, 1, 0, 0),
(93, 10, 1, 0, 0),
(94, 10, 1, 0, 0),
(95, 10, 1, 0, 0),
(96, 10, 1, 0, 0),
(97, 10, 1, 0, 0),
(98, 10, 1, 0, 0),
(99, 10, 1, 0, 0),
(100, 10, 1, 0, 0),
(101, 10, 1, 0, 0),
(102, 9, 1, 0, 0),
(103, 9, 1, 0, 0),
(104, 9, 1, 0, 0),
(105, 9, 1, 0, 0),
(106, 9, 1, 0, 0),
(107, 9, 1, 0, 0),
(108, 9, 1, 0, 0),
(109, 9, 1, 0, 0),
(110, 8, 1, 0, 0),
(111, 8, 1, 0, 0),
(112, 8, 1, 0, 0),
(113, 8, 1, 0, 0),
(114, 8, 1, 0, 0),
(115, 9, 1, 0, 0),
(116, 9, 1, 0, 0),
(117, 10, 1, 0, 0),
(118, 10, 1, 0, 0),
(119, 10, 1, 0, 0),
(120, 10, 1, 0, 0),
(121, 10, 1, 0, 0),
(122, 10, 1, 0, 0),
(123, 10, 1, 0, 0),
(124, 10, 1, 0, 0),
(125, 10, 1, 0, 0),
(126, 10, 1, 0, 0),
(127, 10, 1, 0, 0),
(128, 10, 1, 0, 0),
(129, 10, 1, 0, 0),
(130, 10, 1, 0, 0),
(131, 9, 1, 0, 0),
(132, 9, 1, 0, 0),
(133, 9, 1, 0, 0),
(134, 9, 1, 0, 0),
(135, 9, 1, 0, 0),
(136, 9, 1, 0, 0),
(137, 9, 1, 0, 0),
(138, 9, 1, 0, 0),
(139, 8, 1, 0, 0),
(140, 8, 1, 0, 0),
(141, 8, 1, 0, 0),
(142, 8, 1, 0, 0),
(143, 8, 1, 0, 0),
(144, 9, 1, 0, 0),
(145, 9, 1, 0, 0),
(146, 10, 1, 0, 0),
(147, 10, 1, 0, 0),
(148, 10, 1, 0, 0),
(149, 10, 1, 0, 0),
(150, 10, 1, 0, 0),
(151, 10, 1, 0, 0),
(152, 10, 1, 0, 0),
(153, 10, 1, 0, 0),
(154, 10, 1, 0, 0),
(155, 10, 1, 0, 0),
(156, 10, 1, 0, 0),
(157, 10, 1, 0, 0),
(158, 10, 1, 0, 0),
(159, 10, 1, 0, 0),
(160, 9, 1, 0, 0),
(161, 9, 1, 0, 0),
(162, 9, 1, 0, 0),
(163, 9, 1, 0, 0),
(164, 9, 1, 0, 0),
(165, 9, 1, 0, 0),
(166, 9, 1, 0, 0),
(167, 9, 1, 0, 0),
(168, 8, 1, 0, 0),
(169, 8, 1, 0, 0),
(170, 8, 1, 0, 0),
(171, 8, 1, 0, 0),
(172, 8, 1, 0, 0),
(173, 9, 1, 0, 0),
(174, 9, 1, 0, 0),
(175, 9, 1, 0, 0),
(176, 9, 1, 0, 0),
(177, 2, 1, 0, 0),
(178, 9, 2, 0, 0),
(179, 9, 6, 0, 0),
(180, 9, 7, 0, 0),
(181, 9, 3, 0, 0),
(182, 9, 4, 0, 0),
(183, 9, 2, 0, 0),
(184, 9, 6, 0, 0),
(185, 9, 4, 0, 0),
(186, 9, 1, 0, 0),
(187, 9, 2, 0, 0),
(188, 9, 1, 0, 0),
(189, 9, 1, 0, 0),
(190, 9, 1, 0, 0),
(191, 9, 1, 0, 0),
(192, 9, 1, 0, 0),
(193, 10, 1, 0, 0),
(194, 10, 1, 0, 0),
(195, 10, 1, 0, 0),
(196, 10, 1, 0, 0),
(197, 10, 1, 0, 0),
(198, 10, 1, 0, 0),
(199, 10, 1, 18, 0),
(200, 10, 1, 18, 0),
(201, 10, 1, 18, 0),
(202, 10, 1, 18, 0),
(203, 10, 1, 18, 0),
(204, 10, 1, 18, 0),
(205, 10, 1, 18, 0),
(206, 10, 1, 18, 0),
(207, 10, 1, 18, 0),
(208, 10, 1, 18, 0),
(209, 10, 1, 18, 0),
(210, 10, 1, 18, 0),
(211, 10, 1, 18, 0),
(212, 10, 1, 18, 0),
(213, 10, 1, 18, 0),
(214, 10, 1, 18, 0),
(215, 10, 1, 18, 0),
(216, 10, 1, 18, 0),
(217, 10, 1, 18, 0),
(218, 10, 1, 18, 50),
(219, 10, 1, 18, 50),
(220, 10, 1, 18, 50),
(221, 10, 1, 18, 50),
(222, 10, 1, 18, 50),
(223, 10, 1, 18, 50),
(224, 9, 3, 18, 150);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `product_id` int(11) NOT NULL,
  `present_stock` int(11) DEFAULT NULL,
  `sell_counter` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`product_id`, `present_stock`, `sell_counter`, `date`) VALUES
(1, NULL, NULL, '2018-05-05'),
(1, NULL, NULL, '2018-05-05'),
(1, NULL, NULL, '2018-05-05'),
(7, 10, NULL, '2018-05-05'),
(8, 10, NULL, '2018-05-05'),
(9, 10, NULL, '2018-05-05'),
(10, 10, NULL, '2018-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `stock_last_date`
--

CREATE TABLE `stock_last_date` (
  `product_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `shipping_address` varchar(100) NOT NULL,
  `date_entered` date NOT NULL,
  `email_verified` varchar(50) NOT NULL DEFAULT 'No',
  `user_type` varchar(100) NOT NULL,
  `entry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`, `shipping_address`, `date_entered`, `email_verified`, `user_type`, `entry_date`) VALUES
(17, 'Rashu', 'Nath', 'rashu.web@gmail.com', '1234', '1829695454', 'Patia, Chittagong, Bangladesh', '', '0000-00-00', 'Yes', 'user', '0000-00-00'),
(18, 'seller', 'Nath', 'rashu.pro@gmail.com', '1234', '1829695454', 'Patia, Chittagong, Bangladesh', '', '0000-00-00', 'Yes', 'seller', '0000-00-00'),
(19, 'Rashu', 'Nath', 'rashu@royex.net', '1234', '01829695454', 'Patia, Chittagong, Bangladesh', '', '0000-00-00', 'Yes', 'user', '0000-00-00'),
(20, 'ahmed', 'df', 'hanadsiid@gmail.com', '1234', '1829695454', 'Patia, Chittagong, Bangladesh', '', '0000-00-00', '599ee4fd3907231b811ef7488ef7a8ee', 'seller', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `seller_id` (`vendor_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_sold`
--
ALTER TABLE `product_sold`
  ADD PRIMARY KEY (`product_sold_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stock_last_date`
--
ALTER TABLE `stock_last_date`
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_sold`
--
ALTER TABLE `product_sold`
  MODIFY `product_sold_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
