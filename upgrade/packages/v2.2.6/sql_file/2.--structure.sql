CREATE TABLE IF NOT EXISTS `dsc_seller_shopinfo_changelog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ru_id` int(10) unsigned NOT NULL DEFAULT '0',
  `data_key` varchar(50) NOT NULL,
  `data_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE  `dsc_seller_shopinfo` ADD  `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  '1',
ADD  `review_content` VARCHAR( 100 ) NOT NULL;

ALTER TABLE `dsc_products` CHANGE `product_number` `product_number` INT( 10 ) UNSIGNED NULL DEFAULT '0';

ALTER TABLE `dsc_products_area` CHANGE `product_number` `product_number` INT( 10 ) UNSIGNED NULL DEFAULT '0';

ALTER TABLE `dsc_products_warehouse` CHANGE `product_number` `product_number` INT( 10 ) UNSIGNED NULL DEFAULT '0';

ALTER TABLE  `dsc_goods` ADD  `commission_rate` VARCHAR( 10 ) NOT NULL DEFAULT '0';

ALTER TABLE  `dsc_cart` ADD  `commission_rate` VARCHAR( 10 ) NOT NULL DEFAULT '0';

ALTER TABLE  `dsc_order_goods` ADD  `commission_rate` VARCHAR( 10 ) NOT NULL DEFAULT '0';

ALTER TABLE  `dsc_cart_combo` ADD  `commission_rate` VARCHAR( 10 ) NOT NULL DEFAULT '0';

ALTER TABLE  `dsc_seller_bill_goods` ADD  `commission_rate` VARCHAR( 10 ) NOT NULL DEFAULT '0';

ALTER TABLE `dsc_pay_card_type` CHANGE `type_money` `type_money` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT '0.00';

ALTER TABLE `dsc_user_address` ADD `userUp_time` VARCHAR( 120 ) AFTER `audit`;

ALTER TABLE `dsc_order_info` ADD `is_update_sale` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_seller_commission_bill` ADD `actual_amount` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '实结金额（账单结束）' AFTER `should_amount` ;

ALTER TABLE `dsc_users_vat_invoices_info` ADD `country` int(10) unsigned NOT NULL DEFAULT '0';

ALTER TABLE `dsc_users_vat_invoices_info` ADD `province` int(10) unsigned NOT NULL DEFAULT '0'; 

ALTER TABLE `dsc_users_vat_invoices_info` ADD `city` int(10) unsigned NOT NULL DEFAULT '0';

ALTER TABLE `dsc_users_vat_invoices_info` ADD `district` int(10) unsigned NOT NULL DEFAULT '0';

ALTER TABLE `dsc_users_vat_invoices_info` DROP `consignee_province`;

ALTER TABLE  `dsc_warehouse_goods` CHANGE  `give_integral`  `give_integral` INT( 10 ) NOT NULL DEFAULT  '0';

ALTER TABLE  `dsc_warehouse_goods` CHANGE  `rank_integral`  `rank_integral` INT( 10 ) NOT NULL DEFAULT  '0';