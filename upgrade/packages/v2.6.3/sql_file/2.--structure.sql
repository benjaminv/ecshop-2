ALTER TABLE `dsc_order_info` MODIFY COLUMN `point_id`  varchar(255) NOT NULL DEFAULT '';

ALTER TABLE  `dsc_touch_ad_position` ADD  `tc_id` INT( 10 ) UNSIGNED NOT NULL;

ALTER TABLE  `dsc_touch_ad_position` ADD  `tc_type` VARCHAR( 255 ) NOT NULL;

ALTER TABLE  `dsc_touch_ad_position` ADD  `ad_type` VARCHAR( 20 ) NOT NULL AFTER  `tc_type`;