-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 22 mai 2025 à 15:53
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `monitor`
--

-- --------------------------------------------------------

--
-- Structure de la table `dispositifs`
--

CREATE TABLE `dispositifs` (
  `num` int(11) NOT NULL,
  `nom_appareil` varchar(25) NOT NULL DEFAULT ' ',
  `nom_objet` varchar(40) NOT NULL DEFAULT '',
  `idx` varchar(4) DEFAULT NULL,
  `ID` varchar(50) NOT NULL DEFAULT '',
  `idm` varchar(5) DEFAULT NULL,
  `Actif` varchar(1) NOT NULL DEFAULT '1',
  `materiel` text NOT NULL DEFAULT '',
  `ls` varchar(1) NOT NULL DEFAULT '0',
  `maj_js` varchar(20) NOT NULL DEFAULT '',
  `id1_html` varchar(30) NOT NULL DEFAULT '#',
  `car_max_id1` varchar(4) NOT NULL DEFAULT ' ',
  `F()` int(2) DEFAULT NULL,
  `id2_html` varchar(20) NOT NULL DEFAULT '',
  `coul_id1_id2_ON` varchar(60) NOT NULL,
  `coul_id1_id2_OFF` varchar(60) NOT NULL,
  `class_lamp` varchar(20) NOT NULL DEFAULT '',
  `coul_lamp_ON` varchar(50) NOT NULL,
  `coul_lamp_OFF` varchar(50) NOT NULL DEFAULT '',
  `pass` varchar(10) DEFAULT '0',
  `observations` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `dispositifs`
--

INSERT INTO `dispositifs` (`num`, `nom_appareil`, `nom_objet`, `idx`, `ID`, `idm`, `Actif`, `materiel`, `ls`, `maj_js`, `id1_html`, `car_max_id1`, `F()`, `id2_html`, `coul_id1_id2_ON`, `coul_id1_id2_OFF`, `class_lamp`, `coul_lamp_ON`, `coul_lamp_OFF`, `pass`, `observations`) VALUES
(1, ' var pour connect', 'upload', '22', 'input_text.var_upload', '1016', '2', '', '0', 'variable', '#', ' ', NULL, '', '', '', '', '', '', '0', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `dispositifs`
--
ALTER TABLE `dispositifs`
  ADD PRIMARY KEY (`num`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `dispositifs`
--
ALTER TABLE `dispositifs`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
