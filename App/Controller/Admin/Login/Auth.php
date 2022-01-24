<?php

namespace App\Controller\Admin\Login;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\AdminSession;
use App\Helper\Encrypter;
use App\Helper\Url;
use App\Model\Repository\Administrator as AdministratorRepository;

class Auth extends AbstractAdminAction
{
    public function execute()
    {
        if (!AdminSession::isLoggedIn()) {
            if (!isset($_POST['username'])) {
                throw new \Exception('Unexpected error occurred. Please try again.');
            }

            $admin = AdministratorRepository::getAdministratorByUsername($_POST['username']);

            if (!$admin || $admin->getPassword() != Encrypter::encrypt(($_POST['password']))) {
                throw new \Exception('Incorrect login');
            }

            AdminSession::setAdmin($admin);
        }

        Url::redirect('/admin');
    }
}
