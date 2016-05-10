<?php

namespace YFF\Framework\Core;

class FilterHandler {
  public static $filterStep = [
    'init', 'input', 'url', 'output',
  ];

  private $importFilters = [];

  public function __construct () {

  }

  public static function getRunStep() {
    return self::$filterStep;
  }

  public function init ($conf) {
    if (!empty($conf)) {
      foreach ($conf as $type => $filterConf) {
        $this->importFilters[$type] = new $filterConf;
      }
    } else {

    }

  }

  public function execute() {

  }

}
