-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 04 juin 2023 à 11:08
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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `amis`
--

INSERT INTO `amis` (`id`, `id_u1`, `id_u2`, `date_creation`) VALUES
(13, 3, 4, '2023-06-04 09:30:25'),
(12, 3, 1, '2023-06-04 09:30:21');

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande_amis`
--

INSERT INTO `demande_amis` (`id`, `id_auteur`, `id_destinataire`, `status`, `date_demande`) VALUES
(14, 3, 4, 'accepté', '2023-06-04 09:30:16'),
(13, 3, 1, 'accepté', '2023-06-04 09:30:14');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_user` (`post_id`,`user_id`),
  KEY `fk_likes_users` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(1, 6, 1),
(2, 6, 3),
(3, 10, 1),
(4, 10, 4),
(5, 35, 3);

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
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `author_name` varchar(255) NOT NULL,
  `author_lastname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `post_id`, `content`, `created_at`, `author_name`, `author_lastname`) VALUES
(1, 3, 35, 'test 14', '2023-06-04 10:54:36', 'Mazerat', 'Hugo'),
(2, 4, 35, 'test 14', '2023-06-04 10:54:36', 'Souquieres', 'Gabriel'),
(3, 20, 35, 'test 14', '2023-06-04 10:54:36', 'Jezequel', 'Yann'),
(4, 1, 36, 'test 15', '2023-06-04 11:01:32', 'Jouvenot-Diehl', 'Antoine'),
(5, 4, 36, 'test 15', '2023-06-04 11:01:32', 'Souquieres', 'Gabriel'),
(6, 20, 36, 'test 15', '2023-06-04 11:01:32', 'Jezequel', 'Yann'),
(7, 3, 37, 'test 16', '2023-06-04 11:03:53', 'Mazerat', 'Hugo'),
(8, 4, 37, 'test 16', '2023-06-04 11:03:53', 'Souquieres', 'Gabriel'),
(9, 20, 37, 'test 16', '2023-06-04 11:03:53', 'Jezequel', 'Yann'),
(10, 1, 38, 'test 16', '2023-06-04 11:05:30', 'Jouvenot-Diehl', 'Antoine'),
(11, 4, 38, 'test 16', '2023-06-04 11:05:30', 'Souquieres', 'Gabriel'),
(12, 20, 38, 'test 16', '2023-06-04 11:05:30', 'Jezequel', 'Yann');

-- --------------------------------------------------------

--
-- Structure de la table `offres_emploi`
--

DROP TABLE IF EXISTS `offres_emploi`;
CREATE TABLE IF NOT EXISTS `offres_emploi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `descriptions` text NOT NULL,
  `createur_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createur_id` (`createur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `offres_emploi`
--

INSERT INTO `offres_emploi` (`id`, `titre`, `descriptions`, `createur_id`) VALUES
(1, 'Macdo', 'dhbdfb', 4),
(2, 'Subway', 'coockies', 1);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content` text,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `photo`, `created_at`) VALUES
(36, 3, 'test 15', 'uploads/', '2023-06-04 11:01:32'),
(35, 1, 'test 14', 'uploads/', '2023-06-04 10:54:36'),
(34, 1, 'test 13', 'uploads/', '2023-06-04 10:51:40'),
(32, 1, 'test 11', 'uploads/', '2023-06-04 10:33:45'),
(33, 4, 'test 12', 'uploads/', '2023-06-04 10:39:43'),
(23, 1, 'test 1', 'uploads/', '2023-06-04 10:12:12'),
(24, 1, 'test2', 'uploads/', '2023-06-04 10:12:52'),
(25, 1, 'test 3', 'uploads/', '2023-06-04 10:13:24'),
(26, 1, 'test 4', 'uploads/', '2023-06-04 10:14:58'),
(27, 1, 'test 5', 'uploads/', '2023-06-04 10:15:13'),
(28, 1, 'test 6', 'uploads/', '2023-06-04 10:19:01'),
(29, 1, 'test 7', 'uploads/', '2023-06-04 10:23:29'),
(30, 1, 'test 8', 'uploads/', '2023-06-04 10:27:01'),
(31, 3, 'test 9', 'uploads/', '2023-06-04 10:27:37'),
(37, 1, 'test 16', 'uploads/', '2023-06-04 11:03:53'),
(38, 3, 'test 16', 'uploads/', '2023-06-04 11:05:30');

-- --------------------------------------------------------

--
-- Structure de la table `postulations`
--

DROP TABLE IF EXISTS `postulations`;
CREATE TABLE IF NOT EXISTS `postulations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `offre_id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `offre_id` (`offre_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `postulations`
--

INSERT INTO `postulations` (`id`, `offre_id`, `nom`, `prenom`, `email`) VALUES
(1, 1, 'Jouvenot', 'Antoine', 'antoine.jouvenotdiehl@edu.ece.fr'),
(2, 1, 'Jouvenot', 'Antoine', 'antoine.jouvenotdiehl@edu.ece.fr');

-- --------------------------------------------------------

--
-- Structure de la table `shares`
--

DROP TABLE IF EXISTS `shares`;
CREATE TABLE IF NOT EXISTS `shares` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_user` (`post_id`,`user_id`),
  KEY `fk_shares_users` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `shares`
--

INSERT INTO `shares` (`id`, `post_id`, `user_id`) VALUES
(5, 16, 3);

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
  `Photo` varchar(500) DEFAULT NULL,
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
(1, 'Jouvenot-Diehl', 'Antoine', 'antoine.jouvenotdiehl@edu.ece.fr', 'Lycée Claude Monet Paris 13eme \r\nECE Paris 2eme année', 'projet Mbappé', NULL, NULL, 'antoine.jpg\r\n', 'Je suis blond', 'étudiant', 'coder en python', '2003-05-07', 782999328, 'Valéo\r\nOrtec', '123'),
(3, 'Mazerat', 'Hugo', 'hugo.mazerat@edu.ece.fr\r\n', NULL, NULL, NULL, NULL, 'hugo.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'hugo'),
(4, 'Souquieres', 'Gabriel', 'gabriel.souquieres@edu.ece.fr', NULL, NULL, NULL, NULL, 'gabriel.jpg\r\n', NULL, NULL, NULL, NULL, NULL, NULL, 'gabriel'),
(20, 'Jezequel', 'Yann', 'yann.jezequel@edu.ece.fr', NULL, 'vusebnvl', NULL, NULL, 'yannn.jpg', 'slb vs', NULL, NULL, '2023-06-02', 2147483647, 'test', 'yann');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
