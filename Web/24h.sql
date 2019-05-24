-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  ven. 24 mai 2019 à 18:59
-- Version du serveur :  5.7.24-log
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `24h`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `id_type_cafe` int(11) NOT NULL,
  `id_pays` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `id_exportateur` int(11) NOT NULL,
  `id_importateur` int(11) NOT NULL,
  `date` date NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `id_type_cafe`, `id_pays`, `quantite`, `id_exportateur`, `id_importateur`, `date`, `etat`) VALUES
(1, 1, 2, 15, 15, 13, '2019-05-24', 2),
(2, 1, 2, 23, 15, 13, '2019-05-24', 1),
(3, 1, 2, 10, 15, 13, '2019-05-24', 1);

-- --------------------------------------------------------

--
-- Structure de la table `etats_commandes`
--

CREATE TABLE `etats_commandes` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etats_commandes`
--

INSERT INTO `etats_commandes` (`id`, `nom`) VALUES
(1, 'En cours'),
(2, 'En préparation'),
(3, 'En attente d\'expédition'),
(4, 'Expédié'),
(5, 'Livré');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `drapeau` text NOT NULL,
  `capitale` varchar(255) NOT NULL,
  `nb_habitants` int(11) NOT NULL,
  `surface` int(11) NOT NULL,
  `production_arabica` int(11) NOT NULL,
  `production_robusta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id`, `nom`, `description`, `drapeau`, `capitale`, `nb_habitants`, `surface`, `production_arabica`, `production_robusta`) VALUES
(1, 'France', 'Ceci est la France', 'ert', 'Paris', 66000000, 200000, 8, 14),
(2, 'Ouganda', 'jzerhfguherghergerghernhgerhgheroijguhrefiug', 'gehiguehrigu', 'Jesaispas', 5000, 35000, 15, 20);

-- --------------------------------------------------------

--
-- Structure de la table `type_cafe`
--

CREATE TABLE `type_cafe` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_cafe`
--

INSERT INTO `type_cafe` (`id`, `nom`) VALUES
(1, 'Arabica'),
(2, 'Robusta');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(13, 'Guerino', 'cacdf923dc05147e9c30923284769e88', 'importateur'),
(15, 'Zebra', '69c459dd76c6198f72f0c20ddd3c9447', 'exportateur'),
(16, 'lalpaga', 'ce6066244277ca0723488290bde57eda', 'exportateur'),
(17, 'import', '93473a7344419b15c4219cc2b6c64c6f', 'importateur'),
(18, 'import', '93473a7344419b15c4219cc2b6c64c6f', 'importateur');

-- --------------------------------------------------------

--
-- Structure de la table `user_meta`
--

CREATE TABLE `user_meta` (
  `meta_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_meta`
--

INSERT INTO `user_meta` (`meta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(27, 13, 'entreprise', 'Singularity'),
(28, 13, 'adresse', '64 Rue Général Moulin'),
(29, 13, 'code_postal', '14000'),
(30, 13, 'ville', 'Caen'),
(31, 13, 'pays', 'France'),
(32, 13, 'telephone', '0682016749'),
(39, 15, 'entreprise', 'Zebra Corp'),
(40, 15, 'adresse', 'Abbaye'),
(41, 15, 'code_postal', '14000'),
(42, 15, 'ville', 'Caen'),
(43, 15, 'pays', 'France'),
(44, 15, 'telephone', '0606060606'),
(45, 16, 'entreprise', 'Lalpaga Corp'),
(46, 16, 'adresse', 'Deauville'),
(47, 16, 'code_postal', '14000'),
(48, 16, 'ville', 'Deauville'),
(49, 16, 'pays', 'France'),
(50, 16, 'telephone', '0707070707'),
(51, 17, 'entreprise', 'Import Corp'),
(52, 17, 'adresse', 'Import adresse'),
(53, 17, 'code_postal', '14000'),
(54, 17, 'ville', 'Caen'),
(55, 17, 'pays', 'France'),
(56, 17, 'telephone', '202020202');

-- --------------------------------------------------------

--
-- Structure de la table `varietes`
--

CREATE TABLE `varietes` (
  `id` int(11) NOT NULL,
  `id_type_cafe` int(11) NOT NULL,
  `id_pays` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_exportateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `varietes`
--

INSERT INTO `varietes` (`id`, `id_type_cafe`, `id_pays`, `stock`, `id_exportateur`) VALUES
(1, 1, 2, 77, 15),
(2, 1, 2, 50, 16);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etats_commandes`
--
ALTER TABLE `etats_commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_cafe`
--
ALTER TABLE `type_cafe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`meta_id`);

--
-- Index pour la table `varietes`
--
ALTER TABLE `varietes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `etats_commandes`
--
ALTER TABLE `etats_commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_cafe`
--
ALTER TABLE `type_cafe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `meta_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `varietes`
--
ALTER TABLE `varietes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
