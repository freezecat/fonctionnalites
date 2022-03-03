-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 25 fév. 2022 à 00:11
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `commentaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(10) NOT NULL,
  `commentaire` varchar(256) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `rang` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `pseudo`, `commentaire`, `parent_id`, `rang`) VALUES
(1, 'AAA', 'aaa', NULL, 0),
(2, 'BBB', 'bb', NULL, 0),
(3, 'CCC', 'CCC', NULL, 0),
(4, 'DDD', 'DDD', NULL, 0),
(5, 'EEEEE', 'EEE', NULL, 0),
(6, 'nnnnn', 'nnnnn', NULL, 0),
(7, 'uu', 'uu', 2, 1),
(8, 'vv', 'vv', 7, 2),
(9, 'yy', 'yy', 4, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
