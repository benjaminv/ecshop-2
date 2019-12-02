<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_5
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

	public function up_v2_5()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$field = get_table_column_name($GLOBALS['ecs']->table('order_info'), 'shipping_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' DROP INDEX shipping_id;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('order_info'), 'pay_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' CHANGE `pay_id` `pay_id` MEDIUMINT(8) NOT NULL DEFAULT \'0\';';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('coupons_user'), 'cou_money');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('coupons_user') . ' ADD `cou_money` DECIMAL(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `cou_id` ;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('solve_dealconcurrent') . ' (
		  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `user_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `orec_id` text NOT NULL,
		  `add_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `solve_type` tinyint(3) NOT NULL DEFAULT \'0\',
		  PRIMARY KEY (`id`),
		  KEY `user_id` (`user_id`),
		  KEY `add_time` (`add_time`),
		  KEY `solve_type` (`solve_type`)
		) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'cashier_Settlement\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE `code` = \'extend_basic\';';
			$config_id = $GLOBALS['db']->getOne($sql);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (  `parent_id` ,  `code` ,  `type` ,  `value` ,  `shop_group` ) VALUES ( \'' . $config_id . '\',  \'cashier_Settlement\',  \'hidden\', 1,  \'\' );';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'DELETE FROM ' . $GLOBALS['ecs']->table('payment') . ' WHERE pay_code =\'alipay_bank\';';
		$GLOBALS['db']->query($sql);
		$sql = 'DELETE FROM ' . $GLOBALS['ecs']->table('payment') . ' WHERE pay_code =\'chinabank\';';
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
