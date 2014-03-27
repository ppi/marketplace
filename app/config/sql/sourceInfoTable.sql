DROP TABLE IF EXISTS `module_screenshot`;


CREATE TABLE `module_screenshot` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `thumb_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `module_screenshot` (`id`, `module_id`, `path`, `thumb_path`)
VALUES
        (1, 1, 'assets/images/gallery/image-1.jpg', 'assets/images/gallery/thumb-1.jpg'),
        (2, 1, 'assets/images/gallery/image-2.jpg', 'assets/images/gallery/thumb-2.jpg'),
        (3, 1, 'assets/images/gallery/image-3.jpg', 'assets/images/gallery/thumb-3.jpg');


DROP TABLE IF EXISTS `module_source_info`;

CREATE TABLE `module_source_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `github_url` varchar(255) DEFAULT NULL,
  `packagist_url` varchar(255) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `module_source_info` (`id`, `github_url`, `packagist_url`, `module_id`)
VALUES
	(1, 'http://github.com/ppi/cache-module', 'https://packagist.org/packages/ppi/smarty-module', 1);


