<?php
namespace YFF\Framework;

use YFF\Framework\Core;
use YFF\Framework\Base;

class Initialize {

    public $conf;
    public $mode = null;
    public $di = null;
    const TOOL_MODE = 'ToolApp';
    const WEB_MODE = 'WebApp';

    public function __construct(){
        require_once FRAME_ROOT . '/core/Loader.php';
        $loader = Core\Loader::init();
        require_once FRAME_ROOT . '/core/Service.php';
        $this->di = Core\Di::init();
//        Core\Conf::load(MAIN_CONF_ROOT);  //加载所有配置
    }

    public function run () {
      $timer = new Core\Timer();
      $timer->start('frame_loader');
      $this->registerDiService();
      $this->process(!empty($argv) ? self::TOOL_MODE : self::WEB_MODE);
      $timer->end('frame_loader');
      echo $timer->getRunTime('frame_loader');
    }

    private function registerDiService () {
      $this->di->set('initialize', function () {
          return $this;
      });
      
      $this->di->set('errorHandler', function() {
          return Core\Error::init(1,2);
      });
    }

    //app处理模式按情况来定
    private function process ($mode) {
      if ($mode == self::TOOL_MODE) {
        $modeApp = new Core\ToolApp($this->di);
      } else {
        $modeApp = new Core\WebApp($this->di);
      }
      $modeApp->bootstrap();
    }
}
