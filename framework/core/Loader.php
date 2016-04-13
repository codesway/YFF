<?php
namespace YFF\Framework\Core;

class Loader {

    public static $loader;

    public static function init($conf) {
        if (self::$loader == NULL) {
            self::$loader = new self ($conf);
        }
        return self::$loader;
    }

    private function __construct($conf) {
        self::setPath($conf);
        spl_autoload_register ( array ($this, 'load') );
    }


    private static function setPath($conf) {
        $path = array_column($conf, 'room_path');
        set_include_path(get_include_path() . ';' .implode(';', $path));
    }

    // 可以外部加载
    public static function register ($conf) {
        self::setPath($conf);
//        spl_autoload_register ( array ('Loader', 'load' ) );
    }

    private static function load ($class) {
        $class = substr($class, strrpos($class, '\\') + 1);
        $file = $class . '.php';
//        if (!file_exists($file)) {
//            throw new \Exception('Loader.load:file not exists');
//        }
//        include_once $file;
        print_r(get_include_path());exit();
        include_once $file;
    }
}