ALTER TABLE `dsc_merchants_category` DROP INDEX cat_id;

ALTER TABLE `dsc_merchants_category` ADD `cat_name` VARCHAR( 90 ) NOT NULL AFTER `cat_id` , ADD `parent_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `cat_name`;

ALTER TABLE `dsc_category` CHANGE `sort_order` `sort_order` SMALLINT( 8 ) UNSIGNED NOT NULL DEFAULT '50';

ALTER TABLE `dsc_category` CHANGE `is_top_style` `is_top_style` TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_category` CHANGE `is_top_show` `is_top_show` TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_merchants_category`  
	ADD `keywords` VARCHAR(255) NOT NULL AFTER `user_id`,  
	ADD `cat_desc` VARCHAR(255) NOT NULL AFTER `keywords`,  
	ADD `sort_order` SMALLINT(8) UNSIGNED NOT NULL DEFAULT '0' AFTER `cat_desc`,  
	ADD `measure_unit` VARCHAR(15) NOT NULL AFTER `sort_order`,  
	ADD `show_in_nav` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER `measure_unit`,  
	ADD `style` VARCHAR(150) NOT NULL AFTER `show_in_nav`,  
	ADD `grade` TINYINT(4) UNSIGNED NOT NULL DEFAULT '0' AFTER `style`,  
	ADD `filter_attr` VARCHAR(225) NOT NULL AFTER `grade`,  
	ADD `is_top_style` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' AFTER `filter_attr`,  
	ADD `top_style_tpl` VARCHAR(255) NOT NULL AFTER `is_top_style`,  
	ADD `cat_icon` VARCHAR(255) NOT NULL AFTER `top_style_tpl`,  
	ADD `is_top_show` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' AFTER `cat_icon`,  
	ADD `category_links` TEXT NOT NULL AFTER `is_top_show`,  
	ADD `category_topic` TEXT NOT NULL AFTER `category_links`,  
	ADD `pinyin_keyword` TEXT NOT NULL AFTER `category_topic`,  
	ADD `cat_alias_name` VARCHAR(90) NOT NULL AFTER `pinyin_keyword`,  
	ADD `template_file` VARCHAR(50) NOT NULL AFTER `cat_alias_name`;

ALTER TABLE `dsc_merchants_category` ADD INDEX ( `parent_id` );

ALTER TABLE `dsc_goods` ADD `user_cat` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `cat_id`;

ALTER TABLE `dsc_goods` ADD INDEX ( `user_cat` );

ALTER TABLE `dsc_goods_cat` ADD INDEX ( `goods_id` );

ALTER TABLE `dsc_goods_cat` ADD INDEX ( `cat_id` );

ALTER TABLE `dsc_admin_action` CHANGE `action_id` `action_id` SMALLINT( 8 ) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_admin_action` CHANGE `parent_id` `parent_id` SMALLINT( 8 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_merchants_category` DROP COLUMN uc_id;

ALTER TABLE `dsc_merchants_category` ADD PRIMARY KEY ( `cat_id` );

ALTER TABLE `dsc_merchants_category` CHANGE `cat_id` `cat_id` INT( 10 ) NOT NULL AUTO_INCREMENT;

ALTER TABLE `dsc_merchants_category` ADD INDEX ( `is_top_show` );