-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Samedi 20 juin 2020 à 16:45
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT
= 0;
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ruches`
--

-- --------------------------------------------------------

--
-- Structure de la table `infos`
--

DROP TABLE IF EXISTS `infos`;
CREATE TABLE
IF NOT EXISTS `infos`
(
  `id` int
(11) NOT NULL AUTO_INCREMENT,
  `ruche` varchar
(10) COLLATE utf8mb4_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp
(),
  `poids` float NOT NULL,
  `températures` float NOT NULL,
  `humidite` float NOT NULL,
  PRIMARY KEY
(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `infos`
--

INSERT INTO `infos` (`
id`,
`ruche
`, `date`, `poids`, `températures`, `humidite`) VALUES
(1, 'Ruche A', '2020-06-21 13:40:05', 44.5, 15, 79),
(2, 'Ruche A', '2020-06-21 00:00:00', 45, 16, 77),
(3, 'Ruche A', '2020-06-21 13:48:25', 45, 17, 80),
(4, 'Ruche A', '2020-06-21 13:48:25', 44, 14, 76),
(5, 'Ruche B', '2020-06-21 13:51:02', 44.5, 15, 79),
(6, 'Ruche B', '2020-06-21 17:39:45', 45, 16, 77),
(7, 'Ruche B', '2020-06-21 17:41:05', 45, 17, 80);

-- --------------------------------------------------------

--
-- Structure de la table `ruche`
--

DROP TABLE IF EXISTS `ruche`;
CREATE TABLE
IF NOT EXISTS `ruche`
(
  `id` int
(11) NOT NULL AUTO_INCREMENT,
  `ruche` varchar
(10) COLLATE utf8mb4_bin NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  PRIMARY KEY
(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `ruche`
--

INSERT INTO `ruche` (`
id`,
`ruche
`, `latitude`, `longitude`) VALUES
(1, 'Ruche A', 49.108, 6.18231),
(2, 'Ruche B', 49.2155, 6.17038);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
