
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Index pour la table `variables_dz`
--
ALTER TABLE `variables_dz`
  ADD PRIMARY KEY (`num`);

