<?php
/*运营推荐在线升级版联系QQ97908527*/
class up_v2_4_4
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

	public function up_v2_4_4()
	{
	}

	public function update_database_optionally()
	{
		global $db;
		global $ecs;
		include_once ROOT_PATH . 'includes/inc_constant.php';
		$field = get_table_file_name($GLOBALS['ecs']->table('goods'), 'goods_video');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('goods') . ' ADD `goods_video` varchar( 255 ) NOT NULL DEFAULT \'\';';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('gift_gard_log'), 'gift_gard_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('gift_gard_log') . ' ADD INDEX `gift_gard_id` (`gift_gard_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('gift_gard_log'), 'admin_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('gift_gard_log') . ' ADD INDEX `admin_id` (`admin_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('gallery_album'), 'parent_album_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('gallery_album') . ' ADD INDEX `parent_album_id` (`parent_album_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('gallery_album'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('gallery_album') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('friend_link'), 'link_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('friend_link') . ' ADD INDEX `link_name` (`link_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('floor_content'), 'brand_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('floor_content') . ' ADD INDEX `brand_id` (`brand_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('floor_content'), 'theme');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('floor_content') . ' ADD INDEX `theme` (`theme`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('floor_content'), 'id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('floor_content') . ' ADD INDEX `id` (`id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('feedback'), 'parent_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('feedback') . ' ADD INDEX `parent_id` (`parent_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('feedback'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('feedback') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('feedback'), 'msg_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('feedback') . ' ADD INDEX `msg_type` (`msg_type`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('feedback'), 'msg_status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('feedback') . ' ADD INDEX `msg_status` (`msg_status`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('feedback'), 'msg_area');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('feedback') . ' ADD INDEX `msg_area` (`msg_area`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('favourable_activity'), 'start_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('favourable_activity') . ' ADD INDEX `start_time` (`start_time`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('favourable_activity'), 'end_time');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('favourable_activity') . ' ADD INDEX `end_time` (`end_time`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('favourable_activity'), 'act_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('favourable_activity') . ' ADD INDEX `act_type` (`act_type`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('favourable_activity'), 'rs_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('favourable_activity') . ' ADD INDEX `rs_id` (`rs_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('favourable_activity'), 'userFav_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('favourable_activity') . ' ADD INDEX `userFav_type` (`userFav_type`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('exchange_goods'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('exchange_goods') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('exchange_goods'), 'is_exchange');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('exchange_goods') . ' ADD INDEX `is_exchange` (`is_exchange`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('exchange_goods') . ' CHANGE `eid` `eid` INT(10) NOT NULL AUTO_INCREMENT FIRST;';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('entry_criteria'), 'parent_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('entry_criteria') . ' ADD INDEX `parent_id` (`parent_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('email_sendlist'), 'template_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('email_sendlist') . ' ADD INDEX `template_id` (`template_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('discuss_circle'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('discuss_circle') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('discuss_circle'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('discuss_circle') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('discuss_circle'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('discuss_circle') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('discuss_circle'), 'dis_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('discuss_circle') . ' ADD INDEX `dis_type` (`dis_type`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_order'), 'delivery_sn');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_order') . ' ADD INDEX `delivery_sn` (`delivery_sn`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_order'), 'order_sn');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_order') . ' ADD INDEX `order_sn` (`order_sn`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_order'), 'shipping_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_order') . ' ADD INDEX `shipping_id` (`shipping_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_order'), 'suppliers_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_order') . ' ADD INDEX `suppliers_id` (`suppliers_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_order'), 'agency_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_order') . ' ADD INDEX `agency_id` (`agency_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_order'), 'status');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_order') . ' ADD INDEX `status` (`status`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_goods') . ' CHANGE `send_number` `send_number` INT(10) UNSIGNED NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_goods'), 'product_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_goods') . ' ADD INDEX `product_id` (`product_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_goods'), 'is_real');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_goods') . ' ADD INDEX `is_real` (`is_real`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('delivery_goods'), 'parent_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('delivery_goods') . ' ADD INDEX `parent_id` (`parent_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('coupons_region'), 'cou_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('coupons_region') . ' ADD INDEX `cou_id` (`cou_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('coupons_user'), 'user_id');

		if ($field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('coupons_user') . ' DROP INDEX `user_id`, ADD INDEX `user_id` (`user_id`) USING BTREE;';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('coupons_user'), 'cou_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('coupons_user') . ' ADD INDEX `cou_id` (`cou_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('coupons_user'), 'is_use');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('coupons_user') . ' ADD INDEX `is_use` (`is_use`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('coupons_user'), 'cou_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('coupons_user') . ' ADD INDEX `cou_id` (`cou_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('coupons_user'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('coupons_user') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('coupons'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('coupons') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('connect_user'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('connect_user') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('complain_title'), 'is_show');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complain_title') . ' ADD INDEX `is_show` (`is_show`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('complaint_talk'), 'complaint_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complaint_talk') . ' ADD INDEX `complaint_id` (`complaint_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('complaint_talk'), 'talk_member_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complaint_talk') . ' ADD INDEX `talk_member_id` (`talk_member_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('complaint_img'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complaint_img') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('complaint_img'), 'complaint_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complaint_img') . ' ADD INDEX `complaint_id` (`complaint_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('complaint_img'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complaint_img') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('comment'), 'comment_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment') . ' ADD INDEX `comment_type` (`comment_type`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('comment'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('comment'), 'single_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment') . ' ADD INDEX `single_id` (`single_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('comment'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('comment'), 'rec_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment') . ' ADD INDEX `rec_id` (`rec_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('collect_brand'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('collect_brand') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('category'), 'cat_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('category') . ' ADD INDEX `cat_name` (`cat_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('category'), 'show_in_nav');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('category') . ' ADD INDEX `show_in_nav` (`show_in_nav`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('category'), 'grade');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('category') . ' ADD INDEX `grade` (`grade`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('category'), 'is_top_style');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('category') . ' ADD INDEX `is_top_style` (`is_top_style`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('category'), 'top_style_tpl');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('category') . ' ADD INDEX `top_style_tpl` (`top_style_tpl`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('category'), 'is_top_show');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('category') . ' ADD INDEX `is_top_show` (`is_top_show`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart') . ' CHANGE `goods_attr_id` `goods_attr_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('cart_combo') . ' CHANGE `goods_attr_id` `goods_attr_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('card'), 'card_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('card') . ' ADD INDEX `card_name` (`card_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('brand_extend'), 'brand_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('brand_extend') . ' ADD INDEX `brand_id` (`brand_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('brand_extend'), 'is_recommend');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('brand_extend') . ' ADD INDEX `is_recommend` (`is_recommend`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('booking_goods'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('booking_goods') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('auction_log'), 'bid_user');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('auction_log') . ' ADD INDEX `bid_user` (`bid_user`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('attribute_img'), 'attr_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('attribute_img') . ' ADD INDEX `attr_id` (`attr_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('attribute'), 'attr_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('attribute') . ' ADD INDEX `attr_name` (`attr_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('attribute'), 'attr_cat_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('attribute') . ' ADD INDEX `attr_cat_type` (`attr_cat_type`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('attribute'), 'attr_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('attribute') . ' ADD INDEX `attr_type` (`attr_type`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('attribute'), 'attr_group');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('attribute') . ' ADD INDEX `attr_group` (`attr_group`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('attribute'), 'sort_order');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('attribute') . ' ADD INDEX `sort_order` (`sort_order`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('article_extend'), 'article_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('article_extend') . ' ADD INDEX `article_id` (`article_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('users'), 'address_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('users') . ' ADD INDEX `address_id` (`address_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('article_cat'), 'cat_name');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('article_cat') . ' ADD INDEX `cat_name` (`cat_name`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('article'), 'is_open');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('article') . ' ADD INDEX `is_open` (`is_open`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('article'), 'open_type');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('article') . ' ADD INDEX `open_type` (`open_type`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('appeal_img'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('appeal_img') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('appeal_img'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('appeal_img') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('appeal_img'), 'complaint_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('appeal_img') . ' ADD INDEX `complaint_id` (`complaint_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('alitongxin_configure'), 'temp_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('alitongxin_configure') . ' ADD INDEX `temp_id` (`temp_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('alidayu_configure'), 'temp_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('alidayu_configure') . ' ADD INDEX `temp_id` (`temp_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('admin_user'), 'rs_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('admin_user') . ' ADD INDEX `rs_id` (`rs_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('admin_user'), 'role_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('admin_user') . ' ADD INDEX `role_id` (`role_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('admin_user'), 'ec_salt');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('admin_user') . ' ADD INDEX `ec_salt` (`ec_salt`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('admin_user'), 'parent_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('admin_user') . ' ADD INDEX `parent_id` (`parent_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('account_log'), 'rank_points');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('account_log') . ' ADD INDEX `rank_points` (`rank_points`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('account_log'), 'pay_points');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('account_log') . ' ADD INDEX `pay_points` (`pay_points`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('account_log'), 'pay_points');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('account_log') . ' ADD INDEX `pay_points` (`pay_points`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('account_log'), 'pay_points');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('account_log') . ' ADD INDEX `pay_points` (`pay_points`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('account_log') . ' CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('account_log') . ' CHANGE `user_money` `user_money` DECIMAL(10,2) NOT NULL DEFAULT \'0.00\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('account_log') . ' CHANGE `frozen_money` `frozen_money` DECIMAL(10,2) NOT NULL DEFAULT \'0.00\';';
		$GLOBALS['db']->query($sql);
		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('account_log') . ' CHANGE `rank_points` `rank_points` INT(10) NOT NULL DEFAULT \'0\', 
		CHANGE `pay_points` `pay_points` INT(10) NOT NULL DEFAULT \'0\', 
		CHANGE `change_time` `change_time` INT(10) UNSIGNED NOT NULL DEFAULT \'0\', 
		CHANGE `change_type` `change_type` TINYINT(3) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('merchants_category'), 'sort_order');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_category') . ' ADD INDEX `sort_order` (`sort_order`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $GLOBALS['ecs']->table('intelligent_weight') . ' (
		  `id` int(10) NOT NULL AUTO_INCREMENT,
		  `goods_id` int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'商品ID\',
		  `goods_number` int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'商品购买数量\',
		  `return_number` int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'商品退换货数量\',
		  `user_number` int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'购买此商品的会员数量\',
		  `goods_comment_number` int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'对商品评价数量\',
		  `merchants_comment_number` int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'对商家评价数量\',
		  `user_attention_number` int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'会员关注此商品数量\',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		$GLOBALS['db']->query($sql);
		$field = get_table_file_name($GLOBALS['ecs']->table('seller_account_log'), 'percent_value');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('seller_account_log') . ' ADD `percent_value` VARCHAR(20) NOT NULL;';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_server') . ' CHANGE `suppliers_percent` `suppliers_percent` INT(10) UNSIGNED NOT NULL DEFAULT \'0\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('merchants_server'), 'suppliers_percent');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_server') . ' ADD INDEX `suppliers_percent` (`suppliers_percent`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' CHANGE `store_score` `store_score` INT(10) NOT NULL DEFAULT \'5\';';
		$GLOBALS['db']->query($sql);
		$field = get_table_column_name($GLOBALS['ecs']->table('comment_seller'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment_seller') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('comment_seller'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment_seller') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('comment_seller'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment_seller') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('complain_title'), 'is_show');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complain_title') . ' ADD INDEX `is_show` (`is_show`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('complaint'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complaint') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('complaint'), 'order_sn');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complaint') . ' ADD INDEX `order_sn` (`order_sn`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('complaint'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complaint') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('complaint'), 'ru_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complaint') . ' ADD INDEX `ru_id` (`ru_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('complaint'), 'title_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('complaint') . ' ADD INDEX `title_id` (`title_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('comment_img'), 'user_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment_img') . ' ADD INDEX `user_id` (`user_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('comment_img'), 'order_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment_img') . ' ADD INDEX `order_id` (`order_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('comment_img'), 'rec_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment_img') . ' ADD INDEX `rec_id` (`rec_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('comment_img'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment_img') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('comment_img'), 'comment_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('comment_img') . ' ADD INDEX `comment_id` (`comment_id`);';
			$GLOBALS['db']->query($sql);
		}

		$field = get_table_column_name($GLOBALS['ecs']->table('intelligent_weight'), 'goods_id');

		if (!$field['bool']) {
			$sql = 'ALTER TABLE ' . $GLOBALS['ecs']->table('intelligent_weight') . ' ADD INDEX `goods_id` (`goods_id`);';
			$GLOBALS['db']->query($sql);
		}

		$sql = 'DELETE FROM ' . $GLOBALS['ecs']->table('admin_action') . ' WHERE action_code = \'message_manage\';';
		$GLOBALS['db']->query($sql);
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('admin_action') . ' SET `seller_show` = \'1\' WHERE `action_code` = \'admin_message\';';
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
