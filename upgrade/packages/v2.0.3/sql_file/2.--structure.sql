ALTER TABLE  `dsc_order_info` ADD  `cost_amount` DECIMAL( 10, 2 ) NOT NULL DEFAULT  '0.00' COMMENT  '订单成本' AFTER  `goods_amount`;

ALTER TABLE  `dsc_goods` ADD  `cost_price` DECIMAL( 10, 2 ) NOT NULL DEFAULT  '0.00' COMMENT  '成本价' AFTER  `market_price`;

CREATE TABLE IF NOT EXISTS `dsc_goods_change_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增日志ID',
  `goods_id` mediumint(8) NOT NULL COMMENT '商品ID',
  `shop_price` decimal(10,2) NOT NULL COMMENT '本店价',
  `shipping_fee` decimal(10,2) NOT NULL COMMENT '运费',
  `promote_price` decimal(10,2) NOT NULL COMMENT '促销价',
  `member_price` varchar(255) NOT NULL COMMENT '会员价',
  `volume_price` varchar(255) NOT NULL COMMENT '阶梯价',
  `give_integral` int(11) NOT NULL COMMENT '赠送消费积分',
  `rank_integral` int(11) NOT NULL COMMENT '赠送等级积分',
  `goods_weight` decimal(10,3) NOT NULL COMMENT '商品重量',
  `is_on_sale` tinyint(1) NOT NULL COMMENT '上下架',
  `user_id` int(11) NOT NULL COMMENT '操作者ID',
  `handle_time` int(11) NOT NULL COMMENT '操作时间',
  `old_record` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '原纪录',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

ALTER TABLE `dsc_goods_attr` CHANGE `attr_price` `attr_price` DECIMAL( 10, 2 ) NOT NULL DEFAULT '0.00';

ALTER TABLE  `dsc_brand` ADD  `brand_first_char` CHAR( 1 ) NOT NULL AFTER  `brand_letter`;

ALTER TABLE `dsc_products` ADD `admin_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `product_warn_number` ,
ADD INDEX ( `admin_id` ) ;

ALTER TABLE `dsc_goods_attr` ADD INDEX `admin_id` ( `admin_id` ) ;

ALTER TABLE `dsc_products_area` ADD `admin_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '10' AFTER `area_id` ,
ADD INDEX ( `admin_id` ) ;

ALTER TABLE `dsc_products_warehouse` ADD `admin_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `warehouse_id` ,
ADD INDEX ( `admin_id` ) ;

ALTER TABLE `dsc_warehouse_attr` ADD `admin_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `attr_price` ,
ADD INDEX ( `admin_id` ) ;

ALTER TABLE `dsc_warehouse_area_attr` ADD `admin_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `attr_price` ,
ADD INDEX ( `admin_id` ) ;

ALTER TABLE  `dsc_goods` ADD  `goods_tag` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT  '商品标签' AFTER  `goods_product_tag`;