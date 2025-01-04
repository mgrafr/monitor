-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 04 jan. 2025 à 12:41
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



-- Base de données : `monitor`
--

-- --------------------------------------------------------

--
-- Structure de la table `cameras`
--

CREATE TABLE `cameras` (
  `num` int(2) NOT NULL,
  `idx` varchar(5) NOT NULL,
  `id_zm` varchar(3) NOT NULL,
  `id_fr` varchar(30) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `url` varchar(120) NOT NULL,
  `marque` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `localisation` text NOT NULL,
  `modect` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--

-- Index pour la table `cameras`
--
ALTER TABLE `cameras`
  ADD PRIMARY KEY (`num`);

-- AUTO_INCREMENT pour la table `cameras`
--
ALTER TABLE `cameras`
  MODIFY `num` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;


