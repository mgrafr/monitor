
-- Structure de la table `dispositifs`
--

CREATE TABLE `dispositifs` (
  `num` int(11) NOT NULL,
  `nom_dz` varchar(25) NOT NULL,
  `idx` varchar(4) NOT NULL,
  `idm` varchar(4) NOT NULL,
  `materiel` text NOT NULL,
  `node` int(5) DEFAULT NULL,
  `maj_js` varchar(20) NOT NULL,
  `id1_html` varchar(30) NOT NULL DEFAULT '#',
  `car_max_id1` int(2) NOT NULL DEFAULT 99,
  `id2_html` varchar(20) NOT NULL,
  `coul_id1_id2_ON` varchar(30) NOT NULL,
  `coul_id1_id2_OFF` varchar(30) NOT NULL,
  `class_lamp` varchar(20) NOT NULL,
  `coul_lamp_ON` varchar(30) NOT NULL,
  `coul_lamp_OFF` varchar(30) NOT NULL,
  `pass` varchar(10) DEFAULT '0',
  `doc` varchar(30) NOT NULL,
  `observations` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Index pour la table `dispositifs`
--
ALTER TABLE `dispositifs`
  ADD PRIMARY KEY (`num`);


