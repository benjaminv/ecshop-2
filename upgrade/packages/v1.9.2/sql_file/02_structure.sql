ALTER TABLE `dsc_presale_cat` CHANGE `cid` `cat_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `c_name` `cat_name` VARCHAR( 90 ) NOT NULL ,
CHANGE `parent_cid` `parent_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_presale_cat` ADD INDEX ( `parent_id` ) ;

ALTER TABLE `dsc_presale_cat`  
	ADD `keywords` VARCHAR(255) NOT NULL AFTER `cat_name`,  
	ADD `cat_desc` VARCHAR(255) NOT NULL AFTER `keywords`,  
	ADD `measure_unit` VARCHAR(15) NOT NULL AFTER `cat_desc`,  
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

ALTER TABLE `dsc_presale_cat` ADD `is_show` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `style` ;

ALTER TABLE `dsc_presale_cat` ADD INDEX ( `is_show` ) ;

ALTER TABLE `dsc_presale_activity` CHANGE `cid` `cat_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_seller_shopinfo` ADD `tengxun_key` VARCHAR( 255 ) NOT NULL AFTER `longitude` ;

ALTER TABLE `dsc_goods` CHANGE `goods_number` `goods_number` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_zc_category`  
	ADD `keywords` VARCHAR(255) NOT NULL AFTER `cat_name`,  
	ADD `measure_unit` VARCHAR(15) NOT NULL AFTER `keywords`,  
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


ALTER TABLE `dsc_goods_article` DROP PRIMARY KEY;

ALTER TABLE `dsc_goods_article` ADD `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;

ALTER TABLE `dsc_goods_article` ADD INDEX ( `goods_id` , `article_id` , `admin_id` ) ;





