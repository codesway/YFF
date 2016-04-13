<?php
namespace Framework\Libs\Qrcode;

class Qrcode {


    private $_conf = null;

    public function __construct($conf){

        $this->_conf = $conf;
    }

    public function init () {
        $libName = ucfirst($this->_conf['lib_name']);
        require_once dirname(__FILE__) . "/" . $libName . ".php";
        return new $libName();
    }
}