-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 02 juin 2023 à 15:17
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `linkedin`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

DROP TABLE IF EXISTS `amis`;
CREATE TABLE IF NOT EXISTS `amis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_u1` int DEFAULT NULL,
  `id_u2` int DEFAULT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_u1` (`id_u1`),
  KEY `id_u2` (`id_u2`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demande_amis`
--

DROP TABLE IF EXISTS `demande_amis`;
CREATE TABLE IF NOT EXISTS `demande_amis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_auteur` int DEFAULT NULL,
  `id_destinataire` int DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_demande` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_auteur` (`id_auteur`),
  KEY `id_destinataire` (`id_destinataire`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande_amis`
--

INSERT INTO `demande_amis` (`id`, `id_auteur`, `id_destinataire`, `status`, `date_demande`) VALUES
(7, 1, 3, 'en_attente', '2023-06-02 12:37:24');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_destinataire` int NOT NULL,
  `id_auteur` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offres_emploi`
--

DROP TABLE IF EXISTS `offres_emploi`;
CREATE TABLE IF NOT EXISTS `offres_emploi` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `descriptions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `utilisateur_id` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offre_emploi`
--

DROP TABLE IF EXISTS `offre_emploi`;
CREATE TABLE IF NOT EXISTS `offre_emploi` (
  `Offre_id` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Types` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Salaire` int DEFAULT NULL,
  `Entreprise` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Durée` int DEFAULT NULL,
  PRIMARY KEY (`Offre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `offre_emploi`
--

INSERT INTO `offre_emploi` (`Offre_id`, `Nom`, `Types`, `Salaire`, `Entreprise`, `Durée`) VALUES
(1, 'Stage Macdo', 'CDD', 0, 'Macdonald', 25),
(2, 'Stage ingénieur Systèmes futuristes', 'CDD', 500, 'Souk', 250),
(3, '', '', 0, '', 0),
(4, '', '', 0, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prenom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Formation` varchar(100) DEFAULT NULL,
  `Projets` varchar(100) DEFAULT NULL,
  `Recherche` tinyint(1) DEFAULT NULL,
  `CV` blob,
  `Photo` blob,
  `Bio` varchar(100) DEFAULT NULL,
  `Role` varchar(100) DEFAULT NULL,
  `Compétences` varchar(100) DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `Tel` int DEFAULT NULL,
  `stages` varchar(100) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID`, `nom`, `prenom`, `email`, `Formation`, `Projets`, `Recherche`, `CV`, `Photo`, `Bio`, `Role`, `Compétences`, `DateNaissance`, `Tel`, `stages`, `password`) VALUES
(1, 'Jouvenot-Diehl', 'Antoine', 'antoine.jouvenotdiehl@edu.ece.fr', 'Lycée Claude Monet Paris 13eme \r\nECE Paris 2eme année', 'projet Mbappé', NULL, NULL, '', 'Je suis blond', 'étudiant', 'coder en python', '2003-05-07', 782999328, 'Valéo\r\nOrtec', '123'),
(3, 'Mazerat', 'Hugo', 'hugo.mazerat@edu.ece.fr\r\n', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hugo'),
(4, 'Souquieres', 'Gabriel', 'gabriel.souquieres@edu.ece.fr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gabriel'),
(20, 'Jezequel', 'Yann', 'yann.jezequel@edu.ece.fr', NULL, 'vusebnvl', NULL, NULL, 0x36373238363035353634313463353434303462386431303461333463666235302e706e67, 'slb vs', NULL, NULL, '2023-06-02', 2147483647, 'test', 'yann');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
