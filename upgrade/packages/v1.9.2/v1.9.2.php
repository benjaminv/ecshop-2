<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v1_9_2
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

	public function up_v1_9_2()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'ALTER TABLE ' . $ecs->table('presale_cat') . ' CHANGE `cid` `cat_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `c_name` `cat_name` VARCHAR( 90 ) NOT NULL ,
CHANGE `parent_cid` `parent_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('presale_cat') . ' ADD INDEX ( `parent_id` ) ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('presale_cat') . '  
	ADD `keywords` VARCHAR(255) NOT NULL AFTER `cat_name`,  
	ADD `cat_desc` VARCHAR(255) NOT NULL AFTER `keywords`,  
	ADD `measure_unit` VARCHAR(15) NOT NULL AFTER `cat_desc`,  
	ADD `show_in_nav` TINYINT(1) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `measure_unit`,  
	ADD `style` VARCHAR(150) NOT NULL AFTER `show_in_nav`,  
	ADD `grade` TINYINT(4) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `style`,  
	ADD `filter_attr` VARCHAR(225) NOT NULL AFTER `grade`,  
	ADD `is_top_style` TINYINT(3) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `filter_attr`,  
	ADD `top_style_tpl` VARCHAR(255) NOT NULL AFTER `is_top_style`,  
	ADD `cat_icon` VARCHAR(255) NOT NULL AFTER `top_style_tpl`,  
	ADD `is_top_show` TINYINT(3) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `cat_icon`,  
	ADD `category_links` TEXT NOT NULL AFTER `is_top_show`,  
	ADD `category_topic` TEXT NOT NULL AFTER `category_links`,  
	ADD `pinyin_keyword` TEXT NOT NULL AFTER `category_topic`,  
	ADD `cat_alias_name` VARCHAR(90) NOT NULL AFTER `pinyin_keyword`,  
	ADD `template_file` VARCHAR(50) NOT NULL AFTER `cat_alias_name`;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('presale_cat') . ' ADD `is_show` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `style` ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('presale_cat') . ' ADD INDEX ( `is_show` ) ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('presale_activity') . ' CHANGE `cid` `cat_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('seller_shopinfo') . ' ADD `tengxun_key` VARCHAR( 255 ) NOT NULL AFTER `longitude` ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('goods') . ' CHANGE `goods_number` `goods_number` INT( 10 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('goods_article') . ' DROP PRIMARY KEY;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('goods_article') . ' ADD `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('goods_article') . ' ADD INDEX ( `goods_id` , `article_id` , `admin_id` ) ;';
		$db->query($sql);
		$sql = 'ALTER TABLE ' . $ecs->table('zc_category') . '  
	ADD `keywords` VARCHAR(255) NOT NULL AFTER `cat_name`,  
	ADD `measure_unit` VARCHAR(15) NOT NULL AFTER `keywords`,  
	ADD `show_in_nav` TINYINT(1) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `measure_unit`,  
	ADD `style` VARCHAR(150) NOT NULL AFTER `show_in_nav`,  
	ADD `grade` TINYINT(4) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `style`,  
	ADD `filter_attr` VARCHAR(225) NOT NULL AFTER `grade`,  
	ADD `is_top_style` TINYINT(3) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `filter_attr`,  
	ADD `top_style_tpl` VARCHAR(255) NOT NULL AFTER `is_top_style`,  
	ADD `cat_icon` VARCHAR(255) NOT NULL AFTER `top_style_tpl`,  
	ADD `is_top_show` TINYINT(3) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `cat_icon`,  
	ADD `category_links` TEXT NOT NULL AFTER `is_top_show`,  
	ADD `category_topic` TEXT NOT NULL AFTER `category_links`,  
	ADD `pinyin_keyword` TEXT NOT NULL AFTER `category_topic`,  
	ADD `cat_alias_name` VARCHAR(90) NOT NULL AFTER `pinyin_keyword`,  
	ADD `template_file` VARCHAR(50) NOT NULL AFTER `cat_alias_name`;';
		$db->query($sql);
		$sql = 'SELECT id FROM ' . $ecs->table('shop_config') . ' WHERE code = \'extend_basic\'';
		$config_id = $db->getOne($sql, true);
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, \'' . $config_id . '\', \'use_coupons\', \'select\', \'0,1\', \'\', \'1\', \'1\');';
		$db->query($sql);
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, \'' . $config_id . '\', \'tengxun_key\', \'text\', \'\', \'\', \'\', \'1\');';
		$db->query($sql);
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, \'' . $config_id . '\', \'kuaidi100_key\', \'text\', \'\', \'\', \'\', \'1\');';
		$db->query($sql);
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, \'' . $config_id . '\', \'ip_type\', \'select\', \'0,1,2\', \'\', \'0\', \'1\');';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('shop_config') . ' SET `type` = \'hidden\' WHERE `code` = \'goodsattr_style\';';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('shop_config') . ' SET `type` = \'hidden\' WHERE `code` = \'seller_email\';';
		$db->query($sql);
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, \'' . $config_id . '\', \'ectouch_qrcode\', \'file\', \'\', \'../images/common/\', \'\', \'1\');';
		$db->query($sql);
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, \'' . $config_id . '\', \'ecjia_qrcode\', \'file\', \'\', \'../images/common/\', \'\', \'1\');';
		$db->query($sql);
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, \'' . $config_id . '\', \'index_down_logo\', \'file\', \'\', \'../images/common/\', \'\', \'1\');';
		$db->query($sql);
		$sql = 'INSERT INTO ' . $ecs->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, \'' . $config_id . '\', \'site_commitment\', \'file\', \'\', \'../images/common/\', \'\', \'1\');';
		$db->query($sql);
		$sql = 'SELECT action_id FROM ' . $ecs->table('admin_action') . ' WHERE action_code = \'merchants\'';
		$action_id = $db->getOne($sql, true);
		$sql = 'INSERT INTO ' . $ecs->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, \'1\', \'review_status\', \'\', \'0\');';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('admin_action') . ' SET `seller_show` = \'1\' WHERE `action_code` = \'shiparea_manage\';';
		$db->query($sql);
		$sql = 'INSERT INTO ' . $ecs->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, \'' . $action_id . '\', \'comment_seller\', \'\', \'0\');';
		$db->query($sql);
		$sql = 'UPDATE ' . $ecs->table('admin_action') . ' SET `seller_show` = \'0\' WHERE `action_code` = \'brand_manage\';';
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
