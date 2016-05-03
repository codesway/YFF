<?php

namespace YFF\Framework\Core;
use YFF\Framework\Core\BaseApp;

class WebApp extends BaseApp{


  public $initialize = null;

  public function __construct(Initialize $Initialize) {
    $this->initialize = $Initialize;
    parent::__construct();
  }

  public function init () {
    parent::init($this, $filters);
  }

  public function run () {
    parent::run();
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
