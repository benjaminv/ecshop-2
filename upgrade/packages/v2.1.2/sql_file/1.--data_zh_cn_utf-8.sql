UPDATE `dsc_shop_config` SET shop_group = 'seller' WHERE code = 'marticle';
UPDATE `dsc_shop_config` SET shop_group = 'seller' WHERE code = 'marticle_id';
UPDATE `dsc_shop_config` SET shop_group = 'seller' WHERE code = 'customer_service';
UPDATE `dsc_shop_config` SET shop_group = 'seller' WHERE code = 'review_goods';
UPDATE `dsc_shop_config` SET shop_group = 'seller' WHERE code = 'delete_seller';
UPDATE `dsc_shop_config` SET shop_group = 'seller' WHERE code = 'grade_apply_time';
UPDATE `dsc_shop_config` SET shop_group = 'seller' WHERE code = 'apply_options';
UPDATE `dsc_shop_config` SET shop_group = 'seller' WHERE code = 'commission_model';
UPDATE `dsc_shop_config` SET shop_group = 'seller' WHERE code = 'merchants_prefix';

INSERT INTO `dsc_shop_config` ( `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES ( '7', 'show_give_integral', 'select', '1,0', '', '0', '1');