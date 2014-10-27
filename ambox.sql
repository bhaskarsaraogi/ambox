-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2014 at 02:25 AM
-- Server version: 5.5.38
-- PHP Version: 5.3.10-1ubuntu3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ambox`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_friend_requests`
--
-- Creation: Aug 27, 2014 at 08:12 PM
--

CREATE TABLE IF NOT EXISTS `user_friend_requests` (
  `friend_request_id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_request_to` int(11) NOT NULL,
  `friend_request_from` int(11) NOT NULL,
  `friend_request_accepted` int(11) DEFAULT '0',
  PRIMARY KEY (`friend_request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `user_friend_requests`
--

INSERT INTO `user_friend_requests` (`friend_request_id`, `friend_request_to`, `friend_request_from`, `friend_request_accepted`) VALUES
(1, 3, 4, 1),
(2, 7, 3, 1),
(5, 3, 6, 1),
(6, 3, 5, 0),
(9, 3, 9, 0),
(10, 8, 3, 0),
(14, 12, 3, 1),
(16, 11, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--
-- Creation: Aug 26, 2014 at 02:30 PM
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `username`, `password`) VALUES
(3, 'admin', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e'),
(4, 'user', '12dea96fec20593566ab75692c9949596833adc9'),
(5, 'qwerty', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e'),
(6, 'qazwsx', 'cb45c671cbc500627ea424eea5f91996221b5935'),
(7, 'qsxdr', '693a99b18d519262f3377dcee00d4c9edf7dfd01'),
(8, 'user1', 'b3daa77b4c04a9551b8781d03191fe098f325e67'),
(9, 'user2', 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4'),
(10, 'user3', '0b7f849446d3383546d15a480966084442cd2193'),
(11, 'user4', '06e6eef6adf2e5f54ea6c43c376d6d36605f810e'),
(12, 'ello mllo\n', '124b563961bf68a25f75a6890f3508a0de9da9ab'),
(13, '&lt;script&gt;alert(&quot;foo:);&lt;/script&gt;', '64434af755d6756178d17a75c911f0748e0a22c5');

-- --------------------------------------------------------

--
-- Table structure for table `user_update`
--
-- Creation: Aug 26, 2014 at 03:16 PM
--

CREATE TABLE IF NOT EXISTS `user_update` (
  `user_update_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_master_id` int(11) NOT NULL,
  `user_status` varchar(10000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_update_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `user_update`
--

INSERT INTO `user_update` (`user_update_id`, `user_master_id`, `user_status`, `timestamp`) VALUES
(1, 3, 'hello', '2014-08-26 12:36:35'),
(2, 3, 'ehello gaian', '2014-08-26 12:36:35'),
(4, 3, 'umykk', '2014-08-26 15:18:25'),
(5, 4, 'hello man', '2014-08-27 12:23:18'),
(6, 5, 'hello man', '2014-08-27 12:23:18'),
(7, 6, 'hello man', '2014-08-27 12:23:18'),
(8, 7, 'hello man', '2014-08-27 12:23:18'),
(9, 8, 'hello man', '2014-08-27 12:23:18'),
(10, 9, 'hello man', '2014-08-27 12:24:40'),
(11, 10, 'hello man', '2014-08-27 12:24:40'),
(12, 11, 'hello man', '2014-08-27 12:24:40'),
(13, 12, 'hello man', '2014-08-27 12:24:40'),
(14, 12, 'hello man', '2014-08-27 12:24:40'),
(15, 12, 'hello man', '2014-08-27 12:24:40'),
(16, 11, 'hello man', '2014-08-27 12:24:40'),
(17, 10, 'hello man', '2014-08-27 12:24:40'),
(18, 9, 'hello man', '2014-08-27 12:24:40'),
(19, 8, 'hello man', '2014-08-27 12:24:40'),
(20, 7, 'hello man', '2014-08-27 12:25:16'),
(21, 6, 'hello man', '2014-08-27 12:25:26'),
(22, 5, 'hello man', '2014-08-27 12:25:38'),
(23, 4, 'hello man', '2014-08-27 12:25:50'),
(24, 3, 'hello man', '2014-08-27 12:25:58'),
(25, 3, 'this works', '2014-08-27 18:38:05'),
(26, 4, 'this works too!', '2014-08-27 18:40:50'),
(27, 4, 'Make this work man!', '2014-08-27 18:42:36'),
(28, 11, 'hiii!!!', '2014-08-27 20:53:29');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
