# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 10.0.11-MariaDB)
# Database: marketplace
# Generation Time: 2014-11-15 15:18:51 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table module
# ------------------------------------------------------------

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `num_downloads` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `is_completed` tinyint(1) DEFAULT NULL,
  `stars` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table module_author
# ------------------------------------------------------------

DROP TABLE IF EXISTS `module_author`;

CREATE TABLE `module_author` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table module_comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `module_comment`;

CREATE TABLE `module_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `comment` text,
  `created` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table module_description
# ------------------------------------------------------------

DROP TABLE IF EXISTS `module_description`;

CREATE TABLE `module_description` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table module_installation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `module_installation`;

CREATE TABLE `module_installation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table module_screenshot
# ------------------------------------------------------------

DROP TABLE IF EXISTS `module_screenshot`;

CREATE TABLE `module_screenshot` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `thumb_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `github_uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_github_uid` (`github_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
