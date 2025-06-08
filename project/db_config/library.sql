-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2025 at 05:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `AID` int(11) NOT NULL,
  `password` char(60) NOT NULL,
  `login_time` datetime NOT NULL,
  `failed_attempts` int(11) NOT NULL DEFAULT 0,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AID`, `password`, `login_time`, `failed_attempts`, `is_locked`) VALUES
(1, '$2b$12$t2Q8xZaZ22KPoeOE/KzCIOwXnEfHiTjQAspxnKfkuYzyfWBTyHbIC', '2025-05-15 06:43:31', 2, 0),
(2, '$2b$12$t2Q8xZaZ22KPoeOE/KzCIOwXnEfHiTjQAspxnKfkuYzyfWBTyHbIC', '2025-05-31 06:43:31', 0, 0),
(3, '$2b$12$t2Q8xZaZ22KPoeOE/KzCIOwXnEfHiTjQAspxnKfkuYzyfWBTyHbIC', '2025-05-16 06:43:31', 0, 0),
(4, '$2b$12$t2Q8xZaZ22KPoeOE/KzCIOwXnEfHiTjQAspxnKfkuYzyfWBTyHbIC', '2025-05-31 06:43:31', 0, 0),
(5, '$2b$12$t2Q8xZaZ22KPoeOE/KzCIOwXnEfHiTjQAspxnKfkuYzyfWBTyHbIC', '2025-06-01 06:43:31', 1, 0),
(6, '$2b$12$t2Q8xZaZ22KPoeOE/KzCIOwXnEfHiTjQAspxnKfkuYzyfWBTyHbIC', '2025-06-07 06:43:31', 1, 0),
(7, '$2b$12$t2Q8xZaZ22KPoeOE/KzCIOwXnEfHiTjQAspxnKfkuYzyfWBTyHbIC', '2025-05-26 06:43:31', 1, 0),
(8, '$2b$12$t2Q8xZaZ22KPoeOE/KzCIOwXnEfHiTjQAspxnKfkuYzyfWBTyHbIC', '2025-06-03 06:43:31', 0, 0),
(9, '$2b$12$t2Q8xZaZ22KPoeOE/KzCIOwXnEfHiTjQAspxnKfkuYzyfWBTyHbIC', '2025-05-27 06:43:31', 0, 0),
(10, '$2b$12$t2Q8xZaZ22KPoeOE/KzCIOwXnEfHiTjQAspxnKfkuYzyfWBTyHbIC', '2025-06-08 23:31:55', 0, 0),
(11, '$2y$10$DX0fZnSifLqsSNWpom0TVedtq2rGgYFJWt7PXIafgP/DUyVpmRW.W', '2025-06-08 14:56:28', 0, 0),
(9999, '$2y$10$Gf6Iftn7ZLlw8sNOkJ8uZuWd9rhtXlHfgcoxJigv1zeQolHWZRUXy', '2025-06-08 22:54:22', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ISBN` char(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `author` varchar(255) NOT NULL,
  `PID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ISBN`, `title`, `genre`, `year`, `author`, `PID`) VALUES
('9780000000001', 'Book Title 1', 'Fiction', '2006', 'Author 1', 1),
('9780000000002', 'Book Title 2', 'Fiction', '1997', 'Author 2', 4),
('9780000000003', 'Book Title 3', 'Non-fiction', '1992', 'Author 3', 5),
('9780000000004', 'Book Title 4', 'History', '1997', 'Author 4', 2),
('9780000000005', 'Book Title 5', 'History', '2004', 'Author 5', 5),
('9780000000006', 'Book Title 6', 'Fiction', '2023', 'Author 6', 2),
('9780000000007', 'Book Title 7', 'Fiction', '2015', 'Author 7', 1),
('9780000000008', 'Book Title 8', 'Non-fiction', '2008', 'Author 8', 2),
('9780000000009', 'Book Title 9', 'Sci-fi', '1999', 'Author 9', 5),
('9780000000010', 'Book Title 10', 'History', '2002', 'Author 10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `borrowlog`
--

CREATE TABLE `borrowlog` (
  `LID` int(11) NOT NULL,
  `UID` char(5) NOT NULL,
  `ISBN` char(13) NOT NULL,
  `borrow_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `return_date` datetime DEFAULT NULL,
  `is_returned` tinyint(1) NOT NULL DEFAULT 1,
  `fine` decimal(10,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowlog`
--

INSERT INTO `borrowlog` (`LID`, `UID`, `ISBN`, `borrow_date`, `due_date`, `return_date`, `is_returned`, `fine`) VALUES
(6, '10', '9780000000002', '2025-06-08 00:00:00', '2025-06-22 00:00:00', '2025-06-08 11:53:08', 1, 0),
(7, '10', '9780000000002', '2025-06-08 00:00:00', '2025-06-22 00:00:00', '2025-06-08 11:57:36', 1, 0),
(8, '10', '9780000000002', '2025-02-04 00:00:00', '2025-02-18 00:00:00', '2025-06-08 12:00:15', 1, 1110),
(9, '9999', '9780000000002', '2025-06-01 00:00:00', '2025-06-15 00:00:00', '2025-06-08 12:02:56', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `PID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`PID`, `name`, `address`, `phone`) VALUES
(1, 'Publisher 1', 'Address 1', '09120000001'),
(2, 'Publisher 2', 'Address 2', '09120000002'),
(3, 'Publisher 3', 'Address 3', '09120000003'),
(4, 'Publisher 4', 'Address 4', '09120000004'),
(5, 'Publisher 5', 'Address 5', '09120000005');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `join_date` datetime NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UID`, `name`, `email`, `join_date`, `role`) VALUES
(1, 'Bob', 'bob1@mail.com', '2025-01-24 06:37:20', 'user'),
(2, 'Charlie', 'charlie2@example.com', '2024-12-09 06:37:20', 'user'),
(3, 'David', 'david3@test.com', '2024-12-21 06:37:20', 'user'),
(4, 'Eva', 'eva4@test.com', '2024-12-17 06:37:20', 'user'),
(5, 'Frank', 'frank5@test.com', '2025-01-20 06:37:20', 'user'),
(6, 'Grace', 'grace6@example.com', '2024-12-08 06:37:20', 'user'),
(7, 'Hannah', 'hannah7@example.com', '2024-11-13 06:37:20', 'user'),
(8, 'Ivan', 'ivan8@example.com', '2025-04-10 06:37:20', 'user'),
(9, 'Judy', 'judy9@mail.com', '2025-01-22 06:37:20', 'user'),
(10, 'Alice', 'alice10@test.com', '2024-09-07 06:37:20', 'user'),
(11, 'test', 'test@123', '2025-06-08 14:51:43', 'user'),
(9999, 'admin', 'admin@admin.com', '2025-06-08 15:42:18', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AID`),
  ADD KEY `login_time` (`login_time`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `title` (`title`),
  ADD KEY `genre` (`genre`),
  ADD KEY `year` (`year`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `borrowlog`
--
ALTER TABLE `borrowlog`
  ADD PRIMARY KEY (`LID`,`UID`,`ISBN`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`PID`),
  ADD KEY `name` (`name`),
  ADD KEY `address` (`address`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UID`),
  ADD KEY `name` (`name`),
  ADD KEY `join_date` (`join_date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;

--
-- AUTO_INCREMENT for table `borrowlog`
--
ALTER TABLE `borrowlog`
  MODIFY `LID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
