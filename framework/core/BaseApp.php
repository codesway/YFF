<?php

namespace YFF\Framework\Core;

class BaseApp {
  protected $di = null;
  
  protected function __construct ($di) {
    $this->di = $di;
  }


  protected function run() {

  }

}
