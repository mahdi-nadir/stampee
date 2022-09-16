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
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `uti_id` int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `uti_nom` varchar(25) NOT NULL,
  `uti_courriel` varchar(75) UNIQUE NOT NULL,
  `uti_mdp` varchar(100) NOT NULL,
  `uti_pays` varchar(25),
  `uti_role` varchar(25) DEFAULT 'user'
) ;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`uti_id`, `uti_nom`, `uti_courriel`, `uti_mdp`, `uti_pays`, `uti_role`) VALUES
(1, 'Mahdi', 'mehdinip@gmail.com', '12345', 'Canada', 'admin'),
(2, 'John', 'john@gmail.com', '12345', 'USA', DEFAULT),
(3, 'Eddy', 'eddy@gmail.com', '12345', 'Canada', DEFAULT),
(4, 'Kim Fu', 'kimfu@gmail.com', '12345', 'Japon', DEFAULT);

-- --------------------------------------------------------
--
-- Structure de la table `enchere`
--

CREATE TABLE `enchere` (
  `enc_id` int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `enc_dateDebut` DATE NOT NULL,
  `enc_dateFin` DATE NOT NULL,
  `enc_prixDepart` DECIMAL(10,2) NOT NULL,
  `enc_prixActuel` DECIMAL(10,2) NOT NULL,
  `enc_uti_id_ce` int(6) NOT NULL,
  FOREIGN KEY (`enc_uti_id_ce`) REFERENCES `utilisateur`(`uti_id`)
) ;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`enc_id`, `enc_dateDebut`, `enc_dateFin`, `enc_prixDepart`, `enc_prixActuel`, `enc_uti_id_ce`) VALUES
(1, '2022-09-09', '2022-12-12', 100.00, 100.00, 2),
(2, '2022-08-14', '2022-11-12', 250.00, 300.00, 2),
(3, '2022-10-14', '2022-12-24', 150.00, 160.00, 3),
(4, '2022-09-11', '2022-09-25', 175.00, 190.00, 4);
-- --------------------------------------------------------

--
-- Structure de la table `mise`
--

CREATE TABLE `mise` (
  `mis_id` tinyint(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `mis_enc_id_ce` int(6) NOT NULL,
  FOREIGN KEY (`mis_enc_id_ce`) REFERENCES `enchere`(`enc_id`),
  `mis_uti_id_ce` int(6) NOT NULL,
  FOREIGN KEY (`mis_uti_id_ce`) REFERENCES `utilisateur`(`uti_id`)
) ;

--
-- Déchargement des données de la table `mise`
--

INSERT INTO `mise` (`mis_id`, `mis_enc_id_ce`, `mis_uti_id_ce`) VALUES
(1, 4, 2),
(2, 3, 3),
(3, 2, 1),
(4, 1, 4);


-- --------------------------------------------------------
--
-- Structure de la table `timbre`
--

CREATE TABLE `timbre` (
  `tim_id` int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `tim_nom` varchar(100) NOT NULL UNIQUE,
  `tim_couleur` varchar(20) NOT NULL,
  `tim_ville` varchar(30) NOT NULL,
  `tim_pays` varchar(30) NOT NULL,
  `tim_dateCreation` DATE NOT NULL,
  `tim_description` TEXT NOT NULL,
  `tim_dimensions` varchar(30) NOT NULL,
  `tim_condition` varchar(25) NOT NULL,
  `tim_certification` boolean NOT NULL,
  `tim_enc_id_ce` int(6) NOT NULL,
  FOREIGN KEY (`tim_enc_id_ce`) REFERENCES `enchere`(`enc_id`)
)  ;

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
  `img_id` int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `img_path` varchar(100) NOT NULL,
  `img_tim_id_ce` int(6) NOT NULL,
  FOREIGN KEY (`img_tim_id_ce`) REFERENCES `timbre`(`tim_id`)
) ;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`img_id`, `img_path`, `img_tim_id_ce`) VALUES
(1, 'a', 1),
(2, 'b', 2),
(3, 'c', 3),
(4, 'd', 4);

