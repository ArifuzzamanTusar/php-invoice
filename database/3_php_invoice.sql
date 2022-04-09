-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2022 at 12:44 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `serv_charge` int(20) NOT NULL,
  `payment_terms` int(20) NOT NULL,
  `address` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `email`, `name`, `serv_charge`, `payment_terms`, `address`) VALUES
(1000, 'tusar@yahoo.com', 'Tusar', 3, 10, 'Hatemkhan, Boalia,rajshahi 6000'),
(1001, 'jasim@yahoo.com', 'Jasim', 4, 12, 'Lichubagan, Boalia, Rajshahi 6000'),
(1002, 'Nonti@yahoo.com', 'Nonti', 4, 15, 'Lichubagan, Boalia, Rajshahi 6000'),
(1003, 'john@gmail.com', 'John Karla', 5, 20, 'New York, 2000'),
(1004, 'mamba@gmail.com', 'Black John', 1, 20, 'Africa, 2050');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_order`
--

CREATE TABLE `invoice_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `order_due_date` varchar(30) NOT NULL,
  `order_receiver_name` varchar(250) NOT NULL,
  `order_receiver_address` text NOT NULL,
  `order_total_before_tax` decimal(10,2) NOT NULL,
  `order_total_tax` decimal(10,2) NOT NULL,
  `order_total_after_tax` double(10,2) NOT NULL,
  `inv_ref` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_order`
--

INSERT INTO `invoice_order` (`order_id`, `user_id`, `order_date`, `order_due_date`, `order_receiver_name`, `order_receiver_address`, `order_total_before_tax`, `order_total_tax`, `order_total_after_tax`, `inv_ref`) VALUES
(695, 123456, '2022-04-10 02:27:03', '', 'Tusar', 'Hatemkhan, Boalia,rajshahi 6000', '105.00', '15.75', 120.75, ''),
(697, 123456, '2022-04-10 02:35:42', '', 'Tusar', 'Hatemkhan, Boalia,rajshahi 6000', '796688.00', '183238.24', 979926.24, ''),
(698, 123456, '2022-04-10 02:50:57', '', 'Nonti', 'Lichubagan, Boalia, Rajshahi 6000', '500.00', '25.00', 525.00, ''),
(699, 123456, '2022-04-12', '2022-04-16', 'Tusar', 'Hatemkhan, Boalia,rajshahi 6000', '1088.00', '250.24', 1338.24, ''),
(700, 123456, '2022-04-15', '2022-04-21', 'Jasim', 'Lichubagan, Boalia, Rajshahi 6000', '25000.00', '2500.00', 27500.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_order_item`
--

CREATE TABLE `invoice_order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_disc` varchar(250) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `order_item_quantity` decimal(10,2) NOT NULL,
  `uom` varchar(50) NOT NULL,
  `order_item_price` decimal(10,2) NOT NULL,
  `tax_percent` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `order_item_final_amount` decimal(10,2) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_order_item`
--

INSERT INTO `invoice_order_item` (`order_item_id`, `order_id`, `item_disc`, `item_name`, `order_item_quantity`, `uom`, `order_item_price`, `tax_percent`, `tax_amount`, `order_item_final_amount`, `date`) VALUES
(4100, 2, '13555', 'Face Mask', '120.00', '', '2000.00', '0.00', '0.00', '240000.00', ''),
(4101, 2, '34', 'mobile', '10.00', '', '10000.00', '0.00', '0.00', '100000.00', ''),
(4102, 2, '34', 'mobile battery', '1.00', '', '34343.00', '0.00', '0.00', '34343.00', ''),
(4103, 2, '34', 'mobile cover', '10.00', '', '200.00', '0.00', '0.00', '2000.00', ''),
(4104, 2, '36', 'testing', '1.00', '', '2400.00', '0.00', '0.00', '2400.00', ''),
(4376, 690, 'Silver can bottle', 'speed', '3.00', '', '35.00', '0.00', '0.00', '120.75', ''),
(4378, 697, 'sadasdas', 'sd', '34.00', '', '23432.00', '0.00', '0.00', '979926.24', ''),
(4379, 698, 'kala', 'Bananaa', '50.00', 'PCS', '10.00', '5.00', '25.00', '525.00', '2022-05-03'),
(4380, 699, 'asdfdsf', 'asdff', '32.00', 'PCS', '34.00', '23.00', '250.24', '1338.24', '2022-04-15'),
(4381, 700, 'asdsadas', 'dsadas', '3.00', 'PCS', '5000.00', '10.00', '1500.00', '16500.00', '2022-04-10'),
(4382, 700, 'aseeeeee', 'aserd', '2.00', 'PCS', '5000.00', '10.00', '1000.00', '11000.00', '2022-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_user`
--

CREATE TABLE `invoice_user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_user`
--

INSERT INTO `invoice_user` (`id`, `email`, `password`, `first_name`, `last_name`, `mobile`, `address`) VALUES
(123456, 'test@test.com', '12345', 'The Owner', '', 12345678912, 'New Delhi 110096 India.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_order`
--
ALTER TABLE `invoice_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `invoice_order_item`
--
ALTER TABLE `invoice_order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `invoice_user`
--
ALTER TABLE `invoice_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `invoice_order`
--
ALTER TABLE `invoice_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=701;

--
-- AUTO_INCREMENT for table `invoice_order_item`
--
ALTER TABLE `invoice_order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4383;

--
-- AUTO_INCREMENT for table `invoice_user`
--
ALTER TABLE `invoice_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123457;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
