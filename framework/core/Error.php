<?php
namespace Framework\Core;
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
            E_ERROR => ['error_type' => 'ERROR', 'log_type' => 'ERROR'],
            E_WARNING => ['error_type' => 'WARNING', 'log_type' => 'WARNING'],
            E_PARSE => ['error_type' => 'PARSE_ERROR', 'log_type' => 'ERROR'],
            E_NOTICE => ['error_type' => 'NOTICE', 'log_type' => 'NOTICE'],
            E_CORE_ERROR => ['error_type' => 'CORE_ERROR', 'log_type' => 'ERROR'],
            E_CORE_WARNING => ['error_type' => 'CORE_WARNING', 'log_type' => 'WARNING'],
            E_COMPILE_ERROR => ['error_type' => 'COMPILE_ERROR', 'log_type' => 'ERROR'],
            E_COMPILE_WARNING => ['error_type' => 'COMPILE_WARNING', 'log_type' => 'WARNING'],
            E_USER_NOTICE => ['error_type' => 'USER_NOTICE', 'log_type' => 'NOTICE'],
            E_USER_ERROR => ['error_type' => 'USER_ERROR', 'log_type' => 'ERROR'],
            E_USER_WARNING => ['error_type' => 'USER_WARNING', 'log_type' => 'WARNING'],
            E_STRICT => ['error_type' => 'STRICT_NOTICE', 'log_type' => 'NOTICE'],
            E_RECOVERABLE_ERROR => ['error_type' => 'RECOVERABLE_ERROR', 'log_type' => 'ERROR'],
            0 => ['error_type' => 'EXCEPTION', 'log_type' => 'EXCEPTION'],
        ];
        return !empty($errorLevelMap[$levelNo]) ? $errorLevelMap[$levelNo] : ['error_type' => 'UNKNOWN', 'log_type' => 'UNKNOWN'];
    }

    public static function customErrorHandler($errno, $message, $file, $line, $context) {
        $type = self::getErrorLevel($errno);
        $errInfo = [
            'error_type' => $type['log_type'],
            'error_msg' => $message,
            'error_file' => $file,
            'error_line' => $line,
            'error_other' => var_export($context, true),
        ];
        self::_write_handle($errInfo, 'error');
        self::_email_handle($errInfo, 'error');
    }

    public static function customExceptionHandler($exception) {
        $type = self::getErrorLevel($exception->getCode());
        $errInfo = [
            'error_type' => $type['log_type'],
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
        $errInfo = ['error_type' => 'UNKNOWN', 'error_msg' => '', 'error_flie'=> '', 'error_line' => '', 'error_other' => ''];
        if (!empty($lastError)) {
            $type = self::getErrorLevel($lastError['type']);
            $errInfo = [
                'error_type' => $type['log_type'],
                'error_msg' => $lastError['message'],
                'error_file' => $lastError['file'],
                'error_line' => $lastError['line'],
                'error_other' => 'from:error_get_last',
            ];
        }
        self::_write_handle($errInfo, 'shutdown');
        self::_email_handle($errInfo, 'shutdown');
    }

    private static function _write_handle($info, $type) {
        if (empty(self::$_logger)) {
            //没有传入loger处理器,默认用系统的
            return error_log($type.':'.var_export($info, true), 3, '/data/logs/temp.log');
        }
        $self = new self;
        $self->error_trace = $info;
        $self->type = $type;
        return Logger::sys($self);
        //用自定义日志处理器来解决
    }

    private static function _email_handle($info, $type){
        if (empty(self::$_logger)) {
            //没有传入loger处理器,默认用系统的
            return error_log($type.':'.var_export($info, true), 1, 'admin@qq.com');
        }
    }

}