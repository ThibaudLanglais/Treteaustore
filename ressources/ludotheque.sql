-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 12 jan. 2022 à 00:13
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ludotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `label` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `label`) VALUES
(2, 'sandbox'),
(3, 'jeux pour enfants'),
(5, 'voiture'),
(6, 'jeu de rythme'),
(7, 'skill'),
(8, 'nael'),
(10, 'indie'),
(11, 'Arcade'),
(12, 'Action'),
(13, 'RPG'),
(14, 'Strategy'),
(15, 'Adventure'),
(16, 'Massively Multiplayer'),
(17, 'Platformer');

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

CREATE TABLE `emprunts` (
  `game_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `date_emprunt` date NOT NULL DEFAULT current_timestamp(),
  `gave_back` tinyint(4) NOT NULL DEFAULT 0,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `emprunts`
--

INSERT INTO `emprunts` (`game_id`, `member_id`, `date_emprunt`, `gave_back`, `id`) VALUES
(5, 6, '2022-01-07', 1, 6),
(5, 6, '2021-12-13', 1, 8),
(5, 6, '2021-10-12', 1, 9),
(5, 6, '2021-10-12', 1, 10),
(5, 6, '2022-01-07', 1, 11),
(5, 6, '2022-01-07', 1, 12),
(26, 6, '2022-01-11', 0, 13),
(5, 2, '2022-01-11', 1, 14);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age_restriction` int(11) NOT NULL,
  `date_sortie` date NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `resume` text DEFAULT NULL,
  `cover_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id`, `name`, `age_restriction`, `date_sortie`, `video`, `stock`, `resume`, `cover_id`) VALUES
(2, 'DMC', 3, '2022-01-30', NULL, 4, 'heyyaaa', 5),
(3, 'Rocket League', 3, '2022-03-18', NULL, 3, NULL, 4),
(4, 'Minecraft', 3, '2022-01-20', 'https://www.youtube.com/embed/vdrn4ouZRvQ', 2, NULL, 2),
(5, 'Super Mario Bros', 3, '2021-12-02', NULL, 8, NULL, 6),
(7, 'Pacman', 7, '1998-04-28', NULL, 21, NULL, 10),
(24, 'League of Legends', 18, '2009-10-27', NULL, 1, '<p>League of Legends is a fast-paced, competitive online game that blends the speed and intensity of an RTS with RPG elements. Two teams of powerful champions, each with a unique design and playstyle, battle head-to-head across multiple battlefields and game modes. With an ever-expanding roster of champions, frequent updates and a thriving tournament scene, League of Legends offers endless replayability for players of every skill level.</p>', 21),
(25, 'RuneScape', 18, '2001-03-29', NULL, 1, '<p>RuneScape takes place in the world of Gielinor, a medieval fantasy realm divided into different kingdoms, regions, and cities. Players can travel throughout Gielinor via a number of methods including on foot, magical spells, or charter ships. Each region offers different types of monsters, resources, and quests to challenge players.</p>', 22),
(26, 'Barbie', 18, '1984-01-01', NULL, 1, '<p>Barbie is a multi-platform video game developed by Imagineering for Hi Tech Expressions. It is based on Mattel Inc.\'s doll of the same name, and it was created in an attempt to get more girls to play video games. As such, it is one of the few explicitly girl-oriented NES games. The game takes place in a dream where Barbie must travel through three different worlds (Mall, Underwater and Soda Shop) to gather accessories before attending a ball to meet Ken. Despite it having been of little interest to typical gamers at the time of its release, some critics have praised it as \"not bad\" for a generic platformer. Others have advanced the view that its genre is not appropriate for its content.</p>', 23);

-- --------------------------------------------------------

--
-- Structure de la table `game_images`
--

CREATE TABLE `game_images` (
  `game_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `game_images`
--

INSERT INTO `game_images` (`game_id`, `image_id`) VALUES
(4, 2),
(4, 3),
(3, 4),
(5, 6),
(7, 10),
(2, 10),
(24, 21),
(25, 22),
(26, 23),
(2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `link`) VALUES
(2, 'https://cdn03.nintendo-europe.com/media/images/10_share_images/games_15/nintendo_switch_4/H2x1_NSwitch_Minecraft.jpg'),
(3, 'https://minecraft.gameplaying.info/wp-content/uploads/2020/01/minecraft_kwTrjzgw5f.png'),
(4, 'https://theme.zdassets.com/theme_assets/1094427/189dce017fb19e3ca1b94b2095d519cc514df22c.jpg'),
(5, 'https://e.snmc.io/lk/lv/x/e69845a8464784d8e1b5c03684e7d6ac/7427178'),
(6, 'https://cdn03.nintendo-europe.com/media/images/10_share_images/games_15/virtual_console_nintendo_3ds_7/SI_3DSVC_SuperMarioBros_image1600w.jpg'),
(10, 'https://www.myabandonware.com/media/screenshots/p/pc-man-v2-q8/pc-man-v2_2.png'),
(13, 'https://c.tenor.com/Sqlla32YqQkAAAAC/peppy-osu.gif'),
(20, 'https://media.rawg.io/media/screenshots/142/1420d28eb5fa9d012b90c48629a18a94.jpg'),
(21, 'https://media.rawg.io/media/games/78b/78bc81e247fc7e77af700cbd632a9297.jpg'),
(22, 'https://media.rawg.io/media/games/007/0073b6418763a47eb023fba88cb22e7c.jpg'),
(23, 'https://media.rawg.io/media/screenshots/b47/b473b31e857691da80e5575dfa16e8e2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `link_categories`
--

CREATE TABLE `link_categories` (
  `game_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `link_categories`
--

INSERT INTO `link_categories` (`game_id`, `category_id`) VALUES
(4, 3),
(3, 5),
(2, 10),
(24, 12),
(24, 13),
(24, 14),
(25, 15),
(25, 16),
(25, 13),
(26, 17),
(26, 12);

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `member`
--

INSERT INTO `member` (`id`, `email`, `password`, `lastname`, `firstname`, `birthdate`, `is_admin`, `picture`) VALUES
(2, 'thibaud.langlais@gmail.com', 'e8c0517473bd0ccac3fb7681df586c7ad22bc0ca', 'Thibaud Langlais', 'Thibaud', '2000-09-12', 0, 'http://images6.fanpop.com/image/answers/3579000/3579637_1411151525775.72res_400_300.jpg'),
(6, 'admin@test.com', 'aedaf8ada39d8cefae751d60a453165f2dca8d17', 'Langlais (admin)', 'Thibaud', '2001-07-27', 1, 'https://static-cdn.jtvnw.net/jtv_user_pictures/2e0ea0df-3869-46ab-a6a0-445978af7bcc-profile_image-300x300.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`) USING BTREE,
  ADD KEY `member_id` (`member_id`) USING BTREE;

--
-- Index pour la table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `game_images`
--
ALTER TABLE `game_images`
  ADD KEY `game_id` (`game_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `link_categories`
--
ALTER TABLE `link_categories`
  ADD KEY `game_id` (`game_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `emprunts`
--
ALTER TABLE `emprunts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `emprunts_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emprunts_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `game_images`
--
ALTER TABLE `game_images`
  ADD CONSTRAINT `game_images_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_images_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `link_categories`
--
ALTER TABLE `link_categories`
  ADD CONSTRAINT `link_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_categories_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
