-- phpMyAdmin SQL Dump
-- version 5.1.4deb1~bpo11+1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 25 fév. 2024 à 13:25
-- Version du serveur : 10.5.23-MariaDB-0+deb11u1
-- Version de PHP : 8.2.13

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
  `idm` varchar(4) DEFAULT NULL,
  `Actif` varchar(1) NOT NULL DEFAULT '1',
  `materiel` text NOT NULL DEFAULT '',
  `ls` varchar(1) NOT NULL DEFAULT '0',
  `maj_js` varchar(20) NOT NULL DEFAULT '',
  `id1_html` varchar(30) NOT NULL DEFAULT '#',
  `car_max_id1` varchar(4) NOT NULL DEFAULT ' ',
  `F()` int(2) DEFAULT NULL,
  `id2_html` varchar(20) NOT NULL DEFAULT '',
  `coul_id1_id2_ON` varchar(40) NOT NULL DEFAULT '',
  `coul_id1_id2_OFF` varchar(40) NOT NULL DEFAULT '',
  `class_lamp` varchar(20) NOT NULL DEFAULT '',
  `coul_lamp_ON` varchar(30) NOT NULL DEFAULT '',
  `coul_lamp_OFF` varchar(40) NOT NULL DEFAULT '',
  `pass` varchar(10) DEFAULT '0',
  `observations` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `dispositifs`
--

INSERT INTO `dispositifs` (`num`, `nom_appareil`, `nom_objet`, `idx`, `ID`, `idm`, `Actif`, `materiel`, `ls`, `maj_js`, `id1_html`, `car_max_id1`, `F()`, `id2_html`, `coul_id1_id2_ON`, `coul_id1_id2_OFF`, `class_lamp`, `coul_lamp_ON`, `coul_lamp_OFF`, `pass`, `observations`) VALUES
(1, ' ', 'upload', '22', '', NULL, '1', '', '0', 'variable', '#', ' ', NULL, '', '', '', '', '', '', '0', '');

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
