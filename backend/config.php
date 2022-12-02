<?php

/**
 *  Config File For Handel Route, Database And Request
 * 
 *  Author: Mohammad Rahmani
 *  Email: rto1680@gmail.com
 *  WebPage: mohammadrahmani.com
 *  
 */

// Http Default Url
$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
define('HTTP_URL', '/'. substr_replace(trim($_SERVER['REQUEST_URI'], '/'), '', 0, strlen($scriptName)));

define('SCRIPT', str_replace('\\', '/', rtrim(__DIR__, '/')) . '/');
define('SYSTEM', SCRIPT . 'System/');
define('CONTROLLERS', SCRIPT . 'Application/Controllers/');
define('MODELS', SCRIPT . 'Application/Models/');
define('UPLOAD', SCRIPT . '../frontend/Static/');
define('DATABASE', [
    'Port'   => '3306',
    'Host'   => 'localhost',
    'Driver' => 'PDO',
    'Name'   => 'bookdambinov',
    'User'   => 'root',
    'Pass'   => '',
    'Prefix' => ''
]);

define('DB_PREFIX', '');

