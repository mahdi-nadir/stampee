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
-- Structure de la table `image`
--

/* CREATE TABLE `privilege` (
  `rol_nom` varchar(8) NOT NULL PRIMARY KEY DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; */
-- --------------------------------------------------------
--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `rol_id` int(6) PRIMARY KEY AUTO_INCREMENT,
  `rol_statut` VARCHAR(30) NOT NULL
);

INSERT INTO `role` (`rol_id`, `rol_statut`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'visitor');

-- --------------------------------------------------------
--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `uti_id` int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `uti_nom` varchar(25) NOT NULL,
  `uti_courriel` varchar(100) UNIQUE NOT NULL,
  `uti_mdp` varchar(300) NOT NULL,
  `uti_pays` varchar(25),
  `uti_rol_id_ce` int(6) NOT NULL DEFAULT '2',
  FOREIGN KEY (`uti_rol_id_ce`) REFERENCES `role` (`rol_id`)
) ;

-- --------------------------------------------------------
--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `msg_id` int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `msg_sujet` varchar(100) NOT NULL,
  `msg_contneu` TEXT(1500) NOT NULL,
  `msg_uti_id_ce` int(6) NOT NULL,
  FOREIGN KEY (`msg_uti_id_ce`) REFERENCES `utilisateur` (`uti_id`)
) ;

-- --------------------------------------------------------
--
-- Structure de la table `enchere`
--

CREATE TABLE `enchere` (
  `enc_id` int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `enc_dateDebut` DATE NOT NULL,
  `enc_dateFin` DATE NOT NULL,
  `enc_prixDepart` int(10) NOT NULL,
  `enc_prixActuel` int(10) NOT NULL,
  `enc_uti_id_ce` int(6) NOT NULL,
  FOREIGN KEY (`enc_uti_id_ce`) REFERENCES `utilisateur`(`uti_id`)
) ;

-- --------------------------------------------------------

--
-- Structure de la table `mise`
--

CREATE TABLE `mise` (
  `mis_id` tinyint(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `mis_montant` int(10) NOT NULL,
  `mis_date` TIMESTAMP NOT NULL,
  `mis_enc_id_ce` int(6) NOT NULL,
  FOREIGN KEY (`mis_enc_id_ce`) REFERENCES `enchere`(`enc_id`),
  `mis_uti_id_ce` int(6) NOT NULL,
  FOREIGN KEY (`mis_uti_id_ce`) REFERENCES `utilisateur`(`uti_id`)
) ;

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `fav_id` tinyint(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fav_enc_id_ce` int(6) NOT NULL,
  FOREIGN KEY (`fav_enc_id_ce`) REFERENCES `enchere`(`enc_id`),
  `fav_uti_id_ce` int(6) NOT NULL,
  FOREIGN KEY (`fav_uti_id_ce`) REFERENCES `utilisateur`(`uti_id`)
) ;
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
  `tim_dateCreation` YEAR NOT NULL,
  `tim_description` TEXT NOT NULL,
  `tim_dimensions` varchar(30) NOT NULL,
  `tim_condition` varchar(25) NOT NULL,
  `tim_certification` boolean NOT NULL,
  `tim_enc_id_ce` int(6) NOT NULL,
  FOREIGN KEY (`tim_enc_id_ce`) REFERENCES `enchere`(`enc_id`)
) ;

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




