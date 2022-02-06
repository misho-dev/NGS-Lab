<?php

namespace App\Model\UrlHandler;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\AdminSession;
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

            if (!AdminSession::isLoggedIn()) {
                if ($controllerName != 'Login') {
                    Url::redirect('/admin/login');
                }
            }

            try {
                if (!AdminSession::hasPermission(AbstractAdminAction::PERMISSION_ADMIN)
                    && !AdminSession::hasPermission($controller::ACTION_PERMISSION)
                ) {
                    throw new \Exception('You do not have permission to perform this action');
                }

                $controller->execute();
            } catch (\Exception $e) {
                AdminSession::addErrorLog($e);

                $logger = new Logger('exception.log');
                $logger->log($e->getMessage());

                if ($action != 'Index') {
                    Url::redirect('/admin/' . strtolower($controllerName));
                } else {
                    Url::redirect('/admin');
                }
            }
        } else {
            AdminSession::addErrorLog(new \Exception('Invalid request'));
            Url::redirect('/admin');
        }
    }
}
