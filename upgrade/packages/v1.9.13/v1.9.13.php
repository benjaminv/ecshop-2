<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v1_9_13
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

	public function up_v1_9_13()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'ALTER TABLE ' . $ecs->table('coupons') . ' ADD `spec_cat` TEXT NOT NULL AFTER `cou_goods` ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('coupons') . ' ADD `cou_ok_cat` TEXT NOT NULL AFTER `cou_ok_goods` ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('goods_activity') . ' ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `is_hot` ,
		ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
		ADD INDEX ( `review_status` ) ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('bonus_type') . ' ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `min_goods_amount` ,
		ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
		ADD INDEX ( `review_status` ) ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('topic') . ' ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `description` ,
		ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
		ADD INDEX ( `review_status` ) ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('favourable_activity') . ' ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `userFav_type` ,
		ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
		ADD INDEX ( `review_status` ) ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('wholesale') . ' ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `enabled` ,
		ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
		ADD INDEX ( `review_status` ) ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('exchange_goods') . ' ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `goods_id` ,
		ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
		ADD INDEX ( `review_status` ) ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('exchange_goods') . ' DROP PRIMARY KEY ,
		ADD UNIQUE (
		`goods_id`
		);';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('exchange_goods') . ' ADD `eid` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('presale_activity') . ' ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `is_finished` ,
		ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
		ADD INDEX ( `review_status` ) ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('coupons') . ' ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `cou_title` ,
		ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
		ADD INDEX ( `review_status` ) ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('gift_gard_type') . ' ADD `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `gift_number` ,
		ADD `review_content` VARCHAR( 1000 ) NOT NULL AFTER `review_status` ,
		ADD INDEX ( `review_status` ) ;';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('coupons') . ' SET review_status = 3 WHERE ru_id = 0 ;';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('goods_activity') . ' SET review_status = 3 WHERE user_id = 0 ;';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('bonus_type') . ' SET review_status = 3 WHERE user_id = 0 ;';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('topic') . ' SET review_status = 3 WHERE user_id = 0 ;';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('favourable_activity') . ' SET review_status = 3 WHERE user_id = 0 ;';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('wholesale') . ' SET review_status = 3 WHERE user_id = 0 ;';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('exchange_goods') . ' SET review_status = 3 WHERE user_id = 0 ;';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('presale_activity') . ' SET review_status = 3 WHERE user_id = 0 ;';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('gift_gard_type') . ' SET review_status = 3 WHERE ru_id = 0 ;';
		$db->query($sql);
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
