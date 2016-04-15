<?php

namespace YFF\Framework\Core;


class Service {
    private static $di;

    public static function init () {
        return self::$di;
    }

}