-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 06 dec 2019 kl 17:43
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
-- Tabellstruktur `moviecat`
--

CREATE TABLE `moviecat` (
  `idPolen` int(11) NOT NULL,
  `idCategory` int(1) NOT NULL,
  `idGenre` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `moviecat`
--

INSERT INTO `moviecat` (`idPolen`, `idCategory`, `idGenre`) VALUES
(1, 1, 'Thriller'),
(2, 2, 'Romantic'),
(4, 3, 'Comedy'),
(5, 4, 'Adventure'),
(6, 5, 'Action');

-- --------------------------------------------------------

--
-- Tabellstruktur `movielib`
--

CREATE TABLE `movielib` (
  `idMovie` int(11) NOT NULL,
  `idCategory` int(1) NOT NULL,
  `idTitle` longtext NOT NULL,
  `idDirector` longtext NOT NULL,
  `idYear` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `moviecat`
--
ALTER TABLE `moviecat`
  ADD PRIMARY KEY (`idPolen`);

--
-- Index för tabell `movielib`
--
ALTER TABLE `movielib`
  ADD PRIMARY KEY (`idMovie`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `moviecat`
--
ALTER TABLE `moviecat`
  MODIFY `idPolen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT för tabell `movielib`
--
ALTER TABLE `movielib`
  MODIFY `idMovie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
