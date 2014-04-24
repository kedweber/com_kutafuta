DROP TABLE IF EXISTS `#__kutafuta_terms`;
CREATE TABLE `#__kutafuta_terms` (
  `kutafuta_term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `route_id` bigint(20) NOT NULL,
  `value` text NOT NULL,
  `lang` varchar(255) NOT NULL,
  PRIMARY KEY (`kutafuta_term_id`),
  FULLTEXT KEY `search` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
