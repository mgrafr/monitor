-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 13 fév. 2025 à 20:15
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 8.3.16

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
-- Structure de la table `2fa_token`
--

CREATE TABLE `2fa_token` (
  `num` int(3) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `token` varchar(20) NOT NULL,
  `sms` int(1) NOT NULL DEFAULT 0,
  `user_free` varchar(10) NOT NULL,
  `pass_free` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `2fa_token`
--

INSERT INTO `2fa_token` (`num`, `user_id`, `token`, `sms`, `user_free`, `pass_free`) VALUES
(1, 'user', '', 2, '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `2fa_token`
--
ALTER TABLE `2fa_token`
  ADD PRIMARY KEY (`num`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `2fa_token`
--
ALTER TABLE `2fa_token`
  MODIFY `num` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
