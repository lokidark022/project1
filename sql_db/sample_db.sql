-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 03:53 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_lastName` varchar(255) NOT NULL,
  `php` float NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `username`, `password`, `account_number`, `account_name`, `account_lastName`, `php`, `token`) VALUES
(21, 'admin', 'Yml6b0M1OEEwMkliU3hZMGhRSVFNdz09', '2502147324', 'admin', 'admin', 34463, '86a48134b6cd0b06151344aa749d9cbc'),
(22, 'admin2', 'Yml6b0M1OEEwMkliU3hZMGhRSVFNdz09', '2502194998', 'admin', 'admin2', 2636, 'dfe8572f25fb6b05672f7b66af2336e2'),
(23, 'test', 'UURjOXRWMmhvVEtVdmVZY2dGQlFPZz09', '2502199036', 'test', 'test', 16206, 'aef1b4adfd8751badb7e623b033a3ff2');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `pak` int(10) NOT NULL,
  `price` float NOT NULL,
  `max_credits` int(10) NOT NULL,
  `days` int(11) NOT NULL,
  `daily_interest` float NOT NULL,
  `transfer_fee` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `pak`, `price`, `max_credits`, `days`, `daily_interest`, `transfer_fee`) VALUES
(2, 1, 100, 2, 5, 0.1, '10'),
(3, 2, 500, 5, 8, 0.3, '5'),
(4, 3, 1000, 10, 10, 0.77, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_recipients`
--

CREATE TABLE `user_recipients` (
  `id` int(11) NOT NULL,
  `user_accountNumber` varchar(255) NOT NULL,
  `user_recipient` varchar(255) NOT NULL,
  `user_fullName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_recipients`
--

INSERT INTO `user_recipients` (`id`, `user_accountNumber`, `user_recipient`, `user_fullName`) VALUES
(42, '2502194998', '2502199036', 'test test'),
(43, '2502147324', '2502199036', 'test test'),
(44, '2502199036', '2502147324', 'admin admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` int(11) NOT NULL,
  `account_number` varchar(10) NOT NULL,
  `pak` varchar(5) NOT NULL,
  `substart_date` text NOT NULL,
  `subend_date` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `transaction_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `account_number`, `pak`, `substart_date`, `subend_date`, `status`, `transaction_id`) VALUES
(98, '2502147324', '1', '2025-03-01 10:07:01', '2025-03-06 10:07:01', 'active', '2503012552909'),
(99, '2502199036', '1', '2025-03-01 13:27:14', '2025-03-06 13:27:14', 'active', '2503012286914'),
(100, '2502199036', '2', '2025-03-01 13:28:32', '2025-03-09 13:28:32', 'active', '2503016296785'),
(101, '2502199036', '3', '2025-03-01 13:28:58', '2025-03-11 13:28:58', 'active', '2503014352705');

-- --------------------------------------------------------

--
-- Table structure for table `user_transaction`
--

CREATE TABLE `user_transaction` (
  `id` int(11) NOT NULL,
  `created_transaction_by` varchar(30) NOT NULL,
  `to_accountNumber` varchar(30) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `transaction_type` varchar(20) NOT NULL,
  `transaction_type2` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_transaction`
--

INSERT INTO `user_transaction` (`id`, `created_transaction_by`, `to_accountNumber`, `transaction_id`, `transaction_type`, `transaction_type2`, `amount`, `status`, `date`) VALUES
(349, '2502147324', '', '2503012244399', 'transfer', 'send', 20, 'success', '2025-03-01 10:02'),
(350, '', '2502199036', '2503012244399', 'transfer', 'recieve', 20, 'success', '2025-03-01 10:02'),
(351, '2502147324', '', '2503012552909', 'subscription', '1', 100, 'success', '2025-03-01 10:07:01'),
(352, '2502147324', '', '2503018327804', 'transfer', 'send', 600, 'success', '2025-03-01 12:39'),
(353, '', '2502199036', '2503018327804', 'transfer', 'recieve', 600, 'success', '2025-03-01 12:39'),
(354, '2502147324', '', '2503012849813', 'transfer', 'send', 6000, 'success', '2025-03-01 12:39'),
(355, '', '2502199036', '2503012849813', 'transfer', 'recieve', 6000, 'success', '2025-03-01 12:39'),
(356, '', '2502147324', '2503015575768', 'interest', 'system', 34.463, 'success', '2025-03-01 13:24:49'),
(357, '2502199036', '', '2503012286914', 'subscription', '1', 100, 'success', '2025-03-01 13:27:14'),
(358, '', '2502147324', '2503011835237', 'interest', 'system', 34.463, 'success', '2025-03-01 13:27:29'),
(359, '', '2502199036', '2503015068692', 'interest', 'system', 17.706, 'success', '2025-03-01 13:27:30'),
(360, '', '2502147324', '2503011173694', 'interest', 'system', 34.463, 'success', '2025-03-01 13:27:54'),
(361, '', '2502199036', '2503016597735', 'interest', 'system', 17.706, 'success', '2025-03-01 13:27:54'),
(362, '', '2502147324', '2503013409193', 'interest', 'system', 34.463, 'success', '2025-03-01 13:27:55'),
(363, '', '2502199036', '2503019719541', 'interest', 'system', 17.706, 'success', '2025-03-01 13:27:55'),
(364, '2502199036', '', '2503016296785', 'subscription', '2', 500, 'success', '2025-03-01 13:28:32'),
(365, '', '2502147324', '2503018596145', 'interest', 'system', 34.463, 'success', '2025-03-01 13:28:40'),
(366, '', '2502199036', '2503019371412', 'interest', 'system', 68.824, 'success', '2025-03-01 13:28:40'),
(367, '2502199036', '', '2503014352705', 'subscription', '3', 1000, 'success', '2025-03-01 13:28:58'),
(368, '', '2502147324', '2503015510909', 'interest', 'system', 34.463, 'success', '2025-03-01 13:29:21'),
(369, '', '2502199036', '2503011982896', 'interest', 'system', 189.61, 'success', '2025-03-01 13:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_transfer_transaction`
--

CREATE TABLE `user_transfer_transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `from_user_accountNumber` varchar(255) NOT NULL,
  `from_accountName` varchar(255) NOT NULL,
  `to_user_accountNumber` varchar(255) NOT NULL,
  `to_accountName` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_transfer_transaction`
--

INSERT INTO `user_transfer_transaction` (`id`, `transaction_id`, `from_user_accountNumber`, `from_accountName`, `to_user_accountNumber`, `to_accountName`, `amount`, `status`, `date`) VALUES
(177, '2503012244399', '2502147324', 'admin', '2502199036', 'test test', 20, 'success', '2025-03-01 10:02'),
(178, '2503018327804', '2502147324', 'admin', '2502199036', 'test test', 600, 'success', '2025-03-01 12:39'),
(179, '2503012849813', '2502147324', 'admin', '2502199036', 'test test', 6000, 'success', '2025-03-01 12:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_recipients`
--
ALTER TABLE `user_recipients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_transaction`
--
ALTER TABLE `user_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_transfer_transaction`
--
ALTER TABLE `user_transfer_transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_recipients`
--
ALTER TABLE `user_recipients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `user_transaction`
--
ALTER TABLE `user_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

--
-- AUTO_INCREMENT for table `user_transfer_transaction`
--
ALTER TABLE `user_transfer_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
