ALTER TABLE `dsc_goods_attr` ADD `admin_id` SMALLINT( 8 ) UNSIGNED NOT NULL AFTER `attr_pid`;

ALTER TABLE `dsc_account_log` CHANGE `log_id` `log_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL;

ALTER TABLE `dsc_ad` CHANGE `ad_id` `ad_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `position_id` `position_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_admin_action` CHANGE `action_id` `action_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `parent_id` `parent_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_admin_user` CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `ru_id` `ru_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_ad_position` CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_alidayu_configure` CHANGE `id` `id` SMALLINT( 5 ) NOT NULL AUTO_INCREMENT ;

ALTER TABLE `dsc_area_region` CHANGE `shipping_area_id` `shipping_area_id` SMALLINT( 8 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `region_id` `region_id` SMALLINT( 8 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_attribute_img` CHANGE `id` `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `attr_id` `attr_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_back_goods` CHANGE `rec_id` `rec_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `back_id` `back_id` INT( 10 ) UNSIGNED NULL DEFAULT '0',
CHANGE `goods_id` `goods_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `product_id` `product_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_back_goods` ADD INDEX ( `product_id` ) ;