

--
-- Structure de la table `cameras`
--

CREATE TABLE `cameras` (
  `num` int(2) NOT NULL,
  `idx` varchar(5) NOT NULL,
  `id_zm` varchar(3) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `url` varchar(120) NOT NULL,
  `marque` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `localisation` text NOT NULL,
  `modect` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Index pour la table `cameras`
--
ALTER TABLE `cameras`
  ADD PRIMARY KEY (`num`);

