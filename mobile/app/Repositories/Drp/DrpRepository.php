<?php
/*运营推荐在线升级版联系QQ97908527*/
namespace App\Repositories\Drp;

class DrpRepository
{
	const FAR_ALL = 0;
	const FAR_CATEGORY = 1;
	const FAT_PRICE = 1;
	const FAT_DISCOUNT = 2;
	const FAR_BRAND = 2;
	const FAR_GOODS = 3;

	private $model;
	private $shopConfigRepository;
	private $userRankRepository;
	private $authService;
	private $goodsRepository;
	private $shopRepository;

	public function __construct(\App\Repositories\ShopConfig\ShopConfigRepository $shopConfigRepository, \App\Repositories\User\UserRankRepository $userRankRepository, \App\Services\AuthService $authService, \App\Repositories\Goods\GoodsRepository $goodsRepository, \App\Repositories\Shop\ShopRepository $shopRepository)
	{
		$this->shopConfigRepository = $shopConfigRepository;
		$this->userRankRepository = $userRankRepository;
		$this->authService = $authService;
		$this->goodsRepository = $goodsRepository;
		$this->shopRepository = $shopRepository;
		$this->model = \App\Models\Cart::where('rec_id', '<>', 0);
	}

	public function judgmentDrp($uid)
	{
		$res = \App\Models\DrpShop::select('id')->where('user_id', $uid)->first();
		$res = !empty($res) ? $res->toArray() : '';
		return $res;
	}

	public function judgmentShop($shopname)
	{
		$res = \App\Models\DrpShop::select('id')->where('shop_name', $shopname)->first();
		$res = !empty($res) ? $res->toArray() : '';
		return $res;
	}

	public function judgmentMobile($mobile)
	{
		$res = \App\Models\DrpShop::select('id')->where('mobile', $mobile)->first();
		$res = !empty($res) ? $res->toArray() : '';
		return $res;
	}

	public function creatDrp($uid, $result)
	{
		$res = new \App\Models\DrpShop();
		$res->user_id = $uid;
		$res->shop_name = $result['shopname'];
		$res->real_name = $result['realname'];
		$res->mobile = $result['mobile'];
		$res->qq = $result['qq'];
		$res->create_time = gmtime();
		$res->save();
	}

	public function insertDrplog($order_id, $user_id, $username, $money, $point, $i, $is, $separate_type)
	{
		$time = gmtime();
		$drplog = array('order_id' => $order_id, 'user_id' => $user_id, 'user_name' => $username, 'time' => $time, 'money' => $money, 'point' => $point, 'drp_level' => $i, 'is_separate' => $is, 'separate_type' => $separate_type);
		$id = \App\Models\DrpLog::insertGetId($drplog);
		return $id;
	}

	public function settings($uid, $result)
	{
		\App\Models\DrpShop::where('user_id', $uid)->update($result);
	}

	public function userInfo($uid)
	{
		$res = \App\Models\DrpShop::where('user_id', $uid)->first();

		if ($res) {
			return $res->toArray();
		}
		else {
			return '';
		}
	}

	public function get_drp_money($type, $uid)
	{
		if ($type === 0) {
			$res = \App\Models\DrpAffiliateLog::where('separate_type', '!=', '-1')->where('user_id', $uid)->sum('money');
		}
		else if ($type === 1) {
			$res = \App\Models\DrpAffiliateLog::where('separate_type', '!=', '-1')->where('time', '>=', mktime(0, 0, 0))->where('user_id', $uid)->sum('money');
		}
		else {
			$res = \App\Models\OrderGoods::from('order_goods as o')->leftjoin('drp_affiliate_log as a', 'o.order_id', '=', 'a.order_id')->where('a.separate_type', '!=', '-1')->where('a.user_id', $uid)->sum('goods_price');
		}

		return $res;
	}

	public function shopMoney($uid)
	{
		$res = \App\Models\DrpShop::select('shop_money')->where('user_id', $uid)->first();
		return $res->toArray();
	}

