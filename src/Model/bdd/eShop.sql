-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 16 mars 2023 à 17:56
-- Version du serveur : 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eShop`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `categorie`) VALUES
(1, 'legumes');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires-notes`
--

CREATE TABLE `commentaires-notes` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `texte` varchar(500) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `type_client` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite_produit` float NOT NULL,
  `prix_unitaire_produit` float NOT NULL,
  `date` int(11) NOT NULL,
  `paye` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `producteurs`
--

CREATE TABLE `producteurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `cat` int(11) NOT NULL,
  `sous_cat` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `origine` varchar(255) NOT NULL,
  `poids` float NOT NULL,
  `id_producteur` int(11) DEFAULT NULL,
  `prix_kg` float DEFAULT NULL,
  `prix_unit` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `cat`, `sous_cat`, `description`, `image`, `origine`, `poids`, `id_producteur`, `prix_kg`, `prix_unit`) VALUES
(1, 'test', 1, 1, 'test', NULL, 'test', 10, NULL, NULL, NULL),
(2, 'test2', 1, 1, 'test2', NULL, 'test2', 30, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_commentaire` int(11) NOT NULL,
  `texte` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sousCategories`
--

CREATE TABLE `sousCategories` (
  `id` int(11) NOT NULL,
  `sous_categorie` varchar(255) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sousCategories`
--

INSERT INTO `sousCategories` (`id`, `sous_categorie`, `id_categorie`) VALUES
(1, 'legumes_verts', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `raison_sociale` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` int(11) DEFAULT NULL,
  `verifie` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `type`, `prenom`, `nom`, `raison_sociale`, `email`, `adresse`, `code_postal`, `ville`, `password`, `avatar`, `verifie`) VALUES
(9, 0, 'alexandre', 'aloesode', '', 'alexandre.aloesode@laplateforme.io', '', 0, '', '$2y$10$uv4xVFKVdrkQdiKJG7DNJO0.AqMnHgEhvginloYjFs8N9Mh58mTSG', 0, ''),
(17, 0, 'a', 'a', '', 'a', '', 0, '', '$2y$10$QM5/nFoYuZr9.X.PDzaFS.T2lqJbyuIYpsZ86xwwpHMc7uGGajCrW', 0, ''),
(19, 0, 'c', 'c', '', 'c', '', 0, '', '$2y$10$PaRezxo2DYTDCuJ2h1BbCuun7blVeUVftpqKyK7wfKQjH.Ew7JH5G', 0, ''),
(20, 0, 'e', 'e', '', 'e', '', 0, '', '$2y$10$tGHNKgXV9ojxKmtZII5qWe1KkOVhXjpSc/iO2IOKhuRSvxIob48dK', 0, ''),
(21, 1, 'b', 'b', NULL, 'b', 'test', 13000, 'Marseille', '$2y$10$k7dwaUr0vQEbw0CkYFGlMOCt/Mvjgjxg3sKKwbT4DI9MJRPhwPli2', NULL, 'NON'),
(22, 1, 'v', 'v', NULL, 'v', 'test', 13000, 'Marseille', '$2y$10$QeqV8yAio/MkrV0N.W3c1O/HNzyAqe/GeMBe0RLI9eawSW9xLH/p6', NULL, 'NON'),
(23, 4, 'n', 'n', NULL, 'n', 'test', 13000, 'Marseille', '$2y$10$HSL1fwX.DqmgpoJ3UIpmM.8WqJBVH9qEEtWMc86BFp7sunXevSjUW', NULL, 'NON');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires-notes`
--
ALTER TABLE `commentaires-notes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `producteurs`
--
ALTER TABLE `producteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sousCategories`
--
ALTER TABLE `sousCategories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commentaires-notes`
--
ALTER TABLE `commentaires-notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `producteurs`
--
ALTER TABLE `producteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sousCategories`
--
ALTER TABLE `sousCategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
