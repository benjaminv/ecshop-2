<?php

define('BIND_MODULE', 'Qrpay');
define('BIND_CONTROLLER', 'Index');
define('BIND_ACTION', 'notify');
$_GET['code'] = basename(__FILE__, '.php');
require __DIR__ . '/../../index.php';
