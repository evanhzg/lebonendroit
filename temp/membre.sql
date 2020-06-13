-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 12 juin 2020 à 14:13
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `espace_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `pseudo`, `mail`, `mdp`) VALUES
(1, 'evan', 'test@test.fr', 'mdp'),
(2, 'evan2', 'pv.evaan@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(4, 'test', 'teszt@test.fr', 'de271790913ea81742b7d31a70d85f50a3d3e5ae'),
(5, 'admin', 'admin@admin.fr', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(6, 'azerty', 'azerty@a.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921'),
(7, 'jesuistonpapou', 'papa@mail.fr', 'a51a018714521339d44034af8666f6f821ef6663');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
