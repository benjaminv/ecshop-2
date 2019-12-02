<?php
/*运营推荐在线升级版联系QQ97908527*/
namespace App\Http\Proxy;

class ShippingProxy
{
	protected $client;
	protected $config = array();

	public function __construct()
	{
		$root = dirname(dirname(dirname(__DIR__)));

		if (file_exists($root . '/config/services.php')) {
			$services = require $root . '/config/services.php';
			$this->config = $services['kd100'];
		}

		$this->client = new \GuzzleHttp\Client();
	}

	public function getExpress($com = '', $num = '')
	{
		$key = $this->config['key'];

		if (empty($key)) {
			return $this->basic($com, $num);
		}
		else {
			return $this->advanced($com, $num);
		}
	}

	protected function advanced($com = '', $num = '')
	{
		$url = 'http://poll.kuaidi100.com/poll/query.do';
		$key = $this->config['key'];
		$customer = $this->config['customer'];
		$post_data['customer'] = $customer;
		$post_data['param'] = '{"com":"' . $com . '","num":"' . $num . '"}';
		$post_data['sign'] = strtoupper(md5($post_data['param'] . $key . $post_data['customer']));
		$response = $this->client->post($url, array('form_params' => $post_data));
		$content = str_replace('"', '"', $response->getBody()->getContents());
		$result = json_decode($content, true);
		if (isset($result['status']) && $result['status'] === '200') {
			return array('error' => 0, 'data' => $result['data']);
		}
		else {
			return array('error' => 1, 'data' => $result['message']);
		}
	}

	protected function basic($com = '', $num = '')
	{
		$url = 'aHR0cHM6Ly9zcDAuYmFpZHUuY29tLzlfUTRzalc5MVFoM290cWJwcG5OMkRKdi9wYWUvY2hhbm5lbC9kYXRhL2FzeW5jcXVyeT9hcHBpZD00MDAxJmNvbT0lcyZudT0lcw==';
		$url = sprintf(base64_decode($url), $com, $num);
		$response = $this->client->get($url, $this->defaultOptions());
		$res = json_decode($response->getBody()->getContents(), true);
		$context = array();

		if (isset($res['data']['info']['context'])) {
			$context = $res['data']['info']['context'];

			foreach ($context as $k => $v) {
				$context[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
				$context[$k]['context'] = $v['desc'];
				unset($context[$k]['desc']);
			}
		}

		$result = array('error_code' => $res['error_code'], 'msg' => $res['msg'], 'data' => $context);
		if (isset($result['error_code']) && $result['error_code'] === '0') {
			return array('error' => 0, 'data' => $result['data']);
		}
		else {
			return array('error' => 1, 'data' => $result['msg']);
		}
	}

	protected function defaultOptions()
	{
		return array(
			'headers' => array('User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.' . time(), 'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8', 'Accept-Encoding' => 'gzip, deflate, br', 'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8,zh-TW;q=0.7', 'Cache-Control' => 'no-cache', 'Connection' => 'keep-alive', 'Cookie' => 'BAIDUID=751A380F4F4F8FB7F348EB4E64E9FACF:FG=1', 'Host' => 'sp0.baidu.com', 'Pragma' => 'no-cache', 'Upgrade-Insecure-Requests' => '1')
		);
	}
}


?>
