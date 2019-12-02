ALTER TABLE `dsc_goods` 
	ADD `bar_code` VARCHAR( 60 ) NOT NULL AFTER `goods_sn`;

ALTER TABLE `dsc_products` 
	ADD `bar_code` VARCHAR( 60 ) NOT NULL AFTER `product_sn`;

ALTER TABLE `dsc_products_area` 
	ADD `bar_code` VARCHAR( 60 ) NOT NULL AFTER `product_sn`;

ALTER TABLE `dsc_products_warehouse` 
	ADD `bar_code` VARCHAR( 60 ) NOT NULL AFTER `product_sn`;

ALTER TABLE `dsc_users_real` 
	ADD `bank_name`  varchar(60) NOT NULL AFTER `real_name`;

ALTER TABLE `dsc_users_real` 
	ADD `review_content`  varchar(100) NOT NULL AFTER `review_time`;