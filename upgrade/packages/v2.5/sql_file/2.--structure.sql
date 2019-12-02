ALTER TABLE dsc_order_info DROP INDEX shipping_id;

ALTER TABLE `dsc_order_info` CHANGE `pay_id` `pay_id` MEDIUMINT(8) NOT NULL DEFAULT '0';

ALTER TABLE `dsc_coupons_user` ADD `cou_money` DECIMAL(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `cou_id` ;

DROP TABLE IF EXISTS `dsc_solve_dealconcurrent`;
CREATE TABLE IF NOT EXISTS `dsc_solve_dealconcurrent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `orec_id` text NOT NULL,
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `solve_type` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `add_time` (`add_time`),
  KEY `solve_type` (`solve_type`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;