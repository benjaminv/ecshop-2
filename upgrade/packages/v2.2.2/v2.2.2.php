<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_2_2
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

	public function up_v2_2_2()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('area_region') . ' ADD INDEX `region_id` ( `region_id` ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('area_region') . ' ADD INDEX `ru_id` ( `ru_id` ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping_area') . ' ADD INDEX `ru_id` ( `ru_id` ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD INDEX `review_status` ( `review_status` ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('exchange_goods') . ' ADD `market_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `exchange_integral` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('admin_user') . ' ADD  `recently_cat` VARCHAR( 255 ) NOT NULL COMMENT  \'管理员最近使用分类\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('templates_left') . ' ADD `fileurl` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `theme` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('entry_criteria') . ' ADD `is_cumulative` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `option_value` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
		$config_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' ( `parent_id` , `code` , `type` , `value` , `sort_order` , `shop_group` ) VALUES ( \'' . $config_id . '\', \'receipt_time\', \'text\', \'15\', \'15\', \'complaint_conf\' );';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' ( `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (\'' . $config_id . '\', \'is_downconfig\', \'hidden\', \'\', \'\', \'0\', \'1\', \'\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('ad_position') . (' ( `user_id`, `position_name`, `ad_width`, `ad_height`, `position_model`, `position_desc`, `position_style`, `is_public`, `theme`) VALUES
		(0, \'首页天降红包（商品设置关闭可视化状态使用）\', 500, 500, \'bonushome[num_id]\', \'num_id-数量序号\', \'{foreach from=' . $ads . ' item=ad}
' . $ad . '
{/foreach}\', 0, \'ecmoban_dsc2017\');');
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
