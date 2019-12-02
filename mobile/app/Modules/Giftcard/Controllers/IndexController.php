<?php
/*运营推荐在线升级版联系QQ97908527*/
namespace App\Modules\Giftcard\Controllers;

class IndexController extends \App\Modules\Base\Controllers\FrontendController
{
	public function __construct()
	{
		parent::__construct();
		$this->assign('lang', array_change_key_case(L()));
		$this->user_id = $_SESSION['user_id'];
		$this->actionchecklogin();
	}

	public function actionIndex()
	{
		if (isset($_SESSION['gift_sn']) && !empty($_SESSION['gift_sn'])) {
			ecs_header('Location: ' . url('giftcard/index/list'));
			exit();
		}

		$this->assign('page_title', L('gift_title'));
		$this->assign('keywords', C('shop.shop_keywords'));
		$this->assign('description', C('shop.shop_desc'));
		$this->display();
	}

	public function actionLogin()
	{
		$gift_card = I('gift_card') ? I('gift_card') : '';
		$gift_pwd = I('gift_pwd') ? I('gift_pwd') : '';
		$result = $this->getWepCheckGiftLogin($gift_card, $gift_pwd);
		exit(json_encode($result));
	}

	public function getWepCheckGiftLogin($gift_sn, $gift_pwd)
	{
		if (empty($gift_pwd) || empty($gift_sn)) {
			return array('error' => 1);
		}

		$gift_count = dao('user_gift_gard')->where(array('gift_sn' => $gift_sn, 'goods_id' => 0, 'is_delete' => 1))->count();

		if ($gift_count <= 0) {
			return array('error' => 1, 'content' => L('not_gift_gard'));
		}

		$result = array();
		$row = array();

		if ($gift_sn) {
			$result = dao('user_gift_gard')->where(array('gift_sn' => $gift_sn, 'gift_password' => $gift_pwd, 'is_delete' => 1))->find();

			if (empty($result)) {
				return array('error' => 1, 'content' => L('password_error'));
			}

			if ($result) {
				$row = dao('gift_gard_type')->where(array('review_status' => 3, 'gift_id' => $result['gift_id']))->find();
			}
		}

		if ($row) {
			$time = gmtime();

			if ($row['gift_end_date'] <= $time) {
				return array('error' => 1, 'content' => L('gift_gard_overdue_time') . local_date('Y-m-d H:i:s', $row['gift_end_date']));
			}
			else if ($time <= $row['gift_start_date']) {
				return array('error' => 1, 'content' => L('gift_gard_Use_time') . local_date('Y-m-d H:i:s', $row['gift_start_date']));
			}
		}
		else {
			return array('error' => 1, 'content' => L('gift_gard_error'));
		}

		if ($result) {
			$_SESSION['gift_sn'] = $gift_sn;
			return array('error' => 0, 'content' => L('gift_login_success'));
		}
		else {
			return array('error' => 1, 'content' => L('password_error'));
		}
	}

	public function actionList()
	{
		if (IS_AJAX) {
			$page = I('page', 1, 'intval');
			$size = I('size', 1, 'intval');
			$gift_sn = $_SESSION['gift_sn'];
			$sql = 'SELECT config_goods_id,gift_id FROM {pre}user_gift_gard
                    WHERE  gift_sn = \'' . $gift_sn . '\' and is_delete = 1';
			$config_goods = $this->db->getRow($sql);
			$config_goods_arr = explode(',', $config_goods['config_goods_id']);
			$sql = 'SELECT goods_id, goods_name, shop_price, goods_thumb FROM ' . $GLOBALS['ecs']->table('goods') . ' WHERE goods_id ' . db_create_in($config_goods_arr);
			$res = $this->db->getAll($sql);
			$total = is_array($res) ? count($res) : 0;
			$list = $GLOBALS['db']->selectLimit($sql, $size, ($page - 1) * $size);

			foreach ($list as $key => $value) {
				$list[$key]['url'] = url('goods/index/index', array('id' => $value['goods_id']));
				$list[$key]['goods_thumb'] = get_image_path($value['goods_thumb']);
				$list[$key]['shop_price'] = price_format($value['shop_price']);
			}

			exit(json_encode(array('list' => $list, 'totalPage' => ceil($total / $size))));
		}
		else {
			$this->assign('page_title', L('gift_goods_title'));
			$this->assign('keywords', C('shop.shop_keywords'));
			$this->assign('description', C('shop.shop_desc'));
			$this->display();
		}
	}

	public function actionLogout()
	{
		$_SESSION['gift_sn'] = '';
		$result = array('error' => 0, 'content' => L('gift_logout_success'));
		exit(json_encode($result));
	}

	public function actionConsignee()
	{
		$goods_id = I('id', 0, 'intval');
		$this->assign('goods_id', $goods_id);
		$this->assign('page_title', L('gift_address_title'));
		$this->assign('keywords', C('shop.shop_keywords'));
		$this->assign('description', C('shop.shop_desc'));
		$this->display();
	}

