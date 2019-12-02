<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_3_3
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

	public function up_v2_3_3()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$field = get_table_file_name($GLOBALS['ecs']->table('goods_inventory_logs'), 'suppliers_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_inventory_logs') . ' ADD  `suppliers_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `area_id`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('users_log') . ' (
		  `log_id` int(10) NOT NULL AUTO_INCREMENT,
		  `user_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `change_time` int(10) NOT NULL DEFAULT \'0\',
		  `change_type` tinyint(3) unsigned NOT NULL DEFAULT \'0\',
		  `ip_address` varchar(15) NOT NULL,
		  `change_city` varchar(255) NOT NULL,
		  `logon_service` varchar(60) NOT NULL DEFAULT \'pc\',
		  PRIMARY KEY (`log_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('users_log'), 'admin_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_log') . ' ADD `admin_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `user_id` ;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('gift_gard_log') . ' CHANGE `delivery_status` `delivery_status` VARCHAR( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' CHANGE `goods_amount` `goods_amount` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\', 
		CHANGE `cost_amount` `cost_amount` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\' COMMENT \'订单成本\', 
		CHANGE `shipping_fee` `shipping_fee` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\', 
		CHANGE `insure_fee` `insure_fee` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\', 
		CHANGE `pay_fee` `pay_fee` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\', 
		CHANGE `pack_fee` `pack_fee` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\', 
		CHANGE `card_fee` `card_fee` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\', 
		CHANGE `money_paid` `money_paid` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\', 
		CHANGE `surplus` `surplus` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\', 
		CHANGE `integral_money` `integral_money` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\', 
		CHANGE `bonus` `bonus` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\', 
		CHANGE `tax` `tax` DECIMAL(10,2) UNSIGNED NOT NULL, 
		CHANGE `discount` `discount` DECIMAL(10,2) UNSIGNED NOT NULL, 
		CHANGE `coupons` `coupons` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_return') . ' CHANGE `should_return` `should_return` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT \'0.00\',
		CHANGE `actual_return` `actual_return` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT \'0.00\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('merchants_shop_information'), 'store_score');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' ADD `store_score` TINYINT( 1 ) NOT NULL DEFAULT \'5\' AFTER `sort_order` ;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('goods_inventory_logs'), 'batch_number');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_inventory_logs') . ' ADD `batch_number` VARCHAR(50) NOT NULL;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('goods_inventory_logs'), 'remark');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_inventory_logs') . ' ADD `remark` VARCHAR(255) NOT NULL;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' CHANGE `goods_number` `goods_number` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'1\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' CHANGE `send_number` `send_number` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('return_goods') . ' CHANGE `return_number` `return_number` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'goods_psi\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'seller_store_setup\'';
			$action_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, \'' . $action_id . '\', \'goods_psi\', \'\', \'1\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'floor_nav_type\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
			$config_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'floor_nav_type\', \'select\', \'1,2,3,4\', \'\', \'1\', \'1\', \'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'register_article_id\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
			$config_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id` ,`parent_id` ,`code` ,`type` ,`store_range` ,`store_dir` ,`value` ,`sort_order` ,`shop_group`) VALUES (NULL ,  \'' . $config_id . '\',  \'register_article_id\',  \'text\',  \'\',  \'\',  \'\',  \'1\',  \'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'seller_index_article\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
			$config_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`parent_id`, `code`, `type`, `shop_group`) VALUES (\'' . $config_id . '\', \'seller_index_article\', \'text\', \'seller\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `type` = \'hidden\', value = 1 WHERE `code` = \'sms_find_signin\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET `seller_show` = \'1\' WHERE `action_code` = \'logs_manage\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET `seller_show` = \'1\' WHERE `action_code` = \'logs_drop\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET  `seller_show` =  \'0\' WHERE `action_code` =\'goods_report\';';
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
