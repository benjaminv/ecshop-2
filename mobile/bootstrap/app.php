<?php
/*运营推荐在线升级版联系QQ97908527*/
define('IN_ECTOUCH', true);
define('APPNAME', 'ECTouch');
define('VERSION', 'v2.7.3.4');
define('CHARSET', 'utf-8');
define('ROOT_PATH', str_replace('\\', '/', dirname(__DIR__)) . '/');
define('PATH_HASH', substr(md5(ROOT_PATH), -6));
define('BASE_PATH', ROOT_PATH . 'app/');
define('APP_PATH', BASE_PATH . 'Modules/');
define('COMPONENT_PATH', BASE_PATH . 'Component/');
define('PLAYGROUND_PATH', BASE_PATH . 'Custom/');
define('ADDONS_PATH', BASE_PATH . 'Plugins/');
define('CONF_PATH', ROOT_PATH . 'config/');
define('LANG_PATH', ROOT_PATH . 'resources/lang/');
define('RUNTIME_PATH', ROOT_PATH . 'storage/framework/' . PATH_HASH . '/');
define('HTML_PATH', RUNTIME_PATH . 'views/');
define('LOG_PATH', ROOT_PATH . 'storage/logs/' . PATH_HASH . '/');
define('TMPL_PATH', ROOT_PATH . 'resources/views/');
define('PHP_SELF', isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);
define('BUILD_DIR_SECURE', false);
require BASE_PATH . 'Support/constant.php';
require __DIR__ . '/../vendor/Kernel.php';
require __DIR__ . '/../app/Support/helpers.php';
$dbconf = require CONF_PATH . 'dbconf.php';
$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection(array('driver' => $dbconf['db_type'], 'host' => $dbconf['db_host'], 'port' => $dbconf['db_port'], 'database' => $dbconf['db_name'], 'username' => $dbconf['db_user'], 'password' => $dbconf['db_pwd'], 'charset' => $dbconf['db_charset'], 'collation' => 'utf8_general_ci', 'prefix' => $dbconf['db_prefix'], 'strict' => false));

try {
	$capsule->setAsGlobal();
	$capsule->bootEloquent();
}
catch (Exception $e) {
	exit($e->getMessage());
}

?>
