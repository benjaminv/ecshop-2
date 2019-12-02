<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_5_1
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

	public function up_v2_5_1()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$field = get_table_file_name($GLOBALS['ecs']->table('goods'), 'cloud_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD `cloud_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `product_promote_price`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('attribute'), 'cloud_attr_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('attribute') . ' ADD  `cloud_attr_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `attr_input_category`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('goods_attr'), 'cloud_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_attr') . ' ADD  `cloud_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `admin_id`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('products'), 'cloud_product_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products') . ' ADD  `cloud_product_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `admin_id`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('products'), 'inventoryid');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products') . ' ADD  `inventoryid` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `cloud_product_id`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('goods'), 'cloud_goodsname');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD `cloud_goodsname` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER  `cloud_id`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('order_cloud') . ' (
		  `id` int(10) NOT NULL AUTO_INCREMENT,
		  `apiordersn` varchar(255) NOT NULL,
		  `goods_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `user_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `totalprice` decimal(10,2) NOT NULL DEFAULT \'0.00\',
		  `rec_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `parentordersn` varchar(255) NOT NULL,
		  `cloud_orderid` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `cloud_detailed_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('order_return_extend'), 'aftersn');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_return_extend') . ' ADD  `aftersn` VARCHAR( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER  `return_number`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('entry_criteria'), 'data_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('entry_criteria') . ' ADD  `data_type` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `option_value`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('article'), 'sort_order');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('article') . ' ADD  `sort_order` SMALLINT( 8 ) UNSIGNED NOT NULL DEFAULT  \'50\' AFTER  `description`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('discuss_circle'), 'review_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('discuss_circle') . ' ADD  `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  \'1\' AFTER  `dis_browse_num` ,
			ADD  `review_content` VARCHAR( 1000 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER  `review_status`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('goods'), 'is_show');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD  `is_show` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  \'1\' AFTER  `product_price`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE `code` = \'extend_basic\';';
		$config_id = $GLOBALS['db']->getOne($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'cloud_client_id\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'cloud_client_id\', \'hidden\', \'\', \'\', \'\', \'1\', \'cloud_api\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'cloud_appkey\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'cloud_appkey\', \'hidden\', \'\', \'\', \'\', \'1\', \'cloud_api\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'cloud_dsc_appkey\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'cloud_dsc_appkey\', \'hidden\', \'\', \'\', \'\', \'1\', \'cloud_api\');';
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
