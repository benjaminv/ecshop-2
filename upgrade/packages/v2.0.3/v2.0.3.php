<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_0_3
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

	public function up_v2_0_3()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD  `cost_amount` DECIMAL( 10, 2 ) NOT NULL DEFAULT  \'0.00\' COMMENT  \'订单成本\' AFTER  `goods_amount`;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD  `cost_price` DECIMAL( 10, 2 ) NOT NULL DEFAULT  \'0.00\' COMMENT  \'成本价\' AFTER  `market_price`;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('goods_change_log') . ' (
		  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'自增日志ID\',
		  `goods_id` mediumint(8) NOT NULL COMMENT \'商品ID\',
		  `shop_price` decimal(10,2) NOT NULL COMMENT \'本店价\',
		  `shipping_fee` decimal(10,2) NOT NULL COMMENT \'运费\',
		  `promote_price` decimal(10,2) NOT NULL COMMENT \'促销价\',
		  `member_price` varchar(255) NOT NULL COMMENT \'会员价\',
		  `volume_price` varchar(255) NOT NULL COMMENT \'阶梯价\',
		  `give_integral` int(11) NOT NULL COMMENT \'赠送消费积分\',
		  `rank_integral` int(11) NOT NULL COMMENT \'赠送等级积分\',
		  `goods_weight` decimal(10,3) NOT NULL COMMENT \'商品重量\',
		  `is_on_sale` tinyint(1) NOT NULL COMMENT \'上下架\',
		  `user_id` int(11) NOT NULL COMMENT \'操作者ID\',
		  `handle_time` int(11) NOT NULL COMMENT \'操作时间\',
		  `old_record` tinyint(1) unsigned NOT NULL DEFAULT \'0\' COMMENT \'原纪录\',
		  PRIMARY KEY (`log_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_attr') . ' CHANGE `attr_price` `attr_price` DECIMAL( 10, 2 ) NOT NULL DEFAULT \'0.00\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('brand') . ' ADD  `brand_first_char` CHAR( 1 ) NOT NULL AFTER  `brand_letter`;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products') . ' ADD `admin_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `product_warn_number` , ADD INDEX ( `admin_id` ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_attr') . ' ADD INDEX `admin_id` ( `admin_id` ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_area') . ' ADD `admin_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'10\' AFTER `area_id` , ADD INDEX ( `admin_id` ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_warehouse') . ' ADD `admin_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `warehouse_id` , ADD INDEX ( `admin_id` ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_attr') . ' ADD `admin_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `attr_price` , ADD INDEX ( `admin_id` ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_area_attr') . ' ADD `admin_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `attr_price` , ADD INDEX ( `admin_id` ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD  `goods_tag` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT  \'商品标签\' AFTER  `goods_product_tag`';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET `seller_show` = \'1\' WHERE `action_code` = \'admin_message\';';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`action_id`,`parent_id`, `action_code`, `seller_show`) VALUES (NULL,\'0\', \'index_manage\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT action_id FROM ' . $ecs->table('admin_action') . ' WHERE action_code = \'index_manage\'';
		$action_id = $db->getOne($sql, true);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code`, `seller_show`) VALUES (\'' . $action_id . '\', \'index_sales_volume\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code`, `seller_show`) VALUES (\'' . $action_id . '\', \'index_today_order\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code`, `seller_show`) VALUES (\'' . $action_id . '\', \'index_today_comment\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code`, `seller_show`) VALUES (\'' . $action_id . '\', \'index_seller_num\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code`, `seller_show`) VALUES (\'' . $action_id . '\', \'index_order_status\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code`, `seller_show`) VALUES (\'' . $action_id . '\', \'index_order_stats\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code`, `seller_show`) VALUES (\'' . $action_id . '\', \'index_sales_stats\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code`, `seller_show`) VALUES (\'' . $action_id . '\', \'index_member_info\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code`, `seller_show`) VALUES (\'' . $action_id . '\', \'index_goods_view\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code`, `seller_show`) VALUES (\'' . $action_id . '\', \'index_control_panel\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code`, `seller_show`) VALUES (\'' . $action_id . '\', \'index_system_info\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $ecs->table('shop_config') . ' WHERE code = \'basic\'';
		$config_id = $db->getOne($sql, true);
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`parent_id`, `code`, `type`, `store_dir`) VALUES (\'' . $config_id . '\', \'no_brand\', \'file\', \'../images/\');';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $ecs->table('shop_config') . ' WHERE code = \'extend_basic\'';
		$config_id = $db->getOne($sql, true);
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (\'' . $config_id . '\', \'open_study\', \'select\', \'0,1\', \'\', \'0\', 1);';
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
