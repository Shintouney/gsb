-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 06 Février 2017 à 00:18
-- Version du serveur :  10.1.9-MariaDB
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
-- Structure de la table `etat_ticket`
--

CREATE TABLE `etat_ticket` (
  `id_etat` int(11) NOT NULL,
  `intitule_etat` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etat_ticket`
--

INSERT INTO `etat_ticket` (`id_etat`, `intitule_etat`) VALUES
(1, 'En cours'),
(2, 'En attente'),
(3, 'Validé'),
(4, 'Annulé');

-- --------------------------------------------------------

--
-- Structure de la table `incident`
--

CREATE TABLE `incident` (
  `id` int(11) NOT NULL,
  `etat` int(10) DEFAULT NULL,
  `materiel_id` int(11) NOT NULL,
  `objet_incident` varchar(100) NOT NULL,
  `description_incident` text,
  `solution_incident` text,
  `date_signalement` varchar(16) NOT NULL,
  `date_intervention` date DEFAULT NULL,
  `salle_id` int(11) NOT NULL,
  `technicien_id` int(11) DEFAULT NULL,
  `demandeur_id` int(11) DEFAULT NULL,
  `niveau_urgence` int(11) DEFAULT NULL,
  `niveau_complexite` int(11) DEFAULT NULL,
  `duree` int(11) DEFAULT NULL,
  `nb_appels` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `incident`
--

INSERT INTO `incident` (`id`, `etat`, `materiel_id`, `objet_incident`, `description_incident`, `solution_incident`, `date_signalement`, `date_intervention`, `salle_id`, `technicien_id`, `demandeur_id`, `niveau_urgence`, `niveau_complexite`, `duree`, `nb_appels`) VALUES
(18, 1, 3, 'problème disque dur', 'le disque dur fait un bruit bizarre', 'remplacement du disque dur', '2016-11-28', '2016-11-28', 2, 5, 8, 3, 1, 30, 1),
(74, 2, 1, 'plus d''encre', 'encre à changer', 'changer les cartouches', '2017-02-05', '2017-02-05', 6, 5, 6, 4, 1, 10, 0),
(75, 3, 4, 'problème batterie', 'la batterie se décharge anormalement vite', 'utilisation d''un mauvais chargeur, remplacé par un chargeur adapté', '2017-02-04', '2017-02-06', 15, 7, 2, 1, 1, 0, 1),
(77, 2, 8, 'prise vga abimée', 'prise vga arrachéeen tirant le cable', NULL, '2006-02-17', NULL, 2, 1, 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `id_materiel` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `marque` varchar(20) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `logiciels_installes` varchar(50) NOT NULL,
  `date_achat` date DEFAULT NULL,
  `date_fin_garantie` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `materiel`
--

INSERT INTO `materiel` (`id_materiel`, `type`, `marque`, `modele`, `logiciels_installes`, `date_achat`, `date_fin_garantie`) VALUES
(1, 'Imprimante', 'Epson', 'XP-235 Multifonctions WiFi Noire', '', '2016-11-21', '2018-11-21'),
(2, 'imprimante', 'canon', 'MG 4250', '', '2016-10-01', '2016-12-01'),
(3, 'souris', 'Mad Catz', 'RAT white', '', '2016-11-01', '2017-01-01'),
(4, 'PC (portable)', 'Asus', ' G752VS-BA202D', 'suite office', '2015-01-01', '2017-01-01'),
(5, 'PC (tour)', 'HP', 'PAVILION 550-307NF', 'suite office, suite adobe', '2016-11-29', '2017-02-01'),
(6, 'PC (portable)', 'ASUS', 'G752VS-BA202C', 'paint, démineur', '2016-12-06', '2016-12-06'),
(8, 'Ecran', 'Asus', 'VG245H', '', '2017-01-02', '0000-00-00'),
(9, 'Serveur', 'HP', 'ProLiant DL380', '', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `nom`, `libelle`) VALUES
(1, 'ROLE_USER', 'utilisateur'),
(2, 'ROLE_ADMIN', 'administrateur'),
(3, 'ROLE_VISITEUR', 'visiteur'),
(4, 'ROLE_TECHNICIEN', 'technicien'),
(5, 'ROLE_RESPONSABLE', 'responsable technique'),
(6, 'ROLE_COMPTABLE', 'comptable');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `salle_id` int(11) NOT NULL,
  `salle_nom` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`salle_id`, `salle_nom`) VALUES
(1, '1 Bureau du Directeur'),
(2, '2 Bureau sous-directeur'),
(3, '101 Salle de reunion'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9'),
(10, '100'),
(11, ''),
(12, ''),
(13, ''),
(14, ''),
(15, '105'),
(16, ''),
(17, ''),
(18, ''),
(19, '109'),
(20, '200'),
(21, ''),
(22, ''),
(23, ''),
(24, ''),
(25, '205');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` char(4) NOT NULL,
  `nom` char(30) DEFAULT NULL,
  `prenom` char(30) DEFAULT NULL,
  `login` char(20) DEFAULT NULL,
  `mdp` varchar(128) DEFAULT NULL,
  `adresse` char(30) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL,
  `ville` char(30) DEFAULT NULL,
  `dateEmbauche` date DEFAULT NULL,
  `role_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateEmbauche`, `role_id`) VALUES
