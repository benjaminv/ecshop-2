ALTER TABLE `dsc_shipping` ADD UNIQUE  `shipping_code` (  `shipping_code` );
ALTER TABLE `dsc_shipping` ADD INDEX  `enabled` (  `enabled` );

ALTER TABLE `dsc_users` ADD INDEX  `mobile_phone` (  `mobile_phone` );

ALTER TABLE  `dsc_cart_combo` ADD  `area_city` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `area_id`;

ALTER TABLE  `dsc_cart` ADD  `area_city` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `area_id`;

ALTER TABLE `dsc_order_info` ADD `is_update_sale` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE  `dsc_user_address` CHANGE  `userUp_time`  `update_time` INT( 10 ) UNSIGNED NULL DEFAULT  '0';