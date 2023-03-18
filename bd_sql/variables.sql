-- phpMyAdmin SQL Dump
-- version 5.1.4deb1~bpo11+1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 18 mars 2023 à 15:46
-- Version du serveur : 10.5.18-MariaDB-0+deb11u1
-- Version de PHP : 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



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
  `id_var` varchar(20) NOT NULL,
  `temps_maj` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `variables`
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
  MODIFY `num` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

