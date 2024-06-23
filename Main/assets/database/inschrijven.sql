-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 17 jun 2024 om 12:00
-- Serverversie: 8.0.31
-- PHP-versie: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project4`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inschrijven`
--

DROP TABLE IF EXISTS `inschrijven`;
CREATE TABLE IF NOT EXISTS `inschrijven` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `BurgerServiceNummer` int NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `infix` varchar(20) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `birthDate` date NOT NULL,
  `gender` ENUM('Man', 'Vrouw') NOT NULL,
  `adres` varchar(50) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `inschrijfDatum` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `inschrijven`
--

INSERT INTO `inschrijven` (`id`, `BurgerServiceNummer`, `firstName`, `infix`, `lastName`, `birthDate`, `gender`, `adres`, `postcode`, `email`, `tel`, `inschrijfDatum`) VALUES
(1, 123456789, 'Youri', 'de ', 'Ron', '2003-06-03', 'Man', '6 Adriaanstraat', '4175HB', 'deronyouri@gmail.com', '0642029443', '2024-06-17 10:45:35');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
