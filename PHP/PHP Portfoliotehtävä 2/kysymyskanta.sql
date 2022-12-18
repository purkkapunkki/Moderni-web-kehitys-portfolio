-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2022 at 01:45 AM
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
-- Database: `kysymyskanta`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(11) NOT NULL,
  `nimi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategoria`
--

INSERT INTO `kategoria` (`id`, `nimi`) VALUES
(1, 'Kategoria 1'),
(2, 'Kategoria 2');

-- --------------------------------------------------------

--
-- Table structure for table `kysymys`
--

CREATE TABLE `kysymys` (
  `id` int(11) NOT NULL,
  `otsikko` varchar(50) NOT NULL,
  `sisalto` text NOT NULL,
  `aika` datetime NOT NULL,
  `kayttaja_id` int(11) NOT NULL,
  `kategoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kysymys`
--

INSERT INTO `kysymys` (`id`, `otsikko`, `sisalto`, `aika`, `kayttaja_id`, `kategoria_id`) VALUES
(1, 'Otsikko', 'Kysymys?', '2022-12-16 23:11:30', 1, 2),
(2, 'Hieno kysymys', 'Työlas kysmys, jossa opn paljon tekstiää ja typoja', '2022-12-16 23:23:02', 1, 1),
(3, 'asdasd', 'asdadf', '2022-12-16 23:29:51', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `käyttäjä`
--

CREATE TABLE `käyttäjä` (
  `id` int(11) NOT NULL,
  `nimimerkki` varchar(25) NOT NULL,
  `sähköposti` varchar(25) NOT NULL,
  `salasana` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `käyttäjä`
--

INSERT INTO `käyttäjä` (`id`, `nimimerkki`, `sähköposti`, `salasana`) VALUES
(1, 'kayttaja', 'kayttaja@example.com', 'salasana'),
(2, 'kayttaja2', 'kayttaja2@example.com', 'salasana');

-- --------------------------------------------------------

--
-- Table structure for table `vastaus`
--

CREATE TABLE `vastaus` (
  `id` int(11) NOT NULL,
  `sisalto` text NOT NULL,
  `aika` datetime NOT NULL,
  `kysymys_id` int(11) NOT NULL,
  `kayttaja_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vastaus`
--

INSERT INTO `vastaus` (`id`, `sisalto`, `aika`, `kysymys_id`, `kayttaja_id`) VALUES
(1, 'Eka vastaus', '2022-12-17 01:08:58', 2, 1),
(2, 'Hieno vastaus', '2022-12-17 01:09:37', 2, 1),
(3, 'Viime viikon vastaus', '2022-12-08 01:09:49', 2, 1),
(4, 'Paras vastaus', '2022-12-17 01:10:00', 2, 1),
(5, 'käyttäjä2 tietää asian', '2022-12-17 01:28:42', 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kysymys`
--
ALTER TABLE `kysymys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kayttaja_id` (`kayttaja_id`),
  ADD KEY `kategoria_id` (`kategoria_id`);

--
-- Indexes for table `käyttäjä`
--
ALTER TABLE `käyttäjä`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nimimerkki` (`nimimerkki`),
  ADD UNIQUE KEY `sähköposti` (`sähköposti`);

--
-- Indexes for table `vastaus`
--
ALTER TABLE `vastaus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kysymys_id` (`kysymys_id`),
  ADD KEY `kayttaja_id` (`kayttaja_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kysymys`
--
ALTER TABLE `kysymys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `käyttäjä`
--
ALTER TABLE `käyttäjä`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vastaus`
--
ALTER TABLE `vastaus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kysymys`
--
ALTER TABLE `kysymys`
  ADD CONSTRAINT `kysymys_ibfk_1` FOREIGN KEY (`kayttaja_id`) REFERENCES `käyttäjä` (`id`),
  ADD CONSTRAINT `kysymys_ibfk_2` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoria` (`id`);

--
-- Constraints for table `vastaus`
--
ALTER TABLE `vastaus`
  ADD CONSTRAINT `vastaus_ibfk_1` FOREIGN KEY (`kayttaja_id`) REFERENCES `käyttäjä` (`id`),
  ADD CONSTRAINT `vastaus_ibfk_2` FOREIGN KEY (`kysymys_id`) REFERENCES `kysymys` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
