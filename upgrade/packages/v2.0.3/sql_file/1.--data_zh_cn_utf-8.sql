
INSERT INTO `dsc_ad_position` (`position_id`, `user_id`, `position_name`, `ad_width`, `ad_height`, `position_model`, `position_desc`, `position_style`, `is_public`, `theme`) VALUES (NULL, '0', '店铺轮播图', '1200', '480', 'users_a[num_id]_[merchant_id]', 'num_id-数量序号，merchant_id-商家ID', '{foreach from=$ads item=ad}
{$ad}
{/foreach}', '1', 'ecmoban_dsc2017');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES
(NULL, 942, 'open_study', 'select', '0,1', '', '0', 1);

UPDATE `dsc_admin_action` SET `seller_show` = '1' WHERE `action_code` = 'admin_message';

INSERT INTO `dsc_admin_action` (`action_id`,`parent_id`, `action_code`, `seller_show`) VALUES ('12','0', 'index_manage', '0');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('12', 'index_sales_volume', '0');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('12', 'index_today_order', '0');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('12', 'index_today_comment', '0');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('12', 'index_seller_num', '0');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('12', 'index_order_status', '0');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('12', 'index_order_stats', '0');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('12', 'index_sales_stats', '0');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('12', 'index_member_info', '0');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('12', 'index_goods_view', '0');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('12', 'index_control_panel', '0');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `seller_show`) VALUES ('12', 'index_system_info', '0');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_dir`) VALUES (NULL, '2', 'no_brand', 'file', '../images/');