-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 29 sep. 2020 à 14:05
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `online_games`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Aventure'),
(2, 'Action'),
(3, 'Bac à sable'),
(4, 'Battle royale'),
(5, 'Construction'),
(6, 'Course'),
(7, 'Hack\'n\'slash'),
(8, 'Jeu de rôle'),
(9, 'Plates-formes'),
(10, 'RPG'),
(11, 'Sport');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id_id` int(11) DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5F9E962A4D77E7D8` (`game_id_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `game_id_id`, `author`, `comment`, `rate`, `create_at`) VALUES
(2, 1, 'pierre', 'oui oui !!!', 2.5, '2020-09-21 16:26:00'),
(28, 2, 'dany', 'oui super top', 4, '2020-09-22 11:32:24'),
(29, 3, 'dany', 'trop violent !!! mais toujours top', 2.5, '2020-09-22 16:32:28'),
(33, 6, 'dany', 'excellent tout simplement !!!', 5, '2020-09-23 15:21:50'),
(35, 3, 'dany', 'Oui je confirme', 5, '2020-09-24 09:16:17'),
(38, 16, 'dany', 'bof pas terrible !!!', 3, '2020-09-25 09:04:56'),
(40, 4, 'dany', 'excellent', 0, '2020-09-25 10:52:49'),
(41, 4, 'dany', 'Oui je confirme', 4.5, '2020-09-25 10:53:13'),
(42, 4, 'dany', 'oui c\'est vrai', 0, '2020-09-25 10:54:28'),
(44, 4, 'dany26', 'mais je préfère tintin', 3.5, '2020-09-25 11:09:38'),
(45, 4, 'dany', 'super', 2.5, '2020-09-25 11:11:30'),
(46, 4, 'd', 'd', 0.5, '2020-09-25 11:12:05'),
(49, 2, 'dany26', 'vraiment top', 5, '2020-09-28 12:04:50'),
(51, 2, 'dany26', 'excellent top !!!', 2, '2020-09-25 15:09:28'),
(52, 2, 'dany', 'oui c\'est vrai', 4, '2020-09-25 15:28:15');

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
('DoctrineMigrations\\Version20200918080214', '2020-09-18 11:06:07', 278),
('DoctrineMigrations\\Version20200918093614', '2020-09-18 11:36:38', 1585),
('DoctrineMigrations\\Version20200918114940', '2020-09-18 13:49:54', 2036),
('DoctrineMigrations\\Version20200918121729', '2020-09-18 14:19:41', 958),
('DoctrineMigrations\\Version20200918121936', '2020-09-18 14:19:42', 32),
('DoctrineMigrations\\Version20200921082756', '2020-09-21 10:28:39', 3103),
('DoctrineMigrations\\Version20200925084412', '2020-09-25 10:44:38', 3037);

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_at` int(11) NOT NULL,
  `plateformes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `copies_sold` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rank` int(11) NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `studio_id_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FF232B3181F17E9A` (`studio_id_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `games`
--

INSERT INTO `games` (`id`, `name`, `img`, `release_at`, `plateformes`, `copies_sold`, `rank`, `rate`, `studio_id_id`) VALUES
(1, 'Minecraft (franchise)', '1.jpg', 2009, 'Microsoft Windows, OS X, Linux, Xbox 360, Xbox One,PlayStation 4, PlayStation Vita, Android, iOS, Windows Phone, Kindle Fire, Nintendo Switch, Apple TV', '201 millions', 1, 5, 1),
(2, 'Tetris (franchise)', '2.jpg', 1984, 'Omniplateforme', '170 millions', 2, 5, 2),
(3, 'Grand Theft Auto V', '3.jpg', 2013, 'PlayStation 3, Xbox 360, PlayStation 4, Xbox One, Microsoft Windows', '135 millions', 3, 5, 3),
(4, 'Wii Sports', '4.jpg', 2006, 'Wii', '82,90 millions', 4, 5, 4),
(5, 'PlayerUnknown\'s Battlegrounds', '5.jpg', 2017, 'Microsoft Windows, Xbox One, PlayStation 4', '65 millions', 5, 5, 5),
(6, 'Super Mario Bros.', '6.jpg', 1985, 'Nintendo Entertainment System', '40,24 millions', 6, 5, 4),
(7, 'Mario Kart Wii', '7.jpg', 2008, 'Wii', '37,32 millions', 7, 5, 4),
(8, 'Mario Kart 8/Deluxe', '8.jpg', 2014, 'Wii U, Nintendo Switch', '35,19 millions', 8, 5, 4),
(9, 'Wii Sports Resort', '9.jpg', 2009, 'Wii', '33,13 millions', 9, 5, 4),
(10, 'Red Dead Redemption II', '10.jpg', 2018, 'PlayStation 4, Xbox One, Microsoft Windows', '32 millions', 10, 5, 5),
(11, 'Pokémon Rouge et Bleu', '11.jpg', 1996, 'Game Boy, Game Boy Color, Nintendo 3DS', '31,38 millions', 11, 5, 4),
(12, 'New Super Mario Bros.', '12.jpg', 2006, 'Nintendo DS', '30,80 millions', 12, 5, 4),
(13, 'New Super Mario Bros. Wii', '13.jpg', 2009, 'Wii', '30,30 millions', 13, 5, 4),
(14, 'Diablo III', '14.jpg', 2012, 'Microsoft Windows, OS X, Xbox 360, PlayStation 3, Xbox One, PlayStation 4, Nintendo Switch', '30 millions', 14, 4, 6),
(15, 'The Elder Scrolls V: Skyrim', '15.jpg', 2011, 'Microsoft Windows, PlayStation 3, Xbox 360, PlayStation 4, Xbox One, Nintendo Switch', '30 millions', 15, 4, 7),
(16, 'Terraria', '16.jpg', 2011, 'Microsoft Windows, OS X, Linux, Apple iOS, Android, Windows Phone, PlayStation 4, PlayStation 3, PlayStation Vita, Xbox One, Xbox 360, Wii U, Nintendo 3DS, Nintendo Switch', '30 millions', 16, 4, 8);

-- --------------------------------------------------------

--
-- Structure de la table `games_category`
--

DROP TABLE IF EXISTS `games_category`;
CREATE TABLE IF NOT EXISTS `games_category` (
  `games_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`games_id`,`category_id`),
  KEY `IDX_AF4B7EFD97FFC673` (`games_id`),
  KEY `IDX_AF4B7EFD12469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `games_category`
--

INSERT INTO `games_category` (`games_id`, `category_id`) VALUES
(1, 1),
(1, 3),
(2, 5),
(3, 1),
(3, 2),
(4, 11),
(5, 4),
(6, 9),
(7, 6),
(8, 6),
(9, 11),
(10, 1),
(10, 2),
(11, 8),
(12, 9),
(13, 9),
(14, 7),
(15, 2),
(15, 10),
(16, 1),
(16, 3);

-- --------------------------------------------------------

--
-- Structure de la table `studio`
--

DROP TABLE IF EXISTS `studio`;
CREATE TABLE IF NOT EXISTS `studio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `studio`
--

INSERT INTO `studio` (`id`, `name`) VALUES
(1, 'Mojang Studios'),
(2, 'Divers'),
(3, 'Rockstar Games'),
(4, 'Nintendo'),
(5, 'PUBG'),
(6, 'Activision Blizzard'),
(7, 'Bethesda Softworks'),
(8, 'Re-Logic');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962A4D77E7D8` FOREIGN KEY (`game_id_id`) REFERENCES `games` (`id`);

--
-- Contraintes pour la table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `FK_FF232B3181F17E9A` FOREIGN KEY (`studio_id_id`) REFERENCES `studio` (`id`);

--
-- Contraintes pour la table `games_category`
--
ALTER TABLE `games_category`
  ADD CONSTRAINT `FK_AF4B7EFD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_AF4B7EFD97FFC673` FOREIGN KEY (`games_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
