<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_3_8
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

	public function up_v2_3_8()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$field = get_table_file_name($GLOBALS['ecs']->table('baitiao_log'), 'pay_num');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('baitiao_log') . ' ADD `pay_num` TINYINT(1) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `is_refund`, ADD INDEX `pay_num` (`pay_num`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('baitiao_pay_log') . ' (
		  `id` int(10) NOT NULL AUTO_INCREMENT,
		  `baitiao_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `log_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `stages_num` smallint(3) unsigned NOT NULL DEFAULT \'0\',
		  `stages_price` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `is_pay` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  `pay_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `pay_code` varchar(20) NOT NULL,
		  `add_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `pay_time` int(10) unsigned NOT NULL DEFAULT \'0\',
		  PRIMARY KEY (`id`),
		  KEY `stages_num` (`stages_num`) USING BTREE,
		  KEY `log_id` (`log_id`) USING BTREE,
		  KEY `baitiao_id` (`baitiao_id`),
		  KEY `is_pay` (`is_pay`),
		  KEY `pai_id` (`pay_id`)
		) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('goods_transport_tpl'), 'admin_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport_tpl') . ' ADD `admin_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `configure`, ADD INDEX `admin_id` (`admin_id`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'brand_belongs\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
			$config_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'brand_belongs\', \'hidden\', \'0,1\', \'\', \'0\', \'1\', \'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT position_id FROM ' . $GLOBALS['ecs']->table('touch_ad_position') . ' WHERE position_name = \'首页红包广告\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('touch_ad_position') . ('(`position_id`, `user_id`, `position_name`, `ad_width`, `ad_height`, `position_desc`, `position_style`, `is_public`, `theme`) VALUES (NUll, \'0\', 	\'首页红包广告\', \'360\', \'180\', \'\', \'{foreach ' . $ads . ' as ' . $ad . '}
<div class="swiper-slide">' . $ad . '</div>
{/foreach}\', \'1\', \'ecmoban_dsc2017\');');
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT ad_id FROM ' . $GLOBALS['ecs']->table('touch_ad') . ' WHERE ad_name = \'首页红包广告\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT position_id FROM ' . $GLOBALS['ecs']->table('touch_ad_position') . ' WHERE position_name = \'首页红包广告\'';
			$position_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('touch_ad') . '(`ad_id`,`position_id`, `media_type`, `ad_name`, `ad_link`, `link_color`, `ad_code`, `start_time`, `end_time`, `link_man`, `link_email`, `link_phone`, `click_count`, `enabled`, `is_new`, `is_hot`, `is_best`, `public_ruid`, `ad_type`, `goods_name`) VALUES (NUll,\'' . $position_id . '\', \'0\', \'首页红包广告\', \'index.php?m=bonus\', \'\', \'1508375910448249656.png\', \'1508374020\', \'1606696948\', \'\', \'\', \'\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\')';
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
