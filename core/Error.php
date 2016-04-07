<?php

// 记录IP 时间, UA等一系列信息
class Error {

    private static $_logger;
    private static $_email;

    //发邮件的级别
    private static $_sendEmailLevel = [

    ];

    public static function init ($logger, $email) {
        self::$_logger = $logger;
        self::$_email = $email;

        set_exception_handler(array('Error', 'customExceptionHandler'));
        set_error_handler(array("Error","customErrorHandler"));
        register_shutdown_function(array("Error","customShutDownHandler"));
    }

    private static function getErrorLevel ($levelNo) {
        $errorLevelMap = [
            E_ERROR => 'ERROR',
            E_WARNING => 'WARNING',
            E_PARSE => 'PARSE_ERROR',
            E_NOTICE => 'NOTICE',
            E_CORE_ERROR => 'CORE_ERROR',
            E_CORE_WARNING => 'CORE_WARNING',
            E_COMPILE_ERROR => 'COMPILE_ERROR',
            E_COMPILE_WARNING => 'COMPILE_WARNING',
            E_USER_NOTICE => 'USER_NOTICE',
            E_USER_ERROR => 'USER_ERROR',
            E_USER_WARNING => 'USER_WARNING',
            E_STRICT => 'STRICT_NOTICE',
            E_RECOVERABLE_ERROR => 'RECOVERABLE_ERROR',
            0 => 'EXCEPTION',
        ];
        return !empty($errorLevelMap[$levelNo]) ? $errorLevelMap[$levelNo] : 'UNKNOWN';
    }

    public static function customErrorHandler($errno, $message, $file, $line, $context) {
        $errInfo = [
            'error_no' => self::getErrorLevel($errno),
            'error_msg' => $message,
            'error_file' => $file,
            'error_line' => $line,
            'error_other' => var_export($context, true),
        ];
        self::_write_handle($errInfo, 'error');
        self::_email_handle($errInfo, 'error');
    }

    public static function customExceptionHandler($exception) {
        $errInfo = [
            'error_no' => self::getErrorLevel($exception->getCode()),
            'error_msg' => $exception->getMessage(),
            'error_file' => $exception->getFile(),
            'error_line' => $exception->getLine(),
            'error_other' => $exception->getTraceAsString(),
        ];
        self::_write_handle($errInfo, 'exception');
        self::_email_handle($errInfo, 'exception');
    }

    public static function customShutDownHandler() {
        $lastError = error_get_last();
        $errInfo = ['error_no' => 0, 'error_msg' => '', 'error_flie'=> '', 'error_line' => '', 'error_other' => ''];
        if (!empty($lastError)) {
            $errInfo = [
                'error_no' => self::getErrorLevel($errInfo['type']),
                'error_msg' => $errInfo['message'],
                'error_file' => $errInfo['file'],
                'error_line' => $errInfo['line'],
                'error_other' => 'from:error_get_last',
            ];
        }
        self::_write_handle($errInfo, 'shutdown');
        self::_email_handle($errInfo, 'shutdown');
    }

    private static function _write_handle($info, $type) {
        if (empty(self::$_logger)) {
            //没有传入loger处理器,默认用系统的
            error_log($type.':'.var_export($info, true), 3, '/data/logs/temp.log');
            return false;
        }

        //用自定义日志处理器来解决
    }

    private static function _email_handle($info, $type){
        if (empty(self::$_logger)) {
            //没有传入loger处理器,默认用系统的
            error_log($type.':'.var_export($info, true), 1, 'admin@qq.com');
            return false;
        }
    }

}