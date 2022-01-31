-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2022 at 05:52 PM
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
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=bid,2=confirmed,3=cancelled',
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `user_id`, `seller_id`, `product_id`, `bid_amount`, `status`, `date_created`) VALUES
(8, 6, 7, 6, 1111, 1, '2022-01-26 23:53:47'),
(9, 9, 0, 6, 1112, 1, '2022-01-27 00:12:45'),
(10, 7, 0, 6, 1113, 1, '2022-01-27 00:15:51'),
(11, 7, 0, 7, 2000, 1, '2022-01-27 00:24:00'),
(12, 8, 0, 6, 1114, 1, '2022-01-27 00:26:20'),
(13, 6, 0, 8, 1000, 1, '2022-01-27 04:15:03'),
(14, 6, 0, 9, 11, 1, '2022-01-27 04:20:32'),
(15, 8, 0, 11, 12, 1, '2022-01-29 11:45:56'),
(16, 8, 0, 12, 110, 1, '2022-01-29 13:51:58'),
(17, 12, 0, 13, 111, 1, '2022-01-29 13:55:26');

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
(13, 6, 'Malunggay', 'ASD asd asd', 110, 110, '2022-01-29 13:56:00', '13.jpg', '2022-01-29 13:55:06', 15);

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
(5, 'John Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', 'jsmith@sample.com', '+18456-5455-55', 'Sample', 2, '2020-10-27 14:18:32'),
(6, 'Buyer One', 'user01', 'b75705d7e35e7014521a46b532236ec3', 'christiandecembrana1@gmail.com', '09560585678', '123123123', 3, '2022-01-26 21:32:41'),
(7, 'Seller One', 'seller01', '95abc042bcdf3a5054627d31153bbd1c', '', '', '', 2, '2022-01-26 22:24:21'),
(8, 'Buyer Two', 'buyer02', 'db305ecbb43e2d52a4ceb8d1d3c5ef15', 'buyer2two@hotmail.com', '09560585678', 'Angeles City', 3, '2022-01-26 23:48:05'),
(9, 'buyer three', 'buyer03', 'fc67184aa31d13307f07fef44e625afb', 'buyer3@gmail.com', '09560585678', 'Santa Teresita', 3, '2022-01-27 00:12:16'),
(10, 'Seller02', 'seller02', '917c1b615ff7da73cb2fffa987bc9554', '', '', '', 2, '2022-01-27 00:20:50'),
(12, 'Jane Doe', 'buyer04', '36ee19333c12851819bf8c4b99651dfb', 'janedoe@gmail.com', '9123456789', 'Angeles City', 3, '2022-01-27 22:52:51'),
(15, 'Vergel Medina', 'seller03', '153ded82fa3db5c91237d579309367f7', 'seller03@gmail', '09560458797', '12345 Angeles City', 3, '2022-01-29 13:54:39'),
(16, 'Bonifacio Medina', 'seller04', '8cafe785032524d1dcfdea9f94f3312d', 'boni@gmail.com', '09560585678', 'Angeles City', 3, '2022-01-29 13:59:01'),
(17, 'buyer1001', 'buyer1001', '37cac58372f78542ae48f887d0a0db52', 'buyer1001@gmail.com', '01231231212', 'a.c.', 3, '2022-01-29 16:07:42'),
(18, 'Seller 1001', 'seller1001', '39807dea6362ad8f8550b99f436f18bf', 'seller1001@gmail.com', '09560585678', 'Angeles City', 3, '2022-01-29 16:08:20');

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
