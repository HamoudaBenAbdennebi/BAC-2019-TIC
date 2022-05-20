-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le : Jeu 19 Mai 2022 à 20:23
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bd2019`
--
CREATE DATABASE `bd2019` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd2019`;

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `IdParticipant` int(11) NOT NULL AUTO_INCREMENT,
  `Mail` varchar(50) NOT NULL,
  `Mdp` varchar(6) NOT NULL,
  `Genre` set('M','F') NOT NULL,
  PRIMARY KEY (`IdParticipant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `NumQ` int(11) NOT NULL,
  `NumS` int(11) NOT NULL,
  `Contenu` varchar(150) NOT NULL,
  PRIMARY KEY (`NumQ`,`NumS`),
  KEY `NumS` (`NumS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`NumQ`, `NumS`, `Contenu`) VALUES
(1, 1, 'Les informations partagées sur les réseaux sociaux sont fiables'),
(1, 2, 'Les jeux vidéo contribuent au développement de la pensée logique'),
(2, 1, 'L''usage des réseaux sociaux par les enfants doit être sous le contrôle parental'),
(3, 1, 'Les réseaux sociaux deviennent une nécessité pour les citoyens');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `NumQ` int(11) NOT NULL,
  `NumS` int(11) NOT NULL,
  `IdParticipant` int(11) NOT NULL,
  `Rep` set('O','N','S') NOT NULL,
  PRIMARY KEY (`NumQ`,`NumS`,`IdParticipant`),
  KEY `NumS` (`NumS`),
  KEY `IdParticipant` (`IdParticipant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sondage`
--

CREATE TABLE IF NOT EXISTS `sondage` (
  `NumS` int(11) NOT NULL AUTO_INCREMENT,
  `Theme` varchar(50) NOT NULL,
  `DateDebut` date NOT NULL,
  PRIMARY KEY (`NumS`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `sondage`
--

INSERT INTO `sondage` (`NumS`, `Theme`, `DateDebut`) VALUES
(1, 'Les réseaux sociaux', '2019-05-01'),
(2, 'Les jeux vidéo', '2019-06-01');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`NumS`) REFERENCES `sondage` (`NumS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_3` FOREIGN KEY (`IdParticipant`) REFERENCES `participant` (`IdParticipant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`NumQ`) REFERENCES `question` (`NumQ`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`NumS`) REFERENCES `sondage` (`NumS`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