('1', 'attribuer !', 'A', 'admin', 'azerty', NULL, NULL, NULL, '2016-12-05', 0),
('2', 'tomdefaut', 'tomadmin', 'tom', '$2y$10$8kb42rDcDDTdy5.15X8gVeOAuKCGrXzDZCci1HK9PyMQgJH6D/axa', 'aaa', '12345', 'aaa', '2017-01-16', 2),
('3', 'Andrea', 'Davida', 'dandre', '$2y$10$.Dqesbjc1cUnmBA1WZGnEOtuinGHKZS6.xVhVTzASdU1giuiClnTu', '1 rue Petit', '46200', 'Lalbenque', '1998-11-23', 2),
('4', 'Bedosr', 'Christianr', 'cbedos', '$2y$10$WZew/YSaaXT0aHSmxv/.Hu4qf0ZHz3dd0jkiw7ryr8bZezfbGpV4e', '1 rue Peranud', '46250', 'Montcuq', '1995-01-12', 5),
('5', 'Villachane', 'Louis', 'lvillachane', '$2y$10$pWO6VY/Q1BnrlHsp0zesceXeAp.fKwC8bsDu/wTiuYI/erZ2V4Ol2', '8 rue des Charmes', '46000', 'Cahors', '2005-12-21', 4),
('6', 'Tusseau', 'Louis', 'ltusseau', '$2y$10$LCC0dDQOS5oldiMH3WMgG.4.nzBuUddCaMLW2CsTsWecu2IxU38/K', '22 rue des Ternes', '46123', 'Gramat', '2000-05-01', 3),
('7', 'Bioret', 'Luc', 'lbioret', 'hrjfs', '1 Avenue gambetta', '46000', 'Cahors', '1998-05-11', 4),
('8', 'Bentot', 'Pascal', 'pbentot', 'doyw1', '11 allée des Cerises', '46512', 'Bessines', '1992-07-09', 0),
('9', 'Bunisset', 'Francis', 'fbunisset', '4vbnd', '10 rue des Perles', '93100', 'Montreuil', '1987-10-21', 0),
('b19', 'Bunisset', 'Denise', 'dbunisset', 's1y1r', '23 rue Manin', '75019', 'paris', '2010-12-05', 0),
('b28', 'Cacheux', 'Bernard', 'bcacheux', 'uf7r3', '114 rue Blanche', '75017', 'Paris', '2009-11-12', 0),
('b34', 'Cadic', 'Eric', 'ecadic', '6u8dc', '123 avenue de la République', '75011', 'Paris', '2008-09-23', 0),
('b4', 'Charoze', 'Catherine', 'ccharoze', 'u817o', '100 rue Petit', '75019', 'Paris', '2005-11-12', 0),
('b50', 'Clepkens', 'Christophe', 'cclepkens', 'bw1us', '12 allée des Anges', '93230', 'Romainville', '2003-08-11', 0),
('b59', 'Cottin', 'Vincenne', 'vcottin', '2hoh9', '36 rue Des Roches', '93100', 'Monteuil', '2001-11-18', 0),
('c14', 'Daburon', 'François', 'fdaburon', '7oqpv', '13 rue de Chanzy', '94000', 'Créteil', '2002-02-11', 0),
('c3', 'De', 'Philippe', 'pde', 'gk9kx', '13 rue Barthes', '94000', 'Créteil', '2010-12-14', 0),
('c54', 'Debelle', 'Michel', 'mdebelle', 'od5rt', '181 avenue Barbusse', '93210', 'Rosny', '2006-11-23', 2),
('d13', 'Debelle', 'Jeanne', 'jdebelle', 'nvwqq', '134 allée des Joncs', '44000', 'Nantes', '2000-05-11', 0),
('d51', 'Debroise', 'Michel', 'mdebroise', 'sghkb', '2 Bld Jourdain', '44000', 'Nantes', '2001-04-17', 0),
('e22', 'Desmarquest', 'Nathalie', 'ndesmarquest', 'f1fob', '14 Place d Arc', '45000', 'Orléans', '2005-11-12', 0),
('e24', 'Desnost', 'Pierre', 'pdesnost', '4k2o5', '16 avenue des Cèdres', '23200', 'Guéret', '2001-02-05', 0),
('e39', 'Dudouit', 'Frédéric', 'fdudouit', '44im8', '18 rue de l église', '23120', 'GrandBourg', '2000-08-01', 0),
('e49', 'Duncombe', 'Claude', 'cduncombe', 'qf77j', '19 rue de la tour', '23100', 'La souteraine', '1987-10-10', 0),
('e5', 'Enault-Pascreau', 'Céline', 'cenault', 'y2qdu', '25 place de la gare', '23200', 'Gueret', '1995-09-01', 0),
('e52', 'Eynde', 'Valérie', 'veynde', 'i7sn3', '3 Grand Place', '13015', 'Marseille', '1999-11-01', 0),
('f21', 'Finck', 'Jacques', 'jfinck', 'mpb3t', '10 avenue du Prado', '13002', 'Marseille', '2001-11-10', 0),
('f39', 'Frémont', 'Fernande', 'ffremont', 'xs5tq', '4 route de la mer', '13012', 'Allauh', '1998-10-01', 0),
('f4', 'Gest', 'Alain', 'agest', 'dywvt', '30 avenue de la mer', '13025', 'Berre', '1985-11-01', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `etat_ticket`
--
ALTER TABLE `etat_ticket`
  ADD PRIMARY KEY (`id_etat`);

--
-- Index pour la table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`id_materiel`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`salle_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `etat_ticket`
--
ALTER TABLE `etat_ticket`
  MODIFY `id_etat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `incident`
--
ALTER TABLE `incident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id_materiel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `salle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
