<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_3_1
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

	public function up_v2_3_1()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'SELECT ad_id FROM ' . $GLOBALS['ecs']->table('touch_ad') . ' WHERE `ad_name` = \'天降红包\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('touch_ad') . ' (`position_id`, `media_type`, `ad_name`, `ad_link`, `link_color`, `ad_code`, `start_time`, `end_time`, `link_man`, `link_email`, `link_phone`, `click_count`, `enabled`, `is_new`, `is_hot`, `is_best`, `public_ruid`, `ad_type`, `goods_name`) VALUES (0, 0, \'天降红包\', \'index.php?m=goods&id=626\', \'\', \'1502062956625709303.jpg\', 1500573613, 1629481600, \'\', \'\', \'\', 0, 0, 0, 0, 0, 0, 0, \'0\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE `code` = \'goods_picture\'';
		$config_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `parent_id` =  \'' . $config_id . '\', `shop_group` = \'goods\' WHERE `code` IN (\'two_code_links\', \'two_code_mouse\');';
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
