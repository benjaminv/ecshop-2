
INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'user_login_logo', 'file', '', 'images/common/', '', '1');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `value`) VALUES (NULL, '4', 'use_value_card', 'select', '0,1', '0');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'commission_model', 'select', '0,1', '', '0', '1');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '1', 'value_card', '', '0');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '136', 'seller_users_real', '', '0');
 
INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '5', 'api', '', '0');
 
INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '0', 'transfer_manage', '', '0');
 
INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '10', 'transfer', '', '0');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'login_logo_pic', 'file', '', 'images/common/', '', '1');

INSERT INTO `dsc_ad_position` (`position_id`, `user_id`, `position_name`, `ad_width`, `ad_height`, `position_model`, `position_desc`, `position_style`, `is_public`, `theme`) VALUES (NULL, '0', 'regist_banner', '526', '327', '注册页面左侧banner图', '注册页面左侧banner图', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc');