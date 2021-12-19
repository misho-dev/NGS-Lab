<?php
require __DIR__.'/vendor/autoload.php';
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


use App\Model\Helper\ClassHelper;
use App\ViewModel\View;

// TODO: test
$urlParams = explode('/', strtok($_SERVER['REQUEST_URI'], '?'));
array_shift($urlParams);

$controllerName = ucfirst(array_shift($urlParams));
if ($controllerName == 'Admin') {
    // TODO: Check login
    $isAdmin = true;
    $controllerName = ucfirst(array_shift($urlParams));
    $controllerDir = 'App/Controller/Admin/'.$controllerName;
} else {
    $controllerDir = 'App/Controller/'.$controllerName;
}

if (is_dir($controllerDir)) {
    $action = array_shift($urlParams) ?: 'Index';

    /** @var App\Controller\ControllerAction|null $controller */
    $controller = ClassHelper::createFromDir($controllerDir, $action);
    if ($controller) {
        $controller->execute();
    } else {
        $pageTitle = 'Not Found';
        View::render(strtolower('contact.html')); // TODO: add .html? |> Create controller
    }
} else {
    // TODO: Check if page $controllerName exists
    View::render(strtolower($controllerName)); // TODO: add .html?
    // TODO: If not, 404
}

