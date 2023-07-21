-- phpMyAdmin SQL Dump
-- version 5.1.4deb1~bpo11+1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 21 juil. 2023 à 16:09
-- Version du serveur : 10.5.19-MariaDB-0+deb11u2
-- Version de PHP : 8.2.1

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
-- Structure de la table `variables`
--

CREATE TABLE `variables` (
  `num` int(4) NOT NULL,
  `id_m_img` varchar(20) NOT NULL,
  `id_m_txt` varchar(25) NOT NULL DEFAULT '0',
  `nom_var` varchar(20) NOT NULL,
  `id_var` varchar(4) NOT NULL,
  `temps_maj` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `variables`
--

INSERT INTO `variables` (`num`, `id_m_img`, `id_m_txt`, `nom_var`, `id_var`, `temps_maj`) VALUES
(1, 'poubelle', '0', 'poubelles', '1', 0),
(2, 'fosse', '0', 'fosse_septique', '2', 0),
(3, 'aff_anni', 'prenom', 'anniversaires', '3', 0),
(4, '', 'not', 'porte-ouverte', '4', 0),
(5, '', 'not', 'intrusion', '5', 0),
(6, '', '', 'ma-alarme', '6', 1),
(12, 'alarme_nuit', '0', 'alarme', '15', 0),
(13, 'batterie', '0', 'alarme_bat', '17', 0),
(14, 'bl', '0', 'boite_lettres', '19', 0),
(15, 'ping_rasp', '0', 'pi-alarme', '21', 0),
(17, '', 'act-sir-txt', 'activation-sir-txt', '27', 0),
(18, 'pression_chaud', '0', 'pression-chaudiere', '28', 0),
(19, 'pilule', '0', 'pilule_tension', '30', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `variables`
--
ALTER TABLE `variables`
  ADD PRIMARY KEY (`num`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `variables`
--
ALTER TABLE `variables`
  MODIFY `num` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
