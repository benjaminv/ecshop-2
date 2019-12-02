
--
-- 此处 parent_id(500) 是 SELECT action_id FROM `dsc_admin_action` WHERE `action_code` = 'goods_lib'; 查询出来的值
--
INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `relevance`) VALUES ('0', 'goods_lib', '');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`) VALUES (NULL, '500', 'goods_lib_list', '');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`) VALUES (NULL, '500', 'goods_lib_cat', '');

INSERT INTO `dsc_shop_config` ( `parent_id` , `code` , `type` , `store_range` , `value` , `sort_order` , `shop_group` ) VALUES ( 942, 'template_pay_type', 'select', '0,1', '0', 2, 'seller' ) ;

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '3', 'mass_sms', '', '0');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '1', 'commission_setting', '', '1');

INSERT INTO `dsc_shop_config` (`parent_id` ,`code` ,`type`) VALUES ('942',  'deposit_fee',  'text');

INSERT INTO `dsc_template_mall` ( `temp_code` ) VALUES ('store_tpl_1');

---- 新增
INSERT INTO `dsc_shop_config` ( `parent_id` , `code` , `type` , `value` , `sort_order` ) VALUES ( 4, 'activation_number_type', 'text', 2, 2 ) ;

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '942', 'wholesale_user_rank', 'select', '1,0', '', '1', '1', '');

INSERT INTO `dsc_shop_config` ( `parent_id` , `code` , `type` , `store_range` , `value` , `sort_order` , `shop_group` ) VALUES ( 942, 'is_illegal', 'select', '0,1', '0', 1, '' ) ;

UPDATE `dsc_payment` SET `is_online` = '0' WHERE `pay_code` = 'balance';