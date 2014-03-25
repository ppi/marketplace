INSERT INTO `module` (`id`, `description`, `last_updated`, `num_downloads`, `title`)
VALUES
	(1, 'This module handles basic user authentication', '2014-03-25 22:38:12', 43534, 'AuthModule');


INSERT INTO `module_author` (`id`, `firstname`, `lastname`, `module_id`)
VALUES
	(1, 'Paul', 'Dragoonis', 1),
	(2, 'Ross', 'Moroney', 1);


INSERT INTO `module_comment` (`id`, `module_id`, `comment`, `created`, `name`)
VALUES
	(1, 1, 'This is an excellent module, it saved me lots of time	', '2014-03-25 23:06:43', 'Rick Astley'),
	(2, 1, 'I had a little trouble getting this module set up but once I had it going it saved me huge amounts of effort.', '2014-03-25 23:07:09', 'Jonny Cash');


