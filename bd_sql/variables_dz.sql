-- phpMyAdmin SQL Dump
-- version 5.1.4deb2~bpo11+1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Version de PHP : 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Base de données : `monitor`
--

-- --------------------------------------------------------

--
-- Structure de la table `variables_dz`
--

CREATE TABLE `variables_dz` (
  `num` int(4) NOT NULL,
  `id_m_img` varchar(20) NOT NULL,
  `id_m_txt` varchar(25) NOT NULL DEFAULT '0',
  `nom_dz` varchar(20) NOT NULL,
  `id_dz` varchar(4) NOT NULL,
  `temps_maj` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Index pour la table `variables_dz`
--
ALTER TABLE `variables_dz`
  ADD PRIMARY KEY (`num`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `variables_dz`
--
ALTER TABLE `variables_dz`
  MODIFY `num` int(4) NOT NULL AUTO_INCREMENT;
COMMIT;


