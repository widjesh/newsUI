CREATE TABLE `ne_category` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `image` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `ne_home` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'list',
  `title` varchar(30) NOT NULL,
  `length` int(2) NOT NULL DEFAULT '5',
  `items` varchar(128) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '1'
);

INSERT INTO `ne_home` (`id`, `type`, `title`, `length`, `items`, `sort`) VALUES
(1, 'carousel', 'Featured', 5, 'featured', 0),
(2, 'list', 'Latest', 10, 'latest', 2),
(3, 'horizontal', 'Popular', 5, 'popular', 3);

CREATE TABLE `ne_news` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` blob NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `published_at` datetime DEFAULT NULL,
  `views` int(20) NOT NULL DEFAULT '0',
  `author_id` int(20) NOT NULL DEFAULT '0',
  `image` text,
  `category_id` int(20) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

CREATE TABLE `ne_sess` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
);

CREATE TABLE `ne_users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(300) NOT NULL,
  `password` text NOT NULL,
  `first_name` text,
  `last_name` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `level` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);
INSERT INTO `ne_users` VALUES ('1', 'admin@admin.com', 'b714337aa8007c433329ef43c7b8252c', 'Admin', 'Admin', '2018-02-18 10:49:57', '3');