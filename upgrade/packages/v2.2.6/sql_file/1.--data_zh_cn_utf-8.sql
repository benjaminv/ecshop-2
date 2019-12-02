UPDATE `dsc_shop_config` SET `shop_group` = 'goods' WHERE `parent_id` = 7;
UPDATE `dsc_shop_config` SET `shop_group` = 'goods' WHERE `code` IN ('watermark','watermark_place','watermark_alpha','use_storage','market_price_rate','sn_prefix','no_picture','comment_factor','default_storage','bgcolor','auto_generate_gallery','retain_original_img','image_width','image_height','bought_goods','goods_name_length','price_format','page_size','sort_order_type','sort_order_method','show_order_type','attr_related_number','goods_gallery_number','related_goods_number','recommend_order','open_area_goods','freight_model','group_goods','attr_set_up','goods_file','show_warehouse','two_code','two_code_logo','exchange_size','category_load_type','goods_attr_price','add_shop_price','no_brand');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '11', 'sms_setting', '', '0');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '4', 'sales_volume_time', 'select', '1,0', '', '1', '1', '');

--
-- 此处 parent_id(993) 是 SELECT id FROM dsc_shop_config WHERE code = 'goods_base'; 查询出来的值
--
INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '0', 'goods_base', 'group', '', '', '', '1', 'goods');

UPDATE `dsc_shop_config` SET  `parent_id` =  '993' WHERE `code` IN ('goods_attr_price', 'add_shop_price', 'use_storage', 'market_price_rate', 'sn_prefix', 'comment_factor', 'default_storage', 'group_goods', 'attr_set_up', 'show_warehouse', 'goods_file', 'freight_model', 'goods_name_length', 'price_format', 'recommend_order', 'open_area_goods');

--
-- 此处 parent_id(994) 是 SELECT id FROM dsc_shop_config WHERE code = 'goods_display'; 查询出来的值
--
INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '0', 'goods_display', 'group', '', '', '', '1', 'goods');

UPDATE `dsc_shop_config` SET  `parent_id` =  '994' WHERE `code` IN ('show_goodssn', 'show_brand', 'show_goodsweight', 'show_goodsnumber', 'show_addtime', 'goodsattr_style', 'show_marketprice', 'show_rank_price', 'show_give_integral');

--
-- 此处 parent_id(995) 是 SELECT id FROM dsc_shop_config WHERE code = 'goods_page'; 查询出来的值
--
INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '0', 'goods_page', 'group', '', '', '', '1', 'goods');

UPDATE `dsc_shop_config` SET  `parent_id` =  '995' WHERE `code` IN ('exchange_size', 'category_load_type', 'page_size', 'sort_order_type', 'sort_order_method', 'show_order_type', 'bought_goods', 'attr_related_number', 'related_goods_number');

--
-- 此处 parent_id(996) 是 SELECT id FROM dsc_shop_config WHERE code = 'goods_picture'; 查询出来的值
--
INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '0', 'goods_picture', 'group', '', '', '', '1', 'goods');

UPDATE `dsc_shop_config` SET  `parent_id` =  '996' WHERE `code` IN ('watermark', 'no_picture', 'two_code_logo', 'no_brand', 'watermark_place', 'watermark_alpha', 'bgcolor', 'auto_generate_gallery', 'retain_original_img', 'image_width', 'image_height', 'two_code', 'goods_gallery_number');

--
-- 此处 parent_id(136) 是 SELECT action_id FROM `dsc_admin_action` WHERE `action_code` = 'merchants'; 查询出来的值
--

DELETE FROM `dsc_admin_action` WHERE action_code = 'touch_dashboard' AND parent_id = '136';

--
-- 此处 parent_id(405) 是 SELECT action_id FROM `dsc_admin_action` WHERE `action_code` = 'third_party_service'; 查询出来的值
--
INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '0', 'third_party_service', '', '0');

UPDATE `dsc_admin_action` SET  `parent_id` =  '405' WHERE  `dsc_admin_action`.`action_code` ='sms_setting';

UPDATE `dsc_admin_action` SET  `parent_id` =  '405' WHERE  `dsc_admin_action`.`action_code` ='website';

UPDATE `dsc_admin_action` SET  `parent_id` =  '405' WHERE  `dsc_admin_action`.`action_code` ='oss_configure';

UPDATE `dsc_admin_action` SET  `parent_id` =  '405' WHERE  `dsc_admin_action`.`action_code` ='open_api';

--
-- 此处 parent_id(942) 是 SELECT id FROM `dsc_shop_config` WHERE `code` = 'extend_basic'; 查询出来的值
--
INSERT INTO `dsc_shop_config` ( `parent_id` , `code` , `type` , `store_range` , `value` , `sort_order` ) VALUES ( 942, 'bonus_adv', 'select', '0,1', 1, 1 );

--
-- 此处 parent_id(1004) 是 SELECT id FROM `dsc_shop_config` WHERE `code` = 'goods_picture'; 查询出来的值
--
UPDATE `dsc_shop_config` SET  `parent_id` =  '1004', `shop_group` = 'goods' WHERE `code` IN ('two_code_links', 'two_code_mouse');
