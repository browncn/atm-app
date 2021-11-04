-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 03, 2020 at 06:29 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atmlogistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `state`, `city`, `addr`, `phone`, `email`, `type`) VALUES
(6, 'lagos', 'satellite town', '16 alabaokiri-street', '08139429995', 'bigchuk00@gmail.com', '3rd party'),
(7, 'lagos', 'lekki', '1 MeadowHall way', '1800', 'ict@meadowhallschool.org', 'official'),
(8, 'enugu', 'ogbaete', '1 ikemelu way', '0801000000', 'enugu@atm.com', '3rd party'),
(9, 'abuja', 'gwarimpa', '2 ido road', '9093390900', 'b@g.com', 'official');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `uid` bigint(255) NOT NULL,
  `sender_name` varchar(50) NOT NULL,
  `sender_addr` varchar(100) NOT NULL,
  `sender_num` varchar(20) NOT NULL,
  `sender_email` varchar(50) NOT NULL,
  `sender_state` varchar(20) NOT NULL,
  `rec_name` varchar(50) NOT NULL,
  `rec_addr` varchar(100) NOT NULL,
  `rec_num` varchar(20) NOT NULL,
  `rec_state` varchar(20) NOT NULL,
  `pkg_value` int(100) NOT NULL,
  `pkg_qty` int(100) NOT NULL,
  `pkg_weight` int(100) NOT NULL,
  `pkg_descr` varchar(100) NOT NULL,
  `pref_trans` varchar(5) NOT NULL,
  `deliv_type` varchar(20) NOT NULL,
  `waybill` varchar(50) NOT NULL,
  `amount` int(100) NOT NULL,
  `deliv_status` varchar(20) NOT NULL,
  `disp_id` bigint(255) NOT NULL,
  `pay_method` varchar(20) NOT NULL,
  `update_time` timestamp NOT NULL,
  `added` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `uid`, `sender_name`, `sender_addr`, `sender_num`, `sender_email`, `sender_state`, `rec_name`, `rec_addr`, `rec_num`, `rec_state`, `pkg_value`, `pkg_qty`, `pkg_weight`, `pkg_descr`, `pref_trans`, `deliv_type`, `waybill`, `amount`, `deliv_status`, `disp_id`, `pay_method`, `update_time`, `added`) VALUES
