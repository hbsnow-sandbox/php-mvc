CREATE TABLE `charactor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255),
  `grade` tinyint(4),
  `atk` tinyint(4),
  `def` tinyint(4),
  `created_at` datetime NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;