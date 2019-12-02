INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '0', 'region_store', '', '0');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '301', 'region_store_manage', '', '0');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '942', 'region_store_enabled', 'hidden', '0,1', '', '0', '1', '');

INSERT INTO  `dsc_shop_config` (  `parent_id` ,  `code` ,  `type` ,  `value` ,  `shop_group` ) VALUES ( 942,  'update_home_temp',  'hidden', 1,  '' );

UPDATE `dsc_shop_config` SET `store_range`='2,1,0' WHERE `code`='stock_dec_time';

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('4', 'message_manage', '1');