	public function parentInfo($uid)
	{
		$res = \App\Models\Users::from('users as u')->select('u.user_id', 'u.user_name', 'u.nick_name', 'u.user_picture', 'u.reg_time', 's.status', 's.audit')->leftjoin('drp_shop as s', 'u.user_id', '=', 's.user_id')->where('u.drp_parent_id', $uid)->where('s.status', 1)->where('s.audit', 1)->orderBy('u.reg_time', 'desc')->get()->toArray();

		foreach ($res as $key => $val) {
			$res[$key]['money'] = \App\Models\DrpAffiliateLog::where('user_id', $val['user_id'])->sum('money');
		}

		return $res;
	}

	public function teamdetail($uid)
	{
		$prefix = \Illuminate\Support\Facades\Config::get('database.connections.mysql.prefix');
		$sql = 'SELECT u.user_id,u.drp_parent_id, dp.create_time, IFNULL(w.nickname,u.user_name) as name, w.headimgurl, FROM_UNIXTIME(u.reg_time, \'%Y-%m-%d\') as time,
                IFNULL((select sum(sl.money) from ' . $prefix . 'drp_affiliate_log as sl
                        left join ' . $prefix . ('order_info as so on sl.order_id=so.order_id
                        where so.user_id=\'' . $uid . '\' and sl.separate_type != -1 and sl.user_id=u.drp_parent_id),0) as sum_money,
                IFNULL((select sum(nl.money) from ') . $prefix . 'drp_affiliate_log as nl
                        left join ' . $prefix . 'order_info as no on nl.order_id=no.order_id
                        where  nl.time>\'' . mktime(0, 0, 0) . ('\' and no.user_id=\'' . $uid . '\' and nl.separate_type != -1 and nl.user_id=u.drp_parent_id),0) as now_money,
                       (select count(h.user_id) from ') . $prefix . 'users as h LEFT JOIN ' . $prefix . ('drp_shop as s on s.user_id=h.user_id where s.status=1 and s.audit=1 and drp_parent_id=\'' . $uid . '\' ) as next_num
                FROM ') . $prefix . 'users as u
                LEFT JOIN  ' . $prefix . 'wechat_user as w ON u.user_id=w.ect_uid
                LEFT JOIN  ' . $prefix . ('drp_shop as dp ON u.user_id=dp.user_id
                WHERE u.user_id=\'' . $uid . '\'');
		$res = \Illuminate\Support\Facades\DB::select($sql);
		return $res;
	}

	public function OfflineUser($uid)
	{
		$res = \App\Models\Users::select('*')->where('parent_id', $uid)->orderBy('reg_time', 'desc')->get()->toArray();
		return $res;
	}

	public function drpUserCredit()
	{
		$rank_info = \App\Models\DrpUserCredit::select('id', 'credit_name', 'min_money', 'max_money')->get()->toArray();
		return $rank_info;
	}

	public function drp_rank_info($user_id)
	{
		$drp_info = \App\Models\DrpShop::select('credit_id')->where('user_id', $user_id)->first();

		if (!empty($drp_info)) {
			$drp_info = $drp_info->toArray();
			$rank_info = \App\Models\DrpUserCredit::select('id', 'credit_name', 'min_money', 'max_money')->where('id', 1)->first();
			$rank_info = $rank_info->toArray();

			if (0 < $drp_info['credit_id']) {
				$rank_info = \App\Models\DrpUserCredit::select('id', 'credit_name', 'min_money', 'max_money')->where('id', $drp_info['credit_id'])->first();
				$rank_info = $rank_info->toArray();
			}
		}
		else {
			$totals = \App\Models\OrderGoods::from('order_goods as o')->leftjoin('drp_affiliate_log as a', 'o.order_id', '=', 'a.order_id')->where('a.separate_type', '!=', -1)->where('a.user_id', $user_id)->sum('money');
			$goods_price = $totals ? $totals : 0;
			$rank_info = \App\Models\DrpUserCredit::select('id', 'credit_name', 'min_money', 'max_money')->where('min_money', '<=', $goods_price)->where('max_money', '>', $goods_price)->first();
			$rank_info = $rank_info->toArray();
		}

		return $rank_info;
	}

	public function drpType($code)
	{
		$res = \App\Models\DrpConfig::select('value')->where('code', $code)->first();
		return $res->toArray();
	}

	public function payment($code)
	{
		$res = \App\Models\Payment::select('*')->where('pay_code', $code)->get()->toArray();
		return $res;
	}

	public function order($uid, $corrent, $size, $status)
	{
		$res = \App\Models\DrpLog::from('drp_log as dl')->select('dl.user_id', 'u.nick_name', 'u.user_name', 'dl.money', 'o.*', 'dl.point', 'dl.drp_level', 'dl.is_separate')->leftjoin('order_info as o', 'o.order_id', '=', 'dl.order_id')->leftjoin('wechat_user as w', 'w.ect_uid', '=', 'o.user_id')->leftjoin('users as u', 'u.user_id', '=', 'o.user_id')->offset($corrent)->where('dl.user_id', $uid)->where('o.pay_status', 2);

		if ($status == 2) {
			$res = $res;
		}
		else {
			$res = $res->where('o.drp_is_separate', $status);
		}

		$res = $res->whereIn('dl.is_separate', array(0, 1))->orderBy('order_id', 'desc')->limit($size)->get()->toArray();
		return $res;
	}

	public function orderDetail($uid, $order_id)
	{
		$res = \App\Models\DrpLog::from('drp_log as dl')->select('dl.user_id', 'u.nick_name', 'u.user_name', 'dl.money', 'o.*', 'dl.point', 'dl.drp_level')->leftjoin('order_info as o', 'o.order_id', '=', 'dl.order_id')->leftjoin('wechat_user as w', 'w.ect_uid', '=', 'o.user_id')->leftjoin('users as u', 'u.user_id', '=', 'o.user_id')->where('dl.user_id', $uid)->where('o.order_id', $order_id)->where('o.pay_status', 2)->first();
		return $res->toArray();
	}

	public function ordergoods($order_id)
	{
		$res = \App\Models\OrderGoods::from('order_goods as og')->select('og.rec_id', 'og.goods_id', 'og.goods_name', 'og.goods_attr', 'og.goods_number', 'og.goods_price', 'og.drp_money', 'g.goods_thumb')->leftjoin('goods as g', 'og.goods_id', '=', 'g.goods_id')->where('og.order_id', $order_id)->where('og.is_distribution', 1)->where('og.drp_money', '>', 0)->get()->toArray();
		return $res;
	}

	public function rankList($order_id)
	{
		$prefix = \Illuminate\Support\Facades\Config::get('database.connections.mysql.prefix');
		$sql = 'SELECT d.user_id, w.nickname, w.headimgurl, u.user_name, u.user_picture,
                    IFNULL((select sum(money) from ' . $prefix . 'drp_affiliate_log where  user_id=d.user_id and separate_type != -1),0) as money,
                    IFNULL((select count(user_id) from ' . $prefix . 'users where drp_parent_id=d.user_id ),0) as user_num
                    FROM ' . $prefix . 'drp_shop as d
                    LEFT JOIN ' . $prefix . 'users as u ON d.user_id=u.user_id
                    LEFT JOIN ' . $prefix . 'wechat_user as w ON d.user_id=w.ect_uid
                    LEFT JOIN ' . $prefix . 'drp_affiliate_log as log ON log.user_id=d.user_id
                    where d.audit=1 and d.status=1
                    GROUP BY d.user_id
                    ORDER BY money desc,user_num desc';
		$res = \Illuminate\Support\Facades\DB::select($sql);
		return $res;
	}

	public function getCategoryGetGoods($uid, $cat_id)
	{
		$list = \App\Models\Goods::select('goods_id', 'cat_id', 'goods_name', 'shop_price', 'goods_thumb')->where('is_real', 1)->where('is_on_sale', 1)->where('is_alone_sale', 1)->where('review_status', '>', 2)->where('is_show', 1)->where('is_distribution', 1)->where('cat_id', $cat_id)->get()->toArray();

		foreach ($list as $k => $v) {
			$list[$k]['goods_thumb'] = get_image_path($v['goods_thumb']);
			$type = \App\Models\DrpType::select('id')->where('goods_id', $v['goods_id'])->where('user_id', $uid)->first();

			if (!empty($type)) {
				$list[$k]['drp_type'] = true;
			}
			else {
				$list[$k]['drp_type'] = false;
			}
		}

		return $list;
	}

	public function drpgoods($uid, $id)
	{
		$type = \App\Models\DrpType::select('id')->where('goods_id', $id)->where('user_id', $uid)->first();

		if (!empty($type)) {
			$res = \App\Models\DrpType::where('goods_id', $id)->where('user_id', $uid)->delete();
		}
		else {
			$res = new \App\Models\DrpType();
			$res->user_id = $uid;
			$res->cat_id = 0;
			$res->goods_id = $id;
			$res->add_time = gmtime();
			$res->type = 2;
			$res->save();
		}
	}

	public function drpcat($uid, $id)
	{
		foreach ($id as $k => $val) {
			$type = \App\Models\DrpType::select('id')->where('cat_id', $val)->where('user_id', $uid)->first();

			if (!empty($type)) {
				$res = \App\Models\DrpType::where('cat_id', $val)->where('user_id', $uid)->delete();
			}
			else {
				$res = new \App\Models\DrpType();
				$res->user_id = $uid;
				$res->cat_id = $val;
				$res->goods_id = 0;
				$res->add_time = gmtime();
				$res->type = 1;
				$res->save();
			}
		}
	}

	public function showgoods($uid, $corrent, $size, $type, $status = 0)
	{
		if ($type == 0) {
			$goods = \App\Models\Goods::select('goods_id', 'cat_id', 'goods_name', 'shop_price', 'goods_thumb');

			if ($status == 2) {
				$goods = $goods->where('is_new', 1);
			}
			else if ($status == 3) {
				$time = gmtime();
				$goods = $goods->where('promote_price', '>', 0)->where('promote_start_date', '<=', $time)->where('promote_end_date', '>=', $time);
			}

			$res = $goods->where('is_delete', 0)->where('is_real', 1)->where('is_on_sale', 1)->where('is_alone_sale', 1)->where('review_status', '>', 2)->where('is_show', 1)->where('is_distribution', 1)->get()->toArray();

			foreach ($res as $k => $v) {
				$res[$k]['goods_thumb'] = get_image_path($v['goods_thumb']);
			}
		}
		else {
			$list = \App\Models\DrpType::select('goods_id', 'cat_id')->offset($corrent)->where('user_id', $uid)->where('type', $type)->limit($size)->get()->toArray();
			$res = array();

			if (!empty($list)) {
				foreach ($list as $k => $v) {
					if ($type == 2) {
						$goods = \App\Models\Goods::select('goods_id', 'cat_id', 'goods_name', 'shop_price', 'goods_thumb');

						if ($status == 2) {
							$goods = $goods->where('is_new', 1);
						}
						else if ($status == 3) {
							$time = gmtime();
							$goods = $goods->where('promote_price', '>', 0)->where('promote_start_date', '<=', $time)->where('promote_end_date', '>=', $time);
						}

						$goods = $goods->where('is_delete', 0)->where('is_real', 1)->where('is_on_sale', 1)->where('is_alone_sale', 1)->where('review_status', '>', 2)->where('is_show', 1)->where('is_distribution', 1)->where('goods_id', $v['goods_id'])->first();

						if ($goods) {
							$res[$k] = $goods->toArray();
							$res[$k]['goods_thumb'] = get_image_path($res[$k]['goods_thumb']);
						}
						else {
							unset($res[$k]);
						}
					}
					else {
						$goods = \App\Models\Goods::select('goods_id', 'cat_id', 'goods_name', 'shop_price', 'goods_thumb');

						if ($status == 2) {
							$goods = $goods->where('is_new', 1);
						}
						else if ($status == 3) {
							$time = gmtime();
							$goods = $goods->where('promote_price', '>', 0)->where('promote_start_date', '<=', $time)->where('promote_end_date', '>=', $time);
						}

						$res[$k] = $goods->where('is_delete', 0)->where('is_real', 1)->where('is_on_sale', 1)->where('is_alone_sale', 1)->where('review_status', '>', 2)->where('is_show', 1)->where('is_distribution', 1)->where('cat_id', $v['cat_id'])->get()->toArray();

						if (empty($res[$k])) {
							unset($res[$k]);
						}
					}
				}
			}

			if ($type == 1) {
				$res = array_merge($res);
				$res = isset($res[0]) ? $res[0] : $res;

				foreach ($res as $k => $v) {
					$res[$k]['goods_thumb'] = get_image_path($v['goods_thumb']);
				}
			}
		}

		return $res;
	}

	public function Drplog($uid, $corrent, $size, $status)
	{
		$res = \App\Models\DrpLog::from('drp_log as a')->select('o.order_sn', 'a.time', 'a.user_id', 'a.time', 'a.money', 'a.point', 'a.separate_type', 'w.nickname', 'u.user_name', 'a.is_separate')->leftjoin('order_info as o', 'o.order_id', '=', 'a.order_id')->leftjoin('wechat_user as w', 'w.ect_uid', '=', 'o.user_id')->leftjoin('users as u', 'o.user_id', '=', 'u.user_id')->offset($corrent);

		if ($status == 2) {
			$res = $res;
		}
		else {
			$res = $res->where('a.is_separate', $status);
		}

		$res = $res->where('a.user_id', $uid)->where('o.order_status', 1)->where('o.pay_status', 2)->limit($size)->get()->toArray();

		foreach ($res as $k => $v) {
			$res[$k]['time'] = date('Y-m-d H:i', $v['time']);
			$res[$k]['is_separate'] = $v['is_separate'] == '1' ? '已分成' : '等待处理';

			if ($v['separate_type'] == -1) {
				$res[$k]['is_separate'] = '已撤销';
			}
		}

		return $res;
	}

	public function drpUserShop($uid)
	{
		$res = \App\Models\Users::from('users as u')->select('u.drp_parent_id')->leftjoin('drp_shop as ds', 'u.drp_parent_id', '=', 'ds.user_id')->where('u.user_id', $uid)->where('ds.audit', 1)->where('ds.status', 1)->first();

		if ($res) {
			return $res->toArray();
		}
		else {
			return '';
		}
	}

	public function News()
	{
		$res = \App\Models\Article::select('title', 'content')->where('is_open', 1)->where('cat_id', 1000)->orderBy('add_time', 'desc')->get()->toArray();
		return $res;
	}

	public function Drpmoney($order_id)
	{
		$res = \App\Models\OrderGoods::where('order_id', $order_id)->sum('drp_money');
		return $res;
	}

	public function drpShopInfo($uid)
	{
		$res = \App\Models\DrpShop::where('user_id', $uid)->where('status', 1)->where('audit', 1)->first();

		if ($res) {
			return $res->toArray();
		}
		else {
			return '';
		}
	}

	public function drpOrderInfo()
	{
		$last_oid = \App\Models\DrpLog::max('order_id');
		$last_oid = $last_oid ? $last_oid : 0;
		$model = \App\Models\OrderInfo::MainOrderCount()->where('order_id', '>', $last_oid)->where('drp_is_separate', 0);
		$model = $model->whereHas('getOrderGoods', function($query) {
			$query->select('drp_money')->where('drp_money', '>', 0);
		});
		$res = $model->select('order_id')->orderby('order_id', 'asc')->get();

		if ($res) {
			return $res->toArray();
		}
		else {
			return array();
		}
	}

	public function getOrderInfo($order_id = 0)
	{
		$row = \App\Models\OrderInfo::from('order_info as o')->select('o.order_sn', 'o.drp_is_separate', 'o.user_id')->leftjoin('order_goods as og', 'o.order_id', '=', 'og.order_id')->where('o.order_id', $order_id)->first();

		if ($row) {
			return $row->toArray();
		}
		else {
			return array();
		}
	}

	public function parentShopInfo($user_id = 0)
	{
		$user = \App\Models\Users::from('users as u')->select('u.drp_parent_id as user_id', 'ds.id as drp_shop_id')->leftjoin('drp_shop as ds', 'ds.user_id', '=', 'u.drp_parent_id')->where('u.user_id', $user_id)->first();

		if ($user) {
			return $user->toArray();
		}
		else {
			return array();
		}
	}

	public function getShopInfo($user_id = 0)
	{
		$user = \App\Models\Users::from('users as u')->select('u.user_id', 'ds.id as drp_shop_id')->leftjoin('drp_shop as ds', 'u.user_id', '=', 'ds.user_id')->where('ds.user_id', $user_id)->first();

		if ($user) {
			return $user->toArray();
		}
		else {
			return array();
		}
	}

	public function getUserName($user_id = 0)
	{
		return \App\Models\Users::where('user_id', $user_id)->value('user_name');
	}
}


?>
