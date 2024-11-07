-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 06:12 AM
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
-- Database: `demo_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

Drop table if exists users;
CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ngay` date DEFAULT NULL,
  `gender` enum('nam','nu') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `ngay`, `gender`) VALUES
(1, 'admin', '123456', 'admin@gmail.com', '2004-04-04', 'nam'),
(2, 'dung', '123456', 'dung@gmail.com', '2002-02-02', 'nam'),
(3, 'chip', '123444', 'chip@gmail.com', '2007-12-01', 'nu'),
(4, 'nguyen ', '123123', 'example@gmail.com', NULL, 'nam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
CREATE TABLE post(
    post_id int(10) AUTO_INCREMENT PRIMARY KEY,
    user_id int(10) NOT NULL,
    title VARCHAR(50),
    content varchar(250),
    date DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO post(post_id, user_id, title, content, date) VALUES
(1, 1, 'abcc', 'aaaaaaaa', '2024-11-24 14:50:45'),
(2, 2, 'aaaaaaa', 'bbbbbbbb', '2024-11-24 14:50:45'),
(3, 2, 'aaaaaaaaaa', 'zzzzzzzzzzzzz', '2024-12-24 14:50:45'),
(4, 3, 'adgggggggg', 'dddddkgd', '2024-07-24 14:50:45'),
(5, 4, 'khovaicabiu', 'phplamanhsuy', '2024-07-24 14:50:45');
