ALTER TABLE `dsc_order_print_setting` ADD `sort_order` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' AFTER `is_default`;

ALTER TABLE `dsc_order_print_setting` ADD `width` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `printer`;

ALTER TABLE `dsc_goods` CHANGE `goods_number` `goods_number` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_warehouse_goods` CHANGE `region_number` `region_number` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_warehouse_area_goods` CHANGE `region_number` `region_number` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_goods` CHANGE `review_status` `review_status` TINYINT(1) NOT NULL DEFAULT '1';

ALTER TABLE `dsc_goods` ADD `user_brand` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '品牌统一使用平台品牌ID异步操作', ADD INDEX `user_brand` (`user_brand`);

ALTER TABLE `dsc_collect_brand` ADD `user_brand` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `ru_id`, ADD INDEX `user_brand` (`user_brand`);

ALTER TABLE `dsc_favourable_activity` ADD `user_range_ext` VARCHAR(255) NOT NULL DEFAULT '' AFTER `review_content`;

ALTER TABLE `dsc_favourable_activity` ADD `is_user_brand` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER `user_range_ext`;

ALTER TABLE `dsc_merchants_steps_fields` ADD `shopTime_term` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `business_term` ;

ALTER TABLE `dsc_goods` CHANGE `freight` `freight` TINYINT(1) UNSIGNED NOT NULL DEFAULT '2';