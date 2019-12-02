ALTER TABLE `dsc_admin_user` 
	ADD `parent_id` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `user_name` ;
	
ALTER TABLE  `dsc_ad_position` 
	ADD  `position_model` VARCHAR( 255 ) NOT NULL AFTER  `ad_height` ;

DROP TABLE IF EXISTS `dsc_seller_domain`;
CREATE TABLE IF NOT EXISTS `dsc_seller_domain` (
  `id` tinyint(8) NOT NULL AUTO_INCREMENT,
  `domain_name` varchar(60) NOT NULL DEFAULT '',
  `ru_id` int(8) NOT NULL,
  `is_enable` tinyint(1) NOT NULL DEFAULT '0',
  `validity_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE  `dsc_category` 
	ADD  `cat_icon` VARCHAR( 255 ) NOT NULL AFTER  `top_style_tpl`;