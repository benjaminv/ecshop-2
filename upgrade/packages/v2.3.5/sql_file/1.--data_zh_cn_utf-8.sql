
--
-- 此处 parent_id(942) 是 SELECT id FROM dsc_shop_config WHERE code = 'extend_basic'; 查询出来的值
--
INSERT INTO `dsc_shop_config` ( `parent_id` , `code` , `type` , `value` , `sort_order`, `shop_group`) VALUES ( 942, 'buyer_cash', 'text', 1, 2, '') ;

--
-- 此处 parent_id(942) 是 SELECT id FROM dsc_shop_config WHERE code = 'extend_basic'; 查询出来的值
--
INSERT INTO `dsc_shop_config` ( `parent_id` , `code` , `type` , `value` , `sort_order`, `shop_group`) VALUES ( 942, 'buyer_recharge', 'text', 1, 2, '') ;

--
-- 此处 parent_id(8) 是 SELECT action_id FROM dsc_admin_action WHERE action_code = 'email'; 查询出来的值
--
UPDATE `dsc_admin_action` SET `parent_id` = '8' WHERE `action_code` = 'mail_template';

--
-- 此处 parent_id(8) 是 SELECT action_id FROM dsc_admin_action WHERE action_code = 'email'; 查询出来的值
--
INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '8', 'mail_settings', '', '0');

--
-- 此处 parent_id(8) 是 SELECT id FROM dsc_admin_action WHERE action_code = 'email'; 查询出来的值
--
UPDATE `dsc_admin_action` SET `seller_show` = 0 WHERE `parent_id` = 8;

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '0', 'tp_api', 'hidden', '', '', '', '1', '');

--
-- 此处 parent_id(1005) 是 SELECT id FROM dsc_shop_config WHERE code = 'tp_api'; 查询出来的值
--
INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '1005', 'kdniao_client_id', 'text', '', '', '', '1', 'tp_api');

--
-- 此处 parent_id(1005) 是 SELECT id FROM dsc_shop_config WHERE code = 'tp_api'; 查询出来的值
--
INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '1005', 'kdniao_appkey', 'text', '', '', '', '1', 'tp_api');

--
-- 此处 parent_id(5) 是 SELECT action_id FROM dsc_admin_action WHERE action_code = 'sys_manage'; 查询出来的值
--
INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '5', 'order_print_setting', '', '1');

INSERT INTO `dsc_order_print_size` (`id`, `type`, `specification`, `width`, `height`, `size`, `description`) VALUES
(1, '100', '100MM', '100', '', '100mm', ''),
(2, '80', '80MM', '80', '', '80mm', ''),
(3, '70', '70MM', '70', '', '70mm', ''),
(4, '60', '60MM', '60', '', '60mm', ''),
(5, '50', '50MM', '50', '', '50mm', ''),
(6, 'A4', 'A4纸张', '210', '297', '210mm x 297mm', '当打印设置选择A4纸张、竖向打印、无边距时每张A4打印纸可输出2页订单。'),
(7, '120', '120MM*93MM', '120', '93', '120mm x 93mm', ''),
(8, '120', '120MM*140MM', '120', '140', '120mm x 140mm', ''),
(9, '120', '120MM*280MM', '120', '280', '120mm x 280mm', ''),
(10, '190', '190MM*93MM', '190', '93', '190mm x 93mm', ''),
(11, '190', '190MM*140MM', '190', '140', '190mm x 140mm', ''),
(12, '190', '190MM*280MM', '190', '280', '190mm x 280mm', ''),
(13, '210', '210MM*145MM', '210', '145', '210mm x 145mm', ''),
(14, '241', '241MM*93MM', '241', '93', '241mm x 93mm', ''),
(15, '241', '241MM*139MM', '241', '139', '241mm x 139mm', ''),
(16, '241', '241MM*280MM', '241', '280', '241mm x 280mm', '');