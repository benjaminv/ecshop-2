ALTER TABLE `dsc_order_info` 
	ADD `street` SMALLINT( 5 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `district`;

ALTER TABLE `dsc_order_return` 
	ADD `street` SMALLINT( 5 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `district`;

ALTER TABLE `dsc_users_real` 
	ADD `user_type` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `review_time`;

ALTER TABLE `dsc_users_real` 
	ADD `bank_name` VARCHAR( 60 ) NOT NULL AFTER `bank_mobile`;

ALTER TABLE `dsc_users_real` 
	ADD `review_content` VARCHAR( 200 ) NOT NULL AFTER `add_time`;

ALTER TABLE `dsc_seller_shopinfo` 
	ADD `seller_money` DECIMAL( 10,2 ) NOT NULL;

DROP TABLE IF EXISTS `dsc_seller_account_log`;
CREATE TABLE IF NOT EXISTS `dsc_seller_account_log` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `real_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '实名认证ID',
  `ru_id` int(10) NOT NULL COMMENT '商家ID',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单ID',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商家账户金额',
  `certificate_img` varchar(255) NOT NULL DEFAULT '',
  `log_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '操作类型(1/4:提现 2:结算 3:充值)',
  `apply_sn` varchar(225) NOT NULL DEFAULT '',
  `pay_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '付款方式ID',
  `pay_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '付款时间',
  `admin_note` varchar(225) NOT NULL COMMENT '管理员回复信息',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `seller_note` varchar(225) NOT NULL COMMENT '操作描述',
  `is_paid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否付款',
  PRIMARY KEY (`log_id`),
  KEY `real_id` (`real_id`),
  KEY `admin_id` (`admin_id`),
  KEY `ru_id` (`ru_id`),
  KEY `pay_id` (`pay_id`),
  KEY `log_type` (`log_type`),
  KEY `is_paid` (`is_paid`),
  KEY `add_time` (`add_time`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;