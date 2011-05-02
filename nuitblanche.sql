-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 02 Mai 2011 à 07:16
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `nuitblanche`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `body` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5BC96BF0B5A459A0` (`news_id`),
  KEY `IDX_5BC96BF0F675F31B` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `news_id`, `author_id`, `date`, `body`) VALUES
(1, 1, 1, '2011-05-01 17:28:27', 'a first comment'),
(2, 1, 1, '2011-05-01 17:28:40', 'and a second form');

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `war_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `winner` int(11) NOT NULL,
  `map` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_83199EB25B81B612` (`war_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`id`, `war_id`, `date`, `winner`, `map`) VALUES
(1, 1, '2010-09-19 17:26:37', 1, 'Lost Temple');

-- --------------------------------------------------------

--
-- Structure de la table `gameplayer`
--

CREATE TABLE IF NOT EXISTS `gameplayer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `race` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `apm` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_68E3E990E48FD905` (`game_id`),
  KEY `IDX_68E3E99099E6F5DF` (`player_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `gameplayer`
--

INSERT INTO `gameplayer` (`id`, `game_id`, `player_id`, `name`, `race`, `color`, `apm`, `team`) VALUES
(1, 1, 1, 'AlepH', 'protoss', '', 0, 1),
(2, 1, NULL, 'IMMvp', 'terran', '', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `league`
--

CREATE TABLE IF NOT EXISTS `league` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `league`
--

INSERT INTO `league` (`id`, `name`, `country`) VALUES
(1, 'Friendly', 'FR'),
(2, 'Pandaria', 'FR'),
(3, 'SC2CL', 'EU'),
(4, 'SC2F', 'FR');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BDE1366EF675F31B` (`author_id`),
  KEY `IDX_BDE1366E296CD8AE` (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `author_id`, `team_id`, `title`, `body`, `date`) VALUES
(1, 1, 1, 'A first test news', '<p>\r\nWith some damn short content\r\n</p>\r\n<p>\r\nSo let''s add a lil more to it !\r\n</p>', '2011-05-01 17:28:07');

-- --------------------------------------------------------

--
-- Structure de la table `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `sc2Role` varchar(255) NOT NULL,
  `sc2Id` int(11) NOT NULL,
  `sc2Race` varchar(255) NOT NULL,
  `sc2ProfileEsl` varchar(255) NOT NULL,
  `sc2ProfileSc2cl` varchar(255) NOT NULL,
  `sc2ProfilePandaria` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9FB57F53A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `player`
--

INSERT INTO `player` (`id`, `user_id`, `sc2Role`, `sc2Id`, `sc2Race`, `sc2ProfileEsl`, `sc2ProfileSc2cl`, `sc2ProfilePandaria`) VALUES
(1, 1, 'Admin', 372, 'protoss', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `replay`
--

CREATE TABLE IF NOT EXISTS `replay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `chart` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `length` varchar(255) NOT NULL,
  `obs` varchar(255) NOT NULL,
  `realm` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DE9BF1C4E48FD905` (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `replay`
--

INSERT INTO `replay` (`id`, `game_id`, `file`, `chart`, `size`, `length`, `obs`, `realm`, `version`) VALUES
(1, 1, '', '', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `season`
--

CREATE TABLE IF NOT EXISTS `season` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `league_id` int(11) DEFAULT NULL,
  `number` int(11) NOT NULL,
  `division` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `ended` tinyint(1) NOT NULL,
  `wins` int(11) NOT NULL,
  `draws` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F7485E9F58AFC4DE` (`league_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `season`
--

INSERT INTO `season` (`id`, `league_id`, `number`, `division`, `startDate`, `endDate`, `ended`, `wins`, `draws`, `losses`, `position`) VALUES
(1, 2, 1, 3, '2010-09-19 17:25:02', '2010-12-15 17:25:10', 1, 7, 0, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `team`
--

INSERT INTO `team` (`id`, `name`, `icon`, `tag`) VALUES
(1, 'nB.SC2', '/images/bundles/ihqsnuitblanche/ico/nb_boy.png', 'nB)'),
(2, 'nB.SC2 Girsl', '/images/bundles/ihqsnuitblanche/ico/nb_girl.png', 'nB)'),
(3, 'nB.SC2 Oldies', '/images/bundles/ihqsnuitblanche/ico/nb_boy.png', 'nB)');

-- --------------------------------------------------------

--
-- Structure de la table `team_player`
--

CREATE TABLE IF NOT EXISTS `team_player` (
  `team_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  PRIMARY KEY (`team_id`,`player_id`),
  KEY `IDX_EE023DBC296CD8AE` (`team_id`),
  KEY `IDX_EE023DBC99E6F5DF` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `team_player`
--

INSERT INTO `team_player` (`team_id`, `player_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `skype` varchar(255) NOT NULL,
  `msn` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `avatar`, `firstName`, `lastName`, `city`, `country`, `facebook`, `twitter`, `skype`, `msn`) VALUES
(1, 'AlepH', 'leeloo07', 'lysimaque@gmail.com', '/upload/avatar/aleph.gif', 'Antoine', 'Berranger', 'Nantes', 'France', '', 'AlepH-FR', 'aleph_44', 'lysimaque@hotmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `war`
--

CREATE TABLE IF NOT EXISTS `war` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `season_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `maps` varchar(255) NOT NULL,
  `teamScore` int(11) NOT NULL,
  `opponentName` varchar(255) NOT NULL,
  `opponentScore` int(11) NOT NULL,
  `opponentCountry` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_545FABD1296CD8AE` (`team_id`),
  KEY `IDX_545FABD14EC001D1` (`season_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `war`
--

INSERT INTO `war` (`id`, `team_id`, `season_id`, `date`, `maps`, `teamScore`, `opponentName`, `opponentScore`, `opponentCountry`, `result`) VALUES
(1, 1, 1, '2010-09-19 17:25:30', '', 5, 'NbT', 0, 'FR', 'win');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`);

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`war_id`) REFERENCES `war` (`id`);

--
-- Contraintes pour la table `gameplayer`
--
ALTER TABLE `gameplayer`
  ADD CONSTRAINT `gameplayer_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`),
  ADD CONSTRAINT `gameplayer_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`);

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `replay`
--
ALTER TABLE `replay`
  ADD CONSTRAINT `replay_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`);

--
-- Contraintes pour la table `season`
--
ALTER TABLE `season`
  ADD CONSTRAINT `season_ibfk_1` FOREIGN KEY (`league_id`) REFERENCES `league` (`id`);

--
-- Contraintes pour la table `team_player`
--
ALTER TABLE `team_player`
  ADD CONSTRAINT `team_player_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_player_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `war`
--
ALTER TABLE `war`
  ADD CONSTRAINT `war_ibfk_2` FOREIGN KEY (`season_id`) REFERENCES `season` (`id`),
  ADD CONSTRAINT `war_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`);
