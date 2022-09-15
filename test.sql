-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 15 sep 2022 om 10:32
-- Serverversie: 10.4.21-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `ID` int(11) NOT NULL,
  `Voornaam` varchar(255) DEFAULT NULL,
  `Achternaam` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Bericht` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inner_j`
--

CREATE TABLE `inner_j` (
  `ID` int(11) NOT NULL,
  `k_id` varchar(255) NOT NULL,
  `v_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `koelkast`
--

CREATE TABLE `koelkast` (
  `User` varchar(255) DEFAULT NULL,
  `Koelkast` varchar(255) DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `Artikelnummer` varchar(255) NOT NULL,
  `Prijs` int(11) DEFAULT NULL,
  `Energie` varchar(255) DEFAULT NULL,
  `Inhoud` int(11) DEFAULT NULL,
  `Conditie` varchar(255) DEFAULT NULL,
  `Reparatie` varchar(255) DEFAULT NULL,
  `Time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`user`, `username`, `password`, `user_key`) VALUES
('lin', 'lin', '123', '0'),
('user', 'user', 'user', '0');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verzekering`
--

CREATE TABLE `verzekering` (
  `ID` int(11) NOT NULL,
  `naam` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `verzekering`
--

INSERT INTO `verzekering` (`ID`, `naam`) VALUES
(1, 'verzekering_A'),
(2, 'verzekering_B'),
(3, 'verzekering_C');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `inner_j`
--
ALTER TABLE `inner_j`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `koelkast`
--
ALTER TABLE `koelkast`
  ADD PRIMARY KEY (`Artikelnummer`);

--
-- Indexen voor tabel `verzekering`
--
ALTER TABLE `verzekering`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `inner_j`
--
ALTER TABLE `inner_j`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT voor een tabel `verzekering`
--
ALTER TABLE `verzekering`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
