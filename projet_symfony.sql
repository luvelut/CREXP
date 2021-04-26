-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : lun. 26 avr. 2021 à 11:49
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210408140819', '2021-04-08 14:08:55', 708);

-- --------------------------------------------------------

--
-- Structure de la table `exercise`
--

DROP TABLE IF EXISTS `exercise`;
CREATE TABLE IF NOT EXISTS `exercise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `state` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` date NOT NULL,
  `response` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AEDAD51CCB944F1A` (`student_id`),
  KEY `IDX_AEDAD51C23EDC87` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exercise`
--

INSERT INTO `exercise` (`id`, `student_id`, `subject_id`, `state`, `published_at`, `response`) VALUES
(92, 104, 42, 'OK-ELEVE', '2021-04-15', '2 2 2'),
(93, 103, 44, 'OK-PROF', '2021-04-15', '3 3 3'),
(95, 106, 42, 'OK-ELEVE', '2021-04-15', '3 3 3'),
(96, 106, 44, 'ATTENTE', '2021-04-15', '3 3 3'),
(98, 108, 42, 'OK-PROF', '2021-04-15', '3 3 3'),
(99, 108, 44, 'OK-ELEVE', '2021-04-15', '3 3 3'),
(101, 110, 42, 'OK-ELEVE', '2021-04-15', '3 3 3'),
(103, 110, 44, 'OK-ELEVE', '2021-04-15', '3 3 3'),
(104, 112, 42, 'OK-ELEVE', '2021-04-15', '3 3 3'),
(105, 112, 44, 'ATTENTE', '2021-04-15', '3 3 3'),
(106, 103, 48, 'OK-ELEVE', '2021-04-16', '11'),
(107, 105, 48, 'ATTENTE', '2021-04-16', ''),
(108, 107, 48, 'ATTENTE', '2021-04-16', ''),
(109, 109, 48, 'ATTENTE', '2021-04-16', ''),
(110, 111, 48, 'ATTENTE', '2021-04-16', ''),
(128, 103, 54, 'ATTENTE', '2021-04-23', ''),
(129, 105, 54, 'ATTENTE', '2021-04-23', ''),
(130, 107, 54, 'ATTENTE', '2021-04-23', ''),
(131, 109, 54, 'ATTENTE', '2021-04-23', ''),
(132, 111, 54, 'ATTENTE', '2021-04-23', ''),
(138, 103, 56, 'OK-PROF', '2021-04-26', '2 2'),
(139, 105, 56, 'ATTENTE', '2021-04-26', ''),
(140, 107, 56, 'ATTENTE', '2021-04-26', ''),
(141, 109, 56, 'ATTENTE', '2021-04-26', ''),
(142, 111, 56, 'ATTENTE', '2021-04-26', '');

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B723AF33296CD8AE` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id`, `team_id`, `name`) VALUES
(103, 41, 'Quentin Roche'),
(104, 42, 'Lucile Velut'),
(105, 41, 'Pierre Louis'),
(106, 42, 'Zoe Legrand'),
(107, 41, 'Jean Vand'),
(108, 42, 'Lucas Jour'),
(109, 41, 'Lise Heritier'),
(110, 42, 'Louise Menna'),
(111, 41, 'Chris Dupond'),
(112, 42, 'Jeanne Roydor'),
(114, 42, 'Benjamin Pinheiro');

-- --------------------------------------------------------

--
-- Structure de la table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `number_values` int(11) NOT NULL,
  `title` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_path` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FBCE3E7A296CD8AE` (`team_id`),
  KEY `IDX_FBCE3E7A41807E1D` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `subject`
--

INSERT INTO `subject` (`id`, `team_id`, `teacher_id`, `number_values`, `title`, `comment`, `document_path`, `published_at`) VALUES
(42, 42, 48, 2, 'TP d\'informatique\'', 'Ce tp est un tp pour l\'iut INFO', 'doc2.pdf', '2021-04-15'),
(44, 41, 47, 1, 'TP de mécanique n°2', 'Ce tp est un AUTRE tp pour l\'iut GIM', 'doc2.pdf', '2021-04-15'),
(46, 41, 47, 2, 'TP de test', 'consignes', '6079a991c6b45695704336.pdf', '2021-04-16'),
(47, 41, 47, 2, 'Tp test exercices', 'consignes', '6079b2687d351640446911.pdf', '2021-04-16'),
(48, 41, 47, 2, 'Tp test 2', 'consignes', '6079b33b564b5404469551.pdf', '2021-04-16'),
(54, 41, 47, 2, 'Tp test', 'Séparer les valeurs par un espace', '6082d6b76e20c451592807.pdf', '2021-04-23'),
(56, 41, 47, 2, 'Tp de mécanique n°1', 'consignes', '608682a768d94919415292.pdf', '2021-04-26');

