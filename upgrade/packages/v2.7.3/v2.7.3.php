<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_7_3
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

	public function up_v2_7_3()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$field = get_table_file_name($GLOBALS['ecs']->table('seller_commission_bill'), 'drp_money');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_commission_bill') . ' ADD  `drp_money` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT  \'0.00\' AFTER  `return_shippingfee`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('virtual_card') . ' CHANGE `card_sn` `card_sn` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\', 
		CHANGE `card_password` `card_password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('area_region') . ' CHANGE  `shipping_area_id`  `shipping_area_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\',
		CHANGE  `region_id`  `region_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('solve_dealconcurrent'), 'flow_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('solve_dealconcurrent') . ' ADD  `flow_type` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  \'0\' COMMENT  \'商品类型（flow_type：秒杀、普通商品）\' AFTER  `orec_id` ,
		ADD INDEX (  `flow_type` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('cart_combo'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD  `ru_id` INT( 10 ) NOT NULL DEFAULT  \'0\' AFTER  `goods_attr_id` ,
		ADD INDEX (  `ru_id` );';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('value_card_record'), 'vc_dis');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('value_card_record') . ' ADD  `vc_dis` DECIMAL( 10, 2 ) NOT NULL DEFAULT  \'0.00\' AFTER  `use_val`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'appkey\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE `code` = \'extend_basic\';';
			$config_id = $GLOBALS['db']->getOne($sql);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (\'' . $config_id . '\', \'appkey\', \'hidden\', \'\', \'\', \'\', \'1\', \'\');';
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
