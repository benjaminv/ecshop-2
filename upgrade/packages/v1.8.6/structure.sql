ALTER TABLE `dsc_volume_price` DROP PRIMARY KEY;

ALTER TABLE `dsc_products` CHANGE `product_id` `product_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_products` CHANGE `goods_id` `goods_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_products_area` CHANGE `product_id` `product_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_products_area` CHANGE `goods_id` `goods_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_products_warehouse` CHANGE `product_id` `product_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_products_warehouse` CHANGE `goods_id` `goods_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_attribute` CHANGE `sort_order` `sort_order` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_goods_attr` CHANGE `goods_id` `goods_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_goods_attr` CHANGE `attr_id` `attr_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_goods_attr` CHANGE `attr_sort` `attr_sort` INT( 10 ) UNSIGNED NOT NULL ;

ALTER TABLE `dsc_attribute` CHANGE `attr_id` `attr_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `cat_id` `cat_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_goods` ADD `is_volume` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `is_promote` ,
ADD `is_fullcut` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `is_volume` ;

ALTER TABLE `dsc_volume_price` ADD INDEX ( `goods_id` ) ;

ALTER TABLE `dsc_volume_price` ADD INDEX ( `price_type` ) ;

ALTER TABLE `dsc_volume_price` ADD `id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;

ALTER TABLE `dsc_volume_price` ADD INDEX ( `volume_price` ) ;

ALTER TABLE `dsc_volume_price` ADD INDEX ( `volume_number` ) ;

ALTER TABLE `dsc_alidayu_configure` DROP INDEX temp_id;

ALTER TABLE  `dsc_zc_project` ADD `details` TEXT NOT NULL AFTER  `title_img`;

ALTER TABLE `dsc_goods_gallery` ADD `external_url` VARCHAR( 255 ) NOT NULL AFTER `single_id`;