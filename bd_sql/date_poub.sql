
--
-- Structure de la table `date_poub`
--

CREATE TABLE `date_poub` (
  `num` int(11) NOT NULL,
  `date` text NOT NULL,
  `valeur` text NOT NULL,
  `icone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Index pour la table `date_poub`
--
ALTER TABLE `date_poub`
  ADD PRIMARY KEY (`num`);