(1, 0, 'brown', '123 street', '090222999', 'bigc@gmail.com', '', 'oluwadami', '909 infiniti road', '0805552223', 'lagos', 20000, 1, 21, 'purrr', 'bus', 'local', '9098890899898', 10000, 'delivered', 3, '', '2020-04-20 02:00:00', '0000-00-00 00:00:00'),
(3, 0, 'brown', '123 street', '090222999', 'bigc@gmail.com', '', 'oluwadami', '909 infiniti road', '0805552223', 'lagos', 20000, 1, 21, 'purrr', 'bus', 'local', '9098890899898', 10000, '', 0, '', '2020-04-20 02:00:00', '0000-00-00 00:00:00'),
(4, 0, 'brown', '123 street', '090222999', 'bigc@gmail.com', '', 'oluwadami', '909 infiniti road', '0805552223', 'lagos', 20000, 1, 21, 'purrr', 'bus', 'local', '9098890899898', 10000, '', 0, '', '2020-04-20 02:00:00', '0000-00-00 00:00:00'),
(5, 0, 'brown', '123 street', '090222999', 'bigc@gmail.com', '', 'oluwadami', '909 infiniti road', '0805552223', 'lagos', 20000, 1, 21, 'purrr', 'bus', 'local', '9098890899898', 10000, '', 0, '', '2020-04-20 02:00:00', '0000-00-00 00:00:00'),
(6, 0, 'brown', '123 street', '090222999', 'bigc@gmail.com', '', 'oluwadami', '909 infiniti road', '0805552223', 'lagos', 20000, 1, 21, 'purrr', 'bus', 'local', '9098890899898', 10000, '', 3, '', '2020-04-20 02:00:00', '0000-00-00 00:00:00'),
(7, 0, 'BROWN NWANKWO', '16 Alaba-okiri Street, Satellite Town', '8103290865', 'bigchuk00@gmail.com', 'enugu', 'izzi', 'izzi to the izzo', '8989', 'lagos', 10000, 1, 1, 'ItemX', 'car', 'office', '7525200507042535', 0, '', 0, '', '0000-00-00 00:00:00', '2020-05-07 04:26:21'),
(8, 0, 'BROWN NWANKWO', '16 Alaba-okiri Street, Satellite Town', '8103290865', 'bigchuk00@gmail.com', 'enugu', 'izzi', 'izzi to the izzo', '8989', 'lagos', 10000, 1, 1, 'ItemX', 'car', 'office', '3007200507043501', 2000, '', 0, 'online', '0000-00-00 00:00:00', '2020-05-07 04:35:26'),
(9, 0, 'BROWN NWANKWO', '16 Alaba-okiri Street, Satellite Town', '8103290865', 'bigchuk00@gmail.com', 'enugu', 'izzi', 'izzi to the izzo', '8989', 'lagos', 10000, 1, 1, 'ItemX', 'car', 'office', '1672200507043628', 2000, '', 0, 'online', '0000-00-00 00:00:00', '2020-05-07 04:36:28'),
(10, 0, 'BROWN NWANKWO', '16 Alaba-okiri Street, Satellite Town', '8103290865', 'bigchuk00@gmail.com', 'enugu', 'izzi', 'izzi to the izzo', '8989', 'lagos', 10000, 1, 1, 'ItemX', 'car', 'office', '4440200507043933', 2000, '', 0, 'online', '0000-00-00 00:00:00', '2020-05-07 04:39:33'),
(11, 7, 'BROWN NWANKWO', '16 Alaba-okiri Street, Satellite Town', '8103290865', 'bigchuk00@gmail.com', 'enugu', 'izzi', 'izzi to the izzo', '8989', 'lagos', 10000, 1, 1, 'ItemX', 'car', 'office', '5772200507044041', 2000, '', 0, 'online', '0000-00-00 00:00:00', '2020-05-07 04:40:41'),
(12, 7, 'BROWN NWANKWO', '16 Alaba-okiri Street, Satellite Town', '8103290865', 'bigchuk00@gmail.com', 'enugu', 'izzi', 'izzi to the izzo', '8989', 'lagos', 10000, 1, 1, 'ItemX', 'car', 'office', '2603200507044348', 2000, '', 0, 'online', '0000-00-00 00:00:00', '2020-05-07 04:43:48'),
(13, 7, 'BROWN NWANKWO', '16 Alaba-okiri Street, Satellite Town', '8103290865', 'bigchuk00@gmail.com', 'enugu', 'oluchi', 'kano', '98765432', 'enugu', 10000, 1, 5, 'nelo', 'van', 'office', '3931200508135442', 10000, '', 0, 'ondelivery', '0000-00-00 00:00:00', '2020-05-08 13:54:42'),
(23, 7, 'BROWN NWANKWO', '16 Alaba-okiri Street, Satellite Town', '8103290865', 'bigchuk00@gmail.com', 'enugu', 'Chinelo Helena Ugagu', '7 kano street, Mobil Estate, Satellite Town', '8062202958', 'lagos', 5000, 1, 3, 'A love cake', 'bike', 'home', '178200517225547', 6000, 'pending', 0, 'ondelivery', '0000-00-00 00:00:00', '2020-05-17 22:55:47'),
(27, 7, 'BROWN NWANKWO', '16 Alaba-okiri Street, Satellite Town', '8103290865', 'chinelohelena@gmail.com', 'enugu', 'Chinelo Helena Ugagu', '7 kano street, Mobil Estate, Satellite Town', '8062202958', 'lagos', 5000, 1, 3, 'A love cake', 'bike', 'home', '1942200517230401', 6000, 'pending', 0, 'ondelivery', '0000-00-00 00:00:00', '2020-05-17 23:04:01'),
(28, 7, 'BROWN NWANKWO', '16 Alaba-okiri Street, Satellite Town', '8103290865', 'isaiahudoh22@gmail.com', 'enugu', 'Isaiah Udoh', 'MOQ8, Ikeja Cantonment', '8132128982', 'lagos', 2147483647, 1, 1, 'Thanks Man', 'car', 'office', '9409200517230710', 2000, 'pending', 0, 'online', '0000-00-00 00:00:00', '2020-05-17 23:07:10'),
(29, 7, 'BROWN NWANKWO', '16 Alaba-okiri Street, Satellite Town', '8103290865', 'brown.cnk@gmail.com', 'lagos', 'Brown Nwankwo', '16 Alaba-okiri Street, Satellite Town', '8103290865', 'lagos', 10000, 1, 1, 'nelo', 'bike', 'office', '9539200526131259', 2000, 'pending', 0, 'online', '0000-00-00 00:00:00', '2020-05-26 13:12:59'),
(30, 7, 'okk', 'oo', '8103290865', 'bigchuk00@gmail.com', 'abuja', 'kokok', 'okok', '0000', 'abuja', 10000, 1, 1, 'kkk', 'undef', 'office', '473200601161751', 500, 'pending', 0, 'online', '0000-00-00 00:00:00', '2020-06-01 16:17:51');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

