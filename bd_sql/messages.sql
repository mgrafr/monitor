
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Base de données : `monitor`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `num` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `id1_html` varchar(20) NOT NULL,
  `contenu` text NOT NULL,
  `maj` int(1) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`num`, `nom`, `id1_html`, `contenu`, `maj`, `last_update`) VALUES
(1, 'message1', 'lastseen1', 'essai', 0, '2023-11-10 17:25:10');

-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`num`);

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

