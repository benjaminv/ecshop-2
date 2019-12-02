<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_7_2
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

	public function up_v2_7_2()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$field = get_table_column_name($GLOBALS['ecs']->table('region'), 'region_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('region') . ' ADD INDEX `region_name` (`region_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('region_warehouse'), 'region_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('region_warehouse') . ' ADD INDEX `region_name` (`region_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('region_warehouse'), 'region_code');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('region_warehouse') . ' ADD INDEX `region_code` (`region_code`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('solve_dealconcurrent'), 'flow_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('solve_dealconcurrent') . ' ADD  `flow_type` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  \'0\';';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('solve_dealconcurrent'), 'flow_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('solve_dealconcurrent') . ' ADD INDEX `flow_type` (`flow_type`);';
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
