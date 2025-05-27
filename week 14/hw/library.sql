-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 10:41 PM
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
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` char(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `authorship`
--

CREATE TABLE `authorship` (
  `ISBN` char(5) NOT NULL,
  `a_id` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ISBN` char(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrowlog`
--

CREATE TABLE `borrowlog` (
  `id` char(5) NOT NULL,
  `user_id` char(5) NOT NULL,
  `ISBN` char(5) NOT NULL,
  `date_borrow` date NOT NULL,
  `due_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE `publication` (
  `ISBN` char(5) NOT NULL,
  `p_id` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id` char(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returnlog`
--

CREATE TABLE `returnlog` (
  `id` char(5) NOT NULL,
  `user_id` char(5) NOT NULL,
  `ISBN` char(5) NOT NULL,
  `date_return` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `fine` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` char(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `nationality` (`nationality`);

--
-- Indexes for table `authorship`
--
ALTER TABLE `authorship`
  ADD PRIMARY KEY (`ISBN`,`a_id`),
  ADD KEY `a_fk` (`a_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `title` (`title`),
  ADD KEY `genre` (`genre`),
  ADD KEY `year` (`year`);

--
-- Indexes for table `borrowlog`
--
ALTER TABLE `borrowlog`
  ADD PRIMARY KEY (`id`,`user_id`,`ISBN`),
  ADD KEY `ISBN` (`ISBN`),
  ADD KEY `user_borrow` (`user_id`);

--
-- Indexes for table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`ISBN`,`p_id`),
  ADD KEY `p_fk` (`p_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `address` (`address`);

--
-- Indexes for table `returnlog`
--
ALTER TABLE `returnlog`
  ADD PRIMARY KEY (`id`,`user_id`,`ISBN`),
  ADD KEY `ISBN_return` (`ISBN`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authorship`
--
ALTER TABLE `authorship`
  ADD CONSTRAINT `a_fk` FOREIGN KEY (`a_id`) REFERENCES `author` (`id`),
  ADD CONSTRAINT `authorship` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`);

--
-- Constraints for table `borrowlog`
--
ALTER TABLE `borrowlog`
  ADD CONSTRAINT `ISBN_borrow` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`),
  ADD CONSTRAINT `user_borrow` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `p_fk` FOREIGN KEY (`p_id`) REFERENCES `publisher` (`id`),
  ADD CONSTRAINT `publication` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`);

--
-- Constraints for table `returnlog`
--
ALTER TABLE `returnlog`
  ADD CONSTRAINT `ISBN_return` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`),
  ADD CONSTRAINT `user_return` FOREIGN KEY (`id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
