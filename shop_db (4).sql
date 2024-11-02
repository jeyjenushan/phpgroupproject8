-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 02, 2024 at 07:29 AM
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
(26, 31, 'Quentin Acosta', '864', 'jjjjjjj@gmail.com', 'paypal', 'flat no. 60, Quaerat corrupti au, Modi quos qui non du, Et nemo modi eos qui - 74', ', Kiona Parks(1, Kiona Parks(1', 1300, '30-Oct-2024', 'completed'),
(27, 31, 'Quentin Acosta', '673', 'jjjjjjj@gmail.com', 'cash on delivery', 'flat no. 20, Qui accusamus quis l, Placeat error fugit, Ut nemo repellendus - 63', ', Kiona Parks(1, Kiona Parks(1', 1300, '30-Oct-2024', 'pending'),
(28, 23, 'a', '730', 'jjjjjjj@gmail.com', 'direct', 'flat no. 52, Et eum vitae eum aut, Ut deserunt adipisic, Et molestias volupta - 9', ', Kiona Parks(1', 650, '30-Oct-2024', 'pending'),
(29, 23, 'a', '98', 'jjjjjjj@gmail.com', 'direct', 'flat no. 59, Fugit do blanditiis, Voluptatibus asperio, Neque sequi dolorum  - 5', ', Kiona Parks(2', 1300, '02-Nov-2024', 'pending'),
(30, 23, 'a', '793', 'jjjjjjj@gmail.com', 'direct', 'flat no. 94, Dolore exercitatione, Aspernatur est reici, Est quam qui eos d - 73', ', Kiona Parks(1', 650, '02-Nov-2024', 'pending'),
(31, 23, 'a', '186', 'jjjjjjj@gmail.com', 'cash on delivery', 'flat no. 1, Commodo vel in qui s, Omnis veniam dolore, Voluptate officiis a - 95', ', Kiona Parks(1', 650, '02-Nov-2024', 'pending'),
(32, 23, 'a', '453', 'jjjjjjj@gmail.com', 'paypal', 'flat no. 40, Eiusmod laboriosam , Sint fuga Sunt co, Vitae ratione labori - 84', ', Kiona Parks(1', 650, '02-Nov-2024', 'pending'),
(33, 23, 'a', '999', 'jjjjjjj@gmail.com', 'paytm', 'flat no. 47, Consectetur ipsum , Praesentium temporib, Atque error do eius  - 53', ', Kiona Parks(1', 650, '02-Nov-2024', 'pending'),
(34, 23, 'a', '987', 'jjjjjjj@gmail.com', 'credit card', 'flat no. 19, Porro et sequi quod , Quidem est Nam do au, Ut dolorum alias sun - 38', ', Kiona Parks(1', 650, '02-Nov-2024', 'pending'),
(35, 23, 'a', '292', 'jjjjjjj@gmail.com', 'paypal', 'flat no. 50, Deleniti repudiandae, Consectetur recusand, Nisi non omnis repre - 28', ', Kiona Parks(1', 650, '02-Nov-2024', 'pending'),
(36, 23, 'a', '376', 'jjjjjjj@gmail.com', 'paytm', 'flat no. 95, Maxime reprehenderit, Asperiores eaque ali, Aut dolorem quo eu e - 89', ', Ruth Golden(1', 578, '02-Nov-2024', 'pending'),
(37, 23, 'a', '137', 'jjjjjjj@gmail.com', 'paytm', 'flat no. 56, Molestiae autem even, Et ut aspernatur sin, Voluptatem dolores e - 34', ', Ruth Golden(1', 578, '02-Nov-2024', 'pending'),
(38, 23, 'a', '427', 'jjjjjjj@gmail.com', 'paypal', 'flat no. 47, Dolores saepe repudi, Commodi amet commod, Et in nulla laborum - 67', ', Kiona Parks(1', 650, '02-Nov-2024', 'pending'),
(39, 23, 'a', '502', 'jjjjjjj@gmail.com', 'paypal', 'flat no. 51, Doloremque aliquip q, Minima consequatur , Possimus qui sed eo - 21', ', Kiona Parks(1', 650, '02-Nov-2024', 'pending'),
(40, 23, 'a', '52', 'jjjjjjj@gmail.com', 'credit card', 'flat no. 86, Veritatis non nisi m, Reprehenderit sunt t, Cum amet in molesti - 97', ', Kiona Parks(1', 650, '02-Nov-2024', 'pending'),
(41, 23, 'a', '556', 'jjjjjjj@gmail.com', 'cash on delivery', 'flat no. 5, Sed nulla anim dolor, Quam dolor libero ve, Perferendis eveniet - 28', ', Kiona Parks(1', 650, '02-Nov-2024', 'pending'),
(42, 23, 'a', '202', 'jjjjjjj@gmail.com', 'direct', 'flat no. 21, Ut omnis quo mollit , jaffna, Dolores exercitation - 35', ', Ruth Golden(1', 578, '02-Nov-2024', 'pending'),
(43, 23, 'a', '968', 'jjjjjjj@gmail.com', 'direct', 'flat no. 88, Fugiat voluptatem cu, jaffna, Tenetur tempor ut in - 74', ', Ruth Golden(1', 578, '02-Nov-2024', 'pending'),
(44, 23, 'a', '895', 'jjjjjjj@gmail.com', 'direct', 'flat no. 39, Explicabo Porro eum, Repellendus Ad sit, Quidem facere minim  - 17', ', Ruth Golden(1', 578, '02-Nov-2024', 'pending'),
(45, 23, 'a', '434', 'jjjjjjj@gmail.com', 'direct', 'flat no. 47, Aliqua Dolores dolo, jaffna, Id nisi excepteur s - 59', ', Ruth Golden(1', 578, '02-Nov-2024', 'pending'),
(46, 23, 'a', '374', 'jjjjjjj@gmail.com', 'direct', 'flat no. 60, Minim veniam aliqui, jaffna, Doloremque velit dol - 27', ', Kiona Parks(1', 650, '02-Nov-2024', 'pending'),
(47, 23, 'a', '811', 'jjjjjjj@gmail.com', 'direct', 'flat no. 71, Voluptas quis sed nu, jaffna, Quo non aliquip pari - 97', ', Ruth Golden(1', 578, '02-Nov-2024', 'pending'),
(48, 23, 'a', '178', 'jjjjjjj@gmail.com', 'paytm', 'flat no. 65, Eos consectetur occa, Totam quia quibusdam, Ut et ad excepteur i - 27', ', Ruth Golden(1', 578, '02-Nov-2024', 'pending');

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
(52, 'Kiona Parks', 650, 'about-img old.jpg', 341, 11),
(53, 'Ruth Golden', 578, '2.jpg', 341, 12);

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
(53, 19),
(53, 20),
(53, 22),
(52, 20);

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
  `user_type` varchar(200) NOT NULL DEFAULT 'user',
  `session_id` varchar(64) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `session_id`, `created_at`, `updated_at`) VALUES
