<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_4
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

	public function up_v2_4()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('admin_user') . ' CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('goods_transport_tpl'), 'admin_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport_tpl') . ' ADD `admin_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `configure`, ADD INDEX `admin_id` (`admin_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('goods_transport'), 'free_money');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport') . ' ADD `free_money` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\' AFTER `title` ;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('goods_transport'), 'shipping_title');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport') . ' ADD `shipping_title` VARCHAR(255) NOT NULL AFTER `title`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('products'), 'product_promote_price');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products') . ' ADD `product_promote_price` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\' AFTER `product_price`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('products_area'), 'product_promote_price');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_area') . ' ADD `product_promote_price` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\' AFTER `product_price`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('products_warehouse'), 'product_promote_price');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_warehouse') . ' ADD `product_promote_price` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\' AFTER `product_price`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('goods'), 'product_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD `product_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \'商品默认勾选属性货品\' AFTER `user_brand`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('goods'), 'product_price');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD `product_price` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\' COMMENT \'商品默认勾选属性货品价格\' AFTER `product_id`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('goods'), 'product_promote_price');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD `product_promote_price` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\' AFTER `product_price`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('goods'), 'product_table');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD `product_table` VARCHAR(60) NOT NULL DEFAULT \'products\' AFTER `user_brand`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products') . ' CHANGE `goods_attr` `goods_attr` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_area') . ' CHANGE `goods_attr` `goods_attr` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_warehouse') . ' CHANGE `goods_attr` `goods_attr` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('goods_transport_tpl'), 'tpl_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport_tpl') . ' ADD `tpl_name` VARCHAR(255) NOT NULL AFTER `id`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('coupons_region') . ' (
		  `cf_id` int(10) NOT NULL AUTO_INCREMENT,
		  `cou_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `region_list` varchar(255) NOT NULL,
		  PRIMARY KEY (`cf_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('order_info'), 'uc_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD `uc_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `coupons`, ADD INDEX `uc_id` (`uc_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('seckill'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seckill') . ' ADD  `ru_id` INT( 10 ) UNSIGNED NOT NULL COMMENT  \'商家ID\' AFTER  `sec_id`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('seckill'), 'review_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seckill') . ' ADD  `review_status` TINYINT( 1 ) NOT NULL DEFAULT \'1\' COMMENT  \'审核状态\';';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('shipping'), 'send_site');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping') . ' ADD `send_site` VARCHAR(50) NOT NULL AFTER `customer_pwd`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('shipping'), 'month_code');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping') . ' ADD `month_code` VARCHAR(50) NOT NULL AFTER `customer_pwd`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('link_goods_desc'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('link_goods_desc') . ' ADD `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `goods_id`, ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('link_desc_temporary'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('link_desc_temporary') . ' ADD `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `goods_id`, ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('link_goods_desc'), 'review_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('link_goods_desc') . ' ADD `review_status` TINYINT(1) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `goods_desc`, ADD INDEX `review_status` (`review_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('link_goods_desc'), 'review_content');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('link_goods_desc') . ' ADD `review_content` VARCHAR(255) NOT NULL AFTER `review_status`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport_tpl') . ' CHANGE `region_id` `region_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('coupons_region') . ' CHANGE `region_list` `region_list` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('admin_message') . ' CHANGE `message_id` `message_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('admin_user') . ' CHANGE `agency_id` `agency_id` INT(10) UNSIGNED NOT NULL, CHANGE `suppliers_id` `suppliers_id` INT(10) UNSIGNED NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('affiliate_log') . ' CHANGE `log_id` `log_id` INT(10) NOT NULL AUTO_INCREMENT, CHANGE `order_id` `order_id` INT(10) NOT NULL, CHANGE `user_id` `user_id` INT(10) NOT NULL;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('agency') . ' CHANGE `agency_id` `agency_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('article') . ' CHANGE `article_id` `article_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('article_cat') . ' CHANGE `cat_id` `cat_id` MEDIUMINT(8) NOT NULL AUTO_INCREMENT;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('article') . ' CHANGE `cat_id` `cat_id` MEDIUMINT(8) NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('attribute') . ' CHANGE `attr_input_category` `attr_input_category` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('auction_log') . ' CHANGE `log_id` `log_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, CHANGE `act_id` `act_id` INT(10) UNSIGNED NOT NULL, CHANGE `bid_user` `bid_user` INT(10) UNSIGNED NOT NULL;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('back_goods') . ' CHANGE `send_number` `send_number` INT(10) UNSIGNED NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('back_order') . ' CHANGE `back_id` `back_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `delivery_sn` `delivery_sn` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
		CHANGE `order_sn` `order_sn` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
		CHANGE `order_id` `order_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `user_id` `user_id` INT(10) UNSIGNED NULL DEFAULT \'0\', 
		CHANGE `country` `country` INT(10) UNSIGNED NULL DEFAULT \'0\', 
		CHANGE `province` `province` INT(10) UNSIGNED NULL DEFAULT \'0\', 
		CHANGE `city` `city` INT(10) UNSIGNED NULL DEFAULT \'0\', 
		CHANGE `district` `district` INT(10) UNSIGNED NULL DEFAULT \'0\', 
		CHANGE `agency_id` `agency_id` INT(10) UNSIGNED NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('baitiao') . ' CHANGE `baitiao_id` `baitiao_id` INT(10) NOT NULL AUTO_INCREMENT, 
		CHANGE `user_id` `user_id` INT(10) NOT NULL COMMENT \'用户id\', 
		CHANGE `over_repay_trem` `over_repay_trem` INT(10) NOT NULL DEFAULT \'0\' COMMENT \'超过还款期限的天数\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('baitiao') . ' CHANGE `amount` `amount` DECIMAL(10,2) NOT NULL DEFAULT \'0.00\' COMMENT \'白条金额\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('baitiao_log') . ' CHANGE `log_id` `log_id` INT(10) NOT NULL AUTO_INCREMENT, 
		CHANGE `baitiao_id` `baitiao_id` INT(10) NOT NULL COMMENT \'白条id\', 
		CHANGE `user_id` `user_id` INT(10) NOT NULL COMMENT \'用户id\', 
		CHANGE `order_id` `order_id` INT(10) NOT NULL COMMENT \'订单id\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('bonus_type') . ' CHANGE `type_id` `type_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('booking_goods') . ' CHANGE `rec_id` `rec_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_number` `goods_number` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('brand') . ' CHANGE `brand_id` `brand_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' CHANGE `take_time` `take_time` DATETIME NOT NULL DEFAULT \'1000-01-01 00:00:00\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' CHANGE `rec_id` `rec_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_number` `goods_number` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `is_gift` `is_gift` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' CHANGE `rec_id` `rec_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `product_id` `product_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `is_gift` `is_gift` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_type') . ' CHANGE `cat_id` `cat_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_type_cat') . ' CHANGE `cat_id` `cat_id` INT(10) NOT NULL AUTO_INCREMENT, 
		CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `sort_order` `sort_order` INT(10) UNSIGNED NOT NULL DEFAULT \'50\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_cat') . ' CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `cat_id` `cat_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('group_goods') . ' CHANGE `id` `id` INT(10) NOT NULL AUTO_INCREMENT, 
		CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport') . ' CHANGE `tid` `tid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport_express') . ' CHANGE `tid` `tid` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport_extend') . ' CHANGE `tid` `tid` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport_tpl') . ' CHANGE `id` `id` INT(10) NOT NULL AUTO_INCREMENT, 
		CHANGE `tid` `tid` INT(10) NOT NULL DEFAULT \'0\', 
		CHANGE `user_id` `user_id` INT(10) NOT NULL DEFAULT \'0\', 
		CHANGE `shipping_id` `shipping_id` INT(10) NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('link_area_goods') . ' CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `region_id` `region_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('link_goods') . ' CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `link_goods_id` `link_goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('return_goods') . ' CHANGE `rec_id` `rec_id` INT(10) UNSIGNED NOT NULL, 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `product_id` `product_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('return_action') . ' CHANGE `action_id` `action_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `ret_id` `ret_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `log_time` `log_time` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('return_images') . ' CHANGE `id` `id` INT(10) NOT NULL AUTO_INCREMENT, 
		CHANGE `rg_id` `rg_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `rec_id` `rec_id` INT(10) NOT NULL, 
		CHANGE `user_id` `user_id` INT(10) NOT NULL, CHANGE `add_time` `add_time` INT(10) NOT NULL;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_return') . ' CHANGE `order_id` `order_id` INT(10) NOT NULL COMMENT \'所属订单号\', 
		CHANGE `country` `country` INT(10) NOT NULL COMMENT \'国家\', 
		CHANGE `province` `province` INT(10) NOT NULL COMMENT \'省份\', 
		CHANGE `city` `city` INT(10) NOT NULL COMMENT \'城市\', 
		CHANGE `district` `district` INT(10) NOT NULL COMMENT \'区\', 
		CHANGE `street` `street` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' CHANGE `order_id` `order_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `main_order_id` `main_order_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `country` `country` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `province` `province` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `city` `city` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `district` `district` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `street` `street` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `bonus_id` `bonus_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `extension_id` `extension_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `agency_id` `agency_id` INT(10) UNSIGNED NOT NULL, 
		CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `is_zc_order` `is_zc_order` INT(10) NULL DEFAULT \'0\', 
		CHANGE `zc_goods_id` `zc_goods_id` INT(10) NOT NULL, 
		CHANGE `vat_id` `vat_id` INT(10) NOT NULL DEFAULT \'0\' COMMENT \'增值税发票信息ID 关联 users_vat_invoices_info表自增ID\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_action') . ' CHANGE `action_id` `action_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `order_id` `order_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `log_time` `log_time` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'checkbill_number\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
			$config_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'checkbill_number\', \'hidden\', \'\', \'\', \'10\', \'1\', \'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `type` = \'hidden\', `value` = \'1\' WHERE `code` = \'goods_attr_price\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'basic_logo\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id` ,`parent_id` ,`code` ,`type` ,`store_range` ,`store_dir` ,`value` ,`sort_order` ,`shop_group`) VALUES (NULL ,  \'0\',  \'basic_logo\',  \'group\',  \'\',  \'\',  \'\',  \'1\',  \'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'basic_logo\'';
		$config_id = $GLOBALS['db']->getOne($sql, true);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET  `parent_id` =  \'' . $config_id . '\' WHERE  `code` =\'index_down_logo\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET  `parent_id` =  \'' . $config_id . '\' WHERE  `code` =\'user_login_logo\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET  `parent_id` =  \'' . $config_id . '\' WHERE  `code` =\'login_logo_pic\';';
		$GLOBALS['db']->query($sql);
		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'admin_login_logo\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`,`shop_group`) VALUES (NULL, \'' . $config_id . '\', \'admin_login_logo\', \'file\', \'\', \'admin/images/\', \'\', \'1\',\'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'admin_logo\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`,`shop_group`) VALUES (NULL, \'' . $config_id . '\', \'admin_logo\', \'file\', \'\', \'admin/images/\', \'\', \'1\',\'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'seller_login_logo\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`,`shop_group`) VALUES (NULL, \'' . $config_id . '\', \'seller_login_logo\', \'file\', \'\', \'seller/images/\', \'\', \'1\',\'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'seller_logo\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`,`shop_group`) VALUES (NULL, \'' . $config_id . '\', \'seller_logo\', \'file\', \'\', \'seller/images/\', \'\', \'1\',\'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'stores_login_logo\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`,`shop_group`) VALUES (NULL, \'' . $config_id . '\', \'stores_login_logo\', \'file\', \'\', \'stores/images/\', \'\', \'1\',\'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'stores_logo\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`,`shop_group`) VALUES (NULL, \'' . $config_id . '\', \'stores_logo\', \'file\', \'\', \'stores/images/\', \'\', \'1\',\'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('seckill') . ' SET review_status = 3 WHERE ru_id = 0;';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET `seller_show` = \'0\' WHERE `action_code` = \'logs_drop\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('link_goods_desc') . ' SET review_status = 3 WHERE ru_id = 0;';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET seller_show = 1 WHERE action_code = \'seckill_manage\';';
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
