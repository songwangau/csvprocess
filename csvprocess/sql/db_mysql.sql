-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 25, 2014 at 07:22 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `csv_p_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `user_name` varchar(24) COLLATE utf8_bin NOT NULL COMMENT 'user name',
  `surname` varchar(24) COLLATE utf8_bin NOT NULL COMMENT 'user surname',
  `email` varchar(24) COLLATE utf8_bin NOT NULL COMMENT 'user email',
  `status` int(1) NOT NULL COMMENT 'record status',
  `create_date` datetime NOT NULL COMMENT 'created date',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
