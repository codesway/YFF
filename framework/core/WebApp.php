<?php

namespace YFF\Framework\Core;

use YFF\Framework\Core\BaseApp;
use YFF\Framework\Initialize;
use YFF\Framework\Core\FilterHandler;
use YFF\Framework\Core\Conf;

class WebApp extends BaseApp{


  public $initialize = null;

  public $filterHandle = null;

  public function __construct(Initialize $Initialize) {
    parent::__construct();
    $this->initialize = $Initialize;
    $this->filterHandle = new FilterHandler($this->initialize);
    $this->filterHandle->init(Conf::get('filters'));
  }

  public function bootstrap () {
    parent::run();
    exit( 'YFF is load ok');
    if (false === $this->filterHandler->execute('init')) {
        return;
    }

    if (false === $this->filterHandler->execute('input')) {
        return;
    }

    if (false === $this->filterHandler->execute('url')) {
        return;
    }
    // 非后台任务才有输出
    if (false === $this->filterHandler->execute('output')) {
        return;
    }

  }


  public function __destruct() {

  }
}
