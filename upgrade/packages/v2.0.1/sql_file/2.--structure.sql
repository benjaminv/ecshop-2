ALTER TABLE  `dsc_merchants_shop_information` ADD  `self_run` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '自营店铺';

ALTER TABLE `dsc_goods` ADD `goods_unit` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '个';

ALTER TABLE `dsc_goods_transport` ADD `freight_type` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `type` ;

CREATE TABLE IF NOT EXISTS `dsc_goods_transport_tpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `shipping_id` int(11) NOT NULL DEFAULT '0',
  `region_id` varchar(255) NOT NULL DEFAULT '',
  `configure` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `dsc_source_ip` (
  `ipid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `storeid` int(10) NOT NULL,
  `ipdata` varchar(16) NOT NULL COMMENT '访问者的IP',
  `iptime` varchar(30) NOT NULL COMMENT '访问时间',
  PRIMARY KEY (`ipid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

ALTER TABLE  `dsc_seckill` ADD  `begin_time` INT( 11 ) NOT NULL AFTER  `acti_title`;

ALTER TABLE `dsc_seller_shopinfo` ADD `frozen_money` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT '0.00' AFTER `seller_money` ;

ALTER TABLE `dsc_order_info` ADD `is_frozen` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_seller_account_log` ADD `frozen_money` DECIMAL( 10, 2 ) NOT NULL DEFAULT '0.00' AFTER `amount` ;

CREATE TABLE IF NOT EXISTS `dsc_merchants_account_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `frozen_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `change_time` int(10) unsigned NOT NULL,
  `change_desc` varchar(255) NOT NULL DEFAULT '',
  `change_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;