<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v1_8_7
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

	public function up_v1_8_7()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'SELECT id FROM ' . $ecs->table('shop_config') . ' WHERE code = \'extend_basic\'';
		$config_id = $db->getOne($sql, true);
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, \'' . $config_id . '\', \'add_shop_price\', \'select\', \'0,1\', \'\', \'1\', \'1\');';
		$db->query($sql, 'SILENT');
		$sql = 'UPDATE ' . $ecs->table('shop_config') . ' SET `type` = \'hidden\' WHERE `code` = \'skype\';';
		$db->query($sql, 'SILENT');
		$sql = 'UPDATE ' . $ecs->table('shop_config') . ' SET `type` = \'hidden\' WHERE `code` = \'ym\';';
		$db->query($sql, 'SILENT');
		$sql = 'UPDATE ' . $ecs->table('shop_config') . ' SET `type` = \'hidden\' WHERE `code` = \'msn\';';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('goods_attr') . ' ADD `admin_id` SMALLINT( 8 ) UNSIGNED NOT NULL AFTER `attr_pid`;';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('account_log') . ' CHANGE `log_id` `log_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL;';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('ad') . ' CHANGE `ad_id` `ad_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `position_id` `position_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('admin_action') . ' CHANGE `action_id` `action_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `parent_id` `parent_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('admin_user') . ' CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `ru_id` `ru_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('ad_position') . ' CHANGE `user_id` `user_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('alidayu_configure') . ' CHANGE `id` `id` SMALLINT( 5 ) NOT NULL AUTO_INCREMENT ;';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('area_region') . ' CHANGE `shipping_area_id` `shipping_area_id` SMALLINT( 8 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `region_id` `region_id` SMALLINT( 8 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('attribute_img') . ' CHANGE `id` `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `attr_id` `attr_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('back_goods') . ' CHANGE `rec_id` `rec_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `back_id` `back_id` INT( 10 ) UNSIGNED NULL DEFAULT \'0\',
CHANGE `goods_id` `goods_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\',
CHANGE `product_id` `product_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$db->query($sql, 'SILENT');
		$sql = 'ALTER TABLE ' . $ecs->table('back_goods') . ' ADD INDEX ( `product_id` ) ;';
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
