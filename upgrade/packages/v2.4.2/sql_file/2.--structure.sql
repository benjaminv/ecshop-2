CREATE TABLE IF NOT EXISTS `dsc_region_store` (
  `rs_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rs_name` varchar(50) NOT NULL,
  PRIMARY KEY (`rs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dsc_rs_region` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rs_id` int(10) unsigned NOT NULL DEFAULT '0',
  `region_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  
ALTER TABLE `dsc_admin_user` ADD `rs_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `ru_id`;

ALTER TABLE `dsc_merchants_shop_information` ADD `region_id` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0' AFTER `user_id`;

CREATE TABLE IF NOT EXISTS `dsc_home_templates` (
  `temp_id` int(10) NOT NULL AUTO_INCREMENT,
  `rs_id` int(10) unsigned NOT NULL DEFAULT '0',
  `code` varchar(60) NOT NULL,
  `is_enable` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `theme` varchar(160) NOT NULL,
  PRIMARY KEY (`temp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE  `dsc_favourable_activity` ADD  `userFav_type_ext` VARCHAR( 255 ) NOT NULL COMMENT  '使用类型扩展' AFTER  `userFav_type`;
ALTER TABLE  `dsc_favourable_activity` ADD  `rs_id` int(10) NOT NULL COMMENT  '卖场ID' AFTER  `user_id`;

CREATE TABLE IF NOT EXISTS `dsc_seckill_goods_remind` (
  `r_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增秒杀提醒ID',
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `sec_goods_id` int(10) NOT NULL COMMENT '秒杀商品ID',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='秒杀商品提醒关联表' AUTO_INCREMENT=1 ;

ALTER TABLE  `dsc_search_keyword` ADD  `result_count` INT( 32 ) UNSIGNED NOT NULL DEFAULT  '0';
--
-- 分割线
--

ALTER TABLE `dsc_cart` CHANGE `stages_qishu` `stages_qishu` MEDIUMINT(5) NOT NULL DEFAULT '-1' COMMENT '用户选择的当前商品的分期期数 -1:不分期';

ALTER TABLE `dsc_order_goods` ADD `stages_qishu` MEDIUMINT(5) NOT NULL DEFAULT '-1' COMMENT '用户选择的当前商品的分期期数 -1:不分期' AFTER `commission_rate`, ADD INDEX (`stages_qishu`);

ALTER TABLE `dsc_order_goods` CHANGE `rec_id` `rec_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `order_id` `order_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `product_id` `product_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `is_gift` `is_gift` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `warehouse_id` `warehouse_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `area_id` `area_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `is_distribution` `is_distribution` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品是否参与分销';

ALTER TABLE `dsc_cart` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_cart` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_cart` ADD INDEX `product_id` (`product_id`);

ALTER TABLE `dsc_cart` ADD INDEX `is_real` (`is_real`);

ALTER TABLE `dsc_cart` ADD INDEX `parent_id` (`parent_id`);

ALTER TABLE `dsc_cart` ADD INDEX `is_shipping` (`is_shipping`);

ALTER TABLE `dsc_cart` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_cart` ADD INDEX `store_id` (`store_id`);

ALTER TABLE `dsc_cart` ADD INDEX `freight` (`freight`);

ALTER TABLE `dsc_cart` ADD INDEX `tid` (`tid`);

ALTER TABLE `dsc_cart` ADD INDEX `is_checked` (`is_checked`);

ALTER TABLE `dsc_cart` ADD INDEX `warehouse_id` (`warehouse_id`);

ALTER TABLE `dsc_cart` ADD INDEX `area_id` (`area_id`);

ALTER TABLE `dsc_cart` CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `warehouse_id` `warehouse_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `area_id` `area_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_seller_shopinfo` CHANGE `seller_money` `seller_money` DECIMAL(10,2) NOT NULL DEFAULT '0.00', 
CHANGE `frozen_money` `frozen_money` DECIMAL(10,2) NOT NULL DEFAULT '0.00';

ALTER TABLE `dsc_order_return` CHANGE `apply_time` `apply_time` INT(10) NOT NULL DEFAULT '0' COMMENT '退换货申请时间', 
CHANGE `return_time` `return_time` INT(10) NOT NULL DEFAULT '0' COMMENT '退换货时间';

ALTER TABLE `dsc_seller_shopinfo` ADD `credit_money` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00' AFTER `frozen_money`;

ALTER TABLE `dsc_merchants_shop_information` ADD `shop_close` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否关闭店铺（0：关闭，1：开启）' AFTER `self_run`, ADD INDEX `shop_close` (`shop_close`);

ALTER TABLE `dsc_seller_shopinfo` CHANGE `status` `shop_close` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '是否关闭店铺（0：关闭，1：开启）';

ALTER TABLE `dsc_order_goods` ADD `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '会员ID' AFTER `order_id`, ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_order_goods` ADD `cart_recid` TEXT NOT NULL AFTER `user_id`;

ALTER TABLE `dsc_seller_domain` CHANGE `id` `id` INT(10) NOT NULL AUTO_INCREMENT, 
CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `validity_time` `validity_time` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_comment` ADD INDEX `status` (`status`);

ALTER TABLE `dsc_comment` CHANGE `id_value` `id_value` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `single_id` `single_id` INT(10) UNSIGNED NULL DEFAULT '0', 
CHANGE `order_id` `order_id` INT(10) UNSIGNED NULL DEFAULT '0', 
CHANGE `dis_id` `dis_id` INT(10) UNSIGNED NULL DEFAULT '0';

CREATE TABLE IF NOT EXISTS `dsc_products_changelog` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_attr` varchar(50) NOT NULL,
  `product_sn` varchar(60) NOT NULL,
  `bar_code` varchar(60) NOT NULL,
  `product_number` int(10) unsigned NOT NULL DEFAULT '0',
  `product_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `product_market_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `product_promote_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `product_warn_number` int(10) unsigned NOT NULL DEFAULT '0',
  `warehouse_id` int(11) unsigned NOT NULL DEFAULT '0',
  `area_id` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `dsc_seller_bill_goods` ADD `dis_amount` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '商品单品满减优惠金额' AFTER `goods_price`;

ALTER TABLE `dsc_ad_position` ADD INDEX `theme` (`theme`);
ALTER TABLE `dsc_ad` ADD INDEX `ad_name` (`ad_name`);
ALTER TABLE `dsc_ad` ADD INDEX `media_type` (`media_type`);
ALTER TABLE `dsc_ad` ADD INDEX `start_time` (`start_time`);
ALTER TABLE `dsc_ad` ADD INDEX `end_time` (`end_time`);

ALTER TABLE `dsc_presale_activity` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_warehouse_area_goods` ADD INDEX `region_id` (`region_id`);

ALTER TABLE `dsc_presale_activity` ADD INDEX `goods_name` (`goods_name`);

ALTER TABLE `dsc_presale_activity` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_presale_activity` ADD INDEX `cat_id` (`cat_id`);

ALTER TABLE `dsc_user_gift_gard` CHANGE `gift_gard_id` `gift_gard_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
CHANGE `user_id` `user_id` INT(10) UNSIGNED NULL DEFAULT '0', 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NULL DEFAULT '0', 
CHANGE `user_time` `user_time` INT(10) UNSIGNED NULL DEFAULT '0';

ALTER TABLE `dsc_user_feed` CHANGE `feed_id` `feed_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `value_id` `value_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_user_bank` CHANGE `id` `id` INT(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_user_bonus` CHANGE `bonus_id` `bonus_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `user_id` `user_id` INT(8) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `order_id` `order_id` INT(8) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_user_account_fields` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '关联用户id', 
CHANGE `account_id` `account_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '关联ecs_user_account表id';

ALTER TABLE `dsc_user_account` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_users_vat_invoices_info` CHANGE `id` `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID', 
CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID', 
CHANGE `add_time` `add_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '添加时间';

ALTER TABLE `dsc_users_paypwd` CHANGE `paypwd_id` `paypwd_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_trade_snapshot` CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_number` `goods_number` INT(5) UNSIGNED NOT NULL DEFAULT '1', 
CHANGE `add_time` `add_time` INT(11) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `ru_id` `ru_id` INT(11) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_store_products` CHANGE `product_id` `product_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `product_number` `product_number` INT(10) UNSIGNED NULL DEFAULT '0', 
CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `store_id` `store_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_store_order` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `order_id` `order_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `store_id` `store_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_store_goods` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `store_id` `store_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_number` `goods_number` int(10) UNSIGNED NOT NULL DEFAULT '1';

ALTER TABLE `dsc_store_action` CHANGE `action_id` `action_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_shipping_tpl` CHANGE `st_id` `st_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `shipping_id` `shipping_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_shipping_area` CHANGE `shipping_area_id` `shipping_area_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
CHANGE `shipping_id` `shipping_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_shipping` CHANGE `shipping_id` `shipping_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_seller_template_apply` CHANGE `temp_id` `temp_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `pay_id` `pay_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_seckill_goods_remind` CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID', 
CHANGE `sec_goods_id` `sec_goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '秒杀商品ID', 
CHANGE `add_time` `add_time` INT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '添加时间';

ALTER TABLE `dsc_seckill_goods` CHANGE `sec_id` `sec_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `tb_id` `tb_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '秒杀时段ID', 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_reg_extend_info` CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_warehouse_area_attr` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_warehouse_area_attr` ADD INDEX `goods_attr_id` (`goods_attr_id`);

ALTER TABLE `dsc_warehouse_area_attr` ADD INDEX `area_id` (`area_id`);

ALTER TABLE `dsc_warehouse_attr` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_warehouse_attr` ADD INDEX `goods_attr_id` (`goods_attr_id`);

ALTER TABLE `dsc_warehouse_attr` ADD INDEX `warehouse_id` (`warehouse_id`);

ALTER TABLE `dsc_warehouse_freight` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_warehouse_freight` ADD INDEX `warehouse_id` (`warehouse_id`);

ALTER TABLE `dsc_warehouse_freight` ADD INDEX `shipping_id` (`shipping_id`);

ALTER TABLE `dsc_warehouse_freight` ADD INDEX `region_id` (`region_id`);

ALTER TABLE `dsc_warehouse_freight_tpl` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_warehouse_freight_tpl` ADD INDEX `warehouse_id` (`warehouse_id`);

ALTER TABLE `dsc_warehouse_freight_tpl` ADD INDEX `shipping_id` (`shipping_id`);

ALTER TABLE `dsc_warehouse_freight_tpl` ADD INDEX `region_id` (`region_id`);

ALTER TABLE `dsc_virtual_card` ADD INDEX `add_date` (`add_date`);

ALTER TABLE `dsc_virtual_card` ADD INDEX `end_date` (`end_date`);

ALTER TABLE `dsc_virtual_card` ADD INDEX `order_sn` (`order_sn`);

ALTER TABLE `dsc_value_card_type` ADD INDEX `use_condition` (`use_condition`);

ALTER TABLE `dsc_value_card_type` ADD INDEX `is_rec` (`is_rec`);

ALTER TABLE `dsc_value_card_type` ADD INDEX `vc_indate` (`vc_indate`);

ALTER TABLE `dsc_value_card_record` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_value_card` ADD INDEX `tid` (`tid`);

ALTER TABLE `dsc_value_card` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_user_gift_gard` ADD INDEX `gift_sn` (`gift_sn`);

ALTER TABLE `dsc_user_gift_gard` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_user_gift_gard` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_user_gift_gard` ADD INDEX `gift_id` (`gift_id`);

ALTER TABLE `dsc_user_gift_gard` ADD INDEX `is_delete` (`is_delete`);

ALTER TABLE `dsc_user_feed` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_user_feed` ADD INDEX `vaule_id` (`value_id`);

ALTER TABLE `dsc_user_feed` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_user_bonus` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_user_bonus` ADD INDEX `emailed` (`emailed`);

ALTER TABLE `dsc_user_bank` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_user_account_fields` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_user_account_fields` ADD INDEX `account_id` (`account_id`);

ALTER TABLE `dsc_user_account` DROP INDEX `payment_id`, ADD INDEX `pay_id` (`pay_id`) USING BTREE;

ALTER TABLE `dsc_users_vat_invoices_info` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_users_vat_invoices_info` ADD INDEX `audit_status` (`audit_status`);

ALTER TABLE `dsc_users_paypwd` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_users_log` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_users_log` ADD INDEX `admin_id` (`admin_id`);

ALTER TABLE `dsc_users_auth` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_users_auth` ADD INDEX `user_name` (`user_name`);

ALTER TABLE `dsc_users` ADD INDEX `is_validated` (`is_validated`);

ALTER TABLE `dsc_trade_snapshot` ADD INDEX `order_sn` (`order_sn`);

ALTER TABLE `dsc_trade_snapshot` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_trade_snapshot` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_trade_snapshot` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_suppliers` ADD INDEX `is_check` (`is_check`);

ALTER TABLE `dsc_store_user` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_store_user` ADD INDEX `store_id` (`store_id`);

ALTER TABLE `dsc_store_user` ADD INDEX `parent_id` (`parent_id`);

ALTER TABLE `dsc_store_user` ADD INDEX `ec_salt` (`ec_salt`);

ALTER TABLE `dsc_store_products` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_store_products` ADD INDEX `store_id` (`store_id`);

ALTER TABLE `dsc_store_order` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_store_order` ADD INDEX `store_id` (`store_id`);

ALTER TABLE `dsc_store_order` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_store_goods` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_store_goods` ADD INDEX `store_id` (`store_id`);

ALTER TABLE `dsc_store_goods` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_store_action` ADD INDEX `parent_id` (`parent_id`);

ALTER TABLE `dsc_snatch_log` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_single` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_single` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_single` ADD INDEX `comment_id` (`comment_id`);

ALTER TABLE `dsc_single` ADD INDEX `cat_id` (`cat_id`);

ALTER TABLE `dsc_shipping_tpl` ADD INDEX `shipping_id` (`shipping_id`);

ALTER TABLE `dsc_shipping_tpl` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_shipping_point` ADD INDEX `shipping_area_id` (`shipping_area_id`);

ALTER TABLE `dsc_seller_template_apply` ADD INDEX `apply_sn` (`apply_sn`);

ALTER TABLE `dsc_seller_template_apply` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_seller_template_apply` ADD INDEX `temp_id` (`temp_id`);

ALTER TABLE `dsc_seller_template_apply` ADD INDEX `pay_id` (`pay_id`);

ALTER TABLE `dsc_seller_shopinfo` ADD INDEX `shipping_id` (`shipping_id`);

ALTER TABLE `dsc_seller_qrcode` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_seller_domain` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_seller_commission_bill` ADD INDEX `bill_sn` (`bill_sn`);

ALTER TABLE `dsc_seller_commission_bill` ADD INDEX `chargeoff_time` (`chargeoff_time`);

ALTER TABLE `dsc_seller_commission_bill` ADD INDEX `start_time` (`start_time`);

ALTER TABLE `dsc_seller_commission_bill` ADD INDEX `end_time` (`end_time`);

ALTER TABLE `dsc_seller_commission_bill` ADD INDEX `chargeoff_status` (`chargeoff_status`);

ALTER TABLE `dsc_seller_commission_bill` ADD INDEX `bill_apply` (`bill_apply`);

ALTER TABLE `dsc_seller_bill_order` ADD INDEX `order_status` (`order_status`);

ALTER TABLE `dsc_seller_bill_order` ADD INDEX `shipping_status` (`shipping_status`);

ALTER TABLE `dsc_seller_bill_order` ADD INDEX `pay_status` (`pay_status`);

ALTER TABLE `dsc_seller_bill_order` ADD INDEX `chargeoff_status` (`chargeoff_status`);

ALTER TABLE `dsc_seller_bill_order` ADD INDEX `confirm_take_time` (`confirm_take_time`);

ALTER TABLE `dsc_seller_apply_info` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_seller_apply_info` ADD INDEX `grade_id` (`grade_id`);

ALTER TABLE `dsc_seller_apply_info` ADD INDEX `apply_sn` (`apply_sn`);

ALTER TABLE `dsc_seller_apply_info` ADD INDEX `pay_status` (`pay_status`);

ALTER TABLE `dsc_seller_apply_info` ADD INDEX `apply_status` (`apply_status`);

ALTER TABLE `dsc_seller_apply_info` ADD INDEX `pay_id` (`pay_id`);

ALTER TABLE `dsc_seller_apply_info` ADD INDEX `is_paid` (`is_paid`);

ALTER TABLE `dsc_seckill_goods_remind` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_seckill_goods_remind` ADD INDEX `sec_goods_id` (`sec_goods_id`);

ALTER TABLE `dsc_seckill_goods` ADD INDEX `sec_id` (`sec_id`);

ALTER TABLE `dsc_seckill_goods` ADD INDEX `tb_id` (`tb_id`);

ALTER TABLE `dsc_seckill_goods` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_seckill` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_seckill` ADD INDEX `review_status` (`review_status`);

ALTER TABLE `dsc_rs_region` ADD INDEX `rs_id` (`rs_id`);

ALTER TABLE `dsc_rs_region` ADD INDEX `region_id` (`region_id`);

ALTER TABLE `dsc_return_goods` ADD INDEX `product_id` (`product_id`);

ALTER TABLE `dsc_return_action` DROP INDEX `order_id`, ADD INDEX `ret_id` (`ret_id`) USING BTREE;

ALTER TABLE `dsc_reg_extend_info` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_products_warehouse` ADD INDEX `warehouse_id` (`warehouse_id`);

ALTER TABLE `dsc_products_area` ADD INDEX `area_id` (`area_id`);

ALTER TABLE `dsc_products_changelog` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_products_changelog` ADD INDEX `warehouse_id` (`warehouse_id`);

ALTER TABLE `dsc_products_changelog` ADD INDEX `area_id` (`area_id`);

ALTER TABLE `dsc_products_changelog` ADD INDEX `admin_id` (`admin_id`);

ALTER TABLE `dsc_presale_cat` ADD INDEX `cat_name` (`cat_name`);

ALTER TABLE `dsc_presale_activity` ADD INDEX `start_time` (`start_time`);

ALTER TABLE `dsc_presale_activity` ADD INDEX `end_time` (`end_time`);

ALTER TABLE `dsc_pic_album` ADD INDEX `album_id` (`album_id`);

ALTER TABLE `dsc_pic_album` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_pay_log` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_pay_log` ADD INDEX `is_paid` (`is_paid`);

-----------------------------------------------------------------------------

ALTER TABLE `dsc_package_goods` CHANGE `package_id` `package_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `product_id` `product_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `goods_number` `goods_number` INT(10) UNSIGNED NOT NULL DEFAULT '1';

ALTER TABLE `dsc_goods_inventory_logs` CHANGE `warehouse_id` `warehouse_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `area_id` `area_id` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `suppliers_id` `suppliers_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_cart_combo` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_cart_combo` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_cart_combo` ADD INDEX `product_id` (`product_id`);

ALTER TABLE `dsc_cart_combo` ADD INDEX `group_id` (`group_id`);

ALTER TABLE `dsc_cart_combo` ADD INDEX `is_real` (`is_real`);

ALTER TABLE `dsc_cart_combo` ADD INDEX `extension_code` (`extension_code`);

ALTER TABLE `dsc_cart_combo` ADD INDEX `parent_id` (`parent_id`);

ALTER TABLE `dsc_cart_combo` ADD INDEX `is_gift` (`is_gift`);

ALTER TABLE `dsc_cart_combo` ADD INDEX `warehouse_id` (`warehouse_id`);

ALTER TABLE `dsc_cart_combo` ADD INDEX `area_id` (`area_id`);

ALTER TABLE `dsc_cart_combo` ADD INDEX `model_attr` (`model_attr`);

ALTER TABLE `dsc_cart_combo` CHANGE `goods_number` `goods_number` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_cart` ADD INDEX `is_gift` (`is_gift`);

ALTER TABLE `dsc_cart` ADD INDEX `rec_type` (`rec_type`);

ALTER TABLE `dsc_pay_card` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_payment` ADD INDEX `is_online` (`is_online`);

ALTER TABLE `dsc_oss_configure` ADD INDEX `is_use` (`is_use`);

ALTER TABLE `dsc_order_return_extend` ADD INDEX `ret_id` (`ret_id`);

ALTER TABLE `dsc_order_return` ADD INDEX `return_sn` (`return_sn`);

ALTER TABLE `dsc_order_invoice` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_order_invoice` ADD INDEX `tax_id` (`tax_id`);

ALTER TABLE `dsc_order_info` ADD INDEX `parent_id` (`parent_id`);

ALTER TABLE `dsc_order_info` ADD INDEX `supplier_id` (`supplier_id`);

ALTER TABLE `dsc_order_info` ADD INDEX `is_zc_order` (`is_zc_order`);

ALTER TABLE `dsc_order_info` ADD INDEX `zc_goods_id` (`zc_goods_id`);

ALTER TABLE `dsc_order_info` ADD INDEX `chargeoff_status` (`chargeoff_status`);

ALTER TABLE `dsc_order_goods` ADD INDEX `product_id` (`product_id`);

ALTER TABLE `dsc_order_goods` ADD INDEX `is_real` (`is_real`);

ALTER TABLE `dsc_order_goods` ADD INDEX `warehouse_id` (`warehouse_id`);

ALTER TABLE `dsc_order_goods` ADD INDEX `area_id` (`area_id`);

ALTER TABLE `dsc_order_goods` ADD INDEX `is_gift` (`is_gift`);

ALTER TABLE `dsc_order_goods` CHANGE `goods_attr_id` `goods_attr_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `dsc_order_action` ADD INDEX `action_user` (`action_user`);

ALTER TABLE `dsc_order_action` ADD INDEX `order_status` (`order_status`);

ALTER TABLE `dsc_order_action` ADD INDEX `shipping_status` (`shipping_status`);

ALTER TABLE `dsc_order_action` ADD INDEX `pay_status` (`pay_status`);

ALTER TABLE `dsc_open_api` ADD INDEX `is_open` (`is_open`);

ALTER TABLE `dsc_offline_store` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_offline_store` ADD INDEX `stores_user` (`stores_user`);

ALTER TABLE `dsc_offline_store` ADD INDEX `ec_salt` (`ec_salt`);

ALTER TABLE `dsc_offline_store` ADD INDEX `is_confirm` (`is_confirm`);

ALTER TABLE `dsc_notice_log` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_nav` CHANGE `cid` `cid` INT(10) UNSIGNED NULL DEFAULT '0';

ALTER TABLE `dsc_nav` ADD INDEX `cid` (`cid`);

ALTER TABLE `dsc_nav` ADD INDEX `vieworder` (`vieworder`);

ALTER TABLE `dsc_nav` ADD INDEX `opennew` (`opennew`);

ALTER TABLE `dsc_merchants_shop_information` ADD INDEX `self_run` (`self_run`);

ALTER TABLE `dsc_merchants_server` ADD INDEX `cycle` (`cycle`);

ALTER TABLE `dsc_merchants_server` ADD INDEX `bill_time` (`bill_time`);

ALTER TABLE `dsc_merchants_privilege` ADD INDEX `grade_id` (`grade_id`);

ALTER TABLE `dsc_merchants_category_temporarydate` ADD INDEX `cat_name` (`cat_name`);

ALTER TABLE `dsc_merchants_category` ADD INDEX `cat_name` (`cat_name`);

ALTER TABLE `dsc_merchants_category` ADD INDEX `show_in_nav` (`show_in_nav`);

ALTER TABLE `dsc_merchants_account_log` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_merchants_account_log` ADD INDEX `change_type` (`change_type`);

ALTER TABLE `dsc_mass_sms_template` ADD INDEX `temp_id` (`temp_id`);

ALTER TABLE `dsc_link_desc_goodsid` ADD INDEX `d_id` (`d_id`);

ALTER TABLE `dsc_home_templates` ADD INDEX `rs_id` (`rs_id`);

ALTER TABLE `dsc_home_templates` ADD INDEX `code` (`code`);

ALTER TABLE `dsc_home_templates` ADD INDEX `is_enable` (`is_enable`);

ALTER TABLE `dsc_home_templates` ADD INDEX `theme` (`theme`);

ALTER TABLE `dsc_goods_type_cat` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_goods_type_cat` ADD INDEX `parent_id` (`parent_id`);

ALTER TABLE `dsc_goods_type_cat` ADD INDEX `cat_name` (`cat_name`);

ALTER TABLE `dsc_goods_type` ADD INDEX `cat_name` (`cat_name`);

ALTER TABLE `dsc_goods_type` ADD INDEX `enabled` (`enabled`);

ALTER TABLE `dsc_goods_type` ADD INDEX `c_id` (`c_id`);

ALTER TABLE `dsc_goods_transport_tpl` ADD INDEX `tid` (`tid`);

ALTER TABLE `dsc_goods_transport_tpl` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_goods_transport_tpl` ADD INDEX `shipping_id` (`shipping_id`);

ALTER TABLE `dsc_goods_inventory_logs` ADD INDEX `model_inventory` (`model_inventory`);

ALTER TABLE `dsc_goods_inventory_logs` ADD INDEX `product_id` (`product_id`);

ALTER TABLE `dsc_goods_inventory_logs` ADD INDEX `warehouse_id` (`warehouse_id`);

ALTER TABLE `dsc_goods_inventory_logs` ADD INDEX `area_id` (`area_id`);

ALTER TABLE `dsc_goods_extend` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_goods_extend` ADD INDEX `is_reality` (`is_reality`);

ALTER TABLE `dsc_goods_extend` ADD INDEX `is_return` (`is_return`);

ALTER TABLE `dsc_goods_extend` ADD INDEX `is_fast` (`is_fast`);

ALTER TABLE `dsc_goods_change_log` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_goods_activity` ADD INDEX `product_id` (`product_id`);

ALTER TABLE `dsc_goods_activity` ADD INDEX `is_new` (`is_new`);

ALTER TABLE `dsc_goods_activity` ADD INDEX `goods_name` (`goods_name`);

ALTER TABLE `dsc_gift_gard_type` ADD INDEX `ru_id` (`ru_id`);









