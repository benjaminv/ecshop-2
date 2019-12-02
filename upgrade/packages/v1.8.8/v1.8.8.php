<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v1_8_8
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

	public function up_v1_8_8()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'INSERT INTO ' . $ecs->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`) VALUES (NULL, \'5\', \'partnerlink\', \'\');';
		$db->query($sql, 'SILENT');
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (\'9\', \'use_lbs\', \'select\', \'1,0\', \'\', \'1\', \'1\');';
		$db->query($sql, 'SILENT');
		$sql = 'DROP TABLE IF EXISTS ' . $ecs->table('partner_list') . ';';
		$db->query($sql, 'SILENT');
		$sql = 'CREATE TABLE ' . $ecs->table('partner_list') . ' (
  `link_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `link_name` varchar(255) NOT NULL DEFAULT \'\',
  `link_url` varchar(255) NOT NULL DEFAULT \'\',
  `link_logo` varchar(255) NOT NULL DEFAULT \'\',
  `show_order` tinyint(3) unsigned NOT NULL DEFAULT \'50\',
  PRIMARY KEY (`link_id`),
  KEY `show_order` (`show_order`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
		$db->query($sql, 'SILENT');
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
