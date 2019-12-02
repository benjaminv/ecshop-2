<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_3_7
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

	public function up_v2_3_7()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$field = get_table_file_name($GLOBALS['ecs']->table('comment'), 'like_num');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment') . ' ADD `like_num` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('comment'), 'dis_browse_num');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment') . ' ADD `dis_browse_num` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', ADD INDEX (`like_num`), ADD INDEX (`dis_browse_num`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('order_print_setting'), 'sort_order');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_print_setting') . ' ADD `sort_order` TINYINT(3) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `is_default`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('order_print_setting'), 'width');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_print_setting') . ' ADD `width` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `printer`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' CHANGE `goods_number` `goods_number` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_goods') . ' CHANGE `region_number` `region_number` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_area_goods') . ' CHANGE `region_number` `region_number` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' CHANGE `review_status` `review_status` TINYINT(1) NOT NULL DEFAULT \'1\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('goods'), 'user_brand');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD `user_brand` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \'品牌统一使用平台品牌ID异步操作\', ADD INDEX `user_brand` (`user_brand`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('collect_brand'), 'user_brand');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('collect_brand') . ' ADD `user_brand` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `ru_id`, ADD INDEX `user_brand` (`user_brand`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('favourable_activity'), 'user_range_ext');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('favourable_activity') . ' ADD `user_range_ext` VARCHAR(255) NOT NULL DEFAULT \'\' AFTER `review_content`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('favourable_activity'), 'is_user_brand');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('favourable_activity') . ' ADD `is_user_brand` TINYINT(1) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `user_range_ext`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('merchants_steps_fields'), 'shopTime_term');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_steps_fields') . ' ADD `shopTime_term` TINYINT( 1 ) NOT NULL DEFAULT \'0\' AFTER `business_term` ;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' CHANGE `freight` `freight` TINYINT(1) UNSIGNED NOT NULL DEFAULT \'2\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'wap_category\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'wap\'';
			$config_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES
			(\'' . $config_id . '\', \'wap_category\', \'select\', \'1,0\', \'\', \'0\', \'1\', \'1\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'brand_belongs\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
			$config_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'brand_belongs\', \'hidden\', \'0,1\', \'\', \'0\', \'1\', \'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `type` = \'hidden\', `value` = 0 WHERE `code` = \'freight_model\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('goods') . ' SET `freight` = 2 WHERE `freight` = 0;';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('order_print_size') . ' SET `specification` = \'241MM*140MM\', `height` = \'140\', `size` = \'241mm x 140mm\' WHERE `specification` = \'241MM*140MM\';';
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
