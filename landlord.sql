-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2015 at 04:41 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `landlord`
--

-- --------------------------------------------------------

--
-- Table structure for table `google_map_jobs`
--

CREATE TABLE IF NOT EXISTS `google_map_jobs` (
`id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `place` varchar(300) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `google_map_user`
--

CREATE TABLE IF NOT EXISTS `google_map_user` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place` varchar(300) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
`id` int(11) NOT NULL,
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
  `created_at` varchar(50) NOT NULL
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
`id` int(11) NOT NULL,
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
  `remember_token` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone_number`, `email_confirm`, `pass_reset`, `phone_confirm`, `facebook_id`, `site_link`, `social_link`, `role`, `updated_at`, `created_at`, `remember_token`) VALUES
(17, 'dsds', 'jimmysscentaur@gmail.com', '$2y$10$vRajpRaj6Zy4N1zfD7J.oe/H.LelmSmnaJvCE30flsWApQwmJu1dK', 0, '', '5fy187yzYdjdt2cxUyqV3O3Hw', '', '', '', '', 0, '2015-02-01 15:30:22', '2015-01-31 11:34:25', 'Fpd9dGqX0IS8wFczB1OyW03uXFq1I3Mhf589X3kjQUjqxuWHmtFnhsGc4dVT'),
(18, 'jimmysscentaurertere', 'acmilan_ronaldinhodeptrai@yahoo.com.vn', '$2y$10$itvjYO.oHbI1BpHx98Z2aeA9Z.BH/8Ugfxt/P6pQYJzxvcJTL1fie', 0, '4hRtL0242hecCh69f9189mwcZ', '', '', '', '', '', 0, '2015-01-31 14:26:49', '2015-01-31 14:26:49', ''),
(19, 'noi chng la', 'jimasa@sdws.cdcfd', '$2y$10$u7cmno1y6CNCibuefnKlyeQVNTKFEPeoUeyJQhuLgVKIwerPfGOfK', 0, 'UA3q43y8x4wQXvKZzDTliP459', '', '', '', '', '', 0, '2015-02-01 04:31:47', '2015-02-01 04:31:47', ''),
(20, 'dfdfdfdfdfdfdfdfdfd', 'jjjjjj@gmail.com', '$2y$10$Bz.z0G2w5Hg7BUjH0ZY8aeV5ZLiF.V19Nu4jFPKefYyDoK.ej9ore', 0, '73ccb9mU1q3PIZ9hyIN1ZQZ1U', '', '', '', '', '', 0, '2015-02-01 05:11:01', '2015-02-01 05:11:01', ''),
(21, 'fwerwerwe', 'q@SDEFWE.COM', '$2y$10$lEOKOIJCVHQp/Jda.jCdl.GhkKmA5LgAxrcDM4M4KepkmqWJ5DYRW', 0, 'Bdqz9Cru71sjJ1sVzmzitqmw0', '', '', '', '', '', 0, '2015-02-01 05:11:54', '2015-02-01 05:11:54', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `google_map_jobs`
--
ALTER TABLE `google_map_jobs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_map_user`
--
ALTER TABLE `google_map_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `google_map_jobs`
--
ALTER TABLE `google_map_jobs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `google_map_user`
--
ALTER TABLE `google_map_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
