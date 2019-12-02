ALTER TABLE  `dsc_goods_inventory_logs` ADD  `suppliers_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `area_id`;

CREATE TABLE IF NOT EXISTS `dsc_users_log` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `change_time` int(10) NOT NULL DEFAULT '0',
  `change_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ip_address` varchar(15) NOT NULL,
  `change_city` varchar(255) NOT NULL,
  `logon_service` varchar(60) NOT NULL DEFAULT 'pc',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `dsc_users_log` ADD `admin_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `user_id` ;

ALTER TABLE `dsc_gift_gard_log` CHANGE `delivery_status` `delivery_status` VARCHAR( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;

ALTER TABLE `dsc_order_info` CHANGE `goods_amount` `goods_amount` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00', 
CHANGE `cost_amount` `cost_amount` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '订单成本', 
CHANGE `shipping_fee` `shipping_fee` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00', 
CHANGE `insure_fee` `insure_fee` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00', 
CHANGE `pay_fee` `pay_fee` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00', 
CHANGE `pack_fee` `pack_fee` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00', 
CHANGE `card_fee` `card_fee` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00', 
CHANGE `money_paid` `money_paid` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00', 
CHANGE `surplus` `surplus` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00', 
CHANGE `integral_money` `integral_money` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00', 
CHANGE `bonus` `bonus` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00', 
CHANGE `tax` `tax` DECIMAL(10,2) UNSIGNED NOT NULL, 
CHANGE `discount` `discount` DECIMAL(10,2) UNSIGNED NOT NULL, 
CHANGE `coupons` `coupons` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00';

ALTER TABLE `dsc_order_return` CHANGE `should_return` `should_return` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT '0.00',
CHANGE `actual_return` `actual_return` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT '0.00';

ALTER TABLE `dsc_merchants_shop_information` ADD `store_score` TINYINT( 1 ) NOT NULL DEFAULT '5' AFTER `sort_order` ;