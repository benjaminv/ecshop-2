INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('4', 'admin_message', '1');

DELETE FROM `dsc_shop_config` WHERE `code` = 'goods_file';

--
-- 此处 parent_id(1001) 是 SELECT id FROM dsc_shop_config WHERE code = 'goods_base'; 查询出来的值
--
INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '1001', 'seller_stages', 'select', '0,1', '', '1', '1', 'goods');

UPDATE `dsc_shop_config` SET `store_range` = '0,1,2,3' WHERE `code` = 'sms_type';

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '8', 'dsc_appkey', 'text', '', '', '', '7', 'sms');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '8', 'dsc_appsecret', 'text', '', '', '', '8', 'sms');