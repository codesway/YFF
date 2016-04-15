<?php
namespace YFF\Framework\Core;

/**
 * Class Conf
 */
class Conf {

    private static $isLoaded = array();
    private static $confData = array();

    private static function _init () {

    }


    public static function load($paths) {
        self::_init();

        if (is_file($paths)) {
            require_once $paths;
            self::$isLoaded[$paths] = true;
        }

        foreach($paths as $path) {
            if (isset(self::$isLoaded[$path])) {
                continue;
            }
            if (is_readable($path)) {
                self::$isLoaded[$path] = true;
            } else {
                throw new Exception('conf.load:file not exists');
            }
        }
    }


    public static function get($key,$default=null){
        self::_init();
        if (isset(self::$confData[$key])) {
            return self::$confData[$key];
        }
        return $default;
    }

    public static function set($key,$value){
        self::$confData[$key] = $value;
    }

    public static function clear(){
        self::$isLoaded = array();
        self::$confData = array();
    }

}