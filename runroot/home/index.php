<?php
use YFF\Framework\Initialize;
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('ROOT', realpath('../../'));
require_once ROOT . '/framework/Define.php';   //系统常量
require_once FRAME_ROOT . '/Initialize.php';   //框架入口
$app = new Initialize();
$app->run();

//
//$config = include_once APP_PATH . '/apps/home/config/config.php';
//include APP_PATH . '/apps/mobile/config/router.php';
//include APP_PATH . '/apps/mobile/config/loader.php';
//include APP_PATH . '/apps/config/service.php';
//try {
//    $application->init();
//    $application->run();
//}catch (exception $e) {
//    echo $e->getMessage();
//}
