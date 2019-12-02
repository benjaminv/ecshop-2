<?php
/*运营推荐在线升级版联系QQ97908527*/
class DatabaseSeeder extends \Illuminate\Database\Seeder
{
	public function run()
	{
		$this->call('MobileModuleSeeder');
		$this->call('WechatModuleSeeder');
		$this->call('DRPModuleSeeder');
		$this->call('TeamModuleSeeder');
		$this->call('BargainModuleSeeder');
		$this->call('WeappModuleSeeder');
		$this->call('OrderRuIdSeeder');
	}
}

?>
