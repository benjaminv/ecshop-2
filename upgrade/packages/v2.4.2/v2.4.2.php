<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_4_2
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

	public function up_v2_4_2()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('region_store') . ' (
		  `rs_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `rs_name` varchar(50) NOT NULL,
		  PRIMARY KEY (`rs_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('rs_region') . ' (
		  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `rs_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `region_id` smallint(5) unsigned NOT NULL DEFAULT \'0\',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('admin_user'), 'rs_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('admin_user') . ' ADD `rs_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `ru_id`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('merchants_shop_information'), 'region_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' ADD `region_id` SMALLINT(5) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `user_id`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('home_templates') . ' (
		  `temp_id` int(10) NOT NULL AUTO_INCREMENT,
		  `rs_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `code` varchar(60) NOT NULL,
		  `is_enable` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		  `theme` varchar(160) NOT NULL,
		  PRIMARY KEY (`temp_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('favourable_activity'), 'userFav_type_ext');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('favourable_activity') . ' ADD  `userFav_type_ext` VARCHAR( 255 ) NOT NULL COMMENT  \'使用类型扩展\' AFTER  `userFav_type`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('search_keyword'), 'result_count');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('search_keyword') . ' ADD  `result_count` INT( 32 ) UNSIGNED NOT NULL DEFAULT  \'0\';';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('favourable_activity'), 'rs_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('favourable_activity') . ' ADD  `rs_id` int(10) NOT NULL COMMENT  \'卖场ID\' AFTER  `user_id`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('seckill_goods_remind') . ' (
		  `r_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'自增秒杀提醒ID\',
		  `user_id` int(10) NOT NULL COMMENT \'用户ID\',
		  `sec_goods_id` int(10) NOT NULL COMMENT \'秒杀商品ID\',
		  `add_time` int(11) NOT NULL COMMENT \'添加时间\',
		  PRIMARY KEY (`r_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT=\'秒杀商品提醒关联表\' AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('cart'), 'stages_qishu');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' CHANGE `stages_qishu` `stages_qishu` MEDIUMINT(5) NOT NULL DEFAULT \'-1\' COMMENT \'用户选择的当前商品的分期期数 -1:不分期\';';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('order_goods'), 'stages_qishu');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' ADD `stages_qishu` MEDIUMINT(5) NOT NULL DEFAULT \'-1\' COMMENT \'用户选择的当前商品的分期期数 -1:不分期\' AFTER `commission_rate`, ADD INDEX (`stages_qishu`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' CHANGE `rec_id` `rec_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `order_id` `order_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `product_id` `product_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `is_gift` `is_gift` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `warehouse_id` `warehouse_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `area_id` `area_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `warehouse_id` `warehouse_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `area_id` `area_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_shopinfo') . ' CHANGE `seller_money` `seller_money` DECIMAL(10,2) NOT NULL DEFAULT \'0.00\', 
		CHANGE `frozen_money` `frozen_money` DECIMAL(10,2) NOT NULL DEFAULT \'0.00\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_return') . ' CHANGE `apply_time` `apply_time` INT(10) NOT NULL DEFAULT \'0\' COMMENT \'退换货申请时间\', 
		CHANGE `return_time` `return_time` INT(10) NOT NULL DEFAULT \'0\' COMMENT \'退换货时间\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('seller_shopinfo'), 'credit_money');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_shopinfo') . ' ADD `credit_money` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\' AFTER `frozen_money`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('merchants_shop_information'), 'shop_close');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' ADD `shop_close` TINYINT(1) UNSIGNED NOT NULL DEFAULT \'1\' COMMENT \'是否关闭店铺（0：关闭，1：开启）\' AFTER `self_run`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('seller_shopinfo'), 'status');

		if ($field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_shopinfo') . ' CHANGE `status` `shop_close` TINYINT(1) NOT NULL DEFAULT \'1\' COMMENT \'是否关闭店铺（0：关闭，1：开启）\';';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('order_goods'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' ADD `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \'会员ID\' AFTER `order_id`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_file_name($GLOBALS['ecs']->table('order_goods'), 'cart_recid');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' ADD `cart_recid` TEXT NOT NULL AFTER `user_id`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_domain') . ' CHANGE `id` `id` INT(10) NOT NULL AUTO_INCREMENT, 
		CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `validity_time` `validity_time` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment') . ' CHANGE `id_value` `id_value` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `single_id` `single_id` INT(10) UNSIGNED NULL DEFAULT \'0\', 
		CHANGE `order_id` `order_id` INT(10) UNSIGNED NULL DEFAULT \'0\', 
		CHANGE `dis_id` `dis_id` INT(10) UNSIGNED NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('products_changelog') . ' (
		  `product_id` int(10) NOT NULL AUTO_INCREMENT,
		  `goods_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `goods_attr` varchar(50) NOT NULL,
		  `product_sn` varchar(60) NOT NULL,
		  `bar_code` varchar(60) NOT NULL,
		  `product_number` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `product_price` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `product_market_price` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `product_promote_price` decimal(10,2) unsigned NOT NULL DEFAULT \'0.00\',
		  `product_warn_number` int(10) unsigned NOT NULL DEFAULT \'0\',
		  `warehouse_id` int(11) unsigned NOT NULL DEFAULT \'0\',
		  `area_id` int(11) unsigned NOT NULL DEFAULT \'0\',
		  `admin_id` int(10) unsigned NOT NULL DEFAULT \'0\',
		  PRIMARY KEY (`product_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('seller_bill_goods'), 'dis_amount');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_bill_goods') . ' ADD `dis_amount` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\' COMMENT \'商品单品满减优惠金额\' AFTER `goods_price`;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_gift_gard') . ' CHANGE `gift_gard_id` `gift_gard_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		CHANGE `user_id` `user_id` INT(10) UNSIGNED NULL DEFAULT \'0\', 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NULL DEFAULT \'0\', 
		CHANGE `user_time` `user_time` INT(10) UNSIGNED NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_feed') . ' CHANGE `feed_id` `feed_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `value_id` `value_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_bank') . ' CHANGE `id` `id` INT(10) NOT NULL AUTO_INCREMENT;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_bonus') . ' CHANGE `bonus_id` `bonus_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `user_id` `user_id` INT(8) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `order_id` `order_id` INT(8) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_account_fields') . ' CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \'关联用户id\', 
		CHANGE `account_id` `account_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \'关联ecs_user_account表id\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_account') . ' CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_vat_invoices_info') . ' CHANGE `id` `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT \'自增ID\', 
		CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \'用户ID\', 
		CHANGE `add_time` `add_time` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \'添加时间\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_paypwd') . ' CHANGE `paypwd_id` `paypwd_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('trade_snapshot') . ' CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_number` `goods_number` INT(5) UNSIGNED NOT NULL DEFAULT \'1\', 
		CHANGE `add_time` `add_time` INT(11) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `ru_id` `ru_id` INT(11) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_products') . ' CHANGE `product_id` `product_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `product_number` `product_number` INT(10) UNSIGNED NULL DEFAULT \'0\', 
		CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `store_id` `store_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_order') . ' CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `order_id` `order_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `store_id` `store_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_goods') . ' CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `store_id` `store_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_number` `goods_number` int(10) UNSIGNED NOT NULL DEFAULT \'1\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_action') . ' CHANGE `action_id` `action_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `parent_id` `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping_tpl') . ' CHANGE `st_id` `st_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `shipping_id` `shipping_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `ru_id` `ru_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping_area') . ' CHANGE `shipping_area_id` `shipping_area_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
		CHANGE `shipping_id` `shipping_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping') . ' CHANGE `shipping_id` `shipping_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_template_apply') . ' CHANGE `temp_id` `temp_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `pay_id` `pay_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seckill_goods_remind') . ' CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \'用户ID\', 
		CHANGE `sec_goods_id` `sec_goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \'秒杀商品ID\', 
		CHANGE `add_time` `add_time` INT(11) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \'添加时间\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seckill_goods') . ' CHANGE `sec_id` `sec_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `tb_id` `tb_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \'秒杀时段ID\', 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('reg_extend_info') . ' CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('package_goods') . ' CHANGE `package_id` `package_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_id` `goods_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `product_id` `product_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `goods_number` `goods_number` INT(10) UNSIGNED NOT NULL DEFAULT \'1\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_inventory_logs') . ' CHANGE `warehouse_id` `warehouse_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `area_id` `area_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `suppliers_id` `suppliers_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('comment'), 'status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment') . ' ADD INDEX `status` (`status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('merchants_shop_information'), 'shop_close');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' ADD INDEX `shop_close` (`shop_close`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_goods'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'product_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `product_id` (`product_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'is_real');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `is_real` (`is_real`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'parent_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `parent_id` (`parent_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'is_shipping');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `is_shipping` (`is_shipping`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'store_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `store_id` (`store_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'freight');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `freight` (`freight`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'tid');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `tid` (`tid`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'is_checked');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `is_checked` (`is_checked`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'warehouse_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `warehouse_id` (`warehouse_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'area_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `area_id` (`area_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('ad_position'), 'theme');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('ad_position') . ' ADD INDEX `theme` (`theme`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('ad'), 'ad_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('ad') . ' ADD INDEX `ad_name` (`ad_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('ad'), 'media_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('ad') . ' ADD INDEX `media_type` (`media_type`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('ad'), 'start_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('ad') . ' ADD INDEX `start_time` (`start_time`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('ad'), 'end_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('ad') . ' ADD INDEX `end_time` (`end_time`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_area_goods'), 'region_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_area_goods') . ' ADD INDEX `region_id` (`region_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('presale_activity'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('presale_activity') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('presale_activity'), 'goods_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('presale_activity') . ' ADD INDEX `goods_name` (`goods_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('presale_activity'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('presale_activity') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('presale_activity'), 'cat_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('presale_activity') . ' ADD INDEX `cat_id` (`cat_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_area_attr'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_area_attr') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_area_attr'), 'goods_attr_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_area_attr') . ' ADD INDEX `goods_attr_id` (`goods_attr_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_area_attr'), 'area_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_area_attr') . ' ADD INDEX `area_id` (`area_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_attr'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_attr') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_attr'), 'goods_attr_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_attr') . ' ADD INDEX `goods_attr_id` (`goods_attr_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_attr'), 'warehouse_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_attr') . ' ADD INDEX `warehouse_id` (`warehouse_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_freight'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_freight') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_freight'), 'warehouse_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_freight') . ' ADD INDEX `warehouse_id` (`warehouse_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_freight'), 'shipping_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_freight') . ' ADD INDEX `shipping_id` (`shipping_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_freight'), 'region_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_freight') . ' ADD INDEX `region_id` (`region_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_freight_tpl'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_freight_tpl') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_freight_tpl'), 'warehouse_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_freight_tpl') . ' ADD INDEX `warehouse_id` (`warehouse_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_freight_tpl'), 'shipping_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_freight_tpl') . ' ADD INDEX `shipping_id` (`shipping_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('warehouse_freight_tpl'), 'region_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('warehouse_freight_tpl') . ' ADD INDEX `region_id` (`region_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('virtual_card'), 'add_date');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('virtual_card') . ' ADD INDEX `add_date` (`add_date`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('virtual_card'), 'end_date');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('virtual_card') . ' ADD INDEX `end_date` (`end_date`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('virtual_card'), 'order_sn');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('virtual_card') . ' ADD INDEX `order_sn` (`order_sn`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('value_card_type'), 'use_condition');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('value_card_type') . ' ADD INDEX `use_condition` (`use_condition`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('value_card_type'), 'is_rec');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('value_card_type') . ' ADD INDEX `is_rec` (`is_rec`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('value_card_type'), 'vc_indate');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('value_card_type') . ' ADD INDEX `vc_indate` (`vc_indate`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('value_card_record'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('value_card_record') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('value_card'), 'tid');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('value_card') . ' ADD INDEX `tid` (`tid`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('value_card'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('value_card') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_gift_gard'), 'gift_sn');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_gift_gard') . ' ADD INDEX `gift_sn` (`gift_sn`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_gift_gard'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_gift_gard') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_gift_gard'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_gift_gard') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_gift_gard'), 'gift_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_gift_gard') . ' ADD INDEX `gift_id` (`gift_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_gift_gard'), 'is_delete');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_gift_gard') . ' ADD INDEX `is_delete` (`is_delete`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_feed'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_feed') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_feed'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_feed') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_bonus'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_bonus') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_bonus'), 'emailed');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_bonus') . ' ADD INDEX `emailed` (`emailed`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_bank'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_bank') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_account_fields'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_account_fields') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_account_fields'), 'account_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_account_fields') . ' ADD INDEX `account_id` (`account_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_account'), 'payment_id');

		if ($field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_account') . ' DROP INDEX `payment_id` (`payment_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('user_account'), 'pay_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('user_account') . ' ADD INDEX `pay_id` (`pay_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users_vat_invoices_info'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_vat_invoices_info') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users_vat_invoices_info'), 'audit_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_vat_invoices_info') . ' ADD INDEX `audit_status` (`audit_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users_paypwd'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_paypwd') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users_log'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_log') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users_log'), 'admin_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_log') . ' ADD INDEX `admin_id` (`admin_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users_auth'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_auth') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users_auth'), 'user_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users_auth') . ' ADD INDEX `user_name` (`user_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users'), 'is_validated');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users') . ' ADD INDEX `is_validated` (`is_validated`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('trade_snapshot'), 'order_sn');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('trade_snapshot') . ' ADD INDEX `order_sn` (`order_sn`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('trade_snapshot'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('trade_snapshot') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('trade_snapshot'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('trade_snapshot') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('trade_snapshot'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('trade_snapshot') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('suppliers'), 'is_check');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('suppliers') . ' ADD INDEX `is_check` (`is_check`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_user'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_user') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_user'), 'store_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_user') . ' ADD INDEX `store_id` (`store_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_user'), 'parent_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_user') . ' ADD INDEX `parent_id` (`parent_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_user'), 'ec_salt');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_user') . ' ADD INDEX `ec_salt` (`ec_salt`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_products'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_products') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_products'), 'store_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_products') . ' ADD INDEX `store_id` (`store_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_order'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_order') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_order'), 'store_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_order') . ' ADD INDEX `store_id` (`store_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_order'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_order') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_goods'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_goods') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_goods'), 'store_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_goods') . ' ADD INDEX `store_id` (`store_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_goods'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_goods') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('store_action'), 'parent_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('store_action') . ' ADD INDEX `parent_id` (`parent_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('snatch_log'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('snatch_log') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('single'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('single') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('single'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('single') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('single'), 'comment_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('single') . ' ADD INDEX `comment_id` (`comment_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('single'), 'cat_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('single') . ' ADD INDEX `cat_id` (`cat_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('shipping_tpl'), 'shipping_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping_tpl') . ' ADD INDEX `shipping_id` (`shipping_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('shipping_tpl'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping_tpl') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('shipping_point'), 'shipping_area_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('shipping_point') . ' ADD INDEX `shipping_area_id` (`shipping_area_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_template_apply'), 'apply_sn');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_template_apply') . ' ADD INDEX `apply_sn` (`apply_sn`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_template_apply'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_template_apply') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_template_apply'), 'temp_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_template_apply') . ' ADD INDEX `temp_id` (`temp_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_template_apply'), 'pay_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_template_apply') . ' ADD INDEX `pay_id` (`pay_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_shopinfo'), 'shipping_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_shopinfo') . ' ADD INDEX `shipping_id` (`shipping_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_qrcode'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_qrcode') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_domain'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_domain') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_commission_bill'), 'bill_sn');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_commission_bill') . ' ADD INDEX `bill_sn` (`bill_sn`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_commission_bill'), 'chargeoff_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_commission_bill') . ' ADD INDEX `chargeoff_time` (`chargeoff_time`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_commission_bill'), 'start_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_commission_bill') . ' ADD INDEX `start_time` (`start_time`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_commission_bill'), 'end_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_commission_bill') . ' ADD INDEX `end_time` (`end_time`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_commission_bill'), 'chargeoff_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_commission_bill') . ' ADD INDEX `chargeoff_status` (`chargeoff_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_commission_bill'), 'bill_apply');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_commission_bill') . ' ADD INDEX `bill_apply` (`bill_apply`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_bill_order'), 'order_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_bill_order') . ' ADD INDEX `order_status` (`order_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_bill_order'), 'shipping_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_bill_order') . ' ADD INDEX `shipping_status` (`shipping_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_bill_order'), 'chargeoff_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_bill_order') . ' ADD INDEX `chargeoff_status` (`chargeoff_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_bill_order'), 'confirm_take_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_bill_order') . ' ADD INDEX `confirm_take_time` (`confirm_take_time`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_bill_order'), 'order_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_bill_order') . ' ADD INDEX `order_status` (`order_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_apply_info'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_apply_info') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_apply_info'), 'grade_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_apply_info') . ' ADD INDEX `grade_id` (`grade_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_apply_info'), 'apply_sn');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_apply_info') . ' ADD INDEX `apply_sn` (`apply_sn`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_apply_info'), 'pay_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_apply_info') . ' ADD INDEX `pay_status` (`pay_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_apply_info'), 'apply_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_apply_info') . ' ADD INDEX `apply_status` (`apply_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_apply_info'), 'pay_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_apply_info') . ' ADD INDEX `pay_id` (`pay_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seller_apply_info'), 'is_paid');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_apply_info') . ' ADD INDEX `is_paid` (`is_paid`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seckill_goods_remind'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seckill_goods_remind') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seckill_goods_remind'), 'sec_goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seckill_goods_remind') . ' ADD INDEX `sec_goods_id` (`sec_goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seckill_goods'), 'sec_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seckill_goods') . ' ADD INDEX `sec_id` (`sec_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seckill_goods'), 'tb_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seckill_goods') . ' ADD INDEX `tb_id` (`tb_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seckill_goods'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seckill_goods') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seckill'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seckill') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('seckill'), 'review_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seckill') . ' ADD INDEX `review_status` (`review_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('rs_region'), 'rs_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('rs_region') . ' ADD INDEX `rs_id` (`rs_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('rs_region'), 'region_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('rs_region') . ' ADD INDEX `region_id` (`region_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('return_goods'), 'product_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('return_goods') . ' ADD INDEX `product_id` (`product_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('return_action'), 'order_id');

		if ($field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('return_action') . ' DROP INDEX `order_id`;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('return_action'), 'ret_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('return_action') . ' ADD INDEX `ret_id` (`ret_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('reg_extend_info'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('reg_extend_info') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('products_warehouse'), 'warehouse_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_warehouse') . ' ADD INDEX `warehouse_id` (`warehouse_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('products_area'), 'area_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_area') . ' ADD INDEX `area_id` (`area_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('products_changelog'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_changelog') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('products_changelog'), 'warehouse_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_changelog') . ' ADD INDEX `warehouse_id` (`warehouse_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('products_changelog'), 'area_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_changelog') . ' ADD INDEX `area_id` (`area_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('products_changelog'), 'admin_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('products_changelog') . ' ADD INDEX `admin_id` (`admin_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('presale_cat'), 'cat_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('presale_cat') . ' ADD INDEX `cat_name` (`cat_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('presale_activity'), 'start_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('presale_activity') . ' ADD INDEX `start_time` (`start_time`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('presale_activity'), 'end_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('presale_activity') . ' ADD INDEX `end_time` (`end_time`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('pic_album'), 'album_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('pic_album') . ' ADD INDEX `album_id` (`album_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('pic_album'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('pic_album') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('pay_log'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('pay_log') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('pay_log'), 'is_paid');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('pay_log') . ' ADD INDEX `is_paid` (`is_paid`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart_combo'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart_combo'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart_combo'), 'product_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD INDEX `product_id` (`product_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart_combo'), 'group_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD INDEX `group_id` (`group_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart_combo'), 'is_real');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD INDEX `is_real` (`is_real`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart_combo'), 'extension_code');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD INDEX `extension_code` (`extension_code`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart_combo'), 'parent_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD INDEX `parent_id` (`parent_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart_combo'), 'is_gift');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD INDEX `is_gift` (`is_gift`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart_combo'), 'warehouse_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD INDEX `warehouse_id` (`warehouse_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart_combo'), 'area_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD INDEX `area_id` (`area_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart_combo'), 'model_attr');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' ADD INDEX `model_attr` (`model_attr`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' CHANGE `goods_number` `goods_number` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'is_gift');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `is_gift` (`is_gift`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('cart'), 'rec_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' ADD INDEX `rec_type` (`rec_type`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('pay_card'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('pay_card') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('payment'), 'is_online');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('payment') . ' ADD INDEX `is_online` (`is_online`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('oss_configure'), 'is_use');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('oss_configure') . ' ADD INDEX `is_use` (`is_use`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_return_extend'), 'ret_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_return_extend') . ' ADD INDEX `ret_id` (`ret_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_return'), 'return_sn');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_return') . ' ADD INDEX `return_sn` (`return_sn`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_invoice'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_invoice') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_invoice'), 'tax_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_invoice') . ' ADD INDEX `tax_id` (`tax_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_info'), 'parent_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD INDEX `parent_id` (`parent_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_info'), 'supplier_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD INDEX `supplier_id` (`supplier_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_info'), 'is_zc_order');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD INDEX `is_zc_order` (`is_zc_order`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_info'), 'zc_goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD INDEX `zc_goods_id` (`zc_goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_info'), 'chargeoff_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_info') . ' ADD INDEX `chargeoff_status` (`chargeoff_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_goods'), 'product_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' ADD INDEX `product_id` (`product_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_goods'), 'is_real');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' ADD INDEX `is_real` (`is_real`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_goods'), 'warehouse_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' ADD INDEX `warehouse_id` (`warehouse_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_goods'), 'area_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' ADD INDEX `area_id` (`area_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_goods'), 'is_gift');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' ADD INDEX `is_gift` (`is_gift`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_goods') . ' CHANGE `goods_attr_id` `goods_attr_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('order_action'), 'action_user');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_action') . ' ADD INDEX `action_user` (`action_user`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_action'), 'order_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_action') . ' ADD INDEX `order_status` (`order_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_action'), 'shipping_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_action') . ' ADD INDEX `shipping_status` (`shipping_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('order_action'), 'pay_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('order_action') . ' ADD INDEX `pay_status` (`pay_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('open_api'), 'is_open');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('open_api') . ' ADD INDEX `is_open` (`is_open`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('offline_store'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('offline_store') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('offline_store'), 'stores_user');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('offline_store') . ' ADD INDEX `stores_user` (`stores_user`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('offline_store'), 'ec_salt');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('offline_store') . ' ADD INDEX `ec_salt` (`ec_salt`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('offline_store'), 'is_confirm');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('offline_store') . ' ADD INDEX `is_confirm` (`is_confirm`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('notice_log'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('notice_log') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('nav') . ' CHANGE `cid` `cid` INT(10) UNSIGNED NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('nav'), 'cid');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('nav') . ' ADD INDEX `cid` (`cid`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('nav'), 'vieworder');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('nav') . ' ADD INDEX `vieworder` (`vieworder`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('nav'), 'opennew');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('nav') . ' ADD INDEX `opennew` (`opennew`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('merchants_shop_information'), 'self_run');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' ADD INDEX `self_run` (`self_run`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('merchants_server'), 'cycle');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_server') . ' ADD INDEX `cycle` (`cycle`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('merchants_server'), 'bill_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_server') . ' ADD INDEX `bill_time` (`bill_time`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('merchants_privilege'), 'grade_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_privilege') . ' ADD INDEX `grade_id` (`grade_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('merchants_category_temporarydate'), 'cat_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_category_temporarydate') . ' ADD INDEX `cat_name` (`cat_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('merchants_category'), 'cat_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_category') . ' ADD INDEX `cat_name` (`cat_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('merchants_category'), 'show_in_nav');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_category') . ' ADD INDEX `show_in_nav` (`show_in_nav`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('merchants_account_log'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_account_log') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('merchants_account_log'), 'change_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_account_log') . ' ADD INDEX `change_type` (`change_type`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('mass_sms_template'), 'temp_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('mass_sms_template') . ' ADD INDEX `temp_id` (`temp_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('link_desc_goodsid'), 'd_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('link_desc_goodsid') . ' ADD INDEX `d_id` (`d_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('home_templates'), 'rs_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('home_templates') . ' ADD INDEX `rs_id` (`rs_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('home_templates'), 'code');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('home_templates') . ' ADD INDEX `code` (`code`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('home_templates'), 'is_enable');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('home_templates') . ' ADD INDEX `is_enable` (`is_enable`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('home_templates'), 'theme');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('home_templates') . ' ADD INDEX `theme` (`theme`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_type_cat'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_type_cat') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_type_cat'), 'parent_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_type_cat') . ' ADD INDEX `parent_id` (`parent_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_type_cat'), 'cat_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_type_cat') . ' ADD INDEX `cat_name` (`cat_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_type'), 'cat_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_type') . ' ADD INDEX `cat_name` (`cat_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_type'), 'enabled');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_type') . ' ADD INDEX `enabled` (`enabled`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_type'), 'c_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_type') . ' ADD INDEX `c_id` (`c_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_transport_tpl'), 'tid');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport_tpl') . ' ADD INDEX `tid` (`tid`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_transport_tpl'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport_tpl') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_transport_tpl'), 'shipping_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_transport_tpl') . ' ADD INDEX `shipping_id` (`shipping_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_inventory_logs'), 'model_inventory');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_inventory_logs') . ' ADD INDEX `model_inventory` (`model_inventory`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_inventory_logs'), 'product_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_inventory_logs') . ' ADD INDEX `product_id` (`product_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_inventory_logs'), 'warehouse_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_inventory_logs') . ' ADD INDEX `warehouse_id` (`warehouse_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_inventory_logs'), 'area_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_inventory_logs') . ' ADD INDEX `area_id` (`area_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_extend'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_extend') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_extend'), 'is_reality');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_extend') . ' ADD INDEX `is_reality` (`is_reality`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_extend'), 'is_return');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_extend') . ' ADD INDEX `is_return` (`is_return`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_extend'), 'is_fast');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_extend') . ' ADD INDEX `is_fast` (`is_fast`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_change_log'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_change_log') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_activity'), 'product_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_activity') . ' ADD INDEX `product_id` (`product_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_activity'), 'is_new');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_activity') . ' ADD INDEX `is_new` (`is_new`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('goods_activity'), 'goods_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods_activity') . ' ADD INDEX `goods_name` (`goods_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('gift_gard_type'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('gift_gard_type') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'region_store\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, \'0\', \'region_store\', \'\', \'0\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'region_store_manage\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'region_store\'';
			$action_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, \'' . $action_id . '\', \'region_store_manage\', \'\', \'0\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'region_store_enabled\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
			$config_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`, `shop_group`) VALUES (NULL, \'' . $config_id . '\', \'region_store_enabled\', \'hidden\', \'0,1\', \'\', \'0\', \'1\', \'\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'update_home_temp\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE code = \'extend_basic\'';
			$config_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('shop_config') . ' (`id`,  `parent_id` ,  `code` ,  `type` ,  `value` ,  `shop_group` ) VALUES (NULL, \'' . $config_id . '\',  \'update_home_temp\',  \'hidden\', 1,  \'\' );';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'message_manage\'';

		if (!$GLOBALS['db']->getOne($sql, true)) {
			$sql = 'SELECT action_id FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'priv_manage\'';
			$action_id = $GLOBALS['db']->getOne($sql, true);
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('admin_action') . ' (`parent_id`, `action_code`, `seller_show`) VALUES (\'' . $action_id . '\', \'message_manage\', \'1\');';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('shop_config') . ' SET `store_range`=\'2,1,0\' WHERE `code`=\'stock_dec_time\';';
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
