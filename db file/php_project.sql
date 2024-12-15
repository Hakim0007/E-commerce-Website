-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2024 at 03:37 PM
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
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@email.com', '6206ecef3008238ac9d8f8a7312b7d66');

-- --------------------------------------------------------

--
-- Table structure for table `arrivals`
--

CREATE TABLE `arrivals` (
  `products_id` int(11) NOT NULL,
  `products_name` varchar(50) NOT NULL,
  `products_category` varchar(50) NOT NULL,
  `products_description` varchar(255) NOT NULL,
  `products_image` varchar(50) NOT NULL,
  `products_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arrivals`
--

INSERT INTO `arrivals` (`products_id`, `products_name`, `products_category`, `products_description`, `products_image`, `products_price`) VALUES
(1, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n1.jpg', 260.00),
(2, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n2.jpg', 280.00),
(3, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n3.jpg', 300.00),
(4, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n4.jpg', 320.00),
(5, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n5.jpg', 340.00),
(6, 'Adidas', 'shorts', 'Mens Plaid Golf Short', 'n6.jpg', 360.00),
(7, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n7.jpg', 380.00),
(8, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n8.jpg', 400.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(1, 100.00, 'not paid', 1, 67625148, 'Kuwait', 'Salmiya', '2024-04-15 23:25:26'),
(2, 260.00, 'not paid', 1, 67625148, 'Kuwait', 'Salmiya', '2024-04-15 23:26:42'),
(3, 160.00, 'delivered', 1, 67625148, 'Kuwait', 'Salmiya', '2024-04-15 23:28:11'),
(4, 380.00, 'not paid', 1, 67625148, 'Kuwait', 'Salmiya', '2024-04-15 23:29:50'),
(5, 260.00, 'not paid', 1, 67625148, 'Kuwait', 'Salmiya', '2024-04-15 23:31:34'),
(6, 600.00, 'delivered ', 1, 67625148, 'Kuwait', 'Salmiya', '2024-04-15 23:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_description` varchar(50) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_description`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 1, 1, 'Cartoon Astronaut T-Shirts', 'f1.jpg', 100.00, 1, 1, '2024-04-15 23:25:26'),
(2, 2, 2, 'Cartoon Astronaut T-Shirts', 'f2.jpg', 120.00, 1, 1, '2024-04-15 23:26:42'),
(3, 2, 3, 'Cartoon Astronaut T-Shirts', 'f3.jpg', 140.00, 1, 1, '2024-04-15 23:26:42'),
(4, 3, 4, 'Cartoon Astronaut T-Shirts', 'f4.jpg', 160.00, 1, 1, '2024-04-15 23:28:11'),
(5, 4, 5, 'Cartoon Astronaut T-Shirts', 'f5.jpg', 180.00, 1, 1, '2024-04-15 23:29:50'),
(6, 4, 6, 'Cartoon Astronaut T-Shirts', 'f6.jpg', 200.00, 1, 1, '2024-04-15 23:29:50'),
(7, 5, 9, 'Cartoon Astronaut T-Shirts', 'n1.jpg', 260.00, 1, 1, '2024-04-15 23:31:34'),
(8, 6, 10, 'Cartoon Astronaut T-Shirts', 'n2.jpg', 280.00, 1, 1, '2024-04-15 23:36:19'),
(9, 6, 12, 'Cartoon Astronaut T-Shirts', 'n4.jpg', 320.00, 1, 1, '2024-04-15 23:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_description` varchar(50) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `product_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_price`) VALUES
(1, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'f1.jpg', 100.00),
(2, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'f2.jpg', 120.00),
(3, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'f3.jpg', 140.00),
(4, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'f4.jpg', 160.00),
(5, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'f5.jpg', 180.00),
(6, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'f6.jpg', 200.00),
(7, 'Adidas', 'pants', 'Cartoon Astronaut Capri Pants', 'f7.jpg', 220.00),
(8, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'f8.jpg', 240.00),
(9, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n1.jpg', 260.00),
(10, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n2.jpg', 280.00),
(11, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n3.jpg', 300.00),
(12, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n4.jpg', 320.00),
(13, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n5.jpg', 340.00),
(14, 'Adidas', 'shorts', 'Mens Plaid Golf Short', 'n6.jpg', 360.00),
(15, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n7.jpg', 380.00),
(16, 'Adidas', 'shirts', 'Cartoon Astronaut T-Shirts', 'n8.jpg', 400.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Hakimuddin', 'ratlamhakimuddin@gmail.com', '6206ecef3008238ac9d8f8a7312b7d66'),
(2, 'Hussain', 'husain@husain.com', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `arrivals`
--
ALTER TABLE `arrivals`
  ADD PRIMARY KEY (`products_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `arrivals`
--
ALTER TABLE `arrivals`
  MODIFY `products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
