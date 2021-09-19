-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 02 déc. 2020 à 16:09
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog4`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `id` bigint(20) NOT NULL,
  `rue` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `code_postal` int(5) NOT NULL,
  `ville` varchar(20) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `adresses`
--

INSERT INTO `adresses` (`id`, `rue`, `code_postal`, `ville`) VALUES
(1, '12 rue de la poste', 63400, 'Aigueperse'),
(2, '20 rue des roses', 63200, 'Cellule'),
(3, '454 chemin des lilas', 63000, 'Clermont Ferrand');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) NOT NULL,
  `titre` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `description` longtext COLLATE utf8mb4_bin NOT NULL,
  `id_auteur` bigint(20) NOT NULL,
  `date_publication` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `description`, `id_auteur`, `date_publication`) VALUES
(1, 'balise HEAD', 'On retrouve dans une balise HEAD, le titre et la description de la page.', 1, '0000-00-00 00:00:00'),
(2, 'Variable en PHP', 'Une variable en php se note $mavariable', 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `articles-categories`
--

CREATE TABLE `articles-categories` (
  `id_articles` bigint(20) NOT NULL,
  `id_categories` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `articles-categories`
--

INSERT INTO `articles-categories` (`id_articles`, `id_categories`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

CREATE TABLE `auteurs` (
  `id` bigint(20) NOT NULL,
  `nom` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `prenom` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `id_adresse` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`id`, `nom`, `prenom`, `mail`, `password`, `id_adresse`) VALUES
(1, 'durand', 'loic', 'dl@free.fr', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(2, 'dupont', 'fabien', 'df@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3),
(3, 'ferry', 'lucie', 'lf@free.fr', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 4),
(4, 'durand', 'moise', 'md@free.fr', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `nom` varchar(10) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'html'),
(2, 'css'),
(3, 'JS'),
(4, 'php'),
(5, 'sql');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `mavue`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `mavue` (
`nom` varchar(20)
,`prenom` varchar(20)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `mavue1`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `mavue1` (
`nom` varchar(20)
,`prenom` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure de la vue `mavue`
--
DROP TABLE IF EXISTS `mavue`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mavue`  AS SELECT `auteurs`.`nom` AS `nom`, `auteurs`.`prenom` AS `prenom` FROM `auteurs` ;

-- --------------------------------------------------------

--
-- Structure de la vue `mavue1`
--
DROP TABLE IF EXISTS `mavue1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mavue1`  AS SELECT `auteurs`.`nom` AS `nom`, `auteurs`.`prenom` AS `prenom` FROM `auteurs` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_auteur` (`id_auteur`);

--
-- Index pour la table `articles-categories`
--
ALTER TABLE `articles-categories`
  ADD PRIMARY KEY (`id_articles`,`id_categories`);

--
-- Index pour la table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_adresse` (`id_adresse`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
