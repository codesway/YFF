<?php

namespace YFF\Framework\Core;

class Di {

  public static $di = null;

  public static $ioc = [];

  private function __construct() {

  }

  public static function init () {
    if (self::$di) {
      return self::$di;
    }
    self::$di = new self;
    return self::$di;
  }

  public function set($k, $c){
    self::$ioc[$k] = $c;
  }

  public static function getIoc() {
    return self::$ioc;
  }

  public function __get($k) {
    $obj = self::$ioc[$k];
    return $obj();
  }


}
