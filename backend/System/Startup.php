<?php

function autoload($class) {
    $file = SYSTEM . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file))
        require_once $file;
    else
        throw new Exception(sprintf('Class { %s } не найден!', $class));
}

spl_autoload_register('autoload');

require_once SYSTEM . 'Helper/public.php';
