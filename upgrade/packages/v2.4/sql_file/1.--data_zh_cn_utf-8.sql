INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '942', 'checkbill_number', 'hidden', '', '', '10', '1', '');

UPDATE `dsc_shop_config` SET `type` = 'hidden', `value` = '1' WHERE `code` = 'goods_attr_price';

INSERT INTO `dsc_shop_config` (`id` ,`parent_id` ,`code` ,`type` ,`store_range` ,`store_dir` ,`value` ,`sort_order` ,`shop_group`) VALUES (NULL ,  '0',  'basic_logo',  'group',  '',  '',  '',  '1',  '');

--
-- 此处 position_id(1018) 是 SELECT id FROM dsc_shop_config WHERE code = 'basic_logo'; 查询出来的值
--

UPDATE  `dsc_shop_config` SET  `parent_id` =  '1018' WHERE  `code` ='index_down_logo';

UPDATE  `dsc_shop_config` SET  `parent_id` =  '1018' WHERE  `code` ='user_login_logo';

UPDATE  `dsc_shop_config` SET  `parent_id` =  '1018' WHERE  `code` ='login_logo_pic';

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`,`shop_group`) VALUES (NULL, '1018', 'admin_login_logo', 'file', '', 'admin/images/', '', '1','');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`,`shop_group`) VALUES (NULL, '1018', 'admin_logo', 'file', '', 'admin/images/', '', '1','');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`,`shop_group`) VALUES (NULL, '1018', 'seller_login_logo', 'file', '', 'seller/images/', '', '1','');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`,`shop_group`) VALUES (NULL, '1018', 'seller_logo', 'file', '', 'seller/images/', '', '1','');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`,`shop_group`) VALUES (NULL, '1018', 'stores_login_logo', 'file', '', 'stores/images/', '', '1','');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`,`shop_group`) VALUES (NULL, '1018', 'stores_logo', 'file', '', 'stores/images/', '', '1','');

UPDATE `dsc_seckill` SET review_status = 3 WHERE ru_id = 0;

UPDATE `dsc_admin_action` SET `seller_show` = '0' WHERE `action_code` = 'logs_drop';

UPDATE `dsc_link_goods_desc` SET review_status = 3 WHERE ru_id = 0;

UPDATE `dsc_admin_action` SET seller_show = 1 WHERE action_code = 'seckill_manage';