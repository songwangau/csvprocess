--
-- Database: `csv_p_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `user_name` varchar(24) COLLATE utf8_bin NOT NULL COMMENT 'user name',
  `surname` varchar(24) COLLATE utf8_bin NOT NULL COMMENT 'user surname',
  `email` varchar(24) COLLATE utf8_bin NOT NULL COMMENT 'user email',
  `status` int(1) NOT NULL COMMENT 'record status',
  `create_date` datetime NOT NULL COMMENT 'created date',
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=80 ;

ALTER TABLE `users` ADD INDEX ( `email` ) ;