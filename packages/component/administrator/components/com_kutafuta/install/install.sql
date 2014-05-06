CREATE TABLE IF NOT EXISTS `#__kutafuta_terms` (
  `kutafuta_term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  `lang` varchar(255) NOT NULL,
  `table` varchar(255) NOT NULL,
  `row` bigint NOT NULL,
  PRIMARY KEY (`kutafuta_term_id`),
  FULLTEXT KEY `search` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;