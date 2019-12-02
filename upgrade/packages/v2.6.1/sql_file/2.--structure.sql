ALTER TABLE  `dsc_user_address` CHANGE  `country`  `country` INT( 10 ) NOT NULL DEFAULT  '0',
CHANGE  `province`  `province` INT( 10 ) NOT NULL DEFAULT  '0',
CHANGE  `city`  `city` INT( 10 ) NOT NULL DEFAULT  '0',
CHANGE  `district`  `district` INT( 10 ) NOT NULL DEFAULT  '0',
CHANGE  `street`  `street` INT( 10 ) NOT NULL DEFAULT  '0';


ALTER TABLE  `dsc_products_area` CHANGE  `area_id`  `area_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0';

ALTER TABLE  `dsc_products_changelog` CHANGE  `area_id`  `area_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0';

ALTER TABLE  `dsc_products_warehouse` CHANGE  `warehouse_id`  `warehouse_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0';

ALTER TABLE  `dsc_back_order` ADD INDEX  `country` (  `country` );

ALTER TABLE  `dsc_back_order` ADD INDEX  `province` (  `province` );

ALTER TABLE  `dsc_back_order` ADD INDEX  `city` (  `city` );

ALTER TABLE  `dsc_back_order` ADD INDEX  `district` (  `district` );

ALTER TABLE  `dsc_back_order` ADD  `street` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `district` ,
ADD INDEX (  `street` );

ALTER TABLE  `dsc_delivery_order` CHANGE  `country`  `country` INT( 10 ) UNSIGNED NULL DEFAULT  '0',
CHANGE  `province`  `province` INT( 10 ) UNSIGNED NULL DEFAULT  '0',
CHANGE  `city`  `city` INT( 10 ) UNSIGNED NULL DEFAULT  '0',
CHANGE  `district`  `district` INT( 10 ) UNSIGNED NULL DEFAULT  '0';

ALTER TABLE  `dsc_delivery_order` ADD INDEX  `country` (  `country` );

ALTER TABLE  `dsc_delivery_order` ADD INDEX  `province` (  `province` );

ALTER TABLE  `dsc_delivery_order` ADD INDEX  `city` (  `city` );

ALTER TABLE  `dsc_delivery_order` ADD INDEX  `district` (  `district` );

ALTER TABLE  `dsc_delivery_order` ADD  `street` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `district` ,
ADD INDEX (  `street` );

ALTER TABLE  `dsc_offline_store` CHANGE  `country`  `country` INT( 10 ) NOT NULL DEFAULT  '0',
CHANGE  `province`  `province` INT( 10 ) NOT NULL DEFAULT  '0',
CHANGE  `city`  `city` INT( 10 ) NOT NULL DEFAULT  '0',
CHANGE  `district`  `district` INT( 10 ) NOT NULL DEFAULT  '0';

ALTER TABLE  `dsc_offline_store` ADD INDEX  `country` (  `country` );

ALTER TABLE  `dsc_offline_store` ADD INDEX  `province` (  `province` );

ALTER TABLE  `dsc_offline_store` ADD INDEX  `city` (  `city` );

ALTER TABLE  `dsc_offline_store` ADD INDEX  `district` (  `district` );

ALTER TABLE  `dsc_offline_store` ADD  `street` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `district` ,
ADD INDEX (  `street` );

ALTER TABLE  `dsc_users_type` CHANGE  `country`  `country` INT( 10 ) NOT NULL DEFAULT  '0',
CHANGE  `province`  `province` INT( 10 ) NOT NULL DEFAULT  '0',
CHANGE  `city`  `city` INT( 10 ) NOT NULL DEFAULT  '0',
CHANGE  `district`  `district` INT( 10 ) NOT NULL DEFAULT  '0';

ALTER TABLE  `dsc_users_type` ADD INDEX  `country` (  `country` );

ALTER TABLE  `dsc_users_type` ADD INDEX  `province` (  `province` );

ALTER TABLE  `dsc_users_type` ADD INDEX  `city` (  `city` );

ALTER TABLE  `dsc_users_type` ADD INDEX  `district` (  `district` );

--供应链 SQL start
ALTER TABLE  `dsc_wholesale_order_info` CHANGE  `country`  `country` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0',
CHANGE  `province`  `province` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0',
CHANGE  `city`  `city` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0',
CHANGE  `district`  `district` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0',
CHANGE  `street`  `street` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0';

ALTER TABLE  `dsc_wholesale_order_info` ADD INDEX  `country` (  `country` );

ALTER TABLE  `dsc_wholesale_order_info` ADD INDEX  `province` (  `province` );

ALTER TABLE  `dsc_wholesale_order_info` ADD INDEX  `city` (  `city` );

ALTER TABLE  `dsc_wholesale_order_info` ADD INDEX  `district` (  `district` );

ALTER TABLE  `dsc_wholesale_order_info` ADD INDEX  `street` (  `street` );
--供应链 SQL end

ALTER TABLE  `dsc_order_info` ADD INDEX  `country` (  `country` );

ALTER TABLE  `dsc_order_info` ADD INDEX  `province` (  `province` );

ALTER TABLE  `dsc_order_info` ADD INDEX  `city` (  `city` );

ALTER TABLE  `dsc_order_info` ADD INDEX  `district` (  `district` );

ALTER TABLE  `dsc_order_info` ADD INDEX  `street` (  `street` );

ALTER TABLE  `dsc_cart` ADD  `area_city` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `area_id`;

ALTER TABLE  `dsc_order_goods` ADD  `area_city` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `area_id`;

ALTER TABLE  `dsc_wechat_user` CHANGE `drp_parent_id` `drp_parent_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';
