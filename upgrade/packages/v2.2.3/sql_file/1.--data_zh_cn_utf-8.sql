UPDATE `dsc_shop_config` SET `store_range` = '0,1,2' WHERE `code` = 'sms_type';

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '8', 'access_key_id', 'text', '', '', '', '9', ''), 
(NULL, '8', 'access_key_secret', 'text', '', '', '', '10', '');

UPDATE dsc_shop_config SET sort_order = 3 WHERE code = 'sms_shop_mobile';
UPDATE dsc_shop_config SET sort_order = 11 WHERE code = 'sms_order_placed';
UPDATE dsc_shop_config SET sort_order = 12 WHERE code = 'sms_order_payed';
UPDATE dsc_shop_config SET sort_order = 13 WHERE code = 'sms_order_shipped';
UPDATE dsc_shop_config SET sort_order = 14 WHERE code = 'sms_signin';
UPDATE dsc_shop_config SET sort_order = 15 WHERE code = 'sms_price_notice';
UPDATE dsc_shop_config SET sort_order = 16 WHERE code = 'sms_seller_signin';
UPDATE dsc_shop_config SET sort_order = 17 WHERE code = 'sms_find_signin';
UPDATE dsc_shop_config SET sort_order = 18 WHERE code = 'sms_code';
UPDATE dsc_shop_config SET sort_order = 19 WHERE code = 'user_account_code';

UPDATE `dsc_shop_config` SET `shop_group` = 'sms' WHERE `parent_id` = 8;

UPDATE `dsc_shop_config` SET `value` = 'group' WHERE `code` = 'hidden';

UPDATE `dsc_admin_action` SET parent_id = '136', seller_show = '1' WHERE action_code = 'touch_dashboard';