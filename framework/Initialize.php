<?php
namespace YFF\Framework;
use YFF\Framework\Core;
use YFF\Framework\Base;
//初始化框架内核,ac需要引入此类

class Initialize {


    public static $room = [
        'base' => ['room_path' => ''],
        'core' => ['room_path' => ''],
        'conf' => ['room_path' => ''],
        'func' => ['room_path' => ''],
    ];


    public function __construct(){

    }

    public function run () {
        include_once 'core/Loader.php';
        Core\Loader::init(self::$room);
//        $db = new Base/DB();
//        print_r($db);
        $conf = new Conf();
    }
}