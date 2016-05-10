<?php

namespace YFF\Framework\Core;

use YFF\Framework\Core\BaseApp;
use YFF\Framework\Initialize;
use YFF\Framework\Core\FilterHandler;
use YFF\Framework\Core\Conf;

class WebApp extends BaseApp{


  public $initialize = null;

  public $filterHandler = null;
  public $di = null;
  public function __construct($di) {
    parent::__construct($di);
    $this->di = $di;
    $this->di->set('filterHandler', function () {
      $filterHandler = new FilterHandler();
      $filterHandler->init(Conf::get('filters'));
      return $filterHandler;
    });
  }

  public function bootstrap () {
    parent::run();
    print_r($this->di->filterHandler->execute('init')); 
    exit('YFF is runing!');
  }


  public function __destruct() {

  }
}
