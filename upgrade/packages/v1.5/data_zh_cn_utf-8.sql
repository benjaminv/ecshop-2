ALTER TABLE  `dsc_seller_shopinfo` ADD  `user_menu` TEXT NOT NULL COMMENT  '店铺快捷菜单' AFTER  `kf_secretkey`;
ALTER TABLE `dsc_warehouse_goods` CHANGE `goods_id` `goods_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `dsc_warehouse_goods` CHANGE `user_id` `user_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `dsc_warehouse_goods` CHANGE `region_id` `region_id` INT( 11 ) NOT NULL DEFAULT '0';
ALTER TABLE `dsc_warehouse_area_goods` CHANGE `goods_id` `goods_id` INT( 11 ) NOT NULL DEFAULT '0';
ALTER TABLE `dsc_warehouse_area_goods` CHANGE `user_id` `user_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `dsc_warehouse_area_goods` CHANGE `region_id` `region_id` INT( 11 ) NOT NULL DEFAULT '0';
