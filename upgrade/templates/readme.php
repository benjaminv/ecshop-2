<?php
/*运营推荐在线升级版联系QQ97908527*/
echo '<html>
<head>
<title> ';
echo $lang['readme_title'];
echo ' </title>
<meta http-equiv="Content-Type" content="text/html; charset=';
echo $ec_charset;
echo '" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
</head>

<body class="body">
<div class="main">
';
include ROOT_PATH . 'upgrade/templates/header.php';
echo '
<div id="wrapper" class="wrapper">
<fieldset>
	<legend>';
echo $lang['method'];
echo '<i class="r"></i><i class="b"></i></legend>
    <p class="tit">';
printf($lang['notice'], $new_version);
echo '</p>
    <ul class="list">
        <li>1、';
echo $lang['usage1'];
echo '</li>
        <li>2、';
echo $lang['usage2'];
echo '</li>
        <li>3、';
printf($lang['usage3'], $old_version);
echo '</li>
        <li>4、';
printf($lang['usage4'], $new_version);
echo '</li>
        <li>5、';
echo $lang['usage5'];
echo '</li>
        <li>6、';
echo $lang['usage6'];
echo '</li>
    </ul>
</fieldset>
<div class="btn_info mt50 mb20">
    <input type="submit" id="js-submit" class="button" value="';
echo $lang['next_step'];
echo $lang['check_system_environment'];
echo '" onClick="top.location=\'index.php?step=check&ui=';
echo $ui;
echo '\'" />
</div>
<fieldset>
	<legend>';
echo $lang['faq'];
echo '<i class="r"></i><i class="b"></i></legend>
    <iframe src="templates/faq_';
echo $updater_lang;
echo '_';
echo $ec_charset;
echo '.htm" width="100%" height="500"></iframe>
</fieldset>
</div>
';
include ROOT_PATH . 'upgrade/templates/copyright.php';
echo '</div>
</body>
</html>
';

?>
