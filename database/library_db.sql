-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 07:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `year` int(30) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `edition` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `name`, `author`, `year`, `publisher`, `edition`, `created_at`) VALUES
(9, 'Political History of Assam (1947-1971) – Volume 1', 'Dr. Rajen Saikia', 2005, 'Political History of Assam (1947-1971) – Volume 1', '3rd', '2024-05-11 23:45:00'),
(10, 'Ek Samandar, Mere Andar', 'Sanjeev Joshi', 2024, 'Ek Samandar, Mere Andar', '3rd', '2024-05-11 23:26:38'),
(11, 'Political History of Assam (1947-1971) – Volume 1', 'Dr. Rajen Saikia', 2025, 'Political History of Assam (1947-1971) –', '2nd', '2024-05-11 23:27:32'),
(13, 'Smritivan: An Unparalleled Apotheosis of Commemora', 'Gujarat State Disaster Management Authority', 2002, 'Smritivan: An Unparalleled Apotheosis of', '1th', '2024-05-11 23:28:39'),
(14, 'Assam’s Braveheart – Lachit Barphukan', 'Arup Kumar Dutta', 2007, 'Assam’s Braveheart – Lachit Barphukan', '5th', '2024-05-11 23:29:24'),
(15, 'Fertilising the Future: Bharat’s March Towards Fer', 'Minister Dr. Mansukh Mandaviya', 2019, 'Fertilising the Future: Bharat’s March T', '9th', '2024-05-11 23:29:58'),
(16, 'An Uncommon Love: The Early Life of Sudha and Nara', 'Chitra Banerjee Divakaruni', 2009, 'An Uncommon Love: The Early Life of Sudh', '7th', '2024-05-11 23:30:34'),
(17, 'An Uncommon Love: The Early Life of Sudha and Nara', 'Chitra Banerjee Divakaruni', 2009, 'An Uncommon Love: The Early Life of Sudh', '7th', '2024-05-11 23:31:00'),
(18, 'Gandhi: A Life in Three Campaigns', 'M.J. Akbar and K Natwar Singh', 2008, 'Gandhi: A Life in Three Campaigns', '8th', '2024-05-11 23:31:33'),
(19, 'Smritivan: An Unparalleled Apotheosis of Commemoration to 2001 Victims of Gujarat Earthquake', 'Gujarat State Disaster Management Authority', 2002, 'Smritivan: An Unparalleled Apotheosis of Commemoration to 2001 Victims of Gujarat Earthquake', '5th', '2024-05-11 23:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `borrow_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` text NOT NULL,
  `created-at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borrow_id`, `book_id`, `username`, `start_date`, `end_date`, `status`, `created-at`) VALUES
(6, 9, '26996/t.2021', '2024-05-12', '2024-05-26', 'borrowed', '2024-06-07 15:41:09'),
(8, 15, '65776/t.2021', '2024-05-12', '2024-05-19', 'returned', '2024-06-07 15:27:44'),
(9, 18, 'omollo', '2024-06-08', '2024-06-23', 'borrowed', '2024-06-07 15:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE `fine` (
  `fine_id` int(11) NOT NULL,
  `borrow_id` int(11) NOT NULL,
  `amount` int(30) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`fine_id`, `borrow_id`, `amount`, `reason`, `Status`, `created`) VALUES
(4, 6, 5000, '  beyond the agreed-upon borrowing period', 'paid', '2024-05-12 04:20:03'),
(5, 6, 10000, ' keeps a book beyond the agreed-upon borrowing period', 'paid', '2024-05-12 05:07:51'),
(6, 6, 30000, ' keeps a book beyond the agreed-upon borrowing period', 'paid', '2024-06-07 15:29:19'),
(7, 6, 30000, 'return rate', 'paid', '2024-06-07 15:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_At` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `course` varchar(50) DEFAULT NULL,
  `year` int(10) DEFAULT NULL,
  `password` varchar(35) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created-at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `username`, `course`, `year`, `password`, `role`, `created-at`) VALUES
(1, 'omollo Edward Givenality', 'librarian', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'Librarian', '2024-06-06 23:27:40'),
(2, 'omary said mussa', '26996/t.2021', 'ISM', 1, 'e10adc3949ba59abbe56e057f20f883e', '', '2024-05-11 12:35:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrow_id`);

--
-- Indexes for table `fine`
--
ALTER TABLE `fine`
  ADD PRIMARY KEY (`fine_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fine`
--
ALTER TABLE `fine`
  MODIFY `fine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
