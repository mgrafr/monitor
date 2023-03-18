-- phpMyAdmin SQL Dump
-- version 5.1.4deb1~bpo11+1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 18 mars 2023 à 14:06
-- Version du serveur : 10.5.18-MariaDB-0+deb11u1
-- Version de PHP : 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



-- Base de données : `monitor`
--

-- --------------------------------------------------------

--
-- Structure de la table `dispositifs`
--

CREATE TABLE `dispositifs` (
  `num` int(11) NOT NULL,
  `nom appareil` varchar(20) NOT NULL,
  `nom_dz` varchar(40) NOT NULL,
  `idx` varchar(4) NOT NULL,
  `ID` varchar(50) NOT NULL,
  `idm` varchar(4) NOT NULL,
  `materiel` varchar(40) NOT NULL,
  `maj_js` varchar(20) NOT NULL,
  `id1_html` varchar(30) NOT NULL DEFAULT '#',
  `car_max_id1` varchar(4) NOT NULL DEFAULT ' ',
  `F()` int(2) DEFAULT NULL,
  `id2_html` varchar(20) NOT NULL,
  `coul_id1_id2_ON` varchar(30) NOT NULL,
  `coul_id1_id2_OFF` varchar(30) NOT NULL,
  `class_lamp` varchar(20) NOT NULL,
  `coul_lamp_ON` varchar(30) NOT NULL,
  `coul_lamp_OFF` varchar(30) NOT NULL,
  `pass` varchar(10) DEFAULT '0',
  `observations` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



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
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
COMMIT;

