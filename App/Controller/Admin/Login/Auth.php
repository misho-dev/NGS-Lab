<?php

namespace App\Controller\Admin\Login;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Encrypter;
use App\Helper\Url;
use App\Model\Repository\Administrator as AdministratorRepository;

class Auth extends AbstractAdminAction
{
    public function execute()
    {
        $admin = AdministratorRepository::getAdministratorByUsername($_POST['username']);

        if (!$admin || $admin->getPassword() != Encrypter::encrypt(($_POST['password']))) {
            // throw new \Exception('Incorrect login');
        }

        $_SESSION['admin'] = [];
        $_SESSION['admin']['username'] = $admin->getUsername() ?? '';
        $_SESSION['admin']['permissions'] = $admin->getPermissionsAsArray();
        Url::redirect('/admin');
    }
}
