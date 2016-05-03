<?php
namespace YFF\Framework;

use YFF\Framework\Core;
use YFF\Framework\Base;
//初始化框架内核,ac需要引入此类

class Initialize {

    public $conf;
    public $mode = null;
    public $di = null;
    const TOOL_MODE = 'ToolApp';
    const WEB_MODE = 'WebApp';

    public function __construct(){
        require_once FRAME_ROOT . 'core/Loader.php';
        Core\Loader::init();
        Core\Conf::load(MAIN_CONF_ROOT);  //加载所有配置
    }

    public function run () {
      $timer = new Core\Timer();
      $timer->start('frame_loader');
      $this->process(!empty($argv) ? self::TOOL_MODE : self::WEB_MODE);
      $this->di = Core\Service::init();   //注册依赖服务
      Core\Error::init(1,2);
      print_r(Core\Conf::getIncludePath());
      $timer->end('frame_loader');
      echo $timer->getRunTime('frame_loader');
    }

    //app处理模式按情况来定
    private function process ($mode) {
      if ($mode == self::TOOL_MODE) {
        $modeApp = new Core\ToolApp($this);
      } else {
        $modeApp = new Core\WebApp($this);
      }
      $modeApp->init();
      $modeApp->run();
      print_r($modeApp);
    }
}
