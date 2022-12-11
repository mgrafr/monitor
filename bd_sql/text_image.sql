

--
-- Structure de la table `text_image`
--

CREATE TABLE `text_image` (
  `num` int(3) NOT NULL,
  `texte` varchar(30) NOT NULL,
  `image` varchar(30) NOT NULL,
  `icone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Index pour la table `text_image`
--
ALTER TABLE `text_image`
  ADD PRIMARY KEY (`num`);

