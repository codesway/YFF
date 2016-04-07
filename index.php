<?php

define('LIBS_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR);
define('CONF_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR);

include LIBS_ROOT . 'Com.php';
include CONF_ROOT . 'Conf.php';

$config = Conf::get();
Com::init($config['libs']);
$markdown = Com::get('markdown');
echo $markdown->text('```this is parsedown ```');