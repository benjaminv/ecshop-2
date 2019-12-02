<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_6_1
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

	public function up_v2_6_1()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'ALTER TABLE  ' . $GLOBALS['ecs']->table('user_address') . ' CHANGE  `country`  `country` INT( 10 ) NOT NULL DEFAULT  \'0\',
		CHANGE  `province`  `province` INT( 10 ) NOT NULL DEFAULT  \'0\',
		CHANGE  `city`  `city` INT( 10 ) NOT NULL DEFAULT  \'0\',
		CHANGE  `district`  `district` INT( 10 ) NOT NULL DEFAULT  \'0\',
		CHANGE  `street`  `street` INT( 10 ) NOT NULL DEFAULT  \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_area') . ' CHANGE  `area_id`  `area_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_changelog') . ' CHANGE  `area_id`  `area_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_warehouse') . ' CHANGE  `warehouse_id`  `warehouse_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('back_order'), 'country');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('back_order') . ' ADD INDEX  `country` (  `country` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('back_order'), 'province');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('back_order') . ' ADD INDEX  `province` (  `province` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('back_order'), 'city');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('back_order') . ' ADD INDEX  `city` (  `city` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('back_order'), 'district');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('back_order') . ' ADD INDEX  `district` (  `district` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('back_order'), 'street');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('back_order') . ' ADD  `street` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `district` ,
			ADD INDEX (  `street` );';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_order') . ' CHANGE  `country`  `country` INT( 10 ) UNSIGNED NULL DEFAULT  \'0\',
		CHANGE  `province`  `province` INT( 10 ) UNSIGNED NULL DEFAULT  \'0\',
		CHANGE  `city`  `city` INT( 10 ) UNSIGNED NULL DEFAULT  \'0\',
		CHANGE  `district`  `district` INT( 10 ) UNSIGNED NULL DEFAULT  \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_order'), 'country');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_order') . ' ADD INDEX  `country` (  `country` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_order'), 'province');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_order') . ' ADD INDEX  `province` (  `province` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_order'), 'city');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_order') . ' ADD INDEX  `city` (  `city` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_order'), 'district');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_order') . ' ADD INDEX  `district` (  `district` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('delivery_order'), 'street');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_order') . ' ADD  `street` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `district` ,
			ADD INDEX (  `street` );';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('offline_store') . ' CHANGE  `country`  `country` INT( 10 ) NOT NULL DEFAULT  \'0\',
		CHANGE  `province`  `province` INT( 10 ) NOT NULL DEFAULT  \'0\',
		CHANGE  `city`  `city` INT( 10 ) NOT NULL DEFAULT  \'0\',
		CHANGE  `district`  `district` INT( 10 ) NOT NULL DEFAULT  \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('offline_store'), 'country');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('offline_store') . ' ADD INDEX  `country` (  `country` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('offline_store'), 'province');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('offline_store') . ' ADD INDEX  `province` (  `province` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('offline_store'), 'city');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('offline_store') . ' ADD INDEX  `city` (  `city` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('offline_store'), 'district');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('offline_store') . ' ADD INDEX  `district` (  `district` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('offline_store'), 'street');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('offline_store') . ' ADD  `street` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `district` ,
			ADD INDEX (  `street` );';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_type') . ' CHANGE  `country`  `country` INT( 10 ) NOT NULL DEFAULT  \'0\',
		CHANGE  `province`  `province` INT( 10 ) NOT NULL DEFAULT  \'0\',
		CHANGE  `city`  `city` INT( 10 ) NOT NULL DEFAULT  \'0\',
		CHANGE  `district`  `district` INT( 10 ) NOT NULL DEFAULT  \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('users_type'), 'country');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_type') . ' ADD INDEX  `country` (  `country` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users_type'), 'province');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_type') . ' ADD INDEX  `province` (  `province` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users_type'), 'city');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_type') . ' ADD INDEX  `city` (  `city` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users_type'), 'district');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_type') . ' ADD INDEX  `district` (  `district` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_name('wholesale_order_info');

		if ($field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('wholesale_order_info') . ' CHANGE  `country`  `country` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\',
			CHANGE  `province`  `province` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\',
			CHANGE  `city`  `city` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\',
			CHANGE  `district`  `district` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\',
			CHANGE  `street`  `street` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\';';
			$GLOBALS['db']->query($sql);
			$field = get_table_column_name($GLOBALS['ecs']->table('wholesale_order_info'), 'country');

			if (!$field['bool']) {
				$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('wholesale_order_info') . ' ADD INDEX  `country` (  `country` );';
				$GLOBALS['db']->query($sql);
			}

			$field = get_table_column_name($GLOBALS['ecs']->table('wholesale_order_info'), 'province');

			if (!$field['bool']) {
				$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('wholesale_order_info') . ' ADD INDEX  `province` (  `province` );';
				$GLOBALS['db']->query($sql);
			}

			$field = get_table_column_name($GLOBALS['ecs']->table('wholesale_order_info'), 'city');

			if (!$field['bool']) {
				$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('wholesale_order_info') . ' ADD INDEX  `city` (  `city` );';
				$GLOBALS['db']->query($sql);
			}

			$field = get_table_column_name($GLOBALS['ecs']->table('wholesale_order_info'), 'district');

			if (!$field['bool']) {
				$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('wholesale_order_info') . ' ADD INDEX  `district` (  `district` );';
				$GLOBALS['db']->query($sql);
			}

			$field = get_table_column_name($GLOBALS['ecs']->table('wholesale_order_info'), 'street');

			if (!$field['bool']) {
				$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('wholesale_order_info') . ' ADD INDEX  `street` (  `street` );';
				$GLOBALS['db']->query($sql);
			}
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_info'), 'country');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD INDEX  `country` (  `country` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_info'), 'province');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD INDEX  `province` (  `province` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_info'), 'city');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD INDEX  `city` (  `city` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_info'), 'district');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD INDEX  `district` (  `district` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_info'), 'street');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD INDEX  `street` (  `street` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('cart'), 'area_city');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD  `area_city` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `area_id`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('order_goods'), 'area_city');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' ADD  `area_city` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `area_id`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_name('wechat_user');

		if ($field['bool']) {
			$field = get_table_file_name($GLOBALS['ecs']->table('wechat_user'), 'drp_parent_id');

			if ($field['bool']) {
				$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('wechat_user') . ' CHANGE `drp_parent_id` `drp_parent_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
				$GLOBALS['db']->query($sql);
			}
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'header_region\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE `code` = \'extend_basic\';';
			$config_id = $GLOBALS['db']->getOne($sql);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'header_region\', \'textarea\', \'\', \'\', \'\', \'1\', \'\');';
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
