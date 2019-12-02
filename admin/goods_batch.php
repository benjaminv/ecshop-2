<?php
/*运营推荐在线升级版联系QQ97908527*/
define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
require 'includes/lib_goods.php';
require_once ROOT_PATH . '/' . ADMIN_PATH . '/includes/lib_goods.php';
$adminru = get_admin_ru_id();

if ($_REQUEST['act'] == 'add') {
	admin_priv('goods_batch');
	$smarty->assign('menu_select', array('action' => '02_cat_and_goods', 'current' => '13_batch_add'));
	$dir = opendir('../languages');
	$lang_list = array('UTF8' => $_LANG['charset']['utf8'], 'GB2312' => $_LANG['charset']['zh_cn'], 'BIG5' => $_LANG['charset']['zh_tw']);
	$download_list = array();

	while (@$file = readdir($dir)) {
		if ($file != '.' && $file != '..' && $file != '.svn' && $file != '_svn' && is_dir('../languages/' . $file) == true) {
			$download_list[$file] = sprintf($_LANG['download_file'], isset($_LANG['charset'][$file]) ? $_LANG['charset'][$file] : $file);
		}
	}

	@closedir($dir);
	$data_format_array = array('ecshop' => $_LANG['export_ecshop'], 'taobao' => $_LANG['export_taobao']);
	$smarty->assign('data_format', $data_format_array);
	$smarty->assign('lang_list', $lang_list);
	$smarty->assign('download_list', $download_list);
	set_default_filter($goods_id);
	$ur_here = $_LANG['13_batch_add'];
	$smarty->assign('ur_here', $ur_here);
	assign_query_info();
	$smarty->display('goods_batch_add.dwt');
}
else if ($_REQUEST['act'] == 'upload') {
	admin_priv('goods_batch');
	$smarty->assign('menu_select', array('action' => '02_cat_and_goods', 'current' => '13_batch_add'));
	$guid = gmtime() . rand(1, 10000);
	$smarty->assign('guid', $guid);
	$max_id = $db->getOne('SELECT MAX(goods_id) FROM ' . $ecs->table('goods'));
	$generate_goods_sn = generate_goods_sn($max_id);
	$sn_prefix = $GLOBALS['_CFG']['sn_prefix'];

	if ($sn_prefix) {
		$generate_goods_sn = str_replace($sn_prefix, '', $generate_goods_sn);
	}

	$generate_goods_sn = intval($generate_goods_sn);
	$line_number = 0;
	$arr = array();
	$goods_list = array();
	$field_list = array_keys($_LANG['upload_goods']);
	$data = file($_FILES['file']['tmp_name']);

	if ($_POST['data_cat'] == 'ecshop') {
		foreach ($data as $key => $line) {
			if ($line_number == 0) {
				$line_number++;
				continue;
			}

			if ($_POST['charset'] != 'UTF8' && strpos(strtolower(EC_CHARSET), 'utf') === 0) {
				$line = ecs_iconv($_POST['charset'], 'UTF8', $line);
			}

			$arr = array();
			$buff = '';
			$quote = 0;
			$len = strlen($line);

			for ($i = 0; $i < $len; $i++) {
				$char = $line[$i];

				if ('\\' == $char) {
					$i++;
					$char = $line[$i];

					switch ($char) {
					case '"':
						$buff .= '"';
						break;

					case '\'':
						$buff .= '\'';
						break;

					case ',':
						$buff .= ',';
						break;

					default:
						$buff .= '\\' . $char;
						break;
					}
				}
				else if ('"' == $char) {
					if (0 == $quote) {
						$quote++;
					}
					else {
						$quote = 0;
					}
				}
				else if (',' == $char) {
					if (0 == $quote) {
						if (!isset($field_list[count($arr)])) {
							continue;
						}

						$field_name = $field_list[count($arr)];
						$arr[$field_name] = trim($buff);
						$buff = '';
						$quote = 0;
					}
					else {
						$buff .= $char;
					}
				}
				else {
					$buff .= $char;
				}

				if ($i == $len - 1) {
					if (!isset($field_list[count($arr)])) {
						continue;
					}

					$field_name = $field_list[count($arr)];
					$arr[$field_name] = trim($buff);
				}
			}

			$goods_list[] = $arr;
		}
	}
	else if ($_POST['data_cat'] == 'taobao') {
		foreach ($data as $key => $line) {
			if ($line_number == 0) {
				$line_number++;
				continue;
			}

			$arr = array();
			$line_list = explode('	', $line);
			$arr['goods_name'] = trim($line_list[0], '"');
			$goods_sn = $generate_goods_sn + $key;
			$arr['goods_sn'] = $goods_sn;
			$arr['brand_name'] = '';
			$arr['market_price'] = $line_list[7];
			$arr['shop_price'] = $line_list[7];
			$arr['integral'] = 0;
			$arr['original_img'] = $line_list[25];
			$arr['keywords'] = '';
			$arr['goods_brief'] = '';
			$arr['goods_desc'] = strip_tags($line_list[24]);
			$arr['goods_desc'] = substr($arr['goods_desc'], 1, -1);
			$arr['goods_number'] = $line_list[10];
			$arr['warn_number'] = 1;
			$arr['is_best'] = 0;
			$arr['is_new'] = 0;
			$arr['is_hot'] = 0;
			$arr['is_on_sale'] = 1;
			$arr['is_alone_sale'] = 0;
			$arr['is_real'] = 1;
			$arr['user_id'] = $adminru['ru_id'];
			$goods_list[] = $arr;
		}
	}
	else if ($_POST['data_cat'] == 'paipai') {
		$id_is = 0;

		foreach ($data as $key => $line) {
			if ($line_number == 0) {
				$line_number++;
				continue;
			}

			$arr = array();
			$line_list = explode(',', $line);
			$arr['goods_name'] = trim($line_list[3], '"');
			$goods_sn = $generate_goods_sn + $key;
			$arr['goods_sn'] = $goods_sn;
			$arr['brand_name'] = '';
			$arr['market_price'] = $line_list[13];
			$arr['shop_price'] = $line_list[13];
			$arr['integral'] = 0;
			$arr['original_img'] = $line_list[28];
			$arr['keywords'] = '';
			$arr['goods_brief'] = '';
			$arr['goods_desc'] = strip_tags($line_list[30]);
			$arr['goods_number'] = 100;
			$arr['warn_number'] = 1;
			$arr['is_best'] = 0;
			$arr['is_new'] = 0;
			$arr['is_hot'] = 0;
			$arr['is_on_sale'] = 1;
			$arr['is_alone_sale'] = 0;
			$arr['is_real'] = 1;
			$arr['user_id'] = $adminru['ru_id'];
			$goods_list[] = $arr;
		}
	}
	else if ($_POST['data_cat'] == 'paipai3') {
		foreach ($data as $key => $line) {
			if ($line_number == 0) {
				$line_number++;
				continue;
			}

			$arr = array();
			$line_list = explode(',', $line);
			$arr['goods_name'] = trim($line_list[1], '"');
			$goods_sn = $generate_goods_sn + $key;
			$arr['goods_sn'] = $goods_sn;
			$arr['brand_name'] = '';
			$arr['market_price'] = $line_list[9];
			$arr['shop_price'] = $line_list[9];
			$arr['integral'] = 0;
			$arr['original_img'] = $line_list[23];
			$arr['keywords'] = '';
			$arr['goods_brief'] = '';
			$arr['goods_desc'] = strip_tags($line_list[24]);
			$arr['goods_number'] = $line_list[5];
			$arr['warn_number'] = 1;
			$arr['is_best'] = 0;
			$arr['is_new'] = 0;
			$arr['is_hot'] = 0;
			$arr['is_on_sale'] = 1;
			$arr['is_alone_sale'] = 0;
			$arr['is_real'] = 1;
			$arr['user_id'] = $adminru['ru_id'];
			$goods_list[] = $arr;
		}
	}
	else if ($_POST['data_cat'] == 'taobao46') {
		foreach ($data as $key => $line) {
			if ($line_number == 0) {
				$line_number++;
				continue;
			}

			if ($_POST['charset'] == 'UTF8' && strpos(strtolower(EC_CHARSET), 'utf') == 0) {
				$line = ecs_iconv($_POST['charset'], 'GBK', $line);
			}

			$arr = array();
			$line_list = explode('	', $line);
			$arr['goods_name'] = trim($line_list[0], '"');
			$goods_sn = $generate_goods_sn + $key;
			$arr['goods_sn'] = $goods_sn;
			$arr['brand_name'] = '';
			$arr['market_price'] = $line_list[7];
			$arr['shop_price'] = $line_list[7];
			$arr['integral'] = 0;
			$arr['original_img'] = str_replace('"', '', $line_list[35]);
			$arr['keywords'] = '';
			$arr['goods_brief'] = '';
			$arr['goods_desc'] = strip_tags($line_list[24]);
			$arr['goods_desc'] = substr($arr['goods_desc'], 1, -1);
			$arr['goods_number'] = $line_list[10];
			$arr['warn_number'] = 1;
			$arr['is_best'] = 0;
			$arr['is_new'] = 0;
			$arr['is_hot'] = 0;
			$arr['is_on_sale'] = 1;
			$arr['is_alone_sale'] = 0;
			$arr['is_real'] = 1;
			$arr['user_id'] = $adminru['ru_id'];
			$goods_list[] = $arr;
		}
	}

	$_SESSION['goods_list'] = $goods_list;
	$smarty->assign('page', 1);
	$smarty->assign('title_list', $_LANG['upload_goods']);
	$smarty->assign('field_show', array('goods_name' => true, 'goods_sn' => true, 'brand_name' => true, 'market_price' => true, 'shop_price' => true));
	$smarty->assign('ur_here', $_LANG['goods_upload_confirm']);
	assign_query_info();
	$smarty->display('goods_batch_confirm.dwt');
}
else if ($_REQUEST['act'] == 'creat') {
	include_once ROOT_PATH . 'includes/cls_json.php';
	$json = new JSON();
	$result = array(
		'list'    => array(),
		'is_stop' => 0
	);
	$page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
	$page_size = isset($_REQUEST['page_size']) ? intval($_REQUEST['page_size']) : 1;
	if (isset($_SESSION['goods_list']) && $_SESSION['goods_list']) {
		$goods_list = $_SESSION['goods_list'];
		$goods_list = $ecs->page_array($page_size, $page, $goods_list);
		if (isset($result['list']['goods_brief']) && $result['list']['goods_brief']) {
			$result['list']['goods_brief'] = strip_tags($result['list']['goods_brief']);
			$result['list']['goods_brief'] = htmlspecialchars_decode($result['list']['goods_brief']);
			$result['list']['goods_brief'] = str_replace('"', '\'', $result['list']['goods_brief']);
		}

		if (isset($result['list']['goods_desc']) && $result['list']['goods_desc']) {
			$result['list']['goods_desc'] = strip_tags($result['list']['goods_desc']);
			$result['list']['goods_desc'] = htmlspecialchars_decode($result['list']['goods_desc']);
			$result['list']['goods_desc'] = str_replace('"', '\'', $result['list']['goods_desc']);
		}

		$result['list'] = $goods_list['list'][0];
		$result['page'] = $goods_list['filter']['page'] + 1;
		$result['page_size'] = $goods_list['filter']['page_size'];
		$result['record_count'] = $goods_list['filter']['record_count'];
		$result['page_count'] = $goods_list['filter']['page_count'];
		$result['is_stop'] = 1;

		if ($goods_list['filter']['page_count'] < $page) {
			$result['is_stop'] = 0;
		}
		else {
			$result['filter_page'] = $goods_list['filter']['page'] - 1;
		}
	}

	exit($json->encode($result));
}
else if ($_REQUEST['act'] == 'ajax_insert_data') {
	admin_priv('goods_batch');
	$guid = isset($_POST['guid']) && !empty($_POST['guid']) ? trim($_POST['guid']) : '';
	if (isset($_POST['checked']) && !empty($guid)) {
		$default_value = array('brand_id' => 0, 'goods_number' => 0, 'goods_weight' => 0, 'market_price' => 0, 'shop_price' => 0, 'warn_number' => 0, 'is_real' => 1, 'is_on_sale' => 1, 'is_alone_sale' => 1, 'integral' => 0, 'is_best' => 0, 'is_new' => 0, 'is_hot' => 0, 'goods_type' => 0);
		$field_list = array_keys($_LANG['upload_goods']);
		$field_list[] = 'goods_class';
		$goods_list = array();

		foreach ($_POST['checked'] as $key => $value) {
			$field_arr = array('cat_id' => $_POST['cat'], 'add_time' => gmtime(), 'last_update' => gmtime());

			foreach ($field_list as $field) {
				$field_value = isset($_POST[$field][$value]) ? $_POST[$field][$value] : '';

				if ($field == 'goods_class') {
					$field_value = intval($field_value);

					if ($field_value == G_CARD) {
						$field_arr['extension_code'] = 'virtual_card';
					}

					continue;
				}

				$field_arr[$field] = !isset($field_value) && isset($default_value[$field]) ? $default_value[$field] : $field_value;

				if (!empty($field_value)) {
					if (in_array($field, array('goods_number', 'warn_number', 'integral'))) {
						$field_arr[$field] = intval($field_value);
					}
					else if ($field == 'brand_name') {
						$sql = 'SELECT brand_id FROM ' . $GLOBALS['ecs']->table('brand') . ' WHERE brand_name = \'' . $field_arr[$field] . '\'';
						$brand_id = $GLOBALS['db']->getOne($sql);

						if ($brand_id) {
							$field_arr['brand_id'] = $brand_id;
						}
						else {
							$brand = array('brand_name' => addslashes($field_value));
							$db->autoExecute($ecs->table('brand'), $brand, 'INSERT');
							$brand_id = $db->insert_id();
							$field_arr['brand_id'] = $brand_id;
						}
					}
					else if (in_array($field, array('goods_weight', 'market_price', 'shop_price'))) {
						$field_arr[$field] = floatval($field_value);
					}
					else if (in_array($field, array('is_best', 'is_new', 'is_hot', 'is_on_sale', 'is_alone_sale', 'is_real'))) {
						$field_arr[$field] = 0 < intval($field_value) ? 1 : 0;
					}
				}

				if ($field == 'is_real') {
					$field_arr[$field] = intval($_POST['goods_class'][$key]);
				}
			}

			if (empty($field_arr['goods_sn'])) {
				$field_arr['goods_sn'] = generate_goods_sn($max_id);
			}

			if ($field_arr['is_real'] == 0) {
				$field_arr['goods_number'] = 0;
			}

			if ($field_arr && $field_arr['goods_name']) {
				if (isset($field_arr['goods_name']) && $field_arr['goods_name']) {
					$field_arr['goods_name'] = addslashes($field_arr['goods_name']);
				}

				if (isset($field_arr['goods_brief']) && $field_arr['goods_brief']) {
					$field_arr['goods_brief'] = htmlspecialchars_decode($field_arr['goods_brief']);
					$field_arr['goods_brief'] = str_replace('\'', '"', $field_arr['goods_brief']);
					$field_arr['goods_brief'] = stripcslashes($field_arr['goods_brief']);
				}

				if (isset($field_arr['goods_desc']) && $field_arr['goods_desc']) {
					$field_arr['goods_desc'] = htmlspecialchars_decode($field_arr['goods_desc']);
					$field_arr['goods_desc'] = str_replace('\'', '"', $field_arr['goods_desc']);
					$field_arr['goods_desc'] = stripcslashes($field_arr['goods_desc']);
				}

				$field_arr['user_id'] = 0;
				$field_arr['review_status'] = 5;
				$goods_list[$key] = $field_arr;
			}
		}

		write_static_cache('goods_batch-' . $guid, $goods_list, DATA_DIR . '/sc_file/goods_batch/0/');
	}

	$smarty->assign('guid', $guid);
	$smarty->assign('lang_list', $_LANG['upload_goods']);
	$ur_here = $_LANG['goods_upload_confirm'];
	$smarty->assign('ur_here', $ur_here);
	assign_query_info();
	$smarty->display('goods_batch_add_separate.dwt');
}
else if ($_REQUEST['act'] == 'goods_batch_separate') {
	include_once ROOT_PATH . 'includes/cls_image.php';
	include_once ROOT_PATH . 'includes/cls_json.php';
	$json = new JSON();
	$image = new cls_image($_CFG['bgcolor']);
	$page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
	$page_size = isset($_REQUEST['page_size']) ? intval($_REQUEST['page_size']) : 1;
	$guid = isset($_POST['guid']) && !empty($_POST['guid']) ? trim($_POST['guid']) : '';
	$goods_list = read_static_cache('goods_batch-' . $guid, DATA_DIR . '/sc_file/goods_batch/0/');
	$goods_list = $ecs->page_array($page_size, $page, $goods_list);
	$result['list'] = $goods_list['list'][0];
	$goods = $result['list'];
	$goods_id = 0;
	if ($goods && !empty($guid)) {
		if ($goods && $goods['goods_name']) {
			$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('goods') . ' WHERE (goods_name = \'' . $goods['goods_name'] . '\' OR goods_sn = \'' . $goods['goods_sn'] . '\') AND user_id = 0';
			$count = $GLOBALS['db']->getOne($sql);

			if ($count <= 0) {
				if (isset($goods['goods_name']) && $goods['goods_name']) {
					$goods['goods_name'] = addslashes($goods['goods_name']);
				}

				if (isset($goods['goods_brief']) && $goods['goods_brief']) {
					$goods['goods_brief'] = htmlspecialchars_decode($goods['goods_brief']);
					$goods['goods_brief'] = str_replace('\'', '"', $goods['goods_brief']);
					$goods['goods_brief'] = stripcslashes($goods['goods_brief']);
				}

				if (isset($goods['goods_desc']) && $goods['goods_desc']) {
					$goods['goods_desc'] = htmlspecialchars_decode($goods['goods_desc']);
					$goods['goods_desc'] = str_replace('\'', '"', $goods['goods_desc']);
					$goods['goods_desc'] = stripcslashes($goods['goods_desc']);
				}

				$goods['user_id'] = 0;
				$goods['review_status'] = 5;
				$db->autoExecute($ecs->table('goods'), $goods, 'INSERT');
				$goods_id = $db->insert_id();
				$max_id = $goods_id + 1;
				if (!empty($goods['original_img']) || !empty($goods['goods_img']) || !empty($goods['goods_thumb'])) {
					$goods_img = '';
					$goods_thumb = '';
					$original_img = '';
					$goods_gallery = array();
					$goods_gallery['goods_id'] = $db->insert_id();

					if (!empty($goods['original_img'])) {
						if ($_CFG['auto_generate_gallery']) {
							$ext = substr($goods['original_img'], strrpos($goods['original_img'], '.'));
							$img = dirname($goods['original_img']) . '/' . $image->random_filename() . $ext;
							$gallery_img = dirname($goods['original_img']) . '/' . $image->random_filename() . $ext;
							@copy(ROOT_PATH . $goods['original_img'], ROOT_PATH . $img);
							@copy(ROOT_PATH . $goods['original_img'], ROOT_PATH . $gallery_img);
							$goods_gallery['img_original'] = reformat_image_name('gallery', $goods_gallery['goods_id'], $img, 'source');
						}

						if ($_CFG['retain_original_img']) {
							$original_img = reformat_image_name('goods', $goods_gallery['goods_id'], $goods['original_img'], 'source');
						}
						else {
							@unlink(ROOT_PATH . $goods['original_img']);
						}
					}

					if (!empty($goods['goods_img'])) {
						if ($_CFG['auto_generate_gallery'] && !empty($gallery_img)) {
							$goods_gallery['img_url'] = reformat_image_name('gallery', $goods_gallery['goods_id'], $gallery_img, 'goods');
						}

						$goods_img = reformat_image_name('goods', $goods_gallery['goods_id'], $goods['goods_img'], 'goods');
					}

					if (!empty($goods['goods_thumb'])) {
						if ($_CFG['auto_generate_gallery']) {
							$ext = substr($goods['goods_thumb'], strrpos($goods['goods_thumb'], '.'));
							$gallery_thumb = dirname($goods['goods_thumb']) . '/' . $image->random_filename() . $ext;
							@copy(ROOT_PATH . $goods['goods_thumb'], ROOT_PATH . $gallery_thumb);
							$goods_gallery['thumb_url'] = reformat_image_name('gallery_thumb', $goods_gallery['goods_id'], $gallery_thumb, 'thumb');
						}

						$goods_thumb = reformat_image_name('goods_thumb', $goods_gallery['goods_id'], $goods['goods_thumb'], 'thumb');
					}

					$db->query('UPDATE ' . $ecs->table('goods') . (' SET goods_img = \'' . $goods_img . '\', goods_thumb = \'' . $goods_thumb . '\', original_img = \'' . $original_img . '\' WHERE goods_id=\'') . $goods_gallery['goods_id'] . '\'');

					if ($_CFG['auto_generate_gallery']) {
						$db->autoExecute($ecs->table('goods_gallery'), $goods_gallery, 'INSERT');
					}
				}
			}
		}
	}

	if (0 < $goods_id) {
		$result['status_lang'] = $GLOBALS['_LANG']['add_date_success'];
		admin_log('[' . $GLOBALS['_LANG']['goods_id'] . ':' . $goods_id . ']' . $goods['goods_name'], 'batch_upload', 'goods');
	}
	else {
		$result['status_lang'] = $GLOBALS['_LANG']['add_date_fail'];
	}

	$result['page'] = $goods_list['filter']['page'] + 1;
	$result['page_size'] = $goods_list['filter']['page_size'];
	$result['record_count'] = $goods_list['filter']['record_count'];
	$result['page_count'] = $goods_list['filter']['page_count'];
	$result['is_stop'] = 1;

	if ($goods_list['filter']['page_count'] < $page) {
		$result['is_stop'] = 0;
		dsc_unlink(DATA_DIR . '/sc_file/goods_batch/0/goods_batch-' . $guid . '.php');
	}
	else {
		$result['filter_page'] = $goods_list['filter']['page'];
	}

	exit($json->encode($result));
}
else if ($_REQUEST['act'] == 'select') {
	admin_priv('goods_batch');
	$smarty->assign('menu_select', array('action' => '02_cat_and_goods', 'current' => '15_batch_edit'));
	set_default_filter($goods_id);
	$smarty->assign('brand_list', search_brand_list());
	$ur_here = $_LANG['15_batch_edit'];
	$smarty->assign('ur_here', $ur_here);
	assign_query_info();
	$smarty->display('goods_batch_select.dwt');
}
else if ($_REQUEST['act'] == 'edit') {
	admin_priv('goods_batch');

	if ($_POST['select_method'] == 'cat') {
		$where = ' WHERE goods_id ' . db_create_in($_POST['goods_ids']);
	}
	else {
		$goods_sns = str_replace('
', ',', str_replace('
', '', $_POST['sn_list']));
		$sql = 'SELECT DISTINCT goods_id FROM ' . $ecs->table('goods') . ' WHERE goods_sn ' . db_create_in($goods_sns);
		$goods_ids = join(',', $db->getCol($sql));
		$where = ' WHERE goods_id ' . db_create_in($goods_ids);
	}

	$sql = 'SELECT DISTINCT goods_id, goods_sn, goods_name, market_price, shop_price, goods_number, integral, give_integral, brand_id, is_real,model_attr FROM ' . $ecs->table('goods') . $where;
	$goods_list = $db->getAll($sql);

	foreach ($goods_list as $key => $val) {
		$product_list = '';
		$goods_list[$key]['brand_list'] = get_brand_list($val['goods_id']);

		if ($val['model_attr'] == 1) {
			$table_products = 'products_warehouse';
		}
		else if ($val['model_attr'] == 2) {
			$table_products = 'products_area';
		}
		else {
			$table_products = 'products';
		}

		$sql = 'SELECT * FROM ' . $ecs->table($table_products) . 'WHERE goods_id = \'' . $val['goods_id'] . '\'';
		$product_list = $db->getAll($sql);

		if (!empty($product_list)) {
			$_product_list = array();

			foreach ($product_list as $value) {
				$goods_attr = product_goods_attr_list($value['goods_id']);
				$_goods_attr_array = explode('|', $value['goods_attr']);

				if (is_array($_goods_attr_array)) {
					$_temp = '';

					foreach ($_goods_attr_array as $_goods_attr_value) {
						$_temp[] = $goods_attr[$_goods_attr_value];
					}

					$value['goods_attr'] = implode('，', $_temp);
				}

				$_product_list[] = $value;
			}

			$goods_list[$key]['product_list'] = $_product_list;
		}
	}

	$smarty->assign('goods_list', $goods_list);
	$member_price_list = array();
	$sql = 'SELECT DISTINCT goods_id, user_rank, user_price FROM ' . $ecs->table('member_price') . $where;
	$res = $db->query($sql);

	while ($row = $db->fetchRow($res)) {
		$member_price_list[$row['goods_id']][$row['user_rank']] = $row['user_price'];
	}

	$smarty->assign('member_price_list', $member_price_list);
	$sql = 'SELECT rank_id, rank_name, discount ' . 'FROM ' . $ecs->table('user_rank') . ' ORDER BY discount DESC';
	$smarty->assign('rank_list', $db->getAll($sql));
	$smarty->assign('edit_method', $_POST['edit_method']);
	$ur_here = $_LANG['15_batch_edit'];
	$smarty->assign('ur_here', $ur_here);
	assign_query_info();
	$smarty->display('goods_batch_edit.dwt');
}
else if ($_REQUEST['act'] == 'update') {
	admin_priv('goods_batch');
	$warehouse_id = !empty($_REQUEST['warehouse_id']) ? $_REQUEST['warehouse_id'] : array();
	$area_id = !empty($_REQUEST['area_id']) ? $_REQUEST['area_id'] : array();

	if ($_POST['edit_method'] == 'each') {
		if (!empty($_POST['goods_id'])) {
			foreach ($_POST['goods_id'] as $goods_id) {
				$sql = 'SELECT model_attr FROM' . $ecs->table('goods') . 'WHERE goods_id = \'' . $goods_id . '\' LIMIT 1';
				$model_attr = $db->getOne($sql);

				if (!empty($_POST['product_number'][$goods_id])) {
					$_POST['goods_number'][$goods_id] = 0;

					foreach ($_POST['product_number'][$goods_id] as $key => $value) {
						if ($model_attr == 1) {
							$table_products = 'products_warehouse';
							$table_where = ' AND warehouse_id = \'' . $warehouse_id[$key] . '\'';
						}
						else if ($model_attr == 2) {
							$table_products = 'products_area';
							$table_where = ' AND area_id = \'' . $area_id[$key] . '\'';
						}
						else {
							$table_products = 'products';
							$table_where = '';
						}

						$sql = 'UPDATE' . $ecs->table($table_products) . ('SET product_number = \'' . $value . '\' WHERE goods_id = \'' . $goods_id . '\' AND product_id = ') . $key . $table_where;
						$db->query($sql);
						$_POST['goods_number'][$goods_id] += $value;
					}
				}

				$goods = array('market_price' => floatval($_POST['market_price'][$goods_id]), 'shop_price' => floatval($_POST['shop_price'][$goods_id]), 'integral' => intval($_POST['integral'][$goods_id]), 'give_integral' => intval($_POST['give_integral'][$goods_id]), 'goods_number' => intval($_POST['goods_number'][$goods_id]), 'brand_id' => intval($_POST['brand_id'][$goods_id]), 'last_update' => gmtime());
				$db->autoExecute($ecs->table('goods'), $goods, 'UPDATE', 'goods_id = \'' . $goods_id . '\'');

				if (!empty($_POST['rank_id'])) {
					foreach ($_POST['rank_id'] as $rank_id) {
						if (trim($_POST['member_price'][$goods_id][$rank_id]) == '') {
							continue;
						}

						$rank = array('goods_id' => $goods_id, 'user_rank' => $rank_id, 'user_price' => floatval($_POST['member_price'][$goods_id][$rank_id]));
						$sql = 'SELECT COUNT(*) FROM ' . $ecs->table('member_price') . (' WHERE goods_id = \'' . $goods_id . '\' AND user_rank = \'' . $rank_id . '\'');

						if (0 < $db->getOne($sql)) {
							if ($rank['user_price'] < 0) {
								$db->query('DELETE FROM ' . $ecs->table('member_price') . (' WHERE goods_id = \'' . $goods_id . '\' AND user_rank = \'' . $rank_id . '\''));
							}
							else {
								$db->autoExecute($ecs->table('member_price'), $rank, 'UPDATE', 'goods_id = \'' . $goods_id . '\' AND user_rank = \'' . $rank_id . '\'');
							}
						}
						else if (0 <= $rank['user_price']) {
							$db->autoExecute($ecs->table('member_price'), $rank, 'INSERT');
						}
					}
				}
			}
		}
	}
	else if (!empty($_POST['goods_id'])) {
		foreach ($_POST['goods_id'] as $goods_id) {
			$goods = array();

			if (trim($_POST['market_price'] != '')) {
				$goods['market_price'] = floatval($_POST['market_price']);
			}

			if (trim($_POST['shop_price']) != '') {
				$goods['shop_price'] = floatval($_POST['shop_price']);
			}

			if (trim($_POST['integral']) != '') {
				$goods['integral'] = intval($_POST['integral']);
			}

			if (trim($_POST['give_integral']) != '') {
				$goods['give_integral'] = intval($_POST['give_integral']);
			}

			if (trim($_POST['goods_number']) != '') {
				$goods['goods_number'] = intval($_POST['goods_number']);
			}

			if (0 < $_POST['brand_id']) {
				$goods['brand_id'] = $_POST['brand_id'];
			}

			if (!empty($goods)) {
				$db->autoExecute($ecs->table('goods'), $goods, 'UPDATE', 'goods_id = \'' . $goods_id . '\'');
			}

			if (!empty($_POST['rank_id'])) {
				foreach ($_POST['rank_id'] as $rank_id) {
					if (trim($_POST['member_price'][$rank_id]) != '') {
						$rank = array('goods_id' => $goods_id, 'user_rank' => $rank_id, 'user_price' => floatval($_POST['member_price'][$rank_id]));
						$sql = 'SELECT COUNT(*) FROM ' . $ecs->table('member_price') . (' WHERE goods_id = \'' . $goods_id . '\' AND user_rank = \'' . $rank_id . '\'');

						if (0 < $db->getOne($sql)) {
							if ($rank['user_price'] < 0) {
								$db->query('DELETE FROM ' . $ecs->table('member_price') . (' WHERE goods_id = \'' . $goods_id . '\' AND user_rank = \'' . $rank_id . '\''));
							}
							else {
								$db->autoExecute($ecs->table('member_price'), $rank, 'UPDATE', 'goods_id = \'' . $goods_id . '\' AND user_rank = \'' . $rank_id . '\'');
							}
						}
						else if (0 <= $rank['user_price']) {
							$db->autoExecute($ecs->table('member_price'), $rank, 'INSERT');
						}
					}
				}
			}
		}
	}

	admin_log('', 'batch_edit', 'goods');
	$link[] = array('href' => 'goods_batch.php?act=select', 'text' => $_LANG['15_batch_edit']);
	sys_msg($_LANG['batch_edit_ok'], 0, $link);
}
else if ($_REQUEST['act'] == 'download') {
	admin_priv('goods_batch');
	header('Content-type: application/vnd.ms-excel; charset=utf-8');
	Header('Content-Disposition: attachment; filename=goods_list.csv');

	if ($_GET['charset'] != $_CFG['lang']) {
		$lang_file = '../languages/' . $_GET['charset'] . '/' . ADMIN_PATH . '/goods_batch.php';

		if (file_exists($lang_file)) {
			unset($_LANG['upload_goods']);
			require $lang_file;
		}
	}

	if (isset($_LANG['upload_goods'])) {
		if ($_GET['charset'] == 'zh_cn' || $_GET['charset'] == 'zh_tw') {
			$to_charset = $_GET['charset'] == 'zh_cn' ? 'GB2312' : 'BIG5';
			echo ecs_iconv(EC_CHARSET, $to_charset, join(',', $_LANG['upload_goods']));
		}
		else {
			echo join(',', $_LANG['upload_goods']);
		}
	}
	else {
		echo 'error: $_LANG[upload_goods] not exists';
	}
}
else if ($_REQUEST['act'] == 'get_goods') {
	$filter = new stdclass();
	$filter->cat_id = intval($_GET['cat_id']);
	$filter->brand_id = intval($_GET['brand_id']);
	$filter->real_goods = -1;
	$arr = get_goods_list($filter);
	make_json_result($arr);
}

?>
