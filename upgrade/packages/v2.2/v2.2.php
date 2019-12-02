<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_2
{
	/**
     * 本升级包中SQL文件存放的位置（相对于升级包所在的路径）。每个版本类必须有该属性。
     */
	public $sql_files = array(
		'structure' => 'structure.sql',
		'data'      => array('zh_cn_utf-8' => 'data_zh_cn_utf-8.sql')
	);
	/**
     * 本升级包是否进行智能化的查询操作。每个版本类必须有该属性。
     */
	public $auto_match = true;

	public function __construct()
	{
	}

	public function up_v2_2()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `type` = \'hidden\' WHERE `code` = \'wap_config\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_server') . ' ADD `cycle` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'2\' AFTER `suppliers_percent` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_server') . ' CHANGE `server_id` `server_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
		CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_server') . ' ADD `commission_model` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `suppliers_percent` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD `chargeoff_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_return') . ' ADD `chargeoff_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('seller_bill_goods') . ' (
		  `id` int(10) NOT NULL AUTO_INCREMENT,
		  `rec_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `order_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `goods_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `cat_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `proportion` varchar(20) NOT NULL DEFAULT \'\',
		  `goods_price` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `goods_number` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `goods_attr` text NOT NULL,
		  `drp_money` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  PRIMARY KEY (`id`),
		  KEY `rec_id` (`rec_id`),
		  KEY `order_id` (`order_id`),
		  KEY `goods_id` (`goods_id`),
		  KEY `cat_id` (`cat_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('seller_bill_order') . ' (
		  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `bill_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `user_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `seller_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `order_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `order_sn` varchar(255) NOT NULL DEFAULT \'\',
		  `order_status` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  `shipping_status` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  `pay_status` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  `order_amount` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `return_amount` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `return_shippingfee` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `goods_amount` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `tax` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `shipping_fee` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `insure_fee` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `pay_fee` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `pack_fee` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `card_fee` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `bonus` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `integral_money` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `coupons` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `discount` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `value_card` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `money_paid` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `surplus` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `drp_money` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `confirm_take_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `chargeoff_status` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  PRIMARY KEY (`id`),
		  UNIQUE KEY `order_id` (`order_id`),
		  UNIQUE KEY `order_sn` (`order_sn`),
		  KEY `seller_id` (`seller_id`),
		  KEY `user_id` (`user_id`),
		  KEY `bill_id` (`bill_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('seller_commission_bill') . ' (
		  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `seller_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `bill_sn` varchar(255) NOT NULL DEFAULT \'\',
		  `order_amount` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `shipping_amount` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `return_amount` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `return_shippingfee` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `proportion` varchar(20) NOT NULL DEFAULT \'\',
		  `commission_model` tinyint(1) NOT NULL DEFAULT \'-1\',
		  `gain_commission` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `should_amount` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `chargeoff_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `settleaccounts_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `start_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `end_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `chargeoff_status` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  `bill_cycle` tinyint(1) unsigned NOT NULL DEFAULT \'2\',
		  `bill_apply` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  `apply_note` varchar(255) NOT NULL DEFAULT \'\',
		  `apply_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `operator` varchar(255) NOT NULL DEFAULT \'\',
		  `check_status` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  `reject_note` varchar(255) NOT NULL DEFAULT \'\',
		  `check_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `frozen_money` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `frozen_data` smallint(5) unsigned NOT NULL DEFAULT \'0\',
		  `frozen_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  PRIMARY KEY (`id`),
		  KEY `seller_id` (`seller_id`),
		  KEY `bill_cycle` (`bill_cycle`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_rank') . ' CHANGE `rank_id` `rank_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users') . ' CHANGE `user_rank` `user_rank` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('appeal_img') . ' (
		  `img_id` int(10) NOT NULL AUTO_INCREMENT,
		  `order_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `complaint_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `ru_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `img_file` varchar(255) NOT NULL,
		  PRIMARY KEY (`img_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('complaint') . ' (
		  `complaint_id` int(10) NOT NULL AUTO_INCREMENT,
		  `order_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `order_sn` varchar(255) NOT NULL,
		  `user_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `user_name` varchar(60) NOT NULL,
		  `ru_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `shop_name` varchar(60) NOT NULL,
		  `title_id` smallint(5) unsigned NOT NULL DEFAULT \'0\',
		  `complaint_content` text NOT NULL,
		  `add_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `complaint_handle_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `admin_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `appeal_messg` text NOT NULL,
		  `appeal_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `end_handle_time` int(10) NOT NULL DEFAULT \'0\',
		  `end_admin_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `end_handle_messg` text NOT NULL,
		  `complaint_state` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  `complaint_active` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  PRIMARY KEY (`complaint_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('complaint_img') . ' (
		  `img_id` int(10) NOT NULL AUTO_INCREMENT,
		  `order_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `complaint_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `user_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `img_file` varchar(255) NOT NULL,
		  PRIMARY KEY (`img_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('complaint_talk') . ' (
		  `talk_id` int(10) NOT NULL AUTO_INCREMENT,
		  `complaint_id` int(10) unsigned NOT NULL,
		  `talk_member_id` int(10) unsigned NOT NULL,
		  `talk_member_name` varchar(30) NOT NULL,
		  `talk_member_type` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  `talk_content` varchar(255) NOT NULL,
		  `talk_state` tinyint(1) unsigned NOT NULL DEFAULT \'1\',
		  `admin_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `talk_time` int(10) NOT NULL DEFAULT \'0\',
		  `view_state` varchar(60) NOT NULL,
		  PRIMARY KEY (`talk_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('complain_title') . ' (
		  `title_id` int(10) NOT NULL AUTO_INCREMENT,
		  `title_name` varchar(30) NOT NULL,
		  `title_desc` varchar(255) NOT NULL,
		  PRIMARY KEY (`title_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_server') . ' ADD `bill_freeze_day` SMALLINT( 5 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `commission_model` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD  `invoice_type` TINYINT( 1 ) NOT NULL DEFAULT  \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD  `vat_id` int( 11 ) NOT NULL DEFAULT  \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('users_vat_invoices_info') . ' (
		  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `user_id` mediumint(8) NOT NULL,
		  `company_name` varchar(60) NOT NULL DEFAULT \'\',
		  `company_address` varchar(255) NOT NULL DEFAULT \'\',
		  `tax_id` varchar(20) NOT NULL DEFAULT \'\',
		  `company_telephone` varchar(20) NOT NULL DEFAULT \'\',
		  `bank_of_deposit` varchar(20) NOT NULL DEFAULT \'\',
		  `bank_account` varchar(30) NOT NULL DEFAULT \'\',
		  `consignee_name` varchar(20) NOT NULL DEFAULT \'\',
		  `consignee_mobile_phone` varchar(15) NOT NULL DEFAULT \'\',
		  `consignee_province` varchar(20) NOT NULL DEFAULT \'\',
		  `consignee_address` varchar(255) NOT NULL DEFAULT \'\',
		  `audit_status` tinyint(1) NOT NULL DEFAULT \'0\',
		  `add_time` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('goods_report') . ' (
		  `report_id` int(10) NOT NULL AUTO_INCREMENT,
		  `user_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `user_name` varchar(60) NOT NULL,
		  `goods_id` int(11) unsigned NOT NULL DEFAULT \'0\',
		  `goods_name` varchar(120) NOT NULL,
		  `goods_image` varchar(255) NOT NULL,
		  `title_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `type_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `inform_content` text NOT NULL,
		  `add_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `report_state` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  `handle_type` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  `handle_message` text NOT NULL,
		  `handle_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `admin_id` int(10) NOT NULL DEFAULT \'0\',
		  PRIMARY KEY (`report_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('goods_report_img') . ' (
		  `img_id` int(10) NOT NULL AUTO_INCREMENT,
		  `goods_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `report_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `user_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `img_file` varchar(255) NOT NULL,
		  PRIMARY KEY (`img_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('goods_report_title') . ' (
		  `title_id` int(10) NOT NULL AUTO_INCREMENT,
		  `type_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `title_name` varchar(60) NOT NULL,
		  PRIMARY KEY (`title_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('goods_report_type') . ' (
		  `type_id` int(10) NOT NULL AUTO_INCREMENT,
		  `type_name` varchar(60) NOT NULL,
		  `type_desc` text NOT NULL,
		  PRIMARY KEY (`type_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_server') . ' ADD `day_number` SMALLINT( 8 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `cycle` ,
ADD `bill_time` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `day_number` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users') . ' ADD `report_time` INT( 11 ) NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($ecs->table('order_goods'), 'drp_money');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' ADD `drp_money` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT \'0.00\';';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($ecs->table('order_info'), 'confirm_take_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD `confirm_take_time` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `shipping_time`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complain_title') . ' ADD `is_show` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `title_desc` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_report_type') . ' ADD `is_show` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `type_desc` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_report_title') . ' ADD `is_show` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `title_name` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `type` = \'file\' WHERE `code` = \'watermark\';';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' ( `parent_id` , `action_code` , `seller_show` ) VALUES ( 6, \'exchange\', 1 ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' ( `parent_id` , `action_code` , `seller_show` ) VALUES ( 6, \'complaint\', 1 ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code` , `seller_show` ) VALUES (\'7\', \'seckill_manage\', 0 );';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code` , `seller_show` ) VALUES (\'3\', \'user_vat_manage\', 1 );';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `type` = \'hidden\', `store_range` = \'0,1\' WHERE `code` = \'commission_model\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
		$config_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' ( `parent_id` , `code` , `type` , `store_range` , `value` , `sort_order` , `shop_group` ) VALUES ( \'' . $config_id . '\', \'report_handle\', \'select\', \'0,1\', 1, \'15\', \'report_conf\' ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' ( `parent_id` , `code` , `type` , `value` , `sort_order` , `shop_group` ) VALUES ( \'' . $config_id . '\', \'report_handle_time\', \'text\', \'30\', \'15\', \'report_conf\' ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' ( `parent_id` , `action_code` ) VALUES ( 1, \'goods_report\') ;';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('goods_report_type') . ' (`type_id`, `type_name`, `type_desc`) VALUES (1, \'出售禁售品\', \'销售商城禁止和限制交易规则下所规定的所有商品。\'), (2, \'产品质量问题\', \'产品质量差，与描述严重不相符。\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('goods_report_title') . ' (`type_id`, `title_name`, `is_show`) VALUES
		(1, \'枪支弹药\', 1),
		(1, \'管制刀具、弓弩类、其他武器等\', 1),
		(1, \'赌博用具类\', 1),
		(1, \'毒品及吸毒工具\', 1),
		(2, \'色差大，质量差。\', 1),
		(2, \'描述与实物严重不符\', 1);';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('goods_report_type') . ' (`type_name`, `type_desc`, `is_show`) VALUES
(\'出售禁售品\', \'销售商城禁止和限制交易规则下所规定的所有商品。\', 1),
(\'产品质量问题\', \'产品质量差，与描述严重不相符。\', 1);';
		$GLOBALS['db']->query($sql);
	}

	public function update_files()
	{
		$result = file_mode_info(ROOT_PATH . 'data/');

		if ($result < 2) {
			exit('ERROR, ' . ROOT_PATH . 'data/ isn\'t a writeable directory.');
		}

		if (!file_exists(ROOT_PATH . 'data/config.php')) {
			if (file_exists(ROOT_PATH . 'includes/config.php')) {
				copy(ROOT_PATH . 'includes/config.php', ROOT_PATH . 'data/config.php');
			}
			else {
				exit('ERROR, can\'t find config.php.');
			}
		}

		if (!file_exists(ROOT_PATH . 'data/install.lock.php')) {
			if (file_exists(ROOT_PATH . 'includes/install.lock.php')) {
				copy(ROOT_PATH . 'includes/install.lock.php', ROOT_PATH . 'data/install.lock.php');
			}
			else {
				exit('ERROR, can\'t find install.lock.php.');
			}
		}
	}
}


?>
