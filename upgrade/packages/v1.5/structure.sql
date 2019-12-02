DROP TABLE IF EXISTS `dsc_comment_baseline`;
CREATE TABLE IF NOT EXISTS `dsc_comment_baseline` (
  `id` smallint(8) NOT NULL AUTO_INCREMENT,
  `goods` smallint(3) unsigned NOT NULL DEFAULT '0',
  `service` smallint(3) unsigned NOT NULL DEFAULT '0',
  `shipping` smallint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;