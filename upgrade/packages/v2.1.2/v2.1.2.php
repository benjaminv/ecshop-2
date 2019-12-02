<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_1_2
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

	public function up_v2_1_2()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shop_config') . ' ADD `shop_group` VARCHAR( 250 ) NOT NULL AFTER `sort_order` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD `confirm_take_time` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `shipping_time`;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' ADD INDEX `merchants_audit` ( `merchants_audit` ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' ADD INDEX `is_street` ( `is_street` ) ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('snatch_log') . ' 
MODIFY COLUMN `log_id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT FIRST ,
MODIFY COLUMN `snatch_id`  int(10) UNSIGNED NOT NULL DEFAULT 0 AFTER `log_id`,
MODIFY COLUMN `user_id`  int(10) UNSIGNED NOT NULL DEFAULT 0 AFTER `snatch_id`;';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET shop_group = \'seller\' WHERE code = \'marticle\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET shop_group = \'seller\' WHERE code = \'marticle_id\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET shop_group = \'seller\' WHERE code = \'customer_service\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET shop_group = \'seller\' WHERE code = \'review_goods\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET shop_group = \'seller\' WHERE code = \'delete_seller\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET shop_group = \'seller\' WHERE code = \'grade_apply_time\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET shop_group = \'seller\' WHERE code = \'apply_options\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET shop_group = \'seller\' WHERE code = \'commission_model\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET shop_group = \'seller\' WHERE code = \'merchants_prefix\';';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' ( `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES ( \'7\', \'show_give_integral\', \'select\', \'1,0\', \'\', \'0\', \'1\');';
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
