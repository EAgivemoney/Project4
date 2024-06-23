-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 05 jun 2024 om 22:23
-- Serverversie: 8.0.31
-- PHP-versie: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_p4`
--
CREATE DATABASE IF NOT EXISTS `project_p4` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `project_p4`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Phone` int NOT NULL,
  `Message` varchar(10000) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `highscore`
--

DROP TABLE IF EXISTS `highscore`;
CREATE TABLE IF NOT EXISTS `highscore` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `score` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `highscore`
--

INSERT INTO `highscore` (`id`, `name`, `score`, `date`) VALUES
(1, 'youri', 500, '2024-05-16'),
(2, 'youri', 500, '2024-05-16'),
(3, 'youri2', 340, '2024-05-16'),
(4, 'youri3', 500, '2024-05-16'),
(5, 'winner', 500, '2024-05-23'),
(6, 'loser', 200, '2024-05-23'),
(7, 'loser2', 500, '2024-05-23'),
(8, 'test6', 500, '2024-05-23'),
(9, 'gamer7', 500, '2024-05-23'),
(10, 'noobmaster79', 500, '2024-05-23'),
(11, 'traderking 42', 500, '2024-05-23'),
(12, 'youri', 15015, '2024-05-27');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Status` enum('Banned','User','Admin','Owner') NOT NULL DEFAULT 'User',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `login`
--

INSERT INTO `login` (`Id`, `Username`, `Email`, `Password`, `Status`) VALUES
(1, 'ThomasMeijer', 'ThomasMeijer@Thomas.com', 'Thomas2007', 'Admin'),
(2, 'ThomasTest', 'ThomasTest@Thomas.com', 'Thomas2007', 'User'),
(3, 'ImBanned', 'ImBanned@Banned.com', 'Thomas2007', 'Banned'),
(4, 'Pigeon12000', 'ImAPigeon@ThePark.com', 'Thomas2007', 'Owner');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
