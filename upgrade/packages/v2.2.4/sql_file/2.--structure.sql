ALTER TABLE `dsc_goods_type` ADD `c_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `attr_group` ;

CREATE TABLE IF NOT EXISTS `dsc_goods_type_cat` (
  `cat_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(8) unsigned NOT NULL DEFAULT '0',
  `cat_name` varchar(90) NOT NULL,
  `sort_order` smallint(8) unsigned NOT NULL DEFAULT '50',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `dsc_sessions` ENGINE = MYISAM ;
ALTER TABLE `dsc_sessions` ROW_FORMAT=DYNAMIC;

ALTER TABLE `dsc_order_info` ADD `tax_id` VARCHAR( 255 ) NOT NULL DEFAULT ''; 

ALTER TABLE `dsc_order_invoice` ADD `tax_id` VARCHAR( 255 ) NOT NULL DEFAULT ''; 