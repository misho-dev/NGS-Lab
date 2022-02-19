<?php

require __DIR__.'/vendor/autoload.php';

use App\Config\Config;
use App\Model\Logger\Logger;

session_start();
if (Config::get('app/config/mode') == 'developer') {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//error_reporting(0);

try {
    $urlHandler = new \App\Model\UrlHandler\MainHandler();
    $urlHandler->handle();
} catch (\Exception $e) {
    $logger = new Logger('exception.log');
    $logger->log($e->getMessage());
}
