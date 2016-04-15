<?php
namespace YFF\Framework;

use YFF\Framework\Core;
use YFF\Framework\Base;
//初始化框架内核,ac需要引入此类

class Initialize {

    private $conf;

    public function __construct($mode = 'web'){
        require_once FRAME_ROOT . 'core/Loader.php';
        Core\Loader::init();
        Core\Conf::load(MAIN_CONF_ROOT);  //加载所有配置
    }

    public function run () {
        $timer = new Core\Timer();
        $timer->start('frame_loader');
        Core\Service::init();   //注册依赖服务
        $error = Core\Error::init(1,2);
        $timer->end('frame_loader');
        echo $timer->getRunTime('frame_loader');
//        print_r($error);exit();
    }
}