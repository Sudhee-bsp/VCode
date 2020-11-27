-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 03:51 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vquiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `question_number` int(255) NOT NULL,
  `solution` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question` text NOT NULL,
  `question_number` int(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question`, `question_number`, `date`) VALUES
('1: qwertyuiopasdfghjkllzxcvbnm mnbvcxzlkjhgfdsapoiuytrewq ', 1, '2020-11-20'),
('fwgvchjbjuiqc iequbgcinfjqow wgiucbf6onijpk', 2, '2020-11-20'),
('3:vghuiuytfdcvbjuyredhjytrdcv This is 21 nov 2020', 3, '2020-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `f_name` varchar(10) CHARACTER SET utf16 NOT NULL,
  `l_name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `avatar` varchar(500) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 NOT NULL,
  `session` varchar(200) CHARACTER SET utf8 NOT NULL,
  `user_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `avatar`, `email`, `password`, `session`, `user_name`) VALUES
(6, 'Raj', 'Kumar', 'https://lh3.googleusercontent.com/a-/AOh14GiuCUfkbibp6rku6RTDtYOOwTWGTROuIry4LewZ=s96-c', 'prk7102002@gmail.com', 'z9BDy', '77DxB29vz2', 'Raj Kumar'),
(7, 'Mani', 'Sai', 'https://lh3.googleusercontent.com/a-/AOh14GjP7W6QnRq6rLhldIzGh_ZK3Qfimj6S6zZKdseqOw=s96-c', 'manisss180@gmail.com', 'DBx07', 'w7zvBw79v8', 'Mani Sai'),
(8, 'BANTWAL SU', '18MIS7113', 'https://lh3.googleusercontent.com/a-/AOh14GjC_BMu_9EABTbipHZjDCnr4TUBJYhS0awsrUTf=s96-c', 'sudhindra.18mis7113@vitap.ac.in', 'BDB2y', 'BvB8vD97Cv', 'BANTWAL SUDHINDRA PAI 18MIS7113');

-- --------------------------------------------------------

--
-- Table structure for table `user_solutions`
--

CREATE TABLE `user_solutions` (
  `user_id` int(255) NOT NULL,
  `question_number` int(255) NOT NULL,
  `user_solution` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_solutions`
--

INSERT INTO `user_solutions` (`user_id`, `question_number`, `user_solution`) VALUES
(6, 5, 0x53544d2d554e49542d32205231362e706466),
(6, 5, 0x53544d2d554e49542d32205231362e706466),
(7, 5, 0x53544d2d554e49542d32205231362e706466);

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `question_number` int(255) NOT NULL,
  `first` varchar(250) NOT NULL,
  `second` varchar(250) NOT NULL,
  `third` varchar(250) NOT NULL,
  `fourth` varchar(250) NOT NULL,
  `fifth` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`question_number`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_solutions`
--
ALTER TABLE `user_solutions`
  ADD KEY `question_number` (`question_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`question_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_number`) REFERENCES `questions` (`question_number`);

--
-- Constraints for table `user_solutions`
--
ALTER TABLE `user_solutions`
  ADD CONSTRAINT `user_solutions_ibfk_1` FOREIGN KEY (`question_number`) REFERENCES `questions` (`question_number`),
  ADD CONSTRAINT `user_solutions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `winners`
--
ALTER TABLE `winners`
  ADD CONSTRAINT `winners_ibfk_1` FOREIGN KEY (`question_number`) REFERENCES `questions` (`question_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
