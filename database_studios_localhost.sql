-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2014 at 03:28 PM
-- Server version: 5.6.16
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aleks_blog_goodgamestudios_localhost`
--
CREATE DATABASE IF NOT EXISTS `database_studios_localhost` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `database_studios_localhost`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `email`, `content`, `created_at`) VALUES
(1, 1, 'f@v.de', 'aaaaaaaaaaaa', '2014-06-30 11:56:24'),
(2, 1, 'r@o.de', 'kkkkkkkkkkkkkk', '2014-06-30 11:56:24'),
(3, 4, 'min4@min4.de', '4minute rules', '2014-07-01 10:50:28'),
(4, 4, 'go@go.com', 'go 4minute', '2014-07-01 10:53:18'),
(5, 4, 'fan@fan.de', 'oneul mwohae', '2014-07-01 10:55:09'),
(6, 4, 'alek@san.dar', 'uri manalae', '2014-07-01 10:57:21'),
(12, 4, 'fan@fan.de', 'hatsg <a href=''http://www.this.web''>www.this.web</a> if it works and this one <a href=''http://www.na.com''>www.na.com</a> as this one <a href=''https://www.bla.de''>https://www.bla.de</a> and <a href=''http://aha.not''>http://aha.not</a> yes.', '2014-07-01 11:54:39'),
(27, 2, 'de@de.de', 'deeeeeee', '2014-07-01 15:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `content_hash` char(32) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`,`content_hash`),
  UNIQUE KEY `content_hash` (`content_hash`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `email`, `content`, `content_hash`, `created_at`) VALUES
(1, 'first post', 'a@b.de', 'jfklajflkasjfkljkf sfnsjfnjsaf sjflksjf', '9be326b676d9f019d42eb7922135e4e8', '2014-06-30 11:54:06'),
(2, 'second post', 'b@c.de', 'pokpok kkkkkkk.', 'f960523a39a93f170836aa8199be0302', '2014-06-30 11:54:58'),
(3, 'testing post', 'test@email.com', 'tttttttt', '45fcaeafd8ebec14bece68f7f00ca154', '2014-07-01 10:34:36'),
(4, '4minute', 'min4@min4.de', '4minute', 'e0557b3b0dfc83cfcaefed59deda28cd', '2014-07-01 10:39:12'),
(5, 'dot', 'de@de.de', 'hatsg <a href=''http://www.this.web''>www.this.web</a> if it works and this one <a href=''http://www.na.com''>www.na.com</a> as this one <a href=''https://www.bla.de''>https://www.bla.de</a> and <a href=''http://aha.not''>http://aha.not</a> yes.', '010fd28d2d7d3d8e27eb994c7b852b22', '2014-07-01 11:56:35'),
(6, 'title', 'e@li.co', 'latest post', '9df4aa8ef4e2ddc50051af8072149724', '2014-07-01 15:20:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
