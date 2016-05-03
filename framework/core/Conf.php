<?php
namespace YFF\Framework\Core;


class Conf {

    private static $isLoaded = array();
    private static $confData = array();

    public static function _init () {

    }

    public static function load($paths) {
      if (!is_array($paths)) {
        $paths = array($paths);
      }
      foreach ($paths as $path) {
        if (is_file($path)) {
          self::loadFile($path);
        } else if (is_dir($path)){
          self::loadDir($path);
        } else {
          throw new Exception('conf.load:file not exists');
        }
      }
    }

    private static function loadFile ($file) {
      if (isset(self::$isLoaded[$file])) {
          return true;
      }
      if (!is_readable($file)) {
        throw new Exception('conf.load:file not readable');
      }
      require_once $file;
      self::$isLoaded[$file] = true;
    }

    //只读取当前目录，不能递归
    private static function loadDir ($dir) {
      $dir = rtrim($dir, '/') . '/';
      $pathDir = scandir ($dir);
      $files = array_filter($pathDir, function ($file) use ($dir) {
        return (is_file($dir . $file) && is_readable($dir . $file));
      });

      foreach ($files as $file) {
        if (isset(self::$isLoaded[$dir . $file])) {
            continue;
        }
        require_once $dir . $file;
        self::$isLoaded[$dir . $file] = true;
      }
    }


    public static function get($key,$default=null){
        if (isset(self::$confData[$key])) {
            return self::$confData[$key];
        }
        return $default;
    }

    public static function set($key,$value){
      self::$confData[$key] = $value;
    }

    public static function getIncludePath() {
      return self::$isLoaded;
    }

    public static function clear(){
        self::$isLoaded = array();
        self::$confData = array();
    }

}
