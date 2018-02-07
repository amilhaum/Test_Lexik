-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 07 fév. 2018 à 22:36
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lexik`
--

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `group`
--

INSERT INTO `group` (`name`) VALUES
('Administrateur'),
('SysAdmin'),
('User');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `date_anniversary` date NOT NULL,
  `group_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `group_name` (`group_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `last_name`, `first_name`, `date_anniversary`, `group_name`) VALUES
(13, 'martin.amilhaud@gmail.com', 'AMILHAUD', 'Martin', '1995-06-28', 'User'),
(14, 'john.doe@unknown.com', 'DOE', 'John', '2020-02-07', 'Administrateur'),
(15, 'marty.macfly@gmail.com', 'MACFLY', 'Marty', '1961-06-09', 'SysAdmin'),
(16, 'emmett.brown@gmail.com', 'BROWN', 'EMMET', '1932-08-22', 'User'),
(17, 'elon.musk@spaceX.com', 'MUSK', 'Elon', '1971-06-28', 'SysAdmin'),
(18, 'jane.doe@unknown.com', 'DOE', 'Jane', '2020-02-06', 'Administrateur');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_name`) REFERENCES `group` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
