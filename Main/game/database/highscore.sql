-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 27 mei 2024 om 07:16
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
-- Tabelstructuur voor tabel `highscore`
--

DROP TABLE IF EXISTS `highscore`;
CREATE TABLE IF NOT EXISTS `highscore` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `score` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(11, 'traderking 42', 500, '2024-05-23');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
