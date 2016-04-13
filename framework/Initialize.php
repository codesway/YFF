<?php
namespace YFF\Framework;
use YFF\Framework\Core\Loader;
use YFF\Framework\Base;
//初始化框架内核,ac需要引入此类

define('CORE_ROOT', dirname(__FILE__) . '/core/');
class Initialize {

    public static $room = [
//        'base' => ['room_path' => CORE_ROOT],
        'core' => ['room_path' => CORE_ROOT],
//        'conf' => ['room_path' => 'base/'],
//        'func' => ['room_path' => 'func/'],
    ];


    public function __construct(){

    }

    public function run () {
        include_once 'core/Loader.php';
        Loader::init(self::$room);
//        $db = new Base/DB();
//        print_r($db);
        $conf = new Conf();
//        print_r($conf);
    }
}