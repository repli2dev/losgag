Make /images /log /temp writable by chmod -R 777

Remove images from /images

In subdirectory set proper RewriteBase

Create local config in /app/config/config.local.neon

Create database schema.

Import teams into table team.

------------------------------------------------------------

-- Adminer 4.2.0 MySQL dump

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `id_team` int(10) unsigned NOT NULL,
  `id_post` int(11) NOT NULL,
  UNIQUE KEY `id_team_id_post` (`id_team`,`id_post`),
  KEY `id_post` (`id_post`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_team`) REFERENCES `team` (`id_team`) ON DELETE CASCADE,
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_team` int(10) unsigned NOT NULL,
  `likes` int(10) unsigned NOT NULL DEFAULT '0',
  `inserted` datetime NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_team` (`id_team`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_team`) REFERENCES `team` (`id_team`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id_team` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(160) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id_team`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

ALTER TABLE `team` ADD UNIQUE `name` (`name`);