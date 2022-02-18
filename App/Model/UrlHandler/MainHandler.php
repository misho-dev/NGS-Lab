<?php

namespace App\Model\UrlHandler;

use App\Helper\ClassHelper;
use App\Helper\Session;
use App\Model\Logger\Logger;
use App\Helper\Url;
use App\ViewModel\View;
use Diversen\Lang;


class MainHandler
{
    /**
     * Handles incoming requests
     */
    public function handle()
    {
        if (Url::isAdmin()) {
            $admin = new Admin();
            $admin->handle();
            return;
        }

        $urlPath = Url::getPath();
        if ($urlPath[0] == 'ka') {
            Session::setLanguage('ka');
            array_shift($urlPath);
        } else {
            Session::setLanguage('en');
        }

        $controllerName = ucfirst(array_shift($urlPath));
        $controllerDir = 'App/Controller/' . $controllerName;
        $action = array_shift($urlPath) ?: 'Index';

        if (ClassHelper::isController($controllerDir, $action)) {
            /** @var App\Controller\ControllerAction|null $controller */
            $controller = ClassHelper::createClassFromDir($controllerDir, $action);

            try {
                $this->initLanguage();
                $controller->execute();
            } catch (\Exception $e) {
                $logger = new Logger('exception.log');
                $logger->log($e->getMessage());

                View::render('500-page.html');
            }
        } else {
            // TODO: Check if page $controllerName exists
            View::render(strtolower($controllerName)); // TODO: add .html?
            // TODO: If not, 404
        }
    }

    protected function initLanguage()
    {
        $language = new Lang();

        $language::$ignore = true;
        $language->setSingleDir("App");
        $language->loadLanguage(Session::getLanguage());
    }
}
