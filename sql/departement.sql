-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 17 Janvier 2017 à 17:23
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
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `Dpt_Num` varchar(3) NOT NULL,
  `Dpt_Nom` varchar(30) NOT NULL,
  `Dpt_Region` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`Dpt_Num`, `Dpt_Nom`, `Dpt_Region`) VALUES
('01', 'AIN', 'RA'),
('02', 'AISNE', 'PI'),
('03', 'ALLIER', 'AU'),
('04', 'ALPES DE HAUTE PROVENCE', 'PR'),
('05', 'HAUTES ALPES', 'PR'),
('06', 'ALPES MARITIMES', 'PR'),
('07', 'ARDECHE', 'RA'),
('08', 'ARDENNES', 'CA'),
('09', 'ARIEGE', 'MP'),
('10', 'AUBE', 'CA'),
('11', 'AUDE', 'LR'),
('12', 'AVEYRON', 'MP'),
('13', 'BOUCHES DU RHONE', 'PR'),
('14', 'CALVADOS', 'BN'),
('15', 'CANTAL', 'AU'),
('16', 'CHARENTE', 'PC'),
('17', 'CHARENTE MARITIME', 'PC'),
('18', 'CHER', 'CE'),
('19', 'CORREZE', 'LI'),
('20', 'CORSE', 'CO'),
('21', 'COTE D''OR', 'BO'),
('22', 'COTES D''ARMOR', 'BR'),
('23', 'CREUSE', 'LI'),
('24', 'DORDOGNE', 'AQ'),
('25', 'DOUBS', 'FC'),
('26', 'DROME', 'RA'),
('27', 'EURE', 'HN'),
('28', 'EURE ET LOIR', 'CE'),
('29', 'FINISTERE', 'BR'),
('2A', 'CORSE DU SUD', 'CO'),
('2B', 'HAUTE CORSE', 'CO'),
('30', 'GARD', 'LR'),
('31', 'HAUTE GARONNE', 'MP'),
('32', 'GERS', 'MP'),
('33', 'GIRONDE', 'AQ'),
('34', 'HERAULT', 'LR'),
('35', 'ILLE ET VILLAINE', 'BR'),
('36', 'INDRE', 'CE'),
('37', 'INDRE ET LOIRE', 'CE'),
('38', 'ISERE', 'RA'),
('39', 'JURA', 'FC'),
('40', 'LANDES', 'AQ'),
('41', 'LOIR ET CHER', 'CE'),
('42', 'LOIRE', 'RA'),
('43', 'HAUTE LOIRE', 'AU'),
('44', 'LOIRE ATLANTIQUE', 'PL'),
('45', 'LOIRET', 'CE'),
('46', 'LOT', 'MP'),
('47', 'LOT ET GARONNE', 'AQ'),
('48', 'LOZERE', 'LR'),
('49', 'MAINE ET LOIRE', 'PL'),
('50', 'MANCHE', 'BN'),
('51', 'MARNE', 'CA'),
('52', 'HAUTE MARNE', 'CA'),
('53', 'MAYENNE', 'PL'),
('54', 'MEURTHE ET MOSELLE', 'LO'),
('55', 'MEUSE', 'LO'),
('56', 'MORBIHAN', 'BR'),
('57', 'MOSELLE', 'LO'),
('58', 'NIEVRE', 'BO'),
('59', 'NORD', 'NP'),
('60', 'OISE', 'PI'),
('61', 'ORNE', 'BN'),
('62', 'PAS DE CALAIS', 'NP'),
('63', 'PUY DE DOME', 'AU'),
('64', 'PYRENEES ATLANTIQUES', 'AQ'),
('65', 'HAUTES PYRENEES', 'MP'),
('66', 'PYRENEES ORIENTALES', 'LR'),
('67', 'BAS RHIN', 'AL'),
('68', 'HAUT RHIN', 'AL'),
('69', 'RHONE', 'RA'),
('70', 'HAUTE SAONE', 'FC'),
('71', 'SAONE ET LOIRE', 'BO'),
('72', 'SARTHE', 'PL'),
('73', 'SAVOIE', 'RA'),
('74', 'HAUTE SAVOIE', 'RA'),
('75', 'PARIS', 'IF'),
('76', 'SEINE MARITIME', 'HN'),
('77', 'SEINE ET MARNE', 'IF'),
('78', 'YVELINES', 'IF'),
('79', 'DEUX SEVRES', 'PC'),
('80', 'SOMME', 'PI'),
('81', 'TARN', 'MP'),
('82', 'TARN ET GARONNE', 'MP'),
('83', 'VAR', 'PR'),
('84', 'VAUCLUSE', 'PR'),
('85', 'VENDEE', 'PL'),
('86', 'VIENNE', 'PC'),
('87', 'HAUTE VIENNE', 'LI'),
('88', 'VOSGES', 'LO'),
('89', 'YONNE', 'BO'),
('90', 'TERRITOIRE DE BELFORT', 'FC'),
('91', 'ESSONNE', 'IF'),
('92', 'HAUTS DE SEINE', 'IF'),
('93', 'SEINE SAINT DENIS', 'IF'),
('94', 'VAL DE MARNE', 'IF'),
('95', 'VAL D''OISE', 'IF'),
('971', 'GUADELOUPE', 'AN'),
('972', 'MARTINIQUE', 'AN'),
('973', 'GUYANE', 'AN'),
('974', 'REUNION', 'RE'),
('975', 'SAINT PIERRE ET MIQUELON', 'SM'),
('976', 'MAYOTTE', 'RE');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
