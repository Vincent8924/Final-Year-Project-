-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 06:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobstreet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL COMMENT 'Admin identifier',
  `admin_name` varchar(50) NOT NULL COMMENT 'Admin name',
  `admin_password` varchar(50) NOT NULL COMMENT 'Admin password',
  `admin_email` varchar(255) NOT NULL COMMENT 'Admin_Email'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL COMMENT 'Contact_Id',
  `name` varchar(255) NOT NULL COMMENT 'Name',
  `email` varchar(255) NOT NULL COMMENT 'Email',
  `subject` varchar(255) NOT NULL COMMENT 'Subject',
  `message` text NOT NULL COMMENT 'Message'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'goh hong', 'jason0316@gmail.com', 'q', 'aaaa'),
(2, 'jason', 'abi@gmail.com', 'asd', 'tq for your help'),
(3, 'jason', 'abi@gmail.com', 'asd', 'tq for your help');

-- --------------------------------------------------------

--
-- Table structure for table `homepage`
--

CREATE TABLE `homepage` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `salary_range` varchar(100) DEFAULT NULL,
  `job_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homepage`
--

INSERT INTO `homepage` (`id`, `company_name`, `logo_url`, `salary_range`, `job_description`, `created_at`) VALUES
(1, 'hong', 'aaa', '2000', 'i lack many person ', '2024-04-20 09:32:49'),
(2, 'jane company', NULL, '1900-3000', 'sell flower', '2024-04-20 09:52:07'),
(3, 'alan', NULL, '8000-11000', 'hi i need male staff', '2024-04-20 09:55:08'),
(4, 'Ambank', 'l', '1900-2500', 'your math must good', '2024-04-20 10:05:10'),
(5, 'ali', NULL, '6000-7000', 'i want a malay staff', '2024-04-20 10:06:35'),
(6, 'aa', NULL, '1200-4000', 'look for a good staff', '2024-04-20 10:07:13'),
(7, 'lim', NULL, '3000-4000', 'hi welcome intern to my shop', '2024-04-20 10:11:21'),
(8, 'goh', NULL, '1200-2200', 'i am selling fried chicken', '2024-04-20 10:11:56'),
(9, 'keng', NULL, '1000-2000', 'hi', '2024-04-20 10:14:41'),
(10, 'tea house', NULL, '2200-3300', 'i am selling tea and coffee', '2024-04-20 10:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker`
--

CREATE TABLE `jobseeker` (
  `jobseeker_id` int(6) NOT NULL COMMENT 'Jobseeker identifier',
  `jobseeker_firstname` varchar(100) NOT NULL COMMENT 'Jobseeker first name',
  `jobseeker_lastname` varchar(100) NOT NULL COMMENT 'Jobseeker last name',
  `jobseeker_email` varchar(60) NOT NULL COMMENT 'Jobseeker email',
  `jobseeker_password` varchar(50) NOT NULL COMMENT 'Jobseeker password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobseeker`
--

INSERT INTO `jobseeker` (`jobseeker_id`, `jobseeker_firstname`, `jobseeker_lastname`, `jobseeker_email`, `jobseeker_password`) VALUES
(24, 'goh', 'goh', 'hong0703@gmail.com', '$2y$10$IEXv03LDeNOOhC83Pa2Fo.QwvnCNa2iM2j6yr1mq2nc'),
(25, 'jane', 'adeline', 'adeline@gmail.com', '$2y$10$Rg9QzjN40QnzfcXEKZ9MluWWAWapWBwpxV7wHMLDzx4'),
(26, 'jane', 'hong', 'gohchenghong533@gmail.com', '111'),
(27, 'ah', 'hao', 'tjh@gmail.com', '$2y$10$XCzELeMFS0XT14Z/MRzkNu243CLbTQw8VVrRTGywiHN');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `skills` text NOT NULL,
  `achievements` text DEFAULT NULL,
  `resume` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobseeker`
--
ALTER TABLE `jobseeker`
  ADD PRIMARY KEY (`jobseeker_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Admin identifier';

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Contact_Id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobseeker`
--
ALTER TABLE `jobseeker`
  MODIFY `jobseeker_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'Jobseeker identifier', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
