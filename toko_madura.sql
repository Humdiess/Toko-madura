-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 06:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_madura`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Alat'),
(2, 'Minuman'),
(3, 'Snack'),
(4, 'Beras'),
(5, 'Minyak'),
(6, 'Sabun');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` enum('Transfer Bank','E-Wallet') NOT NULL DEFAULT 'Transfer Bank'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `customer_email`, `total_price`, `created_at`, `payment_method`) VALUES
(35, 4, 'skomda-siswa', '123456@gmail', 10000000.00, '2024-08-26 16:08:50', ''),
(36, 4, 'skomda-siswa', '123456@gmail', 60000000.00, '2024-08-26 16:09:57', ''),
(37, 4, 'skomda-siswa', '123456@gmail', 50000000.00, '2024-08-26 16:10:06', ''),
(38, 4, 'skomda-siswa', '123456@gmail', 10000000.00, '2024-08-26 16:12:25', ''),
(39, 4, 'skomda-siswa', '123456@gmail', 10000000.00, '2024-08-26 16:12:51', ''),
(40, 4, 'skomda-siswa', '123456@gmail', 0.00, '2024-08-26 16:13:27', 'E-Wallet'),
(41, 4, 'skomda-siswa', '123456@gmail', 10003400.00, '2024-08-26 16:14:45', ''),
(42, 4, 'skomda-siswa', '123456@gmail', 10000000.00, '2024-08-26 16:14:56', 'E-Wallet'),
(43, 4, 'skomda-siswa', '123456@gmail', 3400.00, '2024-08-26 16:15:10', 'Transfer Bank'),
(44, 4, 'skomda-siswa', '123456@gmail', 10003400.00, '2024-08-26 16:15:22', 'Transfer Bank'),
(45, 4, 'skomda-siswa', '123456@gmail', 3400.00, '2024-08-26 16:15:50', 'E-Wallet'),
(46, 4, 'skomda-siswa', '123456@gmail', 10000000.00, '2024-08-26 16:24:12', ''),
(47, 4, 'skomda-siswa', '123456@gmail', 0.00, '2024-08-26 16:24:24', ''),
(48, 4, 'skomda-siswa', '123456@gmail', 0.00, '2024-08-26 16:24:33', ''),
(49, 4, 'skomda-siswa', '123456@gmail', 6800.00, '2024-08-26 16:26:03', 'Transfer Bank'),
(50, 4, 'skomda-siswa', '123456@gmail', 3400.00, '2024-08-26 16:30:46', 'Transfer Bank');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(30, 35, 5, 1, 10000000.00),
(31, 36, 5, 6, 10000000.00),
(32, 37, 5, 5, 10000000.00),
(33, 38, 5, 1, 10000000.00),
(34, 39, 5, 1, 10000000.00),
(35, 41, 5, 1, 10000000.00),
(36, 41, 9, 1, 3400.00),
(37, 42, 5, 1, 10000000.00),
(38, 43, 9, 1, 3400.00),
(39, 44, 5, 1, 10000000.00),
(40, 44, 9, 1, 3400.00),
(41, 45, 9, 1, 3400.00),
(42, 46, 5, 1, 10000000.00),
(43, 49, 9, 2, 3400.00),
(44, 50, 9, 1, 3400.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `images`, `created_at`, `category_id`) VALUES
(5, 'Musang Surabaya', 'Musang adalah hewan hitam seperti di foto', 10000000.00, 'WIN_20240730_10_54_48_Pro.jpg,WIN_20240730_10_55_15_Pro.jpg,WIN_20240730_10_55_42_Pro.jpg', '2024-08-25 02:06:31', 6),
(9, 'akusukaeskrim', 'asdasdasdas', 3400.00, '1724470893889.jpg', '2024-08-26 16:03:31', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `gmail` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `gmail`, `created_at`, `photo`) VALUES
(1, '123', '$2y$10$fNsqosPv5QCHaw1ehP/aB.jklQPkqk90Sn1MNG9a0s3I3alBUTA0G', 'user', '123@gmail', '2024-08-24 15:46:34', NULL),
(2, '1234', '$2y$10$fs1FlXybR2aNWg4zUkYcaexZZ9.ZOFUssakao2yPH3/aNO8C1KctK', 'admin', '1234@gmail', '2024-08-24 15:47:05', NULL),
(4, 'skomda-siswa', '$2y$10$68Xeqt1EzTiqAde05kTA4O09iL1OyiYbC811S1FbxmJiVi6G5xMyG', 'user', '123456@gmail', '2024-08-26 01:17:55', 'BG Tecknical meeting.png'),
(5, '5012210004', '$2y$10$DyN3DpO5paEDv1nV3xBmWe62bBNql5OHNyxisFBvGSux3GN5jQEnm', 'user', '123456@gmail3', '2024-08-26 01:24:57', '1724470893889.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_product` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `gmail` (`gmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
