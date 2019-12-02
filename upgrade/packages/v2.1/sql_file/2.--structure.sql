CREATE TABLE IF NOT EXISTS `dsc_trade_snapshot` (
`trade_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`order_sn` varchar(255) NOT NULL,
`user_id` mediumint(8) NOT NULL,
`goods_id` mediumint(8) NOT NULL,
`goods_name` varchar(120) NOT NULL DEFAULT '',
`goods_sn` varchar(60) NOT NULL DEFAULT '',
`shop_price` decimal(10,2) NOT NULL DEFAULT '0.00',
`goods_number` smallint(5) NOT NULL DEFAULT '1',
`shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
`rz_shopName` varchar(60) NOT NULL,
`goods_weight` decimal(10,3) NOT NULL DEFAULT '0.000',
`add_time` int(11) NOT NULL DEFAULT '0',
`goods_attr` varchar(255) NOT NULL,
`goods_attr_id` varchar(255) NOT NULL DEFAULT '',
`ru_id` int(11) NOT NULL DEFAULT '0',
`goods_desc` text NOT NULL,
`goods_img` varchar(255) NOT NULL DEFAULT '',
PRIMARY KEY (`trade_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

ALTER TABLE `dsc_templates_left` ADD `theme` VARCHAR( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `type` ;

ALTER TABLE `dsc_warehouse_goods` CHANGE `w_id` `w_id` INT( 10 ) NOT NULL AUTO_INCREMENT ,
CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `goods_id` `goods_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `region_id` `region_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `region_sn` `region_sn` VARCHAR( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
CHANGE `give_integral` `give_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `rank_integral` `rank_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `pay_integral` `pay_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `add_time` `add_time` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `last_update` `last_update` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_warehouse_area_goods` CHANGE `a_id` `a_id` INT( 10 ) NOT NULL AUTO_INCREMENT ,
CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `goods_id` `goods_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `region_id` `region_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `region_sn` `region_sn` VARCHAR( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
CHANGE `region_sort` `region_sort` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `add_time` `add_time` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `last_update` `last_update` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_users_real` ADD  `front_of_id_card` VARCHAR( 60 ) NOT NULL COMMENT  '身份证正面',
ADD  `reverse_of_id_card` VARCHAR( 60 ) NOT NULL COMMENT  '身份证反面';

ALTER TABLE `dsc_goods` ADD `goods_cause` VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `goods_unit` ;

ALTER TABLE `dsc_trade_snapshot` ADD  `snapshot_time` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '快照新增时间';

ALTER TABLE `dsc_value_card_type` ADD  `use_merchants` VARCHAR( 255 ) NOT NULL DEFAULT  'self' COMMENT  '可使用店铺' AFTER  `use_condition`;

ALTER TABLE  `dsc_presale_activity` ADD  `pre_num` int(10) unsigned NOT NULL DEFAULT '0' AFTER  `review_content`;

ALTER TABLE `dsc_source_ip` ENGINE = MYISAM ;