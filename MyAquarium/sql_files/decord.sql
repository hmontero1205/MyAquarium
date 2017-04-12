-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2016 at 11:15 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hans`
--

-- --------------------------------------------------------

--
-- Table structure for table `decord`
--

CREATE TABLE IF NOT EXISTS `decord` (
  `cTop` int(10) NOT NULL,
  `cLeft` int(10) NOT NULL,
  `idx` int(100) NOT NULL,
  `z` int(250) NOT NULL,
  `price` int(20) NOT NULL,
  `img` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `decord`
--

INSERT INTO `decord` (`cTop`, `cLeft`, `idx`, `z`, `price`, `img`, `username`) VALUES
(-82, 240, 28242, 50, 50, 'microswordp.png', 'Hans'),
(-30, 300, 67857, -50, 50, 'mossp.png', 'Shoheb'),
(-129, 427, 72881, -50, 50, 'rotalaindicap.png', 'Shoheb'),
(-188, 1082, 89641, -50, 50, 'rotalaindicap.png', 'Hans'),
(-82, 959, 52185, 50, 50, 'rotalaindicap.png', 'Hans'),
(-96, 1056, 80874, 50, 50, 'rotalaindicap.png', 'Hans'),
(-187, 856, 80356, -50, 50, 'rotalaindicap.png', 'Hans'),
(-72, 736, 43034, 50, 50, 'rotalaindicap.png', 'Hans'),
(-91, 841, 51667, 50, 50, 'rotalaindicap.png', 'Hans'),
(-108, 489, 92912, 50, 50, 'microswordp.png', 'Shoheb'),
(-101, 641, 57288, 50, 50, 'microswordp.png', 'Shoheb'),
(-99, 778, 40755, 50, 50, 'microswordp.png', 'Shoheb'),
(62, 601, 17912, 50, 50, 'mossp.png', 'Hans'),
(55, 509, 23850, 50, 50, 'mossp.png', 'Hans'),
(-25, 116, 87968, -50, 50, 'mossp.png', 'Joey'),
(-42, 262, 20539, -50, 50, 'mossp.png', 'Joey'),
(65, 429, 50003, 50, 50, 'mossp.png', 'Joey'),
(-53, 606, 58586, -50, 50, 'mossp.png', 'Joey'),
(-18, 443, 87423, -50, 50, 'mossp.png', 'Joey'),
(57, 740, 60440, 50, 50, 'mossp.png', 'Joey'),
(-51, 572, 18111, -50, 50, 'mossp.png', 'Joey'),
(60, 245, 42752, 50, 50, 'mossp.png', 'Joey'),
(58, 371, 95860, 50, 50, 'mossp.png', 'Joey'),
(34, 582, 38666, 50, 50, 'mossp.png', 'Joey'),
(60, 875, 64320, 50, 50, 'mossp.png', 'Joey'),
(-193, 80, 45424, -50, 50, 'microswordp.png', 'Hans'),
(-112, 30, 11479, 50, 50, 'microswordp.png', 'Hans'),
(-104, 341, 38833, 50, 50, 'microswordp.png', 'Hans'),
(41, 711, 86386, 50, 50, 'mossp.png', 'Hans'),
(-42, 702, 20813, -50, 50, 'mossp.png', 'Hans'),
(61, 675, 51179, 50, 50, 'mossp.png', 'Hans'),
(-4, 642, 41728, -50, 50, 'mossp.png', 'Hans'),
(-13, 576, 35998, -50, 50, 'mossp.png', 'Hans'),
(-24, 516, 56942, -50, 50, 'mossp.png', 'Hans'),
(-167, 476, 43520, -50, 50, 'rotalaindicap.png', 'Brendan');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
