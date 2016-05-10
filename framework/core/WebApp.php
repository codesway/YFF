<?php

namespace YFF\Framework\Core;

use YFF\Framework\Core\BaseApp;
use YFF\Framework\Initialize;
use YFF\Framework\Core\FilterHandler;
use YFF\Framework\Core\Conf;

class WebApp extends BaseApp{


  public $initialize = null;

  public $filterHandler = null;

  public function __construct($di) {
    parent::__construct($di);

    $this->di->set('filterHandler', function () {
      $filterHandler = new FilterHandler();
      $filterHandler->init(Conf::get('filters'));
      return $filterHandler;
    });
  }

  public function bootstrap () {
    parent::run();
    exit('YFF is runing !');
    // $filter = $this->di->get('filterHandler')->getRunStep();
    // foreach ($filter as $step) {
    //   if (flase === $this->di->get('filterHandler')->execute($step)) {
    //     return ;
    //   }
    // }
    // $bootstrap = $this->di->filterHandler->getRunStep();
    // print_r($bootstrap); exit();
    // if (false === $this->di->filterHandler->execute->('init')) {
    //     return;
    // }
    //
    // if (false === $this->di->filterHandler->execute->('input')) {
    //     return;
    // }
    //
    // if (false === $this->di->filterHandler->execute->('url')) {
    //     return;
    // }
    //
    // // 非后台任务才有输出
    // if (false === $this->di->filterHandler->execute->('output')) {
    //     return;
    // }

  }


  public function __destruct() {

  }
}
