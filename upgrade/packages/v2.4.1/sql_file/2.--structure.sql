
ALTER TABLE `dsc_merchants_shop_information` ADD `shop_close` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否关闭店铺（0：关闭，1：开启）' AFTER `self_run`, ADD INDEX `shop_close` (`shop_close`);

ALTER TABLE `dsc_seller_shopinfo` CHANGE `status` `shop_close` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '是否关闭店铺（0：关闭，1：开启）';