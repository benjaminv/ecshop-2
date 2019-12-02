<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_1
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

	public function up_v2_1()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('trade_snapshot') . ' (
  `trade_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(255) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `goods_id` mediumint(8) NOT NULL,
  `goods_name` varchar(120) NOT NULL DEFAULT \'\',
  `goods_sn` varchar(60) NOT NULL DEFAULT \'\',
  `shop_price` decimal(10,2) NOT NULL DEFAULT \'0.00\',
  `goods_number` smallint(5) NOT NULL DEFAULT \'1\',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT \'0.00\',
  `rz_shopName` varchar(60) NOT NULL,
  `goods_weight` decimal(10,3) NOT NULL DEFAULT \'0.000\',
  `add_time` int(11) NOT NULL DEFAULT \'0\',
  `goods_attr` varchar(255) NOT NULL,
  `goods_attr_id` varchar(255) NOT NULL DEFAULT \'\',
  `ru_id` int(11) NOT NULL DEFAULT \'0\',
  `goods_desc` text NOT NULL,
  `goods_img` varchar(255) NOT NULL DEFAULT \'\',
  PRIMARY KEY (`trade_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('templates_left') . ' ADD `theme` VARCHAR( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `type` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_goods') . ' CHANGE `w_id` `w_id` INT( 10 ) NOT NULL AUTO_INCREMENT ,
CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `goods_id` `goods_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `region_id` `region_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `region_sn` `region_sn` VARCHAR( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\',
CHANGE `give_integral` `give_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `rank_integral` `rank_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `pay_integral` `pay_integral` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `add_time` `add_time` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `last_update` `last_update` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_area_goods') . ' CHANGE `a_id` `a_id` INT( 10 ) NOT NULL AUTO_INCREMENT ,
CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `goods_id` `goods_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `region_id` `region_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `region_sn` `region_sn` VARCHAR( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\',
CHANGE `region_sort` `region_sort` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `add_time` `add_time` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `last_update` `last_update` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE  ' . $GLOBALS['ecs']->table('users_real') . ' ADD  `front_of_id_card` VARCHAR( 60 ) NOT NULL COMMENT  \'身份证正面\',
ADD  `reverse_of_id_card` VARCHAR( 60 ) NOT NULL COMMENT  \'身份证反面\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD `goods_cause` VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `goods_unit` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('trade_snapshot') . ' ADD  `snapshot_time` INT( 10 ) UNSIGNED NOT NULL DEFAULT  \'0\' COMMENT  \'快照新增时间\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('value_card_type') . ' ADD  `use_merchants` VARCHAR( 255 ) NOT NULL DEFAULT  \'self\' COMMENT  \'可使用店铺\' AFTER  `use_condition`;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('presale_activity') . ' ADD  `pre_num` int(10) unsigned NOT NULL DEFAULT \'0\' AFTER  `review_content`;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('source_ip') . ' ENGINE = MYISAM ;';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' ( `code` , `type` ) VALUES (\'hometheme\', \'hidden\');';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'templates_manage\'';
		$action_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' ( `parent_id` , `action_code` ) VALUES (\'' . $action_id . '\', \'visualhome\');';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
		$config_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' ( `parent_id` , `code` , `type` , `store_range` , `value` ) VALUES (\'' . $config_id . '\', \'openvisual\', \'select\', \'0,1\', 0 ) ;';
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
