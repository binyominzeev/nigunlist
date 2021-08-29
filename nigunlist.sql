-- Adminer 4.8.1 MySQL 5.5.5-10.0.27-MariaDB-cll-lve dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `nigunlist_categ`;
CREATE TABLE `nigunlist_categ` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `categ` varchar(31) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `nigunlist_categ` (`id`, `categ`) VALUES
(3,	'Nagyünnepi'),
(4,	'Sábesz'),
(5,	'Zarándokünnep / Hálél'),
(6,	'Gyors'),
(7,	'Lassú');

DROP TABLE IF EXISTS `nigunlist_categ_nigun`;
CREATE TABLE `nigunlist_categ_nigun` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `categ` bigint(11) NOT NULL,
  `nigun` bigint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `nigunlist_categ_nigun` (`id`, `categ`, `nigun`) VALUES
(3,	3,	32),
(4,	3,	30),
(5,	3,	5),
(6,	3,	33),
(7,	3,	40),
(8,	3,	38),
(9,	3,	42),
(10,	3,	29),
(11,	3,	31),
(12,	3,	21),
(13,	3,	27),
(14,	3,	28),
(15,	3,	37),
(16,	4,	14),
(17,	4,	9),
(18,	4,	16),
(19,	4,	18),
(20,	4,	6),
(21,	4,	19),
(22,	4,	12),
(23,	4,	4),
(24,	4,	13),
(25,	4,	20),
(26,	4,	17),
(27,	4,	23),
(28,	5,	15),
(29,	5,	43),
(30,	5,	8),
(31,	5,	7),
(32,	6,	10),
(33,	6,	12),
(34,	6,	7),
(35,	6,	36),
(36,	7,	32),
(37,	7,	26),
(38,	7,	15),
(39,	7,	5),
(40,	7,	40),
(41,	7,	42),
(42,	7,	29),
(43,	7,	17),
(44,	7,	34),
(45,	7,	22),
(46,	7,	2);

DROP TABLE IF EXISTS `nigunlist_nigun`;
CREATE TABLE `nigunlist_nigun` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(63) NOT NULL,
  `datetime` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `nigunlist_nigun` (`id`, `title`, `datetime`) VALUES
(2,	'Vehu kéli',	'2021-08-25 17:57:11'),
(3,	'Im eskáchéch',	'2021-08-25 17:57:11'),
(4,	'Ki lekách tov',	'2021-08-25 17:57:11'),
(5,	'Ávinu málkénu',	'2021-08-25 18:07:44'),
(6,	'Jedid nefes',	'2021-08-25 18:09:34'),
(7,	'Ki kol pe',	'2021-08-25 18:09:45'),
(8,	'Ki hirbétá',	'2021-08-25 18:09:49'),
(9,	'Áz bájom',	'2021-08-25 18:10:14'),
(10,	'Hosiá et ámechá',	'2021-08-25 18:10:19'),
(11,	'Náfsénu',	'2021-08-25 18:10:22'),
(12,	'Jiszmechu',	'2021-08-25 18:10:26'),
(13,	'Kol mekádés',	'2021-08-25 18:10:29'),
(14,	'Áná ávdá',	'2021-08-25 18:11:18'),
(15,	'Ávinu áv háráchámán',	'2021-08-25 18:11:24'),
(16,	'Éset chájil',	'2021-08-25 18:11:34'),
(17,	'Pihá pátchá',	'2021-08-25 18:11:38'),
(18,	'Git sábesz (Carlebach)',	'2021-08-25 18:11:45'),
(19,	'Jiddise sábesz',	'2021-08-25 18:11:52'),
(20,	'Lechá dodi',	'2021-08-25 18:11:56'),
(21,	'Tehé hásáá',	'2021-08-25 18:12:00'),
(22,	'Szól a kakas',	'2021-08-25 18:12:03'),
(23,	'Sábesz (hangszórókból)',	'2021-08-25 18:12:13'),
(24,	'Táiti kesze ovéd',	'2021-08-26 00:24:14'),
(25,	'Áná Melech',	'2021-08-26 00:24:33'),
(26,	'Áná bekoách',	'2021-08-26 00:24:46'),
(27,	'Tukdás Ádon (kétféle)',	'2021-08-26 06:51:15'),
(28,	'Vehájá bájom háhu',	'2021-08-26 21:35:07'),
(29,	'Máchniszé',	'2021-08-26 21:35:18'),
(30,	'Ánénu',	'2021-08-26 21:35:26'),
(31,	'Moriá',	'2021-08-26 21:35:33'),
(32,	'Ajchiló',	'2021-08-26 21:35:40'),
(33,	'Chámajl',	'2021-08-26 21:35:56'),
(34,	'Somér Jiszráél',	'2021-08-26 21:36:11'),
(35,	'Im lomádto',	'2021-08-27 01:44:36'),
(36,	'Veál kulám',	'2021-08-27 01:44:45'),
(37,	'Vejeetáju',	'2021-08-27 01:45:08'),
(38,	'Hejé im pifijot',	'2021-08-29 22:34:25'),
(39,	'Sábechi',	'2021-08-29 17:23:14'),
(40,	'Hánesámá lách',	'2021-08-29 17:23:29'),
(41,	'Lemáán áchái',	'2021-08-29 17:23:53'),
(42,	'Lemáánchá',	'2021-08-29 17:24:02'),
(43,	'Kéli átá',	'2021-08-29 17:24:16'),
(44,	'Hábét',	'2021-08-29 21:59:48');

-- 2021-08-29 21:08:02
