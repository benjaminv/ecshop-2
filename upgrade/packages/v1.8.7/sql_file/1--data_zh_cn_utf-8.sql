UPDATE `dsc_shop_config` SET `type` = 'hidden' WHERE `code` = 'skype';

UPDATE `dsc_shop_config` SET `type` = 'hidden' WHERE `code` = 'ym';

UPDATE `dsc_shop_config` SET `type` = 'hidden' WHERE `code` = 'msn';

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'add_shop_price', 'select', '0,1', '', '1', '1');