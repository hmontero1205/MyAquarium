-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2016 at 11:13 AM
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
-- Table structure for table `stored`
--

CREATE TABLE IF NOT EXISTS `stored` (
  `breed` varchar(15) NOT NULL,
  `price` int(10) NOT NULL,
  `img` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stored`
--

INSERT INTO `stored` (`breed`, `price`, `img`) VALUES
('Angelfish', 500, 'angelf.png'),
('Molly', 200, 'mollyf.png'),
('Algae Eater', 150, 'algaef.png'),
('Neon Tetra', 50, 'ntetraf.png'),
('Cory', 50, 'coryf.png'),
('Guppy Fish', 300, 'guppyf.png'),
('Gourami', 300, 'gouramif.png'),
('Danio', 50, 'daniof.png'),
('Bala Shark', 200, 'balasharkf.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
