-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 02, 2019 at 07:31 PM
-- Server version: 5.5.57-log
-- PHP Version: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test.dev.melis`
--

-- --------------------------------------------------------

--
-- Table structure for table `melis_demo_album`
--

CREATE TABLE IF NOT EXISTS `melis_demo_album` (
  `alb_id` int(11) NOT NULL AUTO_INCREMENT,
  `alb_name` varchar(255) NOT NULL,
  `alb_song_num` int(11) NOT NULL,
  `alb_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`alb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `melis_demo_album`
--

INSERT INTO `melis_demo_album` (`alb_name`, `alb_song_num`, `alb_date`) VALUES
('Christmas Eve', 200, '2019-07-11 05:19:28'),
('Bon Jovi Hits', 2000, '2019-07-23 07:56:59'),
('Nevermind', 21, '2019-08-23 08:40:21'),
('In Utero', 30, '2019-08-23 08:40:48'),
('The Low End Theory', 30, '2019-08-23 08:41:24');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
