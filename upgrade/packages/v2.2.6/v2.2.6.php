<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_2_6
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

	public function up_v2_2_6()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('seller_shopinfo_changelog') . ' (
		  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `ru_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `data_key` varchar(50) NOT NULL,
		  `data_value` text NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE  ' . $GLOBALS['ecs']->table('seller_shopinfo') . ' ADD  `review_status` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  \'1\',
		ADD  `review_content` VARCHAR( 100 ) NOT NULL;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products') . ' CHANGE `product_number` `product_number` INT( 10 ) UNSIGNED NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_area') . ' CHANGE `product_number` `product_number` INT( 10 ) UNSIGNED NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_warehouse') . ' CHANGE `product_number` `product_number` INT( 10 ) UNSIGNED NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD  `commission_rate` VARCHAR( 10 ) NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD  `commission_rate` VARCHAR( 10 ) NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' ADD  `commission_rate` VARCHAR( 10 ) NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD  `commission_rate` VARCHAR( 10 ) NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_bill_goods') . ' ADD  `commission_rate` VARCHAR( 10 ) NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('pay_card_type') . ' CHANGE `type_money` `type_money` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT \'0.00\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_address') . ' ADD `userUp_time` VARCHAR( 120 ) AFTER `audit`;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD `is_update_sale` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_commission_bill') . ' ADD `actual_amount` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT \'0.00\' COMMENT \'实结金额（账单结束）\' AFTER `should_amount` ;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_vat_invoices_info') . ' ADD `country` int(10) unsigned NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_vat_invoices_info') . ' ADD `province` int(10) unsigned NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_vat_invoices_info') . ' ADD `city` int(10) unsigned NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_vat_invoices_info') . ' ADD `district` int(10) unsigned NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_vat_invoices_info') . ' DROP `consignee_province`;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_goods') . ' CHANGE  `give_integral`  `give_integral` INT( 10 ) NOT NULL DEFAULT  \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_goods') . ' CHANGE  `rank_integral`  `rank_integral` INT( 10 ) NOT NULL DEFAULT  \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'goods\'';
		$config_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `shop_group` = \'goods\' WHERE `parent_id` = \'' . $config_id . '\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `shop_group` = \'goods\' WHERE `code` IN (\'watermark\',\'watermark_place\',\'watermark_alpha\',\'use_storage\',\'market_price_rate\',\'sn_prefix\',\'no_picture\',\'comment_factor\',\'default_storage\',\'bgcolor\',\'auto_generate_gallery\',\'retain_original_img\',\'image_width\',\'image_height\',\'bought_goods\',\'goods_name_length\',\'price_format\',\'page_size\',\'sort_order_type\',\'sort_order_method\',\'show_order_type\',\'attr_related_number\',\'goods_gallery_number\',\'related_goods_number\',\'recommend_order\',\'open_area_goods\',\'freight_model\',\'group_goods\',\'attr_set_up\',\'goods_file\',\'show_warehouse\',\'two_code\',\'two_code_logo\',\'exchange_size\',\'category_load_type\',\'goods_attr_price\',\'add_shop_price\',\'no_brand\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, \'11\', \'sms_setting\', \'\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'4\', \'sales_volume_time\', \'select\', \'1,0\', \'\', \'1\', \'1\', \'\');';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'0\', \'goods_base\', \'group\', \'\', \'\', \'\', \'1\', \'goods\'), (NULL, \'0\', \'goods_display\', \'group\', \'\', \'\', \'\', \'1\', \'goods\'), (NULL, \'0\', \'goods_page\', \'group\', \'\', \'\', \'\', \'1\', \'goods\'), (NULL, \'0\', \'goods_picture\', \'group\', \'\', \'\', \'\', \'1\', \'goods\');';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'goods_base\'';
		$config_id1 = $GLOBALS['db']->getOne($sql, true);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'goods_display\'';
		$config_id2 = $GLOBALS['db']->getOne($sql, true);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'goods_page\'';
		$config_id3 = $GLOBALS['db']->getOne($sql, true);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'goods_picture\'';
		$config_id4 = $GLOBALS['db']->getOne($sql, true);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET  `parent_id` =  \'' . $config_id1 . '\' WHERE `code` IN (\'goods_attr_price\', \'add_shop_price\', \'use_storage\', \'market_price_rate\', \'sn_prefix\', \'comment_factor\', \'default_storage\', \'group_goods\', \'attr_set_up\', \'show_warehouse\', \'goods_file\', \'freight_model\', \'goods_name_length\', \'price_format\', \'recommend_order\', \'open_area_goods\');';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET  `parent_id` =  \'' . $config_id2 . '\' WHERE `code` IN (\'show_goodssn\', \'show_brand\', \'show_goodsweight\', \'show_goodsnumber\', \'show_addtime\', \'goodsattr_style\', \'show_marketprice\', \'show_rank_price\', \'show_give_integral\');';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET  `parent_id` =  \'' . $config_id3 . '\' WHERE `code` IN (\'exchange_size\', \'category_load_type\', \'page_size\', \'sort_order_type\', \'sort_order_method\', \'show_order_type\', \'bought_goods\', \'attr_related_number\', \'related_goods_number\');';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET  `parent_id` =  \'' . $config_id4 . '\' WHERE `code` IN (\'watermark\', \'no_picture\', \'two_code_logo\', \'no_brand\', \'watermark_place\', \'watermark_alpha\', \'bgcolor\', \'auto_generate_gallery\', \'retain_original_img\', \'image_width\', \'image_height\', \'two_code\', \'goods_gallery_number\');';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'merchants\'';
		$action_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'DELETE FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'touch_dashboard\' AND parent_id = \'' . $action_id . '\';';
		$GLOBALS['db']->query($sql);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, \'0\', \'third_party_service\', \'\', \'0\');';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'third_party_service\'';
		$action_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET  `parent_id` =  \'' . $action_id . '\' WHERE  `dsc_admin_action`.`action_code` =\'sms_setting\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET  `parent_id` =  \'' . $action_id . '\' WHERE  `dsc_admin_action`.`action_code` =\'website\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET  `parent_id` =  \'' . $action_id . '\' WHERE  `dsc_admin_action`.`action_code` =\'oss_configure\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET  `parent_id` =  \'' . $action_id . '\' WHERE  `dsc_admin_action`.`action_code` =\'open_api\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
		$config_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' ( `parent_id` , `code` , `type` , `store_range` , `value` , `sort_order` ) VALUES ( \'' . $config_id . '\', \'bonus_adv\', \'select\', \'0,1\', 1, 1 );';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'goods_picture\'';
		$config_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET  `parent_id` =  \'' . $config_id . '\', `shop_group` = \'goods\' WHERE `code` IN (\'two_code_links\', \'two_code_mouse\');';
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
