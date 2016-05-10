<?php

$loader->registerNamespaces([
    'YFF\Framework\Core' => FRAME_ROOT . '/core/',
    'YFF\Framework\Base' => FRAME_ROOT . '/base/',
    'YFF\Framework\Base\Download' => FRAME_ROOT . '/base/download/',
    'YFF\Framework\Base\Filter' => FRAME_ROOT . '/base/filter/',
    'YFF\Framework\Base\Image' => FRAME_ROOT . '/base/image/',
    'YFF\Framework\Base\Logger' => FRAME_ROOT . '/base/logger/',
    'YFF\Framework\Base\Func' => FRAME_ROOT . '/func/',
    'YFF\Framework\Base\Helper' => FRAME_ROOT . '/helper/',
    'YFF\Framework\Base\Interface' => FRAME_ROOT . '/interface/',
    'YFF\Framework\Base\Libs' => FRAME_ROOT . '/libs/',
    'YFF\Framework\Base\Models' => FRAME_ROOT . '/models/',
]);

$loader->register();
