<?php
/*运营推荐在线升级版联系QQ97908527*/
function instheader()
{
	global $charset;
	global $tools_version;
	echo '<html><head>' . ('<meta http-equiv="Content-Type" content="text/html; charset=' . $charset . '">') . ('<title>UCenter 会员数据导入工具' . $tools_version . '</title>') . '<link href="styles/general.css" rel="stylesheet" type="text/css" />' . '<script type="text/javascript">
        function redirect(url) {
            window.location=url;
        }
        function $(id) {
            return document.getElementById(id);
        }
        </script>
        </head>' . '<body class="body"><div class="main">';
	include ROOT_PATH . 'upgrade/templates/header.php';
	echo '<div id="append_parent"></div>' . '<div class="wrapper">' . ('<div class="tit_install">UCenter 会员数据导入工具' . $tools_version . '</div>') . '<div class="content">';
}

function instfooter()
{
	echo '</div></div>' . '<div class="footer"><p>&copy; 2005-2016 <a href="http://www.ecmoban.com" target="_blank">上海商创网络科技有限公司</a>。保留所有权利。</p></div>' . '</div></body></html>';
}

function showmessage($message, $url_forward = '', $msgtype = 'message', $extra = '', $delaymsec = 1000)
{
	if ($msgtype == 'form') {
		$message = '<form method="post" action="' . $url_forward . '" name="hidden_form">' . ('<br><p class="p_indent">' . $message . '</p>
 ' . $extra . '</form><br>') . '<script type="text/javascript">
            setTimeout("document.forms[\'hidden_form\'].submit()", ' . $delaymsec . ');
        </script>';
	}
	else {
		if ($url_forward) {
			$message .= '<script>setTimeout("redirect(\'' . $url_forward . '\');", ' . $delaymsec . ');</script>';
			$message .= '<br><div align="right">[<a href="' . $script_name . '" style="color:red">停止运行</a>]<br><br><a href="' . $url_forward . '">如果您的浏览器长时间没有自动跳转，请点击这里！</a></div>';
		}
		else {
			$message .= '<br /><br /><br />';
		}

		$message = '<br>' . $message . $extra . '<br><br>';
	}

	echo $message;
	instfooter();
	exit();
}

function get_mysql_charset()
{
	global $db;
	global $prefix;
	$tmp_charset = '';
	$query = $db->query('SHOW CREATE TABLE `' . $prefix . 'users`', 'SILENT');

	if ($query) {
		$tablestruct = $db->fetch_array($query, MYSQL_NUM);
		preg_match('/CHARSET=(\\w+)/', $tablestruct[1], $m);

		if (!empty($m)) {
			if (strpos($m[1], 'utf') === 0) {
				$tmp_charset = str_replace('utf', 'utf-', $m[1]);
			}
			else {
				$tmp_charset = $m[1];
			}
		}
	}

	return $tmp_charset;
}

function getgpc($k, $var = 'G')
{
	switch ($var) {
	case 'G':
		$var = &$_GET;
		break;

	case 'P':
		$var = &$_POST;
		break;

	case 'C':
		$var = &$_COOKIE;
		break;

	case 'R':
		$var = &$_REQUEST;
		break;
	}

	return isset($var[$k]) ? $var[$k] : NULL;
}

$charset = 'utf-8';
$tools_version = 'v1.0';
$mysql_version = '';
$ecshop_version = '';
$mysql_charset = '';
$ecshop_charset = '';
$convert_charset = array('utf-8' => 'gbk', 'gbk' => 'utf-8');
$convert_tables_file = 'data/convert_tables.php';
$rpp = 500;
define('ROOT_PATH', str_replace('\\', '/', substr(__FILE__, 0, -20)));
define('IN_ECS', true);
require ROOT_PATH . 'data/config.php';
require ROOT_PATH . 'includes/cls_ecshop.php';
require ROOT_PATH . 'includes/cls_mysql.php';
require ROOT_PATH . 'includes/lib_common.php';

if (defined('EC_CHARSET')) {
	$ec_charset = EC_CHARSET;
}
else {
	$ec_charset = '';
}

$ecshop_version = str_replace('v', '', VERSION);
$ecshop_charset = $ec_charset;
$db = new cls_mysql($db_host, $db_user, $db_pass, $db_name, '', 0, 1);
$mysql_version = $db->version;
$mysql_charset = get_mysql_charset();
$step = getgpc('step');
$step = empty($step) ? 1 : $step;

if ($ecshop_version < '2.6.0') {
	$step = 'halt';
}

if (!defined('UC_DBUSER') && !defined('UC_DBPW') && !defined('UC_DBNAME')) {
	$uc_config = $db->getOne('SELECT value FROM ' . $prefix . 'shop_config WHERE code=\'integrate_config\'');
	$uc_config = unserialize($uc_config);
	if (!empty($uc_config['db_user']) && !empty($uc_config['db_pass']) && !empty($uc_config['db_name'])) {
		define('UC_CONNECT', $uc_config['uc_connect']);
		define('UC_DBHOST', $uc_config['db_host']);
		define('UC_DBUSER', $uc_config['db_user']);
		define('UC_DBPW', $uc_config['db_pass']);
		define('UC_DBNAME', $uc_config['db_name']);
		define('UC_DBCHARSET', $uc_config['db_charset']);
		define('UC_DBTABLEPRE', '`' . $uc_config['db_name'] . '`.' . $uc_config['db_pre']);
		define('UC_DBCONNECT', '0');
		define('UC_KEY', $uc_config['uc_key']);
		define('UC_API', $uc_config['uc_url']);
		define('UC_CHARSET', $uc_config['uc_charset']);
		define('UC_IP', $uc_config['uc_ip']);
		define('UC_APPID', $uc_config['uc_id']);
		define('UC_PPP', '20');
	}
	else {
		$step = 'halt';
	}
}

ob_start();
instheader();

if ($step == 1) {
	$ext_msg = '<a href="?step=start"><font size="3" color="red"><b>&gt;&gt;&nbsp;如果您已确认上面的使用说明,请点这里进行导入</b></font></a><br /><br /><a href="index.php"><font size="2"><b>&gt;&gt;&nbsp;如果您需要执行升级程序，请点这里进行升级</b></font></a>';
	echo '<h4>本转换程序只能针ECShop2.6.0或者以上版本程序的数据导入<br /></h4>
导入之前<b>务必备份数据库资料</b>，避免导入失败给您带来损失与不便<br /><br />

<p>导入程序使用说明：</p>
<ol>
    <li>只支持从UCenter数据库到ECShop数据库的导入</li>
    <li>只导入会员的用户名、邮箱、密码，这些基本信息。不会破坏原有会员数据</li>
</ol>

<p>您当前程序与数据库的信息：</p>
<ul>
    <li>程序版本：' . $ecshop_version . '</li>
    <li>程序编码：' . $ecshop_charset . '</li>
    <li>MySQL版本：' . $mysql_version . '</li>
    <li>MySQL编码：' . $mysql_charset . '</li>
</ul>
' . $ext_msg;
	instfooter();
}
else if ($step == 'halt') {
	echo '	<fieldset>
	<legend>出错了！</legend>
	<ul class="list">
		<li>您当前的程序版本小于2.6.0；</li>
		<li>您的配置文件与数据表中缺少UCenter的配置信息。</li>
	</ul>
	</fieldset>
    <div class="tishi mt30"><span>请先升级您的程序再进行导入。</span></div>';
	instfooter();
}
else if ($step == 'start') {
	$limit = getgpc('limit', 'P');
	$update = getgpc('update', 'P');
	$insert = getgpc('insert', 'P');
	$success = getgpc('success', 'P');
	$error = getgpc('error', 'P');
	$item_num = 500;
	$statistics = array('update' => 0, 'insert' => 0, 'success' => 0, 'error' => 0);

	if (empty($limit)) {
		$limit = 0;
	}

	$uc_db = new cls_mysql(UC_DBHOST, UC_DBUSER, UC_DBPW, UC_DBNAME, UC_DBCHARSET, 0, 1);
	$total_members = $uc_db->getOne('SELECT COUNT(*) FROM ' . UC_DBTABLEPRE . 'members');
	$sql = 'SELECT uid, username, password, email, salt FROM ' . UC_DBTABLEPRE . ('members ORDER BY uid ASC LIMIT ' . $limit . ', ' . $item_num);
	$uc_query = $uc_db->query($sql);

	while ($member = $uc_db->fetch_array($uc_query)) {
		$user_exists = $db->getOne('SELECT COUNT(*) FROM ' . $prefix . 'users WHERE `user_name`=\'' . $member['username'] . '\'');

		if (!$user_exists) {
			$sql = 'INSERT INTO ' . $prefix . 'users (`email`, `user_name`, `password`, `salt`) VALUES(\'' . $member['email'] . '\', \'' . $member['username'] . '\', \'' . $member['password'] . '\', \'2' . $member['salt'] . '\')';
			++$statistics['insert'];
		}
		else {
			$sql = 'UPDATE ' . $prefix . 'users SET `password`=\'' . $member['password'] . '\', `salt`=\'2' . $member['salt'] . '\' WHERE `user_name`=\'' . $member['username'] . '\'';
			++$statistics['update'];
		}

		$db->query($sql);

		if (0 < $db->affected_rows()) {
			++$statistics['success'];
		}
		else {
			++$statistics['error'];
		}
	}

	if ($total_members < $limit + $item_num) {
		$update += $statistics['update'];
		$insert += $statistics['insert'];
		$success += $statistics['success'];
		$error += $statistics['error'];
		$message = '<p>共有 <strong>' . $total_members . '</strong> 个会员数据</p><p>导入完成！</p><p><ul><li>更新的用户数据：' . $update . ' 条</li><li>新增的用户数据：' . $insert . ' 条</li><li>成功的用户数据：' . $success . ' 条</li><li>出错的用户数据：' . $error . ' 条</li></ul></p><p><a href="index.php"><b>&gt;&gt;&nbsp;如果您需要执行升级程序，请点这里进行升级</b></a></p>';
		showmessage($message);
	}
	else {
		$update += $statistics['update'];
		$insert += $statistics['insert'];
		$success += $statistics['success'];
		$error += $statistics['error'];
		$total_item = $limit + $item_num;
		$extra = '<input type="hidden" name="update" value="' . $update . '" /><input type="hidden" name="insert" value="' . $insert . '" /><input type="hidden" name="success" value="' . $success . '" /><input type="hidden" name="error" value="' . $error . '" /><input type="hidden" name="limit" value="' . $total_item . '" />';
		$message = '<p>共有 <strong>' . $total_members . '</strong> 个会员数据</p><p>当前在导入 ' . $limit . ' - ' . $total_item . ' 的会员数据</p><p><ul><li>更新的用户数据：' . $update . ' 条</li><li>新增的用户数据：' . $insert . ' 条</li><li>成功的用户数据：' . $success . ' 条</li><li>出错的用户数据：' . $error . ' 条</li></ul></p>';
		showmessage($message, '?step=start', 'form', $extra);
	}
}

ob_end_flush();

?>
