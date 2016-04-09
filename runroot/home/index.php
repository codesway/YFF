<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('APP_PATH', realpath('../../'));
$config = include_once APP_PATH . '/apps/home/config/config.php';
include APP_PATH . '/apps/mobile/config/router.php';
include APP_PATH . '/apps/mobile/config/loader.php';
include APP_PATH . '/apps/config/service.php';
try {
    $application->init();
    $application->run();
}catch (exception $e) {
    echo $e->getMessage();
}
