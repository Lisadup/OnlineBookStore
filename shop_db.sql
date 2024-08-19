-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 06:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(225) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(225) NOT NULL,
  `author` varchar(225) NOT NULL,
  `genre` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(2, 11, 'Lisa du Plessis', 'lisadup21@gmail.com', '0785572341', 'Hallo I like books by the author Jenny Han. Please add more of her books to your shop. Thank you!'),
(4, 13, 'Lisa du Plessis', 'dumb@gmail.com', '0846309889', 'Hallo is this still working? Loving the logo!'),
(5, 14, 'Chad Michaelson', '20230430@ctucareer.co.za', '0846309889', 'Can you please add more comic books?');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(225) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(225) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(225) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(225) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 1, 'Lisa du Plessis', '081 696 2345', 'lisadup01@gmail.com', 'Cash on Delivery', '123 Maple Street\r\nSpringfield, IL 62704\r\nSouth Africa', 'From The Ashes(2), The Queen Of Hearts(3)', 1220, '13th August 2024', 'completed'),
(4, 11, 'Lisa du Plessis', '0795572341', 'lisadup21@gmail.com', 'cash on delivery', 'flat no. 4, Begonia Drive, Fairbridge Heights, Uitenhage, South Africa - 6229', ', To Kill A Mockingbird (1) , The Queen Of Hearts (2) , The Gilded Ones (1) , The Amazing Spider Man 001 Variant Edition (3) ', 1640, '14-Aug-2024', 'completed'),
(5, 11, 'Lisa du Plessis', '0795572341', 'lisadup21@gmail.com', 'paypal', 'flat no. 4, Begonia Drive, Fairbridge Heights, Uitenhage, South Africa - 6229', ', The Fault In Our Stars (1) , From The Ashes (1) , Queen Charlotte (1) ', 765, '14-Aug-2024', 'pending'),
(6, 13, 'Lisa du Plessis', '0863984562', 'dumb@gmail.com', 'paytm', 'flat no. 4, 4 Begonia Drive, Uitenhage, South Africa - 6229', ', Paper Father (1) , The Gilded Ones (1) , The Amazing Spider Man 001 Variant Edition (1) ', 480, '16-Aug-2024', 'pending'),
(7, 14, 'Chad Michaelson', '0923697845', '20230430@ctucareer.co.za', 'cash on delivery', 'flat no. 3, 101 Maple Street, Upngton, South Africa - 6229', ', Queen Charlotte (1) , To Kill A Mockingbird (1) , The Hypocrite World (2) ', 920, '16-Aug-2024', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(225) NOT NULL,
  `author` varchar(225) NOT NULL,
  `genre` varchar(225) NOT NULL,
  `avg_rating` decimal(3,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `author`, `genre`, `avg_rating`) VALUES
(7, 'From The Ashes', 280, 'R.jpeg', 'Louisa Koch', 'Novel', 0.00),
(13, 'Salems Lot', 150, 'R (2).jpeg', 'Stephen King', 'Horror', 0.00),
(14, 'Paper Father', 120, 'attachment_122099194-e1606150293120.avif', '123', 'Fiction', 0.00),
(15, 'The Hypocrite World', 150, 'ColorfulIllustrationYoungAdultBookCover.webp', 'Sophia Hill', 'Fiction', 0.00),
(16, 'The Queen Of Hearts', 220, 'download.jpeg', 'Kimmery Martin', 'Historical Fiction', 0.00),
(17, 'To Kill A Mockingbird', 320, 'OIP.jpeg', 'Harper Lee', 'Classic/Historical Fiction', 0.00),
(18, 'The Gilded Ones', 100, 'OIP (1).jpeg', 'Namina Forna', 'Fantasy', 0.00),
(19, 'Catching Fire', 190, 'Book.jpg', 'Suzanne Collins', 'Dystopian/Young Adult', 0.00),
(20, 'The Fault In Our Stars', 185, 'Book3.jpg', 'John Green', 'Romance/Young Adult', 0.00),
(21, 'To All The Boys Ive Loved Before', 285, 'Book4.jpg', 'Jenny Han', 'Romance/Young Adult', 0.00),
(22, 'Queen Charlotte', 300, 'Book2.jpg', 'Shonda Rhimes', 'Historical Fiction/Romance', 0.00),
(23, 'The Amazing Spider Man 001 Variant Edition', 260, 'Spiderman.jpeg', 'Dan Slott', 'Superhero/Comics', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `review` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `review`, `created_at`) VALUES
(8, 13, 7, 5, 'Wonderful Book!', '2024-08-16 14:11:42'),
(9, 13, 16, 4, 'Loved!', '2024-08-16 14:12:18'),
(10, 13, 23, 4, 'Loved the graphics and story telling', '2024-08-16 16:37:58'),
(11, 13, 14, 4, 'The author has out done himself', '2024-08-16 17:06:42'),
(12, 13, 19, 5, 'Absolutely brilliant!', '2024-08-16 17:07:11'),
(13, 14, 13, 3, 'Enjoyed the horror theme', '2024-08-16 17:34:03'),
(14, 14, 7, 4, 'Love the book cover', '2024-08-16 17:34:21'),
(15, 14, 21, 4, 'The story is very interesting', '2024-08-16 17:34:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(4, 'Lisa du Plessis', 'lisadup21@gmail.com', '826fdb0f20338a216206178f29519652', 'user'),
(6, 'admin01', 'lisawebsite2@gmail.com', 'c6f057b86584942e415435ffb1fa93d4', 'admin'),
(10, 'Spoopy', 'sillybilly@gmail.com', 'bb357b67088559a068e65834292d96b4', 'admin'),
(13, 'Lisa du Plessis', '20230430@ctucareer.co.za', '202cb962ac59075b964b07152d234b70', 'user'),
(14, 'Chad Michaelson', '20230430@ctucareer.co.za', '0189caa552598b845b29b17a427692d1', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
