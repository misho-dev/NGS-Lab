<?php

namespace App\Controller\Admin\Login;

use App\Config\Config;
use App\Controller\ControllerAction;
use App\Model\Helper\Url;

class Auth implements ControllerAction
{
    public function execute()
    {
        $username = Config::get('admin/user/name');
        $password = Config::get('admin/user/password');
        if ($username != $_POST['username'] || $password != md5($_POST['password'])) {
            throw new \Exception('Incorrect login');
        }

        $_SESSION['admin'] = [];
        Url::redirect('/admin');
    }
}