-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-05-07 05:53:12
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `u1224051`
--

-- --------------------------------------------------------

--
-- 資料表結構 `course`
--

CREATE TABLE `course` (
  `id` char(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `course`
--

INSERT INTO `course` (`id`, `name`, `credits`) VALUES
('C11301', '計算機概論', 3),
('C11302', '微積分', 4),
('C11303', '程式語言', 3),
('C11304', '近代史', 2),
('C11305', '組合語言', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `department`
--

CREATE TABLE `department` (
  `id` char(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
('D1005', '化工系'),
('D1001', '資工系'),
('D1003', '資管系'),
('D1002', '通識中心'),
('D1004', '電子系');

-- --------------------------------------------------------

--
-- 資料表結構 `grade`
--

CREATE TABLE `grade` (
  `s_id` char(5) NOT NULL,
  `c_id` char(6) NOT NULL,
  `d_id` char(5) NOT NULL,
  `t_id` char(5) NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `grade`
--

INSERT INTO `grade` (`s_id`, `c_id`, `d_id`, `t_id`, `grade`) VALUES
('U1001', 'C11301', 'D1001', 'T1001', 87),
('U1001', 'C11302', 'D1002', 'T1002', 90),
('U1002', 'C11301', 'D1003', 'T1003', 97),
('U1002', 'C11302', 'D1002', 'T1002', 79),
('U1002', 'C11303', 'D1001', 'T1004', 92),
('U1004', 'C11301', 'D1001', 'T1001', 99),
('U1004', 'C11302', 'D1002', 'T1002', 93),
('U1004', 'C11304', 'D1002', 'T1005', 67);

-- --------------------------------------------------------

--
-- 資料表結構 `student`
--

CREATE TABLE `student` (
  `id` char(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `student`
--

INSERT INTO `student` (`id`, `name`) VALUES
('U1001', '張三'),
('U1002', '李四'),
('U1004', '王五'),
('U1003', '許六'),
('U1005', '郭七');

-- --------------------------------------------------------

--
-- 資料表結構 `teacher`
--

CREATE TABLE `teacher` (
  `id` char(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `extension` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `extension`) VALUES
('T1001', '黃老師', 111),
('T1002', '賴老師', 121),
('T1003', '溫老師', 112),
('T1004', '何老師', 122),
('T1005', '陳老師', 131);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- 資料表索引 `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- 資料表索引 `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`s_id`,`c_id`,`d_id`,`t_id`),
  ADD KEY `c_fk` (`c_id`),
  ADD KEY `d_fk` (`d_id`),
  ADD KEY `t_fk` (`t_id`);

--
-- 資料表索引 `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- 資料表索引 `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `c_fk` FOREIGN KEY (`c_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `d_fk` FOREIGN KEY (`d_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `s_fk` FOREIGN KEY (`s_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `t_fk` FOREIGN KEY (`t_id`) REFERENCES `teacher` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
