-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 21, 2020 at 03:11 PM
-- Server version: 5.7.32-0ubuntu0.16.04.1
-- PHP Version: 7.3.21-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meena_stack`
--

-- --------------------------------------------------------

--
-- Table structure for table `stacktags`
--

CREATE TABLE `stacktags` (
  `id` int(11) NOT NULL,
  `tagname` varchar(100) NOT NULL,
  `no_of_question` bigint(20) NOT NULL DEFAULT '0',
  `unanswered_question` bigint(20) NOT NULL DEFAULT '0',
  `frequent_question` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stacktags`
--

INSERT INTO `stacktags` (`id`, `tagname`, `no_of_question`, `unanswered_question`, `frequent_question`, `created_at`, `updated_at`) VALUES
(1, 'php', 1383862, 415613, 100771, '2020-12-20 03:52:13', '2020-12-21 14:52:51'),
(2, 'javascript', 2138849, 627114, 159855, '2020-12-20 13:06:25', '2020-12-21 14:53:30'),
(3, 'java', 1739432, 500590, 173084, '2020-12-20 13:11:10', '2020-12-21 14:53:32'),
(4, 'python', 1609519, 459345, 146425, '2020-12-20 13:11:12', '2020-12-21 14:52:46'),
(5, 'c#', 1453648, 376151, 154140, '2020-12-20 13:11:12', '2020-12-21 14:52:49'),
(6, 'android', 1314221, 495154, 140241, '2020-12-20 13:11:12', '2020-12-21 14:52:54'),
(7, 'html', 1041365, 298266, 68735, '2020-12-20 13:11:12', '2020-12-20 15:08:35'),
(8, 'jquery', 1003470, 271986, 74789, '2020-12-20 13:11:12', '2020-12-20 15:08:40'),
(9, 'c++', 705141, 138434, 78762, '2020-12-20 13:11:12', '2020-12-20 15:08:44'),
(10, 'css', 697031, 186207, 47058, '2020-12-20 13:11:12', '2020-12-20 15:08:48'),
(11, 'ios', 646660, 211894, 68596, '2020-12-20 13:11:12', '2020-12-20 15:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(500) NOT NULL,
  `remember_token` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Meena', 'meenageetharam@gmail.com', '2020-12-19 23:50:38', '$2y$10$UP9.OoPLlvYn.rly8Xue.upJrQN6HWW7/VJOHMhO7v.mFHHzPPT1.', NULL, '2020-12-20 07:50:38', '2020-12-20 07:50:38'),
(2, 2, 'user123', 'user@gmail.com', '2020-12-19 23:52:37', '$2y$10$5vLEFIf10fvAVcQ1ItOPZ.B2ts5K0EziuoUa3oxh8OKCbkJxWcTa.', NULL, '2020-12-20 07:52:37', '2020-12-20 07:52:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stacktags`
--
ALTER TABLE `stacktags`
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
-- AUTO_INCREMENT for table `stacktags`
--
ALTER TABLE `stacktags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
