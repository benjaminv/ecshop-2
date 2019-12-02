INSERT INTO `dsc_shop_config` (`parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES
(9, 'wap_category', 'select', '1,0', '', '0', '1', '1');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, '942', 'brand_belongs', 'hidden', '0,1', '', '0', '1', '');

UPDATE `dsc_shop_config` SET `type` = 'hidden', `value` = 0 WHERE `code` = 'freight_model';

UPDATE dsc_goods SET `freight` = 2 WHERE `freight` = 0;

UPDATE `dsc_order_print_size` SET `specification` = '241MM*140MM', `height` = '140', `size` = '241mm x 140mm' WHERE `specification` = '241MM*140MM';