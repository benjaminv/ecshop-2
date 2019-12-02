ALTER TABLE `dsc_goods` ADD `goods_video` varchar( 255 ) NOT NULL DEFAULT '';

ALTER TABLE `dsc_gift_gard_log` ADD INDEX `gift_gard_id` (`gift_gard_id`);

ALTER TABLE `dsc_gift_gard_log` ADD INDEX `admin_id` (`admin_id`);

ALTER TABLE `dsc_gallery_album` ADD INDEX `parent_album_id` (`parent_album_id`);

ALTER TABLE `dsc_gallery_album` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_friend_link` ADD INDEX `link_name` (`link_name`);

ALTER TABLE `dsc_floor_content` ADD INDEX `brand_id` (`brand_id`);

ALTER TABLE `dsc_floor_content` ADD INDEX `theme` (`theme`);

ALTER TABLE `dsc_floor_content` ADD INDEX `id` (`id`);

ALTER TABLE `dsc_feedback` ADD INDEX `parent_id` (`parent_id`);

ALTER TABLE `dsc_feedback` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_feedback` ADD INDEX `msg_type` (`msg_type`);

ALTER TABLE `dsc_feedback` ADD INDEX `msg_status` (`msg_status`);

ALTER TABLE `dsc_feedback` ADD INDEX `msg_area` (`msg_area`);

ALTER TABLE `dsc_favourable_activity` ADD INDEX `start_time` (`start_time`);

ALTER TABLE `dsc_favourable_activity` ADD INDEX `end_time` (`end_time`);

ALTER TABLE `dsc_favourable_activity` ADD INDEX `act_type` (`act_type`);

ALTER TABLE `dsc_favourable_activity` ADD INDEX `rs_id` (`rs_id`);

ALTER TABLE `dsc_favourable_activity` ADD INDEX `userFav_type` (`userFav_type`);

ALTER TABLE `dsc_exchange_goods` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_exchange_goods` ADD INDEX `is_exchange` (`is_exchange`);

ALTER TABLE `dsc_exchange_goods` CHANGE `eid` `eid` INT(10) NOT NULL AUTO_INCREMENT FIRST;

ALTER TABLE `dsc_entry_criteria` ADD INDEX `parent_id` (`parent_id`);

ALTER TABLE `dsc_email_sendlist` ADD INDEX `template_id` (`template_id`);

ALTER TABLE `dsc_discuss_circle` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_discuss_circle` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_discuss_circle` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_discuss_circle` ADD INDEX `dis_type` (`dis_type`);

ALTER TABLE `dsc_delivery_order` ADD INDEX `delivery_sn` (`delivery_sn`);

ALTER TABLE `dsc_delivery_order` ADD INDEX `order_sn` (`order_sn`);

ALTER TABLE `dsc_delivery_order` ADD INDEX `shipping_id` (`shipping_id`);

ALTER TABLE `dsc_delivery_order` ADD INDEX `suppliers_id` (`suppliers_id`);

ALTER TABLE `dsc_delivery_order` ADD INDEX `agency_id` (`agency_id`);

ALTER TABLE `dsc_delivery_order` ADD INDEX `status` (`status`);

ALTER TABLE `dsc_delivery_goods` CHANGE `send_number` `send_number` INT(10) UNSIGNED NULL DEFAULT '0';

ALTER TABLE `dsc_delivery_goods` ADD INDEX `product_id` (`product_id`);

ALTER TABLE `dsc_delivery_goods` ADD INDEX `is_real` (`is_real`);

ALTER TABLE `dsc_delivery_goods` ADD INDEX `parent_id` (`parent_id`);

ALTER TABLE `dsc_coupons_region` ADD INDEX `cou_id` (`cou_id`);

ALTER TABLE `dsc_coupons_user` DROP INDEX `user_id`, ADD INDEX `user_id` (`user_id`) USING BTREE;

ALTER TABLE `dsc_coupons_user` ADD INDEX `cou_id` (`cou_id`);

ALTER TABLE `dsc_coupons_user` ADD INDEX `is_use` (`is_use`);

ALTER TABLE `dsc_coupons_user` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_coupons` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_connect_user` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_complain_title` ADD INDEX `is_show` (`is_show`);

ALTER TABLE `dsc_complaint_talk` ADD INDEX `complaint_id` (`complaint_id`);

ALTER TABLE `dsc_complaint_talk` ADD INDEX `talk_member_id` (`talk_member_id`);

ALTER TABLE `dsc_complaint_img` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_complaint_img` ADD INDEX `complaint_id` (`complaint_id`);

ALTER TABLE `dsc_complaint_img` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_comment` ADD INDEX `comment_type` (`comment_type`);

ALTER TABLE `dsc_comment` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_comment` ADD INDEX `single_id` (`single_id`);

ALTER TABLE `dsc_comment` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_comment` ADD INDEX `rec_id` (`rec_id`);

ALTER TABLE `dsc_collect_brand` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_category` ADD INDEX `cat_name` (`cat_name`);

ALTER TABLE `dsc_category` ADD INDEX `show_in_nav` (`show_in_nav`);

ALTER TABLE `dsc_category` ADD INDEX `grade` (`grade`);

ALTER TABLE `dsc_category` ADD INDEX `is_top_style` (`is_top_style`);

ALTER TABLE `dsc_category` ADD INDEX `top_style_tpl` (`top_style_tpl`);

ALTER TABLE `dsc_category` ADD INDEX `is_top_show` (`is_top_show`);

