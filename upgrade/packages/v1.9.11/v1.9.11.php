<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v1_9_11
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

	public function up_v1_9_11()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' ( `parent_id` , `code` , `type` , `value` , `sort_order` ) VALUES ( 2, \'merchants_prefix\', \'text\', \'ecmoban_\', \'1\' );';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('cart') . ' ADD COLUMN `is_checked`  tinyint(1) NOT NULL DEFAULT 1 COMMENT \'选中状态，0未选中，1选中\';';
		$db->query($sql);
		$sql = 'ALTER TABLE  ' . $ecs->table('order_return') . ' ADD  `return_time` VARCHAR( 120 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER  `apply_time`;';
		$db->query($sql);
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (\'7\', \'show_rank_price\', \'select\', \'1,0\', \'\', \'0\', \'1\');';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('users_auth') . ' ADD INDEX ( `identifier` ) ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('pic_album') . ' ADD `pic_image` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `pic_thumb`;';
		$db->query($sql);
		$sql = 'CREATE TABLE ' . $ecs->table('open_api') . ' (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL DEFAULT \'\',
  `app_key` varchar(225) NOT NULL DEFAULT \'\',
  `action_code` text NOT NULL,
  `is_open` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
  `add_time` varchar(60) NOT NULL DEFAULT \'\',
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_key` (`app_key`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
		$db->query($sql);
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
