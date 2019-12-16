-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 16 dec 2019 kl 18:51
-- Serverversion: 10.4.8-MariaDB
-- PHP-version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `movielibary`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `movielib`
--

CREATE TABLE `movielib` (
  `idMovie` int(11) NOT NULL,
  `idCategory` tinytext NOT NULL,
  `idTitle` tinytext NOT NULL,
  `idDirector` tinytext NOT NULL,
  `idYear` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `movielib`
--

INSERT INTO `movielib` (`idMovie`, `idCategory`, `idTitle`, `idDirector`, `idYear`) VALUES
(1, 'Action', '123', '123', '12367');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `movielib`
--
ALTER TABLE `movielib`
  ADD PRIMARY KEY (`idMovie`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `movielib`
--
ALTER TABLE `movielib`
  MODIFY `idMovie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
