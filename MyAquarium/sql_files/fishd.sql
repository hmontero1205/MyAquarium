-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2016 at 11:14 AM
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
-- Table structure for table `fishd`
--

CREATE TABLE IF NOT EXISTS `fishd` (
  `breed` varchar(15) NOT NULL,
  `price` int(10) NOT NULL,
  `idx` varchar(100) NOT NULL,
  `img` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fishd`
--

INSERT INTO `fishd` (`breed`, `price`, `idx`, `img`, `username`) VALUES
('Cory', 25, '79070', 'coryf.png', 'Shoheb'),
('Cory', 25, '53004', 'coryf.png', 'Shoheb'),
('Cory', 25, '33085', 'coryf.png', 'Shoheb'),
('Cory', 25, '25963', 'coryf.png', 'Shoheb'),
('Cory', 25, '33450', 'coryf.png', 'Shoheb'),
('Molly', 100, '29793', 'mollyf.png', 'Shoheb'),
('Gourami', 150, '33216', 'gouramif.png', 'Hans'),
('Danio', 25, '47975', 'daniof.png', 'Hans'),
('Danio', 25, '69396', 'daniof.png', 'Hans'),
('Danio', 25, '48101', 'daniof.png', 'Hans'),
('Danio', 25, '66846', 'daniof.png', 'Hans'),
('Danio', 25, '22939', 'daniof.png', 'Hans'),
('Danio', 25, '32823', 'daniof.png', 'Hans'),
('Danio', 25, '40648', 'daniof.png', 'Hans'),
('Danio', 25, '56500', 'daniof.png', 'Hans'),
('Danio', 25, '13825', 'daniof.png', 'Hans');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
