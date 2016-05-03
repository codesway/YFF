<?php

namespace YFF\Framework\Core;

class BaseApp {

  protected function __construct () {

  }

  protected function init($app, $filters) {
    $filterHandler = new FilterHandler();
    $filterHandler->init($filters);
    $this->filterHandler = $filterHandler;
  }

  protected function run() {

  }

}
