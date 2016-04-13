<?php
namespace YFF\Framework;
use YFF\Framework\Core;
use YFF\Framework\Base;
//初始化框架内核,ac需要引入此类

class Initialize {

    public function __construct(){
        // conf加载进来后来要做自动加载的文件,合并到一起

    }

    public function run () {
        include_once 'core/Loader.php';
        Core\Loader::init();
        $conf = new Core\Conf();
        print_r($conf);exit();
    }
}