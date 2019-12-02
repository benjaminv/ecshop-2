<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_6_3
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

	public function up_v2_6_3()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$field = get_table_file_name($GLOBALS['ecs']->table('order_info'), 'point_id');

		if ($field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' MODIFY COLUMN `point_id`  varchar(255) NOT NULL DEFAULT \'\';';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('touch_ad_position'), 'tc_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('touch_ad_position') . ' ADD  `tc_id` INT( 10 ) UNSIGNED NOT NULL;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('touch_ad_position'), 'tc_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('touch_ad_position') . ' ADD  `tc_type` VARCHAR( 255 ) NOT NULL;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('touch_ad_position'), 'ad_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('touch_ad_position') . ' ADD  `ad_type` VARCHAR( 20 ) NOT NULL;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT position_id FROM ' . $GLOBALS['ecs']->table('touch_ad_position') . ' WHERE position_name = \'秒杀-banner广告位\'';

		if (!$GLOBALS['db']->getOne($sql)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('touch_ad_position') . (' (`position_id`, `user_id`, `position_name`, `ad_width`, `ad_height`, `position_desc`, `position_style`, `is_public`, `theme`, `tc_id`, `tc_type`, `ad_type`) VALUES (NULL, \'0\', \'秒杀-banner广告位\', \'360\', \'168\', \'\', \'{foreach ' . $ads . ' as ' . $ad . '}<div class="swiper-slide">' . $ad . '</div>{/foreach}\', \'0\', \'ecmoban_dsc2017\', \'0\', \'banner\', \'seckill\');');
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
