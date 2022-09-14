-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 13 juil. 2022 à 19:54
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stampee`
--
CREATE DATABASE IF NOT EXISTS `stampee` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `stampee`;

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `utilisateur` (
  `uti_id` int(6) UNSIGNED NOT NULL,
  `uti_nom` varchar(25) NOT NULL,
  `uti_courriel` varchar(75) NOT NULL,
  `uti_mdp` varchar(100) NOT NULL,
  `uti_age` int(3) NOT NULL,
  `uti_pays` varchar(25) NOT NULL,
  `uti_role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `utilisateur` (`uti_id`, `uti_nom`, `uti_courriel`, `uti_mdp`, `uti_age`, `uti_pays`, `uti_role`) VALUES
(1, 'Mahdi', 'mehdinip@gmail.com', '12345', 32, 'Canada', 'admin'),
(2, 'John', 'john@gmail.com', '12345', 45, 'USA', 'user'),
(3, 'Eddy', 'eddy@gmail.com', '12345', 60, 'Canada', 'user'),
(4, 'Kim Fu', 'kimfu@gmail.com', '12345', 30, 'Japon', 'user');

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

CREATE TABLE `enchere` (
  `enc_id` tinyint(4) NOT NULL,
  `enc_dateDebut` DATE NOT NULL,
  `enc_dateFin` DATE NOT NULL,
  `enc_prixDepart` DECIMAL(10,2) NOT NULL,
  `enc_prixActuel` DECIMAL(10,2) NOT NULL,
  `enc_nbMises` int(6) NOT NULL DEFAULT '0',
  `enc_uti_id_ce` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`enc_id`, `enc_dateDebut`, `enc_dateFin`, `enc_prixDepart`, `enc_prixActuel`, `enc_nbMises`, `enc_uti_id_ce`) VALUES
(1, '2022-09-09', '2022-12-12', 100.00, 100.00, 0, 2),
(2, '2022-08-14', '2022-11-12', 250.00, 300.00, 0, 2),
(3, '2022-10-14', '2022-12-24', 150.00, 160.00, 0, 3),
(4, '2022-09-11', '2022-09-25', 175.00, 190.00, 0, 4);


-- --------------------------------------------------------

--
-- Structure de la table `timbre`
--

CREATE TABLE `timbre` (
  `tim_id` smallint(6) NOT NULL UNIQUE,
  `tim_nom` varchar(100) NOT NULL,
  `tim_couleur` varchar(20) NOT NULL,
  `tim_ville` varchar(30) NOT NULL,
  `tim_pays` varchar(30) NOT NULL,
  `tim_dateCreation` DATE NOT NULL,
  `tim_description` TEXT NOT NULL,
  `tim_dimensions` varchar(30) NOT NULL,
  `tim_condition` varchar(25) NOT NULL,
  `tim_certification` boolean NOT NULL,
  `tim_enc_id_ce` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `timbre`
--

INSERT INTO `timbre` (`tim_id`, `tim_nom`,  `tim_couleur`, `tim_ville`, `tim_pays`, `tim_dateCreation`, `tim_description`, `tim_dimensions`, `tim_condition`, `tim_certification`, `tim_enc_id_ce`) VALUES
(1, 'Queen Elizabeth', 'gris', 'Manchester', 'Angleterre', '1954-04-15', 'Ce timbre anglais représente une photo du profil de la reine Elizabeth en toute sa majesté', '2.5 x 3.5 cm', 'neuf', 0, 1),
(2, 'Prairies du Canada', 'rouge, vert et blanc', 'Ottawa', 'Canada', '1990-03-24', "Les prairies du Canada étaient et demeurent l'une des choses dont les canadiens sont fiers", '2.8 x 3.8 cm', 'occasion', 1, 2),
(3, 'Elvis', 'rose, blanc et jaune', 'Los Angeles', 'USA', '1993-06-06', "Le Rock and Roll aux Etats-Unis fait partie des sigles du pays...", '1.9 x 2.4 cm', 'neuf', 1, 3),
(4, 'Ibn Sina', 'Beige et bleu', 'Alger', 'Algérie', '1983-05-21', 'Un chercheur ès sciences et en médecine', '2.1 x 3.1 cm', 'neuf', 0, 4);


-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `img_id` int(6) UNSIGNED NOT NULL,
  `img_principale` varchar(255) NOT NULL,
  `img_enc_id_ce`  tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`img_id`, `img_principale`, `img_enc_id_ce`) VALUES
(1, 'image1', 1),
(2, 'image2', 2),
(3, 'image3', 3),
(4, 'image4', 4);

-- --------------------------------------------------------

--
-- Structure de la table `vin`
--


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`uti_id`),
  ADD UNIQUE KEY `uti_nom` (`uti_nom`),
  ADD UNIQUE KEY `uti_courriel` (`uti_courriel`);

--
-- Index pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD PRIMARY KEY (`enc_id`);

--
-- Index pour la table `timbre`
--
ALTER TABLE `timbre`
  ADD PRIMARY KEY (`tim_id`),
  ADD UNIQUE KEY `tim_nom` (`tim_nom`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`img_id`),
  ADD UNIQUE KEY `img_principale` (`img_principale`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `uti_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `enchere`
--
ALTER TABLE `enchere`
  MODIFY `enc_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `timbre`
--
ALTER TABLE `timbre`
  MODIFY `tim_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `img_id` tinyint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `plat`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `enchere_ibfk_1` FOREIGN KEY (`enc_uti_id_ce`) REFERENCES `utilisateur` (`uti_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vin`
--
ALTER TABLE `timbre`
  ADD CONSTRAINT `timbre_ibfk_1` FOREIGN KEY (`tim_enc_id_ce`) REFERENCES `enchere` (`enc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`img_enc_id_ce`) REFERENCES `enchere` (`enc_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

-- --------------------------------------------------------
