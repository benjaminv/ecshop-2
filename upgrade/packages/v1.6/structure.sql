ALTER TABLE `dsc_warehouse_goods` 
	ADD `give_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_warehouse_goods` 
	ADD `rank_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_warehouse_goods` 
	ADD `pay_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_warehouse_area_goods` 
	ADD `give_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_warehouse_area_goods` 
	ADD `rank_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_warehouse_area_goods` 
	ADD `pay_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE  `dsc_order_info` 
	ADD  `coupons` DECIMAL( 10, 2 ) NOT NULL DEFAULT 0;

ALTER TABLE `dsc_gift_gard_log` 
	CHANGE `delivery_status` `delivery_status` VARCHAR( 255 ) NOT NULL DEFAULT '0';
	
ALTER TABLE  `dsc_order_info` 
	ADD  `is_zc_order` TINYINT( 1 ) DEFAULT 0;
	
ALTER TABLE  `dsc_order_info` 
	ADD  `zc_goods_id` INT( 11 ) DEFAULT 0;
	
ALTER TABLE `dsc_seller_shopinfo`
	ADD `kf_im_switch`  tinyint NOT NULL DEFAULT 1;

ALTER TABLE `dsc_merchants_privilege` 
	ADD `grade_id` TINYINT( 10 ) UNSIGNED NOT NULL;

ALTER TABLE `dsc_users` 
	ADD `old_user_picture` text NOT NULL;

ALTER TABLE `dsc_delivery_order` 
	ADD `is_zc_order` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';

CREATE TABLE IF NOT EXISTS `dsc_users_real` (
  `real_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` text NOT NULL,
  `real_name` varchar(60) NOT NULL DEFAULT '',
  `bank_mobile` varchar(20) NOT NULL DEFAULT '',
  `bank_card` varchar(255) NOT NULL DEFAULT '',
  `self_num` varchar(255) NOT NULL DEFAULT '',
  `add_time` int(11) NOT NULL,
  `review_status` tinyint(1) NOT NULL DEFAULT '0',
  `review_time` int(11) NOT NULL,
  PRIMARY KEY (`real_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dsc_users_paypwd` (
  `paypwd_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(8) unsigned NOT NULL,
  `ec_salt` varchar(10) DEFAULT NULL,
  `pay_password` varchar(32) NOT NULL DEFAULT '',
  `pay_online` tinyint(1) unsigned NOT NULL,
  `user_surplus` tinyint(1) unsigned NOT NULL,
  `user_point` tinyint(1) unsigned NOT NULL,
  `baitiao` tinyint(1) unsigned NOT NULL,
  `gift_card` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`paypwd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dsc_users_auth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `identity_type` varchar(32) NOT NULL DEFAULT '',
  `identifier` varchar(128) NOT NULL DEFAULT '',
  `credential` varchar(128) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dsc_seller_grade` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `grade_name` varchar(255) NOT NULL DEFAULT '',
  `goods_sun` int(255) NOT NULL,
  `seller_temp` int(255) NOT NULL,
  `favorable_rate` varchar(20) NOT NULL DEFAULT '',
  `give_integral` smallint(8) unsigned NOT NULL,
  `rank_integral` smallint(8) unsigned NOT NULL,
  `pay_integral` smallint(8) NOT NULL,
  `grade_introduce` varchar(255) NOT NULL DEFAULT '',
  `entry_criteria` varchar(255) NOT NULL DEFAULT '',
  `grade_img` varchar(255) NOT NULL DEFAULT '',
  `is_open` tinyint(1) NOT NULL DEFAULT '0',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_seller_apply_info` (
  `apply_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `ru_id` mediumint(10) NOT NULL DEFAULT '0',
  `grade_id` mediumint(8) NOT NULL DEFAULT '0',
  `apply_sn` varchar(20) NOT NULL DEFAULT '',
  `pay_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `apply_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payable_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `refund_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `back_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fee_num` smallint(5) unsigned NOT NULL DEFAULT '1',
  `pay_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `entry_criteria` varchar(255) NOT NULL DEFAULT '',
  `add_time` int(10) unsigned NOT NULL,
  `is_confirm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pay_time` int(10) unsigned NOT NULL,
  `pay_id` tinyint(3) NOT NULL DEFAULT '0',
  `is_paid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `confirm_time` int(10) unsigned NOT NULL,
  `reply_seller` varchar(255) NOT NULL DEFAULT '',
  `valid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`apply_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_merchants_grade` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ru_id` smallint(10) unsigned NOT NULL DEFAULT '0',
  `grade_id` smallint(10) unsigned NOT NULL DEFAULT '0',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `year_num` int(10) NOT NULL DEFAULT '0',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_entry_criteria` (
  `id` smallint(10) NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(10) unsigned NOT NULL DEFAULT '0',
  `criteria_name` varchar(255) NOT NULL DEFAULT '',
  `charge` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `standard_name` varchar(60) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `is_mandatory` tinyint(1) NOT NULL DEFAULT '0',
  `option_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_collect_brand` (
  `rec_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `brand_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `add_time` int(11) unsigned NOT NULL DEFAULT '0',
  `ru_id` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rec_id`),
  KEY `user_id` (`user_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dsc_alidayu_configure` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `temp_id` varchar(255) NOT NULL DEFAULT '',
  `temp_content` varchar(255) NOT NULL DEFAULT '',
  `add_time` int(15) NOT NULL,
  `set_sign` varchar(255) NOT NULL DEFAULT '',
  `send_time` varchar(255) NOT NULL DEFAULT '',
  `signature` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `temp_id` (`temp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_coupons` (
  `cou_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cou_name` varchar(128) NOT NULL DEFAULT '',
  `cou_total` int(11) NOT NULL DEFAULT '0',
  `cou_man` decimal(10,0) unsigned NOT NULL DEFAULT '0',
  `cou_money` decimal(10,0) unsigned NOT NULL DEFAULT '0',
  `cou_user_num` int(11) unsigned NOT NULL DEFAULT '1',
  `cou_goods` varchar(255) NOT NULL DEFAULT '0',
  `cou_start_time` int(10) unsigned NOT NULL DEFAULT '0',
  `cou_end_time` int(10) unsigned NOT NULL DEFAULT '0',
  `cou_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `cou_get_man` decimal(10,0) NOT NULL DEFAULT '0',
  `cou_ok_user` varchar(255) NOT NULL DEFAULT '0',
  `cou_ok_goods` varchar(255) NOT NULL DEFAULT '0',
  `cou_intro` text NOT NULL,
  `cou_add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `ru_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `cou_order` int(11) unsigned NOT NULL DEFAULT '0',
  `cou_title` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`cou_id`),
  KEY `cou_type` (`cou_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `dsc_coupons_user` (
  `uc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `cou_id` int(11) DEFAULT NULL,
  `is_use` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `uc_sn` char(12) NOT NULL DEFAULT '0',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `is_use_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uc_id`),
  KEY `user_id` (`user_id`,`cou_id`,`is_use`,`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
	
CREATE TABLE IF NOT EXISTS `dsc_zc_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(90) NOT NULL DEFAULT '',
  `cat_desc` varchar(255) NOT NULL DEFAULT '',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sort_order` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`cat_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_zc_focus` (
  `rec_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `add_time` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`rec_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_zc_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `limit` int(11) NOT NULL,
  `backer_num` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `shipping_fee` decimal(10,0) NOT NULL,
  `content` text NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT '',
  `return_time` int(11) NOT NULL,
  `backer_list` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_zc_initiator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `company` varchar(255) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL DEFAULT '',
  `intro` text NOT NULL,
  `describe` text NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_zc_progress` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `progress` text NOT NULL,
  `add_time` varchar(255) NOT NULL DEFAULT '',
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_zc_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `init_id` varchar(255) NOT NULL DEFAULT '',
  `start_time` varchar(255) NOT NULL DEFAULT '',
  `end_time` varchar(255) NOT NULL DEFAULT '',
  `amount` decimal(10,0) NOT NULL,
  `join_money` decimal(10,0) NOT NULL,
  `join_num` int(11) NOT NULL,
  `focus_num` int(11) NOT NULL,
  `prais_num` int(11) NOT NULL,
  `title_img` varchar(255) NOT NULL DEFAULT '',
  `describe` text NOT NULL,
  `risk_instruction` text NOT NULL,
  `img` text NOT NULL,
  `is_best` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_zc_rank_logo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo_name` varchar(255) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL DEFAULT '',
  `logo_intro` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dsc_zc_topic` (
  `topic_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_topic_id` int(11) NOT NULL,
  `reply_topic_id` int(11) NOT NULL,
  `topic_status` tinyint(1) NOT NULL,
  `topic_content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `add_time` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`topic_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;