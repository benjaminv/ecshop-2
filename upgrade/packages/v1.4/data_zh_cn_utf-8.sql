INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`) VALUES (null, '3', 'baitiao_manage', '');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '8', 'sms_type', 'select', '0,1', '', '0', '1');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '8', 'ali_appkey', 'text', '', '', '', '1'), (NULL, '8', 'ali_secretkey', 'text', '', '', '', '1');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`) VALUES (NULL, '7', 'gift_gard_manage', '');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`) VALUES (NULL, '7', 'take_manage', '');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'exchange_size', 'text', '', '', '21', '1');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`) VALUES (NULL, '6', 'order_detection', '');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'site_domain', 'text', '', '', '', '1');

UPDATE `dsc_shop_config` SET `sort_order` = '4' WHERE `code` = 'sms_ecmoban_user';
UPDATE `dsc_shop_config` SET `sort_order` = '5' WHERE `code` = 'sms_ecmoban_password';
UPDATE `dsc_shop_config` SET `sort_order` = '6' WHERE `code` = 'sms_shop_mobile';
UPDATE `dsc_shop_config` SET `sort_order` = '2' WHERE `code` = 'sms_type';
UPDATE `dsc_shop_config` SET `sort_order` = '7' WHERE `code` = 'ali_appkey';
UPDATE `dsc_shop_config` SET `sort_order` = '8' WHERE `code` = 'ali_secretkey';

UPDATE `dsc_shop_config` SET `sort_order` = '9' WHERE `code` = 'sms_order_placed';
UPDATE `dsc_shop_config` SET `sort_order` = '10' WHERE `code` = 'sms_order_payed';
UPDATE `dsc_shop_config` SET `sort_order` = '11' WHERE `code` = 'sms_order_shipped';
UPDATE `dsc_shop_config` SET `sort_order` = '12' WHERE `code` = 'sms_signin';
UPDATE `dsc_shop_config` SET `sort_order` = '13' WHERE `code` = 'sms_price_notice';
UPDATE `dsc_shop_config` SET `sort_order` = '14' WHERE `code` = 'sms_seller_signin';

UPDATE `dsc_shop_config` SET `type` = 'textarea' WHERE `code` = 'qq';
UPDATE `dsc_shop_config` SET `type` = 'textarea' WHERE `code` = 'ww';

UPDATE `dsc_shop_config` SET `code` = 'dsc_version' WHERE `id` = 606;
UPDATE `dsc_shop_config` SET `value` = 'v1.3' WHERE `code` = 'dsc_version';