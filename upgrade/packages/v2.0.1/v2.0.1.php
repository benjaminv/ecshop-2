<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_0_1
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

	public function up_v2_0_1()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' ADD  `self_run` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  \'0\' COMMENT  \'自营店铺\';';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD `goods_unit` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'个\';';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport') . ' ADD `freight_type` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `type` ;';
		$db->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('goods_transport_tpl') . ' (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `tid` int(11) NOT NULL DEFAULT \'0\',
		  `user_id` int(11) NOT NULL DEFAULT \'0\',
		  `shipping_id` int(11) NOT NULL DEFAULT \'0\',
		  `region_id` varchar(255) NOT NULL DEFAULT \'\',
		  `configure` text NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;';
		$db->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('source_ip') . ' (
		  `ipid` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `storeid` int(10) NOT NULL,
		  `ipdata` varchar(16) NOT NULL COMMENT \'访问者的IP\',
		  `iptime` varchar(30) NOT NULL COMMENT \'访问时间\',
		  PRIMARY KEY (`ipid`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seckill') . ' ADD  `begin_time` INT( 11 ) NOT NULL AFTER  `acti_title`;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_shopinfo') . ' ADD `frozen_money` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT \'0.00\' AFTER `seller_money` ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD `is_frozen` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_account_log') . ' ADD `frozen_money` DECIMAL( 10, 2 ) NOT NULL DEFAULT \'0.00\' AFTER `amount` ;';
		$db->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('merchants_account_log') . ' (
		  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `user_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `user_money` decimal(10,2) NOT NULL DEFAULT \'0.00\',
		  `frozen_money` decimal(10,2) NOT NULL DEFAULT \'0.00\',
		  `change_time` int(10) unsigned NOT NULL,
		  `change_desc` varchar(255) NOT NULL DEFAULT \'\',
		  `change_type` tinyint(3) unsigned NOT NULL DEFAULT \'0\',
		  PRIMARY KEY (`log_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;';
		$db->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET `seller_show` = 0 WHERE `action_code` = \'notice_logs\';';
		$db->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET `seller_show` = 0 WHERE `action_code` = \'picture_batch\';';
		$db->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET `seller_show` = 0 WHERE `action_code` = \'single_manage\';';
		$db->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET `seller_show` = 0 WHERE `action_code` = \'single_edit_delete\';';
		$db->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET `seller_show` = 0 WHERE `action_code` = \'sale_notice\';';
		$db->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('ad_position') . (' ( `user_id`, `position_name`, `ad_width`, `ad_height`, `position_model`, `position_desc`, `position_style`, `is_public`, `theme`) VALUES
( 0, \'顶级分类页（默认）品牌旗舰\', 200, 200, \'category_top_default_brand[num_id]_[cat_id]\', \'num_id-数量序号，cat_id-分类ID\', \'{foreach from=' . $ads . ' item=ad}
' . $ad . '
{/foreach}\', 0, \'ecmoban_dsc2017\');');
		$db->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES
( 3, \'marticle_index\', \'text\', \'\', \'\', \'1,2,3,4\', 1);';
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
