INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'use_coupons', 'select', '0,1', '', '1', '1');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '1', 'review_status', '', '0');

UPDATE `dsc_admin_action` SET `seller_show` = '1' WHERE `action_code` = 'shiparea_manage';

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'tengxun_key', 'text', '', '', '', '1');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'kuaidi100_key', 'text', '', '', '', '1');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'ip_type', 'select', '0,1,2', '', '0', '1');

UPDATE `dsc_shop_config` SET `type` = 'hidden' WHERE `code` = 'goodsattr_style';

UPDATE `dsc_shop_config` SET `type` = 'hidden' WHERE `code` = 'seller_email';

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '136', 'comment_seller', '', '0');

UPDATE `dsc_admin_action` SET `seller_show` = '0' WHERE `action_code` = 'brand_manage';

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'ectouch_qrcode', 'file', '', '../images/common/', '', '1');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'ecjia_qrcode', 'file', '', '../images/common/', '', '1');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'index_down_logo', 'file', '', '../images/common/', '', '1');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'site_commitment', 'file', '', '../images/common/', '', '1');