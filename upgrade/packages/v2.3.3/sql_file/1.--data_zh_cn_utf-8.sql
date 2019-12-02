INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '244', 'goods_psi', '', '1');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '942', 'floor_nav_type', 'select', '1,2,3,4', '', '1', '1', '');

UPDATE `dsc_shop_config` SET `type` = 'hidden', value = 1 WHERE `code` = 'sms_find_signin';

UPDATE `dsc_admin_action` SET `seller_show` = '1' WHERE `action_code` = 'logs_manage';

UPDATE `dsc_admin_action` SET `seller_show` = '1' WHERE `action_code` = 'logs_drop';

INSERT INTO `dsc_shop_config` (`id` ,`parent_id` ,`code` ,`type` ,`store_range` ,`store_dir` ,`value` ,`sort_order` ,`shop_group`) VALUES (NULL ,  '942',  'register_article_id',  'text',  '',  '',  '',  '1',  '');

UPDATE `dsc_admin_action` SET  `seller_show` =  '0' WHERE `action_code` ='goods_report';

INSERT INTO `dsc_shop_config` (`parent_id`, `code`, `type`, `shop_group`) VALUES ('942', 'seller_index_article', 'text', 'seller');