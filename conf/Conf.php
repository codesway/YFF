<?php


/**
 * Class Conf
 */
class Conf {

    private static $confs = [];

    public static function get ($type = null) {
        $conf = include_once dirname(__FILE__) . "/online/global.php";
        return $conf;
    }


}