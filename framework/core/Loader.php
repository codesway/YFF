<?php
namespace YFF\Framework\Core;

class Loader {

    private static $loader;

    private static $_YYF_ROOT = [
        'base' => ['path' => FRAME_ROOT . 'base/'],
        'core' => ['path' => FRAME_ROOT . 'core/'],
        'conf' => ['path' => FRAME_ROOT . 'conf/'],
        'func' => ['path' => FRAME_ROOT . 'func/'],
    ];

    public static function init() {
        if (self::$loader == NULL) {
            self::$loader = new self ();
        }
        return self::$loader;
    }

    private function __construct() {
        self::setPath(self::$_YYF_ROOT);
        spl_autoload_register ( array ($this, 'load') );
    }


    private static function setPath($framePath) {
        $path = array_column($framePath, 'path');
        set_include_path(get_include_path() . ';' .implode(';', $path));
    }

    // 可以外部加载
    public static function registerPath ($conf) {
//        self::setPath($conf);
//        spl_autoload_register ( array ('Loader', 'load' ) );
    }

    public static function register ($conf) {

    }

    private static function load ($class) {
        if (false !== strpos($class,'\\')) {
            // 框架需要加载的
            $class = trim($class, 'YFF');
            $className = substr($class, strrpos($class, '\\') + 1);
            include_once $className . EXT;
            if (file_exists($className . EXT)) {
                include_once $className . EXT;
            }
//            foreach (self::$_YYF_ROOT as $path) {
//                if (file_exists($path['path'] . $className . EXT)) {
//                    include_once $path['path'] . $className . EXT;
//                    break;
//                }
//            }
        }else{

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