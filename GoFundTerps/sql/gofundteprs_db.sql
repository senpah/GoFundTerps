-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2018 at 03:44 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gofundterps`
--

-- --------------------------------------------------------

--
-- Table structure for table `fundraisers`
--

CREATE TABLE IF NOT EXISTS `fundraisers` (
  `fundraiser_id` int(11) NOT NULL,
  `org_name` varchar(255) NOT NULL,
  `fundraiser_name` varchar(255) NOT NULL,
  `fundraiser_desc` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fundraisers`
--

INSERT INTO `fundraisers` (`fundraiser_id`, `org_name`, `fundraiser_name`, `fundraiser_desc`, `created_at`) VALUES
(1, 'iSchool Society', '$ For iSchool Students', 'Raising money for grants for low-income iSchool Students @ UMD.', '2018-12-13 22:36:08'),
(2, 'Korean Student Association', 'KSA Events Fundraiser', 'Raising money to support KSA activities and events.', '2018-12-13 22:37:36'),
(3, 'Gaming Club', 'Gaming Fundraiser', 'Raising money to provide the club with funds for event prizes.', '2018-12-13 22:38:24'),
(4, 'Animal Lovers', '$ For Shelter Dogs', 'We are raising money to support dogs in shelters.', '2018-12-13 22:39:23'),
(5, 'UMD Sports', 'Equipment Fundraiser', 'We are raising money to buy new sports equipment for our club members.', '2018-12-13 22:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'gofundterps', 'gofundterps@gmail.com', '$2y$10$.Ggloh1abOFnHzhyRhOFo.npuqqw6Zo7QPMy5i9/G4MrD/3qqXlnq', '2018-12-13 22:35:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fundraisers`
--
ALTER TABLE `fundraisers`
  ADD PRIMARY KEY (`fundraiser_id`),
  ADD UNIQUE KEY `org_name` (`org_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fundraisers`
--
ALTER TABLE `fundraisers`
  MODIFY `fundraiser_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
