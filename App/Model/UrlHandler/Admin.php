<?php

namespace App\Model\UrlHandler;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\ClassHelper;
use App\Model\Logger\Logger;
use App\Helper\Url;

class Admin
{
    /**
     * Handles incoming admin requests
     */
    public function handle()
    {
        $urlPath = Url::getPath();
        array_shift($urlPath);

        $controllerName = ucfirst(array_shift($urlPath));
        $action = array_shift($urlPath) ?: 'Index';
        $controllerDir = 'App/Controller/Admin/' . $controllerName;

        if (ClassHelper::isAdminController($controllerDir, $action)) {
            /** @var AbstractAdminAction $controller */
            $controller = ClassHelper::createClassFromDir($controllerDir, $action);

            if (!isset($_SESSION['admin']['username'])) {
                if ($controllerName != 'Login') {
                    Url::redirect('/admin/login');
                }
            }

            try {
                if ($controller::ACTION_PERMISSION != AbstractAdminAction::PERMISSION_NONE
                    && !in_array(AbstractAdminAction::PERMISSION_ADMIN, $_SESSION['admin']['permissions'])
                    && !in_array($controller::ACTION_PERMISSION, $_SESSION['admin']['permissions'])
                ) {
                    throw new \Exception('You do not have permission to perform this action');
                }

                $controller->execute();
            } catch (\Exception $e) {
                $_SESSION['admin']['error_log'][] = $e;

                $logger = new Logger('exception.log');
                $logger->log($e->getMessage());

                if ($action != 'Index') {
                    Url::redirect('/admin/' . strtolower($controllerName));
                } else {
                    Url::redirect('/admin');
                }
            }
        } else {
            $_SESSION['admin']['error_log'][] = new \Exception('Invalid request');
            Url::redirect('/admin');
        }
    }
}
