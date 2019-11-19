-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 14, 2019 at 12:29 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

DROP TABLE IF EXISTS `chat_message`;
CREATE TABLE IF NOT EXISTS `chat_message` (
  `chat_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`chat_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `password`) VALUES
(1, 'root', '$2y$10$KJyAF948q8uMPcctGnt/DObPIdkpo9tGLB.mLiPI.3IfYKUN95fmC'),
(2, 'sudo', '$2y$10$6qY7v6DXYIbFvfNgb1tcMu2L5ERxwnQ7NMpgX2UgAS.Lc0Cz1oGKu');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

DROP TABLE IF EXISTS `login_details`;
CREATE TABLE IF NOT EXISTS `login_details` (
  `login_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_type` enum('no','yes') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`login_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(1, 1, '2019-10-12 08:25:46', 'no'),
(2, 2, '2019-10-12 08:27:17', 'no'),
(3, 2, '2019-10-12 08:30:16', 'no'),
(4, 2, '2019-10-12 08:42:20', 'no'),
(5, 1, '2019-10-12 09:04:10', 'no'),
(6, 2, '2019-10-12 09:04:19', 'no'),
(7, 1, '2019-10-12 09:04:27', 'no'),
(8, 1, '2019-10-12 12:16:25', 'no'),
(9, 1, '2019-10-12 12:19:42', 'no'),
(10, 2, '2019-10-12 12:20:37', 'no'),
(11, 2, '2019-10-12 12:20:42', 'no'),
(12, 1, '2019-10-12 12:21:02', 'no'),
(13, 1, '2019-10-12 12:21:10', 'no'),
(14, 1, '2019-10-12 16:02:53', 'no'),
(15, 1, '2019-10-12 16:03:00', 'no'),
(16, 1, '2019-10-12 16:03:18', 'no'),
(17, 1, '2019-10-12 16:03:27', 'no'),
(18, 1, '2019-10-12 16:03:32', 'no'),
(19, 1, '2019-10-12 16:03:41', 'no'),
(20, 2, '2019-10-12 16:03:44', 'no'),
(21, 2, '2019-10-12 16:04:04', 'no'),
(22, 2, '2019-10-12 16:04:49', 'no'),
(23, 2, '2019-10-12 16:05:09', 'no'),
(24, 2, '2019-10-12 16:07:45', 'no'),
(25, 2, '2019-10-12 16:08:39', 'no'),
(26, 2, '2019-10-12 16:08:51', 'no'),
(27, 1, '2019-10-13 20:03:40', 'no'),
(28, 1, '2019-10-13 20:57:27', 'no'),
(29, 1, '2019-10-14 11:46:38', 'no'),
(30, 1, '2019-10-14 11:58:23', 'no'),
(31, 1, '2019-10-14 12:23:52', 'no');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
