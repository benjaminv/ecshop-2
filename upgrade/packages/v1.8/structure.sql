ALTER TABLE `dsc_admin_user` ADD `admin_user_img` VARCHAR( 255 ) NOT NULL AFTER `major_brand`;

ALTER TABLE `dsc_discuss_circle` ADD `like_num` INT( 10 ) NOT NULL DEFAULT  '0' COMMENT  '点赞数'  AFTER  `dis_id`;

ALTER TABLE `dsc_discuss_circle` ADD `dis_browse_num` INT( 10 ) UNSIGNED NOT NULL COMMENT  '浏览数'  AFTER  `dis_id`;

ALTER TABLE `dsc_seller_shopinfo` 
	ADD `longitude` varchar(100) NOT NULL AFTER `shipping_date`, 
	ADD `latitude` varchar(100) NOT NULL AFTER `longitude`;

ALTER TABLE `dsc_products` ADD  `product_price` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT  '0.00' AFTER  `product_number` ,
	ADD  `product_market_price` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT  '0.00' AFTER  `product_price` ,
	ADD  `product_warn_number` TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT  '1' AFTER  `product_market_price`;

ALTER TABLE `dsc_products_warehouse` ADD  `product_price` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT  '0.00' AFTER  `product_number` ,
	ADD  `product_market_price` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT  '0.00' AFTER  `product_price` ,
	ADD  `product_warn_number` TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT  '1' AFTER  `product_market_price`;

ALTER TABLE `dsc_products_area` ADD  `product_price` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT  '0.00' AFTER  `product_number` ,
	ADD  `product_market_price` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT  '0.00' AFTER  `product_price` ,
	ADD  `product_warn_number` TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT  '1' AFTER  `product_market_price`;

ALTER TABLE `dsc_cart` 
	ADD `store_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `stages_qishu`;

ALTER TABLE `dsc_admin_action` CHANGE `parent_id` `parent_id` SMALLINT( 5 ) UNSIGNED NOT NULL DEFAULT '0';

DROP TABLE IF EXISTS `dsc_touch_adsense`;
CREATE TABLE IF NOT EXISTS `dsc_touch_adsense` (
    `from_ad` smallint(5) NOT NULL DEFAULT '0',
    `referer` varchar(255) NOT NULL DEFAULT '',
    `clicks` int(10) unsigned NOT NULL DEFAULT '0',
    KEY `from_ad` (`from_ad`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dsc_offline_store`;
CREATE TABLE IF NOT EXISTS `dsc_offline_store` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ru_id` int(10) NOT NULL DEFAULT '0',
  `stores_user` varchar(60) NOT NULL DEFAULT '',
  `stores_pwd` varchar(32) NOT NULL DEFAULT '',
  `stores_name` varchar(60) NOT NULL DEFAULT '',
  `country` smallint(5) NOT NULL DEFAULT '0',
  `province` smallint(5) NOT NULL DEFAULT '0',
  `city` smallint(5) NOT NULL DEFAULT '0',
  `district` smallint(5) NOT NULL DEFAULT '0',
  `stores_address` varchar(255) NOT NULL DEFAULT '',
  `stores_tel` varchar(60) NOT NULL DEFAULT '',
  `stores_opening_hours` varchar(255) NOT NULL DEFAULT '',
  `stores_traffic_line` varchar(255) NOT NULL DEFAULT '',
  `stores_img` varchar(255) NOT NULL DEFAULT '',
  `is_confirm` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `add_time` int(11) NOT NULL,
  `ec_salt` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_store_action`;
CREATE TABLE IF NOT EXISTS `dsc_store_action` (
  `action_id` int(8) NOT NULL AUTO_INCREMENT,
  `parent_id` int(8) unsigned NOT NULL DEFAULT '0',
  `action_code` varchar(20) NOT NULL DEFAULT '',
  `relevance` varchar(20) NOT NULL DEFAULT '',
  `action_name` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`action_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_store_goods`;
CREATE TABLE IF NOT EXISTS `dsc_store_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `ru_id` int(11) NOT NULL,
  `goods_number` smallint(5) NOT NULL,
  `extend_goods_number` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_store_order`;
CREATE TABLE IF NOT EXISTS `dsc_store_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) unsigned NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ru_id` int(11) unsigned NOT NULL DEFAULT '0',
  `is_grab_order` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `grab_store_list` text NOT NULL,
  `pick_code` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_store_products`;
CREATE TABLE IF NOT EXISTS `dsc_store_products` (
  `product_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `goods_attr` varchar(50) DEFAULT NULL,
  `product_sn` varchar(60) DEFAULT NULL,
  `product_number` smallint(5) unsigned DEFAULT '0',
  `ru_id` int(11) NOT NULL DEFAULT '0',
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`),
  KEY `goods_id` (`goods_id`),
  KEY `product_sn` (`product_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_store_user`;
CREATE TABLE IF NOT EXISTS `dsc_store_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ru_id` int(10) unsigned NOT NULL DEFAULT '0',
  `store_id` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `stores_user` varchar(60) NOT NULL DEFAULT '',
  `stores_pwd` varchar(32) NOT NULL DEFAULT '',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `store_action` text NOT NULL,
  `add_time` int(10) NOT NULL DEFAULT '0',
  `ec_salt` varchar(10) NOT NULL DEFAULT '',
  `store_user_img` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;