DROP TABLE IF EXISTS `dept`;
CREATE TABLE IF NOT EXISTS `dept` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `dept` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`id`, `dept`) VALUES
(1, 'admin'),
(2, 'client'),
(3, 'dispatch');

-- --------------------------------------------------------

--
-- Table structure for table `dispatch`
--

DROP TABLE IF EXISTS `dispatch`;
CREATE TABLE IF NOT EXISTS `dispatch` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `did` bigint(255) NOT NULL,
  `vehicle` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dispatch`
--

INSERT INTO `dispatch` (`id`, `did`, `vehicle`) VALUES
(1, 3, 'bike');

-- --------------------------------------------------------

--
-- Table structure for table `dispatch_vehicles`
--

DROP TABLE IF EXISTS `dispatch_vehicles`;
CREATE TABLE IF NOT EXISTS `dispatch_vehicles` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `vehicle` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dispatch_vehicles`
--

INSERT INTO `dispatch_vehicles` (`id`, `vehicle`) VALUES
(1, 'bike'),
(2, 'car'),
(3, 'van');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `dep` varchar(100) NOT NULL,
  `dest` varchar(100) NOT NULL,
  `base_price` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `dep`, `dest`, `base_price`) VALUES
(1, 'lagos', 'enugu', 2000),
(2, 'lagos', 'abuja', 3000),
(3, 'enugu', 'lagos', 2000),
(4, 'enugu', 'enugu', 500),
(5, 'lagos', 'lagos', 2000),
(6, 'abuja', 'abuja', 500),
(7, 'abuja', 'enugu', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `pass` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dept` varchar(20) NOT NULL,
  `sub` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `created` timestamp NOT NULL,
  `login` timestamp NOT NULL,
  `device` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pass`, `phone`, `email`, `name`, `fname`, `lname`, `gender`, `dept`, `sub`, `state`, `addr`, `created`, `login`, `device`) VALUES
(1, 'kenjixxx', '08103290865', 'bigchuk00@gmail.com', 'brown nwankwo ', 'brown', 'nwankwo', 'male', 'admin', '', 'lagos', 'addr', '2020-04-10 23:00:00', '0000-00-00 00:00:00', ''),
(7, 'kenjixxx', '8103290865', 'bigchuk00@gmail.com', 'Brown Nwankwo', 'Brown', 'Nwankwo', 'male', 'client', '', 'lagos', '16 Alaba-okiri Street, Satellite Town', '2020-04-29 11:01:08', '0000-00-00 00:00:00', ''),
(3, 'kenjixxx', '9999999990', 'maximus', 'biron dessert', 'biron', 'dessert', 'male', 'dispatch', 'car', 'lagos', 'astronomers crescent ', '2020-04-14 10:35:24', '0000-00-00 00:00:00', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
