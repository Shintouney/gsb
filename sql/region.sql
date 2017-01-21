-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 16 Janvier 2017 à 17:28
-- Version du serveur :  10.1.8-MariaDB
-- Version de PHP :  5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gsb`
--

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

CREATE TABLE `region` (
  `code` varchar(2) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `region`
--

INSERT INTO `region` (`code`, `nom`) VALUES
('AL', 'Alsace'),
('AN', 'Antilles-Guyane'),
('AQ', 'Aquitaine'),
('AU', 'Auvergne'),
('BN', 'Basse-Normandie'),
('BO', 'Bourgogne'),
('BR', 'Bretagne'),
('CA', 'Champagne-Ardenne'),
('CE', 'Centre'),
('CO', 'Corse'),
('FC', 'Franche-Comt?'),
('HN', 'Haute-Normandie'),
('IF', 'Ile-de-France'),
('LI', 'Limousin'),
('LO', 'Lorraine'),
('LR', 'Languedoc-Roussillon'),
('MP', 'Midi-Pyr?n?es'),
('NP', 'Nord-Pas de Calais'),
('PC', 'Poitou-Charentes'),
('PI', 'Picardie'),
('PL', 'Pays de la Loire'),
('PR', 'Provence-Alpes-C?te d''Azur'),
('RA', 'Rh?ne-Alpes'),
('RE', 'R?union'),
('SM', 'Saint-Pierre et Miquelon');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;