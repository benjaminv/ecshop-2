ALTER TABLE  `dsc_goods` ADD  `cloud_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `product_promote_price`;

ALTER TABLE  `dsc_attribute` ADD  `cloud_attr_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `attr_input_category`;

ALTER TABLE  `dsc_goods_attr` ADD  `cloud_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `admin_id`;

ALTER TABLE  `dsc_products` ADD  `cloud_product_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `admin_id`;

ALTER TABLE  `dsc_products` ADD  `inventoryid` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `cloud_product_id`;

ALTER TABLE  `dsc_goods` ADD  `cloud_goodsname` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER  `cloud_id`;

CREATE TABLE IF NOT EXISTS `dsc_order_cloud` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `apiordersn` varchar(255) NOT NULL,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `totalprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rec_id` int(10) unsigned NOT NULL DEFAULT '0',
  `parentordersn` varchar(255) NOT NULL,
  `cloud_orderid` int(10) unsigned NOT NULL DEFAULT '0',
  `cloud_detailed_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE  `dsc_order_return_extend` ADD  `aftersn` VARCHAR( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER  `return_number`;

ALTER TABLE  `dsc_entry_criteria` ADD  `data_type` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `option_value`;

ALTER TABLE  `dsc_article` ADD  `sort_order` SMALLINT( 8 ) UNSIGNED NOT NULL DEFAULT  '50' AFTER  `description`;

ALTER TABLE  `dsc_discuss_circle` ADD  `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  '1' AFTER  `dis_browse_num` ,
ADD  `review_content` VARCHAR( 1000 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER  `review_status`;

ALTER TABLE  `dsc_goods` ADD  `is_show` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  '1' AFTER  `product_price`;