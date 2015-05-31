-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2015 at 07:55 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rpg`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `Name` varchar(35) NOT NULL,
  `Owner` int(25) NOT NULL DEFAULT '0',
  `Strength` int(15) NOT NULL DEFAULT '0',
  `Constitution` int(15) NOT NULL DEFAULT '0',
  `Intelligence` int(15) NOT NULL DEFAULT '0',
`ID` bigint(21) unsigned NOT NULL,
  `ItemClass` varchar(45) NOT NULL DEFAULT '',
  `Dexterity` int(15) unsigned NOT NULL,
  `Worth` bigint(15) NOT NULL DEFAULT '0',
  `Equipped` varchar(5) NOT NULL DEFAULT 'no',
  `Amount` int(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=244 DEFAULT CHARSET=latin1 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Table structure for table `monsters`
--

CREATE TABLE IF NOT EXISTS `monsters` (
`ID` bigint(21) NOT NULL,
  `Level` bigint(15) NOT NULL DEFAULT '0',
  `Name` varchar(20) NOT NULL DEFAULT '',
  `Type` tinyint(2) NOT NULL DEFAULT '0',
  `Spell` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 PACK_KEYS=0;

--
-- Dumping data for table `monsters`
--

INSERT INTO `monsters` (`ID`, `Level`, `Name`, `Type`, `Spell`) VALUES
(1, 1, 'Bandits', 0, 0),
(2, 2, 'Mage', 1, 1),
(3, 3, 'Hiruyoki', 0, 0),
(4, 4, 'Troll', 0, 0),
(5, 5, 'Harpie', 1, 2),
(6, 6, 'Shinigami', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `spells`
--

CREATE TABLE IF NOT EXISTS `spells` (
  `Name` varchar(20) NOT NULL DEFAULT '',
`ID` tinyint(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spells`
--

INSERT INTO `spells` (`Name`, `ID`) VALUES
('Water Terrain', 1),
('Wind Slasher', 2),
('Inferno Edge', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`ID` bigint(21) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `HP` int(15) NOT NULL,
  `MaxHP` int(15) NOT NULL,
  `MP` int(15) NOT NULL,
  `MaxMP` int(15) NOT NULL,
  `Strength` int(15) NOT NULL,
  `Constitution` int(15) NOT NULL,
  `Dexterity` int(15) NOT NULL,
  `Intelligence` int(15) NOT NULL,
  `Gold` bigint(25) NOT NULL,
  `Items` tinyint(5) NOT NULL,
  `Fighting` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 PACK_KEYS=0;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `firstname`, `lastname`, `email`, `username`, `password`, `HP`, `MaxHP`, `MP`, `MaxMP`, `Strength`, `Constitution`, `Dexterity`, `Intelligence`, `Gold`, `Items`, `Fighting`) VALUES
(1, 'jk', 'asentista', 'jk@gmail.com', 'jk', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 100, 100, 70, 100, 102, 108, 106, 102, 4721, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userspells`
--

CREATE TABLE IF NOT EXISTS `userspells` (
`ID` int(20) NOT NULL,
  `Owner` int(5) NOT NULL DEFAULT '0',
  `Name` varchar(45) NOT NULL DEFAULT '',
  `ManaCost` bigint(20) NOT NULL,
  `Power` int(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `monsters`
--
ALTER TABLE `monsters`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `spells`
--
ALTER TABLE `spells`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userspells`
--
ALTER TABLE `userspells`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `ID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=244;
--
-- AUTO_INCREMENT for table `monsters`
--
ALTER TABLE `monsters`
MODIFY `ID` bigint(21) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `spells`
--
ALTER TABLE `spells`
MODIFY `ID` tinyint(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `ID` bigint(21) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `userspells`
--
ALTER TABLE `userspells`
MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
