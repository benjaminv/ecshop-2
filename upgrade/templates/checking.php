<?php
/*运营推荐在线升级版联系QQ97908527*/
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';
echo $ec_charset;
echo '" />
<title>';
echo $lang['checking_title'];
echo '</title>
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/transport.js" charset="';
echo EC_CHARSET;
echo '"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/draggable.js"></script>
<script type="text/javascript" src="js/check.js"></script>
<script type="text/javascript">
var $_LANG = {};
';

foreach ($lang['js_languages'] as $key => $item) {
	echo '$_LANG["';
	echo $key;
	echo '"] = "';
	echo $item;
	echo '";
';
}

echo '</script>
</head>
<body id="checking" class="body">
<div class="main">
';
include ROOT_PATH . 'upgrade/templates/header.php';
echo '<form method="post">
<div id="wrapper" class="wrapper checking">
    <fieldset>
        <legend>';
echo $lang['basic_config'];
echo '<i class="r"></i><i class="b"></i></legend>
        <ul class="list">
			';

foreach ($config_info as $config_item) {
	echo '            <li>
				<span class="detail">';
	echo $config_item[0];
	echo '</span>
                <span class="route green">';
	echo $config_item[1];
	echo '</span>
            </li>
			';
}

echo '        </ul>
    </fieldset>
    
    <fieldset>
        <legend>';
echo $lang['dir_priv_checking'];
echo '<i class="r"></i><i class="b"></i></legend>
        <ul class="list">
			';

foreach ($dir_checking as $checking_item) {
	echo '            <li>
				<span class="detail">';
	echo $checking_item[0];
	echo '</span>
				';

	if ($checking_item[1] == $lang['can_write']) {
		echo '                <span class="route green">';
		echo $checking_item[1];
		echo '</span>
                ';
	}
	else {
		echo '                <span class="route red">';
		echo $checking_item[1];
		echo '</span>
                ';
	}

	echo '            </li>
            ';
}

echo '        </ul>
    </fieldset>
    
    <fieldset>
        <legend>';
echo $lang['template_writable_checking'];
echo '<i class="r"></i><i class="b"></i></legend>
        <ul class="list">
			';

if ($has_unwritable_tpl == 'yes') {
	echo '            ';

	foreach ($template_checking as $checking_item) {
		echo '            <li>
            	<span class="route red">';
		echo $checking_item;
		echo '</span>
            </li>    
            ';
	}

	echo '            ';
}
else {
	echo '            <li class="success">
            	<span class="green">';
	echo $template_checking;
	echo '</span>
            </li>
            ';
}

echo '        </ul>
    </fieldset>
    
    ';

if (!empty($rename_priv)) {
	echo '    <fieldset>
        <legend>';
	echo $lang['rename_priv_checking'];
	echo '<i class="r"></i><i class="b"></i></legend>
        <ul class="list">
			';

	foreach ($rename_priv as $checking_item) {
		echo '            <li><span class="route red">';
		echo $checking_item;
		echo '</span></li>
            ';
	}

	echo '        </ul>
    </fieldset> 
    ';
}

echo '    
    <div class="btn_info mt50 mb20" id="install-btn">
        <input type="button" class="button mr15" value="';
echo $lang['prev_step'];
echo $lang['readme_page'];
echo '" onclick="location.href=\'index.php\'" />
        <input type="button" class="button mr15" value="';
echo $lang['recheck'];
echo '" onclick="location.href=\'index.php?step=check\'" />
        <input type="button" class="button" value="';
echo $lang['update_now'];
echo '" ';
echo $disabled;
echo ' id="js-submit" />
    </div>
    
    <div id="js-monitor_bg" class="js-monitor_bg"></div>
    <div id="js-monitor">
    	<div class="loading_bg">
    		<img id="js-monitor-loading" src=\'images/loading.gif\' />
        </div>
        <div class="con">
    	<fieldset>
            <legend id="js-monitor-title">';
echo $lang['monitor_title'];
echo '<i class="r"></i><i class="b"></i></legend>
            <div class="head_title">
                <span id="js-monitor-wait-please" class="please"></span>
                <span id="js-monitor-rollback" class="rollback hide"></span>
                <i id="js-monitor-view-detail" class="view"></i>
            </div>
            <iframe id="js-monitor-notice" src="templates/notice.htm" height="70px" width="100%" style="display:none;"></iframe>
            <a href="javascript:void(0);" id="js-monitor-close" class="js-monitor-close"></a>
        </fieldset>
        </div>
    </div>
</div>

<div id="copyright">
    <div id="copyright-inside">
      ';
include ROOT_PATH . 'upgrade/templates/copyright.php';
echo '</div>
</div>
</form>
</div>
</body>
</html>
';

?>
