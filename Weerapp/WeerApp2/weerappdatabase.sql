-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 nov 2020 om 23:09
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weerapp`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker`
--

CREATE TABLE `gebruiker` (
  `idGebruiker` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker`
--

INSERT INTO `gebruiker` (`idGebruiker`, `username`, `password`) VALUES
(1, 'patrick', '$2y$10$rqTvajQMKNma5vFUauR2ueQPuZJL0rxnCtCEUeq4arbbfKnwXnB76');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker_locaties_maps`
--

CREATE TABLE `gebruiker_locaties_maps` (
  `Gebruiker_idGebruiker` int(11) NOT NULL,
  `Locaties_idLocaties` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `locaties`
--

CREATE TABLE `locaties` (
  `idLocaties` int(11) NOT NULL,
  `locatie` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `locaties`
--

INSERT INTO `locaties` (`idLocaties`, `locatie`) VALUES
(16, 'Geldermalsen'),
(17, 'Leerdam'),
(18, 'Tiel'),
(19, 'Amsterdam'),
(20, 'Gorinchem'),
(21, 'Rotterdam'),
(22, 'Rotterdam'),
(23, 'Amsterdam'),
(24, 'Amsterdam'),
(25, 'Leerdam'),
(26, 'Leerdam'),
(27, 'Amsterdam'),
(29, 'Leerdam'),
(42, 'Rotterdam'),
(46, 'Rotterdam'),
(47, 'Rotterdam'),
(48, 'Rotterdam'),
(49, 'Rotterdam'),
(50, 'Rotterdam'),
(51, 'Tiel'),
(52, 'Tiel');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`idGebruiker`);

--
-- Indexen voor tabel `gebruiker_locaties_maps`
--
ALTER TABLE `gebruiker_locaties_maps`
  ADD PRIMARY KEY (`Gebruiker_idGebruiker`,`Locaties_idLocaties`),
  ADD KEY `fk_Gebruiker_has_Locaties_Locaties1_idx` (`Locaties_idLocaties`),
  ADD KEY `fk_Gebruiker_has_Locaties_Gebruiker_idx` (`Gebruiker_idGebruiker`);

--
-- Indexen voor tabel `locaties`
--
ALTER TABLE `locaties`
  ADD PRIMARY KEY (`idLocaties`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `idGebruiker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `locaties`
--
ALTER TABLE `locaties`
  MODIFY `idLocaties` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `gebruiker_locaties_maps`
--
ALTER TABLE `gebruiker_locaties_maps`
  ADD CONSTRAINT `fk_Gebruiker_has_Locaties_Gebruiker` FOREIGN KEY (`Gebruiker_idGebruiker`) REFERENCES `gebruiker` (`idGebruiker`),
  ADD CONSTRAINT `fk_Gebruiker_has_Locaties_Locaties1` FOREIGN KEY (`Locaties_idLocaties`) REFERENCES `locaties` (`idLocaties`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
