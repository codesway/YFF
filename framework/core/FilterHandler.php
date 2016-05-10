<?php

namespace YFF\Framework\Core;
use YFF\Framework\Base\Filter;

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
      foreach (self::$filterStep as $default) {
        $className = ucfirst($default) . 'Filter';
        $this->importFilters[$default] = new $className();
      }
    }

  }

  public function execute($filter) {
    if (empty($this->importFilters[$filter])) {
      return false;
    }
    self::$importFilters[$filter]->before();
    self::$importFilters[$filter]->execute();
    self::$importFilters[$filter]->after();
  }

}
