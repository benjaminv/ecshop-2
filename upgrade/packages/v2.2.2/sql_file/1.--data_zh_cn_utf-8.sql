INSERT INTO `dsc_shop_config` ( `parent_id` , `code` , `type` , `value` , `sort_order` , `shop_group` ) VALUES ( 942, 'receipt_time', 'text', '15', '15', 'complaint_conf' );

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '942', 'is_downconfig', 'hidden', '', '', '0', '1', '');

INSERT INTO `dsc_ad_position` ( `user_id`, `position_name`, `ad_width`, `ad_height`, `position_model`, `position_desc`, `position_style`, `is_public`, `theme`) VALUES
(0, '首页天降红包（商品设置关闭可视化状态使用）', 500, 500, 'bonushome[num_id]', 'num_id-数量序号', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', 0, 'ecmoban_dsc2017');