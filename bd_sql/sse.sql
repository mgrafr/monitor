-

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Base de données : `monitor`
--

--
-- Structure de la table `sse`
--

CREATE TABLE `sse` (
  `num` int(1) NOT NULL,
  `id` varchar(20) NOT NULL,
  `state` varchar(5) NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sse`
--

INSERT INTO `sse` (`num`, `id`, `state`, `date`) VALUES
(0, '', '', '09:42:44');
COMMIT;

