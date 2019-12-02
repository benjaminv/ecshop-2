<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_6_0
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

	public function up_v2_6_0()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$field = get_table_file_name($GLOBALS['ecs']->table('merchants_shop_information'), 'add_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' ADD `add_time` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `shop_close`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('warehouse_area_goods'), 'city_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_area_goods') . ' ADD `city_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `region_id` ,
			ADD INDEX ( `city_id` ) ;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('products_area'), 'city_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_area') . ' ADD `city_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `area_id` ,
			ADD INDEX ( `city_id` ) ;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('products_changelog'), 'city_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_changelog') . ' ADD `city_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `area_id` ,
			ADD INDEX ( `city_id` ) ;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('order_goods'), 'product_sn');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . '
			ADD `product_sn`  varchar(60) NULL COMMENT \'商品规格货号\' AFTER `stages_qishu`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('order_goods'), 'is_reality');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . '
			ADD `is_reality`  int(1) NULL DEFAULT -1 COMMENT \'正品保证\' AFTER `product_sn`,
			ADD `is_return`  int(1) NULL DEFAULT -1 COMMENT \'包退服务\' AFTER `is_reality`,
			ADD `is_fast`  int(1) NULL DEFAULT -1 COMMENT \'闪速配送\' AFTER `is_return`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('store_back_order') . ' (
		`id`  int(20) NOT NULL AUTO_INCREMENT ,
		`store_id`  int(20) NOT NULL ,
		`order_id`  int(20) NOT NULL ,
		PRIMARY KEY (`id`)
		);';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('pay_log') . ' CHANGE `order_id` `order_id` varchar(100) NOT NULL DEFAULT 0 AFTER `log_id`;';
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'area_pricetype\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE `code` = \'goods_base\';';
			$config_id = $GLOBALS['db']->getOne($sql);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'area_pricetype\', \'hidden\', \'0,1\', \'\', \'0\', \'1\', \'goods\');';
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
