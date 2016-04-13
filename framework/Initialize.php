<?php
namespace YFF\Framework;

use YFF\Framework\Core;
use YFF\Framework\Base;
//初始化框架内核,ac需要引入此类

class Initialize {

    public function __construct(){
        // conf加载进来后来要做自动加载的文件,合并到一起
        require_once FRAME_ROOT . 'core/Loader.php';
        Core\Loader::init();
    }

    public function run () {
        $timer = new Core\Timer();
        $timer->start('frame_loader');
        $error = Core\Error::init(1,2);
        $conf = new Core\Conf();
        sleep(1);
        $timer->end('frame_loader');
        echo $timer->getRunTime('frame_loader');
//        print_r($error);exit();
    }
}