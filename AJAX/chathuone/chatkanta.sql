-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2022 at 01:41 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatkanta`
--

-- --------------------------------------------------------

--
-- Table structure for table `viesti`
--

CREATE TABLE `viesti` (
  `id` int(11) NOT NULL,
  `sisalto` text NOT NULL,
  `kirjoittaja` varchar(25) NOT NULL,
  `aika` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `viesti`
--

INSERT INTO `viesti` (`id`, `sisalto`, `kirjoittaja`, `aika`) VALUES
(1, 'Moi! Mitä teille kuuluu?', 'Muumipeikko', '2022-12-17 22:24:34'),
(2, 'Hei! Hyvää kuuluu!', 'Niiskuneiti', '2022-12-17 22:26:34'),
(3, 'Hei kaikille, pitkästä aikaa. Jos teillä ei ole muita suunnitelmia, niin mennäänkö rannalle keräämään näkinkenkiä?', 'Nuuskamuikkunen', '2022-12-17 22:27:30'),
(4, 'Ovatko näkinkengät arvokkaita?', 'Nipsu', '2022-12-17 22:28:30'),
(5, 'Näkinkengät ovat erittäin arvokkaita! Ja ne näyttävät kauniilta äidin ruusupenkin ympärillä. Ja rannalle meno sopii hyvin!', 'Muumipeikko', '2022-12-17 22:30:42'),
(6, 'Joo, mennään rannalle!', 'Niiskuneiti', '2022-12-17 22:29:42'),
(7, 'Mjooooo... mennään sitten.', 'Nipsu', '2022-12-17 22:32:53'),
(8, 'Nipsu, senkin ahne tiskiharja.', 'Pikku Myy', '2022-12-17 22:34:53'),
(9, 'Kaikki on arvotonta. Ei sillä että sillä olisi mitään merkitystä.', 'Piisamirotta', '2022-12-17 22:35:14'),
(11, 'Testiviesti', 'Kuka vaan', '2022-12-18 00:13:00'),
(12, 'radamsa', 'Näkymätön päästäinen', '2022-12-18 01:50:28'),
(13, 'mAmElUkKiKaLa!', 'Hemuli', '2022-12-18 01:55:58'),
(14, '..............', 'Mörkö', '2022-12-18 01:58:43'),
(15, 'Mamelukkikala ei ole luettelossani!', 'Niisku', '2022-12-18 02:33:17'),
(16, 'Mamelukkikaloja, tässä tilanteessa?! No, ehkä yksi.', 'Piisamirotta', '2022-12-18 02:35:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `viesti`
--
ALTER TABLE `viesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `viesti`
--
ALTER TABLE `viesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
