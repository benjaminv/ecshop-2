<?php
/*运营推荐在线升级版联系QQ97908527*/
echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>';
echo $lang['upgrade_error_title'];
echo '</title>
<meta http-equiv="Content-Type" content="text/html; charset=';
echo $ec_charset;
echo '" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
</head>

<body class="body">
<div class="main">
	';
include ROOT_PATH . 'upgrade/templates/header.php';
echo '    <div class="wrapper">
        <div class="w_content">
            ';
echo $err_msg;
echo '        </div>
    </div>
    ';
include ROOT_PATH . 'upgrade/templates/copyright.php';
echo '</div>
</body>
</html>';

?>
