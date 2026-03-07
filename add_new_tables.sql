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

--
-- Add missing columns to existing `user_tbl`
--

ALTER TABLE `user_tbl` 
  ADD COLUMN IF NOT EXISTS `phone_number` varchar(20) DEFAULT NULL AFTER `email`,
  ADD COLUMN IF NOT EXISTS `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() AFTER `created_at`;

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE IF NOT EXISTS `product_tbl` (
  `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_category` varchar(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  `reviews_count` int(11) DEFAULT 0,
  `average_rating` decimal(3,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`product_id`),
  KEY `idx_category` (`product_category`),
  KEY `idx_price` (`price`),
  KEY `idx_rating` (`average_rating`)
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

--
-- Table structure for table `payment_methods_tbl`
--

CREATE TABLE IF NOT EXISTS `payment_methods_tbl` (
  `payment_method_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `method_type` enum('credit_card','debit_card','gcash','paymaya','bank_transfer') NOT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `card_name` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(7) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`payment_method_id`),
  KEY `user_id` (`user_id`),
  KEY `idx_user_default` (`user_id`,`is_default`),
  CONSTRAINT `payment_methods_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_tbl`
--

CREATE TABLE IF NOT EXISTS `wishlist_tbl` (
  `wishlist_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`wishlist_id`),
  UNIQUE KEY `unique_wishlist` (`user_id`,`product_id`),
  KEY `idx_user` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `wishlist_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `wishlist_tbl_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_tbl` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_tbl`
--

CREATE TABLE IF NOT EXISTS `cart_tbl` (
  `cart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`cart_id`),
  UNIQUE KEY `unique_cart_item` (`user_id`,`product_id`),
  KEY `idx_user` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `cart_tbl_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_tbl` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE IF NOT EXISTS `order_tbl` (
  `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `idx_user_date` (`user_id`,`order_date`),
  KEY `idx_status` (`status`),
  CONSTRAINT `order_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items_tbl`
--

CREATE TABLE IF NOT EXISTS `order_items_tbl` (
  `order_item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_category` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `idx_order` (`order_id`),
  CONSTRAINT `order_items_tbl_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_tbl` (`order_id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_tbl_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_tbl` (`product_id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
