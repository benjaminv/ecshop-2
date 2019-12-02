<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_3_5
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

	public function up_v2_3_5()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('admin_log') . ' CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('shipping'), 'customer_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping') . ' ADD `customer_name` VARCHAR(50) NOT NULL AFTER `shipping_order`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('shipping'), 'customer_pwd');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping') . ' ADD `customer_pwd` VARCHAR(50) NOT NULL AFTER `customer_name`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('seller_shopinfo'), 'print_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_shopinfo') . ' ADD `print_type` TINYINT(1) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `js_appsecret`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('seller_shopinfo'), 'kdniao_printer');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_shopinfo') . ' ADD `kdniao_printer` VARCHAR(50) NOT NULL AFTER `print_type`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('order_print_size') . ' (
		  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
		  `type` varchar(50) NOT NULL,
		  `specification` varchar(50) NOT NULL,
		  `width` varchar(50) NOT NULL,
		  `height` varchar(50) NOT NULL,
		  `size` varchar(50) NOT NULL,
		  `description` varchar(255) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('order_print_setting') . ' (
		  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `ru_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `specification` varchar(50) NOT NULL,
		  `printer` varchar(50) NOT NULL,
		  `is_default` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  PRIMARY KEY (`id`),
		  KEY `ru_id` (`ru_id`)
		) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
		$config_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'buyer_cash\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' ( `parent_id` , `code` , `type` , `value` , `sort_order`, `shop_group`) VALUES ( \'' . $config_id . '\', \'buyer_cash\', \'text\', 1, 2, \'\') ;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'buyer_recharge\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' ( `parent_id` , `code` , `type` , `value` , `sort_order`, `shop_group`) VALUES ( \'' . $config_id . '\', \'buyer_recharge\', \'text\', 1, 2, \'\') ;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'email\'';
		$action_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET `parent_id` = \'' . $action_id . '\' WHERE `action_code` = \'mail_template\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'mail_settings\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, \'' . $action_id . '\', \'mail_settings\', \'\', \'0\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET `seller_show` = 0 WHERE `parent_id` = \'' . $action_id . '\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'tp_api\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'0\', \'tp_api\', \'hidden\', \'\', \'\', \'\', \'1\', \'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'tp_api\'';
		$config_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'kdniao_client_id\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'kdniao_client_id\', \'text\', \'\', \'\', \'\', \'1\', \'tp_api\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'kdniao_appkey\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'kdniao_appkey\', \'text\', \'\', \'\', \'\', \'1\', \'tp_api\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'order_print_setting\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'sys_manage\'';
			$action_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, \'' . $action_id . '\', \'order_print_setting\', \'\', \'1\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('order_print_size') . ' WHERE specification = \'100MM\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('order_print_size') . ' (`id`, `type`, `specification`, `width`, `height`, `size`, `description`) VALUES
			(1, \'100\', \'100MM\', \'100\', \'\', \'100mm\', \'\'),
			(2, \'80\', \'80MM\', \'80\', \'\', \'80mm\', \'\'),
			(3, \'70\', \'70MM\', \'70\', \'\', \'70mm\', \'\'),
			(4, \'60\', \'60MM\', \'60\', \'\', \'60mm\', \'\'),
			(5, \'50\', \'50MM\', \'50\', \'\', \'50mm\', \'\'),
			(6, \'A4\', \'A4纸张\', \'210\', \'297\', \'210mm x 297mm\', \'当打印设置选择A4纸张、竖向打印、无边距时每张A4打印纸可输出2页订单。\'),
			(7, \'120\', \'120MM*93MM\', \'120\', \'93\', \'120mm x 93mm\', \'\'),
			(8, \'120\', \'120MM*140MM\', \'120\', \'140\', \'120mm x 140mm\', \'\'),
			(9, \'120\', \'120MM*280MM\', \'120\', \'280\', \'120mm x 280mm\', \'\'),
			(10, \'190\', \'190MM*93MM\', \'190\', \'93\', \'190mm x 93mm\', \'\'),
			(11, \'190\', \'190MM*140MM\', \'190\', \'140\', \'190mm x 140mm\', \'\'),
			(12, \'190\', \'190MM*280MM\', \'190\', \'280\', \'190mm x 280mm\', \'\'),
			(13, \'210\', \'210MM*145MM\', \'210\', \'145\', \'210mm x 145mm\', \'\'),
			(14, \'241\', \'241MM*93MM\', \'241\', \'93\', \'241mm x 93mm\', \'\'),
			(15, \'241\', \'241MM*139MM\', \'241\', \'139\', \'241mm x 139mm\', \'\'),
			(16, \'241\', \'241MM*280MM\', \'241\', \'280\', \'241mm x 280mm\', \'\');';
			$GLOBALS['db']->query($sql);
		}
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
