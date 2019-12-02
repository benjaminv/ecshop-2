<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_5_3
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

	public function up_v2_5_3()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('kdniao_eorder_config') . ' (
		  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `ru_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `shipping_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `shipper_code` varchar(10) NOT NULL,
		  `customer_name` varchar(50) NOT NULL,
		  `customer_pwd` varchar(50) NOT NULL,
		  `month_code` varchar(50) NOT NULL,
		  `send_site` varchar(50) NOT NULL,
		  `pay_type` tinyint(1) unsigned NOT NULL DEFAULT \'1\',
		  `template_size` varchar(20) NOT NULL,
		  PRIMARY KEY (`id`),
		  KEY `ru_id` (`ru_id`),
		  KEY `shipping_id` (`shipping_id`)
		) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('kdniao_customer_account') . ' (
		  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `ru_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `shipping_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `shipper_code` varchar(10) NOT NULL,
		  `station_code` varchar(30) NOT NULL,
		  `station_name` varchar(30) NOT NULL,
		  `apply_id` varchar(30) NOT NULL,
		  `company` varchar(30) NOT NULL,
		  `name` varchar(30) NOT NULL,
		  `tel` varchar(20) NOT NULL,
		  `mobile` varchar(20) NOT NULL,
		  `province_name` varchar(20) NOT NULL,
		  `province_code` varchar(20) NOT NULL,
		  `city_name` varchar(20) NOT NULL,
		  `city_code` varchar(20) NOT NULL,
		  `exp_area_name` varchar(20) NOT NULL,
		  `exp_area_code` varchar(20) NOT NULL,
		  `address` varchar(100) NOT NULL,
		  `dsc_province` smallint(5) unsigned NOT NULL DEFAULT \'0\',
		  `dsc_city` smallint(5) unsigned NOT NULL DEFAULT \'0\',
		  `dsc_district` smallint(5) unsigned NOT NULL DEFAULT \'0\',
		  PRIMARY KEY (`id`),
		  KEY `ru_id` (`ru_id`),
		  KEY `shipping_id` (`shipping_id`)
		) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'kdniao_account_use\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE `code` = \'tp_api\';';
			$config_id = $GLOBALS['db']->getOne($sql);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'kdniao_account_use\', \'select\', \'0,1\', \'\', \'0\', \'3\', \'tp_api\');';
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
