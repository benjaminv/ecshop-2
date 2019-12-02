<?php
/*运营推荐在线升级版联系QQ97908527*/
echo '<html>
<head>
<title> ';
echo $lang['select_language_title'];
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
	<div class="common-head">
        <a href="ucimport.php" class="btn">';
echo $lang['goto_members_import'];
echo '</a>
        <a href="convert.php" class="btn">';
echo $lang['goto_charset_convert'];
echo '</a>
    </div>
<form target="_parent" action="" method="post">
<fieldset>
    <legend dir="ltr">';
echo $lang['lang_select'];
echo '<i class="r"></i><i class="b"></i></legend>
    <div class="items">
    	<div class="item">
        	<div class="label">';
echo $lang['lang_title'];
echo '：</div>
            <div class="value">
            	<select dir="ltr" onchange="this.form.submit();" name="lang" style="width:300px;">
				';

foreach ($lang['lang_charset'] as $key => $val) {
	if ($updater_lang . '_' . $ec_charset == $key) {
		$lang_selected = 'selected="selected" ';
	}
	else {
		$lang_selected = '';
	}

	echo '                		<option ';
	echo $lang_selected;
	echo 'value="';
	echo $key;
	echo '">';
	echo $val;
	echo '</option>
                ';
}

echo '                </select>
            </div>
        </div>
    	<div class="item">
        	<div class="label">';
echo $lang['ui_title'];
echo '：</div>
            <div class="value">
            	<div class="checkbox_items">
                	<div class="checkbox_item">
                    	<input type="radio" id="ui_1" name="ui" value="ecshop" class="ui_radio" checked="checked" />
                        <label for="ui_1" class="ui_radio_label">';
echo $lang['ui_ordinary'];
echo '</label>
                    </div>
                    <div class="checkbox_item">
                    	<input type="radio" id="ui_2" name="ui" value="ucenter" class="ui_radio" />
                        <label for="ui_2" class="ui_radio_label">';
echo $lang['ui_ucenter'];
echo '</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
</form>
<form target="_parent" action="" method="post">
    <fieldset>
        <legend>';
echo $lang['lang_description'];
echo '<i class="r"></i><i class="b"></i></legend>
        <ul class="list">
            ';
$i = 1;

foreach ($lang['lang_desc'] as $desc) {
	echo '            <li>';
	echo $i;
	$i++;
	echo '、';
	echo $desc;
	echo '</li>
            ';
}

echo '        </ul>
    </fieldset>
    <div class="btn_info mt50 mb20">
        <input type="hidden" name="step" value="readme" />
        <input type="hidden" name="lang" value="';
echo $updater_lang . '_' . $ec_charset;
echo '" />
        <input type="submit" class="button" value="';
echo $lang['next_step'];
echo $lang['readme_page'];
echo '" />
    </div>
</form>

</div>

';
include ROOT_PATH . 'upgrade/templates/copyright.php';
echo '</div>
</body>
</html>
';

?>
