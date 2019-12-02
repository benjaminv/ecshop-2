UPDATE `dsc_admin_action` SET `seller_show` = 0 WHERE `action_code` = 'notice_logs';

UPDATE `dsc_admin_action` SET `seller_show` = 0 WHERE `action_code` = 'picture_batch';

UPDATE `dsc_admin_action` SET `seller_show` = 0 WHERE `action_code` = 'single_manage';

UPDATE `dsc_admin_action` SET `seller_show` = 0 WHERE `action_code` = 'single_edit_delete';

UPDATE `dsc_admin_action` SET `seller_show` = 0 WHERE `action_code` = 'sale_notice';

INSERT INTO `dsc_ad_position` ( `user_id`, `position_name`, `ad_width`, `ad_height`, `position_model`, `position_desc`, `position_style`, `is_public`, `theme`) VALUES
( 0, '顶级分类页（默认）品牌旗舰', 200, 200, 'category_top_default_brand[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', 0, 'ecmoban_dsc2017');

INSERT INTO `dsc_shop_config` (`parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES
( 3, 'marticle_index', 'text', '', '', '1,2,3,4', 1);