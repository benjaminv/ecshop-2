INSERT INTO `dsc_store_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `action_name`) VALUES
(1, 0, 'goods_manage', '', '商品管理'),
(2, 0, 'order_manage', '', '订单管理'),
(3, 0, 'user_manage', '', '职员管理'),
(4, 0, 'config_manage', '', '设置管理');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '8', 'sms_find_signin', 'select', '1,0', '', '0', '15');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '8', 'sms_code', 'select', '1,0', '', '0', '16');