<?php
/*运营推荐在线升级版联系QQ97908527*/
class OrderRuIdSeeder extends \Illuminate\Database\Seeder
{
	private $prefix;

	public function __construct()
	{
		$this->prefix = config('database.connections.mysql.prefix');
	}

	public function run()
	{
		$this->addFiled();
		$this->mainOrder();
		$this->order();
	}

	private function addFiled()
	{
		if (!\Illuminate\Support\Facades\Schema::hasColumn('order_info', 'ru_id')) {
			\Illuminate\Support\Facades\Schema::table('order_info', function(\Illuminate\Database\Schema\Blueprint $table) {
				$table->integer('ru_id')->unsigned()->default(0)->index('ru_id')->comment('商家ID（同dsc_users表user_id）');
			});
		}

		if (!\Illuminate\Support\Facades\Schema::hasColumn('order_info', 'main_count')) {
			\Illuminate\Support\Facades\Schema::table('order_info', function(\Illuminate\Database\Schema\Blueprint $table) {
				$table->smallInteger('main_count')->unsigned()->default(0)->index('main_count')->comment('子订单数量');
			});
		}
	}

	private function mainOrder()
	{
		$sql = 'SELECT o.order_id, o.order_sn, (SELECT COUNT(*) FROM ' . $this->prefix . 'order_info AS oi2 WHERE oi2.main_order_id = o.order_id) as main_count FROM ' . $this->prefix . 'order_info AS o ' . ' WHERE 1 having main_count > 0';
		$order_list = \Illuminate\Support\Facades\DB::select($sql);

		if ($order_list) {
			foreach ($order_list as $key => $val) {
				\Illuminate\Support\Facades\DB::table('order_info')->where('order_id', $val->order_id)->update(array('main_count' => $val->main_count));
			}
		}
	}

	private function order()
	{
		$no_main_order = ' AND (SELECT COUNT(*) FROM ' . $this->prefix . 'order_info AS oi2 WHERE oi2.main_order_id = o.order_id) = 0';
		$sql = 'SELECT o.order_id, o.order_sn FROM ' . $this->prefix . 'order_info AS o ' . ' WHERE (SELECT COUNT(*) FROM ' . $this->prefix . 'order_goods AS og WHERE o.order_id = og.order_id AND og.ru_id > 0) > 0 AND ru_id = 0 ' . $no_main_order;
		$order_list = \Illuminate\Support\Facades\DB::select($sql);

		if ($order_list) {
			foreach ($order_list as $key => $val) {
				$ru_id = \Illuminate\Support\Facades\DB::table('order_goods')->where('order_id', $val->order_id)->value('ru_id');
				\Illuminate\Support\Facades\DB::table('order_info')->where('order_id', $val->order_id)->update(array('ru_id' => $ru_id));
			}
		}
	}
}

?>
