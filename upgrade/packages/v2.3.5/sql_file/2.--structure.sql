ALTER TABLE `dsc_admin_log` CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_shipping` ADD `customer_name` VARCHAR(50) NOT NULL, ADD `customer_pwd` VARCHAR(50) NOT NULL AFTER `customer_name`;

ALTER TABLE `dsc_seller_shopinfo` ADD `print_type` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER `js_appsecret`, ADD `kdniao_printer` VARCHAR(50) NOT NULL AFTER `print_type`;

CREATE TABLE IF NOT EXISTS `dsc_order_print_size` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `specification` varchar(50) NOT NULL,
  `width` varchar(50) NOT NULL,
  `height` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8; 

CREATE TABLE IF NOT EXISTS `dsc_order_print_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ru_id` int(10) unsigned NOT NULL DEFAULT '0',
  `specification` varchar(50) NOT NULL,
  `printer` varchar(50) NOT NULL,
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ru_id` (`ru_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;