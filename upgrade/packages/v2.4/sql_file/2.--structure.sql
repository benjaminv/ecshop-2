ALTER TABLE `dsc_admin_user` CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_goods_transport_tpl` ADD `admin_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `configure`, ADD INDEX `admin_id` (`admin_id`);

ALTER TABLE `dsc_goods_transport` ADD `free_money` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00' AFTER `title` ;

ALTER TABLE `dsc_goods_transport` ADD `shipping_title` VARCHAR(255) NOT NULL AFTER `title`;

ALTER TABLE `dsc_products` ADD `product_promote_price` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00' AFTER `product_price`;

ALTER TABLE `dsc_products_area` ADD `product_promote_price` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00' AFTER `product_price`;

ALTER TABLE `dsc_products_warehouse` ADD `product_promote_price` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00' AFTER `product_price`;

ALTER TABLE `dsc_goods` ADD `product_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品默认勾选属性货品' AFTER `user_brand`;

ALTER TABLE `dsc_goods` ADD `product_price` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '商品默认勾选属性货品价格' AFTER `product_id`;

ALTER TABLE `dsc_goods` ADD `product_promote_price` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00' AFTER `product_price`;

ALTER TABLE `dsc_goods` ADD `product_table` VARCHAR(60) NOT NULL DEFAULT 'products' AFTER `user_brand`;

ALTER TABLE `dsc_products` CHANGE `goods_attr` `goods_attr` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `dsc_products_area` CHANGE `goods_attr` `goods_attr` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `dsc_products_warehouse` CHANGE `goods_attr` `goods_attr` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `dsc_goods_transport_tpl` ADD `tpl_name` VARCHAR(255) NOT NULL AFTER `id`;

CREATE TABLE IF NOT EXISTS `dsc_coupons_region` (
  `cf_id` int(10) NOT NULL AUTO_INCREMENT,
  `cou_id` int(10) unsigned NOT NULL DEFAULT '0',
  `region_list` varchar(255) NOT NULL,
  PRIMARY KEY (`cf_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `dsc_order_info` ADD `uc_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `coupons`, ADD INDEX `uc_id` (`uc_id`);

ALTER TABLE  `dsc_seckill` ADD  `ru_id` INT( 10 ) UNSIGNED NOT NULL COMMENT  '商家ID' AFTER  `sec_id`;

ALTER TABLE  `dsc_seckill` ADD  `review_status` TINYINT( 1 ) NOT NULL DEFAULT '1' COMMENT  '审核状态';

ALTER TABLE `dsc_goods_transport_tpl` CHANGE `region_id` `region_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `dsc_coupons_region` CHANGE `region_list` `region_list` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `dsc_admin_message` CHANGE `message_id` `message_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_admin_user` CHANGE `agency_id` `agency_id` INT(10) UNSIGNED NOT NULL, CHANGE `suppliers_id` `suppliers_id` INT(10) UNSIGNED NULL DEFAULT '0';

ALTER TABLE `dsc_affiliate_log` CHANGE `log_id` `log_id` INT(10) NOT NULL AUTO_INCREMENT, CHANGE `order_id` `order_id` INT(10) NOT NULL, CHANGE `user_id` `user_id` INT(10) NOT NULL;

