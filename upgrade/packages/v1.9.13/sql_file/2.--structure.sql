ALTER TABLE `dsc_coupons` ADD `spec_cat` TEXT NOT NULL AFTER `cou_goods` ;

ALTER TABLE `dsc_coupons` ADD `cou_ok_cat` TEXT NOT NULL AFTER `cou_ok_goods` ;

ALTER TABLE `dsc_goods_activity` ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1' AFTER `is_hot` ,
ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
ADD INDEX ( `review_status` ) ;

ALTER TABLE `dsc_bonus_type` ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1' AFTER `min_goods_amount` ,
ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
ADD INDEX ( `review_status` ) ;

ALTER TABLE `dsc_topic` ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1' AFTER `description` ,
ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
ADD INDEX ( `review_status` ) ;

ALTER TABLE `dsc_favourable_activity` ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1' AFTER `userFav_type` ,
ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
ADD INDEX ( `review_status` ) ;

ALTER TABLE `dsc_wholesale` ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1' AFTER `enabled` ,
ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
ADD INDEX ( `review_status` ) ;

ALTER TABLE `dsc_exchange_goods` ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1' AFTER `goods_id` ,
ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
ADD INDEX ( `review_status` ) ;

ALTER TABLE `dsc_exchange_goods` DROP PRIMARY KEY ,
ADD UNIQUE (
`goods_id`
);

ALTER TABLE `dsc_exchange_goods` ADD `eid` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ;

ALTER TABLE `dsc_presale_activity` ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1' AFTER `is_finished` ,
ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
ADD INDEX ( `review_status` ) ;

ALTER TABLE `dsc_coupons` ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1' AFTER `cou_title` ,
ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
ADD INDEX ( `review_status` ) ;

ALTER TABLE `dsc_gift_gard_type` ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1' AFTER `gift_number` ,
ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
ADD INDEX ( `review_status` ) ;