-- phpMyAdmin SQL Dump
-- version 5.1.4deb2~bpo11+1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 08 mars 2023 à 16:45
-- Version du serveur : 10.5.18-MariaDB-0+deb11u1
-- Version de PHP : 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `domoticz`
--

-- --------------------------------------------------------

--
-- Structure de la table `text_image`
--

CREATE TABLE `text_image` (
  `num` int(3) NOT NULL,
  `texte` varchar(30) NOT NULL,
  `image` varchar(30) NOT NULL,
  `icone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `text_image`
--

INSERT INTO `text_image` (`num`, `texte`, `image`, `icone`) VALUES
(1, 'pluie', 'images/met_pluie.svg', ''),
(2, 'pas_pluie', 'images/parapluie_ferme.svg', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `text_image`
--
ALTER TABLE `text_image`
  ADD PRIMARY KEY (`num`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `text_image`
--
ALTER TABLE `text_image`
  MODIFY `num` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
