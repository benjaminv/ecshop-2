ALTER TABLE  `dsc_seller_commission_bill` ADD  `drp_money` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT  '0.00' AFTER  `return_shippingfee`;

ALTER TABLE `dsc_virtual_card` CHANGE `card_sn` `card_sn` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '', 
CHANGE `card_password` `card_password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '';

ALTER TABLE  `dsc_area_region` CHANGE  `shipping_area_id`  `shipping_area_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0',
CHANGE  `region_id`  `region_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0';

ALTER TABLE  `dsc_solve_dealconcurrent` ADD  `flow_type` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '商品类型（flow_type：秒杀、普通商品）' AFTER  `orec_id` ,
ADD INDEX (  `flow_type` );

ALTER TABLE  `dsc_cart_combo` ADD  `ru_id` INT( 10 ) NOT NULL DEFAULT  '0' AFTER  `goods_attr_id` ,
ADD INDEX (  `ru_id` );

ALTER TABLE  `dsc_value_card_record` ADD  `vc_dis` DECIMAL( 10, 2 ) NOT NULL DEFAULT  '0.00' AFTER  `use_val`;