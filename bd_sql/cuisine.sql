-- phpMyAdmin SQL Dump
-- version 5.1.4deb1~bpo11+1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 28 sep. 2023 à 16:55
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
-- Structure de la table `cuisine`
--

CREATE TABLE `cuisine` (
  `num` int(3) NOT NULL,
  `id` int(3) NOT NULL,
  `titre` varchar(30) NOT NULL,
  `recette` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cuisine`
--

INSERT INTO `cuisine` (`num`, `id`, `titre`, `recette`) VALUES
(1, 1, 'Pate à pain', '<style>.txt1_cuisine{\r\nmargin-left: 10px;\r\n    font-size: 18px;\r\n    font-family: auto;\r\nfont-style: oblique;}</style>\r\n\r\n<p ><strong>Pour 1 Pizza 200g</strong> <em>+ petites pizzas apéro</em><br></p>	\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\" ><img src=\"$$images/farine.webp\" style=\"vertical-align: middle; width:60px;heght:80px\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;<span class=\"txt1_cuisine\">300&nbsp;g de farine</span></div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/levure.webp\" style=\"vertical-align: middle; width:60px;heght:80px\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;&nbsp;15g de  levure </div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/sel.webp\" style=\"vertical-align: middle;width:60px;heght:80px\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;3 à 5 g de sel </div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/huile olive.webp\" style=\"vertical-align: middle;width:60px;heght:80px\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;2 c a soupe huile olive</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/eau_tiede.webp\" style=\"vertical-align: middle;width:60px;heght:80px\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;15 cl (150g) d\'eau tiède</div>\r\n<p> <strong>Préparation:</strong><br><span style=\"font-family: auto;font-style: oblique;\">Versez dans un bol la levure mélangée à un peu de farine (50g) et à l’eau tiède et laissez réagir 5 minutes.<br>\r\nVersez ensuite la farine, le sel, l’huile d’olive et l’eau contenant la levure<br>\r\nPétrir jusqu’à ce qu’une boule de pâte se détache des parois <br>\r\nLaissez lever dans un endroit chaud à l’abris des courants d’air 30 minutes à 1h</span></p>'),
(2, 2, 'Croque-monsieurs', '<style>.txt1_cuisine{\r\nmargin-left: 10px;\r\n    font-size: 18px;\r\n    font-family: auto;\r\nfont-style: oblique;}</style>\r\n\r\n<p ><strong>Croque-monsieurs</strong> <em>au four</em><br>pour 8 croque-monsieurs</p>	\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\" ><img src=\"$$images/jambon.webp\" style=\"vertical-align: middle; width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;<span class=\"txt1_cuisine\">4&nbsp;tr de jambon</span></div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/leerdammer.webp\" style=\"vertical-align: middle; width:60px;heght:80px\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;&nbsp;8 tranches de Leerdammer</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/echalotte.webp\" style=\"vertical-align: middle;width:60px;heght:80px\" alt=\"\"/><img src=\"$$images/creme-fraiche.webp\" style=\"vertical-align: middle;width:60px;heght:80px\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;échalotes + crème fraiche</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/gruyere.webp\" style=\"vertical-align: middle;width:60px;heght:80px\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;gruyère rapé</div>\r\n\r\n<p> <strong>Préparation et cuisson :</strong><br><span style=\"font-family: auto;font-style: oblique;\">Mélanger échalotes rissolées et crème fraiche <br>\r\nEntre 2 tranches de pain et 2 demi-tranches de fromage, sur le jambon, mettre la creme fraiche-échalottes <br>Sur le croque un peu de crème fraiche et le gruyère rapé<br>	\r\n	Cuire au four à 200°.<br>\r\n	</p>'),
(3, 3, 'Crèpes', '<style>.txt1_cuisine{\r\nmargin-left: 10px;\r\n    font-size: 18px;\r\n    font-family: auto;\r\nfont-style: oblique;}</style>\r\n\r\n<p ><strong>Crèpes</strong>&nbsp;<em>maison </em><br>ingrédients pour 10 crèpes</p>	\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\" ><img src=\"$$images/farine.webp\" style=\"vertical-align: middle; width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;<span class=\"txt1_cuisine\">200 g de farine de blé</span></div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/oeufs.webp\" style=\"vertical-align: middle; width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;&nbsp;3 oeufs</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/beurre.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;40 g de beurre fondu</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/lait.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;400-450 ml de lait</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/huile olive.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/><img src=\"$$images/sel.webp\" style=\"vertical-align: middle;width:60px;\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;2 c à s d\'huile, 1 bâtonnet de vanille ou du sucre vanillé</div>\r\n\r\n<p> <strong>Préparation et cuisson :</strong><br><span style=\"font-family: auto;font-style: oblique;\">on peut ajouter :\r\n	2 c. à soupe de rhum ambré ou de fleur d\'oranger, ou 1/2 verre de bière blonde<br>\r\nDans un saladier, verser la farine, Y déposer les oeufs entiers, le sucre, l\'huile et le beurre.<br>\r\nMélanger délicatement avec un fouet en ajoutant au fur et à mesure le lait<br>Parfumer de vanille, ....ou de rhum (avec modération!!)\r\n	</p>'),
(4, 4, 'Mayonnaise', '<style>.txt1_cuisine{\r\nmargin-left: 10px;\r\n    font-size: 18px;\r\n    font-family: auto;\r\nfont-style: oblique;}</style>\r\n\r\n<p ><strong>Mayonnaise</strong>&nbsp;<em>maison </em><br>\r\ningrédients pour 4 personnes</p>	\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\" ><img src=\"$$images/moutarde.webp\" style=\"vertical-align: middle; width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;<span class=\"txt1_cuisine\">1 c.a.s de moutarde de Dijon</span></div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/vinaigre.webp\" style=\"vertical-align: middle; width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;&nbsp;1 filet de vinaigre</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/sel.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/><img src=\"$$images/poivre.webp\" style=\"vertical-align: middle;width:60px;\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;sel , poivre</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/jaune_oeuf.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;1 jaune d\'oeuf</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/huile_tournesol.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/><img src=\"$$images/huile olive.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;huile de tournesol ou huile d\'olive (selon goût)</div>\r\n\r\n<p> <strong>Préparation :</strong><br>\r\n	Les ingrédients doivent être à température ambiante. Mélangez le jaune d\'oeuf, un peu de sel, poivre, la moutarde et le vinaigre.<br>\r\nFouetter en versant peu à peu l\'huile, la mayonnaise doit peu à peu épaissir.<br>\r\nOn peut y ajouter des herbes ou du citron pour la parfumer.\r\n	</p'),
(5, 5, 'tarte_poires', '<style>.txt1_cuisine{\r\nmargin-left: 10px;\r\n    font-size: 18px;\r\n    font-family: auto;\r\nfont-style: oblique;}</style>\r\n\r\n<p ><strong>Tarte Poires</strong>&nbsp;<em>et chocolat </em><br>\r\ningrédients pour 4 à 8 personnes<br>cuisson 35 à 40 minutes<p>	\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\" ><img src=\"$$images/pate_feuilletée.webp\" style=\"vertical-align: middle; width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;<span class=\"txt1_cuisine\">1 pâte feuilletée</span></div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/poires.webp\" style=\"vertical-align: middle; width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;&nbsp;3 à 4 poires</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/pepites_chocolat.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;pépites de chocolat</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/oeufs.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;2 oeufs</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/creme-fraiche.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;2 ou 3 c.a.s crème fraiche </div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/sucre_vanille.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;1 sachet de sucre vanillé </div>\r\n\r\n<p> <strong>Préparation :</strong><br>\r\n	Dans un récipient mettre les 2 oeufs battus, la crème, le sucre vanillé<br>\r\n	Dérouler la pâte dans le moule avec le papier cuisson.<br>\r\nEplucher les poires , les couper en 2 ou en 4 et les disposer.<br>\r\nVerser la préparation et ajouter les pépites et mettre au four\r\n	</p>'),
(6, 6, 'Pizza au saumon', '<style>.txt1_cuisine{\r\nmargin-left: 10px;\r\n    font-size: 18px;\r\n    font-family: auto;\r\nfont-style: oblique;}</style>\r\n\r\n<p ><strong>Pizza au saumon</strong>&nbsp;<em></em><br>\r\ningrédients pour 1 pizza <p>	\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\" ><img src=\"$$images/pate_pizza.webp\" style=\"vertical-align: middle; width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;<span class=\"txt1_cuisine\">1 pâte à pizza</span></div>\r\n<div class=\"txt1_cuisine\" style=\"margin-top: 5px;margin-left:10px\"><img src=\"$$images/tr_saumon.webp\" style=\"vertical-align: middle; width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;&nbsp;6 tranches de saumon</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/huile olive.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n  &nbsp;&nbsp;&nbsp;2 c.a.s huile d\'olive</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/citron.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;zeste de citron</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/creme-fraiche.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;2 ou 3 c.a.s crème fraiche </div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/mozzarella.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;2 boules de mozzarella</div>\r\n<div class=\"txt1_cuisine\" style=\"margin-left:10px\"><img src=\"$$images/origan.webp\" style=\"vertical-align: middle;width:60px;heght:auto\" alt=\"\"/>\r\n	&nbsp;&nbsp;&nbsp;origan frais ou séché</div>\r\n<p> <strong>Préparation :</strong><br>\r\n	Etalez la pâte à pizza sur une plaque puis recouvrez-la d\'une fine couche de crème fraîche.<br>\r\n	Disposez les tranches de saumon, de façon à ce qu\'elles recouvrent toute la pâte.<br>\r\n	Arrosez de 2 c.a.s d\'huile d\'olive, saupoudrez d\'origan et de quelques zestes de citron.<br>\r\nCoupez la mozzarella en tranches moyennes pour en recouvrir la pizza.<br>\r\nEnfournez dans un four préchauffé à 200°C .\r\n	</p>');

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
  MODIFY `num` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
