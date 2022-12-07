<?php


$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
define('HTTP_URL', '/'. substr_replace(trim($_SERVER['REQUEST_URI'], '/'), '', 0, strlen($scriptName)));

define('SCRIPT', str_replace('\\', '/', rtrim(__DIR__, '/')) . '/');
define('SYSTEM', SCRIPT . 'System/');
define('CONTROLLERS', SCRIPT . 'Application/Controllers/');
define('MODELS', SCRIPT . 'Application/Models/');
define('UPLOAD', SCRIPT . '../Static/');
define('DATABASE', [
    'Port'   => '3306',
    'Host'   => 'localhost',
    'Name'   => 'bookdambinov',
    'User'   => 'root',
    'Pass'   => '',
]);


