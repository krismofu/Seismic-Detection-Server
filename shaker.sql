-- phpMyAdmin SQL Dump
-- version 4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2014 at 01:12 PM
-- Server version: 10.0.15-MariaDB-log
-- PHP Version: 5.6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shaker`
--

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `id` int(10) NOT NULL,
  `device_id` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `magnitude` float NOT NULL,
  `x` float NOT NULL,
  `y` float NOT NULL,
  `z` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2973 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `device_id`, `timestamp`, `magnitude`, `x`, `y`, `z`) VALUES
(2948, '90464ae9865ea7de', '2014-12-20 06:11:22', 0, 0, 0, 0),
(2949, '90464ae9865ea7de', '2014-12-20 06:11:23', 0, 0, 0, 0),
(2950, '90464ae9865ea7de', '2014-12-20 06:11:25', 0, 0, 0, 0),
(2951, '90464ae9865ea7de', '2014-12-20 06:11:28', 0, 0, 0, 0),
(2952, '90464ae9865ea7de', '2014-12-20 06:11:30', 0, 0, 0, 0),
(2953, '90464ae9865ea7de', '2014-12-20 06:11:32', 0, 0, 0, 0),
(2954, '90464ae9865ea7de', '2014-12-20 06:11:33', 0, 0, 0, 0),
(2955, '90464ae9865ea7de', '2014-12-20 06:11:35', 0, 0, 0, 0),
(2956, '90464ae9865ea7de', '2014-12-20 06:11:36', 0, 0, 0, 0),
(2957, '90464ae9865ea7de', '2014-12-20 06:11:37', 0, 0, 0, 0),
(2958, '90464ae9865ea7de', '2014-12-20 06:11:38', 0, 0, 0, 0),
(2959, '90464ae9865ea7de', '2014-12-20 06:11:39', 0, 0, 0, 0),
(2960, '90464ae9865ea7de', '2014-12-20 06:11:40', 0, 0, 0, 0),
(2961, '90464ae9865ea7de', '2014-12-20 06:11:41', 0, 0, 0, 0),
(2962, '90464ae9865ea7de', '2014-12-20 06:11:43', 0, 0, 0, 0),
(2963, '90464ae9865ea7de', '2014-12-20 06:11:45', 0, 0, 0, 0),
(2964, '90464ae9865ea7de', '2014-12-20 06:11:48', 0, 0, 0, 0),
(2965, '90464ae9865ea7de', '2014-12-20 06:11:48', 0, 0, 0, 0),
(2966, '90464ae9865ea7de', '2014-12-20 06:11:49', 0, 0, 0, 0),
(2967, '90464ae9865ea7de', '2014-12-20 06:11:51', 0, 0, 0, 0),
(2968, '90464ae9865ea7de', '2014-12-20 06:11:53', 0, 0, 0, 0),
(2969, '90464ae9865ea7de', '2014-12-20 06:11:59', 0, 0, 0, 0),
(2970, '90464ae9865ea7de', '2014-12-20 06:12:01', 0, 0, 0, 0),
(2971, '90464ae9865ea7de', '2014-12-20 06:12:04', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `threshold` float NOT NULL DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`threshold`) VALUES
(2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2973;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
