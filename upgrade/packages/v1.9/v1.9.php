<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v1_9
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

	public function up_v1_9()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'ALTER TABLE ' . $ecs->table('seller_shopinfo') . ' ADD `seller_templates` VARCHAR( 160 ) NOT NULL ;';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('seller_shopinfo') . ' ADD `templates_mode` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('admin_action') . ' ADD `seller_show` TINYINT( 5 ) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `relevance`;';
		$db->query($sql, 'SILENT');
		$sql = 'DROP TABLE IF EXISTS ' . $ecs->table('templates_left') . ';';
		$db->query($sql, 'SILENT');
		$sql = 'CREATE TABLE ' . $ecs->table('templates_left') . ' (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ru_id` int(10) NOT NULL DEFAULT \'0\',
  `seller_templates` varchar(160) NOT NULL DEFAULT \'\',
  `bg_color` char(10) NOT NULL,
  `img_file` varchar(120) NOT NULL DEFAULT \'\',
  `if_show` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
  `bgrepeat` varchar(50) NOT NULL DEFAULT \'\',
  `align` varchar(50) NOT NULL DEFAULT \'\',
  `type` varchar(20) NOT NULL DEFAULT \'\',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$db->query($sql, 'SILENT');
		$sql = 'DROP TABLE IF EXISTS ' . $ecs->table('pic_album') . ';';
		$db->query($sql, 'SILENT');
		$sql = 'CREATE TABLE ' . $ecs->table('pic_album') . ' (
  `pic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pic_name` varchar(100) NOT NULL DEFAULT \'\',
  `album_id` int(10) unsigned NOT NULL,
  `pic_file` varchar(255) NOT NULL DEFAULT \'\',
  `pic_thumb` varchar(255) NOT NULL DEFAULT \'\',
  `pic_size` int(10) unsigned NOT NULL,
  `pic_spec` varchar(100) NOT NULL DEFAULT \'\',
  `ru_id` int(10) unsigned NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT=\'相册图片表\' AUTO_INCREMENT=1 ;';
		$db->query($sql, 'SILENT');
		$sql = 'DROP TABLE IF EXISTS ' . $ecs->table('gallery_album') . ';';
		$db->query($sql, 'SILENT');
		$sql = 'CREATE TABLE ' . $ecs->table('gallery_album') . ' (
  `album_id` int(10) NOT NULL AUTO_INCREMENT,
  `ru_id` int(10) unsigned NOT NULL DEFAULT \'0\',
  `album_mame` varchar(60) NOT NULL DEFAULT \'\',
  `album_cover` varchar(255) NOT NULL DEFAULT \'\',
  `album_desc` varchar(255) NOT NULL DEFAULT \'\',
  `sort_order` tinyint(1) unsigned NOT NULL DEFAULT \'50\',
  `add_time` int(11) unsigned NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`album_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
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
