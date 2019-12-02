<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_2_3
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

	public function up_v2_2_3()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('alitongxin_configure') . ' (
		  `id` smallint(5) NOT NULL AUTO_INCREMENT,
		  `temp_id` varchar(255) NOT NULL COMMENT \'模板ID\',
		  `temp_content` varchar(255) NOT NULL COMMENT \'模板内容\',
		  `add_time` int(15) NOT NULL COMMENT \'添加时间\',
		  `set_sign` varchar(255) NOT NULL COMMENT \'签名\',
		  `send_time` varchar(255) NOT NULL COMMENT \'短信发送时机\',
		  `signature` tinyint(1) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('touch_page_view') . ' (
		  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `ru_id` int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'商家ID\' ,
		  `type` varchar(60) NOT NULL DEFAULT \'1\' COMMENT \'店铺或专题\' ,
		  `page_id` int(160) unsigned NOT NULL DEFAULT \'0\'  COMMENT \'店铺ID或专题ID\' ,
		  `title` varchar(255)  DEFAULT NULL COMMENT \'标题\' ,
		  `keywords` varchar(255) DEFAULT NULL COMMENT \'关键字\' ,
		  `description` varchar(255) DEFAULT NULL COMMENT \'描述\' ,
		  `data` longtext COMMENT \'内容\'  ,
		  `pic` longtext COMMENT \'图片\'  ,
		  `thumb_pic` varchar(255) NOT NULL DEFAULT \'\' COMMENT \'缩略图\'  ,
		  `create_at` int(11) unsigned DEFAULT \'0\' COMMENT \'创建时间\',
		  `update_at` int(11) unsigned DEFAULT \'0\' COMMENT \'更新时间\',
		  `default` tinyint(1) unsigned NOT NULL DEFAULT \'0\' COMMENT \'数据 0 自定义数据 1 默认数据\',
		  `review_status` tinyint(1) unsigned NOT NULL DEFAULT \'1\' COMMENT \'审核状态1 3 \',
		  `is_show` tinyint(1) unsigned NOT NULL DEFAULT \'1\' COMMENT \'是否显示 0 1\',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `store_range` = \'0,1,2\' WHERE `code` = \'sms_type\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET sort_order = 3 WHERE code = \'sms_shop_mobile\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET sort_order = 11 WHERE code = \'sms_order_placed\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET sort_order = 12 WHERE code = \'sms_order_payed\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET sort_order = 13 WHERE code = \'sms_order_shipped\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET sort_order = 14 WHERE code = \'sms_signin\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET sort_order = 15 WHERE code = \'sms_price_notice\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET sort_order = 16 WHERE code = \'sms_seller_signin\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET sort_order = 17 WHERE code = \'sms_find_signin\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET sort_order = 18 WHERE code = \'sms_code\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET sort_order = 19 WHERE code = \'user_account_code\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'sms\'';
		$config_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'access_key_id\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'access_key_id\', \'text\', \'\', \'\', \'\', \'9\', \'\'), 
			(NULL, \'' . $config_id . '\', \'access_key_secret\', \'text\', \'\', \'\', \'\', \'10\', \'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `shop_group` = \'sms\' WHERE `parent_id` = \'' . $config_id . '\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `value` = \'group\' WHERE `code` = \'hidden\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'merchants\'';
		$action_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'touch_dashboard\'';

		if ($GLOBALS['db']->getOne($sql, true)) {
			$sql = 'DELETE FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'touch_dashboard\';';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'touch_dashboard\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`action_id` ,`parent_id` ,`action_code` ,`relevance`, `seller_show` ) VALUES (NULL , \'' . $action_id . '\',\'touch_dashboard\', \'\', \'1\');';
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
