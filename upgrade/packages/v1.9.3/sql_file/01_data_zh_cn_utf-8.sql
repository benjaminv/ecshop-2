
UPDATE `dsc_shop_config` SET `store_dir` = 'images/common/', `value` = '' WHERE `code` = 'site_commitment';

UPDATE `dsc_shop_config` SET `store_dir` = 'images/common/' WHERE `code` = 'index_down_logo';

UPDATE `dsc_shop_config` SET `store_dir` = 'images/common/' WHERE `code` = 'ecjia_qrcode';

UPDATE `dsc_shop_config` SET `store_dir` = 'images/common/' WHERE `code` = 'ectouch_qrcode';

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '136', 'touch_dashboard', '', '1');