(14, 'Jeyaruban jenushan ', 'pillers296@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', NULL, '2024-11-01 23:41:53', '2024-11-01 23:41:53'),
(16, 'ran', 'ran@gmail.com', '0420d605d97eb746182ce4101970b03a', 'admin', NULL, '2024-11-01 23:41:53', '2024-11-01 23:41:53'),
(17, 'dara', 'dara@gmail.com', 'afa2f30a26a5401b4ee1121f374b81d4', 'admin', NULL, '2024-11-01 23:41:53', '2024-11-01 23:41:53'),
(18, 'dara2', 'dara2@gmail.com', '400410434b899fc6c6644c479bab2c46', 'operator', NULL, '2024-11-01 23:41:53', '2024-11-01 23:41:53'),
(19, 'danindu_ransika', 'daninduransika@gmail.com', 'e1ec310eceb09a9115059ee09b640077', 'operator', NULL, '2024-11-01 23:41:53', '2024-11-01 23:41:53'),
(20, 'danindu', 'danindu@gmail.com', 'afa2f30a26a5401b4ee1121f374b81d4', 'admin', NULL, '2024-11-01 23:41:53', '2024-11-01 23:41:53'),
(21, 'tharindu', 'tharindu@gmail.com', '22dcf0b5cd454a39a2a7552abe14ead6', 'user', NULL, '2024-11-01 23:41:53', '2024-11-01 23:41:53'),
(22, 'thejan', 'thejan@gmail.com', 'e28fa0f3d9ab9ca4ca6ca436b54bff0b', 'user', NULL, '2024-11-01 23:41:53', '2024-11-01 23:41:53'),
(23, 'kenu', 'kenu@gmail.com', '3d5d048c106fa03d92540e869d695c20', 'admin', NULL, '2024-11-01 23:41:53', '2024-11-01 23:41:53'),
(24, 'gam', 'gam@gmail.com', '174006d087bb4c0f7274ad9209612fe2', 'user', NULL, '2024-11-01 23:41:53', '2024-11-01 23:41:53'),
(25, 'kavi', 'kavi@gmail.com', '18ed16e695692e468115225f163464b0', 'admin', NULL, '2024-11-01 23:41:53', '2024-11-01 23:41:53'),
(26, 'rami', 'rami@gmail.com', '7b93bc9e19f7023489bb784cc364d67b', 'user', '94f1a15069c58c3b53793698531034c0d95b0a37d639b611c4e26eb89245c4b3', '2024-11-01 23:41:53', '2024-11-02 06:25:19');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
