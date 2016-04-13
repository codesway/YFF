<?php
namespace YFF\Framework\Core;

class Loader {

    private static $loader;

    private static $_YYF_ROOT = [
        'base' => ['path' => ROOT . '/framework/base/'],
        'core' => ['path' => ROOT . '/framework/core/'],
        'conf' => ['path' => ROOT . '/framework/conf/'],
        'func' => ['path' => ROOT . '/framework/func/'],
    ];

    public static function init() {
        if (self::$loader == NULL) {
            self::$loader = new self ();
        }
        return self::$loader;
    }

    private function __construct() {
        self::setPath();
        spl_autoload_register ( array ($this, 'load') );
    }


    private static function setPath() {
//        $path = array_column($conf, 'room_path');
//        set_include_path(get_include_path() . ';' .implode(';', $path));
    }

    // 可以外部加载
    public static function register ($conf) {
        self::setPath($conf);
//        spl_autoload_register ( array ('Loader', 'load' ) );
    }

    private static function load ($class) {
        if (false !== strpos($class,'\\')) {
            // 框架需要加载的
            $class = trim($class, 'YFF');
            $className = substr($class, strrpos($class, '\\') + 1);
            foreach (self::$_YYF_ROOT as $path) {
                if (file_exists($path['path'] . $className . EXT)) {
                    include_once $path['path'] . $className . EXT;
                    break;
                }
            }
        }
//        print_r($class);exit();
//        $class = substr($class, strrpos($class, '\\') + 1);
//        $file = $class . '.php';
////        if (!file_exists($file)) {
////            throw new \Exception('Loader.load:file not exists');
////        }
////        include_once $file;
//        print_r(get_include_path());exit();
//        include_once $file;
    }
}