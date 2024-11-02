-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 07:05 AM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(8, 'flayers'),
(9, 'books'),
(10, 'post');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(23, 21, 'tharindu', '5566', 'tharindu@gmail.com', 'cash on delivery', 'flat no. 23224, ki, hhj, hhu - 44', ', sfd(1', 125, '31-Oct-2024', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payments_user`
--

CREATE TABLE `payments_user` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` varchar(200) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Payment_mode` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `quantity`, `category_id`) VALUES
(10, 'sfd', 125, 'IMG-20240712-WA0066.jpg', 8, 9);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `reviewr_image` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopdetail`
--

CREATE TABLE `shopdetail` (
  `id` int(11) NOT NULL,
  `location` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `shop_image1` varchar(200) NOT NULL,
  `shop_image2` varchar(200) NOT NULL,
  `shop_image3` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopdetail`
--

INSERT INTO `shopdetail` (`id`, `location`, `name`, `shop_image1`, `shop_image2`, `shop_image3`) VALUES
(19, 'dfghj', 'wdsfdes', 'IMG-20240712-WA0066.jpg', 'IMG-20240717-WA0072.jpg', 'IMG-20240718-WA0108.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` varchar(200) NOT NULL DEFAULT 'user',
  `session_id` varchar(64) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `session_id`, `created_at`, `updated_at`) VALUES
(14, 'Jeyaruban jenushan ', 'pillers296@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', NULL, '2024-11-02 05:11:53', '2024-11-02 05:11:53'),
(16, 'ran', 'ran@gmail.com', '0420d605d97eb746182ce4101970b03a', 'admin', NULL, '2024-11-02 05:11:53', '2024-11-02 05:11:53'),
(17, 'dara', 'dara@gmail.com', 'afa2f30a26a5401b4ee1121f374b81d4', 'admin', NULL, '2024-11-02 05:11:53', '2024-11-02 05:11:53'),
(18, 'dara2', 'dara2@gmail.com', '400410434b899fc6c6644c479bab2c46', 'operator', NULL, '2024-11-02 05:11:53', '2024-11-02 05:11:53'),
(19, 'danindu_ransika', 'daninduransika@gmail.com', 'e1ec310eceb09a9115059ee09b640077', 'operator', NULL, '2024-11-02 05:11:53', '2024-11-02 05:11:53'),
(20, 'danindu', 'danindu@gmail.com', 'afa2f30a26a5401b4ee1121f374b81d4', 'admin', NULL, '2024-11-02 05:11:53', '2024-11-02 05:11:53'),
(21, 'tharindu', 'tharindu@gmail.com', '22dcf0b5cd454a39a2a7552abe14ead6', 'user', NULL, '2024-11-02 05:11:53', '2024-11-02 05:11:53'),
(22, 'thejan', 'thejan@gmail.com', 'e28fa0f3d9ab9ca4ca6ca436b54bff0b', 'user', NULL, '2024-11-02 05:11:53', '2024-11-02 05:11:53'),
(23, 'kenu', 'kenu@gmail.com', '3d5d048c106fa03d92540e869d695c20', 'admin', NULL, '2024-11-02 05:11:53', '2024-11-02 05:11:53'),
(24, 'gam', 'gam@gmail.com', '174006d087bb4c0f7274ad9209612fe2', 'user', NULL, '2024-11-02 05:11:53', '2024-11-02 05:11:53'),
(25, 'kavi', 'kavi@gmail.com', '18ed16e695692e468115225f163464b0', 'admin', NULL, '2024-11-02 05:11:53', '2024-11-02 05:11:53'),
(26, 'rami', 'rami@gmail.com', '7b93bc9e19f7023489bb784cc364d67b', 'user', '87e41159a2fb0ff933552cdfe83bce6831e069c4d705b43d08fb700df5f25b9a', '2024-11-02 05:11:53', '2024-11-02 05:29:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments_user`
--
ALTER TABLE `payments_user`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopdetail`
--
ALTER TABLE `shopdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payments_user`
--
ALTER TABLE `payments_user`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shopdetail`
--
ALTER TABLE `shopdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
