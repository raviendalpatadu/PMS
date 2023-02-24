-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2021 at 02:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(500) DEFAULT NULL,
  `customer_address` varchar(500) DEFAULT NULL,
  `customer_telephone` int(11) DEFAULT NULL,
  `customer_type` varchar(500) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_name`, `customer_address`, `customer_telephone`, `customer_type`) VALUES
(1, 'ravien', 'bandarwela', 79298198, 'loyalty'),
(2, 'namalie', 'bandaraela', 87981327, 'online');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drug`
--

CREATE TABLE `tbl_drug` (
  `drug_id` int(11) NOT NULL,
  `drug_name` varchar(500) NOT NULL DEFAULT '',
  `drug_brand` varchar(500) NOT NULL DEFAULT '',
  `drug_description` varchar(250) NOT NULL,
  `drug_stock` int(11) NOT NULL COMMENT 'remaining stock',
  `drug_price` float NOT NULL,
  `drug_expDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_drug`
--

INSERT INTO `tbl_drug` (`drug_id`, `drug_name`, `drug_brand`, `drug_description`, `drug_stock`, `drug_price`, `drug_expDate`) VALUES
(3, 'zeoS', 'jnkjn', 'kkjkjkj', 7975, 10, '2022-12-14'),
(5, 'piriton', '798', '2250mg', 185, 100, '2022-01-07'),
(9, 'ravien', 'rav', 'vdsvdsv\r\n', 69, 1234, '2022-01-19'),
(10, 'qw', 'jnkjn', 'sds', 12118, 13, '2021-12-31'),
(12, 'drug new', 'brand', '100mg', 29911, 9, '2022-11-30'),
(17, 'testing', '12', 'fbwrrbbwrt', 1, 3, '2022-03-09'),
(18, 'snsndma', '2', 'fdgsgdsgs', 880, 21, '2021-12-31'),
(21, 'sadas', '12', 'efegwergw', 2, 22, '2022-11-30'),
(24, 'xsf', '2312', 'grwrwegrwe', 316, 32, '2022-11-30'),
(26, 'insulin', 'jnkjn', '250ml', 1231, 1231, '2022-11-30'),
(27, 'hjhjhj', 'hjh', '78ml', 898, 78, '2022-12-09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `login_id` int(11) NOT NULL,
  `user_fk` int(11) NOT NULL,
  `login_username` varchar(500) NOT NULL,
  `login_password` varchar(500) NOT NULL,
  `login_type` varchar(500) NOT NULL,
  `login_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`login_id`, `user_fk`, `login_username`, `login_password`, `login_type`, `login_created`) VALUES
(2, 2, 'admin@gm.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', '2021-05-07 15:37:31'),
(5, 5, 'akon@gm.com', 'bfbfcc9642b71f791069b8e544fff6eb0ffbf16a', 'Staff', '2021-05-06 14:48:50'),
(6, 6, 'bkon@gm.com', '4b1c48c06ed3586491c315d20ed52a84572c61ba', 'Staff', '2021-05-07 14:15:41'),
(7, 7, 'a@gm.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Admin', '2021-05-08 14:28:49'),
(8, 8, 'ckon@gm.com', '0a50d250bc367149ca66ea3ab6418eeec3d85edf', 'Staff', '2021-05-07 15:36:01'),
(9, 9, 'dg@gm.com', 'd2d359e4ae582adac36781910ecc7abbb6c45854', '', '2021-11-10 05:32:20'),
(10, 10, 'client@gm.com', 'd2a04d71301a8915217dd5faf81d12cffd6cd958', 'User', '2021-11-10 05:44:57'),
(11, 11, 'client1@gm.com', 'd642fef420c5baa4c72f53de9426f1ed699899e2', 'User', '2021-11-12 13:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `order_id` varchar(60) NOT NULL,
  `user_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_address` varchar(500) NOT NULL,
  `order_mobile` int(13) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `order_id`, `user_id`, `drug_id`, `order_qty`, `order_date`, `order_address`, `order_mobile`, `order_status`, `paid`) VALUES
(1, 'U5PPmJoJiChD4cVnhlGPdb2RnZVk4M0sgObme0BO1zZwmIc3NjbvUhvTbnv', 10, 3, 11, '2021-11-17 18:29:46', 'bandarawel', 122345, 'Shipped', 1),
(2, 'U5PPmJoJiChD4cVnhlGPdb2RnZVk4M0sgObme0BO1zZwmIc3NjbvUhvTbnv', 10, 5, 23, '2021-11-17 18:29:46', 'bandarawela', 122345, 'Shipped', 1),
(3, 'U5PPmJoJiChD4cVnhlGPdb2RnZVk4M0sgObme0BO1zZwmIc3NjbvUhvTbnv', 10, 10, 34, '2021-11-17 18:29:46', 'bandarawela', 122345, 'Shipped', 1),
(4, 'qxFrKgcdpmmkXfObv8hGqclXNCiMkr4MrPSjxY2qVuJO3Llwh8rmOSa23Y8', 11, 18, 100, '2021-11-17 18:37:45', 'jsfhsajkshfk', 37187368, 'Shipped', 1),
(5, 'qxFrKgcdpmmkXfObv8hGqclXNCiMkr4MrPSjxY2qVuJO3Llwh8rmOSa23Y8', 11, 21, 1, '2021-11-17 18:37:45', 'jsfhsajkshfk', 37187368, 'Shipped', 1),
(6, 's7dtjmAFyn7fGqffxYHaxYlPZb7fYPAorURMxfXKhYp7UApsJ5qtvp9Lqyv', 11, 18, 5, '2021-11-27 23:56:36', 'dgsd', 4243242, 'Shipped', 1),
(7, 's7dtjmAFyn7fGqffxYHaxYlPZb7fYPAorURMxfXKhYp7UApsJ5qtvp9Lqyv', 11, 24, 4, '2021-11-27 23:56:36', 'dgsd', 4243242, 'Shipped', 1),
(8, 'QfYdngbg0tFLQq01K0uvNTgYFpl71aKKpVtFpPZxzS8L8KD5OgyCxvhNOML', 10, 3, 10, '2021-11-29 22:06:13', 'jjhjk', 45768, 'preparing', 1),
(9, 'QfYdngbg0tFLQq01K0uvNTgYFpl71aKKpVtFpPZxzS8L8KD5OgyCxvhNOML', 10, 5, 4, '2021-11-29 22:06:13', 'jjhjk', 45768, 'preparing', 1),
(10, 'QfYdngbg0tFLQq01K0uvNTgYFpl71aKKpVtFpPZxzS8L8KD5OgyCxvhNOML', 10, 10, 1, '2021-11-29 22:06:13', 'jjhjk', 45768, 'preparing', 1),
(11, 'QfYdngbg0tFLQq01K0uvNTgYFpl71aKKpVtFpPZxzS8L8KD5OgyCxvhNOML', 10, 9, 1, '2021-11-29 22:06:13', 'jjhjk', 45768, 'preparing', 1),
(12, 'QfYdngbg0tFLQq01K0uvNTgYFpl71aKKpVtFpPZxzS8L8KD5OgyCxvhNOML', 10, 12, 1, '2021-11-29 22:06:13', 'jjhjk', 45768, 'preparing', 1),
(13, 'QfYdngbg0tFLQq01K0uvNTgYFpl71aKKpVtFpPZxzS8L8KD5OgyCxvhNOML', 10, 18, 1, '2021-11-29 22:06:13', 'jjhjk', 45768, 'preparing', 1),
(14, 'lWgHscdDBLrnKQIFh8YfOzXTB8WSuqwdSuWlTX8y4wBedTqgE6EwwUkVnZu', 10, 3, 13, '2021-12-26 19:18:46', 'lkjklkj', 7156165, 'preparing', 1),
(15, 'lWgHscdDBLrnKQIFh8YfOzXTB8WSuqwdSuWlTX8y4wBedTqgE6EwwUkVnZu', 10, 9, 9, '2021-12-26 19:18:46', 'lkjklkj', 7156165, 'preparing', 1),
(16, 'lWgHscdDBLrnKQIFh8YfOzXTB8WSuqwdSuWlTX8y4wBedTqgE6EwwUkVnZu', 10, 18, 3, '2021-12-26 19:18:46', 'lkjklkj', 7156165, 'preparing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_return`
--

CREATE TABLE `tbl_return` (
  `receipt_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `return_date` date NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `return_qunatity` int(11) NOT NULL,
  `return_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `sales_reciptId` int(11) NOT NULL,
  `sales_drugId` int(11) NOT NULL,
  `sales_customerId` int(11) DEFAULT NULL,
  `sales_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sales_quantity` int(255) NOT NULL,
  `sales_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`sales_reciptId`, `sales_drugId`, `sales_customerId`, `sales_date`, `sales_quantity`, `sales_price`) VALUES
(1, 3, NULL, '2021-05-17 07:14:46', 1, 0),
(2, 10, NULL, '2021-05-24 07:15:52', 1, 0),
(3, 3, NULL, '2021-05-01 07:33:23', 1, 11),
(4, 10, NULL, '2021-05-26 07:34:03', 1, 1),
(5, 3, NULL, '2021-05-01 07:35:07', 1, 1),
(6, 10, NULL, '2021-05-01 07:36:04', 1, 1.25),
(7, 10, NULL, '2021-05-01 08:09:50', 12, 132),
(8, 12, NULL, '2021-05-27 08:09:50', 12, 107748),
(9, 12, NULL, '2021-05-01 11:17:29', 1, 8979),
(10, 10, NULL, '2021-05-01 11:18:09', 1, 11),
(11, 9, NULL, '2021-05-02 14:06:29', 1, 1234),
(12, 9, NULL, '2021-05-01 14:07:03', 1, 1234),
(13, 12, NULL, '2021-05-29 16:52:35', 20, 18),
(14, 9, NULL, '2021-05-29 16:52:58', 20, 2468),
(15, 9, NULL, '2021-05-16 17:34:35', 1, 1234),
(16, 5, NULL, '2021-05-22 16:53:36', 20, 300),
(17, 5, NULL, '2021-05-23 08:55:27', 6, 600),
(18, 12, NULL, '2021-05-27 08:55:27', 10, 90),
(19, 10, NULL, '2021-05-19 13:33:39', 5, 65),
(20, 24, NULL, '2021-05-19 16:43:20', 7, 224),
(21, 18, NULL, '2021-05-19 16:43:20', 5, 105),
(22, 18, NULL, '2021-05-19 17:24:27', 4, 84),
(23, 17, NULL, '2021-05-29 16:57:21', 11, 33),
(24, 9, NULL, '2021-05-31 14:39:29', 16, 19744),
(25, 12, NULL, '2021-06-03 14:15:32', 10, 90),
(26, 5, NULL, '2021-06-03 14:15:32', 20, 2000),
(27, 9, NULL, '2021-06-03 14:15:32', 12, 14808),
(28, 12, NULL, '2021-07-15 15:51:46', 67, 603),
(29, 5, NULL, '2021-07-15 15:51:49', 76, 7600);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `sup_id` int(11) NOT NULL,
  `sup_name` varchar(500) NOT NULL,
  `sup_address` varchar(500) DEFAULT NULL,
  `sup_telephone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supply`
--

CREATE TABLE `tbl_supply` (
  `batch_id` int(11) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `drug_expDate` date NOT NULL,
  `drug_stock` int(11) NOT NULL COMMENT 'purchased stock',
  `sup_date` date NOT NULL,
  `sup_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(250) NOT NULL,
  `user_lname` varchar(250) DEFAULT NULL,
  `user_mobile` int(11) NOT NULL,
  `user_address` varchar(500) DEFAULT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_fname`, `user_lname`, `user_mobile`, `user_address`, `user_email`, `user_created`) VALUES
(2, 'Admin', 'Abcdef', 1231234, 'banadarawela', 'admin@gm.com', '2021-05-07 13:52:38'),
(5, 'Akon', 'Akonn', 123213421, 'ssna', 'akon@gm.com', '2021-05-06 18:12:08'),
(6, 'Bkon', 'Bkk', 2893173, 'banadarawela', 'bkon@gm.com', '2021-05-07 14:15:18'),
(7, 'A', 'B', 57856, 'c', 'a@gm.com', '2021-05-08 14:27:57'),
(8, 'ckon', '87', 78341, 'sjabh', 'ckon@gm.com', '2021-05-07 15:36:01'),
(9, 'dg', 'hgh', 6786876, 'ghhgh', 'dg@gm.com', '2021-11-10 05:32:20'),
(10, 'client', 'client', 23423423, 'client', 'client@gm.com', '2021-11-10 05:42:34'),
(11, 'client1', 'client', 45645664, 'jkhjkhkj', 'client1@gm.com', '2021-11-12 13:37:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_drug`
--
ALTER TABLE `tbl_drug`
  ADD PRIMARY KEY (`drug_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `login_username` (`login_username`),
  ADD KEY `user_fk` (`user_fk`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `drug_id` (`drug_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_return`
--
ALTER TABLE `tbl_return`
  ADD PRIMARY KEY (`receipt_id`,`drug_id`) USING BTREE,
  ADD KEY `customer` (`customer_id`),
  ADD KEY `drug` (`drug_id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`sales_reciptId`),
  ADD KEY `sales_drugId` (`sales_drugId`),
  ADD KEY `sales_customerId` (`sales_customerId`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `tbl_supply`
--
ALTER TABLE `tbl_supply`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `FK_tbl_supply_tbl_supplier` (`sup_id`),
  ADD KEY `FK_tbl_supply_tbl_drug` (`drug_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_drug`
--
ALTER TABLE `tbl_drug`
  MODIFY `drug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `sales_reciptId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_supply`
--
ALTER TABLE `tbl_supply`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD CONSTRAINT `tbl_login_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`drug_id`) REFERENCES `tbl_drug` (`drug_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_return`
--
ALTER TABLE `tbl_return`
  ADD CONSTRAINT `customer` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`),
  ADD CONSTRAINT `drug` FOREIGN KEY (`drug_id`) REFERENCES `tbl_drug` (`drug_id`);

--
-- Constraints for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`sales_customerId`) REFERENCES `tbl_customer` (`customer_id`),
  ADD CONSTRAINT `drug_id` FOREIGN KEY (`sales_drugId`) REFERENCES `tbl_drug` (`drug_id`);

--
-- Constraints for table `tbl_supply`
--
ALTER TABLE `tbl_supply`
  ADD CONSTRAINT `FK_tbl_supply_tbl_drug` FOREIGN KEY (`drug_id`) REFERENCES `tbl_drug` (`drug_id`),
  ADD CONSTRAINT `FK_tbl_supply_tbl_supplier` FOREIGN KEY (`sup_id`) REFERENCES `tbl_supplier` (`sup_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
