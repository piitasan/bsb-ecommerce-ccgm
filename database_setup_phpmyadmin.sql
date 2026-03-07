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

--
-- Table structure for table `payment_methods_tbl`
--

CREATE TABLE `payment_methods_tbl` (
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `method_type` enum('credit_card','debit_card','gcash','paymaya','bank_transfer') NOT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `card_name` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(7) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods_tbl`
--

INSERT INTO `payment_methods_tbl` (`payment_method_id`, `user_id`, `method_type`, `card_number`, `card_name`, `expiry_date`, `cvv`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 2, 'credit_card', '****1234', 'John Doe', '12/2028', '***', 1, '2026-03-07 00:00:00', '2026-03-07 00:00:00'),
(2, 2, 'gcash', '09123456789', 'John Doe', NULL, NULL, 0, '2026-03-07 00:00:00', '2026-03-07 00:00:00'),
(3, 3, 'debit_card', '****5678', 'Jane Doe', '06/2027', '***', 1, '2026-03-07 00:00:00', '2026-03-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_tbl`
--

CREATE TABLE `wishlist_tbl` (
  `wishlist_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist_tbl`
--

INSERT INTO `wishlist_tbl` (`wishlist_id`, `user_id`, `product_id`, `created_at`) VALUES
(1, 2, 3, '2026-03-07 00:00:00'),
(2, 2, 5, '2026-03-07 00:00:00'),
(3, 2, 7, '2026-03-07 00:00:00'),
(4, 3, 1, '2026-03-07 00:00:00'),
(5, 3, 4, '2026-03-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart_tbl`
--

CREATE TABLE `cart_tbl` (
  `cart_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_tbl`
--

INSERT INTO `cart_tbl` (`cart_id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(1, 2, 1, 2, '2026-03-07 00:00:00'),
(2, 2, 3, 3, '2026-03-07 00:00:00'),
(3, 2, 9, 5, '2026-03-07 00:00:00'),
(4, 3, 5, 1, '2026-03-07 00:00:00'),
(5, 3, 7, 2, '2026-03-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`order_id`, `user_id`, `total_price`, `status`, `payment_method`, `order_date`, `updated_at`) VALUES
(1, 2, 1245.00, 'delivered', 'Credit Card', '2026-03-01 00:00:00', '2026-03-07 00:00:00'),
(2, 2, 500.00, 'processing', 'GCash', '2026-03-05 00:00:00', '2026-03-07 00:00:00'),
(3, 3, 900.00, 'pending', 'Debit Card', '2026-03-07 00:00:00', '2026-03-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items_tbl`
--

CREATE TABLE `order_items_tbl` (
  `order_item_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_category` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items_tbl`
--

INSERT INTO `order_items_tbl` (`order_item_id`, `order_id`, `product_id`, `product_name`, `product_category`, `price`, `quantity`, `subtotal`) VALUES
(1, 1, 5, 'Chocolate Cake', 'Cake', 850.00, 1, 850.00),
(2, 1, 1, 'Sourdough Loaf', 'Bread', 120.00, 2, 240.00),
(3, 1, 3, 'Croissant', 'Pastry', 65.00, 3, 195.00),
(4, 2, 9, 'Pandesal', 'Bread', 40.00, 5, 200.00),
(5, 2, 7, 'Chocolate Chip Cookies', 'Cookie', 150.00, 2, 300.00),
(6, 3, 6, 'Red Velvet Cake', 'Cake', 900.00, 1, 900.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_user_name` (`user_name`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `idx_category` (`product_category`),
  ADD KEY `idx_price` (`price`),
  ADD KEY `idx_rating` (`average_rating`);

--
-- Indexes for table `payment_methods_tbl`
--
ALTER TABLE `payment_methods_tbl`
  ADD PRIMARY KEY (`payment_method_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_user_default` (`user_id`,`is_default`);

--
-- Indexes for table `wishlist_tbl`
--
ALTER TABLE `wishlist_tbl`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD UNIQUE KEY `unique_wishlist` (`user_id`,`product_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `unique_cart_item` (`user_id`,`product_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_user_date` (`user_id`,`order_date`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `order_items_tbl`
--
ALTER TABLE `order_items_tbl`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `idx_order` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment_methods_tbl`
--
ALTER TABLE `payment_methods_tbl`
  MODIFY `payment_method_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist_tbl`
--
ALTER TABLE `wishlist_tbl`
  MODIFY `wishlist_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  MODIFY `cart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items_tbl`
--
ALTER TABLE `order_items_tbl`
  MODIFY `order_item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_methods_tbl`
--
ALTER TABLE `payment_methods_tbl`
  ADD CONSTRAINT `payment_methods_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist_tbl`
--
ALTER TABLE `wishlist_tbl`
  ADD CONSTRAINT `wishlist_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_tbl_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_tbl` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD CONSTRAINT `cart_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_tbl_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_tbl` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD CONSTRAINT `order_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items_tbl`
--
ALTER TABLE `order_items_tbl`
  ADD CONSTRAINT `order_items_tbl_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_tbl` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_tbl_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_tbl` (`product_id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