-- --------------------------------------------------------

--
-- Structure de la table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `teacher`
--

INSERT INTO `teacher` (`id`, `name`) VALUES
(47, 'Christophe Velut'),
(48, 'Pascale Brigoulet');

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C4E0A61F41807E1D` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `team`
--

INSERT INTO `team` (`id`, `teacher_id`, `name`) VALUES
(41, 47, 'IUT GIM'),
(42, 48, 'IUT INFO'),
(57, 47, 'Licence');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64941807E1D` (`teacher_id`),
  UNIQUE KEY `UNIQ_8D93D649CB944F1A` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `teacher_id`, `student_id`, `login`, `password`) VALUES
(95, 47, NULL, 'cvelut', '$2y$12$eUaORZJ/K6sNcKGUWrmsje9d2T1YCy2dzXDTpqrXvb2uSl33x2sUC'),
(96, 48, NULL, 'pbrigoulet', '$2y$12$2WmKoCp6rxYjmgOEsWD91.mRKiyh1Rp6cbUekz1HXXTVOrd176zjW'),
(97, NULL, 103, 'qroche', '$2y$12$2WmKoCp6rxYjmgOEsWD91.mRKiyh1Rp6cbUekz1HXXTVOrd176zjW'),
(98, NULL, 104, 'lvelut', '$2y$12$2WmKoCp6rxYjmgOEsWD91.mRKiyh1Rp6cbUekz1HXXTVOrd176zjW'),
(99, NULL, 105, 'plouis', '$2y$12$2WmKoCp6rxYjmgOEsWD91.mRKiyh1Rp6cbUekz1HXXTVOrd176zjW'),
(100, NULL, 106, 'zlegrand', '$2y$12$2WmKoCp6rxYjmgOEsWD91.mRKiyh1Rp6cbUekz1HXXTVOrd176zjW'),
(101, NULL, 107, 'jvand', '$2y$12$2WmKoCp6rxYjmgOEsWD91.mRKiyh1Rp6cbUekz1HXXTVOrd176zjW'),
(102, NULL, 108, 'ljour', '$2y$12$2WmKoCp6rxYjmgOEsWD91.mRKiyh1Rp6cbUekz1HXXTVOrd176zjW'),
(103, NULL, 109, 'lheritier', '$2y$12$2WmKoCp6rxYjmgOEsWD91.mRKiyh1Rp6cbUekz1HXXTVOrd176zjW'),
(104, NULL, 110, 'lmenna', '$2y$12$2WmKoCp6rxYjmgOEsWD91.mRKiyh1Rp6cbUekz1HXXTVOrd176zjW'),
(105, NULL, 111, 'cdupond', '$2y$12$2WmKoCp6rxYjmgOEsWD91.mRKiyh1Rp6cbUekz1HXXTVOrd176zjW'),
(106, NULL, 112, 'jroydor', '$2y$12$2WmKoCp6rxYjmgOEsWD91.mRKiyh1Rp6cbUekz1HXXTVOrd176zjW'),
(108, NULL, 114, 'bpinheiro', '$2y$12$2WmKoCp6rxYjmgOEsWD91.mRKiyh1Rp6cbUekz1HXXTVOrd176zjW');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `exercise`
--
ALTER TABLE `exercise`
  ADD CONSTRAINT `FK_AEDAD51C23EDC87` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `FK_AEDAD51CCB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_B723AF33296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`);

--
-- Contraintes pour la table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `FK_FBCE3E7A296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `FK_FBCE3E7A41807E1D` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`);

--
-- Contraintes pour la table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `FK_C4E0A61F41807E1D` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D64941807E1D` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`),
  ADD CONSTRAINT `FK_8D93D649CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
