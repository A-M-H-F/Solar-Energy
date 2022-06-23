-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2022 at 04:54 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wattco`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_inquiry`
--

CREATE TABLE `contact_inquiry` (
  `id` int(11) UNSIGNED NOT NULL,
  `fname` varchar(191) DEFAULT NULL,
  `lname` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_inquiry`
--

INSERT INTO `contact_inquiry` (`id`, `fname`, `lname`, `email`, `subject`, `message`, `created_at`) VALUES
(6, 'asdasd', 'asd', 'admin@example.com', 'asdas', 'dasdasd', '2022-06-19 16:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `wattco_admin`
--

CREATE TABLE `wattco_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wattco_admin`
--

INSERT INTO `wattco_admin` (`id`, `full_name`, `username`, `password`) VALUES
(685, 'hussein', 'amhf', 'fcea920f7412b5da7be0cf42b8c93759');

-- --------------------------------------------------------

--
-- Table structure for table `wattco_category`
--

CREATE TABLE `wattco_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wattco_category`
--

INSERT INTO `wattco_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'Cells', 'cells.jpg', 'Yes', 'Yes'),
(2, 'Inverter', 'inverter.jpg', 'Yes', 'Yes'),
(3, 'Batteries', 'batteries.jpg', 'Yes', 'Yes'),
(4, 'Stabilizers', 'stab.jpg', 'No', 'Yes'),
(5, 'Online UPS', 'online-ups.jpg', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `wattco_order`
--

CREATE TABLE `wattco_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `product` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wattco_order`
--

INSERT INTO `wattco_order` (`id`, `product`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(5, 'LG NeON R Prime', '450.00', 2, '900.00', '2022-06-21 09:27:04', 'Ordered', 'sadasd', '56456456', 'admin@example.com', 'asdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `wattco_product`
--

CREATE TABLE `wattco_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wattco_product`
--

INSERT INTO `wattco_product` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(3, 'LG NeON R Prime', 'LG’s NeON R Prime solar modules combine the power of our high-efficiency NeON R line with an all-black appearance. Back contact technology means no electrodes on the front for a smooth, modern aesthetic. The NeON R Prime features a 25-year limited warranty for product, performance and labor.', '450.00', '1.jpg', 1, 'Yes', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_inquiry`
--
ALTER TABLE `contact_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wattco_admin`
--
ALTER TABLE `wattco_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wattco_category`
--
ALTER TABLE `wattco_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wattco_order`
--
ALTER TABLE `wattco_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wattco_product`
--
ALTER TABLE `wattco_product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_inquiry`
--
ALTER TABLE `contact_inquiry`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wattco_admin`
--
ALTER TABLE `wattco_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=696;

--
-- AUTO_INCREMENT for table `wattco_category`
--
ALTER TABLE `wattco_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `wattco_order`
--
ALTER TABLE `wattco_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wattco_product`
--
ALTER TABLE `wattco_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
