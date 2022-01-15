<?php

require __DIR__.'/vendor/autoload.php';

use App\Config\Config;
use App\Model\Helper\ClassHelper;
use App\Model\Helper\Url as UrlHelper;
use App\ViewModel\View;
use App\Model\Logger\Logger;

session_start();
if (Config::get('app/config/mode') == 'developer') {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

$urlPath = UrlHelper::getPath();

$controllerName = ucfirst(array_shift($urlPath));
if ($controllerName == 'Admin') {
    $controllerName = ucfirst(array_shift($urlPath));
    $controllerDir = 'App/Controller/Admin/'.$controllerName;
    $isAdmin = true;

    if (!isset($_SESSION['admin'])) {
        if ($controllerName != 'Login') {
            UrlHelper::redirect('/admin/login');
        }
    }
} else {
    $controllerDir = 'App/Controller/'.$controllerName;
}

if (is_dir($controllerDir)) {
    $action = array_shift($urlPath) ?: 'Index';

    /** @var App\Controller\ControllerAction|null $controller */
    $controller = ClassHelper::createFromDir($controllerDir, $action);
    if ($controller) {
        try {
            $controller->execute();
        } catch (\Exception $e) {
            $_SESSION['error_log'][] = $e;

            $logger = new Logger('exception.log');
            $logger->log($e->getMessage());

            if ($isAdmin) {
                if ($action != 'Index') {
                    UrlHelper::redirect('/admin/' . strtolower($controllerName));
                } else {
                    UrlHelper::redirect('/admin');
                }
            } else {
                View::render('500-page.html');
            }
        }
    } else {
        // 404 Page not found
        View::render('contact.html'); // TODO: add .html? |> Create controller
    }
} else {
    // TODO: Check if page $controllerName exists
    View::render(strtolower($controllerName)); // TODO: add .html?
    // TODO: If not, 404
}

