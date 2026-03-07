-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2026 at 07:38 PM
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
-- Database: `bsb_db`
--

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `user_name`, `first_name`, `last_name`, `email`, `phone_number`, `password`, `created_at`, `updated_at`) VALUES
(1, 'testuser11', 'piita', '123', 'testuser01@gmail.com', NULL, '$2y$10$v8Qj2HurjBm91CKIs2fyEO70LtuUL1J9zE1VA2eZUmACQ9uF7wHty', '2026-02-20 18:24:40', '2026-02-20 18:24:40'),
(2, 'johndoe', 'John', 'Doe', 'john.doe@example.com', '+639123456789', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-03-07 00:00:00', '2026-03-07 00:00:00'),
(3, 'janedoe', 'Jane', 'Doe', 'jane.doe@example.com', '+639987654321', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-03-07 00:00:00', '2026-03-07 00:00:00');

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  `reviews_count` int(11) DEFAULT 0,
  `average_rating` decimal(3,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `product_category`, `product_name`, `description`, `price`, `stock_quantity`, `image_url`, `reviews_count`, `average_rating`, `created_at`, `updated_at`) VALUES
(1, 'Bread', 'Sourdough Loaf', 'Artisan sourdough bread baked fresh daily', 120.00, 50, 'sourdough.jpg', 15, 4.50, '2026-03-07 00:00:00', '2026-03-07 00:00:00'),
(2, 'Bread', 'Whole Wheat Bread', 'Healthy whole wheat bread, perfect for sandwiches', 95.00, 40, 'wheat_bread.jpg', 23, 4.30, '2026-03-07 00:00:00', '2026-03-07 00:00:00'),
(3, 'Pastry', 'Croissant', 'Buttery, flaky French croissant', 65.00, 100, 'croissant.jpg', 45, 4.80, '2026-03-07 00:00:00', '2026-03-07 00:00:00'),
(4, 'Pastry', 'Chocolate Eclair', 'Cream-filled eclair with chocolate glaze', 75.00, 30, 'eclair.jpg', 32, 4.60, '2026-03-07 00:00:00', '2026-03-07 00:00:00'),
(5, 'Cake', 'Chocolate Cake', 'Rich chocolate cake with ganache frosting', 850.00, 15, 'chocolate_cake.jpg', 28, 4.90, '2026-03-07 00:00:00', '2026-03-07 00:00:00'),
(6, 'Cake', 'Red Velvet Cake', 'Classic red velvet with cream cheese frosting', 900.00, 12, 'red_velvet.jpg', 19, 4.70, '2026-03-07 00:00:00', '2026-03-07 00:00:00'),
(7, 'Cookie', 'Chocolate Chip Cookies', 'Classic cookies with premium chocolate chips (6 pcs)', 150.00, 80, 'choc_chip_cookies.jpg', 67, 4.50, '2026-03-07 00:00:00', '2026-03-07 00:00:00'),
(8, 'Cookie', 'Oatmeal Cookies', 'Healthy oatmeal cookies with raisins (6 pcs)', 130.00, 60, 'oatmeal_cookies.jpg', 41, 4.40, '2026-03-07 00:00:00', '2026-03-07 00:00:00'),
(9, 'Bread', 'Pandesal', 'Filipino bread rolls, soft and slightly sweet (10 pcs)', 40.00, 200, 'pandesal.jpg', 89, 4.80, '2026-03-07 00:00:00', '2026-03-07 00:00:00'),
(10, 'Pastry', 'Ensaymada', 'Filipino brioche topped with butter, sugar, and cheese', 55.00, 45, 'ensaymada.jpg', 53, 4.70, '2026-03-07 00:00:00', '2026-03-07 00:00:00');

-- --------------------------------------------------------
