<?php


class Logger {

    private static $LoggerMap = [

    ];

    public static function trigger($type, $msg) {
        return self::__LOG__();
    }


    public static function __callStatic($func, $arguments){
        return call_user_func_array(['Logger', 'trigger'], [$func, $arguments]);
    }

    private static function __LOG__() {

    }
}