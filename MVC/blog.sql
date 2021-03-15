-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 04 fév. 2021 à 19:03
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `ID` bigint(20) NOT NULL,
  `Rue` varchar(35) NOT NULL,
  `Code Postal` int(6) NOT NULL,
  `Ville` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `adresses`
--

INSERT INTO `adresses` (`ID`, `Rue`, `Code Postal`, `Ville`) VALUES
(1, '20 rue du charolais', 63000, 'Clermont-Ferrand'),
(2, '5 allée des jardins d\'Issoire', 63500, 'Issoire');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `ID` bigint(10) NOT NULL,
  `Titre` varchar(30) NOT NULL,
  `Description` varchar(5000) NOT NULL,
  `ID_Auteur` bigint(10) NOT NULL,
  `Date_Publication` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`ID`, `Titre`, `Description`, `ID_Auteur`, `Date_Publication`) VALUES
(7, 'Article de ouf', 'DESCRITPION article 1', 1, '2021-02-04 18:01:08'),
(8, 'Article 2 plus ouf', 'Description de l\'article 2 de ouf', 1, '2021-02-04 18:02:08'),
(9, 'Article numbeur tree', 'Coucou la description de l\'article 3', 2, '2021-02-04 18:02:44');

-- --------------------------------------------------------

--
-- Structure de la table `articles_catégories`
--

CREATE TABLE `articles_catégories` (
  `ID_Articles` bigint(10) NOT NULL,
  `ID_Catégories` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles_catégories`
--

INSERT INTO `articles_catégories` (`ID_Articles`, `ID_Catégories`) VALUES
(1, 1),
(1, 2),
(2, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

CREATE TABLE `auteurs` (
  `ID` bigint(10) NOT NULL,
  `Pseudo` varchar(25) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prénom` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ID_Adresse` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`ID`, `Pseudo`, `Nom`, `Prénom`, `Email`, `Password`, `ID_Adresse`) VALUES
(1, 'Sinsay', 'Houdier', 'Yanis', 'yanis.houdier@gmail.com', '00d70c561892a94980befd12a400e26aeb4b8599', 1),
(2, 'sansheep', 'Larnaudie', 'Maxime', 'maxime.larnaudie@gmail.com', '00d70c561892a94980befd12a400e26aeb4b8599', 2);

-- --------------------------------------------------------

--
-- Structure de la table `catégories`
--

CREATE TABLE `catégories` (
  `ID` bigint(20) NOT NULL,
  `Nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `catégories`
--

INSERT INTO `catégories` (`ID`, `Nom`) VALUES
(1, 'HTML'),
(2, 'CSS'),
(3, 'JS'),
(4, 'PHP'),
(5, 'SQL');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `articles_catégories`
--
ALTER TABLE `articles_catégories`
  ADD PRIMARY KEY (`ID_Articles`,`ID_Catégories`);

--
-- Index pour la table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID_Adresse`);

--
-- Index pour la table `catégories`
--
ALTER TABLE `catégories`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `ID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `ID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `catégories`
--
ALTER TABLE `catégories`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
