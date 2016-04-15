<?php

namespace YFF\Framework\Libs;
class Com {

    private static $_conf;
    private static $_libs;

    private function __construct($mod){

    }

    /**
     * 初始化com对象,全局对象
     * @param
     */
    public static function get ($mod) {
        if (!empty(self::$_libs[$mod])) {
            return self::$_libs[$mod];
        }
        return self::load($mod);
    }

    /**
     * @param $libName
     */
    private static function load ($mod) {
        // 单独载入对应lib的配置
        if (empty(self::$_conf[$mod])) {
            throw new Exception ('Com.' . $mod . 'conf_is_empty');
        }

        $class = ucfirst($mod);
        require_once dirname(__FILE__)."/{$mod}/{$class}.php";
        $obj = new $class(self::$_conf[$mod]);
        self::$_libs[$mod] = $obj->init();
        return self::$_libs[$mod];
    }

    /**
     * 框架初始化的时候载入lib的配置,或者lib的入口载入配置
     * @param $conf
     * @param bool $satus
     */
    public static function init($conf, $flag = true) {
        // 去Load lib的conf
        self::$_conf = $conf;
    }

    private function __clone() {

    }

}