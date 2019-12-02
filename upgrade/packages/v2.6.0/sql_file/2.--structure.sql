ALTER TABLE `dsc_merchants_shop_information` ADD `add_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `shop_close`;

ALTER TABLE `dsc_warehouse_area_goods` ADD `city_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `region_id` ,
ADD INDEX ( `city_id` ) ;

ALTER TABLE `dsc_products_area` ADD `city_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `area_id` ,
ADD INDEX ( `city_id` ) ;

ALTER TABLE `dsc_products_changelog` ADD `city_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `area_id` ,
ADD INDEX ( `city_id` ) ;

ALTER TABLE `dsc_order_goods`
ADD `product_sn`  varchar(60) NULL COMMENT '商品规格货号' AFTER `stages_qishu`;


ALTER TABLE `dsc_order_goods`
ADD `is_reality`  int(1) NULL DEFAULT -1 COMMENT '正品保证' AFTER `product_sn`,
ADD `is_return`  int(1) NULL DEFAULT -1 COMMENT '包退服务' AFTER `is_reality`,
ADD `is_fast`  int(1) NULL DEFAULT -1 COMMENT '闪速配送' AFTER `is_return`;

DROP TABLE IF EXISTS `dsc_store_back_order`;
CREATE TABLE IF NOT EXISTS `dsc_store_back_order` (
`id`  int(20) NOT NULL AUTO_INCREMENT ,
`store_id`  int(20) NOT NULL ,
`order_id`  int(20) NOT NULL ,
PRIMARY KEY (`id`)
);

ALTER TABLE `dsc_pay_log` CHANGE `order_id`  varchar(100) NOT NULL DEFAULT 0 AFTER `log_id`;