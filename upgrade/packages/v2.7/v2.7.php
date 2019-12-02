<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_7
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

	public function up_v2_7()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$field = get_table_file_name($GLOBALS['ecs']->table('cart'), 'act_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD  `act_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\';';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET value = 1 WHERE code = \'seller_email\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'sys_manage\'';
		$action_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET parent_id = \'' . $action_id . '\' WHERE action_code = \'seo\';';
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