ALTER TABLE `dsc_agency` CHANGE `agency_id` `agency_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_article` CHANGE `article_id` `article_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_article_cat` CHANGE `cat_id` `cat_id` MEDIUMINT(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_article` CHANGE `cat_id` `cat_id` MEDIUMINT(8) NOT NULL DEFAULT '0';

ALTER TABLE `dsc_attribute` CHANGE `attr_input_category` `attr_input_category` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `dsc_auction_log` CHANGE `log_id` `log_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, CHANGE `act_id` `act_id` INT(10) UNSIGNED NOT NULL, CHANGE `bid_user` `bid_user` INT(10) UNSIGNED NOT NULL;

ALTER TABLE `dsc_back_goods` CHANGE `send_number` `send_number` INT(10) UNSIGNED NULL DEFAULT '0';

ALTER TABLE `dsc_back_order` CHANGE `back_id` `back_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `delivery_sn` `delivery_sn` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
CHANGE `order_sn` `order_sn` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
CHANGE `order_id` `order_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `user_id` `user_id` INT(10) UNSIGNED NULL DEFAULT '0', 
CHANGE `country` `country` INT(10) UNSIGNED NULL DEFAULT '0', 
CHANGE `province` `province` INT(10) UNSIGNED NULL DEFAULT '0', 
CHANGE `city` `city` INT(10) UNSIGNED NULL DEFAULT '0', 
CHANGE `district` `district` INT(10) UNSIGNED NULL DEFAULT '0', 
CHANGE `agency_id` `agency_id` INT(10) UNSIGNED NULL DEFAULT '0';

ALTER TABLE `dsc_baitiao` CHANGE `baitiao_id` `baitiao_id` INT(10) NOT NULL AUTO_INCREMENT, 
CHANGE `user_id` `user_id` INT(10) NOT NULL COMMENT '用户id', 
CHANGE `over_repay_trem` `over_repay_trem` INT(10) NOT NULL DEFAULT '0' COMMENT '超过还款期限的天数';

ALTER TABLE `dsc_baitiao` CHANGE `amount` `amount` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '白条金额';

ALTER TABLE `dsc_baitiao_log` CHANGE `log_id` `log_id` INT(10) NOT NULL AUTO_INCREMENT, 
CHANGE `baitiao_id` `baitiao_id` INT(10) NOT NULL COMMENT '白条id', 
CHANGE `user_id` `user_id` INT(10) NOT NULL COMMENT '用户id', 
CHANGE `order_id` `order_id` INT(10) NOT NULL COMMENT '订单id';

ALTER TABLE `dsc_bonus_type` CHANGE `type_id` `type_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_booking_goods` CHANGE `rec_id` `rec_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_number` `goods_number` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_brand` CHANGE `brand_id` `brand_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_cart` CHANGE `take_time` `take_time` DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00';

ALTER TABLE `dsc_cart` CHANGE `rec_id` `rec_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_number` `goods_number` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `is_gift` `is_gift` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_cart_combo` CHANGE `rec_id` `rec_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `product_id` `product_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `is_gift` `is_gift` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_goods_type` CHANGE `cat_id` `cat_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_goods_type_cat` CHANGE `cat_id` `cat_id` INT(10) NOT NULL AUTO_INCREMENT, 
CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `sort_order` `sort_order` INT(10) UNSIGNED NOT NULL DEFAULT '50';

ALTER TABLE `dsc_goods_cat` CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `cat_id` `cat_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_group_goods` CHANGE `id` `id` INT(10) NOT NULL AUTO_INCREMENT, 
CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_goods_transport` CHANGE `tid` `tid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_goods_transport_express` CHANGE `tid` `tid` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_goods_transport_extend` CHANGE `tid` `tid` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_goods_transport_tpl` CHANGE `id` `id` INT(10) NOT NULL AUTO_INCREMENT, 
CHANGE `tid` `tid` INT(10) NOT NULL DEFAULT '0', 
CHANGE `user_id` `user_id` INT(10) NOT NULL DEFAULT '0', 
CHANGE `shipping_id` `shipping_id` INT(10) NOT NULL DEFAULT '0';

ALTER TABLE `dsc_link_area_goods` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `region_id` `region_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_link_goods` CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `link_goods_id` `link_goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_return_goods` CHANGE `rec_id` `rec_id` INT(10) UNSIGNED NOT NULL, 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `product_id` `product_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_return_action` CHANGE `action_id` `action_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `ret_id` `ret_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `log_time` `log_time` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_return_images` CHANGE `id` `id` INT(10) NOT NULL AUTO_INCREMENT, 
CHANGE `rg_id` `rg_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `rec_id` `rec_id` INT(10) NOT NULL, 
CHANGE `user_id` `user_id` INT(10) NOT NULL, CHANGE `add_time` `add_time` INT(10) NOT NULL;

ALTER TABLE `dsc_order_return` CHANGE `order_id` `order_id` INT(10) NOT NULL COMMENT '所属订单号', 
CHANGE `country` `country` INT(10) NOT NULL COMMENT '国家', 
CHANGE `province` `province` INT(10) NOT NULL COMMENT '省份', 
CHANGE `city` `city` INT(10) NOT NULL COMMENT '城市', 
CHANGE `district` `district` INT(10) NOT NULL COMMENT '区', 
CHANGE `street` `street` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_order_info` CHANGE `order_id` `order_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `main_order_id` `main_order_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `country` `country` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `province` `province` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `city` `city` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `district` `district` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `street` `street` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `bonus_id` `bonus_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `extension_id` `extension_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `agency_id` `agency_id` INT(10) UNSIGNED NOT NULL, 
CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `is_zc_order` `is_zc_order` INT(10) NULL DEFAULT '0', 
CHANGE `zc_goods_id` `zc_goods_id` INT(10) NOT NULL, 
CHANGE `vat_id` `vat_id` INT(10) NOT NULL DEFAULT '0' COMMENT '增值税发票信息ID 关联 users_vat_invoices_info表自增ID';

ALTER TABLE `dsc_order_action` CHANGE `action_id` `action_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `order_id` `order_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `log_time` `log_time` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_shipping` ADD `send_site` VARCHAR(50) NOT NULL AFTER `customer_pwd`;

ALTER TABLE `dsc_shipping` ADD `month_code` VARCHAR(50) NOT NULL AFTER `customer_pwd`;

ALTER TABLE `dsc_link_goods_desc` ADD `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `goods_id`, ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_link_desc_temporary` ADD `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `goods_id`, ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_link_goods_desc` ADD `review_status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' AFTER `goods_desc`, ADD INDEX `review_status` (`review_status`);

ALTER TABLE `dsc_link_goods_desc` ADD `review_content` VARCHAR(255) NOT NULL AFTER `review_status`;