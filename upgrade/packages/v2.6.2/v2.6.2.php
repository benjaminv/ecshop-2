<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_6_2
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

	public function up_v2_6_2()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$field = get_table_column_name($GLOBALS['ecs']->table('shipping'), 'shipping_code');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping') . ' ADD UNIQUE  `shipping_code` (  `shipping_code` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('shipping'), 'enabled');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping') . ' ADD INDEX  `enabled` (  `enabled` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users'), 'mobile_phone');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users') . ' ADD INDEX  `mobile_phone` (  `mobile_phone` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('cart_combo'), 'area_city');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD  `area_city` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' AFTER  `area_id`;';
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

		$field = get_table_file_name($GLOBALS['ecs']->table('user_address'), 'userUp_time');

		if ($field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_address') . ' CHANGE  `userUp_time`  `update_time` INT( 10 ) UNSIGNED NULL DEFAULT  \'0\';';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('order_info'), 'is_update_sale');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD `is_update_sale` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'0\';';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'wap_logo\'';

		if ($GLOBALS['db']->getOne($sql)) {
			$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `type` = \'file\',`value` = \'../images/wap_logo.png\' WHERE `code` = \'wap_logo\';';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'DELETE FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE `action_code` = \'goods_psi\';';
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
