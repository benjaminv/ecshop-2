ALTER TABLE `dsc_shop_config` ADD `shop_group` VARCHAR( 250 ) NOT NULL AFTER `sort_order` ;

ALTER TABLE `dsc_order_info` ADD `confirm_take_time` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `shipping_time`;

ALTER TABLE `dsc_merchants_shop_information` ADD INDEX `merchants_audit` ( `merchants_audit` ) ;

ALTER TABLE `dsc_merchants_shop_information` ADD INDEX `is_street` ( `is_street` ) ;

ALTER TABLE `dsc_snatch_log`
MODIFY COLUMN `log_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT FIRST ,
MODIFY COLUMN `snatch_id`  int(10) UNSIGNED NOT NULL DEFAULT 0 AFTER `log_id`,
MODIFY COLUMN `user_id`  int(10) UNSIGNED NOT NULL DEFAULT 0 AFTER `snatch_id`;
