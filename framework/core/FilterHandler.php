<?php

namespace YFF\Framework\Core;

class FilterHandler {

  private $importFilters = [];

  public function __construct () {

  }

  public function init ($conf) {
    if (!empty($conf)) {
      foreach ($conf as $type => $filterConf) {
        $this->importFilters[$type] = new $filterConf;
      }
    }
  }

  public function execute() {

  }

}
