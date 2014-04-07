CREATE TABLE `module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `num_downloads` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `description` text,
  `is_completed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;


