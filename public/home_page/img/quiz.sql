-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2015 at 02:26 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass_reset` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fb_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uid` bigint(20) NOT NULL,
  `role` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=52 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `confirmation`, `password`, `pass_reset`, `profile_picture`, `fb_token`, `uid`, `role`, `updated_at`, `created_at`, `remember_token`) VALUES
(2, 'misa11a04', 'Hieu', 'Nguyen', 'misa11a04@gmail.com', '', '$2y$08$Ag.L7Sl4XpV4nDt9v.Hnc.Zqvxli1GeRoftKWwpkVJsopyptYEhdW', '', '', '', 0, 0, '2014-08-25 13:41:44', '0000-00-00 00:00:00', ''),
(4, 'hieu.huu', 'Hieu', 'Nguyen Huu', 'huuhieubk@gmail.com', '', '$2y$08$Ag.L7Sl4XpV4nDt9v.Hnc.Zqvxli1GeRoftKWwpkVJsopyptYEhdW', 'L1Pn05673T87Pq05W6D3K9kEp', 'http://quiz.local/uploads/users/_user_1409249266.jpg', 'CAAEhLOQNDI4BALnPHWt4CfSuVb5jmb7f6EORefQ8lJNYOkAUZCROZBC4INhpgCm6uIPbeQFboVEOMtnQ2MTC7uXabXeE9ahAJL9MIdiZAISD55N4Rjqaoz24SUuT2s0s0kQOqlrZBCIRhWph5d0ZC1MDhPHcVFM3UZCjiUNugiy7ujUECfsX7g9r5dDAyZBKtisr2r6BXlpPOVLcgEtlZC9b', 10201246982535573, 1, '2015-01-09 10:28:11', '2014-08-18 07:38:19', ''),
(11, 'breakingbad2409gvdf', '', '', 'acmilan_ronaldinhodeptrai@yahoo.com.vn', 'ja95gOd6enwn2uX0F5s1Qy7mN', '$2y$08$gSHuhWF5XVhF9Wnx6bZhVuV1xHDG.xv2myU9bhyDXrcy0rc0SOf.O', '', '', '', 0, 0, '2015-01-11 08:50:00', '2015-01-11 08:50:00', ''),
(12, 'dsffdfdfdfdfdfd', '', '', '51000880@hcmut.edu', 'Z5MZ9wUrW0H98jChR6rAQdQ8f', '$2y$08$Ss8LZJWz3C6Fj4oADpu3LOVp.AYicxVoXJz5ZZNyFCeuq4Y9X5CU6', '', '', '', 0, 0, '2015-01-11 09:08:13', '2015-01-11 09:08:13', ''),
(15, 'anhugn', '', '', 'tam@gmail.com', 'Kkc5E3ydG3513OvgNTPUWS9ol', '$2y$08$cUhyyPHEdhfReHz4ECW9gujB1OkI4apBULbMVECxRfpuVY/CoFjky', '', '', '', 0, 0, '2015-01-11 10:10:09', '2015-01-11 10:10:09', ''),
(16, '51001558dgdt', '', '', 'sdfd@dsfg.com', 'l25Xui3vabNLIoCOa7eE2cVu0', '$2y$08$VdQaN7rNKhdowMKCNi1sie6SIAwxTkUmhueO622YeelOr.RK7gxyO', '', '', '', 0, 0, '2015-01-11 10:13:24', '2015-01-11 10:13:24', ''),
(17, 'jimmysscentaur123', '', '', 'dsadf@dfe.com', 'VpFruCbBnD6Qt3QHwJu0ZDaV4', '$2y$08$AoGj7CAZh/R3b0ELo5f5oOh4YCC7X2HVAd2RgH43eghNzmKZZHpyS', '', '', '', 0, 0, '2015-01-11 10:19:32', '2015-01-11 10:19:32', ''),
(19, 'jimmysscentauregeyuk', '', '', '51000880@hcmut.edu.vn', '6W5H423IGZJM52ggL7uO29UkI', '$2y$08$mcl0Brvw5KTY1bXjDmiiJeOVen.Ue0EtI1QX03Axhfpbnn4PWQ.2q', '', '', '', 0, 0, '2015-01-12 02:36:22', '2015-01-12 02:36:22', ''),
(37, 'jimmysscentaurertu7i86ir', '', '', 'ertyru5e@wertetyhr.df', 'gWEE2uxW4x8Vwmb5L9uM2GIXi', '$2y$08$GrtcpZU2Weo4hinX4QjwCewZGwqwtDgaGaR5kgOl741atnjLIf4a2', '', '', '', 0, 0, '2015-01-13 08:30:09', '2015-01-13 08:30:09', ''),
(44, 'dsdsdsadas', '', '', 'sdsf@dfsghg.com', 'zZXKsLmwNX7fB33z9bb8yaz7o', '$2y$10$jwkzK17L/F4mpcorlCnaZO1CM41YkZxKzYmQGj0cJKwf6GCobYoN6', '', '', '', 0, 0, '2015-01-13 20:16:54', '2015-01-13 20:16:54', ''),
(45, 'sdfgh', '', '', 'asdfg@fg.co', 'HU45i1H5ylwLhSFD4eQ6FrWXC', '$2y$10$b4TFqZWZLa3vj/5ejrsOEuD.cf8EHVpq8ViIiod14ORv3c.Y6c.lu', '', '', '', 0, 0, '2015-01-13 21:28:41', '2015-01-13 21:28:41', ''),
(46, 'jimmysscentaur', '', '', 'jimmysscentaur@gmail.com', '', '$2y$10$dE74otsW/CbDmqr7Yh2aK.FjCRGjv88uBWuQQFU2nLXHfhUfZEJqq', '2iv3bUeieXcik1j2qN0g2XTf5', '', '', 0, 0, '2015-01-14 10:32:53', '2015-01-13 21:39:42', 'm9I6YUncSM1ASYDJ2Vt3BtHQn79ZTV0INHpu0n3Df9f74BaxUPcvPeQQj3Ej'),
(50, 'Mimosa Pudica', '', '', 'acmilan_ronaldinhodeptrai@yahoo.com.vn', '', '', '', '', '', 790444357696033, 0, '2015-01-14 00:35:15', '2015-01-14 00:35:15', ''),
(51, 'rytuyi', '', '', 'fghj@fdghj.df', 'i9I3ZwV24Pj9x49yJwQW7o485', '$2y$10$90gcPqEHqTWTAhZpYsjHOOglNVY2NOiVo5ea2/XWKUk3LetIDywra', '', '', '', 0, 0, '2015-01-14 01:04:42', '2015-01-14 01:04:42', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
