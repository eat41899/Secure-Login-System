-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2016 at 03:44 AM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.13-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Comp424`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `birthday` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `securityQuestion` varchar(70) NOT NULL,
  `securityAnswer` varchar(20) NOT NULL,
  `salt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `firstName`, `lastName`, `birthday`, `email`, `securityQuestion`, `securityAnswer`, `salt`) VALUES
(1, 'Ali', '29aec25f75c971604239238a09c10969e9b770fec1792c1b34720783735b092d2f6b0c4b78699b76b3188005f845d9c26568969f0b7d525f909d057e72a9a7c7', 'Ali', 'Mojarrad', '2016-11-14', 'mojarradali@yahoo.com', 'password question', 'password answer', 'a98b505a15dc'),
(2, 'username', '3cf2eafe3577b72bf7bfcee97146efd39c91afb049bc34d7603791fa18422bf287026c6d6c96c8690f430f22b9b6810d44a80cf9345396e26a317ff3fb742ec0', 'test', 'test', '2016-12-31', 'dupubeham@9me.site', '', '', '485aca363278'),
(3, 'mojarradali', '2965b8d851e2848f1f00cd4a126da7db8342e2005b8567fd275b19c11008416bca64cd095ca52db438e5b2070585816de26c4963da98a6b7a76f46a43b4472d0', 'Ali', 'Mojarrad', '1990-04-01', 'mojarradali@yahoo.com', '', '', '783ae48d95e1');

-- --------------------------------------------------------

--
-- Table structure for table `usersTemp`
--

CREATE TABLE `usersTemp` (
  `code` varchar(120) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `birthday` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `securityQuestion` varchar(70) NOT NULL,
  `securityAnswer` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `usersTemp`
--
ALTER TABLE `usersTemp`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
