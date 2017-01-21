 -- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 16 Janvier 2017 à 17:23
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
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `commune_id` int(11) NOT NULL,
  `date_embauche` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `mdp`, `role_id`, `email`, `token`, `nom`, `prenom`, `adresse`, `commune_id`, `date_embauche`) VALUES
(1, 'bruno', '$2y$10$.2jIJW6KRzGeu/mSIdhO2e4e2KisqKpOpVESyk./Yvk5Qdyleabk6&', 3, 'avinint@hotmail.com', '', 'Avinint&', 'Bruno', '189 rue du Nord', 32691, '2015-09-01'),
(2, 'shinta', '$2y$10$NOEoBeu0q.TTNmCAqup1WuEGeS4jXZVFicdwUWFI5xCYZiJwPXdFq', 3, 'shinta42@hotmail.fr', '', 'Zeghouani', 'Haitem', '8 rue du 11 Décembre', 32252, '2015-09-01'),
(3, 'tom', '$2y$10$NKxmmdCxqs03JfI3a3oZ2u6/ULGBlUqg6e0V5Dh3dhr.QiGWbwASu', 3, 'thomas.duport1@gmail.com', '', 'Duport', 'Thomas', 'les Sauvages', 32532, '2015-09-08');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uti_role` (`role_id`),
  ADD KEY `uti_pays` (`commune_id`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