ALTER TABLE `dsc_cart` CHANGE `goods_attr_id` `goods_attr_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `dsc_cart_combo` CHANGE `goods_attr_id` `goods_attr_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `dsc_card` ADD INDEX `card_name` (`card_name`);

ALTER TABLE `dsc_brand_extend` ADD INDEX `brand_id` (`brand_id`);

ALTER TABLE `dsc_brand_extend` ADD INDEX `is_recommend` (`is_recommend`);

ALTER TABLE `dsc_booking_goods` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_auction_log` ADD INDEX `bid_user` (`bid_user`);

ALTER TABLE `dsc_attribute_img` ADD INDEX `attr_id` (`attr_id`);

ALTER TABLE `dsc_attribute` ADD INDEX `attr_name` (`attr_name`);

ALTER TABLE `dsc_attribute` ADD INDEX `attr_cat_type` (`attr_cat_type`);

ALTER TABLE `dsc_attribute` ADD INDEX `attr_input_type` (`attr_input_type`);

ALTER TABLE `dsc_attribute` ADD INDEX `attr_type` (`attr_type`);

ALTER TABLE `dsc_attribute` ADD INDEX `attr_group` (`attr_group`);

ALTER TABLE `dsc_attribute` ADD INDEX `sort_order` (`sort_order`);

ALTER TABLE `dsc_article_extend` ADD INDEX `article_id` (`article_id`);

ALTER TABLE `dsc_users` ADD INDEX `address_id` (`address_id`);

ALTER TABLE `dsc_article_cat` ADD INDEX `cat_name` (`cat_name`);

ALTER TABLE `dsc_article` ADD INDEX `is_open` (`is_open`);

ALTER TABLE `dsc_article` ADD INDEX `open_type` (`open_type`);

ALTER TABLE `dsc_area_region` DROP PRIMARY KEY, ADD PRIMARY KEY (`shipping_area_id`) USING BTREE;

ALTER TABLE `dsc_appeal_img` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_appeal_img` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_appeal_img` ADD INDEX `complaint_id` (`complaint_id`);

ALTER TABLE `dsc_alitongxin_configure` ADD INDEX `temp_id` (`temp_id`);

ALTER TABLE `dsc_alidayu_configure` ADD INDEX `temp_id` (`temp_id`);

ALTER TABLE `dsc_admin_user` ADD INDEX `rs_id` (`rs_id`);

ALTER TABLE `dsc_admin_user` ADD INDEX `role_id` (`role_id`);

ALTER TABLE `dsc_admin_user` ADD INDEX `ec_salt` (`ec_salt`);

ALTER TABLE `dsc_admin_user` ADD INDEX `parent_id` (`parent_id`);

ALTER TABLE `dsc_account_log` ADD INDEX `rank_points` (`rank_points`);

ALTER TABLE `dsc_account_log` ADD INDEX `pay_points` (`pay_points`);

ALTER TABLE `dsc_account_log` CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0';
 
ALTER TABLE `dsc_account_log` CHANGE `user_money` `user_money` DECIMAL(10,2) NOT NULL DEFAULT '0.00';

ALTER TABLE `dsc_account_log` CHANGE `frozen_money` `frozen_money` DECIMAL(10,2) NOT NULL DEFAULT '0.00';

ALTER TABLE `dsc_account_log` CHANGE `rank_points` `rank_points` INT(10) NOT NULL DEFAULT '0', 
CHANGE `pay_points` `pay_points` INT(10) NOT NULL DEFAULT '0', 
CHANGE `change_time` `change_time` INT(10) UNSIGNED NOT NULL DEFAULT '0', 
CHANGE `change_type` `change_type` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_merchants_category` ADD INDEX `sort_order` (`sort_order`);

CREATE TABLE IF NOT EXISTS `dsc_intelligent_weight` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `goods_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品购买数量',
  `return_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品退换货数量',
  `user_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '购买此商品的会员数量',
  `goods_comment_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对商品评价数量',
  `merchants_comment_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对商家评价数量',
  `user_attention_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员关注此商品数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `dsc_seller_account_log` ADD `percent_value` VARCHAR(20) NOT NULL;

ALTER TABLE `dsc_merchants_server` CHANGE `suppliers_percent` `suppliers_percent` INT(10) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_merchants_server` ADD INDEX `suppliers_percent` (`suppliers_percent`);

ALTER TABLE `dsc_merchants_shop_information` CHANGE `store_score` `store_score` INT(10) NOT NULL DEFAULT '5';

ALTER TABLE `dsc_comment_seller` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_comment_seller` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_comment_seller` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_complain_title` ADD INDEX `is_show` (`is_show`);

ALTER TABLE `dsc_complaint` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_complaint` ADD INDEX `order_sn` (`order_sn`);

ALTER TABLE `dsc_complaint` ADD INDEX `user_id` (`user_id`);
 
ALTER TABLE `dsc_complaint` ADD INDEX `ru_id` (`ru_id`);

ALTER TABLE `dsc_complaint` ADD INDEX `title_id` (`title_id`);

ALTER TABLE `dsc_comment_img` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `dsc_comment_img` ADD INDEX `order_id` (`order_id`);

ALTER TABLE `dsc_comment_img` ADD INDEX `rec_id` (`rec_id`);

ALTER TABLE `dsc_comment_img` ADD INDEX `goods_id` (`goods_id`);

ALTER TABLE `dsc_comment_img` ADD INDEX `comment_id` (`comment_id`);

ALTER TABLE `dsc_intelligent_weight` ADD INDEX `goods_id` (`goods_id`);