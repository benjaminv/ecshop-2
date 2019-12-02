ALTER TABLE `dsc_area_region` ADD INDEX `region_id` ( `region_id` ) ;

ALTER TABLE `dsc_area_region` ADD INDEX `ru_id` ( `ru_id` ) ;

ALTER TABLE `dsc_shipping_area` ADD INDEX `ru_id` ( `ru_id` ) ;

ALTER TABLE `dsc_goods` ADD INDEX `review_status` ( `review_status` ) ;

ALTER TABLE `dsc_exchange_goods` ADD `market_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `exchange_integral` ;

ALTER TABLE  `dsc_admin_user` ADD  `recently_cat` VARCHAR( 255 ) NOT NULL COMMENT  '管理员最近使用分类';

ALTER TABLE `dsc_templates_left` ADD `fileurl` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `theme` ;

ALTER TABLE `dsc_entry_criteria` ADD `is_cumulative` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1' AFTER `option_value` ;