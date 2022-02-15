-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2022 at 04:00 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bidding_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_id` int(30) NOT NULL,
  `bid_amount` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=bid,2=confirmed,3=paid, 4=shipped, 5=delivered, 6=cancelled',
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `user_id`, `seller_id`, `product_id`, `bid_amount`, `status`, `date_created`) VALUES
(18, 21, 0, 15, 400, 5, '2022-02-15 02:24:47'),
(19, 21, 0, 16, 499, 3, '2022-02-15 02:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(6, 'Indoor'),
(7, 'Outdoor');

-- --------------------------------------------------------

--
-- Table structure for table `chatlog`
--

CREATE TABLE `chatlog` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatlog`
--

INSERT INTO `chatlog` (`id`, `sender_id`, `receiver_id`, `message`, `date_created`) VALUES
(30, 7, 6, 'This is seller02 messaging', '2022-01-27 23:25:27'),
(31, 7, 8, 'This is seller02 messaging', '2022-01-27 23:26:19'),
(32, 8, 7, 'This is buyer02 to seller one  speaking', '2022-01-27 23:29:10'),
(33, 7, 8, 'Affirmative, seller1 to buyer2', '2022-01-27 23:29:37'),
(34, 1, 6, 'This is admin to buyer02  speaking', '2022-01-27 23:30:06'),
(35, 1, 8, 'This is admin to buyer2 speaking', '2022-01-27 23:30:23'),
(36, 8, 1, 'affirmative admin!', '2022-01-27 23:30:32'),
(37, 7, 1, 'par may problema tayo!', '2022-01-27 23:32:07'),
(38, 1, 7, 'ano problema naten par? admin toh', '2022-01-27 23:32:29'),
(39, 7, 1, 'ayun par par okay na! nasend na message mo', '2022-01-27 23:32:56'),
(40, 8, 7, 'Hello!', '2022-01-28 11:51:02'),
(41, 8, 7, 'Admin speaking', '2022-01-28 11:53:32'),
(42, 8, 7, 'Hi admin', '2022-01-28 11:53:54'),
(43, 8, 7, 'adasdasd', '2022-01-28 11:54:40'),
(44, 8, 7, 'asd', '2022-01-28 11:54:47'),
(45, 1, 8, 'aaaa', '2022-01-28 11:55:20'),
(46, 8, 1, 'zzzzzzzzzzz', '2022-01-28 11:55:41'),
(47, 1, 8, 'bbbbbbb', '2022-01-28 11:55:54'),
(48, 8, 1, 'admin please support', '2022-01-28 12:09:06'),
(49, 1, 8, 'wazup', '2022-01-29 11:23:19'),
(50, 1, 8, 'how are you?', '2022-01-29 11:23:27'),
(51, 8, 1, 'Pre?!', '2022-01-29 11:45:03'),
(52, 1, 8, 'sup?', '2022-01-29 11:45:13'),
(53, 1, 8, 'Congrats, you win the bid, please pay here: https://pm.link/infiniteGreen-wYebmcuj2scuNGEnw3EbZEgy/test/QYcn7rx', '2022-01-29 11:49:04'),
(54, 15, 12, 'Congratulations! Proceed to Payment https://pm.link/infiniteGreen-wYebmcuj2scuNGEnw3EbZEgy/test/4UbbDEy', '2022-01-29 13:56:43'),
(55, 12, 15, 'Thank you, I will pay now', '2022-01-29 13:59:48'),
(56, 7, 1, 'paano po mag payment un customer?\r\n', '2022-01-29 14:05:58'),
(57, 1, 7, 'send paymonggo', '2022-01-29 14:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `order_info_cod`
--

CREATE TABLE `order_info_cod` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(512) NOT NULL,
  `total_amt` int(11) NOT NULL,
  `trx_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_info_cod`
--

INSERT INTO `order_info_cod` (`order_id`, `user_id`, `address`, `total_amt`, `trx_id`) VALUES
(30, 50, 'Santa Teresita, Angeles City', 10000, '30DCC778-0B7E-4E1D-BCFE-785F4DE7E3CA'),
(450, 50, 'Santa Teresita, Angeles City', 10000, '450F6975-6E11-4531-BA76-6CF980E20AC2'),
(990, 50, 'Santa Teresita, Angeles City', 10000, '990BAE99-155B-4A32-A63B-02A49C28FC3C'),
(8333, 50, 'Santa Teresita, Angeles City', 10000, '8333CF1C-7BD4-4F85-B31E-C3347287A408'),
(1693936, 50, 'Santa Teresita, Angeles City', 10000, 'D464AA58-571D-4BD4-AEE6-253DE0316CE9'),
(1693937, 50, 'Santa Teresita, Angeles City', 10000, 'A4711021-97C0-4EC7-B4F2-170EC34DED8A');

-- --------------------------------------------------------

--
-- Table structure for table `order_info_gcash`
--

CREATE TABLE `order_info_gcash` (
  `id` int(10) NOT NULL,
  `order_id` varchar(512) NOT NULL,
  `trx_id` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(256) NOT NULL,
  `account_name` varchar(64) NOT NULL,
  `account_number` int(64) NOT NULL,
  `total_amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_info_gcash`
--

INSERT INTO `order_info_gcash` (`id`, `order_id`, `trx_id`, `user_id`, `address`, `account_name`, `account_number`, `total_amt`) VALUES
(9, '', '', 49, 'Santa Teresita, Angeles City', 'John Doe', 0, 999),
(10, 'pay_Wr5ve9iJUNSjNcAEJeybr3iF', '', 49, 'Santa Teresita, Angeles City', 'John Doe', 2147483647, 2997),
(11, 'pay_seix56vZsGTgt6uMke9c8Eyx', '', 50, 'Santa Teresita, Angeles City', 'John Doe', 2147483647, 4995),
(12, 'pay_pSbvB6a2Yh9PxjWWo4Cxovbe', '', 50, 'Santa Teresita, Angeles City', 'John Doe', 2147483647, 10000),
(13, 'pay_kHtdJLQTgwz297AR5wbWkdg8', '', 50, 'Santa Teresita, Angeles City', 'John Doe', 2147483647, 10000),
(14, '', '', 21, 'Santa Teresita', 'Buyer 01', 0, 400),
(15, 'pay_PtYwoDPAfvwV29Usk5ediFzv', '', 21, 'Santa Teresita', 'Buyer 01', 2147483647, 400),
(16, 'pay_B3pQQZ2RVYE8h4DG1rkLbbJ4', '', 21, 'Santa Teresita', 'Buyer 01', 2147483647, 400),
(17, 'pay_HUjZoJskTG2QK2YNVLkXahTh', '', 21, 'Santa Teresita', 'Buyer 01', 2147483647, 400),
(18, 'pay_wZ7xDt4PcHGm2BPSVdZDrWjT', '', 21, 'Santa Teresita', 'Buyer 01', 2147483647, 400),
(19, 'pay_gv7HLgEuXvb1CQuoYuzqEo21', '', 21, 'Santa Teresita', 'Buyer 01', 2147483647, 400),
(20, 'pay_hBTQkKvAoqWYKjZ3sxyiL2cA', '', 21, 'Santa Teresita', 'Buyer 01', 2147483647, 499);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `start_bid` float NOT NULL,
  `regular_price` float NOT NULL,
  `bid_end_datetime` datetime NOT NULL,
  `img_fname` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `start_bid`, `regular_price`, `bid_end_datetime`, `img_fname`, `date_created`, `seller_id`) VALUES
(11, 6, 'Malunggay', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Integer quis auctor elit sed vulputate. Venenatis cras sed felis eget. Cursus eget nunc scelerisque viverra mauris in. Non odio euismod lacinia at quis.', 10, 10, '2022-01-29 11:47:00', '11.jpg', '2022-01-29 11:25:11', 1),
(12, 7, 'Malunggay', 'asdasdsadasd', 110, 110, '2022-01-29 13:52:00', '12.jpg', '2022-01-29 13:51:25', 10),
(13, 6, 'Malunggay', 'ASD asd asd', 110, 110, '2022-01-29 13:56:00', '13.jpg', '2022-01-29 13:55:06', 15),
(14, 6, 'Malunggay', 'aasdasdasd', 110, 110, '2022-01-31 18:30:00', '14.jpg', '2022-01-31 18:27:43', 22),
(15, 6, 'Test Bid #1', 'Desc', 9999, 9999, '2022-02-13 17:00:00', '15.jpg', '2022-02-13 17:51:27', 29),
(16, 6, 'Test Bid #2', 'Decs', 10, 10, '2022-02-13 18:31:00', '16.jpg', '2022-02-13 18:30:00', 29);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Infinite Green: Auction', 'info@infinitegreen.com', '+6948 8542 623', '1643214420_latest4.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is &lt;/span&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;&lt;b style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;simply &lt;/b&gt;&lt;/span&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of&lt;/span&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;&lt;b style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt; Lorem Ipsum&lt;/b&gt;&lt;/span&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Admin,2=Seller,3=Buyer',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `contact`, `address`, `type`, `date_created`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'admin@admin.com', '+123456789', '', 1, '2020-10-27 09:19:59'),
(21, 'Buyer 01', 'buyer01', '62567214a2590144eaffd7602194c75d', 'christiandecembrana1@gmail.com', '09560585678', 'Santa Teresita', 3, '2022-01-31 18:18:11'),
(22, 'Seller 012', 'seller012', '95abc042bcdf3a5054627d31153bbd1c', 'christiandecembrana1@gmail.com', '09560585678', 'Santa teresita', 0, '2022-01-31 18:18:28'),
(23, 'Christian Paul', '123123', '165c468905fa4e852e23d2ab8ab2c33a', 'christiandecembrana1@gmail.com', '09560585678', '123123', 2, '2022-01-31 18:21:14'),
(24, 'Christian Paul', '123', '4297f44b13955235245b2497399d7a93', 'christiandecembrana1@gmail.com', '12312', '213123', 2, '2022-01-31 18:21:39'),
(25, 'Christian Paul', '123123asdasd', '6e0f535a5544717591d615d3a264d43e', 'christiandecembrana1@gmail.com', '09560585678', 'as', 2, '2022-01-31 18:22:21'),
(26, 'Christian Paul', ' ada123 ', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'christiandecembrana1@gmail.com', '09560585678', 'asd', 2, '2022-01-31 18:22:44'),
(27, 'Seller02', 'seller02', '917c1b615ff7da73cb2fffa987bc9554', 'christiandecembrana1@gmail.com', '09560585678', 'asd sdasd', 2, '2022-01-31 18:23:03'),
(28, 'seller 03', 'seller03', '153ded82fa3db5c91237d579309367f7', 'seller03@gmail.com', '09560585678', 'Santa Teresita', 2, '2022-01-31 18:23:33'),
(29, 'Christian 01', 'seller01', '95abc042bcdf3a5054627d31153bbd1c', 'seller01@gmail.com', '09560585678', 'Santa teresita AC', 2, '2022-02-13 17:50:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatlog`
--
ALTER TABLE `chatlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_info_cod`
--
ALTER TABLE `order_info_cod`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_info_gcash`
--
ALTER TABLE `order_info_gcash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
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
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chatlog`
--
ALTER TABLE `chatlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `order_info_cod`
--
ALTER TABLE `order_info_cod`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1693938;

--
-- AUTO_INCREMENT for table `order_info_gcash`
--
ALTER TABLE `order_info_gcash`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
