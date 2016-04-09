<?php


class Logger {

    private function __construct(){

    }

    private static $LoggerMap = [

    ];

    //初始化
    public static function init ($config) {

    }

//    public static function trigger($type, $msg) {
//        return self::__LOG__();
//    }


//    public static function __callStatic($func, $arguments){
//        return call_user_func_array(['Logger', 'trigger'], [$func, $arguments]);
//    }

    public static function trace($msg) {
        $string = sprintf('[%s]: msg:%s file:%s line:%s trace:%s', 'TRACE', $msg, $_SERVER['SCRIPT_FILENAME'], __LINE__, __FUNCTION__);
        $write = self::package($string);
    }

    //对error模块提供的接口
    public static function sys(Error $obj) {
        $string = sprintf('[%s]: msg:%s file:%s line:%s trace:%s',$obj->error_trace['error_type'], $obj->error_trace['error_msg'], $obj->error_trace['error_file'], $obj->error_trace['error_line'], $obj->error_trace['error_other']);
        $write = self::package($string);
    }

    //拼装成统一的数据,写入进去
    private static function package($str) {
        $public = sprintf('mhthod:%s ip:%s ua:%s', $_SERVER['REQUEST_METHOD'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
        return $write = $str . $public . "\r\n";
    }

    private static function __LOG__() {

    }

    private function __clone(){

    }
}