	public function actionTake()
	{
		$goods_id = I('goods_id', 0, 'intval');
		$country = I('country', 1, 'intval');
		$province = I('province_region_id', 0, 'intval');
		$city = I('city_region_id', 0, 'intval');
		$district = I('district_region_id', 0, 'intval');
		$street = I('town_region_id', 0, 'intval');
		$desc_address = I('address', '');
		$consignee = I('consignee', '');
		$mobile = I('mobile', '');
		$gift_sn = $_SESSION['gift_sn'];

		if ($gift_sn) {
			$pwd = dao('user_gift_gard')->where(array('gift_sn' => $gift_sn, 'goods_id' => 0, 'is_delete' => 1))->find();

			if (empty($pwd)) {
				$_SESSION['gift_sn'] = '';
				$result = array('error' => 1, 'content' => L('gift_gard_used'));
				exit(json_encode($result));
			}
		}
		else {
			$_SESSION['gift_sn'] = '';
			$result = array('error' => 1, 'content' => L('gift_logout_overdue'));
			exit(json_encode($result));
		}

		$country = get_region_name($country);
		$province = get_region_name($province);
		$city = get_region_name($city);
		$district = get_region_name($district);
		$street = get_region_name($street);
		$address = '[' . $country['region_name'] . ' ' . $province['region_name'] . ' ' . $city['region_name'] . ' ' . $district['region_name'] . ' ' . $street['region_name'] . '] ' . $desc_address;
		if (empty($country['region_name']) || empty($province['region_name']) || empty($city['region_name']) || empty($district['region_name']) || empty($desc_address) || empty($consignee) || empty($mobile)) {
			$result = array('error' => 1, 'content' => L('gift_logout_overdue'));
			exit(json_encode($result));
		}

		$user_time = gmtime();
		$data = array('user_id' => $this->user_id, 'goods_id' => $goods_id, 'user_time' => $user_time, 'address' => $address, 'consignee_name' => $consignee, 'mobile' => $mobile, 'status' => 1);
		$where = array('gift_sn' => $gift_sn);
		$res = dao('user_gift_gard')->data($data)->where($where)->save();

		if ($res) {
			$_SESSION['gift_sn'] = '';
			$result = array('error' => 0, 'content' => L('delivery_Success'));
			exit(json_encode($result));
		}
		else {
			$result = array('error' => 1, 'content' => L('delivery_fail'));
			exit(json_encode($result));
		}
	}

	public function actionOrder()
	{
		if (IS_AJAX) {
			$page = I('page', 1, 'intval');
			$size = I('size', 10, 'intval');
			$user_id = $this->user_id;
			$sql = 'SELECT * FROM {pre}user_gift_gard
                    WHERE  user_id = \'' . $user_id . '\' ORDER BY user_time desc';
			$res = $this->db->getAll($sql);
			$total = is_array($res) ? count($res) : 0;
			$list = $GLOBALS['db']->selectLimit($sql, $size, ($page - 1) * $size);

			foreach ($list as $key => $value) {
				$list[$key]['gift_name'] = dao('gift_gard_type')->where(array('gift_id' => $value['gift_id']))->getField('gift_name');
				$goods = dao('goods')->field('goods_name, goods_thumb')->where(array('goods_id' => $value['goods_id']))->find();
				$list[$key]['url'] = url('goods/index/index', array('id' => $value['goods_id']));
				$list[$key]['goods_name'] = $goods ? $goods['goods_name'] : '';
				$list[$key]['goods_thumb'] = $goods ? get_image_path($goods['goods_thumb']) : '';
			}

			exit(json_encode(array('list' => $list, 'totalPage' => ceil($total / $size))));
		}
		else {
			$this->assign('page_title', L('gift_order_title'));
			$this->assign('keywords', C('shop.shop_keywords'));
			$this->assign('description', C('shop.shop_desc'));
			$this->display();
		}
	}

	public function actionConfirm()
	{
		$take_id = I('take_id', 0, 'intval');
		$data = array('status' => 3);
		$where = array('gift_gard_id' => $take_id);
		$res = dao('user_gift_gard')->data($data)->where($where)->save();

		if ($res) {
			$result = array('error' => 0, 'content' => L('receipt_Success'));
			exit(json_encode($result));
		}
		else {
			$result = array('error' => 1, 'content' => L('receipt_fail'));
			exit(json_encode($result));
		}
	}

	public function actionchecklogin()
	{
		if ($_SESSION['user_id']) {
			$users = dao('users')->where(array('user_id' => $_SESSION['user_id']))->find();

			if (empty($users)) {
				$_SESSION['user_id'] = 0;
				$_SESSION['user_name'] = '';
				$_SESSION['email'] = '';
				$_SESSION['user_rank'] = 0;
				$_SESSION['discount'] = 1;
				$_SESSION['openid'] = '';
				$_SESSION['unionid'] = '';
			}
		}

		if (!$_SESSION['user_id']) {
			$back_act = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : __HOST__ . $_SERVER['REQUEST_URI'];
			$this->redirect('user/login/index', array('back_act' => urlencode($back_act)));
		}
	}
}

?>
