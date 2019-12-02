UPDATE `dsc_shop_config` SET `type` = 'file' WHERE `code` = 'watermark';

INSERT INTO `dsc_admin_action` ( `parent_id` , `action_code` , `seller_show` ) VALUES ( 6, 'exchange', 1 ) ;

INSERT INTO `dsc_admin_action` ( `parent_id` , `action_code` , `seller_show` ) VALUES ( 6, 'complaint', 1 ) ;

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`) VALUES ('7', 'seckill_manage');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`) VALUES ('3', 'user_vat_manage');

UPDATE `dsc_shop_config` SET `type` = 'hidden', `store_range` = '0,1' WHERE `code` = 'commission_model';

INSERT INTO `dsc_shop_config` ( `parent_id` , `code` , `type` , `store_range` , `value` , `sort_order` , `shop_group` ) VALUES ( 942, 'report_handle', 'select', '0,1', 1, '15', 'report_conf' ) ;

INSERT INTO `dsc_shop_config` ( `parent_id` , `code` , `type` , `value` , `sort_order` , `shop_group` ) VALUES ( 942, 'report_handle_time', 'text', '30', '15', 'report_conf' ) ;

INSERT INTO `dsc_admin_action` ( `parent_id` , `action_code` , `seller_show`) VALUES ( 1, 'goods_report', '1') ;

INSERT INTO `dsc_goods_report_type` (`type_id`, `type_name`, `type_desc`) VALUES
(1, '出售禁售品', '销售商城禁止和限制交易规则下所规定的所有商品。'),
(2, '产品质量问题', '产品质量差，与描述严重不相符。');

INSERT INTO `dsc_goods_report_title` (`type_id`, `title_name`, `is_show`) VALUES
(1, '枪支弹药', 1),
(1, '管制刀具、弓弩类、其他武器等', 1),
(1, '赌博用具类', 1),
(1, '毒品及吸毒工具', 1),
(2, '色差大，质量差。', 1),
(2, '描述与实物严重不符', 1);

INSERT INTO `dsc_complain_title` (`title_name`, `title_desc`, `is_show`) VALUES
('未收到货', '交易成功，未收到货，钱已经付给商家，可进行维权。', 1),
('售后保障服务', '交易完成后30天内，在使用商品过程中，发现商品有质量问题或无法正常使用，可进行维权。', 1);