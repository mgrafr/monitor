
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



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
  `coul_lamp_ON` varchar(30) NOT NULL DEFAULT '',
  `coul_lamp_OFF` varchar(50) NOT NULL DEFAULT '',
  `pass` varchar(10) DEFAULT '0',
  `observations` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--

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
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;


