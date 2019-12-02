ALTER TABLE `dsc_goods` 
	ADD `stages` VARCHAR( 512 ) NOT NULL DEFAULT '';
	
ALTER TABLE  `dsc_goods` 
	ADD  `stages_rate` DECIMAL( 10, 2 ) NOT NULL DEFAULT 0.5;

ALTER TABLE `dsc_cart` 
	ADD `stages_qishu` VARCHAR( 4 ) NOT NULL DEFAULT '-1';
	
CREATE TABLE IF NOT EXISTS `dsc_baitiao` (
  `baitiao_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) NOT NULL COMMENT '用户id',
  `amount` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '白条金额',
  `repay_term` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '还款期限',
  `over_repay_trem` int(11) NOT NULL DEFAULT '0' COMMENT '超过还款期限的天数',
  `add_time` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`baitiao_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='白条表';

CREATE TABLE IF NOT EXISTS `dsc_baitiao_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `baitiao_id` int(11) NOT NULL COMMENT '白条id',
  `user_id` mediumint(8) NOT NULL COMMENT '用户id',
  `use_date` varchar(50) NOT NULL COMMENT '记账日期',
  `repay_date` text NOT NULL COMMENT '还款日期',
  `order_id` mediumint(8) NOT NULL COMMENT '订单id',
  `repayed_date` varchar(50) NOT NULL DEFAULT '' COMMENT '完成支付日期',
  `is_repay` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否还款',
  `is_stages` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否为白条分期商品 1:分期 0:不分期',
  `stages_total` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '当前订单的分期总期数',
  `stages_one_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '每期金额',
  `yes_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '已还期数',
  `is_refund` tinyint(3) unsigned DEFAULT '0' COMMENT '该白条记录对应的订单是否退款了. 1:退款 0:正常;',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='白条使用记录表';

CREATE TABLE IF NOT EXISTS `dsc_stages` (
  `stages_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分期表的ID',
  `order_sn` varchar(20) NOT NULL COMMENT '订单编号',
  `stages_total` tinyint(3) unsigned NOT NULL COMMENT '总分期数',
  `stages_one_price` decimal(10,2) unsigned NOT NULL COMMENT '每期的金额',
  `yes_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '已还期数',
  `create_date` int(10) unsigned NOT NULL COMMENT '分期单创建时间',
  `repay_date` text NOT NULL COMMENT '还款日期',
  PRIMARY KEY (`stages_id`),
  KEY `order_sn` (`order_sn`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;
	
ALTER TABLE `dsc_link_brand` 
	ADD INDEX `bid` ( `bid` );
	
ALTER TABLE `dsc_link_brand` 
	ADD INDEX `brand_id` ( `brand_id` );

CREATE TABLE IF NOT EXISTS `dsc_gift_gard_type` (
  `gift_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ru_id` int(10) unsigned NOT NULL DEFAULT '0',
  `gift_name` varchar(100) NOT NULL DEFAULT '',
  `gift_menory` decimal(10,2) DEFAULT NULL,
  `gift_min_menory` decimal(10,2) DEFAULT NULL,
  `gift_start_date` int(11) NOT NULL,
  `gift_end_date` int(11) NOT NULL,
  `gift_number` smallint(5) NOT NULL,
  PRIMARY KEY (`gift_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_user_gift_gard` (
  `gift_gard_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `gift_sn` bigint(20) unsigned NOT NULL,
  `gift_password` char(32) NOT NULL,
  `user_id` mediumint(8) unsigned DEFAULT '0',
  `goods_id` mediumint(8) unsigned DEFAULT '0',
  `user_time` int(11) DEFAULT NULL,
  `express_no` varchar(64) DEFAULT '0',
  `gift_id` mediumint(8) unsigned NOT NULL,
  `address` varchar(120) DEFAULT NULL,
  `consignee_name` varchar(60) DEFAULT NULL,
  `mobile` varchar(60) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '0',
  `config_goods_id` varchar(255) DEFAULT NULL,
  `is_delete` tinyint(1) unsigned DEFAULT '1',
  `shipping_time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`gift_gard_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `dsc_order_info` 
	ADD `supplier_id` INT( 10 )  NOT NULL  DEFAULT 0;

ALTER TABLE `dsc_order_info` 
	ADD `froms` CHAR( 10 ) NOT NULL DEFAULT 'pc';

ALTER TABLE `dsc_merchants_shop_information` 
	ADD `is_street` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';

CREATE TABLE IF NOT EXISTS `dsc_auto_sms` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_type` tinyint(1) NOT NULL,
  `user_id` int(10) NOT NULL,
  `ru_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `add_time` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `dsc_order_return_extend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ret_id` int(10) unsigned NOT NULL,
  `return_number` mediumint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_gift_gard_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `gift_gard_id` int(11) unsigned NOT NULL DEFAULT '0',
  `delivery_status` tinyint(1) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;