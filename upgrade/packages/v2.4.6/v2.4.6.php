<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_4_6
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

	public function up_v2_4_6()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('order_delayed') . ' (
		  `delayed_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `order_id` int(11) unsigned NOT NULL,
		  `apply_day` tinyint(2) unsigned NOT NULL,
		  `apply_time` int(10) unsigned NOT NULL,
		  `review_status` tinyint(1) unsigned NOT NULL,
		  `review_time` int(10) unsigned NOT NULL,
		  `review_admin` int(10) unsigned NOT NULL,
		  PRIMARY KEY (`delayed_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('order_delayed'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_delayed') . ' ADD INDEX  `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods'), 'from_seller');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD INDEX `from_seller` (`from_seller`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('seo') . ' (
		  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT \'主键\',
		  `title` varchar(255) NOT NULL COMMENT \'标题\',
		  `keywords` varchar(255) NOT NULL COMMENT \'关键词\',
		  `description` text NOT NULL COMMENT \'描述\',
		  `type` varchar(20) NOT NULL COMMENT \'类型\',
		  UNIQUE KEY `id` (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT=\'SEO信息存放表\' AUTO_INCREMENT=14 ;';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('category'), 'cate_title');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('category') . ' ADD `cate_title` VARCHAR(200) NOT NULL DEFAULT \'\' COMMENT \'关键词\' AFTER `touch_icon`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('category'), 'cate_keywords');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('category') . ' ADD `cate_keywords` VARCHAR(255) NOT NULL DEFAULT \'\' COMMENT \'关键词\' AFTER `cate_title`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('category'), 'cate_description');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('category') . ' ADD `cate_description` VARCHAR(255) NOT NULL DEFAULT \'\' COMMENT \'描述\' AFTER `cate_keywords`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('cart'), 'is_invalid');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD  `is_invalid` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  \'0\' COMMENT  \'购物车商品是否无效\';';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('users'), 'pay_points');

		if ($field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users') . ' CHANGE  `pay_points`  `pay_points` INT( 10 ) NOT NULL DEFAULT  \'0\';';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE `code` = \'extend_basic\';';
		$config_id = $GLOBALS['db']->getOne($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'open_order_delay\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (  `parent_id` ,  `code` ,  `type` ,  `store_range` ,  `value` ,  `sort_order` ,  `shop_group` ) 
			VALUES ( \'' . $config_id . '\',  \'open_order_delay\',  \'select\',  \'0,1\', 1, 15,  \'order_delay\' );';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'order_delay_num\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (  `parent_id` ,  `code` ,  `type` ,  `value` ,  `sort_order` ,  `shop_group` ) 
			VALUES ( \'' . $config_id . '\',  \'order_delay_num\',  \'text\', 3, 15,  \'order_delay\' );';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'order_delay_day\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (  `parent_id` ,  `code` ,  `type` ,  `value` ,  `sort_order` ,  `shop_group` ) 
			VALUES ( \'' . $config_id . '\',  \'order_delay_day\',  \'text\', 3, 15,  \'order_delay\' );';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'pay_effective_time\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (  `parent_id` ,  `code` ,  `type` ,  `value` ,  `sort_order` ,  `shop_group` ) 
			VALUES ( \'' . $config_id . '\',  \'pay_effective_time\',  \'text\', 0, 15,\'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT count(*) FROM ' . $GLOBALS['ecs']->table('seo') . ' WHERE 1';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('seo') . ' (`id`, `title`, `keywords`, `description`, `type`) VALUES
			(1, \'首页\', \'首页\', \'首页\', \'index\'),
			(2, \'团购\', \'团购\', \'团购\', \'group\'),
			(3, \'团购详情\', \'团购详情\', \'团购详情\', \'group_content\'),
			(5, \'积分商城\', \'积分商城\', \'积分商城\', \'change\'),
			(6, \'积分中心商品内容\', \'积分中心商品内容\', \'积分中心商品内容\', \'change_content\'),
			(7, \'文章分类列表\', \'文章分类列表\', \'文章分类列表\', \'article\'),
			(8, \'文章内容\', \'文章内容\', \'文章内容\', \'article_content\'),
			(9, \'店铺街\', \'店铺街\', \'店铺街\', \'shop\'),
			(10, \' 商品\', \' 商品\', \' 商品\', \'goods\'),
			(12, \'品牌\', \'品牌\', \'品牌\', \'brand_list\'),
			(13, \'品牌商品列表\', \'品牌商品列表\', \'品牌商品列表\', \'brand\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'seo\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE `action_code` = \'basic_logo\';';
			$action_id = $GLOBALS['db']->getOne($sql);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, \'' . $action_id . '\', \'seo\', \'\', \'0\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'visualnews\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, \'2\', \'visualnews\', \'\', \'0\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'order_delayed\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, \'6\', \'order_delayed\', \'\', \'1\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'order_print_logo\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE `code` = \'basic_logo\';';
			$config_id = $GLOBALS['db']->getOne($sql);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id` ,`parent_id` ,`code` ,`type` ,`store_range` ,`store_dir` ,`value` ,`sort_order` ,`shop_group`) VALUES (NULL ,  \'' . $config_id . '\',  \'order_print_logo\',  \'file\',  \'\',  \'admin/images/print/\',  \'admin/images/print/order_print_logo.png\',  \'1\',  \'\');';
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
