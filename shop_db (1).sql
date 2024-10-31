-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 31, 2024 at 06:07 AM
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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(4, 14, 'Dieter Rose', 974, 1, 'lloyd.jpg');

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
(11, 'book'),
(12, 'post'),
(13, 'stamps');

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
(24, 14, 'Jeyaruban jenushan ', '608', 'pillers296@gmail.com', 'credit card', 'flat no. 28, Optio consectetur , Vel possimus qui co, Esse delectus iust - 87', ', four pillers296(1', 674, '16-Oct-2024', 'completed'),
(25, 25, 'Urielle Noble', '572', 'rokit@gmail.com', 'direct', 'flat no. 94, Alias accusamus volu, Fugiat expedita cons, Modi in sunt et aut - 11', ', tamilbook1(2', 460, '25-Oct-2024', 'completed'),
(26, 31, 'Quentin Acosta', '864', 'jjjjjjj@gmail.com', 'paypal', 'flat no. 60, Quaerat corrupti au, Modi quos qui non du, Et nemo modi eos qui - 74', ', Kiona Parks(1, Kiona Parks(1', 1300, '30-Oct-2024', 'pending'),
(27, 31, 'Quentin Acosta', '673', 'jjjjjjj@gmail.com', 'cash on delivery', 'flat no. 20, Qui accusamus quis l, Placeat error fugit, Ut nemo repellendus - 63', ', Kiona Parks(1, Kiona Parks(1', 1300, '30-Oct-2024', 'pending'),
(28, 23, 'a', '730', 'jjjjjjj@gmail.com', 'direct', 'flat no. 52, Et eum vitae eum aut, Ut deserunt adipisic, Et molestias volupta - 9', ', Kiona Parks(1', 650, '30-Oct-2024', 'pending');

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
(52, 'Kiona Parks', 650, 'about-img old.jpg', 363, 11),
(53, 'Ruth Golden', 578, '2.jpg', 190, 12);

-- --------------------------------------------------------

--
-- Table structure for table `productshop`
--

CREATE TABLE `productshop` (
  `product_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productshop`
--

INSERT INTO `productshop` (`product_id`, `shop_id`) VALUES
(52, 20),
(53, 19),
(53, 20),
(53, 22);

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

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_name`, `reviewr_image`, `rating`, `comment`, `created_at`) VALUES
(10, 31, 'jenushan', '../uploaded_img/author-6.jpg', 2, 'good', '2024-10-25 03:36:19'),
(11, 52, 'jenushan', '../uploaded_img/4.jpg', 4, 'ssss', '2024-10-30 15:51:33');

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
(19, 'jaffna', 'modern', 'about-img old.jpg', '2.jpg', '1.jpg'),
(20, 'colombo', 'Jaquelyn Yang', 'bash_and_lucy-2.jpg', 'istockphoto-655761512-2048x2048.jpg', '2.jpg'),
(21, 'irathinapuri', 'Quamar Curry', 'home-bg.jpg', 'shattered.jpg', 'the_world.jpg'),
(22, 'mathara', 'Colt Downs', 'lloyd.jpg', 'Untitled design (5).png', 'the_world.jpg'),
(23, 'vavuniya', 'Amos Pate', 'author-2.jpg', 'the_girl_of_ink_and_stars.jpg', 'the_happy_lemon.jpg'),
(24, 'trincomalee', 'Ray Booker', 'images.jpeg', 'the_happy_lemon.jpg', 'postcards.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` varchar(200) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(21, 'Odette Ferguson', 'jk@gmail.com', 'f970e2767d0cfe75876ea857f92e319b', 'operator'),
(22, 'ssss', 'rokit@gmail.com', '7815696ecbf1c96e6894b779456d330e', 'operator'),
(23, 'a', 'jjjjjjj@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 'user'),
(24, 'Yetta Hull', 'jeyajeya@gmail.com', '8fa14cdd754f91cc6554c9e71929cce7', 'user'),
(25, 'Urielle Noble', 'rokit@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 'user'),
(26, 'Finn Monroe', 'jj@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 'user'),
(27, 'jenushan', 'jenu@gmail.com', '363b122c528f54df4a0446b6bab05515', 'admin'),
(28, 'MacKensie Irwin', 'pillers296@gmail.com', '7694f4a66316e53c8cdd9d9954bd611d', 'admin'),
(29, 'Nyssa Weber', 'asdf@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 'user'),
(30, 'Ulysses Deleon', 'jk@gmail.com', '03c7c0ace395d80182db07ae2c30f034', 'user'),
(31, 'Quentin Acosta', 'jjjjjjj@gmail.com', '7694f4a66316e53c8cdd9d9954bd611d', 'user');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `payments_user`
--
ALTER TABLE `payments_user`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shopdetail`
--
ALTER TABLE `shopdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;