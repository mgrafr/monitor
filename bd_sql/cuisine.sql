-- phpMyAdmin SQL Dump
-- version 5.1.4deb1~bpo11+1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 26 jan. 2023 à 17:09
-- Version du serveur : 10.5.18-MariaDB-0+deb11u1
-- Version de PHP : 8.2.1

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
-- Structure de la table `cuisine`
--

CREATE TABLE `cuisine` (
  `num` int(3) NOT NULL,
  `id` int(3) NOT NULL,
  `titre` varchar(20) NOT NULL,
  `recette` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cuisine`
--

INSERT INTO `cuisine` (`num`, `id`, `titre`, `recette`) VALUES
(1, 1, 'Pate à pain', '<style>.txt1_cuisine{\r\nmargin-left: 10px;\r\n    font-size: 18px;\r\n    font-family: auto;\r\nfont-style: oblique;}</style>\r\n\r\n<p ><strong>Pour 1 Pizza 200g</strong> <em>+ petites pizzas apéro</em><br></p>	\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\" ><img src=\"$$images/farine.webp\" style=\"vertical-align: middle; width:60px;heght:80px\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;<span class=\"txt1_cuisine\">300&nbsp;g de farine</span></div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/levure.webp\" style=\"vertical-align: middle; width:60px;heght:80px\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;&nbsp;15g de  levure </div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/sel.webp\" style=\"vertical-align: middle;width:60px;heght:80px\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;3 à 5 g de sel </div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/huile olive.webp\" style=\"vertical-align: middle;width:60px;heght:80px\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;2 c a soupe huile olive</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/eau_tiede.webp\" style=\"vertical-align: middle;width:60px;heght:80px\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;1⁄4 l d\'eau tiède</div>\r\n<p> <strong>Préparation:</strong><br><span style=\"font-family: auto;font-style: oblique;\">Versez dans un bol la levure mélangée à un peu de farine (50g) et à l’eau tiède et laissez réagir 5 minutes.<br>\r\nVersez ensuite la farine, le sel, l’huile d’olive et l’eau contenant la levure<br>\r\nPétrir jusqu’à ce qu’une boule de pâte se détache des parois <br>\r\nLaissez lever dans un endroit chaud à l’abris des courants d’air 30 minutes à 1h</span></p>'),
(2, 2, 'Croque-monsieurs', '<style>.txt1_cuisine{\r\nmargin-left: 10px;\r\n    font-size: 18px;\r\n    font-family: auto;\r\nfont-style: oblique;}</style>\r\n\r\n<p ><strong>Croque-monsieurs</strong> <em>au four</em><br>pour 8 croque-monsieurs</p>	\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\" ><img src=\"$$images/jambon.png\" style=\"vertical-align: middle; width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;<span class=\"txt1_cuisine\">4&nbsp;tr de jambon</span></div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/leerdammer.png\" style=\"vertical-align: middle; width:60px;heght:80px\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;&nbsp;8 tranches de Leerdammer</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/echalotte.png\" style=\"vertical-align: middle;width:60px;heght:80px\" alt=\"\"/><img src=\"$$images/creme fraiche.png\" style=\"vertical-align: middle;width:60px;heght:80px\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;échalottes + crème fraiche</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/gruyere.png\" style=\"vertical-align: middle;width:60px;heght:80px\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;gruyère rapé</div>\r\n\r\n<p> <strong>Préparation et cuisson :</strong><br><span style=\"font-family: auto;font-style: oblique;\">Mélanger échalottes rissolées et crème fraiche <br>\r\nSur le jambon , dans le croque mettre la creme fraiche-échalottes <br>Sur le croque un peu de crème fraiche et le gruyère rapé<br>	\r\n	Cuire au four à 200°.<br>\r\n	</p>');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cuisine`
--
ALTER TABLE `cuisine`
  ADD PRIMARY KEY (`num`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cuisine`
--
ALTER TABLE `cuisine`
  MODIFY `num` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
