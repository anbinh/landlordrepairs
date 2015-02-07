-- phpMyAdmin SQL Dump
-- version 3.3.1
-- http://www.phpmyadmin.net
--
-- Host: 10.168.1.83
-- Generation Time: Feb 04, 2015 at 06:58 AM
-- Server version: 5.6.21
-- PHP Version: 5.2.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `landlord1_data`
--
CREATE DATABASE `landlord1_data` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `landlord1_data`;

-- --------------------------------------------------------

--
-- Table structure for table `google_map_jobs`
--

CREATE TABLE IF NOT EXISTS `google_map_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `place` varchar(300) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `google_map_jobs`
--


-- --------------------------------------------------------

--
-- Table structure for table `google_map_user`
--

CREATE TABLE IF NOT EXISTS `google_map_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `place` varchar(300) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `google_map_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tittle` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `timeoption` varchar(20) NOT NULL,
  `date` varchar(50) NOT NULL,
  `local` varchar(200) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `status` varchar(100) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `tittle`, `description`, `price`, `category`, `timeoption`, `date`, `local`, `lat`, `lng`, `status`, `updated_at`, `created_at`) VALUES
(12, 16, 'a', 'a ', 'a', 'Category', '', 'a', '', 0, 0, 'openjob', '2015-01-31 11:16:42', '2015-01-31 11:16:42'),
(13, 17, 'a', ' ', 'a', 'Category', '', 'a', '', 0, 0, 'openjob', '2015-01-31 11:34:25', '2015-01-31 11:34:25'),
(14, 17, 'erter', 'jioji ', 'iij', 'Category', 'Flexible', '', '', 0, 0, 'openjob', '2015-01-31 14:10:27', '2015-01-31 14:10:27'),
(15, 17, 'erter', 'jioji ', 'iij', 'Category', 'Flexible', '', '', 0, 0, 'openjob', '2015-01-31 14:11:17', '2015-01-31 14:11:17'),
(16, 17, 'g', 'g ', 'g', 'Category', 'Flexible', '', '', 0, 0, 'openjob', '2015-01-31 14:12:03', '2015-01-31 14:12:03'),
(17, 17, 'g', 'g ', 'g', 'Category', 'Flexible', '', '', 0, 0, 'openjob', '2015-01-31 14:12:13', '2015-01-31 14:12:13'),
(18, 17, 'dyhrtyrtyryt', 'hiuhiuhui ', 'jhij', 'Category', 'Specific', '2015-01-09', '', 0, 0, 'openjob', '2015-01-31 14:16:40', '2015-01-31 14:16:40'),
(19, 18, 'a', 'a ', 'a', 'Category', 'Specific', '2015-01-08', '', 0, 0, 'openjob', '2015-01-31 14:26:49', '2015-01-31 14:26:49'),
(20, 17, 'hshsh', 'h ', 'h', 'Category', 'Flexible', '', '', 0, 0, 'openjob', '2015-02-01 04:05:39', '2015-02-01 04:05:39'),
(21, 17, 'rua chén ', 'rua ko sach ko tra xi?n ', '100VND', 'Category', 'Specific', '2015-02-12', 'ha loi', 37.7699298, -122.44691569999998, 'openjob', '2015-02-01 04:20:25', '2015-02-01 04:20:25'),
(22, 17, 'ws', ' ', 's', 'Category', 'Flexible', '', 's', 37.75548588795201, -122.45933175086975, 'openjob', '2015-02-01 04:22:44', '2015-02-01 04:22:44'),
(23, 19, 'c', 'c ', 'c', 'Category 1', 'Flexible', '', 'c', 21.003114585178476, 105.82016587955877, 'openjob', '2015-02-01 04:31:47', '2015-02-01 04:31:47'),
(24, 20, 'a', 'a ', 'a', 'Category', 'Flexible', '', 'a', 37.7699298, -122.44691569999998, 'openjob', '2015-02-01 05:11:01', '2015-02-01 05:11:01'),
(25, 21, 'A', 'A ', 'A', 'Category', 'Flexible', '', 'A', 37.7699298, -122.44691569999998, 'openjob', '2015-02-01 05:11:54', '2015-02-01 05:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `email_confirm` varchar(100) NOT NULL,
  `pass_reset` varchar(200) NOT NULL,
  `phone_confirm` varchar(100) NOT NULL,
  `facebook_id` varchar(20) NOT NULL,
  `site_link` varchar(200) NOT NULL,
  `social_link` varchar(200) NOT NULL,
  `role` int(11) NOT NULL,
  `updated_at` varchar(20) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone_number`, `email_confirm`, `pass_reset`, `phone_confirm`, `facebook_id`, `site_link`, `social_link`, `role`, `updated_at`, `created_at`, `remember_token`) VALUES
(17, 'dsds', 'jimmysscentaur@gmail.com', '$2y$10$pnpz/qBLSf27D2a3kXF5OeAQ1K6omyGtRzUZcHjrzi6HDX8.MEhqi', 0, '', '', '', '', '', '', 0, '2015-02-03 16:30:13', '2015-01-31 11:34:25', 'Fpd9dGqX0IS8wFczB1OyW03uXFq1I3Mhf589X3kjQUjqxuWHmtFnhsGc4dVT'),
(18, 'jimmysscentaurertere', 'acmilan_ronaldinhodeptrai@yahoo.com.vn', '$2y$10$itvjYO.oHbI1BpHx98Z2aeA9Z.BH/8Ugfxt/P6pQYJzxvcJTL1fie', 0, '4hRtL0242hecCh69f9189mwcZ', '', '', '', '', '', 0, '2015-01-31 14:26:49', '2015-01-31 14:26:49', ''),
(19, 'noi chng la', 'jimasa@sdws.cdcfd', '$2y$10$u7cmno1y6CNCibuefnKlyeQVNTKFEPeoUeyJQhuLgVKIwerPfGOfK', 0, 'UA3q43y8x4wQXvKZzDTliP459', '', '', '', '', '', 0, '2015-02-01 04:31:47', '2015-02-01 04:31:47', ''),
(20, 'dfdfdfdfdfdfdfdfdfd', 'jjjjjj@gmail.com', '$2y$10$Bz.z0G2w5Hg7BUjH0ZY8aeV5ZLiF.V19Nu4jFPKefYyDoK.ej9ore', 0, '73ccb9mU1q3PIZ9hyIN1ZQZ1U', '', '', '', '', '', 0, '2015-02-01 05:11:01', '2015-02-01 05:11:01', ''),
(21, 'fwerwerwe', 'q@SDEFWE.COM', '$2y$10$lEOKOIJCVHQp/Jda.jCdl.GhkKmA5LgAxrcDM4M4KepkmqWJ5DYRW', 0, 'Bdqz9Cru71sjJ1sVzmzitqmw0', '', '', '', '', '', 0, '2015-02-01 05:11:54', '2015-02-01 05:11:54', ''),
(22, 'kinhkhatrangsi', 'hoangkha252@gmail.com', '$2y$10$ytzS6kcZa.BoQKMJaoes4.tHb1KeCzMXeFxM7Qrt9/CC35ItO4z4a', 937163522, '4BLXFt7dQ36X3VqqklZl9OmWP', '', '', '', '', '', 0, '2015-02-03 14:18:41', '2015-02-03 14:18:41', ''),
(23, 'jijij', 'asw@dswd.com', '$2y$10$P73XOQ0Yz0sIlLgKrPZo9.33J/M2/Lte/IUpplxTChYFyb66sd2Mq', 0, 'ql6wcJ3ow7zSofb30i8rxNo46', '', '', '', '', '', 0, '2015-02-03 16:28:34', '2015-02-03 16:28:34', '');
