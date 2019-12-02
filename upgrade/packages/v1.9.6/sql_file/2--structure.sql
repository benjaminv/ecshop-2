ALTER TABLE  `dsc_goods` ADD  `freight` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  '0',
ADD  `shipping_fee` DECIMAL( 10, 2 ) NOT NULL DEFAULT  '0.00',
ADD  `tid` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0';

DROP TABLE IF EXISTS `dsc_goods_transport`;
CREATE TABLE `dsc_goods_transport` (
  `tid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ru_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL DEFAULT '',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `ru_id` (`ru_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dsc_goods_transport_extend`;
CREATE TABLE IF NOT EXISTS `dsc_goods_transport_extend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ru_id` int(10) unsigned NOT NULL DEFAULT '0',
  `admin_id` int(10) unsigned NOT NULL DEFAULT '0',
  `area_id` text NOT NULL,
  `top_area_id` text NOT NULL,
  `sprice` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`),
  KEY `ru_id` (`ru_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_goods_transport_express`;
CREATE TABLE IF NOT EXISTS `dsc_goods_transport_express` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ru_id` int(10) unsigned NOT NULL DEFAULT '0',
  `admin_id` int(10) unsigned NOT NULL DEFAULT '0',
  `shipping_id` text NOT NULL,
  `shipping_fee` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`),
  KEY `ru_id` (`ru_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_pay_card`;
CREATE TABLE IF NOT EXISTS `dsc_pay_card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_number` varchar(60) NOT NULL DEFAULT '',
  `card_psd` varchar(40) NOT NULL DEFAULT '',
  `user_id` int(20) NOT NULL,
  `used_time` varchar(40) NOT NULL DEFAULT '',
  `status` smallint(5) unsigned DEFAULT '0',
  `c_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  UNIQUE KEY `card_number` (`card_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_pay_card_type`;
CREATE TABLE IF NOT EXISTS `dsc_pay_card_type` (
  `type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(40) NOT NULL DEFAULT '',
  `type_money` float(9,2) NOT NULL,
  `type_prefix` varchar(10) NOT NULL DEFAULT '',
  `use_end_date` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_value_card`;
CREATE TABLE `dsc_value_card` (
  `vid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tid` int(10) NOT NULL COMMENT '储值卡类型ID',
  `value_card_sn` varchar(30) NOT NULL COMMENT '储值卡账号',
  `value_card_password` varchar(20) NOT NULL COMMENT '储值卡密码',
  `user_id` int(10) NOT NULL COMMENT '绑定用户ID',
  `vc_value` int(10) NOT NULL,
  `card_money` decimal(10,2) unsigned NOT NULL COMMENT '卡内余额',
  `bind_time` int(11) NOT NULL COMMENT '绑定时间',
  `end_time` int(11) NOT NULL COMMENT '截止日期',
  PRIMARY KEY (`vid`),
  KEY `tid` (`tid`),
  KEY `user_id` (`user_id`),
  UNIQUE KEY `value_card_sn` (`value_card_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dsc_value_card_record`;
CREATE TABLE IF NOT EXISTS `dsc_value_card_record` (
  `rid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `vc_id` int(10) NOT NULL COMMENT '储值卡ID',
  `order_id` int(10) NOT NULL COMMENT '订单ID',
  `use_val` decimal(10,2) NOT NULL COMMENT '使用金额',
  `add_val` int(10) NOT NULL COMMENT '充值金额',
  `record_time` int(11) NOT NULL COMMENT '记录时间',
  PRIMARY KEY (`rid`),
  KEY `vc_id` (`vc_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_value_card_type`;
CREATE TABLE IF NOT EXISTS `dsc_value_card_type` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(180) DEFAULT NULL COMMENT '类型名称',
  `vc_desc` varchar(255) DEFAULT NULL COMMENT '描述',
  `vc_value` decimal(10,0) NOT NULL COMMENT '面值',
  `vc_prefix` varchar(10) NOT NULL DEFAULT '',
  `vc_dis` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT '折扣率',
  `vc_limit` tinyint(5) NOT NULL DEFAULT '1' COMMENT '限制数量',
  `use_condition` tinyint(1) NOT NULL DEFAULT '0' COMMENT '使用条件',
  `spec_goods` varchar(255) NOT NULL COMMENT '指定商品',
  `spec_cat` varchar(255) NOT NULL COMMENT '指定分类',
  `vc_indate` tinyint(3) NOT NULL COMMENT '有效期单位为自然月',
  `is_rec` tinyint(1) NOT NULL DEFAULT '0' COMMENT '可否充值',
  `add_time` int(11) NOT NULL COMMENT '储值卡类型新增时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `dsc_goods` ADD INDEX ( `freight` ) ;

ALTER TABLE `dsc_goods` ADD INDEX ( `tid` ) ;

ALTER TABLE  `dsc_goods_extend` ADD  `width` VARCHAR( 50 ) NOT NULL ,
ADD  `height` VARCHAR( 50 ) NOT NULL ,
ADD  `depth` VARCHAR( 50 ) NOT NULL ,
ADD  `origincountry` VARCHAR( 50 ) NOT NULL ,
ADD  `originplace` VARCHAR( 50 ) NOT NULL ,
ADD  `assemblycountry` VARCHAR( 50 ) NOT NULL ,
ADD  `barcodetype` VARCHAR( 50 ) NOT NULL ,
ADD  `catena` VARCHAR( 50 ) NOT NULL ,
ADD  `isbasicunit` VARCHAR( 50 ) NOT NULL ,
ADD  `packagetype` VARCHAR( 50 ) NOT NULL ,
ADD  `grossweight` VARCHAR( 50 ) NOT NULL ,
ADD  `netweight` VARCHAR( 50 ) NOT NULL ,
ADD  `netcontent` VARCHAR( 50 ) NOT NULL ,
ADD  `licensenum` VARCHAR( 50 ) NOT NULL ,
ADD  `healthpermitnum` VARCHAR( 50 ) NOT NULL;

ALTER TABLE `dsc_cart` ADD `freight` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0',
ADD `tid` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_cart` ADD `shipping_fee` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT '0.00';

ALTER TABLE `dsc_order_goods` ADD `shipping_fee` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT '0.00';

ALTER TABLE  `dsc_seller_shopinfo` ADD  `js_appkey` VARCHAR( 50 ) NOT NULL ,
ADD  `js_appsecret` VARCHAR( 50 ) NOT NULL;

ALTER TABLE `dsc_comment` ADD `rec_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `order_id` ;

ALTER TABLE `dsc_comment_img` ADD `rec_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `order_id` ;

ALTER TABLE  `dsc_category` ADD  `commission_rate` SMALLINT( 5 ) UNSIGNED NOT NULL DEFAULT  '0'; 

ALTER TABLE `dsc_goods` ADD COLUMN `desc_mobile`  text NOT NULL AFTER `goods_desc`;

ALTER TABLE `dsc_cart` ADD `store_mobile` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `shipping_fee` ;

ALTER TABLE `dsc_cart` ADD `take_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `store_mobile` ;

ALTER TABLE `dsc_store_order` ADD `take_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `pick_code`; 

ALTER TABLE `dsc_order_goods` ADD `freight` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `is_single` ,
ADD `tid` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `freight` ;

ALTER TABLE `dsc_order_goods` ADD INDEX ( `freight` ) ;

ALTER TABLE `dsc_order_goods` ADD INDEX ( `tid` ) ;